<div id="gallery" class="gallery row">
<?php foreach ($panitia as $key => $value) { ?>
	<div class="image col-md-3" id="pan<?php echo $value['id'];?>">
		<div class="image-inner">
			<a href="<?php echo base_url('assets/img/photo/128/').$value['photo'];?>" data-lightbox="gallery-group-<?php echo $value['id_jab'];?>">
			<img id="img_pan<?php echo $value['id'];?>" src="<?php echo base_url('assets/img/photo/128/').$value['photo'];?>" alt="" />
			</a>
			<p class="image-caption" id="jab_pan<?php echo $value['id'];?>">
				<?php echo $value['ket'];?>
			</p>
		</div>
		<div class="image-info p-5">
			<a href="#ModalForm" data-toggle="modal" onclick="get_edit_data(<?php echo $value['id'];?>)"><h5 class="title"><?php echo $value['nama'];?></h5></a>
		</div>
	</div>
<?php } ?>
</div>	