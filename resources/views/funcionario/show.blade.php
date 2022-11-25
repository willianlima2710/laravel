@extends('adminlte::page')

@section('title', 'Funcionário')

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
        <h3>{{ $funcionario->nm_pessoa }} </h3>

        <div class="card">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Código:</b> {{ $funcionario->id_pessoa }}</li>
                <li class="list-group-item"><b>CPF:</b> {{ $funcionario->nr_cpfcnpj }}</li>
                <li class="list-group-item"><b>RG:</b> {{ $funcionario->nr_rgie }}</li>                
                <li class="list-group-item"><b>1º Telefone:</b> {{ $funcionario->nr_telefone1 }}</li>
                <li class="list-group-item"><b>Cep:</b> {{ $funcionario->nr_cep }}</li>
                <li class="list-group-item"><b>Endereço:</b> {{ $funcionario->nm_endereco }}</li>
                <li class="list-group-item"><b>Nº:</b> {{ $funcionario->nr_numender }}</li>
                <li class="list-group-item"><b>Complemento:</b> {{ $funcionario->nm_complender }}</li>
                <li class="list-group-item"><b>Bairro:</b> {{ $funcionario->nm_bairro }}</li>
                <li class="list-group-item"><b>Cidade:</b> {{ $funcionario->nm_cidade }}</li>
                <li class="list-group-item"><b>Estado:</b> {{ $funcionario->nm_estado }}</li>
                <li class="list-group-item"><b>2º Telefone:</b> {{ $funcionario->nm_telefone2 }}</li>
                <li class="list-group-item"><b>3º Telefone:</b> {{ $funcionario->nm_telefone3 }}</li>
                <li class="list-group-item"><b>4º Telefone:</b> {{ $funcionario->nm_telefone4 }}</li>
                <li class="list-group-item"><b>E-Mail:</b> {{ $funcionario->nm_email }}</li>                                               
                <li class="list-group-item"><b>Função:</b> {{ $funcionario->nm_funcao }}</li>
                <li class="list-group-item"><b>% Comissão na Venda:</b> {{ $funcionario->vl_comprod }}</li>
                <li class="list-group-item"><b>% Comissão no Serviço:</b> {{ $funcionario->vl_comserv }}</li>
                <li class="list-group-item"><b>Comissão na Cobrança?:</b> {{ $funcionario->st_comcob }}</li>
                <li class="list-group-item"><b>Valor Salário:</b> {{ number_format($funcionario->vl_salario,2, '.', '') }}</li>
                <li class="list-group-item"><b>Admissão:</b> {{ empty($funcionario->dt_admissao) ? '' : $funcionario->dt_admissao->format("d/m/Y") }}</li>
                <li class="list-group-item"><b>Demissão:</b> {{ empty($funcionario->dt_demissao) ? '' : $funcionario->dt_demissao->format("d/m/Y") }}</li>
                <li class="list-group-item"><b>Nº Pis:</b> {{ $funcionario->nr_pis }}</li>
                <li class="list-group-item"><b>Nº CTPS:</b> {{ $funcionario->nr_ctps }}</li>
            </ul>
        </div>
        <hr>
        <a href="{{ url()->previous() }}" class="btn btn-primary">Voltar</a>
    </div>
</div>
@endsection

@section('js')
@stop

