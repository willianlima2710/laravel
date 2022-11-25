<head>
<style rel="stylesheet" type="text/css">
table, th, td {    
    font-family: arial,sans-serif;
    font-size: 11px;
    border-collapse: collapse;    
}
.caption {
    font-weight: bold;
    font-family: arial,sans-serif;
    font-size: 11px;
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
.conta {
    font-weight: bold;
    font-family: arial,sans-serif;
    font-size: 11px;
    border: 1px solid black;
    border-color: #666666;
}
</style>
</head>
<table>        
    <thead>
        <tr>
            <th class="cabecalho" colspan="7" style="border: 1px solid black;">Relátorio de Fluxo de Caixa (Analítico) - Período: <?php echo e($dt_inicial); ?>  a <?php echo e($dt_final); ?></th>
        <tr>
            <th width="50px" align='center' class='caption'>Movto</th>
            <th width="255px" class='caption'>Nome</th>
            <th width="90px" align='center' class='caption'>Documento</th>
            <th width="30px" align='center' class='caption'>Cheque</th>
            <th width="50px" align='right' class ='caption' style="color:blue;">$ Credito</th>
            <th width="50px" align='right' class ='caption' style="color:red;">$ Debito</th>  
            <th width="50px" align='right' class ='caption'>$ Saldo</th>          
        </tr>     
    </thead>       
    <tbody> 
    <?php 
       $idplanoconta = '';
       $cont = 0;
       $totcredito = 0;
       $totdebito = 0;
       $valcredito = 0;
       $valdebito = 0;
       $valsaldo = 52771.11;
    ?>               
    <?php $__currentLoopData = $caixas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $caixa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   
    <?php 
       $cont += 1;
       if ($caixa->st_creddeb==='0') {
           $totcredito += $caixa->vl_total;
           $valsaldo += $caixa->vl_total;
       }else{
           $totdebito += $caixa->vl_total;
           $valsaldo -= $caixa->vl_total;
       }                                
    ?>           
    <tr>
       <?php if($idplanoconta!==$caixa->id_planoconta): ?> 
           <?php if($cont==1): ?>
               <tr>                 
                 <th align='left' class ='conta' colspan="7"><?php echo e($caixa->cd_conta.' - '.$caixa->nm_planoconta); ?></th>        
               </tr>
           <?php else: ?>
               <tr>
                 <th></th>
                 <th></th>
                 <th></th>
                 <th></th>
                 <th align='right' style="color:blue;"><?php echo e(number_format($valcredito, 2, '.', '')); ?></th>
                 <th align='right' style="color:red;"><?php echo e(number_format($valdebito, 2, '.', '')); ?></th>
                 <th align='right'>Saldo: <?php echo e(number_format($valsaldo, 2, '.', '')); ?></th>
               </tr>
               <tr>                 
                 <th align='left' class ='conta' colspan="7"><?php echo e($caixa->cd_conta.' - '.$caixa->nm_planoconta); ?></th>        
               </tr>            
           <?php endif; ?>    
           <?php 
             $idplanoconta = $caixa->id_planoconta;
             $valcredito = ($caixa->st_creddeb==='0') ? $caixa->vl_total : 0; 
             $valdebito = ($caixa->st_creddeb==='1') ? $caixa->vl_total : 0;              
           ?>
       <?php else: ?>          
           <?php 
             $valcredito += ($caixa->st_creddeb==='0') ? $caixa->vl_total : 0; 
             $valdebito += ($caixa->st_creddeb==='1') ? $caixa->vl_total : 0;
             $idplanoconta = $caixa->id_planoconta;
           ?>
       <?php endif; ?>
       <td align='center'><?php echo e($caixa->dt_movimento->format("d/m/Y")); ?></td>
       <td><?php echo e($caixa->nm_pessoa); ?></td>
       <td align='center'><?php echo e($caixa->nr_documento); ?></td>
       <td align='center'><?php echo e($caixa->nr_cheque); ?></td>
       <td align='right'><?php echo e(($caixa->st_creddeb==='0') ? number_format($caixa->vl_total, 2, '.', '') : '0.00'); ?></td>
       <td align='right'><?php echo e(($caixa->st_creddeb==='1') ? number_format($caixa->vl_total, 2, '.', '') : '0.00'); ?></td>
       <td align='right'><?php echo e(number_format($valsaldo, 2, '.', '')); ?></td>        
    </tr>           
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
    <tr>
       <th class ='caption'>Totais:</th>
       <th class ='caption'><?php echo e('Registros: '.$cont); ?></th>
       <th class ='caption'></th>
       <th class ='caption'></th>
       <th class ='caption' style="color:blue;"><?php echo e(number_format($totcredito, 2, '.', '')); ?></th>
       <th class ='caption' style="color:red;"><?php echo e(number_format($totdebito, 2, '.', '')); ?></th>
       <th class ='caption'>Saldo: <?php echo e(number_format($totcredito-$totdebito, 2, '.', '')); ?></th>
    </tr>
    </tbody>
</table><?php /**PATH /home/u203739344/domains/erpvip.com.br/public_html/paranaluto/resources/views/relcaixa/pdfview.blade.php ENDPATH**/ ?>