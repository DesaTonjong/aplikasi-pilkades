<?php 
	$cfg 			= $this->Cfg->get_data();
	$jml_segment 	= $this->uri->total_segments();
	$base_url_int 	= $this->Cfg->int_uri($jml_segment);
?>
<style type="text/css">
	.auto_center{
		margin-top: 10%;
	}
	.panel_data_body{
		min-height: 85vh; 
		background-image: url(<?php echo $base_url_int.'assets/img/login-bg/login-bg-14.jpg';?>);
	  	background-color: #cccccc; /* Used if the image is unavailable */
		background-position: center; /* Center the image */
		background-repeat: no-repeat; /* Do not repeat the image */
		background-size: cover; /* Resize the background image to cover the entire container */
	}
	.form_cek_kehadiran{
		margin-top: 20%;
	}
</style>
<ol class="breadcrumb pull-right">
	<li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
	<li class="breadcrumb-item active">Absensi Kehadiran Pemilih</li>
</ol>
<h4 class="page-header"><?php echo $cfg['sistem'] . ' '. ucwords(strtolower($cfg['desa'])) . ' Kec. '. ucwords(strtolower($cfg['kec']));?></h4>
<div class="panel panel-inverse panel_data">
	<div class="panel-heading">
		<div class="panel-heading-btn">
			<a href="<?php echo base_url('kehadiran');?>" class="btn btn-xs btn-icon btn-circle btn-default"><i class="fa fa-expand"></i></a>
			<a href="#ModalConfig" class="btn btn-xs btn-icon btn-circle btn-default" data-toggle="modal" onclick="get_data_kehadiran(0)"><i class="fas fa-newspaper"></i></a>
		</div>
		<h4 class="panel-title">Absensi Kehadiran Pemilih  </h4>
	</div>
	<div class="panel-body panel_data_body">
			<div class="col-md-6 offset-md-3">
				<form id="form_cek_kehadiran" class="form_cek_kehadiran" autocomplete="off" action="<?php echo $base_url_int.'kehadiran/cek_kehadiran';?>" method="POST">
					<div class="text-center mb-3">
						<h3 class="mb-0"><b>SISTEM APLIKASI PILKADES</b></h3>
						<span class="text-inverse mt-0"><b><?php echo $cfg['sistem'] . ' '. ucwords(strtolower($cfg['desa'])) . ' Kec. '. ucwords(strtolower($cfg['kec']));?></b></span>
					</div>
					<div class="input-append input-group">
						<input class="form-control form-control-lg" name="key_search" id="key_search" type="text" placeholder="Nomor Undangan">
						<button type="submit" class="btn btn-default "><i class="fa fa-search"></i></button>
					</div>
				</form>
				<div id="data_search" class="mt-3"></div>
			</div>
	</div>
</div>