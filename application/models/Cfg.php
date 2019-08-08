<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cfg extends CI_Model {
    public function get_data($kode=''){
        $CI          =& get_instance();
        $cfg 			= $this->Query->select_where('config', array('*'), array(''), 0,1,'id ASC')->row();
        $cfg_desa 	= $this->Query->select_where_join3('data_desa', 'data_kec', 'data_kota_kab', 
        													array(
        														'data_kec.id=data_desa.kec_id',
        														'data_kota_kab.id=data_kec.kota_kab_id',
        													), 
        													array('data_desa.desa','data_kec.kec','data_kota_kab.kota_kab'), 
        													array('data_desa.id'=> $cfg->desa_kode), 0,1,'data_desa.id ASC');
        if($cfg_desa->num_rows()>0){
        		$desa = $cfg_desa->row();
	        	$data = array('sistem'=> $cfg->sistem, 'antri'=> $cfg->antri, 'qr_code'=> $cfg->qr_code, 'bar_code'=> $cfg->bar_code, 'desa'=> $desa->desa, 'kec'=> $desa->kec, 'kab_kota'=> $desa->kota_kab,'dig_no_und'=> $cfg->dig_no_und);
	     }else{
	     		$data = array('sistem'=> $cfg->sistem, 'antri'=> 0, 'qr_code'=> 0, 'bar_code'=> 0, 'desa'=> 'Tidak tersedia', 'kec'=> 'Tidak tersedia', 'kab_kota'=> 'Tidak tersedia', 'dig_no_und'=> $cfg->dig_no_und);
	     }
        return $data;
    }

 	public function int_uri($value=0)
 	{
     	$segment    = base_url();
     	return $segment;
 	}
}