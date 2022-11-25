

<?php $__env->startSection('title', 'Contratos'); ?>

<?php $__env->startSection('content_header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-12 margin-tb">
        <div class="pull-left">
            <h3>Listagem - Contratos</h3>
        </div>
        <div class="pull-right">            
            <a class="btn btn-success" style="margin: 10px;" href="<?php echo e(route('contrato.create')); ?>"><i class='fa fa-plus'></i> Novo</a>
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
        <?php echo $__env->make("forms.search",["rota" => "contrato"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-condensed table-hover" id="dest">
            <thead>
            <tr>
                <th width="100px">Data Inc</th>
                <th width="120px">Nº Contrato</th>
                <th width="250px">Nome</th>
                <th width="120px">Plano</th>
                <th width="90px">Qt Parc</th>
                <th width="90px">$ Valor</th>
                <th width="110px">Vendedor</th>
                <th width="110px">Observação</th>
                <th width="150px"><i class="fa fa-cogs"></i></th>                   
            </tr>     
            </thead>       
            <tbody>                
            <?php $__currentLoopData = $contratos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contrato): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>            
            <tr>
                <td><span style="display: none;"><?php echo e(empty($contrato->dt_inccontrato) ? '' : $contrato->dt_inccontrato->format("Y-m-d")); ?></span>
                    <?php echo e(empty($contrato->dt_inccontrato) ? '' : $contrato->dt_inccontrato->format("d/m/Y")); ?>

                </td>
                <td><?php echo e($contrato->nr_contrato); ?></td>
                <td><?php echo e($contrato->nm_pessoa); ?></td>
                <td><?php echo e($contrato->nm_plano); ?></td>
                <td><?php echo e($contrato->qt_parcela); ?></td>                    
                <td><?php echo e(number_format($contrato->vl_total, 2, '.', '')); ?></td>
                <td><?php echo e($contrato->nm_vendedor); ?></td>
                <td><?php echo e($contrato->nm_obs); ?></td>
                <td>        
                    <div class="dropdown">
                       <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Ações
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                            <li role="presentation"><a role="menuitem" href="<?php echo e(route('contrato.show',$contrato->id_contrato)); ?>">Visualizar</a></li>
                            <li role="presentation"><a role="menuitem" href="<?php echo e(route('contrato.edit',$contrato->id_contrato)); ?>">Editar</a></li>
                            <li role="presentation"><a role="menuitem" href="<?php echo e(route('printpdf',$contrato->id_contrato)); ?>" target="blank">Imprimir</a></li>
                            <li role="presentation"><a role="menuitem" href="">Transferir</a></li>
                            <li role="presentation" class="divider"></li>                            
                            <li role="presentation"><a role="menuitem" href="">Cancelar</a></li>                           
                            <li role="presentation"><a role="menuitem" href="" data-target="#modal-delete-<?php echo e($contrato->id_contrato); ?>" data-toggle="modal">Excluir</a></li>
                        </ul>
                    </div>
                </td>    
            </tr>
            <?php echo $__env->make('forms.modal',['action'=>'ContratoController@destroy','id'=>$contrato->id_contrato], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        </table>
    </div>      
    <div class="box-footer clearfix"> 
        <ul class="pagination pagination-sm no-margin pull-left"><?php echo e($contratos->appends(['searchText' => $searchText])->links()); ?></ul>
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

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/wfuneraria/public_html/anjogabriel/resources/views/contrato/index.blade.php ENDPATH**/ ?>