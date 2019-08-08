<?php 
	$cfg 					= $this->Cfg->get_data();
	$jml_segment 		= $this->uri->total_segments();
	$base_url_int 		= $this->Cfg->int_uri($jml_segment);
?>
<ol class="breadcrumb pull-right">
	<li class="breadcrumb-item"><a href="<?php echo base_url('dashboard?p=dashboard');?>">Dashboard</a></li>
	<li class="breadcrumb-item active">Data Pemilih</li>
</ol>
<h3 class="page-header"><?php echo $cfg['sistem'] . ' '. ucwords(strtolower($cfg['desa'])) . ' Kec. '. ucwords(strtolower($cfg['kec']));?></h3>
<div class="panel panel-inverse panel_data">
	<div class="panel-heading">
		<div class="panel-heading-btn">
			<!-- <a href="#ModalForm" data-toggle="modal" class="btn btn-xs btn-icon btn-circle btn-default" title="Data Dusun" onclick="get_new_panitia()"><i class="fas fa-lg fa-fw fa-database"></i></a> -->
			<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
		</div>
		<h4 class="panel-title title_panel">Data Panitia</h4>
	</div>
	<div class="bg-black-transparent-1 p-t-0 p-l-15 p-r-15 p-b-15 m-b-0">
		<div class="row">
			<div class="col-md-10">
				<form id="form_search" class="form-inline" method="GET" action="<?php echo base_url('panitia/get_data');?>">
					<div class="form-group m-r-10 p-t-10">
						<select class="form-control form-control-sm" name="id_jab" id="id_jab_filter">
							<?php
								$jab 	= $this->Query->select_where('data_panitia_jab', array('*'), array(), 0,10, 'id ASC');
							  foreach ($jab->result_array() as $key => $value) { ?>
								<option value="<?php echo $value['id'];?>"><?php echo $value['jab'];?></option>
							<?php } ?>
							<option value="0">Semua</option>
						</select>
					</div>
					<div class="form-group m-r-10 p-t-10">
						<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
					</div>
				</form>
			</div>
			<div class="col-md-2">
				<a href="#ModalForm" data-toggle="modal" class="m-t-10 btn btn-sm btn-primary pull-right" id="btn_add_form"><i class="fa fa-plus"></i></a>
			</div>
		</div>
	</div>
</div>
	<div id="data_panitia_root" class="p-5"></div>

<div class="modal fade" id="ModalFormSM">
    <div class="modal-dialog modal-sm modal-dialog-centered">
    	<div class="modal-content">
			<div id="data_content_sm"></div>
		</div>		
  </div>
</div>

<div class="modal fade" id="ModalForm">
    <div class="modal-dialog modal-md modal-dialog-centered">
    	<div class="modal-content">
			<div id="data_content"></div>
		</div>		
  </div>
</div>