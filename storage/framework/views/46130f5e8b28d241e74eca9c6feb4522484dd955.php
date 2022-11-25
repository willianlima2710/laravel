

<?php $__env->startSection('title', 'Contrato'); ?>

<?php $__env->startSection('content_header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- topo -->
<div class="row">
    <div class="col-sm-12 margin-tb">
        <div class="pull-left">
            <h3><i class="ion ion-clipboard"></i> Contrato</h3>
        </div>
        <div class="pull-right">            
            <a href="<?php echo e(url()->previous()); ?>" class="btn btn-primary" style="margin: 10px;">Voltar</a>
        </div>
    </div>
</div>

<!-- /.box-header -->
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">Dados</h3>
    </div>    
    <div class="box-body">   
        <fieldset class="form-group">        
            <input type="hidden"  value="<?php echo e($contrato->id_contrato ?? ''); ?>" name="id_contrato" class="form-control">
            <div class="row">
                <div class="form-group col-sm-12 mb-1">
                    <label for="nm_pessoa" class="control-label">Cliente</label>
                    <input type="text" class="form-control" value="<?php echo e($contrato->nm_pessoa ?? ''); ?>" 
                        name="nm_pessoa" id="nm_pessoa" autocomplete="off" placeholder="Nome ou CPF" disabled >                                                                             
                </div>   
                <input type="hidden" class="form-control" value="<?php echo e($contrato->id_pessoa ?? ''); ?>" name="id_pessoa" id="id_pessoa" required>                    
            </div>        
            <div class="row">
                <div class="form-group col-sm-3 mb-1">
                    <label for="id_plano" class="control-label">Plano</label>
                    <select class="form-control" name="id_plano" disabled>
                        <option value=""></option>
                        <?php $__currentLoopData = $planos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plano): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(isset($contrato)): ?>
                                <?php if($plano->id_plano==$contrato->id_plano): ?>
                                <option value="<?php echo e($plano->id_plano); ?>" selected>
                                <?php echo e($plano->nm_plano); ?>

                                </option>
                                <?php else: ?>
                                <option value="<?php echo e($plano->id_plano); ?>">
                                <?php echo e($plano->nm_plano); ?>

                                </option>
                                <?php endif; ?>	         
                            <?php else: ?>                                    
                                <option value="<?php echo e($plano->id_plano); ?>">
                                <?php echo e($plano->nm_plano); ?>

                                </option>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>    
                <div class="form-group col-sm-5 mb-1">
                    <label for="id_vendedor" class="control-label">Vendedor</label>
                    <select class="form-control" name="id_vendedor" disabled>
                        <option value=""></option>
                        <?php $__currentLoopData = $funcionarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $funcionario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(isset($contrato)): ?>
                                <?php if($funcionario->id_pessoa==$contrato->id_vendedor): ?>
                                <option value="<?php echo e($funcionario->id_pessoa); ?>" selected>
                                <?php echo e($funcionario->nm_pessoa); ?>

                                </option>
                                <?php else: ?>
                                <option value="<?php echo e($funcionario->id_pessoa); ?>">
                                <?php echo e($funcionario->nm_pessoa); ?>

                                </option>
                                <?php endif; ?>	         
                            <?php else: ?>                                    
                                <option value="<?php echo e($funcionario->id_pessoa); ?>">
                                <?php echo e($funcionario->nm_pessoa); ?>

                                </option>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>    
                <div class="form-group col-sm-2 mb-3">
                    <label for="nr_contrato" class="control-label">Nº Contrato</label>
                    <input type="text" class="form-control" value="<?php echo e($contrato->nr_contrato ?? ''); ?>" name="nr_contrato" maxlength="10" autocomplete="off" disabled>
                </div>       
                <div class="form-group col-sm-2 mb-1">
                    <label for="st_local" class="control-label">Tipo de Cobrança</label>
                    <select class="form-control" name="st_local" disabled>
                        <option value=""></option>
                        <?php $__currentLoopData = $locals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $local): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(isset($contrato)): ?>
                                <?php if($local['st_local']==$contrato->st_local): ?>
                                <option value="<?php echo e($local['st_local']); ?>" selected >
                                <?php echo e($local['nm_local']); ?>

                                </option>
                                <?php else: ?>
                                <option value="<?php echo e($local['st_local']); ?>">
                                <?php echo e($local['nm_local']); ?>

                                </option>
                                <?php endif; ?>	         
                            <?php else: ?>                                    
                                <option value="<?php echo e($local['st_local']); ?>">
                                <?php echo e($local['nm_local']); ?>

                                </option>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>   
            </div>
            <div class="row">
                <div class="form-group col-sm-2 mb-3">
                    <label for="dt_inccontrato" class="control-label">Data Contrato</label>
                    <input type="text" class="form-control" value="<?php echo e(empty($contrato->dt_inccontrato) ? date('d/m/Y') : $contrato->dt_inccontrato->format('d/m/Y') ?? ''); ?>" name="dt_inccontrato" onkeypress="$(this).mask('00/00/0000')" autocomplete="off" disabled>
                </div>   
                <div class="form-group col-sm-2 mb-3">
                    <label for="nr_carencia" class="control-label text-danger">Carência</label>
                    <input type="text" class="form-control" value="<?php echo e($contrato->nr_carencia ?? ''); ?>" name="nr_carencia" maxlength="10" autocomplete="off" disabled>
                </div>  
                <div class="form-group col-sm-2 mb-3">
                    <label for="dt_termcarencia" class="control-label text-danger">Térm Carência</label>
                    <input type="text" class="form-control" value="<?php echo e(empty($contrato->dt_termcarencia) ? '' : $contrato->dt_termcarencia->format('d/m/Y') ?? ''); ?>" name="dt_termcarencia" disabled="true" onkeypress="$(this).mask('00/00/0000')" autocomplete="off" disabled>
                </div>   
                <div class="form-group col-sm-2 mb-3">
                    <label for="km_plano" class="control-label">Km Plano</label>
                    <input type="text" class="form-control" value="<?php echo e($contrato->km_plano ?? ''); ?>" name="km_plano" maxlength="10" autocomplete="off" disabled>
                </div>   
                <div class="form-group col-sm-2 mb-3">
                    <label for="vl_plano" class="control-label">$ Valor</label>
                    <input type="text" class="form-control" value="<?php echo e($contrato->vl_plano ?? ''); ?>" name="vl_plano" id="vl_plano" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off" disabled>                    
                </div>                        
                <div class="form-group col-sm-2 mb-3">
                    <label for="qt_dependente" class="control-label">Qt Dependentes</label>
                    <input type="number" class="form-control" value="<?php echo e($contrato->qt_dependente ?? '1'); ?>" name="qt_dependente" id="qt_dependente" defaultValue="1" min="1" max="99" disabled>
                </div>    
            </div>
            <div class="row">
                <div class="form-group col-sm-2 mb-1">
                    <label for="st_cobranca" class="control-label">Cobrança por</label>
                    <select class="form-control" name="st_cobranca" disabled>
                        <option value=""></option>
                        <?php $__currentLoopData = $cobrancas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cobranca): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(isset($contrato)): ?>
                                <?php if($cobranca['st_cobranca']==$contrato->st_cobranca): ?>
                                <option value="<?php echo e($cobranca['st_cobranca']); ?>" selected>
                                <?php echo e($cobranca['nm_cobranca']); ?>

                                </option>
                                <?php else: ?>
                                <option value="<?php echo e($cobranca['st_cobranca']); ?>">
                                <?php echo e($cobranca['nm_cobranca']); ?>

                                </option>
                                <?php endif; ?>	         
                            <?php else: ?>                                    
                                <option value="<?php echo e($cobranca['st_cobranca']); ?>">
                                <?php echo e($cobranca['nm_cobranca']); ?>

                                </option>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>    
                <div class="form-group col-sm-2 mb-3">
                    <label for="vl_adicional" class="control-label text-primary">Valor Adicional</label>
                    <input type="text" class="form-control" value="<?php echo e($contrato->vl_adicional ?? ''); ?>" name="vl_adicional" onkeypress="$(this).mask('####0.00', {reverse: true})" autocomplete="off" disabled>                    
                </div>            
                <div class="form-group col-sm-2 mb-3">
                    <label for="vl_total" class="control-label text-danger">Valor Total</label>
                    <input type="text" class="form-control" value="<?php echo e($contrato->vl_total ?? ''); ?>" name="vl_total" onkeypress="$(this).mask('####0.00', {reverse: true})" disabled="true" autocomplete="off" disabled>                    
                </div>                        
                <div class="form-group col-sm-2 mb-3">
                    <label for="dt_fimcontrato" class="control-label">Data Termino</label>
                    <input type="text" class="form-control" value="<?php echo e(empty($contrato->dt_fimcontrato) ? '' : $contrato->dt_fimcontrato->format('d/m/Y') ?? ''); ?>" name="dt_fimcontrato" onkeypress="$(this).mask('00/00/0000')" autocomplete="off" disabled>
                </div>      
                <div class="form-group col-sm-2 mb-3">
                    <label for="dt_valcarterinha" class="control-label text-primary">Validade Carterinha</label>
                    <input type="text" class="form-control" value="<?php echo e(empty($contrato->dt_valcarterinha) ? '' : $contrato->dt_valcarterinha->format('d/m/Y') ?? ''); ?>" name="dt_valcarterinha" onkeypress="$(this).mask('00/00/0000')" autocomplete="off" disabled>
                </div>
                <div class="form-group col-sm-2 mb-3">
                    <label for="dt_cancontrato" class="control-label text-danger">Data Cancelamento</label>
                    <input type="text" class="form-control" value="<?php echo e(empty($contrato->dt_cancontrato) ? '' : $contrato->dt_cancontrato->format('d/m/Y') ?? ''); ?>" name="dt_cancontrato" disabled="true" onkeypress="$(this).mask('00/00/0000')" autocomplete="off" disabled>
                </div> 
            </div>
            <div class="row">
                <div class="form-group col-sm-12">
                    <label for="nm_obs" class="control-label">Observação</label>
                    <textarea class="form-control" name="nm_obs" rows="5" disabled><?php echo e($contrato->nm_obs ?? ''); ?></textarea>
                </div>                            
            </div> 
        </fieldset>        
        <fieldset class="form-group">
        <legend>Dependentes</legend>
            <div class="box-body table-responsive no-padding" style="width:100%;height:300px;overflow-y: scroll;">    
                <table id="tbdependente" class="table table-striped table-bordered table-condensed table-hover">
                <thead class="bg-info">
                <tr>
                    <th width="50px">Seq</th>
                    <th width="250px">Nome</th>
                    <th width="150px">Estado Civil</th>
                    <th width="150px">Sexo</th>
                    <th width="100px">Parentesco</th>
                    <th width="100px">Nascimento</th>
                    <th width="120px">CPF</th>
                    <th width="100px">RG</th>                        
                    <th width="100px">Carencia</th>
                    <th width="150px">1º Telefone</th>
                    <th width="150px">2º Telefone</th>
                </tr>
                </thead>
                <tbody>                
                <?php $__currentLoopData = $contratodeps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contratodep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($contratodep->cd_sequencia); ?></td>
                    <td><?php echo e($contratodep->nm_dependente); ?></td>
                    <td><?php echo e($contratodep->nm_estcivil); ?></td>
                    <td><?php echo e(($contratodep->st_sexo=='0') ? 'MASCULINO' : 'FEMININO'); ?></td>
                    <td><?php echo e($contratodep->nm_parentesco); ?></td>
                    <td><?php echo e(empty($contratodep->dt_nascimento) ? '' : $contratodep->dt_nascimento->format("d/m/Y")); ?></td>
                    <td><?php echo e($contratodep->nr_cpf); ?></td>
                    <td><?php echo e($contratodep->nr_rg); ?></td>            
                    <td><?php echo e($contratodep->nr_carencia); ?></td>            
                    <td><?php echo e($contratodep->nr_telefone1); ?></td>            
                    <td><?php echo e($contratodep->nr_telefone2); ?></td>            
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>                                           
            </div>
        </fieldset>  
        <fieldset class="form-group">
        <legend>Financeiro</legend>          
            <div class="box-body table-responsive no-padding" style="width:100%;height:300px;overflow-y: scroll;">                    
                <table id='tbfinanceiro' class="table table-striped table-bordered table-condensed table-hover">
                    <thead class="bg-info">
                    <tr>
                        <th width="50px">Vencimento</th>
                        <th width="50px">Documento</th>
                        <th width="50px">Parcela</th>
                        <th width="50px">$ Valor</th>
                        <th width="90px">Tp. Pagamento</th>
                        <th width="90px">Pagamento</th>
                        <th width="50px">$ Pago</th>
                        <th width="90px">Descrição</th>
                        <th width="50px">Status</th>
                        <th width="200px">Historico</th>
                    </tr>     
                    </thead>       
                    <tbody>                
                    <?php $__currentLoopData = $ctarecebers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ctareceber): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php                        
                    if ($ctareceber->st_status === '0' && strtotime($ctareceber->dt_vencimento) < strtotime(date("Y-m-d"))) {
                            $rowclass = 'label label-danger';
                            $status = 'Atrasado';
                        }elseif ($ctareceber->st_status === '0' && strtotime($ctareceber->dt_vencimento) >= strtotime(date("Y-m-d"))) {
                            $rowclass = 'label-success';
                            $status = 'Em Dia';
                        }else{
                            $rowclass = 'label label-primary';
                            $status = 'Pago';                           
                        }    
                    ?>            
                    <tr>
                        <td><?php echo e(empty($ctareceber->dt_vencimento) ? '' : $ctareceber->dt_vencimento->format("d/m/Y")); ?></td>
                        <td><?php echo e($ctareceber->nr_documento); ?></td>
                        <td><?php echo e($ctareceber->st_parcela); ?></td>
                        <td><?php echo e(number_format($ctareceber->vl_apagar,2, '.', '')); ?></td>
                        <td><?php echo e($ctareceber->nm_tppagamento); ?></td>
                        <td><?php echo e(empty($ctareceber->dt_pagamento) ? '' : $ctareceber->dt_pagamento->format("d/m/Y")); ?></td>
                        <td><?php echo e(number_format($ctareceber->vl_pago,2, '.', '')); ?></td>
                        <td><?php echo e($ctareceber->ds_historico); ?></td>
                        <td><span class="<?php echo e($rowclass); ?>">&nbsp;<?php echo e($status); ?>&nbsp;</span></td>
                        <td><?php echo e($ctareceber->nm_obs); ?></td>                                    
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                    
                    </tbody>   
                    <tfoot>
                        <th>Total</th>
                        <th></th>
                        <th></th>
                        <th><?php echo e(number_format($total,2, '.', '')); ?></th>
                        <th></th>
                        <th></th>
                        <th><?php echo e(number_format($pago,2, '.', '')); ?></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tfoot>    
                </table>                                           
            </div>        
        </fieldset>             
    </div>   
</div>    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/webfuneraria/public_html/paranaluto/resources/views/contrato/show.blade.php ENDPATH**/ ?>