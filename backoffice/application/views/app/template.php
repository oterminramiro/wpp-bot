<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title><?php echo $title; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta content="Wpp bot" name="description" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />

		<!-- App favicon -->
		<link rel="shortcut icon" href="/assets/themes/app/images/favicon.ico">
		<!-- plugins -->
		<link href="/assets/themes/app/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
		<!-- App css -->
		<link href="/assets/themes/app/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="/assets/themes/app/css/icons.min.css" rel="stylesheet" type="text/css" />
		<link href="/assets/themes/app/css/app.min.css" rel="stylesheet" type="text/css" />

		<?php if(isset($css_files)):?>
			<?php foreach($css_files as $css):?>
				<link type="text/css" rel="stylesheet" href="<?php echo $css;?>" />
			<?php endforeach;?>
		<?php endif;?>

	</head>
	<body data-layout="topnav">
		<!-- Begin page -->
		<div class="wrapper">

			<!-- ============================================================== -->
			<!-- Start Page Content here -->
			<!-- ============================================================== -->

			<!-- Topbar Start -->
			<div class="navbar navbar-expand flex-column flex-md-row navbar-custom">
				<div class="container-fluid">
					<!-- LOGO -->
					<a href="index.html" class="navbar-brand mr-0 mr-md-2 logo">
						<span class="logo-lg">
							<img src="/assets/themes/app/images/logo.png" alt="" height="24" />
							<span class="d-inline h5 ml-1 text-logo"><?php echo $this->user->Email ?></span>
						</span>
						<span class="logo-sm">
							<img src="/assets/themes/app/images/logo.png" alt="" height="24">
						</span>
					</a>

					<ul class="navbar-nav bd-navbar-nav flex-row list-unstyled menu-left mb-0">
						<li class="">
							<button class="button-menu-mobile open-left disable-btn">
								<i data-feather="menu" class="menu-icon"></i>
								<i data-feather="x" class="close-icon"></i>
							</button>
						</li>
					</ul>

					<ul class="navbar-nav flex-row ml-auto d-flex list-unstyled topnav-menu float-right mb-0">
						<li class="d-none d-sm-block">
							<div class="app-search">
								<form>
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Search...">
										<span data-feather="search"></span>
									</div>
								</form>
							</div>
						</li>

						<li class="dropdown notification-list align-self-center profile-dropdown">
							<a class="nav-link dropdown-toggle nav-user mr-0" data-toggle="dropdown" href="#" role="button"
								aria-haspopup="false" aria-expanded="false">
								<div class="media user-profile ">
									<img src="/assets/themes/app/images/users/avatar-7.jpg" alt="user-image" class="rounded-circle align-self-center" />
									<div class="media-body text-left">
										<h6 class="pro-user-name ml-2 my-0">
											<span><?php echo $this->user->Email ?></span>
											<span class="pro-user-desc text-muted d-block mt-1"><?php echo $this->user->Role->Name ?></span>
										</h6>
									</div>
									<span data-feather="chevron-down" class="ml-2 align-self-center"></span>
								</div>
							</a>
							<div class="dropdown-menu profile-dropdown-items dropdown-menu-right">
								<a href="/manage/account/account/" class="dropdown-item notify-item">
									<i data-feather="user" class="icon-dual icon-xs mr-2"></i>
									<span><?php echo $this->lang->line('app_menu_account') ?></span>
								</a>

								<a href="javascript:void(0);" class="dropdown-item notify-item">
									<i data-feather="settings" class="icon-dual icon-xs mr-2"></i>
									<span>Settings</span>
								</a>

								<div class="dropdown-divider"></div>

								<a href="/manage/account/logout/" class="dropdown-item notify-item">
									<i data-feather="log-out" class="icon-dual icon-xs mr-2"></i>
									<span><?php echo $this->lang->line('app_menu_logout') ?></span>
								</a>
							</div>
						</li>
					</ul>
				</div>

			</div>
			<!-- end Topbar -->

			<!-- Sidenav -->
			<?php $this->load->view('app/partials/sidenav'); ?>

			<div class="content-page">
				<div class="content">
					<!-- Start Content-->
					<div class="container-fluid">

						<?php if(isset($breadcrumb)): ?>
							<?php $this->load->view($breadcrumb); ?>
						<?php endif ?>


						<?php if(isset($content)): ?>
							<?php $this->load->view($content); ?>
						<?php endif ?>

					</div>
				</div>


				<!-- Footer Start -->
				<footer class="footer">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12">
								2019 &copy; Shreyu. All Rights Reserved. Crafted with <i class='uil uil-heart text-danger font-size-12'></i> by <a href="https://coderthemes.com" target="_blank">Coderthemes</a>
							</div>
						</div>
					</div>
				</footer>
				<!-- end Footer -->
			</div>
			<!-- ============================================================== -->
			<!-- End Page content -->
			<!-- ============================================================== -->
		</div>

		<!-- Vendor js -->
		<script src="/assets/themes/app/js/vendor.min.js"></script>

		<!-- optional plugins -->
		<script src="/assets/themes/app/libs/moment/moment.min.js"></script>
		<script src="/assets/themes/app/libs/apexcharts/apexcharts.min.js"></script>
		<script src="/assets/themes/app/libs/flatpickr/flatpickr.min.js"></script>

		<!-- page js -->
		<script src="/assets/themes/app/js/pages/dashboard.init.js"></script>

		<!-- App js -->
		<script src="/assets/themes/app/js/app.min.js"></script>

		<?php if(isset($js_files)):?>
			<?php foreach($js_files as $js):?>
				<script src="<?php echo $js;?>"></script>
			<?php endforeach;?>
		<?php endif;?>
	</body>
</html>
