<?php 
	$akses 			= $this->session->userdata('akses');
?>
<div class="text-center">
	<?php if(isset($akses['adminpilkades'])) { ?>
	<a href="<?php echo base_url('dashboard?p=data_pemilih');?>" class="btn btn-lg btn-primary m-t-5">
		<i class="far fa-lg fa-fw fa-check-square fa-2x pull-left m-r-10"></i>
		<b>Data Pemilih</b><br>
		<small>PILKADES</small>
	</a>
	<a href="<?php echo base_url('dashboard?p=data_hadir');?>" class="btn btn-lg btn-danger m-t-5">
		<i class="fas fa-lg fa-fw fa-chart-bar fa-2x pull-left m-r-10"></i>
		<b>Data Kehadiran</b><br>
		<small>PILKADES</small>
	</a>
	<?php }?>
	<?php if(isset($akses['oprpilkades'])) { ?>
	<a href="<?php echo base_url('kehadiran');?>" class="btn btn-lg btn-warning m-t-5">
		<i class="fas fa-lg fa-fw fa-hand-pointer fa-2x pull-left m-r-10"></i>
		<b>Cek Kehadiran</b><br>
		<small>PILKADES</small>
	</a>
	<?php }?>
</div>
