

<?php $__env->startSection('title', 'Veículo'); ?>

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
        <h3><?php echo e($veiculo->nm_fornecedor); ?> </h3>

        <div class="card">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Código:</b> <?php echo e($veiculo->id_veiculo); ?></li>
                <li class="list-group-item"><b>Placa:</b> <?php echo e($veiculo->nr_placa); ?></li>
                <li class="list-group-item"><b>Marca:</b> <?php echo e($veiculo->nm_marca); ?></li>                
                <li class="list-group-item"><b>Cor:</b> <?php echo e($veiculo->nm_cor); ?></li>
                <li class="list-group-item"><b>Ano:</b> <?php echo e($veiculo->nr_ano); ?></li>
                <li class="list-group-item"><b>Seguradora:</b> <?php echo e($veiculo->nm_seguradora); ?></li>
                <li class="list-group-item"><b>Data da Vigencia:</b> <?php echo e(empty($veiculo->dt_vigencia) ? '' : $veiculo->dt_vigencia->format('d/m/Y') ?? ''); ?></li>
                <li class="list-group-item"><b>Condutor:</b> <?php echo e($veiculo->nm_condutor); ?></li>
                <li class="list-group-item"><b>Ult. Manutenção:</b> <?php echo e(empty($veiculo->dt_manutencao) ? '' : $veiculo->dt_manutencao->format('d/m/Y') ?? ''); ?></li>
            </ul>
        </div>
        <hr>
        <a href="<?php echo e(url()->previous()); ?>" class="btn btn-primary">Voltar</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/webfuneraria/public_html/paranaluto/resources/views/veiculo/show.blade.php ENDPATH**/ ?>