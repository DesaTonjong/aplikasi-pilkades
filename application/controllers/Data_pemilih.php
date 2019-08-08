<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;		
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
class Data_pemilih extends CI_Controller {
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

	public function index()
	{

	}

	public function get_data()
	{
		$key_search = $this->input->get('key_search');
		$id_dusun   = $this->input->get('id_dusun');
		$rt   		= $this->input->get('rt');
		$rw   		= $this->input->get('rw');
		$page   		= $this->input->get('page');
		$perpage   	= 20;
		$filt_data  = 'Data Pemilih ';

		$start_page = $page * $perpage;
		$filter      = ' data_pemilih.aktif=1 ';
		$sort 		= 'data_pemilih.no_urut ASC';
		if($key_search!=""){
			if(is_numeric($key_search)){
				$filter      .= ' AND data_pemilih.no_urut LIKE "%'.$key_search.'%"';
				$sort 		= 'data_pemilih.no_urut ASC';
			}else{
				$string = preg_replace('/\s+/', ' ', $key_search);
				if(stripos($string, '-')==TRUE){
					$str 	= explode('-', $string);
					$filter      .= ' AND data_pemilih.no_urut >='.$str[0] .' AND data_pemilih.no_urut <=' . $str[1];
					$sort 		= 'data_pemilih.no_urut ASC';
				}else if(stripos($string, ',')==TRUE){
					$filter      .= ' AND data_pemilih.no_urut IN ('. $string .')';
					$sort 		= 'data_pemilih.no_urut ASC';
				}else{
					$filter      .= ' AND data_pemilih.nama_lengkap LIKE "%'.$key_search.'%"';
					$sort 		= 'data_pemilih.no_urut ASC';
				}
			}
		}

		if($id_dusun!=""){
			$filter      .= ' AND data_pemilih.id_dusun='.$id_dusun;
			$get 			= $this->Query->select_where('dusun', array('dusun'), array('uid'=> $id_dusun),0,1,'id ASC')->row();
			$filt_data 	  .= $get->dusun;
		}

		if($rt!=""){
			$filter      .= ' AND data_pemilih.rt='.$rt;
			$filt_data 	  .= ', RT ' .$rt;
		}

		if($rw!=""){
			$filter      .= ' AND data_pemilih.rw='.$rw;
			$filt_data 	  .= '/' .$rw;
		}
		$rekap       = $this->Query->select_where_join2_group_by('data_pemilih', 'dusun', 'dusun.uid=data_pemilih.id_dusun', 
															array(
															'MIN(data_pemilih.no_urut) as start',
															'MAX(data_pemilih.no_urut) as end',
															'SUM(IF(data_pemilih.lp=1,1,0)) as jml_lk',
															'SUM(IF(data_pemilih.lp=2,1,0)) as jml_pr',
															'COUNT(data_pemilih.id) as total',
															),
															array(),
															$filter,
															0, 1, $sort)->row();

		$data       = $this->Query->select_where_join2('data_pemilih', 'dusun', 'dusun.uid=data_pemilih.id_dusun', 
														array('data_pemilih.id', 'data_pemilih.no_urut', 'data_pemilih.nik', 'data_pemilih.nama_lengkap', 'data_pemilih.tmp_lahir', 'data_pemilih.tgl_lahir', 'dusun.dusun', 'IF(data_pemilih.lp=1,"L","P") as lp','data_pemilih.rt', 'data_pemilih.rw', 'IF(data_pemilih.sts_nikah=0,"BELUM", IF(data_pemilih.sts_nikah=1,"SUDAH","PERNAH"))as sts_nkh'),
														$filter,
														$start_page, $perpage, $sort);
		$tr_row = '';
		$i      = 1;
		foreach ($data->result_array() as $key => $value) {
			$nik 	= '';
			if($value['nik']!=""){
				$nik 	= '<br>'. $this->Set->nik_space($value['nik']);
			}
		   $tr_row .= '<tr id="pemilih'. $value['id'] .'">
								<td id="select'. $value['id'] .'"><div class="checkbox checkbox-css">
											<input type="checkbox" name="select_urut" class="selected_urut" id="cssCheckbox1'. $value['id'] .'" value="'. $value['id'] .'" checked="">
											<label for="cssCheckbox1'. $value['id'] .'">'. $value['no_urut'] .'</label>
										</div>
								</td>
								<td id="nama'. $value['id'] .'"><a href="#ModalFormMid" data-toggle="modal" onclick="get_pemilih('. $value['id'] .')"><b>'.$value['nama_lengkap'] .'</b><span class="pull-right">'. $value['lp'] .'</span><span class="text-black-transparent-7">'. $nik. '</span></a></td>
								<td id="dsn'. $value['id'] .'">'. $value['dusun'] .' '. $value['rt'] .'/'. $value['rw'] .'</td>
								<td id="nkh'. $value['id'] .'">'. $value['sts_nkh'] .'</td>
								</tr>';
		   $i++;
		}

		if($data->num_rows()>=$perpage){
			$tr_row 	.= '<tr id="load_more" class="load_more"><td colspan="6" class="text-center"><a href="javascript:;" onclick="get_data('. intval($page + 1) .')" class="load_more_loader">Load more..</a></td></tr>';
		}

		$filter_result = '<span>' . $filt_data . '</span>';
		echo json_encode(array('sts'=>true, 'filter'=> $filter_result, 'rekap'=> $rekap, 'data'=> $tr_row, 'id_dusun'=> $id_dusun, 'rt'=> $rt, 'rw'=> $rw));
	}

	public function get_form_add()
	{
		$data['nom']	= $this->Query->select_where('data_pemilih', array('max(no_urut) as nom'), array('aktif'=> 1), 0,1, 'id DESC')->row();
		$this->load->view('dashboard/data_pemilih/Form_add', $data);
	}

	public function add_data_pemilih()
	{
		$this->form_validation->set_rules('nik','', 'trim');
		$this->form_validation->set_rules('nama_lengkap','', 'required|trim');
		$this->form_validation->set_rules('lp','', 'required|trim');
		$this->form_validation->set_rules('id_dusun','', 'required|trim');
		$this->form_validation->set_rules('rt','', 'required|trim');
		$this->form_validation->set_rules('rw','', 'required|trim');
		$this->form_validation->set_rules('sts_nikah','', 'required|trim');
		$this->form_validation->set_rules('dusun','', 'required|trim');
		$this->form_validation->set_rules('no_urut','', 'required|trim');
		$this->form_validation->set_rules('nokk','', 'trim');

		if($this->form_validation->run()==true){
			$nik 				= $this->input->post('nik');
			$nama_lengkap 	= $this->input->post('nama_lengkap');
			$lp 				= $this->input->post('lp');
			$id_dusun 		= $this->input->post('id_dusun');
			$rt 				= $this->input->post('rt');
			$rw 				= $this->input->post('rw');
			$sts_nikah 		= $this->input->post('sts_nikah');
			$dusun 			= $this->input->post('dusun');
			$no_urut  		= $this->input->post('no_urut');
			$nokk  			= $this->input->post('nokk');

			//cek nomor undangan
			$cek 			= $this->Query->select_where('data_pemilih', array('no_urut'), array('no_urut'=> $no_urut), 0,1, 'no_urut ASC');
			if($cek->num_rows()>0){
				echo json_encode(array('sts'=> false, 'msg'=> 'Nomor Urut sudah tersedia, coba yang lain'));
				exit();
			}

			//cek nik
			if($nik!=""){
				$cek 			= $this->Query->select_where('data_pemilih', array('nik'), array('nik'=> $nik), 0,1, 'nik ASC');
				if($cek->num_rows()>0){
					echo json_encode(array('sts'=> false, 'msg'=> 'NIK sudah tersedia, coba yang lain'));
					exit();
				}
			}

			$this->Query->insertData('data_pemilih', array(
																			'nik'				=> $nik,
																			'nama_lengkap' => $nama_lengkap,
																			'lp'				=> $lp,
																			'id_dusun'		=> $id_dusun,
																			'rt'				=> $rt,
																			'rw'				=> $rw,
																			'sts_nikah'		=> $sts_nikah,
																			'no_urut'		=> $no_urut,
																			'nokk'			=> $nokk,
																		));

			$nom	= $this->Query->select_where('data_pemilih', array('max(no_urut) as nom'), array('aktif'=> 1), 0,1, 'id DESC')->row();
			echo json_encode(array('sts'=> true, 'last_nom'=> $nom->nom + 1, 'data'=> $nama_lengkap . '<br>'. $dusun, 'msg'=> 'Telah berhasil dimasukan'));
		}else{
			echo json_encode(array('sts'=> false, 'msg'=> validation_errors()));
		}
	}

	public function get_edit_data($value='')
	{
		$id_pemilih 	= $this->input->get('id_pemilih');
		$get 	= $this->Query->select_where('data_pemilih', array('data_pemilih.*'), array('id'=> $id_pemilih), 0,1, 'id ASC');
		if($get->num_rows()>0){
			$data['data'] 	= $get->row();
			$this->load->view('dashboard/data_pemilih/Form_edit', $data);
		}else{
			echo 'Data tidak ditemukan';
		}
	}

	public function update_data_pemilih()
	{
		$this->form_validation->set_rules('id_pemilih','', 'required|trim');
		$this->form_validation->set_rules('nik','', 'required|trim');
		$this->form_validation->set_rules('nama_lengkap','', 'required|trim');
		$this->form_validation->set_rules('lp','', 'required|trim');
		$this->form_validation->set_rules('id_dusun','', 'required|trim');
		$this->form_validation->set_rules('rt','', 'required|trim');
		$this->form_validation->set_rules('rw','', 'required|trim');
		$this->form_validation->set_rules('sts_nikah','', 'required|trim');
		$this->form_validation->set_rules('dusun','', 'required|trim');
		$this->form_validation->set_rules('no_urut','', 'required|trim');
		$this->form_validation->set_rules('nokk','', 'trim');

		if($this->form_validation->run()==true){
			$id 				= $this->input->post('id_pemilih');
			$nik 				= $this->input->post('nik');
			$nama_lengkap 	= $this->input->post('nama_lengkap');
			$lp 				= $this->input->post('lp');
			$id_dusun 		= $this->input->post('id_dusun');
			$rt 				= $this->input->post('rt');
			$rw 				= $this->input->post('rw');
			$sts_nikah 		= $this->input->post('sts_nikah');
			$dusun 			= $this->input->post('dusun');
			$no_urut  		= $this->input->post('no_urut');
			$nokk  			= $this->input->post('nokk');

			$this->Query->updateData('data_pemilih', 
											array(
												'nik' 				=> $nik,
												'nama_lengkap'		=> $nama_lengkap,
												'lp'					=> $lp,
												'rt'					=> $rt,
												'rw'					=> $rw,
												'id_dusun'			=> $id_dusun,
												'sts_nikah'			=> $sts_nikah,
												'nokk'				=> $nokk,
											),
												array('id' 		=> $id)
											);
			$nkh 	= '';
			$gdr 	= '';

			if($sts_nikah==0){
				$nkh 	= 'BELUM';
			}else if($sts_nikah==1){
				$nkh 	= 'SUDAH';
			}else if($sts_nikah==2){
				$nkh 	= 'PERNAH';
			}

			if($lp==1){
				$gdr 	= 'L';
			}else if($lp==2){
				$gdr 	= 'P';
			}

			if($nik!=""){
				$nik 	= $this->Set->nik_space($nik);
			}

			$data['id']			= $id;
			$data['select']	= '<div class="checkbox checkbox-css">
											<input type="checkbox" name="select_urut" class="selected_urut" id="cssCheckbox1'. $id .'" value="'. $id .'" checked="">
											<label for="cssCheckbox1'. $id .'">'. $no_urut .'</label>
										</div>';
			$data['nama']		= '<a href="#ModalFormMid" data-toggle="modal" onclick="get_pemilih('. $id .')"><b>'.$nama_lengkap .'</b></br><span class="text-black-transparent-7">'. $nik. '</span></a>';
			$data['dsn']		= $dusun;
			$data['gdr']		= $gdr;
			$data['rtrw']		= $rt . '/'. $rw;
			$data['nkh']		= $nkh;
			echo json_encode(array('sts'=> true, 'data'=> $data));
		}	
	}

	public function get_data_rt($value='')
	{
		$id_dusun 	= $this->input->get('id_dusun');
		$filter 		= array();
		if($id_dusun!=100){
			$filter = array('id_dusun'=> $id_dusun);
		}
		$data = $this->Query->select_where_group_by('data_pemilih', 
														array('data_pemilih.rt'), 
														array('data_pemilih.rt'),
														$filter, 0, 50, 'rw ASC')->result_array();
		echo json_encode(array('sts'=> true,'data'=> $data));
	}

	public function get_form_dusun()
	{
		$data['dusun']		= $this->Query->select_where('dusun', 
													array('*'), 
													array(), 0,40,'uid ASC');
		$this->load->view('dashboard/data_pemilih/Dusun_form', $data);
	}

	public function get_edit_dusun()
	{
		$id 		= $this->input->get('id_dusun');
		$dusun	= $this->Query->select_where('dusun', array('*'), array('id'=> $id), 0,1,'uid ASC');
		if($dusun->num_rows()>0){
			$data['dusun'] = $dusun->row();
			$this->load->view('dashboard/data_pemilih/Dusun_form_edit', $data);
		}else{
			echo 'Data tidak ditemukan';
		}
	}

	public function update_dusun()
	{
		$this->form_validation->set_rules('id','', 'required|trim|numeric');
		$this->form_validation->set_rules('uid','', 'required|trim|numeric');
		$this->form_validation->set_rules('dusun','', 'required|trim');
		if($this->form_validation->run()==true){
			$id 		= $this->input->post('id');
			$uid 		= $this->input->post('uid');
			$dusun 	= $this->input->post('dusun');
			$this->Query->updateData('dusun', array('uid'=> $uid, 'dusun'=> $dusun), array('id'=> $id));
			$data 	= array('id'=> $id, 'uid'=> $uid, 'dusun'=> '<a href="javascript:void(0)" onclick="get_edit_dusun('.$id.')">'.$dusun.'</a>');
			echo json_encode(array('sts'=> true, 'msg'=> 'Dusun berhasil diperbarui', 'data'=> $data));
		}else{
			echo json_encode(array('sts'=> false, 'msg'=> validation_errors()));
		}
	}

	public function add_new_dusun($value='')
	{
		$this->load->view('dashboard/data_pemilih/Dusun_form_add');
	}

	public function add_new_dusun_action($value='')
	{
		$this->form_validation->set_rules('uid','', 'required|trim|numeric');
		$this->form_validation->set_rules('dusun','', 'required|trim');
		if($this->form_validation->run()==true){
			$uid 		= $this->input->post('uid');
			$dusun 	= $this->input->post('dusun');
			$this->Query->insertData('dusun', array('uid'=> $uid, 'dusun'=> $dusun));
			$dsn	= $this->Query->select_where('dusun', array('id'), array('uid'=> $uid, 'dusun'=> $dusun), 0,1,'id ASC')->row();
			$id 		= $dsn->id;
			$data 	= array('dusun'=> '<tr><td>'.$uid.'</td><td><a href="javascript:void(0)" onclick="get_edit_dusun('.$id.')">'.$dusun.'</a></td></tr>');
			echo json_encode(array('sts'=> true, 'msg'=> 'Dusun berhasil ditambahkan', 'data'=> $data));
		}else{
			echo json_encode(array('sts'=> false, 'msg'=> validation_errors()));
		}
	}

	public function remove_dusun()
	{
		$this->form_validation->set_rules('id_dusun','', 'required|trim|numeric');
		if($this->form_validation->run()==true){
			$id_dusun 	= $this->input->post('id_dusun');
			$this->Query->deleteData('dusun', array('id'=> $id_dusun));
			echo json_encode(array('sts'=> true, 'msg'=> 'Dusun berhasil dihapus'));
		}
	}

	public function print_und_pemilih()
	{
		$id_list 	= $this->input->get('clist');
		$uid 			= $this->session->userdata('uid');
		$margin		= $this->Query->select_where('print_und_setup', array('*'), array('uid_user'=> $uid), 0,1,'id ASC');
		if($margin->num_rows()>0){
			if($id_list!=""){
				$id_list= preg_replace("/-/", ",", $id_list);
				$data['pemilih'] 	= $this->Query->select_where_join2('data_pemilih', 'dusun', 'dusun.uid=data_pemilih.id_dusun', 
																	array('data_pemilih.id', 'data_pemilih.no_urut', 'data_pemilih.nik', 'data_pemilih.nama_lengkap', 'data_pemilih.tmp_lahir', 'data_pemilih.tgl_lahir', 'dusun.dusun', 'IF(data_pemilih.lp=1,"L","P") as lp','data_pemilih.rt', 'data_pemilih.rw', 'IF(data_pemilih.sts_nikah=0,"BELUM", IF(data_pemilih.sts_nikah=1,"SUDAH","PERNAH"))as sts_nkh', 'data_pemilih.qr_code'),
																	'data_pemilih.aktif=1 AND data_pemilih.id IN ('. $id_list .')',
																	0, 300, 'data_pemilih.no_urut ASC')->result_array();
				$data['margin']	= $this->Query->select_where('print_und_setup', array('*'), array('uid_user'=> $uid), 0,1,'id ASC')->row();
				$this->load->view('dashboard/data_pemilih/print/Und_pemilih', $data);
			}
		}else{
			$default = $this->Query->select_where('print_und_setup', 
													array('*'), 
													array('uid_user'=>0), 0,1,'id ASC')->row();
			$this->Query->insertData('print_und_setup', 
											array(
												'uid_user'			=> $uid,
												'wrap'				=> $default->wrap,
												'no_urut_top'		=> $default->no_urut_top,
												'nama_pemilih'		=> $default->nama_pemilih,
												'alamat_pemilih'	=> $default->alamat_pemilih,
												'alamat_pemilih2'	=> $default->alamat_pemilih2,
												'no_urut_bottom'	=> $default->no_urut_bottom,
											));
			$this->print_und_pemilih();
		}
	}

	public function print_und_pemilih_tes()
	{
		$uid 			= $this->session->userdata('uid');
		$data['margin']	= $this->Query->select_where('print_und_setup', array('*'), array('uid_user'=> $uid), 0,1,'id ASC')->row();
		$this->load->view('dashboard/data_pemilih/print/Und_pemilih_tes', $data);
	}

	public function get_setup_print_und()
	{
		$uid 		= $this->session->userdata('uid');
		$setup 	= $this->Query->select_where('print_und_setup', 
													array('*'), 
													array('uid_user'=> $uid), 0,1,'id ASC');
		if($setup->num_rows()>0){
			$data['margin'] = $setup->row();
		}else{
			$default = $this->Query->select_where('print_und_setup', 
													array('*'), 
													array('uid_user'=>0), 0,1,'id ASC')->row();
			$this->Query->insertData('print_und_setup', 
											array(
												'uid_user'			=> $uid,
												'wrap'				=> $default->wrap,
												'no_urut_top'		=> $default->no_urut_top,
												'nama_pemilih'		=> $default->nama_pemilih,
												'alamat_pemilih'	=> $default->alamat_pemilih,
												'alamat_pemilih2'	=> $default->alamat_pemilih2,
												'no_urut_bottom'	=> $default->no_urut_bottom,
											));
			$this->get_setup_print_und();
		}
		$this->load->view('dashboard/data_pemilih/print/Setup_und', $data);
	}

	public function setting_print_und_save()
	{
		$this->form_validation->set_rules('no_urut_top_top','', 'required|trim|numeric');
		$this->form_validation->set_rules('no_urut_top_left','', 'required|trim|numeric');
		$this->form_validation->set_rules('no_urut_top_font_size','', 'required|trim|numeric');
		$this->form_validation->set_rules('nama_pemilih_top','', 'required|trim|numeric');
		$this->form_validation->set_rules('nama_pemilih_left','', 'required|trim|numeric');
		$this->form_validation->set_rules('nama_pemilih_font_size','', 'required|trim|numeric');
		$this->form_validation->set_rules('alamat_pemilih_top','', 'required|trim|numeric');
		$this->form_validation->set_rules('alamat_pemilih_left','', 'required|trim|numeric');
		$this->form_validation->set_rules('alamat_pemilih_font_size','', 'required|trim|numeric');
		$this->form_validation->set_rules('alamat_pemilih2_top','', 'required|trim|numeric');
		$this->form_validation->set_rules('alamat_pemilih2_left','', 'required|trim|numeric');
		$this->form_validation->set_rules('alamat_pemilih2_font_size','', 'required|trim|numeric');
		$this->form_validation->set_rules('no_urut_bottom_top','', 'required|trim|numeric');
		$this->form_validation->set_rules('no_urut_bottom_left','', 'required|trim|numeric');
		$this->form_validation->set_rules('no_urut_bottom_font_size','', 'required|trim|numeric');

		if($this->form_validation->run()==true){
			$no_urut_top_top 				= $this->input->post('no_urut_top_top');
			$no_urut_top_left 			= $this->input->post('no_urut_top_left');
			$no_urut_top_font_size 		= $this->input->post('no_urut_top_font_size');
			$nama_pemilih_top  			= $this->input->post('nama_pemilih_top');
			$nama_pemilih_left			= $this->input->post('nama_pemilih_left');
			$nama_pemilih_font_size		= $this->input->post('nama_pemilih_font_size');
			$alamat_pemilih_top 			= $this->input->post('alamat_pemilih_top');
			$alamat_pemilih_left 		= $this->input->post('alamat_pemilih_left');
			$alamat_pemilih_font_size 	= $this->input->post('alamat_pemilih_font_size');
			$alamat_pemilih2_top 		= $this->input->post('alamat_pemilih2_top');
			$alamat_pemilih2_left 		= $this->input->post('alamat_pemilih2_left');
			$alamat_pemilih2_font_size = $this->input->post('alamat_pemilih2_font_size');
			$no_urut_bottom_top 			= $this->input->post('no_urut_bottom_top');
			$no_urut_bottom_left 		= $this->input->post('no_urut_bottom_left');
			$no_urut_bottom_font_size 	= $this->input->post('no_urut_bottom_font_size');

			$no_urut_top 				= $no_urut_top_top .','.$no_urut_top_left.','.$no_urut_top_font_size;
			$nama_pemilih  			= $nama_pemilih_top .','.$nama_pemilih_left.','.$nama_pemilih_font_size;
			$alamat_pemilih 			= $alamat_pemilih_top .','.$alamat_pemilih_left.','.$alamat_pemilih_font_size;
			$alamat_pemilih2 			= $alamat_pemilih2_top .','.$alamat_pemilih2_left.','.$alamat_pemilih2_font_size;
			$no_urut_bottom 			= $no_urut_bottom_top .','.$no_urut_bottom_left.','.$no_urut_bottom_font_size;

			$this->Query->updateData('print_und_setup', 
											array(
													'no_urut_top' => $no_urut_top,
													'nama_pemilih' => $nama_pemilih,
													'alamat_pemilih' => $alamat_pemilih,
													'alamat_pemilih2' => $alamat_pemilih2,
													'no_urut_bottom' => $no_urut_bottom,
													), 
											array('uid_user'=> $this->session->userdata('uid')));
			echo json_encode(array('sts'=> true));
		}
	}

	// file upload functionality
 	public function upload() {
      // If file uploaded
      if(!empty($_FILES['file']['name'])) { 
      	// get file extension
      	$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

      	if($extension == 'csv'){
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
			} elseif($extension == 'xlsx') {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			} else {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
			}
			// file path
			$spreadsheet = $reader->load($_FILES['file']['tmp_name']);
			$allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
			$tr_row='';

			$dusun = $this->Query->select_where('dusun', array('*'), array(),0,20, 'uid ASC')->result_array();

			foreach ($allDataInSheet as $key => $value) {
				if($allDataInSheet[$key]['N']!=""){
					$cek = $this->Query->select_where('data_pemilih', array('id'), array('no_urut'=> $allDataInSheet[$key]['N']), 0,1,'id ASC');
					if($cek->num_rows()<=0){
						if($key>=10){

							$dsn = '<span class="text-danger">error</span>';
							$tgl_lahir = '';
							$lp=1;
							foreach ($dusun as $ky =>  $row) {
								if($row['uid']==$allDataInSheet[$key]['E']){
									$dsn = $row['dusun'];

									//07/09/1975;
									$lp= intval($allDataInSheet[$key]['E']);

									$nik 			= ''; //NIK
									$nik_info 	= '';
									if(isset($allDataInSheet[$key]['B']) && $allDataInSheet[$key]['B']!="" && $allDataInSheet[$key]['B']!=0){
										$nik 			= $allDataInSheet[$key]['B'];
										$nik_info 	= '<br>'.$allDataInSheet[$key]['B'];
									}

									$nokk =''; //NOKK
									if(isset($allDataInSheet[$key]['C']) && $allDataInSheet[$key]['C']!="" && $allDataInSheet[$key]['C']!=0){
										$nokk = $allDataInSheet[$key]['C'];
									}

									$tgl = intval($allDataInSheet[$key]['G']);
									$bln = intval($allDataInSheet[$key]['H']);
									$thn = intval($allDataInSheet[$key]['I']);
									$tgl_lahir = $thn."/".$bln."/".$tgl;

									$this->Query->insertData('data_pemilih', array(
																					'nik'				=> $nik,
																					'nokk'			=> $nokk,
																					'nama_lengkap' => $allDataInSheet[$key]['D'],
																					'lp' 				=> $lp,
																					'tgl_lahir' 	=> $tgl_lahir,
																					'tmp_lahir' 	=> $allDataInSheet[$key]['F'],
																					'id_dusun' 		=> $allDataInSheet[$key]['J'],
																					'rt' 				=> $allDataInSheet[$key]['K'],
																					'rw' 				=> $allDataInSheet[$key]['L'],
																					'sts_nikah' 	=> intval($allDataInSheet[$key]['M']),
																					'no_urut'		=> intval($allDataInSheet[$key]['N']),
																				));
								}
							}

							$gender="L";
							if($allDataInSheet[$key]['E']==2){
								$gender="P";
							}

							//status nikah
							$sts_nikah= '';
							if($allDataInSheet[$key]['L']==1){
								$sts_nikah= 'Sudah';
							}else if($allDataInSheet[$key]['L']==2){
								$sts_nikah= 'Pernah';
							}else {
								$sts_nikah= 'Belum';
							}
							
							$tr_row .= '<tr>
											<td><div class="checkbox checkbox-css">
													<input type="checkbox" name="select_urut" class="selected_urut" id="cssCheckbox1'.$allDataInSheet[$key]['M'] .'" value="'. $allDataInSheet[$key]['M'] .'" checked="">
													<label for="cssCheckbox1'. $allDataInSheet[$key]['M'] .'">'. $allDataInSheet[$key]['M'] .'</label>
												</div></td>
											<td><b>'. $allDataInSheet[$key]['D'] .'</b>'. $nik_info .'</td>
											<td>'. $gender .'</td>
											<td>'. $dsn .' '. $allDataInSheet[$key]['J'] .'/'. $allDataInSheet[$key]['K'] .'</td>
											<td>'. $sts_nikah .'</td>
											</tr>';
						}
					}
				}
			}

			echo $tr_row;
			
     	}              
 	}

	// file upload functionality
 	// public function upload_v2() {
   //    // If file uploaded
   //    if(!empty($_FILES['file']['name'])) { 
   //    	// get file extension
   //    	$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

   //    	if($extension == 'csv'){
	// 			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
	// 		} elseif($extension == 'xlsx') {
	// 			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
	// 		} else {
	// 			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
	// 		}
	// 		// file path
	// 		$spreadsheet = $reader->load($_FILES['file']['tmp_name']);
	// 		$allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
	// 		$tr_row='';

	// 		$dusun = $this->Query->select_where('dusun', array('*'), array(),0,20, 'uid ASC')->result_array();

	// 		foreach ($allDataInSheet as $key => $value) {
	// 			if($key>=12){
	// 				$gender="L";
	// 				if($allDataInSheet[$key]['H']==2){
	// 					$gender="P";
	// 				}

	// 				$nik = '';
	// 				if($allDataInSheet[$key]['B']!=""){
	// 					$nik = $allDataInSheet[$key]['B'];
	// 				}

	// 				$dsn = '<span class="text-danger">error</span>';
	// 				foreach ($dusun as $ky =>  $row) {
	// 					if($row['uid']==$allDataInSheet[$key]['I']){
	// 						$dsn = $row['dusun'];
	// 						$this->Query->insertData('data_pemilih', array(
	// 																		'no_urut'		=> $allDataInSheet[$key]['A'],
	// 																		'nik' 			=> $nik,
	// 																		'nama_lengkap' => $allDataInSheet[$key]['C'],
	// 																		'tmp_lahir' 	=> $allDataInSheet[$key]['D'],
	// 																		'tgl_lahir' 	=> $allDataInSheet[$key]['H'] . '/'. $allDataInSheet[$key]['G'].'/'. $allDataInSheet[$key]['F'],
	// 																		'lp' 				=> $allDataInSheet[$key]['H'],
	// 																		'id_dusun' 		=> $allDataInSheet[$key]['I'],
	// 																		'rt' 				=> $allDataInSheet[$key]['J'],
	// 																		'rw' 				=> $allDataInSheet[$key]['K'],
	// 																		'sts_nikah' 	=> $allDataInSheet[$key]['L'],
	// 																	));
	// 					}
	// 				}

	// 				//status nikah
	// 				$sts_nikah= '';
	// 				if($allDataInSheet[$key]['L']==1){
	// 					$sts_nikah= 'Sudah';
	// 				}else if($allDataInSheet[$key]['L']==2){
	// 					$sts_nikah= 'Pernah';
	// 				}else {
	// 					$sts_nikah= 'Belum';
	// 				}
						
	// 				$tr_row .= '<tr>
	// 								<td>'. $allDataInSheet[$key]['A'] .'</td>
	// 								<td>'. $allDataInSheet[$key]['B'] .'</td>
	// 								<td><b>'. $allDataInSheet[$key]['C'] .'</b><br>'. $allDataInSheet[$key]['D'] . ', '. $allDataInSheet[$key]['E'] . '-'. $allDataInSheet[$key]['F'].'-'. $allDataInSheet[$key]['G'] .'</td>
	// 								<td>'. $gender .'</td>
	// 								<td>'. $dsn .'</td>
	// 								<td>'. $allDataInSheet[$key]['J'] .'/'. $allDataInSheet[$key]['K'] .'</td>
	// 								<td>'. $sts_nikah .'</td>
	// 								</tr>';
	// 			}
	// 		}

	// 		echo $tr_row;
			
   //   	}              
 	// }

	// checkFileValidation
	public function checkFileValidation($string) {
	$file_mimes = array('text/x-comma-separated-values', 
		'text/comma-separated-values', 
		'application/octet-stream', 
		'application/vnd.ms-excel', 
		'application/x-csv', 
		'text/x-csv', 
		'text/csv', 
		'application/csv', 
		'application/excel', 
		'application/vnd.msexcel', 
		'text/plain', 
		'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
	);
	if(isset($_FILES['fileURL']['name'])) {
		$arr_file = explode('.', $_FILES['fileURL']['name']);
		$extension = end($arr_file);
			if(($extension == 'xlsx' || $extension == 'xls' || $extension == 'csv') && in_array($_FILES['fileURL']['type'], $file_mimes)){
					return true;
			}else{
					$this->form_validation->set_message('checkFileValidation', 'Please choose correct file.');
					return false;
			}
		}else{
			$this->form_validation->set_message('checkFileValidation', 'Please choose a file.');
			return false;
		}
	}

	public function remove_data_pemilih()
	{
		$this->form_validation->set_rules('id_list','', 'required|trim');
		$this->form_validation->set_rules('password','Password', 'required|trim|md5');
		if($this->form_validation->run()==true){
			$id_list 				= $this->input->post('id_list');

			$this->Query->deleteData('data_pemilih', 'id IN ('. $id_list .')');
			$id_list	= explode(',', $id_list);
			echo json_encode(array('sts'=> true, 'msg'=> 'Data berhasil dihapus', 'data'=> $id_list));
		}else{
			echo json_encode(array('sts'=> false, 'msg'=> validation_errors()));
		}
	}

	public function reset_data()
	{
		$this->form_validation->set_rules('password','Password', 'required|trim|md5');
		if($this->form_validation->run()==true){
			$password 	= $this->input->post('password');

			$cek 			= $this->Query->select_where('users',
																array('users.rules_akses'), 
																array(
																	'users.password' 			=> $password,
																	'users.uid'					=> $this->session->userdata('uid'),
																),0,1, 'users.id ASC');
			if($cek->num_rows()>0){
				$row 		= $cek->row();
				$oto 		= explode(',', $row->rules_akses);

				$akses 	= false;
				foreach ($oto as $key => $value) {
					if($value==3){
						$akses 	= true;
					}
				}

				if($akses==true){
					$pemilih 	= $this->input->post('reset_data_pemilih');
					$kehadiran 	= $this->input->post('reset_data_kehadiran');
					if(isset($kehadiran)==true){
						$this->Query->truncate_kehadiran('pilkades_kehadiran');
					}
					if(isset($pemilih)==true){
						$this->Query->truncate_data_pemilih('data_pemilih');
					}
					echo json_encode(array('sts'=> true, 'msg'=> 'Data berhasil dihapus'));
				}else{
					echo json_encode(array('sts'=> false, 'msg'=> 'Anda tidak punya otoritas menghapus data'));
				}
			}else{
					echo json_encode(array('sts'=> false, 'msg'=> 'Password tidak sesuai'));
				}
		}else{
			echo json_encode(array('sts'=> false, 'msg'=> validation_errors()));
		}
	}

public function get_rekap_hadir()
	{
		$rw 		= $this->input->get('rw');

		$cfg 		= $this->Cfg->get_data();
		$data 	= $this->Query->select_where_join3('pilkades_kehadiran', 'data_pemilih', 'users_profile',
														array('data_pemilih.id=pilkades_kehadiran.id_pemilih', 'users_profile.uid=pilkades_kehadiran.id_uid'), 
														array(
															'pilkades_kehadiran.id',
															'data_pemilih.nama_lengkap', 
															'data_pemilih.no_urut', 
															'data_pemilih.rt', 'data_pemilih.rw', 
															'pilkades_kehadiran.datetime_create', 
															'CONCAT(users_profile.nama_depan," ", users_profile.nama_belakang) as operator'
														), 
														array('data_pemilih.rw'=> $rw),0, 300, 'data_pemilih.no_urut ASC');
		$table_row 	= '';
		$i 			= 1;
		foreach ($data->result_array() as $key => $value) {
			$table_row 	.='<tr id="hadir'.$value['id'] .'">
								<td>'. $i.'</td>
								<td id="und'.$value['id'].'">'. str_pad($value['no_urut'], $cfg['dig_no_und'], "0", STR_PAD_LEFT).'</td>
								<td><b><span id="pemilih'.$value['id'].'">'. $value['nama_lengkap'].'</span></b></td>
								<td>'. $value['rt'].'/'.$value['rw'].'</td>
								<td>'. $this->Set->time_sort($value['datetime_create']).'</td>
								<td>'. $value['operator'].'</td>
								<td><a href="javascript:void(0)" onclick="remove_hadir('. $value['id'].')"><i class="fa fa-times"></i></a></td>
								</tr>';
			$i++;
		}
	echo '
	<table class="table table-primary table-bordered table-striped"><thead><tr>
								<td colspan="2" class="text-center">UND</td>
								<td>NAMA PEMILIH</td>
								<td>RT/RW</td>
								<td>PUKUL</td>
								<td colspan="2">OPERATOR</td>
				</tr></thead><tbody>'.$table_row.'</tbody></table>
				';
	}

public function remove_hadir()
{
	$this->form_validation->set_rules('id_hadir', 'Pemilih', 'required|trim');
	if($this->form_validation->run()==true){
		$id_hadir 	= $this->input->post('id_hadir');
		$this->Query->deleteData('pilkades_kehadiran', array('id'=> $id_hadir));
		echo json_encode(array('sts'=>true));
	}
}

public function gen_tgl_lahir($value='')
{
	$tmp 	= $this->Query->select_where('data_kota_kab', array('id', 'kota_kab'), array(), 0, 600, 'id ASC')->result_array();

	foreach ($tmp as $key => $value) {
		$row[$value['id']]	= $value['kota_kab'];
	}
	// echo '<pre>';
	// print_r($row);
	// echo '</pre>';
	$data 	= $this->Query->select_where('data_pemilih', array('id', 'no_urut', 'nama_lengkap', 'nik'), array(), 0, 13000, 'no_urut ASC');
	echo '<table>';
	foreach ($data->result_array() as $key => $value) {
		$id 	= substr($value['nik'], 0,4);
		$temp = '';
		if($row[$id]){
			$temp 	= preg_replace('/KABUPATEN/', '', $row[$id]);
			$temp 	= preg_replace('/KOTA/', '', $temp);
		}
		echo '<tr>
					<td>'. $value['no_urut'] .'</td>
					<td>'. $value['nama_lengkap'] .'</td>
					<td>'. $value['nik'] .'</td>
					<td>'. $this->generate_tgl($value['nik']) . ' ' . $temp .'</td>
				</tr>';
	}
	echo '</table>';
	}

public function download_dpt_pdf(Type $var = null)
{
	# code...
}

public function download_dpt_excel(Type $var = null)
{
	$get 			= $this->Query->select_where('config', array('*'), array(),0,1,'id ASC')->row();
	$desa 		= strtoupper($get->desa);
	$kec 			= strtoupper($get->kec);
	$kabkot 		= strtoupper($get->kabkot);
	$sis_pem 	= strtoupper($get->sis_pem);
	$sis_kabkot = strtoupper($get->sis_kabkot);

	$spreadsheet 	= new Spreadsheet();
	$sheet 			= $spreadsheet->getActiveSheet();
	$sheet->setCellValue('C1', "PANITIA PEMILIHAN KEPALA DESA");
	$sheet->setCellValue('C2', $sis_pem . " ". $desa);
	$sheet->setCellValue('C3', "KECAMATAN ". $kec ." ". $sis_kabkot ." ". $kabkot);
	$sheet->setCellValueExplicit('C4', "2019",\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);

	$sheet->getStyle('C1')->getFont()->setBold(true);
	$row = 6;
	$sheet->setCellValue('A'. $row, "NO");
	$sheet->setCellValue('B'. $row, "NIK");
	$sheet->setCellValue('C'. $row, "NO KK");
	$sheet->setCellValue('D'. $row, "NAMA PEMILIH");
	$sheet->setCellValue('E'. $row, "L/P");
	$sheet->setCellValue('F'. $row, "DUSUN");
	$sheet->setCellValue('G'. $row, "RT");
	$sheet->setCellValue('H'. $row, "RW");
	$sheet->setCellValue('I'. $row, "NO DPT");

	$sheet->getColumnDimension('A')->setWidth(4);
	$sheet->getColumnDimension('B')->setWidth(17);
	$sheet->getColumnDimension('C')->setWidth(17);
	$sheet->getColumnDimension('D')->setWidth(28);
	$sheet->getColumnDimension('E')->setWidth(4);
	$sheet->getColumnDimension('F')->setWidth(16);
	$sheet->getColumnDimension('G')->setWidth(4);
	$sheet->getColumnDimension('H')->setWidth(4);
	$sheet->getColumnDimension('I')->setWidth(8);
	$sheet->getRowDimension('6')->setRowHeight(30);

	$sheet->getStyle('A6:I6')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

	$styleArray = [
				'font' => [
					'bold' => true,
				],
				'borders' => [
					'top' => [
						'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE,
					],
					'bottom' => [
						'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE,
					],
					'left' => [
						'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE,
					],
					'right' => [
						'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE,
					],
				],
		];

	$sheet->getStyle('A6:I6')->applyFromArray($styleArray);
	$sheet->getStyle('A6:I6')->getAlignment()->setHorizontal('center');
	$sheet->getStyle('A6:I6')->getAlignment()->setVertical('center');

	$row 	= 7;
	$no 	= 1;
	$data = $this->Query->select_where_join2('data_pemilih', 'dusun', 'dusun.uid=data_pemilih.id_dusun', array('*', 'IF(data_pemilih.lp=1,"L","P") as gender', 'dusun.dusun'), array(), 0, 800, 'no_urut ASC');
	foreach ($data->result_array() as $key => $value) {
		$sheet->setCellValue('A'. $row, $no);
		$sheet->setCellValueExplicit('B'.$row, $value['nik'],\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
		$sheet->setCellValueExplicit('C'.$row, $value['nokk'],\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
		$sheet->setCellValue('D'. $row, $value['nama_lengkap']);
		$sheet->setCellValue('E'. $row, $value['gender']);
		$sheet->setCellValue('F'. $row, $value['dusun']);
		$sheet->setCellValue('G'. $row, $value['rt']);
		$sheet->setCellValue('H'. $row, $value['rw']);
		$sheet->setCellValue('I'. $row, $value['no_urut']);
		$sheet->getRowDimension($row)->setRowHeight(18);
		$row++;
		$no++;
	}

	$styleArray = [
		'borders' => [
				'bottom' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE,
				],
				'left' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE,
				],
				'right' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE,
				],
				'allBorders' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DASHED,
				],
		],
	];
	$row = $row-1;
	$sheet->getStyle('A7:I'.$row)->applyFromArray($styleArray);
	$sheet->getStyle('B7:C'.$row)->getAlignment()->setHorizontal('center');
	$sheet->getStyle('E7:E'.$row)->getAlignment()->setHorizontal('center');
	$sheet->getStyle('G7:H'.$row)->getAlignment()->setHorizontal('center');
	$sheet->getStyle('A7:I'.$row)->getAlignment()->setVertical('center');
	$sheet->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(6,6);

	$writer 		= new Xlsx($spreadsheet);
	$gen 			= $this->Set->generateNumber(8);
	$filename 	= 'Daftar Pemilih ' . $gen;
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
	header('Cache-Control: max-age=0');
	$writer->save('php://output'); // download file 
}

	public function generate_tgl($nik='')
	{
		$tgl 	= substr($nik, 6,2);
		$bln 	= substr($nik, 8,2);
		$thn 	= substr($nik, 10,2);

		if(intval($tgl)>=40){
			$tgl 	= intval($tgl)-40;
		}

		if(intval($tgl)>31){
			$tgl 	= '----------------------------- Salah tgl';
		}

		if(intval($bln)>12){
			$bln 	= '-------------------------------- Salah bln';
		}

		if(intval($thn)<20){
			$thn 	= '20'.$thn;
		}else{
			$thn 	= '19'.$thn;
		}

		return str_pad($tgl, 2, "0", STR_PAD_LEFT) . '|' . $bln .'|'.$thn; 
	}
}

