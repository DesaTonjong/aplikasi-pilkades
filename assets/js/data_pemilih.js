Dropzone.autoDiscover = false;
$(document).ready(function () {
	$("#upload_data_pemilih").dropzone({
		url: "data_pemilih/upload",
		paramName: "file",
		maxFilesize: 2,
		success: function (file, response) {
			$("#table_data_pemilih tbody").empty();
			$("#table_data_pemilih tbody").append(response);
		}
	});
});
var div_upload_pemilih = 0;

function show_upload_pemilih() {
	if (div_upload_pemilih == 0) {
		div_upload_pemilih = 1;
		$(".dropzone").removeClass('d-none');
		$(this).addClass('active');
	} else {
		div_upload_pemilih = 0;
		$(".dropzone").addClass('d-none');
		$(this).removeClass('active');
	}
}

get_rekap_dapil();
get_data(0);
get_pot_ganda();

function get_rekap_dapil() {
	var dapil_id = $("#dapil_id_filter option:selected").val();
	$.get(base_url + "data_pemilih/get_rekap_dapil", {
		'dapil_id': dapil_id
	}, function (data) {
		$("#rekap_dapil_root").html(data);
	});
}

function get_pot_ganda() {
	var pot_ganda_filter = $("#pot_ganda_filter option:selected").val();
	$.get(base_url + "data_pemilih/get_pot_ganda", {
		'id_filter': pot_ganda_filter
	}, function (data) {
		$("#pot_ganda_root").html(data);
	});
}

function get_ganda_name(filter) {
	$.get(base_url + "data_pemilih/get_ganda_name", {
		'filter': filter
	}, function (data) {
		$("#result_ganda").html(data);
	});
}

function get_ganda_nik(filter) {
	$.get(base_url + "data_pemilih/get_ganda_nik", {
		'filter': filter
	}, function (data) {
		$("#result_ganda").html(data);
	});
}

function get_ganda_tgl_lahir(filter) {
	$.get(base_url + "data_pemilih/get_ganda_tgl_lahir", {
		'filter': filter
	}, function (data) {
		$("#result_ganda").html(data);
	});
}

function get_data(page) {
	if (page == 0) {
		$("#table_data_pemilih tbody").empty();
	}
	var target = $('.panel_data');
	var id_dusun = $('#id_dusun').val();
	var rt = $('#rt_filter').val();
	var rw = $('#rw_filter').val();
	var key_search = $('#key_search').val();
	$(".load_more_loader").html('<i class="fa fa-spinner fa-spin text-center"></i>');
	// if (!$(target).hasClass('panel-loading')) {
	// var targetBody = $(target).find('.panel_data_body');
	// var spinnerHtml = '<div class="panel-loader"><span class="spinner-small"></span></div>';
	// $(target).addClass('panel-loading');
	// $(targetBody).prepend(spinnerHtml);
	var form = $("#form_data");
	$.get(base_url + "data_pemilih/get_data", {
		'id_dusun': id_dusun,
		'rt': rt,
		'rw': rw,
		'key_search': key_search,
		'page': page
	}, function (json) {
		$(".load_more").fadeOut();
		$("#table_data_pemilih tbody").append(json.data);
		// $(target).removeClass('panel-loading');
		// $(target).find('.panel-loader').remove();

		$("#id_dusun").val(json.id_dusun);
		$("#rt_filter").val(json.rt);
		$("#rw_filter").val(json.rw);

		$("#info_rkp_pemilih").html(json.filter + ' <span class="pull-right"><label class="label label-warning">' + json.rekap.start + '-' + json.rekap.end + '</label> <label class="label label-success">Lk : ' + json.rekap.jml_lk + '</label>  <label class="label label-primary">Pr : ' + json.rekap.jml_pr + '</label> <label class="label label-inverse">Jumlah : ' + json.rekap.total + '</label></span>');
	}, 'json');
	// }
}

function get_data_filter(id_dusun, rt, rw, page) {
	if (page == 0) {
		$("#table_data_pemilih tbody").empty();
	}
	// var target = $('.panel_data');
	$(".load_more_loader").html('<i class="fa fa-spinner fa-spin text-center"></i>');
	// if (!$(target).hasClass('panel-loading')) {
	// var targetBody = $(target).find('.panel_data_body');
	// var spinnerHtml = '<div class="panel-loader"><span class="spinner-small"></span></div>';
	// $(target).addClass('panel-loading');
	// $(targetBody).prepend(spinnerHtml);
	var form = $("#form_data");
	$.get(base_url + "data_pemilih/get_data", {
		'id_dusun': id_dusun,
		'rt': rt,
		'rw': rw,
		'page': page
	}, function (json) {
		$(".load_more").fadeOut();
		$("#table_data_pemilih tbody").append(json.data);
		// $(target).removeClass('panel-loading');
		// $(target).find('.panel-loader').remove();

		$("#id_dusun").val(json.id_dusun);
		$("#rt_filter").val(json.rt);
		$("#rw_filter").val(json.rw);

		$("#info_rkp_pemilih").html(json.filter + ' <span class="pull-right"><label class="label label-warning">' + json.rekap.start + '-' + json.rekap.end + '</label> <label class="label label-success">Lk : ' + json.rekap.jml_lk + '</label>  <label class="label label-primary">Pr : ' + json.rekap.jml_pr + '</label> <label class="label label-inverse">Jumlah : ' + json.rekap.total + '</label></span>');
	}, 'json');
	// }
}

$(document).on('click', '[data-click=panel-reload]', function (e) {
	e.preventDefault();
	get_data(0);
});

$(document).on('submit', '#form_data', function (e) {
	e.preventDefault();
	get_data(0);
});

function get_pemilih(id_pemilih) {
	$.get(base_url + "data_pemilih/get_edit_data", {
		'id_pemilih': id_pemilih
	}, function (data) {
		$("#data_content_mid").html(data);
	});
}

$(document).on('submit', '#form_update', function () {
	var btn = $("#btn_update");
	var form = $("#form_update");
	var param = form.serializeArray();
	var dusun = $("#id_dusun_form option:selected").text();
	param.push({
		name: "dusun",
		value: dusun
	});

	btn.html('<i class="fa fa-spinner fa-spin text-center"></i>');
	$.post(form.attr('action'), param, function (json) {
		if (json.sts == true) {
			$("#ModalFormMid").modal('hide');
			$("#select" + json.data.id).html(json.data.select);
			$("#nama" + json.data.id).html(json.data.nama);
			$("#gdr" + json.data.id).html(json.data.gdr);
			$("#nkh" + json.data.id).html(json.data.nkh);
			$("#rtrw" + json.data.id).html(json.data.rtrw);
			$("#dsn" + json.data.id).html(json.data.dsn);
		}else{
			Swal.fire({
				title: 'Warning',
				text: json.msg,
				type: 'warning',
				confirmButtonColor: '#3085d6',
			});
		}
	}, 'json');
	return false;
});

$(document).on('submit', '#form_add', function () {
	var btn = $("#btn_add");
	var form = $("#form_add");
	var param = form.serializeArray();
	var dusun = $("#id_dusun_form option:selected").text();
	param.push({
		name: "dusun",
		value: dusun
	});

	btn.html('<i class="fa fa-spinner fa-spin text-center"></i>');
	$.post(form.attr('action'), param, function (json) {
		if (json.sts == true) {
			$("#nik").val('');
			$("#nama_lengkap").val('');
			$("#rt").val('');
			$("#rw").val('');
			$("#nik").focus();
			$("#no_urut").val(json.last_nom);
			$.gritter.add({
				title: json.data,
				text: json.msg,
				time: 15000,
				class_name: 'my-sticky-class'
			});
		}else{
			Swal.fire({
				title: 'Warning',
				text: json.msg,
				type: 'warning',
				confirmButtonColor: '#3085d6',
			});
		}
		btn.html('Simpan');
	}, 'json');
	return false;
});

function remove_pemilih(argument) {
	// body...
}

function get_form_add() {
	$.get(base_url + "data_pemilih/get_form_add", function (data) {
		$("#data_content_mid").html(data);
	});
}

function get_data_rt() {
	var id_dusun = $("#id_dusun option:selected").val();
	$.get(base_url + "data_pemilih/get_data_rt", {
		'id_dusun': id_dusun
	}, function (json) {
		$("#rt_filter").empty();
		$.each(json.data, function (i) {
			$("#rt_filter").append(new Option("RT " + json.data[i].rt, json.data[i].rt));
		});
		$("#rt_filter").append(new Option("Semua...", 100));
	}, 'json');
}

$(document).on('change', '#id_dusun', function (e) {
	e.preventDefault();
	$("#table_data_pemilih tbody").empty();
	get_data_rt();
});

$(document).on('change', '#rt_filter', function (e) {
	e.preventDefault();
	$("#table_data_pemilih tbody").empty();
	get_data();
});


$(document).ready(function () {
	// Check All
	$('#select_urut_checkbox').click(function () {
		$(":checkbox").attr("checked", true);
	});
	// Uncheck All
	$('#select_urut_checkbox').click(function () {
		$(":checkbox").attr("checked", false);
	});
});

function check_uncheck_checkbox(isChecked) {
	if (isChecked) {
		$('input[name="select_urut"]').each(function () {
			this.checked = true;
		});
	} else {
		$('input[name="select_urut"]').each(function () {
			this.checked = false;
		});
	}
}

function get_setup_print_und() {
	$.get(base_url + "data_pemilih/get_setup_print_und", function (data) {
		$("#data_content").html(data);
	});
}

function print_undangan() {
	var sList = "";
	$('input[name="select_urut"]').each(function () {
		if (this.checked) {
			sList += "-" + $(this).val();
		}
	});

	sList = sList.substring(1);

	var rt = $("#rt_filter").val();
	var rw = $("#rw_filter").val();

	var url = base_url + "data_pemilih/print_und_pemilih?rw=" + rw + "&rt="+ rt + "&clist="+ sList;
	var page_size = "width=900,height=600";
	var popupWin = window.open(url, "_blank", page_size);
	popupWin.document.open(url, "_blank", page_size);
	popupWin.document.close();
	popupWin.focus();
}

function get_form_dusun() {
	$.get(base_url + "data_pemilih/get_form_dusun", function (data) {
		$("#data_content_mid").html(data);
	});
}

function get_edit_dusun(id_dusun) {
	$.get(base_url + "data_pemilih/get_edit_dusun", {
		'id_dusun': id_dusun
	}, function (data) {
		$("#edit_form_dusun").html(data);
	});
}

function close_edit_dusun() {
	$("#edit_form_dusun").html('');
}

$(document).on('submit', '#update_dusun', function (e) {
	e.preventDefault();
	var form = $("#update_dusun");
	$.post(base_url + "data_pemilih/update_dusun", form.serialize(), function (json) {
		if (json.sts == true) {
			$("#uid" + json.data.id).html(json.data.uid);
			$("#dusun" + json.data.id).html(json.data.dusun);
			$("#edit_form_dusun").html('');
		} else {
			//alert
		}
	}, 'json');
	return false;
});

function add_new_dusun() {
	$.get(base_url + "data_pemilih/add_new_dusun", function (data) {
		$("#edit_form_dusun").html(data);
	});
}

$(document).on('submit', '#add_new_dusun', function (e) {
	e.preventDefault();
	var form = $("#add_new_dusun");
	$.post(base_url + "data_pemilih/add_new_dusun_action", form.serialize(), function (json) {
		if (json.sts == true) {
			$("#table_dusun tbody").prepend(json.data.dusun);
			$("#dusun_edit").val('');
			$("#uid_dusun_edit").val('');
			$("#uid_dusun_edit").focus();
		} else {
			//alert
		}
	}, 'json');
	return false;
});

function remove_dusun(id_dusun) {
	$.post(base_url + "data_pemilih/remove_dusun", {
		'id_dusun': id_dusun
	}, function (json) {
		if (json.sts == true) {
			$("#dsn" + id_dusun).fadeOut();
			$("#edit_form_dusun").html('');
		} else {
			//alert
		}
	}, 'json');
}

function print_undangan_tes() {
	var sList = "";
	$('input[name="select_urut"]').each(function () {
		if (this.checked) {
			sList += "-" + $(this).val();
		}
	});
	sList = sList.substring(1);
	var url = base_url + "data_pemilih/print_und_pemilih_tes";
	var page_size = "width=900,height=600";
	var popupWin = window.open(url, "_blank", page_size);
	popupWin.document.open(url, "_blank", page_size);
	popupWin.document.close();
	popupWin.focus();
}


$(document).on('submit', '#setting_print_und_save', function (e) {
	e.preventDefault();
	var form = $("#setting_print_und_save");
	$("#btn_save").html('<i class="fa fa-spinner fa-spin text-center"></i>');
	$.post(base_url + "data_pemilih/setting_print_und_save", form.serialize(), function (json) {
		$("#btn_save").html('Simpan');
	}, 'json');
	return false;
});

function remove_data_pemilih() {
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
			var sList = "";
			$('input[name="select_urut"]').each(function () {
				if (this.checked) {
					sList += "," + $(this).val();
				}
			});
			sList = sList.substring(1);
			$.post(base_url + "data_pemilih/remove_data_pemilih", {
				'id_list': sList
			}, function (json) {
				if (json.sts == true) {
					alert(json.msg);
					$.each(json.data, function (index, value) {
						$("#pemilih" + value).fadeOut();
					});
				} else {
					alert(json.msg);
				}
			}, 'json');

		}
	});
}

function set_dapil(id_dapil, id_dusun, rt, rw) {
	$.get(base_url + "data_pemilih/set_dapil", {
		'id_dapil': id_dapil,
		'id_dusun': id_dusun,
		'rt': rt,
		'rw': rw,
	}, function (data) {
		$("#data_content_sm").html(data);
	});
}

$(document).on('submit', '#form_set_dapil_update', function (e) {
	e.preventDefault();
	var form = $("#form_set_dapil_update");
	$.post(base_url + "data_pemilih/set_dapil_update", form.serialize(), function (json) {
		if (json.sts == true) {
			if(json.data.id_dapil!=json.data.id_dapil_new){
				$("#row" + json.data.id_dapil + json.data.id_dusun + json.data.rt + json.data.rw).fadeOut();
			}
			$("#ModalFormSM").modal('hide');
		} else {
			alert(json.msg);
		}
	}, 'json');
	return false;
});

function get_rekap_pemilih(jns) {
	$.get(base_url + "data_pemilih/get_rekap_pemilih", {'jns': jns}, function (data) {
		$("#data_content_mid").html(data);
	});
}