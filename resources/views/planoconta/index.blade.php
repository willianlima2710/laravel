@extends('adminlte::page')

@section('title', 'Plano de Contas')

@section('content_header')
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h3>Listagem - Plano de Contas</h3>
        </div>
        <div class="pull-right">            
            <a class="btn btn-success" style="margin: 10px;" href="{{ route('planoconta.create') }}"><i class='fa fa-plus'></i> Novo</a>
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
        @include("forms.search",["rota" => "planoconta"])
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-condensed table-hover" id="dest">
            <thead>
            <tr>
                <th width="115px">Código</th>
                <th width="250px">Nome</th>
                <th width="150px">Pai</th>
                <th width="85px">Ordem</th>
                <th width="110px">Reduzido</th>
                <th width="110px">Tipo</th>
                <th width="150px"><i class="fa fa-cogs"></i></th>                   
            </tr>     
            </thead>       
            <tbody>                
            @foreach ($planocontas as $planoconta)   
            @php                
                if ($planoconta->st_tipo === 0) {
                    $rowclass = 'label label-primary';
                    $status = 'Credito';
                }else{
                    $rowclass = 'label label-danger';
                    $status = 'Debito';
                }                    
            @endphp                 
            <tr>
                <td>{{ $planoconta->cd_conta }}</td>
                <td>{{ $planoconta->nm_planoconta }}</td>
                <td>{{ $planoconta->cd_pai }}</td>
                <td>{{ $planoconta->nr_ordem }}</td>                    
                <td>{{ $planoconta->cd_reduzido }}</td>                    
                <td><span class="{{$rowclass}}">&nbsp;{{$status}}&nbsp;</span></td>
                <td>                 
                    <a class="btn btn-sm btn-info" href="{{ route('planoconta.show',$planoconta->id_planoconta) }}"><i class='fa fa-eye'></i></a>                        
                    <a class="btn btn-sm btn-primary" href="{{ route('planoconta.edit',$planoconta->id_planoconta) }}"><i class='fa fa-edit'></i></a>                                                       
                    <a class="btn btn-sm btn-danger" href="" data-target="#modal-delete-{{$planoconta->id_planoconta}}" data-toggle="modal"><i class='fa fa-trash'></i></a>
                </td>    
            </tr>
            @include('forms.modal',['action'=>'PlanocontaController@destroy','id'=>$planoconta->id_planoconta])  
            @endforeach
        </tbody>
        </table>
    </div>      
    <div class="box-footer clearfix"> 
        <ul class="pagination pagination-sm no-margin pull-left">{{$planocontas->appends(['searchText' => $searchText])->links()}}</ul>
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
