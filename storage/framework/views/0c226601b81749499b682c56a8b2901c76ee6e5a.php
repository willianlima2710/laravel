

<?php $__env->startSection('title', 'Fluxo de Caixa'); ?>

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
        <h3><?php echo e($caixa->nm_pessoa); ?> </h3>

        <div class="card">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Nº Documento:</b> <?php echo e($caixa->nr_documento); ?></li>
                <li class="list-group-item"><b>Nº Parcela:</b> <?php echo e($caixa->nr_parcela); ?></li>
                <li class="list-group-item"><b>Vencimento:</b> <?php echo e(empty($caixa->dt_vencimento) ? '' : $caixa->dt_vencimento->format("d/m/Y")); ?></li>                
                <li class="list-group-item"><b>$ Valor:</b> <?php echo e(number_format($caixa->vl_total,2, '.', '')); ?></li>
                <li class="list-group-item"><b>Tipo de Pagamento:</b> <?php echo e($caixa->nm_tppagamento); ?></li>
                <li class="list-group-item"><b>Pagamento:</b> <?php echo e(empty($caixa->dt_pagamento) ? '' : $caixa->dt_pagamento->format("d/m/Y")); ?></li>
                <li class="list-group-item"><b>Movimento:</b> <?php echo e(empty($caixa->dt_movimento) ? '' : $caixa->dt_movimento->format("d/m/Y")); ?></li>                
                <li class="list-group-item"><b>$ Juros:</b> <?php echo e(number_format($caixa->vl_juros,2, '.', '')); ?></li>
                <li class="list-group-item"><b>$ Multa:</b> <?php echo e(number_format($caixa->vl_multa,2, '.', '')); ?></li>
                <li class="list-group-item"><b>Banco:</b> <?php echo e($caixa->nm_banco); ?></li>
                <li class="list-group-item"><b>Plano de Contas:</b> <?php echo e($caixa->nm_planoconta); ?></li>
                <li class="list-group-item"><b>Agencia:</b> <?php echo e($caixa->cd_agencia); ?></li>
                <li class="list-group-item"><b>Conta:</b> <?php echo e($caixa->nr_conta); ?></li>
                <li class="list-group-item"><b>Cheque:</b> <?php echo e($caixa->nr_cheque); ?></li>
                <li class="list-group-item"><b>Histório:</b> <?php echo e($caixa->ds_historico); ?></li>                                               
                <li class="list-group-item"><b>Observação:</b> <?php echo e($caixa->nm_obs); ?></li>
            </ul>
        </div>
        <hr>
        <a href="<?php echo e(url()->previous()); ?>" class="btn btn-primary">Voltar</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/wfuneraria/public_html/paranaluto/resources/views/caixa/show.blade.php ENDPATH**/ ?>