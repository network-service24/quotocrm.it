<script>
    $(function(){
      var s = 0;
      $('#add_tr').click(function(){                                 
        $('#add_t').append('<tr id="tr' + s + '">'
                    +'<td class="col-md-6">'
                    +'<input type="text" name="etichetta_brand[]" class="form-control no_border_input text-center font20">'
                    +'</td>'
                    +'<td class="col-md-6"><input type="text" name="valore_brand[]"  class="form-control no_border_input text-center font24Bold"></td>'
                    +'</tr>');
         s += 1;       
      });       
      $('#rem_tr').click(function(){ 
        s -= 1;                      
        $('#tr' + s + '').remove();
      });

      var n = 0;
      $('#add_riga_g').click(function(){                                 
        $('#add_r_g').append('<tr id="riga_g' + n + '">'
                    +'<td class="col-md-6">'
                    +'<div class="row">'
                    +'<div class="col-md-6">'
                    +'<select name="etichetta_brand[]" id="etichetta_brand_' + n + '"  class="form-control no_border_input font20" style="text-align:center!important">'
                    +'<option value="" selected="selected">--</option><?=$ListaBrand2?>'
                    +'</select></div>'
                     +'<div class="col-md-6"><select name="goal[]" id="goal_' + n + '" onchange="carica_goal(' + n + ')" class="form-control no_border_input font20" style="text-align:center!important">'
                    +'<option value="" selected="selected">--</option><?=$ListaGoal?>'
                    +'</select></div>' 
                    +'</div>'                 
                    +'<input type="hidden" id="compila_' + n +'"></td>'
                    +'<td class="col-md-6"><div class="input-group col-md-12"><span class="input-group-addon no_border_input_no_color"><i id="icona_' + n + '"></i></span><input type="text" name="valore_brand[]" id="valore_brand_' + n + '" class="form-control no_border_input text-center font20Bold"></div></td>'
                    +'</tr>');
         n += 1;       
      });       
      $('#rem_riga_g').click(function(){ 
        n -= 1;                      
        $('#riga_g' + n + '').remove();
      });

      var z = 0;
      $('#add_trN').click(function(){                                 
        $('#add_tN').append('<tr id="trN' + z + '">'
                    +'<td class="col-md-6">'
                    +'<input type="text" name="etichetta_nobrand[]" class="form-control no_border_input text-center font20">'
                    +'</td>'
                    +'<td class="col-md-6"><input type="text" name="valore_nobrand[]"  class="form-control no_border_input text-center font24Bold"></td>'
                    +'</tr>');
         z += 1;       
      });       
      $('#rem_trN').click(function(){ 
        z -= 1;                      
        $('#trN' + z + '').remove();
      });

      var x = 0;
      $('#add_riga_gN').click(function(){                                 
        $('#add_r_gN').append('<tr id="riga_gN' + x + '">'
                    +'<td class="col-md-6">'
                    +'<div class="row">'
                    +'<div class="col-md-6">'
                    +'<select name="etichetta_nobrand[]" id="etichetta_nobrand_' + x + '"  class="form-control no_border_input font20" style="text-align:center!important">'
                    +'<option value="" selected="selected">--</option><?=$ListaNoBrand2?>'
                    +'</select></div>'
                     +'<div class="col-md-6"><select name="goal_nobrand[]" id="goal_nobrand_' + x + '" onchange="carica_goal_nobrand(' + x + ')" class="form-control no_border_input font20" style="text-align:center!important">'
                    +'<option value="" selected="selected">--</option><?=$ListaGoalNoBrand?>'
                    +'</select></div>'  
                    +'</div>'                  
                    +'<input type="hidden" id="compila_nobrand_' + x +'"></td>'
                    +'<td class="col-md-6"><div class="input-group col-md-12"><span class="input-group-addon no_border_input_no_color"><i id="icona_nobrand_' + x + '"></i></span><input type="text" name="valore_nobrand[]" id="valore_nobrand_' + x + '" class="form-control no_border_input text-center font20Bold"></div></td>'
                    +'</tr>');
         x += 1;       
      });       
      $('#rem_riga_gN').click(function(){ 
        x -= 1;                      
        $('#riga_gN' + x + '').remove();
      });


      var y = 0;
      $('#add_trR').click(function(){                                 
        $('#add_tRMKT').append('<tr id="trRMKT' + y + '">'
                    +'<td class="col-md-6">'
                    +'<input type="text" name="etichetta_RMKT[]" class="form-control no_border_input text-center font20">'
                    +'</td>'
                    +'<td class="col-md-6"><input type="text" name="valore_RMKT[]"  class="form-control no_border_input text-center font24Bold"></td>'
                    +'</tr>');
         y += 1;       
      });       
      $('#rem_trRMKT').click(function(){ 
        y -= 1;                      
        $('#trRMKT' + y + '').remove();
      });

      var k = 0;
      $('#add_riga_gRMKT').click(function(){                                 
        $('#add_r_gRMKT').append('<tr id="riga_gRMKT' + k + '">'
                    +'<td class="col-md-6">'
                    +'<div class="row">'
                    +'<div class="col-md-6">'
                    +'<select name="etichetta_RMKT[]" id="etichetta_RMKT_' + k + '"  class="form-control no_border_input font20" style="text-align:center!important">'
                    +'<option value="" selected="selected">--</option><?=$ListaRMKT?>'
                    +'</select></div>'
                     +'<div class="col-md-6"><select name="goal_RMKT[]" id="goal_RMKT_' + k + '" onchange="carica_goal_RMKT(' + k + ')" class="form-control no_border_input font20" style="text-align:center!important">'
                    +'<option value="" selected="selected">--</option><?=$ListaGoalRMKT?>'
                    +'</select></div>'  
                    +'</div>'                  
                    +'<input type="hidden" id="compila_RMKT_' + k +'"></td>'
                    +'<td class="col-md-6"><div class="input-group col-md-12"><span class="input-group-addon no_border_input_no_color"><i id="icona_RMKT_' + k + '"></i></span><input type="text" name="valore_RMKT[]" id="valore_RMKT_' + k + '" class="form-control no_border_input text-center font20Bold"></div></td>'
                    +'</tr>');
         k += 1;       
      });       
      $('#rem_riga_gRMKT').click(function(){ 
        k -= 1;                      
        $('#riga_gRMKT' + k + '').remove();
      });

      var v = 0;
      $('#add_trRD').click(function(){                                 
        $('#add_tRMKT_D').append('<tr id="trRMKT_D' + v + '">'
                    +'<td class="col-md-6">'
                    +'<input type="text" name="etichetta_RMKT_D[]" class="form-control no_border_input text-center font20">'
                    +'</td>'
                    +'<td class="col-md-6"><input type="text" name="valore_RMKT_D[]"  class="form-control no_border_input text-center font24Bold"></td>'
                    +'</tr>');
         v += 1;       
      });       
      $('#rem_trRMKT_D').click(function(){ 
        v -= 1;                      
        $('#trRMKT_D' + v + '').remove();
      });

      var u = 0;
      $('#add_riga_gRMKT_D').click(function(){                                 
        $('#add_r_gRMKT_D').append('<tr id="riga_gRMKT_D' + u + '">'
                    +'<td class="col-md-6">'
                    +'<div class="row">'
                    +'<div class="col-md-6">'
                    +'<select name="etichetta_RMKT_D[]" id="etichetta_RMKT_D_' + u + '"  class="form-control no_border_input font20" style="text-align:center!important">'
                    +'<option value="" selected="selected">--</option><?=$ListaRMKT_D?>'
                    +'</select></div>'
                     +'<div class="col-md-6"><select name="goal_RMKT_D[]" id="goal_RMKT_D_' + u + '" onchange="carica_goal_RMKT_D(' + u + ')" class="form-control no_border_input font20" style="text-align:center!important">'
                    +'<option value="" selected="selected">--</option><?=$ListaGoalRMKT_D?>'
                    +'</select></div>'   
                    +'</div>'                 
                    +'<input type="hidden" id="compila_RMKT_D_' + u +'"></td>'
                    +'<td class="col-md-6"><div class="input-group col-md-12"><span class="input-group-addon no_border_input_no_color"><i id="icona_RMKT_D_' + u + '"></i></span><input type="text" name="valore_RMKT_D[]" id="valore_RMKT_D_' + u + '" class="form-control no_border_input text-center font20Bold"></div></td>'
                    +'</tr>');
         u += 1;       
      });       
      $('#rem_riga_gRMKT_D').click(function(){ 
        u -= 1;                      
        $('#riga_gRMKT_D' + u + '').remove();
      });

      var t = 0;
      $('#add_tr_TRIP').click(function(){                                 
        $('#add_t_TRIP').append('<tr id="tr_TRIP' + t + '">'
                    +'<td class="col-md-3"><select name="etichetta_1_TRIP[]" class="form-control no_border_input font20" style="text-align:center!important"><option value="" selected="selected">--</option><?=$Lista_TRIP?></select></td>'
                    +'<td class="col-md-3"><input type="text" name="valore_1_TRIP[]"  class="form-control no_border_input text-center font24Bold"></td>'
                    +'<td class="col-md-3"><select name="etichetta_2_TRIP[]" class="form-control no_border_input font20" style="text-align:center!important"><option value="" selected="selected">--</option><?=$Lista_TRIP?></select></td>'
                    +'<td class="col-md-3"><input type="text" name="valore_2_TRIP[]"  class="form-control no_border_input text-center font24Bold"></td>'                    
                    +'</tr>');
         t += 1;       
      });       
      $('#rem_tr_TRIP').click(function(){ 
        t -= 1;                      
        $('#tr_TRIP' + t + '').remove();
      });

      var tv = 0;
      $('#add_tr_TRIVAGO').click(function(){                                 
        $('#add_t_TRIVAGO').append('<tr id="tr_TRIVAGO' + tv + '">'
                    +'<td class="col-md-3"><select name="etichetta_1_TRIVAGO[]" class="form-control no_border_input font20" style="text-align:center!important"><option value="" selected="selected">--</option><?=$Lista_TRIVAGO?></select></td>'
                    +'<td class="col-md-3"><input type="text" name="valore_1_TRIVAGO[]"  class="form-control no_border_input text-center font24Bold"></td>'
                    +'<td class="col-md-3"><select name="etichetta_2_TRIVAGO[]" class="form-control no_border_input font20" style="text-align:center!important"><option value="" selected="selected">--</option><?=$Lista_TRIVAGO?></select></td>'
                    +'<td class="col-md-3"><input type="text" name="valore_2_TRIVAGO[]"  class="form-control no_border_input text-center font24Bold"></td>'                    
                    +'</tr>');
         tv += 1;       
      });       
      $('#rem_tr_TRIVAGO').click(function(){ 
        tv -= 1;                      
        $('#tr_TRIVAGO' + tv + '').remove();
      });

  });    

    function carica_goal(n) {

        var goal = $("#goal_"+n).val();
        var etichetta = $("#etichetta_brand_"+n).val();
        var num_id =  n;
        var idsito =  <?=$_REQUEST['param']?>;
        $.ajax({                 
          type: "POST",                
          url: "<?=BASE_URL_SITO?>report/ajax/valori_goal_adwords.php",                 
          data: "goal=" + goal + "&num_id=" + num_id + "&idsito=" + idsito + "&etichetta=" + etichetta,
          dataType: "html",   
          success: function(data){
            console.log(data);
            $("#compila_" + n).html(data);
          },
          error: function(){
            alert("Chiamata fallita, si prega di riprovare..."); 
          }
      });
    } 
    function carica_goal_nobrand(x) {

        var goal = $("#goal_nobrand_"+x).val();
        var etichetta = $("#etichetta_nobrand_"+x).val();
        var num_id =  x;
        var idsito =  <?=$_REQUEST['param']?>;
        $.ajax({                 
          type: "POST",                
          url: "<?=BASE_URL_SITO?>report/ajax/valori_goal_nobrand_adwords.php",                 
          data: "goal=" + goal + "&num_id=" + num_id + "&idsito=" + idsito + "&etichetta=" + etichetta,
          dataType: "html",   
          success: function(data){
            console.log(data);
            $("#compila_nobrand_" + x).html(data);
          },
          error: function(){
            alert("Chiamata fallita, si prega di riprovare..."); 
          }
      });
    } 
    function carica_goal_RMKT(k) {

        var goal = $("#goal_RMKT_"+k).val();
        var etichetta = $("#etichetta_RMKT_"+k).val();
        var num_id =  k;
        var idsito =  <?=$_REQUEST['param']?>;

        $.ajax({                 
          type: "POST",                
          url: "<?=BASE_URL_SITO?>report/ajax/valori_goal_RMKT_adwords.php",                 
          data: "goal=" + goal + "&num_id=" + num_id + "&idsito=" + idsito + "&etichetta=" + etichetta,
          dataType: "html",   
          success: function(data){
            console.log(data);
            $("#compila_RMKT_" + k).html(data);
          },
          error: function(){
            alert("Chiamata fallita, si prega di riprovare..."); 
          }
      });
    }

    function carica_goal_RMKT_D(u) {

        var goal = $("#goal_RMKT_D_"+u).val();
        var etichetta = $("#etichetta_RMKT_D_"+u).val();
        var num_id =  u;
        var idsito =  <?=$_REQUEST['param']?>;

        $.ajax({                 
          type: "POST",                
          url: "<?=BASE_URL_SITO?>report/ajax/valori_goal_RMKT_D_adwords.php",                 
          data: "goal=" + goal + "&num_id=" + num_id + "&idsito=" + idsito + "&etichetta=" + etichetta,
          dataType: "html",   
          success: function(data){
            console.log(data);
            $("#compila_RMKT_D_" + u).html(data);
          },
          error: function(){
            alert("Chiamata fallita, si prega di riprovare..."); 
          }
      });
    }



</script>