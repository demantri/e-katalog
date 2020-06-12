<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.themekita.com/atlantis/livepreview/examples/demo1/login2.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 30 Oct 2019 18:08:54 GMT -->
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Login</title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

  <!-- Fonts and icons -->
  <script src="<?php echo base_url('assets/js/plugin/webfont/webfont.min.js') ?>"></script>
  <script>
    WebFont.load({
      google: {"families":["Lato:300,400,700,900"]},
      custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['<?php echo base_url() ?>assets/css/fonts.min.css']},
      active: function() {
        sessionStorage.fonts = true;
      }
    });
  </script>
  
  <!-- CSS Files -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/atlantis.css">
</head>
<body class="login">
  <div class="wrapper wrapper-login">
    <div class="container container-login animated fadeIn">

      <div class="row">
        <div class="col-md-12">
          <?php echo $this->session->flashdata('alert_message') ?>
        </div>
      </div>

      <h3 class="text-center">LOGIN </h3>

      <form method="POST" action="<?php echo site_url('Auth/login') ?>">
        <div class="login-form">
          <div class="form-group">
            <label for="username" class="placeholder"><b>Username</b></label>
            <input id="username" name="username" type="text" class="form-control" autocomplete="off" placeholder="Username..." required>
          </div>
          <div class="form-group">
            <label for="password" class="placeholder"><b>Password</b></label>
            <div class="position-relative">
              <input id="password" name="password" type="password" class="form-control" autocomplete="off" placeholder="Password..." required>
              <div class="show-password">
                <i class="icon-eye"></i>
              </div>
            </div>
          </div>
          <div class="form-group mb-3 text-center">
            <center>
              <button class="btn btn-primary mt-3 mt-sm-0 fw-bold">Sign In</button>
            </center>
          </div>
        </div>
      </form>
    </div>

  </div>
  <script src="<?php echo base_url() ?>assets/js/core/jquery.3.2.1.min.js"></script>
  <script src="<?php echo base_url() ?>assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
  <script src="<?php echo base_url() ?>assets/js/core/popper.min.js"></script>
  <script src="<?php echo base_url() ?>assets/js/core/bootstrap.min.js"></script>
  <script src="<?php echo base_url() ?>assets/js/atlantis.min.js"></script>
</body>

<!-- Mirrored from demo.themekita.com/atlantis/livepreview/examples/demo1/login2.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 30 Oct 2019 18:08:54 GMT -->
</html>