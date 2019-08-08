<?php 
	$jml_segment 	= $this->uri->total_segments();
	$base_url_int 	= $this->Cfg->int_uri($jml_segment);
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>App PILKADES | Halaman Login</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<!--
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	-->
	<link href="<?php echo $base_url_int;?>themes/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
	<link href="<?php echo $base_url_int;?>themes/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?php echo $base_url_int;?>themes/plugins/font-awesome/css/all.min.css" rel="stylesheet" />
	<link href="<?php echo $base_url_int;?>themes/plugins/animate/animate.min.css" rel="stylesheet" />
	<link href="<?php echo $base_url_int;?>themes/css/default/style.min.css" rel="stylesheet" />
	<link href="<?php echo $base_url_int;?>themes/css/default/style-responsive.min.css" rel="stylesheet" />
	<link href="<?php echo $base_url_int;?>themes/css/default/theme/default.css" rel="stylesheet" id="theme" />
	<script src="<?php echo $base_url_int;?>themes/plugins/pace/pace.min.js"></script>
</head>
<body class="pace-top">
	<div id="page-loader" class="fade show"><span class="spinner"></span></div>
	<div class="login-cover">
		<div class="login-cover-image" style="background-image: url(<?php echo $base_url_int;?>assets/img/login-bg/login-bg-14.jpg)" data-id="login-cover-image"></div>
		<div class="login-cover-bg"></div>
	</div>
	
	<div id="page-container" class="fade">
		<div class="login login-v2" data-pageload-addclass="animated fadeIn">
			<div class="login-header">
				<div class="brand">
					<span class="logo"></span> <b>APP</b> PILKADES
					<small>Tertib Administrasi, Menuju PILKADES Sukses</small>
				</div>
				<div class="icon">
					<i class="fa fa-lock"></i>
				</div>
			</div>
			<div class="login-content">
				<form id="form_login" action="<?php echo $base_url_int;?>home/login_validation" method="POST" class="margin-bottom-0">
					<div class="form-group m-b-20">
						<input type="text" name="username" class="form-control form-control-lg" placeholder="Email Address" required />
                        <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" />
					</div>
					<div class="form-group m-b-20">
						<input type="password" name="password" class="form-control form-control-lg" placeholder="Password" required />
					</div>
					<div class="checkbox checkbox-css m-b-20">
						<input type="checkbox" id="remember_checkbox" /> 
						<label for="remember_checkbox">
							Remember Me
						</label>
					</div>
					<div class="login-buttons">
						<button type="submit" id="btn_login_form" class="btn btn-success btn-block btn-lg">Login</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		var base_url = "<?php echo $base_url_int;?>";
	</script>
	
	<script src="<?php echo $base_url_int;?>themes/plugins/jquery/jquery-3.3.1.min.js"></script>
	<script src="<?php echo $base_url_int;?>themes/plugins/jquery-ui/jquery-ui.min.js"></script>
	<script src="<?php echo $base_url_int;?>themes/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?php echo $base_url_int;?>themes/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?php echo $base_url_int;?>themes/plugins/js-cookie/js.cookie.js"></script>
	<script src="<?php echo $base_url_int;?>themes/js/theme/default.min.js"></script>
	<script src="<?php echo $base_url_int;?>themes/js/apps.min.js"></script>
	<script src="<?php echo $base_url_int;?>themes/js/demo/login-v2.demo.js"></script>
	<script>
		$(document).ready(function() {
			App.init();
			LoginV2.init();
		});
	</script>
</body>
</html>
