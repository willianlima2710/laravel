

<?php $__env->startSection('title', 'Cemitérios'); ?>

<?php $__env->startSection('content_header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h3>Listagem - Cemitérios</h3>
        </div>
        <div class="pull-right">            
            <a class="btn btn-success" style="margin: 10px;" href="<?php echo e(route('cemiterio.create')); ?>"><i class='fa fa-plus'></i> Novo</a>
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
        <?php echo $__env->make("forms.search",["rota" => "cemiterio"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-condensed table-hover" id="dest">
            <thead>
            <tr>
                <th width="250px">Nome</th>
                <th width="100px">Endereço</th>
                <th width="90px">Nº</th>
                <th width="100px">Bairro</th>
                <th width="100px">Cidade</th>
                <th width="100px">Estado</th>
                <th width="150px"><i class="fa fa-cogs"></i></th>                   
            </tr>     
            </thead>       
            <tbody>                
            <?php $__currentLoopData = $cemiterios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cemiterio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($cemiterio->nm_cemiterio); ?></td>
                <td><?php echo e($cemiterio->nm_endereco); ?></td>
                <td><?php echo e($cemiterio->nr_numender); ?></td>
                <td><?php echo e($cemiterio->nm_bairro); ?></td>                    
                <td><?php echo e($cemiterio->nm_cidade); ?></td>                    
                <td><?php echo e($cemiterio->nm_estado); ?></td>                    
                <td>                 
                    <a class="btn btn-sm btn-info" href="<?php echo e(route('cemiterio.show',$cemiterio->id_cemiterio)); ?>"><i class='fa fa-eye'></i></a>                        
                    <a class="btn btn-sm btn-primary" href="<?php echo e(route('cemiterio.edit',$cemiterio->id_cemiterio)); ?>"><i class='fa fa-edit'></i></a>                                                       
                    <a class="btn btn-sm btn-danger" href="" data-target="#modal-delete-<?php echo e($cemiterio->id_cemiterio); ?>" data-toggle="modal"><i class='fa fa-trash'></i></a>
                </td>    
            </tr>
            <?php echo $__env->make('forms.modal',['action'=>'CemiterioController@destroy','id'=>$cemiterio->id_cemiterio], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        </table>
    </div>      
    <div class="box-footer clearfix"> 
        <ul class="pagination pagination-sm no-margin pull-left"><?php echo e($cemiterios->appends(['searchText' => $searchText])->links()); ?></ul>
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

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/webfuneraria/public_html/paranaluto/resources/views/cemiterio/index.blade.php ENDPATH**/ ?>