<?php
// ribadisco error_reporting, perchè escludere alcuni warning
error_reporting(0);

$DataDiOggi = date('Y-m-d');
$GiornoInPiu = mktime (0,0,0,date('m'),(date('d')+1),date('Y'));
$DataDiDomani = date('Y-m-d',$GiornoInPiu);

if($_REQUEST['azione'] == 'edit' && $_REQUEST['param'] != '') {

        // query per recupero dati tramite Identificativo
        $row = $fun->get_modify($_REQUEST['param']);
        // instanza delle varibili utili
        $Id                   = $row['Id'];
        $TipoRichiesta        = 'Conferma';
        $TipoVacanza          = $row['TipoVacanza'];
        $Lingua               = $row['Lingua'];
        $ChiPrenota           = $row['ChiPrenota'];
        $EmailOperatore       = $row['EmailSegretaria'];
        $Lingua               = $row['Lingua'];
        $Nome                 = stripslashes($row['Nome']);
        $Cognome              = stripslashes($row['Cognome']);
        $Email                = $row['Email'];
        $prefisso             = $dati['PrefissoInternazionale'];
        $Cellulare            = $row['Cellulare'];
        $idsito               = $_REQUEST['idsito'];
        $DataArrivo           = $row['DataArrivo'];
        $DataPartenza         = $row['DataPartenza'];
        $Prefisso             = $row['Prefisso'];
        $NumeroPrenotazione   = $row['NumeroPrenotazione'];
        $NumAdulti            = $row['NumeroAdulti'];
        $NumBambini           = $row['NumeroBambini'];
        $EtaBambini1          = $row['EtaBambini1'];
        $EtaBambini2          = $row['EtaBambini2'];
        $EtaBambini3          = $row['EtaBambini3'];
        $EtaBambini4          = $row['EtaBambini4'];
        $EtaBambini5          = $row['EtaBambini5'];
        $EtaBambini6          = $row['EtaBambini6'];
        $FontePrenotazione    = $row['FontePrenotazione'];
        $Note                 = addslashes($_REQUEST['Note']);
        $CheckinOnlineClient  = $row['CheckinOnlineClient'];
        $Chiuso               = $row['Chiuso'];
        $DataChiuso           = $row['DataChiuso'];


        // chiamate per popolare la lista select del target cliente
        $listaTarget = $fun->lista_target(IDSITO);
        $array_target = explode(",",$TipoVacanza);
        foreach($listaTarget as $key => $value){
            $target .='<option value="'.$value['Target'].'" '.(in_array($value['Target'],$array_target)?'selected="selected"':'').'>'.$value['Target'].'</option>';
        }

        // chiamate per popolare la lista select degli operatori
        $listaOperatori = $fun->lista_operatori(IDSITO);
            $Operatori .='<option value="">scegli</option>';
        foreach($listaOperatori as $key => $value){
            $Operatori .='<option value="'.$value['NomeOperatore'].'" '.($value['NomeOperatore'] == $ChiPrenota?'selected="selected"':'').'>'.$value['NomeOperatore'].'</option>';
            $EmailAssociata .='<option value="'.$value['EmailSegretaria'].'" '.($value['EmailSegretaria'] == $EmailOperatore?'selected="selected"':'').'>'.$value['EmailSegretaria'].'</option>';
        }

        // lisat delle lingue disponibili in QUOTO
        $ListaLingue .='<option data-img-src="'.BASE_URL_SITO.'img/flags/big/it.png" data-img-label="Italiano" value="it" '.($Lingua=='it'?'selected="selected"':'').'>Italiano</option>';
        $ListaLingue .='<option data-img-src="'.BASE_URL_SITO.'img/flags/big/en.png" data-img-label="Inglese"  value="en" '.($Lingua=='en'?'selected="selected"':'').'>Inglese</option>';
        $ListaLingue .='<option data-img-src="'.BASE_URL_SITO.'img/flags/big/fr.png" data-img-label="Francese" value="fr" '.($Lingua=='fr'?'selected="selected"':'').'>Francese</option>';
        $ListaLingue .='<option data-img-src="'.BASE_URL_SITO.'img/flags/big/de.png" data-img-label="Tedesco"  value="de" '.($Lingua=='de'?'selected="selected"':'').'>Tedesco</option>';

        // Ciclo per il select Numero Totale Adulti
        $i = 1;
            $NumeroAdulti .='<option value="">scegli</option>';
        for($i==1; $i<=20; $i++){
            $NumeroAdulti .='<option value="'.$i.'" '.($i==$NumAdulti?'selected="selected"':'').'>'.$i.'</option>';
        }
            $NumeroAdulti .='<option value="25" '.(25==$NumAdulti?'selected="selected"':'').'>25</option>';
            $NumeroAdulti .='<option value="30" '.(30==$NumAdulti?'selected="selected"':'').'>30</option>';
            $NumeroAdulti .='<option value="35" '.(35==$NumAdulti?'selected="selected"':'').'>35</option>';
            $NumeroAdulti .='<option value="40" '.(40==$NumAdulti?'selected="selected"':'').'>40</option>';
            $NumeroAdulti .='<option value="45" '.(45==$NumAdulti?'selected="selected"':'').'>45</option>';
            $NumeroAdulti .='<option value="50" '.(50==$NumAdulti?'selected="selected"':'').'>50</option>';
            $NumeroAdulti .='<option value="60" '.(60==$NumAdulti?'selected="selected"':'').'>60</option>';
            $NumeroAdulti .='<option value="70" '.(70==$NumAdulti?'selected="selected"':'').'>70</option>';

        // Ciclo per il select Numero Totale Bambini
        $n = 1;
            $NumeroBambini .='<option value="">scegli</option>';
        for($n==1; $n<=10; $n++){
            $NumeroBambini .='<option value="'.$n.'" '.($n==$NumBambini?'selected="selected"':'').'>'.$n.'</option>';
        }

        $e1 = 1;
        $etaBimbi1 .='<option value="< 1" '.($EtaBambini1=='< 1'?'selected="selected"':'').'>< 1</option>';
        for($e1==1; $e1<=18; $e1++){
            $etaBimbi1 .='<option value="'.$e1.'" '.($EtaBambini1==$e1?'selected="selected"':'').'>'.$e1.'</option>';
        }
        $e2 = 1;
        $etaBimbi2 .='<option value="< 1" '.($EtaBambini2=='< 1'?'selected="selected"':'').'>< 1</option>';
        for($e2==1; $e2<=18; $e2++){
            $etaBimbi2 .='<option value="'.$e2.'" '.($EtaBambini2==$e2?'selected="selected"':'').'>'.$e2.'</option>';
        }
        $e3 = 1;
        $etaBimbi3 .='<option value="< 1" '.($EtaBambini3=='< 1'?'selected="selected"':'').'>< 1</option>';
        for($e3==1; $e3<=18; $e3++){
            $etaBimbi3 .='<option value="'.$e3.'" '.($EtaBambini3==$e3?'selected="selected"':'').'>'.$e3.'</option>';
        }
        $e4 = 1;
        $etaBimbi4 .='<option value="< 1" '.($EtaBambini4=='< 1'?'selected="selected"':'').'>< 1</option>';
        for($e4==1; $e4<=18; $e4++){
            $etaBimbi4 .='<option value="'.$e4.'" '.($EtaBambini4==$e4?'selected="selected"':'').'>'.$e4.'</option>';
        }
        $e5 = 1;
        $etaBimbi5 .='<option value="< 1" '.($EtaBambini5=='< 1'?'selected="selected"':'').'>< 1</option>';
        for($e5==1; $e5<=18; $e5++){
            $etaBimbi5 .='<option value="'.$e5.'" '.($EtaBambini5==$e5?'selected="selected"':'').'>'.$e5.'</option>';
        }
        $e6 = 1;
        $etaBimbi6 .='<option value="< 1" '.($EtaBambini6=='< 1'?'selected="selected"':'').'>< 1</option>';
        for($e6==1; $e6<=18; $e6++){
            $etaBimbi6 .='<option value="'.$e6.'" '.($EtaBambini6==$e6?'selected="selected"':'').'>'.$e6.'</option>';
        }
     
        $ListaPrefissi = $fun->get_var_prefissi($prefisso,$Lingua);

        $ListaFonti .='<option value="Booking.com" '.($FontePrenotazione=='Booking.com'?'selected="selected"':'').'>Booking.com</option>';
        $ListaFonti .='<option value="Expedia.it" '.($FontePrenotazione=='Expedia.it'?'selected="selected"':'').'>Expedia.it</option>';
        $ListaFonti .='<option value="Booking Engine" '.($FontePrenotazione=='Booking Engine'?'selected="selected"':'').'>Booking Engine</option>';
        $ListaFonti .='<option value="Portali turistici" '.($FontePrenotazione=='Portali turistici'?'selected="selected"':'').'>Portali turistici</option>';

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
   
        $(\'#ChiPrenota\').change(function() {
            var ChiPrenota = $("#ChiPrenota").val();
            $.ajax({
                type: "POST",
                url: "'.BASE_URL_SITO.'ajax/email_operatore.php",
                data: "ChiPrenota=" + ChiPrenota + "&idsito=" + '.IDSITO.',
                dataType: "html",
                success: function(msg){
   
                    $("#EmailSegretaria").html(msg);
                },
                error: function(){
                    alert("Chiamata fallita, si prega di riprovare...");
                }
            });
        });
    });
  </script>';

#### SALVATAGGIO DELLA MODIFICA #####
if($_REQUEST['action']=='modif'){

    
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
    $Note               = addslashes($_REQUEST['Note']);
    $CheckinOnlineClient= $_REQUEST['CheckinOnlineClient'];


        // query di update
        $update = " UPDATE hospitality_guest
                    SET 
                        DataRichiesta      =   '".$DataRichiesta."',
                        TipoRichiesta      =   '".$TipoRichiesta."',
                        TipoVacanza        =   '".$TipoVacanza."',
                        ChiPrenota         =   '".$ChiPrenota."',
                        EmailSegretaria    =   '".$EmailSegretaria."',
                        Nome               =   '".$Nome."',
                        Cognome            =   '".$Cognome."',
                        Email              =   '".$Email."',
                        PrefissoInternazionale =   '".$PrefissoInternazionale."',
                        Cellulare          =   '".$Cellulare."',
                        Lingua             =   '".$Lingua."',
                        DataArrivo         =   '".$DataArrivo."',
                        DataPartenza       =   '".$DataPartenza."',
                        Prefisso           =   '".$Prefisso."',
                        NumeroPrenotazione =   '".$NumeroPrenotazione."',
                        NumeroAdulti       =   '".$NumeroAdulti."',
                        NumeroBambini      =   '".$NumeroBambini."',
                        EtaBambini1        =   '".$EtaBambini1."',
                        EtaBambini2        =   '".$EtaBambini2."',
                        EtaBambini3        =   '".$EtaBambini3."',
                        EtaBambini4        =   '".$EtaBambini4."',
                        EtaBambini5        =   '".$EtaBambini5."',
                        EtaBambini6        =   '".$EtaBambini6."',
                        FontePrenotazione  =   '".$FontePrenotazione."'
                    WHERE  
                        Id =  ".$Id."
                    AND 
                        idsito =  ".$idsito."";
        $dbMysqli->query($update);

        header('Location:'.BASE_URL_SITO.'checkinonline-prenotazioni_esterne/');
 }
?>