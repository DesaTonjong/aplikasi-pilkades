<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Hitung extends CI_Controller {
  //   public function __construct()
  //   {
  //       parent::__construct();
  //       $this->load->helper(array('form', 'url'));
  //       $this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
  //       $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
  //       $this->output->set_header('Pragma: no-cache');
  //       $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
  //       $this->Sesi->isAdmin();  
 	// }

 	public function post_hitung($value='')
 	{
 		$this->form_validation->set_rules('id_calon', 'Calon', 'required|trim');
 		$this->form_validation->set_rules('jumlah', 'Perolehan', 'required|trim');
 		if($this->form_validation->run()==true){
 			$id_calon 	= $this->input->post('id_calon');
 			$suara 		= $this->input->post('jumlah');
 			$now_print 	= $this->Set->now_print();
 			$uid 			= '112244';#$this->session->userdata('uid');
 			$get_tps		= $this->Query->select_where('pilkades_tps', array('id', 'tps'), array('uid'=> $uid),0,1,'id ASC');
 			if($get_tps->num_rows()>0){
 				$data		= $get_tps->row();
 				$id_tps	= $data->id;

 				$cek  	= $this->Query->select_where('pilkades_hitung', array('id','id_tps'), array('id_tps'=> $id_tps, 'id_calon'=> $id_calon),0,1,'id ASC');
 				if($cek->num_rows()>0){
 					$hitung 	= $cek->row();
 					$id 		= $hitung->id; 
 					//update
 					$this->Query->updateData('pilkades_hitung', 
 										array(
 											'id_calon' 					=> $id_calon, 
 											'id_tps'						=> $id_tps, 
 											'jumlah' 					=> $suara, 
 											'uid' 						=> $uid,
 											'datetime_update' 		=> $now_print,
 										),
 										array('id'=> $id ));
 				}else{
 					//add
 					$this->Query->insertData('pilkades_hitung', 
 										array(
 											'id_calon' 					=> $id_calon, 
 											'id_tps'						=> $id_tps, 
 											'jumlah' 					=> $suara, 
 											'uid' 						=> $uid,
 											'datetime_update' 		=> $now_print,
 										));
 				}
 			}else{

 			}
 		}
 	}
 }