@extends('adminlte::page')

@section('title', 'Médicos')

@section('content_header')
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h3>Listagem - Médicos</h3>
        </div>
        <div class="pull-right">            
            <a class="btn btn-success" style="margin: 10px;" href="{{ route('medico.create') }}"><i class='fa fa-plus'></i> Novo</a>
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
        @include("forms.search",["rota" => "medico"])
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-condensed table-hover" id="dest">
            <thead>
            <tr>
                <th width="250px">Nome</th>
                <th width="100px">CRM</th>
                <th width="150px">Especialidade</th>
                <th width="85px">Bairro</th>
                <th width="110px">$ Convenio</th>
                <th width="110px">$ Particular</th>
                <th width="150px"><i class="fa fa-cogs"></i></th>                   
            </tr>     
            </thead>       
            <tbody>                
            @foreach ($medicos as $medico)

            <tr>
                <td>{{ $medico->nm_medico }}</td>
                <td>{{ $medico->nr_crm }}</td>
                <td>{{ $medico->nm_especialidade }}</td>
                <td>{{ $medico->nm_bairro }}</td>                    
                <td>{{ number_format($medico->vl_convenio, 2, '.', '') }}</td>
                <td>{{ number_format($medico->vl_particular, 2, '.', '') }}</td>
                <td>                 
                    <a class="btn btn-sm btn-info" href="{{ route('medico.show',$medico->id_medico) }}"><i class='fa fa-eye'></i></a>                        
                    <a class="btn btn-sm btn-primary" href="{{ route('medico.edit',$medico->id_medico) }}"><i class='fa fa-edit'></i></a>                                                       
                    <a class="btn btn-sm btn-danger" href="" data-target="#modal-delete-{{$medico->id_medico}}" data-toggle="modal"><i class='fa fa-trash'></i></a>
                </td>    
            </tr>
            @include('forms.modal',['action'=>'MedicoController@destroy','id'=>$medico->id_medico])  
            @endforeach
        </tbody>
        </table>
    </div>      
    <div class="box-footer clearfix"> 
        <ul class="pagination pagination-sm no-margin pull-left">{{$medicos->appends(['searchText' => $searchText])->links()}}</ul>
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
