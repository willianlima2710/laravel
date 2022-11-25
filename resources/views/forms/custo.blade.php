@extends('adminlte::page')

@section('title', 'Custo Fixo')

@section('content_header')
@stop

@section('content')    

<!-- general form elements -->    
<div class='box box-primary box-solid'> 
    <div class='box-header with-border'>            
        <h3 class="box-title">Custo Fixo</h3>
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

    <form method="post" action="{{ $action ?? url('custo') }}">    
    {{csrf_field()}}
    @isset($custo) {{method_field('patch')}} @endisset

        <!-- /.box-header -->
        <div class="box-body">   
            <fieldset class="form-group">            
                <input type="hidden" value="{{$custo->id_custo ?? ''}}" name="id_custo" class="form-control">
                <div class="row">
                    <div class="form-group col-sm-12 mb-3">
                        <label for="nm_custo" class="control-label">Nome</label>
                        <input type="text" class="form-control" value="{{$custo->nm_custo ?? ''}}" name="nm_custo" maxlength="100" autocomplete="off" required>
                    </div>     
                </div>           
                <div class="row"> 
                    <div class="form-group col-sm-4 mb-3">
                        <label for="vl_custo" class="control-label">Valor</label>
                        <input type="text" class="form-control" value="{{$custo->vl_custo ?? ''}}" name="vl_custo" maxlength="10" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off" required>
                    </div>   
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nr_dia" class="control-label">Dia</label>
                        <input type="text" class="form-control" value="{{$custo->nr_dia ?? ''}}" name="nr_dia" autocomplete="off" required>                    
                    </div>   
                    <div class="form-group col-sm-2 mb-1">
                        <label for="st_periodo" class="control-label">Periodo</label>
                        <select class="form-control" name="st_periodo" required>
                            <option value=""></option>
                            @foreach($periodo as $perid)
                                @if (isset($custo))
                                    @if($perid['st_periodo']==$custo->st_periodo)
                                    <option value="{{$perid['st_periodo']}}" selected>
                                    {{$perid['nm_periodo']}}
                                    </option>
                                    @else
                                    <option value="{{$perid['st_periodo']}}">
                                    {{$perid['nm_periodo']}}
                                    </option>
                                    @endif	         
                                @else                                    
                                    <option value="{{$perid['st_periodo']}}">
                                    {{$perid['nm_periodo']}}
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
                    <div class="form-group col-sm-12">
                        <label for="nm_obs" class="control-label">Observação</label>
                        <textarea class="form-control" name="nm_obs" rows="5">{{$custo->nm_obs ?? ''}}</textarea>
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