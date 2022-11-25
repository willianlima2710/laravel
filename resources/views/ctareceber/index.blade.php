@extends('adminlte::page')

@section('title', 'Contas a Receber')

@section('content_header')
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h3>Listagem - Contas a Receber</h3>
        </div>
        <div class="pull-right">            
            <a class="btn btn-success" style="margin: 10px;" href="{{ route('ctareceber.create') }}"><i class='fa fa-plus'></i> Novo</a>
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
        @include("forms.search",["rota" => "ctareceber"])
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-condensed table-hover" id="dest">
            <thead>
            <tr>
                <th width="115px">Vencimento</th>
                <th width="90px">Nº Doc</th>
                <th width="165px">Nome</th>
                <th width="65px">Parc</th>
                <th width="100px">Tp. Pagto</th>
                <th width="140px">Histórico</th>
                <th width="85px">$ Valor</th>
                <th width="110px">Pagamento</th>
                <th width="75px">Status</th>
                <th width="150px"><i class="fa fa-cogs"></i></th>                   
            </tr>     
            </thead>       
            <tbody>                
            @foreach ($ctarecebers as $ctareceber)
            @php                
                if ($ctareceber->st_status === '0' && strtotime($ctareceber->dt_vencimento) < strtotime(date("Y-m-d"))) {
                    $rowclass = 'label label-danger';
                    $status = 'Atrasado';
                    $disabled = '';
                }elseif ($ctareceber->st_status === '0' && strtotime($ctareceber->dt_vencimento) >= strtotime(date("Y-m-d"))) {
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
                <td><span style="display: none;">{{ empty($ctareceber->dt_vencimento) ? '' : $ctareceber->dt_vencimento->format("Y-m-d") }}</span>
                    {{ empty($ctareceber->dt_vencimento) ? '' : $ctareceber->dt_vencimento->format("d/m/Y") }}
                </td>
                <td>{{ $ctareceber->nr_documento }}</td>
                <td>{{ $ctareceber->nm_pessoa }}</td
                ><td>{{ $ctareceber->nr_parcela }}</td>
                <td>{{ $ctareceber->nm_tppagamento }}</td>                    
                <td>{{ $ctareceber->ds_historico }}</td>                    
                <td>{{ number_format($ctareceber->vl_apagar, 2, '.', '') }}</td>
                <td><span style="display: none;">{{ empty($ctareceber->dt_pagamento) ? '' : $ctareceber->dt_pagamento->format("Y-m-d") }}</span>
                    {{ empty($ctareceber->dt_pagamento) ? '' : $ctareceber->dt_pagamento->format("d/m/Y") }}
                </td>
                <td><span class="{{$rowclass}}">&nbsp;{{$status}}&nbsp;</span></td>
                <td>                 
                    <a class="btn btn-sm btn-info" href="{{ route('ctareceber.show',$ctareceber->id_ctareceber) }}"><i class='fa fa-eye'></i></a>                        
                    <a class="btn btn-sm btn-primary" {{$disabled}} href="{{ route('ctareceber.edit',$ctareceber->id_ctareceber) }}"><i class='fa fa-edit'></i></a>                                                       
                    <a class="btn btn-sm btn-danger" href="" data-target="#modal-delete-{{$ctareceber->id_ctareceber}}" data-toggle="modal"><i class='fa fa-trash'></i></a>
                </td>    
            </tr>
            @include('forms.modal',['action'=>'CtareceberController@destroy','id'=>$ctareceber->id_ctareceber])  
            @endforeach
        </tbody>
        </table>
    </div>      
    <div class="box-footer clearfix"> 
        <ul class="pagination pagination-sm no-margin pull-left">{{$ctarecebers->appends(['searchText' => $searchText])->links()}}</ul>
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
