@extends('adminlte::page')

@section('title', 'Funcionário')

@section('content_header')
@stop

@section('content')    

<!-- general form elements -->    
<div class='box box-primary box-solid'> 
    <div class='box-header with-border'>            
        <h3 class="box-title">Funcionário</h3>
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

    <form method="post" action="{{ $action ?? url('funcionario') }}">    
    {{csrf_field()}}
    @isset($funcionario) {{method_field('patch')}} @endisset

        <!-- /.box-header -->
        <div class="box-body">   
            <fieldset class="form-group">                    
                <input type="hidden" value="{{$funcionario->id_pessoa ?? ''}}" name="id_pessoa" class="form-control">
                <div class="row">
                    <div class="form-group col-sm-12 mb-3">
                        <label for="nm_pessoa" class="control-label">Nome</label>
                        <input type="text" class="form-control" value="{{$funcionario->nm_pessoa ?? ''}}" name="nm_pessoa" maxlength="100" autocomplete="off" required>
                    </div>             
                </div>   
                <div class="row">
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nr_cpfcnpj" class="control-label">CPF</label>
                        <input type="text" class="form-control" value="{{$funcionario->nr_cpfcnpj ?? ''}}" name="nr_cpfcnpj" onblur="cpf(this.value)" onkeypress="$(this).mask('000.000.000-00');" autocomplete="off">
                    </div>                        
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nr_rgie" class="control-label">RG</label>
                        <input type="text" class="form-control" value="{{$funcionario->nr_rgie ?? ''}}" name="nr_rgie" maxlength="30" autocomplete="off">     
                    </div>    
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nr_telefone1" class="control-label">1º Telefone</label>
                        <input type="text" class="form-control" value="{{$funcionario->nr_telefone1 ?? ''}}" name="nr_telefone1" onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off">     
                    </div>
                </div>    
                <div class="row">
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nr_cep" class="control-label">CEP</label>
                        <input type="text" class="form-control" value="{{$funcionario->nr_cep ?? ''}}" name="nr_cep" onkeypress="$(this).mask('00000-000')" autocomplete="off" required>
                    </div>    
                    <div class="form-group col-sm-5 mb-3">
                        <label for="nm_endereco" class="control-label">Endereço</label>
                        <input type="text" class="form-control" value="{{$funcionario->nm_endereco ?? ''}}" name="nm_endereco" maxlength="100" autocomplete="off">     
                    </div>                            
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nr_numender" class="control-label">Numero</label>
                        <input type="text" class="form-control" value="{{$funcionario->nr_numender ?? ''}}" name="nr_numender" maxlength="20" autocomplete="off">
                    </div>
                    <div class="form-group col-sm-3 mb-3">
                        <label for="nm_complender" class="control-label">Complemento</label>
                        <input type="text" class="form-control" value="{{$funcionario->nm_complender ?? ''}}" name="nm_complender" maxlength="60" autocomplete="off">     
                    </div>
                </div> 
                <div class="row">
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_bairro" class="control-label">Bairro</label>
                        <input type="text" class="form-control" value="{{$funcionario->nm_bairro ?? ''}}" name="nm_bairro" maxlength="60" autocomplete="off">     
                    </div>                            
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_cidade" class="control-label">Cidade</label>
                        <input type="text" class="form-control" value="{{$funcionario->nm_cidade ?? ''}}" name="nm_cidade" maxlength="60" autocomplete="off">
                    </div>    
                    <div class="form-group col-sm-4 mb-1">
                        <label for="nm_estado" class="control-label">Estado</label>
                        <select class="form-control" name="nm_estado">
                            <option value=""></option>
                            @foreach($estado as $est)
                                @if (isset($funcionario))
                                    @if($est->nm_sigla==$funcionario->nm_estado)
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
                        <label for="nm_telefone2" class="control-label">2º Telefone</label>
                        <input type="text" class="form-control" value="{{$funcionario->nm_telefone2 ?? ''}}" name="nm_telefone2" onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off">     
                    </div>                            
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_telefone3" class="control-label">3º Telefone</label>
                        <input type="text" class="form-control" value="{{$funcionario->nm_telefone3 ?? ''}}" name="nm_telefone3" onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off">
                    </div>    
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_telefone4" class="control-label">4º Telefone</label>
                        <input type="text" class="form-control" value="{{$funcionario->nm_telefone4 ?? ''}}" name="nm_telefone4" onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off">
                    </div>    
                </div> 
                <div class="row">
                    <div class="form-group col-sm-6 mb-3">
                        <label for="nm_email" class="control-label">E-Mail</label>
                        <input type="email" class="form-control" value="{{$funcionario->nm_email ?? ''}}" name="nm_email" maxlength="191" autocomplete="off">
                    </div>    
                    <div class="form-group col-sm-6 mb-1">
                        <label for="id_funcao" class="control-label">Função</label>
                        <select class="form-control" name="id_funcao">
                            <option value=""></option>
                            @foreach($funcao as $func)
                                @if (isset($funcionario))
                                    @if($func->id_funcao==$funcionario->id_funcao)
                                    <option value="{{$func->id_funcao}}" selected>
                                    {{$func->nm_funcao}}
                                    </option>
                                    @else
                                    <option value="{{$func->id_funcao}}">
                                    {{$func->nm_funcao}}
                                    </option>
                                    @endif	         
                                @else                                    
                                    <option value="{{$func->id_funcao}}">
                                    {{$func->nm_funcao}}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>                        
                </div>
            </fieldset>    
            <!-- Dados complementares -->
            <fieldset class="form-group">
            <legend>Complementares</legend>
                <div class="row">
                    <div class="form-group col-sm-4 mb-3">
                        <label for="vl_comprod" class="control-label">% Comissão na Venda</label>
                        <input type="text" class="form-control" value="{{$funcionario->vl_comprod ?? ''}}" name="vl_comprod" autocomplete="off">                    
                    </div> 
                    <div class="form-group col-sm-4 mb-3">
                        <label for="vl_comserv" class="control-label">% Comissão no Serviço</label>
                        <input type="text" class="form-control" value="{{$funcionario->vl_comserv ?? ''}}" name="vl_comserv" autocomplete="off">                    
                    </div>
                    <div class="form-group col-sm-4 mb-3">                                    
                        <label for="st_comcob" class="control-label">Comissão na Cobrança?</label>
                        @if (isset($funcionario))                        
                            @if($funcionario->st_comcob===1)
                                <input type="checkbox" class="checkbox" value="{{$funcionario->st_comcob ?? ''}}" checked name='st_comcob' >
                            @else 
                                <input type="checkbox" class="checkbox" value="{{$funcionario->st_comcob ?? ''}}" name='st_comcob'>
                            @endif 
                        @else
                            <input type="checkbox" class="checkbox" value="{{$funcionario->st_comcob ?? ''}}" name='st_comcob'>
                        @endif                                
                    </div>                           
                </div>
                <div class="row">
                    <div class="form-group col-sm-2 mb-3">
                        <label for="vl_salario" class="control-label">Valor Salário</label>
                        <input type="text" class="form-control" value="{{$funcionario->vl_salario ?? ''}}" name="vl_salario" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off">                    
                    </div> 
                    <div class="form-group col-sm-2 mb-3">
                        <label for="dt_admissao" class="control-label">Admissão</label>
                        <input type="text" class="form-control" value="{{empty($funcionario->dt_admissao) ? '' : $funcionario->dt_admissao->format('d/m/Y') ?? ''}}" name="dt_admissao" onkeypress="$(this).mask('00/00/0000')" autocomplete="off">
                    </div>
                    <div class="form-group col-sm-2 mb-3">
                        <label for="dt_admissao" class="control-label">Demissão</label>
                        <input type="text" class="form-control" value="{{empty($funcionario->dt_demissao) ? '' : $funcionario->dt_demissao->format('d/m/Y') ?? ''}}" name="dt_admissao" onkeypress="$(this).mask('00/00/0000')" autocomplete="off">
                    </div>
                    <div class="form-group col-sm-3 mb-3">                                    
                        <label for="nr_pis" class="control-label">Nº Pis</label>
                        <input type="text" class="form-control" value="{{$funcionario->nr_pis ?? ''}}" value="nr_pis" autocomplete="off">
                    </div>                           
                    <div class="form-group col-sm-3 mb-3">
                        <label for="nr_ctps" class="control-label">Nº CTPS</label>
                        <input type="text" class="form-control" value="{{$funcionario->nr_ctps ?? ''}}" name="nr_ctps" autocomplete="off">                    
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