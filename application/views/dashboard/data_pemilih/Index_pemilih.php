<?php 
	$cfg 			= $this->Cfg->get_data();
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
			<a href="#ModalForm"  class="btn btn-xs btn-icon btn-circle btn-primary" onclick="show_upload_pemilih()"><i class="fa fa-cloud-upload-alt"></i></a>
			<a href="#ModalForm" class="btn btn-xs btn-icon btn-circle btn-default" title="Data Dusun" data-toggle="modal" onclick="get_form_dusun()"><i class="fas fa-lg fa-fw fa-database"></i></a>
			<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
		</div>
		<h4 class="panel-title title_panel">Database Pemilih <?php if($pemilih->jml>0) {echo '('.number_format($pemilih->jml).')';}?></h4>
	</div>
	<div class="panel-body panel_data_body">
		<div class="row">
			<div class="col-md-5">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th width="60px;">DUSUN</th>
							<th width="60px;">UND</th>
							<th width="60px;">L</th>
							<th width="60px;">P</th>
							<th width="60px;">JML</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($dusun as $key => $value) { 
							$rekap				= $this->Query->select_where_join2_group_by('data_pemilih', 'dusun', 'dusun.uid=data_pemilih.id_dusun', 
																		array('data_pemilih.rw', 'data_pemilih.rt',
																		'MIN(data_pemilih.no_urut) as start',
																		'MAX(data_pemilih.no_urut) as end',
																		'SUM(IF(data_pemilih.lp=1,1,0)) as jml_lk',
																		'SUM(IF(data_pemilih.lp=2,1,0)) as jml_pr',
																		'COUNT(data_pemilih.id) as total',
																		),
																		array('data_pemilih.rw', 'data_pemilih.rt'),
																		'data_pemilih.aktif=1 AND data_pemilih.id_dusun='.$value['uid'],
																		0, 60, 'data_pemilih.id_dusun, data_pemilih.rw, data_pemilih.rt ASC')->result_array();
					?>
						<tr>
							<td colspan="5" width="300px;"><b><?php echo $value['dusun'];?></b></td>
						</tr>
					<?php foreach ($rekap as $ey => $row) { ?>
						<tr>
							<td>
								<a href="javascript:;" onclick="get_data_filter(<?php echo $value['uid'].','.$row['rt'].','.$row['rw'] .',0';?>)"><?php echo $row['rt'].'/'.$row['rw'];?></a>
							</td>
							<td class="text-center"><?php echo $row['start'].'-'.$row['end'];?></td>
							<td class="text-right"><?php echo $row['jml_lk'];?></td>
							<td class="text-right"><?php echo $row['jml_pr'];?></td>
							<td class="text-right"><?php echo $row['total'];?></td>
						</tr>
					<?php } } ?>
					</tbody>
				</table>
			</div>
			<div class="col-md-7">
				<div class="row">
					<div class="col-md-12">
						<div class="btn-group">
							<a href="javascript:;" class="btn btn-success" title="Print Undangan" onclick="print_undangan()">Und</a>
							<a href="#" data-toggle="dropdown" class="btn btn-success dropdown-toggle" aria-expanded="false"></a>
							<ul class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(86px, 33px, 0px);">
								<li><a href="#ModalFormMid" data-toggle="modal" onclick="get_form_add()"><i class="fa fa-user" aria-hidden="true"></i> Tambah Data Pemilih</a></li>
								<li><a href="#ModalForm" data-toggle="modal" onclick="get_setup_print_und()"><i class="fa fa-cog" aria-hidden="true"></i> Setting Print Undangan</a></li>
								<li><a href="<?php echo base_url('data_pemilih/download_dpt_excel');?>"><i class="fa fa-file-excel" aria-hidden="true"></i> Download DPT Excel</a></li>
								<li><a href="javascript:;" onclick="remove_data_pemilih()"><i class="fa fa-times" aria-hidden="true"></i> Hapus</a></li>
							</ul>
						</div>
						<div class="pull-right">
							<form id="form_data" action="<?php echo $base_url_int.'data_pemilih/get_data';?>" class="m-b-10">
								<input type="hidden" name="rt" id="rt_filter">
								<input type="hidden" name="rw" id="rw_filter">
								<input type="hidden" name="id_dusun" id="id_dusun">
								<div class="input-group">
									<input type="text" name="key_search" id="key_search" class="form-control form-control-sm" placeholder="Pencarian" title="Kunci Pencarian">
									<div class="input-group-append">
										<button type="submit" id="btn_submit"  class="btn btn-primary btn-sm">
											<i class="fa fa-search"></i>
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="m-t-5 m-b-10" id="info_rkp_pemilih"></div>
					</div>
				</div>
				<div class="dropzone d-none mb-2" id="upload_data_pemilih"></div>
				<div class="row">
					<div class="col-md-12">
						<table id="table_data_pemilih" class="table table-primary table-striped table-bordered">
							<thead>
								<tr>
									<th width="60px"><div class="checkbox checkbox-css">
															<input type="checkbox" id="select_urut_checkbox" value="0" checked=""  onClick="check_uncheck_checkbox(this.checked);">
															<label for="select_urut_checkbox">UND</label>
														</div></th>
									<th>NAMA LENGKAP</th>
									<th>DUSUN</th>
									<th>NIKAH</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
					</div>
				</div>
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

<div class="modal fade" id="ModalFormMid">
	<div class="modal-dialog modal-md modal-dialog-centered">
		<div class="modal-content">
			<div id="data_content_mid"></div>
		</div>		
	</div>
</div>
<div class="modal fade" id="ModalFormSM">
	<div class="modal-dialog modal-sm modal-dialog-centered">
		<div class="modal-content">
			<div id="data_content_sm"></div>
		</div>		
	</div>
</div>