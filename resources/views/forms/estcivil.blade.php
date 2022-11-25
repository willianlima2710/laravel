@extends('adminlte::page')

@section('title', 'Estado Civil')

@section('content_header')
@stop

@section('content')    

<!-- general form elements -->    
<div class='box box-primary box-solid'> 
    <div class='box-header with-border'>            
        <h3 class="box-title">Estado Civil</h3>
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

    <form method="post" action="{{ $action ?? url('estcivil') }}">    
    {{csrf_field()}}
    @isset($estcivil) {{method_field('patch')}} @endisset

        <!-- /.box-header -->
        <div class="box-body">   
            <fieldset class="form-group">
                <input type="hidden" value="{{$estcivil->id_estcivil ?? ''}}" name="id_estcivil" class="form-control">
                <div class="row">
                    <div class="form-group col-sm-12 mb-1">
                        <label for="nm_estcivil" class="control-label">Nome</label>
                        <input type="text" class="form-control" value="{{$estcivil->nm_estcivil ?? ''}}" name="nm_estcivil" maxlength="100" autocomplete="off" required>                    
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