

<?php $__env->startSection('title', 'Plano'); ?>

<?php $__env->startSection('content_header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>    

<!-- general form elements -->    
<div class='box box-primary box-solid'> 
    <div class='box-header with-border'>            
        <h3 class="box-title">Plano</h3>
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

    <form method="post" action="<?php echo e($action ?? url('plano')); ?>">    
    <?php echo e(csrf_field()); ?>

    <?php if(isset($plano)): ?> <?php echo e(method_field('patch')); ?> <?php endif; ?>

        <!-- /.box-header -->
        <div class="box-body">   
            <fieldset class="form-group">                    
                <input type="hidden" value="<?php echo e($plano->id_plano ?? ''); ?>" name="id_plano" class="form-control">
                <div class="row">
                    <div class="form-group col-sm-8 mb-3">
                        <label for="nm_plano" class="control-label">Nome</label>
                        <input type="text" class="form-control" value="<?php echo e($plano->nm_plano ?? ''); ?>" name="nm_plano" maxlength="100" autocomplete="off" required>
                    </div>    
                    <div class="form-group col-sm-4 mb-3">
                        <label for="vl_plano" class="control-label">$ Plano</label>
                        <input type="text" class="form-control" value="<?php echo e($plano->vl_plano ?? ''); ?>" name="vl_plano" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off">     
                    </div>                            
                </div>   
                <div class="row">
                    <div class="form-group col-sm-4 mb-3">
                        <label for="vl_cobertura" class="control-label">$ Cobertura</label>
                        <input type="text" class="form-control" value="<?php echo e($plano->vl_cobertura ?? ''); ?>" name="vl_cobertura" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off">     
                    </div>                            
                    <div class="form-group col-sm-4 mb-3">
                        <label for="vl_kmincluido" class="control-label">KM Incluida</label>
                        <input type="text" class="form-control" value="<?php echo e($plano->vl_kmincluido ?? ''); ?>" name="vl_kmincluido" onkeypress="$(this).mask('999.990,00')" autocomplete="off">     
                    </div>                            
                    <div class="form-group col-sm-4 mb-3">
                        <label for="vl_adesao" class="control-label">Taxa Adesão</label>
                        <input type="text" class="form-control" value="<?php echo e($plano->vl_adesao ?? ''); ?>" name="vl_adesao" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off">     
                    </div>                            
                </div>    
                <div class="row">
                    <div class="form-group col-sm-4 mb-3">
                        <label for="vl_salminino" class="control-label">% Salário Minimo</label>
                        <input type="text" class="form-control" value="<?php echo e($plano->vl_salminino ?? ''); ?>" name="vl_salminino" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off">     
                    </div>                            
                    <div class="form-group col-sm-4 mb-3">
                        <label for="vl_jurosdia" class="control-label">Juros Dia</label>
                        <input type="text" class="form-control" value="<?php echo e($plano->vl_jurosdia ?? ''); ?>" name="vl_jurosdia" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off">     
                    </div>                            
                    <div class="form-group col-sm-4 mb-3">
                        <label for="vl_multa" class="control-label">Multa</label>
                        <input type="text" class="form-control" value="<?php echo e($plano->vl_multa ?? ''); ?>" name="vl_multa" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off">     
                    </div>                            
                </div> 
            </fieldset>    
            <!-- Dados complementares -->
            <fieldset class="form-group">
                <legend>Complementares</legend>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="nm_obs" class="control-label">Observação</label>
                            <textarea class="form-control" name="nm_obs" rows="5"><?php echo e($plano->nm_obs ?? ''); ?></textarea>
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
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/wfuneraria/public_html/paranaluto/resources/views/forms/plano.blade.php ENDPATH**/ ?>