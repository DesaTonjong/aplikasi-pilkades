<?php foreach ($list_entry->result_array() as $key => $value) { ?>
   <div id="le<?php echo $value['unix_id'];?>" class="widget-list-item rounded-0 p-t-3">
      <div class="widget-list-media icon">
         <span class="rounded <?php echo ($value['no_cal']==0) ? "bg-white text-red":"bg-grey-transparent-2 text-white ";?> p-10 f-s-16 f-w-700"><?php echo ($value['no_cal']==0) ? "X":$value['no_cal'];?></span>
      </div>
      <div class="widget-list-content">
         <div class="widget-list-title"><?php echo '<span class="f-s-12 f-w-700">'. $value['nama_calon'].'</span><br><span class="text-xs text-muted"><i class="fa fa-clock-o" aria-hidden="true"></i> '.date_format(date_create($value['created_at']),"H:i:s").'</span>';?></div>
      </div>
      <div class="widget-list-action text-nowrap text-grey">
         <a href="javascript:;" class="text-danger" title="Hapus/Batal" onclick="remove_le('<?php echo $value['unix_id'];?>')">
            <i class="fa fa-times fa-sm"></i>
         </a>
      </div>
   </div>
<?php } ?>
<div class="widget-list-item rounded-0 p-t-3 load_more">
   <div class="widget-list-content text-center">
      <a href="javascript:;" class="text-primary" title="Load more.." onclick="get_data(<?php echo $next_page;?>)">
         Load more..
      </a>
   </div>
</div>