

<?php $__env->startSection('title', 'Plano'); ?>

<?php $__env->startSection('content_header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <h2>Consulta</h2>
        <div class="flash-message">
            <?php $__currentLoopData = ['danger', 'warning', 'success', 'info']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(Session::has('alert-' . $msg)): ?>

                <p class="alert alert-<?php echo e($msg); ?>"><?php echo e(Session::get('alert-' . $msg)); ?> <a href="#" class="close" data-dismiss="alert" aria-label="fechar">&times;</a></p>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <h3><?php echo e($plano->nm_plano); ?> </h3>

        <div class="card">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Código:</b> <?php echo e($plano->id_plano); ?></li>
                <li class="list-group-item"><b>$ Cobertura:</b> <?php echo e(number_format($plano->vl_cobertura,2, '.', '')); ?></li>
                <li class="list-group-item"><b>KM Incluido:</b> <?php echo e($plano->vl_kmincluido); ?></li>                
                <li class="list-group-item"><b>$ Valor:</b> <?php echo e(number_format($plano->vl_plano,2, '.', '')); ?></li>
                <li class="list-group-item"><b>% Salario:</b> <?php echo e($plano->vl_salminino); ?></li>
                <li class="list-group-item"><b>$ Juros:</b> <?php echo e(number_format($plano->vl_jurosdia,2, '.', '')); ?></li>
                <li class="list-group-item"><b>$ Multa:</b> <?php echo e(number_format($plano->vl_multa,2, '.', '')); ?></li>
                <li class="list-group-item"><b>$ Adesão:</b> <?php echo e(number_format($plano->vl_adesao,2, '.', '')); ?></li>
                <li class="list-group-item"><b>Observação:</b> <?php echo e($plano->nm_obs); ?></li>
            </ul>
        </div>
        <hr>
        <a href="<?php echo e(url()->previous()); ?>" class="btn btn-primary">Voltar</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/wfuneraria/public_html/anjogabriel/resources/views/plano/show.blade.php ENDPATH**/ ?>