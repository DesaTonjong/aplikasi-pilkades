<table class="table table-striped table-bordered">
<thead>
	<tr>
		<th width="30%;" class="text-center">DUSUN</th>
		<th width="25%;" class="text-center">UND</th>
		<th width="25%;" class="text-center">L</th>
		<th width="25%;" class="text-center">P</th>
		<th width="20%;" class="text-center">JUMLAH</th>
	</tr>
<tbody>
	</thead>
		<?php $jml_lk=0; $jml_pr=0; foreach ($rekap as $ey => $row) { ?>
			<tr>
				<td>
					<a href="javascript:;"><?php echo '<b>'.$row['field']. '</b>';?></a>
				</td>
				<td class="text-center"><?php echo $row['start'].'-'.$row['end'];?></td>
				<td class="text-right"><?php echo number_format($row['jml_lk']);?></td>
				<td class="text-right"><?php echo number_format($row['jml_pr']);?></td>
				<td class="text-right"><?php echo number_format($row['total']);?></td>
			</tr>
		<?php $jml_pr += $row['jml_pr']; $jml_lk +=$row['jml_lk']; } ?>
			<tr>
				<td colspan="2" class="text-right"><b>JUMLAH TOTAL</b></td>
				<td class="text-right"><b><?php echo number_format($jml_lk);?></b></td>
				<td class="text-right"><b><?php echo number_format($jml_pr);?></b></td>
				<td class="text-right"><b><?php echo number_format($jml_lk + $jml_pr);?></b></td>
			</tr>
	</tbody>
</table>