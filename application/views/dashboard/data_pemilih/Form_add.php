<div class="panel panel-inverse panel_modal">
	<div class="panel-heading">
		<div class="panel-heading-btn">
			<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
			<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger " data-dismiss="modal"><i class="fa fa-times"></i></a>
		</div>
		<h4 class="panel-title" id="modal_title"><i class="fa fa-cog"></i> Data Pemilih</h4>
	</div>
	<div class="panel-body p-b-0">
		<form id="form_add" action="<?php echo base_url('data_pemilih/add_data_pemilih');?>"  method="POST">
			<div class="form-row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="uid">NIK</label>
						<input type="text" class="form-control" id="nik" name="nik" placeholder="NIK">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="uid">NO KK</label>
						<input type="text" class="form-control" id="no_kk" name="no_kk" placeholder="Nomor KK">
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-md-8">
					<div class="form-group">
						<label for="dusun">NAMA LENGKAP</label>
						<input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="uid">Jenis Kelamin</label>
						<select  class="form-control" name="lp" id="lp">
							<option value="1">Laki-laki</option>
							<option value="2">Perempuan</option>
						</select>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="dusun">Dusun</label>
						<select  class="form-control" name="id_dusun" id="id_dusun_form">
							<?php 
								$get = $this->Query->select_where('dusun', array('*'), array(), 0, 20, 'dusun ASC');
								foreach ($get->result_array() as $key => $value) { ?>
								<option value="<?php echo $value['uid'];?>"><?php echo $value['dusun'];?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="dusun">RT</label>
						<input type="text" class="form-control" id="rt" name="rt" placeholder="RT">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="dusun">RW</label>
						<input type="text" class="form-control" id="rw" name="rw" placeholder="RW">
					</div>
				</div>
			</div>

			<div class="form-row">
				<div class="col-md-3">
					<div class="form-group">
						<label for="uid">Status Nikah</label>
						<select  class="form-control" name="sts_nikah" id="sts_nikah">
							<option value="0">Belum</option>
							<option value="1">Sudah</option>
							<option value="2">Pernah</option>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="no_urut">No Undangan</label>
						<input type="text" class="form-control" id="no_urut" name="no_urut" placeholder="No Undangan" value="<?php echo $nom->nom + 1;?>">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<button type="submit" id="btn_add" class="btn btn-sm btn-primary pull-right">Simpan</button>
					<button type="button" class="btn btn-sm btn-success pull-right m-r-3"  data-dismiss="modal">Tutup</button>
				</div>
			</div>
		</form>
	</div>
</div>
