<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Zend\Barcode\Barcode;
class Bar_qr_code extends CI_Controller {
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

		public function render_qr()
		{
			$value=$this->input->get('code');
			header("Content-Type: image/png");
			$params['data'] 			= $value;
			$params['level'] 			= 'H';
			$config['quality']		= true;
			$params['size'] 			= 5;
			$this->ciqrcode->generate($params);
		}

		public function render_bar()
		{
			$value=$this->input->get('code');
			$code = Barcode::render('code128', 'image', array('text'=>$value, 'stretchText'=> true, 'barHeight'=> 30, 'factor'=>4, 'fontSize'=>6), array());
			return $code;
		}
	}