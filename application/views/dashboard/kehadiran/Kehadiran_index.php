<?php 
	$jml_segment 	= $this->uri->total_segments();
	$base_url_int 	= $this->Cfg->int_uri($jml_segment);
	$cfg 			= $this->Cfg->get_data();
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Cek Kehadiran PILKADES</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="<?php echo $base_url_int;?>themes/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
	<link href="<?php echo $base_url_int;?>themes/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?php echo $base_url_int;?>themes/plugins/font-awesome/css/all.min.css" rel="stylesheet" />
	<link href="<?php echo $base_url_int;?>themes/plugins/animate/animate.min.css" rel="stylesheet" />
	<link href="<?php echo $base_url_int;?>themes/css/default/style.min.css" rel="stylesheet" />
	<link href="<?php echo $base_url_int;?>themes/css/default/style-responsive.min.css" rel="stylesheet" />
	<link href="<?php echo $base_url_int;?>themes/css/default/theme/default.css" rel="stylesheet" id="theme" />
	<link href="<?php echo $base_url_int;?>themes/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
	<script src="<?php echo $base_url_int;?>themes/plugins/pace/pace.min.js"></script>
	<style type="text/css">
		.box_no_und {
			padding: 5px;
			border-radius: 5px;
		}
	</style>
</head>
<body class="pace-top">
	<div id="page-loader" class="fade show"><span class="spinner"></span></div>
	<div class="login-cover">
		<div class="login-cover-image" style="background-image: url(<?php echo $base_url_int;?>assets/img/login-bg/login-bg-15.jpg)" data-id="login-cover-image"></div>
		<div class="login-cover-bg"></div>
	</div>
	
	<div id="page-container" class="fade">
		<div class="login login-v2" data-pageload-addclass="animated fadeIn">
			<?php if(isset($dapil)){ ?>
			<div class="login-header">
				<div class="brand">
					<span class="logo"></span> <b>PILKADES</b>  <?php echo strtoupper($dapil->dapil);?>
					<small><?php echo $cfg['sistem'] . ' '. ucwords(strtolower($cfg['desa'])) . ' Kec. '. ucwords(strtolower($cfg['kec']));?></small>
				</div>
				<div class="icon">
					<i class="fa fa-lock"></i>
				</div>
			</div>
			<div class="login-content">
				<form id="form_cek_kehadiran" autocomplete="off" action="<?php echo $base_url_int;?>kehadiran/cek_kehadiran" method="POST" class="margin-bottom-0">
					<div class="form-group m-b-20">
						<input type="text" name="key_search" id="key_search" class="form-control form-control-lg" placeholder="Nomor Undangan" required />
					</div>
					<div class="login-buttons">
						<button type="submit" id="btn_login_form" class="btn btn-success btn-block btn-lg">Cek Data</button>
					</div>
				</form>
				<div id="data_search" class="mt-3"></div>
			
				<div id="list_kehadiran" class="widget-list widget-list-rounded m-b-30 inverse-mode" data-id="widget"  data-scrollbar="true" data-height="160px">
					<?php foreach ($kehadiran->result_array() as $key => $value) {?>
						<a href="javascript:void(0)" class="widget-list-item">
							<div class="widget-list-media icon">
								<span class="bg-inverse text-white bg-grey-darker  box_no_und f-w-600" title="Nomor Undangan" style=""><?php echo str_pad($value['no_urut'], $cfg['dig_no_und'], "0", STR_PAD_LEFT);?></span>
							</div>
							<div class="widget-list-content">
								<h4 class="widget-list-title"><?php echo $value['nama_lengkap'];?></h4>
								<span class="text-muted"><?php echo $value['dusun'] .' RT/RW : '. $value['rt'] .'/'. $value['rw'];?></span>
							</div>
							<?php if($cfg['antri']>0){ ?>
								<div class="widget-list-content">
									<h4 class="widget-list-title" title="Nomor Antri"><?php echo $value['antri'];?></h4>
								</div>
							<?php } ?>
							<div class="widget-list-action text-right">
								<span class="bg-inverse text-white" title="Pukul Hadir"><?php echo DATE_FORMAT(DATE_CREATE($value['datetime_create']),'h:i');?></span>
							</div>
						</a>
						<?php }?>
					</div>
					<div class="d-block text-center mt-3">
						<ul class="list-unstyled">
							<li><a href="<?php echo base_url('dashboard?p=dashboard');?>">Kembali ke Halaman Utama</a></li>
							<li><a href="https://masjum.com" target="_blank">Aplikasi PILKADES dikembangkan oleh masjum.com</a></li>
						</ul>
					</div>
			</div>
			<?php }else { ?>
				<div class="login-header">
					<div class="brand text-center">
						<b>Mohon maaf anda belum punya otoritas ...!</b>
					</div>
				</div>

			<div class="login-content">
				
					<div class="d-block text-center mt-3">
						<ul class="list-unstyled">
							<li><a href="<?php echo base_url('dashboard?p=dashboard');?>">Kembali ke Halaman Utama</a></li>
							<li><a href="https://masjum.com" target="_blank">Aplikasi PILKADES dikembangkan oleh masjum.com</a></li>
						</ul>
					</div>
			</div>
			<?php }?>
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
	<script src="<?php echo $base_url_int;?>themes/plugins/gritter/js/jquery.gritter.js"></script>
	<script src="<?php echo $base_url_int;?>themes/js/theme/default.min.js"></script>
	<script src="<?php echo $base_url_int;?>themes/js/apps.min.js"></script>
	<script src="<?php echo $base_url_int;?>themes/js/demo/login-v2.demo.js"></script>
	<script>
		$(document).ready(function() {
			App.init();
			LoginV2.init();
		});
	</script>
	<script src="<?php echo $base_url_int;?>assets/js/kehadiran.js"></script>
</body>
</html>
