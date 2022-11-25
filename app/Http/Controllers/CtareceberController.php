<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Ctareceber;
use App\Caixa;
use App\Planoconta;
use App\Banco;
use App\Tppagamento;
use App\Pessoa;
use Functions;
use Exception;

class CtareceberController extends Controller
{
    
    public function index(Request $request)
    {
        $query=trim($request->get('searchText'));
        $ctareceber = Ctareceber::select('ctarecebers.id_ctareceber',
                                         'ctarecebers.id_user',
                                         'ctarecebers.id_pessoa',
                                         'ctarecebers.cd_pessoa',
                                         'ctarecebers.nm_pessoa',
                                         'ctarecebers.nr_documento',
                                         'ctarecebers.nr_parcela',
                                         'ctarecebers.st_parcela',
                                         'ctarecebers.dt_vencimento',
                                         'ctarecebers.dt_pagamento',
                                         'ctarecebers.dt_carne',
                                         'ctarecebers.vl_apagar',
                                         'ctarecebers.vl_pago',
                                         'ctarecebers.vl_juros',
                                         'ctarecebers.vl_multa',
                                         'ctarecebers.vl_desconto',
                                         'ctarecebers.id_tppagamento',
                                         'ctarecebers.id_banco',
                                         'ctarecebers.id_planoconta',
                                         'ctarecebers.nr_cheque',
                                         'ctarecebers.nr_nossonum',
                                         'ctarecebers.nr_dvnossonum',
                                         'ctarecebers.nr_remessa',
                                         'ctarecebers.dt_rembanco',
                                         'ctarecebers.st_boleto',
                                         'ctarecebers.st_status',
                                         'ctarecebers.st_ativo',
                                         'ctarecebers.ds_historico',
                                         'ctarecebers.nm_obs',
                                         'tppagamentos.nm_tppagamento',
                                         'bancos.nm_banco',
                                         'planocontas.nm_planoconta',
                                         'planocontas.cd_conta')
                             ->leftJoin('tppagamentos', 'ctarecebers.id_tppagamento', '=', 'tppagamentos.id_tppagamento')
                             ->leftJoin('bancos', 'ctarecebers.id_banco', '=', 'bancos.id_banco')
                             ->leftJoin('planocontas', 'ctarecebers.id_planoconta', '=', 'planocontas.id_planoconta')
                             ->orderByRaw('ctarecebers.st_status ASC, ctarecebers.dt_vencimento ASC')
                             ->where('ctarecebers.st_ativo',1)
                             ->where(function ($sql) use ($query) {                          
                                $sql->Where('ctarecebers.nm_pessoa','LIKE', '%'.$query.'%')
                                    ->orWhere('ctarecebers.nr_documento',$query)
                                    ->orWhere('ctarecebers.dt_vencimento',Functions::DateToEua($query));
                             })          
                             ->paginate(50);

        return view("ctareceber.index",["ctarecebers"=>$ctareceber,"searchText"=>$query]);
    }

    public function create()
    {
        $planoconta = Planoconta::orderBy('nm_planoconta','asc')->get();
        $banco = Banco::orderBy('nm_banco','asc')->get();
        $tppagamento = Tppagamento::orderBy('nm_tppagamento','asc')->get();

        return view("ctareceber.create",[
            "planocontas" => $planoconta,
            "bancos" => $banco,
            "tppagamentos" => $tppagamento
        ]);        
    }

    public function store(Request $request)
    {
        $cliente = Pessoa::find($request->get('id_pessoa'));

        $ctareceber = new Ctareceber();
        $ctareceber->id_pessoa = $request->get('id_pessoa');
        $ctareceber->cd_pessoa = $cliente->cd_pessoa;
        $ctareceber->nm_pessoa = strtoupper($request->get('nm_pessoa'));
        $ctareceber->nr_documento = strtoupper($request->get('nr_documento'));
        $ctareceber->nr_parcela = $request->get('nr_parcela');        
        $ctareceber->st_parcela = $request->get('nr_parcela').'/'.$request->get('nr_parcela');                
        $ctareceber->dt_vencimento = Functions::DateToEua($request->get('dt_vencimento'));
        $ctareceber->dt_pagamento = Functions::DateToEua($request->get('dt_pagamento'));
        $ctareceber->vl_apagar = $request->get('vl_apagar');
        $ctareceber->vl_pago = $request->get('vl_pago');
        $ctareceber->vl_juros = $request->get('vl_juros');
        $ctareceber->vl_multa = $request->get('vl_multa');
        $ctareceber->vl_desconto = 0;
        $ctareceber->id_tppagamento = $request->get('id_tppagamento');
        $ctareceber->id_banco = $request->get('id_banco');
        $ctareceber->id_planoconta = $request->get('id_planoconta');
        $ctareceber->nr_cheque = $request->get('nr_cheque');
        $ctareceber->st_boleto = '1';
        $ctareceber->st_status = $request->get('vl_pago') > 0 ? '1' : '0';
        $ctareceber->ds_historico = strtoupper($request->get('ds_historico'));
        $ctareceber->nm_obs = strtoupper($request->get('nm_obs'));
        $ctareceber->id_user = Auth::id();
        $ctareceber->created_at = date('Y-m-d H:i:s');
        $ctareceber->save();

        //-- lança no caixa
        if ($ctareceber->st_status == '1') {
            $caixa = new Caixa();
            $caixa->id_pessoa = strtoupper($request->get('id_pessoa'));
            $caixa->cd_pessoa = $cliente->cd_pessoa;
            $caixa->nm_pessoa = strtoupper($request->get('nm_pessoa'));
            $caixa->nr_documento = strtoupper($request->get('nr_documento'));
            $caixa->id = $ctareceber->id_ctareceber;
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
            $caixa->st_modulo = '1';
            $caixa->st_creddeb = '0';
            $caixa->ds_historico = strtoupper($request->get('ds_historico'));
            $caixa->nm_obs = strtoupper($request->get('nm_obs'));
            $caixa->id_user = Auth::id();
            $caixa->created_at = date('Y-m-d H:i:s');
            $caixa->save();
        }        
        
        $request->session()->flash('alert-success', 'Adicionado com sucesso!');
        return Redirect::to('ctareceber');                
    }

    public function show($id)
    {
        $ctareceber = Ctareceber::select('ctarecebers.id_ctareceber',
                                         'ctarecebers.id_user',
                                         'ctarecebers.id_pessoa',
                                         'ctarecebers.cd_pessoa',
                                         'ctarecebers.nm_pessoa',
                                         'ctarecebers.nr_documento',
                                         'ctarecebers.nr_parcela',
                                         'ctarecebers.st_parcela',
                                         'ctarecebers.dt_vencimento',
                                         'ctarecebers.dt_pagamento',
                                         'ctarecebers.dt_carne',
                                         'ctarecebers.vl_apagar',
                                         'ctarecebers.vl_pago',
                                         'ctarecebers.vl_juros',
                                         'ctarecebers.vl_multa',
                                         'ctarecebers.vl_desconto',
                                         'ctarecebers.id_tppagamento',
                                         'ctarecebers.id_banco',
                                         'ctarecebers.id_planoconta',
                                         'ctarecebers.nr_cheque',
                                         'ctarecebers.nr_nossonum',
                                         'ctarecebers.nr_dvnossonum',
                                         'ctarecebers.nr_remessa',
                                         'ctarecebers.dt_rembanco',
                                         'ctarecebers.st_boleto',
                                         'ctarecebers.st_status',
                                         'ctarecebers.st_ativo',
                                         'ctarecebers.ds_historico',
                                         'ctarecebers.nm_obs',
                                         'tppagamentos.nm_tppagamento',
                                         'bancos.nm_banco',
                                         'planocontas.nm_planoconta',
                                         'planocontas.cd_conta')
                             ->leftJoin('tppagamentos', 'ctarecebers.id_tppagamento', '=', 'tppagamentos.id_tppagamento')
                             ->leftJoin('bancos', 'ctarecebers.id_banco', '=', 'bancos.id_banco')
                             ->leftJoin('planocontas', 'ctarecebers.id_planoconta', '=', 'planocontas.id_planoconta')
                             ->where('ctarecebers.id_ctareceber',$id)
                             ->first();
        
        return view('ctareceber.show', ['ctareceber'=>$ctareceber]);

    }

    public function edit($id)
    {
        $ctareceber = Ctareceber::find($id);        
        $planoconta = Planoconta::orderBy('nm_planoconta','asc')->get();
        $banco = Banco::orderBy('nm_banco','asc')->get();
        $tppagamento = Tppagamento::orderBy('nm_tppagamento','asc')->get();
        $action = action('CtareceberController@update', $ctareceber->id_ctareceber);

        return view("ctareceber.edit",[
            "ctareceber" => $ctareceber,
            "planocontas" => $planoconta,
            "bancos" => $banco,
            "tppagamentos" => $tppagamento,
            "action" => $action,
        ]);
    }

    public function update(Request $request, $id)
    {
        $cliente = Pessoa::find($request->get('id_pessoa'));
        $ctareceber = Ctareceber::find($id);

        $ctareceber->id_pessoa = $request->get('id_pessoa');
        $ctareceber->cd_pessoa = $cliente->cd_pessoa;
        $ctareceber->nm_pessoa = strtoupper($request->get('nm_pessoa'));
        $ctareceber->nr_documento = strtoupper($request->get('nr_documento'));
        $ctareceber->nr_parcela = $request->get('nr_parcela');        
        $ctareceber->dt_vencimento = Functions::DateToEua($request->get('dt_vencimento'));
        $ctareceber->dt_pagamento = Functions::DateToEua($request->get('dt_pagamento'));
        $ctareceber->vl_apagar = $request->get('vl_apagar');
        $ctareceber->vl_pago = $request->get('vl_pago');
        $ctareceber->vl_juros = $request->get('vl_juros');
        $ctareceber->vl_multa = $request->get('vl_multa');
        $ctareceber->vl_desconto = 0;
        $ctareceber->id_tppagamento = $request->get('id_tppagamento');
        $ctareceber->id_banco = $request->get('id_banco');
        $ctareceber->id_planoconta = $request->get('id_planoconta');
        $ctareceber->nr_cheque = $request->get('nr_cheque');
        $ctareceber->st_boleto = '1';
        $ctareceber->st_status = $request->get('vl_pago') > 0 ? '1' : '0';
        $ctareceber->ds_historico = strtoupper($request->get('ds_historico'));
        $ctareceber->nm_obs = strtoupper($request->get('nm_obs'));
        $ctareceber->id_user = Auth::id();
        $ctareceber->created_at = date('Y-m-d H:i:s');
        $ctareceber->save();

        //-- lança no caixa
        if ($ctareceber->st_status == '1') {
            $caixa = new Caixa();
            $caixa->id_pessoa = strtoupper($request->get('id_pessoa'));
            $caixa->cd_pessoa = $cliente->cd_pessoa;
            $caixa->nm_pessoa = strtoupper($request->get('nm_pessoa'));
            $caixa->nr_documento = strtoupper($request->get('nr_documento'));
            $caixa->id = $ctareceber->id_ctareceber;
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
            $caixa->st_modulo = '1';
            $caixa->st_creddeb = '0';
            $caixa->ds_historico = strtoupper($request->get('ds_historico'));
            $caixa->nm_obs = strtoupper($request->get('nm_obs'));
            $caixa->id_user = Auth::id();
            $caixa->created_at = date('Y-m-d H:i:s');
            $caixa->save();
        }        

        $request->session()->flash('alert-success', 'Adicionado com sucesso!');
        return Redirect::to('ctareceber');                        
    }

    public function destroy(Request $request,$id)
    {
        $ctareceber = Ctareceber::find($id);

        //-- exclui do caixa        
        $caixa = Caixa::where('id_pessoa',$ctareceber->id_pessoa)
                       ->where('nr_documento',$ctareceber->nr_documento)
                       ->where('nr_parcela', $ctareceber->nr_parcela)
                       ->where('id', $ctareceber->id_ctapagar)
                       ->where('st_creddeb', '0');
        $caixa->delete();        

        //-- exclui do contas a pagar
        $ctareceber->delete();                   

        $request->session()->flash('alert-success', 'Apagado com sucesso!');
        return redirect()->back();        
    }
}
