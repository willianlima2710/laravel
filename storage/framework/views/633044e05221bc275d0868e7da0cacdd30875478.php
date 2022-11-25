

<?php $__env->startSection('title', 'Fornecedor'); ?>

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
        <h3><?php echo e($fornecedor->nm_fornecedor); ?> </h3>

        <div class="card">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>CNPJ/CPF:</b> <?php echo e($fornecedor->nr_cpfcnpj); ?></li>
                <li class="list-group-item"><b>IE/RG:</b> <?php echo e($fornecedor->nr_rgie); ?></li>
                <li class="list-group-item"><b>1º Telefone:</b> <?php echo e($fornecedor->nr_telefone1); ?></li>                
                <li class="list-group-item"><b>2º Telefone:</b> <?php echo e($fornecedor->nr_telefone2); ?></li>
                <li class="list-group-item"><b>3º Telefone:</b> <?php echo e($fornecedor->nr_telefone3); ?></li>
                <li class="list-group-item"><b>4º Telefone:</b> <?php echo e($fornecedor->nr_telefone4); ?></li>
                <li class="list-group-item"><b>CEP:</b> <?php echo e($fornecedor->nr_cep); ?></li>
                <li class="list-group-item"><b>Endereço:</b> <?php echo e($fornecedor->nm_endereco); ?></li>
                <li class="list-group-item"><b>Numero:</b> <?php echo e($fornecedor->nr_numender); ?></li>
                <li class="list-group-item"><b>Complemento:</b> <?php echo e($fornecedor->nm_complender); ?></li>
                <li class="list-group-item"><b>Bairro:</b> <?php echo e($fornecedor->nm_bairro); ?></li>
                <li class="list-group-item"><b>Cidade:</b> <?php echo e($fornecedor->nm_cidade); ?></li>
                <li class="list-group-item"><b>Estado:</b> <?php echo e($fornecedor->nm_estado); ?></li>
                <li class="list-group-item"><b>Contato:</b> <?php echo e($fornecedor->nm_contato); ?></li>
                <li class="list-group-item"><b>E-Mail:</b> <?php echo e($fornecedor->nm_email); ?></li>                                               
                <li class="list-group-item"><b>Site:</b> <?php echo e($fornecedor->nm_site); ?></li>                                               
                <li class="list-group-item"><b>Observação:</b> <?php echo e($fornecedor->nm_obs); ?></li>
            </ul>
        </div>
        <hr>
        <a href="<?php echo e(url()->previous()); ?>" class="btn btn-primary">Voltar</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/webfuneraria/public_html/paranaluto/resources/views/fornecedor/show.blade.php ENDPATH**/ ?>