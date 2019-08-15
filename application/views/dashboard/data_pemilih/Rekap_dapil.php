<table class="table table-striped table-bordered">
<thead>
	<tr>
		<th width="30%;" class="text-center">DUSUN</th>
		<th width="25%;" class="text-center">UND</th>
		<th width="25%;" class="text-center">L/P</th>
		<th width="20%;" class="text-center">JUMLAH</th>
	</tr>
<tbody>
	</thead>
		<?php foreach ($rekap as $ey => $row) { ?>
			<tr id="row<?php echo $row['id_dapil'] .$row['id_dusun'] . $row['rt'].$row['rw'];?>">
				<td>
					<a href="javascript:;" onclick="get_data_filter(<?php echo "'".$row["id_dusun"] ."','". $row["rt"]."','".$row["rw"] ."','0"."'";?>)"><?php echo '<b>'.$row['dusun']. '</b> <br>RT : '.$row['rt'].'/'.$row['rw'];?></a>
				</td>
				<td class="text-center"><?php echo $row['start'].'-'.$row['end'];?></td>
				<td><?php echo $row['jml_lk'];?><span class="pull-right"><?php echo $row['jml_pr'];?></span></td>
				<td class="text-right"><a href="#ModalFormSM" data-toggle="modal" onclick="set_dapil(<?php echo "'".$row["id_dapil"] ."','". $row["id_dusun"] ."','". $row["rt"]."','".$row["rw"]."'";?>)" class="btn btn-xs btn-default m-l-5 pull-right" title="Set Dapil"><i class="far fa-lg fa-fw fa-list-alt"></i></a><?php echo $row['total'];?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>