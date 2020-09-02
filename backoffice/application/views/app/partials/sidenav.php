<div class="topnav shadow-sm">
	<div class="container-fluid">
		<nav class="navbar navbar-light navbar-expand-lg topbar-nav">
			<div class="collapse navbar-collapse" id="topnav-menu-content">
				<ul class="metismenu" id="menu-bar">
					<li class="menu-title">Navigation</li>

					<li>
						<a href="/manage/dashboard/index">
							<i data-feather="home"></i>
							<span class="badge badge-success float-right">1</span>
							<span> <?php echo $this->lang->line('app_menu_home') ?> </span>
						</a>
					</li>
					<li>
						<a href="javascript: void(0);">
							<i data-feather="inbox"></i>
							<span> <?php echo $this->lang->line('app_menu_manage') ?> </span>
							<span class="menu-arrow"></span>
						</a>

						<ul class="nav-second-level" aria-expanded="false">
							<li>
								<a href="/manage/organizations/index"><?php echo $this->lang->line('app_menu_organizations') ?></a>
							</li>
							<li>
								<a href="/manage/options/index"><?php echo $this->lang->line('app_menu_options') ?></a>
							</li>
							<li>
								<a href="/manage/organizations/index"><?php echo $this->lang->line('app_menu_organizations') ?></a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</nav>
	</div>
</div>
