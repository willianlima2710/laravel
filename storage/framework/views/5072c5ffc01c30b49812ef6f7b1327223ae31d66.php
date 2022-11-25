

<?php $__env->startSection('title', 'Planos'); ?>

<?php $__env->startSection('content_header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h3>Listagem - Planos</h3>
        </div>
        <div class="pull-right">            
            <a class="btn btn-success" style="margin: 10px;" href="<?php echo e(route('plano.create')); ?>"><i class='fa fa-plus'></i> Novo</a>
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
        <?php echo $__env->make("forms.search",["rota" => "plano"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-condensed table-hover" id="dest">
            <thead>
            <tr>
                <th width="115px">Código</th>
                <th width="250px">Nome</th>
                <th width="100px">$ Cobertura</th>
                <th width="150px">KM Incluido</th>
                <th width="85px">$ Valor</th>
                <th width="110px">Observação</th>
                <th width="150px"><i class="fa fa-cogs"></i></th>                   
            </tr>     
            </thead>       
            <tbody>                
            <?php $__currentLoopData = $planos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plano): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($plano->id_plano); ?></td>
                <td><?php echo e($plano->nm_plano); ?></td>
                <td><?php echo e(number_format($plano->vl_cobertura, 2, '.', '')); ?></td>
                <td><?php echo e($plano->vl_kmincluido); ?></td>                    
                <td><?php echo e(number_format($plano->vl_plano, 2, '.', '')); ?></td>
                <td><?php echo e($plano->nm_obs); ?></td>
                <td>                 
                    <a class="btn btn-sm btn-info" href="<?php echo e(route('plano.show',$plano->id_plano)); ?>"><i class='fa fa-eye'></i></a>                        
                    <a class="btn btn-sm btn-primary" href="<?php echo e(route('plano.edit',$plano->id_plano)); ?>"><i class='fa fa-edit'></i></a>                                                       
                    <a class="btn btn-sm btn-danger" href="" data-target="#modal-delete-<?php echo e($plano->id_plano); ?>" data-toggle="modal"><i class='fa fa-trash'></i></a>
                </td>    
            </tr>
            <?php echo $__env->make('forms.modal',['action'=>'PlanoController@destroy','id'=>$plano->id_plano], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        </table>
    </div>      
    <div class="box-footer clearfix"> 
        <ul class="pagination pagination-sm no-margin pull-left"><?php echo e($planos->appends(['searchText' => $searchText])->links()); ?></ul>
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

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/wfuneraria/public_html/paranaluto/resources/views/plano/index.blade.php ENDPATH**/ ?>