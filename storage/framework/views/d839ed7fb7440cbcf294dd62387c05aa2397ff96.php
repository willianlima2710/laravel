

<?php $__env->startSection('title', 'Faixa de Acréscimo'); ?>

<?php $__env->startSection('content_header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>    

<!-- general form elements -->    
<div class='box box-primary box-solid'> 
    <div class='box-header with-border'>            
        <h3 class="box-title">Faixa de Acréscimo</h3>
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

    <form method="post" action="<?php echo e($action ?? url('fxacidade')); ?>">    
    <?php echo e(csrf_field()); ?>

    <?php if(isset($fxacidade)): ?> <?php echo e(method_field('patch')); ?> <?php endif; ?>

        <!-- /.box-header -->
        <div class="box-body">   
            <fieldset class="form-group">
                <input type="hidden" value="<?php echo e($fxacidade->id_fxacidade ?? ''); ?>" name="id_fxacidade" class="form-control">
                <div class="row">
                    <div class="form-group col-sm-6 mb-1">
                        <label for="nm_fxacidade" class="control-label">Nome</label>
                        <input type="text" class="form-control" value="<?php echo e($fxacidade->nm_fxacidade ?? ''); ?>" name="nm_fxacidade" maxlength="100" autocomplete="off" required>                    
                    </div>             
                    <div class="form-group col-sm-2 mb-1">
                        <label for="nr_idadeinicial" class="control-label">Idade inicial</label>
                        <input type="text" class="form-control" value="<?php echo e($fxacidade->nr_idadeinicial ?? ''); ?>" name="nr_idadeinicial" maxlength="6" autocomplete="off" required>                    
                    </div>             
                    <div class="form-group col-sm-2 mb-1">
                        <label for="nr_idadefinal" class="control-label">Idade final</label>
                        <input type="text" class="form-control" value="<?php echo e($fxacidade->nr_idadefinal ?? ''); ?>" name="nr_idadefinal" maxlength="6" autocomplete="off" required>                    
                    </div>             
                    <div class="form-group col-sm-2 mb-1">
                        <label for="vl_acrescentar" class="control-label">$ Valor</label>
                        <input type="text" class="form-control" value="<?php echo e($fxacidade->vl_acrescentar ?? ''); ?>" name="vl_acrescentar" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off">                  
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
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/wfuneraria/public_html/paranaluto/resources/views/forms/fxacidade.blade.php ENDPATH**/ ?>