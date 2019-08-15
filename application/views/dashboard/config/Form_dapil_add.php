<div class="panel panel-inverse panel_modal">
	<div class="panel-heading">
		<div class="panel-heading-btn">
			<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
			<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger " data-dismiss="modal"><i class="fa fa-times"></i></a>
		</div>
		<h4 class="panel-title" id="modal_title"><i class="fa fa-cog"></i> Dapil</h4>
	</div>
	<div class="panel-body p-b-0">
		<form id="form_add_dapil" autocomplete="off" action="<?php echo base_url('setting/add_dapil');?>" method="POST">
			<div class="form-group">
				<label>Dapil (Daerah Pemilihan)</label>
				<input type="text" autocomplete="nope" class="form-control form-control-sm" name="dapil" id="dapil_add">
			</div>
			<div class="form-row m-t-10 m-b-10">
				<div class="col">
					<button type="button" class="btn btn-warning btn-md" data-dismiss="modal">Tutup</button>
					<button type="submit" id="btn_add_dapil" class="btn btn-primary btn-md pull-right">Simpan</button>
				</div>
			</div>
		</form>
	</div>
</div>
