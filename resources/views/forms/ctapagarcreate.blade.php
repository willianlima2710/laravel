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
                         name="nm_fornecedor" id="nm_fornecedor" autocomplete="off" placeholder="Nome ou CPF/CNPJ">                                                                             
                    </div>   
                    <input type="hidden" class="form-control" value="{{$ctapagar->id_fornecedor ?? ''}}" name="id_fornecedor" id="id_fornecedor" required>                    
                </div>        
                <div class="row">
                    <div class="form-group col-sm-2 mb-1">
                        <label for="nr_documento" class="control-label">Documento</label>
                        <input type="text" class="form-control" value="{{$ctapagar->nr_documento ?? ''}}" name="nr_documento" id="nr_documento" maxlength="30" autocomplete="off">                                            
                    </div>             
                    <div class="form-group col-sm-2 mb-1">
                        <label for="vl_apagar" class="control-label">$ Valor</label>
                        <input type="text" class="form-control" value="{{$ctapagar->vl_apagar ?? ''}}" name="vl_apagar" id="vl_apagar" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off" required>                  
                    </div> 
                    <div class="form-group col-sm-2 mb-1">
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
                    <div class="form-group col-sm-2 mb-1">
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
                    <div class="form-group col-sm-4 mb-1">
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
            <fieldset class="form-group">
            <legend class="label label-success"><span><h4>Parcelamento</h4></span></legend>
                <div class="row" id='financeiro'>
                    <div class="form-group col-sm-1 mb-3">
                        <label for="qt_parcela" class="control-label">Qt.Parcelas</label>
                        <input type="text" class="form-control" value="{{$contrato->qt_parcela ?? ''}}" id="qt_parcela" autocomplete="off">
                    </div>                                      
                    <div class="form-group col-sm-2 mb-3">
                        <label for="dt_privencimento" class="control-label">1º Vencimento</label>
                        <input type="text" class="form-control" value="{{$contrato->dt_privencimento ?? ''}}" id="dt_privencimento" onkeypress="$(this).mask('00/00/0000')" autocomplete="off">
                    </div>         
                    <div class="form-group col-sm-2 mb-3">
                        <br>
                        <button type='button' id="btfinanceiro" class="btn btn-sm btn-primary pull-right" style="margin: 6px;"><i class='fa fa-plus'></i> Gerar Parcelamento</a></h3>
                    </div>    
                </div>
            </fieldset>            
            <fieldset class="form-group">
            <legend></legend>
                <div class="box-body table-responsive no-padding" style="width:100%;height:300px;overflow-y: scroll;">                        
                    <table id='tbfinanceiro' class="table table-striped table-bordered table-condensed table-hover">
                    <thead class="bg-info">
                    <tr>
                        <th width="50px">Vencimento</th>
                        <th width="50px">Documento</th>
                        <th width="50px">Parcela</th>
                        <th width="50px">$ Valor</th>
                    </tr>
                    </thead>
                    <tbody>  
                    </tbody>
                    <tfoot>
                        <th>Total</th>
                        <th></th>
                        <th></th>
                        <th id="total">{{ isset($total) ? number_format($total,2, '.', '') : 0 }}</th>
                    </tfoot>    
                    </table>                                           
                </div>
            </fieldset>                     
            <!-- /.box-body --> 
            <div class="box-footer">        
                <div class="pull-right">
                    <button class="btn btn-primary" type="submit">Salvar</button>
                    <a class="btn btn-danger" href="{{ url()->previous()  }}">Cancelar</a>
                </div>       
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

var total = 0;
function financeiro()
{
    $('#tbfinanceiro tbody').empty();

    if(       
       $('#qt_parcela').val()!="" && 
       $('#dt_privencimento').val()!="" &&
       $('#vl_apagar').val()!="" &&
       $('#vl_apagar').val()!=0
      )        
    {         
        moment.locale('pt');
        $('#finantotal').html('0.00');       
        var qt_parcela = parseInt($('#qt_parcela').val());        
        var dt_vencimento = moment($('#dt_privencimento').val(),'DD/MM/YYYY');  
        var vl_apagar = parseFloat($('#vl_apagar').val());
        var nr_documento = $('#nr_documento').val().toUpperCase();
        var i = 0;

        for(i=0; i<qt_parcela;i++) 
        {            
            var linha = 
            '<tr>'+            
                '<td><input type="hidden" name="dt_vencimento[]" value="'+dt_vencimento.format('DD/MM/YYYY')+'">'+dt_vencimento.format('DD/MM/YYYY')+'</td>'+            
                '<td><input type="hidden" name="nr_documento[]" value="'+nr_documento+'">'+nr_documento+'</td>'+            
                '<td><input type="hidden" name="nr_parcela[]" value="'+(i+1)+'">'+(i+1)+'</td>'+                            
                '<td><input type="hidden" name="vl_apagar[]" value="'+vl_apagar.toFixed(2)+'">'+vl_apagar.toFixed(2)+'</td>'+
            '</tr>'
            $('#tbfinanceiro').append(linha);
            dt_vencimento = dt_vencimento.add(30, 'd');
            total = parseFloat(total) + parseFloat(vl_apagar);
        }    
        $('#total').html(total.toFixed(2));
        $('#qt_parcela').val('');
        $('#dt_privencimento').val('');
    }else{        
        bootbox.alert({               
            title: "Atenção",     
            message: "<b>Campo(s) obrigatório(s) não preenchido(s)!</b>",
            size: 'small',
            backdrop: true,
        });
    }        
}

$(function(){    
    $("#btfinanceiro").click(function() {
        financeiro();
    });
});    
</script>
@stop