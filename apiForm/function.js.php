<? if($_REQUEST['res'] == 'sent'){ ?>
    <script id="pushDataLayerQuoto">
        window.dataLayer = window.dataLayer || []; 
        dataLayer.push({'event': 'Init', 'NumeroPrenotazione': '<?=$_REQUEST['NumeroPrenotazione']?>#<?=$_REQUEST['idsito']?>'});
    </script>
<?}?>

<script type="text/javascript" defer>
   <? if($_REQUEST['res'] == 'sent'){ ?>

            /**
            ** evento push per analytics spostato in alto nel HEAD
            */
            $("#pushDataLayerQuoto").insertAfter('title');

                $(function() {
                    function session_clear_all() {
                        sessionStorage.clear();
                        $(".form_quoto input[name='nome']").val(sessionStorage.getItem("quoto_nome"));
                        $(".form_quoto input[name='cognome']").val(sessionStorage.getItem("quoto_cognome"));
                        $(".form_quoto input[name='email']").val(sessionStorage.getItem("quoto_email"));
                        $(".form_quoto input[name='telefono']").val(sessionStorage.getItem("quoto_telefono"));
                        $(".form_quoto input[name='data_arrivo']").val(sessionStorage.getItem("quoto_data_arrivo"));
                        $(".form_quoto input[name='data_partenza']").val(sessionStorage.getItem("quoto_data_partenza"));
                        $(".form_quoto textarea[name='messaggio']").val(sessionStorage.getItem("quoto_messaggio"));
                        $(".form_quoto select[name='TipoSoggiorno_1']").val(sessionStorage.getItem("quoto_TipoSoggiorno_1")).attr('');
                        $(".form_quoto select[name='NumAdulti_1']").val(sessionStorage.getItem("NumAdulti_1")).attr('');
                        $(".form_quoto select[name='NumBambini_1']").val(sessionStorage.getItem("NumBambini_1")).attr('');
                    }
                    session_clear_all();
                });

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
                $(document).ready(function(){
                    scroll_to_response("responseForm", 200, 0);
                });

    <?}?>
</script>
<?php
    /**
     ** imposto alcune variabili utili
    */
    $sito 			 = $idsito;
    $type 			 = $captcha;
    $lang_dizionario = $language;

    switch($language){
        case 'it':
                    $id_lang = 1;
            break;
        case 'en':
                    $id_lang = 2;
            break;
        case 'fr':
                    $id_lang = 3;
            break;
        case 'de':	
                    $id_lang = 4;
            break;
        case 'es':	
                $id_lang = 5;
            break;
        case 'ru':	
                $id_lang = 6;
            break;
        default:
                    $id_lang = 2;
            break;
    }

    $k   = $id_lang; 
	/**
    *? Query e ciclo per estrapolare i dati di tipologia camere
    */ 
    $rw = "SELECT hospitality_camere_testo.*
    FROM hospitality_camere_testo
    INNER JOIN hospitality_tipo_camere on hospitality_tipo_camere.Id = hospitality_camere_testo.camere_id
    WHERE hospitality_camere_testo.idsito = ".$sito."
    AND hospitality_camere_testo.lingue = '". $lang_dizionario ."'
    AND hospitality_tipo_camere.idsito = ".$sito."
    AND hospitality_tipo_camere.Abilitato_form = 1
    ORDER BY hospitality_camere_testo.Camera ASC";
$result = $DB_QUOTO->query($rw);
$tot_camere = sizeof($result);
if($tot_camere>0){

foreach($result as $key => $val){
    
    $camera_params .= '<option value="'.$val['Camera'].'">'.$val['Camera'].'</option>';
}
}
	
/**
*? Query e ciclo per estrapolare i dati di tipologia soggiorno
*/ 

$row = "SELECT hospitality_tipo_soggiorno_lingua.*
    FROM hospitality_tipo_soggiorno_lingua
    INNER JOIN hospitality_tipo_soggiorno on hospitality_tipo_soggiorno.Id = hospitality_tipo_soggiorno_lingua.soggiorni_id
    WHERE hospitality_tipo_soggiorno_lingua.idsito = ".$sito."
    AND hospitality_tipo_soggiorno_lingua.lingue = '". $lang_dizionario ."'
    AND hospitality_tipo_soggiorno.idsito = ".$sito."
    AND hospitality_tipo_soggiorno.Abilitato_form = 1
    ORDER BY hospitality_tipo_soggiorno_lingua.Soggiorno ASC";
$record = $DB_QUOTO->query($row);
$tot_soggiorni = sizeof($record);
if($tot_soggiorni>0){

foreach($record as $chiave => $valore){

    $trattamento_params .= '<option value="'.mini_clean($valore['Soggiorno']).'">'.mini_clean($valore['Soggiorno']).'</option>';

}
}

$z = 1;
for($z==1; $z<=10; $z++){
$NumeriC .='<option value="'.$z.'">'.$z.'</option>';
}
$a = 1;
for($a==1; $a<=20; $a++){
$NumeriAD .='<option value="'.$a.'">'.$a.'</option>';
}

$x = 1;
for($x==1; $x<=6; $x++){
$NumeriBimbi .='<option value="'.$x.'">'.$x.'</option>';
}
/** 
** dichiarazione delle variabili coem arry per pre-compilare il form
*! variabili utile per la creazione dinamica dei form dedicati a quoto
*/

        $rem_room = array(
                        1=>'rimuovi camera',
                        2=>'remove room',
                        3=>'retirer la pièce',
                        4=>'Raum entfernen',
                        5=>'quitar habitación',
                        6=>'удалить комнату',
                        7=>'remove room',
                        8=>'remove room',
                        9=>'remove room',
                        10=>'remove room',
                        11=>'remove room',
                        12=>'remove room',
                        13=>'remove room',
                        14=>'remove room',
                        15=>'remove room',
                        16=>'remove room'
                    );	

        $plus_date = array(
                            1=>'aggiungi date alternative',
                            2=>'add alternative dates',
                            3=>'ajouter des dates alternatives',
                            4=>'Alternative Ankunft',
                            5=>'agregar fechas alternativas',
                            6=>'добавить альтернативные даты', 
                            7=>'add alternative dates',
                            8=>'add alternative dates',
                            9=>'add alternative dates',
                            10=>'add alternative dates',
                            11=>'add alternative dates',
                            12=>'add alternative dates',
                            13=>'add alternative dates',
                            14=>'add alternative dates',
                            15=>'add alternative dates',
                            16=>'add alternative dates'
                        );

        $minus_date = array(
                            1=>'elimina date alternative',
                            2=>'delete alternative dates',
                            3=>'supprimer des dates alternatives',
                            4=>'alternative Daten löschen',
                            5=>'eliminar fechas alternativas',
                            6=>'удалить альтернативные даты', 
                            7=>'delete alternative dates',
                            8=>'delete alternative dates',
                            9=>'delete alternative dates',
                            10=>'delete alternative dates',
                            11=>'delete alternative dates',
                            12=>'delete alternative dates',
                            13=>'delete alternative dates',
                            14=>'delete alternative dates',
                            15=>'delete alternative dates',
                            16=>'delete alternative dates'
                        );
                        
        $adulti = array(
                        1=>'Adulti',
                        2=>'Adults',
                        3=>'Adultes',
                        4=>'Erwachsene',
                        5=>'Adultos',
                        6=>urlencode('Взрослые'),
                        7=>'Adults',
                        8=>'Adults',
                        9=>'Adults',
                        10=>'Adults',
                        11=>'Adults',
                        12=>'Adults',
                        13=>'Adults',
                        14=>'Adults',
                        15=>'Adults',
                        16=>'Adults'
                    );
        $bambini = array(
                            1=>'Bambini',
                            2=>'Children',
                            3=>'Enfants',
                            4=>'Kinder',
                            5=>'Niños',
                            6=>urlencode('Дети'), 
                            7=>'Children',
                            8=>'Children',
                            9=>'Children',
                            10=>'Children',
                            11=>'Children',
                            12=>'Children',
                            13=>'Children',
                            14=>'Children',
                            15=>'Children',
                            16=>'Children'
                        );
        $etaB = array(
                            1=>'Età',
                            2=>'Age',
                            3=>'Âge',
                            4=>'Alter',
                            5=>'Edad',
                            6=>urlencode('Возраст'),
                            7=>'Age',
                            8=>'Age',
                            9=>'Age',
                            10=>'Age',
                            11=>'Age',
                            12=>'Age',
                            13=>'Age',
                            14=>'Age',
                            15=>'Age',
                            16=>'Age'
                        );
        $trattamento 	= array(
                            1=>'Trattamento',
                            2=>'Treatment',
                            3=>'Traitement',
                            4=>'Behandlung',
                            5=>'Tratamiento',
                            6=>urlencode('лечение'), 
                            7=>'Treatment',
                            8=>'Treatment',
                            9=>'Treatment',
                            10=>'Treatment',
                            11=>'Treatment',
                            12=>'Treatment',
                            13=>'Treatment',
                            14=>'Treatment',
                            15=>'Treatment',
                            16=>'Treatment'
                        );

    $tipo_vacanza 	= array(
                            1=>'Tipo vacanza',
                            2=>'Vacation type',
                            3=>'Type de vacances',
                            4=>'Urlaubsart',
                            5=>'Tipo de vacaciones',
                            6=>urlencode('Тип отдыха'), 
                            7=>'Vacation type',
                            8=>'Vacation type',
                            9=>'Vacation type',
                            10=>'Vacation type',
                            11=>'Vacation type',
                            12=>'Vacation type',
                            13=>'Vacation type',
                            14=>'Vacation type',
                            15=>'Vacation type',
                            16=>'Vacation type'
                        );
                    
    $tipo_camera 	= array(
                            1=>'Tipo camera',
                            2=>'Room type',
                            3=>'Type de chambre',
                            4=>'Zimmertyp',
                            5=>'Tipo de habitación',
                            6=>urlencode('Тип комнаты'), 
                            7=>'Room type',
                            8=>'Room type',
                            9=>'Room type',
                            10=>'Room type',
                            11=>'Room type',
                            12=>'Room type',
                            13=>'Room type',
                            14=>'Room type',
                            15=>'Room type',
                            16=>'Room type'
                        );

    $num_camere 	= array(
                            1=>'Nr.camere',
                            2=>'Nr.Rooms',
                            3=>'Nr.Chambres',
                            4=>'Nr.Zimmer',
                            5=>'Nr.Habitaciones',
                            6=>urlencode('Номер комнаты'), 
                            7=>'Nr.Rooms',
                            8=>'Nr.Rooms',
                            9=>'Nr.Rooms',
                            10=>'Nr.Rooms',
                            11=>'Nr.Rooms',
                            12=>'Nr.Rooms',
                            13=>'Nr.Rooms',
                            14=>'Nr.Rooms',
                            15=>'Nr.Rooms',
                            16=>'Nr.Rooms'
                        );

    $eta_params = array(
                            1=>'Età,inferiore ad 1,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16',
                            2=>'Age,less than 1,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16',
                            3=>'Âge,moins de 1,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16',
                            4=>'Alter,weniger als 1,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16',
                            5=>'Edad,menos de 1,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16',
                            6=>urlencode('Возраст,менее 1,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16'),
                            7=>'Age,less than 1,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16',
                            8=>'Age,less than 1,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16',
                            9=>'Age,less than 1,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16',
                            10=>'Age,less than 1,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16',
                            11=>'Age,less than 1,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16',
                            12=>'Age,less than 1,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16',
                            13=>'Age,less than 1,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16',
                            14=>'Age,less than 1,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16',
                            15=>'Age,less than 1,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16',
                            16=>'Age,less than 1,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16'
                        );

    $first_eta_params = array(
                            1=>'inferiore ad 1',
                            2=>'less than 1',
                            3=>'Âge,moins de 1',
                            4=>'Alter,weniger als 1',
                            5=>'Edad,menos de 1',
                            6=>'менее 1',
                            7=>'Age,less than 1',
                            8=>'Age,less than 1',
                            9=>'Age,less than 1',
                            10=>'Age,less than 1',
                            11=>'Age,less than 1',
                            12=>'Age,less than 1',
                            13=>'Age,less than 1',
                            14=>'Age,less than 1',
                            15=>'Age,less than 1',
                            16=>'Age,less than 1'
                        );

        $c = 1;
        $NumeroC .='<option value="">'.$num_camere[$k].'</option>';
        for($c==1; $c<=10; $c++){
            $NumeroC .='<option value="'.$c.'">'.$c.'</option>';
        }
    
        $a = 1;
        $NumeroAD .='<option value="">'.$adulti[$k].'</option>';
        for($a==1; $a<=10; $a++){
            $NumeroAD .='<option value="'.$a.'">'.$a.'</option>';
        }

        $b = 1;
        $NumeroBI .='<option value="">'.$bambini[$k].'</option>';
        for($b==1; $b<=6; $b++){
            $NumeroBI .='<option value="'.$b.'">'.$b.'</option>';
        }

        $e = 1;
        $NumeroETA .='<option value="">'.$etaB[$k].'</option>';
        $NumeroETA .='<option value="'.$first_eta_params[$k].'">'.$first_eta_params[$k].'</option>';
        for($e==1; $e<=16; $e++){
            $NumeroETA .='<option value="'.$e.'">'.$e.'</option>';
        }


?>

<script type="text/javascript" defer>
    $(function() {
	/**
     ** dichiarazione del datepicker
    */
    var cal_start = "input[name*='data_arrivo']";
    var cal_end = "input[name*='data_partenza']";
    var dates = $(cal_start + "," + cal_end).datepicker({
    defaultDate: "+7",
    onSelect: function(selectedDate) {
        if (this.id.indexOf('data_arrivo') > -1) {
        var date = $(cal_start).datepicker('getDate', '+1d');
        date.setDate(date.getDate() + 1);
        $(cal_end).datepicker('setDate', date);
        $(cal_end).datepicker("option", "minDate", date);
        }
           
        if($(this).val != ''){
            $(this).parent().find('.input-alert').remove();
            $(this).parent().prepend('<span class="input-alert2"><i class="fa fa-check"></i></span>');
        }

        }
    });

    var cal_start2 = "input[name*='DataArrivo']";
    var cal_end2 = "input[name*='DataPartenza']";
    var dates2 = $(cal_start2 + "," + cal_end2).datepicker({
    defaultDate: "+7",
    onSelect: function(selectedDate) {
        if (this.id.indexOf('DataArrivo') > -1) {
        var date2 = $(cal_start2).datepicker('getDate', '+1d');
        date2.setDate(date2.getDate() + 1);
        $(cal_end2).datepicker('setDate', date2);
        $(cal_end2).datepicker("option", "minDate", date2);
        }
    }
    });

});
/**
 ** funzione per equalizzare  i box
 */
function EQ(id) {
    wWindow = $(window).width();
    HEQ = 0;
    $('.' + id).css({
        'height': 'auto'
    });
    $('.' + id).each(function() {

        HID = $(this).outerHeight();
        if (HID > HEQ) {
            HEQ = HID;
        }
    });
    $('.' + id).css({
        'height': HEQ
    });
}
function EQR() {
    EQ('m-eq');
    EQ('m-eq1');
    EQ('m-eq2');
    EQ('m-eq3');
    EQ('m-eq4');
    EQ('m-eq5');
    EQ('m-eq6');
    EQ('m-eq7');
    EQ('m-eq8');
    EQ('m-eq9');
    EQ('m-eq10');
    EQ('m-eq11');
    EQ('m-eq12');
    EQ('m-eq13');
    EQ('m-eq14');
    EQ('m-eq15');
    EQ('m-eq16');
    EQ('m-eq17');
    EQ('m-eq18');
    EQ('m-eq19');
    EQ('m-eq20');
    EQ('olm-eq');
    EQ('footer-eq2');
    EQ('footer-eq');
    EQ('bnf-eq');
    EQ('bnfb-eq');
    EQ('bnfb-eq2');
    EQ('pg-eq');
    EQ('olm-eq');
    EQ('m-eqcam');
    EQ('bol-eq');
}
$(document).ready(function() {
/**
 ** comportamento sul pulsante "aggiungi date alternative"
 */
    $("#plus_date").on('click',function() {
        var attr = $("#date_alternative").attr('style');
        if(attr == 'display:none'){
            $("#date_alternative").attr('style','display:block');
            $("#plus_date").html('<i class="fa fa-fw  fa-minus"></i> <?=$minus_date[$k]?>');
        }
        if(attr == 'display:block'){
            $("#date_alternative").attr('style','display:none');
            $("#plus_date").html('<i class="fa fa-fw  fa-plus"></i> <?=$plus_date[$k]?>');
        }
        EQR();
    });
/**
 ** controllo degli input per validazione
 */
    $(".SW-submit").on('click',function() {
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

});
/**
 *! calcola totale adulti
 */
function calcola_totale_adulti(lineaA) {
    var totale='';
    $(".calcolaA").each( function() {
        value = new Number($(this).val());
        totale = new Number(totale + value);
        $('#adulti<?=$sito?>').val(totale);
    });
}
/**
 *! calcola totale bambini
 */
function calcola_totale_bambini(lineaB) {
    var totaleb='';
    $(".calcolaB").each( function() {
        valueb = new Number($(this).val());
        totaleb = new Number(totaleb + valueb);
        $('#bambini<?=$sito?>').val(totaleb);
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
                    $(".SW-submit").attr('type', 'button');
                }else{
                    $(".SW-submit").attr('type', 'submit');
                }
            }else{
                $("#EtaB1_"+id+"").css("display","none");
                $("#EtaB1_"+id+"").val('');
            }
            if(numero_b >= 2){
                $("#EtaB2_"+id+"").css("display","block");
                if($("#EtaB2_"+id+"").val()==''){
                    $(".SW-submit").attr('type', 'button');
                }else{
                    $(".SW-submit").attr('type', 'submit');
                }
            }else{
                $("#EtaB2_"+id+"").css("display","none");
                $("#EtaB2_"+id+"").val('');
            }
            if(numero_b >= 3){
                $("#EtaB3_"+id+"").css("display","block");
                if($("#EtaB3_"+id+"").val()==''){
                    $(".SW-submit").attr('type', 'button');
                }else{
                    $(".SW-submit").attr('type', 'submit');
                }
            }else{
                $("#EtaB3_"+id+"").css("display","none");
                $("#EtaB3_"+id+"").val('');
            }
            if(numero_b >= 4){
                $("#EtaB4_"+id+"").css("display","block");
                if($("#EtaB4_"+id+"").val()==''){
                    $(".SW-submit").attr('type', 'button');
                }else{
                    $(".SW-submit").attr('type', 'submit');
                }
            }else{
                $("#EtaB4_"+id+"").css("display","none");
                $("#EtaB4_"+id+"").val('');
            }
            if(numero_b >= 5){
                $("#EtaB5_"+id+"").css("display","block");
                if($("#EtaB5_"+id+"").val()==''){
                    $(".SW-submit").attr('type', 'button');
                }else{
                    $(".SW-submit").attr('type', 'submit');
                }
            }else{
                $("#EtaB5_"+id+"").css("display","none");
                $("#EtaB5_"+id+"").val('');
            }
            if(numero_b >= 6){
                $("#EtaB6_"+id+"").css("display","block");
                if($("#EtaB6_"+id+"").val()==''){
                    $(".SW-submit").attr('type', 'button');
                }else{
                    $(".SW-submit").attr('type', 'submit');
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
            $(".SW-submit").attr('type', 'submit');
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
                $("#EtaB3_1_"+id+"").css("display","none");
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
            $(".SW-submit").attr('type', 'button');
        }else{
            $(".SW-submit").attr('type', 'submit');
        }
    }else if(numero_bambini == 2){
        var eta1 = $("#EtaB1_1_1").val();
        var eta2 = $("#EtaB2_1_1").val();
        if(eta1 == '' || eta2 ==''){
            $(".SW-submit").attr('type', 'button');
        }else{
            $(".SW-submit").attr('type', 'submit');
        }
    }else if(numero_bambini == 3){
        var eta1 = $("#EtaB1_1_1").val();
        var eta2 = $("#EtaB2_1_1").val();
        var eta3 = $("#EtaB3_1_1").val();
        if(eta1 == '' || eta2 == '' || eta3 == ''){
            $(".SW-submit").attr('type', 'button');
        }else{
            $(".SW-submit").attr('type', 'submit');
        }
    }else if(numero_bambini == 4){
        var eta1 = $("#EtaB1_1_1").val();
        var eta2 = $("#EtaB2_1_1").val();
        var eta3 = $("#EtaB3_1_1").val();
        var eta4 = $("#EtaB4_1_1").val();
        if(eta1 == '' || eta2 == '' || eta3 == '' || eta4 == ''){
            $(".SW-submit").attr('type', 'button');
        }else{
            $(".SW-submit").attr('type', 'submit');
        }
    }else if(numero_bambini == 5){
        var eta1 = $("#EtaB1_1_1").val();
        var eta2 = $("#EtaB2_1_1").val();
        var eta3 = $("#EtaB3_1_1").val();
        var eta4 = $("#EtaB4_1_1").val();
        var eta5 = $("#EtaB5_1_1").val();
        if(eta1 == '' || eta2 == '' || eta3 == '' || eta4 == '' || eta5 == ''){
            $(".SW-submit").attr('type', 'button');
        }else{
            $(".SW-submit").attr('type', 'submit');
        }
    }else if(numero_bambini == 6){
        var eta1 = $("#EtaB1_1_1").val();
        var eta2 = $("#EtaB2_1_1").val();
        var eta3 = $("#EtaB3_1_1").val();
        var eta4 = $("#EtaB4_1_1").val();
        var eta5 = $("#EtaB5_1_1").val();
        var eta6 = $("#EtaB6_1_1").val();
        if(eta1 == '' || eta2 == '' || eta3 == '' || eta4 == '' || eta5 == '' || eta6 == ''){
            $(".SW-submit").attr('type', 'button');
        }else{
            $(".SW-submit").attr('type', 'submit');
        }
    }
} 


var linea = 1;

function room_fields(n_proposta,id) {

    linea++;
    var objTo = document.getElementById(id)
    var divtest = document.createElement("div");
    divtest.setAttribute("class", "removeclass" + linea);
    var rdiv = "removeclass" + linea;

    if(linea <= 5){
            divtest.innerHTML = '<div class="clearfix"></div>'
                                +'<div class="row">'
                                +'<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"><select class="form-control" name="TipoSoggiorno_' + linea + '" id="TipoSoggiorno_' + n_proposta + '_' + linea + '"><option value=""><?=$trattamento[$k]?></option><?=$trattamento_params?></select></div>'
                                +'<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"><select class="form-control calcolaA" name="NumAdulti_' + linea + '" id="NumeroAdulti_' + n_proposta + '_' + linea + '"  onchange="calcola_totale_adulti();"><?=$NumeroAD?></select></div>'
                                +'<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"><select class="form-control calcolaB" name="NumBambini_' + linea + '"  id="NumeroBambini_' + n_proposta + '_' + linea + '"  onchange="view_bimbi('+linea+');calcola_totale_bambini();"><?=$NumeroBI?></select></div>'                        
                                +'</div>'
                                +'<div class="clearfix"></div>'
                                +'<div class="row">'
                                +'<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">'
                                +'<div class="row">'
                                +'<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><select class="form-control" id="EtaB1_' + n_proposta + '_' + linea + '" name="EtaB1_' + linea + '" style="display:none" onchange="cambia_prop(' + linea + '_' + n_proposta + '_' + linea + ');"><?=$NumeroETA?></select></div>'
                                +'<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><select class="form-control" id="EtaB2_' + n_proposta + '_' + linea + '" name="EtaB2_' + linea + '" style="display:none" onchange="cambia_prop(' + linea + '_' + n_proposta + '_' + linea + ');"><?=$NumeroETA?></select></div>'
                                +'<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><select class="form-control" id="EtaB3_' + n_proposta + '_' + linea + '" name="EtaB3_' + linea + '" style="display:none" onchange="cambia_prop(' + linea + '_' + n_proposta + '_' + linea + ');"><?=$NumeroETA?></select></div>'
                                +'<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><select class="form-control" id="EtaB4_' + n_proposta + '_' + linea + '" name="EtaB4_' + linea + '" style="display:none" onchange="cambia_prop(' + linea + '_' + n_proposta + '_' + linea + ');"><?=$NumeroETA?></select></div>'
                                +'<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><select class="form-control" id="EtaB5_' + n_proposta + '_' + linea + '" name="EtaB5_' + linea + '" style="display:none" onchange="cambia_prop(' + linea + '_' + n_proposta + '_' + linea + ');"><?=$NumeroETA?></select></div>'
                                +'<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><select class="form-control" id="EtaB6_' + n_proposta + '_' + linea + '" name="EtaB6_' + linea + '" style="display:none" onchange="cambia_prop(' + linea + '_' + n_proposta + '_' + linea + ');"><?=$NumeroETA?></select></div>'
                                +'</div>'
                                +'</div>'
                                +'</div>'
                                +'<div class="clearfix"></div>'
                                +'<a id="re" href="javascript:;"  onclick="remove_room_fields(' + linea + ');"><i class="fa fa-fw  fa-minus"></i> <?=$rem_room[$k]?></a>'
                                +'<div class="clearfix"></div>';
     }
    objTo.appendChild(divtest);
    EQR();
}
function room_fields_full(n_proposta,id) {

    linea++;
    var objTo = document.getElementById(id)
    var divtest = document.createElement("div");
    divtest.setAttribute("class", "removeclass" + linea);
    var rdiv = "removeclass" + linea;

    if(linea <= 5){
        divtest.innerHTML = '<div class="clearfix"></div>'
                            +'<div class="row">'
                            +'<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"><select class="form-control" name="TipoSoggiorno_' + linea + '" id="TipoSoggiorno_' + n_proposta + '_' + linea + '"><option value=""><?=$trattamento[$k]?></option><?=$trattamento_params?></select></div>'  
                            +'<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"><select class="form-control" name="NumeroCamere_' + linea + '" id="NumeroCamere_' + n_proposta +  '_' + linea + '"><?=$NumeroC?></select></div>'
                            +'<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"><select class="form-control" name="TipoCamere_' + linea + '" id="TipoCamere_' + n_proposta +  '_' + linea + '"><option value=""><?=$tipo_camera[$k]?></option><?=$camera_params?></select></div>'
                            +'</div>'
                            +'<div class="clearfix"></div>'
                            +'<div class="row">'
                            +'<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"><select class="form-control calcolaA" name="NumAdulti_' + linea + '" id="NumeroAdulti_' + n_proposta + '_' + linea + '"  onchange="calcola_totale_adulti();"><?=$NumeroAD?></select></div>'
                            +'<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"><select class="form-control calcolaB" name="NumBambini_' + linea + '"  id="NumeroBambini_' + n_proposta + '_' + linea + '"  onchange="view_bimbi('+linea+');calcola_totale_bambini();"><?=$NumeroBI?></select></div>'                        
                            +'</div>'
                            +'<div class="clearfix"></div>'
                            +'<div class="row">'
                            +'<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">'
                            +'<div class="row">'
                            +'<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><select class="form-control" id="EtaB1_' + n_proposta + '_' + linea + '" name="EtaB1_' + linea + '" style="display:none" onchange="cambia_prop(' + linea + '_' + n_proposta + '_' + linea + ');"><?=$NumeroETA?></select></div>'
                            +'<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><select class="form-control" id="EtaB2_' + n_proposta + '_' + linea + '" name="EtaB2_' + linea + '" style="display:none" onchange="cambia_prop(' + linea + '_' + n_proposta + '_' + linea + ');"><?=$NumeroETA?></select></div>'
                            +'<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><select class="form-control" id="EtaB3_' + n_proposta + '_' + linea + '" name="EtaB3_' + linea + '" style="display:none" onchange="cambia_prop(' + linea + '_' + n_proposta + '_' + linea + ');"><?=$NumeroETA?></select></div>'
                            +'<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><select class="form-control" id="EtaB4_' + n_proposta + '_' + linea + '" name="EtaB4_' + linea + '" style="display:none" onchange="cambia_prop(' + linea + '_' + n_proposta + '_' + linea + ');"><?=$NumeroETA?></select></div>'
                            +'<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><select class="form-control" id="EtaB5_' + n_proposta + '_' + linea + '" name="EtaB5_' + linea + '" style="display:none" onchange="cambia_prop(' + linea + '_' + n_proposta + '_' + linea + ');"><?=$NumeroETA?></select></div>'
                            +'<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><select class="form-control" id="EtaB6_' + n_proposta + '_' + linea + '" name="EtaB6_' + linea + '" style="display:none" onchange="cambia_prop(' + linea + '_' + n_proposta + '_' + linea + ');"><?=$NumeroETA?></select></div>'
                            +'</div>'
                            +'</div>'
                            +'</div>'
                            +'<div class="clearfix"></div>'
                            +'<a id="re" href="javascript:;"  onclick="remove_room_fields(' + linea + ');"><i class="fa fa-fw  fa-minus"></i> <?=$rem_room[$k]?></a>'
                            +'<div class="clearfix"></div>';
    }
    objTo.appendChild(divtest);
    EQR();
}

function remove_room_fields(rid) {
    $(".removeclass" + rid).remove();
    EQR();
}
$(function() {
    $("input, select").each(function() {
        reqs = $(this).attr('req');
        console.log(this + "Req:" + reqs);
        if (reqs != undefined) {
            $("<div class='asterisco'>*</div>").insertBefore(this);

        }
    });

    $(".formprivacy").css("position", "relative");
    $("<div class='asterisco'>*</div>").insertBefore('#consenso');
    $(".asterisco").css({
        "position": "absolute",
        "top": "50%",
        "transform": "translateY(-50%)",
        "left": "30px",
        "font-weight": "bold",
        "color": "#999",
        "font-size": "14px",
        "z-index": "10",
    });
    $(".form_quoto .formprivacy").find(".asterisco").css("left", "-12px");
})
$(function() {
    function session_ins(varname) {
        $(".form_quoto input[name='" + varname + "'], .form_quoto textarea[name='" + varname + "'], .form_quoto select[name='" + varname + "']").on("keyup change", function() {
            sessionStorage.setItem("quoto_" + varname, $(this).val());
            sessionStorage.setItem("quoto_data_arrivo", $(".form_quoto input[name='data_arrivo']").val());
            sessionStorage.setItem("quoto_data_partenza", $(".form_quoto input[name='data_partenza']").val());
        });
    }

    function session_w(varname) {
        $(".form_quoto input[name='" + varname + "']").val(sessionStorage.getItem("quoto_" + varname));
        $(".form_quoto textarea[name='" + varname + "']").val(sessionStorage.getItem("quoto_" + varname));
        $(".form_quoto select[name='" + varname + "']").val(sessionStorage.getItem("quoto_" + varname)).attr('selected');
    }

    session_ins('nome');
    session_ins('cognome');
    session_ins('email');
    session_ins('telefono');
    session_ins('data_arrivo');
    session_ins('data_partenza');
    session_ins('messaggio');
    session_ins('TipoSoggiorno_1');

    session_w('nome');
    session_w('cognome');
    session_w('email');
    session_w('telefono');
    session_w('data_arrivo');
    session_w('data_partenza');
    session_w('messaggio');
    session_w('TipoSoggiorno_1');

})



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
    $(document).ready(function(){
        setTimeout(function(){
            var CLIENT_ID_ = leggiCookie("_ga");
            var CLIENT_ID_tmp =  CLIENT_ID_.split(".");
            var CLIENT_ID = CLIENT_ID_tmp[2]+"."+CLIENT_ID_tmp[3];
            $("#load_client_id").html('<input type="hidden" name="CLIENT_ID" value="'+CLIENT_ID+'" />');
        }, 3000);
    });


   <? if($_REQUEST['resp_captcha']=='error'){ ?>
	

        function scroll_to_id(id, scarto, tempo) {
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

        $(document).ready(function(){
            scroll_to_id("form_<?=$form_ref?>", 200, 0);
        });

   <?}?>


    $(function(){
        $("[nomeForm]").on("submit",function(){
            if ($(this).valid()){
                $("#view_send_form_loading").html('<div class="clearfix">&nbsp;</div><div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center"><img src="<?=BASE_URL_SITO?>apiForm/img/Ellipsis-1s-200px.svg" alt="Salvataggio in corso"></div><div class="m m-x-12 text-center"><small>Salvataggio in corso..attendere qualche istante!<br>Saving ..., wait for it to finish!</small></div></div><div class="clearfix">&nbsp;</div>');
                $(".SW-submit").hide();
            }
        })
    });

    function write_client_id(){
            setTimeout(function(){
                var CLIENT_ID_ = leggiCookie("_ga");
                var CLIENT_ID_tmp =  CLIENT_ID_.split(".");
                var CLIENT_ID = CLIENT_ID_tmp[2]+"."+CLIENT_ID_tmp[3];
                $("#load_client_id").html('<input type="hidden" name="CLIENT_ID" value="'+CLIENT_ID+'" />');
            }, 3000);
    }

    

$(document).ready(function() {
    function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
}

  $(".form_quoto input:not([type='email'])").focus(function(){
    placeholder = $(this).attr('placeholder');
    if(placeholder != undefined){
      $(this).parent().prepend('<span class="input-placeholder">'+placeholder+'</span>');
    }
  });
  $(".form_quoto input:not([type='email'])").blur(function(){
    $(this).parent().find('.input-placeholder').remove();
  });
  $(".form_quoto input:not([type='email'])").blur(function(){
    reqs = $(this).attr('req');
    if (reqs != undefined) {
        if( !$(this).val() ) {
        $(this).parent().prepend('<span class="input-alert"><i class="fa fa-close"></i></span>');
        $(this).parent().find('.input-alert2').remove();
        }
        else{
            $(this).parent().find('.input-alert').remove();
            $(this).parent().prepend('<span class="input-alert2"><i class="fa fa-check"></i></span>');
        }
    }
  });
  //email
  $(".form_quoto input[type='email']").focus(function(){
    placeholder = $(this).attr('placeholder');
    if(placeholder != undefined){
      $(this).parent().prepend('<span class="input-placeholder">'+placeholder+'</span>');
    }
  })
  $(".form_quoto input[type='email']").blur(function(){
    $(this).parent().find('.input-placeholder').remove();
  });
  $(".form_quoto input[type='email']").blur(function(){
    var emailona=$(this).val();
    if(isValidEmailAddress(emailona)) { 
        //email valida
        $(this).parent().find('.input-alert').remove();
        $(this).parent().prepend('<span class="input-alert2"><i class="fa fa-check"></i></span>');

    }
    else{
        $(this).parent().prepend('<span class="input-alert"><i class="fa fa-close"></i></span>');
        $(this).parent().find('.input-alert2').remove();
    }
  });




});

</script>