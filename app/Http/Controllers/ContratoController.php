<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Contrato;
use App\Contratodep;
use App\Ctareceber;
use App\Plano;
use App\Funcionario;
use App\Estcivil;
use App\Parentesco;
use App\Pessoa;
use DB;
use Functions;
use Exception;
use PDF;

class ContratoController extends Controller
{
    public function index(Request $request)
    {
        $query=trim($request->get('searchText'));
        $contrato = Contrato::select('contratos.id_contrato',
                                     'contratos.id_pessoa',
                                     'contratos.cd_pessoa',
                                     'contratos.nm_pessoa',
                                     'contratos.id_plano',
                                     'contratos.id_vendedor',
                                     'contratos.dt_inccontrato',
                                     'contratos.dt_fimcontrato',
                                     'contratos.dt_cancontrato',
                                     'contratos.dt_cobcontrato',
                                     'contratos.nr_carencia',
                                     'contratos.dt_termcarencia',
                                     'contratos.km_plano',
                                     'contratos.vl_plano',
                                     'contratos.nr_contrato',                                     
                                     'contratos.qt_dependente',
                                     'contratos.st_cobranca',
                                     'contratos.vl_adicional',
                                     'contratos.vl_total',
                                     'contratos.dt_valcarterinha',
                                     'contratos.qt_parcela',
                                     'contratos.dt_privencimento',
                                     'contratos.st_ativo',
                                     'contratos.st_status',
                                     'contratos.st_local',
                                     'contratos.nm_obs',                                    
                                     'planos.nm_plano',
                                     'pessoas.nm_pessoa as nm_vendedor')                                     
                             ->leftJoin('planos', 'contratos.id_plano', '=', 'planos.id_plano')
                             ->leftJoin('pessoas', 'contratos.id_vendedor', '=', 'pessoas.id_pessoa')
                             ->where('st_ativo',1)
                             ->where(function ($sql) use ($query) {
                                $sql->Where('contratos.nm_pessoa','LIKE', '%'.$query.'%')
                                    ->orWhere('contratos.cd_pessoa',$query)
                                    ->orWhere('contratos.nr_contrato',$query);  
                             })
                             ->orderBy('contratos.dt_inccontrato','desc')
                             ->paginate(50);

        return view("contrato.index",["contratos"=>$contrato,"searchText"=>$query]);    
    }

    public function create()
    {
        $plano = Plano::orderBy('nm_plano','asc')->get();
        $funcionario = Funcionario::where('st_tipo','2')->orderBy('nm_pessoa','asc')->get();
        $estcivil = Estcivil::orderBy('nm_estcivil','asc')->get();
        $parentesco = Parentesco::orderBy('nm_parentesco','asc')->get();

        $cobranca = [
            0 => [
                    'st_cobranca'=> 0,
                    'nm_cobranca'=> 'CARNE',
                 ],
            1 => [
                    'st_cobranca'=> 1,
                    'nm_cobranca'=> 'BOLETO',
                 ],        
        ];

        $local = [
            0 => [
                    'st_local'=> 0,
                    'nm_local'=> 'DOMICÍLIO',
                 ],
            1 => [
                    'st_local'=> 1,
                    'nm_local'=> 'NO ESCRITÓRIO',
                 ],        
            2 => [
                    'st_local'=> 2,
                    'nm_local'=> 'BANCO,LOTÉRICA...',
                ],        
        ];

        $sexo = [
            0 => [
                    'st_sexo'=> 0,
                    'nm_sexo'=> 'MASCULINO',
                 ],
            1 => [
                    'st_sexo'=> 1,
                    'nm_sexo'=> 'FEMININO',
                 ],        
        ];

        $status = [
            0 => [
                    'st_status'=> 0,
                    'nm_status'=> 'VIVO',
                 ],
            1 => [
                    'st_status'=> 1,
                    'nm_status'=> 'FALECIDO',
                 ],        
        ];

        return view("contrato.create",[
            'planos'=>$plano,
            'funcionarios'=>$funcionario,
            'estcivils'=>$estcivil,
            'parentescos'=>$parentesco,
            'cobrancas'=>$cobranca,
            'locals'=>$local,
            'sexos'=>$sexo,
            'statuss'=>$status,        
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        $cliente = Pessoa::find($request->get('id_pessoa'));

        try {
            //-- grava o contrato
            $contrato = new Contrato();
            $contrato->id_pessoa = $request->get('id_pessoa');        
            $contrato->cd_pessoa = $cliente->cd_pessoa;        
            $contrato->nm_pessoa = strtoupper($request->get('nm_pessoa'));
            $contrato->id_plano = $request->get('id_plano');        
            $contrato->id_vendedor = $request->get('id_vendedor');
            $contrato->dt_inccontrato = Functions::DateToEua($request->get('dt_inccontrato'));        
            $contrato->dt_fimcontrato = Functions::DateToEua($request->get('dt_fimcontrato'));
            $contrato->dt_cancontrato = Functions::DateToEua($request->get('dt_cancontrato'));
            $contrato->dt_cobcontrato = Functions::DateToEua($request->get('dt_cobcontrato'));
            $contrato->nr_carencia = $request->get('nr_carencia');
            $contrato->dt_termcarencia = Functions::DateToEua($request->get('dt_termcarencia'));
            $contrato->km_plano = $request->get('km_plano');
            $contrato->vl_plano = $request->get('vl_plano');
            $contrato->nr_contrato = $request->get('nr_contrato');
            $contrato->qt_dependente = $request->get('qt_dependente');
            $contrato->st_cobranca = $request->get('st_cobranca');
            $contrato->vl_adicional = $request->get('vl_adicional');
            $contrato->vl_total = ($contrato->vl_plano+$contrato->vl_adicional);
            $contrato->dt_valcarterinha = Functions::DateToEua($request->get('dt_valcarterinha'));
            $contrato->qt_parcela = $request->get('qt_parcela');
            $contrato->dt_privencimento = Functions::DateToEua($request->get('dt_privencimento'));
            $contrato->st_ativo = 1;
            $contrato->st_status = '0';
            $contrato->st_local = $request->get('st_local');
            $contrato->nm_obs = strtoupper($request->get('nm_obs'));         
            $contrato->id_user = Auth::id();
            $contrato->created_at = date('Y-m-d H:i:s');
            $contrato->save();
            
            //-- grava os dados do dependente
            $cd_sequencia = $request->get('cd_sequencia');
            $nm_dependente = $request->get('nm_dependente');
            $id_estcivil = $request->get('id_estcivil');
            $st_sexo = $request->get('st_sexo');
            $id_parentesco = $request->get('id_parentesco');
            $dt_nascimento = $request->get('dt_nascimento');
            $nr_cpf = $request->get('nr_cpf');
            $nr_rg = $request->get('nr_rg');
            $nr_carencia = $request->get('nr_carenciadep');
            $nr_telefone1 = $request->get('nr_telefone1');
            $nr_telefone2 = $request->get('nr_telefone2');
            $cont=0;
            
            while ($cont < count($cd_sequencia))
            { 
                $contratodep = new Contratodep();
                $contratodep->id_contrato = $contrato->id_contrato;
                $contratodep->id_pessoa = $contrato->id_pessoa;
                $contratodep->cd_pessoa = $contrato->cd_pessoa;
                $contratodep->nm_pessoa = $contrato->nm_pessoa;                
                $contratodep->id_jazigo = null;
                $contratodep->id_plano = $contrato->id_plano;
                $contratodep->id_cemiterio = null;
                $contratodep->id_funeraria = null;
                $contratodep->nr_placa = '';
                $contratodep->nr_contrato = $contrato->nr_contrato;
                $contratodep->cd_sequencia = $cd_sequencia[$cont];
                $contratodep->nm_dependente = $nm_dependente[$cont];
                $contratodep->nr_telefone1 = $nr_telefone1[$cont];
                $contratodep->nr_telefone2 = $nr_telefone2[$cont];
                $contratodep->id_estcivil =  $id_estcivil[$cont] ;
                $contratodep->id_parentesco = $id_parentesco[$cont];
                $contratodep->st_sexo = $st_sexo[$cont];
                $contratodep->dt_nascimento = Functions::DateToEua($dt_nascimento[$cont]);
                $contratodep->nr_idade = 0;
                $contratodep->st_depextra = 0;
                $contratodep->nr_cpf = $nr_cpf[$cont];
                $contratodep->nr_rg = $nr_rg[$cont];
                $contratodep->st_status = '0';
                $contratodep->dt_falecimento = null;
                $contratodep->dt_sepultamento = null;
                $contratodep->nr_carencia = $nr_carencia[$cont];
                $contratodep->st_titular = 0;
                $contratodep->st_ativo = 1;
                $contratodep->st_atendido = 0;
                $contratodep->st_continuidade = 0;
                $contratodep->nm_obs = '';
                $contratodep->id_user = Auth::id();
                $contratodep->created_at = date('Y-m-d H:i:s');
                $contratodep->save();
                $cont++;
            };

            
            //-- grava os dados do parcelamento
            $dt_vencimento = $request->get('dt_vencimento');
            $nr_parcela = $request->get('nr_parcela');
            $st_parcela = $request->get('st_parcela');
            $nr_parcela = $request->get('nr_parcela');
            $ds_historico = $request->get('ds_historico');
            $vl_apagar = $request->get('vl_apagar');
            $dt_pagamento = $request->get('dt_pagamento');
            $cont = 0;            

            while ($cont < count($nr_parcela))
            {
                $ctareceber = new Ctareceber();
                $ctareceber->id_pessoa = $contrato->id_pessoa;
                $ctareceber->cd_pessoa = $contrato->cd_pessoa;
                $ctareceber->nm_pessoa = $contrato->nm_pessoa;
                $ctareceber->nr_documento = $contrato->nr_contrato;
                $ctareceber->nr_parcela = $nr_parcela[$cont];
                $ctareceber->st_parcela = $st_parcela[$cont];
                $ctareceber->dt_vencimento = Functions::DateToEua($dt_vencimento[$cont]);
                $ctareceber->dt_pagamento = Functions::DateToEua($dt_pagamento[$cont]);
                $ctareceber->dt_carne = null;                
                $ctareceber->vl_apagar = Functions::MoedaEua($vl_apagar[$cont]);
                $ctareceber->vl_pago = 0;
                $ctareceber->vl_juros = 0;
                $ctareceber->vl_multa = 0;
                $ctareceber->vl_desconto = 0;
                $ctareceber->id_tppagamento = 2;
                $ctareceber->id_banco = 1;
                $ctareceber->id_planoconta = 61;                
                $ctareceber->nr_cheque = '';
                $ctareceber->nr_nossonum = '';
                $ctareceber->nr_dvnossonum = '';
                $ctareceber->nr_remessa = null;
                $ctareceber->dt_rembanco = null;
                $ctareceber->st_boleto = '1';                
                $ctareceber->st_status = '0';
                $ctareceber->st_ativo = 1;
                $ctareceber->ds_historico = $ds_historico[$cont];
                $ctareceber->nm_obs = '';
                $ctareceber->id_user = Auth::id();
                $ctareceber->created_at = date('Y-m-d H:i:s');
                $ctareceber->save();
                $cont++;
            };            
            
            DB::commit();
            $request->session()->flash('alert-success', 'Adicionado com sucesso!');            
            return Redirect::to('contrato');                    

        }catch(Exception $e) {
            DB::rollback();
            throw $e;
        }    
        return json_encode($contrato);    
    }

    public function show($id)
    {
        $plano = Plano::orderBy('nm_plano','asc')->get();
        $funcionario = Funcionario::where('st_tipo','2')->orderBy('nm_pessoa','asc')->get();
        $estcivil = Estcivil::orderBy('nm_estcivil','asc')->get();
        $parentesco = Parentesco::orderBy('nm_parentesco','asc')->get();

        $contrato = Contrato::select('contratos.id_contrato',
                                     'contratos.id_pessoa',
                                     'contratos.cd_pessoa',
                                     'contratos.nm_pessoa',
                                     'contratos.id_plano',
                                     'contratos.id_vendedor',
                                     'contratos.dt_inccontrato',
                                     'contratos.dt_fimcontrato',
                                     'contratos.dt_cancontrato',
                                     'contratos.dt_cobcontrato',
                                     'contratos.nr_carencia',
                                     'contratos.dt_termcarencia',
                                     'contratos.km_plano',
                                     'contratos.vl_plano',
                                     'contratos.nr_contrato',                                     
                                     'contratos.qt_dependente',
                                     'contratos.st_cobranca',
                                     'contratos.vl_adicional',
                                     'contratos.vl_total',
                                     'contratos.dt_valcarterinha',
                                     'contratos.qt_parcela',
                                     'contratos.dt_privencimento',
                                     'contratos.st_ativo',
                                     'contratos.st_status',
                                     'contratos.st_local',
                                     'contratos.nm_obs',                                    
                                     'planos.nm_plano',
                                     'pessoas.nm_pessoa as nm_vendedor')                                     
                             ->leftJoin('planos', 'contratos.id_plano', '=', 'planos.id_plano')
                             ->leftJoin('pessoas', 'contratos.id_vendedor', '=', 'pessoas.id_pessoa')
                             ->where('contratos.id_contrato',$id)
                             ->first();

        $contratodep = Contratodep::select('contratos_dep.id_contratodep',
                                           'contratos_dep.id_contrato',
                                           'contratos_dep.id_pessoa',
                                           'contratos_dep.cd_pessoa',
                                           'contratos_dep.nm_pessoa',
                                           'contratos_dep.dt_inccontrato',
                                           'contratos_dep.id_jazigo',
                                           'contratos_dep.id_plano',
                                           'contratos_dep.id_cemiterio',
                                           'contratos_dep.id_funeraria',
                                           'contratos_dep.id_vendedor',
                                           'contratos_dep.nm_vendedor',
                                           'contratos_dep.nr_placa',
                                           'contratos_dep.nr_contrato',
                                           'contratos_dep.cd_sequencia',
                                           'contratos_dep.nm_dependente',
                                           'contratos_dep.nr_telefone1',
                                           'contratos_dep.nr_telefone2',
                                           'contratos_dep.id_estcivil',
                                           'contratos_dep.id_parentesco',
                                           'contratos_dep.st_sexo',
                                           'contratos_dep.dt_nascimento',
                                           'contratos_dep.nr_idade',
                                           'contratos_dep.st_depextra',
                                           'contratos_dep.nr_cpf',
                                           'contratos_dep.nr_rg',
                                           'contratos_dep.nm_email',
                                           'contratos_dep.nm_cidade',
                                           'contratos_dep.nm_estado',
                                           'contratos_dep.st_status',
                                           'contratos_dep.dt_falecimento',
                                           'contratos_dep.dt_sepultamento',
                                           'contratos_dep.vl_sepultamento',
                                           'contratos_dep.nr_carencia',
                                           'contratos_dep.st_titular',
                                           'contratos_dep.st_ativo',
                                           'contratos_dep.id_obito',
                                           'contratos_dep.nm_obs',
                                           'jazigos.cd_jazigo',
                                           'planos.nm_plano',
                                           'cemiterios.nm_cemiterio',
                                           'funerarias.nm_funeraria',
                                           'estcivils.nm_estcivil',
                                           'parentescos.nm_parentesco'                                            
                                          )
                                ->leftJoin('jazigos', 'contratos_dep.id_jazigo', '=', 'jazigos.id_jazigo')
                                ->leftJoin('planos', 'contratos_dep.id_plano', '=', 'planos.id_plano')
                                ->leftJoin('cemiterios', 'contratos_dep.id_cemiterio', '=', 'cemiterios.id_cemiterio')
                                ->leftJoin('funerarias', 'contratos_dep.id_funeraria', '=', 'funerarias.id_funeraria')
                                ->leftJoin('estcivils', 'contratos_dep.id_estcivil', '=', 'estcivils.id_estcivil')
                                ->leftJoin('parentescos', 'contratos_dep.id_parentesco', '=', 'parentescos.id_parentesco')
                                ->where('contratos_dep.id_contrato',$id)
                                ->orderBy('contratos_dep.cd_sequencia','asc')
                                ->get();

        $ctareceber = Ctareceber::where('nr_documento',$contrato['nr_contrato'])
                                ->where('id_pessoa',$contrato['id_pessoa'])
                                ->leftJoin('tppagamentos', 'ctarecebers.id_tppagamento', '=', 'tppagamentos.id_tppagamento')
                                ->orderBy('dt_vencimento','asc')
                                ->get();                                   
                        
        $cobranca = [
            0 => [
                    'st_cobranca'=> 0,
                    'nm_cobranca'=> 'CARNE',
                    ],
            1 => [
                    'st_cobranca'=> 1,
                    'nm_cobranca'=> 'BOLETO',
                    ],        
        ];

        $local = [
            0 => [
                    'st_local'=> 0,
                    'nm_local'=> 'DOMICÍLIO',
                    ],
            1 => [
                    'st_local'=> 1,
                    'nm_local'=> 'NO ESCRITÓRIO',
                    ],        
            2 => [
                    'st_local'=> 2,
                    'nm_local'=> 'BANCO,LOTÉRICA...',
                ],        
        ];

        $sexo = [
            0 => [
                    'st_sexo'=> 0,
                    'nm_sexo'=> 'MASCULINO',
                    ],
            1 => [
                    'st_sexo'=> 1,
                    'nm_sexo'=> 'FEMININO',
                    ],        
        ];

        $status = [
            0 => [
                    'st_status'=> 0,
                    'nm_status'=> 'VIVO',
                    ],
            1 => [
                    'st_status'=> 1,
                    'nm_status'=> 'FALECIDO',
                    ],        
        ];             
        
        $total = 0;
        $pago  = 0;
        foreach($ctareceber as $o):
            $total += $o->vl_apagar;
            $pago  += $o->vl_pago;
        endforeach;
        
        return view('contrato.show',[
            'contrato'=>$contrato,
            'contratodeps'=>$contratodep,
            'ctarecebers'=>$ctareceber,
            'planos'=>$plano,
            'funcionarios'=>$funcionario,
            'estcivils'=>$estcivil,
            'parentescos'=>$parentesco,
            'cobrancas'=>$cobranca,
            'locals'=>$local,
            'sexos'=>$sexo,
            'statuss'=>$status,   
            'total'=>$total,
            'pago'=>$pago,      
        ]);               
                        
    }

    public function edit($id)
    {
        $plano = Plano::orderBy('nm_plano','asc')->get();
        $funcionario = Funcionario::where('st_tipo','2')->orderBy('nm_pessoa','asc')->get();
        $estcivil = Estcivil::orderBy('nm_estcivil','asc')->get();
        $parentesco = Parentesco::orderBy('nm_parentesco','asc')->get();

        $contrato = Contrato::select('contratos.id_contrato',
                                     'contratos.id_pessoa',
                                     'contratos.cd_pessoa',
                                     'contratos.nm_pessoa',
                                     'contratos.id_plano',
                                     'contratos.id_vendedor',
                                     'contratos.dt_inccontrato',
                                     'contratos.dt_fimcontrato',
                                     'contratos.dt_cancontrato',
                                     'contratos.dt_cobcontrato',
                                     'contratos.nr_carencia',
                                     'contratos.dt_termcarencia',
                                     'contratos.km_plano',
                                     'contratos.vl_plano',
                                     'contratos.nr_contrato',                                     
                                     'contratos.qt_dependente',
                                     'contratos.st_cobranca',
                                     'contratos.vl_adicional',
                                     'contratos.vl_total',
                                     'contratos.dt_valcarterinha',
                                     'contratos.qt_parcela',
                                     'contratos.dt_privencimento',
                                     'contratos.st_ativo',
                                     'contratos.st_status',
                                     'contratos.st_local',
                                     'contratos.nm_obs',                                    
                                     'planos.nm_plano',
                                     'pessoas.nm_pessoa as nm_vendedor')                                     
                             ->leftJoin('planos', 'contratos.id_plano', '=', 'planos.id_plano')
                             ->leftJoin('pessoas', 'contratos.id_vendedor', '=', 'pessoas.id_pessoa')
                             ->where('contratos.id_contrato',$id)
                             ->first();

        $contratodep = Contratodep::select('contratos_dep.id_contratodep',
                                           'contratos_dep.id_contrato',
                                           'contratos_dep.id_pessoa',
                                           'contratos_dep.cd_pessoa',
                                           'contratos_dep.nm_pessoa',
                                           'contratos_dep.dt_inccontrato',
                                           'contratos_dep.id_jazigo',
                                           'contratos_dep.id_plano',
                                           'contratos_dep.id_cemiterio',
                                           'contratos_dep.id_funeraria',
                                           'contratos_dep.id_vendedor',
                                           'contratos_dep.nm_vendedor',
                                           'contratos_dep.nr_placa',
                                           'contratos_dep.nr_contrato',
                                           'contratos_dep.cd_sequencia',
                                           'contratos_dep.nm_dependente',
                                           'contratos_dep.nr_telefone1',
                                           'contratos_dep.nr_telefone2',
                                           'contratos_dep.id_estcivil',
                                           'contratos_dep.id_parentesco',
                                           'contratos_dep.st_sexo',
                                           'contratos_dep.dt_nascimento',
                                           'contratos_dep.nr_idade',
                                           'contratos_dep.st_depextra',
                                           'contratos_dep.nr_cpf',
                                           'contratos_dep.nr_rg',
                                           'contratos_dep.nm_email',
                                           'contratos_dep.nm_cidade',
                                           'contratos_dep.nm_estado',
                                           'contratos_dep.st_status',
                                           'contratos_dep.dt_falecimento',
                                           'contratos_dep.dt_sepultamento',
                                           'contratos_dep.vl_sepultamento',
                                           'contratos_dep.nr_carencia',
                                           'contratos_dep.st_titular',
                                           'contratos_dep.st_ativo',
                                           'contratos_dep.id_obito',
                                           'contratos_dep.nm_obs',
                                           'jazigos.cd_jazigo',
                                           'planos.nm_plano',
                                           'cemiterios.nm_cemiterio',
                                           'funerarias.nm_funeraria',
                                           'estcivils.nm_estcivil',
                                           'parentescos.nm_parentesco'                                            
                                          )
                                ->leftJoin('jazigos', 'contratos_dep.id_jazigo', '=', 'jazigos.id_jazigo')
                                ->leftJoin('planos', 'contratos_dep.id_plano', '=', 'planos.id_plano')
                                ->leftJoin('cemiterios', 'contratos_dep.id_cemiterio', '=', 'cemiterios.id_cemiterio')
                                ->leftJoin('funerarias', 'contratos_dep.id_funeraria', '=', 'funerarias.id_funeraria')
                                ->leftJoin('estcivils', 'contratos_dep.id_estcivil', '=', 'estcivils.id_estcivil')
                                ->leftJoin('parentescos', 'contratos_dep.id_parentesco', '=', 'parentescos.id_parentesco')
                                ->where('contratos_dep.id_contrato',$id)
                                ->orderBy('contratos_dep.cd_sequencia','asc')
                                ->get();

        $ctareceber = Ctareceber::where('nr_documento',$contrato['nr_contrato'])
                                ->where('id_pessoa',$contrato['id_pessoa'])
                                ->leftJoin('tppagamentos', 'ctarecebers.id_tppagamento', '=', 'tppagamentos.id_tppagamento')
                                ->orderBy('dt_vencimento','asc')
                                ->get();                                   
                        
        $cobranca = [
            0 => [
                    'st_cobranca'=> 0,
                    'nm_cobranca'=> 'CARNE',
                    ],
            1 => [
                    'st_cobranca'=> 1,
                    'nm_cobranca'=> 'BOLETO',
                    ],        
        ];

        $local = [
            0 => [
                    'st_local'=> 0,
                    'nm_local'=> 'DOMICÍLIO',
                    ],
            1 => [
                    'st_local'=> 1,
                    'nm_local'=> 'NO ESCRITÓRIO',
                    ],        
            2 => [
                    'st_local'=> 2,
                    'nm_local'=> 'BANCO,LOTÉRICA...',
                ],        
        ];

        $sexo = [
            0 => [
                    'st_sexo'=> 0,
                    'nm_sexo'=> 'MASCULINO',
                    ],
            1 => [
                    'st_sexo'=> 1,
                    'nm_sexo'=> 'FEMININO',
                    ],        
        ];

        $status = [
            0 => [
                    'st_status'=> 0,
                    'nm_status'=> 'VIVO',
                    ],
            1 => [
                    'st_status'=> 1,
                    'nm_status'=> 'FALECIDO',
                    ],        
        ];                     

        $total = 0;
        $pago  = 0;
        foreach($ctareceber as $o):
            $total += $o->vl_apagar;
            $pago  += $o->vl_pago;
        endforeach;
        
        return view('contrato.edit',[
            'contrato'=>$contrato,
            'contratodeps'=>$contratodep,
            'ctarecebers'=>$ctareceber,
            'planos'=>$plano,
            'funcionarios'=>$funcionario,
            'estcivils'=>$estcivil,
            'parentescos'=>$parentesco,
            'cobrancas'=>$cobranca,
            'locals'=>$local,
            'sexos'=>$sexo,
            'statuss'=>$status, 
            'total'=>$total,
            'pago'=>$pago,   
        ]);                       
    }

    public function update(Request $request, $id)
    {  
        $contrato = Contrato::find($id);
        if (isset($contrato)) {
            $contrato->id_pessoa = $request->input('id_pessoa');
            $contrato->nm_pessoa = strtoupper($request->input('nm_pessoa'));
            $contrato->id_plano = $request->input('id_plano');
            $contrato->id_vendedor = $request->input('id_vendedor');
            $contrato->dt_inccontrato = $request->input('dt_inccontrato');
            $contrato->dt_fimcontrato = $request->input('dt_fimcontrato');
            $contrato->dt_cancontrato = $request->input('dt_cancontrato');
            $contrato->dt_cobcontrato = $request->input('dt_cobcontrato');
            $contrato->nr_carencia = $request->input('nr_carencia');
            $contrato->dt_termcarencia = $request->input('dt_termcarencia');
            $contrato->km_plano = $request->input('km_plano');
            $contrato->vl_plano = $request->input('vl_plano');
            $contrato->nr_contrato = $request->input('nr_contrato');
            $contrato->qt_dependente = $request->input('qt_dependente');
            $contrato->st_cobranca = $request->input('st_cobranca');
            $contrato->vl_adicional = $request->input('vl_adicional');
            $contrato->vl_total = $request->input('vl_total');
            $contrato->dt_valcarterinha = $request->input('dt_valcarterinha');
            $contrato->qt_parcela = $request->input('qt_parcela');
            $contrato->dt_privencimento = $request->input('dt_privencimento');
            $contrato->st_status = $request->input('st_status');
            $contrato->st_local = $request->input('st_local');
            $contrato->nm_obs = strtoupper($request->input('nm_obs')); 
            $contrato->id_user = Auth::id();
            $contrato->save();
            return json_encode($contrato);
        }        
        return response('Registro não encontrado', 404);
    }

    public function destroy(Request $request,$id)
    {
        $contrato = Contrato::find($id);
        $contrato->delete();

        $request->session()->flash('alert-success', 'Apagado com sucesso!');
        return redirect()->back(); 
    }

    public function imprimir(Request $request,$id)
    {
        $contratos = Contrato::paginate(50);
        $pdf = PDF::loadView('contrato.pdfview', compact('contratos'));
        return $pdf->setPaper('A4','portrait')->stream();
    }

}
