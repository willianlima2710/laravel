@extends('adminlte::page')

@section('title', 'Veículo')

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
        <h3>{{ $veiculo->nm_fornecedor }} </h3>

        <div class="card">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Código:</b> {{ $veiculo->id_veiculo }}</li>
                <li class="list-group-item"><b>Placa:</b> {{ $veiculo->nr_placa }}</li>
                <li class="list-group-item"><b>Marca:</b> {{ $veiculo->nm_marca }}</li>                
                <li class="list-group-item"><b>Cor:</b> {{ $veiculo->nm_cor }}</li>
                <li class="list-group-item"><b>Ano:</b> {{ $veiculo->nr_ano }}</li>
                <li class="list-group-item"><b>Seguradora:</b> {{ $veiculo->nm_seguradora }}</li>
                <li class="list-group-item"><b>Data da Vigencia:</b> {{ empty($veiculo->dt_vigencia) ? '' : $veiculo->dt_vigencia->format('d/m/Y') ?? '' }}</li>
                <li class="list-group-item"><b>Condutor:</b> {{ $veiculo->nm_condutor }}</li>
                <li class="list-group-item"><b>Ult. Manutenção:</b> {{ empty($veiculo->dt_manutencao) ? '' : $veiculo->dt_manutencao->format('d/m/Y') ?? '' }}</li>
            </ul>
        </div>
        <hr>
        <a href="{{ url()->previous() }}" class="btn btn-primary">Voltar</a>
    </div>
</div>
@endsection

@section('js')
@stop

