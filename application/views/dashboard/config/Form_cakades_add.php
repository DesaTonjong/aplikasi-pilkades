<?php
   $date=date_create($this->Set->now_print());
   $tgl 	= date_format($date,'d');
   $bln 	= date_format($date,'m');
   $thn 	= date_format($date,'Y');
?>
<div class="panel panel-inverse panel_modal">
	<div class="panel-heading">
		<div class="panel-heading-btn">
			<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
			<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger " data-dismiss="modal"><i class="fa fa-times"></i></a>
		</div>
		<h4 class="panel-title" id="modal_title"><i class="fa fa-cog"></i> CAKDES (Calon Kepala Desa)</h4>
	</div>
	<div class="panel-body p-b-0">
		<form id="form_add_cakades" autocomplete="off" action="<?php echo base_url('setting/add_cakades');?>" method="POST">
			<div class="form-row">
				<div class="col-md-8">
					<div class="form-group">
						<label>Nama Lengkap</label>
						<input type="text" autocomplete="nope" class="form-control form-control-sm" name="nama" id="nama_cakades">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Nomor Urut</label>
						<input type="text" autocomplete="nope" class="form-control form-control-sm" name="nomor" id="nomor_add">
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-md-3">
					<div class="form-group">
						<label>Gender</label>
						<select class="form-control form-control-sm" name="gender">
							<option value="1">Laki-Laki</option>
							<option value="2">Perempuan</option>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Tmp.Lahir</label>
						<input type="text" autocomplete="nope" class="form-control form-control-sm" name="lahir_tmp" id="lahir_tmp_add">
					</div>
				</div>
				<div class="col-md-5">
					<div class="form-group">
						<label>Tanggal Lahir</label>
                  <div class="input-group input-daterange">
                     <input type="text" class="form-control form-control-sm" name="tgl" id="tgl" placeholder="Tanggal"
                        value="<?php echo $tgl;?>" title="Tanggal">
                     <input type="text" class="form-control form-control-sm" name="bln" id="bulan" placeholder="Bulan"
                        value="<?php echo $bln;?>" title="Bulan">
                     <input type="text" class="form-control form-control-sm" name="thn" id="tahun" placeholder="Tahun"
                        value="<?php echo $thn;?>" title="Tahun">
                  </div>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-md-3">
					<div class="form-group">
						<label>Pendidikan</label>
						<select class="form-control form-control-sm" name="pend_tingkat">
							<option value="1">SD/Sederajat</option>
							<option value="2">SMP/Sederajat</option>
							<option value="3">SMA/Sederajat</option>
							<option value="4">D1</option>
							<option value="5">D3</option>
							<option value="6">S1</option>
							<option value="7">S2</option>
							<option value="8">S3</option>
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Pendidikan (Nama Lembaga)</label>
						<input type="text" autocomplete="nope" class="form-control form-control-sm" name="pend_nama" id="pend_nama_add">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Tahun Tamat</label>
						<input type="text" autocomplete="nope" class="form-control form-control-sm" name="pend_thn" id="pend_thn_add">
					</div>
				</div>
			</div>
			<div class="form-row m-t-10 m-b-10">
				<div class="col">
					<button type="button" class="btn btn-warning btn-md" data-dismiss="modal">Tutup</button>
					<button type="submit" id="btn_add_cakades" class="btn btn-primary btn-md pull-right">Simpan</button>
				</div>
			</div>
		</form>
	</div>
</div>
