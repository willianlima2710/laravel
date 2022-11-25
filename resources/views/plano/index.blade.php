@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h3>Listagem - Planos</h3>
        </div>
        <div class="pull-right">            
            <a class="btn btn-success" style="margin: 10px;" href="{{ route('plano.create') }}"><i class='fa fa-plus'></i> Novo</a>
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
        @include("forms.search",["rota" => "plano"])
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-condensed table-hover" id="dest">
            <thead>
            <tr>
                <th width="115px">Código</th>
                <th width="250px">Nome</th>
                <th width="100px">$ Cobertura</th>
                <th width="150px">KM Incluido</th>
                <th width="85px">$ Valor</th>
                <th width="110px">Observação</th>
                <th width="150px"><i class="fa fa-cogs"></i></th>                   
            </tr>     
            </thead>       
            <tbody>                
            @foreach ($planos as $plano)
            <tr>
                <td>{{ $plano->id_plano }}</td>
                <td>{{ $plano->nm_plano }}</td>
                <td>{{ number_format($plano->vl_cobertura, 2, '.', '') }}</td>
                <td>{{ $plano->vl_kmincluido }}</td>                    
                <td>{{ number_format($plano->vl_plano, 2, '.', '') }}</td>
                <td>{{ $plano->nm_obs }}</td>
                <td>                 
                    <a class="btn btn-sm btn-info" href="{{ route('plano.show',$plano->id_plano) }}"><i class='fa fa-eye'></i></a>                        
                    <a class="btn btn-sm btn-primary" href="{{ route('plano.edit',$plano->id_plano) }}"><i class='fa fa-edit'></i></a>                                                       
                    <a class="btn btn-sm btn-danger" href="" data-target="#modal-delete-{{$plano->id_plano}}" data-toggle="modal"><i class='fa fa-trash'></i></a>
                </td>    
            </tr>
            @include('forms.modal',['action'=>'PlanoController@destroy','id'=>$plano->id_plano])  
            @endforeach
        </tbody>
        </table>
    </div>      
    <div class="box-footer clearfix"> 
        <ul class="pagination pagination-sm no-margin pull-left">{{$planos->appends(['searchText' => $searchText])->links()}}</ul>
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
