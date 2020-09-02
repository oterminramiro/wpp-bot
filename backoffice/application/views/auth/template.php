<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Argon Dashboard PRO - Premium Bootstrap 4 Admin Template</title>
  <!-- Favicon -->
  <link rel="icon" href="/assets/themes/app/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="/assets/themes/app/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="/assets/themes/app/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="/assets/themes/app/css/argon.css?v=1.2.0" type="text/css">
</head>

<body class="bg-default">
  <!-- Navbar -->

  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h1 class="text-white"><?php echo $this->lang->line('app_auth_title_welcome') ?></h1>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary border-0 mb-0">
            <div class="card-body px-lg-5 py-lg-5">
				<?php $this->load->view($content); ?>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
              <a href="/auth/forgot_password" class="text-light"><small><?php echo $this->lang->line('app_auth_login_forget') ?></small></a>
            </div>
            <div class="col-6 text-right">
              <a href="/auth/register" class="text-light"><small><?php echo $this->lang->line('app_auth_create_account') ?></small></a>
            </div>
          </div>
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
  <!-- Argon JS -->
  <script src="/assets/themes/app/js/argon.js?v=1.2.0"></script>
  <!-- Demo JS - remove this in your project -->
  <script src="/assets/themes/app/js/demo.min.js"></script>
</body>

</html>
