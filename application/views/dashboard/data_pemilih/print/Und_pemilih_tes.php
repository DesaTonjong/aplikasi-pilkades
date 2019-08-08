<?php
	$wrap_print 		= explode(',', $margin->wrap);
	$no_urut_top 		= explode(',', $margin->no_urut_top);
	$nama_pemilih 		= explode(',', $margin->nama_pemilih);
	$alamat_pemilih 	= explode(',', $margin->alamat_pemilih);
	$alamat_pemilih2 	= explode(',', $margin->alamat_pemilih2);
	$no_urut_bottom 	= explode(',', $margin->no_urut_bottom);
	$cfg 					= $this->Cfg->get_data();
	$jml_segment 		= $this->uri->total_segments();
	$base_url_int 		= $this->Cfg->int_uri($jml_segment);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Test Print Undangan Pemilih | APP PILKADES</title>
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

        	.no_urut_top{
        		display: block;
			  	min-width: 400px;
        		font-weight: bold;
        		margin-top: 70px; 
        		margin-left: 0px;
        		font-size: 22px;
        		margin-top: <?php echo $no_urut_top[0].'px';?>;
        		margin-left: <?php echo $no_urut_top[1].'px';?>;
        		font-size: <?php echo $no_urut_top[2].'px';?>;
        	}

        	.nama_pemilih{
        		display: block;
			  	min-width: 400px;
        		font-weight: bold;
        		margin-top: 30px; 
        		margin-left: 0px; 
        		font-size: 15px;
        		margin-top: <?php echo $nama_pemilih[0].'px';?>;
        		margin-left: <?php echo $nama_pemilih[1].'px';?>;
        		font-size: <?php echo $nama_pemilih[2].'px';?>;
        	}

        	.alamat_pemilih{
        		display: block;
			  	min-width: 600px;
        		margin-top: 0px; 
        		margin-left: 0px; 
        		font-size: 15px;
        		margin-top: <?php echo $alamat_pemilih[0].'px';?>;
        		margin-left: <?php echo $alamat_pemilih[1].'px';?>;
        		font-size: <?php echo $alamat_pemilih[2].'px';?>;
        	}

        	.alamat_pemilih2{
        		display: block;
			  	min-width: 600px; 
        		margin-top: 0px; 
        		margin-left: 0px; 
        		font-size: 15px;
        		margin-top: <?php echo $alamat_pemilih2[0].'px';?>;
        		margin-left: <?php echo $alamat_pemilih2[1].'px';?>;
        		font-size: <?php echo $alamat_pemilih2[2].'px';?>;
        	}

        	.no_urut_bottom{
        		display: block;
			  	min-width: 600px; 
        		font-weight: bold;
        		margin-top: 650px; 
        		margin-left: 0px;
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
 		<div class="wrapper">
	    	<span class="no_urut_top"><?php echo str_pad(1, $cfg['dig_no_und'], "0", STR_PAD_LEFT);?></span>
 			<span class="nama_pemilih"><?php echo strtoupper('SOEKARNO HATTA');?></span>
 			<span class="alamat_pemilih"><?php echo 'NAMA DUSUN' . " RT/RW : ". "005" . "/" . "008";?></span>
 			<span class="alamat_pemilih2"><?php echo "DESA MAJU JAYA, KECAMATAN HARAPAN RAKYAT";?></span>
 			<span class="no_urut_bottom"><?php echo str_pad(1, $cfg['dig_no_und'], "0", STR_PAD_LEFT);?></span>
    	</div>
 			<div class="page-break"></div>
        <script type="text/javascript">
            window.print();
        </script>
 	</body>
</html>    