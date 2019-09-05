<?php 
	$jml_segment 		= $this->uri->total_segments();
	$base_url_int 		= $this->Cfg->int_uri($jml_segment);
?>
<div id="header" class="header navbar-inverse">
	<div class="navbar-header">
		<a href="<?php echo $base_url_int.'dashboard?p=dashboard';?>" class="navbar-brand"><span class="navbar-logo"></span> <b>APP</b> PILKADES <small>v.3.0.0</small></a>
		<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
	</div>
	<ul class="navbar-nav navbar-right">
		<li class="dropdown navbar-user">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<img src="<?php echo $base_url_int;?>assets/img/user/user-13.jpg" alt="" /> 
				<span class="d-none d-md-inline"><?php echo $this->session->userdata('username');?></span> <b class="caret"></b>
			</a>
			<div class="dropdown-menu dropdown-menu-right">
				<!--
				<a href="javascript:;" class="dropdown-item">Edit Profile</a>
				<a href="javascript:;" class="dropdown-item"><span class="badge badge-danger pull-right">2</span> Inbox</a>
				<a href="javascript:;" class="dropdown-item">Profile</a>
				<div class="dropdown-divider"></div>
			-->
				<a href="<?php echo $base_url_int.'home/logout';?>" class="dropdown-item">Log Out</a>
			</div>
		</li>
	</ul>
</div>