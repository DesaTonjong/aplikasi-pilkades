<div class="panel panel-inverse panel_modal">
	<div class="panel-heading">
		<div class="panel-heading-btn">
			<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
			<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger " data-dismiss="modal"><i class="fa fa-times"></i></a>
		</div>
		<h4 class="panel-title" id="modal_title"><i class="fa fa-cog"></i> Dapil</h4>
	</div>
	<div class="panel-body p-b-0">
		<form id="form_update_dapil" autocomplete="off" action="<?php echo base_url('setting/dapil_update');?>" method="POST">
			<div class="form-group">
				<label>Dapil (Daerah Pemilihan)</label>
				<input type="text" autocomplete="nope" class="form-control form-control-sm" name="dapil" id="dapil_add" value="<?php echo $result->dapil;?>">
				<input type="hidden" name="dapil_id" id="dapil_id" value="<?php echo $result->id;?>">
			</div>
			<div class="form-row m-t-10 m-b-10">
				<div class="col">
					<button type="button" class="btn btn-danger btn-md" onclick="remove_dapil(<?php echo $result->id;?>)">Hapus</button>
					<button type="submit" id="btn_upd_dapil" class="btn btn-primary btn-md pull-right">Simpan</button>
				</div>
			</div>
		</form>
	</div>
</div>
