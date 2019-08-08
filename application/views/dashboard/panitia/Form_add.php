<form id="form_add" autocomplete="off" action="<?php echo base_url('panitia/add_panitia');?>" method="POST"  enctype="multipart/form-data">
	<div class="panel panel-inverse panel_modal">
		<div class="panel-heading">
			<div class="panel-heading-btn">
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger " data-dismiss="modal"><i class="fa fa-times"></i></a>
			</div>
			<h4 class="panel-title" id="modal_title_mid">Data Panitia</h4>
		</div>
		<div class="panel-body panel_modal_body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-row m-b-10">
						<div class="col-md-8">
						<select class="form-control form-control-sm" name="id_jab">
							<?php
								$jab 	= $this->Query->select_where('data_panitia_jab', array('*'), array(), 0,10, 'id ASC');
							  foreach ($jab->result_array() as $key => $value) { ?>
								<option <?php if($id_jab==$value['id']){echo 'selected';}?>  value="<?php echo $value['id'];?>"><?php echo $value['jab'];?></option>
							<?php } ?>
						</select>
						</div>
						<div class="col-md-4">
							<div class="input-group">
									<input type="text" class="form-control form-control-sm" name="sort" id="sort" title="Urutan saat ditampilkan" placeholder="Urut" value="999">
							</div>
						</div>
					</div>
							<div class="form-group">
								<label>Keterangan</label>
								<div class="input-group">
									<input type="text" class="form-control form-control-sm" name="ket" id="ket_jab">
								</div>
							</div>
					<div class="form-group">
						<label>Nama Panitia</label>
						<div class="input-group">
								<input type="text" class="form-control form-control-sm" name="nama" id="panitia_nama" placeholder="Nama Lengkap">
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-row m-b-5">
						<img src="./assets/img/default_200.jpg" id="image-preview" class="rounded" alt="image preview"/>
					</div>

					<div class="form-row">
						<div class="input-group">
							<input type="file" name="file" id="image-source" onchange="previewImage();"/>
						</div>
					</div>
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


