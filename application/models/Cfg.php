<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cfg extends CI_Model {
    public function get_data($kode=''){
        $CI          =& get_instance();
        $cfg 		= $this->Query->select_where('config', array('*'), array(''), 0,1,'id ASC')->row();
        if($cfg){
	        	$data = array('sistem'=> $cfg->sistem, 'app_status'=> $cfg->app_status, 'per_dapil'=> $cfg->per_dapil, 'qr_code'=> $cfg->qr_code, 'bar_code'=> $cfg->bar_code, 'desa'=> $cfg->desa, 'kec'=> $cfg->kec, 'kab_kota'=> $cfg->kabkot,'dig_no_und'=> $cfg->dig_no_und);
	     }else{
	     		$data = array('sistem'=> $cfg->sistem, 'antri'=> 0, 'qr_code'=> 0, 'bar_code'=> 0, 'desa'=> 'Tidak tersedia', 'kec'=> 'Tidak tersedia', 'kab_kota'=> 'Tidak tersedia', 'dig_no_und'=> 4);
	     }
        return $data;
    }

 	public function int_uri($value=0)
 	{
     	$segment    = base_url();
     	return $segment;
 	}
}