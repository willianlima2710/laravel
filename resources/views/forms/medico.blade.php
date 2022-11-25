@extends('adminlte::page')

@section('title', 'Médicos')

@section('content_header')
@stop

@section('content')    

<!-- general form elements -->    
<div class='box box-primary box-solid'> 
    <div class='box-header with-border'>            
        <h3 class="box-title">Médicos</h3>
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

    <form method="post" action="{{ $action ?? url('medico') }}">    
    {{csrf_field()}}
    @isset($medico) {{method_field('patch')}} @endisset

        <!-- /.box-header -->
        <div class="box-body">   
            <fieldset class="form-group">                
                <input type="hidden" value="{{$medico->id_medico ?? ''}}" name="id_medico" class="form-control">
                <div class="row">
                    <div class="form-group col-sm-8 mb-3">
                        <label for="nm_medico" class="control-label">Nome</label>
                        <input type="text" class="form-control" value="{{$medico->nm_medico ?? ''}}" name="nm_medico" maxlength="100" autocomplete="off" required>
                    </div>             
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nr_crm" class="control-label">CRM</label>
                        <input type="text" class="form-control" value="{{$medico->nr_crm ?? ''}}" name="nr_crm" maxlength="10" autocomplete="off" required>                    
                    </div>               
                </div>   
                <div class="row">
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_especialidade" class="control-label">Especidalidade</label>
                        <input type="text" class="form-control" value="{{$medico->nm_especialidade ?? ''}}" name="nm_especialidade" maxlength="100" autocomplete="off">
                    </div>                        
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_profissional" class="control-label">Profissional</label>
                        <input type="text" class="form-control" value="{{$medico->nm_profissional ?? ''}}" name="nm_profissional" maxlength="60" autocomplete="off">     
                    </div>    
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_clinica" class="control-label">Clinica</label>
                        <input type="text" class="form-control" value="{{$medico->nm_clinica ?? ''}}" name="nm_clinica" maxlength="60" autocomplete="off">     
                    </div>
                </div>    
                <div class="row">
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nr_cep" class="control-label">CEP</label>
                        <input type="text" class="form-control" value="{{$medico->nr_cep ?? ''}}" name="nr_cep" onkeypress="$(this).mask('00000-000')" autocomplete="off">
                    </div>    
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_endereco" class="control-label">Endereço</label>
                        <input type="text" class="form-control" value="{{$medico->nm_endereco ?? ''}}" name="nm_endereco" maxlength="100" autocomplete="off">     
                    </div>                            
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nr_numender" class="control-label">Numero</label>
                        <input type="text" class="form-control" value="{{$medico->nr_numender ?? ''}}" name="nr_numender" maxlength="20" autocomplete="off">
                    </div>    
                </div> 
                <div class="row">
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_bairro" class="control-label">Bairro</label>
                        <input type="text" class="form-control" value="{{$medico->nm_bairro ?? ''}}" name="nm_bairro" maxlength="60" autocomplete="off">     
                    </div>                            
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_cidade" class="control-label">Cidade</label>
                        <input type="text" class="form-control" value="{{$medico->nm_cidade ?? ''}}"  name="nm_cidade" maxlength="60" autocomplete="off">
                    </div>    
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_estado" class="control-label">Estado</label>
                        <select class="form-control" name="nm_estado">
                            <option value=""></option>
                            @foreach($estado as $est)
                                @if (isset($medico))
                                    @if($est->nm_sigla==$medico->nm_estado)
                                    <option value="{{$est->nm_sigla}}" selected>
                                    {{$est->nm_estado}}
                                    </option>
                                    @else
                                    <option value="{{$est->nm_sigla}}">
                                    {{$est->nm_estado}}
                                    </option>
                                    @endif	         
                                @else                                    
                                    <option value="{{$est->nm_sigla}}">
                                    {{$est->nm_estado}}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>    
                </div> 
                <div class="row">
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_telefone1" class="control-label">1º Telefone</label>
                        <input type="text" class="form-control" value="{{$medico->nm_telefone1 ?? ''}}" name="nm_telefone1" onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off">     
                    </div>                            
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_telefone2" class="control-label">2º Telefone</label>
                        <input type="text" class="form-control" value="{{$medico->nm_telefone2 ?? ''}}" name="nm_telefone2" onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off">
                    </div>    
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_telefone3" class="control-label">3º Telefone</label>
                        <input type="text" class="form-control" value="{{$medico->nm_telefone3 ?? ''}}" name="nm_telefone3" onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off">
                    </div>    
                </div>                     
            </fieldset>    
            <!-- Dados complementares -->
            <fieldset class="form-group">
            <legend>Complementares</legend>
                <div class="row">
                    <div class="form-group col-sm-4 mb-3">
                        <label for="vl_particular" class="control-label">$ Particular</label>
                        <input type="text" class="form-control" value="{{$medico->vl_particular ?? ''}}" name="vl_particular" onkeypress="$(this).mask('999.990,00')" autocomplete="off">     
                    </div>
                    <div class="form-group col-sm-4 mb-3">
                        <label for="vl_convenio" class="control-label">R$ Convenio</label>
                        <input type="text" class="form-control" value="{{$medico->vl_convenio ?? ''}}" name="vl_convenio" onkeypress="$(this).mask('999.990,00')" autocomplete="off">     
                    </div>                            
                </div> 
                <div class="row">
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_plano1" class="control-label">1º Plano</label>
                        <input type="text" class="form-control" value="{{$medico->nm_plano1 ?? ''}}" name="nm_plano1" maxlength="60" autocomplete="off">     
                    </div>                            
                    <div class="form-group col-sm-4 mb-3">
                        <label for="vl_desconto1" class="control-label">% Desconto</label>
                        <input type="text" class="form-control" value="{{$medico->vl_desconto1 ?? ''}}" name="vl_desconto1" onkeypress="$(this).mask('999.990,00')" autocomplete="off">     
                    </div>
                </div> 
                <div class="row">
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_plano2" class="control-label">2º Plano</label>
                        <input type="text" class="form-control" value="{{$medico->nm_plano2 ?? ''}}" name="nm_plano2" maxlength="60" autocomplete="off">     
                    </div>                            
                    <div class="form-group col-sm-4 mb-3">
                        <label for="vl_desconto2" class="control-label">% Desconto</label>
                        <input type="text" class="form-control" value="{{$medico->vl_desconto2 ?? ''}}" name="vl_desconto2" onkeypress="$(this).mask('999.990,00')" autocomplete="off">     
                    </div>
                </div> 
                <div class="row">
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_plano3" class="control-label">3º Plano</label>
                        <input type="text" class="form-control" value="{{$medico->nm_plano3 ?? ''}}"  name="nm_plano3" maxlength="60" autocomplete="off">     
                    </div>                            
                    <div class="form-group col-sm-4 mb-3">
                        <label for="vl_desconto3" class="control-label">% Desconto</label>
                        <input type="text" class="form-control" value="{{$medico->vl_desconto3 ?? ''}}" name="vl_desconto3" onkeypress="$(this).mask('999.990,00')" autocomplete="off">     
                    </div>
                </div> 
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="nm_obs" class="control-label">Observação</label>
                        <textarea class="form-control" name="nm_obs" rows="5">{{$medico->nm_obs ?? ''}}</textarea>
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