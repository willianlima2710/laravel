<?php $__env->startSection('title', 'Relatorio de contas a pagar'); ?>

<?php $__env->startSection('content_header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="box box-danger">
    <div class="box-header">
        <h3 class="box-title">Relatório - Contas a pagar</h3>
    </div>
    <form method="post" action="<?php echo e(action('RelctapagarController@impctapagar')); ?>">  
    <?php echo e(csrf_field()); ?>

    
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="form-group col-sm-2 mb-3">
                <label class="control-label">Data inicial:</label>
                <input type="text" class="form-control" name="dt_inicial" value="<?php echo e($dt_inicial); ?>" onkeypress="$(this).mask('00/00/0000')" autocomplete="off" required>
            </div>       
            <div class="form-group col-sm-2 mb-3">
                <label class="control-label">Data final:</label>
                <input type="text" class="form-control" name="dt_final" value="<?php echo e($dt_final); ?>" onkeypress="$(this).mask('00/00/0000')" autocomplete="off" required>
            </div>   
            <div class="form-group col-sm-2 mb-1">
                <label class="control-label">Situação</label>
                <select class="form-control" name="st_ctapagar" required>
                    <option value="9">Todas</option>
                    <option value="0">Abertos</option>
                    <option value="1">Pagos</option>
                    <option value="2">Inativos</option>
                </select>
            </div>   
            <div class="form-group col-sm-6 mb-1">
                <label for="nm_fornecedor" class="control-label">Fornecedor</label>
                <input type="text" class="form-control" value="<?php echo e($nm_fornecedor); ?>" 
                name="nm_fornecedor" id="nm_fornecedor" autocomplete="off" placeholder="Nome ou CPF/CNPJ" >                                                                             
            </div>   
            <input type="hidden" class="form-control" value="<?php echo e($id_fornecedor); ?>" name="id_fornecedor" id="id_fornecedor" required>                    
        </div>    
    </div>
    <div class="box-footer">        
        <div class="pull-right">                            
            <button class="btn btn-primary" type="submit" formtarget="_blank"><i class='fa fa-print'></i> Imprimir</button>
        </div>       
    </div> 
    </form>       
</div> 
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

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp73\htdocs\funeraria\resources\views/relctapagar/index.blade.php ENDPATH**/ ?>