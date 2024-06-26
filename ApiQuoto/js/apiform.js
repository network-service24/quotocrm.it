//BOX BIMBI
function azzera_eta_bambini(idbambini) {
    jQuery("#form-field-EtaB" + idbambini + "_1,#form-field-EtaB" + idbambini + '_2,#form-field-EtaB' + idbambini + '_3,#form-field-EtaB' + idbambini + '_4,#form-field-EtaB' + idbambini + '_5').parents('.elementor-field-group').addClass('chiusox');
}
azzera_eta_bambini('1');
azzera_eta_bambini('2');
azzera_eta_bambini('3');
jQuery('#form-field-NumBambini1').on('change', function () {
    azzera_eta_bambini(1);
    contatore = 1;
    while (contatore <= 5) {
        jQuery('#form-field-EtaB1_' + contatore).removeAttr('required');
        jQuery('#form-field-EtaB1_' + contatore).removeAttr('aria-required');
        contatore++;
    }
    contatore = 1;
    while (contatore <= this.value) {
        jQuery('#form-field-EtaB1_' + contatore).parents('.elementor-field-group').removeClass('chiusox');
        jQuery('#form-field-EtaB1_' + contatore).attr('required', 'required');
        jQuery('#form-field-EtaB1_' + contatore).attr('aria-required', 'true');
        contatore++;
    }
});
jQuery('#form-field-NumBambini2').on('change', function () {
    azzera_eta_bambini(2);
    contatore = 1;
    while (contatore <= this.value) {
        jQuery('#form-field-EtaB2_' + contatore).parents('.elementor-field-group').removeClass('chiusox');
        contatore++;
    }
});
jQuery('#form-field-NumBambini3').on('change', function () {
    azzera_eta_bambini(3);
    contatore = 1;
    while (contatore <= this.value) {
        jQuery('#form-field-EtaB3_' + contatore).parents('.elementor-field-group').removeClass('chiusox');
        contatore++;
    }
});
//DATE ALTERNATIVE
function azzera_date_alernative() {
    jQuery('#form-field-DataArrivo,#form-field-DataPartenza').parents('.elementor-field-group').addClass('chiusox');
    jQuery(".minus_date").parents('.elementor-field-group').addClass("chiusox");
}
azzera_date_alernative();
jQuery('.plus_date').click(function () {
    jQuery('#form-field-DataArrivo,#form-field-DataPartenza').parents('.elementor-field-group').removeClass('chiusox');
    jQuery(this).parents('.elementor-field-group').addClass("chiusox");
    jQuery('.minus_date').parents('.elementor-field-group').removeClass("chiusox")
})
jQuery('.minus_date').click(function () {
    azzera_date_alernative();
    jQuery('.plus_date').parents('.elementor-field-group').removeClass("chiusox")
})
//CAMERE
camere = 3;
camera = 1;
jQuery('#form-field-TipoSoggiorno2,#form-field-NumAdulti2,#form-field-NumBambini2,.sepcam2, #form-field-TipoCamere2').parents('.elementor-field-group').addClass('chiusox');
jQuery('#form-field-TipoSoggiorno3,#form-field-NumAdulti3,#form-field-NumBambini3,.sepcam3, #form-field-TipoCamere3').parents('.elementor-field-group').addClass('chiusox');
jQuery('.minus_camere').parents('.elementor-field-group').addClass('chiusox');
jQuery('.plus_camere').click(function () {
    camera++;
    jQuery("#camera").text(camera);
    jQuery('#form-field-TipoSoggiorno' + camera + ',#form-field-NumAdulti' + camera + ',#form-field-NumBambini' + camera + ',.sepcam' + camera + ',#form-field-TipoCamere' + camera).parents('.elementor-field-group').removeClass('chiusox');
    if (camera == camere) {
        jQuery('.plus_camere').parents('.elementor-field-group').addClass('chiusox');
    } else {
        jQuery('.plus_camere').parents('.elementor-field-group').removeClass('chiusox');
    }
    if (camera > 1) {
        jQuery('.minus_camere').parents('.elementor-field-group').removeClass('chiusox');
    } else {
        jQuery('.minus_camere').parents('.elementor-field-group').addClass('chiusox');
    }
})
jQuery('.minus_camere').click(function () {
    jQuery("#camera").text(camera);
    jQuery('#form-field-TipoSoggiorno' + camera + ',#form-field-NumAdulti' + camera + ',#form-field-NumBambini' + camera + ',.sepcam' + camera + ',#form-field-TipoCamere' + camera).parents('.elementor-field-group').addClass('chiusox');
    jQuery('#form-field-EtaB' + camera + '_1,#form-field-EtaB' + camera + '_2,#form-field-EtaB' + camera + '_3,#form-field-EtaB' + camera + '_4,#form-field-EtaB' + camera + '_5').parents('.elementor-field-group').addClass('chiusox');
    camera--;
    if (camera == camere) {
        jQuery('.plus_camere').parents('.elementor-field-group').addClass('chiusox');
    } else {
        jQuery('.plus_camere').parents('.elementor-field-group').removeClass('chiusox');
    }
    if (camera > 1) {
        jQuery('.minus_camere').parents('.elementor-field-group').removeClass('chiusox');
    } else {
        jQuery('.minus_camere').parents('.elementor-field-group').addClass('chiusox');
    }
})
//CONTEGGIO ASSOLUTO ADULTI + BAMBINI
jQuery('#form-field-adulti').val(0);
jQuery('#form-field-bambini').val(0);
adulti = 0;
jQuery('#form-field-NumAdulti1, #form-field-NumAdulti2, #form-field-NumAdulti3').on('change', function () {
    adulti1 = new Number(jQuery('#form-field-NumAdulti1').val());
    adulti2 = new Number(jQuery('#form-field-NumAdulti2').val());
    adulti3 = new Number(jQuery('#form-field-NumAdulti3').val());
    adultitotale = new Number(adulti1 + adulti2 + adulti3);
    jQuery('#form-field-adulti').val(adultitotale);
});
jQuery('#form-field-NumBambini1, #form-field-NumBambini2, #form-field-NumBambini3').on('change', function () {
    adulti1 = new Number(jQuery('#form-field-NumBambini1').val());
    adulti2 = new Number(jQuery('#form-field-NumBambini2').val());
    adulti3 = new Number(jQuery('#form-field-NumBambini3').val());
    adultitotale = new Number(adulti1 + adulti2 + adulti3);
    jQuery('#form-field-bambini').val(adultitotale);
});
//AJAX
jQuery('form[name="QUOTO"]').submit(function () {
    var dati = jQuery(this).serialize();
    jQuery.ajax({
        url: "https://" + window.location.hostname + "/wp-content/themes/networkservice/send.php",
        type: "POST",
        data: dati,
        success: function (msg) {
            jQuery(".success").html(msg);
        },
        error: function () {
            alert("Chiamata fallita, si prega di riprovare..." + msg);
        }
    });
    return false;
});
//CLIENT ID DA COOKIE
function leggiCookie(nomeCookie) {
    if (document.cookie.length > 0) {
        var inizio = document.cookie.indexOf(nomeCookie + "=");
        if (inizio != -1) {
            inizio = inizio + nomeCookie.length + 1;
            var fine = document.cookie.indexOf(";", inizio);
            if (fine == -1) fine = document.cookie.length;
            return unescape(document.cookie.substring(inizio, fine));
        } else {
            return "";
        }
    }
    return "";
}
jQuery(document).ready(function () {
    setTimeout(function () {
        var CLIENT_ID_ = leggiCookie("_ga");
        var CLIENT_ID_tmp = CLIENT_ID_.split(".");
        var CLIENT_ID = CLIENT_ID_tmp[2] + "." + CLIENT_ID_tmp[3];
        jQuery("#form-field-CLIENT_ID").val(CLIENT_ID);
    }, 3000);
});
//URL BACK
jQuery(document).ready(function () {
    uri = window.location.href.substr(window.location.protocol.length + window.location.hostname.length + 2);
    uri2 = uri.split("?")[0];
    jQuery("#form-field-urlback").val("https://" + window.location.hostname + uri2);
    console.log("---->URI2:"+uri2);
});
//CORREZIONE FORMATO DATE
jQuery(document).ready(function () {
    setTimeout(function () {
        jQuery('.flatpickr-input').each(function () {
            flatpickr(jQuery(this)[0]).set('dateFormat', 'd/m/Y');
        });
        flatpickr("input[name='form_fields[data_arrivo]']", {
            minDate: "today",
            dateFormat:'d/m/Y'
        });
        jQuery('.elementor-date-field').removeAttr('pattern');
    }, 1000);
    jQuery("input[name='form_fields[data_arrivo]']").on('change', function () {
        var giorni_da_aggiungere = 1;
        //
        var from = jQuery(this).val().split("/")
        var stop_date = new Date(from[2], from[1] - 1, from[0]);
        var stop_date2 = new Date(from[2], from[1] - 1, from[0]);
        console.log("data inizio:" + stop_date);
        stop_date.setDate(stop_date.getDate() + giorni_da_aggiungere);
        var stop_date =  ("0" + stop_date.getDate()).slice(-2) + "/" + ("0" + (stop_date.getMonth() + 1)).slice(-2) + "/" + stop_date.getFullYear();
        console.log("giorni da aggiungere:" + giorni_da_aggiungere);
        console.log("data inizio:" + stop_date);
        flatpickr("input[name='form_fields[data_partenza]']", {
            minDate: stop_date2,
            dateFormat:'d/m/Y'
        });
        jQuery("input[name='form_fields[data_partenza]']").val(stop_date);

      });
});
//
//Tracking
var miouri = jQuery(location).attr('href');
jQuery("#form-field-tracking").val(miouri);
//User Agent
var mioagent = navigator.userAgent;
jQuery("#form-field-Agent").val(mioagent);
//IP
jQuery.getJSON('https://api.ipify.org?format=jsonp&callback=?', function (data) {
    var mioip = data.ip;
    jQuery("#form-field-Ip").val(mioip);
});
//
//
var res = location.search.replace('?', '').split('res=')
if (res[1] == 'sent') {
    jQuery('.form_quoto').addClass("chiusox");
    jQuery('.form_ok').addClass("open");
    jQuery(document).ready(function () {
        jQuery("html, body").animate({
            scrollTop: jQuery('#quoto').offset().top
        }, 500);
    });
}
jQuery('.form_ok .exit').click(function () {
    jQuery('.form_ok').remove();
});
//
jQuery(document).ready(function () {
    jQuery('#form-field-data_arrivo').attr({'readonly':'readonly','autocomplete':'off'});
    jQuery('#form-field-data_partenza').attr({'readonly':'readonly','autocomplete':'off'});
    jQuery('#form-field-DataArrivo').attr({'readonly':'readonly','autocomplete':'off'});
    jQuery('#form-field-DataPartenza').attr({'readonly':'readonly','autocomplete':'off'});
});
//interruzione prima della tipologia di camera
jQuery(document).ready(function () {
    jQuery("<div style='position: relative;clear: both;width: 100%;'></div>").insertBefore(".elementor-field-group-TipoSoggiorno2,.elementor-field-group-TipoSoggiorno3");
})