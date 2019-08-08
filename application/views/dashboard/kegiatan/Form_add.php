<form id="form_add" autocomplete="off" action="<?php echo base_url('kegiatan/add_data');?>" method="POST"  enctype="multipart/form-data">
	<div class="panel panel-inverse panel_modal">
		<div class="panel-heading">
			<div class="panel-heading-btn">
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger " data-dismiss="modal"><i class="fa fa-times"></i></a>
			</div>
			<h4 class="panel-title" id="modal_title_mid">Data Kegiatan</h4>
		</div>
		<div class="panel-body panel_modal_body">
			<div class="form-group">
				<label>Judul</label>
				<div class="input-group">
					<input type="text" class="form-control form-control-sm" name="title" id="title" value="" placeholder="Nama Lengkap">
					<input type="hidden" class="" name="photo_fname" id="photo_fname" value="">
				</div>
			</div>
			<div class="form-group">
				<label>Keterangan</label>
				<div class="input-group">
					<input type="text" class="form-control form-control-sm" name="keterangan" id="keterangan" value="">
				</div>
			</div>
			<div class="form-row m-b-5">
				<img src="./assets/img/default_photo_800.jpg" id="image-preview" class="rounded" alt="image preview"/>
			</div>

			<div class="form-row">
				<div class="input-group">
					<input type="file" name="file" id="image-source" onchange="previewImage();"/>
				</div>
			</div>
			<div class="form-group">
				<div id="alert_msg"></div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" id="btnSubmit" class="btn btn-primary btn-md">Simpan</button>
		</div>
	</div>
</form>
<style type="text/css">
#image-preview{
    width : 100%;
}
</style>




