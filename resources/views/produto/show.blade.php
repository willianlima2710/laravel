@extends('adminlte::page')

@section('title', 'Produto')

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
        <h3>{{ $produto->nm_produto }} </h3>

        <div class="card">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Código:</b> {{ $produto->id_produto }}</li>
                <li class="list-group-item"><b>Fornecedor:</b> {{ $produto->nm_fornecedor }}</li>
                <li class="list-group-item"><b>$ Compra:</b> {{ number_format($produto->vl_compra,2, '.', '') }}</li>                
                <li class="list-group-item"><b>$ Venda:</b> {{ number_format($produto->vl_venda,2, '.', '') }}</li>
                <li class="list-group-item"><b>Unidade:</b> {{ $produto->cd_unidade }}</li>
                <li class="list-group-item"><b>Estoque:</b> {{ $produto->qt_estoque }}</li>
                <li class="list-group-item"><b>Minino:</b> {{ $produto->qt_minestoque }}</li>
                <li class="list-group-item"><b>Barras:</b> {{ $produto->cd_barra }}</li>
                <li class="list-group-item"><b>Convalecente:</b> {{ $produto->st_convalescente }}</li>
                <li class="list-group-item"><b>Observação:</b> {{ $produto->nm_obs }}</li>
            </ul>
        </div>
        <hr>
        <a href="{{ url()->previous() }}" class="btn btn-primary">Voltar</a>
    </div>
</div>
@endsection

@section('js')
@stop

