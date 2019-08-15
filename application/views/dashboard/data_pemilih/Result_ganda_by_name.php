<table id="table_data_pemilih" class="table table-primary table-striped table-bordered bg-white">
	<thead>
		<tr>
			<th width="30%">NAMA LENGKAP</th>
			<th>DUSUN</th>
			<th>NIK/NO KK</th>
			<th>NIKAH</th>
		</tr>
	</thead>
	<tbody>
	<?php 
		$i=1;
		foreach ($result->result_array() as $key => $value) {
			$nik 	= '';
			if($value['nik']!=""){
				$nik 	=  $this->Set->nik_space($value['nik']);
			}
		echo '<tr id="pemilih'. $value['id'] .'">
				<td id="nama'. $value['id'] .'"><a href="#ModalFormMid" data-toggle="modal" onclick="get_pemilih('. $value['id'] .')"><b>'.$value['nama_lengkap'] .'</b><span class="pull-right">'. $value['lp'] .'</span><br><span class="text-black-transparent-7">'. $value['tmp_lahir'] .', '. $this->Set->tgl_indo_sort(date_create($value['tgl_lahir'])) .'</span></a></td>
				<td id="dsn'. $value['id'] .'">'. $value['dusun']. '<span class="pull-right">'.$value['rt'] .'/'. $value['rw'] .'</span></td>
				<td id="dsn'. $value['id'] .'">'. $nik. '<br>'. $this->Set->nik_space($value['nokk']) .'</td>
				<td id="nkh'. $value['id'] .'">'. $value['sts_nkh'] .'</td>
				</tr>';
				$i++;
			}
	?>
	</tbody>
</table>