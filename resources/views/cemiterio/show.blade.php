@extends('adminlte::page')

@section('title', 'Cemitérios')

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
        <h3>{{ $cemiterio->nm_cemiterio }} </h3>
        <div class="card">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Endereço:</b> {{ $cemiterio->nm_endereco }}</li>
                <li class="list-group-item"><b>Nº:</b> {{ $cemiterio->nr_numender }}</li>
                <li class="list-group-item"><b>Bairro:</b> {{ $cemiterio->nm_bairro }}</li>                
                <li class="list-group-item"><b>Cidade:</b> {{ $cemiterio->nm_cidade }}</li>
                <li class="list-group-item"><b>Estado:</b> {{ $cemiterio->nm_estado }}</li>
                <li class="list-group-item"><b>Código:</b> {{ $cemiterio->id_cemiterio }}</li>
            </ul>
        </div>
        <hr>
        <a href="{{ url()->previous() }}" class="btn btn-primary">Voltar</a>
    </div>
</div>
@endsection

@section('js')
@stop

