get_data();

function get_data() {
	$.get(base_url+"setting/get_data", function(json){
		$("#data_cakades").html(json.data_calon);
	},'json');
}

function get_add_form_cakades() {
	$.get(base_url+"setting/get_add_form_cakades", function(data){
		$("#data_content_mid").html(data);
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
			$("#data_content_mid").html(data);
		});
	}else{
		$("#data_content_mid").html('Data tidak bisa diedit');
	}
}

$(document).on('submit', '#form_update_cakades', function (e) {
	e.preventDefault();
	var form = $("#form_update_cakades");
	var btn 	= $("#btn_upd_cakades");
	btn.html('<i class="fa fa-spinner fa-spin text-center"></i>');
	$.post(form.attr('action'), form.serialize(), function (json) {
		if (json.sts == true) {
			$("#cakades"+json.cakades_id).html(json.cakades);
			$("#ModalFormMid").modal('hide');
		}else{
			Swal.fire({
				title: 'Periksa kesalahan error',
				text: json.msg,
				type: 'warning',
				confirmButtonColor: '#3085d6',
			});
		}
		btn.html('Simpan');
	}, 'json');
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