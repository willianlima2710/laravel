@extends('adminlte::page')

@section('title', 'Obitos')

@section('content_header')
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h3>Listagem - Obitos</h3>
        </div>
        <div class="pull-right">            
            <a class="btn btn-success" style="margin: 10px;" href="{{ route('obito.create') }}"><i class='fa fa-plus'></i> Novo</a>
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
        @include("forms.search",["rota" => "obito"])
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-condensed table-hover" id="dest">
            <thead>
            <tr>            
                <th width="90px">Nº Obito</th>
                <th width="100px">Atendimento</th>
                <th width="100x">Falecimento</th>
                <th width="250px">Falecido</th>
                <th width="250px">Causa Morte</th>
                <th width="100px">Médico</th>
                <th width="150px"><i class="fa fa-cogs"></i></th>                   
            </tr>     
            </thead>       
            <tbody>                
            @foreach ($obitos as $obito)            
            <tr>
                <td>{{ $obito->nr_declaracao }}</td>
                <td><span style="display: none;">{{ empty($obito->dt_atendimento) ? '' : $obito->dt_atendimento->format("Y-m-d") }}</span>
                    {{ empty($obito->dt_atendimento) ? '' : $obito->dt_atendimento->format("d/m/Y") }}
                </td>                
                <td><span style="display: none;">{{ empty($obito->dt_falecimento) ? '' : $obito->dt_falecimento->format("Y-m-d") }}</span>
                    {{ empty($obito->dt_falecimento) ? '' : $obito->dt_falecimento->format("d/m/Y") }}
                </td>                
                <td>{{ $obito->nm_dependente }}</td>
                <td>{{ $obito->nm_causamorte }}</td>
                <td>{{ $obito->nm_medico }}</td>                    
                <td>                 
                    <a class="btn btn-sm btn-info" href="{{ route('obito.show',$obito->id_obito) }}"><i class='fa fa-eye'></i></a>                        
                    <a class="btn btn-sm btn-primary" href="{{ route('obito.edit',$obito->id_obito) }}"><i class='fa fa-edit'></i></a>                                                       
                    <a class="btn btn-sm btn-danger" href="" data-target="#modal-delete-{{$obito->id_obito}}" data-toggle="modal"><i class='fa fa-trash'></i></a>
                </td>    
            </tr>
            @include('forms.modal',['action'=>'ObitoController@destroy','id'=>$obito->id_obito])  
            @endforeach
        </tbody>
        </table>
    </div>      
    <div class="box-footer clearfix"> 
        <ul class="pagination pagination-sm no-margin pull-left">{{$obitos->appends(['searchText' => $searchText])->links()}}</ul>
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
