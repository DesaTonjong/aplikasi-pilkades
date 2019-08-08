<?php 
	$jml_segment 		= $this->uri->total_segments();
	$base_url_int 		= $this->Cfg->int_uri($jml_segment);
?>
<div class="panel panel-inverse panel_modal">
	<div class="panel-heading">
		<div class="panel-heading-btn">
			<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
			<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger " data-dismiss="modal"><i class="fa fa-times"></i></a>
		</div>
		<h4 class="panel-title" id="modal_title"><i class="fa fa-cog"></i> Config Aplikasi</h4>
	</div>
	<div class="panel-body panel_modal_body">
		<div class="row">
		<div class="col-md-8">
		<form action="<?php echo $base_url_int.'setting/update_config';?>" method="POST" id="form_update_config">
			<div class="form-group row m-b-15">
				<label class="col-form-label col-md-3">Kode Desa</label>
				<div class="col-md-9">
					<input type="text" name="desa_kode" class="form-control m-b-5" placeholder="Kode Desa" value="<?php echo $config->desa_kode;?>">
					<small class="f-s-12 text-grey-darker">Isikan dengan benar kode desa, informasi lebih lanjut hubungi Administrator.</small>
				</div>
			</div>
			<div class="form-group row m-b-15">
				<label class="col-form-label col-md-3">Sistem Desa</label>
				<div class="col-md-9">
					<input type="text" name="sistem" class="form-control m-b-5" placeholder="Kode Desa" value="<?php echo $config->sistem;?>">
					<small class="f-s-12 text-grey-darker">Sistem Tata Pemerintahan Desa (Desa/Kelurahan)</small>
				</div>
			</div>
			<div class="form-group row m-b-15">
				<label class="col-form-label col-md-3">Digit Nomor Undangan</label>
				<div class="col-md-9">
					<input type="text" name="dig_no_und" class="form-control m-b-5" placeholder="Kode Desa" value="<?php echo $config->dig_no_und;?>">
					<small class="f-s-12 text-grey-darker">Digit Penomoran Nomor Undangan PILKADES</small>
				</div>
			</div>
			<div class="form-group row m-b-15">
				<label class="col-form-label col-md-3">Kapasitas Ruang Tunggu</label>
				<div class="col-md-9">
					<input type="text" name="antri" class="form-control m-b-5" placeholder="Jumlah Kursi Ruang Tunggu" value="<?php echo $config->antri;?>">
					<small class="f-s-12 text-grey-darker">Jumlah kursi/kapasitas ruang tunggu antrian pencoblosan</small>
				</div>
			</div>

			<div class="form-group row m-b-15 pull-right m-r-4">
				<button class="btn btn-primary" type="submit" id="btn_submit">Simpan</button>
			</div>
		</form>
		</div>
		<div class="col-md-4">
			<h3>Reset Data</h3>
			<form autocomplete="off" action="<?php echo $base_url_int.'data_pemilih/reset_data';?>" method="POST" id="form_reset">
				<div class="checkbox checkbox-css">
					<input type="checkbox" name="reset_data_pemilih" id="reset_data_pemilih">
					<label for="reset_data_pemilih">Data Pemilih</label>
				</div>
				<div class="checkbox checkbox-css">
					<input type="checkbox" name="reset_data_kehadiran" id="reset_data_kehadiran">
					<label for="reset_data_kehadiran">Data Kehadiran</label>
				</div>

			<div class="form-group m-b-15">
				<label class="col-form-label">Password</label>
				<input type="password" autocomplete="off" name="password" class="form-control m-b-5" placeholder="Password">
			</div>

			<div class="form-group row m-l-5 m-t-15 m-r-4">
					<button class="btn btn-danger" type="submit" id="btn_reset_data"><i class="fa fa-times"></i> Action</button>
			</div>
			</form>
		</div>
		</div>
	</div>
</div>