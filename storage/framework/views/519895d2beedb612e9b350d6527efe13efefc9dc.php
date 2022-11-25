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
    $credito = 0;
    $debito = 0;
    $cont = 0;   
?>   

<table>        
    <thead>
        <tr>
            <th class="cabecalho" colspan="8">Relátorio de Fluxo de Caixa (Analítico) - Período: <?php echo e($dt_inicial); ?>  a <?php echo e($dt_final); ?></th>
        </tr>    
        <tr>
            <th width="60px" align='center'>Movto</th>
            <th width="255px">Nome</th>
            <th width="120px">Documento</th>
            <th width="30px" align='center'>Parc</th>
            <th width="70px" align='right'>$ Valor</th>
            <th width="80px" align='center'>Conta</th>
            <th width="50px" align='center'>Cheque</th>
            <th width="10px" align='center'>C/D</th>
        </tr>     
    </thead>       
    <tbody>                
    <?php $__currentLoopData = $caixas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $caixa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   
    <?php 
        $cont += 1;        
        if ($caixa->st_creddeb==='0') {
            $credito += $caixa->vl_total;
        }else{
            $debito += $caixa->vl_total;
        }
    ?>   
    <tr>
        <td align='center'><?php echo e(empty($caixa->dt_movimento) ? '' : $caixa->dt_movimento->format("d/m/Y")); ?></td>
        <td><?php echo e($caixa->nm_pessoa); ?></td>
        <td><?php echo e($caixa->nr_documento); ?></td>
        <td align='center'><?php echo e($caixa->nr_parcela); ?></td>
        <td align='right'><?php echo e(number_format($caixa->vl_total, 2, '.', '')); ?></td>
        <td align='center'><?php echo e($caixa->id_planoconta); ?></td>
        <td align='center'><?php echo e($caixa->nr_cheque); ?></td>
        <td align='center'><?php echo e(($caixa->st_creddeb==='0') ? 'C' : 'D'); ?></td>
    </tr>       
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
    <tr>
        <th>Totais:</th>
        <th colspan="1" style="color:blue;">Creditos: <?php echo e(number_format($credito, 2, '.', '')); ?></th>
        <th colspan="2" style="color:red;">Debitos: <?php echo e(number_format($debito, 2, '.', '')); ?></th>
        <th colspan="3">Saldo: <?php echo e(number_format($credito-$debito, 2, '.', '')); ?></th>
        <th></th>
    </tr>
    </tbody>
</table><?php /**PATH /home/webfuneraria/public_html/paranaluto/resources/views/relcaixa/pdfview.blade.php ENDPATH**/ ?>