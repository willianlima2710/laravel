@extends('adminlte::page')

@section('title', 'Veículos')

@section('content_header')
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h3>Listagem - Veículos</h3>
        </div>
        <div class="pull-right">            
            <a class="btn btn-success" style="margin: 10px;" href="{{ route('veiculo.create') }}"><i class='fa fa-plus'></i> Novo</a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif
<div class="box">
    <div class="box-header with-border">
        @include("forms.search",["rota" => "veiculo"])
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-condensed table-hover" id="dest">
            <thead>
            <tr>
                <th width="115px">Código</th>
                <th width="250px">Nome</th>
                <th width="100px">Placa</th>
                <th width="150px">Marca</th>
                <th width="85px">Cor</th>
                <th width="150px"><i class="fa fa-cogs"></i></th>                   
            </tr>     
            </thead>       
            <tbody>                
            @foreach ($veiculos as $veiculo)            
            <tr>
                <td>{{ $veiculo->id_veiculo }}</td>
                <td>{{ $veiculo->nm_veiculo }}</td>
                <td>{{ $veiculo->nr_placa }}</td>
                <td>{{ $veiculo->nm_marca }}</td>                    
                <td>{{ $veiculo->nm_cor }}</td>                    
                <td>                 
                    <a class="btn btn-sm btn-info" href="{{ route('veiculo.show',$veiculo->id_veiculo) }}"><i class='fa fa-eye'></i></a>                        
                    <a class="btn btn-sm btn-primary" href="{{ route('veiculo.edit',$veiculo->id_veiculo) }}"><i class='fa fa-edit'></i></a>                                                       
                    <a class="btn btn-sm btn-danger" href="" data-target="#modal-delete-{{$veiculo->id_veiculo}}" data-toggle="modal"><i class='fa fa-trash'></i></a>
                </td>    
            </tr>
            @include('forms.modal',['action'=>'VeiculoController@destroy','id'=>$veiculo->id_veiculo])  
            @endforeach
        </tbody>
        </table>
    </div>      
    <div class="box-footer clearfix"> 
        <ul class="pagination pagination-sm no-margin pull-left">{{$veiculos->appends(['searchText' => $searchText])->links()}}</ul>
    </div>                  
</div> 
@stop

@section('js')
<script> 

$(function(){
    $("#dest").addSortWidget();
});
</script>
@stop
