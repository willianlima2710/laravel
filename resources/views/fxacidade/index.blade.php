@extends('adminlte::page')

@section('title', 'Faixa de Acréscimo')

@section('content_header')
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h3>Listagem - Faixa de Acréscimo</h3>
        </div>
        <div class="pull-right">            
            <a class="btn btn-success" style="margin: 10px;" href="{{ route('fxacidade.create') }}"><i class='fa fa-plus'></i> Novo</a>
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
        @include("forms.search",["rota" => "fxacidade"])
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-condensed table-hover" id="dest">
            <thead>
            <tr>
                <th width="115px">Código</th>
                <th width="250px">Nome</th>
                <th width="100px">Idade Inicial</th>
                <th width="150px">Idade Final</th>
                <th width="85px">$ Valor</th>
                <th width="150px"><i class="fa fa-cogs"></i></th>                   
            </tr>     
            </thead>       
            <tbody>                
            @foreach ($fxacidades as $fxacidade)
           
            <tr>
                <td>{{ $fxacidade->id_fxacidade }}</td>
                <td>{{ $fxacidade->nm_fxacidade }}</td>
                <td>{{ $fxacidade->nr_idadeinicial }}</td>
                <td>{{ $fxacidade->nr_idadefinal }}</td>                    
                <td>{{ number_format($fxacidade->vl_acrescentar, 2, '.', '') }}</td>
                <td>                 
                    <a class="btn btn-sm btn-info" href="{{ route('fxacidade.show',$fxacidade->id_fxacidade) }}"><i class='fa fa-eye'></i></a>                        
                    <a class="btn btn-sm btn-primary" href="{{ route('fxacidade.edit',$fxacidade->id_fxacidade) }}"><i class='fa fa-edit'></i></a>                                                       
                    <a class="btn btn-sm btn-danger" href="" data-target="#modal-delete-{{$fxacidade->id_fxacidade}}" data-toggle="modal"><i class='fa fa-trash'></i></a>
                </td>    
            </tr>
            @include('forms.modal',['action'=>'FxacidadeController@destroy','id'=>$fxacidade->id_fxacidade])  
            @endforeach
        </tbody>
        </table>
    </div>      
    <div class="box-footer clearfix"> 
        <ul class="pagination pagination-sm no-margin pull-left">{{$fxacidades->appends(['searchText' => $searchText])->links()}}</ul>
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
