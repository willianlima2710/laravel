

<?php $__env->startSection('title', 'Plano de Conta'); ?>

<?php $__env->startSection('content_header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>    

<!-- general form elements -->    
<div class='box box-primary box-solid'> 
    <div class='box-header with-border'>            
        <h3 class="box-title">Plano de Conta</h3>
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

    <form method="post" action="<?php echo e($action ?? url('planoconta')); ?>">    
    <?php echo e(csrf_field()); ?>

    <?php if(isset($planoconta)): ?> <?php echo e(method_field('patch')); ?> <?php endif; ?>

        <!-- /.box-header -->
        <div class="box-body">   
            <fieldset class="form-group">                    
                <input type="hidden" value="<?php echo e($planoconta->id_planoconta ?? ''); ?>" name="id_planoconta" class="form-control">
                <div class="row">
                    <div class="form-group col-sm-12 mb-3">
                        <label for="nm_planoconta" class="control-label">Nome</label>
                        <input type="text" class="form-control" value="<?php echo e($planoconta->nm_planoconta ?? ''); ?>" name="nm_planoconta" maxlength="100" autocomplete="off" required>
                    </div>     
                </div>           
                <div class="row"> 
                    <div class="form-group col-sm-8 mb-3">
                        <label for="cd_conta" class="control-label">Código</label>
                        <input type="text" class="form-control" value="<?php echo e($planoconta->cd_conta ?? ''); ?>" name="cd_conta" autocomplete="off" required>                    
                    </div>   
                    <div class="form-group col-sm-4 mb-1">
                        <label for="st_tipo" class="control-label">Tipo</label>
                        <select class="form-control" name="st_tipo" required>
                            <option value=""></option>
                            <?php $__currentLoopData = $tipo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(isset($planoconta)): ?>
                                    <?php if($tip['st_tipo']==$planoconta->st_tipo): ?>
                                    <option value="<?php echo e($tip['st_tipo']); ?>" selected>
                                    <?php echo e($tip['nm_tipo']); ?>

                                    </option>
                                    <?php else: ?>
                                    <option value="<?php echo e($tip['st_tipo']); ?>">
                                    <?php echo e($tip['nm_tipo']); ?>

                                    </option>
                                    <?php endif; ?>	         
                                <?php else: ?>                                    
                                    <option value="<?php echo e($tip['st_tipo']); ?>">
                                    <?php echo e($tip['nm_tipo']); ?>

                                    </option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>    
                </div>   
                <div class="row">
                    <div class="form-group col-sm-4 mb-3">
                        <label for="cd_pai" class="control-label">Código Pai</label>
                        <input type="text" class="form-control" value="<?php echo e($planoconta->cd_pai ?? ''); ?>" name="cd_pai" autocomplete="off" required>                    
                    </div>                        
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nr_ordem" class="control-label">Ordem</label>
                        <input type="text" class="form-control" value="<?php echo e($planoconta->nr_ordem ?? ''); ?>" name="nr_ordem" autocomplete="off" required>     
                    </div>    
                    <div class="form-group col-sm-4 mb-3">
                        <label for="cd_reduzido" class="control-label">Código Reduzido</label>
                        <input type="text" class="form-control" value="<?php echo e($planoconta->cd_reduzido ?? ''); ?>" name="cd_reduzido" autocomplete="off" required>     
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
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/webfuneraria/public_html/paranaluto/resources/views/forms/planoconta.blade.php ENDPATH**/ ?>