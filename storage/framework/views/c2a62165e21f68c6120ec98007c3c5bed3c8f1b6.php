

<?php $__env->startSection('title', 'Contas a Pagar'); ?>

<?php $__env->startSection('content_header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h3>Listagem - Contas a Pagar</h3>
        </div>
        <div class="pull-right">            
            <a class="btn btn-success" style="margin: 10px;" href="<?php echo e(route('ctapagar.create')); ?>"><i class='fa fa-plus'></i> Novo</a>
        </div>
    </div>
</div>

<?php if($message = Session::get('success')): ?>
    <div class="alert alert-success">
        <p><?php echo e($message); ?></p>
    </div>
<?php endif; ?>
<div class="box">
    <div class="box-header with-border">
        <?php echo $__env->make("forms.search",["rota" => "ctapagar"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-condensed table-hover" id="dest">
            <thead>
            <tr>
                <th width="115px">Vencimento</th>
                <th width="90px">Nº Doc</th>
                <th width="165px">Nome</th>
                <th width="70px">Parc</th>
                <th width="100px">Tp. Pagto</th>
                <th width="140px">Histórico</th>
                <th width="85px">$ Valor</th>
                <th width="110px">Pagamento</th>
                <th width="110px">Nº Cheque</th>
                <th width="75px">Status</th>
                <th width="150px"><i class="fa fa-cogs"></i></th>                   
            </tr>     
            </thead>       
            <tbody>                
            <?php $__currentLoopData = $ctapagars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ctapagar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php                
                if ($ctapagar->st_status === '0' && strtotime($ctapagar->dt_vencimento) < strtotime(date("Y-m-d"))) {
                    $rowclass = 'label label-danger';
                    $status = 'Atrasado';
                    $disabled = '';
                }elseif ($ctapagar->st_status === '0' && strtotime($ctapagar->dt_vencimento) >= strtotime(date("Y-m-d"))) {
                    $rowclass = 'label-success';
                    $status = 'Em Dia';
                    $disabled = '';
                }else{
                    $rowclass = 'label label-primary';
                    $status = 'Pago';
                    $disabled = 'disabled';
                }    
            ?>            
            <tr>
                <td><span style="display: none;"><?php echo e(empty($ctapagar->dt_vencimento) ? '' : $ctapagar->dt_vencimento->format("Y-m-d")); ?></span>
                    <?php echo e(empty($ctapagar->dt_vencimento) ? '' : $ctapagar->dt_vencimento->format("d/m/Y")); ?>

                </td>
                <td><?php echo e($ctapagar->nr_documento); ?></td>
                <td><?php echo e($ctapagar->nm_fornecedor); ?></td
                ><td><?php echo e($ctapagar->nr_parcela); ?></td>
                <td><?php echo e($ctapagar->nm_tppagamento); ?></td>                    
                <td><?php echo e($ctapagar->ds_historico); ?></td>                    
                <td><?php echo e(number_format($ctapagar->vl_apagar, 2, '.', '')); ?></td>
                <td><span style="display: none;"><?php echo e(empty($ctapagar->dt_pagamento) ? '' : $ctapagar->dt_pagamento->format("Y-m-d")); ?></span>
                    <?php echo e(empty($ctapagar->dt_pagamento) ? '' : $ctapagar->dt_pagamento->format("d/m/Y")); ?>

                </td>
                <td><?php echo e($ctapagar->nr_cheque); ?></td>
                <td><span class="<?php echo e($rowclass); ?>">&nbsp;<?php echo e($status); ?>&nbsp;</span></td>
                <td>                 
                    <a class="btn btn-sm btn-info" href="<?php echo e(route('ctapagar.show',$ctapagar->id_ctapagar)); ?>"><i class='fa fa-eye'></i></a>                        
                    <a class="btn btn-sm btn-primary" <?php echo e($disabled); ?> href="<?php echo e(route('ctapagar.edit',$ctapagar->id_ctapagar)); ?>"><i class='fa fa-edit'></i></a>                                                       
                    <a class="btn btn-sm btn-danger" href="" data-target="#modal-delete-<?php echo e($ctapagar->id_ctapagar); ?>" data-toggle="modal"><i class='fa fa-trash'></i></a>
                </td>    
            </tr>
            <?php echo $__env->make('forms.modal',['action'=>'CtapagarController@destroy','id'=>$ctapagar->id_ctapagar], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        </table>
    </div>      
    <div class="box-footer clearfix"> 
        <ul class="pagination pagination-sm no-margin pull-left"><?php echo e($ctapagars->appends(['searchText' => $searchText])->links()); ?></ul>
    </div>                  
</div> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script> 

$(function(){
    $("#dest").addSortWidget();
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/wfuneraria/public_html/anjogabriel/resources/views/ctapagar/index.blade.php ENDPATH**/ ?>