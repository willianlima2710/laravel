@extends('adminlte::page')

@section('title', 'Plano de Conta')

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
        <h3>{{ $planoconta->nm_planoconta }} </h3>

        <div class="card">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Id:</b> {{ $planoconta->id_planoconta }}</li>
                <li class="list-group-item"><b>Código:</b> {{ $planoconta->cd_conta }}</li>
                <li class="list-group-item"><b>Pai:</b> {{ $planoconta->cd_pai }}</li>                
                <li class="list-group-item"><b>Ordem:</b> {{ $planoconta->nr_ordem }}</li>
                <li class="list-group-item"><b>Reduzido:</b> {{ $planoconta->cd_reduzido }}</li>
                <li class="list-group-item"><b>Tipo:</b> {{ $planoconta->st_tipo }}</li>
            </ul>
        </div>
        <hr>
        <a href="{{ url()->previous() }}" class="btn btn-primary">Voltar</a>
    </div>
</div>
@endsection

@section('js')
@stop

