$("#key_search").focus();
$(document).on('submit', '#form_cek_kehadiran', function(){
	var form = $("#form_cek_kehadiran");
	$.post(form.attr('action'), form.serialize(), function(json){
		if(json.sts==true){
			$("#form_cek_kehadiran").addClass('d-none');
			$("#data_search").html(json.data);
			$("#accept_id").focus();
		}else{
			$("#form_cek_kehadiran").addClass('d-none');
			$("#data_search").html(json.msg);
		}
	},'json');
	return false;
});

$(document).on('submit', '#form_post_kehadiran', function(){
	var form = $("#form_post_kehadiran");
	$.post(form.attr('action'), form.serialize(), function(json){
		if(json.sts==true){
			//$("#data_search").html(json.data);
			// $.gritter.add({
			// 	title: json.gritter.no_urut+', '+json.gritter.pemilih,
			// 	text: json.gritter.alamat+', <br>Telah dicatat hadir, pada pukul : '+ json.gritter.time,
			// 	time: 15000,
			// 	class_name: 'my-sticky-class'
			// });
			$("#data_search").html('');
			$("#form_cek_kehadiran").removeClass('d-none');
			$("#key_search").val('');
			$("#key_search").focus();
			$("#list_kehadiran").prepend(json.data);
		}else{
			$("#data_search").html(json.msg);
		}
	},'json');
	return false;
});

function cancel_kehadiran() {
	$("#form_cek_kehadiran").removeClass('d-none');
	$("#key_search").val('');
	$("#data_search").html('');
	$("#key_search").focus();
}

$(document).on('keyup', '#key_search', function(e){
//$(document).keyup(function(e) {
     if (e.key === "Escape") { // escape key maps to keycode `27`
			$("#key_search").val('');
			$("#data_search").html('');
			$("#key_search").focus();
    }
});

$(document).on('keyup', '#accept_id', function(e){
//$(document).keyup(function(e) {
     if (e.key === "Escape") { // escape key maps to keycode `27`
       cancel_kehadiran();
    }
});

$(document).on('keyup', 'body', function(e){
//$(document).keyup(function(e) {
     if (e.key === "Escape") { // escape key maps to keycode `27`
       cancel_kehadiran();
    }
});

function get_data_kehadiran(page) {
	$.get('./kehadiran/get_data_kehadiran', {'page':page}, function(data){
		$("#data_config").html(data);
	});
}