@extends('adminlte::page')

@section('title', 'Produto')

@section('content_header')
@stop

@section('content')    

<!-- general form elements -->    
<div class='box box-primary box-solid'> 
    <div class='box-header with-border'>            
        <h3 class="box-title">Produto</h3>
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

    <form method="post" action="{{ $action ?? url('produto') }}">    
    {{csrf_field()}}
    @isset($produto) {{method_field('patch')}} @endisset

        <!-- /.box-header -->
        <div class="box-body">   
            <fieldset class="form-group">                            
                <input type="hidden" value="{{$produto->produto ?? ''}}" name="produto" class="form-control">
                <div class="row">
                    <div class="form-group col-sm-12 mb-3">
                        <label for="nm_produto" class="control-label">Nome</label>
                        <input type="text" class="form-control" value="{{$produto->nm_produto ?? ''}}" name="nm_produto" maxlength="100" autocomplete="off" required>
                    </div>             
                </div> 
                <div class="row" id='fornecedor'>
                    <div class="form-group col-sm-12 mb-1">
                        <label for="nm_fornecedor" class="control-label">Fornecedor</label>
                        <input type="text" class="form-control" value="{{$produto->nm_fornecedor ?? ''}}" 
                         name="nm_fornecedor" id="nm_fornecedor" autocomplete="off" placeholder="Nome ou CPF/CNPJ" >                                                                             
                    </div>   
                    <input type="hidden" class="form-control" value="{{$produto->id_fornecedor ?? ''}}" name="id_fornecedor" id="id_fornecedor" required>                    
                </div>        
                <div class="row">
                    <div class="form-group col-sm-4 mb-3">
                        <label for="vl_compra" class="control-label">$ Compra</label>
                        <input type="text" class="form-control" value="{{$produto->vl_compra ?? ''}}" name="vl_compra" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off">                    
                    </div>                        
                    <div class="form-group col-sm-4 mb-3">
                        <label for="vl_venda" class="control-label">$ Venda</label>
                        <input type="text" class="form-control" value="{{$produto->vl_venda ?? ''}}" name="vl_venda" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off">     
                    </div>
                    <div class="form-group col-sm-4 mb-1">
                        <label for="cd_unidade" class="control-label">Unidade</label>
                        <select class="form-control" name="cd_unidade" required>
                            <option value=""></option>
                            @foreach($unidades as $unidade)
                                @if (isset($produto))
                                    @if($unidade['cd_unidade']==$produto->cd_unidade)
                                    <option value="{{$unidade['cd_unidade']}}" selected>
                                    {{$unidade['nm_unidade']}}
                                    </option>
                                    @else
                                    <option value="{{$unidade['cd_unidade']}}">
                                    {{$unidade['nm_unidade']}}
                                    </option>
                                    @endif	         
                                @else                                    
                                    <option value="{{$unidade['cd_unidade']}}">
                                    {{$unidade['nm_unidade']}}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>                        
                </div>    
                <div class="row">
                    <div class="form-group col-sm-3 mb-3">
                        <label for="qt_estoque" class="control-label">Estoque</label>
                        <input type="text" class="form-control" value="{{$produto->qt_estoque ?? ''}}" name="qt_estoque" autocomplete="off" required>
                    </div>    
                    <div class="form-group col-sm-3 mb-3">
                        <label for="qt_minestoque" class="control-label">Estoque Minimo</label>
                        <input type="text" class="form-control" value="{{$produto->qt_minestoque ?? ''}}" name="qt_minestoque" autocomplete="off" required>     
                    </div>                            
                    <div class="form-group col-sm-4 mb-3">
                        <label for="cd_barra" class="control-label">Código de Barra</label>
                        <input type="text" class="form-control" value="{{$produto->cd_barra ?? ''}}" name="cd_barra" maxlength="20" autocomplete="off">
                    </div> 
                    <div class="form-group col-sm-2 mb-3">                                    
                        <label for="st_convalescente" class="control-label">Convalescente ?</label>
                        @if (isset($produto))                        
                            @if($produto->st_convalescente===1)
                                <input type="checkbox" class="checkbox" value="{{$produto->st_convalescente ?? ''}}" checked name='st_convalescente'>
                            @else 
                                <input type="checkbox" class="checkbox" value="{{$produto->st_convalescente ?? ''}}" name='st_convalescente'>
                            @endif 
                        @else
                            <input type="checkbox" class="checkbox" value="{{$produto->st_convalescente ?? ''}}" name='st_convalescente'>
                        @endif                                
                    </div>                           
                </div> 
            </fieldset>    
            <!-- Dados complementares -->
            <fieldset class="form-group">
            <legend>Complementares</legend>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="nm_obs" class="control-label">Observação</label>
                        <textarea class="form-control" name="nm_obs" rows="5">{{$produto->nm_obs ?? ''}}</textarea>
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
<script> 
$("#nm_fornecedor").autocomplete({    
    source: "{{ URL::to('completefornecedor') }}",
    dataType: "json",
    minLength: 2,
    select: function (key, value) {                        
        $("#id_fornecedor").val(value.item.id);	            
	},
});

$(function(){    
});    
</script>

@stop