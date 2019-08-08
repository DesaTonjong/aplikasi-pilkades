get_data();

function get_data() {
	$.get(base_url+"setting/get_data", function(json){
		$("#data_tps").html(json.data_tps);
		$("#data_calon").html(json.data_calon);
	},'json');
}

function get_tps(id) {
	$.get(base_url+"setting/get_tps", {'id_tps': id}, function(json){
		$("#data_content").html(data);
	},'json');
}