<div class="panel panel-inverse panel_modal">
	<div class="panel-heading">
		<div class="panel-heading-btn">
			<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
			<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger " data-dismiss="modal"><i class="fa fa-times"></i></a>
		</div>
		<h4 class="panel-title" id="modal_title"><i class="fa fa-cog"></i> User Dapil </h4>
	</div>
	<div class="panel-body p-b-0">
		<form id="form_add_user_dapil" autocomplete="off" action="<?php echo base_url('setting/add_user_dapil');?>" method="POST">
			<?php if(COUNT($get_user)>0){ ?>
			<input type="hidden" name="id_dapil" value="<?php echo $id_dapil;?>">
			<input type="hidden" name="jns" value="<?php echo $jns;?>">
			<div class="form-group">
				<label>User Operotar</label>
				<select class="form-control form-control-sm" name="uid_user"  id="uid_user_add">
					<?php foreach ($get_user as $key => $value) { ?>
						<option value="<?php echo $value['uid'];?>"><?php echo $value['opr'];?></option>
					<?php } ?>
					
				</select>
			</div>
			<div class="form-row m-t-10 m-b-10">
				<div class="col">
					<button type="button" class="btn btn-warning btn-md" data-dismiss="modal">Tutup</button>
					<button type="submit" id="btn_add_user" class="btn btn-primary btn-md pull-right">Simpan</button>
				</div>
			</div>
		<?php }else { ?>
			<h3 class="text-danger">Data Operator tidak tersedia</h3>
		<?php } ?>
		</form>
	</div>
</div>
