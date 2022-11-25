@extends('adminlte::page')

@section('title', 'Contas a Receber')

@section('content_header')
@stop

@section('content')    

<!-- general form elements -->    
<div class='box box-primary box-solid'> 
    <div class='box-header with-border'>            
        <h3 class="box-title">Contas a Receber</h3>
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

    <form method="post" action="{{ $action ?? url('ctareceber') }}">    
    {{csrf_field()}}
    @isset($ctareceber) {{method_field('patch')}} @endisset

        <!-- /.box-header -->
        <div class="box-body">   
            <fieldset class="form-group">
                <input type="hidden" value="{{$ctareceber->id_ctareceber ?? ''}}" name="id_ctareceber" class="form-control">
                <div class="row">
                    <div class="form-group col-sm-12 mb-1">
                        <label for="nm_pessoa" class="control-label">Cliente</label>
                        <input type="text" class="form-control" value="{{$ctareceber->nm_pessoa ?? ''}}" 
                         name="nm_pessoa" id="nm_pessoa" autocomplete="off" placeholder="Nome ou CPF" >                                                                             
                    </div>   
                    <input type="hidden" class="form-control" value="{{$ctareceber->id_pessoa ?? ''}}" name="id_pessoa" id="id_pessoa" required>                    
                </div>        
                <div class="row">
                    <div class="form-group col-sm-2 mb-1">
                        <label for="nr_documento" class="control-label">Documento</label>
                        <input type="text" class="form-control" value="{{$ctareceber->nr_documento ?? ''}}" name="nr_documento" maxlength="30" autocomplete="off" required>                    
                    </div>             
                    <div class="form-group col-sm-2 mb-1">
                        <label for="nr_parcela" class="control-label">Nº Parcela</label>
                        <input type="text" class="form-control" value="{{$ctareceber->nr_parcela ?? ''}}" name="nr_parcela" maxlength="3" value="1" autocomplete="off" required>                    
                    </div>             
                    <div class="form-group col-sm-2 mb-1">
                        <label for="dt_vencimento" class="control-label">Data Vencimento</label>
                        <input type="text" class="form-control" value="{{empty($ctareceber->dt_vencimento) ? '' : $ctareceber->dt_vencimento->format('d/m/Y') ?? ''}}" name="dt_vencimento" onkeypress="$(this).mask('00/00/0000')" autocomplete="off" required>
                    </div> 
                    <div class="form-group col-sm-2 mb-1">
                        <label for="vl_apagar" class="control-label">$ Valor</label>
                        <input type="text" class="form-control" value="{{$ctareceber->vl_apagar ?? ''}}" name="vl_apagar" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off" required>                  
                    </div> 
                    <div class="form-group col-sm-4 mb-1">
                        <label for="id_tppagamento" class="control-label">Tipo Pagamento</label>
                        <select class="form-control" name="id_tppagamento" required>
                            <option value=""></option>
                            @foreach($tppagamentos as $tppagamento)
                                @if (isset($ctareceber))
                                    @if($tppagamento->id_tppagamento==$ctareceber->id_tppagamento)
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
                        <input type="text" class="form-control" value="{{$ctareceber->vl_pago ?? ''}}" id="vl_pago" name="vl_pago" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off">                  
                    </div> 
                    <div class="form-group col-sm-3 mb-1">
                        <label for="dt_pagamento" class="control-label">Data Pagamento</label>
                        <input type="text" class="form-control" value="{{empty($ctareceber->dt_pagamento) ? '' : $ctareceber->dt_pagamento->format('d/m/Y') ?? ''}}" id="dt_pagamento" name="dt_pagamento" onkeypress="$(this).mask('00/00/0000')" autocomplete="off">
                    </div> 
                    <div class="form-group col-sm-3 mb-1">
                        <label for="vl_juros" class="control-label">$ Juros</label>
                        <input type="text" class="form-control" value="{{$ctareceber->vl_juros ?? ''}}" name="vl_juros" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off">                  
                    </div> 
                    <div class="form-group col-sm-3 mb-1">
                        <label for="vl_multa" class="control-label">$ Multa</label>
                        <input type="text" class="form-control" value="{{$ctareceber->vl_multa ?? ''}}" name="vl_multa" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off">                  
                    </div> 
                </div>                         
                <div class="row">                        
                    <div class="form-group col-sm-6 mb-1">
                        <label for="id_banco" class="control-label">Banco</label>
                        <select class="form-control" name="id_banco" required>
                            <option value=""></option>
                            @foreach($bancos as $banco)
                                @if (isset($ctareceber))
                                    @if($banco->id_banco==$ctareceber->id_banco)
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
                                @if (isset($ctareceber))
                                    @if($planoconta->id_planoconta==$ctareceber->id_planoconta)
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
            </fieldset>
            <fieldset class="form-group">
            <legend>Informações</legend>                                                                      
                <div class="row">
                    <div class="form-group col-sm-12 mb-1">
                        <label for="ds_historico" class="control-label">Historico</label>
                        <input type="text" class="form-control" value="{{$ctareceber->ds_historico ?? ''}}" name="ds_historico" maxlength="100" autocomplete="off" required>     
                    </div>        
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="nm_obs" class="control-label">Observação</label>
                        <textarea class="form-control" name="nm_obs" rows="5">{{$ctareceber->nm_obs ?? ''}}</textarea>
                    </div>                            
                </div> 
            </fieldset>    
            <fieldset class="form-group">
            <legend>Outros</legend>                                                                      
                <div class="row">
                    <div class="form-group col-sm-2 mb-1">
                        <label for="st_parcela" class="control-label">Qt Parcela</label>
                        <input type="text" class="form-control" value="{{$ctareceber->st_parcela ?? ''}}" name="st_parcela" maxlength="10" disabled autocomplete="off">     
                    </div>                             
                    <div class="form-group col-sm-2 mb-1">
                        <label for="dt_carne" class="control-label">Data do Carne</label>
                        <input type="text" class="form-control" value="{{empty($ctareceber->dt_carne) ? '' : $ctareceber->dt_carne->format('d/m/Y') ?? ''}}" name="dt_carne" maxlength="10" disabled autocomplete="off">     
                    </div>        
                    <div class="form-group col-sm-2 mb-1">
                        <label for="nr_nossonum" class="control-label">Nosso Numero</label>
                        <input type="text" class="form-control" value="{{$ctareceber->nr_nossonum ?? ''}}" name="nr_nossonum" maxlength="10" disabled autocomplete="off">     
                    </div>        
                    <div class="form-group col-sm-2 mb-1">
                        <label for="nr_dvnossonum" class="control-label">Digito</label>
                        <input type="text" class="form-control" value="{{$ctareceber->nr_dvnossonum ?? ''}}" name="nr_dvnossonum" maxlength="20" disabled autocomplete="off">     
                    </div>        
                    <div class="form-group col-sm-2 mb-1">
                        <label for="nr_remessa" class="control-label">Nº Remessa</label>
                        <input type="text" class="form-control" value="{{$ctareceber->nr_remessa ?? ''}}" name="nr_remessa" maxlength="20" disabled autocomplete="off">     
                    </div>        
                    <div class="form-group col-sm-2 mb-1">
                        <label for="dt_rembanco" class="control-label">Data Remessa</label>
                        <input type="text" class="form-control" value="{{empty($ctareceber->dt_rembanco) ? '' : $ctareceber->dt_rembanco->format('d/m/Y') ?? ''}}" name="dt_rembanco" maxlength="20" disabled autocomplete="off">     
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
$("#nm_pessoa").autocomplete({    
    source: "{{ URL::to('completecliente') }}",
    dataType: "json",
    minLength: 2,
    select: function (key, value) {                        
        $("#id_pessoa").val(value.item.id);	            
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