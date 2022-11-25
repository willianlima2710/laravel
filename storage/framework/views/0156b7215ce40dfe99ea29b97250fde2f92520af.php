

<?php $__env->startSection('title', 'Fornecedor'); ?>

<?php $__env->startSection('content_header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>    

<!-- general form elements -->    
<div class='box box-primary box-solid'> 
    <div class='box-header with-border'>            
        <h3 class="box-title">Fornecedor</h3>
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

    <form method="post" action="<?php echo e($action ?? url('fornecedor')); ?>">    
    <?php echo e(csrf_field()); ?>

    <?php if(isset($fornecedor)): ?> <?php echo e(method_field('patch')); ?> <?php endif; ?>

        <!-- /.box-header -->
        <div class="box-body">   
            <fieldset class="form-group">
                <input type="hidden" value="<?php echo e($fornecedor->id_pessoa ?? ''); ?>" name="id_pessoa" class="form-control">
                <div class="row">
                    <div class="form-group col-sm-12 mb-1">
                        <label for="nm_pessoa" class="control-label">Nome</label>
                        <input type="text" class="form-control" value="<?php echo e($fornecedor->nm_pessoa ?? ''); ?>" name="nm_pessoa" maxlength="100" autocomplete="off" required>                    
                    </div>             
                </div>    
                <div class="row">
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nr_cpfcnpj" class="control-label">CNPJ</label>
                        <input type="text" class="form-control" value="<?php echo e($fornecedor->nr_cpfcnpj ?? ''); ?>" name='nr_cpfcnpj' onkeypress="$(this).mask('00.000.000/0000-00');" autocomplete="off">                    
                    </div>                        
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nr_rgie" class="control-label">IE</label>
                        <input type="text" class="form-control" value="<?php echo e($fornecedor->nr_rgie ?? ''); ?>" name='nr_rgie' maxlength="30" autocomplete="off">     
                    </div>    
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nr_telefone1" class="control-label">1º Telefone</label>
                        <input type="text" class="form-control" value="<?php echo e($fornecedor->nr_telefone1 ?? ''); ?>" name='nr_telefone1' onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off">     
                    </div>
                    <div class="form-group col-sm-6 mb-3">
                        <label for="nm_contato" class="control-label">Contato</label>
                        <input type="text" class="form-control" value="<?php echo e($fornecedor->nm_contato ?? ''); ?>" name='nm_contato' maxlength="100" autocomplete="off">
                    </div>    
                </div>    
                <div class="row">
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nr_cep" class="control-label">CEP</label>
                        <input type="text" class="form-control" value="<?php echo e($fornecedor->nr_cep ?? ''); ?>" name='nr_cep' onkeypress="$(this).mask('00000-000')" autocomplete="off" required>
                    </div>    
                    <div class="form-group col-sm-5 mb-3">
                        <label for="nm_endereco" class="control-label">Endereço</label>
                        <input type="text" class="form-control" value="<?php echo e($fornecedor->nm_endereco ?? ''); ?>" name='nm_endereco' maxlength="100" autocomplete="off">     
                    </div>                            
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nr_numender" class="control-label">Numero</label>
                        <input type="text" class="form-control" value="<?php echo e($fornecedor->nr_numender ?? ''); ?>" name='nr_numender' maxlength="20" autocomplete="off">
                    </div>
                    <div class="form-group col-sm-3 mb-3">
                        <label for="nm_complender" class="control-label">Complemento</label>
                        <input type="text" class="form-control" value="<?php echo e($fornecedor->nm_complender ?? ''); ?>" name='nm_complender' maxlength="60" autocomplete="off">     
                    </div>
                </div> 
                <div class="row">
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_bairro" class="control-label">Bairro</label>
                        <input type="text" class="form-control" value="<?php echo e($fornecedor->nm_bairro ?? ''); ?>" name='nm_bairro' maxlength="60" autocomplete="off">     
                    </div>                            
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_cidade" class="control-label">Cidade</label>
                        <input type="text" class="form-control" value="<?php echo e($fornecedor->nm_cidade ?? ''); ?>" name='nm_cidade' maxlength="60" autocomplete="off">
                    </div>    
                    <div class="form-group col-sm-4 mb-1">
                        <label for="nm_estado" class="control-label">Estado</label>
                        <select class="form-control" name="nm_estado">
                            <option value=""></option>
                            <?php $__currentLoopData = $estado; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $est): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(isset($fornecedor)): ?>
                                    <?php if($est->nm_sigla==$fornecedor->nm_estado): ?>
                                    <option value="<?php echo e($est->nm_sigla); ?>" selected>
                                    <?php echo e($est->nm_estado); ?>

                                    </option>
                                    <?php else: ?>
                                    <option value="<?php echo e($est->nm_sigla); ?>">
                                    <?php echo e($est->nm_estado); ?>

                                    </option>
                                    <?php endif; ?>	         
                                <?php else: ?>                                    
                                    <option value="<?php echo e($est->nm_sigla); ?>">
                                    <?php echo e($est->nm_estado); ?>

                                    </option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>                        
                </div> 
                <div class="row">
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_telefone2" class="control-label">2º Telefone</label>
                        <input type="text" class="form-control" value="<?php echo e($fornecedor->nm_telefone2 ?? ''); ?>" name='nm_telefone2' onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off">     
                    </div>                            
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_telefone3" class="control-label">3º Telefone</label>
                        <input type="text" class="form-control" value="<?php echo e($fornecedor->nm_telefone3 ?? ''); ?>" name='nm_telefone3' onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off">
                    </div>    
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_telefone4" class="control-label">4º Telefone</label>
                        <input type="text" class="form-control" value="<?php echo e($fornecedor->nm_telefone4 ?? ''); ?>" name='nm_telefone4' onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off">
                    </div>    
                </div> 
                <div class="row">
                    <div class="form-group col-sm-8 mb-3">
                        <label for="nm_email" class="control-label">E-Mail</label>
                        <input type="email" class="form-control" value="<?php echo e($fornecedor->nm_email ?? ''); ?>" name='nm_email' maxlength="191" autocomplete="off">
                    </div>    
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_site" class="control-label">Site</label>
                        <input type="text" class="form-control" value="<?php echo e($fornecedor->nm_site ?? ''); ?>" name='nm_site' maxlength="191" autocomplete="off">     
                    </div>                            
                </div>
            </fieldset>   
            <!-- Dados complementares -->
            <fieldset class="form-group">
            <legend class="label label-success"><span><h4>Dados Complementares</h4></span></legend>               
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="nm_obs" class="control-label">Observação</label>
                        <textarea class="form-control" rows="5" name='nm_obs'><?php echo e($fornecedor->nm_obs ?? ''); ?></textarea>
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
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/wfuneraria/public_html/paranaluto/resources/views/forms/fornecedor.blade.php ENDPATH**/ ?>