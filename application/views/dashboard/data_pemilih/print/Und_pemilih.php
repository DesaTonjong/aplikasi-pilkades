	<?php
	$wrap_print 		= explode(',', $margin->wrap);
	$no_urut_top 		= explode(',', $margin->no_urut_top);
	$nama_pemilih 		= explode(',', $margin->nama_pemilih);
	$alamat_pemilih 	= explode(',', $margin->alamat_pemilih);
	$alamat_pemilih2 	= explode(',', $margin->alamat_pemilih2);
	$no_urut_bottom 	= explode(',', $margin->no_urut_bottom);
	$qr_code 			= explode(',', $margin->qr_code);
	$bar_code 			= explode(',', $margin->bar_code);
	$cfg 					= $this->Cfg->get_data();
	$jml_segment 		= $this->uri->total_segments();
	$base_url_int 		= $this->Cfg->int_uri($jml_segment);
	?>
	<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="utf-8" />
			<title>Undangan Pemilih | APP PILKADES</title>
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta content="width=device-width, initial-scale=1" name="viewport" />
			<meta content="" name="description" />
			<meta content="" name="author" />

			<!-- START @FONT STYLES -->
			<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700" rel="stylesheet"/>
			<link href="https://fonts.googleapis.com/css?family=Oswald:700,400" rel="stylesheet"/>
			<!--/ END FONT STYLES -->

			<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
			<link href="<?php echo $base_url_int;?>themes/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
			<link href="<?php echo $base_url_int;?>themes/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
			<link href="<?php echo $base_url_int;?>themes/plugins/font-awesome/css/all.min.css" rel="stylesheet" />
			<link href="<?php echo $base_url_int;?>themes/plugins/animate/animate.min.css" rel="stylesheet" />
			<link href="<?php echo $base_url_int;?>themes/css/default/style.min.css" rel="stylesheet" />
			<link href="<?php echo $base_url_int;?>themes/css/default/style-responsive.min.css" rel="stylesheet" />
			<link href="<?php echo $base_url_int;?>themes/css/default/theme/default.css" rel="stylesheet" id="theme" />
			<style type="text/css">
			body{
				background-color: white;
			}

			.wrapper{

			}

			.wrap_data{
				position: relative;
				margin-top: 0px;
				margin-left: 0px;
				width: 700px;
			}

			.wrap_qr{
				position: absolute;
				margin-top: 90px;
				margin-left: 700px;
				margin-top: <?php echo $qr_code[0].'px';?>;
				margin-left: <?php echo $qr_code[1].'px';?>;
				padding: 10px;
				border: 7px solid #000000;
			}

			.wrap_bar{
				position: absolute;
				margin-top: 90px;
				margin-left: 700px;
				margin-top: <?php echo $bar_code[0].'px';?>;
				margin-left: <?php echo $bar_code[1].'px';?>;
				padding: 10px;
			}

			.wrap_data .no_urut_top{
				position: relative;
				display: block;
				min-width: 400px;
				font-weight: bold;
				font-size: 22px;
				margin-top: <?php echo $no_urut_top[0].'px';?>;
				margin-left: <?php echo $no_urut_top[1].'px';?>;
				font-size: <?php echo $no_urut_top[2].'px';?>;
			}

			.wrap_data .nama_pemilih{
				position: relative;
				display: block;
				min-width: 400px;
				font-weight: bold;
				font-size: 15px;
				margin-top: <?php echo $nama_pemilih[0].'px';?>;
				margin-left: <?php echo $nama_pemilih[1].'px';?>;
				font-size: <?php echo $nama_pemilih[2].'px';?>;
			}

			.wrap_data .alamat_pemilih{
				position: relative;
				display: block;
				min-width: 600px;
				font-size: 15px;
				margin-top: <?php echo $alamat_pemilih[0].'px';?>;
				margin-left: <?php echo $alamat_pemilih[1].'px';?>;
				font-size: <?php echo $alamat_pemilih[2].'px';?>;
			}

			.wrap_data .alamat_pemilih2{
				position: relative;
				display: block;
				min-width: 600px; 
				font-size: 15px;
				margin-top: <?php echo $alamat_pemilih2[0].'px';?>;
				margin-left: <?php echo $alamat_pemilih2[1].'px';?>;
				font-size: <?php echo $alamat_pemilih2[2].'px';?>;
			}

			.wrap_data .no_urut_bottom{
				position: relative;
				display: block;
				min-width: 600px; 
				font-weight: bold;
				font-size: 22px;
				margin-top: <?php echo $no_urut_bottom[0].'px';?>;
				margin-left: <?php echo $no_urut_bottom[1].'px';?>;
				font-size: <?php echo $no_urut_bottom[2].'px';?>;
			}


			@media all {
				.page-break	{ display: none; }
			}

			@media print {
				.page-break	{ display: block; page-break-before: always; }
			}

			</style>
			<link rel="shortcut icon" href="favicon.ico" /> 
		</head>

	<body>
			<?php 
			foreach ($pemilih as $key => $value) { 
				$nik 	= '';
				if($value['nik']!=""){
					$nik 				= $this->Set->nik_space($value['nik']).'<br>';
					$nik_q 			= '';
					if($cfg['qr_code']==1){
						$nik_q 		.= $value['nik'];
						$qr_code 	= base_url('bar_qr_code/render_qr'). '?code=' . str_pad($value['no_urut'], $cfg['dig_no_und'], "0", STR_PAD_LEFT).';'.$nik_q .';'. strtoupper($value['nama_lengkap']). ";".$value['dusun']. ";". $value['rt'] . ";" . $value['rw'].'#';
					}
					if($cfg['bar_code']==1){
						$nik_q 		.= $value['nik'];
						$bar_code 	= base_url('bar_qr_code/render_bar'). '?code=' . str_pad($value['no_urut'], $cfg['dig_no_und'], "0", STR_PAD_LEFT);
					}
				}
				?>
				
				<div class="wrapper">
					<div class="wrap_data">
						<?php if($cfg['qr_code']==1){ ?>
							<div class="wrap_qr text-center" style="border-radius: 15px;">
								<img src="<?php echo $qr_code;?>">
								<?php echo '<b><span class="f-s-18 f-w-600">'. $nik. '</span></b>';?>
							</div>
						<?php } ?>
						<?php if($cfg['bar_code']==1){ ?>
							<div class="wrap_bar text-center" style="border-radius: 15px;">
								<img src="<?php echo $bar_code;?>">
							</div>
						<?php } ?>
						<span class="no_urut_top text-inverse"><?php echo str_pad($value['no_urut'], $cfg['dig_no_und'], "0", STR_PAD_LEFT);?></span>
						<span class="nama_pemilih text-inverse"><?php echo $nik. strtoupper($value['nama_lengkap']);?></span>
						<span class="alamat_pemilih"><?php echo $value['dusun'] . " RT/RW : ". $value['rt'] . "/" . $value['rw'];?></span>
						<span class="alamat_pemilih2"><?php echo $cfg['sistem'] . ' '. ucwords(strtolower($cfg['desa'])) . ' - Kec. '. ucwords(strtolower($cfg['kec']));?></span>
						<span class="no_urut_bottom"><?php echo str_pad($value['no_urut'], $cfg['dig_no_und'], "0", STR_PAD_LEFT);?></span>
					</div>
				</div>	

				<div class="page-break"></div>
			<?php } ?>
		
			<script type="text/javascript">
				window.print();
			</script>
	</body>
	</html>    