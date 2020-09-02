<form action="/auth/new_password/" method="post">
	<?php if(isset($messages) && $messages != ''): ?>
		<?php echo $messages; ?>
	<?php endif; ?>
	<input class="form-control input-lg" type="password" name="Passwordone" placeholder="<?php echo $this->lang->line('app_auth_recover_password') ?>" required="required">
	<input class="form-control input-lg mt-3" type="password" name="Passwordtwo" placeholder="<?php echo $this->lang->line('app_auth_recover_password') ?>" required="required">
    <input type="hidden" name="guid" value="<?php echo $guid ?>">
	<button class="btn btn-block btn-secondary mt-3" id="loginbtn" type="submit"><?php echo $this->lang->line('app_auth_recover_submit') ?></button>
	<a class="btn btn-default mt-3 w-100" href="/auth/login"><?php echo $this->lang->line('app_auth_recover_return') ?></a>
</form>
