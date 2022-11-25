@extends('adminlte::page')

@section('title', 'Regiões')

@section('content_header')
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h3>Listagem - Regiões</h3>
        </div>
        <div class="pull-right">            
            <a class="btn btn-success" style="margin: 10px;" href="{{ route('regioes.create') }}"><i class='fa fa-plus'></i> Novo</a>
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
        @include("forms.search",["rota" => "regioes"])
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-condensed table-hover" id="dest">
            <thead>
            <tr>
                <th width="115px">Código</th>
                <th width="250px">Nome</th>
                <th width="150px"><i class="fa fa-cogs"></i></th>                   
            </tr>     
            </thead>       
            <tbody>                
            @foreach ($regioes as $regiao)
            <tr>
                <td>{{ $regiao->id_regiao }}</td>
                <td>{{ $regiao->nm_regiao }}</td>
                <td>                 
                    <a class="btn btn-sm btn-info" href="{{ route('regioes.show',$regiao->id_regiao) }}"><i class='fa fa-eye'></i></a>                        
                    <a class="btn btn-sm btn-primary" href="{{ route('regioes.edit',$regiao->id_regiao) }}"><i class='fa fa-edit'></i></a>                                                       
                    <a class="btn btn-sm btn-danger" href="" data-target="#modal-delete-{{$regiao->id_regiao}}" data-toggle="modal"><i class='fa fa-trash'></i></a>
                </td>    
            </tr>
            @include('forms.modal',['action'=>'RegioesController@destroy','id'=>$regiao->id_regiao])  
            @endforeach
        </tbody>
        </table>
    </div>      
    <div class="box-footer clearfix"> 
        <ul class="pagination pagination-sm no-margin pull-left">{{$regioes->appends(['searchText' => $searchText])->links()}}</ul>
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
