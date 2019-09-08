<?php
   $date=date_create($result->lahir_tgl);
   $tgl 	= date_format($date,'d');
   $bln 	= date_format($date,'m');
   $thn 	= date_format($date,'Y');
?>

<form id="form_update_cakades" autocomplete="off" action="<?php echo base_url('setting/update_cakades');?>" method="POST" enctype="multipart/form-data">
<div class="panel panel-inverse panel_modal">
	<div class="panel-heading">
		<div class="panel-heading-btn">
			<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
			<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger " data-dismiss="modal"><i class="fa fa-times"></i></a>
		</div>
		<h4 class="panel-title" id="modal_title"><i class="fa fa-cog"></i> CAKDES (Calon Kepala Desa)</h4>
	</div>
	<div class="panel-body p-b-0">
			<div class="row">
				<div class="col-md-3">
					<?php $source_img = base_url('assets/img/user/c'. $result->nomor .".png"); 
						if($result->photo!=""){ $source_img = base_url('assets/img/calon/200/'. $result->photo); } ?>
					<img src="<?php echo $source_img;?>" id="image-preview" width="120px" alt="">
					<div class="input-group mt-2">
						<input type="file" name="file" id="image-source" onchange="previewImage();"/>
						<span class="text-info text-xs ">Photo ukuran 3x4</span>
					</div>
				</div>
				<div class="col-md-9">
				<div class="form-row">
					<div class="col-md-8">
						<div class="form-group">
							<label>Nama Lengkap</label>
							<input type="text" autocomplete="nope" class="form-control form-control-sm" name="nama" id="nama_cakades" value="<?php echo $result->nama_calon;?>">
							<input type="hidden" autocomplete="nope" class="form-control form-control-sm" name="cakades_id" id="cakades_id_add" value="<?php echo $result->id;?>">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Nomor Urut</label>
							<input type="text" autocomplete="nope" class="form-control form-control-sm" name="nomor" id="nomor_add" value="<?php echo $result->nomor;?>">
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
							<input type="text" autocomplete="nope" class="form-control form-control-sm" name="lahir_tmp" id="lahir_tmp_add" value="<?php echo $result->lahir_tmp;?>">
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
							<input type="text" autocomplete="nope" class="form-control form-control-sm" name="pend_nama" id="pend_nama_add" value="<?php echo $result->pend_nama;?>">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Tahun Tamat</label>
							<input type="text" autocomplete="nope" class="form-control form-control-sm" name="pend_thn" id="pend_thn_add" value="<?php echo $result->pend_thn;?>">
						</div>
					</div>
				</div>
			</div>
	</div>

	<div class="panel-footer m-t-10 m-b-10">
		<div class="row pull-right">
			<button type="button" class="btn btn-danger btn-md m-r-10" onclick="remove_cakades(<?php echo $result->id;?>)">Hapus</button>
			<button type="submit" id="btn_upd_cakades" class="btn btn-primary btn-md pull-right">Simpan</button>
		</div>
	</div>
</div>
</form>
