<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Kehadiran extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        $this->Sesi->is_logged();  
 	}

 	public function index()
 	{
 		$uid 						= $this->session->userdata('uid');
 		$data['kehadiran']	= $this->Query->select_where_join3('pilkades_kehadiran', 'data_pemilih', 'dusun', 
 															array(
 																'data_pemilih.id=pilkades_kehadiran.id_pemilih',
 																'dusun.uid=data_pemilih.id_dusun',
 															), 
		                                       array('pilkades_kehadiran.id', 'data_pemilih.no_urut', 'data_pemilih.nik', 'data_pemilih.nama_lengkap', 'pilkades_kehadiran.antri',
		                                       'dusun.dusun', 'data_pemilih.rt', 'data_pemilih.rw', 'pilkades_kehadiran.datetime_create'),
		                                       array('id_uid'=> $uid),0, 500, 'pilkades_kehadiran.id DESC'
		                                     );
 		$this->load->view('dashboard/kehadiran/Kehadiran_index', $data);
 	}

 	public function cek_kehadiran($value='')
 	{
		$this->form_validation->set_rules('key_search','Key Search', 'required|trim');
		if($this->form_validation->run()==true){
	 		$key_search 	= $this->input->post('key_search');

	 		if(is_numeric($key_search)){
	 			$get_cek 	= $this->Query->select_where_join2('data_pemilih', 'dusun', 'dusun.uid=data_pemilih.id_dusun', 
		                                        array('data_pemilih.id', 'data_pemilih.no_urut', 'data_pemilih.nik', 'data_pemilih.nama_lengkap', 'data_pemilih.tmp_lahir', 'data_pemilih.tgl_lahir', 'dusun.dusun', 'IF(data_pemilih.lp=1,"Laki-laki","Perempuan") as lp','data_pemilih.rt', 'data_pemilih.rw', 'IF(data_pemilih.sts_nikah=0,"BELUM", IF(data_pemilih.sts_nikah=1,"SUDAH","PERNAH"))as sts_nkh'),
		                                        'data_pemilih.aktif=1  AND data_pemilih.no_urut='.$key_search,
		                                        0, 1 , 'data_pemilih.id ASC');
	 			if($get_cek->num_rows()>0){
	 				
	 				$pemilih 	= $get_cek->row();
	 				$cfg 			= $this->Cfg->get_data();
	 				$cek_hadir 	= $this->Query->select_where_join3('pilkades_kehadiran', 'data_pemilih', 'users_profile',
	 													array('data_pemilih.id=pilkades_kehadiran.id_pemilih', 'users_profile.uid=pilkades_kehadiran.id_uid'), 
	 													array('data_pemilih.nama_lengkap', 'data_pemilih.rt', 'data_pemilih.rw', 'pilkades_kehadiran.datetime_create', 'CONCAT(users_profile.nama_depan," ", users_profile.nama_belakang) as operator'), 
	 													array('data_pemilih.no_urut'=> $key_search),0,1, 'pilkades_kehadiran.id ASC');
	 				if($cek_hadir->num_rows()>0){
	 					$pemilih 	= $cek_hadir->row();
	 					echo json_encode(array('sts'=> false, 'msg'=> '<div class="alert alert-pink fade show m-b-10">
										<span class="close" data-dismiss="alert" onclick="cancel_kehadiran()">×</span><h3><b>'.$pemilih->nama_lengkap. '</b></h3>Nomor Undangan : <b>'. str_pad($key_search, $cfg['dig_no_und'], "0", STR_PAD_LEFT) .'</b><br><h3><span class="text-danger"><b>SUDAH HADIR</b></span></h3>pada jam '. $pemilih->datetime_create .'<br>Melalui : <b>'. $pemilih->operator .'</b></div>'));
	 					exit;
	 				}

	 				$nik 		= '<b>'. $pemilih->lp .'</b>';
	 				if($pemilih->nik!=""){
	 					$nik 	= '<b>'.$pemilih->lp . '</b>, NIK : <strong>'.$pemilih->nik .'</strong>';
	 				}
	 				$status 	= '<form  autocomplete="off" action="'. './kehadiran/post_kehadiran' .'" id="form_post_kehadiran" class="mt-3" method="POST">
			 				<div class="input-append input-group">
								<input class="form-control form-control-lg" name="accept_id" id="accept_id" type="text" placeholder="Enter untuk Simpan, Esc untuk batal">
								<input class="d-none" name="accept_id_ok" id="accept_id_ok" type="text" value="'.  $pemilih->id .'">
								<button type="submit" class="add-on input-group-addon" title="Enter untuk simpan" ><i class="fa fa-check"></i></button>
							</div>
						<div class="mt-1"><a href="javascript:void(0)" class="text-inverse" onclick="cancel_kehadiran()"><b>Enter</b> untuk Simpan, <b>Esc</b> pembatalan</a></div></form>';
		 			echo json_encode(array('sts'=> true, 'data'=> '<div class="alert alert-success fade show m-b-10">
										<span class="close" data-dismiss="alert" onclick="cancel_kehadiran()">×</span>
										<address class="m-t-5 m-b-5">
							<h4><strong class="text-inverse">'. str_pad($pemilih->no_urut, $cfg['dig_no_und'], "0", STR_PAD_LEFT) .'</strong></h4>
							<strong class="text-inverse h3">'. $pemilih->nama_lengkap .'</strong><br>'. $nik .'<br>
							'. $pemilih->dusun .' RT/RW : '. $pemilih->rt .'/'. $pemilih->rw .'<br>
						</address>'.
						$status.'</div>'));
		 		}else{
		 			echo json_encode(array('sts'=> false, 'msg'=> '<div class="alert alert-danger fade show m-b-10">
										<span class="close" data-dismiss="alert" onclick="cancel_kehadiran()">×</span>Data tidak ditemukan</div>'));
		 		}
	 		}else{
	 			echo json_encode(array('sts'=> true, 'data'=> '<div class="alert alert-danger fade show m-b-10">
										<span class="close" data-dismiss="alert" onclick="cancel_kehadiran()">×</span>Isian harus angka</div>'));
	 		}
	 		
	 	}else{
	 		echo json_encode(array('sts'=> false, 'msg'=> '<div class="alert alert-danger fade show m-b-10">
										<span class="close" data-dismiss="alert" onclick="cancel_kehadiran()">×</span>'.validation_errors().'</div>'));
	 	}
 	}

 	public function post_kehadiran()
 	{
		$this->form_validation->set_rules('accept_id_ok','ID Pemilih', 'required|trim|numeric');
		if($this->form_validation->run()==true){
	 		$accept_id 	= $this->input->post('accept_id_ok');
	 		$cek_hadir 	= $this->Query->select_where_join2('pilkades_kehadiran', 'data_pemilih', 
	 													'data_pemilih.id=pilkades_kehadiran.id_pemilih', 
	 													array('data_pemilih.nama_lengkap', 'data_pemilih.rt', 'data_pemilih.rw', 'data_pemilih.no_urut', 'pilkades_kehadiran.datetime_create'), 
	 													array('id_pemilih'=> $accept_id),0,5, 'pilkades_kehadiran.id ASC');
	 		$cfg 			= $this->Cfg->get_data();
	 		if($cek_hadir->num_rows()>0){
	 			$pemilih 	= $cek_hadir->row();

	 			echo json_encode(array('sts'=> false, 'data'=>  '<div class="alert alert-pink fade show m-b-10">
										<span class="close" data-dismiss="alert">×</span><b><h3>'.$pemilih->nama_lengkap. '</h3></b>dengan Nomor Undangan : <b>'. str_pad($pemilih->no_urut, $cfg['dig_no_und'], "0", STR_PAD_LEFT) .'</b><br><span class="text-danger"><b>SUDAH HADIR</b></span><br>pada jam '. $pemilih->datetime_create .'</div>'));
	 		}else{
	 			$no_antri 	= '';
	 			if($cfg['antri']>0){
	 				$hdr 			= $this->Query->select_where('pilkades_kehadiran', array('COUNT(id) as hadir'), array(),0,1, 'id ASC')->row();
		 			$limit 		= $cfg['antri'];
		 			$hadir      = $hdr->hadir+1;
		 			if($hdr->hadir==0){
		 				$hadir 		= 1;
		 			}
		 			$hdr_ceil 	= ceil($hadir/$limit);
		 			$no_antri 	= '<div class="widget-list-content">
								<h4 class="widget-list-title" title="Nomor Antri">'.$limit-(($hdr_ceil*$limit)-$hadir).'</h4>
							</div>';
		 		}

		 		$waktu 	= $this->Set->now_print();

	 			$this->Query->insertData('pilkades_kehadiran', 
	 																		array(
	 																			'id_pemilih'			=> $accept_id,
	 																			'antri'					=> $no_antri,
	 																			'datetime_create'		=> $waktu,
	 																			'id_uid'					=> $this->session->userdata('uid'),
	 																		));
	 			$data 	= $this->Query->select_where_join3('pilkades_kehadiran', 'data_pemilih', 'dusun', 
	 														array(
		 														'data_pemilih.id=pilkades_kehadiran.id_pemilih', 
		 														'dusun.uid=data_pemilih.id_dusun', 
		 													),
		                                        array('data_pemilih.id', 'data_pemilih.no_urut', 'data_pemilih.nik', 'data_pemilih.nama_lengkap', 'data_pemilih.tmp_lahir', 'data_pemilih.tgl_lahir', 'dusun.dusun', 'IF(data_pemilih.lp=1,"L","P") as lp','data_pemilih.rt', 'data_pemilih.rw', 'IF(data_pemilih.sts_nikah=0,"BELUM", IF(data_pemilih.sts_nikah=1,"SUDAH","PERNAH"))as sts_nkh'),
		                                        'data_pemilih.aktif=1  AND data_pemilih.id='.$accept_id,
		                                        0, 1 , 'data_pemilih.id ASC');
	 			if($data->num_rows()>0){

	 				$data 	= $data->row();
	 				$alamat 	= $data->dusun .' RT/RW : '. $data->rt .'/'. $data->rw;
	 				$time 	= $this->Set->now_time();
	 				$hadir 	= '<a href="javascript:void(0)" class="widget-list-item">
							<div class="widget-list-media icon">
								<span class="bg-inverse text-white bg-grey-darker  box_no_und" title="Nomor Undangan" style="">'. str_pad($data->no_urut, $cfg['dig_no_und'], "0", STR_PAD_LEFT) .'</span>
							</div>
							<div class="widget-list-content">
								<h4 class="widget-list-title">'. $data->nama_lengkap .'</h4>
								<span class="text-muted">'. $alamat .'</span>
							</div>
							'. $no_antri .'
							<div class="widget-list-action text-right">
								<span class="bg-inverse text-white" title="Pukul Hadir">'.$time.'</span>
							</div>
						</a>';
	 				$gritter 	= array('pemilih'=> $data->nama_lengkap, 'no_urut'=> $data->no_urut, 'alamat'=> $alamat, 'time'=> $time);
	 			}else{
	 				$hadir 	= '';
	 				$gritter 	= array();
	 			}
	 			echo json_encode(array('sts'=> true, 'data'=>$hadir, 'gritter'=> $gritter, 'msg'=>'Data kehadiran berhasil disimpan'));
	 		}
 		}else{
 			echo json_encode(array('sts'=> false, 'msg'=> validation_errors()));
 		}
 	}

 	public function get_data_kehadiran($value='')
 	{
 		$page 					= $this->input->get('page');
 		$limit 					= 10;
 		$filter 					= 'pilkades_kehadiran.id_uid='. $this->session->userdata('uid');
 		$total 					= $this->Query->select_where_join3('pilkades_kehadiran', 'data_pemilih', 'dusun', 
 															array(
 																'data_pemilih.id=pilkades_kehadiran.id_pemilih',
 																'dusun.uid=data_pemilih.id_dusun',
 															), 
		                                       array('COUNT(data_pemilih.id) total'),
		                                       $filter,0, 1,'pilkades_kehadiran.id ASC'
		                                     )->row();
 		$ceil 					= ceil($total->total/$limit);
 		$index					= $page*$limit;
 		$data['ceil'] 			= $ceil;
 		$data['kehadiran'] 	= $this->Query->select_where_join3('pilkades_kehadiran', 'data_pemilih', 'dusun', 
 															array(
 																'data_pemilih.id=pilkades_kehadiran.id_pemilih',
 																'dusun.uid=data_pemilih.id_dusun',
 															), 
		                                       array('pilkades_kehadiran.id', 'data_pemilih.no_urut', 'data_pemilih.nik', 'data_pemilih.nama_lengkap', 
		                                       'dusun.dusun', 'data_pemilih.rt', 'data_pemilih.rw', 'pilkades_kehadiran.datetime_create'),
		                                       $filter,$index, $limit,'pilkades_kehadiran.id DESC'
		                                     );
 		$data['page']			= $page;
 		$data['page_view']	= $page+1;
 		$this->load->view('dashboard/kehadiran/Kehadiran_modal', $data);
 	}
 }