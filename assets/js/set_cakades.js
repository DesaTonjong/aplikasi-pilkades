get_data();

function get_data() {
	$.get(base_url+"setting/get_data", function(json){
		$("#data_cakades").html(json.data_calon);
	},'json');
}

function get_add_form_cakades() {
	$.get(base_url+"setting/get_add_form_cakades", function(data){
		$("#data_content").html(data);
	});
}

$(document).on('submit', '#form_add_cakades', function (e) {
	e.preventDefault();
	var form = $("#form_add_cakades");
	var btn 	= $("#btn_add_cakades");
	btn.html('<i class="fa fa-spinner fa-spin text-center"></i>');
	$.post(form.attr('action'), form.serialize(), function (json) {
		if (json.sts == true) {
			$("#cakades_list").append(json.list);
			$("#nama_cakades").val('');
			$("#nomor_add").val('');
			$("#pend_nama_add").val('');
			$("#pend_thn_add").val('');
			$("#lahir_tmp_add").val('');
			$("#nama_cakades").focus();
		} else {
			//alert
		}
		btn.html('Simpan');
	}, 'json');
	return false;
});

function get_form_update_cakades(cakades_id) {
	if(parseInt(cakades_id)>1){
		$.get(base_url+"setting/get_form_update_cakades", {'cakades_id': cakades_id}, function(data){
			$("#data_content").html(data);
		});
	}else{
		$("#data_content").html('Data tidak bisa diedit');
	}
}

$(document).on('submit', '#form_update_cakades', function (es) {
	es.preventDefault();
	var form_attr = $("#form_update_cakades");
	var form = $('#form_update_cakades')[0];;
	var data = new FormData(form);
	var btn 	= $("#btn_upd_cakades");
	btn.html('<i class="fa fa-spinner fa-spin text-center"></i>');
	$.ajax({
      type: "POST",
      enctype: 'multipart/form-data',
      url: form_attr.attr('action'),
      data: data,
      processData: false,
      contentType: false,
      cache: false,
      timeout: 600000,
      success: function (data) {
			get_data();
			$("#ModalForm").modal('hide');
			btn.html('Simpan');
      }
	  });
	  
	return false;
});

function remove_cakades(cakades_id) {
	Swal.fire({
				title: 'Apakah anda yakin akan menghapus..?',
				text: "Data yang terhapus tidak dapat ditampilkan lagi",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
				}).then((result) => {
					if (result.value) {
						$.post(base_url+"setting/remove_cakades", {'cakades_id': cakades_id}, function(json){
							if (json.sts == true) {
								$("#cakades"+json.cakades_id).fadeOut();
								$("#ModalFormMid").modal('hide');
							}
						},'json');
				}
	});
}



function previewImage() {
	document.getElementById("image-preview").style.display = "block";
	var oFReader = new FileReader();
	 oFReader.readAsDataURL(document.getElementById("image-source").files[0]);

	oFReader.onload = function(oFREvent) {
	  document.getElementById("image-preview").src = oFREvent.target.result;
	};
};