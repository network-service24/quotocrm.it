<?php
    $db->query("SELECT * FROM hospitality_guest WHERE Id = ".$_GET['param']);
    $row = $db->row();

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

    $DataA_tmp            = explode("-",$row['DataArrivo']);
    $DataArrivo           = $DataA_tmp[2].'/'.$DataA_tmp[1].'/'.$DataA_tmp[0];
    $DataP_tmp            = explode("-",$row['DataPartenza']);
    $DataPartenza         = $DataP_tmp[2].'/'.$DataP_tmp[1].'/'.$DataP_tmp[0];
    $Prefisso             = $row['Prefisso'];
    $NumeroPrenotazione   = $row['NumeroPrenotazione'];

    $NumeroAdulti         = $row['NumeroAdulti'];
    $NumeroBambini        = $row['NumeroBambini'];
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
    $DataChiuso          = $row['DataChiuso'];

// Query e ciclo per estrapolare le lingue
$db->query("SELECT * FROM hospitality_lingue WHERE idsito = ".IDSITO." ORDER BY Id ASC");
$row = $db->result();
foreach($row as $chiave => $valore){
    $ListaLingua .='<option value="'.$valore['Sigla'].'" '.($Lingua==$valore['Sigla']?'selected="selected"':'').'>'.$valore['Lingua'].'</option>';
}
// Query e ciclo per estrapolare i prefissi telefonici internazionali
$db->query("SELECT * FROM prefissi  ORDER BY nazione ASC");
$rows = $db->result();
foreach($rows as $ch => $val){
    switch($Lingua){
        case "it":
            $lingua_estesa = 'ITALY';
        break;
        case "en":
            $lingua_estesa = 'UNITED KINGDOM';
        break;
        case "fr":
            $lingua_estesa = 'FRANCE';
        break;
        case "de":
            $lingua_estesa = 'GERMANY';
        break;
        default :
            $lingua_estesa = 'ITALY';
        break;
    }
    $ListaPrefissi .='<option value="'.$val['prefisso'].'" '.(($prefisso==trim($val['prefisso'])) || ($lingua_estesa==trim($val['nazione']))?'selected="selected"':'').'>'.ucwords(strtolower($val['nazione'])).' +'.$val['prefisso'].' </option>';
}
 // Query e ciclo per estrapolare gli operatori

 $db->query("SELECT * FROM hospitality_operatori WHERE Abilitato = 1 AND idsito = ".IDSITO." ORDER BY Id ASC");
 $row = $db->result();
 foreach($row as $chiave => $valore){
    $NomiOperatori .='<option value="'.$valore['NomeOperatore'].'" '.($ChiPrenota==$valore['NomeOperatore']?'selected="selected"':'').'>'.$valore['NomeOperatore'].'</option>';
    $EmailSegretaria .='<option value="'.$valore['EmailSegretaria'].'" '.($EmailOperatore==$valore['EmailSegretaria']?'selected="selected"':'').'>'.$valore['EmailSegretaria'].'</option>';
 }

 $db->query("SELECT * FROM hospitality_target WHERE idsito = ".IDSITO." AND Abilitato = 1 ORDER BY Id ASC");
 $row = $db->result();
 $Target .='<option value="">--</option>';
 foreach($row as $chiave => $valore){
     $Target .='<option value="'.$valore['Target'].'" '.($TipoVacanza==$valore['Target']?'selected="selected"':'').' >'.$valore['Target'].'</option>';
 }

 $i = 1;
 for($i==1; $i<=20; $i++){
     $NumeriA .='<option value="'.$i.'" '.($NumeroAdulti==$i?'selected="selected"':'').'>'.$i.'</option>';

 }

 $x = 1;
 for($x==1; $x<=6; $x++){
     $NumeriB .='<option value="'.$x.'" '.($NumeroBambini==$x?'selected="selected"':'').'>'.$x.'</option>';
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

 
 $ListaFonti .='<option value="Booking.com" '.($FontePrenotazione=='Booking.com'?'selected="selected"':'').'>Booking.com</option>';
 $ListaFonti .='<option value="Expedia.it" '.($FontePrenotazione=='Expedia.it'?'selected="selected"':'').'>Expedia.it</option>';
 $ListaFonti .='<option value="Booking Engine" '.($FontePrenotazione=='Booking Engine'?'selected="selected"':'').'>Booking Engine</option>';
 $ListaFonti .='<option value="Portali turistici" '.($FontePrenotazione=='Portali turistici'?'selected="selected"':'').'>Portali turistici</option>';

$js = 
'<script>
$(document).ready(function(){

    $("#lingua").on("change",function(){  
        var lang = $("#lingua").val();
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
   
    $( "#DataArrivo" ).datepicker({
        numberOfMonths: 2,
        language:"it",
        showButtonPanel: true
    });

    $("#DataArrivo").datepicker({dateFormat: "dd/mm/yy"}).change(function () {             
        var $picker = $("#DataArrivo");
        var $picker2 = $("#DataPartenza");
        var date=new Date($picker.datepicker("getDate"));
        date.setDate(date.getDate()+1);
        $picker2.datepicker("setDate", date);  

    });       

    $( "#DataPartenza" ).datepicker({
        numberOfMonths: 2,
        language:"it",
        showButtonPanel: true
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
    $PrefissoInternazionale          = $_REQUEST['PrefissoInternazionale'];
    $Cellulare          = $_REQUEST['Cellulare'];
    // dati prenotazione
    $DataA_tmp          = explode("/",$_REQUEST['DataArrivo']);
    $DataArrivo         = $DataA_tmp[2].'-'.$DataA_tmp[1].'-'.$DataA_tmp[0];
    $DataP_tmp          = explode("/",$_REQUEST['DataPartenza']);
    $DataPartenza       = $DataP_tmp[2].'-'.$DataP_tmp[1].'-'.$DataP_tmp[0];
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
        $db->query($update);

        header('Location:'.BASE_URL_SITO.'checkinonline-prenotazioni_esterne/');
    }










?>