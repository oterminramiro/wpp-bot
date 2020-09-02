<div class="text-center text-muted mb-4">
    <small><?php echo $this->lang->line('app_auth_login_title') ?></small>
</div>
<form role="form" method="POST" method="/auth/login/">

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
            <input class="form-control" name="username" placeholder="<?php echo $this->lang->line('app_auth_login_username') ?>" type="email" value="<?php echo set_value('username'); ?>">
        </div>
    </div>

    <div class="form-group">
        <div class="input-group input-group-merge input-group-alternative">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
            </div>
            <input class="form-control" name="password" placeholder="<?php echo $this->lang->line('app_auth_login_password') ?>" type="password" value="<?php echo set_value('password'); ?>">
        </div>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary my-4"><?php echo $this->lang->line('app_auth_login_submit') ?></button>
    </div>

</form>
