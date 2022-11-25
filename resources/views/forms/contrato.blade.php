@extends('adminlte::page')

@section('title', 'Contrato')

@section('content_header')
@stop

@section('content')    

<!-- general form elements -->    
<div class='box box-primary box-solid'> 
    <div class='box-header with-border'>            
        <h3 class="box-title">Contrato</h3>
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

    <form method="post" action="{{ $action ?? url('contrato') }}">    
    {{csrf_field()}}
    @isset($contrato) {{method_field('patch')}} @endisset

        <!-- /.box-header -->
        <div class="box-body">   
            <fieldset class="form-group">
                <input type="hidden" value="{{$contrato->id_contrato ?? ''}}" name="id_contrato" id="id_contrato" class="form-control">
                <div class="row">
                    <div class="form-group col-sm-12 mb-1">
                        <label for="nm_pessoa" class="control-label">Cliente</label>
                        <input type="text" class="form-control" value="{{$contrato->nm_pessoa ?? ''}}" 
                         name="nm_pessoa" id="nm_pessoa" autocomplete="off" placeholder="Nome ou CPF" >                                                                             
                    </div>   
                    <input type="hidden" class="form-control" value="{{$contrato->id_pessoa ?? ''}}" name="id_pessoa" id="id_pessoa" required>                    
                </div>        
                <div class="row">
                    <div class="form-group col-sm-3 mb-1">
                        <label for="id_plano" class="control-label">Plano</label>
                        <select class="form-control" name="id_plano" required>
                            <option value=""></option>
                            @foreach($planos as $plano)
                                @if (isset($contrato))
                                    @if($plano->id_plano==$contrato->id_plano)
                                    <option value="{{$plano->id_plano}}" selected>
                                    {{$plano->nm_plano}}
                                    </option>
                                    @else
                                    <option value="{{$plano->id_plano}}">
                                    {{$plano->nm_plano}}
                                    </option>
                                    @endif	         
                                @else                                    
                                    <option value="{{$plano->id_plano}}">
                                    {{$plano->nm_plano}}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>    
                    <div class="form-group col-sm-5 mb-1">
                        <label for="id_vendedor" class="control-label">Vendedor</label>
                        <select class="form-control" name="id_vendedor" required>
                            <option value=""></option>
                            @foreach($funcionarios as $funcionario)
                                @if (isset($contrato))
                                    @if($funcionario->id_pessoa==$contrato->id_vendedor)
                                    <option value="{{$funcionario->id_pessoa}}" selected>
                                    {{$funcionario->nm_pessoa}}
                                    </option>
                                    @else
                                    <option value="{{$funcionario->id_pessoa}}">
                                    {{$funcionario->nm_pessoa}}
                                    </option>
                                    @endif	         
                                @else                                    
                                    <option value="{{$funcionario->id_pessoa}}">
                                    {{$funcionario->nm_pessoa}}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>    
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nr_contrato" class="control-label">Nº Contrato</label>
                        <input type="text" class="form-control" value="{{$contrato->nr_contrato ?? ''}}" name="nr_contrato" maxlength="10" autocomplete="off">
                    </div>       
                    <div class="form-group col-sm-2 mb-1">
                        <label for="st_local" class="control-label">Tipo de Cobrança</label>
                        <select class="form-control" name="st_local" required>
                            <option value=""></option>
                            @foreach($locals as $local)
                                @if (isset($contrato))
                                    @if($local['st_local']==$contrato->st_local)
                                    <option value="{{$local['st_local']}}" selected>
                                    {{$local['nm_local']}}
                                    </option>
                                    @else
                                    <option value="{{$local['st_local']}}">
                                    {{$local['nm_local']}}
                                    </option>
                                    @endif	         
                                @else                                    
                                    <option value="{{$local['st_local']}}">
                                    {{$local['nm_local']}}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>   
                </div>
                <div class="row">
                    <div class="form-group col-sm-2 mb-3">
                        <label for="dt_inccontrato" class="control-label">Data Contrato</label>
                        <input type="text" class="form-control" value="{{empty($contrato->dt_inccontrato) ? date('d/m/Y') : $contrato->dt_inccontrato->format('d/m/Y') ?? ''}}" name="dt_inccontrato" onkeypress="$(this).mask('00/00/0000')" autocomplete="off">
                    </div>   
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nr_carencia" class="control-label text-danger">Carência</label>
                        <input type="text" class="form-control" value="{{$contrato->nr_carencia ?? ''}}" name="nr_carencia" maxlength="10" autocomplete="off">
                    </div>  
                    <div class="form-group col-sm-2 mb-3">
                        <label for="dt_termcarencia" class="control-label text-danger">Térm Carência</label>
                        <input type="text" class="form-control" value="{{empty($contrato->dt_termcarencia) ? '' : $contrato->dt_termcarencia->format('d/m/Y') ?? ''}}" name="dt_termcarencia" disabled="true" onkeypress="$(this).mask('00/00/0000')" autocomplete="off">
                    </div>   
                    <div class="form-group col-sm-2 mb-3">
                        <label for="km_plano" class="control-label">Km Plano</label>
                        <input type="text" class="form-control" value="{{$contrato->km_plano ?? ''}}" name="km_plano" maxlength="10" autocomplete="off">
                    </div>   
                    <div class="form-group col-sm-2 mb-3">
                        <label for="vl_plano" class="control-label">$ Valor</label>
                        <input type="text" class="form-control" value="{{$contrato->vl_plano ?? ''}}" name="vl_plano" id="vl_plano" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off">                    
                    </div>                        
                    <div class="form-group col-sm-2 mb-3">
                        <label for="qt_dependente" class="control-label">Qt Dependentes</label>
                        <input type="number" class="form-control" value="{{$contrato->qt_dependente ?? '1'}}" name="qt_dependente" id="qt_dependente" defaultValue="1" min="1" max="99">
                    </div>    
                </div>
                <div class="row">
                    <div class="form-group col-sm-2 mb-1">
                        <label for="st_cobranca" class="control-label">Cobrança por</label>
                        <select class="form-control" name="st_cobranca" required>
                            <option value=""></option>
                            @foreach($cobrancas as $cobranca)
                                @if (isset($contrato))
                                    @if($cobranca['st_cobranca']==$contrato->st_cobranca)
                                    <option value="{{$cobranca['st_cobranca']}}" selected>
                                    {{$cobranca['nm_cobranca']}}
                                    </option>
                                    @else
                                    <option value="{{$cobranca['st_cobranca']}}">
                                    {{$cobranca['nm_cobranca']}}
                                    </option>
                                    @endif	         
                                @else                                    
                                    <option value="{{$cobranca['st_cobranca']}}">
                                    {{$cobranca['nm_cobranca']}}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>    
                    <div class="form-group col-sm-2 mb-3">
                        <label for="vl_adicional" class="control-label text-primary">Valor Adicional</label>
                        <input type="text" class="form-control" value="{{$contrato->vl_adicional ?? ''}}" name="vl_adicional" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off">                    
                    </div>            
                    <div class="form-group col-sm-2 mb-3">
                        <label for="vl_total" class="control-label text-danger">Valor Total</label>
                        <input type="text" class="form-control" value="{{$contrato->vl_total ?? ''}}" name="vl_total" onkeypress="$(this).mask('####0.00', {reverse: true})" disabled="true" autocomplete="off">                    
                    </div>                        
                    <div class="form-group col-sm-2 mb-3">
                        <label for="dt_fimcontrato" class="control-label">Data Termino</label>
                        <input type="text" class="form-control" value="{{empty($contrato->dt_fimcontrato) ? '' : $contrato->dt_fimcontrato->format('d/m/Y') ?? ''}}" name="dt_fimcontrato" onkeypress="$(this).mask('00/00/0000')" autocomplete="off">
                    </div>      
                    <div class="form-group col-sm-2 mb-3">
                        <label for="dt_valcarterinha" class="control-label text-primary">Validade Carterinha</label>
                        <input type="text" class="form-control" value="{{empty($contrato->dt_valcarterinha) ? '' : $contrato->dt_valcarterinha->format('d/m/Y') ?? ''}}" name="dt_valcarterinha" onkeypress="$(this).mask('00/00/0000')" autocomplete="off">
                    </div>
                    <div class="form-group col-sm-2 mb-3">
                        <label for="dt_cancontrato" class="control-label text-danger">Data Cancelamento</label>
                        <input type="text" class="form-control" value="{{empty($contrato->dt_cancontrato) ? '' : $contrato->dt_cancontrato->format('d/m/Y') ?? ''}}" name="dt_cancontrato" disabled="true" onkeypress="$(this).mask('00/00/0000')" autocomplete="off">
                    </div> 
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="nm_obs" class="control-label">Observação</label>
                        <textarea class="form-control" name="nm_obs" rows="5">{{$contrato->nm_obs ?? ''}}</textarea>
                    </div>                            
                </div> 
            </fieldset>        
            <fieldset class="form-group">
            <legend class="label label-success"><span><h4>Dependentes</h4></span></legend>               
                <div class="row">
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_dependente" class="control-label">Dependente</label>
                        <input type="text" class="form-control" value="{{$contrato->nm_dependente ?? ''}}" id="nm_dependente" maxlength="100" autocomplete="off">
                    </div>  
                    <div class="form-group col-sm-3 mb-1">
                        <label for="id_estcivil" class="control-label">Estado Civil</label>
                        <select class="form-control" id="id_estcivil">
                            <option value=""></option>
                            @foreach($estcivils as $estcivil)
                                @if (isset($contrato))
                                    @if($estcivil->id_estcivil==$contrato->id_estcivil)
                                    <option value="{{$estcivil->id_estcivil}}" selected>
                                    {{$estcivil->nm_estcivil}}
                                    </option>
                                    @else
                                    <option value="{{$estcivil->id_estcivil}}">
                                    {{$estcivil->nm_estcivil}}
                                    </option>
                                    @endif	         
                                @else                                    
                                    <option value="{{$estcivil->id_estcivil}}">
                                    {{$estcivil->nm_estcivil}}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>    
                    <div class="form-group col-sm-2 mb-1">
                        <label for="st_sexo" class="control-label">Sexo</label>
                        <select class="form-control" id="st_sexo">
                            <option value=""></option>
                            @foreach($sexos as $sexo)
                                @if (isset($contrato))
                                    @if($sexo['st_sexo']==$contrato->st_sexo)
                                    <option value="{{$sexo['st_sexo']}}" selected>
                                    {{$sexo['nm_sexo']}}
                                    </option>
                                    @else
                                    <option value="{{$sexo['st_sexo']}}">
                                    {{$sexo['nm_sexo']}}
                                    </option>
                                    @endif	         
                                @else                                    
                                    <option value="{{$sexo['st_sexo']}}">
                                    {{$sexo['nm_sexo']}}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>    
                    <div class="form-group col-sm-2 mb-1">
                        <label for="id_parentesco" class="control-label">Parentesco</label>
                        <select class="form-control" id="id_parentesco">
                            <option value=""></option>
                            @foreach($parentescos as $parentesco)
                                @if (isset($contrato))
                                    @if($parentesco->nm_parentesco==$contrato->id_parentesco)
                                    <option value="{{$parentesco->id_parentesco}}" selected>
                                    {{$parentesco->nm_parentesco}}
                                    </option>
                                    @else
                                    <option value="{{$parentesco->id_parentesco}}">
                                    {{$parentesco->nm_parentesco}}
                                    </option>
                                    @endif	         
                                @else                                    
                                    <option value="{{$parentesco->id_parentesco}}">
                                    {{$parentesco->nm_parentesco}}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>       
                </div>        
                <div class="row">
                    <div class="form-group col-sm-2 mb-3">
                        <label for="dt_nascimento" class="control-label">Data de Nascimento</label>
                        <input type="text" class="form-control" value="{{empty($contrato->dt_nascimento) ? '' : $contrato->dt_nascimento->format('d/m/Y') ?? ''}}" id="dt_nascimento" onkeypress="$(this).mask('00/00/0000')" autocomplete="off">
                    </div>         
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nr_cpf" class="control-label">CPF</label>
                        <input type="text" class="form-control" value="{{$contrato->nr_cpf ?? ''}}" id="nr_cpf" onkeypress="$(this).mask('000.000.000-00');" autocomplete="off">                    
                    </div>                         
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nr_rg" class="control-label">RG</label>
                        <input type="text" class="form-control" value="{{$contrato->nr_rg ?? ''}}" id="nr_rg" maxlength="30" autocomplete="off">     
                    </div>    
                    <div class="form-group col-sm-1 mb-3">
                        <label for="nr_carencia" class="control-label text-danger">Carência</label>
                        <input type="text" class="form-control" value="{{$contrato->nr_carencia ?? ''}}" id="nr_carencia" maxlength="3" autocomplete="off">
                    </div>    
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nr_telefone1" class="control-label">1º Telefone</label>
                        <input type="text" class="form-control" value="{{$contrato->nr_telefone1 ?? ''}}" id="nr_telefone1" onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off">      
                    </div>
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nr_telefone2" class="control-label">2º Telefone</label>
                        <input type="text" class="form-control" value="{{$contrato->nr_telefone2 ?? ''}}" id="nr_telefone2" onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off">     
                    </div>
                    <div class="form-group col-sm-1 mb-3">
                        <br>
                        <button type='button' class="btn btn-sm btn-primary pull-right" id="btdependente" style="margin: 6px;"><i class='fa fa-plus'></i> Adicionar</button>
                    </div>    
                </div>
            </fieldset>           
            <fieldset class="form-group">
            <legend></legend>
                <div class="box-body table-responsive no-padding" style="width:100%;height:300px;overflow-y: scroll;">    
                    <table id="tbdependente" class="table table-striped table-bordered table-condensed table-hover">
                    <thead class="bg-info">
                    <tr>
                        <th width="50px"></th>
                        <th width="50px">Seq</th>
                        <th width="250px">Nome</th>
                        <th width="150px">Estado Civil</th>
                        <th width="150px">Sexo</th>
                        <th width="100px">Parentesco</th>
                        <th width="100px">Nascimento</th>
                        <th width="120px">CPF</th>
                        <th width="100px">RG</th>                        
                        <th width="100px">Carencia</th>
                        <th width="150px">1º Telefone</th>
                        <th width="150px">2º Telefone</th>
                    </tr>
                    </thead>
                    <tbody> 
                    @if (isset($contratodeps)) 
                    @foreach ($contratodeps as $contratodep)
                    <tr>
                        <td></td>
                        <td>{{ $contratodep->cd_sequencia }}</td>
                        <td>{{ $contratodep->nm_dependente }}</td>
                        <td>{{ $contratodep->nm_estcivil }}</td>
                        <td>{{ ($contratodep->st_sexo=='0') ? 'MASCULINO' : 'FEMININO' }}</td>
                        <td>{{ $contratodep->nm_parentesco }}</td>
                        <td>{{ empty($contratodep->dt_nascimento) ? '' : $contratodep->dt_nascimento->format("d/m/Y") }}</td>
                        <td>{{ $contratodep->nr_cpf }}</td>
                        <td>{{ $contratodep->nr_rg }}</td>            
                        <td>{{ $contratodep->nr_carencia }}</td>            
                        <td>{{ $contratodep->nr_telefone1 }}</td>            
                        <td>{{ $contratodep->nr_telefone2 }}</td>            
                    </tr>
                    @endforeach
                    @endif
                    </tbody>
                    </table>                                                         
                </div>
            </fieldset>  
            <fieldset class="form-group">
            <legend class="label label-success"><span><h4>Financeiro</h4></span></legend>
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
                        <button type='button' id="btfinanceiro" class="btn btn-sm btn-primary pull-right" style="margin: 6px;"><i class='fa fa-plus'></i> Gerar Mensalidades</a></h3>
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
                            <th width="90px">Tp. Pagamento</th>
                            <th width="90px">Pagamento</th>
                            <th width="50px">$ Pago</th>
                            <th width="90px">Descrição</th>
                            <th width="50px">Status</th>
                            <th width="200px">Historico</th>
                        </tr>
                        </thead>
                        <tbody>  
                        @if (isset($ctarecebers))                     
                        @foreach ($ctarecebers as $ctareceber)
                        @php                        
                        if ($ctareceber->st_status === '0' && strtotime($ctareceber->dt_vencimento) < strtotime(date("Y-m-d"))) {
                                $rowclass = 'label label-danger';
                                $status = 'Atrasado';
                            }elseif ($ctareceber->st_status === '0' && strtotime($ctareceber->dt_vencimento) >= strtotime(date("Y-m-d"))) {
                                $rowclass = 'label-success';
                                $status = 'Em Dia';
                            }else{
                                $rowclass = 'label label-primary';
                                $status = 'Pago';                           
                            }    
                        @endphp            
                        <tr>
                            <td>{{ empty($ctareceber->dt_vencimento) ? '' : $ctareceber->dt_vencimento->format("d/m/Y") }}</td>
                            <td>{{ $ctareceber->nr_documento }}</td>
                            <td>{{ $ctareceber->st_parcela }}</td>
                            <td>{{ number_format($ctareceber->vl_apagar,2, '.', '')}}</td>
                            <td>{{ $ctareceber->nm_tppagamento }}</td>
                            <td>{{ empty($ctareceber->dt_pagamento) ? '' : $ctareceber->dt_pagamento->format("d/m/Y") }}</td>
                            <td>{{ number_format($ctareceber->vl_pago,2, '.', '')}}</td>
                            <td>{{ $ctareceber->ds_historico }}</td>
                            <td><span class="{{$rowclass}}">&nbsp;{{$status}}&nbsp;</span></td>
                            <td>{{ $ctareceber->nm_obs }}</td>                                    
                        </tr>
                        @endforeach                    
                        @endif
                        </tbody>
                        <tfoot>
                            <th>Total</th>
                            <th></th>
                            <th></th>
                            <th id="total">{{ isset($total) ? number_format($total,2, '.', '') : 0 }}</th>
                            <th></th>
                            <th></th>
                            <th>{{ isset($pago) ? number_format($pago,2, '.', '') : 0 }}</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tfoot>    
                    </table>                                           
                    </div>
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
$("#nm_pessoa").autocomplete({    
    source: "{{ URL::to('completecliente') }}",
    dataType: "json",
    minLength: 2,
    select: function (key, value) {                        
        $("#id_pessoa").val(value.item.id);	            
	},
});

var cont = 0;
function dependente()
{
    if(
       $('#nm_dependente').val()!="" && 
       $('#id_estcivil option:selected').val()!="" && 
       $('#st_sexo option:selected').val()!="" &&
       $('#id_parentesco option:selected').val()!="" &&
       $('#dt_nascimento').val()!="" &&
       $('#nr_telefone1').val()!="" &&
       $('#qt_dependente').val()!=""
      )        
    {
        if(parseInt(cont+1) > parseInt($('#qt_dependente').val()) && cont!=0) {
            bootbox.alert({               
                title: "Atenção",     
                message: "<b>Numero máximo de dependentes atinguido!</b>",
                size: 'small',
                backdrop: true,
            }); 
            return
        }
        
        var linha = 
        '<tr class="selected" id="linha'+cont+'">'+
            '<td><button type="button" onclick="apagadependente('+cont+');"class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></td>'+
            '<td><input type="hidden" name="cd_sequencia[]" value="'+parseInt(cont+1)+'">'+parseInt(cont+1)+'</td>'+                        
            '<td><input type="hidden" name="nm_dependente[]" value="'+$('#nm_dependente').val().toUpperCase()+'">'+$('#nm_dependente').val().toUpperCase()+'</td>'+            
            '<td><input type="hidden" name="id_estcivil[]" value="'+$('#id_estcivil option:selected').val().trim()+'">'+$('#id_estcivil option:selected').text().trim()+'</td>'+
            '<td><input type="hidden" name="st_sexo[]" value="'+$('#st_sexo option:selected').val().trim()+'">'+$('#st_sexo option:selected').text().trim()+'</td>'+
            '<td><input type="hidden" name="id_parentesco[]" value="'+$('#id_parentesco option:selected').val().trim()+'">'+$('#id_parentesco option:selected').text().trim()+'</td>'+
            '<td><input type="hidden" name="dt_nascimento[]" value="'+$('#dt_nascimento').val()+'">'+$('#dt_nascimento').val()+'</td>'+            
            '<td><input type="hidden" name="nr_cpf[]" value="'+$('#nr_cpf').val()+'">'+$('#nr_cpf').val()+'</td>'+
            '<td><input type="hidden" name="nr_rg[]" value="'+$('#nr_rg').val()+'">'+$('#nr_rg').val()+'</td>'+
            '<td><input type="hidden" name="nr_carenciadep[]" value="'+$('#nr_carencia').val()+'">'+$('#nr_carencia').val()+'</td>'+
            '<td><input type="hidden" name="nr_telefone1[]" value="'+$('#nr_telefone1').val()+'">'+$('#nr_telefone1').val()+'</td>'+
            '<td><input type="hidden" name="nr_telefone2[]" value="'+$('#nr_telefone2').val()+'">'+$('#nr_telefone2').val()+'</td>'+
        '</tr>'
        $('#tbdependente').append(linha);
        cont++;

        $('#nm_dependente').val('');
        $('#dt_nascimento').val('');
        $('#nr_cpf').val('');
        $('#nr_rg').val('');
        $('#nr_carencia').val('');
        $('#nr_telefone1').val('');
        $('#nr_telefone2').val('') 
    }else{        
        bootbox.alert({               
            title: "Atenção",     
            message: "<b>Campo(s) obrigatório(s) não preenchido(s)!</b>",
            size: 'small',
            backdrop: true,
        });
    }        
}

function apagadependente($id)
{
    $('#linha'+$id).remove();
}

var total = 0;
function financeiro()
{
    $('#tbfinanceiro tbody').empty();

    if(
       $('#qt_parcela').val()!="" && 
       $('#dt_privencimento').val()!="" &&
       $('#vl_plano').val()!="" &&
       $('#vl_plano').val()!=0
      )        
    {         
        moment.locale('pt');
        $('#finantotal').html('0.00');       
        var qt_parcela = parseInt($('#qt_parcela').val());        
        var dt_vencimento = moment($('#dt_privencimento').val(),'DD/MM/YYYY');  
        var ds_historico = '';
        var vl_apagar = parseFloat($('#vl_plano').val());
        var st_parcela = '';
        
        for(i=0; i<qt_parcela;i++) 
        {            
            st_parcela = (i+1)+'/'+qt_parcela;
            ds_historico = 'MÊS: '+moment(dt_vencimento).format('MMMM').toUpperCase()+
                       ' - ANO: '+moment(dt_vencimento).format('YYYY')+
                       ' - PAR: '+(i+1)+'/'+qt_parcela;

            var linha = 
            '<tr>'+            
                '<td><input type="hidden" name="dt_vencimento[]" value="'+dt_vencimento.format('DD/MM/YYYY')+'">'+dt_vencimento.format('DD/MM/YYYY')+'</td>'+            
                '<td><input type="hidden" name="nr_parcela[]" value="'+(i+1)+'">'+(i+1)+'</td>'+            
                '<td><input type="hidden" name="st_parcela[]" value="'+st_parcela+'">'+st_parcela+'</td>'+            
                '<td><input type="hidden" name="ds_historico[]" value="'+ds_historico+'">'+ds_historico+'</td>'+
                '<td><input type="hidden" name="vl_apagar[]" value="'+vl_apagar.toFixed(2)+'">'+vl_apagar.toFixed(2)+'</td>'+
                '<td><input type="hidden" name="dt_pagamento[]" value=""></td>'
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
    $("#btdependente").click(function() {
        dependente();
    });

    $("#btfinanceiro").click(function() {
        financeiro();
    });
    
    if($("#id_contrato").val()!='') {
        $('#financeiro').hide();
    }    
});    
</script>
@stop