get_data();
function get_data() {
	$("#data_kegiatan_root").html('');
	var target   = $('.panel_data');
	var id_jab = $('#id_jab option:selected').val();
	var key_search	= $('#key_search').val();
	if (!$(target).hasClass('panel-loading')) {
		var targetBody = $(target).find('.panel_data_body');
		var spinnerHtml = '<div class="panel-loader"><span class="spinner-small"></span></div>';
		$(target).addClass('panel-loading');
		$(targetBody).prepend(spinnerHtml);
		var form = $("#form_search");
		$.get(form.attr('action'), form.serialize(), function(data){
			$("#data_kegiatan_root").html(data);
			$(target).removeClass('panel-loading');
			$(target).find('.panel-loader').remove();
		});
	}
}

$(document).on('submit', '#form_search', function(){
	get_data();
	return false;
});

$(document).on('change', '#id_jab_filter', function(){
	get_data();
});

$(document).on('click', '#btn_add_form', function(){
	var id_jab = $("#id_jab_filter option:selected").val();
	$.get(base_url+"kegiatan/add_form", {'id_jab':id_jab}, function(data){
		$("#data_content").html(data);
	});
});

function get_edit_data(id_kegiatan) {
	$("#data_content").html('');
	$.get(base_url+"kegiatan/edit_form", {'id_pan':id_kegiatan}, function(data){
		$("#data_content").html(data);
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

$(document).on('submit', '#form_add', function(event){
	$("#btnSubmit").html('<i class="fa fa-spinner fa-spin text-center"></i>');
  event.preventDefault();
  var form = $('#form_add')[0];;
  var data = new FormData(form);
 	$.ajax({
      type: "POST",
      enctype: 'multipart/form-data',
      url: './kegiatan/add_data',
      data: data,
      processData: false,
      contentType: false,
      cache: false,
      timeout: 600000,
      success: function (data) {
         $("#image-source").val('');
         $("#image-preview").attr('src', './assets/img/default_photo_800.jpg');
         console.log("SUCCESS : ", data);
         $("#gallery").prepend(data);
         $("#btnSubmit").prop("disabled", false);
			$("#btnSubmit").html('Simpan');
         $("#keterangan").val('');
         $("#title").val('');
         $("#title").focus();

      },
      error: function (e) {
         $("#result").text(e.responseText);
         console.log("ERROR : ", e);
         $("#btnSubmit").prop("disabled", false);
			$("#btnSubmit").html('Simpan');

      }
  	});
	return false;
}); 

$(document).on('submit', '#form_update', function(event){
	$("#btnSubmit").html('<i class="fa fa-spinner fa-spin text-center"></i>');
  event.preventDefault();
  var form = $('#form_update')[0];;
  var data = new FormData(form);
 	$.ajax({
      type: "POST",
      enctype: 'multipart/form-data',
      url: './kegiatan/update_data',
      data: data,
      processData: false,
      contentType: false,
      cache: false,
      timeout: 600000,
      success: function (data) {
      	var obj = JSON.parse(data);
         console.log("SUCCESS : ", obj.photo_new);
         $("#img_pan"+obj.id_pan).attr('src', './assets/img/photo/128/'+obj.photo_new);
         $("#ModalForm").modal('hide');

      },
      error: function (e) {
         $("#result").text(e.responseText);
         console.log("ERROR : ", e);
         $("#btnSubmit").prop("disabled", false);
			$("#btnSubmit").html('Simpan');

      }
  	});
	return false;
});


$(document).on('click', '#btnremove', function(){
	var id_kgiat = $("#id_kgiat").val();
	var kegiatan_nama = $("#kegiatan_nama").val();

	Swal.fire({
	  title: 'Apakah anda yakin akan menghapus '+kegiatan_nama+'..?',
	  text: "Data yang terhapus tidak dapat ditampilkan lagi",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
	  if (result.value) {
	  	$.post(base_url+"kegiatan/remove_kegiatan", {'id_kgiat': id_kgiat}, function(json){
	  		if(json.sts==true){
	  			$("#ModalForm").modal('hide');
	  			$("#pan"+id_kgiat).fadeOut();
			    Swal.fire(
			      'Deleted!',
			      'Data berhasil dihapus',
			      'success'
			    );
	  		}
	  	},'json');

	  }
	});
});
