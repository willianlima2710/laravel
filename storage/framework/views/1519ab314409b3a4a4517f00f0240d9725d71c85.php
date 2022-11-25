

<?php $__env->startSection('title', 'Plano de Contas'); ?>

<?php $__env->startSection('content_header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h3>Listagem - Plano de Contas</h3>
        </div>
        <div class="pull-right">            
            <a class="btn btn-success" style="margin: 10px;" href="<?php echo e(route('planoconta.create')); ?>"><i class='fa fa-plus'></i> Novo</a>
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
        <?php echo $__env->make("forms.search",["rota" => "planoconta"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-condensed table-hover" id="dest">
            <thead>
            <tr>
                <th width="115px">Código</th>
                <th width="250px">Nome</th>
                <th width="150px">Pai</th>
                <th width="85px">Ordem</th>
                <th width="110px">Reduzido</th>
                <th width="110px">Tipo</th>
                <th width="150px"><i class="fa fa-cogs"></i></th>                   
            </tr>     
            </thead>       
            <tbody>                
            <?php $__currentLoopData = $planocontas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $planoconta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   
            <?php                
                if ($planoconta->st_tipo === 0) {
                    $rowclass = 'label label-primary';
                    $status = 'Credito';
                }else{
                    $rowclass = 'label label-danger';
                    $status = 'Debito';
                }                    
            ?>                 
            <tr>
                <td><?php echo e($planoconta->cd_conta); ?></td>
                <td><?php echo e($planoconta->nm_planoconta); ?></td>
                <td><?php echo e($planoconta->cd_pai); ?></td>
                <td><?php echo e($planoconta->nr_ordem); ?></td>                    
                <td><?php echo e($planoconta->cd_reduzido); ?></td>                    
                <td><span class="<?php echo e($rowclass); ?>">&nbsp;<?php echo e($status); ?>&nbsp;</span></td>
                <td>                 
                    <a class="btn btn-sm btn-info" href="<?php echo e(route('planoconta.show',$planoconta->id_planoconta)); ?>"><i class='fa fa-eye'></i></a>                        
                    <a class="btn btn-sm btn-primary" href="<?php echo e(route('planoconta.edit',$planoconta->id_planoconta)); ?>"><i class='fa fa-edit'></i></a>                                                       
                    <a class="btn btn-sm btn-danger" href="" data-target="#modal-delete-<?php echo e($planoconta->id_planoconta); ?>" data-toggle="modal"><i class='fa fa-trash'></i></a>
                </td>    
            </tr>
            <?php echo $__env->make('forms.modal',['action'=>'PlanocontaController@destroy','id'=>$planoconta->id_planoconta], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        </table>
    </div>      
    <div class="box-footer clearfix"> 
        <ul class="pagination pagination-sm no-margin pull-left"><?php echo e($planocontas->appends(['searchText' => $searchText])->links()); ?></ul>
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

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/wfuneraria/public_html/paranaluto/resources/views/planoconta/index.blade.php ENDPATH**/ ?>