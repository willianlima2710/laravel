@extends('adminlte::page')

@section('title', 'Contas a Pagar')

@section('content_header')
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h3>Listagem - Contas a Pagar</h3>
        </div>
        <div class="pull-right">            
            <a class="btn btn-success" style="margin: 10px;" href="{{ route('ctapagar.create') }}"><i class='fa fa-plus'></i> Novo</a>
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
        @include("forms.search",["rota" => "ctapagar"])
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-condensed table-hover" id="dest">
            <thead>
            <tr>
                <th width="115px">Vencimento</th>
                <th width="90px">Nº Doc</th>
                <th width="165px">Nome</th>
                <th width="70px">Parc</th>
                <th width="100px">Tp. Pagto</th>
                <th width="140px">Histórico</th>
                <th width="85px">$ Valor</th>
                <th width="110px">Pagamento</th>
                <th width="110px">Nº Cheque</th>
                <th width="75px">Status</th>
                <th width="150px"><i class="fa fa-cogs"></i></th>                   
            </tr>     
            </thead>       
            <tbody>                
            @foreach ($ctapagars as $ctapagar)
            @php                
                if ($ctapagar->st_status === '0' && strtotime($ctapagar->dt_vencimento) < strtotime(date("Y-m-d"))) {
                    $rowclass = 'label label-danger';
                    $status = 'Atrasado';
                    $disabled = '';
                }elseif ($ctapagar->st_status === '0' && strtotime($ctapagar->dt_vencimento) >= strtotime(date("Y-m-d"))) {
                    $rowclass = 'label-success';
                    $status = 'Em Dia';
                    $disabled = '';
                }else{
                    $rowclass = 'label label-primary';
                    $status = 'Pago';
                    $disabled = 'disabled';
                }    
            @endphp            
            <tr>
                <td><span style="display: none;">{{ empty($ctapagar->dt_vencimento) ? '' : $ctapagar->dt_vencimento->format("Y-m-d") }}</span>
                    {{ empty($ctapagar->dt_vencimento) ? '' : $ctapagar->dt_vencimento->format("d/m/Y") }}
                </td>
                <td>{{ $ctapagar->nr_documento }}</td>
                <td>{{ $ctapagar->nm_fornecedor }}</td
                ><td>{{ $ctapagar->nr_parcela }}</td>
                <td>{{ $ctapagar->nm_tppagamento }}</td>                    
                <td>{{ $ctapagar->ds_historico }}</td>                    
                <td>{{ number_format($ctapagar->vl_apagar, 2, '.', '') }}</td>
                <td><span style="display: none;">{{ empty($ctapagar->dt_pagamento) ? '' : $ctapagar->dt_pagamento->format("Y-m-d") }}</span>
                    {{ empty($ctapagar->dt_pagamento) ? '' : $ctapagar->dt_pagamento->format("d/m/Y") }}
                </td>
                <td>{{ $ctapagar->nr_cheque }}</td>
                <td><span class="{{$rowclass}}">&nbsp;{{$status}}&nbsp;</span></td>
                <td>                 
                    <a class="btn btn-sm btn-info" href="{{ route('ctapagar.show',$ctapagar->id_ctapagar) }}"><i class='fa fa-eye'></i></a>                        
                    <a class="btn btn-sm btn-primary" {{$disabled}} href="{{ route('ctapagar.edit',$ctapagar->id_ctapagar) }}"><i class='fa fa-edit'></i></a>                                                       
                    <a class="btn btn-sm btn-danger" href="" data-target="#modal-delete-{{$ctapagar->id_ctapagar}}" data-toggle="modal"><i class='fa fa-trash'></i></a>
                </td>    
            </tr>
            @include('forms.modal',['action'=>'CtapagarController@destroy','id'=>$ctapagar->id_ctapagar])  
            @endforeach
        </tbody>
        </table>
    </div>      
    <div class="box-footer clearfix"> 
        <ul class="pagination pagination-sm no-margin pull-left">{{$ctapagars->appends(['searchText' => $searchText])->links()}}</ul>
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
