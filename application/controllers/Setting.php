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

	public function get_data_dapil($value='')
	{
		$tps 			= $this->Query->select_where('pilkades_dapil', array('id','dapil', 'uid', 'uid_khadir', 'uid_phitung'), array(), 0,20, 'dapil ASC');
		$list_tps 		= '';
		$user_khadir 	= '';
		$user_phitung 	= '';

		foreach ($tps->result_array() as $key => $value) {
			$user_khadir 	= '<a href="#ModalFormSM" data-toggle="modal" onclick="get_new_user('. 1 . ',' . $value['id'] .')" class="btn btn-xs btn-inverse m-r-5"><i class="fa fa-plus"></i></a>';
			$user_phitung 	= '<a href="#ModalFormSM" data-toggle="modal" onclick="get_new_user('. 2 . ',' . $value['id'] .')" class="btn btn-xs btn-inverse m-r-5"><i class="fa fa-plus"></i></a>';

			if($value['uid_khadir']!=""){
				$uid_khadir = explode(',', $value['uid_khadir']);
				for ($i=0; $i < count($uid_khadir); $i++) { 
					$usr 		= $this->Query->select_where('users_profile', array('uid', 'CONCAT(nama_depan," ", nama_belakang) as user'), array('uid'=> $uid_khadir[$i]),0,1,'id ASC');
					if($usr->num_rows()>0){
						$user 	 = $usr->row();
						$user_khadir .= '<span class="badge badge-success m-r-5" id="user'. 1 .$value['id'] . $uid_khadir[$i] .'">' . $user->user .' <a href="javascript:;" title="Hapus User ' . $user->user .'" class="text-white" onclick="remove_user('. 1 .','.$value['id'] .','. $uid_khadir[$i] .')"><i class="fa fa-times"></i></a></span>';
					}
				}
			}

			if($value['uid_phitung']!=""){
				$uid_phitung = explode(',', $value['uid_phitung']);
				for ($i=0; $i < count($uid_phitung); $i++) { 
					$usr 		= $this->Query->select_where('users_profile', array('CONCAT(nama_depan," ", nama_belakang) as user'), array('uid'=> $uid_phitung[$i]),0,1,'id ASC');
					if($usr->num_rows()>0){
						$user = $usr->row();
						$user_phitung .= '<span class="badge badge-success m-r-5" id="user'. 2 .$value['id'] . $uid_phitung[$i] .'">' . $user->user .' <a href="javascript:;" title="Hapus User ' . $user->user .'" class="text-white" onclick="remove_user('. 2 .','.$value['id'] .','. $uid_phitung[$i] .')"><i class="fa fa-times"></i></a></span>';
					}
				}
			}

			$list_tps 	.= '<tr id="list_dapil'.$value['id'].'">
									<td>
										<a href="#ModalFormSM" data-toggle="modal" class="todolist-container" data-click="todolist" onclick="get_form_update_dapil('.$value['id'].')">'.$value['dapil'].'</a>
									</td>
									<td width="40%" id="user_dapil'. 1 .$value['id'].'">'. $user_khadir .'</td>
									<td width="40%" id="user_dapil'. 2 .$value['id'].'">'. $user_phitung .'</td>
									</tr>';
		}

		$data_tps 	= '<h3>DAPIL <small>Daerah Pemilihan</small>
		<a href="#ModalFormSM" data-toggle="modal" onclick="get_form_add_dapil()" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i></a>
		<a href="javascript:;" onclick="reload_dapil()" class="btn btn-success btn-sm pull-right m-r-5"><i class="fa fa-undo"></i></a>
		</h3><table class="table table-primary table-bordered" id="table_dapil_list">
			<thead>
				<tr>
					<th>DAPIL</th>
					<th>PETUGAS KEHADIRAN</th>
					<th>PETUGAS PENGHITUNGAN</th>
				</tr>
			</thead>
			<tbody>
			'.$list_tps.'</tbody></table>';
		echo json_encode(array('sts'=> true, 'data_tps'=> $data_tps));
	}

	public function remove_user()
	{
		$this->form_validation->set_rules('jns','Jenis', 'required|trim|is_numeric');
		$this->form_validation->set_rules('id_dapil','id_dapil', 'required|trim|is_numeric');
		$this->form_validation->set_rules('uid','User', 'required|trim|is_numeric');
		if($this->form_validation->run()==true){
			$jns 			= $this->input->post('jns');
			$id_dapil 	= $this->input->post('id_dapil');
			$uid 			= $this->input->post('uid');

			if($jns==1){
				$select 	= array('uid_khadir as uid_user');
			}else if($jns==2){
				$select 	= array('uid_phitung as uid_user');
			}

			$uid_upd 	= '';
			$dapil 		= $this->Query->select_where('pilkades_dapil', $select, array('id'=> $id_dapil),0,1,'id ASC')->row();
			if($dapil->uid_user!=""){
				$uid_select = explode(',', $dapil->uid_user);
				if(COUNT($uid_select)>1){
					for ($i=0; $i < COUNT($uid_select); $i++) {
						if($uid_select[$i] != $uid){ 
							$uid_upd 	.= ','. $uid_select[$i];
						}
					}
					$uid_upd = substr($uid_upd, 1);
				}else{
					$uid_upd = '';
				}
			}

			if($jns==1){
				$data 	= array('uid_khadir'=> $uid_upd);
			}else if($jns==2){
				$data 	= array('uid_phitung'=> $uid_upd);
			}

			$upd = $this->Query->updateData('pilkades_dapil', $data, array('id'=> $id_dapil));
			if($upd==true){
				echo json_encode(array('sts'=> true));
			}
		}else{
			echo json_encode(array('sts'=> false, 'msg'=> validation_errors()));
		}
	}

	public function get_new_user($value='')
	{
		$data['jns'] 		= $this->input->get('jns');
		$data['id_dapil'] = $this->input->get('id_dapil');
		if($data['jns']==1){
			$select 			= array('uid_khadir as uid_user');
			$otoritas 		= 4;
		}else if($data['jns']==2){
			$select 			= array('uid_phitung as uid_user');
			$otoritas 		= 5;
		}

		$get_user_dapil 	= $this->Query->select_where('pilkades_dapil', $select, array(),0,15,'id ASC');
		$selected 			= '';
		foreach ($get_user_dapil->result_array() as $key => $value) {
			if($value['uid_user']!=""){
				$selected 	.= ','.$value['uid_user'];
			}
		}

		if($selected!=""){
			$selected 	= substr($selected, 1);
			$get_user 			= $this->db->Query('SELECT users.uid, CONCAT(users_profile.nama_depan," ", users_profile.nama_belakang) as opr  FROM users INNER JOIN users_profile ON users_profile.uid=users.uid where users.uid NOT IN('.$selected.') ORDER BY users.uid ASC')->result_array();
		}else{
			$get_user 			= $this->db->Query('SELECT users.uid, CONCAT(users_profile.nama_depan," ", users_profile.nama_belakang) as opr  FROM users INNER JOIN users_profile ON users_profile.uid=users.uid where 1 ORDER BY users.uid ASC')->result_array();
		}

		
		// $get_user 			= $this->Query->select_where('users', array('uid', 'rules_akses'), array(),0,100,'uid ASC');
		// $rules 				= '';
		// $uid_rule 			= '';
		// $rules_akses 		= '';
		// foreach ($get_user->result_array() as $key => $value) {
		// 	$rules_akses 		.= ','.$value['rules_akses'];
		// 	if($value['rules_akses']!=""){
		// 		$rules 	= explode(',', $value['rules_akses']);
		// 		for ($i=0; $i < COUNT($rules); $i++) { 
		// 			if($rules[$i] ==$otoritas){ //jika user kehadiran
		// 				$uid_rule 	.= ','.$value['uid'];
		// 			}
		// 		}
		// 	}
		// }

		$data['get_user'] 		= $get_user;
		// $data['uid_rule'] 		= substr($uid_rule, 1);
		// $data['rules_akses'] 	= substr($rules_akses, 1);

		$this->load->view('dashboard/config/Form_add_user_dapil', $data);
	}

	public function add_user_dapil($value='')
	{
		$this->form_validation->set_rules('uid_user','', 'required|trim|numeric');
		$this->form_validation->set_rules('id_dapil','', 'required|trim');
		$this->form_validation->set_rules('jns','', 'required|trim|numeric');
		if($this->form_validation->run()==true){
			$uid_user 	= $this->input->post('uid_user');
			$id_dapil 	= $this->input->post('id_dapil');
			$jns 			= $this->input->post('jns');
			$user 		= $this->input->post('user');
			if($jns==1){
				$data = array('uid_khadir as uid_opr');
			}else if($jns==2){
				$data = array('uid_phitung as uid_opr');
			}

			$get 			= $this->Query->select_where('pilkades_dapil', 
																	$data, 
																	array('id'=> $id_dapil), 0,1, 'id ASC')->row();
			
			if($get->uid_opr!=""){
				$uid 	= $get->uid_opr . ",".$uid_user;
				// $uid 	= substr($uid, 1);
			}else{
				$uid 	= $uid_user;
			}
			
			if($jns==1){
				$upd = $this->db->Query('UPDATE pilkades_dapil set uid_khadir="'. $uid .'" WHERE id='.$id_dapil);
			}else if($jns==2){
				$upd = $this->db->Query('UPDATE pilkades_dapil set uid_phitung="'. $uid .'" WHERE id='.$id_dapil);
			}
			if($upd==true){
				$user = '<span class="badge badge-success m-r-5" id="user'. $jns . $id_dapil . $uid_user .'">' . $user .' <a href="javascript:;" title="Hapus User ' . $user .'" class="text-white" onclick="remove_user('. $jns .','.$id_dapil .','. $uid_user .')"><i class="fa fa-times"></i></a></span>';
				echo json_encode(array('sts'=> true, 'jns'=> $jns, 'id_dapil'=> $id_dapil, 'user'=> $user));
			}
		}
	}

	public function get_data()
	{
		$cln 			= $this->Query->select_where('pilkades_calon', array('id','nomor', 'nama_calon', 'photo'), array(), 0,20, 'nomor ASC');
		$list_calon	= '';
		foreach ($cln->result_array() as $key => $value) {
			$list_calon .='<li id="cakades'.$value['id'].'">
								<a href="#ModalFormMid" data-toggle="modal" onclick="get_form_update_cakades('.$value['id'].')"><img src="'. base_url('assets/img/user/c'. $value['nomor'] .'.png') .'" alt=""></a>
								<h4 class="username text-ellipsis">
									'.$value['nomor'].'
									<small>'.$value['nama_calon'].'</small>
								</h4>
							</li>';
		}
		$data_calon = '<h3>CAKADES <small>Calon Kepala Desa</small>
		<a href="#ModalFormMid" data-toggle="modal" onclick="get_add_form_cakades()" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i></a>
		<a href="javascript:;" onclick="reload_dapil()" class="btn btn-success btn-sm pull-right m-r-5"><i class="fa fa-undo"></i></a>
		</h3><ul class="registered-users-list clearfix row" id="cakades_list">'. $list_calon .'</ul>';
		echo json_encode(array('sts'=> true, 'data_calon'=> $data_calon));
	}

	public function get_dapil()
	{
		$id_tps 	= $this->input->get('id_tps');
		$data 	= $this->Query->select_where(); 
	}

	public function get_form_add_dapil()
	{
		$this->load->view('dashboard/config/Form_add_dapil');
	}

	public function add_dapil($value='')
	{
		$this->form_validation->set_rules('dapil','Dapil', 'required|trim');
		if($this->form_validation->run()==true){
			$dapil 		= $this->input->post('dapil');
			$response 	= $this->Query->insertData('pilkades_dapil', array(
													'dapil' 		=> $dapil,
												));
			if($response==true){
				$last_id = $this->db->insert_id();
				$list 	= '<li id="list_dapil'. $last_id .'"><a href="#ModalFormSM" data-toggle="modal" class="todolist-container" data-click="todolist" onclick="get_form_update_dapil('. $last_id .')">
											<div class="todolist-input text-inverse">'.$dapil.'</div>
											<div class="todolist-title"></div>
										</a></li>';
			echo json_encode(array('sts'=> true,'msg'=> 'Dapil berhasil disimpan', 'list'=> $list));
			}
		}else{
			echo json_encode(array('sts'=> false,'msg'=> validation_errors()));
		}
	}

	public function get_dapil_update($value='')
	{
		$dapil_id 			= $this->input->get('dapil_id');
		$data['result'] 	= $this->Query->select_where('pilkades_dapil', array('*'), array('id'=> $dapil_id),0,1,'id ASC')->row();
		$this->load->view('dashboard/config/Form_dapil_update', $data);
	}

	public function dapil_update($value='')
	{
		$this->form_validation->set_rules('dapil','Dapil', 'required|trim');
		$this->form_validation->set_rules('dapil_id','Dapil ID', 'required|trim|is_numeric');
		if($this->form_validation->run()==true){
			$dapil 		= $this->input->post('dapil');
			$dapil_id 	= $this->input->post('dapil_id');
			$response 	= $this->Query->updateData('pilkades_dapil', array(
													'dapil' 		=> $dapil,
												), array(
													'id'=> $dapil_id));
			if($response==true){
				$dapil 	= $dapil;
			echo json_encode(array('sts'=> true,'msg'=> 'Dapil berhasil diperbaharui', 'dapil'=> $dapil, 'dapil_id'=> $dapil_id));
			}
		}else{
			echo json_encode(array('sts'=> false,'msg'=> validation_errors()));
		}
	}

	public function remove_dapil($value='')
	{
		$this->form_validation->set_rules('dapil_id','Dapil ID', 'required|trim|is_numeric');
		if($this->form_validation->run()==true){
			$dapil_id 	= $this->input->post('dapil_id');
			$response 	= $this->Query->deleteData('pilkades_dapil',  array(
													'id'=> $dapil_id));
			if($response==true){
			echo json_encode(array('sts'=> true,'msg'=> 'Dapil berhasil dihapus', 'dapil_id'=> $dapil_id));
			}
		}else{
			echo json_encode(array('sts'=> false,'msg'=> validation_errors()));
		}
	}

	public function get_add_form_cakades()
	{
		$this->load->view('dashboard/config/Form_cakades_add');
	}

	public function add_cakades($value='')
	{
		$this->form_validation->set_rules('nomor','Nomor Urut', 'required|trim|is_numeric');
		$this->form_validation->set_rules('nama','Nama', 'required|trim');
		$this->form_validation->set_rules('gender','Jenis Kelamin', 'required|trim|is_numeric');
		$this->form_validation->set_rules('lahir_tmp','Tempat Lahir', 'required|trim');
		$this->form_validation->set_rules('tgl','Tanggal Lahir', 'required|trim|is_numeric');
		$this->form_validation->set_rules('bln','Bulan Lahir', 'required|trim|is_numeric');
		$this->form_validation->set_rules('thn','Tahun Lahir', 'required|trim|is_numeric');
		$this->form_validation->set_rules('pend_tingkat','Tingkat Pendidikan', 'required|trim|is_numeric');
		$this->form_validation->set_rules('pend_nama','Nama Pendidikan', 'required|trim');
		$this->form_validation->set_rules('pend_thn','Tahun Tamat Pendidikan', 'required|trim|is_numeric');
		if($this->form_validation->run()==true){
			$nama 			= $this->input->post('nama');
			$gender 			= $this->input->post('gender');
			$lahir_tmp 		= $this->input->post('lahir_tmp');
			$tanggal 		= $this->input->post('thn').'/'.$this->input->post('bln').'/'.$this->input->post('tgl');
			$pend_tingkat 	= $this->input->post('pend_tingkat');
			$pend_nama 		= $this->input->post('pend_nama');
			$pend_thn 		= $this->input->post('pend_thn');
			$nomor 			= $this->input->post('nomor');

			$response 	= $this->Query->insertData('pilkades_calon', array(
													'nama_calon'	=> $nama,
													'gender' 		=> $gender,
													'lahir_tmp' 	=> $lahir_tmp,
													'lahir_tgl' 	=> $tanggal,
													'pend_tingkat' => $pend_tingkat,
													'pend_nama' 	=> $pend_nama,
													'pend_thn' 		=> $pend_thn,
													'nomor' 			=> $nomor,
												));
			if($response==true){
				$last_id = $this->db->insert_id();
				$list 	= '<li id="cakades'.$last_id.'">
								<a href="#ModalFormMid" data-toggle="modal" onclick="get_form_update_cakades('.$last_id.')"><img src="'. base_url('assets/img/user/c'. $nomor .'.png') .'" alt=""></a>
								<h4 class="username text-ellipsis">
									'.$nomor.'
									<small>'.$nama.'</small>
								</h4>
							</li>';
			echo json_encode(array('sts'=> true,'msg'=> 'Cakades berhasil disimpan', 'list'=> $list));
			}
		}else{
			echo json_encode(array('sts'=> false,'msg'=> validation_errors()));
		}
	}

	public function get_form_update_cakades($value='')
	{
		$cakades_id 		= $this->input->get('cakades_id');
		$data['result'] 	= $this->Query->select_where('pilkades_calon', array('*'), array('id'=> $cakades_id),0,1,'id ASC')->row();
		$this->load->view('dashboard/config/Form_cakades_update', $data);
	}

	public function update_cakades($value='')
	{
		$this->form_validation->set_rules('cakades_id','Calon', 'required|trim|is_numeric');
		$this->form_validation->set_rules('nomor','Nomor Urut', 'required|trim|is_numeric|less_than_equal_to[5] ');
		$this->form_validation->set_rules('nama','Nama', 'required|trim');
		$this->form_validation->set_rules('gender','Jenis Kelamin', 'required|trim|is_numeric');
		$this->form_validation->set_rules('lahir_tmp','Tempat Lahir', 'required|trim');
		$this->form_validation->set_rules('tgl','Tanggal Lahir', 'required|trim|is_numeric');
		$this->form_validation->set_rules('bln','Bulan Lahir', 'required|trim|is_numeric');
		$this->form_validation->set_rules('thn','Tahun Lahir', 'required|trim|is_numeric');
		$this->form_validation->set_rules('pend_tingkat','Tingkat Pendidikan', 'required|trim|is_numeric');
		$this->form_validation->set_rules('pend_nama','Nama Pendidikan', 'required|trim');
		$this->form_validation->set_rules('pend_thn','Tahun Tamat Pendidikan', 'required|trim|is_numeric');
		if($this->form_validation->run()==true){
			$cakades_id 	= $this->input->post('cakades_id');
			$nama 			= $this->input->post('nama');
			$gender 			= $this->input->post('gender');
			$lahir_tmp 		= $this->input->post('lahir_tmp');
			$tanggal 		= $this->input->post('thn').'/'.$this->input->post('bln').'/'.$this->input->post('tgl');
			$pend_tingkat 	= $this->input->post('pend_tingkat');
			$pend_nama 		= $this->input->post('pend_nama');
			$pend_thn 		= $this->input->post('pend_thn');
			$nomor 			= $this->input->post('nomor');

			$response 	= $this->Query->updateData('pilkades_calon', array(
													'nama_calon'	=> $nama,
													'gender' 		=> $gender,
													'lahir_tmp' 	=> $lahir_tmp,
													'lahir_tgl' 	=> $tanggal,
													'pend_tingkat' => $pend_tingkat,
													'pend_nama' 	=> $pend_nama,
													'pend_thn' 		=> $pend_thn,
													'nomor' 			=> $nomor,
												), array(
													'id'	=> $cakades_id,
												));
			if($response==true){
				$data 	= '<a href="#ModalFormMid" data-toggle="modal" onclick="get_form_update_cakades('.$cakades_id.')"><img src="'. base_url('assets/img/user/c'. $nomor .'.png') .'" alt=""></a>
								<h4 class="username text-ellipsis">
									'.$nomor.'
									<small>'.$nama.'</small>
								</h4>';
				echo json_encode(array('sts'=> true,'msg'=> 'Cakades berhasil disimpan', 'cakades_id'=> $cakades_id, 'cakades'=> $data));
			}
		}else{
			echo json_encode(array('sts'=> false,'msg'=> validation_errors()));
		}
	}

	public function remove_cakades($value='')
	{
		$this->form_validation->set_rules('cakades_id','Dapil ID', 'required|trim|is_numeric');
		if($this->form_validation->run()==true){
			$cakades_id 	= $this->input->post('cakades_id');
			$response 		= $this->Query->deleteData('pilkades_calon',  array(
													'id'=> $cakades_id));
			if($response==true){
			echo json_encode(array('sts'=> true,'msg'=> 'Cakades berhasil dihapus', 'cakades_id'=> $cakades_id));
			}
		}else{
			echo json_encode(array('sts'=> false,'msg'=> validation_errors()));
		}
	}
}