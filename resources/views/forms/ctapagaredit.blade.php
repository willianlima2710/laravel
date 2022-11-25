@extends('adminlte::page')

@section('title', 'Contas a Pagar')

@section('content_header')
@stop

@section('content')    

<!-- general form elements -->    
<div class='box box-primary box-solid'> 
    <div class='box-header with-border'>            
        <h3 class="box-title">Contas a Pagar</h3>
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

    <form method="post" action="{{ $action ?? url('ctapagar') }}">    
    {{csrf_field()}}
    @isset($ctapagar) {{method_field('patch')}} @endisset

        <!-- /.box-header -->
        <div class="box-body">   
            <fieldset class="form-group">
                <input type="hidden" value="{{$ctapagar->id_ctapagar ?? ''}}" name="id_ctapagar" class="form-control">
                <div class="row">
                    <div class="form-group col-sm-12 mb-1">
                        <label for="nm_fornecedor" class="control-label">Fornecedor</label>
                        <input type="text" class="form-control" value="{{$ctapagar->nm_fornecedor ?? ''}}" 
                         name="nm_fornecedor" id="nm_fornecedor" autocomplete="off" placeholder="Nome ou CPF/CNPJ" >                                                                             
                    </div>   
                    <input type="hidden" class="form-control" value="{{$ctapagar->id_fornecedor ?? ''}}" name="id_fornecedor" id="id_fornecedor" required>                    
                </div>        
                <div class="row">
                    <div class="form-group col-sm-2 mb-1">
                        <label for="nr_documento" class="control-label">Documento</label>
                        <input type="text" class="form-control" value="{{$ctapagar->nr_documento ?? ''}}" name="nr_documento" maxlength="30" autocomplete="off" required>                    
                    </div>             
                    <div class="form-group col-sm-2 mb-1">
                        <label for="nr_parcela" class="control-label">Nº Parcela</label>
                        <input type="text" class="form-control" value="{{$ctapagar->nr_parcela ?? ''}}" name="nr_parcela" maxlength="3" value="1" autocomplete="off" required>                    
                    </div>             
                    <div class="form-group col-sm-2 mb-1">
                        <label for="dt_vencimento" class="control-label">Data Vencimento</label>
                        <input type="text" class="form-control" value="{{empty($ctapagar->dt_vencimento) ? '' : $ctapagar->dt_vencimento->format('d/m/Y') ?? ''}}" name="dt_vencimento" onkeypress="$(this).mask('00/00/0000')" autocomplete="off" required>
                    </div> 
                    <div class="form-group col-sm-2 mb-1">
                        <label for="vl_apagar" class="control-label">$ Valor</label>
                        <input type="text" class="form-control" value="{{$ctapagar->vl_apagar ?? ''}}" name="vl_apagar" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off" required>                  
                    </div> 
                    <div class="form-group col-sm-4 mb-1">
                        <label for="id_tppagamento" class="control-label">Tipo Pagamento</label>
                        <select class="form-control" name="id_tppagamento" required>
                            <option value=""></option>
                            @foreach($tppagamentos as $tppagamento)
                                @if (isset($ctapagar))
                                    @if($tppagamento->id_tppagamento==$ctapagar->id_tppagamento)
                                    <option value="{{$tppagamento->id_tppagamento}}" selected>
                                    {{$tppagamento->nm_tppagamento}}
                                    </option>
                                    @else
                                    <option value="{{$tppagamento->id_tppagamento}}">
                                    {{$tppagamento->nm_tppagamento}}
                                    </option>
                                    @endif	         
                                @else                                    
                                    <option value="{{$tppagamento->id_tppagamento}}">
                                    {{$tppagamento->nm_tppagamento}}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>    
                </div>       
                <div class="row">
                    <div class="form-group col-sm-3 mb-1">
                        <label for="vl_pago" class="control-label">$ Pago</label>
                        <input type="text" class="form-control" value="{{$ctapagar->vl_pago ?? ''}}" id="vl_pago" name="vl_pago" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off">                  
                    </div> 
                    <div class="form-group col-sm-3 mb-1">
                        <label for="dt_pagamento" class="control-label">Data Pagamento</label>
                        <input type="text" class="form-control" value="{{empty($ctapagar->dt_pagamento) ? '' : $ctapagar->dt_pagamento->format('d/m/Y') ?? ''}}" id="dt_pagamento" name="dt_pagamento" onkeypress="$(this).mask('00/00/0000')" autocomplete="off">
                    </div> 
                    <div class="form-group col-sm-3 mb-1">
                        <label for="vl_juros" class="control-label">$ Juros</label>
                        <input type="text" class="form-control" value="{{$ctapagar->vl_juros ?? ''}}" name="vl_juros" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off">                  
                    </div> 
                    <div class="form-group col-sm-3 mb-1">
                        <label for="vl_multa" class="control-label">$ Multa</label>
                        <input type="text" class="form-control" value="{{$ctapagar->vl_multa ?? ''}}" name="vl_multa" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off">                  
                    </div> 
                </div>                         
                <div class="row">                        
                    <div class="form-group col-sm-6 mb-1">
                        <label for="id_banco" class="control-label">Banco</label>
                        <select class="form-control" name="id_banco" required>
                            <option value=""></option>
                            @foreach($bancos as $banco)
                                @if (isset($ctapagar))
                                    @if($banco->id_banco==$ctapagar->id_banco)
                                    <option value="{{$banco->id_banco}}" selected>
                                    {{$banco->nm_banco}}
                                    </option>
                                    @else
                                    <option value="{{$banco->id_banco}}">
                                    {{$banco->nm_banco}}
                                    </option>
                                    @endif	            		
                                @else
                                    <option value="{{$banco->id_banco}}">
                                    {{$banco->nm_banco}}
                                    </option>
                                @endif    
                            @endforeach
                        </select>
                    </div>    
                    <div class="form-group col-sm-6 mb-1">
                        <label for="id_planoconta" class="control-label">Plano de Contas</label>
                        <select class="form-control" name="id_planoconta" required>
                            <option value=""></option>
                            @foreach($planocontas as $planoconta)
                                @if (isset($ctapagar))
                                    @if($planoconta->id_planoconta==$ctapagar->id_planoconta)
                                    <option value="{{$planoconta->id_planoconta}}" selected>
                                    {{$planoconta->nm_planoconta}}
                                    </option>
                                    @else
                                    <option value="{{$planoconta->id_planoconta}}">
                                    {{$planoconta->nm_planoconta}}
                                    </option>
                                    @endif	            		
                                @else 
                                    <option value="{{$planoconta->id_planoconta}}">
                                    {{$planoconta->nm_planoconta}}
                                    </option>
                                @endif   
                            @endforeach
                        </select>
                    </div>    
                </div> 
                <div class="row">
                    <div class="form-group col-sm-4 mb-1">
                        <label for="cd_agencia" class="control-label">Agencia</label>
                        <input type="text" class="form-control" value="{{$ctapagar->cd_agencia ?? ''}}" name="cd_agencia" maxlength="10" autocomplete="off">     
                    </div>        
                    <div class="form-group col-sm-4 mb-1">
                        <label for="nr_conta" class="control-label">Nº Conta</label>
                        <input type="text" class="form-control" value="{{$ctapagar->nr_conta ?? ''}}" name="nr_conta" maxlength="20" autocomplete="off">     
                    </div>        
                    <div class="form-group col-sm-4 mb-1">
                        <label for="nr_cheque" class="control-label">Nº Cheque</label>
                        <input type="text" class="form-control" value="{{$ctapagar->nr_cheque ?? ''}}" name="nr_cheque" maxlength="20" autocomplete="off">     
                    </div>        
                </div>
            </fieldset>
            <fieldset class="form-group">
            <legend class="label label-success"><span><h4>Informações</h4></span></legend>
                <div class="row">
                    <div class="form-group col-sm-12 mb-1">
                        <label for="ds_historico" class="control-label">Historico</label>
                        <input type="text" class="form-control" value="{{$ctapagar->ds_historico ?? ''}}" name="ds_historico" maxlength="100" autocomplete="off" required>     
                    </div>        
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="nm_obs" class="control-label">Observação</label>
                        <textarea class="form-control" name="nm_obs" rows="5">{{$ctapagar->nm_obs ?? ''}}</textarea>
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

$("#vl_pago").change(function() {
    if ($("#dt_pagamento").val()==='') {
        $("#dt_pagamento").val(moment().format('DD/MM/YYYY')); 
    }
});

$(function(){    
});    
</script>
@stop