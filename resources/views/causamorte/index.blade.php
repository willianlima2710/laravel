@extends('adminlte::page')

@section('title', 'Causas de Morte')

@section('content_header')
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h3>Listagem - Causas de Morte</h3>
        </div>
        <div class="pull-right">            
            <a class="btn btn-success" style="margin: 10px;" href="{{ route('causamorte.create') }}"><i class='fa fa-plus'></i> Novo</a>
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
        @include("forms.search",["rota" => "causamorte"])
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-condensed table-hover" id="dest">
            <thead>
            <tr>
                <th width="115px">Código</th>
                <th width="300px">Nome</th>
                <th width="150px"><i class="fa fa-cogs"></i></th>                   
            </tr>     
            </thead>       
            <tbody>                
            @foreach ($causamortes as $causamorte)
            <tr>
                <td>{{ $causamorte->id_causamorte }}</td>
                <td>{{ $causamorte->nm_causamorte }}</td>
                <td>                 
                    <a class="btn btn-sm btn-info" href="{{ route('causamorte.show',$causamorte->id_causamorte) }}"><i class='fa fa-eye'></i></a>                        
                    <a class="btn btn-sm btn-primary" href="{{ route('causamorte.edit',$causamorte->id_causamorte) }}"><i class='fa fa-edit'></i></a>                                                       
                    <a class="btn btn-sm btn-danger" href="" data-target="#modal-delete-{{$causamorte->id_causamorte}}" data-toggle="modal"><i class='fa fa-trash'></i></a>
                </td>    
            </tr>
            @include('forms.modal',['action'=>'CausamorteController@destroy','id'=>$causamorte->id_causamorte])  
            @endforeach
        </tbody>
        </table>
    </div>      
    <div class="box-footer clearfix"> 
        <ul class="pagination pagination-sm no-margin pull-left">{{$causamortes->appends(['searchText' => $searchText])->links()}}</ul>
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
