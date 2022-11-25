<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Caixa;
use Functions;
use Exception;
use PDF;

class RelcaixaController extends Controller
{

    public function index()
    {        
        return view("relcaixa.index",[
            'dt_inicial' => '',
            'dt_final' => '',            
        ]);
    }

    public function impcaixa(Request $request)
    {
        $caixa = Caixa::select('caixas.id_caixa',
                               'caixas.id_user',
                               'caixas.id_pessoa',
                               'caixas.id_caixa',
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
                               'planocontas.cd_conta',
                               'planocontas.nm_planoconta'
                              )
                        ->leftJoin('planocontas', 'caixas.id_planoconta', '=', 'planocontas.id_planoconta')
                        ->whereBetween('dt_movimento',[
                                       Functions::DateToEua($request->get('dt_inicial')),
                                       Functions::DateToEua($request->get('dt_final'))])
                        ->orderByRaw('id_planoconta asc','nm_pessoa asc')
                        ->get();                                              

        return view("relcaixa.pdfview",[
            'caixas' => $caixa,
            'dt_inicial' => $request->get('dt_inicial'),
            'dt_final' => $request->get('dt_final')
        ]);
    }
}
