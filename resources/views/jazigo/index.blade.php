@extends('adminlte::page')

@section('title', 'Jazigos')

@section('content_header')
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h3>Listagem - Jazigos</h3>
        </div>
        <div class="pull-right">            
            <a class="btn btn-success" style="margin: 10px;" href="{{ route('jazigo.create') }}"><i class='fa fa-plus'></i> Novo</a>
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
        @include("forms.search",["rota" => "jazigo"])
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-condensed table-hover" id="dest">
            <thead>
            <tr>
                <th width="115px">Código</th>                
                <th width="100px">Quadra</th>
                <th width="150px">Rua</th>
                <th width="150px">Setor</th>
                <th width="150px">Ocupado</th>
                <th width="150px">Ativo</th>
                <th width="150px">Granito</th>
                <th width="150px">Observação</th>
                <th width="150px"><i class="fa fa-cogs"></i></th>                   
            </tr>     
            </thead>       
            <tbody>                
            @foreach ($jazigos as $jazigo)
            @php                
                if ($jazigo->st_ocupado === 0) {
                    $rowclass01 = 'label label-primary';
                    $status = 'Não';
                }else{
                    $rowclass01 = 'label label-danger';
                    $status = 'Sim';
                }       

                if ($jazigo->st_ativo === 0) {
                    $rowclass02 = 'label label-default';
                    $ativo = 'Não';
                }else{
                    $rowclass02 = 'label label-primary';
                    $ativo = 'Sim';
                }    

                if($jazigo->st_granito === '0') {
                    $stgranito = 'SIM - EMPRESA';
                }elseif ($jazigo->st_granito === '1') {
                    $stgranito = 'SIM - CLIENTE';
                }else{
                    $stgranito = 'NÃO';
                }
            @endphp                 
            <tr>
                <td>{{ $jazigo->cd_jazigo }}</td>                
                <td>{{ $jazigo->cd_quadra }}</td>
                <td>{{ $jazigo->cd_rua }}</td>                    
                <td>{{ $jazigo->cd_setor }}</td>                    
                <td><span class="{{$rowclass01}}">&nbsp;{{$status}}&nbsp;</span></td>
                <td><span class="{{$rowclass02}}">&nbsp;{{$ativo}}&nbsp;</span></td>
                <td>{{ $stgranito }}</td>
                <td>{{ $jazigo->nm_obs }}</td>                    
                <td>                 
                    <a class="btn btn-sm btn-info" href="{{ route('jazigo.show',$jazigo->id_jazigo) }}"><i class='fa fa-eye'></i></a>                        
                    <a class="btn btn-sm btn-primary" href="{{ route('jazigo.edit',$jazigo->id_jazigo) }}"><i class='fa fa-edit'></i></a>                                                       
                    <a class="btn btn-sm btn-danger" href="" data-target="#modal-delete-{{$jazigo->id_jazigo}}" data-toggle="modal"><i class='fa fa-trash'></i></a>
                </td>    
            </tr>
            @include('forms.modal',['action'=>'JazigoController@destroy','id'=>$jazigo->id_jazigo])  
            @endforeach
        </tbody>
        </table>
    </div>      
    <div class="box-footer clearfix"> 
        <ul class="pagination pagination-sm no-margin pull-left">{{$jazigos->appends(['searchText' => $searchText])->links()}}</ul>
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
