var handleDashboardGritterNotification = function() {
	setTimeout(function() {
		$.gritter.add({
			title: 'Welcome back, Admin!',
			text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempus lacus ut lectus rutrum placerat.',
			image: '../assets/img/user/user-12.jpg',
			sticky: true,
			time: '',
			class_name: 'my-sticky-class'
		});
	}, 1000);
};

var DashboardV2 = function () {
	"use strict";
	return {
		//main function
		init: function () {
			//handleDashboardGritterNotification();
		}
	};
}();

function get_config() {
	$.get(base_url+"dashboard/get_form_config", function(data){
		$("#data_config").html(data);
	});
}

$(document).on('submit', '#form_update_config', function(){
	var form = $("#form_update_config");
	$.post(form.attr('action'), form.serialize(), function(json){
		if(json.sts==true){
			$("#ModalConfig").modal('hide');
		}
	},'json');
	return false;
});

function get_new_user() {
	$.get(base_url+"set_opr/add_new", function(data){
		$("#form_input").html(data);
			$("#nama_depan").val('');
			$("#nama_belakang").val('');
			$("#email_login_user").val('');
			$("#password_login_user").val('');
	});
}

function get_user_oper() {
	$.get(base_url+"set_opr/get_data", function(data){
		$("#data_config").html(data);
	});
	$("")
}

$(document).on('submit', '#form_add_new_user', function(){
	var form = $("#form_add_new_user");
	$.post(form.attr('action'), form.serialize(), function(json){
		if(json.sts==true){
			$("#nama_depan").val('');
			$("#nama_belakang").val('');
			$("#email_login_user").val('');
			$("#password_login_user").val('');
			$("#nama_depan").focus();
			$("#table_user tbody").append(json.trow);
		}
	},'json');
	return false;
});

function close_add_user() {
	$("#form_input").html('');
}

function get_edit_user(uid) {
	$.get(base_url+"set_opr/get_edit_user", {'uid':uid}, function(data){
		$("#form_input").html(data);
	});
	$("")
}

$(document).on('submit', '#form_update_user', function(){
	var form = $("#form_update_user");
	$.post(form.attr('action'), form.serialize(), function(json){
		if(json.sts==true){
			$("#form_input").html('');
			$("#nama_depan"+json.data.uid).html(json.data.nama_user);
			$("#mail"+json.data.uid).html(json.data.mail);
			$("#rule"+json.data.uid).html(json.data.rule);
			//$("#table_user tbody").append(json.trow);
		}
	},'json');
	return false;
});

function reset_pass(uid) {
	$.post(base_url+"set_opr/reset_pass", {'uid':uid},  function(json){
		if(json.sts==true){
			$("#pass"+json.uid).html(json.new_pass);
		}
	},'json');
	return false;
}

function remove_user(uid) {
	$.post(base_url+"set_opr/remove_user", {'uid':uid},  function(json){
		if(json.sts==true){
			$("#form_input").html('');
			$("#row"+json.uid).fadeOut();
		}else{
			alert(json.msg);	
		}
		
	},'json');
	return false;
}
$(document).on('submit', '#form_reset', function(){
	var form = $("#form_reset");
	$.post(form.attr('action'), form.serialize(), function(json){
		if(json.sts==true){
			
		}
		alert(json.msg);
	},'json');
	return false;
});
