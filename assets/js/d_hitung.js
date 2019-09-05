get_result();
function get_result() {
   $.get('./penghitungan/get_result', function(json){
      $.each( json.result, function( key, value ) {
         var persen = 0;
         if(json.dapil[value['id_dapil']]){
            persen = $.number((value['jml_suara']/json.dapil[value['id_dapil']])*100,1);
            $("#rest"+ value['id_cal']+ value['id_dapil']).html(persen+"%");// style="width: 10%"
            $("#rest"+ value['id_cal']+ value['id_dapil']).removeClass("d-none");// style="width: 10%"
            $("#result"+ value['id_cal']+ value['id_dapil']).css('width', persen+"%");// style="width: 10%"
            console.log('rest',value['id_cal']+ value['id_dapil']);
         }else{

         }
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