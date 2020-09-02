<div class="header my-6 pt-6 d-flex align-items-center">
  <!-- Mask -->
  <!-- Header container -->
  <div class="container-fluid d-flex align-items-center">
	<div class="row">
	  <div class="col-lg-7 col-md-10">
		<h1 class="display-2"> <?php echo $this->lang->line('app_account_hello') ?> <?php echo $this->user->Email ?></h1>
		<p class="mt-0 mb-5">
			<?php echo $this->lang->line('app_account_maintext') ?></p>
	  </div>
	</div>
  </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
	<div class="row">

		<!-- Card widget with info -->
		<div class="col-xl-4 order-xl-2">
			<div class="card card-profile h-100">
				<div class="bg-primary card-img-top">
					<div style="width:1000px; height:200px">

					</div>
					<!-- <img src="/assets/themes/app/img/theme/img-1-1000x600.jpg" alt="Image placeholder" class="card-img-top"> -->
				</div>
				<div class="row justify-content-center">
					<div class="col-lg-3 order-lg-2">
						<div class="card-profile-image">
							<a href="#">
								<img src="/assets/themes/app/img/theme/team-4.jpg" class="rounded-circle">
							</a>
						</div>
					</div>
				</div>
				<div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
					<div class="d-flex justify-content-between">
						<!-- <a href="#" class="btn btn-sm btn-info  mr-4 ">Connect</a>
						<a href="#" class="btn btn-sm btn-default float-right">Message</a> -->
					</div>
				</div>
				<div class="card-body pt-5">
					<div class="text-center">
						<h5 class="h3">
							<?php echo $this->user->Email ?>
						</h5>
						<div class="h5 font-weight-300">
							<i class="ni location_pin mr-2"></i><?php echo $this->user->Email ?>
						</div>
						<div class="h5 mt-4">
							<i class="ni business_briefcase-24 mr-2"></i><?php echo $this->user->Role->Name ?>
						</div>
						<?php if(!$this->sessionManager->checkRole(['ADMIN'])): ?>
						<div>
							<i class="ni education_hat mr-2"></i><?php echo $this->user->Organization->Name ?>
						</div>
						<?php endif ?>
					</div>
				</div>
			</div>

		</div>

		<div class="col-xl-8">
			<!-- Edit User password -->
			<div class="">
				<div class="card">
					<div class="card-header">
						<div class="row align-items-center">
							<div class="col-8">
								<h3 class="mb-0"><?php echo $this->lang->line('app_account_editpassword') ?></h3>
							</div>
						</div>
					</div>
					<div class="card-body">
						<?php if(isset($messages_password) && $messages_password != ''): ?>
							 <?php echo $messages_password; ?>
						<?php endif; ?>
						<form action="/manage/account/account/" method="post">
							<h6 class="heading-small text-muted mb-4"><?php echo $this->lang->line('app_account_userpassword') ?></h6>
							<div class="pl-lg-4">
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label class="form-control-label" for="input-username"><?php echo $this->lang->line('app_account_user_pass') ?></label>
											<input type="password" name="Password" class="form-control" placeholder="<?php echo $this->lang->line('app_account_user_pass') ?>" required="required"
											>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label class="form-control-label" for="input-email"><?php echo $this->lang->line('app_account_user_confirm_pass') ?></label>
											<input type="password" name="RepeatPassword" class="form-control" placeholder="<?php echo $this->lang->line('app_account_user_confirm_pass') ?>" required="required"
											>
										</div>
									</div>
								</div>
							</div>
							<button type="submit" class="btn btn-primary my-4"><?php echo $this->lang->line('app_account_submit') ?></button>
						</form>
					</div>
				</div>
			</div>


			<!-- Edit User language -->
			<div class="">
				<div class="card mb-0">
					<div class="card-header">
						<div class="row align-items-center">
							<div class="col-8">
								<h3 class="mb-0"><?php echo $this->lang->line('app_account_editlanguage') ?></h3>
							</div>
						</div>
					</div>
					<div class="card-body">
						<?php if(isset($messages_language) && $messages_language != ''): ?>
							 <?php echo $messages_language; ?>
						<?php endif; ?>
						<form action="/manage/account/language/" method="post">
							<h6 class="heading-small text-muted mb-4"><?php echo $this->lang->line('app_account_userlanguage') ?></h6>
							<div class="pl-lg-4">
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label class="form-control-label" for="input-username"><?php echo $this->lang->line('app_account_user_language') ?></label>
											<select class="form-control" name="language">
											<?php $language = Language::get(); ?>
					                        <?php foreach($language as $key => $item): ?>
					                            <option <?php if($item->IdLanguage == $this->user->IdLanguage) echo 'selected=""' ?> value="<?php echo $item->IdLanguage ?>"><?php echo $item->Name ?></option>
					                        <?php endforeach ?>
					                        </select>
										</div>
									</div>
								</div>
							</div>
							<button type="submit" class="btn btn-primary my-4"><?php echo $this->lang->line('app_account_submit') ?></button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
