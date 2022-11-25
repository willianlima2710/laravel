@extends('adminlte::page')

@section('title', 'Cliente')

@section('content_header')
@stop

@section('content')    

<!-- general form elements -->    
<div class='box box-primary box-solid'> 
    <div class='box-header with-border'>            
        <h3 class="box-title">Cliente</h3>
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

    <form method="post" action="{{ $action ?? url('cliente') }}">    
    {{csrf_field()}}
    @isset($cliente) {{method_field('patch')}} @endisset

        <!-- /.box-header -->
        <div class="box-body">   
            <fieldset class="form-group">
                <input type="hidden" value="{{$cliente->id_pessoa ?? ''}}" name="id_pessoa" class="form-control">
                <div class="row">
                    <div class="form-group col-sm-10 mb-1">
                        <label for="nm_pessoa" class="control-label">Nome</label>
                        <input type="text" class="form-control" value="{{$cliente->nm_pessoa ?? ''}}" name="nm_pessoa" maxlength="100" autocomplete="off" required>                    
                    </div>             
                    <div class="form-group col-sm-2 mb-1">
                        <label for="cd_pessoa" class="control-label">Código</label>
                        <input type="text" class="form-control" value="{{$cliente->cd_pessoa ?? ''}}" name="cd_pessoa" maxlength="10" autocomplete="off">                    
                    </div>                                 
                </div>    
                <div class="row">
                    <div class="form-group col-sm-2 mb-1">
                        <label for="st_sexo" class="control-label">Sexo</label>
                        <select class="form-control" name="st_sexo" required>
                            <option value=""></option>
                            @foreach($sexos as $sexo)
                                @if (isset($cliente))
                                    @if($sexo['st_sexo']==$cliente->st_sexo)
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
                        <label for="dt_nascimento" class="control-label">Data de Nascimento</label>
                        <input type="text" class="form-control" value="{{empty($cliente->dt_nascimento) ? '' : $cliente->dt_nascimento->format('d/m/Y') ?? ''}}" name='dt_nascimento' onkeypress="$(this).mask('00/00/0000')" autocomplete="off">
                    </div>    
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nr_cpfcnpj" class="control-label">CPF</label>
                        <input type="text" class="form-control" value="{{$cliente->nr_cpfcnpj ?? ''}}" name='nr_cpfcnpj' onkeypress="$(this).mask('000.000.000-00');" autocomplete="off">                    
                    </div>                        
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nr_rgie" class="control-label">RG</label>
                        <input type="text" class="form-control" value="{{$cliente->nr_rgie ?? ''}}" name='nr_rgie' maxlength="30" autocomplete="off">     
                    </div>    
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nr_telefone1" class="control-label">1º Telefone</label>
                        <input type="text" class="form-control" value="{{$cliente->nr_telefone1 ?? ''}}" name='nr_telefone1' onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off">     
                    </div>
                </div>    
                <div class="row">
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nr_cep" class="control-label">CEP</label>
                        <input type="text" class="form-control" value="{{$cliente->nr_cep ?? ''}}" name='nr_cep' onkeypress="$(this).mask('00000-000')" autocomplete="off" required>      
                    </div>    
                    <div class="form-group col-sm-5 mb-3">
                        <label for="nm_endereco" class="control-label">Endereço</label>
                        <input type="text" class="form-control" value="{{$cliente->nm_endereco ?? ''}}" name='nm_endereco' maxlength="100" autocomplete="off">     
                    </div>                            
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nr_numender" class="control-label">Numero</label>
                        <input type="text" class="form-control" value="{{$cliente->nr_numender ?? ''}}" name='nr_numender' maxlength="20" autocomplete="off">
                    </div>
                    <div class="form-group col-sm-3 mb-3">
                        <label for="nm_complender" class="control-label">Complemento</label>
                        <input type="text" class="form-control" value="{{$cliente->nm_complender ?? ''}}" name='nm_complender' maxlength="100" autocomplete="off">     
                    </div>
                </div> 
                <div class="row">
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_bairro" class="control-label">Bairro</label>
                        <input type="text" class="form-control" value="{{$cliente->nm_bairro ?? ''}}" name='nm_bairro' maxlength="60" autocomplete="off">     
                    </div>                            
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_cidade" class="control-label">Cidade</label>
                        <input type="text" class="form-control" value="{{$cliente->nm_cidade ?? ''}}" name='nm_cidade' maxlength="60" autocomplete="off">
                    </div>    
                    <div class="form-group col-sm-4 mb-1">
                        <label for="nm_estado" class="control-label">Estado</label>
                        <select class="form-control" name="nm_estado">
                            <option value=""></option>
                            @foreach($estados as $estado)
                                @if (isset($cliente))
                                    @if($estado->nm_sigla==$cliente->nm_estado)
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
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_telefone2" class="control-label">2º Telefone</label>
                        <input type="text" class="form-control" value="{{$cliente->nm_telefone2 ?? ''}}" name='nm_telefone2' onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off">     
                    </div>                            
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_telefone3" class="control-label">3º Telefone</label>
                        <input type="text" class="form-control" value="{{$cliente->nm_telefone3 ?? ''}}" name='nm_telefone3' onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off">
                    </div>    
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_telefone4" class="control-label">4º Telefone</label>
                        <input type="text" class="form-control" value="{{$cliente->nm_telefone4 ?? ''}}" name='nm_telefone4' onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off">
                    </div>    
                </div> 
                <div class="row">
                    <div class="form-group col-sm-8 mb-3">
                        <label for="nm_email" class="control-label">E-Mail</label>
                        <input type="email" class="form-control" value="{{$cliente->nm_email ?? ''}}" name='nm_email' maxlength="191" autocomplete="off">
                    </div>    
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_profissao" class="control-label">Profissão</label>
                        <input type="text" class="form-control" value="{{$cliente->nm_profissao ?? ''}}" name='nm_profissao' maxlength="100" autocomplete="off">     
                    </div>                            
                </div>
                <div class="row">
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nm_nacionalidade" class="control-label">Nacionalidade</label>
                        <input type="text" class="form-control" value="{{$cliente->nm_nacionalidade ?? ''}}" name='nm_nacionalidade' maxlength="100" autocomplete="off">     
                    </div>   
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nm_naturalidade" class="control-label">Naturalidade</label>
                        <input type="text" class="form-control" value="{{$cliente->nm_naturalidade ?? ''}}" name='nm_naturalidade' maxlength="100" autocomplete="off">     
                    </div>     
                    <div class="form-group col-sm-4 mb-1">
                        <label for="id_estcivil" class="control-label">Estado Civil</label>
                        <select class="form-control" name="id_estcivil">
                            <option value=""></option>
                            @foreach($estcivils as $estcivil)
                                @if (isset($cliente))
                                    @if($estcivil->id_estcivil==$cliente->id_estcivil)
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
                    <div class="form-group col-sm-4 mb-1">
                        <label for="id_religiao" class="control-label">Religião</label>
                        <select class="form-control" name="id_religiao">
                            <option value=""></option>
                            @foreach($religiaos as $religiao)
                                @if (isset($cliente))
                                    @if($religiao->id_religiao==$cliente->id_religiao)
                                    <option value="{{$religiao->id_religiao}}" selected>
                                    {{$religiao->nm_religiao}}
                                    </option>
                                    @else
                                    <option value="{{$religiao->id_religiao}}">
                                    {{$religiao->nm_religiao}}
                                    </option>
                                    @endif	         
                                @else                                    
                                    <option value="{{$religiao->id_religiao}}">
                                    {{$religiao->nm_religiao}}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>    
                </div>
            </fieldset>   
            <!-- Dados complementares -->
            <fieldset class="form-group">
            <legend class="label label-success"><span><h4>Dados Complementares</h4></span></legend>               
                <div class="row">
                    <div class="form-group col-sm-8 mb-3">
                        <label for="nm_conjuge" class="control-label">Conjuge</label>
                        <input type="text" class="form-control" value="{{$cliente->nm_conjuge ?? ''}}" name='nm_conjuge' maxlength="100" autocomplete="off">     
                    </div>
                    <div class="form-group col-sm-3 mb-3">
                        <label for="nr_conjugetelefone" class="control-label">Telefone</label>
                        <input type="text" class="form-control" value="{{$cliente->nr_conjugetelefone ?? ''}}" name='nr_conjugetelefone' onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off">      
                    </div>
                </div> 
                <div class="row">
                    <div class="form-group col-sm-8 mb-3">
                        <label for="nm_mae" class="control-label">Mãe</label>
                        <input type="text" class="form-control" value="{{$cliente->nm_mae ?? ''}}" name='nm_mae' maxlength="100" autocomplete="off">     
                    </div>
                    <div class="form-group col-sm-3 mb-3">
                        <label for="nr_maetelefone" class="control-label">Telefone</label>
                        <input type="text" class="form-control" value="{{$cliente->nr_maetelefone ?? ''}}" name='nr_maetelefone' onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off">     
                    </div>
                    <div class="form-group col-sm-1 mb-3">                                    
                        <label for="st_maeviva" class="control-label">Viva ?</label>
                        @if (isset($cliente))                        
                            @if($cliente->st_maeviva===1)
                                <input type="checkbox" class="checkbox" value="{{$cliente->st_maeviva ?? ''}}" checked name='st_maeviva' >
                            @else 
                                <input type="checkbox" class="checkbox" value="{{$cliente->st_maeviva ?? ''}}" name='st_maeviva'>
                            @endif 
                        @else
                            <input type="checkbox" class="checkbox" value="{{$cliente->st_maeviva ?? ''}}" name='st_maeviva'>
                        @endif                                
                    </div>                           
                </div> 
                <div class="row">
                    <div class="form-group col-sm-8 mb-3">
                        <label for="nm_pai" class="control-label">Pai</label>
                        <input type="text" class="form-control" value="{{$cliente->nm_pai ?? ''}}" name='nm_pai' maxlength="100" autocomplete="off">     
                    </div>
                    <div class="form-group col-sm-3 mb-3">
                        <label for="nr_paitelefone" class="control-label">Telefone</label>
                        <input type="text" class="form-control" value="{{$cliente->nr_paitelefone ?? ''}}" name='nr_paitelefone' onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off">     
                    </div>
                    <div class="form-group col-sm-1 mb-3">                                    
                        <label for="st_paivivo" class="control-label">Vivo ?</label>
                        @if (isset($cliente))                        
                            @if($cliente->st_paivivo===1)
                                <input type="checkbox" class="checkbox" value="{{$cliente->st_paivivo}}" checked name='st_paivivo'>
                            @else 
                                <input type="checkbox" class="checkbox" value="{{$cliente->st_paivivo ?? ''}}" name='st_paivivo'>
                            @endif 
                        @else
                            <input type="checkbox" class="checkbox" value="{{$cliente->st_paivivo ?? ''}}" name='st_paivivo'>
                        @endif
                    </div>                           
                </div> 
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="nm_obs" class="control-label">Observação</label>
                        <textarea class="form-control" rows="5" name='nm_obs'>{{$cliente->nm_obs ?? ''}}</textarea>
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