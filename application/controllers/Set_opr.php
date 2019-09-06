<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Set_opr extends CI_Controller {
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

    public function get_data()
    {
    	$data['users']		= $this->Query->select_where_join2('users','users_profile', 'users_profile.uid=users.uid',
    																			array(
    																				'users.uid',
    																				'CONCAT(users_profile.nama_depan," ", users_profile.nama_belakang) as nama_user',
    																				'users_profile.email','users.rules_akses',
    																			), array(), 0,30, 'users.uid ASC');
    	$this->load->view('dashboard/User_operator', $data);
    }

    public function add_new($value='')
    {
    		$this->load->view('dashboard/config/User_opr_addform');
    }

    public function add_new_post($value='')
    {
		$this->form_validation->set_rules('nama_depan','', 'required|trim');
		$this->form_validation->set_rules('nama_belakang','', 'required|trim');
		$this->form_validation->set_rules('email_login_user','', 'required|trim');
		$this->form_validation->set_rules('password_login_user','', 'required|trim');
		if($this->form_validation->run()==true){
			$nama_depan 		= $this->input->post('nama_depan');
			$nama_belakang 	= $this->input->post('nama_belakang');
			$email_login 		= $this->input->post('email_login_user');
			$password_login 	= $this->input->post('password_login_user');
			$data_pemilih 			= $this->input->post('data_pemilih');
			$cek_kehadiran 		= $this->input->post('cek_kehadiran');
			$penghitungan 		= $this->input->post('penghitungan');

			$akses 				= '';
			$rules_akses 		= '';
			if(isset($data_pemilih)){
				$akses 			.= '<span class="badge badge-primary">Data Pemilih</span> ';
				$rules_akses 	.= ','.$data_pemilih;
			}
			if(isset($cek_kehadiran)){
				$akses 			.= '<span class="badge badge-purple">Cek Kehadiran</span> ';
				$rules_akses 	.= ','.$cek_kehadiran;
			}
			if(isset($penghitungan)){
				$akses 			.= '<span class="badge badge-purple">Set Penghitungan</span> ';
				$rules_akses 	.= ','.$penghitungan;
			}
			$rules_akses = substr($rules_akses, 1);

			$uid = $this->Set->generateNumber(8);
			//simpan user profile
			$this->Query->insertData('users', array('uid'=> $uid, 'password'=> md5($password_login), 'rules_akses'=> $rules_akses));

			//simpan user login
			$this->Query->insertData('users_profile', array('uid'=> $uid, 'nama_depan'=> $nama_depan, 'nama_belakang'=> $nama_belakang, 'email'=> $email_login));

			$tr_row = '<tr id="row'. $uid .'">
							<td>new</td>
							<td><a href="javascript:void(0)" id="user" onclick="get_edit_user('."'". $uid ."'".')">'. $nama_depan .' '. $nama_belakang .'</a></td>
							<td id="mail'. $uid .'">'. $email_login .'</td>
							<td id="rule'. $uid .'">'. $akses .'</td>
							<td id="pass'. $uid .'"><button class="btn btn-info btn-xs" title="Reset Password" onclick="reset_pass('. $uid .')"><i class="fa fa-redo"></i></button> <span class="pull-right">'.$password_login.'</span></td>
							</tr>';
	    	echo json_encode(array('sts'=> true, 'trow'=> $tr_row));
	   }
    }

    public function get_edit_user($value='')
    {
    	$uid 			= $this->input->get('uid');
    	$user 		= $this->Query->select_where_join2('users','users_profile', 'users_profile.uid=users.uid',
    																		array(
    																			'users.uid',
    																			'users_profile.nama_depan', 'users_profile.nama_belakang', 'users_profile.email',
    																			'users.uid', 'users.rules_akses'
    																		),array('users.uid'=>$uid),0,1, 'users.uid ASC');
    	if($user->num_rows()>0){
    		$data['user'] 			= $user->row();
    		$this->load->view('dashboard/config/User_opr_updateform', $data);
    	}else{

    	}
    }

    public function update_user()
    {
		$this->form_validation->set_rules('nama_depan','', 'required|trim');
		$this->form_validation->set_rules('uid','', 'required|trim');
		$this->form_validation->set_rules('nama_belakang','', 'required|trim');
		$this->form_validation->set_rules('email_login_user','', 'required|trim');
		if($this->form_validation->run()==true){
			$uid 					= $this->input->post('uid');
			$nama_depan 		= $this->input->post('nama_depan');
			$nama_belakang 	= $this->input->post('nama_belakang');
			$email_login 		= $this->input->post('email_login_user');
			$data_pemilih 		= $this->input->post('data_pemilih');
			$cek_kehadiran 	= $this->input->post('cek_kehadiran');
			$penghitungan 		= $this->input->post('penghitungan');
			$password 			= $this->input->post('password_login_user');

			$akses 			= '';
			$rules_akses 	= '';
			if(isset($data_pemilih)){
				$akses 			.= '<span class="badge badge-primary">Data Pemilih</span> ';
				$rules_akses 	.= ','.$data_pemilih;
			}
			if(isset($cek_kehadiran)){
				$akses 			.= '<span class="badge badge-purple">Cek Kehadiran</span> ';
				$rules_akses 	.= ','.$cek_kehadiran;
			}
			if(isset($penghitungan)){
				$akses 			.= '<span class="badge badge-pink">Penghitungan</span> ';
				$rules_akses 	.= ','.$penghitungan;
			}
			$rules_akses = substr($rules_akses, 1);

			$update 		= array('rules_akses'=> $rules_akses);
			if($password!=""){
				$update 		= array('rules_akses'=> $rules_akses, 'password'=> md5($password));
			}

			$this->Query->updateData('users', $update, array('uid'=> $uid));
			$this->Query->updateData('users_profile', array('nama_depan'=> $nama_depan, 'nama_belakang'=> $nama_belakang, 'email'=> $email_login), array('uid'=> $uid));

			$data = array('uid'=> $uid, 'nama_user'=> $nama_depan .' '. $nama_belakang, 'mail'=> $email_login, 'rule'=> $akses); 

			echo json_encode(array('sts'=> true, 'data'=> $data));
		}else{

		}
    }

    public function reset_pass($value='')
    {
		$this->form_validation->set_rules('uid','', 'required|trim');
		if($this->form_validation->run()==true){
			$uid 			= $this->input->post('uid');
			$new_pass 	= $this->Set->generateString_text(3) .$this->Set->generateNumber(3);
			$this->Query->updateData('users', array('password'=> md5($new_pass)), array('uid'=> $uid));
			echo json_encode(array('sts'=> true, 'uid'=> $uid, 'new_pass'=> '<button class="btn btn-info btn-xs" title="Reset Password" onclick="reset_pass('. $uid .')"><i class="fa fa-redo"></i></button> <span class="pull-right">'.$new_pass.'</span>'));
		}
    }

    public function remove_user()
    {
		$this->form_validation->set_rules('uid','', 'required|trim');
		if($this->form_validation->run()==true){
			$uid 			= $this->input->post('uid');
			$uid_admin	= $this->session->userdata('uid');
			if($uid!=$uid_admin){
				$this->Query->deleteData('users',  array('uid'=> $uid));
				$this->Query->deleteData('users_profile',  array('uid'=> $uid));
				echo json_encode(array('sts'=> true, 'uid'=> $uid));
			}else{
				echo json_encode(array('sts'=> false, 'msg'=> 'User tidak dapat dihapus'));
			}
		}
    }
 }