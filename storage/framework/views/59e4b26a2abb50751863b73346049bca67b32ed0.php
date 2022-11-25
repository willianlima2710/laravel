

<?php $__env->startSection('title', 'Tipo de Pagamento'); ?>

<?php $__env->startSection('content_header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>    

<!-- general form elements -->    
<div class='box box-primary box-solid'> 
    <div class='box-header with-border'>            
        <h3 class="box-title">Tipo de Pagamento</h3>
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

    <form method="post" action="<?php echo e($action ?? url('tppagamento')); ?>">    
    <?php echo e(csrf_field()); ?>

    <?php if(isset($tppagamento)): ?> <?php echo e(method_field('patch')); ?> <?php endif; ?>

        <!-- /.box-header -->
        <div class="box-body">   
            <fieldset class="form-group">
                <input type="hidden" value="<?php echo e($tppagamento->id_tppagamento ?? ''); ?>" name="id_tppagamento" class="form-control">
                <div class="row">
                    <div class="form-group col-sm-10 mb-1">
                        <label for="nm_tppagamento" class="control-label">Nome</label>
                        <input type="text" class="form-control" value="<?php echo e($tppagamento->nm_tppagamento ?? ''); ?>" name="nm_tppagamento" maxlength="100" autocomplete="off" required>                    
                    </div>         
                    <div class="form-group col-sm-2 mb-3">                                    
                        <label for="st_avista" class="control-label">A Vista ?</label>
                        <?php if(isset($tppagamento)): ?>                        
                            <?php if($tppagamento->st_avista===1): ?>
                                <input type="checkbox" class="checkbox" value="<?php echo e($tppagamento->st_avista ?? ''); ?>" checked name='st_avista' >
                            <?php else: ?> 
                                <input type="checkbox" class="checkbox" value="<?php echo e($tppagamento->st_avista ?? ''); ?>" name='st_avista'>
                            <?php endif; ?> 
                        <?php else: ?>
                            <input type="checkbox" class="checkbox" value="<?php echo e($tppagamento->st_avista ?? ''); ?>" name='st_avista'>
                        <?php endif; ?>                                
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
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/wfuneraria/public_html/paranaluto/resources/views/forms/tppagamento.blade.php ENDPATH**/ ?>