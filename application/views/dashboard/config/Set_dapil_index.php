<?php 
	$cfg 					= $this->Cfg->get_data();
?>
<ol class="breadcrumb pull-right">
	<li class="breadcrumb-item"><a href="<?php echo base_url('dashboard?p=dashboard');?>">Dashboard</a></li>
	<li class="breadcrumb-item active">Setting Dapil</li>
</ol>
<h3 class="page-header"><?php echo $cfg['sistem'] . ' '. ucwords(strtolower($cfg['desa'])) . ' Kec. '. ucwords(strtolower($cfg['kec']));?></h3>
<div class="panel panel-inverse panel_data">
	<div class="panel-heading">
		<div class="panel-heading-btn">
			<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
		</div>
		<h4 class="panel-title title_panel">Data Dapil</h4>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-12">
				<div id="data_dapil"></div>
			</div>
		</div>
	</div>
</div>