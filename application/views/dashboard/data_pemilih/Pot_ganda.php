<table class="table table-striped table-bordered bg-white">
	<thead>
		<tr>
			<th width="60px;" class="text-center" colspan="2"><?php echo $filter;?></th>
			<th width="60px;" class="text-center">JML</th>
		</tr>
		</thead>
	<tbody>
		<?php $i=1; foreach ($rekap as $ey => $row) { ?>
			<tr>
				<td><?php echo $i;?></td>
				<td>
					<?php if($id_filter==1){ ?>
						<a href="javascript:;" onclick="get_ganda_name(<?php echo "'". $row['nama_lengkap']."'";?>)"><?php echo '<b>'.$row['nama_lengkap']. '</b>';?></a>
					<?php } ?>
					<?php if($id_filter==2){ ?>
						<a href="javascript:;" onclick="get_ganda_nik(<?php echo "'". $row['nik']."'";?>)"><?php echo '<b>'.$row['nik']. '</b>';?></a>
					<?php } ?>
					<?php if($id_filter==3){ ?>
						<a href="javascript:;" onclick="get_ganda_tgl_lahir(<?php echo "'". $row['tgl_lahir']."'";?>)"><?php echo '<b>'.$row['tgl_lahir']. '</b>';?></a>
					<?php } ?>
				</td>
				<td class="text-right"><?php echo $row['jml'];?></td>
			</tr>
		<?php $i++; } ?>
	</tbody>
</table>
