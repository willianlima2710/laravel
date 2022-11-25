<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-<?php echo e($id); ?>">	
	<form method="post" action="<?php echo e(action($action,$id)); ?>">    	
		<?php echo e(csrf_field()); ?> <?php echo e(method_field('delete')); ?>

		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title">Apagar</h4>
				</div>
				<div class="modal-body">
					<p>Deseja mesmo apagar o registro selecionado ?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					<button type="submit" class="btn btn-primary">Confirmar</button>
				</div>
			</div>
		</div>
	</form>
</div><?php /**PATH /home/wfuneraria/public_html/paranaluto/resources/views/forms/modal.blade.php ENDPATH**/ ?>