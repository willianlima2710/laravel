@extends('adminlte::page')

@section('title', 'Obito')

@section('content_header')
@stop

@section('content')    

<!-- general form elements -->    
<div class='box box-primary box-solid'> 
    <div class='box-header with-border'>            
        <h3 class="box-title">Obito</h3>
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

    <form method="post" action="{{ $action ?? url('obito') }}">    
    {{csrf_field()}}
    @isset($obito) {{method_field('patch')}} @endisset

        <!-- /.box-header -->
        <div class="box-body">   
            <fieldset class="form-group">
                <input type="hidden" value="{{$obito->id_obito ?? ''}}" name="id_obito" id="id_obito" class="form-control">
                <div class="row">
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nr_declaracao" class="control-label">Nº Obito/Declaração</label>
                        <input type="text" class="form-control" value="{{$obito->nr_declaracao ?? ''}}" name="nr_declaracao" maxlength="20" autocomplete="off" required>
                    </div>       
                    <div class="form-group col-sm-2 mb-3">
                        <label for="dt_atendimento" class="control-label">Data do Atendimento</label>
                        <input type="text" class="form-control" value="{{empty($obito->dt_atendimento) ? date('d/m/Y') : $obito->dt_atendimento->format('d/m/Y') ?? ''}}" name="dt_atendimento" onkeypress="$(this).mask('00/00/0000')" autocomplete="off" required>
                    </div>   
                    <div class="form-group col-sm-2 mb-3">
                        <label for="hr_atendimento" class="control-label">Hora do Atendimento</label>
                        <input type="text" class="form-control" value="{{$obito->hr_atendimento ?? date('H:i:s') }}" name="hr_atendimento" onkeypress="$(this).mask('99:99:99')" autocomplete="off" required>
                    </div>   
                </div>
            </fieldset>
            <!-- Dados do falecido -->
            <fieldset class="form-group">
            <legend class="label label-success"><span><h4>Dados do Falecido</h4></span></legend>                
                <div class="row">
                    <div class="form-group col-sm-6 mb-1">
                        <label for="nm_dependente" class="control-label">Nome</label>
                        <input type="text" class="form-control" value="{{$obito->nm_dependente ?? ''}}" 
                         name="nm_dependente" id="nm_dependente" placeholder="Nome, CPF/CNPJ ou Contrato" autocomplete="off">                                                                             
                    </div>   
                    <input type="hidden" class="form-control" value="{{$obito->id_dependente ?? ''}}" name="id_dependente" id="id_dependente" required>
                    <input type="hidden" class="form-control" value="{{$obito->nr_contrato ?? ''}}" name="nr_contrato" id="nr_contrato" maxlength="10" autocomplete="off" required>                    
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nr_contrato_1" class="control-label">Nº Contrato</label>
                        <input type="text" class="form-control" value="{{$obito->nr_contrato ?? ''}}" name="nr_contrato_1" id="nr_contrato_1" maxlength="10" autocomplete="off" disabled>
                    </div>       
                    <div class="form-group col-sm-2 mb-3">
                        <label for="dt_falecimento" class="control-label">Data do Falecimento</label>
                        <input type="text" class="form-control" value="{{empty($obito->dt_falecimento) ? '' : $obito->dt_falecimento->format('d/m/Y') ?? ''}}" name="dt_falecimento" onkeypress="$(this).mask('00/00/0000')" autocomplete="off">
                    </div>   
                    <div class="form-group col-sm-2 mb-3">
                        <label for="hr_falecimento" class="control-label">Hora do Falecimento</label>
                        <input type="text" class="form-control" value="{{$obito->hr_falecimento ?? ''}}" name="hr_falecimento" onkeypress="$(this).mask('99:99:99')" autocomplete="off">
                    </div>                       
                </div>        
                <div class="row">
                    <div class="form-group col-sm-2 mb-3">
                        <label for="dt_nascimento" class="control-label">Nascimento</label>
                        <input type="text" class="form-control" value="{{empty($obito->dt_nascimento) ? '' : $obito->dt_nascimento->format('d/m/Y') ?? ''}}" name="dt_nascimento" onkeypress="$(this).mask('00/00/0000')" autocomplete="off">
                    </div> 
                    <div class="form-group col-sm-2 mb-1">
                        <label for="st_sexo" class="control-label">Sexo</label>
                        <select class="form-control" name="st_sexo">
                            <option value=""></option>
                            @foreach($sexos as $sexo)
                                @if (isset($obito))
                                    @if($sexo['st_sexo']==$obito->st_sexo)
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
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nm_cor" class="control-label">Cor</label>
                        <input type="text" class="form-control" value="{{$obito->nm_cor ?? ''}}" name="nm_cor" maxlength="100" autocomplete="off">                    
                    </div>                         
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nr_cpf" class="control-label">CPF</label>
                        <input type="text" class="form-control" value="{{$obito->nr_cpfcnpj ?? ''}}" name="nr_cpfcnpj" onkeypress="$(this).mask('000.000.000-00');" autocomplete="off">                    
                    </div>                         
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nr_rg" class="control-label">RG</label>
                        <input type="text" class="form-control" value="{{$obito->nr_rgie ?? ''}}" name="nr_rgie" maxlength="30" autocomplete="off">     
                    </div>    
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nm_profissao" class="control-label">Profissão</label>
                        <input type="text" class="form-control" value="{{$obito->nm_profissao ?? ''}}" name="nm_profissao" maxlength="100" autocomplete="off">                    
                    </div>                         
                </div>
                <div class="row">
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nr_telefone1" class="control-label">1º Telefone</label>
                        <input type="text" class="form-control" value="{{$obito->nr_telefone1 ?? ''}}" name='nr_telefone1' onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off">     
                    </div>
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nr_telefone2" class="control-label">2º Telefone</label>
                        <input type="text" class="form-control" value="{{$obito->nr_telefone2 ?? ''}}" name='nr_telefone2' onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off">     
                    </div>
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nm_nacionalidade" class="control-label">Nacionalidade</label>
                        <input type="text" class="form-control" value="{{$obito->nm_nacionalidade ?? ''}}" name="nm_nacionalidade" maxlength="100" autocomplete="off">                    
                    </div>                         
                    <div class="form-group col-sm-3 mb-3">
                        <label for="nm_naturalidade" class="control-label">Naturalidade</label>
                        <input type="text" class="form-control" value="{{$obito->nm_naturalidade ?? ''}}" name="nm_naturalidade" maxlength="100" autocomplete="off">                    
                    </div>                         
                    <div class="form-group col-sm-3 mb-1">
                        <label for="id_estcivil" class="control-label">Estado Civil</label>
                        <select class="form-control" name="id_estcivil">
                            <option value=""></option>
                            @foreach($estcivils as $estcivil)
                                @if (isset($obito))
                                    @if($estcivil->id_estcivil==$obito->id_estcivil)
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
                </div>
                <div class="row">
                    <div class="form-group col-sm-5 mb-3">
                        <label for="nm_endereco" class="control-label">Endereço</label>
                        <input type="text" class="form-control" value="{{$obito->nm_endereco ?? ''}}" name='nm_endereco' maxlength="100" autocomplete="off">     
                    </div>                            
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nr_numender" class="control-label">Numero</label>
                        <input type="text" class="form-control" value="{{$obito->nr_numender ?? ''}}" name='nr_numender' maxlength="20" autocomplete="off">
                    </div>
                    <div class="form-group col-sm-5 mb-3">
                        <label for="nm_complender" class="control-label">Complemento</label>
                        <input type="text" class="form-control" value="{{$obito->nm_complender ?? ''}}" name='nm_complender' maxlength="100" autocomplete="off">     
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_bairro" class="control-label">Bairro</label>
                        <input type="text" class="form-control" value="{{$obito->nm_bairro ?? ''}}" name='nm_bairro' maxlength="60" autocomplete="off">     
                    </div>                            
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_cidade" class="control-label">Cidade</label>
                        <input type="text" class="form-control" value="{{$obito->nm_cidade ?? ''}}" name='nm_cidade' maxlength="60" autocomplete="off">
                    </div>    
                    <div class="form-group col-sm-4 mb-1">
                        <label for="nm_estado" class="control-label">Estado</label>
                        <select class="form-control" name="nm_estado">
                            <option value=""></option>
                            @foreach($estados as $estado)
                                @if (isset($obito))
                                    @if($estado->nm_sigla==$obito->nm_estado)
                                    <option value="{{$estado->nm_sigla}}" selected>
                                    {{$estado->nm_estado}}
                                    </option>
                                    @else
                                    <option value="{{$estado->nm_sigla}}">
                                    {{$estado->nm_estado}}
                                    </option>
                                    @endif	         
                                @else                                    
                                    <option value="{{$estado->nm_sigla}}">
                                    {{$estado->nm_estado}}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>                        
                </div> 
                <div class="row">
                    <div class="form-group col-sm-2 mb-3">                                    
                        <label for="st_bens" class="control-label">Bens ?</label>
                        @if (isset($obito))                        
                            @if($obito->st_bens===1)
                                <input type="checkbox" class="checkbox" value="{{$obito->st_bens ?? ''}}" checked name='st_bens'>
                            @else 
                                <input type="checkbox" class="checkbox" value="{{$obito->st_bens ?? ''}}" name='st_bens'>
                            @endif 
                        @else
                            <input type="checkbox" class="checkbox" value="{{$obito->st_bens ?? ''}}" name='st_bens'>
                        @endif                                
                    </div>                           
                    <div class="form-group col-sm-2 mb-3">                                    
                        <label for="st_testamento" class="control-label">Testamento ?</label>
                        @if (isset($obito))                        
                            @if($obito->st_testamento===1)
                                <input type="checkbox" class="checkbox" value="{{$obito->st_testamento ?? ''}}" checked name='st_testamento'>
                            @else 
                                <input type="checkbox" class="checkbox" value="{{$obito->st_testamento ?? ''}}" name='st_testamento'>
                            @endif 
                        @else
                            <input type="checkbox" class="checkbox" value="{{$obito->st_testamento ?? ''}}" name='st_testamento'>
                        @endif                                
                    </div>                           
                    <div class="form-group col-sm-2 mb-3">                                    
                        <label for="st_reservista" class="control-label">Reservista ?</label>
                        @if (isset($obito))                        
                            @if($obito->st_reservista===1)
                                <input type="checkbox" class="checkbox" value="{{$obito->st_reservista ?? ''}}" checked name='st_reservista'>
                            @else 
                                <input type="checkbox" class="checkbox" value="{{$obito->st_reservista ?? ''}}" name='st_reservista'>
                            @endif 
                        @else
                            <input type="checkbox" class="checkbox" value="{{$obito->st_reservista ?? ''}}" name='st_reservista'>
                        @endif                                
                    </div>               
                    <div class="form-group col-sm-2 mb-3">                                    
                        <label for="st_eleitor" class="control-label">Eleitor ?</label>
                        @if (isset($obito))                        
                            @if($obito->st_eleitor===1)
                                <input type="checkbox" class="checkbox" value="{{$obito->st_eleitor ?? ''}}" checked name='st_eleitor'>
                            @else 
                                <input type="checkbox" class="checkbox" value="{{$obito->st_eleitor ?? ''}}" name='st_eleitor'>
                            @endif 
                        @else
                            <input type="checkbox" class="checkbox" value="{{$obito->st_eleitor ?? ''}}" name='st_eleitor'>
                        @endif                                
                    </div>                                            
                </div>
                <div class="row">
                    <div class="form-group col-sm-6 mb-3">
                        <label for="nm_pai" class="control-label">Pai</label>
                        <input type="text" class="form-control" value="{{$obito->nm_pai ?? ''}}" name='nm_pai' maxlength="100" autocomplete="off">     
                    </div>
                    <div class="form-group col-sm-6 mb-3">
                        <label for="nm_mae" class="control-label">Mãe</label>
                        <input type="text" class="form-control" value="{{$obito->nm_mae ?? ''}}" name='nm_mae' maxlength="100" autocomplete="off">     
                    </div>
                </div>
            </fieldset>
            <!-- Dados do falecimeno -->
            <fieldset class="form-group">
            <legend class="label label-success"><span><h4>Dados do Falecimento</h4></span></legend>                
                <div class="row">
                    <div class="form-group col-sm-8 mb-3">
                        <label for="ds_falecimento" class="control-label">Local de Falecimento</label>
                        <input type="text" class="form-control" value="{{$obito->ds_falecimento ?? ''}}" name='ds_falecimento' maxlength="100" autocomplete="off">     
                    </div>
                    <div class="form-group col-sm-2 mb-3">
                        <label for="dt_sepultamento" class="control-label">Data do Sepultamento</label>
                        <input type="text" class="form-control" value="{{empty($obito->dt_sepultamento) ? '' : $obito->dt_sepultamento->format('d/m/Y') ?? ''}}" name='dt_sepultamento' onkeypress="$(this).mask('00/00/0000')" autocomplete="off">
                    </div>    
                    <div class="form-group col-sm-2 mb-3">
                        <label for="hr_sepultamento" class="control-label">Hora do Sepultamento</label>
                        <input type="text" class="form-control" value="{{$obito->hr_sepultamento ?? ''}}" name='hr_sepultamento' onkeypress="$(this).mask('99:99:99')" autocomplete="off">
                    </div>    
                </div>
                <div class="row">
                    <div class="form-group col-sm-12 mb-3">
                        <label for="ds_velorio" class="control-label">Endereço do velório</label>
                        <input type="text" class="form-control" value="{{$obito->ds_velorio ?? ''}}" name='ds_velorio' maxlength="100" autocomplete="off">     
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-4 mb-1">
                        <label for="id_cemiterio" class="control-label">Cemitério/Crematório</label>
                        <select class="form-control" name="id_cemiterio">
                            <option value=""></option>
                            @foreach($cemiterios as $cemiterio)
                                @if (isset($obito))
                                    @if($cemiterio->id_cemiterio==$obito->id_cemiterio)
                                    <option value="{{$cemiterio->id_cemiterio}}" selected>
                                    {{$cemiterio->nm_cemiterio}}
                                    </option>
                                    @else
                                    <option value="{{$cemiterio->id_cemiterio}}">
                                    {{$cemiterio->nm_cemiterio}}
                                    </option>
                                    @endif	         
                                @else                                    
                                    <option value="{{$cemiterio->id_cemiterio}}">
                                    {{$cemiterio->nm_cemiterio}}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>       
                    <div class="form-group col-sm-2 mb-1">
                        <label for="id_tppagamentocm" class="control-label">Tipo Pagamento</label>
                        <select class="form-control" name="id_tppagamentocm">
                            <option value=""></option>
                            @foreach($tppagamentoscm as $tppagamentocm)
                                @if (isset($obito))
                                    @if($tppagamentocm->id_tppagamento==$obito->id_tppagamentocm)
                                    <option value="{{$tppagamentocm->id_tppagamento}}" selected>
                                    {{$tppagamentocm->nm_tppagamento}}
                                    </option>
                                    @else
                                    <option value="{{$tppagamentocm->id_tppagamento}}">
                                    {{$tppagamentocm->nm_tppagamento}}
                                    </option>
                                    @endif	         
                                @else                                    
                                    <option value="{{$tppagamentocm->id_tppagamento}}">
                                    {{$tppagamentocm->nm_tppagamento}}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>    
                    <div class="form-group col-sm-2 mb-1">
                        <label for="vl_despesacm" class="control-label">$ Despesa</label>
                        <input type="text" class="form-control" value="{{$obito->vl_despesacm ?? ''}}" name="vl_despesacm" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off">                  
                    </div> 
                    <div class="form-group col-sm-4 mb-1">
                        <label for="nr_chequecm" class="control-label">Nº Cheque</label>
                        <input type="text" class="form-control" value="{{$obito->nr_chequecm ?? ''}}" name="nr_chequecm" maxlength="20" autocomplete="off">     
                    </div>       
                </div>
                <div class="row">
                    <div class="form-group col-sm-4 mb-3">
                    <label for="id_funeraria" class="control-label">Funerária</label>
                        <select class="form-control" name="id_funeraria">
                            <option value=""></option>
                            @foreach($funerarias as $funeraria)
                                @if (isset($obito))
                                    @if($funeraria->id_funeraria==$obito->id_funeraria)
                                    <option value="{{$funeraria->id_funeraria}}" selected>
                                    {{$funeraria->nm_funeraria}}
                                    </option>
                                    @else
                                    <option value="{{$funeraria->id_funeraria}}">
                                    {{$funeraria->nm_funeraria}}
                                    </option>
                                    @endif	         
                                @else                                    
                                    <option value="{{$funeraria->id_funeraria}}">
                                    {{$funeraria->nm_funeraria}}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>                 
                    <div class="form-group col-sm-2 mb-1">
                        <label for="id_tppagamentofn" class="control-label">Tipo Pagamento</label>
                        <select class="form-control" name="id_tppagamentofn">
                            <option value=""></option>
                            @foreach($tppagamentosfn as $tppagamentofn)
                                @if (isset($obito))
                                    @if($tppagamentofn->id_tppagamento==$obito->id_tppagamentofn)
                                    <option value="{{$tppagamentofn->id_tppagamento}}" selected>
                                    {{$tppagamentofn->nm_tppagamento}}
                                    </option>
                                    @else
                                    <option value="{{$tppagamentofn->id_tppagamento}}">
                                    {{$tppagamentofn->nm_tppagamento}}
                                    </option>
                                    @endif	         
                                @else                                    
                                    <option value="{{$tppagamentofn->id_tppagamento}}">
                                    {{$tppagamentofn->nm_tppagamento}}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>    
                    <div class="form-group col-sm-2 mb-1">
                        <label for="vl_despesafn" class="control-label">$ Despesa</label>
                        <input type="text" class="form-control" value="{{$obito->vl_despesafn ?? ''}}" name="vl_despesafn" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off">                  
                    </div> 
                    <div class="form-group col-sm-4 mb-1">
                        <label for="nr_chequefn" class="control-label">Nº Cheque</label>
                        <input type="text" class="form-control" value="{{$obito->nr_chequefn ?? ''}}" name="nr_chequefn" maxlength="20" autocomplete="off">     
                    </div>        
                </div>
                <div class="row">
                    <div class="form-group col-sm-4 mb-1">
                        <label for="id_capela" class="control-label">Capela</label>
                        <select class="form-control" name="id_capela">
                            <option value=""></option>
                            @foreach($capelas as $capela)
                                @if (isset($obito))
                                    @if($capela->id_capela==$obito->id_capela)
                                    <option value="{{$capela->id_capela}}" selected>
                                    {{$capela->nm_capela}}
                                    </option>
                                    @else
                                    <option value="{{$capela->id_capela}}">
                                    {{$capela->nm_capela}}
                                    </option>
                                    @endif	         
                                @else                                    
                                    <option value="{{$capela->id_capela}}">
                                    {{$capela->nm_capela}}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>    
                    <div class="form-group col-sm-2 mb-1">
                        <label for="id_tppagamentocp" class="control-label">Tipo Pagamento</label>
                        <select class="form-control" name="id_tppagamentocp">
                            <option value=""></option>
                            @foreach($tppagamentoscp as $tppagamentocp)
                                @if (isset($obito))
                                    @if($tppagamentocp->id_tppagamento==$obito->id_tppagamentocp)
                                    <option value="{{$tppagamentocp->id_tppagamento}}" selected>
                                    {{$tppagamentocp->nm_tppagamento}}
                                    </option>
                                    @else
                                    <option value="{{$tppagamentocp->id_tppagamento}}">
                                    {{$tppagamentocp->nm_tppagamento}}
                                    </option>
                                    @endif	         
                                @else                                    
                                    <option value="{{$tppagamentocp->id_tppagamento}}">
                                    {{$tppagamentocp->nm_tppagamento}}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>    
                    <div class="form-group col-sm-2 mb-1">
                        <label for="vl_despesacp" class="control-label">$ Despesa</label>
                        <input type="text" class="form-control" value="{{$obito->vl_despesacp ?? ''}}" name="vl_despesacp" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off">                  
                    </div> 
                    <div class="form-group col-sm-4 mb-1">
                        <label for="nr_chequecp" class="control-label">Nº Cheque</label>
                        <input type="text" class="form-control" value="{{$obito->nr_chequecp ?? ''}}" name="nr_chequecp" maxlength="20" autocomplete="off">     
                    </div>        
                </div>
                <div class="row">
                    <div class="form-group col-sm-6 mb-3">
                        <label for="nm_medico" class="control-label">Médico</label>
                        <input type="text" class="form-control" value="{{$obito->nm_medico ?? ''}}" name='nm_medico' maxlength="100" autocomplete="off">     
                    </div>
                    <div class="form-group col-sm-6 mb-3">
                        <label for="nr_crm" class="control-label">Nº CRM</label>
                        <input type="text" class="form-control" value="{{$obito->nr_crm ?? ''}}" name='nr_crm' maxlength="20" autocomplete="off">     
                    </div>
                    <div class="form-group col-sm-12 mb-3">
                        <label for="nm_medico" class="control-label">Causa da Morte</label>
                        <input type="text" class="form-control" value="{{$obito->nm_causamorte ?? ''}}" name='nm_causamorte' maxlength="100" autocomplete="off">     
                    </div>
                </div>
            </fieldset>
            <!-- Dados complementares -->
            <fieldset class="form-group">
            <legend class="label label-success"><span><h4>Dados Complementares</h4></span></legend>               
                <div class="row">
                    <div class="form-group col-sm-2 mb-3">                                    
                        <label for="st_declaobito" class="control-label">Declaração de Óbito ?</label>
                        @if (isset($obito))                        
                            @if($obito->st_declaobito===1)
                                <input type="checkbox" class="checkbox" value="{{$obito->st_declaobito ?? ''}}" checked name='st_declaobito' >
                            @else 
                                <input type="checkbox" class="checkbox" value="{{$obito->st_declaobito ?? ''}}" name='st_declaobito'>
                            @endif 
                        @else
                            <input type="checkbox" class="checkbox" value="{{$obito->st_declaobito ?? ''}}" name='st_declaobito'>
                        @endif                                
                    </div>                           
                    <div class="form-group col-sm-2 mb-3">                                    
                        <label for="st_tanatopraxia" class="control-label">Autorização Tanatopraxia ?</label>
                        @if (isset($obito))                        
                            @if($obito->st_tanatopraxia===1)
                                <input type="checkbox" class="checkbox" value="{{$obito->st_tanatopraxia ?? ''}}" checked name='st_tanatopraxia'>
                            @else 
                                <input type="checkbox" class="checkbox" value="{{$obito->st_tanatopraxia ?? ''}}" name='st_tanatopraxia'>
                            @endif 
                        @else
                            <input type="checkbox" class="checkbox" value="{{$obito->st_tanatopraxia ?? ''}}" name='st_tanatopraxia'>
                        @endif                                
                    </div>                           
                    <div class="form-group col-sm-2 mb-3">                                    
                        <label for="st_translado" class="control-label">Translado de cadáver ?</label>
                        @if (isset($obito))                        
                            @if($obito->st_translado===1)
                                <input type="checkbox" class="checkbox" value="{{$obito->st_translado ?? ''}}" checked name='st_translado'>
                            @else 
                                <input type="checkbox" class="checkbox" value="{{$obito->st_translado ?? ''}}" name='st_translado'>
                            @endif 
                        @else
                            <input type="checkbox" class="checkbox" value="{{$obito->st_translado ?? ''}}" name='st_translado'>
                        @endif                                
                    </div>               
                    <div class="form-group col-sm-2 mb-3">                                    
                        <label for="st_notafaleci" class="control-label">Nota falecimento/convite ?</label>
                        @if (isset($obito))                        
                            @if($obito->st_notafaleci===1)
                                <input type="checkbox" class="checkbox" value="{{$obito->st_notafaleci ?? ''}}" checked name='st_notafaleci'>
                            @else 
                                <input type="checkbox" class="checkbox" value="{{$obito->st_notafaleci ?? ''}}" name='st_notafaleci'>
                            @endif 
                        @else
                            <input type="checkbox" class="checkbox" value="{{$obito->st_notafaleci ?? ''}}" name='st_notafaleci'>
                        @endif                                
                    </div>                                            
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="nm_obs" class="control-label">Observação</label>
                        <textarea class="form-control" rows="5" name='nm_obs'>{{$obito->nm_obs ?? ''}}</textarea>
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
$("#nm_dependente").autocomplete({    
    source: "{{ URL::to('completecontrdep') }}",
    dataType: "json",
    minLength: 2,
    focus: function( event, ui ) {        
        $( "#nm_dependente" ).val( ui.item.label );
        return false;
    },    
    select: function( event, ui ) {        
        $("#id_dependente").val(ui.item.id);	                    
        $("#nm_dependente").val(ui.item.label);	
        $("#nr_contrato").val(ui.item.contrato);	
        $("#nr_contrato_1").val(ui.item.contrato);	
        return false;
	},
}).autocomplete( "instance" )._renderItem = function( ul, item ) {    
    return $( "<li>" )    
        .append( "<div>" + item.label + " - <b>Contrato: " + item.contrato + "</b></div>" )
        .appendTo( ul );
};    
</script>

@stop