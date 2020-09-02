<div class="mb-lg">
    <?php if(isset($messages) && $messages != ''): ?>
    <?php echo $messages; ?>
    <?php endif; ?>
    <p class="mx-auto text-center"><?php echo $this->lang->line('app_auth_check_send') ?></p>
    <a class="btn btn-default mt-3 w-100" href="/auth/login"><?php echo $this->lang->line('app_auth_check_return') ?></a>
  </a>
</div>
