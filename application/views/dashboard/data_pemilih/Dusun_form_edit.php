<?php
	$jml_segment 		= $this->uri->total_segments();
	$base_url_int 		= $this->Cfg->int_uri($jml_segment);
?>
<div class="hljs-wrapper mb-3" style="padding: 15px;">
	<form id="update_dusun" action="<?php echo $base_url_int.'data_pemilih/update_dusun';?>"  method="POST">
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label for="uid">Kode</label>
					<input type="text" class="form-control" id="uid" name="uid" placeholder="Kode" value="<?php echo $dusun->uid;?>">
					<input type="text" class="d-none" id="id_dusun_edit" name="id" placeholder="Kode" value="<?php echo $dusun->id;?>">
				</div>
			</div>
			<div class="col-md-10">
				<div class="form-group">
					<label for="dusun">Dusun</label>
					<input type="text" class="form-control" id="dusun" name="dusun" placeholder="Nama Dusun" value="<?php echo $dusun->dusun;?>">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<button type="button" class="btn btn-sm btn-danger" onclick="remove_dusun(<?php echo $dusun->id;?>)">Hapus</button>
				<button type="submit" class="btn btn-sm btn-primary pull-right">Simpan</button>
				<button type="button" class="btn btn-sm btn-success pull-right m-r-3" onclick="close_edit_dusun()">Tutup</button>
			</div>
		</div>
	</form>
</div>