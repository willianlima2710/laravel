

<?php $__env->startSection('title', 'Jazigo'); ?>

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
        <h3><?php echo e($jazigo->nm_jazigo); ?> </h3>

        <div class="card">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Id:</b> <?php echo e($jazigo->id_jazigo); ?></li>
                <li class="list-group-item"><b>Código:</b> <?php echo e($jazigo->cd_jazigo); ?></li>
                <li class="list-group-item"><b>Quadra:</b> <?php echo e($jazigo->cd_quadra); ?></li>                
                <li class="list-group-item"><b>Rua:</b> <?php echo e($jazigo->cd_rua); ?></li>
                <li class="list-group-item"><b>Setor:</b> <?php echo e($jazigo->cd_setor); ?></li>
                <li class="list-group-item"><b>Ocupado:</b> <?php echo e($jazigo->st_ocupado); ?></li>
                <li class="list-group-item"><b>Ativo:</b> <?php echo e($jazigo->st_ativo); ?></li>
                <li class="list-group-item"><b>Granito:</b> <?php echo e($jazigo->st_granito); ?></li>
                <li class="list-group-item"><b>Observação:</b> <?php echo e($jazigo->nm_obs); ?></li>
            </ul>
        </div>
        <hr>
        <a href="<?php echo e(url()->previous()); ?>" class="btn btn-primary">Voltar</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/webfuneraria/public_html/paranaluto/resources/views/jazigo/show.blade.php ENDPATH**/ ?>