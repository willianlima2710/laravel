@extends('adminlte::page')

@section('title', 'Contas Bancárias')

@section('content_header')
@stop

@section('content')    

<!-- general form elements -->    
<div class='box box-primary box-solid'> 
    <div class='box-header with-border'>            
        <h3 class="box-title">Contas Bancárias</h3>
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

    <form method="post" action="{{ $action ?? url('banco') }}">    
    {{csrf_field()}}
    @isset($banco) {{method_field('patch')}} @endisset

        <!-- /.box-header -->
        <div class="box-body">   
            <fieldset class="form-group">
                <input type="hidden" value="{{$banco->id_banco ?? ''}}" name="id_banco" class="form-control">
                <div class="row">
                    <div class="form-group col-sm-12 mb-1">
                        <label for="nm_banco" class="control-label">Nome</label>
                        <input type="text" class="form-control" value="{{$banco->nm_banco ?? ''}}" name="nm_banco" maxlength="100" autocomplete="off" required>                    
                    </div>                                 
                </div>    
                <div class="row">
                    <div class="form-group col-sm-4 mb-1">
                        <label for="cd_banco" class="control-label">Código</label>
                        <input type="text" class="form-control" value="{{$banco->cd_banco ?? ''}}" name="cd_banco" maxlength="4" onkeypress="$(this).mask('9999')" autocomplete="off">                    
                    </div>                                 
                    <div class="form-group col-sm-4 mb-1">
                        <label for="nr_agencia" class="control-label">Agencia</label>
                        <input type="text" class="form-control" value="{{$banco->nr_agencia ?? ''}}" name="nr_agencia" maxlength="4" onkeypress="$(this).mask('9999')" autocomplete="off">                    
                    </div>                                 
                    <div class="form-group col-sm-4 mb-1">
                        <label for="nr_conta" class="control-label">Conta</label>
                        <input type="text" class="form-control" value="{{$banco->nr_conta ?? ''}}" name="nr_conta" maxlength="20" autocomplete="off">                    
                    </div>                                 
                </div>    
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="nm_obs" class="control-label">Observação</label>
                        <textarea class="form-control" rows="5" name='nm_obs'>{{$banco->nm_obs ?? ''}}</textarea>
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