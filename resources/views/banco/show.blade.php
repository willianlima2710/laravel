@extends('adminlte::page')

@section('title', 'Contas Bancárias')

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
        <h3>{{ $banco->nm_fornecedor }} </h3>

        <div class="card">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Código:</b> {{ $banco->cd_banco }}</li>
                <li class="list-group-item"><b>Nome:</b> {{ $banco->nm_banco }}</li>
                <li class="list-group-item"><b>Agencia:</b> {{ $banco->nr_agencia }}</li>                
                <li class="list-group-item"><b>Conta:</b> {{ $banco->nr_conta }}</li>
            </ul>
        </div>
        <hr>
        <a href="{{ url()->previous() }}" class="btn btn-primary">Voltar</a>
    </div>
</div>
@endsection

@section('js')
@stop

