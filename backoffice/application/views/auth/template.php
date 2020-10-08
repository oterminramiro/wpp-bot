<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title><?php echo $title ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta content="Wpp Bot" name="description" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />

		<!-- App favicon -->
		<link rel="shortcut icon" href="/assets/themes/app/images/favicon.ico">

		<!-- App css -->
		<link href="/assets/themes/app/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="/assets/themes/app/css/icons.min.css" rel="stylesheet" type="text/css" />
		<link href="/assets/themes/app/css/app.min.css" rel="stylesheet" type="text/css" />

	</head>

	<body class="authentication-bg">

		<div class="account-pages my-5">
			<div class="container py-5">
				<div class="row justify-content-center">
					<div class="col-xl-10">
						<div class="card">
							<div class="card-body p-0">
								<div class="row">
									<div class="col-md-6 p-5">
										<div class="mx-auto mb-5">
											<a href="index.html">
												<img src="/assets/themes/app/images/logo.png" alt="" height="24" />
												<h3 class="d-inline align-middle ml-1 text-logo">WPP Bot</h3>
											</a>
										</div>

										<?php $this->load->view($content); ?>

									</div>
									<div class="col-lg-6 d-none d-md-inline-block">
										<div class="auth-page-sidebar">
											<div class="overlay"></div>
										</div>
									</div>
								</div>

							</div> <!-- end card-body -->
						</div>
						<!-- end card -->

					</div> <!-- end col -->
				</div>
				<!-- end row -->
			</div>
			<!-- end container -->
		</div>
		<!-- end page -->

		<!-- Vendor js -->
		<script src="/assets/themes/app/js/vendor.min.js"></script>

		<!-- App js -->
		<script src="/assets/themes/app/js/app.min.js"></script>

	</body>
</html>
