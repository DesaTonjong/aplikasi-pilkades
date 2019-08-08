<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Panitia extends CI_Controller {
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

	public function get_data()
	{
		$id_jab 				= $this->input->get('id_jab');
		$filter 				= array();
		if($id_jab>0){
			$filter 	= array('data_panitia.id_jab'=> $id_jab);
		}
		$data['panitia'] 	= $this->Query->select_where_join2('data_panitia', 'data_panitia_jab', 
														'data_panitia_jab.id=data_panitia.id_jab', 
												array('data_panitia.*'), $filter, 0, 200, 'data_panitia_jab.id, data_panitia.sort ASC')->result_array();
		$this->load->view('dashboard/panitia/Get_data', $data);
	}

	public function add_form()
	{
		$data['id_jab']	= $this->input->get('id_jab');
		$this->load->view('dashboard/panitia/Form_add', $data);
	}

	public function add_panitia()
	{
		$this->form_validation->set_rules('nama','Nama', 'required|trim');
		$this->form_validation->set_rules('ket','Ket', 'required|trim');
		$this->form_validation->set_rules('sort','Urutan', 'required|trim');

		if($this->form_validation->run()==true){
			$config['upload_path']          = './assets/img/photo/';
	      $config['allowed_types']        = 'gif|jpg|png|jpeg';
	      $config['encrypt_name']         = TRUE;

	      $this->load->library('upload', $config);

	      if ( ! $this->upload->do_upload('file')){
	         $error = array('error' => $this->upload->display_errors());
	         echo json_encode(array('sts'=> false, 'msg'=> $error));
	      }
	      else
	      {
				$data       = $this->upload->data();  
				$id_jab    	= $this->input->post('id_jab');
				$nama    	= $this->input->post('nama');
				$ket    		= $this->input->post('ket');
				$sort    	= $this->input->post('sort');
				$this->Query->insertData('data_panitia', array(
				                                      'photo'     	=> $data['file_name'],
				                                      'nama'     	=> $nama,
				                                      'id_jab'     => $id_jab,
				                                      'ket'     	=> $ket,
				                                      'sort'     	=> $sort,
				                                  )); 
				$this->load->library('image_lib');

	         $config = array(
	              'source_image'      => $data['full_path'],
	              'new_image'         => realpath(APPPATH.'../assets/img/photo/128/'),
	              'maintain_ratio'    => true,
	              'width'             => 128,
	              'height'            => 128
	              );
	                  
	         $this->image_lib->initialize($config);
	         $this->image_lib->resize();

	         $media 	= '<div class="image col-md-3">
								<div class="image-inner">
									<a href="'. base_url('assets/img/photo/128/').$data['file_name'].'" data-lightbox="gallery-group-'. $id_jab.'">
									<img src="'. base_url('assets/img/photo/128/').$data['file_name'].'" alt="" />
									</a>
									<p class="image-caption">
										'.$ket.'
									</p>
								</div>
								<div class="image-info p-5">
									<a href="#ModalForm" data-toggle="modal" onclick="get_edit_data()"><h5 class="title">'.$nama.'</h5></a>
								</div>
							</div>';
	          
	          //echo base_url('uploads/logo_pams/160').'/'.$data['file_name'];
				$foldom 		= '';//$this->Getconf->foldom();
				$filename = $_SERVER["DOCUMENT_ROOT"] . $foldom .'/assets/img/photo/'.$data['file_name'];
				if(file_exists($filename)){
					unlink($filename);
				}
	         echo $media;
	      }
	   }else{
	   	echo validation_errors();
	   }
	}

	public function edit_form()
	{
		$id_pan 	= $this->input->get('id_pan');
		$get 		= $this->Query->select_where('data_panitia', array('*'), array('id'=> $id_pan),0,1,'id ASC');
		if($get->num_rows()>0){
			$data['panitia']	= $get->row();
			$this->load->view('dashboard/panitia/Form_update', $data);
		}else{
			echo 'Tidak ada data ditemukan';
		}
	}

	public function update_panitia($value='')
	{
		$this->form_validation->set_rules('id_pan','Panitia', 'required|trim');
		$this->form_validation->set_rules('nama','Nama', 'required|trim');
		$this->form_validation->set_rules('ket','Ket', 'required|trim');
		$this->form_validation->set_rules('sort','Urutan', 'required|trim');

		if($this->form_validation->run()==true){
			$id_jab    		= $this->input->post('id_jab');
			$nama    		= $this->input->post('nama');
			$ket    			= $this->input->post('ket');
			$sort    		= $this->input->post('sort');
			$id_pan    		= $this->input->post('id_pan');
			$photo_fname   = $this->input->post('photo_fname');

			$data_update 	= array(
                                'nama'     	=> $nama,
                                'id_jab'     => $id_jab,
                                'ket'     	=> $ket,
                                'sort'     	=> $sort,
                            );

			$config['upload_path']          = './assets/img/photo/';
	      $config['allowed_types']        = 'gif|jpg|png|jpeg';
	      $config['encrypt_name']         = TRUE;

	      $this->load->library('upload', $config);

	      //upload photo
	      if ($this->upload->do_upload('file'))
			{
				$data       = $this->upload->data(); 
				$this->load->library('image_lib');
	         $config = array(
	              'source_image'      => $data['full_path'],
	              'new_image'         => realpath(APPPATH.'../assets/img/photo/128/'),
	              'maintain_ratio'    => true,
	              'width'             => 128,
	              'height'            => 128
	              );
	                  
	         $this->image_lib->initialize($config);
	         $this->image_lib->resize();

				$filename = $_SERVER["DOCUMENT_ROOT"] .'/assets/img/photo/'.$data['file_name'];
				if(file_exists($filename)){
					unlink($filename);
				}

				//hapus photo lama
				$filename = $_SERVER["DOCUMENT_ROOT"] .'/assets/img/photo/128/'.$photo_fname;
				if(file_exists($filename)){
					unlink($filename);
				}

				$data_update 	= array('nama' => $nama, 'id_jab' => $id_jab,'ket' => $ket,'sort' => $sort, 'photo' => $data['file_name']);
				$photo_fname = $data['file_name'];
	      }

	      //update database
			$this->Query->updateData('data_panitia', $data_update, array('id'=> $id_pan)); 
			echo json_encode(array('sts'=> true, 'msg'=> 'Update data berhasil', 'id_pan'=> $id_pan, 'photo_new'=> $photo_fname));
		}else{
			echo validation_errors();
		}
	}

	public function remove_panitia($value='')
	{
		$this->form_validation->set_rules('id_pan','panitia', 'required|trim');
		if($this->form_validation->run()==true){
			$id_pan 	= $this->input->post('id_pan');
			$get 	= $this->Query->select_where('data_panitia', array('photo'), array('id'=> $id_pan),0,1,'id ASC');
			if($get->num_rows()>0){
				$pan 	= $get->row();

				$filename = $_SERVER["DOCUMENT_ROOT"] .'/assets/img/photo/128/'.$pan->photo;
				if(file_exists($filename)){
					unlink($filename);
				}

				$this->Query->deleteData('data_panitia', array('id'=> $id_pan));
				echo json_encode(array('sts'=> true));
			}
		}	
	}
}