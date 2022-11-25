

<?php $__env->startSection('title', 'Obitos'); ?>

<?php $__env->startSection('content_header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h3>Listagem - Obitos</h3>
        </div>
        <div class="pull-right">            
            <a class="btn btn-success" style="margin: 10px;" href="<?php echo e(route('obito.create')); ?>"><i class='fa fa-plus'></i> Novo</a>
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
        <?php echo $__env->make("forms.search",["rota" => "obito"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-condensed table-hover" id="dest">
            <thead>
            <tr>            
                <th width="90px">Nº Obito</th>
                <th width="100px">Atendimento</th>
                <th width="100x">Falecimento</th>
                <th width="250px">Falecido</th>
                <th width="250px">Causa Morte</th>
                <th width="100px">Médico</th>
                <th width="150px"><i class="fa fa-cogs"></i></th>                   
            </tr>     
            </thead>       
            <tbody>                
            <?php $__currentLoopData = $obitos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $obito): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>            
            <tr>
                <td><?php echo e($obito->nr_declaracao); ?></td>
                <td><span style="display: none;"><?php echo e(empty($obito->dt_atendimento) ? '' : $obito->dt_atendimento->format("Y-m-d")); ?></span>
                    <?php echo e(empty($obito->dt_atendimento) ? '' : $obito->dt_atendimento->format("d/m/Y")); ?>

                </td>                
                <td><span style="display: none;"><?php echo e(empty($obito->dt_falecimento) ? '' : $obito->dt_falecimento->format("Y-m-d")); ?></span>
                    <?php echo e(empty($obito->dt_falecimento) ? '' : $obito->dt_falecimento->format("d/m/Y")); ?>

                </td>                
                <td><?php echo e($obito->nm_dependente); ?></td>
                <td><?php echo e($obito->nm_causamorte); ?></td>
                <td><?php echo e($obito->nm_medico); ?></td>                    
                <td>                 
                    <a class="btn btn-sm btn-info" href="<?php echo e(route('obito.show',$obito->id_obito)); ?>"><i class='fa fa-eye'></i></a>                        
                    <a class="btn btn-sm btn-primary" href="<?php echo e(route('obito.edit',$obito->id_obito)); ?>"><i class='fa fa-edit'></i></a>                                                       
                    <a class="btn btn-sm btn-danger" href="" data-target="#modal-delete-<?php echo e($obito->id_obito); ?>" data-toggle="modal"><i class='fa fa-trash'></i></a>
                </td>    
            </tr>
            <?php echo $__env->make('forms.modal',['action'=>'ObitoController@destroy','id'=>$obito->id_obito], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        </table>
    </div>      
    <div class="box-footer clearfix"> 
        <ul class="pagination pagination-sm no-margin pull-left"><?php echo e($obitos->appends(['searchText' => $searchText])->links()); ?></ul>
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

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/webfuneraria/public_html/paranaluto/resources/views/obito/index.blade.php ENDPATH**/ ?>