@extends('adminlte::page')

@section('title', 'Contas a Receber')

@section('content_header')
@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <h2>Consulta</h2>
        <div class="flash-message">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))

                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="fechar">&times;</a></p>
                @endif
            @endforeach
        </div>
        <h3>{{ $ctareceber->nm_pessoa }} </h3>

        <div class="card">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Nº Documento:</b> {{ $ctareceber->nr_documento }}</li>
                <li class="list-group-item"><b>Nº Parcela:</b> {{ $ctareceber->nr_parcela }}</li>
                <li class="list-group-item"><b>Qt Parcela:</b> {{ $ctareceber->st_parcela }}</li>
                <li class="list-group-item"><b>Vencimento:</b> {{ empty($ctareceber->dt_vencimento) ? '' : $ctareceber->dt_vencimento->format("d/m/Y") }}</li>                
                <li class="list-group-item"><b>$ Valor:</b> {{ number_format($ctareceber->vl_apagar,2, '.', '') }}</li>
                <li class="list-group-item"><b>Tipo de Pagamento:</b> {{ $ctareceber->nm_tppagamento }}</li>
                <li class="list-group-item"><b>$ Pago:</b> {{ number_format($ctareceber->vl_pago,2, '.', '') }}</li>
                <li class="list-group-item"><b>Pagamento:</b> {{ empty($ctareceber->dt_pagamento) ? '' : $ctareceber->dt_pagamento->format("d/m/Y") }}</li>
                <li class="list-group-item"><b>$ Juros:</b> {{ number_format($ctareceber->vl_juros,2, '.', '') }}</li>
                <li class="list-group-item"><b>$ Multa:</b> {{ number_format($ctareceber->vl_multa,2, '.', '') }}</li>
                <li class="list-group-item"><b>Banco:</b> {{ $ctareceber->nm_banco }}</li>
                <li class="list-group-item"><b>Plano de Contas:</b> {{ $ctareceber->nm_planoconta }}</li>
                <li class="list-group-item"><b>Agencia:</b> {{ $ctareceber->cd_agencia }}</li>
                <li class="list-group-item"><b>Conta:</b> {{ $ctareceber->nr_conta }}</li>
                <li class="list-group-item"><b>Cheque:</b> {{ $ctareceber->nr_cheque }}</li>
                <li class="list-group-item"><b>Histório:</b> {{ $ctareceber->ds_historico }}</li>                                               
                <li class="list-group-item"><b>Observação:</b> {{ $ctareceber->nm_obs }}</li>
            </ul>
        </div>
        <hr>
        <a href="{{ url()->previous() }}" class="btn btn-primary">Voltar</a>
    </div>
</div>
@endsection

@section('js')
@stop

