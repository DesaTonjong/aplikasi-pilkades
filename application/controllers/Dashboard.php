<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
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

	public function index()
	{
		$page 						= $this->input->get('p');
		$data['page_active'] 	= $page;
		$this->load->view('Member', $data);
	}

	public function get_form_config($value='')
	{
		$data['config']	= $this->Query->select_where('config', array('*'), array(),0,1,'id ASC')->row();
		$this->load->view('dashboard/Config_desa',$data);
	}

	public function get_form_user($value='')
	{
		$this->load->view('dashboard/User_operator');
	}
}

