@extends('adminlte::page')

@section('title', 'Contratos')

@section('content_header')
@stop

@section('content')
<div class="row">
    <div class="col-sm-12 margin-tb">
        <div class="pull-left">
            <h3>Listagem - Contratos</h3>
        </div>
        <div class="pull-right">            
            <a class="btn btn-success" style="margin: 10px;" href="{{ route('contrato.create') }}"><i class='fa fa-plus'></i> Novo</a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif
<div class="box">
    <div class="box-header with-border">
        @include("forms.search",["rota" => "contrato"])
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-condensed table-hover" id="dest">
            <thead>
            <tr>
                <th width="100px">Data Inc</th>
                <th width="120px">Nº Contrato</th>
                <th width="250px">Nome</th>
                <th width="120px">Plano</th>
                <th width="90px">Qt Parc</th>
                <th width="90px">$ Valor</th>
                <th width="110px">Vendedor</th>
                <th width="110px">Observação</th>
                <th width="150px"><i class="fa fa-cogs"></i></th>                   
            </tr>     
            </thead>       
            <tbody>                
            @foreach ($contratos as $contrato)            
            <tr>
                <td><span style="display: none;">{{ empty($contrato->dt_inccontrato) ? '' : $contrato->dt_inccontrato->format("Y-m-d") }}</span>
                    {{ empty($contrato->dt_inccontrato) ? '' : $contrato->dt_inccontrato->format("d/m/Y") }}
                </td>
                <td>{{ $contrato->nr_contrato }}</td>
                <td>{{ $contrato->nm_pessoa }}</td>
                <td>{{ $contrato->nm_plano }}</td>
                <td>{{ $contrato->qt_parcela }}</td>                    
                <td>{{ number_format($contrato->vl_total, 2, '.', '') }}</td>
                <td>{{ $contrato->nm_vendedor }}</td>
                <td>{{ $contrato->nm_obs }}</td>
                <td>        
                    <div class="dropdown">
                       <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Ações
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                            <li role="presentation"><a role="menuitem" href="{{ route('contrato.show',$contrato->id_contrato) }}">Visualizar</a></li>
                            <li role="presentation"><a role="menuitem" href="{{ route('contrato.edit',$contrato->id_contrato) }}">Editar</a></li>
                            <li role="presentation"><a role="menuitem" href="{{ route('printpdf',$contrato->id_contrato) }}" target="blank">Imprimir</a></li>
                            <li role="presentation"><a role="menuitem" href="">Transferir</a></li>
                            <li role="presentation" class="divider"></li>                            
                            <li role="presentation"><a role="menuitem" href="">Cancelar</a></li>                           
                            <li role="presentation"><a role="menuitem" href="" data-target="#modal-delete-{{$contrato->id_contrato}}" data-toggle="modal">Excluir</a></li>
                        </ul>
                    </div>
                </td>    
            </tr>
            @include('forms.modal',['action'=>'ContratoController@destroy','id'=>$contrato->id_contrato])  
            @endforeach
        </tbody>
        </table>
    </div>      
    <div class="box-footer clearfix"> 
        <ul class="pagination pagination-sm no-margin pull-left">{{$contratos->appends(['searchText' => $searchText])->links()}}</ul>
    </div>                  
</div> 
@stop

@section('js')
<script> 

$(function(){
    $("#dest").addSortWidget();
});
</script>
@stop
