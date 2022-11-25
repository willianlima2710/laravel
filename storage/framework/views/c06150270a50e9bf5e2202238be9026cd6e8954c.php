

<?php $__env->startSection('title', 'Cemitérios'); ?>

<?php $__env->startSection('content_header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>    

<!-- general form elements -->    
<div class='box box-primary box-solid'> 
    <div class='box-header with-border'>            
        <h3 class="box-title">Cemitérios</h3>
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

    <form method="post" action="<?php echo e($action ?? url('cemiterio')); ?>">    
    <?php echo e(csrf_field()); ?>

    <?php if(isset($cemiterio)): ?> <?php echo e(method_field('patch')); ?> <?php endif; ?>

        <!-- /.box-header -->
        <div class="box-body">   
            <fieldset class="form-group">
                <input type="hidden" value="<?php echo e($cemiterio->id_cemiterio ?? ''); ?>" name="id_cemiterio" class="form-control">
                <div class="row">
                    <div class="form-group col-sm-12 mb-1">
                        <label for="nm_cemiterio" class="control-label">Nome</label>
                        <input type="text" class="form-control" value="<?php echo e($cemiterio->nm_cemiterio ?? ''); ?>" name="nm_cemiterio" maxlength="100" autocomplete="off" required>                    
                    </div>             
                </div>    
                <div class="row">
                    <div class="form-group col-sm-8 mb-1">
                        <label for="nm_endereco" class="control-label">Endereço</label>
                        <input type="text" class="form-control" value="<?php echo e($cemiterio->nm_endereco ?? ''); ?>" name="nm_endereco" maxlength="100" autocomplete="off" required>                    
                    </div>             
                    <div class="form-group col-sm-2 mb-1">
                        <label for="nr_numender" class="control-label">Nº</label>
                        <input type="text" class="form-control" value="<?php echo e($cemiterio->nr_numender ?? ''); ?>" name="nr_numender" maxlength="5" onkeypress="$(this).mask('99999')" autocomplete="off" required>                    
                    </div>             
                    <div class="form-group col-sm-2 mb-1">
                        <label for="nm_bairro" class="control-label">Bairro</label>
                        <input type="text" class="form-control" value="<?php echo e($cemiterio->nm_bairro ?? ''); ?>" name="nm_bairro" maxlength="60" autocomplete="off" required>                    
                    </div>             
                </div>
                <div class="row">    
                    <div class="form-group col-sm-8 mb-1">
                        <label for="nm_cidade" class="control-label">Cidade</label>
                        <input type="text" class="form-control" value="<?php echo e($cemiterio->nm_cidade ?? ''); ?>" name="nm_cidade" maxlength="60" autocomplete="off" required>                    
                    </div>             
                    <div class="form-group col-sm-4 mb-1">
                        <label for="nm_estado" class="control-label">Estado</label>
                        <select class="form-control" name="nm_estado" required>
                            <option value=""></option>
                            <?php $__currentLoopData = $estados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $estado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(isset($cemiterio)): ?>
                                    <?php if($estado->nm_sigla==$cemiterio->nm_estado): ?>
                                    <option value="<?php echo e($estado->nm_sigla); ?>" selected>
                                    <?php echo e($estado->nm_estado); ?>

                                    </option>
                                    <?php else: ?>
                                    <option value="<?php echo e($estado->nm_sigla); ?>">
                                    <?php echo e($estado->nm_estado); ?>

                                    </option>
                                    <?php endif; ?>	         
                                <?php else: ?>                                    
                                    <option value="<?php echo e($estado->nm_sigla); ?>">
                                    <?php echo e($estado->nm_estado); ?>

                                    </option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
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
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/webfuneraria/public_html/paranaluto/resources/views/forms/cemiterio.blade.php ENDPATH**/ ?>