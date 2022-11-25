

<?php $__env->startSection('title', 'Contas a Receber'); ?>

<?php $__env->startSection('content_header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>    

<!-- general form elements -->    
<div class='box box-primary box-solid'> 
    <div class='box-header with-border'>            
        <h3 class="box-title">Contas a Receber</h3>
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

    <form method="post" action="<?php echo e($action ?? url('ctareceber')); ?>">    
    <?php echo e(csrf_field()); ?>

    <?php if(isset($ctareceber)): ?> <?php echo e(method_field('patch')); ?> <?php endif; ?>

        <!-- /.box-header -->
        <div class="box-body">   
            <fieldset class="form-group">
                <input type="hidden" value="<?php echo e($ctareceber->id_ctareceber ?? ''); ?>" name="id_ctareceber" class="form-control">
                <div class="row">
                    <div class="form-group col-sm-12 mb-1">
                        <label for="nm_pessoa" class="control-label">Cliente</label>
                        <input type="text" class="form-control" value="<?php echo e($ctareceber->nm_pessoa ?? ''); ?>" 
                         name="nm_pessoa" id="nm_pessoa" autocomplete="off" placeholder="Nome ou CPF" >                                                                             
                    </div>   
                    <input type="hidden" class="form-control" value="<?php echo e($ctareceber->id_pessoa ?? ''); ?>" name="id_pessoa" id="id_pessoa" required>                    
                </div>        
                <div class="row">
                    <div class="form-group col-sm-2 mb-1">
                        <label for="nr_documento" class="control-label">Documento</label>
                        <input type="text" class="form-control" value="<?php echo e($ctareceber->nr_documento ?? ''); ?>" name="nr_documento" maxlength="30" autocomplete="off" required>                    
                    </div>             
                    <div class="form-group col-sm-2 mb-1">
                        <label for="nr_parcela" class="control-label">Nº Parcela</label>
                        <input type="text" class="form-control" value="<?php echo e($ctareceber->nr_parcela ?? ''); ?>" name="nr_parcela" maxlength="3" value="1" autocomplete="off" required>                    
                    </div>             
                    <div class="form-group col-sm-2 mb-1">
                        <label for="dt_vencimento" class="control-label">Data Vencimento</label>
                        <input type="text" class="form-control" value="<?php echo e(empty($ctareceber->dt_vencimento) ? '' : $ctareceber->dt_vencimento->format('d/m/Y') ?? ''); ?>" name="dt_vencimento" onkeypress="$(this).mask('00/00/0000')" autocomplete="off" required>
                    </div> 
                    <div class="form-group col-sm-2 mb-1">
                        <label for="vl_apagar" class="control-label">$ Valor</label>
                        <input type="text" class="form-control" value="<?php echo e($ctareceber->vl_apagar ?? ''); ?>" name="vl_apagar" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off" required>                  
                    </div> 
                    <div class="form-group col-sm-4 mb-1">
                        <label for="id_tppagamento" class="control-label">Tipo Pagamento</label>
                        <select class="form-control" name="id_tppagamento" required>
                            <option value=""></option>
                            <?php $__currentLoopData = $tppagamentos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tppagamento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(isset($ctareceber)): ?>
                                    <?php if($tppagamento->id_tppagamento==$ctareceber->id_tppagamento): ?>
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
                        <input type="text" class="form-control" value="<?php echo e($ctareceber->vl_pago ?? ''); ?>" id="vl_pago" name="vl_pago" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off">                  
                    </div> 
                    <div class="form-group col-sm-3 mb-1">
                        <label for="dt_pagamento" class="control-label">Data Pagamento</label>
                        <input type="text" class="form-control" value="<?php echo e(empty($ctareceber->dt_pagamento) ? '' : $ctareceber->dt_pagamento->format('d/m/Y') ?? ''); ?>" id="dt_pagamento" name="dt_pagamento" onkeypress="$(this).mask('00/00/0000')" autocomplete="off">
                    </div> 
                    <div class="form-group col-sm-3 mb-1">
                        <label for="vl_juros" class="control-label">$ Juros</label>
                        <input type="text" class="form-control" value="<?php echo e($ctareceber->vl_juros ?? ''); ?>" name="vl_juros" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off">                  
                    </div> 
                    <div class="form-group col-sm-3 mb-1">
                        <label for="vl_multa" class="control-label">$ Multa</label>
                        <input type="text" class="form-control" value="<?php echo e($ctareceber->vl_multa ?? ''); ?>" name="vl_multa" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off">                  
                    </div> 
                </div>                         
                <div class="row">                        
                    <div class="form-group col-sm-6 mb-1">
                        <label for="id_banco" class="control-label">Banco</label>
                        <select class="form-control" name="id_banco" required>
                            <option value=""></option>
                            <?php $__currentLoopData = $bancos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banco): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(isset($ctareceber)): ?>
                                    <?php if($banco->id_banco==$ctareceber->id_banco): ?>
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
                                <?php if(isset($ctareceber)): ?>
                                    <?php if($planoconta->id_planoconta==$ctareceber->id_planoconta): ?>
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
            </fieldset>
            <fieldset class="form-group">
            <legend>Informações</legend>                                                                      
                <div class="row">
                    <div class="form-group col-sm-12 mb-1">
                        <label for="ds_historico" class="control-label">Historico</label>
                        <input type="text" class="form-control" value="<?php echo e($ctareceber->ds_historico ?? ''); ?>" name="ds_historico" maxlength="100" autocomplete="off" required>     
                    </div>        
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="nm_obs" class="control-label">Observação</label>
                        <textarea class="form-control" name="nm_obs" rows="5"><?php echo e($ctareceber->nm_obs ?? ''); ?></textarea>
                    </div>                            
                </div> 
            </fieldset>    
            <fieldset class="form-group">
            <legend>Outros</legend>                                                                      
                <div class="row">
                    <div class="form-group col-sm-2 mb-1">
                        <label for="st_parcela" class="control-label">Qt Parcela</label>
                        <input type="text" class="form-control" value="<?php echo e($ctareceber->st_parcela ?? ''); ?>" name="st_parcela" maxlength="10" disabled autocomplete="off">     
                    </div>                             
                    <div class="form-group col-sm-2 mb-1">
                        <label for="dt_carne" class="control-label">Data do Carne</label>
                        <input type="text" class="form-control" value="<?php echo e(empty($ctareceber->dt_carne) ? '' : $ctareceber->dt_carne->format('d/m/Y') ?? ''); ?>" name="dt_carne" maxlength="10" disabled autocomplete="off">     
                    </div>        
                    <div class="form-group col-sm-2 mb-1">
                        <label for="nr_nossonum" class="control-label">Nosso Numero</label>
                        <input type="text" class="form-control" value="<?php echo e($ctareceber->nr_nossonum ?? ''); ?>" name="nr_nossonum" maxlength="10" disabled autocomplete="off">     
                    </div>        
                    <div class="form-group col-sm-2 mb-1">
                        <label for="nr_dvnossonum" class="control-label">Digito</label>
                        <input type="text" class="form-control" value="<?php echo e($ctareceber->nr_dvnossonum ?? ''); ?>" name="nr_dvnossonum" maxlength="20" disabled autocomplete="off">     
                    </div>        
                    <div class="form-group col-sm-2 mb-1">
                        <label for="nr_remessa" class="control-label">Nº Remessa</label>
                        <input type="text" class="form-control" value="<?php echo e($ctareceber->nr_remessa ?? ''); ?>" name="nr_remessa" maxlength="20" disabled autocomplete="off">     
                    </div>        
                    <div class="form-group col-sm-2 mb-1">
                        <label for="dt_rembanco" class="control-label">Data Remessa</label>
                        <input type="text" class="form-control" value="<?php echo e(empty($ctareceber->dt_rembanco) ? '' : $ctareceber->dt_rembanco->format('d/m/Y') ?? ''); ?>" name="dt_rembanco" maxlength="20" disabled autocomplete="off">     
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
$("#nm_pessoa").autocomplete({    
    source: "<?php echo e(URL::to('completecliente')); ?>",
    dataType: "json",
    minLength: 2,
    select: function (key, value) {                        
        $("#id_pessoa").val(value.item.id);	            
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
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/wfuneraria/public_html/anjogabriel/resources/views/forms/ctareceber.blade.php ENDPATH**/ ?>