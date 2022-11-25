

<?php $__env->startSection('title', 'Cliente'); ?>

<?php $__env->startSection('content_header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>    

<!-- general form elements -->    
<div class='box box-primary box-solid'> 
    <div class='box-header with-border'>            
        <h3 class="box-title">Cliente</h3>
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

    <form method="post" action="<?php echo e($action ?? url('cliente')); ?>">    
    <?php echo e(csrf_field()); ?>

    <?php if(isset($cliente)): ?> <?php echo e(method_field('patch')); ?> <?php endif; ?>

        <!-- /.box-header -->
        <div class="box-body">   
            <fieldset class="form-group">
                <input type="hidden" value="<?php echo e($cliente->id_pessoa ?? ''); ?>" name="id_pessoa" class="form-control">
                <div class="row">
                    <div class="form-group col-sm-10 mb-1">
                        <label for="nm_pessoa" class="control-label">Nome</label>
                        <input type="text" class="form-control" value="<?php echo e($cliente->nm_pessoa ?? ''); ?>" name="nm_pessoa" maxlength="100" autocomplete="off" required>                    
                    </div>             
                    <div class="form-group col-sm-2 mb-1">
                        <label for="cd_pessoa" class="control-label">Código</label>
                        <input type="text" class="form-control" value="<?php echo e($cliente->cd_pessoa ?? ''); ?>" name="cd_pessoa" maxlength="10" autocomplete="off">                    
                    </div>                                 
                </div>    
                <div class="row">
                    <div class="form-group col-sm-2 mb-1">
                        <label for="st_sexo" class="control-label">Sexo</label>
                        <select class="form-control" name="st_sexo" required>
                            <option value=""></option>
                            <?php $__currentLoopData = $sexos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sexo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(isset($cliente)): ?>
                                    <?php if($sexo['st_sexo']==$cliente->st_sexo): ?>
                                    <option value="<?php echo e($sexo['st_sexo']); ?>" selected>
                                    <?php echo e($sexo['nm_sexo']); ?>

                                    </option>
                                    <?php else: ?>
                                    <option value="<?php echo e($sexo['st_sexo']); ?>">
                                    <?php echo e($sexo['nm_sexo']); ?>

                                    </option>
                                    <?php endif; ?>	         
                                <?php else: ?>                                    
                                    <option value="<?php echo e($sexo['st_sexo']); ?>">
                                    <?php echo e($sexo['nm_sexo']); ?>

                                    </option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>    
                    <div class="form-group col-sm-2 mb-3">
                        <label for="dt_nascimento" class="control-label">Data de Nascimento</label>
                        <input type="text" class="form-control" value="<?php echo e(empty($cliente->dt_nascimento) ? '' : $cliente->dt_nascimento->format('d/m/Y') ?? ''); ?>" name='dt_nascimento' onkeypress="$(this).mask('00/00/0000')" autocomplete="off">
                    </div>    
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nr_cpfcnpj" class="control-label">CPF</label>
                        <input type="text" class="form-control" value="<?php echo e($cliente->nr_cpfcnpj ?? ''); ?>" name='nr_cpfcnpj' onkeypress="$(this).mask('000.000.000-00');" autocomplete="off">                    
                    </div>                        
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nr_rgie" class="control-label">RG</label>
                        <input type="text" class="form-control" value="<?php echo e($cliente->nr_rgie ?? ''); ?>" name='nr_rgie' maxlength="30" autocomplete="off">     
                    </div>    
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nr_telefone1" class="control-label">1º Telefone</label>
                        <input type="text" class="form-control" value="<?php echo e($cliente->nr_telefone1 ?? ''); ?>" name='nr_telefone1' onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off">     
                    </div>
                </div>    
                <div class="row">
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nr_cep" class="control-label">CEP</label>
                        <input type="text" class="form-control" value="<?php echo e($cliente->nr_cep ?? ''); ?>" name='nr_cep' onkeypress="$(this).mask('00000-000')" autocomplete="off" required>      
                    </div>    
                    <div class="form-group col-sm-5 mb-3">
                        <label for="nm_endereco" class="control-label">Endereço</label>
                        <input type="text" class="form-control" value="<?php echo e($cliente->nm_endereco ?? ''); ?>" name='nm_endereco' maxlength="100" autocomplete="off">     
                    </div>                            
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nr_numender" class="control-label">Numero</label>
                        <input type="text" class="form-control" value="<?php echo e($cliente->nr_numender ?? ''); ?>" name='nr_numender' maxlength="20" autocomplete="off">
                    </div>
                    <div class="form-group col-sm-3 mb-3">
                        <label for="nm_complender" class="control-label">Complemento</label>
                        <input type="text" class="form-control" value="<?php echo e($cliente->nm_complender ?? ''); ?>" name='nm_complender' maxlength="100" autocomplete="off">     
                    </div>
                </div> 
                <div class="row">
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_bairro" class="control-label">Bairro</label>
                        <input type="text" class="form-control" value="<?php echo e($cliente->nm_bairro ?? ''); ?>" name='nm_bairro' maxlength="60" autocomplete="off">     
                    </div>                            
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_cidade" class="control-label">Cidade</label>
                        <input type="text" class="form-control" value="<?php echo e($cliente->nm_cidade ?? ''); ?>" name='nm_cidade' maxlength="60" autocomplete="off">
                    </div>    
                    <div class="form-group col-sm-4 mb-1">
                        <label for="nm_estado" class="control-label">Estado</label>
                        <select class="form-control" name="nm_estado">
                            <option value=""></option>
                            <?php $__currentLoopData = $estados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $estado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(isset($cliente)): ?>
                                    <?php if($estado->nm_sigla==$cliente->nm_estado): ?>
                                    <option value="<?php echo e($estado->nm_sigla); ?>" selected>
                                    <?php echo e($estado->nm_estado); ?>

                                    </option>
                                    <?php else: ?>
                                    <option value="<?php echo e($estado->nm_sigla); ?>">
                                    <?php echo e($estado->nm_estado); ?>

                                    </option>
                                    <?php endif; ?>	         
                                <?php else: ?>                                    
                                    <option value="<?php echo e($estado->nm_sigla); ?>">
                                    <?php echo e($estado->nm_estado); ?>

                                    </option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>                        
                </div> 
                <div class="row">
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_telefone2" class="control-label">2º Telefone</label>
                        <input type="text" class="form-control" value="<?php echo e($cliente->nm_telefone2 ?? ''); ?>" name='nm_telefone2' onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off">     
                    </div>                            
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_telefone3" class="control-label">3º Telefone</label>
                        <input type="text" class="form-control" value="<?php echo e($cliente->nm_telefone3 ?? ''); ?>" name='nm_telefone3' onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off">
                    </div>    
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_telefone4" class="control-label">4º Telefone</label>
                        <input type="text" class="form-control" value="<?php echo e($cliente->nm_telefone4 ?? ''); ?>" name='nm_telefone4' onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off">
                    </div>    
                </div> 
                <div class="row">
                    <div class="form-group col-sm-8 mb-3">
                        <label for="nm_email" class="control-label">E-Mail</label>
                        <input type="email" class="form-control" value="<?php echo e($cliente->nm_email ?? ''); ?>" name='nm_email' maxlength="191" autocomplete="off">
                    </div>    
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_profissao" class="control-label">Profissão</label>
                        <input type="text" class="form-control" value="<?php echo e($cliente->nm_profissao ?? ''); ?>" name='nm_profissao' maxlength="100" autocomplete="off">     
                    </div>                            
                </div>
                <div class="row">
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nm_nacionalidade" class="control-label">Nacionalidade</label>
                        <input type="text" class="form-control" value="<?php echo e($cliente->nm_nacionalidade ?? ''); ?>" name='nm_nacionalidade' maxlength="100" autocomplete="off">     
                    </div>   
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nm_naturalidade" class="control-label">Naturalidade</label>
                        <input type="text" class="form-control" value="<?php echo e($cliente->nm_naturalidade ?? ''); ?>" name='nm_naturalidade' maxlength="100" autocomplete="off">     
                    </div>     
                    <div class="form-group col-sm-4 mb-1">
                        <label for="id_estcivil" class="control-label">Estado Civil</label>
                        <select class="form-control" name="id_estcivil">
                            <option value=""></option>
                            <?php $__currentLoopData = $estcivils; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $estcivil): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(isset($cliente)): ?>
                                    <?php if($estcivil->id_estcivil==$cliente->id_estcivil): ?>
                                    <option value="<?php echo e($estcivil->id_estcivil); ?>" selected>
                                    <?php echo e($estcivil->nm_estcivil); ?>

                                    </option>
                                    <?php else: ?>
                                    <option value="<?php echo e($estcivil->id_estcivil); ?>">
                                    <?php echo e($estcivil->nm_estcivil); ?>

                                    </option>
                                    <?php endif; ?>	         
                                <?php else: ?>                                    
                                    <option value="<?php echo e($estcivil->id_estcivil); ?>">
                                    <?php echo e($estcivil->nm_estcivil); ?>

                                    </option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>    
                    <div class="form-group col-sm-4 mb-1">
                        <label for="id_religiao" class="control-label">Religião</label>
                        <select class="form-control" name="id_religiao">
                            <option value=""></option>
                            <?php $__currentLoopData = $religiaos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $religiao): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(isset($cliente)): ?>
                                    <?php if($religiao->id_religiao==$cliente->id_religiao): ?>
                                    <option value="<?php echo e($religiao->id_religiao); ?>" selected>
                                    <?php echo e($religiao->nm_religiao); ?>

                                    </option>
                                    <?php else: ?>
                                    <option value="<?php echo e($religiao->id_religiao); ?>">
                                    <?php echo e($religiao->nm_religiao); ?>

                                    </option>
                                    <?php endif; ?>	         
                                <?php else: ?>                                    
                                    <option value="<?php echo e($religiao->id_religiao); ?>">
                                    <?php echo e($religiao->nm_religiao); ?>

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
                    <div class="form-group col-sm-8 mb-3">
                        <label for="nm_conjuge" class="control-label">Conjuge</label>
                        <input type="text" class="form-control" value="<?php echo e($cliente->nm_conjuge ?? ''); ?>" name='nm_conjuge' maxlength="100" autocomplete="off">     
                    </div>
                    <div class="form-group col-sm-3 mb-3">
                        <label for="nr_conjugetelefone" class="control-label">Telefone</label>
                        <input type="text" class="form-control" value="<?php echo e($cliente->nr_conjugetelefone ?? ''); ?>" name='nr_conjugetelefone' onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off">      
                    </div>
                </div> 
                <div class="row">
                    <div class="form-group col-sm-8 mb-3">
                        <label for="nm_mae" class="control-label">Mãe</label>
                        <input type="text" class="form-control" value="<?php echo e($cliente->nm_mae ?? ''); ?>" name='nm_mae' maxlength="100" autocomplete="off">     
                    </div>
                    <div class="form-group col-sm-3 mb-3">
                        <label for="nr_maetelefone" class="control-label">Telefone</label>
                        <input type="text" class="form-control" value="<?php echo e($cliente->nr_maetelefone ?? ''); ?>" name='nr_maetelefone' onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off">     
                    </div>
                    <div class="form-group col-sm-1 mb-3">                                    
                        <label for="st_maeviva" class="control-label">Viva ?</label>
                        <?php if(isset($cliente)): ?>                        
                            <?php if($cliente->st_maeviva===1): ?>
                                <input type="checkbox" class="checkbox" value="<?php echo e($cliente->st_maeviva ?? ''); ?>" checked name='st_maeviva' >
                            <?php else: ?> 
                                <input type="checkbox" class="checkbox" value="<?php echo e($cliente->st_maeviva ?? ''); ?>" name='st_maeviva'>
                            <?php endif; ?> 
                        <?php else: ?>
                            <input type="checkbox" class="checkbox" value="<?php echo e($cliente->st_maeviva ?? ''); ?>" name='st_maeviva'>
                        <?php endif; ?>                                
                    </div>                           
                </div> 
                <div class="row">
                    <div class="form-group col-sm-8 mb-3">
                        <label for="nm_pai" class="control-label">Pai</label>
                        <input type="text" class="form-control" value="<?php echo e($cliente->nm_pai ?? ''); ?>" name='nm_pai' maxlength="100" autocomplete="off">     
                    </div>
                    <div class="form-group col-sm-3 mb-3">
                        <label for="nr_paitelefone" class="control-label">Telefone</label>
                        <input type="text" class="form-control" value="<?php echo e($cliente->nr_paitelefone ?? ''); ?>" name='nr_paitelefone' onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off">     
                    </div>
                    <div class="form-group col-sm-1 mb-3">                                    
                        <label for="st_paivivo" class="control-label">Vivo ?</label>
                        <?php if(isset($cliente)): ?>                        
                            <?php if($cliente->st_paivivo===1): ?>
                                <input type="checkbox" class="checkbox" value="<?php echo e($cliente->st_paivivo); ?>" checked name='st_paivivo'>
                            <?php else: ?> 
                                <input type="checkbox" class="checkbox" value="<?php echo e($cliente->st_paivivo ?? ''); ?>" name='st_paivivo'>
                            <?php endif; ?> 
                        <?php else: ?>
                            <input type="checkbox" class="checkbox" value="<?php echo e($cliente->st_paivivo ?? ''); ?>" name='st_paivivo'>
                        <?php endif; ?>
                    </div>                           
                </div> 
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="nm_obs" class="control-label">Observação</label>
                        <textarea class="form-control" rows="5" name='nm_obs'><?php echo e($cliente->nm_obs ?? ''); ?></textarea>
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
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/wfuneraria/public_html/anjogabriel/resources/views/forms/cliente.blade.php ENDPATH**/ ?>