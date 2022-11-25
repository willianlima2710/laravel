@extends('adminlte::page')

@section('title', 'Fornecedor')

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
        <h3>{{ $fornecedor->nm_fornecedor }} </h3>

        <div class="card">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>CNPJ/CPF:</b> {{ $fornecedor->nr_cpfcnpj }}</li>
                <li class="list-group-item"><b>IE/RG:</b> {{ $fornecedor->nr_rgie }}</li>
                <li class="list-group-item"><b>1º Telefone:</b> {{ $fornecedor->nr_telefone1 }}</li>                
                <li class="list-group-item"><b>2º Telefone:</b> {{ $fornecedor->nr_telefone2 }}</li>
                <li class="list-group-item"><b>3º Telefone:</b> {{ $fornecedor->nr_telefone3 }}</li>
                <li class="list-group-item"><b>4º Telefone:</b> {{ $fornecedor->nr_telefone4 }}</li>
                <li class="list-group-item"><b>CEP:</b> {{ $fornecedor->nr_cep }}</li>
                <li class="list-group-item"><b>Endereço:</b> {{ $fornecedor->nm_endereco }}</li>
                <li class="list-group-item"><b>Numero:</b> {{ $fornecedor->nr_numender }}</li>
                <li class="list-group-item"><b>Complemento:</b> {{ $fornecedor->nm_complender }}</li>
                <li class="list-group-item"><b>Bairro:</b> {{ $fornecedor->nm_bairro }}</li>
                <li class="list-group-item"><b>Cidade:</b> {{ $fornecedor->nm_cidade }}</li>
                <li class="list-group-item"><b>Estado:</b> {{ $fornecedor->nm_estado }}</li>
                <li class="list-group-item"><b>Contato:</b> {{ $fornecedor->nm_contato }}</li>
                <li class="list-group-item"><b>E-Mail:</b> {{ $fornecedor->nm_email }}</li>                                               
                <li class="list-group-item"><b>Site:</b> {{ $fornecedor->nm_site }}</li>                                               
                <li class="list-group-item"><b>Observação:</b> {{ $fornecedor->nm_obs }}</li>
            </ul>
        </div>
        <hr>
        <a href="{{ url()->previous() }}" class="btn btn-primary">Voltar</a>
    </div>
</div>
@endsection

@section('js')
@stop

