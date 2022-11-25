@extends('adminlte::page')

@section('title', 'Cemitérios')

@section('content_header')
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h3>Listagem - Cemitérios</h3>
        </div>
        <div class="pull-right">            
            <a class="btn btn-success" style="margin: 10px;" href="{{ route('cemiterio.create') }}"><i class='fa fa-plus'></i> Novo</a>
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
        @include("forms.search",["rota" => "cemiterio"])
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-condensed table-hover" id="dest">
            <thead>
            <tr>
                <th width="250px">Nome</th>
                <th width="100px">Endereço</th>
                <th width="90px">Nº</th>
                <th width="100px">Bairro</th>
                <th width="100px">Cidade</th>
                <th width="100px">Estado</th>
                <th width="150px"><i class="fa fa-cogs"></i></th>                   
            </tr>     
            </thead>       
            <tbody>                
            @foreach ($cemiterios as $cemiterio)
            <tr>
                <td>{{ $cemiterio->nm_cemiterio }}</td>
                <td>{{ $cemiterio->nm_endereco }}</td>
                <td>{{ $cemiterio->nr_numender }}</td>
                <td>{{ $cemiterio->nm_bairro }}</td>                    
                <td>{{ $cemiterio->nm_cidade }}</td>                    
                <td>{{ $cemiterio->nm_estado }}</td>                    
                <td>                 
                    <a class="btn btn-sm btn-info" href="{{ route('cemiterio.show',$cemiterio->id_cemiterio) }}"><i class='fa fa-eye'></i></a>                        
                    <a class="btn btn-sm btn-primary" href="{{ route('cemiterio.edit',$cemiterio->id_cemiterio) }}"><i class='fa fa-edit'></i></a>                                                       
                    <a class="btn btn-sm btn-danger" href="" data-target="#modal-delete-{{$cemiterio->id_cemiterio}}" data-toggle="modal"><i class='fa fa-trash'></i></a>
                </td>    
            </tr>
            @include('forms.modal',['action'=>'CemiterioController@destroy','id'=>$cemiterio->id_cemiterio])  
            @endforeach
        </tbody>
        </table>
    </div>      
    <div class="box-footer clearfix"> 
        <ul class="pagination pagination-sm no-margin pull-left">{{$cemiterios->appends(['searchText' => $searchText])->links()}}</ul>
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
