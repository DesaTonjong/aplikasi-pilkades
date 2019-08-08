var handleLoginPageChangeBackground = function() {
	$(document).on('click', '[data-click="change-bg"]', function(e) {
		e.preventDefault();
		var targetImage = '[data-id="login-cover-image"]';
		var targetImageSrc = 'url(' + $(this).attr('data-img') +')';

		$(targetImage).css('background-image', targetImageSrc);
		$('[data-click="change-bg"]').closest('li').removeClass('active');
		$(this).closest('li').addClass('active');	
	});

	$(document).on('submit', '#form_login', function(e){
		e.preventDefault();
		var form = $("#form_login");
		var btn  = $("#btn_login_form");
    	btn.html('<i class="fa fa-spinner fa-spin text-center"></i>');
		$.post(form.attr('action'), form.serialize(), function(json){
			if(json.sts==true){
				window.location.href = json.url;
			}else{
				var value = $("[name='"+ json.data.csrf.name +"']").val(json.data.csrf.hash);
			}
    		btn.html('Login');
		},'json');
		return false;
	});
};

var LoginV2 = function () {
	"use strict";
	return {
		//main function
		init: function () {
			handleLoginPageChangeBackground();
		}
	};
}();