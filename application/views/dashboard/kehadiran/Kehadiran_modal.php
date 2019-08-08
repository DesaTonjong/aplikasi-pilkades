	<div class="panel panel-inverse panel_modal">
		<div class="panel-heading">
			<div class="panel-heading-btn">
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger " data-dismiss="modal"><i class="fa fa-times"></i></a>
			</div>
			<h4 class="panel-title" id="modal_title"><i class="fa fa-cog"></i> Kehadiran</h4>
		</div>
		<div class="panel-body panel_modal_body">
			<table id="table_dusun" class="table table-primary table-striped table-bordered">
				<thead>
					<tr>
						<th width="40px">UND</th>
						<th>NAMA PEMILIH</th>
						<th>PUKUL</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$cfg 	= $this->Cfg->get_data();foreach ($kehadiran->result_array() as $key => $value) { ?>
					<tr>
						<td><?php echo str_pad($value['no_urut'], $cfg['dig_no_und'], "0", STR_PAD_LEFT);?></td>
						<td><?php echo '<b>'.$value['nama_lengkap'].'</b><br>'.$value['dusun']." RT/RW : ".$value['rt'].'/'.$value['rw'];?></td>
						<td><?php echo date_format(date_create($value['datetime_create']),'h:i');?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<ul class="pagination pagination-sm m-t-0 m-b-5">
			<li class="page-item disabled"><a href="javascript:;" class="page-link">«</a></li>
			<?php for ($i=1; $i <= $ceil; $i++) { ?>
				<li class="page-item <?php if($i==$page_view){ echo 'active';}?>"><a href="javascript:;" onclick="get_data_kehadiran(<?php echo $i-1;?>)" class="page-link"><?php echo $i;?></a></li>
			<?php } ?>
		</ul>
	</div>
