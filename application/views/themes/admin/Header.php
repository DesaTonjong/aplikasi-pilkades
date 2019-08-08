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
	<title><?php echo $title;?></title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="<?php echo $base_url_int;?>themes/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
	<link href="<?php echo $base_url_int;?>themes/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?php echo $base_url_int;?>themes/plugins/font-awesome/css/all.min.css" rel="stylesheet" />
	<link href="<?php echo $base_url_int;?>themes/plugins/animate/animate.min.css" rel="stylesheet" />
	<link href="<?php echo $base_url_int;?>themes/css/default/style.min.css" rel="stylesheet" />
	<link href="<?php echo $base_url_int;?>themes/css/default/style-responsive.min.css" rel="stylesheet" />
	<link href="<?php echo $base_url_int;?>themes/css/default/theme/default.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
	<link href="<?php echo $base_url_int;?>themes/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
	<link href="<?php echo $base_url_int;?>themes/plugins/nvd3/build/nv.d3.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>themes/plugins/sweetalert/sweetalert2.min.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?php echo $base_url_int;?>themes/plugins/pace/pace.min.js"></script>
	<link href="<?php echo $base_url_int;?>themes/plugins/isotope/isotope.css" rel="stylesheet" />
	<link href="<?php echo $base_url_int;?>themes/plugins/lightbox/css/lightbox.css" rel="stylesheet" />
	<!-- ================== END BASE JS ================== -->

	<?php if(isset($dropzone_css)){  ?>
		<link href="<?php echo $base_url_int. $dropzone_css;?>" rel="stylesheet" />
	<?php } ?>
</head>
<body>