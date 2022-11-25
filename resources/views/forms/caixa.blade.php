@extends('adminlte::page')

@section('title', 'Caixa')

@section('content_header')
@stop

@section('content')    

<!-- general form elements -->    
<div class='box box-primary box-solid'> 
    <div class='box-header with-border'>            
        <h3 class="box-title">Caixa</h3>
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

    <form method="post" action="{{ $action ?? url('caixa') }}">    
    {{csrf_field()}}
    @isset($caixa) {{method_field('patch')}} @endisset

        <!-- /.box-header -->
        <div class="box-body">   
            <fieldset class="form-group">
                <input type="hidden" value="{{$caixa->id_caixa ?? ''}}" name="id_caixa" class="form-control">
                <div class="row" id='pessoa'>
                    <div class="form-group col-sm-12 mb-1">
                        <label for="nm_pessoa" class="control-label">Pessoa (Cliente,Fornecedor,Empresa ou Funcionario)</label>
                        <input type="text" class="form-control" value="{{$caixa->nm_pessoa ?? ''}}" 
                         name="nm_pessoa" id="nm_pessoa" autocomplete="off" placeholder="Nome ou CPF/CNPJ" >                                                                             
                    </div>   
                    <input type="hidden" class="form-control" value="{{$caixa->id_pessoa ?? ''}}" name="id_pessoa" id="id_pessoa" required>                    
                </div>        
                <div class="row">
                    <div class="form-group col-sm-6 mb-1">
                        <label for="id_banco" class="control-label">Banco</label>
                        <select class="form-control" name="id_banco" required>
                            <option value=""></option>
                            @foreach($bancos as $banco)
                                @if (isset($caixa))
                                    @if($banco->id_banco==$caixa->id_banco)
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
                                @if (isset($caixa))
                                    @if($planoconta->id_planoconta==$caixa->id_planoconta)
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
                        <label for="st_creddeb" class="control-label">Natureza</label>
                        <select class="form-control" name="st_creddeb" required>
                            <option value=""></option>
                            @foreach($creddeb as $crdb)
                                @if (isset($caixa))
                                    @if($crdb['st_creddeb']==$caixa->st_creddeb)
                                    <option value="{{$crdb['st_creddeb']}}" selected>
                                    {{$crdb['nm_creddeb']}}
                                    </option>
                                    @else
                                    <option value="{{$crdb['st_creddeb']}}">
                                    {{$crdb['nm_creddeb']}}
                                    </option>
                                    @endif	         
                                @else                                    
                                    <option value="{{$crdb['st_creddeb']}}">
                                    {{$crdb['nm_creddeb']}}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>    
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nr_documento" class="control-label">Documento</label>
                        <input type="text" class="form-control" value="{{$caixa->nr_documento ?? ''}}" name="nr_documento" maxlength="10" autocomplete="off">                    
                    </div>             
                    <div class="form-group col-sm-2 mb-3">
                        <label for="dt_movimento" class="control-label">Data do Movimento</label>
                        <input type="text" class="form-control" value="{{empty($caixa->dt_movimento) ? '' : $caixa->dt_movimento->format('d/m/Y') ?? ''}}" name="dt_movimento" onkeypress="$(this).mask('00/00/0000')" autocomplete="off" required>
                    </div>  
                    <div class="form-group col-sm-2 mb-1">
                        <label for="nr_parcela" class="control-label">Nº Parcela</label>
                        <input type="text" class="form-control" value="{{$caixa->nr_parcela ?? ''}}" name="nr_parcela" maxlength="3" value="1" autocomplete="off" required>                    
                    </div>             
                </div>           
                <div class="row">                   
                    <div class="form-group col-sm-2 mb-3">
                        <label for="vl_total" class="control-label">$ Valor</label>
                        <input type="text" class="form-control" value="{{$caixa->vl_total ?? ''}}" name="vl_total" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off" required>                  
                    </div>    
                    <div class="form-group col-sm-2 mb-3">
                        <label for="vl_juros" class="control-label">$ Juros</label>
                        <input type="text" class="form-control" value="{{$caixa->vl_juros ?? ''}}" name="vl_juros" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off">                  
                    </div>    
                    <div class="form-group col-sm-2 mb-3">
                        <label for="vl_multa" class="control-label">$ Multa</label>
                        <input type="text" class="form-control" value="{{$caixa->vl_multa ?? ''}}" name="vl_multa" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off">                  
                    </div>    
                    <div class="form-group col-sm-2 mb-1">
                        <label for="id_tppagamento" class="control-label">Tipo Pagamento</label>
                        <select class="form-control" name="id_tppagamento" required>
                            <option value=""></option>
                            @foreach($tppagamentos as $tppagamento)
                                @if (isset($caixa))
                                    @if($tppagamento->id_tppagamento==$caixa->id_tppagamento)
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
                    <div class="form-group col-sm-1 mb-1">
                        <label for="cd_agencia" class="control-label">Agencia</label>
                        <input type="text" class="form-control" value="{{$caixa->cd_agencia ?? ''}}" name="cd_agencia" maxlength="10" autocomplete="off">     
                    </div>        
                    <div class="form-group col-sm-1 mb-1">
                        <label for="nr_conta" class="control-label">Nº Conta</label>
                        <input type="text" class="form-control" value="{{$caixa->nr_conta ?? ''}}" name="nr_conta" maxlength="20" autocomplete="off">     
                    </div>        
                    <div class="form-group col-sm-2 mb-1">
                        <label for="nr_cheque" class="control-label">Nº Cheque</label>
                        <input type="text" class="form-control" value="{{$caixa->nr_cheque ?? ''}}" name="nr_cheque" maxlength="20" autocomplete="off">     
                    </div>        
                </div>
            </fieldset>
            <fieldset class="form-group">
            <legend class="label label-success"><span><h4>Informações</h4></span></legend>                                                                
                <div class="row">
                    <div class="form-group col-sm-12 mb-3">
                        <label for="ds_historico" class="control-label">Historico</label>
                        <input type="text" class="form-control" value="{{$caixa->ds_historico ?? ''}}" name="ds_historico" maxlength="100" autocomplete="off" required>     
                    </div>        
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="nm_obs" class="control-label">Observação</label>
                        <textarea class="form-control" name="nm_obs" rows="5">{{$caixa->nm_obs ?? ''}}</textarea>
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
    source: "{{ URL::to('completepessoa') }}",
    dataType: "json",
    minLength: 2,
    select: function (key, value) {                        
        $("#id_pessoa").val(value.item.id);	            
	},
});

$(function(){    
});    
</script>
@stop