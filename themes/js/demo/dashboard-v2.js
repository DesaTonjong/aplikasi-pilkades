
var handleDashboardGritterNotification = function() {
	setTimeout(function() {
		$.gritter.add({
			title: 'Welcome back, Admin!',
			text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempus lacus ut lectus rutrum placerat.',
			image: '../assets/img/user/user-12.jpg',
			sticky: true,
			fade_out_speed: 2000,
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