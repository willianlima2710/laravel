@extends('adminlte::page')

@section('title', 'Jazigo')

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
        <h3>{{ $jazigo->nm_jazigo }} </h3>

        <div class="card">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Id:</b> {{ $jazigo->id_jazigo }}</li>
                <li class="list-group-item"><b>Código:</b> {{ $jazigo->cd_jazigo }}</li>
                <li class="list-group-item"><b>Quadra:</b> {{ $jazigo->cd_quadra }}</li>                
                <li class="list-group-item"><b>Rua:</b> {{ $jazigo->cd_rua }}</li>
                <li class="list-group-item"><b>Setor:</b> {{ $jazigo->cd_setor }}</li>
                <li class="list-group-item"><b>Ocupado:</b> {{ $jazigo->st_ocupado }}</li>
                <li class="list-group-item"><b>Ativo:</b> {{ $jazigo->st_ativo }}</li>
                <li class="list-group-item"><b>Granito:</b> {{ $jazigo->st_granito }}</li>
                <li class="list-group-item"><b>Observação:</b> {{ $jazigo->nm_obs }}</li>
            </ul>
        </div>
        <hr>
        <a href="{{ url()->previous() }}" class="btn btn-primary">Voltar</a>
    </div>
</div>
@endsection

@section('js')
@stop

