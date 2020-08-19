<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>MyHC | Login</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="<?php echo base_url();?>assets/favicon.png">
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
					<a href="<?php echo site_url('login'); ?>" class="logo">
						<img src="<?php echo base_url();?>assets/login/img/logo_white.png" height="60" alt="">
					</a>
				</div>
				<div class="login-content">
                    <?php echo form_open(site_url('login/validate_login'), array('enctype' => 'multipart/form-data')); ?>
						<div class="form-group">
							<input type="text" class="input-field" name="nik" placeholder="NIK" required>
						</div>
						<div class="form-group">
                            <input type="password" class="input-field" name="user_password" placeholder="Password" required>
						</div>
						<button type="submit" class="btn btn-primary">Login<i class="fa fa-lock"></i></button>
					<?php echo form_close(); ?>
				</div>
			</div>
			<div class="image-area"></div>
		</div>

        <script src="<?php echo base_url();?>assets/login/js/vendor/jquery-1.12.0.min.js"></script>
        <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap-notify.js"></script>

        <?php if ($this->session->flashdata('error') != '') { ?>

        <script type="text/javascript">
            $.notify({
            // options
            title: '<strong>Error!</strong>',
            message: '<?php echo $this->session->flashdata('error');?>'
            },{
            // settings
            type: 'danger'
            });
        </script>
        <?php } ?>
    </body>
</html>