

<?php $__env->startSection('title', 'Faixa de Acréscimo'); ?>

<?php $__env->startSection('content_header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h3>Listagem - Faixa de Acréscimo</h3>
        </div>
        <div class="pull-right">            
            <a class="btn btn-success" style="margin: 10px;" href="<?php echo e(route('fxacidade.create')); ?>"><i class='fa fa-plus'></i> Novo</a>
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
        <?php echo $__env->make("forms.search",["rota" => "fxacidade"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-condensed table-hover" id="dest">
            <thead>
            <tr>
                <th width="115px">Código</th>
                <th width="250px">Nome</th>
                <th width="100px">Idade Inicial</th>
                <th width="150px">Idade Final</th>
                <th width="85px">$ Valor</th>
                <th width="150px"><i class="fa fa-cogs"></i></th>                   
            </tr>     
            </thead>       
            <tbody>                
            <?php $__currentLoopData = $fxacidades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fxacidade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           
            <tr>
                <td><?php echo e($fxacidade->id_fxacidade); ?></td>
                <td><?php echo e($fxacidade->nm_fxacidade); ?></td>
                <td><?php echo e($fxacidade->nr_idadeinicial); ?></td>
                <td><?php echo e($fxacidade->nr_idadefinal); ?></td>                    
                <td><?php echo e(number_format($fxacidade->vl_acrescentar, 2, '.', '')); ?></td>
                <td>                 
                    <a class="btn btn-sm btn-info" href="<?php echo e(route('fxacidade.show',$fxacidade->id_fxacidade)); ?>"><i class='fa fa-eye'></i></a>                        
                    <a class="btn btn-sm btn-primary" href="<?php echo e(route('fxacidade.edit',$fxacidade->id_fxacidade)); ?>"><i class='fa fa-edit'></i></a>                                                       
                    <a class="btn btn-sm btn-danger" href="" data-target="#modal-delete-<?php echo e($fxacidade->id_fxacidade); ?>" data-toggle="modal"><i class='fa fa-trash'></i></a>
                </td>    
            </tr>
            <?php echo $__env->make('forms.modal',['action'=>'FxacidadeController@destroy','id'=>$fxacidade->id_fxacidade], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        </table>
    </div>      
    <div class="box-footer clearfix"> 
        <ul class="pagination pagination-sm no-margin pull-left"><?php echo e($fxacidades->appends(['searchText' => $searchText])->links()); ?></ul>
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

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/wfuneraria/public_html/paranaluto/resources/views/fxacidade/index.blade.php ENDPATH**/ ?>