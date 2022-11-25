<?php $__env->startSection('title', 'Empresas'); ?>

<?php $__env->startSection('content_header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h3>Listagem - Empresas</h3>
        </div>
        <div class="pull-right">            
            <a class="btn btn-success" style="margin: 10px;" href="<?php echo e(route('empresa.create')); ?>"><i class='fa fa-plus'></i> Novo</a>
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
        <?php echo $__env->make("forms.search",["rota" => "empresa"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-condensed table-hover" id="dest">
            <thead>
            <tr>
                <th width="115px">Código</th>
                <th width="250px">Nome</th>
                <th width="100px">CNPJ</th>
                <th width="150px">Telefone</th>
                <th width="85px">Bairro</th>
                <th width="110px">Cidade</th>
                <th width="150px"><i class="fa fa-cogs"></i></th>                   
            </tr>     
            </thead>       
            <tbody>                
            <?php $__currentLoopData = $empresas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $empresa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($empresa->id_pessoa); ?></td>
                <td><?php echo e($empresa->nm_pessoa); ?></td>
                <td><?php echo e($empresa->nr_cpfcnpj); ?></td>
                <td><?php echo e($empresa->nr_telefone1); ?></td>                    
                <td><?php echo e($empresa->nm_bairro); ?></td>                    
                <td><?php echo e($empresa->nm_cidade); ?></td>
                <td>                 
                    <a class="btn btn-sm btn-info" href="<?php echo e(route('empresa.show',$empresa->id_pessoa)); ?>"><i class='fa fa-eye'></i></a>                        
                    <a class="btn btn-sm btn-primary" href="<?php echo e(route('empresa.edit',$empresa->id_pessoa)); ?>"><i class='fa fa-edit'></i></a>                                                       
                    <a class="btn btn-sm btn-danger" href="" data-target="#modal-delete-<?php echo e($empresa->id_pessoa); ?>" data-toggle="modal"><i class='fa fa-trash'></i></a>
                </td>    
            </tr>
            <?php echo $__env->make('forms.modal',['action'=>'EmpresaController@destroy','id'=>$empresa->id_pessoa], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        </table>
    </div>      
    <div class="box-footer clearfix"> 
        <ul class="pagination pagination-sm no-margin pull-left"><?php echo e($empresas->appends(['searchText' => $searchText])->links()); ?></ul>
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

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp73\htdocs\funeraria\resources\views/empresa/index.blade.php ENDPATH**/ ?>