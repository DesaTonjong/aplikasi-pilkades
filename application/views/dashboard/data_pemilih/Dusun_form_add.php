<?php
	$jml_segment 		= $this->uri->total_segments();
	$base_url_int 		= $this->Cfg->int_uri($jml_segment);
?>
<div class="hljs-wrapper mb-3" style="padding: 15px;">
	<form id="add_new_dusun" action="<?php echo $base_url_int.'data_pemilih/add_new_dusun_action';?>"  method="POST">
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label for="uid">Kode</label>
					<input type="text" class="form-control" id="uid_dusun_edit" name="uid" placeholder="Kode">
				</div>
			</div>
			<div class="col-md-9">
				<div class="form-group">
					<label for="dusun">Dusun</label>
					<input type="text" class="form-control" id="dusun_edit" name="dusun" placeholder="Nama Dusun">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<button type="submit" class="btn btn-sm btn-primary pull-right">Simpan</button>
				<button type="button" class="btn btn-sm btn-success pull-right m-r-3" onclick="close_edit_dusun()">Tutup</button>
			</div>
		</div>
	</form>
</div>