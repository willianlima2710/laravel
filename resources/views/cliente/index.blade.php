@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h3>Listagem - Clientes</h3>
        </div>
        <div class="pull-right">            
            <a class="btn btn-success" style="margin: 10px;" href="{{ route('cliente.create') }}"><i class='fa fa-plus'></i> Novo</a>
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
        @include("forms.search",["rota" => "cliente"])
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-condensed table-hover" id="dest">
            <thead>
            <tr>
                <th width="90px">Código</th>
                <th width="250px">Nome</th>
                <th width="70px">CPF</th>
                <th width="200px">Telefones</th>
                <th width="150px">Bairro</th>
                <th width="85px">Cidade</th>
                <th width="200px">Observação</th>
                <th width="150px"><i class="fa fa-cogs"></i></th>                   
            </tr>     
            </thead>       
            <tbody>                
            @foreach ($clientes as $cliente)
            <tr>
                <td>{{ $cliente->cd_pessoa }}</td>
                <td>{{ $cliente->nm_pessoa }}</td>
                <td>{{ $cliente->nr_cpfcnpj }}</td>
                <td>{{ $cliente->nr_telefone1.' '.
                       $cliente->nr_telefone2.' '.
                       $cliente->nr_telefone3.' '.
                       $cliente->nr_telefone4}}</td>                    
                <td>{{ $cliente->nm_bairro }}</td>
                <td>{{ $cliente->nm_cidade }}</td>                                    
                <td>{{ $cliente->nm_obs }}</td>                                    
                <td>                 
                    <a class="btn btn-sm btn-info" href="{{ route('cliente.show',$cliente->id_pessoa) }}"><i class='fa fa-eye'></i></a>                        
                    <a class="btn btn-sm btn-primary" href="{{ route('cliente.edit',$cliente->id_pessoa) }}"><i class='fa fa-edit'></i></a>                                                       
                    <a class="btn btn-sm btn-danger" href="" data-target="#modal-delete-{{$cliente->id_pessoa}}" data-toggle="modal"><i class='fa fa-trash'></i></a>
                </td>    
            </tr>
            @include('forms.modal',['action'=>'ClienteController@destroy','id'=>$cliente->id_pessoa])  
            @endforeach
        </tbody>
        </table>
    </div>      
    <div class="box-footer clearfix"> 
        <ul class="pagination pagination-sm no-margin pull-left">{{$clientes->appends(['searchText' => $searchText])->links()}}</ul>
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
