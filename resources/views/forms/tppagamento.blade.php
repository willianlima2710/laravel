@extends('adminlte::page')

@section('title', 'Tipo de Pagamento')

@section('content_header')
@stop

@section('content')    

<!-- general form elements -->    
<div class='box box-primary box-solid'> 
    <div class='box-header with-border'>            
        <h3 class="box-title">Tipo de Pagamento</h3>
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

    <form method="post" action="{{ $action ?? url('tppagamento') }}">    
    {{csrf_field()}}
    @isset($tppagamento) {{method_field('patch')}} @endisset

        <!-- /.box-header -->
        <div class="box-body">   
            <fieldset class="form-group">
                <input type="hidden" value="{{$tppagamento->id_tppagamento ?? ''}}" name="id_tppagamento" class="form-control">
                <div class="row">
                    <div class="form-group col-sm-10 mb-1">
                        <label for="nm_tppagamento" class="control-label">Nome</label>
                        <input type="text" class="form-control" value="{{$tppagamento->nm_tppagamento ?? ''}}" name="nm_tppagamento" maxlength="100" autocomplete="off" required>                    
                    </div>         
                    <div class="form-group col-sm-2 mb-3">                                    
                        <label for="st_avista" class="control-label">A Vista ?</label>
                        @if (isset($tppagamento))                        
                            @if($tppagamento->st_avista===1)
                                <input type="checkbox" class="checkbox" value="{{$tppagamento->st_avista ?? ''}}" checked name='st_avista' >
                            @else 
                                <input type="checkbox" class="checkbox" value="{{$tppagamento->st_avista ?? ''}}" name='st_avista'>
                            @endif 
                        @else
                            <input type="checkbox" class="checkbox" value="{{$tppagamento->st_avista ?? ''}}" name='st_avista'>
                        @endif                                
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