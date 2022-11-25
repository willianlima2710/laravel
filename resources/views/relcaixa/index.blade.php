@extends('adminlte::page')

@section('title', 'Relatorio de fluxo de caixa')

@section('content_header')
@stop

@section('content')
<div class="box box-danger">
    <div class="box-header">
        <h3 class="box-title">Relatório - Fluxo de Caixa</h3>
    </div>
    <form method="post" action="{{action('RelcaixaController@impcaixa')}}">  
    {{csrf_field()}}
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="form-group col-sm-2 mb-3">
                <label class="control-label">Data inicial:</label>
                <input type="text" class="form-control" name="dt_inicial" value="{{$dt_inicial}}" onkeypress="$(this).mask('00/00/0000')" autocomplete="off" required>
            </div>       
            <div class="form-group col-sm-2 mb-3">
                <label class="control-label">Data final:</label>
                <input type="text" class="form-control" name="dt_final" value="{{$dt_final}}" onkeypress="$(this).mask('00/00/0000')" autocomplete="off" required>
            </div>
            <div class="form-group col-sm-2 mb-1">
                <label class="control-label">Tipo</label>
                <select class="form-control" name="tp_relatorio" required>
                    <option value="0">Analítico</option>
                    <option value="1">Sintético</option>
                    <option value="2">Por conta</option>
                </select>
            </div>   
        </div>    
    </div>
    <div class="box-footer">        
        <div class="pull-right">                            
            <button class="btn btn-primary" type="submit" formtarget="_blank"><i class='fa fa-print'></i> Imprimir</button>
        </div>       
    </div> 
    </form>   
</div> 
@stop

@section('js')
<script> 

$(function(){
});
</script>
@stop
