

<?php $__env->startSection('title', 'Obito'); ?>

<?php $__env->startSection('content_header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>    

<!-- general form elements -->    
<div class='box box-primary box-solid'> 
    <div class='box-header with-border'>            
        <h3 class="box-title">Obito</h3>
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

    <form method="post" action="<?php echo e($action ?? url('obito')); ?>">    
    <?php echo e(csrf_field()); ?>

    <?php if(isset($obito)): ?> <?php echo e(method_field('patch')); ?> <?php endif; ?>

        <!-- /.box-header -->
        <div class="box-body">   
            <fieldset class="form-group">
                <input type="hidden" value="<?php echo e($obito->id_obito ?? ''); ?>" name="id_obito" id="id_obito" class="form-control">
                <div class="row">
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nr_declaracao" class="control-label">Nº Obito/Declaração</label>
                        <input type="text" class="form-control" value="<?php echo e($obito->nr_declaracao ?? ''); ?>" name="nr_declaracao" maxlength="20" autocomplete="off" required>
                    </div>       
                    <div class="form-group col-sm-2 mb-3">
                        <label for="dt_atendimento" class="control-label">Data do Atendimento</label>
                        <input type="text" class="form-control" value="<?php echo e(empty($obito->dt_atendimento) ? date('d/m/Y') : $obito->dt_atendimento->format('d/m/Y') ?? ''); ?>" name="dt_atendimento" onkeypress="$(this).mask('00/00/0000')" autocomplete="off" required>
                    </div>   
                    <div class="form-group col-sm-2 mb-3">
                        <label for="hr_atendimento" class="control-label">Hora do Atendimento</label>
                        <input type="text" class="form-control" value="<?php echo e($obito->hr_atendimento ?? date('H:i:s')); ?>" name="hr_atendimento" onkeypress="$(this).mask('99:99:99')" autocomplete="off" required>
                    </div>   
                </div>
            </fieldset>
            <!-- Dados do falecido -->
            <fieldset class="form-group">
            <legend class="label label-success"><span><h4>Dados do Falecido</h4></span></legend>                
                <div class="row">
                    <div class="form-group col-sm-6 mb-1">
                        <label for="nm_dependente" class="control-label">Nome</label>
                        <input type="text" class="form-control" value="<?php echo e($obito->nm_dependente ?? ''); ?>" 
                         name="nm_dependente" id="nm_dependente" placeholder="Nome, CPF/CNPJ ou Contrato" autocomplete="off">                                                                             
                    </div>   
                    <input type="hidden" class="form-control" value="<?php echo e($obito->id_dependente ?? ''); ?>" name="id_dependente" id="id_dependente" required>
                    <input type="hidden" class="form-control" value="<?php echo e($obito->nr_contrato ?? ''); ?>" name="nr_contrato" id="nr_contrato" maxlength="10" autocomplete="off" required>                    
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nr_contrato_1" class="control-label">Nº Contrato</label>
                        <input type="text" class="form-control" value="<?php echo e($obito->nr_contrato ?? ''); ?>" name="nr_contrato_1" id="nr_contrato_1" maxlength="10" autocomplete="off" disabled>
                    </div>       
                    <div class="form-group col-sm-2 mb-3">
                        <label for="dt_falecimento" class="control-label">Data do Falecimento</label>
                        <input type="text" class="form-control" value="<?php echo e(empty($obito->dt_falecimento) ? '' : $obito->dt_falecimento->format('d/m/Y') ?? ''); ?>" name="dt_falecimento" onkeypress="$(this).mask('00/00/0000')" autocomplete="off">
                    </div>   
                    <div class="form-group col-sm-2 mb-3">
                        <label for="hr_falecimento" class="control-label">Hora do Falecimento</label>
                        <input type="text" class="form-control" value="<?php echo e($obito->hr_falecimento ?? ''); ?>" name="hr_falecimento" onkeypress="$(this).mask('99:99:99')" autocomplete="off">
                    </div>                       
                </div>        
                <div class="row">
                    <div class="form-group col-sm-2 mb-3">
                        <label for="dt_nascimento" class="control-label">Nascimento</label>
                        <input type="text" class="form-control" value="<?php echo e(empty($obito->dt_nascimento) ? '' : $obito->dt_nascimento->format('d/m/Y') ?? ''); ?>" name="dt_nascimento" onkeypress="$(this).mask('00/00/0000')" autocomplete="off">
                    </div> 
                    <div class="form-group col-sm-2 mb-1">
                        <label for="st_sexo" class="control-label">Sexo</label>
                        <select class="form-control" name="st_sexo">
                            <option value=""></option>
                            <?php $__currentLoopData = $sexos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sexo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(isset($obito)): ?>
                                    <?php if($sexo['st_sexo']==$obito->st_sexo): ?>
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
                        <label for="nm_cor" class="control-label">Cor</label>
                        <input type="text" class="form-control" value="<?php echo e($obito->nm_cor ?? ''); ?>" name="nm_cor" maxlength="100" autocomplete="off">                    
                    </div>                         
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nr_cpf" class="control-label">CPF</label>
                        <input type="text" class="form-control" value="<?php echo e($obito->nr_cpfcnpj ?? ''); ?>" name="nr_cpfcnpj" onkeypress="$(this).mask('000.000.000-00');" autocomplete="off">                    
                    </div>                         
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nr_rg" class="control-label">RG</label>
                        <input type="text" class="form-control" value="<?php echo e($obito->nr_rgie ?? ''); ?>" name="nr_rgie" maxlength="30" autocomplete="off">     
                    </div>    
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nm_profissao" class="control-label">Profissão</label>
                        <input type="text" class="form-control" value="<?php echo e($obito->nm_profissao ?? ''); ?>" name="nm_profissao" maxlength="100" autocomplete="off">                    
                    </div>                         
                </div>
                <div class="row">
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nr_telefone1" class="control-label">1º Telefone</label>
                        <input type="text" class="form-control" value="<?php echo e($obito->nr_telefone1 ?? ''); ?>" name='nr_telefone1' onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off">     
                    </div>
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nr_telefone2" class="control-label">2º Telefone</label>
                        <input type="text" class="form-control" value="<?php echo e($obito->nr_telefone2 ?? ''); ?>" name='nr_telefone2' onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off">     
                    </div>
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nm_nacionalidade" class="control-label">Nacionalidade</label>
                        <input type="text" class="form-control" value="<?php echo e($obito->nm_nacionalidade ?? ''); ?>" name="nm_nacionalidade" maxlength="100" autocomplete="off">                    
                    </div>                         
                    <div class="form-group col-sm-3 mb-3">
                        <label for="nm_naturalidade" class="control-label">Naturalidade</label>
                        <input type="text" class="form-control" value="<?php echo e($obito->nm_naturalidade ?? ''); ?>" name="nm_naturalidade" maxlength="100" autocomplete="off">                    
                    </div>                         
                    <div class="form-group col-sm-3 mb-1">
                        <label for="id_estcivil" class="control-label">Estado Civil</label>
                        <select class="form-control" name="id_estcivil">
                            <option value=""></option>
                            <?php $__currentLoopData = $estcivils; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $estcivil): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(isset($obito)): ?>
                                    <?php if($estcivil->id_estcivil==$obito->id_estcivil): ?>
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
                </div>
                <div class="row">
                    <div class="form-group col-sm-5 mb-3">
                        <label for="nm_endereco" class="control-label">Endereço</label>
                        <input type="text" class="form-control" value="<?php echo e($obito->nm_endereco ?? ''); ?>" name='nm_endereco' maxlength="100" autocomplete="off">     
                    </div>                            
                    <div class="form-group col-sm-2 mb-3">
                        <label for="nr_numender" class="control-label">Numero</label>
                        <input type="text" class="form-control" value="<?php echo e($obito->nr_numender ?? ''); ?>" name='nr_numender' maxlength="20" autocomplete="off">
                    </div>
                    <div class="form-group col-sm-5 mb-3">
                        <label for="nm_complender" class="control-label">Complemento</label>
                        <input type="text" class="form-control" value="<?php echo e($obito->nm_complender ?? ''); ?>" name='nm_complender' maxlength="100" autocomplete="off">     
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_bairro" class="control-label">Bairro</label>
                        <input type="text" class="form-control" value="<?php echo e($obito->nm_bairro ?? ''); ?>" name='nm_bairro' maxlength="60" autocomplete="off">     
                    </div>                            
                    <div class="form-group col-sm-4 mb-3">
                        <label for="nm_cidade" class="control-label">Cidade</label>
                        <input type="text" class="form-control" value="<?php echo e($obito->nm_cidade ?? ''); ?>" name='nm_cidade' maxlength="60" autocomplete="off">
                    </div>    
                    <div class="form-group col-sm-4 mb-1">
                        <label for="nm_estado" class="control-label">Estado</label>
                        <select class="form-control" name="nm_estado">
                            <option value=""></option>
                            <?php $__currentLoopData = $estados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $estado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(isset($obito)): ?>
                                    <?php if($estado->nm_sigla==$obito->nm_estado): ?>
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
                    <div class="form-group col-sm-2 mb-3">                                    
                        <label for="st_bens" class="control-label">Bens ?</label>
                        <?php if(isset($obito)): ?>                        
                            <?php if($obito->st_bens===1): ?>
                                <input type="checkbox" class="checkbox" value="<?php echo e($obito->st_bens ?? ''); ?>" checked name='st_bens'>
                            <?php else: ?> 
                                <input type="checkbox" class="checkbox" value="<?php echo e($obito->st_bens ?? ''); ?>" name='st_bens'>
                            <?php endif; ?> 
                        <?php else: ?>
                            <input type="checkbox" class="checkbox" value="<?php echo e($obito->st_bens ?? ''); ?>" name='st_bens'>
                        <?php endif; ?>                                
                    </div>                           
                    <div class="form-group col-sm-2 mb-3">                                    
                        <label for="st_testamento" class="control-label">Testamento ?</label>
                        <?php if(isset($obito)): ?>                        
                            <?php if($obito->st_testamento===1): ?>
                                <input type="checkbox" class="checkbox" value="<?php echo e($obito->st_testamento ?? ''); ?>" checked name='st_testamento'>
                            <?php else: ?> 
                                <input type="checkbox" class="checkbox" value="<?php echo e($obito->st_testamento ?? ''); ?>" name='st_testamento'>
                            <?php endif; ?> 
                        <?php else: ?>
                            <input type="checkbox" class="checkbox" value="<?php echo e($obito->st_testamento ?? ''); ?>" name='st_testamento'>
                        <?php endif; ?>                                
                    </div>                           
                    <div class="form-group col-sm-2 mb-3">                                    
                        <label for="st_reservista" class="control-label">Reservista ?</label>
                        <?php if(isset($obito)): ?>                        
                            <?php if($obito->st_reservista===1): ?>
                                <input type="checkbox" class="checkbox" value="<?php echo e($obito->st_reservista ?? ''); ?>" checked name='st_reservista'>
                            <?php else: ?> 
                                <input type="checkbox" class="checkbox" value="<?php echo e($obito->st_reservista ?? ''); ?>" name='st_reservista'>
                            <?php endif; ?> 
                        <?php else: ?>
                            <input type="checkbox" class="checkbox" value="<?php echo e($obito->st_reservista ?? ''); ?>" name='st_reservista'>
                        <?php endif; ?>                                
                    </div>               
                    <div class="form-group col-sm-2 mb-3">                                    
                        <label for="st_eleitor" class="control-label">Eleitor ?</label>
                        <?php if(isset($obito)): ?>                        
                            <?php if($obito->st_eleitor===1): ?>
                                <input type="checkbox" class="checkbox" value="<?php echo e($obito->st_eleitor ?? ''); ?>" checked name='st_eleitor'>
                            <?php else: ?> 
                                <input type="checkbox" class="checkbox" value="<?php echo e($obito->st_eleitor ?? ''); ?>" name='st_eleitor'>
                            <?php endif; ?> 
                        <?php else: ?>
                            <input type="checkbox" class="checkbox" value="<?php echo e($obito->st_eleitor ?? ''); ?>" name='st_eleitor'>
                        <?php endif; ?>                                
                    </div>                                            
                </div>
                <div class="row">
                    <div class="form-group col-sm-6 mb-3">
                        <label for="nm_pai" class="control-label">Pai</label>
                        <input type="text" class="form-control" value="<?php echo e($obito->nm_pai ?? ''); ?>" name='nm_pai' maxlength="100" autocomplete="off">     
                    </div>
                    <div class="form-group col-sm-6 mb-3">
                        <label for="nm_mae" class="control-label">Mãe</label>
                        <input type="text" class="form-control" value="<?php echo e($obito->nm_mae ?? ''); ?>" name='nm_mae' maxlength="100" autocomplete="off">     
                    </div>
                </div>
            </fieldset>
            <!-- Dados do falecimeno -->
            <fieldset class="form-group">
            <legend class="label label-success"><span><h4>Dados do Falecimento</h4></span></legend>                
                <div class="row">
                    <div class="form-group col-sm-8 mb-3">
                        <label for="ds_falecimento" class="control-label">Local de Falecimento</label>
                        <input type="text" class="form-control" value="<?php echo e($obito->ds_falecimento ?? ''); ?>" name='ds_falecimento' maxlength="100" autocomplete="off">     
                    </div>
                    <div class="form-group col-sm-2 mb-3">
                        <label for="dt_sepultamento" class="control-label">Data do Sepultamento</label>
                        <input type="text" class="form-control" value="<?php echo e(empty($obito->dt_sepultamento) ? '' : $obito->dt_sepultamento->format('d/m/Y') ?? ''); ?>" name='dt_sepultamento' onkeypress="$(this).mask('00/00/0000')" autocomplete="off">
                    </div>    
                    <div class="form-group col-sm-2 mb-3">
                        <label for="hr_sepultamento" class="control-label">Hora do Sepultamento</label>
                        <input type="text" class="form-control" value="<?php echo e($obito->hr_sepultamento ?? ''); ?>" name='hr_sepultamento' onkeypress="$(this).mask('99:99:99')" autocomplete="off">
                    </div>    
                </div>
                <div class="row">
                    <div class="form-group col-sm-12 mb-3">
                        <label for="ds_velorio" class="control-label">Endereço do velório</label>
                        <input type="text" class="form-control" value="<?php echo e($obito->ds_velorio ?? ''); ?>" name='ds_velorio' maxlength="100" autocomplete="off">     
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-4 mb-1">
                        <label for="id_cemiterio" class="control-label">Cemitério/Crematório</label>
                        <select class="form-control" name="id_cemiterio">
                            <option value=""></option>
                            <?php $__currentLoopData = $cemiterios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cemiterio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(isset($obito)): ?>
                                    <?php if($cemiterio->id_cemiterio==$obito->id_cemiterio): ?>
                                    <option value="<?php echo e($cemiterio->id_cemiterio); ?>" selected>
                                    <?php echo e($cemiterio->nm_cemiterio); ?>

                                    </option>
                                    <?php else: ?>
                                    <option value="<?php echo e($cemiterio->id_cemiterio); ?>">
                                    <?php echo e($cemiterio->nm_cemiterio); ?>

                                    </option>
                                    <?php endif; ?>	         
                                <?php else: ?>                                    
                                    <option value="<?php echo e($cemiterio->id_cemiterio); ?>">
                                    <?php echo e($cemiterio->nm_cemiterio); ?>

                                    </option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>       
                    <div class="form-group col-sm-2 mb-1">
                        <label for="id_tppagamentocm" class="control-label">Tipo Pagamento</label>
                        <select class="form-control" name="id_tppagamentocm">
                            <option value=""></option>
                            <?php $__currentLoopData = $tppagamentoscm; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tppagamentocm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(isset($obito)): ?>
                                    <?php if($tppagamentocm->id_tppagamento==$obito->id_tppagamentocm): ?>
                                    <option value="<?php echo e($tppagamentocm->id_tppagamento); ?>" selected>
                                    <?php echo e($tppagamentocm->nm_tppagamento); ?>

                                    </option>
                                    <?php else: ?>
                                    <option value="<?php echo e($tppagamentocm->id_tppagamento); ?>">
                                    <?php echo e($tppagamentocm->nm_tppagamento); ?>

                                    </option>
                                    <?php endif; ?>	         
                                <?php else: ?>                                    
                                    <option value="<?php echo e($tppagamentocm->id_tppagamento); ?>">
                                    <?php echo e($tppagamentocm->nm_tppagamento); ?>

                                    </option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>    
                    <div class="form-group col-sm-2 mb-1">
                        <label for="vl_despesacm" class="control-label">$ Despesa</label>
                        <input type="text" class="form-control" value="<?php echo e($obito->vl_despesacm ?? ''); ?>" name="vl_despesacm" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off">                  
                    </div> 
                    <div class="form-group col-sm-4 mb-1">
                        <label for="nr_chequecm" class="control-label">Nº Cheque</label>
                        <input type="text" class="form-control" value="<?php echo e($obito->nr_chequecm ?? ''); ?>" name="nr_chequecm" maxlength="20" autocomplete="off">     
                    </div>       
                </div>
                <div class="row">
                    <div class="form-group col-sm-4 mb-3">
                    <label for="id_funeraria" class="control-label">Funerária</label>
                        <select class="form-control" name="id_funeraria">
                            <option value=""></option>
                            <?php $__currentLoopData = $funerarias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $funeraria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(isset($obito)): ?>
                                    <?php if($funeraria->id_funeraria==$obito->id_funeraria): ?>
                                    <option value="<?php echo e($funeraria->id_funeraria); ?>" selected>
                                    <?php echo e($funeraria->nm_funeraria); ?>

                                    </option>
                                    <?php else: ?>
                                    <option value="<?php echo e($funeraria->id_funeraria); ?>">
                                    <?php echo e($funeraria->nm_funeraria); ?>

                                    </option>
                                    <?php endif; ?>	         
                                <?php else: ?>                                    
                                    <option value="<?php echo e($funeraria->id_funeraria); ?>">
                                    <?php echo e($funeraria->nm_funeraria); ?>

                                    </option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>                 
                    <div class="form-group col-sm-2 mb-1">
                        <label for="id_tppagamentofn" class="control-label">Tipo Pagamento</label>
                        <select class="form-control" name="id_tppagamentofn">
                            <option value=""></option>
                            <?php $__currentLoopData = $tppagamentosfn; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tppagamentofn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(isset($obito)): ?>
                                    <?php if($tppagamentofn->id_tppagamento==$obito->id_tppagamentofn): ?>
                                    <option value="<?php echo e($tppagamentofn->id_tppagamento); ?>" selected>
                                    <?php echo e($tppagamentofn->nm_tppagamento); ?>

                                    </option>
                                    <?php else: ?>
                                    <option value="<?php echo e($tppagamentofn->id_tppagamento); ?>">
                                    <?php echo e($tppagamentofn->nm_tppagamento); ?>

                                    </option>
                                    <?php endif; ?>	         
                                <?php else: ?>                                    
                                    <option value="<?php echo e($tppagamentofn->id_tppagamento); ?>">
                                    <?php echo e($tppagamentofn->nm_tppagamento); ?>

                                    </option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>    
                    <div class="form-group col-sm-2 mb-1">
                        <label for="vl_despesafn" class="control-label">$ Despesa</label>
                        <input type="text" class="form-control" value="<?php echo e($obito->vl_despesafn ?? ''); ?>" name="vl_despesafn" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off">                  
                    </div> 
                    <div class="form-group col-sm-4 mb-1">
                        <label for="nr_chequefn" class="control-label">Nº Cheque</label>
                        <input type="text" class="form-control" value="<?php echo e($obito->nr_chequefn ?? ''); ?>" name="nr_chequefn" maxlength="20" autocomplete="off">     
                    </div>        
                </div>
                <div class="row">
                    <div class="form-group col-sm-4 mb-1">
                        <label for="id_capela" class="control-label">Capela</label>
                        <select class="form-control" name="id_capela">
                            <option value=""></option>
                            <?php $__currentLoopData = $capelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $capela): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(isset($obito)): ?>
                                    <?php if($capela->id_capela==$obito->id_capela): ?>
                                    <option value="<?php echo e($capela->id_capela); ?>" selected>
                                    <?php echo e($capela->nm_capela); ?>

                                    </option>
                                    <?php else: ?>
                                    <option value="<?php echo e($capela->id_capela); ?>">
                                    <?php echo e($capela->nm_capela); ?>

                                    </option>
                                    <?php endif; ?>	         
                                <?php else: ?>                                    
                                    <option value="<?php echo e($capela->id_capela); ?>">
                                    <?php echo e($capela->nm_capela); ?>

                                    </option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>    
                    <div class="form-group col-sm-2 mb-1">
                        <label for="id_tppagamentocp" class="control-label">Tipo Pagamento</label>
                        <select class="form-control" name="id_tppagamentocp">
                            <option value=""></option>
                            <?php $__currentLoopData = $tppagamentoscp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tppagamentocp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(isset($obito)): ?>
                                    <?php if($tppagamentocp->id_tppagamento==$obito->id_tppagamentocp): ?>
                                    <option value="<?php echo e($tppagamentocp->id_tppagamento); ?>" selected>
                                    <?php echo e($tppagamentocp->nm_tppagamento); ?>

                                    </option>
                                    <?php else: ?>
                                    <option value="<?php echo e($tppagamentocp->id_tppagamento); ?>">
                                    <?php echo e($tppagamentocp->nm_tppagamento); ?>

                                    </option>
                                    <?php endif; ?>	         
                                <?php else: ?>                                    
                                    <option value="<?php echo e($tppagamentocp->id_tppagamento); ?>">
                                    <?php echo e($tppagamentocp->nm_tppagamento); ?>

                                    </option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>    
                    <div class="form-group col-sm-2 mb-1">
                        <label for="vl_despesacp" class="control-label">$ Despesa</label>
                        <input type="text" class="form-control" value="<?php echo e($obito->vl_despesacp ?? ''); ?>" name="vl_despesacp" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off">                  
                    </div> 
                    <div class="form-group col-sm-4 mb-1">
                        <label for="nr_chequecp" class="control-label">Nº Cheque</label>
                        <input type="text" class="form-control" value="<?php echo e($obito->nr_chequecp ?? ''); ?>" name="nr_chequecp" maxlength="20" autocomplete="off">     
                    </div>        
                </div>
                <div class="row">
                    <div class="form-group col-sm-6 mb-3">
                        <label for="nm_medico" class="control-label">Médico</label>
                        <input type="text" class="form-control" value="<?php echo e($obito->nm_medico ?? ''); ?>" name='nm_medico' maxlength="100" autocomplete="off">     
                    </div>
                    <div class="form-group col-sm-6 mb-3">
                        <label for="nr_crm" class="control-label">Nº CRM</label>
                        <input type="text" class="form-control" value="<?php echo e($obito->nr_crm ?? ''); ?>" name='nr_crm' maxlength="20" autocomplete="off">     
                    </div>
                    <div class="form-group col-sm-12 mb-3">
                        <label for="nm_medico" class="control-label">Causa da Morte</label>
                        <input type="text" class="form-control" value="<?php echo e($obito->nm_causamorte ?? ''); ?>" name='nm_causamorte' maxlength="100" autocomplete="off">     
                    </div>
                </div>
            </fieldset>
            <!-- Dados complementares -->
            <fieldset class="form-group">
            <legend class="label label-success"><span><h4>Dados Complementares</h4></span></legend>               
                <div class="row">
                    <div class="form-group col-sm-2 mb-3">                                    
                        <label for="st_declaobito" class="control-label">Declaração de Óbito ?</label>
                        <?php if(isset($obito)): ?>                        
                            <?php if($obito->st_declaobito===1): ?>
                                <input type="checkbox" class="checkbox" value="<?php echo e($obito->st_declaobito ?? ''); ?>" checked name='st_declaobito' >
                            <?php else: ?> 
                                <input type="checkbox" class="checkbox" value="<?php echo e($obito->st_declaobito ?? ''); ?>" name='st_declaobito'>
                            <?php endif; ?> 
                        <?php else: ?>
                            <input type="checkbox" class="checkbox" value="<?php echo e($obito->st_declaobito ?? ''); ?>" name='st_declaobito'>
                        <?php endif; ?>                                
                    </div>                           
                    <div class="form-group col-sm-2 mb-3">                                    
                        <label for="st_tanatopraxia" class="control-label">Autorização Tanatopraxia ?</label>
                        <?php if(isset($obito)): ?>                        
                            <?php if($obito->st_tanatopraxia===1): ?>
                                <input type="checkbox" class="checkbox" value="<?php echo e($obito->st_tanatopraxia ?? ''); ?>" checked name='st_tanatopraxia'>
                            <?php else: ?> 
                                <input type="checkbox" class="checkbox" value="<?php echo e($obito->st_tanatopraxia ?? ''); ?>" name='st_tanatopraxia'>
                            <?php endif; ?> 
                        <?php else: ?>
                            <input type="checkbox" class="checkbox" value="<?php echo e($obito->st_tanatopraxia ?? ''); ?>" name='st_tanatopraxia'>
                        <?php endif; ?>                                
                    </div>                           
                    <div class="form-group col-sm-2 mb-3">                                    
                        <label for="st_translado" class="control-label">Translado de cadáver ?</label>
                        <?php if(isset($obito)): ?>                        
                            <?php if($obito->st_translado===1): ?>
                                <input type="checkbox" class="checkbox" value="<?php echo e($obito->st_translado ?? ''); ?>" checked name='st_translado'>
                            <?php else: ?> 
                                <input type="checkbox" class="checkbox" value="<?php echo e($obito->st_translado ?? ''); ?>" name='st_translado'>
                            <?php endif; ?> 
                        <?php else: ?>
                            <input type="checkbox" class="checkbox" value="<?php echo e($obito->st_translado ?? ''); ?>" name='st_translado'>
                        <?php endif; ?>                                
                    </div>               
                    <div class="form-group col-sm-2 mb-3">                                    
                        <label for="st_notafaleci" class="control-label">Nota falecimento/convite ?</label>
                        <?php if(isset($obito)): ?>                        
                            <?php if($obito->st_notafaleci===1): ?>
                                <input type="checkbox" class="checkbox" value="<?php echo e($obito->st_notafaleci ?? ''); ?>" checked name='st_notafaleci'>
                            <?php else: ?> 
                                <input type="checkbox" class="checkbox" value="<?php echo e($obito->st_notafaleci ?? ''); ?>" name='st_notafaleci'>
                            <?php endif; ?> 
                        <?php else: ?>
                            <input type="checkbox" class="checkbox" value="<?php echo e($obito->st_notafaleci ?? ''); ?>" name='st_notafaleci'>
                        <?php endif; ?>                                
                    </div>                                            
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="nm_obs" class="control-label">Observação</label>
                        <textarea class="form-control" rows="5" name='nm_obs'><?php echo e($obito->nm_obs ?? ''); ?></textarea>
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
$("#nm_dependente").autocomplete({    
    source: "<?php echo e(URL::to('completecontrdep')); ?>",
    dataType: "json",
    minLength: 2,
    focus: function( event, ui ) {        
        $( "#nm_dependente" ).val( ui.item.label );
        return false;
    },    
    select: function( event, ui ) {        
        $("#id_dependente").val(ui.item.id);	                    
        $("#nm_dependente").val(ui.item.label);	
        $("#nr_contrato").val(ui.item.contrato);	
        $("#nr_contrato_1").val(ui.item.contrato);	
        return false;
	},
}).autocomplete( "instance" )._renderItem = function( ul, item ) {    
    return $( "<li>" )    
        .append( "<div>" + item.label + " - <b>Contrato: " + item.contrato + "</b></div>" )
        .appendTo( ul );
};    
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/wfuneraria/public_html/paranaluto/resources/views/forms/obito.blade.php ENDPATH**/ ?>