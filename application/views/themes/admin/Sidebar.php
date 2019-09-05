<?php 
	$cfg 			= $this->Cfg->get_data();
	$jml_segment 	= $this->uri->total_segments();
	$base_url_int 	= $this->Cfg->int_uri($jml_segment);
	$akses 			= $this->session->userdata('akses');
?>
<div id="sidebar" class="sidebar">
	<!-- begin sidebar scrollbar -->
	<div data-scrollbar="true" data-height="100%">
		<!-- begin sidebar user -->
		<ul class="nav">
			<li class="nav-profile">
				<a href="javascript:;" data-toggle="nav-profile">
					<div class="cover with-shadow"></div>
					<div class="image">
						<img src="<?php echo $base_url_int;?>assets/img/user/user-13.jpg" alt="" />
					</div>
					<div class="info">
						<b class="caret pull-right"></b>
						<?php echo ucwords(strtolower($cfg['desa']));?>
						<small><?php echo ucwords(strtolower($cfg['kec'])) . '-' .ucwords(strtolower($cfg['kab_kota']));?></small>
					</div>
				</a>
			</li>
			<?php if(isset($akses['adminpilkades'])) { ?>
			<li>
				<ul class="nav nav-profile">
					<li><a href="#ModalConfig" data-toggle="modal" onclick="get_config()"><i class="fa fa-cog"></i> Settings</a></li>
					<li><a href="#ModalConfig" data-toggle="modal" onclick="get_user_oper()" ><i class="fa fa-user"></i> User Operator</a></li>
					<li><a href="<?php echo $base_url_int. 'dashboard?p=set_dapil';?>"><i class="fa fa-user"></i> Setting Dapil</a></li>
					<li><a href="<?php echo $base_url_int. 'dashboard?p=set_cakades';?>"><i class="fa fa-users"></i> Setting Cakades</a></li>
					<!--
						<li><a href="javascript:;"><i class="fa fa-question-circle"></i> Helps</a></li>
					-->
				</ul>
			</li>
		<?php }?>
		</ul>
		<!-- end sidebar user -->
		<!-- begin sidebar nav -->
		<ul class="nav">
			<li class="nav-header">Navigasi</li>
			<li class="has-sub <?php if($aktif=='dashboard'){ echo 'active';}?>">
				<a href="<?php echo $base_url_int.'dashboard?p=dashboard';?>">
					<i class="fa fa-th-large"></i>
					<span>Dashboard</span>
				</a>
			</li>
			<li class="has-sub <?php if($aktif=='panitia' || $aktif=='kegiatan'){ echo 'active';}?>">
				<a href="javascript:;">
					<b class="caret"></b>
					<i class="fa fa-globe" aria-hidden="true"></i>
					<span>Frontend</span>
				</a>
				<ul class="sub-menu">
					<?php if(isset($akses['adminpilkades'])) { ?>
						<li class=" <?php if($aktif=='panitia'){ echo 'active';}?>"><a href="<?php echo $base_url_int. 'dashboard?p=panitia';?>">Data Panitia</a></li>
					<?php } ?>
					<?php if(isset($akses['adminpilkades'])) { ?>
						<li class=" <?php if($aktif=='kegiatan'){ echo 'active';}?>"><a href="<?php echo $base_url_int. 'dashboard?p=kegiatan';?>">Dokumentasi Kegiatan</a></li>
					<?php } ?>
				</ul>
			</li>
			<li class="has-sub <?php if($aktif=='data_pemilih' || $aktif=='set_hitung' || $aktif=='cek_hadir' || $aktif=='data_hadir'){ echo 'active';}?>">
				<a href="javascript:;">
					<b class="caret"></b>
					<i class="fa fa-chart-pie"></i>
					<span>PILKADES</span>
				</a>
				<ul class="sub-menu">
					<?php if(isset($akses['adminpilkades'])) { ?>
						<li class=" <?php if($aktif=='data_pemilih'){ echo 'active';}?>"><a href="<?php echo $base_url_int. 'dashboard?p=data_pemilih';?>">Data Pemilih</a></li>
					<?php } ?>
					<?php if(isset($akses['adminpilkades'])) { ?>
						<li class=" <?php if($aktif=='data_hadir'){ echo 'active';}?>"><a href="<?php echo $base_url_int. 'dashboard?p=data_hadir';?>">Data Kehadiran</a></li>
					<?php } ?>
					<?php if(isset($akses['opr_pilkades'])) { ?>
					<li class=" <?php if($aktif=='cek_hadir'){ echo 'active';}?>"><a href="<?php echo $base_url_int.'kehadiran';?>">Cek Kehadiran</a></li>
					<?php } ?>
					<?php if(isset($akses['dapil_phitung'])) { ?>
					<li class=" <?php if($aktif=='set_hitung'){ echo 'active';}?>"><a href="<?php echo $base_url_int.'dashboard?p=set_hitung';?>">Penghitungan</a></li>
					<?php } ?>
				</ul>
			</li>
			
			<!-- begin sidebar minify button -->
			<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
			<!-- end sidebar minify button -->
		</ul>
		<!-- end sidebar nav -->
	</div>
	<!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>
<!-- end #sidebar -->