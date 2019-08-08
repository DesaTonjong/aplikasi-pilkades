function get_rekap_hadir(rw) {
	$.get(base_url+"data_pemilih/get_rekap_hadir", {'rw':rw},function(data){
		$("#data_content").html(data);
	});
}

function remove_hadir(id_hadir) {
   swal({
       title: "Apakah anda yakin?",
       text: "akan menghapus kehadiran saudara : "+ $("#und"+id_hadir).html()+", "+ $("#pemilih"+id_hadir).html() +" ..?",
       icon: "warning",
       buttons: true,
       dangerMode: true,
     })
    .then((willDelete) => {
         if (willDelete) {
				$.post(base_url+"data_pemilih/remove_hadir", {'id_hadir':id_hadir},function(json){
					if(json.sts==true){
						$("#hadir"+id_hadir).fadeOut();
						swal($("#und"+id_hadir).html()+", "+ $("#pemilih"+id_hadir).html() + " berhasil dihapus");
					}
				},'json');
         } else {
                swal("Penghapusan dibatalkan");
     }
  });
}