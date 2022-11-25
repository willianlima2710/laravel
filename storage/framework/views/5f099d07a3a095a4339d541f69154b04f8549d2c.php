

<?php $__env->startSection('title', 'Custo Fixo'); ?>

<?php $__env->startSection('content_header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>    

<!-- general form elements -->    
<div class='box box-primary box-solid'> 
    <div class='box-header with-border'>            
        <h3 class="box-title">Custo Fixo</h3>
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

    <form method="post" action="<?php echo e($action ?? url('custo')); ?>">    
    <?php echo e(csrf_field()); ?>

    <?php if(isset($custo)): ?> <?php echo e(method_field('patch')); ?> <?php endif; ?>

        <!-- /.box-header -->
        <div class="box-body">   
            <fieldset class="form-group">            
                <input type="hidden" value="<?php echo e($custo->id_custo ?? ''); ?>" name="id_custo" class="form-control">
                <div class="row">
                    <div class="form-group col-sm-12 mb-3">
                        <label for="nm_custo" class="control-label">Nome</label>
                        <input type="text" class="form-control" value="<?php echo e($custo->nm_custo ?? ''); ?>" name="nm_custo" maxlength="100" autocomplete="off" required>
                    </div>     
                </div>           
                <div class="row"> 
                    <div class="form-group col-sm-4 mb-3">
                        <label for="vl_custo" class="control-label">Valor</label>
                        <input type="text" class="form-control" value="<?php echo e($custo->vl_custo ?? ''); ?>" name="vl_custo" maxlength="10" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off" required>
                    </div>   
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nr_dia" class="control-label">Dia</label>
                        <input type="text" class="form-control" value="<?php echo e($custo->nr_dia ?? ''); ?>" name="nr_dia" autocomplete="off" required>                    
                    </div>   
                    <div class="form-group col-sm-2 mb-1">
                        <label for="st_periodo" class="control-label">Periodo</label>
                        <select class="form-control" name="st_periodo" required>
                            <option value=""></option>
                            <?php $__currentLoopData = $periodo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $perid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(isset($custo)): ?>
                                    <?php if($perid['st_periodo']==$custo->st_periodo): ?>
                                    <option value="<?php echo e($perid['st_periodo']); ?>" selected>
                                    <?php echo e($perid['nm_periodo']); ?>

                                    </option>
                                    <?php else: ?>
                                    <option value="<?php echo e($perid['st_periodo']); ?>">
                                    <?php echo e($perid['nm_periodo']); ?>

                                    </option>
                                    <?php endif; ?>	         
                                <?php else: ?>                                    
                                    <option value="<?php echo e($perid['st_periodo']); ?>">
                                    <?php echo e($perid['nm_periodo']); ?>

                                    </option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>   
                </div>   
            </fieldset>   
            <!-- Dados complementares -->
            <fieldset class="form-group">
            <legend>Complementares</legend>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="nm_obs" class="control-label">Observação</label>
                        <textarea class="form-control" name="nm_obs" rows="5"><?php echo e($custo->nm_obs ?? ''); ?></textarea>
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
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/wfuneraria/public_html/paranaluto/resources/views/forms/custo.blade.php ENDPATH**/ ?>