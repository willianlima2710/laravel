@extends('adminlte::page')

@section('title', 'Obito')

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
        <h3>{{ $ctapagar->nm_fornecedor }} </h3>

        <div class="card">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Nº Documento:</b> {{ $ctapagar->nr_documento }}</li>
                <li class="list-group-item"><b>Nº Parcela:</b> {{ $ctapagar->nr_parcela }}</li>
                <li class="list-group-item"><b>Vencimento:</b> {{ empty($ctapagar->dt_vencimento) ? '' : $ctapagar->dt_vencimento->format("d/m/Y") }}</li>                
                <li class="list-group-item"><b>$ Valor:</b> {{ number_format($ctapagar->vl_apagar,2, '.', '') }}</li>
                <li class="list-group-item"><b>Tipo de Pagamento:</b> {{ $ctapagar->nm_tppagamento }}</li>
                <li class="list-group-item"><b>$ Pago:</b> {{ number_format($ctapagar->vl_pago,2, '.', '') }}</li>
                <li class="list-group-item"><b>Pagamento:</b> {{ empty($ctapagar->dt_pagamento) ? '' : $ctapagar->dt_pagamento->format("d/m/Y") }}</li>
                <li class="list-group-item"><b>$ Juros:</b> {{ number_format($ctapagar->vl_juros,2, '.', '') }}</li>
                <li class="list-group-item"><b>$ Multa:</b> {{ number_format($ctapagar->vl_multa,2, '.', '') }}</li>
                <li class="list-group-item"><b>Banco:</b> {{ $ctapagar->nm_banco }}</li>
                <li class="list-group-item"><b>Plano de Contas:</b> {{ $ctapagar->nm_planoconta }}</li>
                <li class="list-group-item"><b>Agencia:</b> {{ $ctapagar->cd_agencia }}</li>
                <li class="list-group-item"><b>Conta:</b> {{ $ctapagar->nr_conta }}</li>
                <li class="list-group-item"><b>Cheque:</b> {{ $ctapagar->nr_cheque }}</li>
                <li class="list-group-item"><b>Histório:</b> {{ $ctapagar->ds_historico }}</li>                                               
                <li class="list-group-item"><b>Observação:</b> {{ $ctapagar->nm_obs }}</li>
            </ul>
        </div>
        <hr>
        <a href="{{ url()->previous() }}" class="btn btn-primary">Voltar</a>
    </div>
</div>
@endsection

@section('js')
@stop

