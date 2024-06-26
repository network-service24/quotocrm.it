<script>
function strstr(haystack, needle, bool) {
    // Finds first occurrence of a string within another
    //
    // version: 1103.1210
    // discuss at: http://phpjs.org/functions/strstr    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   bugfixed by: Onno Marsman
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // *     example 1: strstr(‘Kevin van Zonneveld’, ‘van’);
    // *     returns 1: ‘van Zonneveld’    // *     example 2: strstr(‘Kevin van Zonneveld’, ‘van’, true);
    // *     returns 2: ‘Kevin ‘
    // *     example 3: strstr(‘name@example.com’, ‘@’);
    // *     returns 3: ‘@example.com’
    // *     example 4: strstr(‘name@example.com’, ‘@’, true);    // *     returns 4: ‘name’
    var pos = 0;

    haystack += "";
    pos = haystack.indexOf(needle); if (pos == -1) {
        return false;
    } else {
        if (bool) {
            return haystack.substr(0, pos);
        } else {
            return haystack.slice(pos);
        }
    }
}
/* formattazione di un numero */
function number_format( number, decimals, dec_point, thousands_sep ) {
  // *     example 1: number_format(1234.5678, 2, '.', '');
  // *     returns 1: 1234.57
  var n = number, c = isNaN(decimals = Math.abs(decimals)) ? 2 : decimals;
  var d = dec_point == undefined ? "," : dec_point;
  var t = thousands_sep == undefined ? "." : thousands_sep, s = n < 0 ? "-" : "";
  var i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;

  return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}

/* controllo se il campo prezzo è obbligatorio*/
function check_prezzo(){
  if($("input[name*='Prezzo1[]']").val().length > 0){
       $("#PrezzoP_1").attr("required",true);
   }else{
      $("#PrezzoP_1").attr("required",false);
   }
  if($("input[name*='Prezzo2[]']").val().length > 0){
       $("#PrezzoP_2").attr("required",true);
   }else{
      $("#PrezzoP_2").attr("required",false);
   }
  if($("input[name*='Prezzo3[]']").val().length > 0){
       $("#PrezzoP_3").attr("required",true);
   }else{
      $("#PrezzoP_3").attr("required",false);
   }
   if($("input[name*='Prezzo4[]']").val().length > 0){
       $("#PrezzoP_4").attr("required",true);
   }else{
      $("#PrezzoP_4").attr("required",false);
   }
   if($("input[name*='Prezzo5[]']").val().length > 0){
       $("#PrezzoP_5").attr("required",true);
   }else{
      $("#PrezzoP_5").attr("required",false);
   }

}
/* funzione di controllo se visibile o nascvosto il chekbox per ongi proposta */
function ctrl(){
  if($("#TipoRichiesta").val() == 'Preventivo'){
          $(".Check1").hide();
          $(".Check1bis").show();
          $(".Check2").hide();
          $(".Check2bis").show();
          $(".Check3").hide();
          $(".Check3bis").show();
          $(".Check4").hide();
          $(".Check4bis").show();
          $(".Check5").hide();
          $(".Check5bis").show();
      } else {
          $(".Check1").show();
          $(".Check1bis").hide();
          $(".Check2").show();
          $(".Check2bis").hide();
          $(".Check3").show();
          $(".Check3bis").hide();
          $(".Check4").show();
          $(".Check4bis").hide();
          $(".Check5").show();
          $(".Check5bis").hide();
      }
  }
/* calcolo del prezzo totale per la 1° proposta */
function calcola_totale1() {
    var totale='';
    var parziale='';
    if($("#SC_1").val()!='0'){
        totale = new Number($("#sconto_camere_1").val());
        $('#PrezzoP_1').val(totale);
        $('.prezzo1').each( function() {
            value = new Number($(this).val());
            parziale = new Number(parziale + value);
            $('#PrezzoL_1').val(parziale);
        });
    }else{
        $('.prezzo1').each( function() {
            value = new Number($(this).val());
            totale = new Number(totale + value);
            $('#PrezzoL_1').val(totale);
            $('#PrezzoP_1').val(totale);
        });
    }

    if($('#DataArrivo_1').val()!='' && $('#DataPartenza_1').val()!=''){
        var s_tmp     = $('#DataArrivo_1').val();
        var e_tmp     = $('#DataPartenza_1').val();
        var start_tmp = s_tmp.split('/');
        var end_tmp   = e_tmp.split('/');
        var start     = new Date(start_tmp[2],(start_tmp[1]-1),start_tmp[0],1,0,0).getTime()/1000;
        var end       = new Date(end_tmp[2],(end_tmp[1]-1),end_tmp[0],1,0,0).getTime()/1000;
        var notti    = Math.ceil(Math.abs(end - start) / 86400);

    }
    
    $('.PrezzoServizio1').each(function () {
        if ($(this).is(":checked")) {
            var valueS_tmp     = $(this).val().split('#');
            var prezzo         = valueS_tmp[0];
            var calcolo        = valueS_tmp[1];
            var id_servizio    = valueS_tmp[2];
            var numero_persone = $('#num_persone1_'+id_servizio).val();
            var numero_notti   = $('#notti1_'+id_servizio).val();
            if (calcolo == 'Una tantum') {
                valueS = new Number(prezzo);
            } else if (calcolo == 'Al giorno') {
                valueS = new Number(prezzo * notti);
            } else if (calcolo == 'A percentuale') {
                var percent = ((totale*prezzo)/100);
                valueS = new Number(percent);
            } else if (calcolo == 'A persona') {
                console.log(prezzo + ' ' + numero_persone + ' ' + numero_notti);
                valueS = new Number((prezzo * numero_notti) * numero_persone);
            }
            totale = new Number(totale + valueS);
            if($("#SC_1").val()!='0'){
                $('#PrezzoL_1').val(parziale);
            }else{
                $('#PrezzoL_1').val(totale);
            }
            $('#PrezzoP_1').val(totale);
        }
    });
}

/* calcolo del prezzo totale per la 2° proposta */
function calcola_totale2() {
    var totale2='';
    var parziale2='';
    if($("#SC_2").val()!='0'){
        totale2 = new Number($("#sconto_camere_2").val());
        $('#PrezzoP_2').val(totale2);
        $('.prezzo2').each( function() {
            value2 = new Number($(this).val());
            parziale2 = new Number(parziale2 + value2);
            $('#PrezzoL_2').val(parziale2);
        });
    }else{
        $('.prezzo2').each( function() {
            value2 = new Number($(this).val());
            totale2 = new Number(totale2 + value2);
            $('#PrezzoL_2').val(totale2);
            $('#PrezzoP_2').val(totale2);
        });
    }

    if($('#DataArrivo_2').val()!='' && $('#DataPartenza_2').val()!=''){
        var s_tmp     = $('#DataArrivo_2').val();
        var e_tmp     = $('#DataPartenza_2').val();
        var start_tmp = s_tmp.split('/');
        var end_tmp   = e_tmp.split('/');
        var start     = new Date(start_tmp[2],(start_tmp[1]-1),start_tmp[0],1,0,0).getTime()/1000;
        var end       = new Date(end_tmp[2],(end_tmp[1]-1),end_tmp[0],1,0,0).getTime()/1000;
        var notti2    = Math.ceil(Math.abs(end - start) / 86400);
    }

    $('.PrezzoServizio2').each( function() {
        if($(this).is(":checked")){
            var valueS2_tmp = $(this).val().split('#');
            var prezzo2 = valueS2_tmp[0];
            var calcolo2 = valueS2_tmp[1];
            var id_servizio2 = valueS2_tmp[2];
            var numero_persone2 = $('#num_persone2_'+id_servizio2).val();
            var numero_notti2   = $('#notti2_'+id_servizio2).val();
            if (calcolo2 == 'Una tantum') {
                valueS2 = new Number(prezzo2);
            } else if (calcolo2 == 'Al giorno') {
                valueS2 = new Number(prezzo2 * notti2);
            } else if (calcolo2 == 'A percentuale') {
                var percent2 = ((totale2*prezzo2)/100);
                valueS2 = new Number(percent2);
            } else if (calcolo2 == 'A persona') {
                console.log(prezzo2 + ' ' + numero_persone2 + ' ' + numero_notti2);
                valueS2 = new Number((prezzo2 * numero_notti2) * numero_persone2);
            }
            totale2 = new Number(totale2 + valueS2);
            if($("#SC_2").val()!='0'){
                $('#PrezzoL_2').val(parziale2);
            }else{
                $('#PrezzoL_2').val(totale2);
            }
            $('#PrezzoP_2').val(totale2);
        }
    });
}
/* calcolo del prezzo totale per la 3° proposta */
function calcola_totale3() {
    var totale3='';
    var parziale3='';
    if($("#SC_3").val()!='0'){
        totale3 = new Number($("#sconto_camere_3").val());
        $('#PrezzoP_3').val(totale3);
        $('.prezzo3').each( function() {
            value3 = new Number($(this).val());
            parziale3 = new Number(parziale3 + value3);
            $('#PrezzoL_3').val(parziale3);
        });
    }else{
        $('.prezzo3').each( function() {
            value3 = new Number($(this).val());
            totale3 = new Number(totale3 + value3);
            $('#PrezzoL_3').val(totale3);
            $('#PrezzoP_3').val(totale3);
        });
    }

    if($('#DataArrivo_3').val()!='' && $('#DataPartenza_3').val()!=''){
        var s_tmp     = $('#DataArrivo_3').val();
        var e_tmp     = $('#DataPartenza_3').val();
        var start_tmp = s_tmp.split('/');
        var end_tmp   = e_tmp.split('/');
        var start     = new Date(start_tmp[2],(start_tmp[1]-1),start_tmp[0],1,0,0).getTime()/1000;
        var end       = new Date(end_tmp[2],(end_tmp[1]-1),end_tmp[0],1,0,0).getTime()/1000;
        var notti3    = Math.ceil(Math.abs(end - start) / 86400);

    }

    $('.PrezzoServizio3').each( function() {
        if($(this).is(":checked")){
            var valueS3_tmp = $(this).val().split('#');
            var prezzo3 = valueS3_tmp[0];
            var calcolo3 = valueS3_tmp[1];
            var id_servizio3 = valueS3_tmp[2];
            var numero_persone3 = $('#num_persone3_'+id_servizio3).val();
            var numero_notti3   = $('#notti3_'+id_servizio3).val();
            if (calcolo3 == 'Una tantum') {
                valueS3 = new Number(prezzo3);
            } else if (calcolo3 == 'Al giorno') {
                valueS3 = new Number(prezzo3 * notti3);
            } else if (calcolo3 == 'A percentuale') {
                var percent3 = ((totale3*prezzo3)/100);
                valueS3 = new Number(percent3);
            } else if (calcolo3 == 'A persona') {
                console.log(prezzo3 + ' ' + numero_persone3 + ' ' + numero_notti3);
                valueS3 = new Number((prezzo3 * numero_notti3) * numero_persone3);
            }
            totale3 = new Number(totale3 + valueS3);
            if($("#SC_3").val()!='0'){
                $('#PrezzoL_3').val(parziale3);
            }else{
                $('#PrezzoL_3').val(totale3);
            }
            $('#PrezzoP_3').val(totale3);
        }
    });
}
/* calcolo del prezzo totale per la 4° proposta */
function calcola_totale4() {
    var totale4='';
    var parziale4='';
    if($("#SC_4").val()!='0'){
        totale4 = new Number($("#sconto_camere_4").val());
        $('#PrezzoP_4').val(totale4);
        $('.prezzo4').each( function() {
            value4 = new Number($(this).val());
            parziale4 = new Number(parziale4 + value4);
            $('#PrezzoL_4').val(parziale4);
        });
    }else{
        $('.prezzo4').each( function() {
            value4 = new Number($(this).val());
            totale4 = new Number(totale4 + value4);
            $('#PrezzoL_4').val(totale4);
            $('#PrezzoP_4').val(totale4);
        });
    }

    if($('#DataArrivo_4').val()!='' && $('#DataPartenza_4').val()!=''){
        var s_tmp     = $('#DataArrivo_4').val();
        var e_tmp     = $('#DataPartenza_4').val();
        var start_tmp = s_tmp.split('/');
        var end_tmp   = e_tmp.split('/');
        var start     = new Date(start_tmp[2],(start_tmp[1]-1),start_tmp[0],1,0,0).getTime()/1000;
        var end       = new Date(end_tmp[2],(end_tmp[1]-1),end_tmp[0],1,0,0).getTime()/1000;
        var notti4    = Math.ceil(Math.abs(end - start) / 86400);
    }

    $('.PrezzoServizio4').each( function() {
        if($(this).is(":checked")){
            var valueS4_tmp = $(this).val().split('#');
            var prezzo4 = valueS4_tmp[0];
            var calcolo4 = valueS4_tmp[1];
            var id_servizio4 = valueS4_tmp[2];
            var numero_persone4 = $('#num_persone4_'+id_servizio4).val();
            var numero_notti4   = $('#notti4_'+id_servizio4).val();
            if (calcolo4 == 'Una tantum') {
                valueS4 = new Number(prezzo4);
            } else if (calcolo4 == 'Al giorno') {
                valueS4 = new Number(prezzo4 * notti4);
            } else if (calcolo4 == 'A percentuale') {
                var percent4 = ((totale4*prezzo4)/100);
                valueS4 = new Number(percent4);
            } else if (calcolo4 == 'A persona') {
                console.log(prezzo4 + ' ' + numero_persone4 + ' ' + numero_notti4);
                valueS4 = new Number((prezzo4 * numero_notti4) * numero_persone4);
            }
            totale4 = new Number(totale4 + valueS4);
            if($("#SC_4").val()!='0'){
                $('#PrezzoL_4').val(parziale4);
            }else{
                $('#PrezzoL_4').val(totale4);
            }
            $('#PrezzoP_4').val(totale4);
        }
    });
}
/* calcolo del prezzo totale per la 5° proposta */
function calcola_totale5() {
    var totale5='';
    var parziale5='';
    if($("#SC_5").val()!='0'){
        totale5 = new Number($("#sconto_camere_5").val());
        $('#PrezzoP_5').val(totale5);
        $('.prezzo5').each( function() {
            value5 = new Number($(this).val());
            parziale5 = new Number(parziale5 + value5);
            $('#PrezzoL_5').val(parziale5);
        });
    }else{
        $('.prezzo5').each( function() {
            value5 = new Number($(this).val());
            totale5 = new Number(totale5 + value5);
            $('#PrezzoL_5').val(totale5);
            $('#PrezzoP_5').val(totale5);
        });
    }

    if($('#DataArrivo_5').val()!='' && $('#DataPartenza_5').val()!=''){
        var s_tmp     = $('#DataArrivo_5').val();
        var e_tmp     = $('#DataPartenza_5').val();
        var start_tmp = s_tmp.split('/');
        var end_tmp   = e_tmp.split('/');
        var start     = new Date(start_tmp[2],(start_tmp[1]-1),start_tmp[0],1,0,0).getTime()/1000;
        var end       = new Date(end_tmp[2],(end_tmp[1]-1),end_tmp[0],1,0,0).getTime()/1000;
        var notti5    = Math.ceil(Math.abs(end - start) / 86400);

    }

    $('.PrezzoServizio5').each( function() {
        if($(this).is(":checked")){
            var valueS5_tmp = $(this).val().split('#');
            var prezzo5 = valueS5_tmp[0];
            var calcolo5 = valueS5_tmp[1];
            var id_servizio5 = valueS5_tmp[2];
            var numero_persone5 = $('#num_persone5_'+id_servizio5).val();
            var numero_notti5   = $('#notti5_'+id_servizio5).val();
            if (calcolo5 == 'Una tantum') {
                valueS5 = new Number(prezzo5);
            } else if (calcolo5 == 'Al giorno') {
                valueS5 = new Number(prezzo5 * notti5);
            } else if (calcolo5 == 'A percentuale') {
                var percent5 = ((totale5*prezzo5)/100);
                valueS5 = new Number(percent5);
            } else if (calcolo5 == 'A persona') {
                console.log(prezzo5 + ' ' + numero_persone5 + ' ' + numero_notti5);
                valueS5 = new Number((prezzo5 * numero_notti5) * numero_persone5);
            }
            totale5 = new Number(totale5 + valueS5);
            if($("#SC_5").val()!='0'){
                $('#PrezzoL_5').val(parziale5);
            }else{
                $('#PrezzoL_5').val(totale5);
            }
            $('#PrezzoP_5').val(totale5);
        }
    });
}
    /* compilazione campo prezzo camera automatico da listino*/
    function get_listino(n,r){

        if($('#DataArrivo_'+n).val()!='' && $('#DataPartenza_'+n).val()!=''){
            var s_tmp     = $('#DataArrivo_'+n).val();
            var e_tmp     = $('#DataPartenza_'+n).val();
            var start_tmp = s_tmp.split('/');
            var end_tmp   = e_tmp.split('/');
            var dal       = s_tmp;
            var al        = e_tmp;
            var start     = new Date(start_tmp[2],(start_tmp[1]-1),start_tmp[0],1,0,0).getTime()/1000;
            var end       = new Date(end_tmp[2],(end_tmp[1]-1),end_tmp[0],1,0,0).getTime()/1000;
            var notti    = Math.ceil(Math.abs(end - start) / 86400);
        }
        var idsoggiorno   = $("#TipoSoggiorno_"+n+"_"+r).val();
        var numero_camera = $("#NumeroCamere_"+n+"_"+r).val();
        var numero_adulti = $("#NumeroAdulti_"+n+"_"+r).val();
        var idcamera      = $("#TipoCamere_"+n+"_"+r).val();
        var idsito        = <?=IDSITO?>;
        var n_proposta    = n;
        var n_riga        = r;
        $.ajax({
            type: "POST",
            url: "<?=BASE_URL_SITO?>ajax/<?=(check_listino_parity(IDSITO)==1?'get_listino_parity.php':'get_listino.php')?>",
            data: "notti=" + notti + "&dal=" + dal + "&al=" + al + "&n_proposta=" + n_proposta + "&n_riga=" + n_riga + "&idsoggiorno=" + idsoggiorno + "&numero_camera=" + numero_camera + "&numero_adulti=" + numero_adulti + "&idcamera=" + idcamera + "&idsito=" + idsito,
            dataType: "html",
            success: function(data){
                $("#valori").html(data);
            },
            error: function(){
                alert("Chiamata fallita, si prega di riprovare...");
            }
        });
    }

/* check se il chebox delle proposte in conferma è cliccato */
function check(c) {
    $('.controllo').prop('checked', false);
    $(c).prop('checked', true);

    $('#CheckProposta_1').removeAttr('required');
    $('#CheckProposta_2').removeAttr('required');
    $('#CheckProposta_3').removeAttr('required');
    $('#CheckProposta_4').removeAttr('required');
    $('#CheckProposta_5').removeAttr('required');

}

function eta_bimbi(id){
    /* ON CLICK in base al nunmero dei bambini selezionati si rendono visibili i campi per età */
    $(".NumeroBambini_"+id+"").each(function(){
        if($(".NumeroBambini_"+id+"").val() != ''){
            $(".EtaBambini"+id+"").css("display","block");
        }else{
            $(".EtaBambini"+id+"").css("display","none");
        }
    });
}
function eta_bimbi_sb(id){
    /* ON CLICK in base al nunmero dei bambini selezionati si rendono visibili i campi per età */
    $(".NumeroBambini_sb_"+id+"").each(function(){
        if($(".NumeroBambini_sb_"+id+"").val() != ''){
            $(".EtaBambini_sb"+id+"").css("display","block");
        }else{
            $(".EtaBambini_sb"+id+"").css("display","none");
        }
    });
}

function capitalize(s){
        //return s[0].toUpperCase() + s.slice(1);
        s.toLowerCase().replace(/\b[a-z]/g, function(letter) {
            return letter.toUpperCase();
        });
}

$( document ).ready(function() {

    /* AUTCOMPLETE per ricerca nome o cognome */
   var substringMatcher = function(strs) {
    return function findMatches(q, cb) {
        var matches, substringRegex;
        matches = [];
        substrRegex = new RegExp(q, 'i');
            $.each(strs, function(i, str) {
                if (substrRegex.test(str)) {
                    matches.push(str);
                }
            });
        cb(matches);
        };
    };
    var nomi = [<?=$lista_nomi?>];
    $('#the-basics-nomi .form-control').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        },
        {
            name: 'nomi',
            source: substringMatcher(nomi)
    });
    /* sulla selezione del campo ANagrafica si autocompila Nome e Cognome */
    $('#Anagrafica').on("focusout keyup keypress select", function() {
        var Anagrafica = $("#Anagrafica").val();
        var anagra_tmp    = Anagrafica.split(" ");
        var recapiti_tmp    = Anagrafica.split(", ");

        if(anagra_tmp[0]!= ''){
            var Nome   = anagra_tmp[0];
            $("#Nome").val(Nome);
        }
        if(anagra_tmp[1]!= ''){
            var Cognome   = anagra_tmp[1].replace(",", "");
            $("#Cognome").val(Cognome);
        }
        if(recapiti_tmp[1]!= ''){
            var Email     = recapiti_tmp[1];
            $("#Email").val(Email);
        }
        if(recapiti_tmp[2]!= ''){
            var Cellulare = recapiti_tmp[2];
            $("#Cellulare").val(Cellulare);
        }
    });
    $('#Anagrafica').on("focusout", function() {
        setTimeout(function(){
            $('#Anagrafica').val("");
        }, 3000);

    });

    /* istanza per thumb di selzione immagine template */
  jQuery("select.image-picker.show-labels").imagepicker({hide_select:  true,show_label:   true,});


    /* lettera maiuscola per il nome */
    if($('#Nome').val()!=''){
        $('#Nome').attr('style', 'text-transform:capitalize');
    }
    $('#Nome').on("focusout keyup keypress",function(){
        $('#Nome').attr('style', 'text-transform:capitalize');
    });
    /* lettera maiuscola per il cognome */
    if($('#Cognome').val()!=''){
        $('#Nome').attr('style', 'text-transform:capitalize');
    }
    $('#Cognome').on("focusout keyup keypress",function(){
        $('#Cognome').attr('style', 'text-transform:capitalize');
    });

<?if(check_configurazioni(IDSITO,'select_tipo_camere')!=''){?>
    var config = {
            '.chosen-select'           : {},
            '.chosen-select-deselect'  : { allow_single_deselect: true },
            '.chosen-select-no-single' : { disable_search_threshold: 10 },
            '.chosen-select-no-results': { no_results_text: 'Oops, nothing found!' },
            '.chosen-select-rtl'       : { rtl: true },
            '.chosen-select-width'     : { width: '95%' }
            }

            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }
<?}?>
/* switch tra importo e percentuale sull'acconto generale */
  $("#acconto_richiesta").change(function(){
      if($("#acconto_richiesta").val() == "importo"){
          $("#acconto_l").html('<input type="text" id="acconto_libero" name="acconto_libero" class="form-control" placeholder="000.00">');
          $("#acconto_richiesta").val();
      }else{
          $("#acconto_libero").css("display","none");
      }
  });
/* switch tra importo e percentuale sull'acconto 1° proposta */
  $("#AccontoPercentuale_1").change(function(){
      if($("#AccontoPercentuale_1").val() == "importo"){
          $("#acconto_l1").html('<input type="text" id="AccontoImporto_1" name="AccontoImporto1" class="form-control" placeholder="000.00">');
          $("#AccontoPercentuale_1").val();
      }else{
          $("#AccontoImporto_1").css("display","none");
      }
  });
/* switch tra importo e percentuale sull'acconto 2° proposta */
  $("#AccontoPercentuale_2").change(function(){
      if($("#AccontoPercentuale_2").val() == "importo"){
          $("#acconto_l2").html('<input type="text" id="AccontoImporto_2" name="AccontoImporto2" class="form-control" placeholder="000.00">');
          $("#AccontoPercentuale_2").val();
      }else{
          $("#AccontoImporto_2").css("display","none");
      }
  });
/* switch tra importo e percentuale sull'acconto 3° proposta */
  $("#AccontoPercentuale_3").change(function(){
      if($("#AccontoPercentuale_3").val() == "importo"){
          $("#acconto_l3").html('<input type="text" id="AccontoImporto_3" name="AccontoImporto3" class="form-control" placeholder="000.00">');
          $("#AccontoPercentuale_3").val();
      }else{
          $("#AccontoImporto_3").css("display","none");
      }
  });
/* switch tra importo e percentuale sull'acconto 4° proposta */
  $("#AccontoPercentuale_4").change(function(){
    if($("#AccontoPercentuale_4").val() == "importo"){
        $("#acconto_l4").html('<input type="text" id="AccontoImporto_4" name="AccontoImporto4" class="form-control" placeholder="000.00">');
        $("#AccontoPercentuale_4").val();
    }else{
        $("#AccontoImporto_4").css("display","none");
    }
});
/* switch tra importo e percentuale sull'acconto 5° proposta */
$("#AccontoPercentuale_5").change(function(){
    if($("#AccontoPercentuale_5").val() == "importo"){
        $("#acconto_l5").html('<input type="text" id="AccontoImporto_5" name="AccontoImporto5" class="form-control" placeholder="000.00">');
        $("#AccontoPercentuale_5").val();
    }else{
        $("#AccontoImporto_5").css("display","none");
    }
});

/* calcolo percentuale sconto 1° proposta */
/*     if(parseFloat($("#PrezzoP_1").val())<parseFloat($("#PrezzoL_1").val())){
        var sconto1 = 100-(($("#PrezzoP_1").val()*100)/$("#PrezzoL_1").val());
            sconto1 = parseFloat(sconto1).toFixed(2);
            sconto1 = parseFloat(sconto1);
        $("#sconto_P1").html('<p>Sconto del '+ sconto1 +' %</p>');
    }else{
        $("#sconto_P1").html('');
    } */

  $("#PrezzoP_1").keyup(function(){
      var prezzo_totale1 = $("#PrezzoP_1").val();
      var prezzo_listino1 = $("#PrezzoL_1").val();
      if(parseFloat(prezzo_totale1) < parseFloat(prezzo_listino1)){
          var percentuale1 =(100-(100*prezzo_totale1)/prezzo_listino1);
          percentuale1 = parseFloat(percentuale1).toFixed(2);
          percentuale1 = parseFloat(percentuale1);
          $("#sconto_P1").html('<p>Sconto del '+ percentuale1 +' %</p>');
      }else{
          $("#sconto_P1").html("");
      }
  });
/*   $("#PrezzoP_1").click(function(){
      $("#SC_1 option[value=0]").prop("selected",true);
       $("#sconto_P1").html("");
  });  */
  /* calcolo prezzo scontato 1° proposta */
  $("#SC_1").change(function(){

        var valore_sconto1 = $("#SC_1").val();
        var totale_camere1 = '';
        $('.prezzo1').each( function() {
            val_camere1 = new Number($(this).val());
            totale_camere1 = new Number(totale_camere1 + val_camere1);
            var sconto1 = totale_camere1-(totale_camere1*valore_sconto1/100);
            $("#Imponibile_1").html('<p><small><small>Sconto '+valore_sconto1 +'% pari a € '+sconto1+' applicato sul totale camere € '+totale_camere1+'</small></small></p>');
            $("#sconto_camere_1").val(sconto1);
        });
        calcola_totale1();
  });
/* calcolo percentuale sconto 2° proposta */
/*     if(parseFloat($("#PrezzoP_2").val())<parseFloat($("#PrezzoL_2").val())){
        var sconto2 = 100-(($("#PrezzoP_2").val()*100)/$("#PrezzoL_2").val());
            sconto2 = parseFloat(sconto2).toFixed(2);
            sconto2 = parseFloat(sconto2);
        $("#sconto_P2").html('<p>Sconto del '+ sconto2  +' %</p>');
    }else{
        $("#sconto_P2").html('');
    }  */

  $("#PrezzoP_2").keyup(function(){
      var prezzo_totale2 = $("#PrezzoP_2").val();
      var prezzo_listino2 = $("#PrezzoL_2").val();
      if(parseFloat(prezzo_totale2) < parseFloat(prezzo_listino2)){
          var percentuale2 =(100-(100*prezzo_totale2)/prezzo_listino2);
          percentuale2 = parseFloat(percentuale2).toFixed(2);
          percentuale2 = parseFloat(percentuale2);
          $("#sconto_P2").html('<p>Sconto del '+ percentuale2 +' %</p>');
      }else{
          $("#sconto_P2").html("");
      }
  });
/*   $("#PrezzoP_2").click(function(){
      $("#SC_2 option[value=0]").prop("selected",true);
       $("#sconto_P2").html("");
  });  */
  /* calcolo prezzo scontato 2° proposta */
  $("#SC_2").change(function(){
    var valore_sconto2 = $("#SC_2").val();
        var totale_camere2 = '';
        $('.prezzo2').each( function() {
            val_camere2 = new Number($(this).val());
            totale_camere2 = new Number(totale_camere2 + val_camere2);
            var sconto2 = totale_camere2-(totale_camere2*valore_sconto2/100);
            $("#Imponibile_2").html('<p><small><small>Sconto '+valore_sconto2 +'% pari a € '+sconto2+' applicato sul totale camere € '+totale_camere2+'</small></small></p>');
            $("#sconto_camere_2").val(sconto2);
        });
        calcola_totale2();
  });
/* calcolo percentuale sconto 3° proposta */
/*     if(parseFloat($("#PrezzoP_3").val())<parseFloat($("#PrezzoL_3").val())){
        var sconto3 = 100-(($("#PrezzoP_3").val()*100)/$("#PrezzoL_3").val());
            sconto3 = parseFloat(sconto3).toFixed(2);
            sconto3 = parseFloat(sconto3);
        $("#sconto_P3").html('<p>Sconto del '+ sconto3  +' %</p>');
    }else{
        $("#sconto_P3").html('');
    }  */

  $("#PrezzoP_3").keyup(function(){
      var prezzo_totale3 = $("#PrezzoP_3").val();
      var prezzo_listino3 = $("#PrezzoL_3").val();
      if(parseFloat(prezzo_totale3) < parseFloat(prezzo_listino3)){
          var percentuale3 =(100-(100*prezzo_totale3)/prezzo_listino3);
          percentuale3 = parseFloat(percentuale3).toFixed(2);
          percentuale3 = parseFloat(percentuale3);
          $("#sconto_P3").html('<p>Sconto del '+ percentuale3 +' %</p>');
      }else{
          $("#sconto_P3").html("");
      }
  });
/*   $("#PrezzoP_3").click(function(){
      $("#SC_3 option[value=0]").prop("selected",true);
       $("#sconto_P3").html("");
  });  */
  /* calcolo prezzo scontato 3° proposta */
  $("#SC_3").change(function(){
    var valore_sconto3 = $("#SC_3").val();
        var totale_camere3 = '';
        $('.prezzo3').each( function() {
            val_camere3 = new Number($(this).val());
            totale_camere3 = new Number(totale_camere3 + val_camere3);
            var sconto3 = totale_camere3-(totale_camere3*valore_sconto3/100);
            $("#Imponibile_3").html('<p><small><small>Sconto '+valore_sconto3 +'% pari a € '+sconto3+' applicato sul totale camere € '+totale_camere3+'</small></small></p>');
            $("#sconto_camere_3").val(sconto3);
        });
        calcola_totale3();
  });
/* calcolo percentuale sconto 4° proposta */
/*     if(parseFloat($("#PrezzoP_4").val())<parseFloat($("#PrezzoL_4").val())){
        var sconto4 = 100-(($("#PrezzoP_4").val()*100)/$("#PrezzoL_4").val());
            sconto4 = parseFloat(sconto4).toFixed(2);
            sconto4 = parseFloat(sconto4);
        $("#sconto_P4").html('<p>Sconto del '+ sconto4  +' %</p>');
    }else{
        $("#sconto_P4").html('');
    }  */

    $("#PrezzoP_4").keyup(function(){
        var prezzo_totale4 = $("#PrezzoP_4").val();
        var prezzo_listino4 = $("#PrezzoL_4").val();
        if(parseFloat(prezzo_totale4) < parseFloat(prezzo_listino4)){
            var percentuale4 =(100-(100*prezzo_totale4)/prezzo_listino4);
            percentuale4 = parseFloat(percentuale4).toFixed(2);
            percentuale4 = parseFloat(percentuale4);
            $("#sconto_P4").html('<p>Sconto del '+ percentuale4 +' %</p>');
        }else{
            $("#sconto_P4").html("");
        }
    });
/*     $("#PrezzoP_4").click(function(){
        $("#SC_4 option[value=0]").prop("selected",true);
        $("#sconto_P4").html("");
    });  */
    /* calcolo prezzo scontato 4° proposta */
    $("#SC_4").change(function(){
        var valore_sconto4 = $("#SC_4").val();
        var totale_camere4 = '';
        $('.prezzo4').each( function() {
            val_camere4 = new Number($(this).val());
            totale_camere4 = new Number(totale_camere4 + val_camere4);
            var sconto4 = totale_camere4-(totale_camere4*valore_sconto4/100);
            $("#Imponibile_4").html('<p><small><small>Sconto '+valore_sconto4 +'% pari a € '+sconto4+' applicato sul totale camere € '+totale_camere4+'</small></small></p>');
            $("#sconto_camere_4").val(sconto4);
        });
        calcola_totale4();
    });
/* calcolo percentuale sconto 5° proposta */
/*     if(parseFloat($("#PrezzoP_5").val())<parseFloat($("#PrezzoL_5").val())){
        var sconto5 = 100-(($("#PrezzoP_5").val()*100)/$("#PrezzoL_5").val());
            sconto5 = parseFloat(sconto5).toFixed(2);
            sconto5 = parseFloat(sconto5);
        $("#sconto_P5").html('<p>Sconto del '+ sconto5  +' %</p>');
    }else{
        $("#sconto_P5").html('');
    }  */

    $("#PrezzoP_5").keyup(function(){
        var prezzo_totale5 = $("#PrezzoP_5").val();
        var prezzo_listino5 = $("#PrezzoL_5").val();
        if(parseFloat(prezzo_totale5) < parseFloat(prezzo_listino5)){
            var percentuale5 =(100-(100*prezzo_totale5)/prezzo_listino5);
            percentuale5 = parseFloat(percentuale5).toFixed(2);
            percentuale5 = parseFloat(percentuale5);
            $("#sconto_P5").html('<p>Sconto del '+ percentuale5 +' %</p>');
        }else{
            $("#sconto_P5").html("");
        }
    });
/*     $("#PrezzoP_5").click(function(){
        $("#SC_5 option[value=0]").prop("selected",true);
         $("#sconto_P5").html("");
    });  */
    /* calcolo prezzo scontato 5° proposta */
    $("#SC_5").change(function(){
        var valore_sconto5 = $("#SC_5").val();
        var totale_camere5 = '';
        $('.prezzo5').each( function() {
            val_camere5 = new Number($(this).val());
            totale_camere5 = new Number(totale_camere5 + val_camere5);
            var sconto5 = totale_camere5-(totale_camere5*valore_sconto5/100);
            $("#Imponibile_5").html('<p><small><small>Sconto '+valore_sconto5 +'% pari a € '+sconto5+' applicato sul totale camere € '+totale_camere5+'</small></small></p>');
            $("#sconto_camere_5").val(sconto5);
        });
        calcola_totale5();
    });

    /* se è un PREVENTIVO */
    if($("#TipoRichiesta").val() == "Preventivo"){
              $(".Check1").hide();
              $(".Check1bis").show();
              $(".Check2").hide();
              $(".Check2bis").show();
              $(".Check3").hide();
              $(".Check3bis").show();
              $(".Check4").hide();
              $(".Check4bis").show();
              $(".Check5").hide();
              $(".Check5bis").show();
    }else{/* se è un CONFERMA */
              $(".Check1").show();
              $(".Check1bis").hide();
              $(".Check2").show();
              $(".Check2bis").hide();
              $(".Check3").show();
              $(".Check3bis").hide();
              $(".Check4").show();
              $(".Check4bis").hide();
              $(".Check5").show();
              $(".Check5bis").hide();
    }


/* in base al nunmero dei bambini selezionati si rendono visibili i campi per età */
        if($('#NumeroBambini').val() == 1){
            $('#EtaBambini1').css('display','block');
            $('#EtaBambini2').css('display','none');
            $('#EtaBambini3').css('display','none');
            $('#EtaBambini4').css('display','none');
            $('#EtaBambini5').css('display','none');
            $('#EtaBambini6').css('display','none');
        }
        if($('#NumeroBambini').val() == 2){
            $('#EtaBambini1').css('display','block');
            $('#EtaBambini2').css('display','block');
            $('#EtaBambini3').css('display','none');
            $('#EtaBambini4').css('display','none');
            $('#EtaBambini5').css('display','none');
            $('#EtaBambini6').css('display','none');
        }
        if($('#NumeroBambini').val() == 3){
            $('#EtaBambini1').css('display','block');
            $('#EtaBambini2').css('display','block');
            $('#EtaBambini3').css('display','block');
            $('#EtaBambini4').css('display','none');
            $('#EtaBambini5').css('display','none');
            $('#EtaBambini6').css('display','none');
        }
        if($('#NumeroBambini').val() == 4){
            $('#EtaBambini1').css('display','block');
            $('#EtaBambini2').css('display','block');
            $('#EtaBambini3').css('display','block');
            $('#EtaBambini4').css('display','block');
            $('#EtaBambini5').css('display','none');
            $('#EtaBambini6').css('display','none');
        }
        if($('#NumeroBambini').val() == 5){
            $('#EtaBambini1').css('display','block');
            $('#EtaBambini2').css('display','block');
            $('#EtaBambini3').css('display','block');
            $('#EtaBambini4').css('display','block');
            $('#EtaBambini5').css('display','block');
            $('#EtaBambini6').css('display','none');
        }
        if($('#NumeroBambini').val() == 6){
            $('#EtaBambini1').css('display','block');
            $('#EtaBambini2').css('display','block');
            $('#EtaBambini3').css('display','block');
            $('#EtaBambini4').css('display','block');
            $('#EtaBambini5').css('display','block');
            $('#EtaBambini6').css('display','block');
        }
        if($('#NumeroBambini').val() == ''){
            $('#EtaBambini1').css('display','none');
            $('#EtaBambini2').css('display','none');
            $('#EtaBambini3').css('display','none');
            $('#EtaBambini4').css('display','none');
            $('#EtaBambini5').css('display','none');
            $('#EtaBambini6').css('display','none');
        }
/* ON CLICK in base al nunmero dei bambini selezionati si rendono visibili i campi per età */
  $("#NumeroBambini").on("change",function(){
      if($("#NumeroBambini").val() == 1){
          $("#EtaBambini1").css("display","block");
          $("#EtaBambini2").css("display","none");
          $("#EtaBambini3").css("display","none");
          $("#EtaBambini4").css("display","none");
          $("#EtaBambini5").css("display","none");
          $("#EtaBambini6").css("display","none");
      }
      if($("#NumeroBambini").val() == 2){
          $("#EtaBambini1").css("display","block");
          $("#EtaBambini2").css("display","block");
          $("#EtaBambini3").css("display","none");
          $("#EtaBambini4").css("display","none");
          $("#EtaBambini5").css("display","none");
          $("#EtaBambini6").css("display","none");
      }
      if($("#NumeroBambini").val() == 3){
          $("#EtaBambini1").css("display","block");
          $("#EtaBambini2").css("display","block");
          $("#EtaBambini3").css("display","block");
          $("#EtaBambini4").css("display","none");
          $("#EtaBambini5").css("display","none");
          $("#EtaBambini6").css("display","none");
      }
      if($("#NumeroBambini").val() == 4){
          $("#EtaBambini1").css("display","block");
          $("#EtaBambini2").css("display","block");
          $("#EtaBambini3").css("display","block");
          $("#EtaBambini4").css("display","block");
          $("#EtaBambini5").css("display","none");
          $("#EtaBambini6").css("display","none");
      }
      if($("#NumeroBambini").val() == 5){
          $("#EtaBambini1").css("display","block");
          $("#EtaBambini2").css("display","block");
          $("#EtaBambini3").css("display","block");
          $("#EtaBambini4").css("display","block");
          $("#EtaBambini5").css("display","block");
          $("#EtaBambini6").css("display","none");
      }
      if($("#NumeroBambini").val() == 6){
          $("#EtaBambini1").css("display","block");
          $("#EtaBambini2").css("display","block");
          $("#EtaBambini3").css("display","block");
          $("#EtaBambini4").css("display","block");
          $("#EtaBambini5").css("display","block");
          $("#EtaBambini6").css("display","block");
      }
      if($("#NumeroBambini").val() == ""){
          $("#EtaBambini1").css("display","none");
          $("#EtaBambini2").css("display","none");
          $("#EtaBambini3").css("display","none");
          $("#EtaBambini4").css("display","none");
          $("#EtaBambini5").css("display","none");
          $("#EtaBambini6").css("display","none");
      }
  });
/* aggiungi riga camere per 1° proposta */

var c = 0;

  $("#add_cam").click(function(){
      setTimeout(function(){
          var config = {
          ".chosen-select"           : {},
          ".chosen-select-deselect"  : { allow_single_deselect: true },
          ".chosen-select-no-single" : { disable_search_threshold: 10 },
          ".chosen-select-no-results": { no_results_text: "Oops, nothing found!" },
          ".chosen-select-rtl"       : { rtl: true },
          ".chosen-select-width"     : { width: "95%" }
          }

              for (var selector in config) {
                  $(selector).chosen(config[selector]);
              }
          }, 500);
      $("#add_c").append('<tr id="cc' + c + '">'
                          +'<td style="width:25%"><div class="form-group"><input type="hidden" value="<?=$val['idRichiesta']?>" name="idrichiesta' + c + '[]"><label for="TipoSoggiorno">Tipo Soggiorno</label>'
                          +'<select name="TipoSoggiorno1[]" id="TipoSoggiorno_' + c + '" class="form-control">'
                          +'<option value="" selected="selected">--</option><?=$ListaSoggiorno?></select></div></td>'
                          +'<td style="width:25%"> <div class="form-group"> <label for="NumeroCamere">Nr Camere</label>'
                          +'<select name="NumeroCamere1[]" id="NumeroCamere_' + c + '" class="form-control">'
                          +'<option value="" selected>--</option> <?=$Numeri?></select></div></td>'
                          +'<td style="width:25%"> <div class="form-group"> <label for="TipoCamere">Tipo Camere</label>'
                          +'<select name="TipoCamere1[]" id="TipoCamere_' + c + '" class="<?=$stile_chosen?> form-control">'
                          +'<option value="" selected>--</option> <?=$ListaCamere?> </select> </div> </td>'
                          +'<td style="width:25%"><label for="Prezzo">Prezzo</label><div class="input-group">'
                          +'<span class="input-group-addon"><i class="fa fa-euro"></i></span>'
                          +'<input type="text" name="Prezzo1[]" id="Prezzo_' + c + '"  class="prezzo1 form-control" placeholder="000.00">'
                          +'</div></td></tr>');

  });
  /* elimina riga camere per 1° proposta */
  $("#rem_cam").click(function(){
      $('#cc' + c + '').remove();
  });
  c++;

var c2 = 1;
/* aggiungi riga camere per 2° proposta */
  $("#add_cam2").click(function(){
      setTimeout(function(){
          var config = {
          ".chosen-select"           : {},
          ".chosen-select-deselect"  : { allow_single_deselect: true },
          ".chosen-select-no-single" : { disable_search_threshold: 10 },
          ".chosen-select-no-results": { no_results_text: "Oops, nothing found!" },
          ".chosen-select-rtl"       : { rtl: true },
          ".chosen-select-width"     : { width: "95%" }
          }

              for (var selector in config) {
                  $(selector).chosen(config[selector]);
              }
          }, 500);
      $("#add_c2").append('<tr id="cc2' + c2 + '">'
                          +'<td style="width:25%"><div class="form-group"><input type="hidden" value="<?=$val['idRichiesta']?>" name="idrichiesta' + c2 + '[]"><label for="TipoSoggiorno">Tipo Soggiorno</label>'
                          +'<select name="TipoSoggiorno2[]" id="TipoSoggiorno_' + c2 + '" class="form-control">'
                          +'<option value="" selected="selected">--</option><?=$ListaSoggiorno?> </select></div></td>'
                          +'<td style="width:25%"> <div class="form-group"> <label for="NumeroCamere">Nr Camere</label>'
                          +'<select name="NumeroCamere2[]" id="NumeroCamere_' + c2 + '" class="form-control">'
                          +'<option value="" selected>--</option> <?=$Numeri?> </select></div></td>'
                          +'<td style="width:25%"> <div class="form-group"> <label for="TipoCamere">Tipo Camere</label>'
                          +'<select name="TipoCamere2[]" id="TipoCamere_' + c2 + '" class="<?=$stile_chosen?> form-control">'
                          +'<option value="" selected>--</option> <?=$ListaCamere?>  </select> </div> </td>'
                          +'<td style="width:25%"><label for="Prezzo">Prezzo</label><div class="input-group">'
                          +'<span class="input-group-addon"><i class="fa fa-euro"></i></span>'
                          +'<input type="text" name="Prezzo2[]" id="Prezzo_' + c2 + '"  class="prezzo2 form-control" placeholder="000.00">'
                          +'</div></td></tr>');
  });
  /* elimina riga camere per 2° proposta */
  $("#rem_cam2").click(function(){
      $('#cc2' + c2 + '').remove();
  });
  c2++;

var c3 = 1;
/* aggiungi riga camere per 3° proposta */
  $("#add_cam3").click(function(){
      setTimeout(function(){
          var config = {
          ".chosen-select"           : {},
          ".chosen-select-deselect"  : { allow_single_deselect: true },
          ".chosen-select-no-single" : { disable_search_threshold: 10 },
          ".chosen-select-no-results": { no_results_text: "Oops, nothing found!" },
          ".chosen-select-rtl"       : { rtl: true },
          ".chosen-select-width"     : { width: "95%" }
          }

              for (var selector in config) {
                  $(selector).chosen(config[selector]);
              }
          }, 500);
      $("#add_c3").append('<tr id="cc3' + c3 + '">'
                          +'<td style="width:25%"><div class="form-group"><input type="hidden" value="<?=$val['idRichiesta']?>" name="idrichiesta' + c3 + '[]"><label for="TipoSoggiorno">Tipo Soggiorno</label>'
                          +'<select name="TipoSoggiorno3[]" id="TipoSoggiorno_' + c3 + '" class="form-control">'
                          +'<option value="" selected="selected">--</option><?=$ListaSoggiorno?></select></div></td>'
                          +'<td style="width:25%"> <div class="form-group"> <label for="NumeroCamere">Nr Camere</label>'
                          +'<select name="NumeroCamere3[]" id="NumeroCamere_' + c3 + '" class="form-control">'
                          +'<option value="" selected>--</option> <?=$Numeri?></select></div></td>'
                          +'<td style="width:25%"> <div class="form-group"> <label for="TipoCamere">Tipo Camere</label>'
                          +'<select name="TipoCamere3[]" id="TipoCamere_' + c3 + '" class="<?=$stile_chosen?> form-control">'
                          +'<option value="" selected>--</option> <?=$ListaCamere?> </select> </div> </td>'
                          +'<td style="width:25%"><label for="Prezzo">Prezzo</label><div class="input-group">'
                          +'<span class="input-group-addon"><i class="fa fa-euro"></i></span>'
                          +'<input type="text" name="Prezzo3[]" id="Prezzo_' + c3 + '"  class="prezzo3 form-control" placeholder="000.00">'
                          +'</div></td></tr>');
  });
  /* elimina riga camere per 3° proposta */
  $("#rem_cam3").click(function(){
      $('#cc3' + c3 + '').remove();
  });
  c3++;

  var c4 = 1;
/* aggiungi riga camere per 4° proposta */
  $("#add_cam4").click(function(){
      setTimeout(function(){
          var config = {
          ".chosen-select"           : {},
          ".chosen-select-deselect"  : { allow_single_deselect: true },
          ".chosen-select-no-single" : { disable_search_threshold: 10 },
          ".chosen-select-no-results": { no_results_text: "Oops, nothing found!" },
          ".chosen-select-rtl"       : { rtl: true },
          ".chosen-select-width"     : { width: "95%" }
          }

              for (var selector in config) {
                  $(selector).chosen(config[selector]);
              }
          }, 500);
      $("#add_c4").append('<tr id="cc4' + c4 + '">'
                          +'<td style="width:25%"><div class="form-group"><input type="hidden" value="<?=$val['idRichiesta']?>" name="idrichiesta' + c4 + '[]"><label for="TipoSoggiorno">Tipo Soggiorno</label>'
                          +'<select name="TipoSoggiorno4[]" id="TipoSoggiorno_' + c4 + '" class="form-control">'
                          +'<option value="" selected="selected">--</option><?=$ListaSoggiorno?></select></div></td>'
                          +'<td style="width:25%"> <div class="form-group"> <label for="NumeroCamere">Nr Camere</label>'
                          +'<select name="NumeroCamere4[]" id="NumeroCamere_' + c4 + '" class="form-control">'
                          +'<option value="" selected>--</option> <?=$Numeri?></select></div></td>'
                          +'<td style="width:25%"> <div class="form-group"> <label for="TipoCamere">Tipo Camere</label>'
                          +'<select name="TipoCamere4[]" id="TipoCamere_' + c4 + '" class="<?=$stile_chosen?> form-control">'
                          +'<option value="" selected>--</option> <?=$ListaCamere?> </select> </div> </td>'
                          +'<td style="width:25%"><label for="Prezzo">Prezzo</label><div class="input-group">'
                          +'<span class="input-group-addon"><i class="fa fa-euro"></i></span>'
                          +'<input type="text" name="Prezzo4[]" id="Prezzo_' + c4 + '"  class="prezzo4 form-control" placeholder="000.00">'
                          +'</div></td></tr>');
  });
  /* elimina riga camere per 4° proposta */
  $("#rem_cam4").click(function(){
      $('#cc4' + c4 + '').remove();
  });
  c4++;

  var c5 = 1;
/* aggiungi riga camere per 5° proposta */
  $("#add_cam5").click(function(){
      setTimeout(function(){
          var config = {
          ".chosen-select"           : {},
          ".chosen-select-deselect"  : { allow_single_deselect: true },
          ".chosen-select-no-single" : { disable_search_threshold: 10 },
          ".chosen-select-no-results": { no_results_text: "Oops, nothing found!" },
          ".chosen-select-rtl"       : { rtl: true },
          ".chosen-select-width"     : { width: "95%" }
          }

              for (var selector in config) {
                  $(selector).chosen(config[selector]);
              }
          }, 500);
      $("#add_c5").append('<tr id="cc5' + c5 + '">'
                          +'<td style="width:25%"><div class="form-group"><input type="hidden" value="<?=$val['idRichiesta']?>" name="idrichiesta' + c5 + '[]"><label for="TipoSoggiorno">Tipo Soggiorno</label>'
                          +'<select name="TipoSoggiorno5[]" id="TipoSoggiorno_' + c5 + '" class="form-control">'
                          +'<option value="" selected="selected">--</option><?=$ListaSoggiorno?></select></div></td>'
                          +'<td style="width:25%"> <div class="form-group"> <label for="NumeroCamere">Nr Camere</label>'
                          +'<select name="NumeroCamere5[]" id="NumeroCamere_' + c5 + '" class="form-control">'
                          +'<option value="" selected>--</option> <?=$Numeri?></select></div></td>'
                          +'<td style="width:25%"> <div class="form-group"> <label for="TipoCamere">Tipo Camere</label>'
                          +'<select name="TipoCamere5[]" id="TipoCamere_' + c5 + '" class="<?=$stile_chosen?> form-control">'
                          +'<option value="" selected>--</option> <?=$ListaCamere?> </select> </div> </td>'
                          +'<td style="width:25%"><label for="Prezzo">Prezzo</label><div class="input-group">'
                          +'<span class="input-group-addon"><i class="fa fa-euro"></i></span>'
                          +'<input type="text" name="Prezzo5[]" id="Prezzo_' + c5 + '"  class="prezzo5 form-control" placeholder="000.00">'
                          +'</div></td></tr>');
  });
  /* elimina riga camere per 5° proposta */
  $("#rem_cam5").click(function(){
      $('#cc5' + c5 + '').remove();
  });
  c5++;

/* drag and drop della modale calcolatrice */
  $(".draggable").draggabilly();

    /* check sulle date arrivo e partenza per calcolo delle notti */
    if($('#DataArrivo').val()!='' && $('#DataPartenza').val()!=''){
//        var s_tmp     = $('#DataArrivo').val();
//        var e_tmp     = $('#DataPartenza').val();
//        var start_tmp = s_tmp.split('/');
//        var end_tmp   = e_tmp.split('/');
//        var start     = new Date(start_tmp[2],(start_tmp[1]-1),start_tmp[0],1,0,0).getTime()/1000;
//        var end       = new Date(end_tmp[2],(end_tmp[1]-1),end_tmp[0],1,0,0).getTime()/1000;
//        var Nnotti    = Math.ceil(Math.abs(end - start) / 86400);
        /**
         * se la data start va dal 29/10 e la data end accavalla il mese e
         * va per esempio al 01/11 assegnava un giorno in più;
         * piccolo accrocchio per sistemare il bug
         * */
//        var fixstart     = new Date(2021,(10-1),29,1,0,0).getTime()/1000;
//        var fixend       = new Date(2021,(11-1),01,1,0,0).getTime()/1000;
//        if((start >= fixstart) && (end >= fixend)){
//            var  Nnotti    = Nnotti-1;
//        }
        /**
         * se la data start va dal 27/12 e la data end accavalla il mese e
         * va per esempio al 04/01 assegnava un giorno in più;
         * piccolo accrocchio per sistemare il bug
         * */
//        var fixstart2     = new Date(2021,(12-1),27,1,0,0).getTime()/1000;
//        var fixend2       = new Date(2022,(01-1),04,1,0,0).getTime()/1000;
//        if((start >= fixstart2) && (end <= fixend2)){
//            var  Nnotti    = Nnotti+1;
//        }
//        $('#notti').html('<h3 class="text-green"><b>Numero notti: ' +Nnotti+'</b></h3>');

        let dateEnd = moment($('#DataArrivo').val(), "DD/MM/YYYY");
        let dateStart = moment($('#DataPartenza').val(), "DD/MM/YYYY");
        let dateDiff = dateStart.diff(dateEnd, 'days');
        
        $('#notti').html('<h3 class="text-green"><b>Numero notti: ' +dateDiff+'</b></h3>');
    }
  $("#DataPartenza").focusout(function(){
/*       var s_tmp     = $("#DataArrivo").val();
      var e_tmp     = $("#DataPartenza").val();
      var start_tmp = s_tmp.split("/");
      var end_tmp   = e_tmp.split("/");
      var start     = new Date(start_tmp[2],(start_tmp[1]-1),start_tmp[0],1,0,0).getTime()/1000;
      var end       = new Date(end_tmp[2],(end_tmp[1]-1),end_tmp[0],1,0,0).getTime()/1000;
      var Nnotti    = Math.ceil(Math.abs(end - start) / 86400); */
        let End = moment($('#DataArrivo').val(), "DD/MM/YYYY");
        let Start = moment($('#DataPartenza').val(), "DD/MM/YYYY");
        let Nnotti = Start.diff(End, 'days');
      if(Start >= End){
          $("#notti").html('<h3 class="text-green"><b>Numero notti: ' +Nnotti+'</b></h3>');
      }else{
          $("#notti").html('<small class="text-red">Attenzione la data di partenza è inferiore alla data di arrivo!</small>');
      }

  });
 /* in modifica preventivo e/o conferma, pre-carico le dATE SE VUOTE  */
    if($('#DataArrivo').val()!='' && $('#DataPartenza').val()!=''){

        if($('#DataArrivoB1').val()=='' && $('#DataPartenzaB1').val()==''){
            $("#DataArrivoB1").val($("#DataArrivo").val());
            $("#DataPartenzaB1").val($("#DataPartenza").val());
        }
        if($('#DataArrivoB2').val()=='' && $('#DataPartenzaB2').val()==''){
            $("#DataArrivoB2").val($("#DataArrivo").val());
            $("#DataPartenzaB2").val($("#DataPartenza").val());
        }
        if($('#DataArrivoB3').val()=='' && $('#DataPartenzaB3').val()==''){
            $("#DataArrivoB3").val($("#DataArrivo").val());
            $("#DataPartenzaB3").val($("#DataPartenza").val());
        }
        if($('#DataArrivoB4').val()=='' && $('#DataPartenzaB4').val()==''){
            $("#DataArrivoB4").val($("#DataArrivo").val());
            $("#DataPartenzaB4").val($("#DataPartenza").val());
        }
        if($('#DataArrivoB5').val()=='' && $('#DataPartenzaB5').val()==''){
            $("#DataArrivoB5").val($("#DataArrivo").val());
            $("#DataPartenzaB5").val($("#DataPartenza").val());
        }
        if($('#DataArrivo_1').val()=='' && $('#DataPartenza_1').val()==''){
            $("#DataArrivo_1").val($("#DataArrivo").val());
            $("#DataPartenza_1").val($("#DataPartenza").val());
        }
        if($('#DataArrivo_2').val()=='' && $('#DataPartenza_2').val()==''){
            $("#DataArrivo_2").val($("#DataArrivo").val());
            $("#DataPartenza_2").val($("#DataPartenza").val());
        }
        if($('#DataArrivo_3').val()=='' && $('#DataPartenza_3').val()==''){
            $("#DataArrivo_3").val($("#DataArrivo").val());
            $("#DataPartenza_3").val($("#DataPartenza").val());
        }
        if($('#DataArrivo_4').val()=='' && $('#DataPartenza_4').val()==''){
            $("#DataArrivo_4").val($("#DataArrivo").val());
            $("#DataPartenza_4").val($("#DataPartenza").val());
        }
        if($('#DataArrivo_5').val()=='' && $('#DataPartenza_5').val()==''){
            $("#DataArrivo_5").val($("#DataArrivo").val());
            $("#DataPartenza_5").val($("#DataPartenza").val());
        }
        /* ERICSOFT BOOKING*/
        if($('#DataArrivoE1').val()=='' && $('#DataPartenzaE1').val()==''){
            $("#DataArrivoE1").val($("#DataArrivo").val());
            $("#DataPartenzaE1").val($("#DataPartenza").val());
        }
        if($('#DataArrivoE2').val()=='' && $('#DataPartenzaE2').val()==''){
            $("#DataArrivoE2").val($("#DataArrivo").val());
            $("#DataPartenzaE2").val($("#DataPartenza").val());
        }
        if($('#DataArrivoE3').val()=='' && $('#DataPartenzaE3').val()==''){
            $("#DataArrivoE3").val($("#DataArrivo").val());
            $("#DataPartenzaE3").val($("#DataPartenza").val());
        }
        if($('#DataArrivoE4').val()=='' && $('#DataPartenzaE4').val()==''){
            $("#DataArrivoE4").val($("#DataArrivo").val());
            $("#DataPartenzaE4").val($("#DataPartenza").val());
        }
        if($('#DataArrivoE5').val()=='' && $('#DataPartenzaE5').val()==''){
            $("#DataArrivoE5").val($("#DataArrivo").val());
            $("#DataPartenzaE5").val($("#DataPartenza").val());
        }
        /* BEDZZLE BOOKING*/
        if($('#DataArrivoBedzzle1').val()=='' && $('#DataPartenzaBedzzle1').val()==''){
            $("#DataArrivoBedzzle1").val($("#DataArrivo").val());
            $("#DataPartenzaBedzzle1").val($("#DataPartenza").val());
        }
        if($('#DataArrivoBedzzle2').val()=='' && $('#DataPartenzaBedzzle2').val()==''){
            $("#DataArrivoBedzzle2").val($("#DataArrivo").val());
            $("#DataPartenzaBedzzle2").val($("#DataPartenza").val());
        }
        if($('#DataArrivoBedzzle3').val()=='' && $('#DataPartenzaBedzzle3').val()==''){
            $("#DataArrivoBedzzle3").val($("#DataArrivo").val());
            $("#DataPartenzaBedzzle3").val($("#DataPartenza").val());
        }
        if($('#DataArrivoBedzzle4').val()=='' && $('#DataPartenzaBedzzle4').val()==''){
            $("#DataArrivoBedzzle4").val($("#DataArrivo").val());
            $("#DataPartenzaBedzzle4").val($("#DataPartenza").val());
        }
        if($('#DataArrivoBedzzle5').val()=='' && $('#DataPartenzaBedzzle5').val()==''){
            $("#DataArrivoBedzzle5").val($("#DataArrivo").val());
            $("#DataPartenzaBedzzle5").val($("#DataPartenza").val());
        }
    }

    /* setting data */
    $.fn.datepicker.defaults.format = "dd/mm/yyyy";
        $( "#DataScadenza" ).datepicker({
              numberOfMonths: 1,
              language:"it",
              showButtonPanel: true,
              todayHighlight: true
        });

        $( "#DataNascita" ).datepicker({
            numberOfMonths: 1,
            language:"it",
            showButtonPanel: true,
            todayHighlight: true
        });

        $( "#DataArrivo" ).datepicker({
            numberOfMonths: 2,
            language:"it",
            showButtonPanel: true,
            todayHighlight: true
        });

        $("#DataArrivo").datepicker({dateFormat: "dd/mm/yy"}).change(function () {
            var $picker = $("#DataArrivo");
            var $picker2 = $("#DataPartenza");
            var date=new Date($picker.datepicker("getDate"));
            date.setDate(date.getDate()+1);
            $picker2.datepicker("setDate", date);
            /* riporto le data in tutte le  proposte */
            $("#DataArrivoB1").val($("#DataArrivo").val());
            $("#DataArrivoB2").val($("#DataArrivo").val());
            $("#DataArrivoB3").val($("#DataArrivo").val());
            $("#DataArrivoB4").val($("#DataArrivo").val());
            $("#DataArrivoB5").val($("#DataArrivo").val());

            $("#DataArrivoE1").val($("#DataArrivo").val());
            $("#DataArrivoE2").val($("#DataArrivo").val());
            $("#DataArrivoE3").val($("#DataArrivo").val());
            $("#DataArrivoE4").val($("#DataArrivo").val());
            $("#DataArrivoE5").val($("#DataArrivo").val());

            $("#DataArrivoBedzzle1").val($("#DataArrivo").val());
            $("#DataArrivoBedzzle2").val($("#DataArrivo").val());
            $("#DataArrivoBedzzle3").val($("#DataArrivo").val());
            $("#DataArrivoBedzzle4").val($("#DataArrivo").val());
            $("#DataArrivoBedzzle5").val($("#DataArrivo").val());

            $("#DataArrivo_1").val($("#DataArrivo").val());
            $("#DataPartenza_1").datepicker("setDate", date);
            $("#DataArrivo_2").val($("#DataArrivo").val());
            $("#DataPartenza_2").datepicker("setDate", date);
            $("#DataArrivo_3").val($("#DataArrivo").val());
            $("#DataPartenza_3").datepicker("setDate", date);
            $("#DataArrivo_4").val($("#DataArrivo").val());
            $("#DataPartenza_4").datepicker("setDate", date);
            $("#DataArrivo_5").val($("#DataArrivo").val());
            $("#DataPartenza_5").datepicker("setDate", date);

        });

        $( "#DataPartenza" ).datepicker({
            numberOfMonths: 2,
            language:"it",
            showButtonPanel: true,
            todayHighlight: true
        });
        /* riporto le data in tutte le  proposte */
        $("#DataPartenza").change(function () {
            $("#DataPartenzaB1").val($(this).val());
            $("#DataPartenzaB2").val($(this).val());
            $("#DataPartenzaB3").val($(this).val());
            $("#DataPartenzaB4").val($(this).val());
            $("#DataPartenzaB5").val($(this).val());
            $("#DataPartenzaE1").val($(this).val());
            $("#DataPartenzaE2").val($(this).val());
            $("#DataPartenzaE3").val($(this).val());
            $("#DataPartenzaE4").val($(this).val());
            $("#DataPartenzaE5").val($(this).val());
            $("#DataPartenzaBedzzle1").val($(this).val());
            $("#DataPartenzaBedzzle2").val($(this).val());
            $("#DataPartenzaBedzzle3").val($(this).val());
            $("#DataPartenzaBedzzle4").val($(this).val());
            $("#DataPartenzaBedzzle5").val($(this).val());
            $("#DataPartenza_1").val($(this).val());
            $("#DataPartenza_2").val($(this).val());
            $("#DataPartenza_3").val($(this).val());
            $("#DataPartenza_4").val($(this).val());
            $("#DataPartenza_5").val($(this).val());

        });
        /* data 1° proposta */
        $( "#DataArrivo_1" ).datepicker({
            numberOfMonths: 2,
            language:"it",
            showButtonPanel: true,
            todayHighlight: true
        });

        $("#DataArrivo_1").datepicker({dateFormat: "dd/mm/yy"}).change(function () {
            var $picker = $("#DataArrivo_1");
            var $picker2 = $("#DataPartenza_1");
            var date=new Date($picker.datepicker("getDate"));
            date.setDate(date.getDate()+1);
            $picker2.datepicker("setDate", date);
        });


        $( "#DataPartenza_1" ).datepicker({
            numberOfMonths: 2,
            language:"it",
            showButtonPanel: true,
            todayHighlight: true
        });
        /* data 2° proposta */
        $( "#DataArrivo_2" ).datepicker({
            numberOfMonths: 2,
            language:"it",
            showButtonPanel: true,
            todayHighlight: true
        });

        $("#DataArrivo_2").datepicker({dateFormat: "dd/mm/yy"}).change(function () {
            var $picker = $("#DataArrivo_2");
            var $picker2 = $("#DataPartenza_2");
            var date=new Date($picker.datepicker("getDate"));
            date.setDate(date.getDate()+1);
            $picker2.datepicker("setDate", date);
        });


        $( "#DataPartenza_2" ).datepicker({
            numberOfMonths: 2,
            language:"it",
            showButtonPanel: true,
            todayHighlight: true
        });
        /* data 3° proposta */
        $( "#DataArrivo_3" ).datepicker({
            numberOfMonths: 2,
            language:"it",
            showButtonPanel: true,
            todayHighlight: true
        });

        $("#DataArrivo_3").datepicker({dateFormat: "dd/mm/yy"}).change(function () {
            var $picker = $("#DataArrivo_3");
            var $picker2 = $("#DataPartenza_3");
            var date=new Date($picker.datepicker("getDate"));
            date.setDate(date.getDate()+1);
            $picker2.datepicker("setDate", date);
        });


        $( "#DataPartenza_3" ).datepicker({
            numberOfMonths: 2,
            language:"it",
            showButtonPanel: true,
            todayHighlight: true
        });
        /* data 4° proposta */
        $( "#DataArrivo_4" ).datepicker({
            numberOfMonths: 2,
            language:"it",
            showButtonPanel: true,
            todayHighlight: true
        });

        $("#DataArrivo_4").datepicker({dateFormat: "dd/mm/yy"}).change(function () {
            var $picker = $("#DataArrivo_4");
            var $picker2 = $("#DataPartenza_4");
            var date=new Date($picker.datepicker("getDate"));
            date.setDate(date.getDate()+1);
            $picker2.datepicker("setDate", date);
        });


        $( "#DataPartenza_4" ).datepicker({
            numberOfMonths: 2,
            language:"it",
            showButtonPanel: true,
            todayHighlight: true
        });
        /* data 5° proposta */
        $( "#DataArrivo_5" ).datepicker({
            numberOfMonths: 2,
            language:"it",
            showButtonPanel: true,
            todayHighlight: true
        });

        $("#DataArrivo_5").datepicker({dateFormat: "dd/mm/yy"}).change(function () {
            var $picker = $("#DataArrivo_5");
            var $picker2 = $("#DataPartenza_5");
            var date=new Date($picker.datepicker("getDate"));
            date.setDate(date.getDate()+1);
            $picker2.datepicker("setDate", date);
        });


        $( "#DataPartenza_5" ).datepicker({
            numberOfMonths: 2,
            language:"it",
            showButtonPanel: true,
            todayHighlight: true
        });

        //  $("#DataPartenza").change(function () {
        //     $("#DataPartenzaB").val($(this).val());
        //     $("#DataPartenza_1").val($(this).val());
        //     $("#DataPartenza_2").val($(this).val());
        //     $("#DataPartenza_3").val($(this).val());
        //     $("#DataPartenza_4").val($(this).val());
        //     $("#DataPartenza_5").val($(this).val());

        // });

       /**
        * CODICE AJAX
        */
        // codice per email operatore
        $('#ChiPrenota').change(function() {
            var ChiPrenota = $("#ChiPrenota").val();
            $.ajax({
                type: "POST",
                url: "<?=BASE_URL_SITO?>ajax/email_operatore.php",
                data: "ChiPrenota=" + ChiPrenota + "&idsito=" + <?=IDSITO?>,
                dataType: "html",
                success: function(msg){
   
                    $("#EmailSegretaria").html(msg);
                },
                error: function(){
                    alert("Chiamata fallita, si prega di riprovare...");
                }
            });
        });
        if($('#NumeroAdulti').val()!=''){
            $('#NumeroAdultiB1').val($('#NumeroAdulti').val());
            $('#NumeroAdultiB2').val($('#NumeroAdulti').val());
            $('#NumeroAdultiB3').val($('#NumeroAdulti').val());
            $('#NumeroAdultiB4').val($('#NumeroAdulti').val());
            $('#NumeroAdultiB5').val($('#NumeroAdulti').val());

            $('#NumeroAdultiE1').val($('#NumeroAdulti').val());
            $('#NumeroAdultiE2').val($('#NumeroAdulti').val());
            $('#NumeroAdultiE3').val($('#NumeroAdulti').val());
            $('#NumeroAdultiE4').val($('#NumeroAdulti').val());
            $('#NumeroAdultiE5').val($('#NumeroAdulti').val());

            $('#NumeroAdultiBedzzle1').val($('#NumeroAdulti').val());
            $('#NumeroAdultiBedzzle2').val($('#NumeroAdulti').val());
            $('#NumeroAdultiBedzzle3').val($('#NumeroAdulti').val());
            $('#NumeroAdultiBedzzle4').val($('#NumeroAdulti').val());
            $('#NumeroAdultiBedzzle5').val($('#NumeroAdulti').val());
        }
        if($('#NumeroBambini').val()!=''){
            $('#NumeroBambiniB1').val($('#NumeroBambini').val());
            $('#NumeroBambiniB2').val($('#NumeroBambini').val());
            $('#NumeroBambiniB3').val($('#NumeroBambini').val());
            $('#NumeroBambiniB4').val($('#NumeroBambini').val());
            $('#NumeroBambiniB5').val($('#NumeroBambini').val());

            $('#NumeroBambiniE1').val($('#NumeroBambini').val());
            $('#NumeroBambiniE2').val($('#NumeroBambini').val());
            $('#NumeroBambiniE3').val($('#NumeroBambini').val());
            $('#NumeroBambiniE4').val($('#NumeroBambini').val());
            $('#NumeroBambiniE5').val($('#NumeroBambini').val());

            $('#NumeroBambiniBedzzle1').val($('#NumeroBambini').val());
            $('#NumeroBambiniBedzzle2').val($('#NumeroBambini').val());
            $('#NumeroBambiniBedzzle3').val($('#NumeroBambini').val());
            $('#NumeroBambiniBedzzle4').val($('#NumeroBambini').val());
            $('#NumeroBambiniBedzzle5').val($('#NumeroBambini').val());
        }
        $('#NumeroAdulti').change(function() {
            $('#NumeroAdultiB1').val($(this).val());
            $('#NumeroAdultiB2').val($(this).val());
            $('#NumeroAdultiB3').val($(this).val());
            $('#NumeroAdultiB4').val($(this).val());
            $('#NumeroAdultiB5').val($(this).val());

            $('#NumeroAdultiE1').val($(this).val());
            $('#NumeroAdultiE2').val($(this).val());
            $('#NumeroAdultiE3').val($(this).val());
            $('#NumeroAdultiE4').val($(this).val());
            $('#NumeroAdultiE5').val($(this).val());

            $('#NumeroAdultiBedzzle1').val($(this).val());
            $('#NumeroAdultiBedzzle2').val($(this).val());
            $('#NumeroAdultiBedzzle3').val($(this).val());
            $('#NumeroAdultiBedzzle4').val($(this).val());
            $('#NumeroAdultiBedzzle5').val($(this).val());
        });
        $('#NumeroBambini').change(function() {
            $('#NumeroBambiniB1').val($(this).val());
            $('#NumeroBambiniB2').val($(this).val());
            $('#NumeroBambiniB3').val($(this).val());
            $('#NumeroBambiniB4').val($(this).val());
            $('#NumeroBambiniB5').val($(this).val());

            $('#NumeroBambiniE1').val($(this).val());
            $('#NumeroBambiniE2').val($(this).val());
            $('#NumeroBambiniE3').val($(this).val());
            $('#NumeroBambiniE4').val($(this).val());
            $('#NumeroBambiniE5').val($(this).val());

            $('#NumeroBambiniBedzzle1').val($(this).val());
            $('#NumeroBambiniBedzzle2').val($(this).val());
            $('#NumeroBambiniBedzzle3').val($(this).val());
            $('#NumeroBambiniBedzzle4').val($(this).val());
            $('#NumeroBambiniBedzzle5').val($(this).val());
        });

          /* controllo simplebooking 1° proposta */
          $('#SB_booking1B').click(function() {
            var start    = $("#DataArrivoB1").val();
            var end      = $("#DataPartenzaB1").val();
            var adulti   = $("#NumeroAdultiB1").val();
            var bambini  = $("#NumeroBambiniB1").val();
            var eta1     = $("#EtaB1B1").val();
            var eta2     = $("#EtaB2B1").val();
            var eta3     = $("#EtaB3B1").val();
            var eta4     = $("#EtaB4B1").val();
            var eta5     = $("#EtaB5B1").val();
            var eta6     = $("#EtaB6B1").val();
            var idsito   = <?=IDSITO?>;
            var proposta = '1';
            $("#wait1").html('<img src="<?=BASE_URL_SITO?>img/Spinner.svg" width="64" height="64"/><div class="text-green">Attendi...!</div>');
            $("#SB_booking1B").hide();
            $.ajax({
                type: "POST",
                url: "<?=BASE_URL_SITO?>ajax/check_SB_booking.php",
                data: "proposta=" + proposta + "&start=" + start + "&end=" + end + "&adulti=" + adulti + "&bambini=" + bambini + "&eta1=" + eta1 + "&eta2=" + eta2 + "&eta3=" + eta3 + "&eta4=" + eta4 + "&eta5=" + eta5 + "&eta6=" + eta6 + "&idsito=" + idsito,
                dataType: "html",
                success: function(data){

                    $("#wait1").html('');
                    $("#SB_booking1B").show();
                    $("#simple1").html(data);
                    scroll_to('simple1', 150, 500);
                },
                error: function(){
                    alert("Chiamata fallita, si prega di riprovare...");
                }
            });
        });
                  /* controllo ericsoftbooking 1° proposta */
        $('#SB_booking1E').click(function() {
            var start    = $("#DataArrivoE1").val();
            var end      = $("#DataPartenzaE1").val();
            var adulti   = $("#NumeroAdultiE1").val();
            var bambini  = $("#NumeroBambiniE1").val();
            var eta1     = $("#EtaB1E1").val();
            var eta2     = $("#EtaB2E1").val();
            var eta3     = $("#EtaB3E1").val();
            var eta4     = $("#EtaB4E1").val();
            var eta5     = $("#EtaB5E1").val();
            var eta6     = $("#EtaB6E1").val();
            var numero_camere  = $("#numero_camere1").val();
            var adulti2   = $("#NumeroAdultiE1_2").val();
            var bambini2  = $("#NumeroBambiniE1_2").val();
            var eta1_2     = $("#EtaB1E1_2").val();
            var eta2_2     = $("#EtaB2E1_2").val();
            var eta3_2     = $("#EtaB3E1_2").val();
            var eta4_2     = $("#EtaB4E1_2").val();
            var eta5_2     = $("#EtaB5E1_2").val();
            var eta6_2     = $("#EtaB6E1_2").val();
            var adulti3   = $("#NumeroAdultiE1_3").val();
            var bambini3  = $("#NumeroBambiniE1_3").val();
            var eta1_3     = $("#EtaB1E1_3").val();
            var eta2_3     = $("#EtaB2E1").val();
            var eta3_3     = $("#EtaB3E1").val();
            var eta4_3     = $("#EtaB4E1").val();
            var eta5_3     = $("#EtaB5E1").val();
            var eta6_3     = $("#EtaB6E1").val();
            var idsito   = <?=IDSITO?>;
            var proposta = '1';
            $("#wait1E").html('<img src="<?=BASE_URL_SITO?>img/Spinner.svg" width="64" height="64"/><div class="text-green">Attendi...!</div>');
            $("#SB_booking1E").hide();
            $.ajax({
                type: "POST",
                url: "<?=BASE_URL_SITO?>ajax/check_ericsoft_booking.php",
                data: "proposta=" + proposta + "&start=" + start + "&end=" + end + "&numero_camere=" + numero_camere + "&adulti=" + adulti + "&bambini=" + bambini + "&eta1=" + eta1 + "&eta2=" + eta2 + "&eta3=" + eta3 + "&eta4=" + eta4 + "&eta5=" + eta5 + "&eta6=" + eta6 + "&adulti2=" + adulti2 + "&bambini2=" + bambini2 + "&eta1_2=" + eta1_2 + "&eta2_2=" + eta2_2 + "&eta3_2=" + eta3_2 + "&eta4_2=" + eta4_2 + "&eta5_2=" + eta5_2 + "&eta6_2=" + eta6_2 + "&adulti3=" + adulti3 + "&bambini3=" + bambini3 + "&eta1_3=" + eta1_3 + "&eta2_3=" + eta2_3 + "&eta3_3=" + eta3_3 + "&eta4_3=" + eta4_3 + "&eta5_3=" + eta5_3 + "&eta6_3=" + eta6_3 + "&idsito=" + idsito,
                dataType: "html",
                success: function(data){

                    $("#wait1E").html('');
                    $("#SB_booking1E").show();
                    $("#simple1E").html(data);
                    scroll_to('simple1E', 150, 500);
                },
                error: function(){
                    alert("Chiamata fallita, si prega di riprovare...");
                }
            });
        });
        /* controllo BEDZZLE Booking 1° proposta */
        $('#SB_booking1Bedzzle').click(function() {
            var start    = $("#DataArrivoBedzzle1").val();
            var end      = $("#DataPartenzaBedzzle1").val();
            var adulti   = $("#NumeroAdultiBedzzle1").val();
            var bambini  = $("#NumeroBambiniBedzzle1").val();
            var eta1     = $("#EtaB1Bedzzle1").val();
            var eta2     = $("#EtaB2Bedzzle1").val();
            var eta3     = $("#EtaB3Bedzzle1").val();
            var eta4     = $("#EtaB4Bedzzle1").val();
            var eta5     = $("#EtaB5Bedzzle1").val();
            var eta6     = $("#EtaB6Bedzzle1").val();
            var numero_camere  = $("#numero_camere1").val();
            var adulti2   = $("#NumeroAdultiBedzzle1_2").val();
            var bambini2  = $("#NumeroBambiniBedzzle1_2").val();
            var eta1_2     = $("#EtaB1Bedzzle1_2").val();
            var eta2_2     = $("#EtaB2Bedzzle1_2").val();
            var eta3_2     = $("#EtaB3Bedzzle1_2").val();
            var eta4_2     = $("#EtaB4Bedzzle1_2").val();
            var eta5_2     = $("#EtaB5Bedzzle1_2").val();
            var eta6_2     = $("#EtaB6Bedzzle1_2").val();
            var adulti3   = $("#NumeroAdultiBedzzle1_3").val();
            var bambini3  = $("#NumeroBambiniBedzzle1_3").val();
            var eta1_3     = $("#EtaB1Bedzzle1_3").val();
            var eta2_3     = $("#EtaB2Bedzzle1").val();
            var eta3_3     = $("#EtaB3Bedzzle1").val();
            var eta4_3     = $("#EtaB4Bedzzle1").val();
            var eta5_3     = $("#EtaB5Bedzzle1").val();
            var eta6_3     = $("#EtaB6Bedzzle1").val();
            var idsito   = <?=IDSITO?>;
            var proposta = '1';
            $("#wait1Bedzzle").html('<img src="<?=BASE_URL_SITO?>img/Spinner.svg" width="64" height="64"/><div class="text-green">Attendi...!</div>');
            $("#SB_booking1Bedzzle").hide();
            $.ajax({
                type: "POST",
                url: "<?=BASE_URL_SITO?>ajax/check_bedzzle_booking.php",
                data: "proposta=" + proposta + "&start=" + start + "&end=" + end + "&numero_camere=" + numero_camere + "&adulti=" + adulti + "&bambini=" + bambini + "&eta1=" + eta1 + "&eta2=" + eta2 + "&eta3=" + eta3 + "&eta4=" + eta4 + "&eta5=" + eta5 + "&eta6=" + eta6 + "&adulti2=" + adulti2 + "&bambini2=" + bambini2 + "&eta1_2=" + eta1_2 + "&eta2_2=" + eta2_2 + "&eta3_2=" + eta3_2 + "&eta4_2=" + eta4_2 + "&eta5_2=" + eta5_2 + "&eta6_2=" + eta6_2 + "&adulti3=" + adulti3 + "&bambini3=" + bambini3 + "&eta1_3=" + eta1_3 + "&eta2_3=" + eta2_3 + "&eta3_3=" + eta3_3 + "&eta4_3=" + eta4_3 + "&eta5_3=" + eta5_3 + "&eta6_3=" + eta6_3 + "&idsito=" + idsito,
                dataType: "html",
                success: function(data){

                    $("#wait1Bedzzle").html('');
                    $("#SB_booking1Bedzzle").show();
                    $("#simple1Bedzzle").html(data);
                    scroll_to('simple1Bedzzle', 150, 500);
                },
                error: function(){
                    alert("Chiamata fallita, si prega di riprovare...");
                }
            });
        });
        /* descrizione pacchetto  1° proposta */
        $('#NomeProposta_1').change(function() {
            var pacchetto =  $('#NomeProposta_1 option:selected').data('id');
            var idsito = <?=IDSITO?>;
            $.ajax({
                type: "POST",
                url: "<?=BASE_URL_SITO?>ajax/descr_pacchetto.php",
                data: "pacchetto=" + pacchetto +"&idsito=" + idsito,
                dataType: "html",
                success: function(data){
                    $("#TestoProposta_1").text(data);
                },
                error: function(){
                    alert("Chiamata fallita, si prega di riprovare...");
                }
            });
        });

        /* descrizione tariffa  1° proposta */
        $('#EtichettaTariffa_1').change(function() {
            var tariffa =  $('#EtichettaTariffa_1 option:selected').data('id');
            var idsito = <?=IDSITO?>;
            var lingua = '<?=$Lingua?>';
            $.ajax({
                type: "POST",
                url: "<?=BASE_URL_SITO?>ajax/descr_tariffa.php",
                data: "tariffa=" + tariffa + "&idsito=" + idsito + "&lingua=" + lingua,
                dataType: "html",
                success: function(data){
                    $("#AccontoTesto_1").text(data);
                },
                error: function(){
                    alert("Chiamata fallita, si prega di riprovare...");
                }
            });
        });

        /* controllo simplebooking 2° proposta */
        $('#SB_booking2B').click(function() {
            var start    = $("#DataArrivoB2").val();
            var end      = $("#DataPartenzaB2").val();
            var adulti   = $("#NumeroAdultiB2").val();
            var bambini  = $("#NumeroBambiniB2").val();
            var eta1     = $("#EtaB1B2").val();
            var eta2     = $("#EtaB2B2").val();
            var eta3     = $("#EtaB3B2").val();
            var eta4     = $("#EtaB4B2").val();
            var eta5     = $("#EtaB5B2").val();
            var eta6     = $("#EtaB6B2").val();
            var idsito   = <?=IDSITO?>;
            var proposta = '2';
            $("#wait2").html('<img src="<?=BASE_URL_SITO?>img/Spinner.svg" width="64" height="64"/><div class="text-green">Attendi...!</div>');
            $("#SB_booking2B").hide();
            $.ajax({
                type: "POST",
                url: "<?=BASE_URL_SITO?>ajax/check_SB_booking.php",
                data: "proposta=" + proposta + "&start=" + start + "&end=" + end + "&adulti=" + adulti + "&bambini=" + bambini + "&eta1=" + eta1 + "&eta2=" + eta2 + "&eta3=" + eta3 + "&eta4=" + eta4 + "&eta5=" + eta5 + "&eta6=" + eta6 + "&idsito=" + idsito,
                dataType: "html",
                success: function(data){
                    $("#wait2").html('');
                    $("#SB_booking2B").show();
                    $("#simple2").html(data);
                    scroll_to('simple2', 150, 500);
                },
                error: function(){
                    alert("Chiamata fallita, si prega di riprovare...");
                }
            });
        });
        /* controllo ericsoftbooking 2° proposta */
        $('#SB_booking2E').click(function() {
            var start    = $("#DataArrivoE2").val();
            var end      = $("#DataPartenzaE2").val();
            var adulti   = $("#NumeroAdultiE2").val();
            var bambini  = $("#NumeroBambiniE2").val();
            var eta1     = $("#EtaB1E2").val();
            var eta2     = $("#EtaB2E2").val();
            var eta3     = $("#EtaB3E2").val();
            var eta4     = $("#EtaB4E2").val();
            var eta5     = $("#EtaB5E2").val();
            var eta6     = $("#EtaB6E2").val();
            var numero_camere  = $("#numero_camere2").val();
            var adulti2   = $("#NumeroAdultiE2_2").val();
            var bambini2  = $("#NumeroBambiniE2_2").val();
            var eta1_2     = $("#EtaB1E2_2").val();
            var eta2_2     = $("#EtaB2E2_2").val();
            var eta3_2     = $("#EtaB3E2_2").val();
            var eta4_2     = $("#EtaB4E2_2").val();
            var eta5_2     = $("#EtaB5E2_2").val();
            var eta6_2     = $("#EtaB6E2_2").val();
            var adulti3   = $("#NumeroAdultiE2_3").val();
            var bambini3  = $("#NumeroBambiniE2_3").val();
            var eta1_3     = $("#EtaB1E2_3").val();
            var eta2_3     = $("#EtaB2E2_3").val();
            var eta3_3    = $("#EtaB3E2_3").val();
            var eta4_3     = $("#EtaB4E2_3").val();
            var eta5_3     = $("#EtaB5E2_3").val();
            var eta6_3     = $("#EtaB6E2_3").val();
            var idsito   = <?=IDSITO?>;
            var proposta = '2';
            $("#wait2E").html('<img src="<?=BASE_URL_SITO?>img/Spinner.svg" width="64" height="64"/><div class="text-green">Attendi...!</div>');
            $("#SB_booking2E").hide();
            $.ajax({
                type: "POST",
                url: "<?=BASE_URL_SITO?>ajax/check_ericsoft_booking.php",
                data: "proposta=" + proposta + "&start=" + start + "&end=" + end + "&numero_camere=" + numero_camere + "&adulti=" + adulti + "&bambini=" + bambini + "&eta1=" + eta1 + "&eta2=" + eta2 + "&eta3=" + eta3 + "&eta4=" + eta4 + "&eta5=" + eta5 + "&eta6=" + eta6 + "&adulti2=" + adulti2 + "&bambini2=" + bambini2 + "&eta1_2=" + eta1_2 + "&eta2_2=" + eta2_2 + "&eta3_2=" + eta3_2 + "&eta4_2=" + eta4_2 + "&eta5_2=" + eta5_2 + "&eta6_2=" + eta6_2 + "&adulti3=" + adulti3 + "&bambini3=" + bambini3 + "&eta1_3=" + eta1_3 + "&eta2_3=" + eta2_3 + "&eta3_3=" + eta3_3 + "&eta4_3=" + eta4_3 + "&eta5_3=" + eta5_3 + "&eta6_3=" + eta6_3 + "&idsito=" + idsito,
                dataType: "html",
                success: function(data){

                    $("#wait2E").html('');
                    $("#SB_booking2E").show();
                    $("#simple2E").html(data);
                    scroll_to('simple2E', 150, 500);
                },
                error: function(){
                    alert("Chiamata fallita, si prega di riprovare...");
                }
            });
        });
        /* controllo bedzzle booking 2° proposta */
        $('#SB_booking2Bedzzle').click(function() {
            var start    = $("#DataArrivoBedzzle2").val();
            var end      = $("#DataPartenzaBedzzle2").val();
            var adulti   = $("#NumeroAdultiBedzzle2").val();
            var bambini  = $("#NumeroBambiniBedzzle2").val();
            var eta1     = $("#EtaB1Bedzzle2").val();
            var eta2     = $("#EtaB2Bedzzle2").val();
            var eta3     = $("#EtaB3Bedzzle2").val();
            var eta4     = $("#EtaB4Bedzzle2").val();
            var eta5     = $("#EtaB5Bedzzle2").val();
            var eta6     = $("#EtaB6Bedzzle2").val();
            var numero_camere  = $("#numero_camere2").val();
            var adulti2   = $("#NumeroAdultiBedzzle2_2").val();
            var bambini2  = $("#NumeroBambiniBedzzle2_2").val();
            var eta1_2     = $("#EtaB1Bedzzle2_2").val();
            var eta2_2     = $("#EtaB2Bedzzle2_2").val();
            var eta3_2     = $("#EtaB3Bedzzle2_2").val();
            var eta4_2     = $("#EtaB4Bedzzle2_2").val();
            var eta5_2     = $("#EtaB5Bedzzle2_2").val();
            var eta6_2     = $("#EtaB6Bedzzle2_2").val();
            var adulti3   = $("#NumeroAdultiBedzzle2_3").val();
            var bambini3  = $("#NumeroBambiniBedzzle2_3").val();
            var eta1_3     = $("#EtaB1Bedzzle2_3").val();
            var eta2_3     = $("#EtaB2Bedzzle2_3").val();
            var eta3_3    = $("#EtaB3Bedzzle2_3").val();
            var eta4_3     = $("#EtaB4Bedzzle2_3").val();
            var eta5_3     = $("#EtaB5Bedzzle2_3").val();
            var eta6_3     = $("#EtaB6Bedzzle2_3").val();
            var idsito   = <?=IDSITO?>;
            var proposta = '2';
            $("#wait2Bedzzle").html('<img src="<?=BASE_URL_SITO?>img/Spinner.svg" width="64" height="64"/><div class="text-green">Attendi...!</div>');
            $("#SB_booking2Bedzzle").hide();
            $.ajax({
                type: "POST",
                url: "<?=BASE_URL_SITO?>ajax/check_bedzzle_booking.php",
                data: "proposta=" + proposta + "&start=" + start + "&end=" + end + "&numero_camere=" + numero_camere + "&adulti=" + adulti + "&bambini=" + bambini + "&eta1=" + eta1 + "&eta2=" + eta2 + "&eta3=" + eta3 + "&eta4=" + eta4 + "&eta5=" + eta5 + "&eta6=" + eta6 + "&adulti2=" + adulti2 + "&bambini2=" + bambini2 + "&eta1_2=" + eta1_2 + "&eta2_2=" + eta2_2 + "&eta3_2=" + eta3_2 + "&eta4_2=" + eta4_2 + "&eta5_2=" + eta5_2 + "&eta6_2=" + eta6_2 + "&adulti3=" + adulti3 + "&bambini3=" + bambini3 + "&eta1_3=" + eta1_3 + "&eta2_3=" + eta2_3 + "&eta3_3=" + eta3_3 + "&eta4_3=" + eta4_3 + "&eta5_3=" + eta5_3 + "&eta6_3=" + eta6_3 + "&idsito=" + idsito,
                dataType: "html",
                success: function(data){

                    $("#wait2Bedzzle").html('');
                    $("#SB_booking2Bedzzle").show();
                    $("#simple2Bedzzle").html(data);
                    scroll_to('simple2Bedzzle', 150, 500);
                },
                error: function(){
                    alert("Chiamata fallita, si prega di riprovare...");
                }
            });
        });
        /* descrizione pacchetto 2° proposta */
        $('#NomeProposta_2').change(function() {
            var pacchetto = $('#NomeProposta_2 option:selected').data('id');
            var idsito = <?=IDSITO?>;
            $.ajax({
                type: "POST",
                url: "<?=BASE_URL_SITO?>ajax/descr_pacchetto.php",
                data: "pacchetto=" + pacchetto +"&idsito=" + idsito,
                dataType: "html",
                success: function(data){
                    $("#TestoProposta_2").text(data);
                },
                error: function(){
                    alert("Chiamata fallita, si prega di riprovare...");
                }
            });
        });

        /* descrizione tariffa  2° proposta */
        $('#EtichettaTariffa_2').change(function() {
            var tariffa =  $('#EtichettaTariffa_2 option:selected').data('id');
            var idsito = <?=IDSITO?>;
            var lingua = '<?=$Lingua?>';
            $.ajax({
                type: "POST",
                url: "<?=BASE_URL_SITO?>ajax/descr_tariffa.php",
                data: "tariffa=" + tariffa + "&idsito=" + idsito + "&lingua=" + lingua,
                dataType: "html",
                success: function(data){
                    $("#AccontoTesto_2").text(data);
                },
                error: function(){
                    alert("Chiamata fallita, si prega di riprovare...");
                }
            });
        });

        /* controllo simplebooking 3° proposta */
        $('#SB_booking3B').click(function() {
            var start    = $("#DataArrivoB3").val();
            var end      = $("#DataPartenzaB3").val();
            var adulti   = $("#NumeroAdultiB3").val();
            var bambini  = $("#NumeroBambiniB3").val();
            var eta1     = $("#EtaB1B3").val();
            var eta2     = $("#EtaB2B3").val();
            var eta3     = $("#EtaB3B3").val();
            var eta4     = $("#EtaB4B3").val();
            var eta5     = $("#EtaB5B3").val();
            var eta6     = $("#EtaB6B3").val();
            var idsito   = <?=IDSITO?>;
            var proposta = '3';
            $("#wait3").html('<img src="<?=BASE_URL_SITO?>img/Spinner.svg" width="64" height="64"/><div class="text-green">Attendi...!</div>');
            $("#SB_booking3B").hide();
            $.ajax({
                type: "POST",
                url: "<?=BASE_URL_SITO?>ajax/check_SB_booking.php",
                data: "proposta=" + proposta + "&start=" + start + "&end=" + end + "&adulti=" + adulti + "&bambini=" + bambini + "&eta1=" + eta1 + "&eta2=" + eta2 + "&eta3=" + eta3 + "&eta4=" + eta4 + "&eta5=" + eta5 + "&eta6=" + eta6 + "&idsito=" + idsito,
                dataType: "html",
                success: function(data){
                    $("#wait3").html('');
                    $("#SB_booking3B").show();
                    $("#simple3").html(data);
                    scroll_to('simple3', 150, 500);
                },
                error: function(){
                    alert("Chiamata fallita, si prega di riprovare...");
                }
            });
        });
        /* controllo ericsoftbooking 3° proposta */
        $('#SB_booking3E').click(function() {
            var start    = $("#DataArrivoE3").val();
            var end      = $("#DataPartenzaE3").val();
            var adulti   = $("#NumeroAdultiE3").val();
            var bambini  = $("#NumeroBambiniE3").val();
            var eta1     = $("#EtaB1E3").val();
            var eta2     = $("#EtaB2E3").val();
            var eta3     = $("#EtaB3E3").val();
            var eta4     = $("#EtaB4E3").val();
            var eta5     = $("#EtaB5E3").val();
            var eta6     = $("#EtaB6E3").val();
            var numero_camere  = $("#numero_camere3").val();
            var adulti2   = $("#NumeroAdultiE3_2").val();
            var bambini2  = $("#NumeroBambiniE3_2").val();
            var eta1_2     = $("#EtaB1E3_2").val();
            var eta2_2     = $("#EtaB2E3_2").val();
            var eta3_2     = $("#EtaB3E3_2").val();
            var eta4_2     = $("#EtaB4E3_2").val();
            var eta5_2     = $("#EtaB5E3_2").val();
            var eta6_2     = $("#EtaB6E3_2").val();
            var adulti3   = $("#NumeroAdultiE3_3").val();
            var bambini3  = $("#NumeroBambiniE3_3").val();
            var eta1_3     = $("#EtaB1E3_3").val();
            var eta2_3     = $("#EtaB2E3_3").val();
            var eta3_3     = $("#EtaB3E3_3").val();
            var eta4_3     = $("#EtaB4E3_3").val();
            var eta5_3     = $("#EtaB5E3_3").val();
            var eta6_3     = $("#EtaB6E3_3").val();
            var idsito   = <?=IDSITO?>;
            var proposta = '3';
            $("#wait3E").html('<img src="<?=BASE_URL_SITO?>img/Spinner.svg" width="64" height="64"/><div class="text-green">Attendi...!</div>');
            $("#SB_booking3E").hide();
            $.ajax({
                type: "POST",
                url: "<?=BASE_URL_SITO?>ajax/check_ericsoft_booking.php",
                data: "proposta=" + proposta + "&start=" + start + "&end=" + end + "&numero_camere=" + numero_camere + "&adulti=" + adulti + "&bambini=" + bambini + "&eta1=" + eta1 + "&eta2=" + eta2 + "&eta3=" + eta3 + "&eta4=" + eta4 + "&eta5=" + eta5 + "&eta6=" + eta6 + "&adulti2=" + adulti2 + "&bambini2=" + bambini2 + "&eta1_2=" + eta1_2 + "&eta2_2=" + eta2_2 + "&eta3_2=" + eta3_2 + "&eta4_2=" + eta4_2 + "&eta5_2=" + eta5_2 + "&eta6_2=" + eta6_2 + "&adulti3=" + adulti3 + "&bambini3=" + bambini3 + "&eta1_3=" + eta1_3 + "&eta2_3=" + eta2_3 + "&eta3_3=" + eta3_3 + "&eta4_3=" + eta4_3 + "&eta5_3=" + eta5_3 + "&eta6_3=" + eta6_3 + "&idsito=" + idsito,
                dataType: "html",
                success: function(data){

                    $("#wait3E").html('');
                    $("#SB_booking3E").show();
                    $("#simple3E").html(data);
                    scroll_to('simple3E', 150, 500);
                },
                error: function(){
                    alert("Chiamata fallita, si prega di riprovare...");
                }
            });
        });
       /* controllo bedzzle booking 3° proposta */
       $('#SB_booking3Bedzzle').click(function() {
            var start    = $("#DataArrivoBedzzle3").val();
            var end      = $("#DataPartenzaBedzzle3").val();
            var adulti   = $("#NumeroAdultiBedzzle3").val();
            var bambini  = $("#NumeroBambiniBedzzle3").val();
            var eta1     = $("#EtaB1Bedzzle3").val();
            var eta2     = $("#EtaB2Bedzzle3").val();
            var eta3     = $("#EtaB3Bedzzle3").val();
            var eta4     = $("#EtaB4Bedzzle3").val();
            var eta5     = $("#EtaB5Bedzzle3").val();
            var eta6     = $("#EtaB6Bedzzle3").val();
            var numero_camere  = $("#numero_camere3").val();
            var adulti2   = $("#NumeroAdultiBedzzle3_2").val();
            var bambini2  = $("#NumeroBambiniBedzzle3_2").val();
            var eta1_2     = $("#EtaB1Bedzzle3_2").val();
            var eta2_2     = $("#EtaB2Bedzzle3_2").val();
            var eta3_2     = $("#EtaB3Bedzzle3_2").val();
            var eta4_2     = $("#EtaB4Bedzzle3_2").val();
            var eta5_2     = $("#EtaB5Bedzzle3_2").val();
            var eta6_2     = $("#EtaB6Bedzzle3_2").val();
            var adulti3   = $("#NumeroAdultiBedzzle3_3").val();
            var bambini3  = $("#NumeroBambiniBedzzle3_3").val();
            var eta1_3     = $("#EtaB1Bedzzle3_3").val();
            var eta2_3     = $("#EtaB2Bedzzle3_3").val();
            var eta3_3     = $("#EtaB3Bedzzle3_3").val();
            var eta4_3     = $("#EtaB4Bedzzle3_3").val();
            var eta5_3     = $("#EtaB5Bedzzle3_3").val();
            var eta6_3     = $("#EtaB6Bedzzle3_3").val();
            var idsito   = <?=IDSITO?>;
            var proposta = '3';
            $("#wait3Bedzzle").html('<img src="<?=BASE_URL_SITO?>img/Spinner.svg" width="64" height="64"/><div class="text-green">Attendi...!</div>');
            $("#SB_booking3Bedzzle").hide();
            $.ajax({
                type: "POST",
                url: "<?=BASE_URL_SITO?>ajax/check_bedzzle_booking.php",
                data: "proposta=" + proposta + "&start=" + start + "&end=" + end + "&numero_camere=" + numero_camere + "&adulti=" + adulti + "&bambini=" + bambini + "&eta1=" + eta1 + "&eta2=" + eta2 + "&eta3=" + eta3 + "&eta4=" + eta4 + "&eta5=" + eta5 + "&eta6=" + eta6 + "&adulti2=" + adulti2 + "&bambini2=" + bambini2 + "&eta1_2=" + eta1_2 + "&eta2_2=" + eta2_2 + "&eta3_2=" + eta3_2 + "&eta4_2=" + eta4_2 + "&eta5_2=" + eta5_2 + "&eta6_2=" + eta6_2 + "&adulti3=" + adulti3 + "&bambini3=" + bambini3 + "&eta1_3=" + eta1_3 + "&eta2_3=" + eta2_3 + "&eta3_3=" + eta3_3 + "&eta4_3=" + eta4_3 + "&eta5_3=" + eta5_3 + "&eta6_3=" + eta6_3 + "&idsito=" + idsito,
                dataType: "html",
                success: function(data){

                    $("#wait3Bedzzle").html('');
                    $("#SB_booking3Bedzzle").show();
                    $("#simple3Bedzzle").html(data);
                    scroll_to('simple3Bedzzle', 150, 500);
                },
                error: function(){
                    alert("Chiamata fallita, si prega di riprovare...");
                }
            });
        });
        /* descrizione pacchetto 3° proposta */
        $('#NomeProposta_3').change(function() {
            var pacchetto = $('#NomeProposta_3 option:selected').data('id');
            var idsito = <?=IDSITO?>;
            $.ajax({
                type: "POST",
                url: "<?=BASE_URL_SITO?>ajax/descr_pacchetto.php",
                data: "pacchetto=" + pacchetto +"&idsito=" + idsito,
                dataType: "html",
                success: function(data){
                    $("#TestoProposta_3").text(data);
                },
                error: function(){
                    alert("Chiamata fallita, si prega di riprovare...");
                }
            });
        });
        /* descrizione tariffa 3° proposta */
        $('#EtichettaTariffa_3').change(function() {
            var tariffa =  $('#EtichettaTariffa_3 option:selected').data('id');
            var idsito = <?=IDSITO?>;
            var lingua = '<?=$Lingua?>';
            $.ajax({
                type: "POST",
                url: "<?=BASE_URL_SITO?>ajax/descr_tariffa.php",
                data: "tariffa=" + tariffa + "&idsito=" + idsito + "&lingua=" + lingua,
                dataType: "html",
                success: function(data){
                    $("#AccontoTesto_3").text(data);
                },
                error: function(){
                    alert("Chiamata fallita, si prega di riprovare...");
                }
            });
        });

        /* controllo simplebooking 4° proposta */
        $('#SB_booking4B').click(function() {
            var start    = $("#DataArrivoB4").val();
            var end      = $("#DataPartenzaB4").val();
            var adulti   = $("#NumeroAdultiB4").val();
            var bambini  = $("#NumeroBambiniB4").val();
            var eta1     = $("#EtaB1B4").val();
            var eta2     = $("#EtaB2B4").val();
            var eta3     = $("#EtaB3B4").val();
            var eta4     = $("#EtaB4B4").val();
            var eta5     = $("#EtaB5B4").val();
            var eta6     = $("#EtaB6B4").val();
            var idsito   = <?=IDSITO?>;
            var proposta = '4';
            $("#wait4").html('<img src="<?=BASE_URL_SITO?>img/Spinner.svg" width="64" height="64"/><div class="text-green">Attendi...!</div>');
            $("#SB_booking4B").hide();
            $.ajax({
                type: "POST",
                url: "<?=BASE_URL_SITO?>ajax/check_SB_booking.php",
                data: "proposta=" + proposta + "&start=" + start + "&end=" + end + "&adulti=" + adulti + "&bambini=" + bambini + "&eta1=" + eta1 + "&eta2=" + eta2 + "&eta3=" + eta3 + "&eta4=" + eta4 + "&eta5=" + eta5 + "&eta6=" + eta6 + "&idsito=" + idsito,
                dataType: "html",
                success: function(data){
                    $("#wait4").html('');
                    $("#SB_booking4B").show();
                    $("#simple4").html(data);
                    scroll_to('simple4', 150, 500);
                },
                error: function(){
                    alert("Chiamata fallita, si prega di riprovare...");
                }
            });
        });
        /* controllo ericsoftbooking 4° proposta */
        $('#SB_booking4E').click(function() {
            var start    = $("#DataArrivoE4").val();
            var end      = $("#DataPartenzaE4").val();
            var adulti   = $("#NumeroAdultiE4").val();
            var bambini  = $("#NumeroBambiniE4").val();
            var eta1     = $("#EtaB1E4").val();
            var eta2     = $("#EtaB2E4").val();
            var eta3     = $("#EtaB3E4").val();
            var eta4     = $("#EtaB4E4").val();
            var eta5     = $("#EtaB5E4").val();
            var eta6     = $("#EtaB6E4").val();
            var numero_camere  = $("#numero_camere4").val();
            var adulti2   = $("#NumeroAdultiE4_2").val();
            var bambini2  = $("#NumeroBambiniE4_2").val();
            var eta1_2     = $("#EtaB1E4_2").val();
            var eta2_2     = $("#EtaB2E4_2").val();
            var eta3_2     = $("#EtaB3E4_2").val();
            var eta4_2     = $("#EtaB4E4_2").val();
            var eta5_2     = $("#EtaB5E4_2").val();
            var eta6_2     = $("#EtaB6E4_2").val();
            var adulti3   = $("#NumeroAdultiE4_3").val();
            var bambini3  = $("#NumeroBambiniE4_3").val();
            var eta1_3     = $("#EtaB1E4_3").val();
            var eta2_3     = $("#EtaB2E4_3").val();
            var eta3_3     = $("#EtaB3E4_3").val();
            var eta4_3     = $("#EtaB4E4_3").val();
            var eta5_3     = $("#EtaB5E4_3").val();
            var eta6_3     = $("#EtaB6E4_3").val();
            var idsito   = <?=IDSITO?>;
            var proposta = '4';
            $("#wait4E").html('<img src="<?=BASE_URL_SITO?>img/Spinner.svg" width="64" height="64"/><div class="text-green">Attendi...!</div>');
            $("#SB_booking4E").hide();
            $.ajax({
                type: "POST",
                url: "<?=BASE_URL_SITO?>ajax/check_ericsoft_booking.php",
                data: "proposta=" + proposta + "&start=" + start + "&end=" + end + "&numero_camere=" + numero_camere + "&adulti=" + adulti + "&bambini=" + bambini + "&eta1=" + eta1 + "&eta2=" + eta2 + "&eta3=" + eta3 + "&eta4=" + eta4 + "&eta5=" + eta5 + "&eta6=" + eta6 + "&adulti2=" + adulti2 + "&bambini2=" + bambini2 + "&eta1_2=" + eta1_2 + "&eta2_2=" + eta2_2 + "&eta3_2=" + eta3_2 + "&eta4_2=" + eta4_2 + "&eta5_2=" + eta5_2 + "&eta6_2=" + eta6_2 + "&adulti3=" + adulti3 + "&bambini3=" + bambini3 + "&eta1_3=" + eta1_3 + "&eta2_3=" + eta2_3 + "&eta3_3=" + eta3_3 + "&eta4_3=" + eta4_3 + "&eta5_3=" + eta5_3 + "&eta6_3=" + eta6_3 + "&idsito=" + idsito,
                dataType: "html",
                success: function(data){

                    $("#wait4E").html('');
                    $("#SB_booking4E").show();
                    $("#simple4E").html(data);
                    scroll_to('simple4E', 150, 500);
                },
                error: function(){
                    alert("Chiamata fallita, si prega di riprovare...");
                }
            });
        });
        /* controllo bedzzle booking 4° proposta */
        $('#SB_booking4Bedzzle').click(function() {
            var start    = $("#DataArrivoBedzzle4").val();
            var end      = $("#DataPartenzaBedzzle4").val();
            var adulti   = $("#NumeroAdultiBedzzle4").val();
            var bambini  = $("#NumeroBambiniBedzzle4").val();
            var eta1     = $("#EtaB1Bedzzle4").val();
            var eta2     = $("#EtaB2Bedzzle4").val();
            var eta3     = $("#EtaB3Bedzzle4").val();
            var eta4     = $("#EtaB4Bedzzle4").val();
            var eta5     = $("#EtaB5Bedzzle4").val();
            var eta6     = $("#EtaB6Bedzzle4").val();
            var numero_camere  = $("#numero_camere4").val();
            var adulti2   = $("#NumeroAdultiBedzzle4_2").val();
            var bambini2  = $("#NumeroBambiniBedzzle4_2").val();
            var eta1_2     = $("#EtaB1Bedzzle4_2").val();
            var eta2_2     = $("#EtaB2Bedzzle4_2").val();
            var eta3_2     = $("#EtaB3Bedzzle4_2").val();
            var eta4_2     = $("#EtaB4Bedzzle4_2").val();
            var eta5_2     = $("#EtaB5Bedzzle4_2").val();
            var eta6_2     = $("#EtaB6Bedzzle4_2").val();
            var adulti3   = $("#NumeroAdultiBedzzle4_3").val();
            var bambini3  = $("#NumeroBambiniBedzzle4_3").val();
            var eta1_3     = $("#EtaB1Bedzzle4_3").val();
            var eta2_3     = $("#EtaB2Bedzzle4_3").val();
            var eta3_3     = $("#EtaB3Bedzzle4_3").val();
            var eta4_3     = $("#EtaB4Bedzzle4_3").val();
            var eta5_3     = $("#EtaB5Bedzzle4_3").val();
            var eta6_3     = $("#EtaB6Bedzzle4_3").val();
            var idsito   = <?=IDSITO?>;
            var proposta = '4';
            $("#wait4Bedzzle").html('<img src="<?=BASE_URL_SITO?>img/Spinner.svg" width="64" height="64"/><div class="text-green">Attendi...!</div>');
            $("#SB_booking4Bedzzle").hide();
            $.ajax({
                type: "POST",
                url: "<?=BASE_URL_SITO?>ajax/check_bedzzle_booking.php",
                data: "proposta=" + proposta + "&start=" + start + "&end=" + end + "&numero_camere=" + numero_camere + "&adulti=" + adulti + "&bambini=" + bambini + "&eta1=" + eta1 + "&eta2=" + eta2 + "&eta3=" + eta3 + "&eta4=" + eta4 + "&eta5=" + eta5 + "&eta6=" + eta6 + "&adulti2=" + adulti2 + "&bambini2=" + bambini2 + "&eta1_2=" + eta1_2 + "&eta2_2=" + eta2_2 + "&eta3_2=" + eta3_2 + "&eta4_2=" + eta4_2 + "&eta5_2=" + eta5_2 + "&eta6_2=" + eta6_2 + "&adulti3=" + adulti3 + "&bambini3=" + bambini3 + "&eta1_3=" + eta1_3 + "&eta2_3=" + eta2_3 + "&eta3_3=" + eta3_3 + "&eta4_3=" + eta4_3 + "&eta5_3=" + eta5_3 + "&eta6_3=" + eta6_3 + "&idsito=" + idsito,
                dataType: "html",
                success: function(data){

                    $("#wait4Bedzzle").html('');
                    $("#SB_booking4Bedzzle").show();
                    $("#simple4Bedzzle").html(data);
                    scroll_to('simple4Bedzzle', 150, 500);
                },
                error: function(){
                    alert("Chiamata fallita, si prega di riprovare...");
                }
            });
        });
        /* descrizione pacchetto 4° proposta */
        $('#NomeProposta_4').change(function() {
            var pacchetto = $('#NomeProposta_4 option:selected').data('id');
            var idsito = <?=IDSITO?>;
            $.ajax({
                type: "POST",
                url: "<?=BASE_URL_SITO?>ajax/descr_pacchetto.php",
                data: "pacchetto=" + pacchetto +"&idsito=" + idsito,
                dataType: "html",
                success: function(data){
                    $("#TestoProposta_4").text(data);
                },
                error: function(){
                    alert("Chiamata fallita, si prega di riprovare...");
                }
            });
        });
        /* descrizione tariffa 4° proposta */
        $('#EtichettaTariffa_4').change(function() {
            var tariffa =  $('#EtichettaTariffa_4 option:selected').data('id');
            var idsito = <?=IDSITO?>;
            var lingua = '<?=$Lingua?>';
            $.ajax({
                type: "POST",
                url: "<?=BASE_URL_SITO?>ajax/descr_tariffa.php",
                data: "tariffa=" + tariffa + "&idsito=" + idsito + "&lingua=" + lingua,
                dataType: "html",
                success: function(data){
                    $("#AccontoTesto_4").text(data);
                },
                error: function(){
                    alert("Chiamata fallita, si prega di riprovare...");
                }
            });
        });

        /* controllo simplebooking 5° proposta */
        $('#SB_booking5B').click(function() {
            var start    = $("#DataArrivoB5").val();
            var end      = $("#DataPartenzaB5").val();
            var adulti   = $("#NumeroAdultiB5").val();
            var bambini  = $("#NumeroBambiniB5").val();
            var eta1     = $("#EtaB1B5").val();
            var eta2     = $("#EtaB2B5").val();
            var eta3     = $("#EtaB3B5").val();
            var eta4     = $("#EtaB4B5").val();
            var eta5     = $("#EtaB5B5").val();
            var eta6     = $("#EtaB6B5").val();
            var idsito   = <?=IDSITO?>;
            var proposta = '5';
            $("#wait5").html('<img src="<?=BASE_URL_SITO?>img/Spinner.svg" width="64" height="64"/><div class="text-green">Attendi...!</div>');
            $("#SB_booking5B").hide();
            $.ajax({
                type: "POST",
                url: "<?=BASE_URL_SITO?>ajax/check_SB_booking.php",
                data: "proposta=" + proposta + "&start=" + start + "&end=" + end + "&adulti=" + adulti + "&bambini=" + bambini + "&eta1=" + eta1 + "&eta2=" + eta2 + "&eta3=" + eta3 + "&eta4=" + eta4 + "&eta5=" + eta5 + "&eta6=" + eta6 + "&idsito=" + idsito,
                dataType: "html",
                success: function(data){
                    $("#wait5").html('');
                    $("#SB_booking5B").show();
                    $("#simple5").html(data);
                    scroll_to('simple5', 150, 500);
                },
                error: function(){
                    alert("Chiamata fallita, si prega di riprovare...");
                }
            });
        });
        /* controllo ericsoftbooking 5° proposta */
        $('#SB_booking5E').click(function() {
            var start    = $("#DataArrivoE5").val();
            var end      = $("#DataPartenzaE5").val();
            var adulti   = $("#NumeroAdultiE5").val();
            var bambini  = $("#NumeroBambiniE5").val();
            var eta1     = $("#EtaB1E5").val();
            var eta2     = $("#EtaB2E5").val();
            var eta3     = $("#EtaB3E5").val();
            var eta4     = $("#EtaB4E5").val();
            var eta5     = $("#EtaB5E5").val();
            var eta6     = $("#EtaB6E5").val();
            var numero_camere  = $("#numero_camere5").val();
            var adulti2   = $("#NumeroAdultiE5_2").val();
            var bambini2  = $("#NumeroBambiniE5_2").val();
            var eta1_2     = $("#EtaB1E5_2").val();
            var eta2_2     = $("#EtaB2E5_2").val();
            var eta3_2     = $("#EtaB3E5_2").val();
            var eta4_2     = $("#EtaB4E5_2").val();
            var eta5_2     = $("#EtaB5E5_2").val();
            var eta6_2     = $("#EtaB6E5_2").val();
            var adulti3   = $("#NumeroAdultiE5_3").val();
            var bambini3  = $("#NumeroBambiniE5_3").val();
            var eta1_3     = $("#EtaB1E5_3").val();
            var eta2_3     = $("#EtaB2E5_3").val();
            var eta3_3     = $("#EtaB3E5_3").val();
            var eta4_3     = $("#EtaB4E5_3").val();
            var eta5_3     = $("#EtaB5E5_3").val();
            var eta6_3     = $("#EtaB6E5_3").val();
            var idsito   = <?=IDSITO?>;
            var proposta = '5';
            $("#wait5E").html('<img src="<?=BASE_URL_SITO?>img/Spinner.svg" width="64" height="64"/><div class="text-green">Attendi...!</div>');
            $("#SB_booking5E").hide();
            $.ajax({
                type: "POST",
                url: "<?=BASE_URL_SITO?>ajax/check_ericsoft_booking.php",
                data: "proposta=" + proposta + "&start=" + start + "&end=" + end + "&numero_camere=" + numero_camere + "&adulti=" + adulti + "&bambini=" + bambini + "&eta1=" + eta1 + "&eta2=" + eta2 + "&eta3=" + eta3 + "&eta4=" + eta4 + "&eta5=" + eta5 + "&eta6=" + eta6 + "&adulti2=" + adulti2 + "&bambini2=" + bambini2 + "&eta1_2=" + eta1_2 + "&eta2_2=" + eta2_2 + "&eta3_2=" + eta3_2 + "&eta4_2=" + eta4_2 + "&eta5_2=" + eta5_2 + "&eta6_2=" + eta6_2 + "&adulti3=" + adulti3 + "&bambini3=" + bambini3 + "&eta1_3=" + eta1_3 + "&eta2_3=" + eta2_3 + "&eta3_3=" + eta3_3 + "&eta4_3=" + eta4_3 + "&eta5_3=" + eta5_3 + "&eta6_3=" + eta6_3 + "&idsito=" + idsito,
                dataType: "html",
                success: function(data){

                    $("#wait5E").html('');
                    $("#SB_booking5E").show();
                    $("#simple5E").html(data);
                    scroll_to('simple5E', 150, 500);
                },
                error: function(){
                    alert("Chiamata fallita, si prega di riprovare...");
                }
            });
        });
        /* controllo bedzzle booking 5° proposta */
        $('#SB_booking5Bedzzle').click(function() {
            var start    = $("#DataArrivoBedzzle5").val();
            var end      = $("#DataPartenzaBedzzle5").val();
            var adulti   = $("#NumeroAdultiBedzzle5").val();
            var bambini  = $("#NumeroBambiniBedzzle5").val();
            var eta1     = $("#EtaB1Bedzzle5").val();
            var eta2     = $("#EtaB2Bedzzle5").val();
            var eta3     = $("#EtaB3Bedzzle5").val();
            var eta4     = $("#EtaB4Bedzzle5").val();
            var eta5     = $("#EtaB5Bedzzle5").val();
            var eta6     = $("#EtaB6Bedzzle5").val();
            var numero_camere  = $("#numero_camere5").val();
            var adulti2   = $("#NumeroAdultiBedzzle5_2").val();
            var bambini2  = $("#NumeroBambiniBedzzle5_2").val();
            var eta1_2     = $("#EtaB1Bedzzle5_2").val();
            var eta2_2     = $("#EtaB2Bedzzle5_2").val();
            var eta3_2     = $("#EtaB3Bedzzle5_2").val();
            var eta4_2     = $("#EtaB4Bedzzle5_2").val();
            var eta5_2     = $("#EtaB5Bedzzle5_2").val();
            var eta6_2     = $("#EtaB6Bedzzle5_2").val();
            var adulti3   = $("#NumeroAdultiBedzzle5_3").val();
            var bambini3  = $("#NumeroBambiniBedzzle5_3").val();
            var eta1_3     = $("#EtaB1Bedzzle5_3").val();
            var eta2_3     = $("#EtaB2Bedzzle5_3").val();
            var eta3_3     = $("#EtaB3Bedzzle5_3").val();
            var eta4_3     = $("#EtaB4Bedzzle5_3").val();
            var eta5_3     = $("#EtaB5Bedzzle5_3").val();
            var eta6_3     = $("#EtaB6Bedzzle5_3").val();
            var idsito   = <?=IDSITO?>;
            var proposta = '5';
            $("#wait5Bedzzle").html('<img src="<?=BASE_URL_SITO?>img/Spinner.svg" width="64" height="64"/><div class="text-green">Attendi...!</div>');
            $("#SB_booking5Bedzzle").hide();
            $.ajax({
                type: "POST",
                url: "<?=BASE_URL_SITO?>ajax/check_bedzzle_booking.php",
                data: "proposta=" + proposta + "&start=" + start + "&end=" + end + "&numero_camere=" + numero_camere + "&adulti=" + adulti + "&bambini=" + bambini + "&eta1=" + eta1 + "&eta2=" + eta2 + "&eta3=" + eta3 + "&eta4=" + eta4 + "&eta5=" + eta5 + "&eta6=" + eta6 + "&adulti2=" + adulti2 + "&bambini2=" + bambini2 + "&eta1_2=" + eta1_2 + "&eta2_2=" + eta2_2 + "&eta3_2=" + eta3_2 + "&eta4_2=" + eta4_2 + "&eta5_2=" + eta5_2 + "&eta6_2=" + eta6_2 + "&adulti3=" + adulti3 + "&bambini3=" + bambini3 + "&eta1_3=" + eta1_3 + "&eta2_3=" + eta2_3 + "&eta3_3=" + eta3_3 + "&eta4_3=" + eta4_3 + "&eta5_3=" + eta5_3 + "&eta6_3=" + eta6_3 + "&idsito=" + idsito,
                dataType: "html",
                success: function(data){

                    $("#wait5Bedzzle").html('');
                    $("#SB_booking5Bedzzle").show();
                    $("#simple5Bedzzle").html(data);
                    scroll_to('simple5Bedzzle', 150, 500);
                },
                error: function(){
                    alert("Chiamata fallita, si prega di riprovare...");
                }
            });
        });   
        /* descrizione pacchetto 5° proposta */
        $('#NomeProposta_5').change(function() {
            var pacchetto = $('#NomeProposta_5 option:selected').data('id');
            var idsito = <?=IDSITO?>;
            $.ajax({
                type: "POST",
                url: "<?=BASE_URL_SITO?>ajax/descr_pacchetto.php",
                data: "pacchetto=" + pacchetto +"&idsito=" + idsito,
                dataType: "html",
                success: function(data){
                    $("#TestoProposta_5").text(data);
                },
                error: function(){
                    alert("Chiamata fallita, si prega di riprovare...");
                }
            });
        });
        /* descrizione tariffa 5° proposta */
        $('#EtichettaTariffa_5').change(function() {
            var tariffa =  $('#EtichettaTariffa_5 option:selected').data('id');
            var idsito = <?=IDSITO?>;
            var lingua = '<?=$Lingua?>';
            $.ajax({
                type: "POST",
                url: "<?=BASE_URL_SITO?>ajax/descr_tariffa.php",
                data: "tariffa=" + tariffa + "&idsito=" + idsito + "&lingua=" + lingua,
                dataType: "html",
                success: function(data){
                    $("#AccontoTesto_5").text(data);
                },
                error: function(){
                    alert("Chiamata fallita, si prega di riprovare...");
                }
            });
        });

/* funzione per modificare i testi della richiesta */
    function contenuto_landing(){
        var tiporichiesta = $("#TipoRichiesta").val();
        var idsito = <?=IDSITO?>;
        var lingua = '<?=$Lingua?>';
        $.ajax({
            type: "POST",
            url: "<?=BASE_URL_SITO?>ajax/content_landing.php",
            data: "tiporichiesta=" + tiporichiesta + "&idsito=" + idsito + "&lingua=" + lingua,
            dataType: "html",
            success: function(data){
                $("#Testo").val(data);
            },
            error: function(){
                alert("Chiamata fallita, si prega di riprovare...");
            }
        });
    }

    $("#html").prop("disabled",true);
    $("#html2").prop("disabled",false);
    $("#Testo").wysihtml5();

        $( "#html" ).click(function() {
            $(this).prop("disabled",true);
            $("#html2").prop("disabled",false);
            $("#Testo").wysihtml5();
        });

        $( "#html2" ).click(function() {
            $(this).prop("disabled",true);
            $("#html").prop("disabled",false);
                var content = $('#Testo');
                var contentPar = content.parent();
                contentPar.find('.wysihtml5-toolbar').remove();
                contentPar.find('iframe').remove();
                contentPar.find('input[name*="wysihtml5"]').remove();
                content.show();
        });

        $( "#visual" ).click(function() {
            $( "#nascosto" ).toggle( "slow", function() {
            });
        });

    /* controllo sulle proposte se la richiesta è una conferma almeno una deve essere cliccata */
    if(!$('#CheckProposta_1').is(":checked") || !$('#CheckProposta_2').is(":checked") || !$('#CheckProposta_3').is(":checked") || !$('#CheckProposta_4').is(":checked") || !$('#CheckProposta_5').is(":checked")){
        $('#CheckProposta_1').prop('required',true);
        $('#CheckProposta_2').prop('required',true);
        $('#CheckProposta_3').prop('required',true);
        $('#CheckProposta_4').prop('required',true);
        $('#CheckProposta_5').prop('required',true);
    }else{
        $('#CheckProposta_1').prop('required',false);
        $('#CheckProposta_2').prop('required',false);
        $('#CheckProposta_3').prop('required',false);
        $('#CheckProposta_4').prop('required',false);
        $('#CheckProposta_5').prop('required',false);
    }


    /** controllo se almeno una riga per proposta è stata compliata */
    /** tipo soggiorno */
    if($("select[name*='TipoSoggiorno1[]']").val().length > 0){
        $("select[name*='TipoSoggiorno1[]']").attr('required',false);
    }else{
        $("select[name*='TipoSoggiorno1[]']").attr('required',true);
        $("select[name*='TipoSoggiorno1[]']").attr('title',' ');
    }
    $("select[name*='TipoSoggiorno1[]']").on("change", function(){
        if($("select[name*='TipoSoggiorno1[]']").val().length > 0){
            $("select[name*='TipoSoggiorno1[]']").attr('required',false);
        }else{
            $("select[name*='TipoSoggiorno1[]']").attr('required',true);
            $("select[name*='TipoSoggiorno1[]']").attr('title',' ');
        }
    })
    /** numero camera */
    if($("select[name*='NumeroCamere1[]']").val().length > 0){
        $("select[name*='NumeroCamere1[]']").attr('required',false);
    }else{
        $("select[name*='NumeroCamere1[]']").attr('required',true);
        $("select[name*='NumeroCamere1[]']").attr('title',' ');
    }
    $("select[name*='NumeroCamere1[]']").on("change", function(){
        if($("select[name*='NumeroCamere1[]']").val().length > 0){
            $("select[name*='NumeroCamere1[]']").attr('required',false);
        }else{
            $("select[name*='NumeroCamere1[]']").attr('required',true);
            $("select[name*='NumeroCamere1[]']").attr('title',' ');
        }
    })
    /**  camera */
    if($("select[name*='TipoCamere1[]']").val().length > 0){
        $("select[name*='TipoCamere1[]']").attr('required',false);
    }else{
        $("select[name*='TipoCamere1[]']").attr('required',true);
        $("select[name*='TipoCamere1[]']").attr('title',' ');
    }
    $("select[name*='TipoCamere1[]']").on("change", function(){
        if($("select[name*='TipoCamere1[]']").val().length > 0){
            $("select[name*='TipoCamere1[]']").attr('required',false);
        }else{
            $("select[name*='TipoCamere1[]']").attr('required',true);
            $("select[name*='TipoCamere1[]']").attr('title',' ');
        }
    })

    <? if(($DataVoucherRecSend != '' && $DataValiditaVoucher != '' && $IdMotivazione != '') && $DataRi == ''  && $TipoRichiesta == 'Conferma'){?>

        $('#AccontoPercentuale_1').val('importo');
        if($("#AccontoPercentuale_1").val() == "importo"){
            $("#acconto_l1").html('<input type="text" id="AccontoImporto_1" name="AccontoImporto1" class="form-control" placeholder="000.00">');
            $("#AccontoPercentuale_1").val();
        }else{
            $("#acconto_l1").css("display","none");
        }
        if($('#AccontoPrecedente_1').val()!=''){
            var text_note = $('#Note').text();
            var acconto_text_note = $('#AccontoPrecedente_1').val();
            var nuovo_contenuto_note = text_note+"\r\nVecchia caparra: "+acconto_text_note;
            $('#Note').text(nuovo_contenuto_note);
        }

    <?}?>

  });
  $( document ).bind('ready ajaxComplete', function(){
      /**  adulti */
      if($("#simple1").is(":empty") && $("#simple1E").is(":empty") && $("#simple1Bedzzle").is(":empty")){
        if($("select[name*='NumAdulti1[]']").val().length > 0){
            $("select[name*='NumAdulti1[]']").attr('required',false);
        }else{
            $("select[name*='NumAdulti1[]']").attr('required',true);
            $("select[name*='NumAdulti1[]']").attr('title',' ');
        }
        $("select[name*='NumAdulti1[]']").on("change", function(){
            if($("select[name*='NumAdulti1[]']").val().length > 0){
                $("select[name*='NumAdulti1[]']").attr('required',false);
            }else{
                $("select[name*='NumAdulti1[]']").attr('required',true);
                $("select[name*='NumAdulti1[]']").attr('title',' ');
            }
        })
   }else{
        $("select[name*='TipoSoggiorno1[]']").attr('value','');
        $("select[name*='TipoSoggiorno1[]']").removeAttr('required');
        $("select[name*='NumeroCamere1[]']").attr('value','');
        $("select[name*='NumeroCamere1[]']").removeAttr('required');
        $("select[name*='TipoCamere1[]']").attr('value','');
        $("select[name*='TipoCamere1[]']").removeAttr('required');
        $("select[name*='NumAdulti1[]']").attr('value','');
        $("select[name*='NumAdulti1[]']").removeAttr('required');
   }




});
</script>