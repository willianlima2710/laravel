@extends('adminlte::page')

@section('title', 'Fluxo de Caixa')

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
        <h3>{{ $caixa->nm_pessoa }} </h3>

        <div class="card">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Nº Documento:</b> {{ $caixa->nr_documento }}</li>
                <li class="list-group-item"><b>Nº Parcela:</b> {{ $caixa->nr_parcela }}</li>
                <li class="list-group-item"><b>Vencimento:</b> {{ empty($caixa->dt_vencimento) ? '' : $caixa->dt_vencimento->format("d/m/Y") }}</li>                
                <li class="list-group-item"><b>$ Valor:</b> {{ number_format($caixa->vl_total,2, '.', '') }}</li>
                <li class="list-group-item"><b>Tipo de Pagamento:</b> {{ $caixa->nm_tppagamento }}</li>
                <li class="list-group-item"><b>Pagamento:</b> {{ empty($caixa->dt_pagamento) ? '' : $caixa->dt_pagamento->format("d/m/Y") }}</li>
                <li class="list-group-item"><b>Movimento:</b> {{ empty($caixa->dt_movimento) ? '' : $caixa->dt_movimento->format("d/m/Y") }}</li>                
                <li class="list-group-item"><b>$ Juros:</b> {{ number_format($caixa->vl_juros,2, '.', '') }}</li>
                <li class="list-group-item"><b>$ Multa:</b> {{ number_format($caixa->vl_multa,2, '.', '') }}</li>
                <li class="list-group-item"><b>Banco:</b> {{ $caixa->nm_banco }}</li>
                <li class="list-group-item"><b>Plano de Contas:</b> {{ $caixa->nm_planoconta }}</li>
                <li class="list-group-item"><b>Agencia:</b> {{ $caixa->cd_agencia }}</li>
                <li class="list-group-item"><b>Conta:</b> {{ $caixa->nr_conta }}</li>
                <li class="list-group-item"><b>Cheque:</b> {{ $caixa->nr_cheque }}</li>
                <li class="list-group-item"><b>Histório:</b> {{ $caixa->ds_historico }}</li>                                               
                <li class="list-group-item"><b>Observação:</b> {{ $caixa->nm_obs }}</li>
            </ul>
        </div>
        <hr>
        <a href="{{ url()->previous() }}" class="btn btn-primary">Voltar</a>
    </div>
</div>
@endsection

@section('js')
@stop

