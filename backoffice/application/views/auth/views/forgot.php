<form action="/auth/forgot_password/" method="post">
	<?php if(isset($messages) && $messages != ''): ?>
		<?php echo $messages; ?>
	<?php endif; ?>
	<input class="form-control input-lg" type="email" name="username" placeholder="<?php echo $this->lang->line('app_auth_forget_username') ?>" required="required">
	<button class="btn btn-default mt-3 w-100" type="submit"><?php echo $this->lang->line('app_auth_forget_submit') ?></button>
</form>
