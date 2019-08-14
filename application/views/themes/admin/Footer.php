<?php 
	$jml_segment 	= $this->uri->total_segments();
	$base_url_int 	= $this->Cfg->int_uri($jml_segment);
?>
	<script src="<?php echo $base_url_int;?>themes/plugins/jquery/jquery-3.3.1.min.js"></script>
	<script src="<?php echo $base_url_int;?>themes/plugins/jquery-ui/jquery-ui.min.js"></script>
	<script src="<?php echo $base_url_int;?>themes/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

	<script src="<?php echo $base_url_int;?>themes/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?php echo $base_url_int;?>themes/plugins/js-cookie/js.cookie.js"></script>
	<script src="<?php echo $base_url_int;?>themes/js/theme/default.min.js"></script>
	<script src="<?php echo $base_url_int;?>themes/js/apps.min.js"></script>

	<!-- <script src="<?php echo $base_url_int;?>themes/plugins/bootstrap-sweetalert/sweetalert.min.js"></script> -->
	<script src="<?php echo base_url();?>themes/plugins/sweetalert/sweetalert2.min.js"></script>
	<script src="<?php echo $base_url_int;?>themes/plugins/d3/d3.min.js"></script>
	<script src="<?php echo $base_url_int;?>themes/plugins/nvd3/build/nv.d3.js"></script>
	<script src="<?php echo $base_url_int;?>themes/plugins/gritter/js/jquery.gritter.js"></script>
	<script src="<?php echo $base_url_int;?>themes/plugins/isotope/jquery.isotope.min.js"></script>
	<script src="<?php echo $base_url_int;?>themes/plugins/lightbox/js/lightbox.min.js"></script>
	<script src="<?php echo $base_url_int;?>assets/js/gallery.demo.js"></script>
	<script>
		base_url = "<?php echo $base_url_int;?>";
		$(document).ready(function() {
			App.init();
			Gallery.init();
		});
	</script>
<?php if(isset($dashboard)){  ?>
	<script src="<?php echo $base_url_int;?>assets/js/dashboard.js"></script>
	<script>
		$(document).ready(function() {
			DashboardV2.init();
		});
	</script>
<?php } ?>
<?php if(isset($base_pend)){  ?>
	<script src="<?php echo $base_url_int;?>assets/js/base_pend.js"></script>
<?php } ?>
<?php if(isset($dropzone_js)){  ?>
	<script src="<?php echo $base_url_int.$dropzone_js;?>"></script>
<?php } ?>
<?php if(isset($data_pemilih)){  ?>
	<script src="<?php echo $base_url_int.$data_pemilih;?>"></script>
<?php } ?>
<?php if(isset($kehadiran)){  ?>
	<script src="<?php echo $base_url_int;?>assets/js/kehadiran.js"></script>
<?php } ?>
<?php if(isset($set_hitung)){  ?>
	<script src="<?php echo $base_url_int.$set_hitung;?>"></script>
<?php } ?>
<?php if(isset($rekap_hadir)){  ?>
	<script src="<?php echo $base_url_int.$rekap_hadir;?>"></script>
<?php } ?>
<?php if(isset($set_dapil)){  ?>
	<script src="<?php echo $base_url_int.$set_dapil;?>"></script>
<?php } ?>
<?php if(isset($set_cakades)){  ?>
	<script src="<?php echo $base_url_int.$set_cakades;?>"></script>
<?php } ?>
</body>
</html>