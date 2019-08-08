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
							<a class="nav-link active" href="#home" data-click="scroll-to-target" data-scroll-target="#home">HOME</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link" href="#pilkades" data-click="scroll-to-target" data-scroll-target="#pilkades" data-toggle="dropdown">PILKADES <b class="caret"></b></a>
							<div class="dropdown-menu dropdown-menu-left animated fadeInDown">
								<a class="dropdown-item" href="#sk_panitia">SK Panitia</a>
								<!-- <a class="dropdown-item" href="#tatib">Tatib Pilkades</a> -->
								<a class="dropdown-item" href="#kegiatan">Photo Kegiatan Pilkades</a>
								<a class="dropdown-item" href="#cek_pemilih">Cek Data Pemilih</a>
							</div>
						</li>
						<li class="nav-item"><a class="nav-link" href="#perangkat" data-click="scroll-to-target">Perangkat Desa</a></li>
						<li class="nav-item"><a class="nav-link" href="#bpd" data-click="scroll-to-target">BPD</a></li>
						<li class="nav-item"><a class="nav-link" href="" data-click="scroll-to-target"></a></li>
						<li class="nav-item"><a class="nav-link" href="<?php echo base_url('home/login');?>">Login</a></li>
					</ul>
				</div>
			</div>
		</div>
		
		<div id="home" class="content has-bg home">
			<div class="content-bg" style="background-image: url(<?php echo base_url();?>/themes/frontend/img/bg/bg-home.jpg);" 
				data-paroller="true" 
				data-paroller-factor="0.5"
				data-paroller-factor-xs="0.25">
			</div>
			<div class="container home-content" style="top: 40%;">
				<img src="<?php echo base_url('assets/img/logo/'.$logo_kab);?>" width="150px" alt="logo-kabupaten-<?php echo strtolower($kabkot);?>" >
				<h1>Selamat Datang</h1>
				<h3>Web Informasi PILKADES <?php echo $sis_pem . ' '. $desa;?></h3>
				<p>
					<?php echo 'Kecamatan '. $kec . ' - ' .$sis_kabkot . ' '. $kabkot;?><br />
				</p>
			</div>
		</div>

		<div id="perangkat" class="content bg-silver-lighter" data-scrollview="true">
			<div class="container">
				<h2 class="content-title">Perangkat Desa, <?php echo $sis_pem . ' '. $desa;?></h2>
				<div class="row">
					<?php 
						$data = $this->Query->select_where_join2('data_panitia', 'data_panitia_jab', 
											'data_panitia_jab.id=data_panitia.id_jab',
											array('data_panitia.*', 'data_panitia_jab.jab'),
											array('id_jab'=>2), 0, 100, 'data_panitia.sort, data_panitia.id ASC'
											);
						foreach ($data->result_array() as $key => $value) {
					?>
						<div class="col-md-4 col-sm-12">
							<div class="team p-l-10 p-r-10">
								<div class="image" data-animation="true" data-animation-type="flipInX">
									<img src="../assets/img/photo/128/<?php echo $value['photo'];?>" alt="<?php echo $value['nama'];?>" />
								</div>
								<div class="info">
									<h3 class="name m-b-0"><?php echo $value['nama'];?></h3>
									<div class="title text-theme"><?php echo $value['ket'];?></div>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<div id="bpd" class="content" data-scrollview="true">
			<div class="container">
				<h2 class="content-title">BPD <?php echo $sis_pem . ' '. $desa;?></h2>
				<div class="row">
					<?php 
						$data = $this->Query->select_where_join2('data_panitia', 'data_panitia_jab', 
											'data_panitia_jab.id=data_panitia.id_jab',
											array('data_panitia.*', 'data_panitia_jab.jab'),
											array('id_jab'=>1), 0, 100, 'data_panitia.sort, data_panitia.id ASC'
											);
						foreach ($data->result_array() as $key => $value) {
					?>
						<div class="col-md-4 col-sm-12">
							<div class="team p-l-10 p-r-10">
								<div class="image" data-animation="true" data-animation-type="flipInX">
									<img src="../assets/img/photo/128/<?php echo $value['photo'];?>" alt="<?php echo $value['nama'];?>" />
								</div>
								<div class="info">
									<h3 class="name m-b-0"><?php echo $value['nama'];?></h3>
									<div class="title text-theme"><?php echo $value['ket'];?></div>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>

		<div id="sk_panitia" class="content bg-silver-lighter" data-scrollview="true">
			<div class="container">
				<h2 class="content-title">Panitia PILKADES <?php echo $sis_pem . ' '. $desa;?></h2>
				<p class="content-desc">
					SK Nomor : 188/1/35.09.08.2011/BPD/2019
				</p>
				<div class="row">
					<?php 
						$data = $this->Query->select_where_join2('data_panitia', 'data_panitia_jab', 
											'data_panitia_jab.id=data_panitia.id_jab',
											array('data_panitia.*', 'data_panitia_jab.jab'),
											array('id_jab'=>3), 0, 100, 'data_panitia.sort, data_panitia.id ASC'
											);
						foreach ($data->result_array() as $key => $value) {
					?>
						<div class="col-md-4 col-sm-12">
							<div class="team p-l-10 p-r-10">
								<div class="image" data-animation="true" data-animation-type="flipInX">
									<img src="../assets/img/photo/128/<?php echo $value['photo'];?>" alt="<?php echo $value['nama'];?>" />
								</div>
								<div class="info">
									<h3 class="name m-b-0"><?php echo $value['nama'];?></h3>
									<div class="title text-theme"><?php echo $value['ket'];?></div>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<div id="gastarlih" class="content" data-scrollview="true">
			<div class="container">
				<h2 class="content-title">Petugas Pendaftaran Pemilih</h2>
				<div class="row">
						<?php 
							$data = $this->Query->select_where_join2('data_panitia', 'data_panitia_jab', 
												'data_panitia_jab.id=data_panitia.id_jab',
												array('data_panitia.*', 'data_panitia_jab.jab'),
												array('id_jab'=>4), 0, 100, 'data_panitia.sort, data_panitia.ket, data_panitia.nama ASC'
												);
							foreach ($data->result_array() as $key => $value) {
						?>
					<div class="col-md-3 col-sm-12">
						<div class="team p-l-10 p-r-10">
							<div class="image" data-animation="true" data-animation-type="flipInX">
								<img src="../assets/img/photo/128/<?php echo $value['photo'];?>" alt="<?php echo $value['nama'];?>" />
							</div>
							<div class="info">
								<h3 class="name m-b-0"><?php echo $value['nama'];?></h3>
								<div class="title text-theme">Gastarlih <?php echo $value['ket'];?></div>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
		<div id="bumdes" class="content" data-scrollview="true">
			<div class="container">
				<h2 class="content-title">TIM BUMDES GUNUNG MULIA, <?php echo $sis_pem . ' '. $desa;?></h2>
				<div class="row">
						<?php 
							$data = $this->Query->select_where_join2('data_panitia', 'data_panitia_jab', 
												'data_panitia_jab.id=data_panitia.id_jab',
												array('data_panitia.*', 'data_panitia_jab.jab'),
												array('id_jab'=>5), 0, 100, 'data_panitia.sort, data_panitia.ket, data_panitia.nama ASC'
												);
							foreach ($data->result_array() as $key => $value) {
						?>
					<div class="col-md-3 col-sm-12">
						<div class="team p-l-10 p-r-10">
							<div class="image" data-animation="true" data-animation-type="flipInX">
								<img src="../assets/img/photo/128/<?php echo $value['photo'];?>" alt="<?php echo $value['nama'];?>" />
							</div>
							<div class="info">
								<h3 class="name m-b-0"><?php echo $value['nama'];?></h3>
								<div class="title text-theme"><?php echo $value['ket'];?></div>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>

		<div id="cek_pemilih" class="content bg-silver-lighter" data-scrollview="true">
			<!-- begin container -->
			<div class="container">
				<h2 class="content-title">Cek Data Pemilih</h2>
				<p class="content-desc">
					Pastikan anda terdaftar sebagai pemilih, isikan NIK KTP dan ENTER
				</p>
				<div class="row">
					<div class="col-md-4 form-col" data-animation="true" data-animation-type="fadeInRight">
						<form id="form_cek" autocomplete="off" action="<?php echo base_url('home/cek_pemilih');?>" class="form-horizontal" method="POST">
							<div class="form-group row m-b-15">
								<label class="col-form-label col-md-3 text-md-right">NIK <span class="text-theme">*</span></label>
								<div class="col-md-9">
									<input type="text" class="form-control form-control-lg" placeholder="NIK KTP" name="nik_ktp" />
								</div>
							</div>
							<div id="data_cecker"></div>
							<div class="form-group row m-b-15">
								<label class="col-form-label col-md-3 text-md-right"></label>
								<div class="col-md-9 text-left">
									<button id="btn_form" type="submit" class="btn btn-theme btn-block">Cek Data</button>
								</div>
							</div>
						</form>
					</div>
					<div class="col-md-8" data-animation="true" data-animation-type="fadeInLeft">
						<h3><b>Data Pemilih Sementara PILKADES 2019</b></h3>
						<table class="table">
							<thead>
								<tr>
									<td><b>NO</b></td>
									<td><b>DUSUN</b></td>
									<td class="text-right"><b>LAKI-LAKI</b></td>
									<td class="text-right"><b>PEREMPUAN</b></td>
									<td class="text-right"><b>JUMLAH</b></td>
								</tr>
							</thead>
							<tbody>
								<?php 
									$rkp 	= $this->Query->select_where_join2_group_by('data_pemilih', 'dusun', 'dusun.uid=data_pemilih.id_dusun',
																	array('dusun.dusun',
		                                        	'SUM(IF(data_pemilih.lp=1,1,0)) as jml_lk',
		                                        	'SUM(IF(data_pemilih.lp=2,1,0)) as jml_pr',
		                                        	'COUNT(data_pemilih.id) as jumlah',),
																	array('dusun.dusun'),
																	array(),0,30, 'dusun.uid ASC'
																);
									$i=1;	$tot_p=0;$tot_l=0;$total=0;
									foreach ($rkp->result_array() as $key => $value) { ?>
								<tr>
									<td><?php echo $i;?></td>
									<td><?php echo $value['dusun'];?></td>
									<td class="text-right"><?php echo number_format($value['jml_lk']);?></td>
									<td class="text-right"><?php echo number_format($value['jml_pr']);?></td>
									<td class="text-right"><?php echo number_format($value['jumlah']);?></td>
								</tr>
							<?php 
								$tot_p +=$value['jml_pr'];
								$tot_l +=$value['jml_lk'];
								$total +=$value['jumlah'];
								$i++; 
							} ?>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="2" class="text-right"><b>TOTAL</td>
									<td class="text-right"><b><?php echo number_format($tot_l);?></b></td>
									<td class="text-right"><b><?php echo number_format($tot_p);?></b></td>
									<td class="text-right"><b><?php echo number_format($total);?></b></td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div id="video" class="content" data-scrollview="true">
			<div class="container" data-animation="true" data-animation-type="fadeInDown">
				<div class="row text-center">
					<?php 
						$get = $this->Query->select_where('berkas', array('*'),array(), 0,10, 'title ASC');
						foreach ($get->result_array() as $key => $value) {
					?>
					<div class="col-md-3" data-animation="true" data-animation-type="fadeInRight">
						<a href="<?php echo base_url('assets/berkas/'.$value['filename']);?> ">
							<i class="fa fa-file-pdf fa-10x"></i>
							<p class="m-t-10"><?php echo $value['title'];?></p>
						</a>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<div id="video" class="content" data-scrollview="true">
			<div class="container" data-animation="true" data-animation-type="fadeInDown">
				<div class="row">
					<div class="col-md-6 form-col" data-animation="true" data-animation-type="fadeInRight">
						<iframe width="460" height="315" src="https://www.youtube.com/embed/iqQxob-euU0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</div>

					<div class="col-md-6 form-col" data-animation="true" data-animation-type="fadeInRight">
						<iframe width="460" height="315" src="https://www.youtube.com/embed/9pHn2VSDI_Q" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</div>
				</div>
			</div>
		</div>

		<div id="kegiatan" class="content" data-scrollview="true">
			<div class="container" data-animation="true" data-animation-type="fadeInDown">
				<h2 class="content-title">Dokumentasi Photo Kegiatan Pilkades</h2>
				<p class="content-desc">
					Dokumentasi Kegiatan Tahapan Pilkades 2019
				</p>
				<div class="row row-space-10">
					<?php 
						$get 	= $this->Query->select_where('pilkades_kegiatan', array('*'), array(), 0, 36, 'id DESC');
						foreach ($get->result_array() as $key => $value) { ?>
							<div class="col-md-4 col-sm-6">
								<div class="work">
									<div class="image">
										<a href="<?php echo base_url('../assets/img/kegiatan/800/'. $value['filename']);?>" data-fancybox="gallery"><img src="<?php echo base_url('../assets/img/kegiatan/400/'. $value['filename']);?>" alt="<?php echo $value['title'];?>" /></a>
									</div>
									<div class="desc">
										<span class="desc-title"><?php echo $value['title'];?></span>
										<span class="desc-text"><?php echo $value['keterangan'];?></span>
									</div>
								</div>
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
	<script>    
		$(document).ready(function() {
			App.init();
		});
	</script>
	<script type="text/javascript">
		$(document).on('submit', '#form_cek', function(e){
			var form = $("#form_cek");
			var btn = $("#btn_form");

		    $("#data_cecker").empty();
		    btn.html('<i class="fa fa-spinner fa-spin text-center"></i>');
		    btn.attr('disabled', true);
			e.preventDefault();
			$.post(form.attr('action'), form.serialize(), function(json){
				if(json.sts==true){
					$("#data_cecker").html(json.data);
				}else{
					$("#data_cecker").html(json.msg);
				}

	        btn.removeAttr('disabled');

				btn.html('Cek Data');
			},'json');
			return false;
		});
	</script>
</body>
</html>
