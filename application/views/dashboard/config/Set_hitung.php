<style>
#tally {
    cursor: pointer;
    width:100%; height:auto;
}
</style>
<?php 
	$cfg 					= $this->Cfg->get_data();
	$jml_segment 		= $this->uri->total_segments();
	$base_url_int 		= $this->Cfg->int_uri($jml_segment);
	$sesi 				= $this->session->userdata('akses')['dapil_phitung'];
	$now_print 			= $this->Set->now_print();
	if(isset($sesi)) {
		$id_dapil 			= $sesi['id'];
		$unix_id 		= strtotime($now_print) . $id_dapil . $this->Set->generateNumber(3);
?>
<ol class="breadcrumb pull-right">
	<li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
	<li class="breadcrumb-item active">Input Penghitungan</li>
</ol>
<h3 class="page-header"><?php echo $cfg['sistem'] . ' '. ucwords(strtolower($cfg['desa'])) . ' Kec. '. ucwords(strtolower($cfg['kec']));?></h3>
<div class="panel panel-inverse panel_data">
	<div class="panel-heading">
		<div class="panel-heading-btn">
			<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" onclick="get_data()"><i class="fa fa-redo"></i></a>
			<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
		</div>
		<h4 class="panel-title title_panel">Penghitungan Dapil <?php echo $sesi['uid'];?></h4>
	</div>
	<div class="panel-body panel_data_body">
			<!-- <div id="tally"></div> -->
			 <?php 
				//  echo '<pre>';
				// print_r($this->session->userdata());
				//  echo '</pre>';
			?>		
		<div class="row">
			<div class="col-lg-3">
				<form id="form_post" autocomplete="off" action="<?php echo base_url('hitung_manual/post_entry');?>" method="POST">
					<div class="form-group">
						<label>Nomor Calon</label>
						<div class="input-group">
						<input type="text" name="no_calon" id="no_calon" class="form-control">
						<input type="hidden" name="unix_id" id="unix_id" class="form-control" value="<?php echo $unix_id;?>">
						<button class="btn btn-primary" id="btn_add_post">Simpan</button>
						</div>
					</div>
					<span id="alert_msg"></span>
				</form>
				<div data-scrollbar="true" data-height="350px">
					<div id="list_entry" class="widget-list widget-list-rounded inverse-mode">
					</div>
				</div>
			</div>
			<div class="col-lg-9">
				<a href="<?php echo base_url('penghitungan/show');?>" class="pull-right" target="_blank">Penghitungan Keseluruhan <i class="fa fa-md fa-angle-double-right"></i></a><div class="clearfix"></div>
				<div id="data_perolehan" class="m-t-10"></div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="ModalForm">
    <div class="modal-dialog modal-lg modal-dialog-centered">
    	<div class="modal-content">		 
			<div id="data_content"></div>
		</div>		
  </div>
</div>
	<?php } ?>