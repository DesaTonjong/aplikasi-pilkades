<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penghitungan extends CI_Controller {

	public function index()
	{
      $data['calon']    =  $this->Query->select_where('pilkades_calon', array('id','nomor', 'nama_calon', 'photo'), array(), 0,20, 'nomor ASC');
		$this->load->view('penghitungan/Index_html', $data);
   }

public function get_result(Type $var = null)
   {
      $tot_global       = $this->Query->select_where_join2_group_by('pilkades_hitung_manual', 'pilkades_calon', 'pilkades_calon.id=pilkades_hitung_manual.id_cal',
                                    array('COUNT(pilkades_hitung_manual.id) as jml_suara'),
                                    array(),
                                    array(),0,1, 'pilkades_hitung_manual.id ASC')->row();
      $per_cal       = $this->Query->select_where_join2_group_by('pilkades_hitung_manual', 'pilkades_calon', 'pilkades_calon.id=pilkades_hitung_manual.id_cal',
                                    array('pilkades_hitung_manual.id_cal', 'COUNT(pilkades_hitung_manual.id) as jml_suara'),
                                    array('pilkades_hitung_manual.id_cal'),
                                    array(),0,25, 'id_cal ASC')->result_array();
      $get_suara  = $this->Query->select_where_join2_group_by('pilkades_hitung_manual', 'pilkades_calon', 'pilkades_calon.id=pilkades_hitung_manual.id_cal',
                                    array('pilkades_hitung_manual.id_dapil', 'COUNT(pilkades_hitung_manual.id) as jml_suara'),
                                    array('pilkades_hitung_manual.id_dapil'),
                                    array(),0,25, 'pilkades_hitung_manual.id ASC')->result_array();
      foreach ($get_suara as $key => $value) {
        $dapil[$value['id_dapil']]    = $value['jml_suara'];
      } 
      $result        = $this->Query->select_where_join2_group_by('pilkades_hitung_manual', 'pilkades_calon', 'pilkades_calon.id=pilkades_hitung_manual.id_cal',
                                          array('pilkades_hitung_manual.id_cal', 'pilkades_hitung_manual.id_dapil', 'COUNT(pilkades_hitung_manual.id) as jml_suara'),
                                          array('pilkades_hitung_manual.id_cal', 'pilkades_hitung_manual.id_dapil'),
                                          array(),0,25, 'id_cal, id_dapil ASC')->result_array();
      echo json_encode(array('tot_global'=> $tot_global->jml_suara, 'dapil'=> $dapil, 'result'=> $result, 'per_cal'=> $per_cal));
   }

   public function show(Type $var = null)
   {
      $data['calon']    = $this->Query->select_where('pilkades_calon', array('id','nomor', 'nama_calon', 'photo'), array(), 0,20, 'nomor ASC');
      $data['dapil']    = $this->Query->select_where('pilkades_dapil', array('*'), array(),0,20, 'uid ASC');
		$this->load->view('penghitungan/Show_index', $data);
   }
}
