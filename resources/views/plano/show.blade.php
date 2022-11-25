@extends('adminlte::page')

@section('title', 'Plano')

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
        <h3>{{ $plano->nm_plano }} </h3>

        <div class="card">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Código:</b> {{ $plano->id_plano }}</li>
                <li class="list-group-item"><b>$ Cobertura:</b> {{ number_format($plano->vl_cobertura,2, '.', '') }}</li>
                <li class="list-group-item"><b>KM Incluido:</b> {{ $plano->vl_kmincluido }}</li>                
                <li class="list-group-item"><b>$ Valor:</b> {{ number_format($plano->vl_plano,2, '.', '') }}</li>
                <li class="list-group-item"><b>% Salario:</b> {{ $plano->vl_salminino }}</li>
                <li class="list-group-item"><b>$ Juros:</b> {{ number_format($plano->vl_jurosdia,2, '.', '') }}</li>
                <li class="list-group-item"><b>$ Multa:</b> {{ number_format($plano->vl_multa,2, '.', '') }}</li>
                <li class="list-group-item"><b>$ Adesão:</b> {{ number_format($plano->vl_adesao,2, '.', '') }}</li>
                <li class="list-group-item"><b>Observação:</b> {{ $plano->nm_obs }}</li>
            </ul>
        </div>
        <hr>
        <a href="{{ url()->previous() }}" class="btn btn-primary">Voltar</a>
    </div>
</div>
@endsection

@section('js')
@stop

