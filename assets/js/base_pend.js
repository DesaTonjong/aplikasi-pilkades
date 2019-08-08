get_data();
function get_data() {
	$("#root").empty();
	var target = $('.panel_data');
	if (!$(target).hasClass('panel-loading')) {
		var targetBody = $(target).find('.panel_data_body');
		var spinnerHtml = '<div class="panel-loader"><span class="spinner-small"></span></div>';
		$(target).addClass('panel-loading');
		$(targetBody).prepend(spinnerHtml);
		var form = $("#form_data");
		$.get(base_url+"base_pend/get_data", form.serialize(), function(data){
			$("#root").html(data);
			$(target).removeClass('panel-loading');
			$(target).find('.panel-loader').remove();
		});
	}
}

$(document).on('click', '[data-click=panel-reload]', function(e) {
	e.preventDefault();
	get_data();
});


$(document).on('submit', '#form_data', function(e) {
	e.preventDefault();
	get_data();
	return false;
});

function get_data_keluarga(unix) {
	$("#modal_title").html('Data Keluarga');
	$("#ModalForm").modal('show');
	var target = $('.panel_modal');
	if (!$(target).hasClass('panel-loading')) {
		var targetBody = $(target).find('.panel_modal_body');
		var spinnerHtml = '<div class="panel-loader m-t-15"><span class="spinner-small"></span></div>';
		$(target).addClass('panel-loading');
		$(targetBody).prepend(spinnerHtml);
		$.get(base_url+"base_pend/get_data_keluarga", {'unix': unix}, function(data){
			$("#modal_content").html(data);
			$(target).removeClass('panel-loading');
			$(target).find('.panel-loader').remove();
		});
	}
}

function get_data_penduduk_info(unix) {
	$("#modal_title").html('Data Penduduk');
	$("#ModalForm").modal('show');
	var target = $('.panel_modal');
	if (!$(target).hasClass('panel-loading')) {
		var targetBody = $(target).find('.panel_modal_body');
		var spinnerHtml = '<div class="panel-loader m-t-15"><span class="spinner-small"></span></div>';
		$(target).addClass('panel-loading');
		$(targetBody).prepend(spinnerHtml);
		$.get(base_url+"base_pend/get_data_penduduk_info", {'unix': unix}, function(data){
			$("#modal_content").html(data);
			$(target).removeClass('panel-loading');
			$(target).find('.panel-loader').remove();
		});
	}
}

function get_data_penduduk_edit(unix) {
	$("#modal_title").html('Data Penduduk');
	$("#ModalForm").modal('show');
	var target = $('.panel_modal');
	if (!$(target).hasClass('panel-loading')) {
		var targetBody = $(target).find('.panel_modal_body');
		var spinnerHtml = '<div class="panel-loader m-t-15"><span class="spinner-small"></span></div>';
		$(target).addClass('panel-loading');
		$(targetBody).prepend(spinnerHtml);
		$.get(base_url+"base_pend/get_data_penduduk_edit", {'unix': unix}, function(data){
			$("#modal_content").html(data);
			$(target).removeClass('panel-loading');
			$(target).find('.panel-loader').remove();
		});
	}
}

$(document).on('submit', '#form_update_data_penduduk', function(){
	var form = $("#form_update_data_penduduk");
	var btn = $("#btn_update_data_penduduk");
	var unix = $("#unix_update_pend").val();
	btn.html('<i class="fa fa-spinner fa-spin text-center"></i>');
	$.post(form.attr('action'), form.serialize(), function(json){
		if(json.sts==true){
			get_data_penduduk_info(unix);
		}else{
			$("[name="+json.csrf.csrf.name+"]").val(json.csrf.csrf.hash);
		}
		btn.html('Login');
	},'json');
	return false;
});

function remove_data_penduduk(unix,from) {
	$.get(base_url+"base_pend/get_csrf", function(json){
		if(json.sts==true){
			swal({
				title: 'Apakah anda yakin?',
				text: "menghapus data ini!",
				icon: 'error',
				buttons:{
					cancel: {
						text:'Batal',
						visible: true,
						className: 'btn btn-success'
					},
					confirm: {
						text : 'Ya, saya yakin hapus data!',
						className : 'btn btn-danger'
					}
				}
			}).then((confirm) => {
				$.post(base_url+"base_pend/remove_data_penduduk", {'csrf_app_name': json.hash}, function(json){
					if(json.sts==true){
						if (confirm) {
							swal({
								title: 'Penghapusan!',
								text: 'Data telah berhasil dihapus',
								buttons : {
									confirm: {
										className : 'btn btn-success'
									}
								}
							});
							if(from==1){
								$("#ModalForm").modal('hide');
								$(".pend"+unix).fadeOut();
							}else{
								$(".pend"+unix).fadeOut();
							}
						} else {
							swal.close();
						}
					}
				},'json');
			});
		}
	},'json');
}
