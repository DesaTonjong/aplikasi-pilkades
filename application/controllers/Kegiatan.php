<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Kegiatan extends CI_Controller {
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
		// $id_jab 				= $this->input->get('id_jab');
		$filter 				= array();
		// if($id_jab>0){
		// 	$filter 	= array('pilkades_kegiatan.id_jab'=> $id_jab);
		// }
		$data['panitia'] 	= $this->Query->select_where('pilkades_kegiatan',
												array('pilkades_kegiatan.*'), $filter, 0, 200, 'pilkades_kegiatan.id DESC')->result_array();
		$this->load->view('dashboard/kegiatan/Get_data', $data);
	}

	public function add_form()
	{
		$data['id_jab']	= $this->input->get('id_jab');
		$this->load->view('dashboard/kegiatan/Form_add', $data);
	}

	public function add_data()
	{
		$this->form_validation->set_rules('title','Judul', 'required|trim');
		$this->form_validation->set_rules('keterangan','Keterangan', 'required|trim');

		if($this->form_validation->run()==true){
			$config['upload_path']          = './assets/img/kegiatan/';
	      $config['allowed_types']        = 'gif|jpg|png|jpeg';
	      $config['encrypt_name']         = TRUE;

	      $this->load->library('upload', $config);

	      if ( ! $this->upload->do_upload('file'))
	      {
	          $error = array('error' => $this->upload->display_errors());
	          echo json_encode(array('sts'=> false, 'msg'=> $error));
	      }
	      else
	      {
				$data       = $this->upload->data();  
				$title    	= $this->input->post('title');
				$keterangan = $this->input->post('keterangan');
				$this->Query->insertData('pilkades_kegiatan', array(
				                                      'filename'     	=> $data['file_name'],
				                                      'title'     	=> $title,
				                                      'keterangan' => $keterangan,
				                                  )); 
				$this->load->library('image_lib');

	         $config = array(
	              'source_image'      => $data['full_path'],
	              'new_image'         => realpath(APPPATH.'../assets/img/kegiatan/200/'),
	              'maintain_ratio'    => true,
	              'width'             => 200,
	              'height'            => 200
	              );
	                  
	         $this->image_lib->initialize($config);
	         $this->image_lib->resize();

	         $config = array(
	              'source_image'      => $data['full_path'],
	              'new_image'         => realpath(APPPATH.'../assets/img/kegiatan/400/'),
	              'maintain_ratio'    => true,
	              'width'             => 400,
	              'height'            => 400
	              );
	                  
	         $this->image_lib->initialize($config);
	         $this->image_lib->resize();

	         $config = array(
	              'source_image'      => $data['full_path'],
	              'new_image'         => realpath(APPPATH.'../assets/img/kegiatan/800/'),
	              'maintain_ratio'    => true,
	              'width'             => 800,
	              'height'            => 800
	              );
	                  
	         $this->image_lib->initialize($config);
	         $this->image_lib->resize();

	         $media 	= '<div class="image col-md-4">
								<div class="image-inner">
									<a href="'. base_url('assets/img/kegiatan/800/').$data['file_name'].'" data-lightbox="gallery-group-1">
									<img src="'. base_url('assets/img/kegiatan/200/').$data['file_name'].'" alt="" />
									</a>
								</div>
								<div class="image-info p-5">
									<a href="#ModalForm" data-toggle="modal" onclick="get_edit_data()"><h5 class="title">'.$title.'</h5><small>'. $keterangan .'</small></a>
								</div>
							</div>';
	          
	          //echo base_url('uploads/logo_pams/160').'/'.$data['file_name'];
				$foldom 		= '';//$this->Getconf->foldom();
				$filename = $_SERVER["DOCUMENT_ROOT"] . $foldom .'/assets/img/kegiatan/'.$data['file_name'];
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
		$get 		= $this->Query->select_where('pilkades_kegiatan', array('*'), array('id'=> $id_pan),0,1,'id ASC');
		if($get->num_rows()>0){
			$data['panitia']	= $get->row();
			$this->load->view('dashboard/kegiatan/Form_update', $data);
		}else{
			echo 'Tidak ada data ditemukan';
		}
	}

	public function update_data($value='')
	{
		$this->form_validation->set_rules('id_kgiat','Panitia', 'required|trim');
		$this->form_validation->set_rules('title','Judul', 'required|trim');
		$this->form_validation->set_rules('keterangan','Keterangan', 'required|trim');

		if($this->form_validation->run()==true){
			$id_kgiat    	= $this->input->post('id_kgiat');
			$title    		= $this->input->post('title');
			$keterangan    = $this->input->post('keterangan');
			$sort    		= $this->input->post('sort');
			$id_pan    		= $this->input->post('id_pan');
			$photo_fname   = $this->input->post('photo_fname');

			$data_update 	= array(
                                'title'     	=> $title,
                                'keterangan' => $keterangan,
                            );

			$config['upload_path']          = './assets/img/kegiatan/';
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
	              'new_image'         => realpath(APPPATH.'../assets/img/kegiatan/200/'),
	              'maintain_ratio'    => true,
	              'width'             => 200,
	              'height'            => 200
	              );
	                  
	         $this->image_lib->initialize($config);
	         $this->image_lib->resize();

	         $config = array(
	              'source_image'      => $data['full_path'],
	              'new_image'         => realpath(APPPATH.'../assets/img/kegiatan/400/'),
	              'maintain_ratio'    => true,
	              'width'             => 400,
	              'height'            => 400
	              );
	                  
	         $this->image_lib->initialize($config);
	         $this->image_lib->resize();

	         $config = array(
	              'source_image'      => $data['full_path'],
	              'new_image'         => realpath(APPPATH.'../assets/img/kegiatan/800/'),
	              'maintain_ratio'    => true,
	              'width'             => 800,
	              'height'            => 800
	              );
	                  
	         $this->image_lib->initialize($config);
	         $this->image_lib->resize();

				$filename = $_SERVER["DOCUMENT_ROOT"] .'/assets/img/photo/'.$data['file_name'];
				if(file_exists($filename)){
					unlink($filename);
				}

				//hapus photo lama
				$filename = $_SERVER["DOCUMENT_ROOT"] .'/assets/img/kegiatan/'.$photo_fname;
				if(file_exists($filename)){
					unlink($filename);
				}

				$data_update 	= array(
                                'title'     	=> $title,
                                'keterangan' => $keterangan,
                                'filename'	=> $data['file_name'],
                            );
				$photo_fname = $data['file_name'];
	      }

	      //update database
			$this->Query->updateData('pilkades_kegiatan', $data_update, array('id'=> $id_kgiat)); 
			echo json_encode(array('sts'=> true, 'msg'=> 'Update data berhasil', 'id_pan'=> $id_pan, 'photo_new'=> $photo_fname));
		}else{
			echo validation_errors();
		}
	}

	public function remove_kegiatan($value='')
	{
		$this->form_validation->set_rules('id_kgiat','Kegiatan', 'required|trim');
		if($this->form_validation->run()==true){
			$id_kgiat 	= $this->input->post('id_kgiat');
			$get 	= $this->Query->select_where('pilkades_kegiatan', array('filename'), array('id'=> $id_kgiat),0,1,'id ASC');
			if($get->num_rows()>0){
				$pan 	= $get->row();

				$filename = $_SERVER["DOCUMENT_ROOT"] .'/assets/img/kegiatan/200/'.$pan->filename;
				if(file_exists($filename)){
					unlink($filename);
				}

				$filename = $_SERVER["DOCUMENT_ROOT"] .'/assets/img/kegiatan/400/'.$pan->filename;
				if(file_exists($filename)){
					unlink($filename);
				}

				$filename = $_SERVER["DOCUMENT_ROOT"] .'/assets/img/kegiatan/800/'.$pan->filename;
				if(file_exists($filename)){
					unlink($filename);
				}

				$this->Query->deleteData('pilkades_kegiatan', array('id'=> $id_kgiat));
				echo json_encode(array('sts'=> true));
			}
		}	
	}
}