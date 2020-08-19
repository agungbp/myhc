<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>MyHC | Lupa Password</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="shortcut icon" href="<?php echo base_url();?>assets/login/img/favicon.png">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/login/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/login/css/normalize.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/login/css/main.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/login/css/style.css">
        <script src="<?php echo base_url();?>assets/login/js/vendor/modernizr-2.8.3.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
    </head>
    <body>
		<div class="main-content-wrapper">
			<div class="login-area">
				<div class="login-header">
					<a href="<?php echo site_url('login');?>" class="logo">
						<img src="<?php echo base_url();?>assets/login_page/img/logo_white.png" height="60" alt="">
					</a>
				</div>
				<div class="login-content">
					<form method="post" role="form" id="form_login" action="<?php echo site_url('login/reset_password');?>">
						<div class="form-group">
							<input type="email" class="input-field" name="nik" placeholder="Email" required autocomplete="off">
						</div>
						<button type="submit" class="btn btn-primary">Reset Password<i class="fa fa-unlock"></i></button>
					</form>
					<div class="login-bottom-links">
						<a href="<?php echo site_url('login');?>" class="link"><i class="fa fa-lock"></i>Kembali ke halaman login</a>
					</div>
				</div>
			</div>
			<div class="image-area forgot-pass"></div>
		</div>

    <script src="<?php echo base_url();?>assets/login_page/js/vendor/jquery-1.12.0.min.js"></script>
    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap-notify.js"></script>

    <?php if ($this->session->flashdata('reset_error') != '') { ?>
      <script type="text/javascript">
        $.notify({
          // options
          title: '<strong>Error!</strong>',
          message: '<?php echo $this->session->flashdata('reset_error');?>'
          },{
          // settings
          type: 'danger'
        });
      </script>
    <?php } ?>
    <?php if ($this->session->flashdata('reset_success') != '') { ?>
      <script type="text/javascript">
        $.notify({
          // options
          title: '<strong>Sukses!</strong>',
          message: '<?php echo $this->session->flashdata('reset_success');?>'
          },{
          // settings
          type: 'success'
        });
      </script>
    <?php } ?>

    </body>
</html>
