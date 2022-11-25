

<?php $__env->startSection('title', 'Produto'); ?>

<?php $__env->startSection('content_header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>    

<!-- general form elements -->    
<div class='box box-primary box-solid'> 
    <div class='box-header with-border'>            
        <h3 class="box-title">Produto</h3>
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

    <form method="post" action="<?php echo e($action ?? url('produto')); ?>">    
    <?php echo e(csrf_field()); ?>

    <?php if(isset($produto)): ?> <?php echo e(method_field('patch')); ?> <?php endif; ?>

        <!-- /.box-header -->
        <div class="box-body">   
            <fieldset class="form-group">                            
                <input type="hidden" value="<?php echo e($produto->produto ?? ''); ?>" name="produto" class="form-control">
                <div class="row">
                    <div class="form-group col-sm-12 mb-3">
                        <label for="nm_produto" class="control-label">Nome</label>
                        <input type="text" class="form-control" value="<?php echo e($produto->nm_produto ?? ''); ?>" name="nm_produto" maxlength="100" autocomplete="off" required>
                    </div>             
                </div> 
                <div class="row" id='fornecedor'>
                    <div class="form-group col-sm-12 mb-1">
                        <label for="nm_fornecedor" class="control-label">Fornecedor</label>
                        <input type="text" class="form-control" value="<?php echo e($produto->nm_fornecedor ?? ''); ?>" 
                         name="nm_fornecedor" id="nm_fornecedor" autocomplete="off" placeholder="Nome ou CPF/CNPJ" >                                                                             
                    </div>   
                    <input type="hidden" class="form-control" value="<?php echo e($produto->id_fornecedor ?? ''); ?>" name="id_fornecedor" id="id_fornecedor" required>                    
                </div>        
                <div class="row">
                    <div class="form-group col-sm-4 mb-3">
                        <label for="vl_compra" class="control-label">$ Compra</label>
                        <input type="text" class="form-control" value="<?php echo e($produto->vl_compra ?? ''); ?>" name="vl_compra" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off">                    
                    </div>                        
                    <div class="form-group col-sm-4 mb-3">
                        <label for="vl_venda" class="control-label">$ Venda</label>
                        <input type="text" class="form-control" value="<?php echo e($produto->vl_venda ?? ''); ?>" name="vl_venda" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off">     
                    </div>
                    <div class="form-group col-sm-4 mb-1">
                        <label for="cd_unidade" class="control-label">Unidade</label>
                        <select class="form-control" name="cd_unidade" required>
                            <option value=""></option>
                            <?php $__currentLoopData = $unidades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unidade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(isset($produto)): ?>
                                    <?php if($unidade['cd_unidade']==$produto->cd_unidade): ?>
                                    <option value="<?php echo e($unidade['cd_unidade']); ?>" selected>
                                    <?php echo e($unidade['nm_unidade']); ?>

                                    </option>
                                    <?php else: ?>
                                    <option value="<?php echo e($unidade['cd_unidade']); ?>">
                                    <?php echo e($unidade['nm_unidade']); ?>

                                    </option>
                                    <?php endif; ?>	         
                                <?php else: ?>                                    
                                    <option value="<?php echo e($unidade['cd_unidade']); ?>">
                                    <?php echo e($unidade['nm_unidade']); ?>

                                    </option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>                        
                </div>    
                <div class="row">
                    <div class="form-group col-sm-3 mb-3">
                        <label for="qt_estoque" class="control-label">Estoque</label>
                        <input type="text" class="form-control" value="<?php echo e($produto->qt_estoque ?? ''); ?>" name="qt_estoque" autocomplete="off" required>
                    </div>    
                    <div class="form-group col-sm-3 mb-3">
                        <label for="qt_minestoque" class="control-label">Estoque Minimo</label>
                        <input type="text" class="form-control" value="<?php echo e($produto->qt_minestoque ?? ''); ?>" name="qt_minestoque" autocomplete="off" required>     
                    </div>                            
                    <div class="form-group col-sm-4 mb-3">
                        <label for="cd_barra" class="control-label">Código de Barra</label>
                        <input type="text" class="form-control" value="<?php echo e($produto->cd_barra ?? ''); ?>" name="cd_barra" maxlength="20" autocomplete="off">
                    </div> 
                    <div class="form-group col-sm-2 mb-3">                                    
                        <label for="st_convalescente" class="control-label">Convalescente ?</label>
                        <?php if(isset($produto)): ?>                        
                            <?php if($produto->st_convalescente===1): ?>
                                <input type="checkbox" class="checkbox" value="<?php echo e($produto->st_convalescente ?? ''); ?>" checked name='st_convalescente'>
                            <?php else: ?> 
                                <input type="checkbox" class="checkbox" value="<?php echo e($produto->st_convalescente ?? ''); ?>" name='st_convalescente'>
                            <?php endif; ?> 
                        <?php else: ?>
                            <input type="checkbox" class="checkbox" value="<?php echo e($produto->st_convalescente ?? ''); ?>" name='st_convalescente'>
                        <?php endif; ?>                                
                    </div>                           
                </div> 
            </fieldset>    
            <!-- Dados complementares -->
            <fieldset class="form-group">
            <legend>Complementares</legend>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="nm_obs" class="control-label">Observação</label>
                        <textarea class="form-control" name="nm_obs" rows="5"><?php echo e($produto->nm_obs ?? ''); ?></textarea>
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
<script> 
$("#nm_fornecedor").autocomplete({    
    source: "<?php echo e(URL::to('completefornecedor')); ?>",
    dataType: "json",
    minLength: 2,
    select: function (key, value) {                        
        $("#id_fornecedor").val(value.item.id);	            
	},
});

$(function(){    
});    
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/wfuneraria/public_html/paranaluto/resources/views/forms/produto.blade.php ENDPATH**/ ?>