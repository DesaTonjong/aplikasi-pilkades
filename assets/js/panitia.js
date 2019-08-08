get_data();
function get_data() {
	$("#data_panitia_root").html('');
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
			$("#data_panitia_root").html(data);
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
	$.get(base_url+"panitia/add_form", {'id_jab':id_jab}, function(data){
		$("#data_content").html(data);
	});
});

function get_edit_data(id_panitia) {
	$("#data_content").html('');
	$.get(base_url+"panitia/edit_form", {'id_pan':id_panitia}, function(data){
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
      url: './panitia/add_panitia',
      data: data,
      processData: false,
      contentType: false,
      cache: false,
      timeout: 600000,
      success: function (data) {
         $("#ket_jab").val('');
         $("#panitia_nama").val('');
         $("#image-source").val('');
         $("#image-preview").attr('./assets/img/default_200.jpg');
         console.log("SUCCESS : ", data);
         $("#gallery").prepend(data);
         $("#btnSubmit").prop("disabled", false);
         $("#ket_jab").focus();
			$("#btnSubmit").html('Simpan');

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
      url: './panitia/update_panitia',
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
	var id_pan = $("#id_pan").val();
	var panitia_nama = $("#panitia_nama").val();

	Swal.fire({
	  title: 'Apakah anda yakin akan menghapus '+panitia_nama+'..?',
	  text: "Data yang terhapus tidak dapat ditampilkan lagi",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
	  if (result.value) {
	  	$.post(base_url+"panitia/remove_panitia", {'id_pan': id_pan}, function(json){
	  		if(json.sts==true){
	  			$("#ModalForm").modal('hide');
	  			$("#pan"+id_pan).fadeOut();
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
