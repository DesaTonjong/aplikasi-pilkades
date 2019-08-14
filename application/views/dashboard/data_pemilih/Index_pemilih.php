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
<div class="row">
<div class="col-lg-12">
	<ul class="nav nav-tabs">
		<li class="nav-items">
			<a href="#default-tab-1" data-toggle="tab" class="nav-link show active">
				<span class="d-sm-none">Rekap Data</span>
				<span class="d-sm-block d-none">Data Pemilih</span>
			</a>
		</li>
		<li class="nav-items">
			<a href="#default-tab-2" data-toggle="tab" class="nav-link show">
				<span class="d-sm-none">Data</span>
				<span class="d-sm-block d-none">Data</span>
			</a>
		</li>
		<li class="nav-items">
			<a href="#default-tab-3" data-toggle="tab" class="nav-link show">
				<span class="d-sm-none">Potensi Ganda</span>
				<span class="d-sm-block d-none">Potensi Ganda</span>
			</a>
		</li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane fade active show" id="default-tab-1">
		<div class="row">
			<div class="col-md-6">
				<form id="form_get_rekap_dapil" action="<?php echo $base_url_int.'data_pemilih/get_rekap_dapil';?>" class="m-b-10">
					<div class="form-group row ">
						<label class="col-form-label col-md-3">Dapil</label>
						<div class="col-md-4">
							<select name="dapil_id" id="dapil_id_filter" class="form-control form-control-sm" onchange="get_rekap_dapil()">
							<?php 
								$get_dapil 	= $this->Query->select_where('pilkades_dapil', 
																		array('*'), array(), 0,15, 'dapil ASC');
								foreach ($get_dapil->result_array() as $key => $value) {
							?>
							<option value="<?php echo $value['id'];?>"><?php echo $value['dapil'];?></option>
						<?php } ?>
						</select>
					</div>
					<div class="col-md-4">
						<a href="#ModalFormMid" data-toggle="modal" class="btn btn-sm btn-primary"><i class="fa fa-chart-pie"></i></a>
					</div>
					</div>
				</form>
				<div id="rekap_dapil_root"></div>
			</div>
			<div class="col-md-6">
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
		<!-- end tab-pane -->
		<!-- begin tab-pane -->
		<div class="tab-pane fade" id="default-tab-2">
			<h3>Maaf belum selesai fiturnya, lompatin aja</h3>
		</div>
		<div class="tab-pane fade" id="default-tab-3">
			<h3>Potensi Ganda</h3>
			<div class="row">
				<div class="col-md-4">
					<form id="form_pot_ganda" action="<?php echo $base_url_int.'data_pemilih/get_pot_ganda';?>" class="m-b-10">
						<div class="input-group">
							<select name="pot_ganda_filter" id="pot_ganda_filter" class="form-control form-control-sm" onchange="get_pot_ganda()">
							<option value="1">Nama</option>
							<option value="2">NIK</option>
							<option value="3">Tanggal lahir</option>
						</select>
						</div>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="chats bg-grey-transparent-2" data-scrollbar="true" data-height="450px">
						<div id="pot_ganda_root"></div>
					</div>
				</div>
				<div class="col-md-8">
					<div id="result_ganda"></div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
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

	</div>
</div>
