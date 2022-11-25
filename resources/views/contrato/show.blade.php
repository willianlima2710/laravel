@extends('adminlte::page')

@section('title', 'Contrato')

@section('content_header')
@stop

@section('content')
<!-- topo -->
<div class="row">
    <div class="col-sm-12 margin-tb">
        <div class="pull-left">
            <h3><i class="ion ion-clipboard"></i> Contrato</h3>
        </div>
        <div class="pull-right">            
            <a href="{{ url()->previous() }}" class="btn btn-primary" style="margin: 10px;">Voltar</a>
        </div>
    </div>
</div>

<!-- /.box-header -->
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">Dados</h3>
    </div>    
    <div class="box-body">   
        <fieldset class="form-group">        
            <input type="hidden"  value="{{$contrato->id_contrato ?? ''}}" name="id_contrato" class="form-control">
            <div class="row">
                <div class="form-group col-sm-12 mb-1">
                    <label for="nm_pessoa" class="control-label">Cliente</label>
                    <input type="text" class="form-control" value="{{$contrato->nm_pessoa ?? ''}}" 
                        name="nm_pessoa" id="nm_pessoa" autocomplete="off" placeholder="Nome ou CPF" disabled >                                                                             
                </div>   
                <input type="hidden" class="form-control" value="{{$contrato->id_pessoa ?? ''}}" name="id_pessoa" id="id_pessoa" required>                    
            </div>        
            <div class="row">
                <div class="form-group col-sm-3 mb-1">
                    <label for="id_plano" class="control-label">Plano</label>
                    <select class="form-control" name="id_plano" disabled>
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
                    <select class="form-control" name="id_vendedor" disabled>
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
                    <input type="text" class="form-control" value="{{$contrato->nr_contrato ?? ''}}" name="nr_contrato" maxlength="10" autocomplete="off" disabled>
                </div>       
                <div class="form-group col-sm-2 mb-1">
                    <label for="st_local" class="control-label">Tipo de Cobrança</label>
                    <select class="form-control" name="st_local" disabled>
                        <option value=""></option>
                        @foreach($locals as $local)
                            @if (isset($contrato))
                                @if($local['st_local']==$contrato->st_local)
                                <option value="{{$local['st_local']}}" selected >
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
                    <input type="text" class="form-control" value="{{empty($contrato->dt_inccontrato) ? date('d/m/Y') : $contrato->dt_inccontrato->format('d/m/Y') ?? ''}}" name="dt_inccontrato" onkeypress="$(this).mask('00/00/0000')" autocomplete="off" disabled>
                </div>   
                <div class="form-group col-sm-2 mb-3">
                    <label for="nr_carencia" class="control-label text-danger">Carência</label>
                    <input type="text" class="form-control" value="{{$contrato->nr_carencia ?? ''}}" name="nr_carencia" maxlength="10" autocomplete="off" disabled>
                </div>  
                <div class="form-group col-sm-2 mb-3">
                    <label for="dt_termcarencia" class="control-label text-danger">Térm Carência</label>
                    <input type="text" class="form-control" value="{{empty($contrato->dt_termcarencia) ? '' : $contrato->dt_termcarencia->format('d/m/Y') ?? ''}}" name="dt_termcarencia" disabled="true" onkeypress="$(this).mask('00/00/0000')" autocomplete="off" disabled>
                </div>   
                <div class="form-group col-sm-2 mb-3">
                    <label for="km_plano" class="control-label">Km Plano</label>
                    <input type="text" class="form-control" value="{{$contrato->km_plano ?? ''}}" name="km_plano" maxlength="10" autocomplete="off" disabled>
                </div>   
                <div class="form-group col-sm-2 mb-3">
                    <label for="vl_plano" class="control-label">$ Valor</label>
                    <input type="text" class="form-control" value="{{$contrato->vl_plano ?? ''}}" name="vl_plano" id="vl_plano" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off" disabled>                    
                </div>                        
                <div class="form-group col-sm-2 mb-3">
                    <label for="qt_dependente" class="control-label">Qt Dependentes</label>
                    <input type="number" class="form-control" value="{{$contrato->qt_dependente ?? '1'}}" name="qt_dependente" id="qt_dependente" defaultValue="1" min="1" max="99" disabled>
                </div>    
            </div>
            <div class="row">
                <div class="form-group col-sm-2 mb-1">
                    <label for="st_cobranca" class="control-label">Cobrança por</label>
                    <select class="form-control" name="st_cobranca" disabled>
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
                    <input type="text" class="form-control" value="{{$contrato->vl_adicional ?? ''}}" name="vl_adicional" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off" disabled>                    
                </div>            
                <div class="form-group col-sm-2 mb-3">
                    <label for="vl_total" class="control-label text-danger">Valor Total</label>
                    <input type="text" class="form-control" value="{{$contrato->vl_total ?? ''}}" name="vl_total" onkeypress="$(this).mask('####0.00', {reverse: true})" disabled="true" autocomplete="off" disabled>                    
                </div>                        
                <div class="form-group col-sm-2 mb-3">
                    <label for="dt_fimcontrato" class="control-label">Data Termino</label>
                    <input type="text" class="form-control" value="{{empty($contrato->dt_fimcontrato) ? '' : $contrato->dt_fimcontrato->format('d/m/Y') ?? ''}}" name="dt_fimcontrato" onkeypress="$(this).mask('00/00/0000')" autocomplete="off" disabled>
                </div>      
                <div class="form-group col-sm-2 mb-3">
                    <label for="dt_valcarterinha" class="control-label text-primary">Validade Carterinha</label>
                    <input type="text" class="form-control" value="{{empty($contrato->dt_valcarterinha) ? '' : $contrato->dt_valcarterinha->format('d/m/Y') ?? ''}}" name="dt_valcarterinha" onkeypress="$(this).mask('00/00/0000')" autocomplete="off" disabled>
                </div>
                <div class="form-group col-sm-2 mb-3">
                    <label for="dt_cancontrato" class="control-label text-danger">Data Cancelamento</label>
                    <input type="text" class="form-control" value="{{empty($contrato->dt_cancontrato) ? '' : $contrato->dt_cancontrato->format('d/m/Y') ?? ''}}" name="dt_cancontrato" disabled="true" onkeypress="$(this).mask('00/00/0000')" autocomplete="off" disabled>
                </div> 
            </div>
            <div class="row">
                <div class="form-group col-sm-12">
                    <label for="nm_obs" class="control-label">Observação</label>
                    <textarea class="form-control" name="nm_obs" rows="5" disabled>{{$contrato->nm_obs ?? ''}}</textarea>
                </div>                            
            </div> 
        </fieldset>        
        <fieldset class="form-group">
        <legend>Dependentes</legend>
            <div class="box-body table-responsive no-padding" style="width:100%;height:300px;overflow-y: scroll;">    
                <table id="tbdependente" class="table table-striped table-bordered table-condensed table-hover">
                <thead class="bg-info">
                <tr>
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
                @foreach ($contratodeps as $contratodep)
                <tr>
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
                </table>                                           
            </div>
        </fieldset>  
        <fieldset class="form-group">
        <legend>Financeiro</legend>          
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
                    </tbody>   
                    <tfoot>
                        <th>Total</th>
                        <th></th>
                        <th></th>
                        <th>{{ number_format($total,2, '.', '') }}</th>
                        <th></th>
                        <th></th>
                        <th>{{ number_format($pago,2, '.', '') }}</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tfoot>    
                </table>                                           
            </div>        
        </fieldset>             
    </div>   
</div>    
@endsection

@section('js')
@stop

