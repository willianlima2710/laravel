@extends('adminlte::page')

@section('title', 'Produtos')

@section('content_header')
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h3>Listagem - Produtos</h3>
        </div>
        <div class="pull-right">            
            <a class="btn btn-success" style="margin: 10px;" href="{{ route('produto.create') }}"><i class='fa fa-plus'></i> Novo</a>
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
        @include("forms.search",["rota" => "produto"])
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-condensed table-hover" id="dest">
            <thead>
            <tr>
                <th width="115px">Código</th>
                <th width="250px">Nome</th>
                <th width="100px">$ Valor</th>
                <th width="150px">Unidade</th>
                <th width="110px">Estoque</th>
                <th width="110px">Fornecedor</th>
                <th width="150px"><i class="fa fa-cogs"></i></th>                   
            </tr>     
            </thead>       
            <tbody>                
            @foreach ($produtos as $produto)          

            <tr>
                <td>{{ $produto->id_produto }}</td>
                <td>{{ $produto->nm_produto }}</td>
                <td>{{ number_format($produto->vl_venda, 2, '.', '') }}</td>
                <td>{{ $produto->cd_unidade }}</td>
                <td>{{ $produto->qt_estoque }}</td>                    
                <td>{{ $produto->nm_fornecedor }}</td>                    
                <td>                 
                    <a class="btn btn-sm btn-info" href="{{ route('produto.show',$produto->id_produto) }}"><i class='fa fa-eye'></i></a>                        
                    <a class="btn btn-sm btn-primary" href="{{ route('produto.edit',$produto->id_produto) }}"><i class='fa fa-edit'></i></a>                                                       
                    <a class="btn btn-sm btn-danger" href="" data-target="#modal-delete-{{$produto->id_produto}}" data-toggle="modal"><i class='fa fa-trash'></i></a>
                </td>    
            </tr>
            @include('forms.modal',['action'=>'ProdutoController@destroy','id'=>$produto->id_produto])  
            @endforeach
        </tbody>
        </table>
    </div>      
    <div class="box-footer clearfix"> 
        <ul class="pagination pagination-sm no-margin pull-left">{{$produtos->appends(['searchText' => $searchText])->links()}}</ul>
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
