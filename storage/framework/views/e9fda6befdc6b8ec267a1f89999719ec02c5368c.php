

<?php $__env->startSection('title', 'Veículo'); ?>

<?php $__env->startSection('content_header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>    

<!-- general form elements -->    
<div class='box box-primary box-solid'> 
    <div class='box-header with-border'>            
        <h3 class="box-title">Veículo</h3>
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

    <form method="post" action="<?php echo e($action ?? url('veiculo')); ?>">    
    <?php echo e(csrf_field()); ?>

    <?php if(isset($veiculo)): ?> <?php echo e(method_field('patch')); ?> <?php endif; ?>

        <!-- /.box-header -->
        <div class="box-body">   
            <fieldset class="form-group">
                <input type="hidden" value="<?php echo e($veiculo->id_veiculo ?? ''); ?>" name="id_veiculo" class="form-control">
                <div class="row">
                    <div class="form-group col-sm-12 mb-3">
                        <label for="nm_veiculo" class="control-label">Nome</label>
                        <input type="text" class="form-control" value="<?php echo e($veiculo->nm_veiculo ?? ''); ?>" name="nm_veiculo" maxlength="100" autocomplete="off" required>
                    </div>     
                </div>           
                <div class="row"> 
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nr_placa" class="control-label">Placa</label>
                        <input type="text" class="form-control" value="<?php echo e($veiculo->nr_placa ?? ''); ?>" name="nr_placa" autocomplete="off" maxlength="10" onkeypress="$(this).mask('AAA-AAAA')">                    
                    </div>   
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_marca" class="control-label">Marca</label>
                        <input type="text" class="form-control" value="<?php echo e($veiculo->nm_marca ?? ''); ?>" name="nm_marca" maxlength="100" autocomplete="off">                    
                    </div>   
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_cor" class="control-label">Cor</label>
                        <input type="text" class="form-control" value="<?php echo e($veiculo->nm_cor ?? ''); ?>" name="nm_cor" maxlength="60" autocomplete="off">                    
                    </div>   
                </div>   
                <div class="row"> 
                    <div class="form-group col-sm-1 mb-3">
                        <label for="nr_ano" class="control-label">Ano</label>
                        <input type="text" class="form-control" value="<?php echo e($veiculo->nr_ano ?? ''); ?>" name="nr_ano" autocomplete="off" maxlength="4">                    
                    </div>   
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_seguradora" class="control-label">Seguradora</label>
                        <input type="text" class="form-control" value="<?php echo e($veiculo->nm_seguradora ?? ''); ?>" name="nm_seguradora" maxlength="100" autocomplete="off">                    
                    </div>   
                    <div class="form-group col-sm-2 mb-3">
                        <label for="dt_vigencia" class="control-label">Data da Vigencia</label>
                        <input type="text" class="form-control" value="<?php echo e(empty($veiculo->dt_vigencia) ? '' : $veiculo->dt_vigencia->format('d/m/Y') ?? ''); ?>" name='dt_vigencia' onkeypress="$(this).mask('00/00/0000')" autocomplete="off">
                    </div>   
                    <div class="form-group col-sm-3 mb-3">
                        <label for="nm_condutor" class="control-label">Condutor</label>
                        <input type="text" class="form-control" value="<?php echo e($veiculo->nm_condutor ?? ''); ?>" name="nm_condutor" maxlength="100" autocomplete="off">                    
                    </div>   
                    <div class="form-group col-sm-2 mb-3">
                        <label for="dt_manutencao" class="control-label">Ult. Manutenção</label>
                        <input type="text" class="form-control" value="<?php echo e(empty($veiculo->dt_manutencao) ? '' : $veiculo->dt_manutencao->format('d/m/Y') ?? ''); ?>" name='dt_manutencao' onkeypress="$(this).mask('00/00/0000')" autocomplete="off">
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
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/wfuneraria/public_html/paranaluto/resources/views/forms/veiculo.blade.php ENDPATH**/ ?>