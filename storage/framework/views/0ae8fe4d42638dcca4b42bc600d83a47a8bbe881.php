<?php $__env->startSection('title', 'Jazigos'); ?>

<?php $__env->startSection('content_header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h3>Listagem - Jazigos</h3>
        </div>
        <div class="pull-right">            
            <a class="btn btn-success" style="margin: 10px;" href="<?php echo e(route('jazigo.create')); ?>"><i class='fa fa-plus'></i> Novo</a>
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
        <?php echo $__env->make("forms.search",["rota" => "jazigo"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-condensed table-hover" id="dest">
            <thead>
            <tr>
                <th width="115px">Código</th>                
                <th width="100px">Quadra</th>
                <th width="150px">Rua</th>
                <th width="150px">Setor</th>
                <th width="150px">Ocupado</th>
                <th width="150px">Ativo</th>
                <th width="150px">Granito</th>
                <th width="150px">Observação</th>
                <th width="150px"><i class="fa fa-cogs"></i></th>                   
            </tr>     
            </thead>       
            <tbody>                
            <?php $__currentLoopData = $jazigos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jazigo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php                
                if ($jazigo->st_ocupado === 0) {
                    $rowclass01 = 'label label-primary';
                    $status = 'Não';
                }else{
                    $rowclass01 = 'label label-danger';
                    $status = 'Sim';
                }       

                if ($jazigo->st_ativo === 0) {
                    $rowclass02 = 'label label-default';
                    $ativo = 'Não';
                }else{
                    $rowclass02 = 'label label-primary';
                    $ativo = 'Sim';
                }    

                if($jazigo->st_granito === '0') {
                    $stgranito = 'SIM - EMPRESA';
                }elseif ($jazigo->st_granito === '1') {
                    $stgranito = 'SIM - CLIENTE';
                }else{
                    $stgranito = 'NÃO';
                }
            ?>                 
            <tr>
                <td><?php echo e($jazigo->cd_jazigo); ?></td>                
                <td><?php echo e($jazigo->cd_quadra); ?></td>
                <td><?php echo e($jazigo->cd_rua); ?></td>                    
                <td><?php echo e($jazigo->cd_setor); ?></td>                    
                <td><span class="<?php echo e($rowclass01); ?>">&nbsp;<?php echo e($status); ?>&nbsp;</span></td>
                <td><span class="<?php echo e($rowclass02); ?>">&nbsp;<?php echo e($ativo); ?>&nbsp;</span></td>
                <td><?php echo e($stgranito); ?></td>
                <td><?php echo e($jazigo->nm_obs); ?></td>                    
                <td>                 
                    <a class="btn btn-sm btn-info" href="<?php echo e(route('jazigo.show',$jazigo->id_jazigo)); ?>"><i class='fa fa-eye'></i></a>                        
                    <a class="btn btn-sm btn-primary" href="<?php echo e(route('jazigo.edit',$jazigo->id_jazigo)); ?>"><i class='fa fa-edit'></i></a>                                                       
                    <a class="btn btn-sm btn-danger" href="" data-target="#modal-delete-<?php echo e($jazigo->id_jazigo); ?>" data-toggle="modal"><i class='fa fa-trash'></i></a>
                </td>    
            </tr>
            <?php echo $__env->make('forms.modal',['action'=>'JazigoController@destroy','id'=>$jazigo->id_jazigo], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        </table>
    </div>      
    <div class="box-footer clearfix"> 
        <ul class="pagination pagination-sm no-margin pull-left"><?php echo e($jazigos->appends(['searchText' => $searchText])->links()); ?></ul>
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

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp73\htdocs\funeraria\resources\views/jazigo/index.blade.php ENDPATH**/ ?>