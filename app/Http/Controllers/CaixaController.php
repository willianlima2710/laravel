<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Caixa;
use App\Planoconta;
use App\Banco;
use App\Tppagamento;
use App\Pessoa;
use App\Parametro;
use Functions;

class CaixaController extends Controller
{

    public function index(Request $request)
    {
        $query=trim($request->get('searchText'));
        $caixa = Caixa::select('caixas.id_caixa',
                               'caixas.id_pessoa',
                               'caixas.cd_pessoa',
                               'caixas.nm_pessoa',
                               'caixas.nr_documento',
                               'caixas.id',
                               'caixas.nr_parcela',
                               'caixas.dt_vencimento',
                               'caixas.dt_pagamento',
                               'caixas.dt_movimento',
                               'caixas.vl_total',
                               'caixas.vl_juros',
                               'caixas.vl_multa',
                               'caixas.vl_desconto',
                               'caixas.vl_saldo',
                               'caixas.id_tppagamento',
                               'caixas.id_banco',
                               'caixas.id_planoconta',
                               'caixas.cd_agencia',
                               'caixas.nr_conta',
                               'caixas.nr_cheque',
                               'caixas.st_modulo',
                               'caixas.st_creddeb',
                               'caixas.ds_historico',
                               'caixas.nm_obs',
                               'tppagamentos.nm_tppagamento',
                               'bancos.nm_banco',
                               'planocontas.nm_planoconta',
                               'planocontas.cd_conta')                    
                      ->leftJoin('tppagamentos', 'caixas.id_tppagamento', '=', 'tppagamentos.id_tppagamento')
                      ->leftJoin('bancos', 'caixas.id_banco', '=', 'bancos.id_banco')
                      ->leftJoin('planocontas', 'caixas.id_planoconta', '=', 'planocontas.id_planoconta')
                      //->whereYear('caixas.dt_movimento',date('Y'))           
                      ->where(function ($sql) use ($query) {                          
                          $sql->Where('caixas.nm_pessoa','LIKE', '%'.$query.'%')
                              ->orWhere('caixas.nr_documento',$query)
                              ->orWhere('caixas.dt_vencimento',Functions::DateToEua($query))                                
                              ->orWhere('caixas.vl_total',$query);
                        })    
                      ->orderBy('caixas.created_at','desc')                                
                      ->paginate(50);
        return view("caixa.index",["caixas"=>$caixa,"searchText"=>$query]);             
    }

    public function create()
    {
        $planoconta = Planoconta::orderBy('nm_planoconta','asc')->get();
        $banco = Banco::orderBy('nm_banco','asc')->get();
        $tppagamento = Tppagamento::orderBy('nm_tppagamento','asc')->get();

        $creddeb = [
            0 => [
                    'st_creddeb'=> 0,
                    'nm_creddeb'=> 'CREDITO',
                 ],
            1 => [
                    'st_creddeb'=> 1,
                    'nm_creddeb'=> 'DEBITO',
                 ],        
        ];

        return view("caixa.create",[
            "planocontas" => $planoconta,
            "bancos" => $banco,
            "tppagamentos" => $tppagamento,
            "creddeb" => $creddeb,
        ]);
    }

    public function store(Request $request)
    {
        $pessoa = Pessoa::find($request->get('id_pessoa'));

        // verifica se tem documento senão busca
        if (empty($request->get('nr_documento'))) {
            $parametro = Parametro::all()->first();
            $nr_documento = $parametro->nr_doccaixa+1;
            
            // atualiza o numero do documento do caixa
            $parametro->nr_doccaixa = $nr_documento;
            $parametro->save();                
        }else{
            $nr_documento = $request->get('nr_documento');
        }

        $caixa = new Caixa();
        $caixa->id_pessoa = $request->get('id_pessoa');
        $caixa->cd_pessoa = $pessoa->cd_pessoa;
        $caixa->nm_pessoa = strtoupper($request->get('nm_pessoa'));
        $caixa->nr_documento = strtoupper($nr_documento);
        $caixa->nr_parcela = $request->get('nr_parcela');
        $caixa->dt_vencimento = Functions::DateToEua($request->get('dt_movimento'));
        $caixa->dt_pagamento = Functions::DateToEua($request->get('dt_movimento'));
        $caixa->dt_movimento = Functions::DateToEua($request->get('dt_movimento'));       
        $caixa->vl_total = $request->get('vl_total');
        $caixa->vl_juros = $request->get('vl_juros');
        $caixa->vl_multa = $request->get('vl_multa');
        $caixa->vl_desconto = 0;
        $caixa->vl_saldo = 0;
        $caixa->id_tppagamento = $request->get('id_tppagamento') ;
        $caixa->id_banco = $request->get('id_banco');
        $caixa->id_planoconta = $request->get('id_planoconta');
        $caixa->cd_agencia = $request->get('cd_agencia');
        $caixa->nr_conta = $request->get('nr_conta');
        $caixa->nr_cheque = $request->get('nr_cheque');
        $caixa->st_modulo = '0';
        $caixa->st_creddeb = $request->get('st_creddeb');
        $caixa->ds_historico = strtoupper($request->get('ds_historico'));
        $caixa->nm_obs = strtoupper($request->get('nm_obs'));
        $caixa->id_user = Auth::id();
        $caixa->created_at = date('Y-m-d H:i:s');
        $caixa->save();

        $request->session()->flash('alert-success', 'Adicionado com sucesso!');
        return Redirect::to('caixa');                
    }

    public function show($id)
    {
        $caixa = Caixa::select('caixas.id_caixa',
                               'caixas.id_pessoa',
                               'caixas.cd_pessoa',
                               'caixas.nm_pessoa',
                               'caixas.nr_documento',
                               'caixas.id',
                               'caixas.nr_parcela',
                               'caixas.dt_vencimento',
                               'caixas.dt_pagamento',
                               'caixas.dt_movimento',
                               'caixas.vl_total',
                               'caixas.vl_juros',
                               'caixas.vl_multa',
                               'caixas.vl_desconto',
                               'caixas.vl_saldo',
                               'caixas.id_tppagamento',
                               'caixas.id_banco',
                               'caixas.id_planoconta',
                               'caixas.cd_agencia',
                               'caixas.nr_conta',
                               'caixas.nr_cheque',
                               'caixas.st_modulo',
                               'caixas.st_creddeb',
                               'caixas.ds_historico',
                               'caixas.nm_obs',
                               'tppagamentos.nm_tppagamento',
                               'bancos.nm_banco',
                               'planocontas.nm_planoconta',
                               'planocontas.cd_conta')                    
                      ->leftJoin('tppagamentos', 'caixas.id_tppagamento', '=', 'tppagamentos.id_tppagamento')
                      ->leftJoin('bancos', 'caixas.id_banco', '=', 'bancos.id_banco')
                      ->leftJoin('planocontas', 'caixas.id_planoconta', '=', 'planocontas.id_planoconta')
                      ->where('caixas.id_caixa',$id)
                      ->first();

        return view('caixa.show',[
            'caixa'=>$caixa,
        ]);        
    }

    public function edit($id)
    {
        $caixa = Caixa::find($id);
        $planoconta = Planoconta::orderBy('nm_planoconta','asc')->get();
        $banco = Banco::orderBy('nm_banco','asc')->get();
        $tppagamento = Tppagamento::orderBy('nm_tppagamento','asc')->get();        
        $action = action('CaixaController@update', $caixa->id_caixa);

        $creddeb = [
            0 => [
                    'st_creddeb'=> 0,
                    'nm_creddeb'=> 'CREDITO',
                 ],
            1 => [
                    'st_creddeb'=> 1,
                    'nm_creddeb'=> 'DEBITO',
                 ],        
        ];

        return view("caixa.edit",[
            "caixa" => $caixa,
            "planocontas" => $planoconta,
            "bancos" => $banco,
            "tppagamentos" => $tppagamento,
            "creddeb" => $creddeb,
            "action" => $action,
        ]);        
    }

    public function update(Request $request, $id)
    {
        $pessoa = Pessoa::find($request->get('id_pessoa'));

        $caixa = Caixa::find($id);
        $caixa->id_pessoa = $request->get('id_pessoa');
        $caixa->cd_pessoa =$pessoa->cd_pessoa;
        $caixa->nm_pessoa = strtoupper($request->get('nm_pessoa'));
        $caixa->nr_documento = strtoupper($request->get('nr_documento'));
        $caixa->nr_parcela = $request->get('nr_parcela');
        $caixa->dt_vencimento = Functions::DateToEua($request->get('dt_movimento'));
        $caixa->dt_pagamento = Functions::DateToEua($request->get('dt_movimento'));
        $caixa->dt_movimento = Functions::DateToEua($request->get('dt_movimento'));       
        $caixa->vl_total = $request->get('vl_total');
        $caixa->vl_juros = $request->get('vl_juros');
        $caixa->vl_multa = $request->get('vl_multa');
        $caixa->vl_desconto = 0;
        $caixa->vl_saldo = 0;
        $caixa->id_tppagamento = $request->get('id_tppagamento') ;
        $caixa->id_banco = $request->get('id_banco');
        $caixa->id_planoconta = $request->get('id_planoconta');
        $caixa->cd_agencia = $request->get('cd_agencia');
        $caixa->nr_conta = $request->get('nr_conta');
        $caixa->nr_cheque = $request->get('nr_cheque');
        $caixa->st_modulo = '0';
        $caixa->st_creddeb = $request->get('st_creddeb');
        $caixa->ds_historico = strtoupper($request->get('ds_historico'));
        $caixa->nm_obs = strtoupper($request->get('nm_obs'));
        $caixa->id_user = Auth::id();
        $caixa->created_at = date('Y-m-d H:i:s');
        $caixa->save();

        $request->session()->flash('alert-success', 'Alterado com sucesso!');
        return Redirect::to('caixa');        
    }
 
    public function destroy(Request $request,$id)
    {
        $caixa = Caixa::find($id);
        $caixa->delete();

        $request->session()->flash('alert-success', 'Apagado com sucesso!');
        return redirect()->back();        
    }
}
