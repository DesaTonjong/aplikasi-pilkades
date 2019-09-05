<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->load->view('Home');
	}
	
	public function login($value='')
	{
		$data['csrf'] = array(
		        'name' => $this->security->get_csrf_token_name(),
		        'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('login', $data);
	}
	
	public function login_validation()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|md5');
		if($this->form_validation->run()==true){
			$jml_segment 	= $this->uri->total_segments();
			$base_url_int 	= $this->Cfg->int_uri($jml_segment);

			$email 			= $this->input->post('username');
			$password 		= $this->input->post('password');
			$data 			= array();
			$user_check 	= $this->Query->select_where_join2('users', 'users_profile', 'users_profile.uid=users.uid',
																array(
																	'concat(users_profile.nama_depan," ", users_profile.nama_belakang) as username',
																	'users.uid', 'users.rules_akses', 'users.id_akses'
																), array(
																	'users.password' 			=> $password,
																	'users_profile.email'	=> $email,
																),0,1, 'users.id ASC');
			if($user_check->num_rows()>0){
				$row 		= $user_check->row();
				$rules 		= explode(',', $row->rules_akses);
				$akses 		= array();
				foreach ($rules as $key => $value) {
					if($value==3){
						$akses['adminpilkades'] = 'Admin Pilkades';
					}else if($value==4){
						$akses['opr_pilkades'] = 'Operator Pilkades';
					}else if($value==5){
						$uid_khadir = '';
						$uid_hitung = '';
						$get 	= $this->Query->select_where('pilkades_dapil', array('id', 'uid', 'uid_khadir', 'uid_phitung'), array(),0,15, 'id ASC');
						foreach ($get->result_array() as $key => $value) {
							if($value['uid_khadir']!=""){
								$uid_khadir = explode(',', $value['uid_khadir']);
								for ($i=0; $i < COUNT($uid_khadir); $i++) { 
									if($row->uid==$uid_khadir[$i]){
										$akses['dapil_khadir'] = array('id'=>$value['id'],'uid'=>$value['uid']);
									}
								}
							}
							if($value['uid_phitung']!=""){
								$uid_hitung = explode(',', $value['uid_phitung']);
								for ($i=0; $i < COUNT($uid_hitung); $i++) { 
									if($row->uid==$uid_hitung[$i]){
										$akses['dapil_phitung'] = array('id'=>$value['id'],'uid'=>$value['uid']);
									}
								}
							}
						}
					}
				}
				
				$data 	= array('uid'=> $row->uid, 'username'=> $row->username, 'akses'=> $akses);
				$this->session->set_userdata($data);
				echo json_encode(array('sts'=>true, 'msg'=> 'Login Anda Sukses', 'url'=> $base_url_int.'dashboard?p=dashboard'));
			}else{
				// $data['csrf'] = array(
				//         'name' => $this->security->get_csrf_token_name(),
				//         'hash' => $this->security->get_csrf_hash()
				// );
				echo json_encode(array('sts'=> false, 'data'=> $data, 'msg'=> 'Username dan Password anda salah', 'url'=>  $base_url_int.'home/login'));
			}
		}else{
			// $data['csrf'] = array(
			//         'name' => $this->security->get_csrf_token_name(),
			//         'hash' => $this->security->get_csrf_hash()
			// );
			echo json_encode(array('sts'=> false, 'data'=> $data, 'msg'=> validation_errors(), 'url'=>  $base_url_int.'home/login'));
		}
	}
	public function logout()
	{
			$jml_segment 	= $this->uri->total_segments();
			$base_url_int 	= $this->Cfg->int_uri($jml_segment);
		$this->session->sess_destroy();
		//$this->cache->clean();
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		//header('location:'.base_url());	
		header('Location:'. $base_url_int.'home/login');
	}

	public function cek_pemilih($value='')
	{
		$this->form_validation->set_rules('nik_ktp', 'NIK', 'required|trim');
		if($this->form_validation->run()==true){
			$nik 	= $this->input->post('nik_ktp');
			$get 	= $this->Query->select_where_join2('data_pemilih', 'dusun', 'dusun.uid=data_pemilih.id_dusun', 
								array('data_pemilih.nama_lengkap','data_pemilih.rw','data_pemilih.rt','dusun.dusun'),
								array('data_pemilih.nik'=> $nik),0,1,'data_pemilih.id ASC'
							);
			if($get->num_rows()>0){
				$pemilih 	= $get->row();
				$data 		= '<div class="form-group row m-b-15"><div class="col-md-9 offset-md-3"><p><br><strong>'. $pemilih->nama_lengkap .'</strong><br>
								Dusun '. $pemilih->dusun . ' RT/RW: '. $pemilih->rt .'/'. $pemilih->rw .'<br><span class="text-success">Anda terdaftar sebagai Pemilih</span>
							</p></div></div>';
				echo json_encode(array('sts'=> true,'data'=> $data)); 
			}else{
				echo json_encode(array('sts'=> false, 'msg'=> '<div class="form-group row m-b-15"><div class="col-md-9 offset-md-3 text-danger">Data tidak ditemukan</div></div>'));
			}
		}else{
			echo json_encode(array('sts'=> false, 'msg'=> '<div class="form-group row m-b-15"><div class="col-md-9 offset-md-3 text-danger">'. validation_errors().'</div></div>'));
		}
	}
}

