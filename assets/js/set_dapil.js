get_data();

function get_data() {
	$.get(base_url+"setting/get_data_dapil", function(json){
		$("#data_dapil").html(json.data_tps);
	},'json');
}

function get_form_add_dapil() {
	$.get(base_url+"setting/get_form_add_dapil", function(data){
		$("#data_content_sm").html(data);
	});
}

function reload_dapil() {
	get_data();
}

$(document).on('submit', '#form_add_dapil', function (e) {
	e.preventDefault();
	var form = $("#form_add_dapil");
	var btn 	= $("#btn_add_dapil");
	btn.html('<i class="fa fa-spinner fa-spin text-center"></i>');
	$.post(form.attr('action'), form.serialize(), function (json) {
		if (json.sts == true) {
			$("#dapil_list").prepend(json.list);
			$("#dapil_add").val('');
			$("#dapil_add").focus();
		} else {
			//alert
		}
		btn.html('Simpan');
	}, 'json');
	return false;
});

function get_form_update_dapil(dapil_id) {
	$.get(base_url+"setting/get_dapil_update", {'dapil_id': dapil_id}, function(data){
		$("#data_content_sm").html(data);
	});
}

$(document).on('submit', '#form_update_dapil', function (e) {
	e.preventDefault();
	var form = $("#form_update_dapil");
	var btn 	= $("#btn_upd_dapil");
	btn.html('<i class="fa fa-spinner fa-spin text-center"></i>');
	$.post(form.attr('action'), form.serialize(), function (json) {
		if (json.sts == true) {
			$("#dapil"+json.dapil_id).html(json.dapil);
			$("#ModalFormSM").modal('hide');
		}
		btn.html('Simpan');
	}, 'json');
	return false;
});

function remove_dapil(dapil_id) {
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
						$.post(base_url+"setting/remove_dapil", {'dapil_id': dapil_id}, function(json){
							if (json.sts == true) {
								$("#list_dapil"+json.dapil_id).fadeOut();
								$("#ModalFormSM").modal('hide');
							}
						},'json');
				}
	});
}

function remove_user(jns, id_dapil, uid) {
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
						$.post(base_url+"setting/remove_user", {'jns':jns, 'id_dapil': id_dapil, 'uid': uid}, function(json){
							if (json.sts == true) {
								$("#user" + jns + id_dapil + uid).fadeOut();
							}
						},'json');
				}
	});
}

function get_new_user(jns, id_dapil) {
	$.get(base_url+"setting/get_new_user", {'jns':jns, 'id_dapil': id_dapil}, function(data){
		$("#data_content_sm").html(data);
	});
}

$(document).on('submit', '#form_add_user_dapil', function (e) {
	e.preventDefault();
	var form = $("#form_add_user_dapil");
	var btn 	= $("#btn_add_user");
	var user = $("#uid_user_add option:selected").text();
	var param = form.serializeArray();
   param.push({
      name: "user",
      value: user
   });

	btn.html('<i class="fa fa-spinner fa-spin text-center"></i>');
	$.post(form.attr('action'), param, function (json) {
		if (json.sts == true) {
			$("#user_dapil"+ json.jns + json.id_dapil).append(json.user);
			$("#ModalFormSM").modal('hide');
		} else {
			//alert
		}
		btn.html('Simpan');
	}, 'json');
	return false;
});