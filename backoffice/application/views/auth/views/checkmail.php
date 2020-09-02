<?php if(isset($messages) && $messages != ''): ?>
<?php echo $messages; ?>
<?php endif; ?>

<h6 class="h5 mb-0 mt-5"><?php echo $this->lang->line('app_auth_check_send') ?></h6>
<p class="text-muted mt-3 mb-3">Your account has been successfully registered. To
	complete the verification process, please check your email for a validation request.
</p>
