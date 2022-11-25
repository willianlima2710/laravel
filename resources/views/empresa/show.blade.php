@extends('adminlte::page')

@section('title', 'Empresa')

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
        <h3>{{ $empresa->nm_pessoa }} </h3>

        <div class="card">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Código:</b> {{ $empresa->id_pessoa }}</li>
                <li class="list-group-item"><b>CNPJ:</b> {{ $empresa->nr_cpfcnpj }}</li>
                <li class="list-group-item"><b>Insc. Estadual:</b> {{ $empresa->nr_rgie }}</li>                
                <li class="list-group-item"><b>1º Telefone:</b> {{ $empresa->nr_telefone1 }}</li>
                <li class="list-group-item"><b>CEP:</b> {{ $empresa->nr_cep }}</li>
                <li class="list-group-item"><b>Endereço:</b> {{ $empresa->nm_endereco }}</li>
                <li class="list-group-item"><b>Numero:</b> {{ $empresa->nr_numender }}</li>
                <li class="list-group-item"><b>Complemento:</b> {{ $empresa->nm_complender }}</li>
                <li class="list-group-item"><b>Bairro:</b> {{ $empresa->nm_bairro }}</li>
                <li class="list-group-item"><b>Cidade:</b> {{ $empresa->nm_cidade }}</li>
                <li class="list-group-item"><b>Estado:</b> {{ $empresa->nm_estado }}</li>
                <li class="list-group-item"><b>2º Telefone:</b> {{ $empresa->nm_telefone2 }}</li>
                <li class="list-group-item"><b>3º Telefone:</b> {{ $empresa->nm_telefone3 }}</li>
                <li class="list-group-item"><b>4º Telefone:</b> {{ $empresa->nm_telefone4 }}</li>
                <li class="list-group-item"><b>E-Mail:</b> {{ $empresa->nm_email }}</li>                                               
                <li class="list-group-item"><b>Site:</b> {{ $empresa->nm_site }}</li>
                <li class="list-group-item"><b>Observações:</b> {{ $empresa->nm_obs }}</li>
            </ul>
        </div>
        <hr>
        <a href="{{ url()->previous() }}" class="btn btn-primary">Voltar</a>
    </div>
</div>
@endsection

@section('js')
@stop

