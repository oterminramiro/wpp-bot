<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
		<meta name="author" content="Creative Tim">
		<title><?php echo $title; ?></title>
		<!-- Favicon -->
		<link rel="icon" href="/assets/themes/app/img/brand/favicon.png" type="image/png">
		<!-- Fonts -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
		<!-- Icons -->
		<link rel="stylesheet" href="/assets/themes/app/vendor/nucleo/css/nucleo.css" type="text/css">
		<link rel="stylesheet" href="/assets/themes/app/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
		<!-- Page plugins -->
		<!-- Argon CSS -->
		<link rel="stylesheet" href="/assets/themes/app/css/argon.css?v=1.2.0" type="text/css">
		<link rel="stylesheet" href="/assets/themes/app/vendor/font-awesome-pro/css/all.min.css" type="text/css" />

		<?php if(isset($css_files)):?>
			<?php foreach($css_files as $css):?>
				<link type="text/css" rel="stylesheet" href="<?php echo $css;?>" />
			<?php endforeach;?>
		<?php endif;?>
	</head>
	<body>

		<!-- Sidenav -->
		<?php $this->load->view('app/partials/sidenav'); ?>


		<!-- Main content -->
		<div class="main-content" id="panel">
			<!-- Topnav -->
			<nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
				<div class="container-fluid">
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<!-- Search form -->
						<form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
							<div class="form-group mb-0">
								<div class="input-group input-group-alternative input-group-merge">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-search"></i></span>
									</div>
									<input class="form-control" placeholder="Search" type="text">
								</div>
							</div>
							<button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
							<span aria-hidden="true">×</span>
							</button>
						</form>
						<!-- Navbar links -->
						<ul class="navbar-nav align-items-center  ml-md-auto ">
							<li class="nav-item d-xl-none">
								<!-- Sidenav toggler -->
								<div class="pr-3 sidenav-toggler sidenav-toggler-light" data-action="sidenav-pin" data-target="#sidenav-main">
									<div class="sidenav-toggler-inner">
										<i class="sidenav-toggler-line"></i>
										<i class="sidenav-toggler-line"></i>
										<i class="sidenav-toggler-line"></i>
									</div>
								</div>
							</li>
							<li class="nav-item d-sm-none">
								<a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
								<i class="ni ni-zoom-split-in"></i>
								</a>
							</li>
						</ul>
						<ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
							<li class="nav-item dropdown">
								<a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<div class="media align-items-center">
										<div class="media-body  ml-2  d-none d-lg-block">
											<span class="mb-0 text-sm  font-weight-bold">
												<?php echo $this->user->Email ?>
											</span>
										</div>
									</div>
								</a>
								<div class="dropdown-menu  dropdown-menu-right ">
									<a href="/manage/account/account/" class="dropdown-item">
										<i class="ni ni-single-02"></i>
										<span><?php echo $this->lang->line('app_menu_account') ?></span>
									</a>
									<div class="dropdown-divider"></div>
									<a href="/manage/account/logout/" class="dropdown-item">
										<i class="ni ni-user-run"></i>
										<span><?php echo $this->lang->line('app_menu_logout') ?></span>
									</a>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</nav>

			<!-- Header -->
			<div class="header pb-6 bg-primary">
				<div class="container-fluid">
					<div class="header-body">
						<div class="row align-items-center py-4">
							<div class="col-lg-6 col-7">
								<h6 class="h2 text-white d-inline-block mb-0"><?php echo $title; ?></h6>
								<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
									<ol class="breadcrumb breadcrumb-links breadcrumb-dark">
										<li class="breadcrumb-item"><a href="/manage/dashboard/index"><i class="fas fa-home"></i></a></li>
										<li class="breadcrumb-item"><a href="/manage/dashboard/index"><?php echo $this->lang->line('app_menu_home') ?></a></li>
										<li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
									</ol>
								</nav>
							</div>
							<div class="col-lg-6 col-5 text-right">
								<a href="#" class="btn btn-sm btn-neutral"><?php echo $this->lang->line('app_menu_return') ?></a>
							</div>
						</div>
					</div>
				</div>
			</div>


			<!-- Page content -->
			<div class="container-fluid mt--6">
				<div class="row">
					<div class="col-xl-12 col-md-12">
						<?php $this->load->view($content); ?>
					</div>
				</div>
			</div>
		</div>
		<!-- Argon Scripts -->
		<!-- Core -->
		<script src="/assets/themes/app/vendor/jquery/dist/jquery.min.js"></script>
		<script src="/assets/themes/app/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
		<script src="/assets/themes/app/vendor/js-cookie/js.cookie.js"></script>
		<script src="/assets/themes/app/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
		<script src="/assets/themes/app/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
		<!-- Optional JS -->
		<script src="/assets/themes/app/vendor/jvectormap-next/jquery-jvectormap.min.js"></script>
		<script src="/assets/themes/app/js/vendor/jvectormap/jquery-jvectormap-world-mill.js"></script>
		<!-- Argon JS -->
		<script src="/assets/themes/app/js/argon.js?v=1.2.0"></script>
		<?php if(isset($js_files)):?>
			<?php foreach($js_files as $js):?>
				<script src="<?php echo $js;?>"></script>
			<?php endforeach;?>
		<?php endif;?>
	</body>
</html>
