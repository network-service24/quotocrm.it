<?php
// ribadisco error_reporting, perchè escludere alcuni warning
error_reporting(0);

$DataDiOggi = date('Y-m-d');
$GiornoInPiu = mktime (0,0,0,date('m'),(date('d')+1),date('Y'));
$DataDiDomani = date('Y-m-d',$GiornoInPiu);
// nuovo numero preventivo
$nuovoNumeroPreventivo = $fun->nextNumberPrev(IDSITO);

// chiamate per popolare la lista select del target cliente
$listaTarget = $fun->lista_target(IDSITO);
foreach($listaTarget as $key => $value){
    $target .='<option value="'.$value['Target'].'">'.$value['Target'].'</option>';
}

// chiamate per popolare la lista select degli operatori
$listaOperatori = $fun->lista_operatori(IDSITO);
    $Operatori .='<option value="">scegli</option>';
foreach($listaOperatori as $key => $value){
    $Operatori .='<option value="'.$value['NomeOperatore'].'">'.$value['NomeOperatore'].'</option>';
}

// lisat delle lingue disponibili in QUOTO
$ListaLingue .='<option data-img-src="'.BASE_URL_SITO.'img/flags/big/it.png" data-img-label="Italiano" value="it" '.($dati['Lingua']=='it'?'selected="selected"':'').'>Italiano</option>';
$ListaLingue .='<option data-img-src="'.BASE_URL_SITO.'img/flags/big/en.png" data-img-label="Inglese"  value="en" '.($dati['Lingua']=='en'?'selected="selected"':'').'>Inglese</option>';
$ListaLingue .='<option data-img-src="'.BASE_URL_SITO.'img/flags/big/fr.png" data-img-label="Francese" value="fr" '.($dati['Lingua']=='fr'?'selected="selected"':'').'>Francese</option>';
$ListaLingue .='<option data-img-src="'.BASE_URL_SITO.'img/flags/big/de.png" data-img-label="Tedesco"  value="de" '.($dati['Lingua']=='de'?'selected="selected"':'').'>Tedesco</option>';


// lista fonti di prenotazione
$ListaFonti .='<option value=""></option>';
$ListaFonti .='<option value="Booking.com">Booking.com</option>';
$ListaFonti .='<option value="Expedia.it">Expedia.it</option>';
$ListaFonti .='<option value="Booking Engine">Booking Engine</option>';
$ListaFonti .='<option value="Portali turistici">Portali turistici</option>';

$ListaPrefissi = $fun->get_prefissi();

// Ciclo per il select Numero Totale Adulti
$i = 1;
    $NumeroAdulti .='<option value="">scegli</option>';
for($i==1; $i<=20; $i++){
    $NumeroAdulti .='<option value="'.$i.'">'.$i.'</option>';
}
    $NumeroAdulti .='<option value="25">25</option>';
    $NumeroAdulti .='<option value="30">30</option>';
    $NumeroAdulti .='<option value="35">35</option>';
    $NumeroAdulti .='<option value="40">40</option>';
    $NumeroAdulti .='<option value="45">45</option>';
    $NumeroAdulti .='<option value="50">50</option>';
    $NumeroAdulti .='<option value="60">60</option>';
    $NumeroAdulti .='<option value="70">70</option>';

// Ciclo per il select Numero Totale Bambini
$n = 1;
    $NumeroBambini .='<option value="">scegli</option>';
for($n==1; $n<=6; $n++){
    $NumeroBambini .='<option value="'.$n.'">'.$n.'</option>';
}

$e = 1;
$etaBimbi .='<option value="< 1">< 1</option>';
for($e==1; $e<=18; $e++){
   $etaBimbi .='<option value="'.$e.'">'.$e.'</option>';
}

$js = 
'<script>
    $(document).ready(function(){

        $("#TipoVacanza_").on("change",function(){

            var TipoVacanza_new = "" ;

            $(".TipoVacanza").each(function() {
                TipoVacanza_new =  $(this).val();
            });

            $("#TipoVacanza").val(TipoVacanza_new);
        });

        $("#DataArrivo").change(function () {

            var dateA = new Date($("#DataArrivo")[0].valueAsDate);
            dateA.setDate(dateA.getDate() + 1);
            $(\'#DataPartenza\')[0].valueAsDate = dateA;

        });


        $("#Lingua").imagepicker({
            hide_select : true,
            show_label:   false,
        })

        $(\'#Lingua\').change(function() {
                var lang = $(\'#Lingua option:selected\').val();
            if(lang=="it"){
                $("#PrefissoInternazionale").val("39");
                $("#PrefissoInternazionale").attr("selected",true);
            }
            if(lang=="en"){
                $("#PrefissoInternazionale").val("44");
                $("#PrefissoInternazionale").attr("selected",true);
            }
            if(lang=="fr"){
                $("#PrefissoInternazionale").val("33");
                $("#PrefissoInternazionale").attr("selected",true);
            }
            if(lang=="de"){
                $("#PrefissoInternazionale").val("49");
                $("#PrefissoInternazionale").attr("selected",true);
            }
        });

    $("#NumeroBambini").on("change",function(){   
        if($("#NumeroBambini").val() == \'\'){
            $("#EtaBambini1").css("display","none"); 
            $("#EtaBambini2").css("display","none");
            $("#EtaBambini3").css("display","none"); 
            $("#EtaBambini4").css("display","none"); 
            $("#EtaBambini5").css("display","none"); 
            $("#EtaBambini6").css("display","none"); 
        }else if($("#NumeroBambini").val() == "1"){
            $("#EtaBambini1").css("display","block");  
            $("#EtaBambini2").css("display","none");
            $("#EtaBambini3").css("display","none"); 
            $("#EtaBambini4").css("display","none"); 
            $("#EtaBambini5").css("display","none"); 
            $("#EtaBambini6").css("display","none");  
        }else if($("#NumeroBambini").val() == "2"){
            $("#EtaBambini1").css("display","block"); 
            $("#EtaBambini2").css("display","block");  
            $("#EtaBambini3").css("display","none"); 
            $("#EtaBambini4").css("display","none"); 
            $("#EtaBambini5").css("display","none"); 
            $("#EtaBambini6").css("display","none"); 
        }else if($("#NumeroBambini").val() == "3"){
            $("#EtaBambini1").css("display","block"); 
            $("#EtaBambini2").css("display","block");
            $("#EtaBambini3").css("display","block");
            $("#EtaBambini4").css("display","none"); 
            $("#EtaBambini5").css("display","none"); 
            $("#EtaBambini6").css("display","none");  
        }else if($("#NumeroBambini").val() == "4"){
            $("#EtaBambini1").css("display","block"); 
            $("#EtaBambini2").css("display","block");
            $("#EtaBambini3").css("display","block"); 
            $("#EtaBambini4").css("display","block"); 
            $("#EtaBambini5").css("display","none"); 
            $("#EtaBambini6").css("display","none");  
        }else if($("#NumeroBambini").val() == "5"){
            $("#EtaBambini1").css("display","block"); 
            $("#EtaBambini2").css("display","block");
            $("#EtaBambini3").css("display","block"); 
            $("#EtaBambini4").css("display","block"); 
            $("#EtaBambini5").css("display","block"); 
            $("#EtaBambini6").css("display","none");  
        }else if($("#NumeroBambini").val() == "6"){
            $("#EtaBambini1").css("display","block"); 
            $("#EtaBambini2").css("display","block");
            $("#EtaBambini3").css("display","block"); 
            $("#EtaBambini4").css("display","block"); 
            $("#EtaBambini5").css("display","block"); 
            $("#EtaBambini5").css("display","block"); 
        }
    });
        if($(\'#Cellulare\').val() != \'\'){
            var Phone = $("#Cellulare").val();
            $.ajax({
                type: "POST",
                url: "'.BASE_URL_SITO.'ajax/check_valid_phone.php",
                data: "Phone=" + Phone,
                dataType: "html",
                success: function(msg){
                    $("#check_phone").html(msg);
                },
                error: function(){
                    alert("Chiamata fallita, si prega di riprovare...");
                }
            });
        }
    /*CONTROLLO DEL NUMERO DI TELEFONO*/       
        $("#Cellulare").bind("keyup focusout",function(){
            var Phone = $("#Cellulare").val();
            $.ajax({
                type: "POST",
                url: "'.BASE_URL_SITO.'ajax/check_valid_phone.php",
                data: "Phone=" + Phone,
                dataType: "html",
                success: function(msg){
                    $("#check_phone").html(msg);
                },
                error: function(){
                    alert("Chiamata fallita, si prega di riprovare...");
                }
            });
        })
          
        $(\'#ChiPrenota\').change(function() {
            var ChiPrenota = $("#ChiPrenota").val();
            $.ajax({
                type: "POST",
                url: "'.BASE_URL_SITO.'ajax/email_operatore.php",
                data: "ChiPrenota=" + ChiPrenota + "&idsito=" + '.IDSITO.',
                dataType: "html",
                success: function(msg){
                    $("#EmailSegretaria").val(msg);
                },
                error: function(){
                    alert("Chiamata fallita, si prega di riprovare...");
                }
            });
        });
    });
  </script>';

if($_REQUEST['action']=='create'){

    
    // dati richiesta
    $DataRichiesta      = date('Y-m-d');
    $Prefisso           = addslashes($_REQUEST['Prefisso']);
    $NumeroPrenotazione = $_REQUEST['NumeroPrenotazione'];
    $Lingua             = $_REQUEST['Lingua'];
    $TipoRichiesta      = 'Conferma';
    $Chiuso             = 1;
    $DataChiuso         = date('Y-m-d H:i:s');
    $TipoRichiesta      = 'Conferma';
    $TipoVacanza        = $_REQUEST['TipoVacanza'];
    $ChiPrenota         = $_REQUEST['ChiPrenota'];
    $EmailSegretaria    = $_REQUEST['EmailSegretaria'];
    $idsito             = $_REQUEST['idsito'];
    // dati cliente
    $Nome               = addslashes($_REQUEST['Nome']);
    $Cognome            = addslashes($_REQUEST['Cognome']);
    $Email              = $_REQUEST['Email'];
    
    $PrefissoInternazionale  = $_REQUEST['PrefissoInternazionale'];
    $Cellulare          = $_REQUEST['Cellulare'];
    // dati prenotazione

    $DataArrivo         = $_REQUEST['DataArrivo'];
    $DataPartenza       = $_REQUEST['DataPartenza'];
    $NumeroAdulti       = $_REQUEST['NumeroAdulti'];
    $NumeroBambini      = $_REQUEST['NumeroBambini'];
    $EtaBambini1        = ($_REQUEST['EtaBambini1']==''?NULL:$_REQUEST['EtaBambini1']);
    $EtaBambini2        = ($_REQUEST['EtaBambini2']==''?NULL:$_REQUEST['EtaBambini2']);
    $EtaBambini3        = ($_REQUEST['EtaBambini3']==''?NULL:$_REQUEST['EtaBambini3']);
    $EtaBambini4        = ($_REQUEST['EtaBambini4']==''?NULL:$_REQUEST['EtaBambini4']);
    $EtaBambini5        = ($_REQUEST['EtaBambini5']==''?NULL:$_REQUEST['EtaBambini5']);
    $EtaBambini6        = ($_REQUEST['EtaBambini6']==''?NULL:$_REQUEST['EtaBambini6']);
    // dati informativi
    $FontePrenotazione  = $_REQUEST['FontePrenotazione'];
    $CheckinOnlineClient= $_REQUEST['CheckinOnlineClient'];


        // query di inserimento
        $insert = "INSERT INTO hospitality_guest(DataRichiesta,
                                                TipoRichiesta,
                                                TipoVacanza,
                                                ChiPrenota,
                                                EmailSegretaria,
                                                idsito,
                                                Nome,
                                                Cognome,
                                                Email,
                                                PrefissoInternazionale,
                                                Cellulare,
                                                Lingua,
                                                DataArrivo,
                                                DataPartenza,
                                                Prefisso,
                                                NumeroPrenotazione,
                                                NumeroAdulti,
                                                NumeroBambini,
                                                EtaBambini1,
                                                EtaBambini2,
                                                EtaBambini3,
                                                EtaBambini4,
                                                EtaBambini5,
                                                EtaBambini6,
                                                FontePrenotazione,
                                                Chiuso,
                                                DataChiuso,
                                                CheckinOnlineClient
                                                 ) VALUES (
                                                '".$DataRichiesta."',
                                                '".$TipoRichiesta."',
                                                '".$TipoVacanza."',
                                                '".$ChiPrenota."',
                                                '".$EmailSegretaria."',
                                                '".$idsito."',
                                                '".$Nome."',
                                                '".$Cognome."',
                                                '".$Email."',
                                                '".$PrefissoInternazionale."',
                                                '".$Cellulare."',
                                                '".$Lingua."',
                                                '".$DataArrivo."',
                                                '".$DataPartenza."',
                                                '".$Prefisso."',
                                                '".$NumeroPrenotazione."',
                                                '".$NumeroAdulti."',
                                                '".$NumeroBambini."',
                                                '".$EtaBambini1."',
                                                '".$EtaBambini2."',
                                                '".$EtaBambini3."',
                                                '".$EtaBambini4."',
                                                '".$EtaBambini5."',
                                                '".$EtaBambini6."',
                                                '".$FontePrenotazione."',
                                                '".$Chiuso."',
                                                '".$DataChiuso."',
                                                '".$CheckinOnlineClient."')";
        $dbMysqli->query($insert);

        header('Location:'.BASE_URL_SITO.'checkinonline-prenotazioni_esterne/');
    }




?>