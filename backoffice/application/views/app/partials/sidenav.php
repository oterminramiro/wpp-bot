<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
	<div class="scrollbar-inner">
		<!-- Brand -->
		<div class="sidenav-header  d-flex  align-items-center">
			<a class="navbar-brand" href="/manage/dashboard/index">
			<img src="/assets/images/logo.png" class="navbar-brand-img" alt="...">
			</a>
			<div class=" ml-auto ">
				<!-- Sidenav toggler -->
				<div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
					<div class="sidenav-toggler-inner">
						<i class="sidenav-toggler-line"></i>
						<i class="sidenav-toggler-line"></i>
						<i class="sidenav-toggler-line"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="navbar-inner">
			<!-- Collapse -->
			<div class="collapse navbar-collapse" id="sidenav-collapse-main">
				<!-- Nav items -->
				<ul class="navbar-nav">

					<li class="nav-item">
						<a class="nav-link" href="/manage/dashboard/index">
						<i class="fal fa-tachometer-fast text-red"></i>
						<span class="nav-link-text"><?php echo $this->lang->line('app_menu_home') ?></span>
						</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="#navbar-options" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-options">
						<i class="fal fa-clipboard-list-check text-info"></i>
						<span class="nav-link-text"><?php echo $this->lang->line('app_menu_options') ?></span>
						</a>
						<div class="collapse" id="navbar-options">
							<ul class="nav nav-sm flex-column">
								<li class="nav-item">
									<a href="/manage/options/all" class="nav-link">
									<span class="sidenav-mini-icon"> <?php echo $this->lang->line('app_menu_options_all_mini') ?> </span>
									<span class="sidenav-normal"> <?php echo $this->lang->line('app_menu_options_all') ?> </span>
									</a>
								</li>
							</ul>
						</div>
					</li>

					<?php if($this->sessionManager->checkRole(['ADMIN'])): ?>
					<li class="nav-item">
						<a class="nav-link" href="#navbar-organizations" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-organizations">
							<i class="fal fa-cogs text-orange"></i>
							<span class="nav-link-text"><?php echo $this->lang->line('app_menu_manage') ?></span>
						</a>
						<div class="collapse" id="navbar-organizations">
							<ul class="nav nav-sm flex-column">
								<li class="nav-item">
									<a href="/manage/organizations/index" class="nav-link">
									<span class="sidenav-mini-icon"> <?php echo $this->lang->line('app_menu_organizations_mini') ?> </span>
									<span class="sidenav-normal"> <?php echo $this->lang->line('app_menu_organizations') ?> </span>
									</a>
								</li>
								<li class="nav-item">
									<a href="/manage/organizations/index" class="nav-link">
									<span class="sidenav-mini-icon"> <?php echo $this->lang->line('app_menu_organizations_mini') ?> </span>
									<span class="sidenav-normal"> <?php echo $this->lang->line('app_menu_organizations') ?> </span>
									</a>
								</li>
							</ul>
						</div>
					</li>
					<?php endif ?>

					<li class="nav-item">
						<a class="nav-link" href="/manage/account/account/">
						<i class="fal fa-user-cog text-primary"></i>
						<span class="nav-link-text"><?php echo $this->lang->line('app_menu_account') ?></span>
						</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="/manage/account/logout/">
						<i class="fal fa-sign-out"></i>
						<span class="nav-link-text"><?php echo $this->lang->line('app_menu_logout') ?></span>
						</a>
					</li>

				</ul>
			</div>
		</div>
	</div>
</nav>
