<div class="panel panel-inverse panel_modal">
	<div class="panel-heading">
		<div class="panel-heading-btn">
			<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-primary" onclick="get_new_user()"><i class="fa fa-plus"></i></a>
			<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
			<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger " data-dismiss="modal"><i class="fa fa-times"></i></a>
		</div>
		<h4 class="panel-title" id="modal_title"><i class="fa fa-cog"></i> User Operator</h4>
	</div>
		<div id="form_input"></div>
	<div class="panel-body panel_modal_body" style="height: 500px;">
		<div class="slimScrollDiv">
		<table id="table_user" class="table table-primary table-striped table-bordered">
			<thead>
				<tr>
					<th width="40px">NO</th>
					<th>USER OPERATOR</th>
					<th>EMAIL / USERNAME</th>
					<th>AKSES</th>
					<th>PASSWORD</th>
				</tr>
			</thead>
			<tbody>
				<?php $i=1; foreach ($users->result_array() as $key => $value) { 
					$akses = explode(',', $value['rules_akses']);
					$rules = '';
					foreach ($akses as $row) {
						if($row==3){
							$rules .= '<span class="badge badge-primary">Data Pemilih</span> ';
						}else if($row==4){
							$rules .= '<span class="badge badge-purple">Cek Kehadiran</span> ';
						}else if($row==5){
							$rules .= '<span class="badge badge-pink">Penghitungan</span> ';
						}
					}
				?>
				<tr id="row<?php echo $value['uid'];?>">
					<td><?php echo $i;?></td>
					<td><a href="javascript:void(0)" onclick="get_edit_user('<?php echo $value['uid'];?>')" id="user<?php echo $value['uid'];?>"><?php echo $value['nama_user'];?></a></td>
					<td id="mail<?php echo $value['uid'];?>"><?php echo $value['email'];?></td>
					<td id="rule<?php echo $value['uid'];?>"><?php echo $rules;?></td>
					<td id="pass<?php echo $value['uid'];?>"><button class="btn btn-info btn-xs" title="Reset Password" onclick="reset_pass(<?php echo $value['uid'];?>)"><i class="fa fa-redo"></i></button></td>
				</tr>
			<?php $i++; } ?>
			</tbody>
		</table>
	</div>
	</div>
</div>