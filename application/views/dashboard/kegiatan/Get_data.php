<div id="gallery" class="gallery row">
<?php foreach ($panitia as $key => $value) { ?>
	<div class="image col-md-4" id="pan<?php echo $value['id'];?>">
		<div class="image-inner">
			<a href="<?php echo base_url('assets/img/kegiatan/800/').$value['filename'];?>" data-lightbox="gallery-group-1">
			<img id="img_pan<?php echo $value['id'];?>" src="<?php echo base_url('assets/img/kegiatan/200/').$value['filename'];?>" alt="" />
			</a>
		</div>
		<div class="image-info p-5">
			<a href="#ModalForm" data-toggle="modal" onclick="get_edit_data(<?php echo $value['id'];?>)"><h5 class="title m-b-0"><?php echo $value['title'];?></h5>
				<small><?php echo $value['keterangan'];?></small></a>
		</div>
	</div>
<?php } ?>
</div>
