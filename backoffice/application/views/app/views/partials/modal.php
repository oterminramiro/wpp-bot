<div class="modal fade gc-iframe-modal gc-visible-but-hidden" role="dialog">
	<div class="modal-dialog gc-modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="title">
					<?php if(isset($title)): ?>
						<?php echo $title;?>
					<?php endif; ?>
				</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			</div>
			<div class="modal-body">
				<iframe id='iframe' class="responsive-iframe" width="100%" height="500px" frameBorder="0"></iframe>
			</div>
		</div>
	</div>
</div>
