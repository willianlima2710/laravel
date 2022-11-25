

<?php $__env->startSection('title', 'Jazigo'); ?>

<?php $__env->startSection('content_header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>    

<!-- general form elements -->    
<div class='box box-primary box-solid'> 
    <div class='box-header with-border'>            
        <h3 class="box-title">Jazigo</h3>
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

    <form method="post" action="<?php echo e($action ?? url('jazigo')); ?>">    
    <?php echo e(csrf_field()); ?>

    <?php if(isset($jazigo)): ?> <?php echo e(method_field('patch')); ?> <?php endif; ?>

        <!-- /.box-header -->
        <div class="box-body">   
            <fieldset class="form-group">
                <input type="hidden" value="<?php echo e($jazigo->id_jazigo ?? ''); ?>" name="id_jazigo" class="form-control">
                <div class="row">
                    <div class="form-group col-sm-4 mb-3">
                        <label for="cd_jazigo" class="control-label">Código</label>
                        <input type="text" class="form-control" value="<?php echo e($jazigo->cd_jazigo ?? ''); ?>" name="cd_jazigo" maxlength="10" autocomplete="off" required>
                    </div>             
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_jazigo" class="control-label">Nome</label>
                        <input type="text" class="form-control" value="<?php echo e($jazigo->nm_jazigo ?? ''); ?>" name="nm_jazigo" maxlength="100" autocomplete="off" required>                    
                    </div>               
                    <div class="form-group col-sm-2 mb-3">
                        <label for="cd_quadra" class="control-label">Quadra</label>
                        <input type="text" class="form-control" value="<?php echo e($jazigo->cd_quadra ?? ''); ?>" name="cd_quadra" autocomplete="off" maxlength="10">                    
                    </div>                        
                    <div class="form-group col-sm-2 mb-3">
                        <label for="cd_rua" class="control-label">Rua</label>
                        <input type="text" class="form-control" value="<?php echo e($jazigo->cd_rua ?? ''); ?>" name="cd_rua" maxlength="10" autocomplete="off">     
                    </div>    
                </div>    
                <div class="row">
                    <div class="form-group col-sm-4 mb-3">
                        <label for="cd_setor" class="control-label">Setor</label>
                        <input type="text" class="form-control" value="<?php echo e($jazigo->cd_setor ?? ''); ?>" name="cd_setor" maxlength="10" autocomplete="off">     
                    </div>
                    <div class="form-group col-sm-2 mb-3">                                    
                        <label for="st_ocupado" class="control-label">Ocupado ?</label>
                        <?php if(isset($jazigo)): ?>                        
                            <?php if($jazigo->st_ocupado===1): ?>
                                <input type="checkbox" class="checkbox" value="<?php echo e($jazigo->st_ocupado ?? ''); ?>" checked name='st_ocupado' >
                            <?php else: ?> 
                                <input type="checkbox" class="checkbox" value="<?php echo e($jazigo->st_ocupado ?? ''); ?>" name='st_ocupado'>
                            <?php endif; ?> 
                        <?php else: ?>
                            <input type="checkbox" class="checkbox" value="<?php echo e($jazigo->st_ocupado ?? ''); ?>" name='st_ocupado'>
                        <?php endif; ?>                                
                    </div>  
                    <div class="form-group col-sm-2 mb-3">                                    
                        <label for="st_ativo" class="control-label">Ativo ?</label>
                        <?php if(isset($jazigo)): ?>                        
                            <?php if($jazigo->st_ativo===1): ?>
                                <input type="checkbox" class="checkbox" value="<?php echo e($jazigo->st_ativo ?? ''); ?>" checked name='st_ativo' >
                            <?php else: ?> 
                                <input type="checkbox" class="checkbox" value="<?php echo e($jazigo->st_ativo ?? ''); ?>" name='st_ativo'>
                            <?php endif; ?> 
                        <?php else: ?>
                            <input type="checkbox" class="checkbox" value="<?php echo e($jazigo->st_ativo ?? ''); ?>" name='st_ativo'>
                        <?php endif; ?>                                
                    </div>  
                    <div class="form-group col-sm-4 mb-1">
                        <label for="st_granito" class="control-label">Granito</label>
                        <select class="form-control" name="st_granito" required>
                            <option value=""></option>
                            <?php $__currentLoopData = $granitos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $granito): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(isset($jazigo)): ?>
                                    <?php if($granito['st_granito']==$jazigo->st_granito): ?>
                                    <option value="<?php echo e($granito['st_granito']); ?>" selected>
                                    <?php echo e($granito['nm_granito']); ?>

                                    </option>
                                    <?php else: ?>
                                    <option value="<?php echo e($granito['st_granito']); ?>">
                                    <?php echo e($granito['nm_granito']); ?>

                                    </option>
                                    <?php endif; ?>	         
                                <?php else: ?>                                    
                                    <option value="<?php echo e($granito['st_granito']); ?>">
                                    <?php echo e($granito['nm_granito']); ?>

                                    </option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>  
                </div>    
            </fieldset>    
            <!-- Dados complementares -->
            <fieldset class="form-group">
            <legend class="label label-success"><span><h4>Dados Complementares</h4></span></legend>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="nm_obs" class="control-label">Observação</label>
                        <textarea class="form-control" name="nm_obs" rows="5"><?php echo e($jazigo->nm_obs ?? ''); ?></textarea>
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
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/wfuneraria/public_html/paranaluto/resources/views/forms/jazigo.blade.php ENDPATH**/ ?>