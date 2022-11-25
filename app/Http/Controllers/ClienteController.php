<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Cliente;
use App\Estcivil;
use App\Religiao;
use App\Estado;
use App\Contratodep;
use App\Ctareceber;
use App\Protocolo;
use Functions;

class ClienteController extends Controller
{
    protected $st_tipo = 0; // 0-cliente/1-fornecedor/2-funcionario/3-empresa(corporativo)

    public function index(Request $request)
    {        
        $query=trim($request->get('searchText'));
        $cliente = Cliente::select('pessoas.id_pessoa',
                                   'pessoas.cd_pessoa',    
                                   'pessoas.nm_pessoa',
                                   'pessoas.nm_endereco',
                                   'pessoas.nr_numender',
                                   'pessoas.nm_complender',
                                   'pessoas.nm_bairro',
                                   'pessoas.nm_cidade',
                                   'pessoas.nr_cep',
                                   'pessoas.nm_estado',
                                   'pessoas.nr_telefone1',
                                   'pessoas.nr_telefone2',
                                   'pessoas.nr_telefone3',
                                   'pessoas.nr_telefone4',
                                   'pessoas.nm_pai',
                                   'pessoas.nr_paitelefone',
                                   'pessoas.st_paivivo',
                                   'pessoas.nm_mae',
                                   'pessoas.nr_maetelefone',
                                   'pessoas.st_maeviva',
                                   'pessoas.nm_conjuge',    
                                   'pessoas.nr_conjugetelefone',
                                   'pessoas.nr_cpfcnpj',
                                   'pessoas.nr_rgie',
                                   'pessoas.nm_email',
                                   'pessoas.nm_site',
                                   'pessoas.nm_profissao',
                                   'pessoas.id_estcivil',
                                   'pessoas.dt_nascimento',
                                   'pessoas.id_religiao',
                                   'pessoas.nm_nacionalidade',
                                   'pessoas.nm_naturalidade',
                                   'pessoas.st_sexo',
                                   'pessoas.st_pessoa',
                                   'pessoas.st_tipo',
                                   'pessoas.nm_contato',
                                   'pessoas.vl_comprod',
                                   'pessoas.vl_comserv',
                                   'pessoas.st_comcob',
                                   'pessoas.vl_salario',
                                   'pessoas.dt_admissao',
                                   'pessoas.nr_pis',
                                   'pessoas.nr_ctps',
                                   'pessoas.id_funcao',
                                   'pessoas.nm_obs',
                                   'pessoas.created_at')
                          ->leftJoin('estcivils', 'pessoas.id_estcivil', '=', 'estcivils.id_estcivil')
                          ->leftJoin('religiaos', 'pessoas.id_religiao', '=', 'religiaos.id_religiao')
                          ->leftJoin('funcoes', 'pessoas.id_funcao', '=', 'funcoes.id_funcao')                          
                          ->where('st_tipo',$this->st_tipo)
                          ->where(function ($sql) use ($query) {
                              $sql->Where('pessoas.nm_pessoa','LIKE', '%'.$query.'%')
                                  ->orWhere('pessoas.cd_pessoa',$query)
                                  ->orWhere('pessoas.nr_cpfcnpj','LIKE', '%'.$query.'%');  
                          })    
                          ->orderBy('pessoas.created_at','desc')                                
                          ->paginate(50);

        return view("cliente.index",["clientes"=>$cliente,"searchText"=>$query]);             
    }

    public function create()
    {
        $estcivil = Estcivil::orderBy('nm_estcivil','asc')->get();
        $religiao = Religiao::orderBy('nm_religiao','asc')->get();
        $estado = Estado::orderBy('nm_sigla','asc')->get();

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

        return view("cliente.create",[
            'estcivils'=>$estcivil,
            'religiaos'=>$religiao,
            'estados'=>$estado,
            'sexos' => $sexo,
        ]);
    }

    public function store(Request $request)
    {
        $cliente = new Cliente();
        $cliente->cd_pessoa = strtoupper($request->get('cd_pessoa'));
        $cliente->nm_pessoa = strtoupper($request->get('nm_pessoa'));
        $cliente->nm_endereco = strtoupper($request->get('nm_endereco'));
        $cliente->nr_numender = strtoupper($request->get('nr_numender'));
        $cliente->nm_complender = strtoupper($request->get('nm_complender'));
        $cliente->nm_bairro = strtoupper($request->get('nm_bairro'));
        $cliente->nm_cidade = strtoupper($request->get('nm_cidade'));
        $cliente->nr_cep = $request->get('nr_cep');
        $cliente->nm_estado = strtoupper($request->get('nm_estado'));
        $cliente->nr_telefone1 = strtoupper($request->get('nr_telefone1'));
        $cliente->nr_telefone2 = strtoupper($request->get('nr_telefone2'));
        $cliente->nr_telefone3 = strtoupper($request->get('nr_telefone3'));
        $cliente->nr_telefone4 = strtoupper($request->get('nr_telefone3'));
        $cliente->nm_pai = strtoupper($request->get('nm_pai'));
        $cliente->nr_paitelefone = strtoupper($request->get('nr_paitelefone'));
        $cliente->st_paivivo = $request->get('st_paivivo') !== null ? 1 : 0;
        $cliente->nm_mae = strtoupper($request->get('nm_mae'));
        $cliente->nr_maetelefone = strtoupper($request->get('nr_maetelefone'));
        $cliente->st_maeviva = $request->get('st_maeviva') !== null ? 1 : 0;
        $cliente->nm_conjuge = strtoupper($request->get('nm_mae'));
        $cliente->nr_conjugetelefone = strtoupper($request->get('nr_maetelefone'));
        $cliente->nr_cpfcnpj = $request->get('nr_cpfcnpj');
        $cliente->nr_rgie = $request->get('nr_rgie');
        $cliente->nm_email = strtoupper($request->get('nm_email'));
        $cliente->nm_profissao = strtoupper($request->get('nm_profissao'));
        $cliente->id_estcivil = $request->get('id_estcivil');
        $cliente->dt_nascimento = Functions::DateToEua($request->get('dt_nascimento'));
        $cliente->id_religiao = $request->get('id_religiao');
        $cliente->nm_nacionalidade = strtoupper($request->get('nm_nacionalidade'));
        $cliente->nm_naturalidade = strtoupper($request->get('nm_naturalidade'));
        $cliente->st_sexo = $request->get('st_sexo');
        $cliente->st_pessoa = '0';
        $cliente->st_tipo = $this->st_tipo;
        $cliente->nm_obs = strtoupper($request->get('nm_obs')); 
        $cliente->id_user = Auth::id();
        $cliente->created_at = date('Y-m-d H:i:s');
        $cliente->save();

        $request->session()->flash('alert-success', 'Adicionado com sucesso!');
        return Redirect::to('cliente');
    }

    public function show($id)
    {
        $cliente = Cliente::find($id);   
        $estcivil = Estcivil::orderBy('nm_estcivil','asc')->get();
        $religiao = Religiao::orderBy('nm_religiao','asc')->get();
        $estado = Estado::orderBy('nm_sigla','asc')->get();   
        
        //-- localiza os dependentes e o financeiro ativo
        $contdepativo = Contratodep::select('contratos_dep.id_contratodep',
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
                                   ->where('contratos_dep.id_pessoa',$id)
                                   ->where('contratos_dep.st_ativo',1) 
                                   ->orderBy('contratos_dep.cd_sequencia','asc')
                                   ->get();
        $ctarecativo = Ctareceber::where('id_pessoa',$id)
                                 ->where('st_ativo',1)
                                 ->leftJoin('tppagamentos', 'ctarecebers.id_tppagamento', '=', 'tppagamentos.id_tppagamento')
                                 ->orderBy('dt_vencimento','desc')
                                 ->get();                                  
        $protocolo = Protocolo::where('id_pessoa',$id) 
                              ->orderBy('dt_protocolo','asc')
                              ->get();       

                              
        //-- localiza os dependentes e o financeiro inativos
        $contdepinativo = Contratodep::select('contratos_dep.id_contratodep',
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
                                     ->where('contratos_dep.id_pessoa',$id)
                                     ->where('contratos_dep.st_ativo',0) 
                                     ->orderBy('contratos_dep.cd_sequencia','asc')
                                     ->get();
        $ctarecinativo = Ctareceber::where('id_pessoa',$id)
                                   ->where('st_ativo',0)
                                   ->leftJoin('tppagamentos', 'ctarecebers.id_tppagamento', '=', 'tppagamentos.id_tppagamento')
                                   ->orderBy('dt_vencimento','desc')
                                   ->get();                                  
                              
                              
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
                    
        return view('cliente.show',[
            'cliente'=>$cliente,
            'contdepativo'=>$contdepativo,
            'ctarecativo'=>$ctarecativo,
            'protocolo'=>$protocolo,
            'estcivil'=>$estcivil,
            'religiao'=>$religiao,
            'estado'=>$estado,
            'sexo' => $sexo,
            'contdepinativo'=>$contdepinativo,
            'ctarecinativo'=>$ctarecinativo,
        ]);        
    }

    public function edit($id)
    {
        $cliente = Cliente::find($id);        
        $estcivil = Estcivil::orderBy('nm_estcivil','asc')->get();
        $religiao = Religiao::orderBy('nm_religiao','asc')->get();
        $estado = Estado::orderBy('nm_sigla','asc')->get();
        $action = action('ClienteController@update', $cliente->id_pessoa);

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

        return view("cliente.edit",[
            'cliente'=>$cliente,
            'estcivils'=>$estcivil,
            'religiaos'=>$religiao,
            'estados'=>$estado,
            'sexos' => $sexo,
            'action'=> $action,
        ]);        
    }

    public function update(Request $request, $id)
    {        
        $cliente = Cliente::find($id);
        $cliente->cd_pessoa = strtoupper($request->get('cd_pessoa'));
        $cliente->nm_pessoa = strtoupper($request->get('nm_pessoa'));
        $cliente->nm_endereco = strtoupper($request->get('nm_endereco'));
        $cliente->nr_numender = strtoupper($request->get('nr_numender'));
        $cliente->nm_complender = strtoupper($request->get('nm_complender'));
        $cliente->nm_bairro = strtoupper($request->get('nm_bairro'));
        $cliente->nm_cidade = strtoupper($request->get('nm_cidade'));
        $cliente->nr_cep = $request->get('nr_cep');
        $cliente->nm_estado = strtoupper($request->get('nm_estado'));
        $cliente->nr_telefone1 = strtoupper($request->get('nr_telefone1'));
        $cliente->nr_telefone2 = strtoupper($request->get('nr_telefone2'));
        $cliente->nr_telefone3 = strtoupper($request->get('nr_telefone3'));
        $cliente->nr_telefone4 = strtoupper($request->get('nr_telefone3'));
        $cliente->nm_pai = strtoupper($request->get('nm_pai'));
        $cliente->nr_paitelefone = strtoupper($request->get('nr_paitelefone'));
        $cliente->st_paivivo = $request->get('st_paivivo') !== null ? 1 : 0;
        $cliente->nm_mae = strtoupper($request->get('nm_mae'));
        $cliente->nr_maetelefone = strtoupper($request->get('nr_maetelefone'));
        $cliente->st_maeviva = $request->get('st_maeviva') !== null ? 1 : 0;
        $cliente->nm_conjuge = strtoupper($request->get('nm_mae'));
        $cliente->nr_conjugetelefone = strtoupper($request->get('nr_maetelefone'));
        $cliente->nr_cpfcnpj = $request->get('nr_cpfcnpj');
        $cliente->nr_rgie = $request->get('nr_rgie');
        $cliente->nm_email = strtoupper($request->get('nm_email'));
        $cliente->nm_profissao = strtoupper($request->get('nm_profissao'));
        $cliente->id_estcivil = $request->get('id_estcivil');
        $cliente->dt_nascimento = Functions::DateToEua($request->get('dt_nascimento'));
        $cliente->id_religiao = $request->get('id_religiao');
        $cliente->nm_nacionalidade = strtoupper($request->get('nm_nacionalidade'));
        $cliente->nm_naturalidade = strtoupper($request->get('nm_naturalidade'));
        $cliente->st_sexo = $request->get('st_sexo');
        $cliente->st_pessoa = '0';
        $cliente->st_tipo = $this->st_tipo;
        $cliente->nm_obs = strtoupper($request->get('nm_obs')); 
        $cliente->id_user = Auth::id();
        $cliente->save();

        $request->session()->flash('alert-success', 'Alterado com sucesso!');
        return Redirect::to('cliente');
    }

    public function destroy(Request $request,$id)
    {
        $cliente = Cliente::find($id);
        $cliente->delete();

        $request->session()->flash('alert-success', 'Apagado com sucesso!');
        return redirect()->back();        
    }

    public function autocomplete(Request $request)
    {
        $termo =  $request->get('term');
        $cliente = Cliente::where('st_tipo',$this->st_tipo)
                          ->where(function ($sql) use ($termo) {
                              $sql->where('nm_pessoa','like','%'.$termo.'%')
                                  ->orWhere('nr_cpfcnpj',$termo) 
                                  ->orWhere('cd_pessoa',$termo);    
                            }) 
                          ->get();
                          
        $data = [];
        foreach ($cliente as $key => $value) {
            $data[] = ['id'=>$value->id_pessoa,'label'=>$value->nm_pessoa];
        }
        return response($data);
    }

}
