<script>
  $(function(){
    var s = 0;
    $('#add_tr').click(function(){
      $('#add_t').append('<tr id="tr' + s + '">'
                  +'<td class="col-md-6">'
                  +'<input type="text" name="panoramica[]" class="form-control no_border_input text-center font20">'
                  +'</td>'
                  +'<td class="col-md-3"><input type="text" name="anno_panoramica[]"  class="form-control no_border_input text-center font20Bold"></td>'
                  +'<td class="col-md-3"><input type="text" name="scorsoanno_panoramica[]"  class="form-control no_border_input text-center"></td>'
                  +'</tr>');
       s += 1;
    });
    $('#rem_tr').click(function(){
      s -= 1;
      $('#tr' + s + '').remove();
    });

    var z = 0;
    $('#add_cr').click(function(){
      $('#add_c').append('<tr id="tr' + z + '">'
                  +'<td class="col-md-6">'
                  +'<input type="text" name="conversioni[]"  class="form-control no_border_input font20">'
                  +'</td>'
                  +'<td class="col-md-3"><input type="text" name="anno_conversioni[]" class="form-control no_border_input text-center font20Bold"></td>'
                  +'<td class="col-md-3"><input type="text" name="scorsoanno_conversioni[]"  class="form-control no_border_input text-center"></td>'
                  +'</tr>');
       z += 1;
    });
    $('#rem_cr').click(function(){
      z -= 1;
      $('#cr' + z + '').remove();
    });

    var m = 0;
    $('#add_trA').click(function(){
      $('#add_tA').append('<table  id="trA' + m + '" class="table table-bordered" >'
                  +'<tr>'
                  +'<td class="col-md-3"><input type="text" name="canale[]" class="form-control no_border_input font24Bold" /></td>'
                  +'<td class="col-md-3"></td>'
                  +'<td class="col-md-3"></td>'
                  +'<td class="col-md-3"></td>'
                  +'</tr>'
                  +'<tr>'
                  +'<td class="col-md-3"><input type="text" name="anno_canale_organico[]" class="form-control no_border_input text-center font20"></td>'
                  +'<td class="col-md-3"><input type="text" name="sessioni_canale_organico[]" class="form-control no_border_input text-center font20" /></td>'
                  +'<td class="col-md-3"><input type="text" name="transazioni_canale_organico[]" class="form-control no_border_input text-center font20" /></td>'
                  +'<td class="col-md-3"><input type="text" name="entrate_canale_organico[]" class="font20 form-control no_border_input text-center" /></td>'
                  +'</tr>'
                  +'<tr>'
                  +'<td class="col-md-3"><input type="text" name="anno_canale_organico[]" class="form-control no_border_input text-center"></td>'
                  +'<td class="col-md-3"><input type="text" name="sessioni_canale_organico[]" class="form-control no_border_input text-center" /></td>'
                  +'<td class="col-md-3"><input type="text" name="transazioni_canale_organico[]" class="form-control no_border_input text-center" /></td>'
                  +'<td class="col-md-3"><input type="text" name="entrate_canale_organico[]" class="form-control no_border_input text-center" /></td>'
                  +'</tr>'
                  +'</table>');
       m += 1;
    });
    $('#rem_trA').click(function(){
      m -= 1;
      $('#trA' + m + '').remove();
    });

    var x = 0;
    $('#add_trA2').click(function(){
      $('#add_tA2').append('<table  id="trA2' + x + '" class="table table-bordered" >'
                  +'<tr>'
                  +'<td class="col-md-3"><input type="text" name="canale2[]" class="form-control no_border_input font24Bold" /></td>'
                  +'<td class="col-md-3"></td>'
                  +'<td class="col-md-3"></td>'
                  +'<td class="col-md-3"></td>'
                  +'</tr>'
                  +'<tr>'
                  +'<td class="col-md-3"><input type="text" name="anno_canale_organico2[]" class="form-control no_border_input text-center font20"></td>'
                  +'<td class="col-md-3"><input type="text" name="sessioni_canale_organico2[]" class="form-control no_border_input text-center font20" /></td>'
                  +'<td class="col-md-3"><input type="text" name="conversioni_canale_organico2[]" class="form-control no_border_input text-center font20" /></td>'
                  +'<td class="col-md-3"><input type="text" name="tasso_conversione_canale_organico2[]" class="font20 form-control no_border_input text-center" /></td>'
                  +'</tr>'
                  +'<tr>'
                  +'<td class="col-md-3"><input type="text" name="anno_canale_organico2[]" class="form-control no_border_input text-center"></td>'
                  +'<td class="col-md-3"><input type="text" name="sessioni_canale_organico2[]" class="form-control no_border_input text-center" /></td>'
                  +'<td class="col-md-3"><input type="text" name="conversioni_canale_organico2[]" class="form-control no_border_input text-center" /></td>'
                  +'<td class="col-md-3"><input type="text" name="tasso_conversione_canale_organico2[]" class="form-control no_border_input text-center" /></td>'
                  +'</tr>'
                  +'</table>');
       x += 1;
    });
    $('#rem_trA2').click(function(){
      x -= 1;
      $('#trA2' + x + '').remove();
    });

    var y = 0;
    $('#add_trA3').click(function(){
      $('#add_tA3').append('<table  id="trA3' + y + '" class="table table-bordered" >'
                  +'<tr>'
                  +'<td class="col-md-3"><input type="text" name="canale3[]" class="form-control no_border_input font24Bold" /></td>'
                  +'<td class="col-md-3"></td>'
                  +'<td class="col-md-3"></td>'
                  +'<td class="col-md-3"></td>'
                  +'</tr>'
                  +'<tr>'
                  +'<td class="col-md-3"><input type="text" name="anno_canale_organico3[]" class="form-control no_border_input text-center font20"></td>'
                  +'<td class="col-md-3"><input type="text" name="sessioni_canale_organico3[]" class="form-control no_border_input text-center font20" /></td>'
                  +'<td class="col-md-3"><input type="text" name="conversioni_canale_organico3[]" class="form-control no_border_input text-center font20" /></td>'
                  +'<td class="col-md-3"><input type="text" name="entrate_canale_organico3[]" class="font20 form-control no_border_input text-center" /></td>'
                  +'</tr>'
                  +'<tr>'
                  +'<td class="col-md-3"><input type="text" name="anno_canale_organico3[]" class="form-control no_border_input text-center"></td>'
                  +'<td class="col-md-3"><input type="text" name="sessioni_canale_organico3[]" class="form-control no_border_input text-center" /></td>'
                  +'<td class="col-md-3"><input type="text" name="conversioni_canale_organico3[]" class="form-control no_border_input text-center" /></td>'
                  +'<td class="col-md-3"><input type="text" name="entrate_canale_organico3[]" class="form-control no_border_input text-center" /></td>'
                  +'</tr>'
                  +'</table>');
       y += 1;
    });
    $('#rem_trA3').click(function(){
      y -= 1;
      $('#trA3' + y + '').remove();
    });


    var v = 0;
    $('#add_trV').click(function(){
        $('#add_tV').append('<table  id="trV' + v + '" class="table table-bordered" >'
                    +'<tr>'
                    +'<td class="col-md-3"><input type="text" name="categoria[]" class="form-control no_border_input font24Bold" /></td>'
                    +'<td class="col-md-3"></td>'
                    +'<td class="col-md-3"></td>'
                    +'<td class="col-md-3"></td>'
                    +'</tr>'
                    +'<tr>'
                    +'<td class="col-md-3"><input type="text" name="anno_categoria_organico[]" class="form-control no_border_input text-center font20"></td>'
                    +'<td class="col-md-3"><input type="text" name="sessioni_categoria_organico[]" class="form-control no_border_input text-center font20" /></td>'
                    +'<td class="col-md-3"><input type="text" name="transazioni_categoria_organico[]" class="form-control no_border_input text-center font20" /></td>'
                    +'<td class="col-md-3"><input type="text" name="entrate_categoria_organico[]" class="font20 form-control no_border_input text-center" /></td>'
                    +'</tr>'
                    +'<tr>'
                    +'<td class="col-md-3"><input type="text" name="anno_categoria_organico[]" class="form-control no_border_input text-center"></td>'
                    +'<td class="col-md-3"><input type="text" name="sessioni_categoria_organico[]" class="form-control no_border_input text-center" /></td>'
                    +'<td class="col-md-3"><input type="text" name="transazioni_categoria_organico[]" class="form-control no_border_input text-center" /></td>'
                    +'<td class="col-md-3"><input type="text" name="entrate_categoria_organico[]" class="form-control no_border_input text-center" /></td>'
                    +'</tr>'
                    +'</table>');
        v += 1;
    });
    $('#rem_trV').click(function(){
        v -= 1;
        $('#trV' + v + '').remove();
    });

    var v2 = 0;
    $('#add_trV2').click(function(){
        $('#add_tV2').append('<table  id="trV2' + v2 + '" class="table table-bordered" >'
                    +'<tr>'
                    +'<td class="col-md-3"><input type="text" name="categoria2[]" class="form-control no_border_input font24Bold" /></td>'
                    +'<td class="col-md-3"></td>'
                    +'<td class="col-md-3"></td>'
                    +'<td class="col-md-3"></td>'
                    +'</tr>'
                    +'<tr>'
                    +'<td class="col-md-3"><input type="text" name="anno_categoria_organico2[]" class="form-control no_border_input text-center font20"></td>'
                    +'<td class="col-md-3"><input type="text" name="sessioni_categoria_organico2[]" class="form-control no_border_input text-center font20" /></td>'
                    +'<td class="col-md-3"><input type="text" name="transazioni_categoria_organico2[]" class="form-control no_border_input text-center font20" /></td>'
                    +'<td class="col-md-3"><input type="text" name="entrate_categoria_organico2[]" class="font20 form-control no_border_input text-center" /></td>'
                    +'</tr>'
                    +'<tr>'
                    +'<td class="col-md-3"><input type="text" name="anno_categoria_organico2[]" class="form-control no_border_input text-center"></td>'
                    +'<td class="col-md-3"><input type="text" name="sessioni_categoria_organico2[]" class="form-control no_border_input text-center" /></td>'
                    +'<td class="col-md-3"><input type="text" name="transazioni_categoria_organico2[]" class="form-control no_border_input text-center" /></td>'
                    +'<td class="col-md-3"><input type="text" name="entrate_categoria_organico2[]" class="form-control no_border_input text-center" /></td>'
                    +'</tr>'
                    +'</table>');
        v2 += 1;
    });
    $('#rem_trV2').click(function(){
        v2 -= 1;
        $('#trV2' + v2 + '').remove();
    });


    var v3 = 0;
    $('#add_trV3').click(function(){
        $('#add_tV3').append('<table  id="trV3' + v3 + '" class="table table-bordered" >'
                    +'<tr>'
                    +'<td class="col-md-3"><input type="text" name="categoria3[]" class="form-control no_border_input font24Bold" /></td>'
                    +'<td class="col-md-3"></td>'
                    +'<td class="col-md-3"></td>'
                    +'<td class="col-md-3"></td>'
                    +'</tr>'
                    +'<tr>'
                    +'<td class="col-md-3"><input type="text" name="anno_categoria_organico3[]" class="form-control no_border_input text-center font20"></td>'
                    +'<td class="col-md-3"><input type="text" name="sessioni_categoria_organico3[]" class="form-control no_border_input text-center font20" /></td>'
                    +'<td class="col-md-3"><input type="text" name="transazioni_categoria_organico3[]" class="form-control no_border_input text-center font20" /></td>'
                    +'<td class="col-md-3"><input type="text" name="entrate_categoria_organico3[]" class="font20 form-control no_border_input text-center" /></td>'
                    +'</tr>'
                    +'<tr>'
                    +'<td class="col-md-3"><input type="text" name="anno_categoria_organico3[]" class="form-control no_border_input text-center"></td>'
                    +'<td class="col-md-3"><input type="text" name="sessioni_categoria_organico3[]" class="form-control no_border_input text-center" /></td>'
                    +'<td class="col-md-3"><input type="text" name="transazioni_categoria_organico3[]" class="form-control no_border_input text-center" /></td>'
                    +'<td class="col-md-3"><input type="text" name="entrate_categoria_organico3[]" class="form-control no_border_input text-center" /></td>'
                    +'</tr>'
                    +'</table>');
        v3 += 1;
    });
    $('#rem_trV3').click(function(){
        v3 -= 1;
        $('#trV3' + v3 + '').remove();
    });

    var c = 0;
    $('#add_riga').click(function(){
        $('#add_r').append('<tr id="riga' + c + '">'
                    +'<td class="col-md-6">'
                    +'<select name="conversioni[]" id="conversioni_' + c + '" onchange="carica_valori(' + c + ')" class="form-control no_border_input font20" style="text-align:center!important">'
                    +'<option value="" selected="selected">--</option><?=$ListaConversioni?>'
                    +'</select>'
                    +'<input type="hidden" id="compila_' +c +'"></td>'
                    +'<td class="col-md-3"><div class="input-group"><span class="input-group-addon no_border_input_no_color"><i id="icona_' + c + '"></i></span><input type="text" name="anno_conversioni[]" id="anno_' + c + '" class="form-control no_border_input text-center font20Bold"></div></td>'
                    +'<td class="col-md-3"><div class="input-group"><span class="input-group-addon no_border_input_no_color"><i id="icona_bis_' + c + '"></i></span><input type="text" name="scorsoanno_conversioni[]" id="scorsoanno_' + c + '" class="form-control no_border_input text-center"></div></td>'
                    +'</tr>');
        c += 1;
    });
    $('#rem_riga').click(function(){
        c -= 1;
        $('#riga' + c + '').remove();
    });

    var n = 0;
    $('#add_riga_g').click(function(){
        $('#add_r_g').append('<tr id="riga_g' + n + '">'
                    +'<td class="col-md-6">'
                    +'<div class="row">'
                    +'<div class="col-md-6">'
                    +'<select name="conversioni[]" id="conversioni_g_' + n + '"  class="form-control no_border_input font20" style="text-align:center!important">'
                    +'<option value="" selected="selected">--</option><?=$ListaConversioni2?>'
                    +'</select></div>'
                    +'<div class="col-md-6"><select name="goal[]" id="goal_' + n + '" onchange="carica_goal(' + n + ')" class="form-control no_border_input font20" style="text-align:center!important">'
                    +'<option value="" selected="selected">--</option><?=$ListaGoal?>'
                    +'</select></div>'
                    +'</div>'
                    +'<input type="hidden" id="compila_g_' + n +'"></td>'
                    +'<td class="col-md-3"><div class="input-group"><span class="input-group-addon no_border_input_no_color"><i id="icona_g_' + n + '"></i></span><input type="text" name="anno_conversioni[]" id="anno_g_' + n + '" class="form-control no_border_input text-center font20Bold"></div></td>'
                    +'<td class="col-md-3"><div class="input-group"><span class="input-group-addon no_border_input_no_color"><i id="icona_bis_g_' + n + '"></i></span><input type="text" name="scorsoanno_conversioni[]" id="scorsoanno_g_' + n + '" class="form-control no_border_input text-center"></div></td>'
                    +'</tr>');
        n += 1;
    });
    $('#rem_riga_g').click(function(){
        n -= 1;
        $('#riga_g' + n + '').remove();
    });

});

function carica_valori(c) {

    var conversione = $("#conversioni_"+c).val();
    var num_id =  c;
    var idsito =  <?=$_REQUEST['param']?>;
    $.ajax({
    type: "POST",
    url: "<?=BASE_URL_SITO?>report/ajax/valori_conversioni.php",
    data: "conversione=" + conversione + "&num_id=" + num_id + "&idsito=" + idsito,
    dataType: "html",
    success: function(data){
        console.log(data);
        $("#compila_" + c).html(data);
    },
    error: function(){
        alert("Chiamata fallita, si prega di riprovare...");
    }
});
}

function carica_goal(n) {

    var goal = $("#goal_"+n).val();
    var conversione = $("#conversioni_g_"+n).val();
    var num_id =  n;
    var idsito =  <?=$_REQUEST['param']?>;
    $.ajax({
        type: "POST",
        url: "<?=BASE_URL_SITO?>report/ajax/valori_goal.php",
        data: "goal=" + goal + "&num_id=" + num_id + "&idsito=" + idsito + "&conversione=" + conversione,
        dataType: "html",
        success: function(data){
            console.log(data);
            $("#compila_g_" + n).html(data);
        },
        error: function(){
        alert("Chiamata fallita, si prega di riprovare...");
        }
    });
}


function capture() {

  $('#semi_pie_analitycs').html2canvas({
   logging: true,
   useCORS: true,
    onrendered: function (canvas) {
      img_semi = canvas.toDataURL("image/jpeg");
      $('#img_semi_pie_analitycs').val(img_semi);
      document.getElementById("form_report").submit();
    }
  });

}

function capture2() {

  $('#bar_analitycs').html2canvas({
  logging: true,
  useCORS: true,
    onrendered: function (canvas) {
      img_bar = canvas.toDataURL("image/jpeg");
      $('#img_bar_analitycs').val(img_bar);
      document.getElementById("form_report").submit();
    }
  });

}

$(document).ready(function(){

    $('[data-tooltip="tooltip"]').tooltip();

    $("#type_score").on("change",function(){
        var tipo = $("#type_score").val();
        if(tipo == 'logo'){
            $('#salva_dati').hide();
            $('#salva_dati_capture').html('<button type="submit" class="btn btn-success"  onclick="capture();"><i class="fa fa-floppy-o" aria-hidden="true"></i> Salva</button><input type="hidden" name="img_semi_pie_analitycs" id="img_semi_pie_analitycs" value="" />');
        }
        if(tipo == 'grafico'){
            $('#salva_dati').hide();
            $('#salva_dati_capture').html('<button type="submit" class="btn btn-success"  onclick="capture2();"><i class="fa fa-floppy-o" aria-hidden="true"></i> Salva</button><input type="hidden" name="img_bar_analitycs" id="img_bar_analitycs" value="" />');
        }
    })

    $("#score_percentuale").on("keyup",function(){
        var score = $("#score_percentuale").val();
        var scorelen = score.length;
        $.ajax({
            url: "<?=BASE_URL_SITO?>report/ajax/change_value_score.php",
            type: "POST",
            data: "score="+score+"",
                success: function(data) {
                    $("#load_score_date").html(data);
                    $("#percentuale_score_php").hide();
                    if(scorelen >2){
                        $("#percentuale_score_js").attr("style","position:relative;top:-190px;left:350px")
                    }else{
                        $("#percentuale_score_js").attr("style","position:relative;top:-190px;left:365px")
                    } 
                },
                error: function(){
                    alert("Chiamata fallita, si prega di riprovare...");
                }
        });
        return false; 
    });

    $("#score_percentuale_altre").on("keyup",function(){
        var scoreN = $("#score_percentuale_altre").val();
        var scoreNlen = scoreN.length;
        $.ajax({
            url: "<?=BASE_URL_SITO?>report/ajax/change_value_scoreN.php",
            type: "POST",
            data: "scoreN="+scoreN+"",
                success: function(data) {
                    $("#load_score_dateN").html(data);
                },
                error: function(){
                    alert("Chiamata fallita, si prega di riprovare...");
                }
        });
        return false; 
    });

    $("#ricarica_pie").on("click",function(){
        var perc_marketing = $("#perc_marketing").val();
        var perc_altro     = $("#perc_altro").val();
        $.ajax({
            url: "<?=BASE_URL_SITO?>report/ajax/custom_pie.php",
            type: "POST",
            data: "perc_marketing="+perc_marketing+"&perc_altro="+perc_altro+"",
                success: function(data) {
                    $("#chartContainer2").html(data);
                    $("#chartContainer").remove();
                    $("#grafico_dinamico").remove();
                    $("#chartContainer_custom").show();
                    $("#chartContainer_custom").attr("style","height: 370px; width: 90%; margin: 0px auto;");
                    $("a.canvasjs-chart-credit").remove(); 
                },
                error: function(){
                    alert("Chiamata fallita, si prega di riprovare...");
                }
        });
        return false; 
    });

    $('#marketing_score').on("keyup keypress", function() {
        var valore = $('#marketing_score').val();
        if(valore){
          $('#perc_marketing_score').html(valore +'%');
        }
    });

    setTimeout(function(){  
        $("a.canvasjs-chart-credit").remove(); 
    }, 3000);

});



</script>