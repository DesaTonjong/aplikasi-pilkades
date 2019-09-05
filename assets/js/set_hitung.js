var segment = "hitung_manual/";
get_data(0);
get_data_data_perolehan();

function get_data(page){
   $.get(base_url + segment + "get_data", {'page':page},function(json){
      if(page==0){
         $("#list_entry").html();
         $("#list_entry").append(json.list_entry);
      }else{
         $(".load_more").fadeOut();
         $("#list_entry").append(json.list_entry);
      }
   },'json');
}

function get_data_data_perolehan(){
   $.get(base_url + segment + "get_data_data_perolehan", function(json){
      $("#data_perolehan").html(json.result);
   },'json');
}

$(document).on('submit', '#form_post', function (e) {
	e.preventDefault();
	var form = $("#form_post");
	var btn 	= $("#btn_add_post");
   btn.html('<i class="fa fa-spinner fa-spin text-center"></i>');
   var alert_msg = $("#alert_msg");
   alert_msg.html('');
	$.post(form.attr('action'), form.serialize(), function (json) {
		if (json.sts == true) {
         $("#unix_id").val(json.unix_id);
         $("#result_list").prepend(json.list);
			$("#no_calon").val('');
         $("#no_calon").focus();
         var tot_suara = json.tot_suara;
         $(".tot_suara").html(tot_suara);
         var persen = 0;
         $.each( json.suara, function( key, value ) {
            $("#suara"+ value['id_cal']).html(value['jml_suara']);
            persen = (parseInt(value['jml_suara']) / tot_suara) * 100;
            $("#persen"+ value['id_cal']).html('<div class="flex-grow-1">' +
                  '<div class="progress progress-xs rounded-corner bg-white-transparent-1">' +
                     '<div class="progress-bar bg-indigo" data-animation="width" data-value="'+ persen +'%" style="width: '+ persen +'%;"></div>' +
                  '</div>'+
               '</div>' +
               '<div class="ml-2 f-s-11 width-50 text-center text-muted"><span data-animation="number" data-value="'+ persen+'" class="f-s-15 f-w-700 text-white">'+ $.number(persen,1) +'</span>%</div>');
            });
            $("#list_entry").prepend(json.list);
		} else {
			$("#no_calon").val('');
			$("#no_calon").focus();
         //alert
         alert_msg.html(json.msg);
		}
		btn.html('Simpan');
	}, 'json');
	return false;
});

function remove_le(unix_id) {
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
			$.post(base_url + "hitung_manual/remove_hitung", {
				'unix_id': unix_id
			}, function (json) {
				if (json.sts == true) {
               $("#le" + unix_id).fadeOut();
                  
               var tot_suara = json.tot_suara;
               $(".tot_suara").html(tot_suara);
               var persen = 0;
               $.each( json.suara, function( key, value ) {
                  $("#suara"+ value['id_cal']).html(value['jml_suara']);
                  persen = (parseInt(value['jml_suara']) / tot_suara) * 100;
                  $("#persen"+ value['id_cal']).html('<div class="flex-grow-1">' +
                        '<div class="progress progress-xs rounded-corner bg-white-transparent-1">' +
                           '<div class="progress-bar bg-indigo" data-animation="width" data-value="'+ persen +'%" style="width: '+ persen +'%;"></div>' +
                        '</div>'+
                     '</div>' +
                     '<div class="ml-2 f-s-11 width-50 text-center text-muted"><span data-animation="number" data-value="'+ persen+'" class="f-s-15 f-w-700 text-white">'+ $.number(persen,1) +'</span>%</div>');
                  });
				} else {
					alert(json.msg);
				}
			}, 'json');

		}
	});
}

$.fn.tallier = function (count) {
   var $this = this,
       bgUrl = 'http://i.stack.imgur.com/96hvp.png',
       bgHeight = 125,
       bgVals = [
           [45, 25],
           [65, -35],
           [85, -115],
           [105, -215],
           [140, -360]
       ],
       count = 0;
   
   $this.click(function(e) {
       count++;
       if (count%5 == 1) {
           var $newTally = $('<div>').addClass('tally');
           $newTally.css({
                         background: 'url("' + bgUrl + '") ' +
                           bgVals[0][1] + 'px 0 no-repeat transparent',
                         float: 'left',
                         width: bgVals[0][0] + 'px',
                         height: bgHeight + 'px'
                     });
           $this.append($newTally);
       }
       var $lastTally = $this.find('.tally:last'),
           i = count%5 - 1;
       i = i < 0 ? 4 : i;
       $lastTally.css({
           'background-position': bgVals[i][1] + 'px 0',
           width: bgVals[i][0] + 'px'
       });
   });
};

$('#tally').tallier(5);
$('#tally').click();