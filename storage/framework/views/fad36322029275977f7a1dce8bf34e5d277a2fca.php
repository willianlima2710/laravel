

<?php $__env->startSection('title', 'Fornecedores'); ?>

<?php $__env->startSection('content_header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h3>Listagem - Fornecedores</h3>
        </div>
        <div class="pull-right">            
            <a class="btn btn-success" style="margin: 10px;" href="<?php echo e(route('fornecedor.create')); ?>"><i class='fa fa-plus'></i> Novo</a>
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
        <?php echo $__env->make("forms.search",["rota" => "fornecedor"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-condensed table-hover" id="dest">
            <thead>
            <tr>
                <th width="100px">Código</th>
                <th width="250px">Nome</th>
                <th width="100px">CNPJ/CPF</th>
                <th width="100px">IE/RG</th>
                <th width="100px">Telefone</th>
                <th width="100px">Bairro</th>
                <th width="100px">Cidade</th>
                <th width="150px"><i class="fa fa-cogs"></i></th>                   
            </tr>     
            </thead>       
            <tbody>                
            <?php $__currentLoopData = $fornecedores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fornecedor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($fornecedor->id_pessoa); ?></td>
                <td><?php echo e($fornecedor->nm_pessoa); ?></td>
                <td><?php echo e($fornecedor->nr_cpfcnpj); ?></td>
                <td><?php echo e($fornecedor->nr_rgie); ?></td>
                <td><?php echo e($fornecedor->nr_telefone1); ?></td>                    
                <td><?php echo e($fornecedor->nm_bairro); ?></td>                    
                <td><?php echo e($fornecedor->nm_cidade); ?></td>                    
                <td>                 
                    <a class="btn btn-sm btn-info" href="<?php echo e(route('fornecedor.show',$fornecedor->id_pessoa)); ?>"><i class='fa fa-eye'></i></a>                        
                    <a class="btn btn-sm btn-primary" href="<?php echo e(route('fornecedor.edit',$fornecedor->id_pessoa)); ?>"><i class='fa fa-edit'></i></a>                                                       
                    <a class="btn btn-sm btn-danger" href="" data-target="#modal-delete-<?php echo e($fornecedor->id_pessoa); ?>" data-toggle="modal"><i class='fa fa-trash'></i></a>
                </td>    
            </tr>
            <?php echo $__env->make('forms.modal',['action'=>'FornecedorController@destroy','id'=>$fornecedor->id_pessoa], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        </table>
    </div>      
    <div class="box-footer clearfix"> 
        <ul class="pagination pagination-sm no-margin pull-left"><?php echo e($fornecedores->appends(['searchText' => $searchText])->links()); ?></ul>
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

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/wfuneraria/public_html/paranaluto/resources/views/fornecedor/index.blade.php ENDPATH**/ ?>