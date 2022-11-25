@extends('adminlte::page')

@section('title', 'Custos Fixos')

@section('content_header')
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h3>Listagem - Custos Fixos</h3>
        </div>
        <div class="pull-right">            
            <a class="btn btn-success" style="margin: 10px;" href="{{ route('custo.create') }}"><i class='fa fa-plus'></i> Novo</a>
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
        @include("forms.search",["rota" => "custo"])
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-condensed table-hover" id="dest">
            <thead>
            <tr>
                <th width="115px">Código</th>
                <th width="250px">Nome</th>
                <th width="100px">$ Valor</th>
                <th width="150px">Dia</th>
                <th width="85px">Periodo</th>
                <th width="110px">Observação</th>
                <th width="150px"><i class="fa fa-cogs"></i></th>                   
            </tr>     
            </thead>       
            <tbody>                
            @foreach ($custos as $custo)            
            @php                
                if ($custo->st_periodo === '0') {
                    $rowclass = 'label label-warning';
                    $status = 'Mensal';
                }elseif ($custo->st_periodo === '1'){
                    $rowclass = 'label label-primary';
                    $status = 'Trimestral';
                }elseif ($custo->st_periodo === '2'){
                    $rowclass = 'label label-success';
                    $status = 'Semestral';
                }elseif ($custo->st_periodo === '3'){
                    $rowclass = 'label label-info';
                    $status = 'Anual';
                }                    
            @endphp                 
            <tr>
                <td>{{ $custo->id_custo }}</td>
                <td>{{ $custo->nm_custo }}</td>
                <td>{{ number_format($custo->vl_custo, 2, '.', '') }}</td>
                <td>{{ $custo->nr_dia }}</td>                    
                <td><span class="{{$rowclass}}">&nbsp;{{$status}}&nbsp;</span></td>
                <td>{{ $custo->nm_obs }}</td>
                <td>                 
                    <a class="btn btn-sm btn-info" href="{{ route('custo.show',$custo->id_custo) }}"><i class='fa fa-eye'></i></a>                        
                    <a class="btn btn-sm btn-primary" href="{{ route('custo.edit',$custo->id_custo) }}"><i class='fa fa-edit'></i></a>                                                       
                    <a class="btn btn-sm btn-danger" href="" data-target="#modal-delete-{{$custo->id_custo}}" data-toggle="modal"><i class='fa fa-trash'></i></a>
                </td>    
            </tr>
            @include('forms.modal',['action'=>'CustoController@destroy','id'=>$custo->id_custo])  
            @endforeach
        </tbody>
        </table>
    </div>      
    <div class="box-footer clearfix"> 
        <ul class="pagination pagination-sm no-margin pull-left">{{$custos->appends(['searchText' => $searchText])->links()}}</ul>
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
