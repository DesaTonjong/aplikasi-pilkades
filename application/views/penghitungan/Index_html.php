<?php
	$get 			= $this->Query->select_where('config', array('*'), array(),0,1,'id ASC')->row();
	$desa 		= $get->desa;
	$kec 			= $get->kec;
	$kabkot 		= $get->kabkot;
	$sis_pem 	= $get->sis_pem;
	$sis_kabkot = $get->sis_kabkot;
	$logo_kab 	= $get->logo_kab;
	$logo_fav 	= $get->logo_fav;
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
<meta charset="utf-8" />
<title>PEMDES | <?php echo $desa;?></title>
<meta name="description" content="Web Informasi Pilkades PILKADES <?php echo $sis_pem . ' '. $desa . ' Kecamatan '. $kec . ' '. $sis_kabkot . $kabkot;?>">

<!-- Google / Search Engine Tags -->
<meta itemprop="name" content="PEMDES | <?php echo $desa;?>">
<meta itemprop="description" content="Web Informasi PILKADES <?php echo $sis_pem . ' '. $desa . ' Kecamatan '. $kec . ' '. $sis_kabkot . $kabkot;?>">
<meta itemprop="image" content="<?php echo base_url();?>assets/img/kegiatan/400/02029138-5e62-40b9-bdca-97cefed55e8c.jpg">

<!-- Facebook Meta Tags -->
<meta property="og:url" content="<?php echo base_url('home');?>">
<meta property="og:type" content="website">
<meta property="og:title" content="PEMDES | <?php echo $desa;?>">
<meta property="og:description" content="Web Informasi PILKADES <?php echo $sis_pem . ' '. $desa . ' Kecamatan '. $kec . ' '. $sis_kabkot . $kabkot;?>">
<meta property="og:image" content="<?php echo base_url();?>assets/img/kegiatan/400/02029138-5e62-40b9-bdca-97cefed55e8c.jpg">

<!-- Twitter Meta Tags -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="PEMDES | <?php echo $desa;?>">
<meta name="twitter:description" content="Web Informasi PILKADES <?php echo $sis_pem . ' '. $desa . ' Kecamatan '. $kec . ' '. $sis_kabkot . $kabkot;?>">
<meta name="twitter:image" content="<?php echo base_url();?>assets/img/kegiatan/400/02029138-5e62-40b9-bdca-97cefed55e8c.jpg">
	
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
<link href="<?php echo base_url();?>themes/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link href="<?php echo base_url();?>themes/plugins/font-awesome/css/all.min.css" rel="stylesheet" />
<link href="<?php echo base_url();?>themes/plugins/animate/animate.min.css" rel="stylesheet" />
<link href="<?php echo base_url();?>themes/plugins/fancybox-master/dist/jquery.fancybox.min.css" rel="stylesheet" />
<link href="<?php echo base_url();?>themes/frontend/css/one-page-parallax/style.min.css" rel="stylesheet" />
<link href="<?php echo base_url();?>themes/frontend/css/one-page-parallax/style-responsive.min.css" rel="stylesheet" />
<link href="<?php echo base_url();?>themes/frontend/css/one-page-parallax/theme/default.css" id="theme" rel="stylesheet" />
<link rel="icon" type="image/png" href="<?php echo base_url('assets/img/logo/'.$logo_fav);?>">

<script src="<?php echo base_url();?>themes/frontend/plugins/pace/pace.min.js"></script>
</head>
<body data-spy="scroll" data-target="#header" data-offset="51">
	<div id="page-container" class="fade">
		<div id="header" class="header navbar navbar-inverse navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="<?php echo base_url('home');?>" class="navbar-brand">
						<span class="brand-logo"></span>
						<span class="brand-text">
							<span class="text-theme">PEMDES</span> <?php echo $desa;?>
						</span>
					</a>
				</div>
				<div class="collapse navbar-collapse" id="header-navbar">
					<ul class="nav navbar-nav navbar-right">
						<li class="nav-item dropdown">
							<a class="nav-link active" href="#home" data-click="scroll-to-target" data-scroll-target="<?php echo base_url();?>#home">HOME</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		
      <div id="perangkat" class="content bg-dark-lighter m-t-30" data-scrollview="true">
			<div class="container">
				<h2 class="content-title">Hasil Proses Penghitungan, <?php echo $sis_pem . ' '. $desa;?></h2>
				<div class="row d-flex justify-content-center">
            <?php 
               $get_dapil = $this->Query->select_where('pilkades_dapil', array('*'), array(),0,20, 'uid ASC')->result_array();
               foreach ($calon->result_array() as $key => $value) { 
            ?>
               <div class="col-lg-3 col-md-6 col-sm-12">
						<!-- begin team -->
						<div class="team rounded p-0 m-t-20 bg-dark text-white">
                     <div class="p-20">
                     <div class="title text-white f-s-18 f-w-700"><?php echo $value['nomor'];?></div>
                     <img src="<?php echo base_url('assets/img/user/c'. $value['nomor'] .'.png');?>" width="100px" alt="Ryan Teller">
                     </div>
                     <h4 class="name f-s-16 f-w-700 text-truncate bg-black text-white p-20"><?php echo strtoupper($value['nama_calon']);?></h4>
                  </div>
                     <div class="info rounded m-t-10 bg-black-transparent-5 p-10">
                        <div class="skills">
                        <?php foreach ($get_dapil as $ky => $row) { ?>
                           <div class="skills-name text-white text-center"><?php echo $row['dapil'];?></div>
                           <div class="progress mb-3">
                              <div id="result<?php echo $value['id'].$row['id'];?>" class="progress-bar progress-bar-striped progress-bar-animated bg-theme">
                                 <span id="rest<?php echo $value['id'].$row['id'];?>" class="progress-number bg-teal-transparent-5 d-none">0%</span>
                              </div>
                           </div>
                        <?php } ?>
                        </div>
								<div class="social">
									
								</div>
							</div>
						<!-- end team -->
					</div>
            <?php } ?>
            </div>
			</div>
		</div>
		<div id="footer" class="footer">
			<div class="container">
				<div class="footer-brand">
					<div class=""><img src="<?php echo base_url('assets/img/logo/'.$logo_kab);?>"  alt="icon-kabupaten-<?php echo strtolower($kabkot);?>" width="80px"></div>
					<?php echo $sis_pem . ' '. $desa;?>
				</div>
				<p>
					&copy; Copyright PEMDES <?php echo $sis_pem . ' '. $desa;?>
				</p>
				<p class="social-list">
					<a href="#"><i class="fab fa-facebook-f fa-fw"></i></a>
					<a href="#"><i class="fab fa-instagram fa-fw"></i></a>
					<a href="#"><i class="fab fa-twitter fa-fw"></i></a>
					<a href="#"><i class="fab fa-youtube fa-fw"></i></a>
				</p>
			</div>
		</div>
		
	</div>
	
	<script src="<?php echo base_url();?>themes/plugins/jquery/jquery-3.3.1.min.js"></script>
	<script src="<?php echo base_url();?>themes/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?php echo base_url();?>themes/plugins/js-cookie/js.cookie.js"></script>
	<script src="<?php echo base_url();?>themes/plugins/scrollMonitor/scrollMonitor.js"></script>
	<script src="<?php echo base_url();?>themes/plugins/paroller/jquery.paroller.min.js"></script>
	<script src="<?php echo base_url();?>themes/plugins/fancybox-master/dist/jquery.fancybox.min.js"></script>
	<script src="<?php echo base_url();?>themes/frontend/js/one-page-parallax/apps.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/jquery.number.js"></script>
	<script>    
		$(document).ready(function() {
			App.init();
		});
	</script>
	<script src="<?php echo base_url('assets/js/d_hitung.js');?>"></script>
</body>
</html>
