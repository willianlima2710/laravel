<head>
<style rel="stylesheet" type="text/css">
table, th, td {    
    font-family: arial,sans-serif;
    font-size: 10px;
    border-collapse: collapse;
    border: 1px solid black;
}
caption {
    font-weight: bold;
    text-align: center;
    border: 1px solid black;
    border-color: #666666;
}
.cabecalho {
    font-family: arial,sans-serif;
    font-size: 12px;
    font-weight: bold;
    text-align: center;
}
</style>
</head>

@php 
    $apagar = 0;  
    $pago = 0;     
    $cont = 0;   
@endphp   

<table>        
    <thead>
        <tr>
            <th class="cabecalho" colspan="7">Relátorio de Contas a Pagar - Período: {{$dt_inicial}}  a {{$dt_final}} - {{$ds_status}}  </th>
        </tr>    
        <tr>
            <th width="60px" align='center'>Vencto</th>
            <th width="255px">Fornecedor</th>
            <th width="140px">Documento</th>
            <th width="30px" align='center'>Parc</th>
            <th width="70px" align='right'>$ Original</th>
            <th width="60px" align='center'>Pagto</th>
            <th width="70px" align='right'>$ Quitado</th>
        </tr>     
    </thead>       
    <tbody>                
    @foreach ($ctapagars as $ctapagar)   
    @php 
        $apagar += $ctapagar->vl_apagar;  
        $pago += $ctapagar->vl_pago;
        $cont += 1;        
    @endphp   
    <tr>
        <td align='center'>{{ empty($ctapagar->dt_vencimento) ? '' : $ctapagar->dt_vencimento->format("d/m/Y") }}</td>
        <td>{{ $ctapagar->nm_fornecedor }}</td>
        <td>{{ $ctapagar->nr_documento }}</td>
        <td align='center'>{{ $ctapagar->nr_parcela }}</td>
        <td align='right'>{{ number_format($ctapagar->vl_apagar, 2, '.', '') }}</td>
        <td align='center'>{{ empty($ctapagar->dt_pagamento) ? '' : $ctapagar->dt_pagamento->format("d/m/Y") }}</td>
        <td align='right'>{{ number_format($ctapagar->vl_pago, 2, '.', '') }}</td>
    </tr>       
    @endforeach 
    <tr>
        <th>Total</th>
        <th align='center'>{{ $cont }}</th>
        <th></th>
        <th></th>
        <th align='right'>{{ number_format($apagar,2, '.', '') }}</th>
        <th></th>
        <th align='right'>{{ number_format($pago,2, '.', '') }}</th>
    </tr>
    </tbody>
</table>