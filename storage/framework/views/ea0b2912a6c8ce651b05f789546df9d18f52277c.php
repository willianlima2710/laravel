

<?php $__env->startSection('title', 'Contas a Pagar'); ?>

<?php $__env->startSection('content_header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>    

<!-- general form elements -->    
<div class='box box-primary box-solid'> 
    <div class='box-header with-border'>            
        <h3 class="box-title">Contas a Pagar</h3>
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

    <form method="post" action="<?php echo e($action ?? url('ctapagar')); ?>">    
    <?php echo e(csrf_field()); ?>

    <?php if(isset($ctapagar)): ?> <?php echo e(method_field('patch')); ?> <?php endif; ?>

        <!-- /.box-header -->
        <div class="box-body">   
            <fieldset class="form-group">
                <input type="hidden" value="<?php echo e($ctapagar->id_ctapagar ?? ''); ?>" name="id_ctapagar" class="form-control">
                <div class="row">
                    <div class="form-group col-sm-12 mb-1">
                        <label for="nm_fornecedor" class="control-label">Fornecedor</label>
                        <input type="text" class="form-control" value="<?php echo e($ctapagar->nm_fornecedor ?? ''); ?>" 
                         name="nm_fornecedor" id="nm_fornecedor" autocomplete="off" placeholder="Nome ou CPF/CNPJ" >                                                                             
                    </div>   
                    <input type="hidden" class="form-control" value="<?php echo e($ctapagar->id_fornecedor ?? ''); ?>" name="id_fornecedor" id="id_fornecedor" required>                    
                </div>        
                <div class="row">
                    <div class="form-group col-sm-2 mb-1">
                        <label for="nr_documento" class="control-label">Documento</label>
                        <input type="text" class="form-control" value="<?php echo e($ctapagar->nr_documento ?? ''); ?>" name="nr_documento" maxlength="30" autocomplete="off" required>                    
                    </div>             
                    <div class="form-group col-sm-2 mb-1">
                        <label for="nr_parcela" class="control-label">Nº Parcela</label>
                        <input type="text" class="form-control" value="<?php echo e($ctapagar->nr_parcela ?? ''); ?>" name="nr_parcela" maxlength="3" value="1" autocomplete="off" required>                    
                    </div>             
                    <div class="form-group col-sm-2 mb-1">
                        <label for="dt_vencimento" class="control-label">Data Vencimento</label>
                        <input type="text" class="form-control" value="<?php echo e(empty($ctapagar->dt_vencimento) ? '' : $ctapagar->dt_vencimento->format('d/m/Y') ?? ''); ?>" name="dt_vencimento" onkeypress="$(this).mask('00/00/0000')" autocomplete="off" required>
                    </div> 
                    <div class="form-group col-sm-2 mb-1">
                        <label for="vl_apagar" class="control-label">$ Valor</label>
                        <input type="text" class="form-control" value="<?php echo e($ctapagar->vl_apagar ?? ''); ?>" name="vl_apagar" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off" required>                  
                    </div> 
                    <div class="form-group col-sm-4 mb-1">
                        <label for="id_tppagamento" class="control-label">Tipo Pagamento</label>
                        <select class="form-control" name="id_tppagamento" required>
                            <option value=""></option>
                            <?php $__currentLoopData = $tppagamentos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tppagamento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(isset($ctapagar)): ?>
                                    <?php if($tppagamento->id_tppagamento==$ctapagar->id_tppagamento): ?>
                                    <option value="<?php echo e($tppagamento->id_tppagamento); ?>" selected>
                                    <?php echo e($tppagamento->nm_tppagamento); ?>

                                    </option>
                                    <?php else: ?>
                                    <option value="<?php echo e($tppagamento->id_tppagamento); ?>">
                                    <?php echo e($tppagamento->nm_tppagamento); ?>

                                    </option>
                                    <?php endif; ?>	         
                                <?php else: ?>                                    
                                    <option value="<?php echo e($tppagamento->id_tppagamento); ?>">
                                    <?php echo e($tppagamento->nm_tppagamento); ?>

                                    </option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>    
                </div>       
                <div class="row">
                    <div class="form-group col-sm-3 mb-1">
                        <label for="vl_pago" class="control-label">$ Pago</label>
                        <input type="text" class="form-control" value="<?php echo e($ctapagar->vl_pago ?? ''); ?>" id="vl_pago" name="vl_pago" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off">                  
                    </div> 
                    <div class="form-group col-sm-3 mb-1">
                        <label for="dt_pagamento" class="control-label">Data Pagamento</label>
                        <input type="text" class="form-control" value="<?php echo e(empty($ctapagar->dt_pagamento) ? '' : $ctapagar->dt_pagamento->format('d/m/Y') ?? ''); ?>" id="dt_pagamento" name="dt_pagamento" onkeypress="$(this).mask('00/00/0000')" autocomplete="off">
                    </div> 
                    <div class="form-group col-sm-3 mb-1">
                        <label for="vl_juros" class="control-label">$ Juros</label>
                        <input type="text" class="form-control" value="<?php echo e($ctapagar->vl_juros ?? ''); ?>" name="vl_juros" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off">                  
                    </div> 
                    <div class="form-group col-sm-3 mb-1">
                        <label for="vl_multa" class="control-label">$ Multa</label>
                        <input type="text" class="form-control" value="<?php echo e($ctapagar->vl_multa ?? ''); ?>" name="vl_multa" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off">                  
                    </div> 
                </div>                         
                <div class="row">                        
                    <div class="form-group col-sm-6 mb-1">
                        <label for="id_banco" class="control-label">Banco</label>
                        <select class="form-control" name="id_banco" required>
                            <option value=""></option>
                            <?php $__currentLoopData = $bancos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banco): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(isset($ctapagar)): ?>
                                    <?php if($banco->id_banco==$ctapagar->id_banco): ?>
                                    <option value="<?php echo e($banco->id_banco); ?>" selected>
                                    <?php echo e($banco->nm_banco); ?>

                                    </option>
                                    <?php else: ?>
                                    <option value="<?php echo e($banco->id_banco); ?>">
                                    <?php echo e($banco->nm_banco); ?>

                                    </option>
                                    <?php endif; ?>	            		
                                <?php else: ?>
                                    <option value="<?php echo e($banco->id_banco); ?>">
                                    <?php echo e($banco->nm_banco); ?>

                                    </option>
                                <?php endif; ?>    
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>    
                    <div class="form-group col-sm-6 mb-1">
                        <label for="id_planoconta" class="control-label">Plano de Contas</label>
                        <select class="form-control" name="id_planoconta" required>
                            <option value=""></option>
                            <?php $__currentLoopData = $planocontas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $planoconta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(isset($ctapagar)): ?>
                                    <?php if($planoconta->id_planoconta==$ctapagar->id_planoconta): ?>
                                    <option value="<?php echo e($planoconta->id_planoconta); ?>" selected>
                                    <?php echo e($planoconta->nm_planoconta); ?>

                                    </option>
                                    <?php else: ?>
                                    <option value="<?php echo e($planoconta->id_planoconta); ?>">
                                    <?php echo e($planoconta->nm_planoconta); ?>

                                    </option>
                                    <?php endif; ?>	            		
                                <?php else: ?> 
                                    <option value="<?php echo e($planoconta->id_planoconta); ?>">
                                    <?php echo e($planoconta->nm_planoconta); ?>

                                    </option>
                                <?php endif; ?>   
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>    
                </div> 
                <div class="row">
                    <div class="form-group col-sm-4 mb-1">
                        <label for="cd_agencia" class="control-label">Agencia</label>
                        <input type="text" class="form-control" value="<?php echo e($ctapagar->cd_agencia ?? ''); ?>" name="cd_agencia" maxlength="10" autocomplete="off">     
                    </div>        
                    <div class="form-group col-sm-4 mb-1">
                        <label for="nr_conta" class="control-label">Nº Conta</label>
                        <input type="text" class="form-control" value="<?php echo e($ctapagar->nr_conta ?? ''); ?>" name="nr_conta" maxlength="20" autocomplete="off">     
                    </div>        
                    <div class="form-group col-sm-4 mb-1">
                        <label for="nr_cheque" class="control-label">Nº Cheque</label>
                        <input type="text" class="form-control" value="<?php echo e($ctapagar->nr_cheque ?? ''); ?>" name="nr_cheque" maxlength="20" autocomplete="off">     
                    </div>        
                </div>
            </fieldset>
            <fieldset class="form-group">
            <legend class="label label-success"><span><h4>Informações</h4></span></legend>
                <div class="row">
                    <div class="form-group col-sm-12 mb-1">
                        <label for="ds_historico" class="control-label">Historico</label>
                        <input type="text" class="form-control" value="<?php echo e($ctapagar->ds_historico ?? ''); ?>" name="ds_historico" maxlength="100" autocomplete="off" required>     
                    </div>        
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="nm_obs" class="control-label">Observação</label>
                        <textarea class="form-control" name="nm_obs" rows="5"><?php echo e($ctapagar->nm_obs ?? ''); ?></textarea>
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

$("#vl_pago").change(function() {
    if ($("#dt_pagamento").val()==='') {
        $("#dt_pagamento").val(moment().format('DD/MM/YYYY')); 
    }
});

$(function(){    
});    
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/wfuneraria/public_html/paranaluto/resources/views/forms/ctapagaredit.blade.php ENDPATH**/ ?>