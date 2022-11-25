@extends('adminlte::page')

@section('title', 'Custo Fixo')

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
        <h3>{{ $custo->nm_custo }} </h3>

        <div class="card">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Código:</b> {{ $custo->id_custo }}</li>
                <li class="list-group-item"><b>$ Valor:</b> {{ number_format($custo->vl_custo,2, '.', '') }}</li>
                <li class="list-group-item"><b>Dia:</b> {{ $custo->nr_dia }}</li>
                <li class="list-group-item"><b>Periodo:</b> {{ $custo->st_periodo }}</li>
                <li class="list-group-item"><b>Observação:</b> {{ $custo->nm_obs }}</li>
            </ul>
        </div>
        <hr>
        <a href="{{ url()->previous() }}" class="btn btn-primary">Voltar</a>
    </div>
</div>
@endsection

@section('js')
@stop

