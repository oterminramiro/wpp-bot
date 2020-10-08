<?php if(isset($messages) && $messages != ''): ?>
	<?php echo $messages; ?>
<?php endif; ?>

<h6 class="h5 mb-0 mt-4">Reset Password</h6>
<p class="text-muted mt-1 mb-5">
	Enter your email address and we'll send you an email with instructions to reset your password.
</p>

<form class="pb-5 pt-3" action="/auth/forgot_password/" method="post">
	<div class="form-group">
		<label class="form-control-label">Email Address</label>
		<div class="input-group input-group-merge">
			<div class="input-group-prepend">
				<span class="input-group-text">
					<i class="icon-dual" data-feather="mail"></i>
				</span>
			</div>
			<input type="email" class="form-control" id="email" name="username" placeholder="<?php echo $this->lang->line('app_auth_forget_username') ?>">
		</div>
	</div>

	<div class="form-group mb-0 text-center">
		<button class="btn btn-primary btn-block" type="submit"> <?php echo $this->lang->line('app_auth_forget_submit') ?></button>
	</div>
</form>
