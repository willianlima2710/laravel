

<?php $__env->startSection('title', 'Contas a pagar'); ?>

<?php $__env->startSection('content_header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- topo -->
<div class="row">
    <div class="col-sm-12 margin-tb">
        <div class="pull-left">
        <h3><i class="ion ion-clipboard"></i> Ficha do Cliente</h3>
        </div>
        <div class="pull-right">            
        <a href="<?php echo e(url()->previous()); ?>" class="btn btn-primary" style="margin: 10px;">Voltar</a>
        </div>
    </div>
</div>

<!-- dados do cliente -->
<div class="box box-solid box-success collapsed-box">
    <div class="box-header">
        <h3 class="box-title">Cliente</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>    
    <!-- /.box-header -->
    <div class="box-body">   
        <fieldset class="form-group">
            <div class="row">
                <div class="form-group col-sm-10 mb-1">
                    <label for="nm_pessoa" class="control-label">Nome</label>
                    <input type="text" class="form-control input-sm" value="<?php echo e($cliente->nm_pessoa ?? ''); ?>" name="nm_pessoa" maxlength="100" autocomplete="off" disabled>                    
                </div>             
                <div class="form-group col-sm-2 mb-1">
                    <label for="cd_pessoa" class="control-label">Código</label>
                    <input type="text" class="form-control input-sm" value="<?php echo e($cliente->cd_pessoa ?? ''); ?>" name="cd_pessoa" maxlength="10" autocomplete="off" disabled>                    
                </div>                                 
            </div>    
            <div class="row">
                <div class="form-group col-sm-2 mb-1">
                    <label for="st_sexo" class="control-label">Sexo</label>
                    <select class="form-control input-sm" name="st_sexo" disabled>
                        <option value=""></option>
                        <?php $__currentLoopData = $sexo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sex): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(isset($cliente)): ?>
                                <?php if($sex['st_sexo']==$cliente->st_sexo): ?>
                                <option value="<?php echo e($sex['st_sexo']); ?>" selected>
                                <?php echo e($sex['nm_sexo']); ?>

                                </option>
                                <?php else: ?>
                                <option value="<?php echo e($sex['st_sexo']); ?>">
                                <?php echo e($sex['nm_sexo']); ?>

                                </option>
                                <?php endif; ?>	         
                            <?php else: ?>                                    
                                <option value="<?php echo e($sex['st_sexo']); ?>">
                                <?php echo e($sex['nm_sexo']); ?>

                                </option>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>    
                <div class="form-group col-sm-2 mb-3">
                    <label for="dt_nascimento" class="control-label">Data de Nascimento</label>
                    <input type="text" class="form-control input-sm"  value="<?php echo e(empty($cliente->dt_nascimento) ? '' : $cliente->dt_nascimento->format('d/m/Y') ?? ''); ?>" name='dt_nascimento' onkeypress="$(this).mask('00/00/0000')" autocomplete="off" disabled>
                </div>    
                <div class="form-group col-sm-2 mb-3">
                    <label for="nr_cpfcnpj" class="control-label">CPF</label>
                    <input type="text" class="form-control input-sm"  value="<?php echo e($cliente->nr_cpfcnpj ?? ''); ?>" name='nr_cpfcnpj' onkeypress="$(this).mask('000.000.000-00');" autocomplete="off" disabled>                     
                </div>                        
                <div class="form-group col-sm-2 mb-3">
                    <label for="nr_rgie" class="control-label">RG</label>
                    <input type="text" class="form-control input-sm"  value="<?php echo e($cliente->nr_rgie ?? ''); ?>" name='nr_rgie' maxlength="30" autocomplete="off" disabled>     
                </div>    
                <div class="form-group col-sm-4 mb-3">
                    <label for="nr_telefone1" class="control-label">1º Telefone</label>
                    <input type="text" class="form-control input-sm"  value="<?php echo e($cliente->nr_telefone1 ?? ''); ?>" name='nr_telefone1' onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off" disabled>     
                </div>
            </div>    
            <div class="row">
                <div class="form-group col-sm-2 mb-3">
                    <label for="nr_cep" class="control-label">CEP</label>
                    <input type="text" class="form-control input-sm"  value="<?php echo e($cliente->nr_cep ?? ''); ?>" name='nr_cep' autocomplete="off" disabled>
                </div>    
                <div class="form-group col-sm-5 mb-3">
                    <label for="nm_endereco" class="control-label">Endereço</label>
                    <input type="text" class="form-control input-sm"  value="<?php echo e($cliente->nm_endereco ?? ''); ?>" name='nm_endereco' maxlength="100" autocomplete="off" disabled>     
                </div>                            
                <div class="form-group col-sm-2 mb-3">
                    <label for="nr_numender" class="control-label">Numero</label>
                    <input type="text" class="form-control input-sm"  value="<?php echo e($cliente->nr_numender ?? ''); ?>" name='nr_numender' maxlength="20" autocomplete="off" disabled>
                </div>
                <div class="form-group col-sm-3 mb-3">
                    <label for="nm_complender" class="control-label">Complemento</label>
                    <input type="text" class="form-control input-sm"  value="<?php echo e($cliente->nm_complender ?? ''); ?>" name='nm_complender' maxlength="60" autocomplete="off" disabled>     
                </div>
            </div> 
            <div class="row">
                <div class="form-group col-sm-4 mb-3">
                    <label for="nm_bairro" class="control-label">Bairro</label>
                    <input type="text" class="form-control input-sm"  value="<?php echo e($cliente->nm_bairro ?? ''); ?>" name='nm_bairro' maxlength="60" autocomplete="off" disabled>     
                </div>                            
                <div class="form-group col-sm-4 mb-3">
                    <label for="nm_cidade" class="control-label">Cidade</label>
                    <input type="text" class="form-control input-sm"  value="<?php echo e($cliente->nm_cidade ?? ''); ?>" name='nm_cidade' maxlength="60" autocomplete="off" disabled>
                </div>    
                <div class="form-group col-sm-4 mb-1">
                    <label for="nm_estado" class="control-label">Estado</label>
                    <select class="form-control input-sm"  name="nm_estado" disabled>
                        <option value=""></option>
                        <?php $__currentLoopData = $estado; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $est): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(isset($cliente)): ?>
                                <?php if($est->nm_sigla==$cliente->nm_estado): ?>
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
                    <input type="text" class="form-control input-sm"  value="<?php echo e($cliente->nm_telefone2 ?? ''); ?>" name='nm_telefone2' onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off" disabled>     
                </div>                            
                <div class="form-group col-sm-4 mb-3">
                    <label for="nm_telefone3" class="control-label">3º Telefone</label>
                    <input type="text" class="form-control input-sm"  value="<?php echo e($cliente->nm_telefone3 ?? ''); ?>" name='nm_telefone3' onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off" disabled>
                </div>    
                <div class="form-group col-sm-4 mb-3">
                    <label for="nm_telefone4" class="control-label">4º Telefone</label>
                    <input type="text" class="form-control input-sm"  value="<?php echo e($cliente->nm_telefone4 ?? ''); ?>" name='nm_telefone4' onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off" disabled>
                </div>    
            </div> 
            <div class="row">
                <div class="form-group col-sm-8 mb-3">
                    <label for="nm_email" class="control-label">E-Mail</label>
                    <input type="email" class="form-control input-sm"  value="<?php echo e($cliente->nm_email ?? ''); ?>" name='nm_email' maxlength="191" autocomplete="off" disabled>
                </div>    
                <div class="form-group col-sm-4 mb-3">
                    <label for="nm_profissao" class="control-label">Profissão</label>
                    <input type="text" class="form-control input-sm"  value="<?php echo e($cliente->nm_profissao ?? ''); ?>" name='nm_profissao' maxlength="100" autocomplete="off" disabled>     
                </div>                            
            </div>
            <div class="row">
                <div class="form-group col-sm-2 mb-3">
                    <label for="nm_nacionalidade" class="control-label">Nacionalidade</label>
                    <input type="text" class="form-control input-sm"  value="<?php echo e($cliente->nm_nacionalidade ?? ''); ?>" name='nm_nacionalidade' maxlength="100" autocomplete="off" disabled>     
                </div>   
                <div class="form-group col-sm-2 mb-3">
                    <label for="nm_naturalidade" class="control-label">Naturalidade</label>
                    <input type="text" class="form-control input-sm"  value="<?php echo e($cliente->nm_naturalidade ?? ''); ?>" name='nm_naturalidade' maxlength="100" autocomplete="off" disabled>     
                </div>     
                <div class="form-group col-sm-4 mb-1">
                    <label for="id_estcivil" class="control-label">Estado Civil</label>
                    <select class="form-control input-sm"  name="id_estcivil" disabled>
                        <option value=""></option>
                        <?php $__currentLoopData = $estcivil; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $est): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(isset($cliente)): ?>
                                <?php if($est->id_estcivil==$cliente->id_estcivil): ?>
                                <option value="<?php echo e($est->id_estcivil); ?>" selected>
                                <?php echo e($est->nm_estcivil); ?>

                                </option>
                                <?php else: ?>
                                <option value="<?php echo e($est->id_estcivil); ?>">
                                <?php echo e($est->nm_estcivil); ?>

                                </option>
                                <?php endif; ?>	         
                            <?php else: ?>                                    
                                <option value="<?php echo e($est->id_estcivil); ?>">
                                <?php echo e($est->nm_estcivil); ?>

                                </option>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>    
                <div class="form-group col-sm-4 mb-1">
                    <label for="id_religiao" class="control-label">Religião</label>
                    <select class="form-control input-sm"  name="id_religiao" disabled>
                        <option value=""></option>
                        <?php $__currentLoopData = $religiao; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relig): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(isset($cliente)): ?>
                                <?php if($relig->id_religiao==$cliente->id_religiao): ?>
                                <option value="<?php echo e($relig->id_religiao); ?>" selected>
                                <?php echo e($relig->nm_religiao); ?>

                                </option>
                                <?php else: ?>
                                <option value="<?php echo e($relig->id_religiao); ?>">
                                <?php echo e($relig->nm_religiao); ?>

                                </option>
                                <?php endif; ?>	         
                            <?php else: ?>                                    
                                <option value="<?php echo e($relig->id_religiao); ?>">
                                <?php echo e($relig->nm_religiao); ?>

                                </option>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>    
            </div>
        </fieldset>   
        <!-- Dados complementares -->
        <fieldset class="form-group">
        <legend>Complementares</legend>
            <div class="row">
                <div class="form-group col-sm-8 mb-3">
                    <label for="nm_conjuge" class="control-label">Conjuge</label>
                    <input type="text" class="form-control input-sm"  value="<?php echo e($cliente->nm_conjuge ?? ''); ?>" name='nm_conjuge' maxlength="100" autocomplete="off" disabled>     
                </div>
                <div class="form-group col-sm-3 mb-3">
                    <label for="nr_conjugetelefone" class="control-label">Telefone</label>
                    <input type="text" class="form-control input-sm"  value="<?php echo e($cliente->nr_conjugetelefone ?? ''); ?>" name='nr_conjugetelefone' onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off" disabled>      
                </div>
            </div> 
            <div class="row">
                <div class="form-group col-sm-8 mb-3">
                    <label for="nm_mae" class="control-label">Mãe</label>
                    <input type="text" class="form-control input-sm"  value="<?php echo e($cliente->nm_mae ?? ''); ?>" name='nm_mae' maxlength="100" autocomplete="off" disabled>     
                </div>
                <div class="form-group col-sm-3 mb-3">
                    <label for="nr_maetelefone" class="control-label">Telefone</label>
                    <input type="text" class="form-control input-sm"  value="<?php echo e($cliente->nr_maetelefone ?? ''); ?>" name='nr_maetelefone' onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off" disabled>     
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
                    <input type="text" class="form-control input-sm"  value="<?php echo e($cliente->nm_pai ?? ''); ?>" name='nm_pai' maxlength="100" autocomplete="off" disabled>     
                </div>
                <div class="form-group col-sm-3 mb-3">
                    <label for="nr_paitelefone" class="control-label">Telefone</label>
                    <input type="text" class="form-control input-sm"  value="<?php echo e($cliente->nr_paitelefone ?? ''); ?>" name='nr_paitelefone' onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off" disabled>     
                </div>
                <div class="form-group col-sm-1 mb-3">                                    
                    <label for="st_paivivo" class="control-label">Vivo ?</label>
                    <?php if(isset($cliente)): ?>                        
                        <?php if($cliente->st_paivivo===1): ?>
                            <input type="checkbox" class="checkbox" value="<?php echo e($cliente->st_paivivo); ?>" checked name='st_paivivo' disabled>
                        <?php else: ?> 
                            <input type="checkbox" class="checkbox" value="<?php echo e($cliente->st_paivivo ?? ''); ?>" name='st_paivivo' disabled>
                        <?php endif; ?> 
                    <?php else: ?>
                        <input type="checkbox" class="checkbox" value="<?php echo e($cliente->st_paivivo ?? ''); ?>" name='st_paivivo' disabled>
                    <?php endif; ?>
                </div>                           
            </div> 
            <div class="row">
                <div class="form-group col-sm-12">
                    <label for="nm_obs" class="control-label">Observação</label>
                    <textarea class="form-control input-sm" rows="5" name='nm_obs' disabled><?php echo e($cliente->nm_obs ?? ''); ?></textarea>
                </div>                            
            </div> 
        </fieldset>        
    </div>   
</div>

<!-- listagem dos dependentes/contrato -->
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">Dependentes</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>    
    <div class="box-body table-responsive no-padding">
        <table class="table table-striped table-bordered table-hover" id="dest">
            <thead>
            <tr>
                <th width="250px">Nome</th>
                <th width="90px">Contrato</th>
                <th width="90px">Falecimento</th>
                <th width="90px">$ Valor</th>
                <th width="150px">Funeraria</th>
                <th width="150px">Cemiterio</th>
                <th width="150px">Plano</th>
                <th width="90px">Sepultamento</th>
                <th width="80px">Atendido</th>
                <th width="150px">Observação</i></th>                   
            </tr>     
            </thead>       
            <tbody>                
            <?php $__currentLoopData = $contdepativo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contativo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php                
                if ($contativo->st_atendido === 1) {
                    $rowclass = 'label label-danger';
                    $status = 'Sim';
                }else{
                    $rowclass = 'label label-primary';
                    $status = 'Não';
                }                    
            ?>                 
            <tr>
                <td><?php echo e($contativo->nm_dependente); ?></td>
                <td><?php echo e($contativo->nr_contrato); ?></td>
                <td><?php echo e(empty($contativo->dt_falecimento) ? '' : $contativo->dt_falecimento->format("d/m/Y")); ?></td>
                <td><?php echo e($contativo->vl_sepultamento); ?></td>
                <td><?php echo e($contativo->nm_funeraria); ?></td>            
                <td><?php echo e($contativo->nm_cemiterio); ?></td>            
                <td><?php echo e($contativo->nm_plano); ?></td>            
                <td><?php echo e(empty($contativo->dt_sepultamento) ? '' : $contativo->dt_sepultamento->format("d/m/Y")); ?></td>                                    
                <td><span class="<?php echo e($rowclass); ?>">&nbsp;<?php echo e($status); ?>&nbsp;</span></td>
                <td><?php echo e(utf8_encode($contativo->nm_obs)); ?></td>                                    
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        </table>        
    </div>
</div>    

<!-- listagem do financeiro -->

<div class="box box-solid box-danger">
    <div class="box-header">
        <h3 class="box-title">Financeiro</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body table-responsive no-padding" style="width:100%;height:300px;overflow-y: scroll;">
        <table class="table table-striped table-bordered table-hover" id="dest">
            <thead>
            <tr>
                <th width="50px">Vencimento</th>
                <th width="50px">Documento</th>
                <th width="50px">Parcela</th>
                <th width="50px">$ Valor</th>
                <th width="90px">Tp. Pagamento</th>
                <th width="90px">Pagamento</th>
                <th width="90px">Descrição</th>
                <th width="50px">Status</th>
                <th width="200px">Historico</th>
            </tr>     
            </thead>       
            <tbody>                
            <?php $__currentLoopData = $ctarecativo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ctaativo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php            
            if ($ctaativo->st_status === '0' && strtotime($ctaativo->dt_vencimento) < strtotime(date("Y-m-d"))) {
                    $rowclass = 'label label-danger';
                    $status = 'Atrasado';
                }elseif ($ctaativo->st_status === '0' && strtotime($ctaativo->dt_vencimento) >= strtotime(date("Y-m-d"))) {
                    $rowclass = 'label-success';
                    $status = 'Em Dia';
                }else{
                    $rowclass = 'label label-primary';
                    $status = 'Pago';
                }    
            ?>            
            <tr>
                <td><?php echo e(empty($ctaativo->dt_vencimento) ? '' : $ctaativo->dt_vencimento->format("d/m/Y")); ?></td>
                <td><?php echo e($ctaativo->nr_documento); ?></td>
                <td><?php echo e($ctaativo->st_parcela); ?></td>
                <td><?php echo e(number_format($ctaativo->vl_apagar,2, '.', '')); ?></td>
                <td><?php echo e($ctaativo->nm_tppagamento); ?></td>
                <td><?php echo e(empty($ctaativo->dt_pagamento) ? '' : $ctaativo->dt_pagamento->format("d/m/Y")); ?></td>
                <td><?php echo e($ctaativo->ds_historico); ?></td>
                <td><span class="<?php echo e($rowclass); ?>">&nbsp;<?php echo e($status); ?>&nbsp;</span></td>
                <td><?php echo e(utf8_encode($ctaativo->nm_obs)); ?></td>                                    
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        </table>        
    </div>
</div>

<!-- listagem dos protocolos -->

<div class="box box-solid box-warning">
    <div class="box-header">
        <h3 class="box-title">Protocolo</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body table-responsive no-padding" style="width:100%;height:300px;overflow-y: scroll; ">
        <table class="table table-striped table-bordered table-hover" id="dest">
            <thead>
            <tr>
                <th width="90px">Data</th>
                <th width="90px">Hora</th>
                <th width="90px">Nº Protocolo</th>
                <th width="300px">Descrição</th>
        </tr>     
            </thead>       
            <tbody>                
            <?php $__currentLoopData = $protocolo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $protoc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php                
            ?>            
            <tr>
                <td><?php echo e(empty($protoc->dt_protocolo) ? '' : $protoc->dt_protocolo->format("d/m/Y")); ?></td>
                <td><?php echo e($protoc->hr_protocolo); ?></td>
                <td><?php echo e($protoc->nr_protocolo); ?></td>
                <td><?php echo e(utf8_encode($protoc->nm_protocolo)); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        </table>        
    </div>
</div>

<!-- listagem dos dependentes/contrato inativos -->

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h3><i class="fa fa-inbox"></i> Inativo</h3>
        </div>
    </div>
</div>

<div class="box box-solid box-default collapsed-box">
    <div class="box-header">
        <h3 class="box-title">Dependentes</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>    
    <div class="box-body table-responsive no-padding">
        <table class="table table-striped table-bordered table-hover" id="dest">
            <thead>
            <tr>
                <th width="250px">Nome</th>
                <th width="90px">Contrato</th>
                <th width="90px">Falecimento</th>
                <th width="90px">$ Valor</th>
                <th width="150px">Funeraria</th>
                <th width="150px">Cemiterio</th>
                <th width="150px">Plano</th>
                <th width="90px">Sepultamento</th>
                <th width="80px">Atendido</th>
                <th width="150px">Observação</i></th>                   
            </tr>     
            </thead>       
            <tbody>                
            <?php $__currentLoopData = $contdepinativo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $continativo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php                
                if ($continativo->st_atendido === 1) {
                    $rowclass = 'label label-danger';
                    $status = 'Sim';
                }else{
                    $rowclass = 'label label-primary';
                    $status = 'Não';
                }    
            ?>            
            <tr>
                <td><?php echo e($continativo->nm_dependente); ?></td>
                <td><?php echo e($continativo->nr_contrato); ?></td>
                <td><?php echo e(empty($continativo->dt_falecimento) ? '' : $continativo->dt_falecimento->format("d/m/Y")); ?></td>
                <td><?php echo e($continativo->vl_sepultamento); ?></td>
                <td><?php echo e($continativo->nm_funeraria); ?></td>
                <td><?php echo e($continativo->nm_cemiterio); ?></td>
                <td><?php echo e($continativo->nm_plano); ?></td>            
                <td><?php echo e(empty($continativo->dt_sepultamento) ? '' : $continativo->dt_sepultamento->format("d/m/Y")); ?></td>                                    
                <td><span class="<?php echo e($rowclass); ?>">&nbsp;<?php echo e($status); ?>&nbsp;</span></td>
                <td><?php echo e(utf8_encode($continativo->nm_obs)); ?></td>                                    
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        </table>        
    </div>
</div>    

<!-- listagem do financeiro inativos -->

<div class="box box-solid box-default collapsed-box">
    <div class="box-header">
        <h3 class="box-title">Financeiro</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body table-responsive no-padding" style="width:100%;height:300px;overflow-y: scroll; ">
        <table class="table table-striped table-bordered table-hover" id="dest">
            <thead>
            <tr>
                <th width="50px">Vencimento</th>
                <th width="50px">Documento</th>
                <th width="50px">Parcela</th>
                <th width="50px">$ Valor</th>
                <th width="90px">Tp. Pagamento</th>
                <th width="90px">Pagamento</th>
                <th width="90px">Descrição</th>
                <th width="50px">Status</th>
                <th width="200px">Observação</th>
        </tr>     
            </thead>       
            <tbody>                
            <?php $__currentLoopData = $ctarecinativo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ctainativo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php            
            if ($ctainativo->st_status === '0' && strtotime($ctainativo->dt_vencimento) < strtotime(date("Y-m-d"))) {
                    $rowclass = 'label label-danger';
                    $status = 'Atrasado';
                }elseif ($ctainativo->st_status === '0' && strtotime($ctainativo->dt_vencimento) >= strtotime(date("Y-m-d"))) {
                    $rowclass = 'label-success';
                    $status = 'Em Dia';
                }else{
                    $rowclass = 'label label-primary';
                    $status = 'Pago';
                }    
            ?>            
            <tr>
                <td><?php echo e(empty($ctainativo->dt_vencimento) ? '' : $ctainativo->dt_vencimento->format("d/m/Y")); ?></td>
                <td><?php echo e($ctainativo->nr_documento); ?></td>
                <td><?php echo e($ctainativo->st_parcela); ?></td>
                <td><?php echo e(number_format($ctainativo->vl_apagar,2, '.', '')); ?></td>
                <td><?php echo e($ctainativo->nm_tppagamento); ?></td>
                <td><?php echo e(empty($ctainativo->dt_pagamento) ? '' : $ctainativo->dt_pagamento->format("d/m/Y")); ?></td>
                <td></td>
                <td><span class="<?php echo e($rowclass); ?>">&nbsp;<?php echo e($status); ?>&nbsp;</span></td>
                <td><?php echo e(utf8_encode($ctainativo->nm_obs)); ?></td>                                    
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        </table>        
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/webfuneraria/public_html/paranaluto/resources/views/cliente/show.blade.php ENDPATH**/ ?>