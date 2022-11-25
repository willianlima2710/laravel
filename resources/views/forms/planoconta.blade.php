@extends('adminlte::page')

@section('title', 'Plano de Conta')

@section('content_header')
@stop

@section('content')    

<!-- general form elements -->    
<div class='box box-primary box-solid'> 
    <div class='box-header with-border'>            
        <h3 class="box-title">Plano de Conta</h3>
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

    <form method="post" action="{{ $action ?? url('planoconta') }}">    
    {{csrf_field()}}
    @isset($planoconta) {{method_field('patch')}} @endisset

        <!-- /.box-header -->
        <div class="box-body">   
            <fieldset class="form-group">                    
                <input type="hidden" value="{{$planoconta->id_planoconta ?? ''}}" name="id_planoconta" class="form-control">
                <div class="row">
                    <div class="form-group col-sm-12 mb-3">
                        <label for="nm_planoconta" class="control-label">Nome</label>
                        <input type="text" class="form-control" value="{{$planoconta->nm_planoconta ?? ''}}" name="nm_planoconta" maxlength="100" autocomplete="off" required>
                    </div>     
                </div>           
                <div class="row"> 
                    <div class="form-group col-sm-8 mb-3">
                        <label for="cd_conta" class="control-label">Código</label>
                        <input type="text" class="form-control" value="{{$planoconta->cd_conta ?? ''}}" name="cd_conta" autocomplete="off" required>                    
                    </div>   
                    <div class="form-group col-sm-4 mb-1">
                        <label for="st_tipo" class="control-label">Tipo</label>
                        <select class="form-control" name="st_tipo" required>
                            <option value=""></option>
                            @foreach($tipo as $tip)
                                @if (isset($planoconta))
                                    @if($tip['st_tipo']==$planoconta->st_tipo)
                                    <option value="{{$tip['st_tipo']}}" selected>
                                    {{$tip['nm_tipo']}}
                                    </option>
                                    @else
                                    <option value="{{$tip['st_tipo']}}">
                                    {{$tip['nm_tipo']}}
                                    </option>
                                    @endif	         
                                @else                                    
                                    <option value="{{$tip['st_tipo']}}">
                                    {{$tip['nm_tipo']}}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>    
                </div>   
                <div class="row">
                    <div class="form-group col-sm-4 mb-3">
                        <label for="cd_pai" class="control-label">Código Pai</label>
                        <input type="text" class="form-control" value="{{$planoconta->cd_pai ?? ''}}" name="cd_pai" autocomplete="off" required>                    
                    </div>                        
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nr_ordem" class="control-label">Ordem</label>
                        <input type="text" class="form-control" value="{{$planoconta->nr_ordem ?? ''}}" name="nr_ordem" autocomplete="off" required>     
                    </div>    
                    <div class="form-group col-sm-4 mb-3">
                        <label for="cd_reduzido" class="control-label">Código Reduzido</label>
                        <input type="text" class="form-control" value="{{$planoconta->cd_reduzido ?? ''}}" name="cd_reduzido" autocomplete="off" required>     
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