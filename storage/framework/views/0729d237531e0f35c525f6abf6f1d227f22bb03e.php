<table border="1" cellspacing="1" cellpadding="10" width ="100%">
            <thead>
            <tr>
                <th>Data Inc</th>
                <th>Nº Contrato</th>
                <th>Nome</th>
                <th>$ Valor</th>
            </tr>     
            </thead>       
            <tbody>                
            <?php $__currentLoopData = $contratos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contrato): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>            
            <tr>
                <td><?php echo e(empty($contrato->dt_inccontrato) ? '' : $contrato->dt_inccontrato->format("d/m/Y")); ?></td>
                <td><?php echo e($contrato->nr_contrato); ?></td>
                <td><?php echo e($contrato->nm_pessoa); ?></td>
                <td><?php echo e(number_format($contrato->vl_total, 2, '.', '')); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        </table><?php /**PATH /home/webfuneraria/public_html/paranaluto/resources/views/contrato/pdfview.blade.php ENDPATH**/ ?>