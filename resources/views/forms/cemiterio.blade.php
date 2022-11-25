@extends('adminlte::page')

@section('title', 'Cemitérios')

@section('content_header')
@stop

@section('content')    

<!-- general form elements -->    
<div class='box box-primary box-solid'> 
    <div class='box-header with-border'>            
        <h3 class="box-title">Cemitérios</h3>
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

    <form method="post" action="{{ $action ?? url('cemiterio') }}">    
    {{csrf_field()}}
    @isset($cemiterio) {{method_field('patch')}} @endisset

        <!-- /.box-header -->
        <div class="box-body">   
            <fieldset class="form-group">
                <input type="hidden" value="{{$cemiterio->id_cemiterio ?? ''}}" name="id_cemiterio" class="form-control">
                <div class="row">
                    <div class="form-group col-sm-12 mb-1">
                        <label for="nm_cemiterio" class="control-label">Nome</label>
                        <input type="text" class="form-control" value="{{$cemiterio->nm_cemiterio ?? ''}}" name="nm_cemiterio" maxlength="100" autocomplete="off" required>                    
                    </div>             
                </div>    
                <div class="row">
                    <div class="form-group col-sm-8 mb-1">
                        <label for="nm_endereco" class="control-label">Endereço</label>
                        <input type="text" class="form-control" value="{{$cemiterio->nm_endereco ?? ''}}" name="nm_endereco" maxlength="100" autocomplete="off" required>                    
                    </div>             
                    <div class="form-group col-sm-2 mb-1">
                        <label for="nr_numender" class="control-label">Nº</label>
                        <input type="text" class="form-control" value="{{$cemiterio->nr_numender ?? ''}}" name="nr_numender" maxlength="5" onkeypress="$(this).mask('99999')" autocomplete="off" required>                    
                    </div>             
                    <div class="form-group col-sm-2 mb-1">
                        <label for="nm_bairro" class="control-label">Bairro</label>
                        <input type="text" class="form-control" value="{{$cemiterio->nm_bairro ?? ''}}" name="nm_bairro" maxlength="60" autocomplete="off" required>                    
                    </div>             
                </div>
                <div class="row">    
                    <div class="form-group col-sm-8 mb-1">
                        <label for="nm_cidade" class="control-label">Cidade</label>
                        <input type="text" class="form-control" value="{{$cemiterio->nm_cidade ?? ''}}" name="nm_cidade" maxlength="60" autocomplete="off" required>                    
                    </div>             
                    <div class="form-group col-sm-4 mb-1">
                        <label for="nm_estado" class="control-label">Estado</label>
                        <select class="form-control" name="nm_estado" required>
                            <option value=""></option>
                            @foreach($estados as $estado)
                                @if (isset($cemiterio))
                                    @if($estado->nm_sigla==$cemiterio->nm_estado)
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