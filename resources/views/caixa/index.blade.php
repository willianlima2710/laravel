@extends('adminlte::page')

@section('title', 'Fluxo de Caixa')

@section('content_header')
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h3>Listagem - Fluxo de Caixa</h3>
        </div>
        <div class="pull-right">            
            <a class="btn btn-success" style="margin: 10px;" href="{{ route('caixa.create') }}"><i class='fa fa-plus'></i> Novo</a>
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
        @include("forms.search",["rota" => "caixa"])
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-condensed table-hover" id="dest">
            <thead>
            <tr>
                <th width="115px">Movimento</th>
                <th width="115px">Vencimento</th>
                <th width="115px">Documento</th>
                <th width="250px">Nome</th>
                <th width="70px">Parc</th>
                <th width="200px">Histórico</th>
                <th width="85px">$ Valor</th>
                <th width="80px">Status</th>
                <th width="150px"><i class="fa fa-cogs"></i></th>                   
            </tr>     
            </thead>       
            <tbody>                
            @foreach ($caixas as $caixa)
            @php                
                if ($caixa->st_creddeb === '0') {
                    $rowclass = 'label label-primary';
                    $status = 'Crédito';
                }elseif ($caixa->st_creddeb === '1') {
                    $rowclass = 'label label-danger';
                    $status = 'Débito';
                }    
            @endphp
            <tr>
                <td><span style="display: none;">{{ empty($caixa->dt_movimento) ? '' : $caixa->dt_movimento->format("Y-m-d") }}</span>
                    {{ empty($caixa->dt_movimento) ? '' : $caixa->dt_movimento->format("d/m/Y") }}
                </td>
                <td><span style="display: none;">{{ empty($caixa->dt_vencimento) ? '' : $caixa->dt_vencimento->format("Y-m-d") }}</span>
                    {{ empty($caixa->dt_vencimento) ? '' : $caixa->dt_vencimento->format("d/m/Y") }}
                </td>
                <td>{{ $caixa->nr_documento }}</td>
                <td>{{ $caixa->nm_pessoa }}</td>                
                <td>{{ $caixa->nr_parcela }}</td>
                <td>{{ $caixa->ds_historico }}</td>                                    
                <td>{{ number_format($caixa->vl_total, 2, '.', '') }}</td>
                <td><span class="{{$rowclass}}">&nbsp;{{$status}}&nbsp;</span></td>
                <td>                 
                    <a class="btn btn-sm btn-info" href="{{ route('caixa.show',$caixa->id_caixa) }}"><i class='fa fa-eye'></i></a>                        
                    <a class="btn btn-sm btn-primary" href="{{ route('caixa.edit',$caixa->id_caixa) }}"><i class='fa fa-edit'></i></a>                                                       
                    <a class="btn btn-sm btn-danger" href="" data-target="#modal-delete-{{$caixa->id_caixa}}" data-toggle="modal"><i class='fa fa-trash'></i></a>
                </td>    
            </tr>
            @include('forms.modal',['action'=>'CaixaController@destroy','id'=>$caixa->id_caixa])  
            @endforeach
        </tbody>
        </table>
    </div>      
    <div class="box-footer clearfix"> 
        <ul class="pagination pagination-sm no-margin pull-left">{{$caixas->appends(['searchText' => $searchText])->links()}}</ul>
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
