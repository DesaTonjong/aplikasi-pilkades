<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Hitung_manual extends CI_Controller {
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

 	public function get_data($value='')
 	{
      $page             = $this->input->get('page');
      $limit            = 10;
      $id_dapil         = $this->session->userdata('akses')['dapil_phitung']['id'];
      $id_dapil         = $id_dapil;
      $list['list_entry']  = $this->Query->select_where_join2('pilkades_hitung_manual', 'pilkades_calon',
                                 'pilkades_calon.id=pilkades_hitung_manual.id_cal',
                                 array(
                                    'pilkades_hitung_manual.*',
                                    'pilkades_calon.nama_calon',
                                 ), 
                                 array('pilkades_hitung_manual.id_dapil'=> $id_dapil), $page*$limit, $limit, 'pilkades_hitung_manual.id DESC');
      $list['next_page']   = $page+1;
      $list_entry = $this->load->view('dashboard/phitung/List_entry', $list, TRUE);
      echo json_encode(array('sts'=> TRUE, 'list_entry'=> $list_entry));
   }

   public function get_data_data_perolehan()
   {
      $id_dapil         = $this->session->userdata('akses')['dapil_phitung']['id'];
      $data['id_dapil'] = $id_dapil;
      $data['calon']    = $this->Query->select_where('pilkades_calon', 
                                 array('id','nomor', 'nama_calon', 'photo'), 
                                 array(), 0, 20, 'nomor ASC');
      $data['tot_suara']   = $this->Query->select_where_join2_group_by('pilkades_hitung_manual', 'pilkades_calon', 'pilkades_calon.id=pilkades_hitung_manual.id_cal',
                                 array('count(pilkades_hitung_manual.id) as tot_suara'), 
                                 array(), 
                                 array('pilkades_hitung_manual.id_dapil'=> $id_dapil), 0, 1, 'pilkades_hitung_manual.id ASC')->row();
      $result              = $this->load->view('dashboard/phitung/Get_data', $data, TRUE);
      echo json_encode(array('sts'=> TRUE, 'result'=> $result));
   }

   public function post_entry(Type $var = null)
   {
      $this->form_validation->set_rules('no_calon', 'Nomor Calon', 'required|trim|numeric');
      $this->form_validation->set_rules('unix_id', 'Unix ID', 'required|trim|numeric');
      if($this->form_validation->run()==true){
         $id_dapil   = $this->session->userdata('akses')['dapil_phitung']['id'];
         $uid_opr    = $this->session->userdata('uid');
         $no_cal     = $this->input->post('no_calon');
         $unix_id    = $this->input->post('unix_id');
         $now_print  = $this->Set->now_print();

         //cek database calon
         $cek_cal    = $this->Query->select_where('pilkades_calon', array('id','nama_calon'), array('nomor'=> $no_cal),0,1,'id ASC')->row();
         if($cek_cal){
            $data       = array(
                           'unix_id'   => $unix_id,
                           'id_cal'    => $cek_cal->id,
                           'no_cal'    => $no_cal,
                           'created_at' => $now_print,
                           'id_dapil'  => $id_dapil,
                           'uid_opr'   => $uid_opr,
                           );
            $add           = $this->Query->insertData('pilkades_hitung_manual', $data);
            $new_unix_id   = strtotime($now_print) . $id_dapil . $this->Set->generateNumber(3);
            $tot_suara     = $this->Query->select_where_group_by('pilkades_hitung_manual', 
                                          array('COUNT(id) as jml_suara'),
                                          array(),
                                          array('id_dapil'=> $id_dapil),0,1, 'id ASC')->row();
            $suara     = $this->Query->select_where_group_by('pilkades_hitung_manual', 
                                          array('id_cal', 'COUNT(id) as jml_suara'),
                                          array('id_cal'),
                                          array('id_dapil'=> $id_dapil),0,15, 'id ASC')->result_array();
            $color_no   =  ($no_cal==0) ? "bg-white text-red":"bg-grey-transparent-2 text-white";
            $nom        = ($no_cal==0) ? "X":$no_cal;
            $list       = '<div id="le'.$unix_id.'" class="widget-list-item rounded-0 p-t-3">
                              <div class="widget-list-media icon">
                                 <span class="rounded '. $color_no .' p-10 f-s-16 f-w-700">'. $nom .'</span>
                              </div>
                              <div class="widget-list-content">
                                 <div class="widget-list-title"><span class="f-s-12 f-w-700">'. $cek_cal->nama_calon.'</span><br><span class="text-xs text-muted"><i class="fa fa-clock-o" aria-hidden="true"></i> '.date_format(date_create($now_print),"H:i:s").'</span></div>
                              </div>
                              <div class="widget-list-action text-nowrap text-grey">
                                 <a href="javascript:;" class="text-danger" title="Hapus/Batal" onclick="remove_le('.$unix_id.')">
                                    <i class="fa fa-times fa-sm"></i>
                                 </a>
                              </div>
                           </div>';
            echo json_encode(array('sts'=>true, 'tot_suara'=> $tot_suara->jml_suara, 'suara'=> $suara, 'unix_id'=> $new_unix_id, 'list'=> $list));
         }else{
            echo json_encode(array('sts'=>false, 'msg'=> 'Nomor Calon <span class="text-danger f-s-13 f-w-700">'. $no_cal .'</span> tidak tersedia'));
         }
      }else{
         echo json_encode(array('sts'=>false,'msg'=> validation_errors()));
      }
   }

   public function remove_hitung(Type $var = null)
   {
      $this->form_validation->set_rules('unix_id', 'Data', 'required|trim');
      if($this->form_validation->run()==true){
         $id_dapil   = $this->session->userdata('akses')['dapil_phitung']['id'];
         $unix_id    = $this->input->post('unix_id');
         $uid_opr    = $this->session->userdata('uid');
         $result     = $this->Query->deleteData('pilkades_hitung_manual', array('unix_id'=> $unix_id, 'id_dapil'=> $id_dapil, 'uid_opr'=> $uid_opr));
         if($result){
            $tot_suara     = $this->Query->select_where_group_by('pilkades_hitung_manual', 
                                          array('COUNT(id) as jml_suara'),
                                          array(),
                                          array('id_dapil'=> $id_dapil),0,1, 'id ASC')->row();
            $suara     = $this->Query->select_where_group_by('pilkades_hitung_manual', 
                                          array('id_cal', 'COUNT(id) as jml_suara'),
                                          array('id_cal'),
                                          array('id_dapil'=> $id_dapil),0,15, 'id ASC')->result_array();
            echo json_encode(array('sts'=> TRUE, 'tot_suara'=> $tot_suara->jml_suara, 'suara'=> $suara));
         }
      }
   }
}
