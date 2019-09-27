<?php 
	$cfg 			= $this->Cfg->get_data();
	$jml_segment 		= $this->uri->total_segments();
	$base_url_int 		= $this->Cfg->int_uri($jml_segment);
?>
<ol class="breadcrumb pull-right">
	<li class="breadcrumb-item"><a href="<?php echo base_url('dashboard?p=dashboard');?>">Dashboard</a></li>
	<li class="breadcrumb-item active">Data Pemilih</li>
</ol>
<h3 class="page-header"><?php echo $cfg['sistem'] . ' '. ucwords(strtolower($cfg['desa'])) . ' Kec. '. ucwords(strtolower($cfg['kec']));?></h3>
<div class="panel panel-inverse panel_data">
	<div class="panel-heading">
		<div class="panel-heading-btn">
			<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
		</div>
		<h4 class="panel-title title_panel">Database Pemilih dan Kehadiran</h4>
	</div>
	<div class="panel-body panel_data_body">
		<div class="row">
			<div class="col-lg-6 col-md-12">
					<?php foreach ($dapil as $key => $value) { 
							$rekap	= $this->Query->select_where_join2_group_by('data_pemilih', 'pilkades_dapil', 'pilkades_dapil.id=data_pemilih.id_dapil', 
													array('data_pemilih.rw', 
													'SUM(IF(data_pemilih.lp=1,1,0)) as jml_lk',
													'SUM(IF(data_pemilih.lp=2,1,0)) as jml_pr',
													'COUNT(data_pemilih.id) as jumlah',
													),
													array('pilkades_dapil.dapil', 'data_pemilih.rw'),
													'data_pemilih.aktif=1 AND data_pemilih.id_dapil='.$value['id'],
													0, 60, 'data_pemilih.id_dapil, data_pemilih.rw ASC')->result_array();
							$tot_lk			= 0;
							$tot_pr			= 0;
							$tot_jml			= 0;

							$tot_lk_hdr		= 0;
							$tot_pr_hdr		= 0;
							$tot_jml_hdr	= 0;

							$pros_lk_hdr	= 0;
							$pros_pr_hdr	= 0;
							$pros_jml_hdr	= 0;
							if(count($rekap)>0){
					?>
				<h3><?php echo $value['dapil'];?></h3>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th rowspan="2" class="align-middle text-center">RW</th>
							<th colspan="3" class="text-center">DATA PEMILIH</th>
							<th colspan="4" class="text-center">DATA KEHADIRAN</th>
						</tr>

						<tr>
							<th class="text-center">L</th>
							<th class="text-center">P</th>
							<th class="text-center">JML</th>
							<th class="text-center" colspan="1">L</th>
							<th class="text-center" colspan="1">P</th>
							<th class="text-center" colspan="2">JUMLAH</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($rekap as $ey => $row) { 

							$tot_lk			= $tot_lk + $row['jml_lk'];
							$tot_pr			= $tot_pr + $row['jml_pr'];
							$tot_jml			= $tot_jml + $row['jumlah'];
						$rkp				= $this->Query->select_where_join3_group_by('pilkades_kehadiran', 'data_pemilih', 'dusun', 
																	array(
																		'data_pemilih.id=pilkades_kehadiran.id_pemilih', 
																		'dusun.uid=data_pemilih.id_dusun',
																	), 
				                                        array('data_pemilih.rw', 
				                                        	'SUM(IF(data_pemilih.lp=1,1,0)) as jml_lk',
				                                        	'SUM(IF(data_pemilih.lp=2,1,0)) as jml_pr',
				                                        	'COUNT(data_pemilih.id) as jumlah',
				                                        ),
				                                        array('dusun.dusun', 'data_pemilih.rw'),
				                                        'data_pemilih.aktif=1 AND data_pemilih.id_dapil='.$value['id'] . ' AND data_pemilih.rw='.$row['rw'],
				                                        0, 60, 'data_pemilih.id_dusun, data_pemilih.rw ASC');

							$hdr_lk 	= 0; 
							$hdr_pr 	= 0; 
							$jumlah 	= 0; 

							$pros_lk 		= ''; 
							$pros_pr 		= ''; 
							$pros_jumlah 	= ''; 

						if($rkp->num_rows()>0){
							$hadir 	= $rkp->row();

							$hdr_lk 	= ($hadir->jml_lk!=0) ? intval($hadir->jml_lk):0; 
							$hdr_pr 	= ($hadir->jml_pr!=0) ? intval($hadir->jml_pr):0; 
							$jumlah 	= ($hadir->jumlah!=0) ? intval($hadir->jumlah):0; 

							$tot_lk_hdr		= $tot_lk_hdr + $hdr_lk;
							$tot_pr_hdr		= $tot_pr_hdr + $hdr_pr;
							$tot_jml_hdr	= $tot_jml_hdr + $jumlah;

							if($row['jml_lk']>0){ 
							$pros_lk 		= number_format(($hdr_lk/$row['jml_lk'])*100,2).' %';
							}
							if($row['jml_pr']) {
							$pros_pr 		= number_format(($hdr_pr/$row['jml_pr'])*100,2).' %'; 
							}
							$pros_jumlah 	= '<a href="#ModalForm" data-toggle="modal" onclick="get_rekap_hadir('."'".$row['rw']."'".')" class="text-white">'.number_format(($jumlah/$row['jumlah'])*100,2).' %</a>'; 
						}
				   ?>
						<tr>
							<td>&nbsp;&nbsp;<?php echo 'RW:'.$row['rw'];?></td>
							<td class="text-right"><?php echo $row['jml_lk'];?></td>
							<td class="text-right"><?php echo $row['jml_pr'];?></td>
							<td class="text-right"><?php echo $row['jumlah'];?></td>
							<td class="text-right"><span class="" title="<?php echo $pros_lk;?>"><?php echo $hdr_lk;?></span></td>
							<td class="text-right"><span class="" title="<?php echo $pros_pr;?>"><?php echo $hdr_pr;?></td>
							<td class="text-right"><span class="" title="<?php echo $pros_lk;?>"><?php echo $jumlah;?></td>
							<td class="text-right"><?php echo '<badge class="badge badge-primary">'.$pros_jumlah.'</badge>';?></td>
						</tr>
					<?php } ?>
						<tr class="bg-purple-darker">
							<td class="text-right bg-black-transparent-8 text-grey"><b>JUMLAH</b></td>
							<td class="text-right bg-black-transparent-8 text-grey"><b><?php echo number_format($tot_lk);?></b></td>
							<td class="text-right bg-black-transparent-8 text-grey"><b><?php echo number_format($tot_pr);?></b></td>
							<td class="text-right bg-black-transparent-8 text-grey"><b><?php echo number_format($tot_jml);?></b></td>
							<td class="text-right bg-black-transparent-8 text-grey"><span class="" title="<?php echo ($tot_lk>0) ? number_format(($tot_lk_hdr/$tot_lk)*100,2) : 0 .' %';?>"><b><?php echo number_format($tot_lk_hdr);?></b></span></td>
							<td class="text-right bg-black-transparent-8 text-grey"><b><span class="" title="<?php echo ($tot_pr>0) ? number_format(($tot_pr_hdr/$tot_pr)*100,2) : 0 .' %';?>"><?php echo number_format($tot_pr_hdr);?></b></span></td>
							<td class="text-right bg-black-transparent-8 text-grey"><b><?php echo number_format($tot_jml_hdr);?></b></td>
							<td class="text-right bg-black-transparent-8 text-grey"><b><?php echo number_format(($tot_jml_hdr/$tot_jml)*100,2).' %';?></b></td>
						</tr>
					</tbody>
				</table>
			<?php  } }?>
	</div>
	<div class="col-lg-6 col-md-12">
		<h3>Rekapitulasi</h3>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th rowspan="2" class="align-middle text-center">DAPIL</th>
							<th colspan="3" class="text-center">DATA PEMILIH</th>
							<th colspan="4" class="text-center">DATA KEHADIRAN</th>
						</tr>

						<tr>
							<th class="text-center">L</th>
							<th class="text-center">P</th>
							<th class="text-center">JML</th>
							<th class="text-center" colspan="1">L</th>
							<th class="text-center" colspan="1">P</th>
							<th class="text-center" colspan="2">JUMLAH</th>
						</tr>
					</thead>
					<tbody>
					<?php 
							$tot_lk			= 0;
							$tot_pr			= 0;
							$tot_jml			= 0;

							$tot_lk_hdr		= 0;
							$tot_pr_hdr		= 0;
							$tot_jml_hdr	= 0;

							$pros_lk_hdr	= 0;
							$pros_pr_hdr	= 0;
							$pros_jml_hdr	= 0;

							foreach ($dapil as $key => $value) { 
							$rekap				= $this->Query->select_where_join2_group_by('data_pemilih', 'pilkades_dapil', 'pilkades_dapil.id=data_pemilih.id_dapil', 
				                                        array('pilkades_dapil.dapil', 
				                                        	'SUM(IF(data_pemilih.lp=1,1,0)) as jml_lk',
				                                        	'SUM(IF(data_pemilih.lp=2,1,0)) as jml_pr',
				                                        	'COUNT(data_pemilih.id) as jumlah',
				                                        ),
				                                        array('pilkades_dapil.dapil'),
				                                        'data_pemilih.aktif=1 AND data_pemilih.id_dapil='.$value['id'],
				                                        0, 60, 'data_pemilih.id_dapil, data_pemilih.rw ASC')->result_array();

							if(count($rekap)>0){
					 			foreach ($rekap as $ey => $row) { 

									$tot_lk			= $tot_lk + $row['jml_lk'];
									$tot_pr			= $tot_pr + $row['jml_pr'];
									$tot_jml			= $tot_jml + $row['jumlah'];
									$rkp				= $this->Query->select_where_join3_group_by('pilkades_kehadiran', 'data_pemilih', 'dusun', 
																			array(
																				'data_pemilih.id=pilkades_kehadiran.id_pemilih', 
																				'dusun.uid=data_pemilih.id_dusun',
																			), 
						                                        array('dusun.dusun', 
						                                        	'SUM(IF(data_pemilih.lp=1,1,0)) as jml_lk',
						                                        	'SUM(IF(data_pemilih.lp=2,1,0)) as jml_pr',
						                                        	'COUNT(data_pemilih.id) as jumlah',
						                                        ),
						                                        array('dusun.dusun'),
						                                        'data_pemilih.aktif=1 AND data_pemilih.id_dapil='.$value['id'],
						                                        0, 60, 'data_pemilih.id_dusun ASC');

									$hdr_lk 	= ''; 
									$hdr_pr 	= ''; 
									$jumlah 	= ''; 

									$pros_lk 		= ''; 
									$pros_pr 		= ''; 
									$pros_jumlah 	= ''; 

									if($rkp->num_rows()>0){
										$hadir 	= $rkp->row();

										$hdr_lk 	= $hadir->jml_lk; 
										$hdr_pr 	= $hadir->jml_pr; 
										$jumlah 	= $hadir->jumlah; 

										$tot_lk_hdr		= $tot_lk_hdr+$hadir->jml_lk;
										$tot_pr_hdr		= $tot_pr_hdr+$hadir->jml_pr;
										$tot_jml_hdr	= $tot_jml_hdr+$hadir->jumlah;

										$pros_lk 		= number_format(($hdr_lk/$row['jml_lk'])*100,2).' %'; 
										$pros_pr 		= number_format(($hdr_pr/$row['jml_lk'])*100,2).' %'; 
										$pros_jumlah 	= number_format(($jumlah/$row['jumlah'])*100,2).' %'; 
									}
							   ?>
								<tr>
									<td>&nbsp;&nbsp;<?php echo $row['dapil'];?></td>
									<td class="text-right"><?php echo $row['jml_lk'];?></td>
									<td class="text-right"><?php echo $row['jml_pr'];?></td>
									<td class="text-right"><?php echo $row['jumlah'];?></td>
									<td class="text-right"><span class="" title="<?php echo $pros_lk;?>"><?php echo $hdr_lk;?></span></td>
									<td class="text-right"><span class="" title="<?php echo $pros_pr;?>"><?php echo $hdr_pr;?></span></td>
									<td class="text-right"><?php echo $jumlah;?></td>
									<td class="text-right"><?php echo '<badge class="badge badge-primary">'.$pros_jumlah.'</badge>';?></td>
								</tr>
							<?php } ?>
					<?php } ?>
					<?php } if($tot_jml>0){?>
						<tr class="bg-purple-darker">
							<td class="text-right bg-black-transparent-8 text-grey"><b>TOTAL</b></td>
							<td class="text-right bg-black-transparent-8 text-grey"><b><?php echo number_format($tot_lk);?></b></td>
							<td class="text-right bg-black-transparent-8 text-grey"><b><?php echo number_format($tot_pr);?></b></td>
							<td class="text-right bg-black-transparent-8 text-grey"><b><?php echo number_format($tot_jml);?></b></td>
							<td class="text-right bg-black-transparent-8 text-grey"><span class="" title="<?php echo number_format(($tot_lk_hdr/$tot_lk)*100,2).' %';?>"><b><?php echo number_format($tot_lk_hdr);?></b></span></td>
							<td class="text-right bg-black-transparent-8 text-grey"><span class="" title="<?php echo number_format(($tot_pr_hdr/$tot_pr)*100,2).' %';?>"><b><?php echo number_format($tot_pr_hdr);?></b></span></td>
							<td class="text-right bg-black-transparent-8 text-grey"><b><?php echo number_format($tot_jml_hdr);?></b></td>
							<td class="text-right bg-black-transparent-8 text-grey"><b><?php echo number_format(($tot_jml_hdr/$tot_jml)*100,2).' %';?></b></td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
	</div>
	</div>
</div>

<div class="modal fade" id="ModalForm">
    <div class="modal-dialog modal-lg modal-dialog-centered">
    	<div class="modal-content">
    		<div class="panel panel-inverse panel_modal">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger " data-dismiss="modal"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title" id="modal_title"><i class="fa fa-cog"></i> Data Kehadiran</h4>
				</div>
				<div class="panel-body panel_modal_body" data-scrollbar="true" data-height="325px">
					<div id="data_content"></div>
				</div>		
		  </div>
		</div>
	</div>
</div>