@extends('adminlte::page')

@section('title', 'Empresas')

@section('content_header')
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h3>Listagem - Empresas</h3>
        </div>
        <div class="pull-right">            
            <a class="btn btn-success" style="margin: 10px;" href="{{ route('empresa.create') }}"><i class='fa fa-plus'></i> Novo</a>
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
        @include("forms.search",["rota" => "empresa"])
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-condensed table-hover" id="dest">
            <thead>
            <tr>
                <th width="115px">Código</th>
                <th width="250px">Nome</th>
                <th width="100px">CNPJ</th>
                <th width="150px">Telefone</th>
                <th width="85px">Bairro</th>
                <th width="110px">Cidade</th>
                <th width="150px"><i class="fa fa-cogs"></i></th>                   
            </tr>     
            </thead>       
            <tbody>                
            @foreach ($empresas as $empresa)
            <tr>
                <td>{{ $empresa->id_pessoa }}</td>
                <td>{{ $empresa->nm_pessoa }}</td>
                <td>{{ $empresa->nr_cpfcnpj }}</td>
                <td>{{ $empresa->nr_telefone1 }}</td>                    
                <td>{{ $empresa->nm_bairro }}</td>                    
                <td>{{ $empresa->nm_cidade }}</td>
                <td>                 
                    <a class="btn btn-sm btn-info" href="{{ route('empresa.show',$empresa->id_pessoa) }}"><i class='fa fa-eye'></i></a>                        
                    <a class="btn btn-sm btn-primary" href="{{ route('empresa.edit',$empresa->id_pessoa) }}"><i class='fa fa-edit'></i></a>                                                       
                    <a class="btn btn-sm btn-danger" href="" data-target="#modal-delete-{{$empresa->id_pessoa}}" data-toggle="modal"><i class='fa fa-trash'></i></a>
                </td>    
            </tr>
            @include('forms.modal',['action'=>'EmpresaController@destroy','id'=>$empresa->id_pessoa])  
            @endforeach
        </tbody>
        </table>
    </div>      
    <div class="box-footer clearfix"> 
        <ul class="pagination pagination-sm no-margin pull-left">{{$empresas->appends(['searchText' => $searchText])->links()}}</ul>
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
