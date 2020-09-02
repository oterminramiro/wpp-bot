<?php if(isset($messages) && $messages != ''): ?>
	<?php echo $messages; ?>
<?php endif; ?>

<?php if(isset($recoverpass) && $recoverpass != ''): ?>
	<?php echo $recoverpass; ?>
<?php endif; ?>

<h6 class="h5 mb-0 mt-4">Welcome back!</h6>
<p class="text-muted mt-1 mb-4">Enter your email address and password to
	access admin panel.</p>

<form role="form" method="POST" method="/auth/login/">

	<div class="form-group">
		<label class="form-control-label">Email Address</label>
		<div class="input-group input-group-merge">
			<div class="input-group-prepend">
				<span class="input-group-text">
					<i class="icon-dual" data-feather="mail"></i>
				</span>
			</div>
			<input class="form-control" id="email" name="username" placeholder="<?php echo $this->lang->line('app_auth_login_username') ?>" type="email" value="<?php echo set_value('username'); ?>">
		</div>
	</div>

	<div class="form-group mt-4">
		<label class="form-control-label">Password</label>
		<a href="/auth/forgot_password" class="float-right text-muted text-unline-dashed ml-1"><?php echo $this->lang->line('app_auth_login_forget') ?></a>
		<div class="input-group input-group-merge">
			<div class="input-group-prepend">
				<span class="input-group-text">
					<i class="icon-dual" data-feather="lock"></i>
				</span>
			</div>
			<input class="form-control" id="password"
				name="password" placeholder="<?php echo $this->lang->line('app_auth_login_password') ?>" type="password" value="<?php echo set_value('password'); ?>">
		</div>
	</div>

	<div class="form-group mb-4">
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input"
				id="checkbox-signin" checked>
			<label class="custom-control-label" for="checkbox-signin">Remember
				me</label>
		</div>
	</div>

	<div class="form-group mb-0 text-center">
		<button class="btn btn-primary btn-block" type="submit">
			<?php echo $this->lang->line('app_auth_login_submit') ?>
		</button>
	</div>
</form>
