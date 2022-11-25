

<?php $__env->startSection('title', 'Funcionários'); ?>

<?php $__env->startSection('content_header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h3>Listagem - Funcionários</h3>
        </div>
        <div class="pull-right">            
            <a class="btn btn-success" style="margin: 10px;" href="<?php echo e(route('funcionario.create')); ?>"><i class='fa fa-plus'></i> Novo</a>
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
        <?php echo $__env->make("forms.search",["rota" => "funcionario"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-condensed table-hover" id="dest">
            <thead>
            <tr>
                <th width="115px">Código</th>
                <th width="250px">Nome</th>
                <th width="100px">CPF</th>
                <th width="150px">Telefone</th>
                <th width="85px">Bairro</th>
                <th width="110px">Cidade</th>
                <th width="110px">Admissão</th>
                <th width="110px">Demissão</th>
                <th width="150px"><i class="fa fa-cogs"></i></th>                   
            </tr>     
            </thead>       
            <tbody>                
            <?php $__currentLoopData = $funcionarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $funcionario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>            
            <tr>
                <td><?php echo e($funcionario->id_pessoa); ?></td>
                <td><?php echo e($funcionario->nm_pessoa); ?></td>
                <td><?php echo e($funcionario->nr_cpfcnpj); ?></td>
                <td><?php echo e($funcionario->nr_telefone1); ?></td>                    
                <td><?php echo e($funcionario->nm_bairro); ?></td>                    
                <td><?php echo e($funcionario->nm_cidade); ?></td>
                <td><span style="display: none;"><?php echo e(empty($funcionario->dt_admissao) ? '' : $funcionario->dt_admissao->format("Y-m-d")); ?></span>
                    <?php echo e(empty($funcionario->dt_admissao) ? '' : $funcionario->dt_admissao->format("d/m/Y")); ?>

                </td>
                <td><span style="display: none;"><?php echo e(empty($funcionario->dt_demissao) ? '' : $funcionario->dt_demissao->format("Y-m-d")); ?></span>
                    <?php echo e(empty($funcionario->dt_demissao) ? '' : $funcionario->dt_demissao->format("d/m/Y")); ?>

                </td>
                <td>                 
                    <a class="btn btn-sm btn-info" href="<?php echo e(route('funcionario.show',$funcionario->id_pessoa)); ?>"><i class='fa fa-eye'></i></a>                        
                    <a class="btn btn-sm btn-primary" href="<?php echo e(route('funcionario.edit',$funcionario->id_pessoa)); ?>"><i class='fa fa-edit'></i></a>                                                       
                    <a class="btn btn-sm btn-danger" href="" data-target="#modal-delete-<?php echo e($funcionario->id_pessoa); ?>" data-toggle="modal"><i class='fa fa-trash'></i></a>
                </td>    
            </tr>
            <?php echo $__env->make('forms.modal',['action'=>'FuncionarioController@destroy','id'=>$funcionario->id_pessoa], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        </table>
    </div>      
    <div class="box-footer clearfix"> 
        <ul class="pagination pagination-sm no-margin pull-left"><?php echo e($funcionarios->appends(['searchText' => $searchText])->links()); ?></ul>
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

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/wfuneraria/public_html/paranaluto/resources/views/funcionario/index.blade.php ENDPATH**/ ?>