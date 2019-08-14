<?php 
	$cfg 			= $this->Cfg->get_data();
	$jml_segment 		= $this->uri->total_segments();
	$base_url_int 		= $this->Cfg->int_uri($jml_segment);
?>
<ol class="breadcrumb pull-right">
	<li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
	<li class="breadcrumb-item active">Data Pemilih</li>
</ol>
<h3 class="page-header"><?php echo $cfg['sistem'] . ' '. ucwords(strtolower($cfg['desa'])) . ' Kec. '. ucwords(strtolower($cfg['kec']));?></h3>
<div class="panel panel-inverse panel_data">
	<div class="panel-heading">
		<div class="panel-heading-btn">
			<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
		</div>
		<h4 class="panel-title title_panel">Data Setting</h4>
	</div>
	<div class="panel-body panel_data_body">
		<div class="row">
			<div class="col-lg-4">
				<div id="data_dapil"></div>
			</div>
			<div class="col-lg-8">
				<div id="data_calon"></div>
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