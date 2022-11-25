

<?php $__env->startSection('title', 'Fluxo de Caixa'); ?>

<?php $__env->startSection('content_header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h3>Listagem - Fluxo de Caixa</h3>
        </div>
        <div class="pull-right">            
            <a class="btn btn-success" style="margin: 10px;" href="<?php echo e(route('caixa.create')); ?>"><i class='fa fa-plus'></i> Novo</a>
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
        <?php echo $__env->make("forms.search",["rota" => "caixa"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-condensed table-hover" id="dest">
            <thead>
            <tr>
                <th width="115px">Movimento</th>
                <th width="115px">Vencimento</th>
                <th width="115px">Documento</th>
                <th width="250px">Nome</th>
                <th width="70px">Parc</th>
                <th width="200px">Histórico</th>
                <th width="85px">$ Valor</th>
                <th width="80px">Status</th>
                <th width="150px"><i class="fa fa-cogs"></i></th>                   
            </tr>     
            </thead>       
            <tbody>                
            <?php $__currentLoopData = $caixas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $caixa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php                
                if ($caixa->st_creddeb === '0') {
                    $rowclass = 'label label-primary';
                    $status = 'Crédito';
                }elseif ($caixa->st_creddeb === '1') {
                    $rowclass = 'label label-danger';
                    $status = 'Débito';
                }    
            ?>
            <tr>
                <td><span style="display: none;"><?php echo e(empty($caixa->dt_movimento) ? '' : $caixa->dt_movimento->format("Y-m-d")); ?></span>
                    <?php echo e(empty($caixa->dt_movimento) ? '' : $caixa->dt_movimento->format("d/m/Y")); ?>

                </td>
                <td><span style="display: none;"><?php echo e(empty($caixa->dt_vencimento) ? '' : $caixa->dt_vencimento->format("Y-m-d")); ?></span>
                    <?php echo e(empty($caixa->dt_vencimento) ? '' : $caixa->dt_vencimento->format("d/m/Y")); ?>

                </td>
                <td><?php echo e($caixa->nr_documento); ?></td>
                <td><?php echo e($caixa->nm_pessoa); ?></td>                
                <td><?php echo e($caixa->nr_parcela); ?></td>
                <td><?php echo e($caixa->ds_historico); ?></td>                                    
                <td><?php echo e(number_format($caixa->vl_total, 2, '.', '')); ?></td>
                <td><span class="<?php echo e($rowclass); ?>">&nbsp;<?php echo e($status); ?>&nbsp;</span></td>
                <td>                 
                    <a class="btn btn-sm btn-info" href="<?php echo e(route('caixa.show',$caixa->id_caixa)); ?>"><i class='fa fa-eye'></i></a>                        
                    <a class="btn btn-sm btn-primary" href="<?php echo e(route('caixa.edit',$caixa->id_caixa)); ?>"><i class='fa fa-edit'></i></a>                                                       
                    <a class="btn btn-sm btn-danger" href="" data-target="#modal-delete-<?php echo e($caixa->id_caixa); ?>" data-toggle="modal"><i class='fa fa-trash'></i></a>
                </td>    
            </tr>
            <?php echo $__env->make('forms.modal',['action'=>'CaixaController@destroy','id'=>$caixa->id_caixa], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        </table>
    </div>      
    <div class="box-footer clearfix"> 
        <ul class="pagination pagination-sm no-margin pull-left"><?php echo e($caixas->appends(['searchText' => $searchText])->links()); ?></ul>
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

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u203739344/domains/erpvip.com.br/public_html/paranaluto/resources/views/caixa/index.blade.php ENDPATH**/ ?>