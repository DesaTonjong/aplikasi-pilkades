<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qr_code extends CI_Controller {
 	public function __construct()
		{
	     	parent::__construct();
	 		$this->load->library('ciqrcode');
	     	$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
	     	$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
	     	$this->output->set_header('Pragma: no-cache');
	     	$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	     	$this->Sesi->is_logged();  
	 	}

 	public function render()
	 	{
	 		//phpinfo();
	 		$value=$this->input->get('qr');
			header("Content-Type: image/png");
			$params['data'] 			= $value;
			$params['level'] 			= 'H';
			$config['quality']		= true;
			$params['size'] 			= 5;
			$this->ciqrcode->generate($params);
	 	}
	}