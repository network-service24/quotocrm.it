/**
 ** Codice per stampare a video il form di QUOTO v3 
 ** dedicato a chi vuole inserire nel sito un widget-form
 ** author: Marcello Visigalli by Network Service
 ** Data creazione: 20-01-2023
 ** VERSIONE -> 1.0.0 RC
 */

var idsito              = quoto_form[0]['idsito'];
var language            = quoto_form[0]['language'];
var bootstrap       	= quoto_form[0]['bootstrap'];  
var captcha         	= quoto_form[0]['captcha'];
var ChiaveSitoReCaptcha = quoto_form[0]['ChiaveSitoReCaptcha'];
var iubendapolicy   	= quoto_form[0]['iubendapolicy'];
var iubendacode         = quoto_form[0]['iubendacode'];
var tipoSoggiorni       = quoto_form[0]['tipoSoggiorni'];
var selBambini          = quoto_form[0]['selBambini'];
var EtaBambini          = quoto_form[0]['maxEtaBambini'];
var fontawesome     	= quoto_form[0]['fontawesome'];
var campoSconto     	= quoto_form[0]['campoSconto'];
var selectAnimali   	= quoto_form[0]['selectAnimali'];
var selectAlloggi       = quoto_form[0]['selectAlloggi'];
var tipoAlloggi         = quoto_form[0]['tipoAlloggi']; 
var multiStruttura = quoto_form[0]['multiStruttura']; 

    
 $(document).ready(function () {


    /**
    ** controllo degli input per validazione
    */

        $("#form_quoto").mousemove(function () {
            if($("#nome").val()!=''){
                $("#nome").removeClass('error');
            }
            if($("#cognome").val()!=''){
                $("#cognome").removeClass('error');
            }
            if($("#email").val()!=''){
                $("#email").removeClass('error');
            }
            if($("#data_arrivo").val()!=''){
                $("#data_arrivo").removeClass('error');
            }
            if($("#data_partenza").val()!=''){
                $("#data_partenza").removeClass('error');
            }
            /*PRIMA RIGA*/
            if($("select[name*='TipoSoggiorno_1']").val()!=''){
                $("select[name*='TipoSoggiorno_1']").removeClass('error');
            }  
            if($("select[name*='NumAdulti_1']").val()!=''){
                $("select[name*='NumAdulti_1']").removeClass('error');
            }  
            if($("select[name*='EtaB1_1']").val()!=''){
                $("select[name*='EtaB1_1']").removeClass('error');
            }
            if($("select[name*='EtaB2_1']").val()!=''){
                $("select[name*='EtaB2_1']").removeClass('error');
            }
            if($("select[name*='EtaB3_1']").val()!=''){
                $("select[name*='EtaB3_1']").removeClass('error');
            }
            if($("select[name*='EtaB4_1']").val()!=''){
                $("select[name*='EtaB4_1']").removeClass('error');
            }
            if($("select[name*='EtaB5_1']").val()!=''){
                $("select[name*='EtaB5_1']").removeClass('error');
            }
            if($("select[name*='EtaB6_1']").val()!=''){
                $("select[name*='EtaB6_1']").removeClass('error');
            }
        });

     
     
        $(".submit").on('click', function () {
    
            if($("#nome").val()==''){
                $("#nome").addClass('error');
                $("#nome").attr('title','');
            } else {
                $("#nome").removeClass('error');
            }
            if($("#cognome").val()==''){
                $("#cognome").addClass('error');
                $("#cognome").attr('title','');
            }else{
                $("#cognome").removeClass('error');
            }
            if($("#email").val()==''){
                $("#email").addClass('error');
                $("#email").attr('title','');
            }else{
                $("#email").removeClass('error');
            }
            if($("#data_arrivo").val()==''){
                $("#data_arrivo").addClass('error');
                $("#data_arrivo").attr('title','');
            }else{
                $("#data_arrivo").removeClass('error');
            }
            if($("#data_partenza").val()==''){
                $("#data_partenza").addClass('error');
                $("#data_partenza").attr('title','');
            }else{
                $("#data_partenza").removeClass('error');
            }
            /*PRIMA RIGA*/
            if($("select[name*='TipoSoggiorno_1']").val()==''){
                $("select[name*='TipoSoggiorno_1']").addClass('error');
                $("select[name*='TipoSoggiorno_1']").attr('title','');
                if($("#consenso").is(':checked')){
                    return false;
                }
            }else{
                $("select[name*='TipoSoggiorno_1']").removeClass('error');
            }
    
            if($("select[name*='NumAdulti_1']").val()==''){
                $("select[name*='NumAdulti_1']").addClass('error');
                $("select[name*='NumAdulti_1']").attr('title','');
                if($("#consenso").is(':checked')){
                    return false;
                }
            }else{
                $("select[name*='NumAdulti_1']").removeClass('error');
            }
    
            if($("select[name*='EtaB1_1']").val()==''){
                $("select[name*='EtaB1_1']").addClass('error');
                $("select[name*='EtaB1_1']").attr('title','');
            }else{
                $("select[name*='EtaB1_1']").removeClass('error');
            }
            if($("select[name*='EtaB2_1']").val()==''){
                $("select[name*='EtaB2_1']").addClass('error');
                $("select[name*='EtaB2_1']").attr('title','');
            }else{
                $("select[name*='EtaB2_1']").removeClass('error');
            }
            if($("select[name*='EtaB3_1']").val()==''){
                $("select[name*='EtaB3_1']").addClass('error');
                $("select[name*='EtaB3_1']").attr('title','');
            }else{
                $("select[name*='EtaB3_1']").removeClass('error');
            }
            if($("select[name*='EtaB4_1']").val()==''){
                $("select[name*='EtaB4_1']").addClass('error');
                $("select[name*='EtaB4_1']").attr('title','');
            }else{
                $("select[name*='EtaB4_1']").removeClass('error');
            }
            if($("select[name*='EtaB5_1']").val()==''){
                $("select[name*='EtaB5_1']").addClass('error');
                $("select[name*='EtaB5_1']").attr('title','');
            }else{
                $("select[name*='EtaB5_1']").removeClass('error');
            }
            if($("select[name*='EtaB6_1']").val()==''){
                $("select[name*='EtaB6_1']").addClass('error');
                $("select[name*='EtaB6_1']").attr('title','');
            }else{
                $("select[name*='EtaB6_1']").removeClass('error');
            }
        });
    


     
     if (captcha == 1) {
         /** 
          *!CONTROLLO CAPTCHA INVISIBLE E INVIO FORM
         */
         var formQuoto = document.getElementById("form_quoto")
         formQuoto.addEventListener("submit", function (event) {
             console.log('form inviato.');

             if (!grecaptcha.getResponse()) {
                 console.log('captcha non ancora completato.');

                 event.preventDefault(); //prevent form submit
                 grecaptcha.execute();
             } else {
                 console.log('form realmente inviato.');
             }
         });

         onCompleted = function () {
             console.log('captcha completato.');
             formQuoto.submit();
             /* document.getElementById("message-success").style.display = "flex"*/
         }
     } 
        /**
        ** LOADING PER INVIO DEL FORM
        */
        
        $("#form_quoto").on("submit",function(){        
            $("#view_send_form_loading").html('<div class="clearfix">&nbsp;</div><div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center"><img src="https://www.quotocrm.it/apiForm/img/Ellipsis-1s-200px.svg" alt="Salvataggio in corso"></div><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center"><small>Salvataggio in corso..attendere qualche istante!<br>Saving ..., wait for it to finish!</small></div></div><div class="clearfix">&nbsp;</div>');
            $(".submit").hide();       
        }) 
        
        $("#data_arrivo").change(function () {
            var dateA = new Date($("#data_arrivo")[0].valueAsDate);
            dateA.setDate(dateA.getDate() + 1);
            $('#data_partenza')[0].valueAsDate = dateA;
        });     
        $("#DataArrivo").change(function () {
            var dateA = new Date($("#DataArrivo")[0].valueAsDate);
            dateA.setDate(dateA.getDate() + 1);
            $('#DataPartenza')[0].valueAsDate = dateA;
        });   
        $("#data_arrivo").on("change", function () {
            var DtA_tmp = $("#data_arrivo").val();
            $("#data_partenza").attr("min",DtA_tmp);
        });
        $("#DataArrivo").on("change", function () {
            var DtA_tmp = $("#DataArrivo").val();
            $("#DataPartenza").attr("min",DtA_tmp);
        });
     
 });
 /** 
 *! FUNZIONE PER RIDIMESIONARE IFRAME ALL'APERTURA
 */
 function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.documentElement.scrollHeight + 'px';
}
/** 
 *! FUNZIONE PER INCLUDERE ALTRE LIBRERIE
 */
function include(filePath) {
    const scriptTag = document.createElement("script");
    scriptTag.src = filePath;
    document.body.appendChild(scriptTag);
}
/** 
 *! FUNZIONE PER LEGGERE LE VARIABILE GET DA URL DEL SITO
 */
function parseURLParams(url) {
    var queryStart = url.indexOf("?") + 1,
        queryEnd   = url.indexOf("#") + 1 || url.length + 1,
        query = url.slice(queryStart, queryEnd - 1),
        pairs = query.replace(/\+/g, " ").split("&"),
        parms = {}, i, n, v, nv;

    if (query === url || query === "") return;

    for (i = 0; i < pairs.length; i++) {
        nv = pairs[i].split("=", 2);
        n = decodeURIComponent(nv[0]);
        v = decodeURIComponent(nv[1]);

        if (!parms.hasOwnProperty(n)) parms[n] = [];
        parms[n].push(nv.length === 2 ? v : null);
    }
    return parms;
}
if (captcha == 1) {
    if (language == 'it') {
        var lg = '';
    } else {
        var lg = '?hl='+language;
    }

    $('head').append('<script type="text/javascript" src="https://www.google.com/recaptcha/api.js'+lg+'" async defer></script>');
}
if (fontawesome == 1) {
    $('head').append('<script src="https://use.fontawesome.com/da6d3ea52f.js"></script>');
}

if (bootstrap == 1) {
    $('head').append('<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>');
    $('head').append('<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">');
}

$('head').append('<link type="text/css" href="https://www.quotocrm.it/apiForm/css/form_quoto_js.min.css" rel="Stylesheet" />');

/**
** estraggo il _GA di Analytics per creare il CLIENT ID utile per la tracciabilità
*/
setTimeout(function(){
    var CLIENT_ID_ = leggiCookie("_ga");
    var CLIENT_ID_tmp =  CLIENT_ID_.split(".");
    var CLIENT_ID = CLIENT_ID_tmp[2]+"."+CLIENT_ID_tmp[3];
    $("#load_client_id").html('<input type="hidden" name="CLIENT_ID" value="' + CLIENT_ID + '" />');
    $("#_ga").val(CLIENT_ID_);
}, 3000);

/**
** estraggo gli UTM SOURCE per la tracciabilità
*/
setTimeout(function(){
    var UTM_SOURCE = leggiCookie("utm_source");
    $("#utm_source").val(UTM_SOURCE);
}, 3000);

/**
** estraggo gli UTM MEDIUM per la tracciabilità
*/
setTimeout(function(){
    var UTM_MEDIUM = leggiCookie("utm_medium");
    $("#utm_medium").val(UTM_MEDIUM);
}, 3000);

/**
** estraggo gli UTM CAMPAIGN per la tracciabilità
*/
setTimeout(function(){
    var UTM_CAMPAIGN = leggiCookie("utm_campaign");
    $("#utm_campaign").val(UTM_CAMPAIGN);
}, 3000);
/** 
** dichiarazioni delle variabili per uso e pre-compilazione del form
*/
// Crea la data di oggi
var dtToday = new Date();
var month   = dtToday.getMonth() + 1;     // getMonth() is zero-based
var day     = dtToday.getDate();
var year    = dtToday.getFullYear();
if(month < 10)
    month = '0' + month.toString();
if(day < 10)
    day = '0' + day.toString();

var data_oggiQ = year + '-' + month + '-' + day;

/* var dateQ      = new Date();
var yearQ      = dateQ.toLocaleString("default", { yearQ : "numeric" });
var monthQ     = dateQ.toLocaleString("default", { monthQ: "2-digit" });
var dayQ       = dateQ.toLocaleString("default", { dayQ  : "2-digit" });*/

    
var linea      = 1;
var n_proposta = 1;

switch(language) {
    case 'it':
        var idlang = 1;
    break;
    case 'en':
        var idlang = 2;
    break;
    case 'fr':
        var idlang = 3;
    break;
    case 'de':
        var idlang = 4;
    break;
    case 'es':
        var idlang = 5;
    break;
    case 'ru':
        var idlang = 6;
    break;
    case 'nl':
        var idlang = 7;
    break;
    case 'pl':
        var idlang = 8;
    break;
    case 'hu':
        var idlang = 9;
    break;
    case 'pt':
        var idlang = 10;
    break;
    case 'ea':
        var idlang = 11;
    break;
    case 'cz':
        var idlang = 12;
    break;
    case 'cn':
        var idlang = 13;
    break;
    case 'br':
        var idlang = 14;
    break;
    case 'jp':
        var idlang = 15;
    break;
    default:
     var idlang = 2;
}
  
var sito                   = 'https://'+window.location.hostname;
var request_uri            = window.location.pathname + window.location.search;
var provenienza_tmp        = request_uri.split('?'); 
var provenienza            = provenienza_tmp[0];
var urlback                = sito + provenienza;
/**
 *!SCRIVI COOKIE UTM
 */
 if (strstr(request_uri,'utm_campaign',true)) {
    var utm__ = request_uri.split('?');
    var utm_ = utm__[1].split('&');
    for (var i = 0; i < utm_.length; ++i) {
        var val_utm = utm_[i].split('=');
        var utm_nome = val_utm[0];
        var utm_valore = val_utm[1];
        console.log(utm_nome + ' ' + utm_valore);
        scriviCookie(utm_nome, utm_valore, '60');
    }
}

var placeholder_nome = new Array();
    placeholder_nome[1]  = 'Nome *';
    placeholder_nome[2]  = 'Name *';
    placeholder_nome[3]  = 'Prénom *';
    placeholder_nome[4]  = 'Vorname *';
    placeholder_nome[5]  = 'Nombre propio *';
    placeholder_nome[6]  = 'Имя *';
    placeholder_nome[7]  = 'Name *';
    placeholder_nome[8]  = 'Name *';
    placeholder_nome[9]  = 'Name *';
    placeholder_nome[10] = 'Name *';
    placeholder_nome[11] = 'Name *';
    placeholder_nome[12] = 'Name *';
    placeholder_nome[13] = 'Name *';
    placeholder_nome[14] = 'Name *';
    placeholder_nome[15] = 'Name *';
    
    var placeholder_cognome = new Array();
        placeholder_cognome[1]  = 'Cognome *';
        placeholder_cognome[2]  = 'Last name *';
        placeholder_cognome[3]  = 'Nom *';
        placeholder_cognome[4]  = 'Nachname *';
        placeholder_cognome[5]  = 'Apellido *';
        placeholder_cognome[6]  = 'Имя *';
        placeholder_cognome[7]  = 'Last name *';
        placeholder_cognome[8]  = 'Last name *';
        placeholder_cognome[9]  = 'Last name *';
        placeholder_cognome[10] = 'Last name *';
        placeholder_cognome[11] = 'Last name *';
        placeholder_cognome[12] = 'Last name *';
        placeholder_cognome[13] = 'Last name *';
        placeholder_cognome[14] = 'Last name *';
        placeholder_cognome[15] = 'Last name *';
        
var placeholder_telefono = new Array();
        placeholder_telefono[1]  = 'Telefono';
        placeholder_telefono[2]  = 'Phone';
        placeholder_telefono[3]  = 'Téléphone';
        placeholder_telefono[4]  = 'Telefon';
        placeholder_telefono[5]  = 'Teléfono';
        placeholder_telefono[6]  = 'телефонИмя';
        placeholder_telefono[7]  = 'Phone';
        placeholder_telefono[8]  = 'Phone';
        placeholder_telefono[9]  = 'Phone';
        placeholder_telefono[10] = 'Phone';
        placeholder_telefono[11] = 'Phone';
        placeholder_telefono[12] = 'Phone';
        placeholder_telefono[13] = 'Phone';
        placeholder_telefono[14] = 'Phone';
        placeholder_telefono[15] = 'Phone';

var placeholder_messaggio = new Array();
        placeholder_messaggio[1]  = 'Messaggio';
        placeholder_messaggio[2]  = 'Message';
        placeholder_messaggio[3]  = 'Message';
        placeholder_messaggio[4]  = 'Nachricht';
        placeholder_messaggio[5]  = 'Mensaje';
        placeholder_messaggio[6]  = 'Сообщение';
        placeholder_messaggio[7]  = 'Message';
        placeholder_messaggio[8]  = 'Message';
        placeholder_messaggio[9]  = 'Message';
        placeholder_messaggio[10] = 'Message';
        placeholder_messaggio[11] = 'Message';
        placeholder_messaggio[12] = 'Message';
        placeholder_messaggio[13] = 'Message';
        placeholder_messaggio[14] = 'Message';
        placeholder_messaggio[15] = 'Message';


var marketing = new Array();
        marketing[1]  = 'Acconsento a ricevere offerte esclusive e novità';
        marketing[2]  = 'I agree to receive exclusive offers and news';
        marketing[3]  = 'J\'accepte de recevoir des offres exclusives et des nouvelles';
        marketing[4]  = 'Ich stimme zu, exklusive Angebote und Neuigkeiten zu erhalten';
        marketing[5]  = 'Acepto recibir ofertas y novedades exclusivas';
        marketing[6]  = 'Я согласен получать эксклюзивные предложения и новости';
        marketing[7]  = 'I agree to receive exclusive offers and news';
        marketing[8]  = 'I agree to receive exclusive offers and news';
        marketing[9]  = 'I agree to receive exclusive offers and news';
        marketing[10] = 'I agree to receive exclusive offers and news';
        marketing[11] = 'I agree to receive exclusive offers and news';
        marketing[12] = 'I agree to receive exclusive offers and news';
        marketing[13] = 'I agree to receive exclusive offers and news';
        marketing[14] = 'I agree to receive exclusive offers and news';
        marketing[15] = 'I agree to receive exclusive offers and news';

if (iubendapolicy == 1) {

    var iubenda_tmp = iubendacode.split("#");
    var iubendacode_it = iubenda_tmp[0];
    var iubendacode_en = iubenda_tmp[1];
    var iubendacode_fr = iubenda_tmp[2];
    var iubendacode_de = iubenda_tmp[3];
    var iubendacode_es = iubenda_tmp[4];
    var iubendacode_ru = iubenda_tmp[5];

    var consenso = new Array();
        consenso[1]  = 'Do il consenso al trattamento dei dati - <a href="//www.iubenda.com/privacy-policy/'+iubendacode_it+'" class="iubenda-white no-brand iubenda-noiframe iubenda-embed iubenda-noiframe  linkPrivacy" title="Privacy Policy">Privacy Policy</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src = "//cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>';
        consenso[2]  = 'I consent to the processing of data - <a href="//www.iubenda.com/privacy-policy/'+iubendacode_en+'" class="iubenda-white no-brand iubenda-noiframe iubenda-embed iubenda-noiframe  linkPrivacy" title="Privacy Policy">Privacy Policy</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src = "//cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>';
        consenso[3]  = 'Je consens au traitement des données - <a href="//www.iubenda.com/privacy-policy/'+iubendacode_fr+'" class="iubenda-white no-brand iubenda-noiframe iubenda-embed iubenda-noiframe  linkPrivacy" title="Politique de confidentialité">Politique de confidentialité</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src = "//cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>';
        consenso[4]  = 'Ich stimme der Datenverarbeitung zu - <a href="//www.iubenda.com/privacy-policy/'+iubendacode_de+'" class="iubenda-white no-brand iubenda-noiframe iubenda-embed iubenda-noiframe  linkPrivacy" title="Datenschutz-Bestimmungen">Datenschutz-Bestimmungen</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src = "//cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>';
        consenso[5]  = 'Acepto el tratamiento de datos - <a href="//www.iubenda.com/privacy-policy/'+iubendacode_es+'" class="iubenda-white no-brand iubenda-noiframe iubenda-embed iubenda-noiframe  linkPrivacy" title="Política de privacidad">Política de privacidad</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src = "//cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>';
        consenso[6]  = 'Я даю согласие на обработку данных - <a href="//www.iubenda.com/privacy-policy/'+iubendacode_ru+'" class="iubenda-white no-brand iubenda-noiframe iubenda-embed iubenda-noiframe  linkPrivacy" title="политика конфиденциальности">политика конфиденциальности</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src = "//cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>';
        consenso[7]  = 'I consent to the processing of data - <a href="//www.iubenda.com/privacy-policy/'+iubendacode_en+'" class="iubenda-white no-brand iubenda-noiframe iubenda-embed iubenda-noiframe  linkPrivacy" title="Privacy Policy">Privacy Policy</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src = "//cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>';
        consenso[8]  = 'I consent to the processing of data - <a href="//www.iubenda.com/privacy-policy/'+iubendacode_en+'" class="iubenda-white no-brand iubenda-noiframe iubenda-embed iubenda-noiframe  linkPrivacy" title="Privacy Policy">Privacy Policy</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src = "//cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>';
        consenso[9]  = 'I consent to the processing of data - <a href="//www.iubenda.com/privacy-policy/'+iubendacode_en+'" class="iubenda-white no-brand iubenda-noiframe iubenda-embed iubenda-noiframe  linkPrivacy" title="Privacy Policy">Privacy Policy</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src = "//cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>';
        consenso[10] = 'I consent to the processing of data - <a href="//www.iubenda.com/privacy-policy/'+iubendacode_en+'" class="iubenda-white no-brand iubenda-noiframe iubenda-embed iubenda-noiframe  linkPrivacy" title="Privacy Policy">Privacy Policy</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src = "//cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>';
        consenso[11] = 'I consent to the processing of data - <a href="//www.iubenda.com/privacy-policy/'+iubendacode_en+'" class="iubenda-white no-brand iubenda-noiframe iubenda-embed iubenda-noiframe  linkPrivacy" title="Privacy Policy">Privacy Policy</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src = "//cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>';
        consenso[12] = 'I consent to the processing of data - <a href="//www.iubenda.com/privacy-policy/'+iubendacode_en+'" class="iubenda-white no-brand iubenda-noiframe iubenda-embed iubenda-noiframe  linkPrivacy" title="Privacy Policy">Privacy Policy</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src = "//cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>';
        consenso[13] = 'I consent to the processing of data - <a href="//www.iubenda.com/privacy-policy/'+iubendacode_en+'" class="iubenda-white no-brand iubenda-noiframe iubenda-embed iubenda-noiframe  linkPrivacy" title="Privacy Policy">Privacy Policy</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src = "//cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>';
        consenso[14] = 'I consent to the processing of data - <a href="//www.iubenda.com/privacy-policy/'+iubendacode_en+'" class="iubenda-white no-brand iubenda-noiframe iubenda-embed iubenda-noiframe  linkPrivacy" title="Privacy Policy">Privacy Policy</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src = "//cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>';
        consenso[15] = 'I consent to the processing of data - <a href="//www.iubenda.com/privacy-policy/'+iubendacode_en+'" class="iubenda-white no-brand iubenda-noiframe iubenda-embed iubenda-noiframe  linkPrivacy" title="Privacy Policy">Privacy Policy</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src = "//cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>';
           
} else {

    var consenso = new Array();
    consenso[1]  = 'Do il consenso al trattamento dei dati - <a href="javascript:;" onclick="window.open(\'https://www.quotocrm.it/consensi/privacy_policy.php?idsito='+idsito+'&lang='+language+'\',\'Informativa Privacy\',\'left=200,top=200,width=800,height=600\');" class="linkPrivacy">Visualizza Informativa</a>';
    consenso[2]  = 'I consent to the processing of data - <a href="javascript:;" onclick="window.open(\'https://www.quotocrm.it/consensi/privacy_policy.php?idsito='+idsito+'&lang='+language+'\',\'Informativa Privacy\',\'left=200,top=200,width=800,height=600\');" class="linkPrivacy">View Information</a>';
    consenso[3]  = 'Je consens au traitement des données - <a href="javascript:;" onclick="window.open(\'https://www.quotocrm.it/consensi/privacy_policy.php?idsito='+idsito+'&lang='+language+'\',\'Informativa Privacy\',\'left=200,top=200,width=800,height=600\');" class="linkPrivacy">Afficher les informations</a>';
    consenso[4]  = 'Ich stimme der Datenverarbeitung zu - <a href="javascript:;" onclick="window.open(\'https://www.quotocrm.it/consensi/privacy_policy.php?idsito='+idsito+'&lang='+language+'\',\'Informativa Privacy\',\'left=200,top=200,width=800,height=600\');" class="linkPrivacy">Informationen anzeigen</a>';
    consenso[5]  = 'Doy mi consentimiento para el procesamiento de datos - <a href="javascript:;" onclick="window.open(\'https://www.quotocrm.it/consensi/privacy_policy.php?idsito='+idsito+'&lang='+language+'\',\'Informativa Privacy\',\'left=200,top=200,width=800,height=600\');" class="linkPrivacy">Ver información</a>';
    consenso[6]  = 'Я даю согласие на обработку данных - <a href="javascript:;" onclick="window.open(\'https://www.quotocrm.it/consensi/privacy_policy.php?idsito='+idsito+'&lang='+language+'\',\'Informativa Privacy\',\'left=200,top=200,width=800,height=600\');" class="linkPrivacy">Просмотреть информацию</a>';
    consenso[7]  = 'I consent to the processing of data - <a href="javascript:;" onclick="window.open(\'https://www.quotocrm.it/consensi/privacy_policy.php?idsito='+idsito+'&lang='+language+'\',\'Informativa Privacy\',\'left=200,top=200,width=800,height=600\');" class="linkPrivacy">View Information</a>';
    consenso[8]  = 'I consent to the processing of data - <a href="javascript:;" onclick="window.open(\'https://www.quotocrm.it/consensi/privacy_policy.php?idsito='+idsito+'&lang='+language+'\',\'Informativa Privacy\',\'left=200,top=200,width=800,height=600\');" class="linkPrivacy">View Information</a>';
    consenso[9]  = 'I consent to the processing of data - <a href="javascript:;" onclick="window.open(\'https://www.quotocrm.it/consensi/privacy_policy.php?idsito='+idsito+'&lang='+language+'\',\'Informativa Privacy\',\'left=200,top=200,width=800,height=600\');" class="linkPrivacy">View Information</a>';
    consenso[10] = 'I consent to the processing of data - <a href="javascript:;" onclick="window.open(\'https://www.quotocrm.it/consensi/privacy_policy.php?idsito='+idsito+'&lang='+language+'\',\'Informativa Privacy\',\'left=200,top=200,width=800,height=600\');" class="linkPrivacy">View Information</a>';
    consenso[11] = 'I consent to the processing of data - <a href="javascript:;" onclick="window.open(\'https://www.quotocrm.it/consensi/privacy_policy.php?idsito='+idsito+'&lang='+language+'\',\'Informativa Privacy\',\'left=200,top=200,width=800,height=600\');" class="linkPrivacy">View Information</a>';
    consenso[12] = 'I consent to the processing of data - <a href="javascript:;" onclick="window.open(\'https://www.quotocrm.it/consensi/privacy_policy.php?idsito='+idsito+'&lang='+language+'\',\'Informativa Privacy\',\'left=200,top=200,width=800,height=600\');" class="linkPrivacy">View Information</a>';
    consenso[13] = 'I consent to the processing of data - <a href="javascript:;" onclick="window.open(\'https://www.quotocrm.it/consensi/privacy_policy.php?idsito='+idsito+'&lang='+language+'\',\'Informativa Privacy\',\'left=200,top=200,width=800,height=600\');" class="linkPrivacy">View Information</a>';
    consenso[14] = 'I consent to the processing of data - <a href="javascript:;" onclick="window.open(\'https://www.quotocrm.it/consensi/privacy_policy.php?idsito='+idsito+'&lang='+language+'\',\'Informativa Privacy\',\'left=200,top=200,width=800,height=600\');" class="linkPrivacy">View Information</a>';

    
}

var placeholder_codice_sconto = new Array();
        placeholder_codice_sconto[1]  = 'Codice Sconto';
        placeholder_codice_sconto[2]  = 'Discount code';
        placeholder_codice_sconto[3]  = 'Code de réduction';
        placeholder_codice_sconto[4]  = 'Rabattcode';
        placeholder_codice_sconto[5]  = 'Código de descuento';
        placeholder_codice_sconto[6]  = 'Код скидки';
        placeholder_codice_sconto[7]  = 'Discount code';
        placeholder_codice_sconto[8]  = 'Discount code';
        placeholder_codice_sconto[9]  = 'Discount code';
        placeholder_codice_sconto[10] = 'Discount code';
        placeholder_codice_sconto[11] = 'Discount code';
        placeholder_codice_sconto[12] = 'Discount code';
        placeholder_codice_sconto[13] = 'Discount code';
        placeholder_codice_sconto[14] = 'Discount code';
        placeholder_codice_sconto[15] = 'Discount code';


var responseForm = new Array();
    responseForm[1]  = 'Grazie per averci contattato, ti risponderemo al più presto.<br />ATTENZIONE: alcuni programmi di posta come <b>GMail</b>, <b>Libero Mail</b>, ecc., potrebbero inserire erroneamente la nostra risposta di preventivo tra le <b>Promozioni/Offerte</b> o in <b>Spam</b>. <br />Ti invitiamo pertanto a controllare tali cartelle e a trascinare il tuo preventivo nella cartella <b>Principale</b>.';
    responseForm[2]  = 'Thank you for your request. We\'ll contact you soon.<br />ATTENTION: some e-mail programs such as <b>GMail</b>, <b>Libero Mail</b>, etc., may mistakenly insert our quote response among the <b>Promotions/Offers</b> or in <b>Spam</b>.<br />We therefore encourage you to check these folders and drag your quote to the <b>Main</b> folder.';
    responseForm[3]  = 'Merci de nous avoir contactés, nous vous répondrons dans les plus brefs délais.<br />ATTENTION : certains programmes de messagerie tels que <b>GMail</b>, <b>Libero Mail</b>, etc., pourraient entrer dans notre réponse incorrecte de devis parmi les <b>Promotions/Offres</b> ou dans les <b>Spam</b>. <br />Nous vous invitons donc à vérifier ces dossiers et à faire glisser votre devis dans le dossier <b>Main</b>.';
    responseForm[4]  = 'Vielen Dank für Ihre Kontaktaufnahme, wir werden so schnell wie möglich antworten.<br />ACHTUNG: einige E-Mail-Programme wie <b>GMail</b>, <b>Libero Mail</b> usw. könnten in unsere E-Mail-Adresse gelangen falsche Antwort unter den <b>Aktionen/Angeboten</b> oder im <b>Spam</b>. <br />Deshalb laden wir Sie ein, diese Ordner zu überprüfen und Ihr Angebot in den <b>Hauptordner</b> zu ziehen.';
    responseForm[5]  = 'Gracias por contactar con nosotros, le responderemos lo antes posible.<br />ATENCIÓN: algunos programas de correo como <b>GMail</b>, <b>Libero Mail</b>, etc., podrían entrar en nuestro responder incorrectamente de presupuesto entre las <b>Promociones/Ofertas</b> o en <b>Spam</b>. <br />Así que lo invitamos a revisar estas carpetas y arrastrar su cotización a la carpeta <b>Principal</b>.';
    responseForm[6]  = 'Thank you for your request. We\'ll contact you soon.<br />ATTENTION: some e-mail programs such as <b>GMail</b>, <b>Libero Mail</b>, etc., may mistakenly insert our quote response among the <b>Promotions/Offers</b> or in <b>Spam</b>.<br />We therefore encourage you to check these folders and drag your quote to the <b>Main</b> folder.';
    responseForm[7]  = 'Thank you for your request. We\'ll contact you soon.<br />ATTENTION: some e-mail programs such as <b>GMail</b>, <b>Libero Mail</b>, etc., may mistakenly insert our quote response among the <b>Promotions/Offers</b> or in <b>Spam</b>.<br />We therefore encourage you to check these folders and drag your quote to the <b>Main</b> folder.';
    responseForm[8]  = 'Thank you for your request. We\'ll contact you soon.<br />ATTENTION: some e-mail programs such as <b>GMail</b>, <b>Libero Mail</b>, etc., may mistakenly insert our quote response among the <b>Promotions/Offers</b> or in <b>Spam</b>.<br />We therefore encourage you to check these folders and drag your quote to the <b>Main</b> folder.';
    responseForm[9]  = 'Thank you for your request. We\'ll contact you soon.<br />ATTENTION: some e-mail programs such as <b>GMail</b>, <b>Libero Mail</b>, etc., may mistakenly insert our quote response among the <b>Promotions/Offers</b> or in <b>Spam</b>.<br />We therefore encourage you to check these folders and drag your quote to the <b>Main</b> folder.';
    responseForm[10] = 'Thank you for your request. We\'ll contact you soon.<br />ATTENTION: some e-mail programs such as <b>GMail</b>, <b>Libero Mail</b>, etc., may mistakenly insert our quote response among the <b>Promotions/Offers</b> or in <b>Spam</b>.<br />We therefore encourage you to check these folders and drag your quote to the <b>Main</b> folder.';
    responseForm[11] = 'Thank you for your request. We\'ll contact you soon.<br />ATTENTION: some e-mail programs such as <b>GMail</b>, <b>Libero Mail</b>, etc., may mistakenly insert our quote response among the <b>Promotions/Offers</b> or in <b>Spam</b>.<br />We therefore encourage you to check these folders and drag your quote to the <b>Main</b> folder.';
    responseForm[12] = 'Thank you for your request. We\'ll contact you soon.<br />ATTENTION: some e-mail programs such as <b>GMail</b>, <b>Libero Mail</b>, etc., may mistakenly insert our quote response among the <b>Promotions/Offers</b> or in <b>Spam</b>.<br />We therefore encourage you to check these folders and drag your quote to the <b>Main</b> folder.';
    responseForm[13] = 'Thank you for your request. We\'ll contact you soon.<br />ATTENTION: some e-mail programs such as <b>GMail</b>, <b>Libero Mail</b>, etc., may mistakenly insert our quote response among the <b>Promotions/Offers</b> or in <b>Spam</b>.<br />We therefore encourage you to check these folders and drag your quote to the <b>Main</b> folder.';
    responseForm[14] = 'Thank you for your request. We\'ll contact you soon.<br />ATTENTION: some e-mail programs such as <b>GMail</b>, <b>Libero Mail</b>, etc., may mistakenly insert our quote response among the <b>Promotions/Offers</b> or in <b>Spam</b>.<br />We therefore encourage you to check these folders and drag your quote to the <b>Main</b> folder.';
    responseForm[15] = 'Thank you for your request. We\'ll contact you soon.<br />ATTENTION: some e-mail programs such as <b>GMail</b>, <b>Libero Mail</b>, etc., may mistakenly insert our quote response among the <b>Promotions/Offers</b> or in <b>Spam</b>.<br />We therefore encourage you to check these folders and drag your quote to the <b>Main</b> folder.';
 
    
var rem_room = new Array();
    rem_room[1]  = 'rimuovi camera';
    rem_room[2]  = 'remove room';
    rem_room[3]  = 'retirer la pièce';
    rem_room[4]  = 'Raum entfernen';
    rem_room[5]  = 'quitar habitación';
    rem_room[6]  = 'удалить комнату';
    rem_room[7]  = 'remove room';
    rem_room[8]  = 'remove room';
    rem_room[9]  = 'remove room';
    rem_room[10] = 'remove room';
    rem_room[11] = 'remove room';
    rem_room[12] = 'remove room';
    rem_room[13] = 'remove room';
    rem_room[14] = 'remove room';
    rem_room[15] = 'remove room';


var plus_date = new Array();
    plus_date[1]  = 'aggiungi date alternative';
    plus_date[2]  = 'add alternative dates';
    plus_date[3]  = 'ajouter des dates alternatives';
    plus_date[4]  = 'Alternative Ankunft';
    plus_date[5]  = 'agregar fechas alternativas';
    plus_date[6]  = 'добавить альтернативные даты'; 
    plus_date[7]  = 'add alternative dates';
    plus_date[8]  = 'add alternative dates';
    plus_date[9]  = 'add alternative dates';
    plus_date[10] = 'add alternative dates';
    plus_date[11] = 'add alternative dates';
    plus_date[12] = 'add alternative dates';
    plus_date[13] = 'add alternative dates';
    plus_date[14] = 'add alternative dates';
    plus_date[15] = 'add alternative dates';


var minus_date = new Array();
    minus_date[1]  = 'elimina date alternative';
    minus_date[2]  = 'delete alternative dates';
    minus_date[3]  = 'supprimer des dates alternatives';
    minus_date[4]  = 'alternative Daten löschen';
    minus_date[5]  = 'eliminar fechas alternativas';
    minus_date[6]  = 'удалить альтернативные даты'; 
    minus_date[7]  = 'delete alternative dates';
    minus_date[8]  = 'delete alternative dates';
    minus_date[9]  = 'delete alternative dates';
    minus_date[10] = 'delete alternative dates';
    minus_date[11] = 'delete alternative dates';
    minus_date[12] = 'delete alternative dates';
    minus_date[13] = 'delete alternative dates';
    minus_date[14] = 'delete alternative dates';
    minus_date[15] = 'delete alternative dates';

var addC = new Array();
    addC[1]  = 'aggiungi camera';
    addC[2]  = 'add room';
    addC[3]  = 'ajouter une chambre';
    addC[4]  = 'Zimmer hinzufügen';
    addC[5]  = 'añadir habitación';
    addC[6]  = 'добавить комнату'; 
    addC[7]  = 'add room';
    addC[8]  = 'add room';
    addC[9]  = 'add room';
    addC[10] = 'add room';
    addC[11] = 'add room';
    addC[12] = 'add room';
    addC[13] = 'add room';
    addC[14] = 'add room';
    addC[15] = 'add room';


var adulti = new Array();
    adulti[1]  = 'Adulti *';
    adulti[2]  = 'Adults *';
    adulti[3]  = 'Adultes *';
    adulti[4]  = 'Erwachsene *';
    adulti[5]  = 'Adultos *';
    adulti[6]  = 'Взрослые *';
    adulti[7]  = 'Adults *';
    adulti[8]  = 'Adults *';
    adulti[9]  = 'Adults *';
    adulti[10] = 'Adults *';
    adulti[11] = 'Adults *';
    adulti[12] = 'Adults *';
    adulti[13] = 'Adults *';
    adulti[14] = 'Adults *';
    adulti[15] = 'Adults *';

var bambini = new Array();
    bambini[1]  = 'Bambini';
    bambini[2]  = 'Children';
    bambini[3]  = 'Enfants';
    bambini[4]  = 'Kinder';
    bambini[5]  = 'Niños';
    bambini[6]  = 'Дети'; 
    bambini[7]  = 'Children';
    bambini[8]  = 'Children';
    bambini[9]  = 'Children';
    bambini[10] = 'Children';
    bambini[11] = 'Children';
    bambini[12] = 'Children';
    bambini[13] = 'Children';
    bambini[14] = 'Children';
    bambini[15] = 'Children';
 
var etaB = new Array();
    etaB[1] = 'Età';
    etaB[2] = 'Age';
    etaB[3] = 'Âge';
    etaB[4] = 'Alter';
    etaB[5] = 'Edad';
    etaB[6] = 'Возраст';
    etaB[7] = 'Age';
    etaB[8] = 'Age';
    etaB[9] = 'Age';
    etaB[10] = 'Age';
    etaB[11] = 'Age';
    etaB[12] = 'Age';
    etaB[13] = 'Age';
    etaB[14] = 'Age';
    etaB[15] = 'Age';


    
if (tipoAlloggi != '') {

    var alloggi = new Array();
        alloggi[1]  = '<option value="">Tipo Alloggio</option>';
        alloggi[2]  = '<option value="">Accommodation type</option>';
        alloggi[3]  = '<option value="">Type d\'hébergement</option>';
        alloggi[4]  = '<option value="">Unterkunftsart</option>';
        alloggi[5]  = '<option value="">Tipo de alojamiento</option>';
        alloggi[6]  = '<option value="">Тип размещения</option>'; 
        alloggi[7]  = '<option value="">Accommodation type</option>';
        alloggi[8]  = '<option value="">Accommodation type</option>';
        alloggi[9]  = '<option value="">Accommodation type</option>';
        alloggi[10] = '<option value="">Accommodation type</option>';
        alloggi[11] = '<option value="">Accommodation type</option>';
        alloggi[12] = '<option value="">Accommodation type</option>';
        alloggi[13] = '<option value="">Accommodation type</option>';
        alloggi[14] = '<option value="">Accommodation type</option>';
        alloggi[15] = '<option value="">Accommodation type</option>';
    
    var alloggi_params = new Array();

        var alloggi_tmp    = tipoAlloggi.split("#");
    
        var alloggi_it_tmp = alloggi_tmp[0].split(",");

        var alloggi_en_tmp = alloggi_tmp[1].split(",");

        var alloggi_fr_tmp = alloggi_tmp[2].split(",");

        var alloggi_de_tmp = alloggi_tmp[3].split(",");    
    
        var alloggi_es_tmp = alloggi_tmp[4].split(","); 
    
        var alloggi_ru_tmp = alloggi_tmp[5].split(",");

        alloggi_it_tmp.forEach(function (alloggi_it) {
            alloggi_params[1]  += '<option value="'+alloggi_it+'">'+alloggi_it+'</option>';
        });

        alloggi_en_tmp.forEach(function(alloggi_en) {
            alloggi_params[2] += '<option value="' + alloggi_en + '">' + alloggi_en + '</option>';   
            alloggi_params[7] += '<option value="' + alloggi_en + '">' + alloggi_en + '</option>';
            alloggi_params[8] += '<option value="' + alloggi_en + '">' + alloggi_en + '</option>';
            alloggi_params[9] += '<option value="' + alloggi_en + '">' + alloggi_en + '</option>';
            alloggi_params[10] += '<option value="' + alloggi_en + '">' + alloggi_en + '</option>';
            alloggi_params[11] += '<option value="' + alloggi_en + '">' + alloggi_en + '</option>';
            alloggi_params[12] += '<option value="' + alloggi_en + '">' + alloggi_en + '</option>';
            alloggi_params[13] += '<option value="' + alloggi_en + '">' + alloggi_en + '</option>';
            alloggi_params[14] += '<option value="' + alloggi_en + '">' + alloggi_en + '</option>';
            alloggi_params[15] += '<option value="' + alloggi_en + '">' + alloggi_en + '</option>';
            
        });       

        alloggi_fr_tmp.forEach(function(alloggi_fr) {
            alloggi_params[3]  += '<option value="'+alloggi_fr+'">'+alloggi_fr+'</option>';
        });       

        alloggi_de_tmp.forEach(function(alloggi_de) {
            alloggi_params[4]  += '<option value="'+alloggi_de+'">'+alloggi_de+'</option>';
        });       
    
        alloggi_es_tmp.forEach(function(alloggi_es) {
            alloggi_params[5]  += '<option value="'+alloggi_es+'">'+alloggi_es+'</option>';
        });
    
        alloggi_ru_tmp.forEach(function(alloggi_ru) {
            alloggi_params[6]  += '<option value="'+alloggi_ru+'">'+alloggi_ru+'</option>';
        }); 
}

var trattamento = new Array();
    trattamento[1]  = '<option value="">Trattamento *</option>';
    trattamento[2]  = '<option value="">Treatment *</option>';
    trattamento[3]  = '<option value="">Traitement *</option>';
    trattamento[4]  = '<option value="">Behandlung *</option>';
    trattamento[5]  = '<option value="">Tratamiento *</option>';
    trattamento[6]  = '<option value="">лечение *</option>'; 
    trattamento[7]  = '<option value="">Treatment *</option>';
    trattamento[8]  = '<option value="">Treatment *</option>';
    trattamento[9]  = '<option value="">Treatment *</option>';
    trattamento[10] = '<option value="">Treatment *</option>';
    trattamento[11] = '<option value="">Treatment *</option>';
    trattamento[12] = '<option value="">Treatment *</option>';
    trattamento[13] = '<option value="">Treatment *</option>';
    trattamento[14] = '<option value="">Treatment *</option>';
    trattamento[15] = '<option value="">Treatment *</option>';
    
if (tipoSoggiorni != '') {

    var trattamento_params = new Array();

        var soggiorni_tmp    = tipoSoggiorni.split("#");
    
        var soggiorni_it_tmp = soggiorni_tmp[0].split(",");

        var soggiorni_en_tmp = soggiorni_tmp[1].split(",");

        var soggiorni_fr_tmp = soggiorni_tmp[2].split(",");

        var soggiorni_de_tmp = soggiorni_tmp[3].split(",");   
    
        var soggiorni_es_tmp = soggiorni_tmp[4].split(",");

        var soggiorni_ru_tmp = soggiorni_tmp[5].split(",");

        soggiorni_it_tmp.forEach(function (soggiorni_it) {
            trattamento_params[1]  += '<option value="'+soggiorni_it+'">'+soggiorni_it+'</option>';
        });

        soggiorni_en_tmp.forEach(function(soggiorni_en) {
            trattamento_params[2] += '<option value="' + soggiorni_en + '">' + soggiorni_en + '</option>';   
            trattamento_params[7] += '<option value="' + soggiorni_en + '">' + soggiorni_en + '</option>';
            trattamento_params[8] += '<option value="' + soggiorni_en + '">' + soggiorni_en + '</option>';
            trattamento_params[9] += '<option value="' + soggiorni_en + '">' + soggiorni_en + '</option>';
            trattamento_params[10] += '<option value="' + soggiorni_en + '">' + soggiorni_en + '</option>';
            trattamento_params[11] += '<option value="' + soggiorni_en + '">' + soggiorni_en + '</option>';
            trattamento_params[12] += '<option value="' + soggiorni_en + '">' + soggiorni_en + '</option>';
            trattamento_params[13] += '<option value="' + soggiorni_en + '">' + soggiorni_en + '</option>';
            trattamento_params[14] += '<option value="' + soggiorni_en + '">' + soggiorni_en + '</option>';
            trattamento_params[15] += '<option value="' + soggiorni_en + '">' + soggiorni_en + '</option>';
            
        });       

        soggiorni_fr_tmp.forEach(function(soggiorni_fr) {
            trattamento_params[3]  += '<option value="'+soggiorni_fr+'">'+soggiorni_fr+'</option>';
        });       

        soggiorni_de_tmp.forEach(function(soggiorni_de) {
            trattamento_params[4]  += '<option value="'+soggiorni_de+'">'+soggiorni_de+'</option>';
        });
    
        soggiorni_es_tmp.forEach(function(soggiorni_es) {
            trattamento_params[5]  += '<option value="'+soggiorni_es+'">'+soggiorni_es+'</option>';
        }); 
    
        soggiorni_ru_tmp.forEach(function(soggiorni_ru) {
            trattamento_params[6]  += '<option value="'+soggiorni_ru+'">'+soggiorni_ru+'</option>';
        }); 
    
} else {
 
    var trattamento_params = new Array();
        trattamento_params[1]  = '<option value="Bed & Breakfast">Bed & Breakfast</option><option value="Mezza Pensione">Mezza Pensione</option><option value="Pensione Completa">Pensione Completa</option><option value="All inclusive">All inclusive</option>';
        trattamento_params[2]  = '<option value="Full Board">Full Board</option><option value="Half Board">Half Board</option><option value="Bed & Breakfast">Bed & Breakfast</option>';
        trattamento_params[3]  = '<option value="Pension Complete">Pension Complete</option><option value="Demi-Pension">Demi-Pension</option><option value="Chambre + petit déjeuner">Chambre + petit déjeuner</option>';
        trattamento_params[4]  = '<option value="Vollpension">Vollpension</option><option value="Halbpension">Halbpension</option><option value="Bed & Breakfast">Bed & Breakfast</option>';
        trattamento_params[5]  = '<option value="Alojamiento y desayuno">Alojamiento y desayuno</option><option value="media pensión">media pensión</option><option value="pensión completa">pensión completa</option>';
        trattamento_params[6]  = '<option value="полный пансион">полный пансион</option><option value="полупансион">полупансион</option><option value="кровать и завтрак">кровать и завтрак</option>'; 
        trattamento_params[7]  = '<option value="Full Board">Full Board</option><option value="Half Board">Half Board</option><option value="Bed & Breakfast">Bed & Breakfast</option>';
        trattamento_params[8]  = '<option value="Full Board">Full Board</option><option value="Half Board">Half Board</option><option value="Bed & Breakfast">Bed & Breakfast</option>';
        trattamento_params[9]  = '<option value="Full Board">Full Board</option><option value="Half Board">Half Board</option><option value="Bed & Breakfast">Bed & Breakfast</option>';
        trattamento_params[10] = '<option value="Full Board">Full Board</option><option value="Half Board">Half Board</option><option value="Bed & Breakfast">Bed & Breakfast</option>';
        trattamento_params[11] = '<option value="Full Board">Full Board</option><option value="Half Board">Half Board</option><option value="Bed & Breakfast">Bed & Breakfast</option>';
        trattamento_params[12] = '<option value="Full Board">Full Board</option><option value="Half Board">Half Board</option><option value="Bed & Breakfast">Bed & Breakfast</option>';
        trattamento_params[13] = '<option value="Full Board">Full Board</option><option value="Half Board">Half Board</option><option value="Bed & Breakfast">Bed & Breakfast</option>';
        trattamento_params[14] = '<option value="Full Board">Full Board</option><option value="Half Board">Half Board</option><option value="Bed & Breakfast">Bed & Breakfast</option>';
        trattamento_params[15] = '<option value="Full Board">Full Board</option><option value="Half Board">Half Board</option><option value="Bed & Breakfast">Bed & Breakfast</option>';
  
}

var tipo_camera = new Array();
    tipo_camera[1]  = 'Tipo camera';
    tipo_camera[2]  = 'Room type';
    tipo_camera[3]  = 'Type de chambre';
    tipo_camera[4]  = 'Zimmertyp';
    tipo_camera[5]  = 'Tipo de habitación';
    tipo_camera[6]  = 'Тип комнаты'; 
    tipo_camera[7]  = 'Room type';
    tipo_camera[8]  = 'Room type';
    tipo_camera[9]  = 'Room type';
    tipo_camera[10] = 'Room type';
    tipo_camera[11] = 'Room type';
    tipo_camera[12] = 'Room type';
    tipo_camera[13] = 'Room type';
    tipo_camera[14] = 'Room type';
    tipo_camera[15] = 'Room type';


var camera_params = new Array();
    camera_params[1]  = '<option value="singola">singola</option><option value="doppia uso singolo">doppia uso singolo</option><option value="doppia">doppia</option><option value="matrimoniale">matrimoniale</option><option value="tripla">tripla</option><option value="suite">suite</option>';
    camera_params[2]  = '<option value="single">single</option><option value="double">double</option><option value="triple">triple</option><option value="suite">suite</option>';
    camera_params[3]  = '<option value="simple">simple</option><option value="double">double</option><option value="triple">triple</option><option value="suite">suite</option>';
    camera_params[4]  = '<option value="Einzel">Einzel</option><option value="Doppel">Doppel</option><option value="Dreibettzimmer">Dreibettzimmer</option><option value="Suite">Suite</option>';
    camera_params[5]  = '<option value="individual">individual</option><option value="doble">doble</option><option value="triple">triple</option><option value="suite">suite</option>';
    camera_params[6]  = '<option value="одноместный">одноместный</option><option value="двухместный">двухместный</option><option value="трехместный">трехместный</option><option value="люкс">люкс</option>'; 
    camera_params[7]  = '<option value="single">single</option><option value="double">double</option><option value="triple">triple</option><option value="suite">suite</option>';
    camera_params[8]  = '<option value="single">single</option><option value="double">double</option><option value="triple">triple</option><option value="suite">suite</option>';
    camera_params[9]  = '<option value="single">single</option><option value="double">double</option><option value="triple">triple</option><option value="suite">suite</option>';
    camera_params[10] = '<option value="single">single</option><option value="double">double</option><option value="triple">triple</option><option value="suite">suite</option>';
    camera_params[11] = '<option value="single">single</option><option value="double">double</option><option value="triple">triple</option><option value="suite">suite</option>';
    camera_params[12] = '<option value="single">single</option><option value="double">double</option><option value="triple">triple</option><option value="suite">suite</option>';
    camera_params[13] = '<option value="single">single</option><option value="double">double</option><option value="triple">triple</option><option value="suite">suite</option>';
    camera_params[14] = '<option value="single">single</option><option value="double">double</option><option value="triple">triple</option><option value="suite">suite</option>';
    camera_params[15] = '<option value="single">single</option><option value="double">double</option><option value="triple">triple</option><option value="suite">suite</option>';
  
    
var num_camere = new Array();
    num_camere[1]  = 'Nr.camere';
    num_camere[2]  = 'Nr.Rooms';
    num_camere[3]  = 'Nr.Chambres';
    num_camere[4]  = 'Nr.Zimmer';
    num_camere[5]  = 'Nr.Habitaciones';
    num_camere[6]  = 'Номер комнаты'; 
    num_camere[7]  = 'Nr.Rooms';
    num_camere[8]  = 'Nr.Rooms';
    num_camere[9]  = 'Nr.Rooms';
    num_camere[10] = 'Nr.Rooms';
    num_camere[11] = 'Nr.Rooms';
    num_camere[12] = 'Nr.Rooms';
    num_camere[13] = 'Nr.Rooms';
    num_camere[14] = 'Nr.Rooms';
    num_camere[15] = 'Nr.Rooms';


var first_eta_params = new Array();
    first_eta_params[1]  = 'inferiore ad 1';
    first_eta_params[2]  = 'less than 1';
    first_eta_params[3]  = 'Âge,moins de 1';
    first_eta_params[4]  = 'Alter,weniger als 1';
    first_eta_params[5]  = 'Edad,menos de 1';
    first_eta_params[6]  = 'менее 1';
    first_eta_params[7]  = 'Age,less than 1';
    first_eta_params[8]  = 'Age,less than 1';
    first_eta_params[9]  = 'Age,less than 1';
    first_eta_params[10] = 'Age,less than 1';
    first_eta_params[11] = 'Age,less than 1';
    first_eta_params[12] = 'Age,less than 1';
    first_eta_params[13] = 'Age,less than 1';
    first_eta_params[14] = 'Age,less than 1';
    first_eta_params[15] = 'Age,less than 1';


    var animali_ammessi = new Array();
        animali_ammessi[1]  = '<option value="">Viaggiamo con animali domestici</option>';
        animali_ammessi[2]  = '<option value="">We travel with pets</option>';
        animali_ammessi[3]  = '<option value="">Nous voyageons avec des animaux</option>';
        animali_ammessi[4]  = '<option value="">Wir reisen mit Haustieren</option>';
        animali_ammessi[5]  = '<option value="">Viajamos con mascotas</option>';
        animali_ammessi[6]  = '<option value="">Мы путешествуем с домашними животными</option>'; 
        animali_ammessi[7]  = '<option value="">We travel with pets</option>';
        animali_ammessi[8]  = '<option value="">We travel with pets</option>';
        animali_ammessi[9]  = '<option value="">We travel with pets</option>';
        animali_ammessi[10] = '<option value="">We travel with pets</option>';
        animali_ammessi[11] = '<option value="">We travel with pets</option>';
        animali_ammessi[12] = '<option value="">We travel with pets</option>';
        animali_ammessi[13] = '<option value="">We travel with pets</option>';
        animali_ammessi[14] = '<option value="">We travel with pets</option>';
        animali_ammessi[15] = '<option value="">We travel with pets</option>';

 
    var animali_ammessi_params = new Array();
        animali_ammessi_params[1] = '<option value="1">Si</option><option value=0">No</option>';
        animali_ammessi_params[2] = '<option value="1">Yes</option><option value=0">No</option>';
        animali_ammessi_params[3] = '<option value="1">Oui</option><option value=0">Non</option>';
        animali_ammessi_params[4] = '<option value="1">Ja</option><option value=0">Nein</option>';
        animali_ammessi_params[5] = '<option value="1">Sì</option><option value=0">No</option>';
        animali_ammessi_params[6] = '<option value="1">Ara</option><option value=0">Het</option>';
        animali_ammessi_params[7] = '<option value="1">Yes</option><option value=0">No</option>';
        animali_ammessi_params[8] = '<option value="1">Yes</option><option value=0">No</option>';
        animali_ammessi_params[9] = '<option value="1">Yes</option><option value=0">No</option>';
        animali_ammessi_params[10] = '<option value="1">Yes</option><option value=0">No</option>';
        animali_ammessi_params[11] = '<option value="1">Yes</option><option value=0">No</option>';
        animali_ammessi_params[12] = '<option value="1">Yes</option><option value=0">No</option>';
        animali_ammessi_params[13] = '<option value="1">Yes</option><option value=0">No</option>';
        animali_ammessi_params[14] = '<option value="1">Yes</option><option value=0">No</option>';
        animali_ammessi_params[15] = '<option value="1">Yes</option><option value=0">No</option>';

var required = new Array();
        required[1]  = 'I campi contrassegnati con * sono obbligatori...';
        required[2]  = 'Fields marked with * are required...';
        required[3]  = 'Les champs marqués d\'une * sont obligatoires...';
        required[4]  = 'Felder, die mit * markiert sind, sind Pflichtfelder...';
        required[5]  = 'Los campos marcados con * son obligatorios...';
        required[6]  = 'Поля, помеченные * обязательны к заполнению...';
        required[7]  = 'Fields marked with * are required...';
        required[8]  = 'Fields marked with * are required...';
        required[9]  = 'Fields marked with * are required...';
        required[10] = 'Fields marked with * are required...';
        required[11] = 'Fields marked with * are required...';
        required[12] = 'Fields marked with * are required...';
        required[13] = 'Fields marked with * are required...';
        required[14] = 'Fields marked with * are required...';
        required[15] = 'Fields marked with * are required...';       
         
var placeholder_data_arrivo = new Array();
        placeholder_data_arrivo[1]  = 'Data di Arrivo *';
        placeholder_data_arrivo[2]  = 'Check-in date *';
        placeholder_data_arrivo[3]  = 'Date d\'arrivée *';
        placeholder_data_arrivo[4]  = 'Check-in Datum *';
        placeholder_data_arrivo[5]  = 'Comprobar en la fecha *';
        placeholder_data_arrivo[6]  = 'Дата заезда *';
        placeholder_data_arrivo[7]  = 'Check-in date *';
        placeholder_data_arrivo[8]  = 'Check-in date *';
        placeholder_data_arrivo[9]  = 'Check-in date *';
        placeholder_data_arrivo[10] = 'Check-in date *';
        placeholder_data_arrivo[11] = 'Check-in date *';
        placeholder_data_arrivo[12] = 'Check-in date *';
        placeholder_data_arrivo[13] = 'Check-in date *';
        placeholder_data_arrivo[14] = 'Check-in date *';
        placeholder_data_arrivo[15] = 'Check-in date *';
        
var placeholder_data_partenza = new Array();
        placeholder_data_partenza[1]  = 'Data di Partenza *';
        placeholder_data_partenza[2]  = 'Check-out date *';
        placeholder_data_partenza[3]  = 'Date de départ *';
        placeholder_data_partenza[4]  = 'Check-out Datum *';
        placeholder_data_partenza[5]  = 'Fecha de salida *';
        placeholder_data_partenza[6]  = 'Дата отбытия *';
        placeholder_data_partenza[7]  = 'Check-out date *';
        placeholder_data_partenza[8]  = 'Check-out date *';
        placeholder_data_partenza[9]  = 'Check-out date *';
        placeholder_data_partenza[10] = 'Check-out date *';
        placeholder_data_partenza[11] = 'Check-out date *';
        placeholder_data_partenza[12] = 'Check-out date *';
        placeholder_data_partenza[13] = 'Check-out date *';
        placeholder_data_partenza[14] = 'Check-out date *';
        placeholder_data_partenza[15] = 'Check-out date *';
        
var sendForm = new Array();
        sendForm[1]  = 'Invia Richiesta';
        sendForm[2]  = 'Send Request';
        sendForm[3]  = 'Envoyer une demande';
        sendForm[4]  = 'Anfrage absenden';
        sendForm[5]  = 'Enviar';
        sendForm[6]  = 'Послать запрос';
        sendForm[7]  = 'Send Request';
        sendForm[8]  = 'Send Request';
        sendForm[9]  = 'Send Request';
        sendForm[10] = 'Send Request';
        sendForm[11] = 'Send Request';
        sendForm[12] = 'Send Request';
        sendForm[13] = 'Send Request';
        sendForm[14] = 'Send Request';
        sendForm[15] = 'Send Request';          

var a = 1;
    var NumeroAD ='<option value="">'+adulti[idlang]+'</option>';
    for(a==1; a<=10; a++){
        NumeroAD +='<option value="'+a+'">'+a+'</option>';
    }

var b = 1;
    var NumeroBI ='<option value="">'+bambini[idlang]+'</option>';
    for(b==1; b<=6; b++){
        NumeroBI +='<option value="'+b+'">'+b+'</option>';
    }

var e = 1;
    var NumeroETA ='<option value="">'+etaB[idlang]+'</option>';
NumeroETA += '<option value="' + first_eta_params[idlang] + '">' + first_eta_params[idlang] + '</option>';

    if (EtaBambini == undefined || EtaBambini == '') {
        var etaMax = 16;          
    } else {
        var   etaMax = EtaBambini;
    } 
    
    for(e==1; e<=etaMax; e++){
        NumeroETA +='<option value="'+e+'">'+e+'</option>';
    }

var openForm = '<div class="container"><div class="row">'
                    +'<div class="col-md-12 col-sm-12 col-xs-12">'
                + '<form class="form_quoto" name="form_quoto" id="form_quoto" action="https://www.quotocrm.it/apiForm/send_form.php" method="post" enctype="multipart/form-data">';
                        
var inputHidden = '<input type="hidden" name="oggetto_email" id="oggetto_email" value="Richiesta per ' + sito + '"/>'
                + '<input type="hidden" name="id_sito" id="id_sito" value="' + idsito + '"/>'
                + '<input type="hidden" name="idsito" id="idsito" value="' + idsito + '"/>'
                + '<input type="hidden" name="id_lingua" id="id_lingua" value="' + idlang + '"/>'
                + '<input type="hidden" name="language" id="language" value="' + language + '"/>'
                + '<input type="hidden" name="lang_dizionario" id="lang_dizionario" value="' + language + '"/>'
                + '<input type="hidden" name="id_lang" id="id_lang" value="' + idlang + '"/>'
                + '<input type="hidden" name="captcha" id="captcha" value="' + captcha + '"/>'
                + '<input type="hidden" name="REMOTE_ADDR" id="REMOTE_ADDR" value=""/>'
                + '<input type="hidden" name="HTTP_USER_AGENT" id="HTTP_USER_AGENT" value=""/>'
                + '<input type="hidden" name="urlback" id="urlback" value="' + urlback + '"/>'
                + '<input type="hidden" name="adulti" id="adulti' + idsito + '" value=""/>'
                + '<input type="hidden" name="bambini" id="bambini' + idsito + '" value=""/>'
                + '<input type="hidden" name="utm_source" id="utm_source" value=""/>'
                + '<input type="hidden" name="utm_medium" id="utm_medium" value=""/>'
                + '<input type="hidden" name="utm_campaign" id="utm_campaign" value=""/>'
                + '<input type="hidden" name="HTTP_REFERRER" id="HTTP_REFERRER" value=""/>'
                + '<input type="hidden" name="_ga" id="_ga" value=""/>'
                + '<div id="load_client_id"><input type="hidden" name="CLIENT_ID" value=""></div>'
                + '<input type="hidden" name="action" id="action" value="send"/>';

if (multiStruttura != '') {
    var inputMultiStruttura = '<input type="hidden" name="hotel" id="hotel" value="' + multiStruttura + '"/>';
} else {
    var inputMultiStruttura = '<input type="hidden" name="hotel" id="hotel" value="' + (request_uri == '/'?'':request_uri) + '"/>';
}   
                                  
var inputNome = '<div class="row">'
                    +'<div class="col-md-6 col-sm-6 col-xs-6">'
                        +'<div class="form-group">'
                            +'<input type="text" name="nome" id="nome" class="form-control CheckChange" placeholder="'+ placeholder_nome[idlang] +'" required />'
                        +'</div>'
                    +'</div>';
                 
var inputCognome = '<div class="col-md-6 col-sm-6 col-xs-6">'
                        +'<div class="form-group" >'
                            +'<input type="text" name="cognome" id="cognome" class="form-control CheckChange"  placeholder="'+ placeholder_cognome[idlang] +'" required />'
                        +'</div>'
                    +'</div>'
                + '</div>'
            +'<div class="clearfix p-b-10"></div>';

var inputEmail = '<div class="row">'
                    +'<div class="col-md-6 col-sm-6 col-xs-6">'
                        +'<div class="form-group">'
                            +'<input type="email" name="email" id="email" class="form-control CheckChange"  placeholder="Email *" required />'
                        +'</div>'
                    +'</div>';

var inputTelefono = '<div class="col-md-6 col-sm-6 col-xs-6">'
                        +'<div class="form-group">'
                            +'<input type="number" name="telefono" id="telefono" class="form-control"  placeholder="'+ placeholder_telefono[idlang] +'" />'
                        +'</div>'
                    +'</div>'
                +'</div>'
            +'<div class="clearfix p-b-10"></div>';

var inputDataArrivo = '<div class="row">'
                            +'<div class="col-md-6 col-sm-6 col-xs-6" > '
                                +'<div class="form-group"> '
                                    +'<input type="text" placeholder="'+placeholder_data_arrivo[idlang]+'"  onMouseOver="(this.type= \'date\');(data_partenza.type= \'date\')" name="data_arrivo" id="data_arrivo" class="form-control" min="'+data_oggiQ+'" required /> '
                                +'</div> '
                            +'</div> ';

var inputDataPartenza = '<div class="col-md-6 col-sm-6 col-xs-6">'
                            +'<div class="form-group">'
                                 +'<input type="text" placeholder="'+placeholder_data_partenza[idlang]+'" onMouseOver="(this.type= \'date\')" name="data_partenza" id="data_partenza" class="form-control" min="'+data_oggiQ+'" required  />'
                            +'</div>'
                        +'</div>'
                    + '</div>'
                    +'<div class="clearfix p-b-10"></div>'
                        +'<a href="javascript:;" onclick="aggiungi_date();" id="add_date"><i class="fa fa-fw  fa-plus" aria-hidden="true"></i> '+plus_date[idlang]+'</a>'
                    + '<div class="clearfix p-b-10"></div>';
                    
var inputDataArrivoAlt = '<div id="date_alternative" style="display:none"><div class="row">'
                            +'<div class="col-md-6 col-sm-6 col-xs-6" > '
                                +'<div class="form-group" > '
                                    +'<input type="text" placeholder="'+placeholder_data_arrivo[idlang]+'" onMouseOver="(this.type= \'date\');(DataPartenza.type= \'date\')" name="DataArrivo" id="DataArrivo" class="form-control" min="'+data_oggiQ+'"   /> '
                                +'</div> '
                            +'</div> ';

var inputDataPartenzaAlt = '<div class="col-md-6 col-sm-6 col-xs-6">'
                                + '<div class="form-group">'
                                 + '<input type="text" placeholder="'+placeholder_data_partenza[idlang]+'" onMouseOver="(this.type= \'date\')" name="DataPartenza" id="DataPartenza" class="form-control" min="'+data_oggiQ+'" />'
                                + '</div>'
                            + '</div>'
                        + '</div><div class="clearfix p-b-10"></div></div>';

if (selectAlloggi == 1) {       
    var selAlloggi = '<div class="row">'
                        + '<div class="col-md-4 col-sm-12 col-xs-12"> '
                            + '<div class="form-group">'
                                + '<select name="TipoCamere" id="TipoCamere"  class="form-control">'+alloggi[idlang]+''+alloggi_params[idlang]+'</select>'
                            + '</div>'
                        + '</div>'
                + '</div><div class="clearfix p-b-10"></div>';
} else {
    var selAlloggi = '';
}                       

var selectTrattamenti = '<div class="row">'
                        + '<div class="col-md-4 col-sm-12 col-xs-12"> '
                            + '<div class="form-group">'
                                + '<select name="TipoSoggiorno_1" id="TipoSoggiorno_1_1"  class="form-control CheckChange" required>'+trattamento[idlang]+''+trattamento_params[idlang]+'</select>'
                            + '</div>'                   
                        + '</div>';

var selectAdulti = '<div class="col-md-4 col-sm-12 col-xs-12"> '
                        + '<div class="form-group">'
                            + '<select name="NumAdulti_1" id="NumeroAdulti_1_1" onchange="calcola_totale_adulti('+idsito+');" class="calcolaA form-control CheckChange" required>'+adulti[idlang]+''+NumeroAD+'</select>'
                        + '</div>'                
                    + '</div>';

if (selBambini == 1) {
    var selectBambini = '<div class="col-md-4 col-sm-12 col-xs-12"> '
                            + '<div class="form-group">'
                                + '<select name="NumBambini_1" id="NumeroBambini_1_1" onchange="eta_bimbi(\'1_1\');calcola_totale_bambini(' + idsito + ');" class="calcolaB form-control">' + bambini[idlang] + '' + NumeroBI + '</select>'
                            + '</div>'
                        + '</div>'
                        + '</div><div class="clearfix p-b-10"></div>';
} else {
    var selectBambini = '';
}
var selectEtaB ='<div class="row">'
                    + '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">'
                        + '<div class="row">'
                            + '<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><select class="form-control" id="EtaB1_' + n_proposta + '_' + linea + '" name="EtaB1_' + linea + '" style="display:none" onchange="cambia_prop(' + linea + '_' + n_proposta + '_' + linea + ');">' + NumeroETA + '</select></div>'
                            + '<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><select class="form-control" id="EtaB2_' + n_proposta + '_' + linea + '" name="EtaB2_' + linea + '" style="display:none" onchange="cambia_prop(' + linea + '_' + n_proposta + '_' + linea + ');">' + NumeroETA + '</select></div>'
                            + '<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><select class="form-control" id="EtaB3_' + n_proposta + '_' + linea + '" name="EtaB3_' + linea + '" style="display:none" onchange="cambia_prop(' + linea + '_' + n_proposta + '_' + linea + ');">' + NumeroETA + '</select></div>'
                            + '<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><select class="form-control" id="EtaB4_' + n_proposta + '_' + linea + '" name="EtaB4_' + linea + '" style="display:none" onchange="cambia_prop(' + linea + '_' + n_proposta + '_' + linea + ');">' + NumeroETA + '</select></div>'
                            + '<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><select class="form-control" id="EtaB5_' + n_proposta + '_' + linea + '" name="EtaB5_' + linea + '" style="display:none" onchange="cambia_prop(' + linea + '_' + n_proposta + '_' + linea + ');">' + NumeroETA + '</select></div>'
                            + '<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><select class="form-control" id="EtaB6_' + n_proposta + '_' + linea + '" name="EtaB6_' + linea + '" style="display:none" onchange="cambia_prop(' + linea + '_' + n_proposta + '_' + linea + ');">' + NumeroETA + '</select></div>'
                        + '</div>'
                    + '</div>'
                + '</div><div class="clearfix p-b-10"></div>';


var addCamere =  '<a id="add" href="javascript:;"  onclick="room_fields(1,\'righe_room\');" > <i class="fa fa-fw  fa-plus"></i> '+addC[idlang]+'</a>'
                + '<div id="righe_room" class="form_quoto">&nbsp;</div>';
                    
if (selectAnimali == 1) {       
var selAnimali = '<div class="row">'
                + '<div iv class="col-md-4 col-sm-12 col-xs-12"> '
                    + '<select name="animali_ammessi" id="animali_ammessi"  class="form-control">'+animali_ammessi[idlang]+''+animali_ammessi_params[idlang]+'</select>'
                + '</div>'
            + '</div><div class="clearfix p-b-10"></div>';
} else {
    var selAnimali = '';
}               
var inputNote = '<div class="row">'
                    + '<div class="col-md-12 col-sm-12 col-xs-12">'
                        + '<div class="form-group">'
                            + '<textarea name="messaggio" id="messaggio" class="form-control formatTextarea" placeholder="'+ placeholder_messaggio[idlang] +'" rows="5"></textarea>'
                        + '</div>'
                    + '</div>'
                + '</div>'
            + '<div class="clearfix p-b-10"></div>';
if (campoSconto == 1) {                 
    var inputCodiceSconto = '<div class="row">'
                                + '<div class="col-md-4 col-sm-12 col-xs-12">'
                                    + '<div class="form-group">'
                                        + '<input type="text" name="codice_sconto" id="codice_sconto" class="form-control"  placeholder="'+ placeholder_codice_sconto[idlang] +'" />'
                                    + '</div>'
                                 + '</div>'
                            + '</div><div class="clearfix p-b-10"></div>';
} else {
    var inputCodiceSconto = '';
}     

var inputMarketign = '<div class="row">'
                        + '<div class="col-md-12 col-sm-12 col-xs-12">'
                            + '<div class="form-group">'
                                + '<input type="checkbox" name="marketing" id="marketing" />  '+ marketing[idlang]
                            + '</div>'
                        + '</div>'
                    + '</div>'
                    + '<div class="clearfix p-b-10"></div>';

var inputConsenso = '<div class="" style="position:relative;"><div class="row">'
                        + '<div class="col-md-12 col-sm-12 col-xs-12">'
                            + '<div class="form-group">'
                                + '<input type="checkbox" name="consenso" id="consenso" required /> ' + consenso[idlang]
                                + '</div>'
                            + '</div>'
                        + '</div>'
                    + '</div>'
                    + '<div class="clearfix p-b-20"></div>';

var inputSubmit = '<div class="row">'
                        + '<div class="col-md-12 col-sm-12 col-xs-12">'
                            + '<div class="form-group">'
                                + (captcha == 1 ? '<div id="recaptcha" class="g-recaptcha" data-sitekey="' + ChiaveSitoReCaptcha + '" data-callback="onCompleted" data-size="invisible"></div>' : '')
                                + '<button class="btn btn-success submit" type="submit">'+sendForm[idlang]+'</button>'
                                + '<div id="view_send_form_loading"></div>'
                            + '</div>'
                    + '</div><div class="clearfix p-b-10"></div>';
                                           
var closeForm =         '</form>'
                   +'</div>'
    + '</div></div>';

var campiObbligatori = '<div class="clearfix p-b-10"></div><div class="row"><div class="col-md-12 col-sm-12 col-xs-12">' + required[idlang] + '</div></div><div class="clearfix p-b-10"></div>';  
    
var responseForm = '<div class="responseForm" id="responseForm" style="display:none">'+responseForm[idlang]+'</div>'; 

$("body #WidgetformQuoto").append(
    openForm
    + inputHidden
    + inputMultiStruttura
    + inputNome
    + inputCognome
    + inputEmail
    + inputTelefono
    + inputDataArrivo
    + inputDataPartenza
    + inputDataArrivoAlt
    + inputDataPartenzaAlt
    + selAlloggi
    + selectTrattamenti
    + selectAdulti
    + selectBambini
    + selectEtaB
    + addCamere
    + selAnimali
    + inputNote
    + inputCodiceSconto
    + inputMarketign
    + inputConsenso
    + inputSubmit
    + campiObbligatori
    + closeForm
    + responseForm 
);  

/**
 ** calcolo dell'IP e dello UserAgent
 */
 $.getJSON('https://api.ipify.org?format=jsonp&callback=?', function(data) {
    //console.log(JSON.stringify(data, null, 2));
    var obj = JSON.parse(JSON.stringify(data, null, 2));  
    $("#REMOTE_ADDR").val(obj.ip);
});
    var UserAgent = navigator.userAgent;
    $("#HTTP_USER_AGENT").val(UserAgent);
/**
** CALCOLO DELLA VARIABILE res=sent
*/
var request_tmp = parseURLParams(JSON.stringify(window.location.pathname + window.location.search, null, 2));


if ($.isEmptyObject(request_tmp)) {
   
}else{
    if (request_tmp != 'undefined') {
        var response = request_tmp.res[0];

    }
}

/**
** CALCOLO DEL REFERRER
 *!SCRIVO COOKIE REFERRER
*/
if (leggiCookie('utm_referrer')=='') {
    var ref = ref || []; ref = document.referrer;
    if (ref == '') {
        ref = '/';
    } else {
        ref = ref;
    }
    scriviCookie('utm_referrer', ref, '60');
}
/**
** estraggo UTM REFERRER per la tracciabilità
*/
setTimeout(function(){
    var UTM_REFERRER = leggiCookie("utm_referrer");
    $("#HTTP_REFERRER").val(UTM_REFERRER);
}, 3000);

/**
 ** Aggiungo il check-mark verde agli input
 */
 $(function() {
     $("input, select").each(function() {
        reqs = $(this).attr('required');
        if (reqs != undefined) {
            $('<div class="check_mark" style="display:none">&#10003;</div>').insertBefore(this);
        }
     }); 
     
    $(".form-group").css({ "position": "relative" });

    $(".check_mark").css({
        "position": "absolute",
        "top": "50%",
        "transform": "translateY(-50%)",
        "right": "20px",
        "font-weight": "bold",
        "color": "#008000",
        "font-size": "14px",
        "z-index": "10",
    });

     $(".CheckChange").on("change", function () {
         if ($(this).val().length > 0) {
             console.log($(this).parent().find(".check_mark"));
             $(this).parent().find(".check_mark").show();
         } else {
            $(this).parent().find(".check_mark").hide();
         }
    });
});
/**
** DOPO L'INVIO DEL FORM
*/
if (response == 'sent' || response == 'sent"') {
    /**
    ** estrapolo il numero di prenotazione
    */
    var NumeroPrenotazione_    = request_uri.split('&'); 
    var NumeroPrenotazione__   = NumeroPrenotazione_[1];
    var NumeroPrenotazione_tmp = NumeroPrenotazione__.split('='); 
    var NumeroPrenotazione     = atob(NumeroPrenotazione_tmp[1]);
    /**
    ** evento init per analytics, solo dopo invio del form
    */
    $("#form_quoto").remove(); //nascondo il form
    $("#responseForm").show(); //mostro la response

    $("<script>window.dataLayer = window.dataLayer || [];dataLayer.push({ 'event': 'Init', 'NumeroPrenotazione': '" + NumeroPrenotazione + "#" + idsito + "'});</script>").insertAfter('title');

    /**
     ** funzione per scrollare la pagina fino al form
    */
    function scroll_to_response(id, scarto, tempo) {
        if (scarto === null) {
            scarto = 0;
        }
        if (tempo === null) {
            tempo = 300;
        }
        $("html,body").animate({
            scrollTop: $("#" + id).offset().top - scarto
        }, {
            queue: false,
            duration: tempo
        });
    }
    $(document).ready(function () {
        scroll_to_response("responseForm", 200, 0);
    });

}


/**
 ** comportamento sul pulsante "aggiungi date alternative"
 */
 function aggiungi_date(){

    var attr = $("#date_alternative").attr('style');
    if(attr == 'display:none'){
        $("#date_alternative").attr('style','display:block');
        $("#add_date").html('<i class="fa fa-fw  fa-minus"></i> '+minus_date[idlang]+'');
        }
    if(attr == 'display:block'){
        $("#date_alternative").attr('style','display:none');
        $("#add_date").html('<i class="fa fa-fw  fa-plus"></i> '+plus_date[idlang]+'');
        }

}
/**
 *! calcola totale adulti
 */
 function calcola_totale_adulti(idsito) {
    var totale='';
    $(".calcolaA").each( function() {
        value = new Number($(this).val());
        totale = new Number(totale + value);
        $('#adulti'+idsito).val(totale);
    });
}
/**
 *! calcola totale bambini
 */
function calcola_totale_bambini(idsito) {
    var totaleb='';
    $(".calcolaB").each( function() {
        valueb = new Number($(this).val());
        totaleb = new Number(totaleb + valueb);
        $('#bambini'+idsito).val(totaleb);
    });
}

function eta_bimbi(id){
    /**
     *? ON CLICK in base al nunmero dei bambini selezionati si rendono visibili i campi per età 
    */
    var numero_b = $("#NumeroBambini_"+id+"").val();	
        if(numero_b != ''){	
            if(numero_b >= 1){
                $("#EtaB1_"+id+"").css("display","block");											
                if($("#EtaB1_"+id+"").val()==''){
                    $(".submit").attr('type', 'button');
            }else{
                    $(".submit").attr('type', 'submit');
            }
        }else{
                $("#EtaB1_"+id+"").css("display","none");
                $("#EtaB1_"+id+"").val('');
        }
            if(numero_b >= 2){
                $("#EtaB2_"+id+"").css("display","block");
                if($("#EtaB2_"+id+"").val()==''){
                    $(".submit").attr('type', 'button');
            }else{
                    $(".submit").attr('type', 'submit');
            }
        }else{
                $("#EtaB2_"+id+"").css("display","none");
                $("#EtaB2_"+id+"").val('');
        }
            if(numero_b >= 3){
                $("#EtaB3_"+id+"").css("display","block");
                if($("#EtaB3_"+id+"").val()==''){
                    $(".submit").attr('type', 'button');
            }else{
                    $(".submit").attr('type', 'submit');
            }
        }else{
                $("#EtaB3_"+id+"").css("display","none");
                $("#EtaB3_"+id+"").val('');
        }
            if(numero_b >= 4){
                $("#EtaB4_"+id+"").css("display","block");
                if($("#EtaB4_"+id+"").val()==''){
                    $(".submit").attr('type', 'button');
            }else{
                    $(".submit").attr('type', 'submit');
            }
        }else{
                $("#EtaB4_"+id+"").css("display","none");
                $("#EtaB4_"+id+"").val('');
        }
            if(numero_b >= 5){
                $("#EtaB5_"+id+"").css("display","block");
                if($("#EtaB5_"+id+"").val()==''){
                    $(".submit").attr('type', 'button');
            }else{
                    $(".submit").attr('type', 'submit');
            }
        }else{
                $("#EtaB5_"+id+"").css("display","none");
                $("#EtaB5_"+id+"").val('');
        }
            if(numero_b >= 6){
                $("#EtaB6_"+id+"").css("display","block");
                if($("#EtaB6_"+id+"").val()==''){
                    $(".submit").attr('type', 'button');
            }else{
                    $(".submit").attr('type', 'submit');
            }
        }else{
                $("#EtaB6_"+id+"").css("display","none");
                $("#EtaB6_"+id+"").val('');
        }
    }else{
            $("#EtaB1_"+id+"").css("display","none");
            $("#EtaB1_"+id+"").val('');
            $("#EtaB2_"+id+"").css("display","none");
            $("#EtaB2_"+id+"").val('');
            $("#EtaB3_"+id+"").css("display","none");
            $("#EtaB3_"+id+"").val('');
            $("#EtaB4_"+id+"").css("display","none");
            $("#EtaB4_"+id+"").val('');
            $("#EtaB5_"+id+"").css("display","none");
            $("#EtaB5_"+id+"").val('');
            $("#EtaB6_"+id+"").css("display","none");
            $("#EtaB6_"+id+"").val('');
            $(".submit").attr('type', 'submit');
    }
}
function view_bimbi(id){
    var numero_b = $("#NumeroBambini_1_"+id+"").val();
        if(numero_b != ''){												
            if(numero_b >= 1){
                $("#EtaB1_1_"+id+"").css("display","block");
        }else{
                $("#EtaB1_1_"+id+"").css("display","none");
                $("#EtaB1_1_"+id+"").val('');
        }
            if(numero_b >= 2){
                $("#EtaB2_1_"+id+"").css("display","block");
        }else{
                $("#EtaB2_1_"+id+"").css("display","none");
                $("#EtaB2_1_"+id+"").val('');
        }
            if(numero_b >= 3){
                $("#EtaB3_1_"+id+"").css("display","block");
        }else{
                $("#EtaB3_1_"+id+"").css("display", "none");
                $("#EtaB3_1_"+id+"").val('');
        }
            if(numero_b >= 4){
                $("#EtaB4_1_"+id+"").css("display","block");
        }else{
                $("#EtaB4_1_"+id+"").css("display","none");
                $("#EtaB4_1_"+id+"").val('');
        }
            if(numero_b >= 5){
                $("#EtaB5_1_"+id+"").css("display","block");
        }else{
                $("#EtaB5_1_"+id+"").css("display","none");
                $("#EtaB5_1_"+id+"").val('');
        }
            if(numero_b >= 6){
                $("#EtaB6_1_"+id+"").css("display","block");
        }else{
                $("#EtaB6_1_"+id+"").css("display","none");
                $("#EtaB6_1_"+id+"").val('');
        }
    }else{
            $("#EtaB1_1_"+id+"").css("display","none");
            $("#EtaB1_1_"+id+"").val('');
            $("#EtaB2_1_"+id+"").css("display","none");
            $("#EtaB2_1_"+id+"").val('');
            $("#EtaB3_1_"+id+"").css("display","none");
            $("#EtaB3_1_"+id+"").val('');
            $("#EtaB4_1_"+id+"").css("display","none");
            $("#EtaB4_1_"+id+"").val('');
            $("#EtaB5_1_"+id+"").css("display","none");
            $("#EtaB5_1_"+id+"").val('');
            $("#EtaB6_1_"+id+"").css("display","none");
            $("#EtaB6_1_"+id+"").val('');
    }
}								


function cambia_prop(id) {
    var numero_bambini = $("#NumeroBambini_1_1").val();
    if(numero_bambini == 1){
        var eta = $("#EtaB"+id+"").val();
        if(eta == ''){
            $(".submit").attr('type', 'button');
        }else{
            $(".submit").attr('type', 'submit');
        }
    }else if(numero_bambini == 2){
        var eta1 = $("#EtaB1_1_1").val();
        var eta2 = $("#EtaB2_1_1").val();
        if(eta1 == '' || eta2 ==''){
            $(".submit").attr('type', 'button');
        }else{
            $(".submit").attr('type', 'submit');
        }
    }else if(numero_bambini == 3){
        var eta1 = $("#EtaB1_1_1").val();
        var eta2 = $("#EtaB2_1_1").val();
        var eta3 = $("#EtaB3_1_1").val();
        if(eta1 == '' || eta2 == '' || eta3 == ''){
            $(".submit").attr('type', 'button');
        }else{
            $(".submit").attr('type', 'submit');
        }
    }else if(numero_bambini == 4){
        var eta1 = $("#EtaB1_1_1").val();
        var eta2 = $("#EtaB2_1_1").val();
        var eta3 = $("#EtaB3_1_1").val();
        var eta4 = $("#EtaB4_1_1").val();
        if(eta1 == '' || eta2 == '' || eta3 == '' || eta4 == ''){
            $(".submit").attr('type', 'button');
        }else{
            $(".submit").attr('type', 'submit');
        }
    }else if(numero_bambini == 5){
        var eta1 = $("#EtaB1_1_1").val();
        var eta2 = $("#EtaB2_1_1").val();
        var eta3 = $("#EtaB3_1_1").val();
        var eta4 = $("#EtaB4_1_1").val();
        var eta5 = $("#EtaB5_1_1").val();
        if(eta1 == '' || eta2 == '' || eta3 == '' || eta4 == '' || eta5 == ''){
            $(".submit").attr('type', 'button');
        }else{
            $(".submit").attr('type', 'submit');
        }
    }else if(numero_bambini == 6){
        var eta1 = $("#EtaB1_1_1").val();
        var eta2 = $("#EtaB2_1_1").val();
        var eta3 = $("#EtaB3_1_1").val();
        var eta4 = $("#EtaB4_1_1").val();
        var eta5 = $("#EtaB5_1_1").val();
        var eta6 = $("#EtaB6_1_1").val();
        if(eta1 == '' || eta2 == '' || eta3 == '' || eta4 == '' || eta5 == '' || eta6 == ''){
            $(".submit").attr('type', 'button');
        }else{
            $(".submit").attr('type', 'submit');
        }
    }
} 



var linea = 1;

function room_fields(n_proposta,id) {

    linea++;
    var objTo = document.getElementById(id)
    var divtest = document.createElement("div");
    divtest.setAttribute("class","removeclass" + linea);
    var rdiv = "removeclass" + linea;

    if(linea <= 3){
            divtest.innerHTML = '<div class="clearfix p-b-10"></div>'
                                +'<div class="row">'
                                +'<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"><select class="form-control" name="TipoSoggiorno_' + linea + '" id="TipoSoggiorno_' + n_proposta + '_' + linea + '">'+trattamento[idlang]+''+trattamento_params[idlang]+'</select></div>'
                                +'<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"><select class="form-control calcolaA" name="NumAdulti_' + linea + '" id="NumeroAdulti_' + n_proposta + '_' + linea + '"  onchange="calcola_totale_adulti('+idsito+');">'+NumeroAD+'</select></div>'
                                +(selBambini == 1 ?'<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"><select class="form-control calcolaB" name="NumBambini_' + linea + '"  id="NumeroBambini_' + n_proposta + '_' + linea + '"  onchange="view_bimbi('+linea+');calcola_totale_bambini('+idsito+');">'+NumeroBI+'</select></div>':'')                        
                                +'</div>'
                                +'<div class="clearfix p-b-10"></div>'
                                +'<div class="row">'
                                +'<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">'
                                +'<div class="row">'
                                +'<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><select class="form-control" id="EtaB1_' + n_proposta + '_' + linea + '" name="EtaB1_' + linea + '" style="display:none" onchange="cambia_prop(' + linea + '_' + n_proposta + '_' + linea + ');">'+NumeroETA+'</select></div>'
                                +'<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><select class="form-control" id="EtaB2_' + n_proposta + '_' + linea + '" name="EtaB2_' + linea + '" style="display:none" onchange="cambia_prop(' + linea + '_' + n_proposta + '_' + linea + ');">'+NumeroETA+'</select></div>'
                                +'<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><select class="form-control" id="EtaB3_' + n_proposta + '_' + linea + '" name="EtaB3_' + linea + '" style="display:none" onchange="cambia_prop(' + linea + '_' + n_proposta + '_' + linea + ');">'+NumeroETA+'</select></div>'
                                +'<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><select class="form-control" id="EtaB4_' + n_proposta + '_' + linea + '" name="EtaB4_' + linea + '" style="display:none" onchange="cambia_prop(' + linea + '_' + n_proposta + '_' + linea + ');">'+NumeroETA+'</select></div>'
                                +'<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><select class="form-control" id="EtaB5_' + n_proposta + '_' + linea + '" name="EtaB5_' + linea + '" style="display:none" onchange="cambia_prop(' + linea + '_' + n_proposta + '_' + linea + ');">'+NumeroETA+'</select></div>'
                                +'<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><select class="form-control" id="EtaB6_' + n_proposta + '_' + linea + '" name="EtaB6_' + linea + '" style="display:none" onchange="cambia_prop(' + linea + '_' + n_proposta + '_' + linea + ');">'+NumeroETA+'</select></div>'
                                +'</div>'
                                +'</div>'
                                +'</div>'
                                +'<div class="clearfix p-b-10"></div>'
                                +'<a id="re" href="javascript:;"  onclick="remove_room_fields(' + linea + ');"><i class="fa fa-fw  fa-minus"></i> '+rem_room[idlang]+'</a>'
                                +'<div class="clearfix p-b-10"></div>';
    }
    objTo.appendChild(divtest);

}

function remove_room_fields(rid) {
    $(".removeclass" + rid).remove();

}


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

function write_client_id(){
        setTimeout(function(){
            var CLIENT_ID_ = leggiCookie("_ga");
            var CLIENT_ID_tmp =  CLIENT_ID_.split(".");
            var CLIENT_ID = CLIENT_ID_tmp[2]+"."+CLIENT_ID_tmp[3];
            $("#load_client_id").html('<input type="hidden" name="CLIENT_ID" value="'+CLIENT_ID+'" />');
    },
    3000);
}    
/* scrivi cookie */
function scriviCookie(nomeCookie, valoreCookie, durataCookie) {
    var scadenza = new Date();
    var adesso = new Date();
    scadenza.setTime(adesso.getTime() + (parseInt(durataCookie) * 60000));
    document.cookie = nomeCookie + '=' + escape(valoreCookie) + '; expires=' + scadenza.toGMTString() + '; path = /';
}
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