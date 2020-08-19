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
					<a href="<?php echo site_url('erecruitment/login'); ?>" class="logo">
						<img src="<?php echo base_url();?>assets/login/img/logo_white.png" height="60" alt="">
					</a>
				</div>
				<div class="login-content">
                    <?php echo form_open(site_url('erecruitment/validate_login'), array('enctype' => 'multipart/form-data')); ?>
						<div class="form-group">
							<input type="email" class="input-field" name="candidate_email" placeholder="Email" required>
						</div>
						<div class="form-group">
                            <input type="password" class="input-field" name="candidate_password" placeholder="Password" required>
						</div>
						<button type="submit" class="btn btn-primary">Login<i class="fa fa-lock"></i></button>
					<?php echo form_close(); ?>
                    <div class="login-bottom-links">
						Tidak punya akun?
						<a href="<?php echo site_url('erecruitment/register');?>" class="link">
							Daftar disini
						</a>
					</div>
				</div>
			</div>
			<div class="image-area-candidate"></div>
		</div>

        <script src="<?php echo base_url();?>assets/login/js/vendor/jquery-1.12.0.min.js"></script>
        <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap-notify.js"></script>

        <?php if ($this->session->flashdata('error') != '') { ?>
            <script type="text/javascript">
                $.notify({
                    title: '<strong>Error!</strong>',
                    message: '<?php echo $this->session->flashdata('error');?>'
                },{
                    type: 'danger'
                });
            </script>
        <?php } elseif ($this->session->flashdata('success') != '') { ?>
            <script type="text/javascript">
                $.notify({
                    title: '<strong>Success!</strong>',
                    message: '<?php echo $this->session->flashdata('success');?>'
                },{
                    type: 'success'
                });
            </script>
        <?php } ?>
    </body>
</html>