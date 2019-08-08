<div class="panel panel-inverse panel_modal">
	<div class="panel-heading">
		<div class="panel-heading-btn">
			<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
			<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger " data-dismiss="modal"><i class="fa fa-times"></i></a>
		</div>
		<h4 class="panel-title" id="modal_title"><i class="fa fa-cog"></i> Data Pemilih</h4>
	</div>
	<div class="panel-body p-b-0">
		<form id="form_update" action="<?php echo base_url('data_pemilih/update_data_pemilih');?>"  method="POST">
			<div class="form-row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="uid">NIK</label>
						<input type="hidden" id="id_pemilih" name="id_pemilih" value="<?php echo $data->id;?>">
						<input type="text" class="form-control" id="nik" name="nik" placeholder="NIK" value="<?php echo $data->nik;?>">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="uid">NO KK</label>
						<input type="text" class="form-control" id="nokk" name="nokk" placeholder="Nomor KK" value="<?php echo $data->nokk;?>">
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-md-8">
					<div class="form-group">
						<label for="dusun">NAMA LENGKAP</label>
						<input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap"  value="<?php echo $data->nama_lengkap;?>">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="uid">Jenis Kelamin</label>
						<select  class="form-control" name="lp" id="lp">
							<option <?php if($data->lp==1){echo 'selected';}?> value="1">Laki-laki</option>
							<option <?php if($data->lp==2){echo 'selected';}?> value="2">Perempuan</option>
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
								<option <?php if($data->id_dusun==$value['uid']){echo 'selected';}?>  value="<?php echo $value['uid'];?>"><?php echo $value['dusun'];?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="dusun">RT</label>
						<input type="text" class="form-control" id="rt" name="rt" placeholder="RT"  value="<?php echo $data->rt;?>">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="dusun">RW</label>
						<input type="text" class="form-control" id="rw" name="rw" placeholder="RW"  value="<?php echo $data->rw;?>">
					</div>
				</div>
			</div>

			<div class="form-row">
				<div class="col-md-3">
					<div class="form-group">
						<label for="uid">Status Nikah</label>
						<select  class="form-control" name="sts_nikah" id="sts_nikah">
							<option <?php if($data->sts_nikah==0){echo 'selected';}?> value="0">Belum</option>
							<option <?php if($data->sts_nikah==1){echo 'selected';}?> value="1">Sudah</option>
							<option <?php if($data->sts_nikah==2){echo 'selected';}?> value="2">Pernah</option>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="no_urut">No Undangan</label>
						<input type="text" class="form-control" id="no_urut" name="no_urut" placeholder="No. Undangan"  value="<?php echo $data->no_urut;?>">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<button type="button" id="btn_remove" class="btn btn-sm btn-danger" onclick="remove_pemilih(<?php echo $data->id;?>)" value="<?php echo $data->id;?>">Hapus</button>
					<button type="submit" id="btn_update" class="btn btn-sm btn-primary pull-right">Simpan</button>
					<button type="button" class="btn btn-sm btn-success pull-right m-r-3"  data-dismiss="modal">Tutup</button>
				</div>
			</div>
		</form>
	</div>
</div>
