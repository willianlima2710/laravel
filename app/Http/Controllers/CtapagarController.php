<?php

namespace App\Http\Controllers;

use App\Http\Requests\CtapagarRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Ctapagar;
use App\Caixa;
use App\Planoconta;
use App\Banco;
use App\Tppagamento;
use App\Parametro;
use Functions;
use Exception;
use DB;

class CtapagarController extends Controller
{        
    public function index(Request $request)
    {        
        $query=trim($request->get('searchText'));
        $ctapagar = Ctapagar::select('ctapagars.id_ctapagar',
                                     'ctapagars.id_user',
                                     'ctapagars.id_fornecedor',
                                     'ctapagars.nm_fornecedor',
                                     'ctapagars.nr_documento',
                                     'ctapagars.nr_parcela',
                                     'ctapagars.dt_vencimento',
                                     'ctapagars.dt_pagamento',
                                     'ctapagars.vl_apagar',
                                     'ctapagars.vl_pago',
                                     'ctapagars.vl_juros',
                                     'ctapagars.vl_multa',
                                     'ctapagars.vl_desconto',
                                     'ctapagars.id_tppagamento',
                                     'ctapagars.id_banco',
                                     'ctapagars.id_planoconta',
                                     'ctapagars.cd_agencia',
                                     'ctapagars.nr_conta',
                                     'ctapagars.nr_cheque',
                                     'ctapagars.st_status',
                                     'ctapagars.ds_historico',
                                     'ctapagars.nm_obs',
                                     'ctapagars.created_at',
                                     'tppagamentos.nm_tppagamento',
                                     'bancos.nm_banco',
                                     'planocontas.nm_planoconta',
                                     'planocontas.cd_conta')
                            ->leftJoin('tppagamentos', 'ctapagars.id_tppagamento', '=', 'tppagamentos.id_tppagamento')
                            ->leftJoin('bancos', 'ctapagars.id_banco', '=', 'bancos.id_banco')
                            ->leftJoin('planocontas', 'ctapagars.id_planoconta', '=', 'planocontas.id_planoconta')
                            ->where('ctapagars.nm_fornecedor','LIKE', '%'.$query.'%')
                            ->orWhere('ctapagars.nr_documento',$query)
                            ->orWhere('ctapagars.dt_vencimento',Functions::DateToEua($query))                                
                            ->orWhere('ctapagars.vl_apagar',$query)
                            ->orWhere('ctapagars.nr_cheque',$query)
                            ->orWhere('ctapagars.ds_historico','LIKE', '%'.$query.'%')
                            ->orderBy('ctapagars.created_at','desc')                                
                            ->paginate(50);

        return view("ctapagar.index",["ctapagars"=>$ctapagar,"searchText"=>$query]);             
    }  

    public function create()
    {
        $planoconta = Planoconta::orderBy('nm_planoconta','asc')->get();
        $banco = Banco::orderBy('nm_banco','asc')->get();
        $tppagamento = Tppagamento::orderBy('nm_tppagamento','asc')->get();

        return view("ctapagar.create",[
            "planocontas" => $planoconta,
            "bancos" => $banco,
            "tppagamentos" => $tppagamento
        ]);
    }

    public function store(CtapagarRequest $request)
    {                
        DB::beginTransaction();
        
        try {
            $dt_vencimento = $request->get('dt_vencimento');
            $nr_documento = $request->get('nr_documento');
            $nr_parcela = $request->get('nr_parcela');
            $vl_apagar = $request->get('vl_apagar');
            $cont=0;

            // verifica se tem documento senão busca
            if (empty($nr_documento[$cont])) {
                $parametro = Parametro::all()->first();
                $nr_documento[0] = $parametro->nr_docctapagar+1;
                
                // atualiza o numero do documento do contas a pagar
                $parametro->nr_docctapagar = $nr_documento[0];
                $parametro->save();                
            }
            
            while ($cont < count($dt_vencimento))
            {
                $ctapagar = new Ctapagar();
                $ctapagar->id_fornecedor = $request->get('id_fornecedor');
                $ctapagar->nm_fornecedor = strtoupper($request->get('nm_fornecedor'));
                $ctapagar->nr_documento = $nr_documento[0].'/'.($cont+1);
                $ctapagar->nr_parcela = $nr_parcela[$cont];
                $ctapagar->dt_vencimento = Functions::DateToEua($dt_vencimento[$cont]);
                $ctapagar->dt_pagamento = null;
                $ctapagar->vl_apagar = $vl_apagar[$cont];
                $ctapagar->vl_pago = null;
                $ctapagar->vl_juros = null;
                $ctapagar->vl_multa = null;
                $ctapagar->vl_desconto = null;
                $ctapagar->id_tppagamento = $request->get('id_tppagamento');
                $ctapagar->id_banco = $request->get('id_banco');
                $ctapagar->id_planoconta = $request->get('id_planoconta');
                $ctapagar->cd_agencia = $request->get('cd_agencia');
                $ctapagar->nr_conta = $request->get('nr_conta');
                $ctapagar->nr_cheque = $request->get('nr_cheque');    
                $ctapagar->st_status = '0';
                $ctapagar->ds_historico = strtoupper($request->get('ds_historico'));
                $ctapagar->nm_obs = strtoupper($request->get('nm_obs'));
                $ctapagar->id_user = Auth::id();
                $ctapagar->created_at = date('Y-m-d H:i:s');
                $ctapagar->save();
                $cont++; 
            }

            DB::commit();
            $request->session()->flash('alert-success', 'Adicionado com sucesso!');            
            return Redirect::to('ctapagar');                    

        }catch(Exception $e) {
            DB::rollback();
            throw $e;
        }    
        return json_encode($ctapagar);  
    }

    public function show($id)
    {
        $ctapagar = Ctapagar::select('ctapagars.id_ctapagar',
                                     'ctapagars.id_user',
                                     'ctapagars.id_fornecedor',
                                     'ctapagars.nm_fornecedor',
                                     'ctapagars.nr_documento',
                                     'ctapagars.nr_parcela',
                                     'ctapagars.dt_vencimento',
                                     'ctapagars.dt_pagamento',
                                     'ctapagars.vl_apagar',
                                     'ctapagars.vl_pago',
                                     'ctapagars.vl_juros',
                                     'ctapagars.vl_multa',
                                     'ctapagars.vl_desconto',
                                     'ctapagars.id_tppagamento',
                                     'ctapagars.id_banco',
                                     'ctapagars.id_planoconta',
                                     'ctapagars.cd_agencia',
                                     'ctapagars.nr_conta',
                                     'ctapagars.nr_cheque',
                                     'ctapagars.st_status',
                                     'ctapagars.ds_historico',
                                     'ctapagars.nm_obs',
                                     'ctapagars.created_at',
                                     'tppagamentos.nm_tppagamento',
                                     'bancos.nm_banco',
                                     'planocontas.nm_planoconta',
                                     'planocontas.cd_conta')
                            ->leftJoin('tppagamentos', 'ctapagars.id_tppagamento', '=', 'tppagamentos.id_tppagamento')
                            ->leftJoin('bancos', 'ctapagars.id_banco', '=', 'bancos.id_banco')
                            ->leftJoin('planocontas', 'ctapagars.id_planoconta', '=', 'planocontas.id_planoconta')
                            ->where('ctapagars.id_ctapagar',$id)
                            ->first();                     

        return view('ctapagar.show', ['ctapagar'=>$ctapagar]);
    }

    public function edit($id)
    {
        $ctapagar = Ctapagar::find($id);        
        $planoconta = Planoconta::orderBy('nm_planoconta','asc')->get();
        $banco = Banco::orderBy('nm_banco','asc')->get();
        $tppagamento = Tppagamento::orderBy('nm_tppagamento','asc')->get();
        $action = action('CtapagarController@update', $ctapagar->id_ctapagar);

        return view("ctapagar.edit",[
            "ctapagar" => $ctapagar,
            "planocontas" => $planoconta,
            "bancos" => $banco,
            "tppagamentos" => $tppagamento,
            "action" => $action,
        ]);
    }

    public function update(CtapagarRequest $request, $id)
    {
        $ctapagar = Ctapagar::find($id);           
        $ctapagar->id_fornecedor = $request->get('id_fornecedor');
        $ctapagar->nm_fornecedor = strtoupper($request->get('nm_fornecedor'));
        $ctapagar->nr_documento = strtoupper($request->get('nr_documento'));
        $ctapagar->nr_parcela = $request->get('nr_parcela');
        $ctapagar->dt_vencimento = Functions::DateToEua($request->get('dt_vencimento'));
        $ctapagar->dt_pagamento = Functions::DateToEua($request->get('dt_pagamento'));
        $ctapagar->vl_apagar = $request->get('vl_apagar');
        $ctapagar->vl_pago = $request->get('vl_pago');
        $ctapagar->vl_juros = $request->get('vl_juros');
        $ctapagar->vl_multa = $request->get('vl_multa');
        $ctapagar->vl_desconto = 0;
        $ctapagar->id_tppagamento = $request->get('id_tppagamento');
        $ctapagar->id_banco = $request->get('id_banco');
        $ctapagar->id_planoconta = $request->get('id_planoconta');
        $ctapagar->cd_agencia = $request->get('cd_agencia');
        $ctapagar->nr_conta = $request->get('nr_conta');
        $ctapagar->nr_cheque = $request->get('nr_cheque');    
        $ctapagar->st_status = $request->get('vl_pago') > 0 ? '1' : '0';
        $ctapagar->ds_historico = strtoupper($request->get('ds_historico'));
        $ctapagar->nm_obs = strtoupper($request->get('nm_obs'));
        $ctapagar->id_user = Auth::id();
        $ctapagar->created_at = date('Y-m-d H:i:s');
        $ctapagar->save();

        //-- lança no caixa
        if ($ctapagar->st_status == '1') {            
            $caixa = new Caixa();
            $caixa->id_pessoa = strtoupper($request->get('id_fornecedor'));
            $caixa->cd_pessoa = strtoupper($request->get('id_fornecedor'));
            $caixa->nm_pessoa = strtoupper($request->get('nm_fornecedor'));
            $caixa->nr_documento = strtoupper($request->get('nr_documento'));
            $caixa->id = $ctapagar->id_ctapagar;
            $caixa->nr_parcela = $request->get('nr_parcela');
            $caixa->dt_vencimento = Functions::DateToEua($request->get('dt_vencimento'));
            $caixa->dt_pagamento = Functions::DateToEua($request->get('dt_pagamento'));
            $caixa->dt_movimento = Functions::DateToEua($request->get('dt_pagamento'));       
            $caixa->vl_total = $request->get('vl_pago');
            $caixa->vl_juros = $request->get('vl_juros');
            $caixa->vl_multa = $request->get('vl_multa');
            $caixa->vl_desconto = 0;
            $caixa->vl_saldo = 0;
            $caixa->id_tppagamento = $request->get('id_tppagamento');
            $caixa->id_banco = $request->get('id_banco');
            $caixa->id_planoconta = $request->get('id_planoconta');
            $caixa->cd_agencia = $request->get('cd_agencia');
            $caixa->nr_conta = $request->get('nr_conta');
            $caixa->nr_cheque = $request->get('nr_cheque');        
            $caixa->st_modulo = '2';
            $caixa->st_creddeb = '1';
            $caixa->ds_historico = strtoupper($request->get('ds_historico'));
            $caixa->nm_obs = strtoupper($request->get('nm_obs'));
            $caixa->id_user = Auth::id();
            $caixa->created_at = date('Y-m-d H:i:s');
            $caixa->save();
        }
        
        $request->session()->flash('alert-success', 'Alterado com sucesso!');
        return Redirect::to('ctapagar');
    }

    public function destroy(Request $request,$id)
    {
        $ctapagar = Ctapagar::find($id);

        //-- exclui do caixa
        
        $caixa = Caixa::where('id_pessoa',$ctapagar->id_fornecedor)
                        ->where('nr_documento',$ctapagar->nr_documento)
                        ->where('nr_parcela', $ctapagar->nr_parcela)
                        ->where('id', $ctapagar->id_ctapagar)
                        ->where('st_creddeb', '1');
        $caixa->delete();
        

        //-- exclui do contas a pagar
        $ctapagar->delete();                   

        $request->session()->flash('alert-success', 'Apagado com sucesso!');
        return redirect()->back();        
    }
}
