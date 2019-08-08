<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Setting extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        $this->Sesi->isAdmin();  
 	}

	public function update_config()
	{
		$this->form_validation->set_rules('desa_kode','', 'required|trim|numeric');
		$this->form_validation->set_rules('sistem','', 'required|trim');
		$this->form_validation->set_rules('dig_no_und','', 'required|trim|numeric');
		$this->form_validation->set_rules('antri','', 'required|trim|numeric');
		if($this->form_validation->run()==true){
			$desa_kode 				= $this->input->post('desa_kode');
			$sistem 					= $this->input->post('sistem');
			$dig_no_und 			= $this->input->post('dig_no_und');
			$antri 					= $this->input->post('antri');
			$this->Query->updateData('config', array(
													'desa_kode' 		=> $desa_kode,
													'sistem' 			=> $sistem,
													'dig_no_und' 		=> $dig_no_und,
													'antri' 				=> $antri,
												),
											array(
												'id'	=> 1
											));
			echo json_encode(array('sts'=> true,'msg'=> 'Config berhasil diupdate'));
		}else{
			echo json_encode(array('sts'=> false,'msg'=> validation_errors()));
		}
	}

	public function get_data()
	{
		$tps 			= $this->Query->select_where('pilkades_tps', array('id','tps', 'uid'), array(), 0,20, 'tps ASC');
		$list_tps 	= '';
		$user_tps 	= '';

		foreach ($tps->result_array() as $key => $value) {
			$usr 		= $this->Query->select_where('users_profile', array('CONCAT(nama_depan," ", nama_belakang) as user'), array('uid'=> $value['uid']),0,1,'id ASC');
			$user_tps 	= '';
			if($usr->num_rows()>0){
				$user 	= $usr->row();
				$user_tps= $user->user;
			}
			$list_tps 	.= '<li><a href="#ModalForm" data-toggle="modal" class="todolist-container" data-click="todolist" onclick="get_tps('.$value['id'].')">
										<div class="todolist-input text-inverse">TPS '.$value['tps'].'</div>
										<div class="todolist-title">'.$user_tps.'</div>
									</a></li>';
		}

		$data_tps 	= '<h3>Data TPS</h3><ul class="todolist" id="list_tps">'.$list_tps.'</ul>';

		$cln 			= $this->Query->select_where('pilkades_calon', array('id','nomor', 'nama_calon', 'photo'), array(), 0,20, 'nomor ASC');
		$list_calon	= '';
		foreach ($cln->result_array() as $key => $value) {
			$list_calon .='<li>
								<a href="javascript:;"><img src="'. base_url('assets/img/user/c'. $value['nomor'] .'.png') .'" alt=""></a>
								<h4 class="username text-ellipsis">
									'.$value['nomor'].'
									<small>'.$value['nama_calon'].'</small>
								</h4>
							</li>';
		}
		$data_calon = '<h3>Data Calon</h3><ul class="registered-users-list clearfix row" id="list_calon">'. $list_calon .'</ul>';
		echo json_encode(array('sts'=> true, 'data_tps'=> $data_tps, 'data_calon'=> $data_calon));
	}

	public function get_tps()
	{
		$id_tps 	= $this->input->get('id_tps');
		$data 	= $this->Query->select_where(); 
	}
}