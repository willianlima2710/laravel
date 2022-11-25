<?php $__env->startSection('title', 'Contas Bancárias'); ?>

<?php $__env->startSection('content_header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>    

<!-- general form elements -->    
<div class='box box-primary box-solid'> 
    <div class='box-header with-border'>            
        <h3 class="box-title">Contas Bancárias</h3>
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>

    <form method="post" action="<?php echo e($action ?? url('banco')); ?>">    
    <?php echo e(csrf_field()); ?>

    <?php if(isset($banco)): ?> <?php echo e(method_field('patch')); ?> <?php endif; ?>

        <!-- /.box-header -->
        <div class="box-body">   
            <fieldset class="form-group">
                <input type="hidden" value="<?php echo e($banco->id_banco ?? ''); ?>" name="id_banco" class="form-control">
                <div class="row">
                    <div class="form-group col-sm-12 mb-1">
                        <label for="nm_banco" class="control-label">Nome</label>
                        <input type="text" class="form-control" value="<?php echo e($banco->nm_banco ?? ''); ?>" name="nm_banco" maxlength="100" autocomplete="off" required>                    
                    </div>                                 
                </div>    
                <div class="row">
                    <div class="form-group col-sm-4 mb-1">
                        <label for="cd_banco" class="control-label">Código</label>
                        <input type="text" class="form-control" value="<?php echo e($banco->cd_banco ?? ''); ?>" name="cd_banco" maxlength="4" onkeypress="$(this).mask('9999')" autocomplete="off">                    
                    </div>                                 
                    <div class="form-group col-sm-4 mb-1">
                        <label for="nr_agencia" class="control-label">Agencia</label>
                        <input type="text" class="form-control" value="<?php echo e($banco->nr_agencia ?? ''); ?>" name="nr_agencia" maxlength="4" onkeypress="$(this).mask('9999')" autocomplete="off">                    
                    </div>                                 
                    <div class="form-group col-sm-4 mb-1">
                        <label for="nr_conta" class="control-label">Conta</label>
                        <input type="text" class="form-control" value="<?php echo e($banco->nr_conta ?? ''); ?>" name="nr_conta" maxlength="20" autocomplete="off">                    
                    </div>                                 
                </div>    
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="nm_obs" class="control-label">Observação</label>
                        <textarea class="form-control" rows="5" name='nm_obs'><?php echo e($banco->nm_obs ?? ''); ?></textarea>
                    </div>                            
                </div> 
            </fieldset>                                    
        </div>   
        <!-- /.box-body --> 
        <div class="box-footer">        
            <div class="pull-right">
                <button class="btn btn-primary" type="submit">Salvar</button>
                <a class="btn btn-danger" href="<?php echo e(url()->previous()); ?>">Cancelar</a>
            </div>       
        </div>    
    </form>
</div>         
            
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp73\htdocs\funeraria\resources\views/forms/banco.blade.php ENDPATH**/ ?>