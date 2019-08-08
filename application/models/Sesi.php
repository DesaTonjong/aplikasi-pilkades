<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sesi extends CI_Model {
    public function is_logged(){
        $CI                         =& get_instance();
        $is_logged_in               = $CI->session->userdata('uid');
        $cek_user							= $CI->Query->select_where('users', array('id'), array('uid'=> $is_logged_in),0,1,'id ASC')->num_rows();
        if(!isset($is_logged_in) || $is_logged_in != true || $cek_user<=0)
        {
            $this->session->sess_destroy();
            header('Location:'.base_url('home/login'));           
        }
    }

    public function isAdmin($value='')
    {
        $CI                =& get_instance();
        $is_logged_in      = $CI->session->userdata('uid');
        $cek_user				= $CI->Query->select_where('users', array('rules_akses'), array('uid'=> $is_logged_in),0,1,'id ASC')->row();
        $oto 					= explode(',', $cek_user->rules_akses);
        $isAdmin 				= false;

        foreach ($oto as $key => $value) {
        	if($value==3){
				$isAdmin =true;        		
        	}
        }
        
        if(!isset($is_logged_in) || $is_logged_in != true || $isAdmin==false)
        {
            $this->session->sess_destroy();
            header('Location:'.base_url('home/login'));          
        }
    }
}