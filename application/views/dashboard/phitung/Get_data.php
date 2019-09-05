<?php
$list_calon = '';
foreach ($calon->result_array() as $key => $value) {
   $get = $this->Query->select_where_group_by('pilkades_hitung_manual', 
               array('COUNT(id) as jml'),
               array(),
               array('id_cal'=> $value['id'], 'id_dapil'=> $id_dapil), 0,1, 'id ASC'
               )->row();
   $suara = 0;
   $persen = number_format(0,1);
   if($get){
      $suara = number_format($get->jml);

      $persen = number_format(0,1);
      if($tot_suara->tot_suara>0){
      $persen = number_format(($get->jml/$tot_suara->tot_suara)*100,1);
      }
   }
   $list_calon .='<div id="cakades'.$value['id'].'" class="col-lg-6">
                  <div class="card border-0 bg-dark text-white text-white">
                     <div class="row align-items-center p-5">
								<div class="col-3">
									<div class="height-100 d-flex ">
                              <img src="'. base_url('assets/img/user/c'. $value['nomor'] .'.png') .'" class="mw-100 mh-100 rounded" alt="">
									</div>
								</div>
								<div class="col-9">
									<div class="m-b-2 text-truncate f-w-700">'.$value['nama_calon'].'</div>
									<div class="d-flex align-items-center m-b-2" id="persen'. $value['id']. '">
										<div class="flex-grow-1">
											<div class="progress progress-xs rounded-corner bg-white-transparent-1">
												<div class="progress-bar bg-indigo" data-animation="width" data-value="'. $persen.'%" style="width: '. $persen.'%;"></div>
											</div>
										</div>
										<div class="ml-2 f-s-11 width-50 text-center text-muted"><span data-animation="number" data-value="'. $persen.'" class="f-s-18 f-w-700 text-white">'. $persen.'</span>%</div>
									</div>
									<div class="text-grey f-s-11 m-b-15 text-truncate">
                           <span class="f-s-18 f-w-700" id="suara'. $value['id']. '">'.$suara.'</span> suara, dari <span class="f-s-14 f-w-700 tot_suara">'. $tot_suara->tot_suara .'</span> total suara
									</div>
								</div>
							</div>
                  </div>
               </div>';
}
echo '<div class="row" id="cakades_list">'. $list_calon .'</div>';
?>

