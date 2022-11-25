@extends('adminlte::page')

@section('title', 'Médico')

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
        <h3>{{ $medico->nm_medico }} </h3>

        <div class="card">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>CRM:</b> {{ $medico->nr_crm }}</li>
                <li class="list-group-item"><b>Especialidade:</b> {{ $medico->nm_especialidade }}</li>
                <li class="list-group-item"><b>Endereço:</b> {{ $medico->nm_endereco }}</li>                
                <li class="list-group-item"><b>Nº:</b> {{ $medico->nr_numender }}</li>
                <li class="list-group-item"><b>Bairro:</b> {{ $medico->nm_bairro }}</li>
                <li class="list-group-item"><b>Cidade:</b> {{ $medico->nm_cidade }}</li>
                <li class="list-group-item"><b>Cep:</b> {{ $medico->nr_cep }}</li>
                <li class="list-group-item"><b>Estado:</b> {{ $medico->nm_estado }}</li>
                <li class="list-group-item"><b>1º Plano:</b> {{ $medico->nm_plano1 }}</li>
                <li class="list-group-item"><b>2º Plano:</b> {{ $medico->nm_plano2 }}</li>
                <li class="list-group-item"><b>3º Plano:</b> {{ $medico->nm_plano3 }}</li>
                <li class="list-group-item"><b>$ 1º Desconto:</b> {{ number_format($medico->vl_desconto1,2, '.', '') }}</li>
                <li class="list-group-item"><b>$ 2º Desconto:</b> {{ number_format($medico->vl_desconto2,2, '.', '') }}</li>
                <li class="list-group-item"><b>$ 3º Desconto:</b> {{ number_format($medico->vl_desconto3,2, '.', '') }}</li>
                <li class="list-group-item"><b>Profissional:</b> {{ $medico->nm_profissional }}</li>                                               
                <li class="list-group-item"><b>Clinica:</b> {{ $medico->nm_clinica }}</li>
                <li class="list-group-item"><b>$ Particular:</b> {{ number_format($medico->vl_particular,2, '.', '') }}</li>
                <li class="list-group-item"><b>$ Convenio:</b> {{ number_format($medico->vl_convenio,2, '.', '') }}</li>
                <li class="list-group-item"><b>Telefone 1º:</b> {{ $medico->nm_telefone1 }}</li>
                <li class="list-group-item"><b>Telefone 2º:</b> {{ $medico->nm_telefone2 }}</li>
                <li class="list-group-item"><b>Telefone 3º:</b> {{ $medico->nm_telefone3 }}</li>
                <li class="list-group-item"><b>Observação:</b> {{ $medico->nm_obs }}</li>
            </ul>
        </div>
        <hr>
        <a href="{{ url()->previous() }}" class="btn btn-primary">Voltar</a>
    </div>
</div>
@endsection

@section('js')
@stop

