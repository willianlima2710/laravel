@extends('adminlte::page')

@section('title', 'Fornecedores')

@section('content_header')
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h3>Listagem - Fornecedores</h3>
        </div>
        <div class="pull-right">            
            <a class="btn btn-success" style="margin: 10px;" href="{{ route('fornecedor.create') }}"><i class='fa fa-plus'></i> Novo</a>
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
        @include("forms.search",["rota" => "fornecedor"])
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-condensed table-hover" id="dest">
            <thead>
            <tr>
                <th width="100px">Código</th>
                <th width="250px">Nome</th>
                <th width="100px">CNPJ/CPF</th>
                <th width="100px">IE/RG</th>
                <th width="100px">Telefone</th>
                <th width="100px">Bairro</th>
                <th width="100px">Cidade</th>
                <th width="150px"><i class="fa fa-cogs"></i></th>                   
            </tr>     
            </thead>       
            <tbody>                
            @foreach ($fornecedores as $fornecedor)
            <tr>
                <td>{{ $fornecedor->id_pessoa }}</td>
                <td>{{ $fornecedor->nm_pessoa }}</td>
                <td>{{ $fornecedor->nr_cpfcnpj }}</td>
                <td>{{ $fornecedor->nr_rgie }}</td>
                <td>{{ $fornecedor->nr_telefone1 }}</td>                    
                <td>{{ $fornecedor->nm_bairro }}</td>                    
                <td>{{ $fornecedor->nm_cidade }}</td>                    
                <td>                 
                    <a class="btn btn-sm btn-info" href="{{ route('fornecedor.show',$fornecedor->id_pessoa) }}"><i class='fa fa-eye'></i></a>                        
                    <a class="btn btn-sm btn-primary" href="{{ route('fornecedor.edit',$fornecedor->id_pessoa) }}"><i class='fa fa-edit'></i></a>                                                       
                    <a class="btn btn-sm btn-danger" href="" data-target="#modal-delete-{{$fornecedor->id_pessoa}}" data-toggle="modal"><i class='fa fa-trash'></i></a>
                </td>    
            </tr>
            @include('forms.modal',['action'=>'FornecedorController@destroy','id'=>$fornecedor->id_pessoa])  
            @endforeach
        </tbody>
        </table>
    </div>      
    <div class="box-footer clearfix"> 
        <ul class="pagination pagination-sm no-margin pull-left">{{$fornecedores->appends(['searchText' => $searchText])->links()}}</ul>
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
