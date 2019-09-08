<?php 
	$scripts = array();
	if($page_active=='data_pemilih'){
		$data['dropzone_css'] 			= 'themes/plugins/dropzone/min/dropzone.min.css';
		$scripts['dropzone_js'] 		= 'themes/plugins/dropzone/dropzone_v.js';
		$scripts['data_pemilih'] 		= 'assets/js/data_pemilih.js';
	}
	$data['title'] 						= 'Dashboard Kantor Desa'; 
	$this->load->view('themes/admin/Header', $data);
?>
	<div id="page-loader" class="fade show"><span class="spinner"></span></div>
	<div id="page-container" class="page-container fade page-sidebar-fixed page-header-fixed">
		<?php
			$this->load->view('themes/admin/Header_nav');
			$menu['aktif']	= $page_active;
			$this->load->view('themes/admin/Sidebar', $menu);
		?>		
		<div id="content" class="content">
			<?php 
				if($page_active=='dashboard'){
					$scripts['dashboard'] 		= true;
					$this->load->view('dashboard/Dashboard_content');
				}
				if($page_active=='data_pemilih'){
					$scripts['dashboard'] 		= true;
					$dbase['dusun']				= $this->Query->select_where('dusun', array('*'), array(),0,20, 'uid ASC')->result_array();
					$dbase['rt']					= $this->Query->select_where_group_by('data_pemilih', array('rt'), array('rt'), array('id_dusun'=>$dbase['dusun'][0]['uid']),0,20, 'rt ASC')->result_array();
					$dbase['pemilih']				= $this->Query->select_where('data_pemilih', array('COUNT(id) as jml'), array(),0,1, 'id ASC')->row();
					$this->load->view('dashboard/data_pemilih/Index_pemilih', $dbase);
				}
				if($page_active=='data_hadir'){
					$scripts['dashboard'] 		= true;
					$scripts['rekap_hadir'] 	= 'assets/js/rekap_hadir.js';
					$dbase['dapil']				= $this->Query->select_where('pilkades_dapil', array('*'), array(),0,20, 'dapil ASC')->result_array();
					$dbase['rt']					= $this->Query->select_where_group_by('data_pemilih', array('rt'), array('rt'), array('id_dapil'=>$dbase['dapil'][0]['id']),0,20, 'rt ASC')->result_array();
					$dbase['pemilih']				= $this->Query->select_where('data_pemilih', array('COUNT(id) as jml'), array(),0,1, 'id ASC')->row();
					$this->load->view('dashboard/kehadiran/Kehadiran_rekap', $dbase);
				}
				if($page_active=='cek_hadir'){
					$scripts['dashboard'] 		= true;
					$scripts['kehadiran'] 		= 'assets/js/kehadiran.js';
					$this->load->view('dashboard/data_pemilih/Cek_hadir');
				}
				if($page_active=='set_hitung'){
					$scripts['dashboard'] 		= true;
					$scripts['set_hitung'] 		= 'assets/js/set_hitung.js';
					$this->load->view('dashboard/config/Set_hitung');
				}
				if($page_active=='panitia'){
					$scripts['dashboard'] 		= true;
					$scripts['panitia'] 		= 'assets/js/panitia.js';
					$this->load->view('dashboard/panitia/Panitia_index.php');
				}
				if($page_active=='kegiatan'){
					$scripts['dashboard'] 		= true;
					$scripts['kegiatan'] 		= 'assets/js/kegiatan.js';
					$this->load->view('dashboard/kegiatan/Kegiatan_index.php');
				}
				if($page_active=='set_dapil'){
					$scripts['dashboard'] 		= true;
					$scripts['set_dapil'] 		= 'assets/js/set_dapil.js';
					$this->load->view('dashboard/config/Set_dapil_index.php');
				}
				if($page_active=='set_cakades'){
					$scripts['dashboard'] 		= true;
					$scripts['set_cakades'] 	= 'assets/js/set_cakades.js';
					$this->load->view('dashboard/config/Set_cakades_index.php');
				}
			?>
		</div>
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
	</div>

	<div class="modal fade" id="ModalConfig">
	    <div class="modal-dialog modal-lg modal-dialog-centered">
	    	<div class="modal-content">
				<div id="data_config"></div>
			</div>		
	  </div>
	</div>

	<div class="modal fade" id="ModalForm">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content">
				<div id="data_content"></div>
			</div>		
		</div>
	</div>

	<div class="modal fade" id="ModalFormMid">
		<div class="modal-dialog modal-md modal-dialog-centered">
			<div class="modal-content">
				<div id="data_content_mid"></div>
			</div>		
		</div>
	</div>
	<div class="modal fade" id="ModalFormSM">
		<div class="modal-dialog modal-sm modal-dialog-centered">
			<div class="modal-content">
				<div id="data_content_sm"></div>
			</div>		
		</div>
	</div>
<?php 
	$this->load->view('themes/admin/Footer', $scripts);
?>