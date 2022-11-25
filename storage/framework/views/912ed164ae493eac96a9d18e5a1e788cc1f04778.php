

<?php $__env->startSection('title', 'Plano de Conta'); ?>

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
        <h3><?php echo e($planoconta->nm_planoconta); ?> </h3>

        <div class="card">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Id:</b> <?php echo e($planoconta->id_planoconta); ?></li>
                <li class="list-group-item"><b>Código:</b> <?php echo e($planoconta->cd_conta); ?></li>
                <li class="list-group-item"><b>Pai:</b> <?php echo e($planoconta->cd_pai); ?></li>                
                <li class="list-group-item"><b>Ordem:</b> <?php echo e($planoconta->nr_ordem); ?></li>
                <li class="list-group-item"><b>Reduzido:</b> <?php echo e($planoconta->cd_reduzido); ?></li>
                <li class="list-group-item"><b>Tipo:</b> <?php echo e($planoconta->st_tipo); ?></li>
            </ul>
        </div>
        <hr>
        <a href="<?php echo e(url()->previous()); ?>" class="btn btn-primary">Voltar</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/webfuneraria/public_html/paranaluto/resources/views/planoconta/show.blade.php ENDPATH**/ ?>