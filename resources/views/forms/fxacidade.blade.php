@extends('adminlte::page')

@section('title', 'Faixa de Acréscimo')

@section('content_header')
@stop

@section('content')    

<!-- general form elements -->    
<div class='box box-primary box-solid'> 
    <div class='box-header with-border'>            
        <h3 class="box-title">Faixa de Acréscimo</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <form method="post" action="{{ $action ?? url('fxacidade') }}">    
    {{csrf_field()}}
    @isset($fxacidade) {{method_field('patch')}} @endisset

        <!-- /.box-header -->
        <div class="box-body">   
            <fieldset class="form-group">
                <input type="hidden" value="{{$fxacidade->id_fxacidade ?? ''}}" name="id_fxacidade" class="form-control">
                <div class="row">
                    <div class="form-group col-sm-6 mb-1">
                        <label for="nm_fxacidade" class="control-label">Nome</label>
                        <input type="text" class="form-control" value="{{$fxacidade->nm_fxacidade ?? ''}}" name="nm_fxacidade" maxlength="100" autocomplete="off" required>                    
                    </div>             
                    <div class="form-group col-sm-2 mb-1">
                        <label for="nr_idadeinicial" class="control-label">Idade inicial</label>
                        <input type="text" class="form-control" value="{{$fxacidade->nr_idadeinicial ?? ''}}" name="nr_idadeinicial" maxlength="6" autocomplete="off" required>                    
                    </div>             
                    <div class="form-group col-sm-2 mb-1">
                        <label for="nr_idadefinal" class="control-label">Idade final</label>
                        <input type="text" class="form-control" value="{{$fxacidade->nr_idadefinal ?? ''}}" name="nr_idadefinal" maxlength="6" autocomplete="off" required>                    
                    </div>             
                    <div class="form-group col-sm-2 mb-1">
                        <label for="vl_acrescentar" class="control-label">$ Valor</label>
                        <input type="text" class="form-control" value="{{$fxacidade->vl_acrescentar ?? ''}}" name="vl_acrescentar" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off">                  
                    </div> 
                </div>    
            </fieldset>                                    
        </div>   
        <!-- /.box-body --> 
        <div class="box-footer">        
            <div class="pull-right">
                <button class="btn btn-primary" type="submit">Salvar</button>
                <a class="btn btn-danger" href="{{ url()->previous()  }}">Cancelar</a>
            </div>       
        </div>    
    </form>
</div>         
            
@stop

@section('css')
@stop

@section('js')

@stop