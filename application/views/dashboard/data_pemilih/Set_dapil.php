<div class="panel panel-inverse panel_modal">
	<div class="panel-heading">
		<div class="panel-heading-btn">
			<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
			<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger " data-dismiss="modal"><i class="fa fa-times"></i></a>
		</div>
		<h4 class="panel-title" id="modal_title"><i class="fa fa-cog"></i> Setting Dapil</h4>
	</div>
	<div class="panel-body p-b-0">
		<form id="form_set_dapil_update" action="<?php echo base_url('data_pemilih/set_dapil_update');?>"  method="POST">
			<input type="hidden" name="id_dusun" value="<?php echo $id_dusun;?>">
			<input type="hidden" name="rt" value="<?php echo $rt;?>">
			<input type="hidden" name="rw" value="<?php echo $rw;?>">
			<input type="hidden" name="id_dapil" value="<?php echo $id_dapil;?>">
			<div class="form-group">
				<label>Dapil</label>
				<select class="form-control form-control-sm" name="id_dapil_new" >
					<?php 
						foreach ($dapil->result_array() as $key => $value) { 
							$get = $this->Query->select_where('data_pemilih', array('COUNT(id) as jml'), array('id_dapil'=> $value['id']),0,1, 'id ASC')->row();
							$jml = '';
							if($get->jml>0){
								$jml = ' ('. number_format($get->jml).')';
							}
					?>
						<option <?php if($value['id']==$id_dapil){echo 'selected';}?> value="<?php echo $value['id'];?>"><?php echo $value['dapil'] . ' ' . $jml;?></option>
					<?php } ?>
				</select>
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary">Simpan</button>
			</div>
		</form>
	</div>
</div>