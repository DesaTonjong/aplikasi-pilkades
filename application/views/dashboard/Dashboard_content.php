<?php 
	$akses 			= $this->session->userdata('akses');
?>
<div class="row justify-content-center p-20">
	<?php if(isset($akses['adminpilkades'])) { ?>
	<a href="<?php echo base_url('dashboard?p=data_pemilih');?>" class="btn btn-lg btn-primary col-lg-3 m-10">
		<i class="far fa-lg fa-fw fa-check-square fa-2x pull-left m-r-10"></i>
		<b>Olah Data Pemilih</b><br>
		<small>PILKADES</small>
	</a>
	<a href="<?php echo base_url('dashboard?p=data_hadir');?>" class="btn btn-lg btn-danger col-lg-3 m-10">
		<i class="fas fa-lg fa-fw fa-chart-bar fa-2x pull-left m-r-10"></i>
		<b>Data Kehadiran</b><br>
		<small>PILKADES</small>
	</a>
	<?php }?>
	<?php if(isset($akses['dapil_khadir'])) { ?>
	<a href="<?php echo base_url('kehadiran');?>" class="btn btn-lg btn-warning  col-lg-3 m-10">
		<i class="fas fa-lg fa-fw fa-hand-pointer fa-2x pull-left m-r-10"></i>
		<b>Cek Kehadiran</b><br>
		<small>PILKADES</small>
	</a>
	<?php }?>
	<?php if(isset($akses['dapil_phitung'])) { ?>
	<a href="<?php echo base_url('dashboard?p=set_hitung');?>" class="btn btn-lg btn-green  col-lg-3 m-10">
		<i class="fa fa-lg fa-fw fa-check-circle fa-2x pull-left m-r-10"></i>
		<b>Penghitungan</b><br>
		<small>PILKADES</small>
	</a>
	<?php }?>
	<a href="<?php echo base_url('penghitungan/show');?>" target="_blank" class="btn btn-lg btn-dark  col-lg-4 m-10">
		<i class="fa fa-lg fa-fw fa-check-circle fa-2x pull-left m-r-10"></i>
		<b>Penghitungan Keseluruhan</b><br>
		<small>PILKADES</small>
	</a>
</div>