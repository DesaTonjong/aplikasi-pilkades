<?php
	$wrap_print 		= explode(',', $margin->wrap);
	$no_urut_top 		= explode(',', $margin->no_urut_top);
	$nama_pemilih 		= explode(',', $margin->nama_pemilih);
	$alamat_pemilih 	= explode(',', $margin->alamat_pemilih);
	$alamat_pemilih2 	= explode(',', $margin->alamat_pemilih2);
	$no_urut_bottom 	= explode(',', $margin->no_urut_bottom);
	$qr_code 			= explode(',', $margin->qr_code);
	$bar_code 			= explode(',', $margin->bar_code);
	$jml_segment 	= $this->uri->total_segments();
	$base_url_int 	= $this->Cfg->int_uri($jml_segment);
?>
<form id="setting_print_und_save" action="<?php echo $base_url_int.'data_pemilih/setting_print_und_save';?>" method="POST">
	
		<div class="panel panel-inverse panel_modal">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger " data-dismiss="modal"><i class="fa fa-times"></i></a>
				</div>
				<h4 class="panel-title" id="modal_title"><i class="fa fa-cog"></i> Setting Print Undangan</h4>
			</div>
			<div class="panel-body panel_modal_body">
					<div class="form-group row mb-0">
						<div class="col-md-5 offset-md-5 ">
							<div class="input-group">
								<label class="col-form-label col-md-4">Kiri</label>
								<label class="col-form-label col-md-4">Atas</label>
								<label class="col-form-label col-md-4">Font Size</label>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 offset-md-2 col-form-label">Nomor Urut Atas</label>
						<div class="col-md-5">
							<div class="input-group">
								<input type="text" value="<?php echo $no_urut_top[1];?>" class="form-control" name="no_urut_top_left" title="Margin Samping" placeholder="Margin Samping">
								<input type="text" value="<?php echo $no_urut_top[0];?>" class="form-control" name="no_urut_top_top" title="Margin Atas" placeholder="Margin Atas">
								<input type="text" value="<?php echo $no_urut_top[2];?>" class="form-control" name="no_urut_top_font_size" title="Ukuran Huruf" placeholder="Ukuran Huruf">
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 offset-md-2 col-form-label">Nama Pemilih</label>
						<div class="col-md-5">
							<div class="input-group">
								<input type="text" value="<?php echo $nama_pemilih[1];?>" class="form-control" name="nama_pemilih_left" title="Margin Samping" placeholder="Margin Samping">
								<input type="text" value="<?php echo $nama_pemilih[0];?>" class="form-control" name="nama_pemilih_top" title="Margin Atas" placeholder="Margin Atas">
								<input type="text" value="<?php echo $nama_pemilih[2];?>" class="form-control" name="nama_pemilih_font_size" title="Ukuran Huruf" placeholder="Ukuran Huruf">
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 offset-md-2 col-form-label">Alamat (baris1)</label>
						<div class="col-md-5">
							<div class="input-group">
								<input type="text" value="<?php echo $alamat_pemilih[1];?>" class="form-control" name="alamat_pemilih_left" title="Margin Samping" placeholder="Margin Samping">
								<input type="text" value="<?php echo $alamat_pemilih[0];?>" class="form-control" name="alamat_pemilih_top" title="Margin Atas" placeholder="Margin Atas">
								<input type="text" value="<?php echo $alamat_pemilih[2];?>" class="form-control" name="alamat_pemilih_font_size" title="Ukuran Huruf" placeholder="Ukuran Huruf">
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 offset-md-2 col-form-label">Alamat (baris2)</label>
						<div class="col-md-5">
							<div class="input-group">
								<input type="text" value="<?php echo $alamat_pemilih2[1];?>" class="form-control" name="alamat_pemilih2_left" title="Margin Samping" placeholder="Margin Samping">
								<input type="text" value="<?php echo $alamat_pemilih2[0];?>" class="form-control" name="alamat_pemilih2_top" title="Margin Atas" placeholder="Margin Atas">
								<input type="text" value="<?php echo $alamat_pemilih2[2];?>" class="form-control" name="alamat_pemilih2_font_size" title="Ukuran Huruf" placeholder="Ukuran Huruf">
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 offset-md-2 col-form-label">Nomor Urut Bawah</label>
						<div class="col-md-5">
							<div class="input-group">
								<input type="text" value="<?php echo $no_urut_bottom[1];?>" class="form-control" name="no_urut_bottom_left" title="Margin Samping" placeholder="Margin Samping">
								<input type="text" value="<?php echo $no_urut_bottom[0];?>" class="form-control" name="no_urut_bottom_top" title="Margin Atas" placeholder="Margin Atas">
								<input type="text" value="<?php echo $no_urut_bottom[2];?>" class="form-control" name="no_urut_bottom_font_size" title="Ukuran Huruf" placeholder="Ukuran Huruf">
							</div>
						</div>
					</div>
					
					<div class="form-group row">
						<label class="col-md-3 offset-md-2 col-form-label">QR Code</label>
						<div class="col-md-3">
							<div class="input-group">
								<input type="text" value="<?php echo $qr_code[1];?>" class="form-control" name="qr_code_left" title="Margin Samping" placeholder="Margin Samping">
								<input type="text" value="<?php echo $qr_code[0];?>" class="form-control" name="qr_code_top" title="Margin Atas" placeholder="Margin Atas">
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 offset-md-2 col-form-label">Barcode</label>
						<div class="col-md-3">
							<div class="input-group">
								<input type="text" value="<?php echo $bar_code[1];?>" class="form-control" name="bar_code_left" title="Margin Samping" placeholder="Margin Samping">
								<input type="text" value="<?php echo $bar_code[0];?>" class="form-control" name="bar_code_top" title="Margin Atas" placeholder="Margin Atas">
							</div>
						</div>
					</div>
			</div>

			<div class="panel-footer panel_modal_footer">
				<div class="col-md-7 offset-md-2">
					<button type="submit" class="btn btn-sm btn-success" onclick="print_undangan_tes()">Tes Print</button>
					<button type="submit" id="btn_save" class="btn btn-sm btn-primary pull-right">Simpan</button>
				</div>
			</div>
		</div>
</form>