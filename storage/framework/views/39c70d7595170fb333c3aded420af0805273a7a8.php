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

<?php 
    $apagar = 0;  
    $pago = 0;     
    $cont = 0;   
?>   

<table>        
    <thead>
        <tr>
            <th class="cabecalho" colspan="7">Relátorio de Contas a Pagar - Período: <?php echo e($dt_inicial); ?>  a <?php echo e($dt_final); ?> - <?php echo e($ds_status); ?>  </th>
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
    <?php $__currentLoopData = $ctapagars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ctapagar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   
    <?php 
        $apagar += $ctapagar->vl_apagar;  
        $pago += $ctapagar->vl_pago;
        $cont += 1;        
    ?>   
    <tr>
        <td align='center'><?php echo e(empty($ctapagar->dt_vencimento) ? '' : $ctapagar->dt_vencimento->format("d/m/Y")); ?></td>
        <td><?php echo e($ctapagar->nm_fornecedor); ?></td>
        <td><?php echo e($ctapagar->nr_documento); ?></td>
        <td align='center'><?php echo e($ctapagar->nr_parcela); ?></td>
        <td align='right'><?php echo e(number_format($ctapagar->vl_apagar, 2, '.', '')); ?></td>
        <td align='center'><?php echo e(empty($ctapagar->dt_pagamento) ? '' : $ctapagar->dt_pagamento->format("d/m/Y")); ?></td>
        <td align='right'><?php echo e(number_format($ctapagar->vl_pago, 2, '.', '')); ?></td>
    </tr>       
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
    <tr>
        <th>Total</th>
        <th align='center'><?php echo e($cont); ?></th>
        <th></th>
        <th></th>
        <th align='right'><?php echo e(number_format($apagar,2, '.', '')); ?></th>
        <th></th>
        <th align='right'><?php echo e(number_format($pago,2, '.', '')); ?></th>
    </tr>
    </tbody>
</table><?php /**PATH /home/wfuneraria/public_html/paranaluto/resources/views/relctapagar/pdfview.blade.php ENDPATH**/ ?>