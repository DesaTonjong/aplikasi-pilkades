get_result();
function get_result() {
   $.get('./get_result', function(json){
      var tot_global = json.tot_global;
      $.each( json.result, function( key, value ) {
         var persen  = 0;
         if(json.dapil[value['id_dapil']]>0){
            persen = $.number((value['jml_suara']/json.dapil[value['id_dapil']])*100,1);
            $("#show_info"+ value['id_cal']+ value['id_dapil']).html(value['jml_suara'] + '');// style="width: 10%"
            $("#rest"+ value['id_cal']+ value['id_dapil']).html(persen);// style="width: 10%"
            $("#result"+ value['id_cal']+ value['id_dapil']).css('width', persen+"%");// style="width: 10%"
            $("#result"+ value['id_cal']+ value['id_dapil']).attr('data-value="'+ persen +'%"');// style="width: 10%"
         }else{
            $("#show_info"+ value['id_cal']+ value['id_dapil']).html('masing kosong');// style="width: 10%"
            $("#rest"+ value['id_cal']+ value['id_dapil']).html('0');// style="width: 10%"
            $("#result"+ value['id_cal']+ value['id_dapil']).css('width', "0%");// style="width: 10%"
            $("#result"+ value['id_cal']+ value['id_dapil']).attr('data-value="0%"');// style="width: 10%"
         }
      });
      $.each( json.per_cal, function( key, value ) {
         var persen = $.number((value['jml_suara'] / tot_global) * 100,1);
         $("#rest_tot"+ value['id_cal']).html(persen);// style="width: 10%"
         $("#result_tot"+ value['id_cal']).css('width', persen+"%");// style="width: 10%"
         $("#result_tot"+ value['id_cal']).attr('data-value="'+ persen +'%"');// style="width: 10%"
         $("#show_info_tot"+ value['id_cal']).html($.number(value['jml_suara']) + '');
      });  
   },'json');
}

var n = 30;
var tm = setInterval(countDown,1000);

function countDown(){
   n--;
   if(n == 0){
      // clearInterval(tm);
      n=30;
      get_result();
   }
   console.log(n);
}