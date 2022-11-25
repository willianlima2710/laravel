

<?php $__env->startSection('title', 'Custos Fixos'); ?>

<?php $__env->startSection('content_header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h3>Listagem - Custos Fixos</h3>
        </div>
        <div class="pull-right">            
            <a class="btn btn-success" style="margin: 10px;" href="<?php echo e(route('custo.create')); ?>"><i class='fa fa-plus'></i> Novo</a>
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
        <?php echo $__env->make("forms.search",["rota" => "custo"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-condensed table-hover" id="dest">
            <thead>
            <tr>
                <th width="115px">Código</th>
                <th width="250px">Nome</th>
                <th width="100px">$ Valor</th>
                <th width="150px">Dia</th>
                <th width="85px">Periodo</th>
                <th width="110px">Observação</th>
                <th width="150px"><i class="fa fa-cogs"></i></th>                   
            </tr>     
            </thead>       
            <tbody>                
            <?php $__currentLoopData = $custos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $custo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>            
            <?php                
                if ($custo->st_periodo === '0') {
                    $rowclass = 'label label-warning';
                    $status = 'Mensal';
                }elseif ($custo->st_periodo === '1'){
                    $rowclass = 'label label-primary';
                    $status = 'Trimestral';
                }elseif ($custo->st_periodo === '2'){
                    $rowclass = 'label label-success';
                    $status = 'Semestral';
                }elseif ($custo->st_periodo === '3'){
                    $rowclass = 'label label-info';
                    $status = 'Anual';
                }                    
            ?>                 
            <tr>
                <td><?php echo e($custo->id_custo); ?></td>
                <td><?php echo e($custo->nm_custo); ?></td>
                <td><?php echo e(number_format($custo->vl_custo, 2, '.', '')); ?></td>
                <td><?php echo e($custo->nr_dia); ?></td>                    
                <td><span class="<?php echo e($rowclass); ?>">&nbsp;<?php echo e($status); ?>&nbsp;</span></td>
                <td><?php echo e($custo->nm_obs); ?></td>
                <td>                 
                    <a class="btn btn-sm btn-info" href="<?php echo e(route('custo.show',$custo->id_custo)); ?>"><i class='fa fa-eye'></i></a>                        
                    <a class="btn btn-sm btn-primary" href="<?php echo e(route('custo.edit',$custo->id_custo)); ?>"><i class='fa fa-edit'></i></a>                                                       
                    <a class="btn btn-sm btn-danger" href="" data-target="#modal-delete-<?php echo e($custo->id_custo); ?>" data-toggle="modal"><i class='fa fa-trash'></i></a>
                </td>    
            </tr>
            <?php echo $__env->make('forms.modal',['action'=>'CustoController@destroy','id'=>$custo->id_custo], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        </table>
    </div>      
    <div class="box-footer clearfix"> 
        <ul class="pagination pagination-sm no-margin pull-left"><?php echo e($custos->appends(['searchText' => $searchText])->links()); ?></ul>
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

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/wfuneraria/public_html/paranaluto/resources/views/custo/index.blade.php ENDPATH**/ ?>