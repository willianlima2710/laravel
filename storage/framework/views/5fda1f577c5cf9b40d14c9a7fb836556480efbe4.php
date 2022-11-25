

<?php $__env->startSection('title', 'Funcionário'); ?>

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
        <h3><?php echo e($funcionario->nm_pessoa); ?> </h3>

        <div class="card">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Código:</b> <?php echo e($funcionario->id_pessoa); ?></li>
                <li class="list-group-item"><b>CPF:</b> <?php echo e($funcionario->nr_cpfcnpj); ?></li>
                <li class="list-group-item"><b>RG:</b> <?php echo e($funcionario->nr_rgie); ?></li>                
                <li class="list-group-item"><b>1º Telefone:</b> <?php echo e($funcionario->nr_telefone1); ?></li>
                <li class="list-group-item"><b>Cep:</b> <?php echo e($funcionario->nr_cep); ?></li>
                <li class="list-group-item"><b>Endereço:</b> <?php echo e($funcionario->nm_endereco); ?></li>
                <li class="list-group-item"><b>Nº:</b> <?php echo e($funcionario->nr_numender); ?></li>
                <li class="list-group-item"><b>Complemento:</b> <?php echo e($funcionario->nm_complender); ?></li>
                <li class="list-group-item"><b>Bairro:</b> <?php echo e($funcionario->nm_bairro); ?></li>
                <li class="list-group-item"><b>Cidade:</b> <?php echo e($funcionario->nm_cidade); ?></li>
                <li class="list-group-item"><b>Estado:</b> <?php echo e($funcionario->nm_estado); ?></li>
                <li class="list-group-item"><b>2º Telefone:</b> <?php echo e($funcionario->nm_telefone2); ?></li>
                <li class="list-group-item"><b>3º Telefone:</b> <?php echo e($funcionario->nm_telefone3); ?></li>
                <li class="list-group-item"><b>4º Telefone:</b> <?php echo e($funcionario->nm_telefone4); ?></li>
                <li class="list-group-item"><b>E-Mail:</b> <?php echo e($funcionario->nm_email); ?></li>                                               
                <li class="list-group-item"><b>Função:</b> <?php echo e($funcionario->nm_funcao); ?></li>
                <li class="list-group-item"><b>% Comissão na Venda:</b> <?php echo e($funcionario->vl_comprod); ?></li>
                <li class="list-group-item"><b>% Comissão no Serviço:</b> <?php echo e($funcionario->vl_comserv); ?></li>
                <li class="list-group-item"><b>Comissão na Cobrança?:</b> <?php echo e($funcionario->st_comcob); ?></li>
                <li class="list-group-item"><b>Valor Salário:</b> <?php echo e(number_format($funcionario->vl_salario,2, '.', '')); ?></li>
                <li class="list-group-item"><b>Admissão:</b> <?php echo e(empty($funcionario->dt_admissao) ? '' : $funcionario->dt_admissao->format("d/m/Y")); ?></li>
                <li class="list-group-item"><b>Demissão:</b> <?php echo e(empty($funcionario->dt_demissao) ? '' : $funcionario->dt_demissao->format("d/m/Y")); ?></li>
                <li class="list-group-item"><b>Nº Pis:</b> <?php echo e($funcionario->nr_pis); ?></li>
                <li class="list-group-item"><b>Nº CTPS:</b> <?php echo e($funcionario->nr_ctps); ?></li>
            </ul>
        </div>
        <hr>
        <a href="<?php echo e(url()->previous()); ?>" class="btn btn-primary">Voltar</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/webfuneraria/public_html/paranaluto/resources/views/funcionario/show.blade.php ENDPATH**/ ?>