<div class="text-center text-muted mb-4">
	<small><?php echo $this->lang->line('app_auth_register_title') ?></small>
</div>
<form role="form" method="POST" method="/auth/register/">

	<?php if(isset($messages) && $messages != ''): ?>
		<?php echo $messages; ?>
	<?php endif; ?>

	<?php if(isset($recoverpass) && $recoverpass != ''): ?>
		<?php echo $recoverpass; ?>
	<?php endif; ?>

	<div class="form-group mb-3">
		<div class="input-group input-group-merge input-group-alternative">
			<div class="input-group-prepend">
				<span class="input-group-text"><i class="ni ni-email-83"></i></span>
			</div>
			<input class="form-control" name="username" placeholder="<?php echo $this->lang->line('app_auth_register_username') ?>" type="email">
		</div>
	</div>

	<div class="form-group">
		<div class="input-group input-group-merge input-group-alternative">
			<div class="input-group-prepend">
				<span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
			</div>
			<input class="form-control" name="password" placeholder="<?php echo $this->lang->line('app_auth_register_password') ?>" type="password">
		</div>
	</div>


	<div class="form-group">
		<div class="input-group input-group-merge input-group-alternative">
			<div class="input-group-prepend">
				<span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
			</div>
			<input class="form-control" name="idorganization" placeholder="<?php echo $this->lang->line('app_auth_register_org') ?>" type="password">
		</div>
	</div>

	<div class="text-center">
		<button type="submit" class="btn btn-primary my-4"><?php echo $this->lang->line('app_auth_register_submit') ?></button>
	</div>

</form>
