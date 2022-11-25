@extends('adminlte::page')

@section('title', 'Jazigo')

@section('content_header')
@stop

@section('content')    

<!-- general form elements -->    
<div class='box box-primary box-solid'> 
    <div class='box-header with-border'>            
        <h3 class="box-title">Jazigo</h3>
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

    <form method="post" action="{{ $action ?? url('jazigo') }}">    
    {{csrf_field()}}
    @isset($jazigo) {{method_field('patch')}} @endisset

        <!-- /.box-header -->
        <div class="box-body">   
            <fieldset class="form-group">
                <input type="hidden" value="{{$jazigo->id_jazigo ?? ''}}" name="id_jazigo" class="form-control">
                <div class="row">
                    <div class="form-group col-sm-4 mb-3">
                        <label for="cd_jazigo" class="control-label">Código</label>
                        <input type="text" class="form-control" value="{{$jazigo->cd_jazigo ?? ''}}" name="cd_jazigo" maxlength="10" autocomplete="off" required>
                    </div>             
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_jazigo" class="control-label">Nome</label>
                        <input type="text" class="form-control" value="{{$jazigo->nm_jazigo ?? ''}}" name="nm_jazigo" maxlength="100" autocomplete="off" required>                    
                    </div>               
                    <div class="form-group col-sm-2 mb-3">
                        <label for="cd_quadra" class="control-label">Quadra</label>
                        <input type="text" class="form-control" value="{{$jazigo->cd_quadra ?? ''}}" name="cd_quadra" autocomplete="off" maxlength="10">                    
                    </div>                        
                    <div class="form-group col-sm-2 mb-3">
                        <label for="cd_rua" class="control-label">Rua</label>
                        <input type="text" class="form-control" value="{{$jazigo->cd_rua ?? ''}}" name="cd_rua" maxlength="10" autocomplete="off">     
                    </div>    
                </div>    
                <div class="row">
                    <div class="form-group col-sm-4 mb-3">
                        <label for="cd_setor" class="control-label">Setor</label>
                        <input type="text" class="form-control" value="{{$jazigo->cd_setor ?? ''}}" name="cd_setor" maxlength="10" autocomplete="off">     
                    </div>
                    <div class="form-group col-sm-2 mb-3">                                    
                        <label for="st_ocupado" class="control-label">Ocupado ?</label>
                        @if (isset($jazigo))                        
                            @if($jazigo->st_ocupado===1)
                                <input type="checkbox" class="checkbox" value="{{$jazigo->st_ocupado ?? ''}}" checked name='st_ocupado' >
                            @else 
                                <input type="checkbox" class="checkbox" value="{{$jazigo->st_ocupado ?? ''}}" name='st_ocupado'>
                            @endif 
                        @else
                            <input type="checkbox" class="checkbox" value="{{$jazigo->st_ocupado ?? ''}}" name='st_ocupado'>
                        @endif                                
                    </div>  
                    <div class="form-group col-sm-2 mb-3">                                    
                        <label for="st_ativo" class="control-label">Ativo ?</label>
                        @if (isset($jazigo))                        
                            @if($jazigo->st_ativo===1)
                                <input type="checkbox" class="checkbox" value="{{$jazigo->st_ativo ?? ''}}" checked name='st_ativo' >
                            @else 
                                <input type="checkbox" class="checkbox" value="{{$jazigo->st_ativo ?? ''}}" name='st_ativo'>
                            @endif 
                        @else
                            <input type="checkbox" class="checkbox" value="{{$jazigo->st_ativo ?? ''}}" name='st_ativo'>
                        @endif                                
                    </div>  
                    <div class="form-group col-sm-4 mb-1">
                        <label for="st_granito" class="control-label">Granito</label>
                        <select class="form-control" name="st_granito" required>
                            <option value=""></option>
                            @foreach($granitos as $granito)
                                @if (isset($jazigo))
                                    @if($granito['st_granito']==$jazigo->st_granito)
                                    <option value="{{$granito['st_granito']}}" selected>
                                    {{$granito['nm_granito']}}
                                    </option>
                                    @else
                                    <option value="{{$granito['st_granito']}}">
                                    {{$granito['nm_granito']}}
                                    </option>
                                    @endif	         
                                @else                                    
                                    <option value="{{$granito['st_granito']}}">
                                    {{$granito['nm_granito']}}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>  
                </div>    
            </fieldset>    
            <!-- Dados complementares -->
            <fieldset class="form-group">
            <legend class="label label-success"><span><h4>Dados Complementares</h4></span></legend>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="nm_obs" class="control-label">Observação</label>
                        <textarea class="form-control" name="nm_obs" rows="5">{{$jazigo->nm_obs ?? ''}}</textarea>
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