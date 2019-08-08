	<div class="panel panel-inverse panel_modal">
		<div class="panel-heading">
			<div class="panel-heading-btn">
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-primary" onclick="add_new_dusun()" title="Tambah data dusun"><i class="fa fa-plus"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger " data-dismiss="modal"><i class="fa fa-times"></i></a>
			</div>
			<h4 class="panel-title" id="modal_title"><i class="fa fa-cog"></i> Dusun</h4>
		</div>
		<div class="panel-body panel_modal_body">
			<div id="edit_form_dusun"></div>
			<table id="table_dusun" class="table table-primary table-striped table-bordered">
				<thead>
					<tr>
						<th width="40px">KODE</th>
						<th>DUSUN</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($dusun->result_array() as $key => $value) { ?>
					<tr id="dsn<?php echo $value['id'];?>">
						<td id="uid<?php echo $value['id'];?>"><?php echo $value['uid'];?></td>
						<td id="dusun<?php echo $value['id'];?>"><a href="javascript:void(0)" onclick="get_edit_dusun(<?php echo $value['id'];?>)"><?php echo $value['dusun'];?></a></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
