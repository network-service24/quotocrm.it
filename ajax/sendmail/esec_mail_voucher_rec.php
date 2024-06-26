<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");
include($_SERVER['DOCUMENT_ROOT'].'/include/function.inc.php');
#RECUPERO VARIBILI

$idsito                      = $_REQUEST['idsito'];
$id_prenotazione             = $_REQUEST['id_prenotazione'];
$tag_voucher                 = $_REQUEST['tag_voucher'];
$oggetto                     = $_REQUEST['oggetto'];
$testo_voucher_rec           = $_REQUEST['testo_voucher_rec'];
$DataValiditaVoucher         = $_REQUEST['DataValiditaVoucher'];
 

$linkvoucher        = '<a href="'.URL_LANDING.$dir_sito.'/'.base64_encode($id_prenotazione.'_'.$idsito.'_c').'/voucher_rec/">VOUCHER</a>';

$select       = 'SELECT siti.nome,siti.email FROM siti WHERE siti.idsito = '.$idsito;
$result       = $dbMysqli->query($select);
$DatiStruttua = $result[0];
$NOMEHOTEL    = $DatiStruttua['nome'];
$EMAILHOTEL   = $DatiStruttua['email'];

$qry  = "SELECT 
            hospitality_guest.* 
        FROM 
            hospitality_guest 
        INNER JOIN 
            hospitality_proposte 
        ON 
            hospitality_proposte.id_richiesta = hospitality_guest.Id
        WHERE 
            hospitality_guest.idsito = ".$idsito." 
        AND 
            hospitality_guest.Id = ".$id_prenotazione." ";

$risultato = $dbMysqli->query($qry);
$value     = $risultato[0];

$Id                 = $value['Id'];
$AccontoRichiesta   = $value['AccontoRichiesta'];
$AccontoLibero      = $value['AccontoLibero'];

$Nome               = stripslashes(ucfirst($value['Nome']));
$Cognome            = stripslashes(ucfirst($value['Cognome']));
$Email              = $value['Email'];

$Lingua             = $value['Lingua'];
if($Lingua =='')      $Lingua = 'it';

$DataPreno_tmp      = explode("-",$value['DataChiuso']);
$DataPrenoCheck     = $value['DataChiuso'];
$DataPreno          = $DataPreno_tmp[2].'/'.$DataPreno_tmp[1].'/'.$DataPreno_tmp[0];   

$NumeroPrenotazione = $value['NumeroPrenotazione'];


$query = "SELECT 
            hospitality_proposte.Id                 as IdProposta,
            hospitality_proposte.Arrivo             as Arrivo,
            hospitality_proposte.Partenza           as Partenza,
            hospitality_proposte.NomeProposta       as NomeProposta,
            hospitality_proposte.TestoProposta      as TestoProposta,
            hospitality_proposte.CheckProposta      as CheckProposta,
            hospitality_proposte.PrezzoL            as PrezzoL,
            hospitality_proposte.PrezzoP            as PrezzoP,
            hospitality_proposte.AccontoPercentuale as AccontoPercentuale,
            hospitality_proposte.AccontoImporto     as AccontoImporto,
            hospitality_proposte.AccontoTariffa     as AccontoTariffa,
            hospitality_proposte.AccontoTesto       as AccontoTesto
        FROM 
            hospitality_proposte
        WHERE 
            hospitality_proposte.id_richiesta = ".$Id."
        GROUP BY 
            hospitality_proposte.Id";

$array_record = $dbMysqli->query($query);

    foreach($array_record as $k => $record){

        $CheckProposta      = $record['CheckProposta'];                 
        $PrezzoL            = number_format($record['PrezzoL'],2,',','.');
        $PrezzoP            = number_format($record['PrezzoP'],2,',','.'); 
        $PrezzoPC           = $record['PrezzoP']; 
        $IdProposta         = $record['IdProposta'];  
        $NomeProposta       = stripslashes($record['NomeProposta']); 
        $TestoProposta      = stripslashes($record['TestoProposta']); 
        $AccontoPercentuale = $record['AccontoPercentuale'];
        $AccontoImporto     = $record['AccontoImporto'];
        $AccontoTariffa     = stripslashes($record['AccontoTariffa']); 
        $AccontoTesto       = stripslashes($record['AccontoTesto']); 
        $A_tmp              = explode("-",$record['Arrivo']);
        $A                  = $record['Arrivo'];
        $Arrivo             = $A_tmp[2].'/'.$A_tmp[1].'/'.$A_tmp[0];
        $P_tmp              = explode("-",$record['Partenza']);
        $P                  = $record['Partenza'];
        $Partenza           = $P_tmp[2].'/'.$P_tmp[1].'/'.$P_tmp[0];
        $Astart             = mktime(24,0,0,$A_tmp[1],$A_tmp[2],$A_tmp[0]);
        $Aend               = mktime(01,0,0,$P_tmp[1],$P_tmp[2],$P_tmp[0]);
        $formato="%a";
        $ANotti = dateDiff($record['Arrivo'],$record['Partenza'],$formato);

        if($PrezzoL!='0,00'){
            $percentuale_sconto =  str_replace(",00", "",number_format((100-(100*$record['PrezzoP'])/$record['PrezzoL']),2,',','.'));             
        }  

        if($AccontoRichiesta != 0 && $AccontoLibero == 0) {
            $saldo   = ($PrezzoPC-($PrezzoPC*$AccontoRichiesta/100));
            $acconto = number_format(($PrezzoPC*$AccontoRichiesta/100),2,',','.');
        }
        if($AccontoRichiesta == 0 && $AccontoLibero != 0) {
            $saldo   = ($PrezzoPC-$AccontoLibero);
            $acconto = number_format($AccontoLibero,2,',','.');
        }

        if($AccontoPercentuale != 0 && $AccontoImporto == 0) {
            $saldo   = ($PrezzoPC-($PrezzoPC*$AccontoPercentuale/100));
            $acconto = number_format(($PrezzoPC*$AccontoPercentuale/100),2,',','.');
        }
        if($AccontoPercentuale == 0 && $AccontoImporto != 0) {
            if($AccontoImporto >= 1) {
                $etichetta_caparra  = '';
            }else{
                $etichetta_caparra  = '<br /><i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Carta di Credito a garanzia';
            }
            $saldo   = ($PrezzoPC-$AccontoImporto);
            $acconto = number_format($AccontoImporto,2,',','.');
        }
        if($PrezzoPC==$saldo){
            $etichetta_saldo = '<i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Cifra a saldo €.0,00';
        }else{
            $etichetta_saldo = '<i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Cifra a saldo €.'.number_format(floatval($saldo),2,',','.');
        }

    }


    $qr  = "SELECT 
                hospitality_tipo_voucher_cancellazione.DataValidita
            FROM 
                hospitality_tipo_voucher_cancellazione 
            WHERE 
                hospitality_tipo_voucher_cancellazione.idsito = ".$idsito." 
            AND 
                hospitality_tipo_voucher_cancellazione.Abilitato = 1 ";

$risult = $dbMysqli->query($qr);
$valore = $risult[0];


$contenuto_mail = str_replace("[cliente]",$Nome.' '.$Cognome, $testo_voucher_rec);
$contenuto_mail = str_replace("[caparra]",$acconto,$contenuto_mail);
$contenuto_mail = str_replace("[numeropreno]",$NumeroPrenotazione,$contenuto_mail);
$contenuto_mail = str_replace("[validita]",gira_data($valore['DataValidita']),$contenuto_mail);
$contenuto_mail = str_replace("[emailhotel]",$EMAILHOTEL,$contenuto_mail);
$contenuto_mail = str_replace("[linkvoucher]",$linkvoucher,$contenuto_mail);
$contenuto_mail = str_replace("[struttura]",$NOMEHOTEL,$contenuto_mail);

$oggetto_mail = str_replace("[cliente]",$Nome.' '.$Cognome, $oggetto);
$oggetto_mail = str_replace("[numeropreno]",$NumeroPrenotazione, $oggetto_mail);

if($_REQUEST['action']=='send_email_voucher_rec'){
    
    $qr = "SELECT * FROM hospitality_smtp WHERE idsito = ".$idsito." AND Abilitato = 1";  
    $ri = $dbMysqli->query($qr);
    $rx = $ri[0];
    if(sizeof($ri)>0) {
        $isSMTP = count($ri); 
    }else{ 	
        $isSMTP = 0;
    }
    $SmtpAuth     = $rx['SMTPAuth'];
    $SmtpHost     = $rx['SMTPHost'];
    $SmtpPort     = $rx['SMTPPort'];
    $SmtpSecure   = $rx['SMTPSecure'];
    $SmtpUsername = $rx['SMTPUsername'];
    $SmtpPassword = $rx['SMTPPassword'];
    $NumberSend   = $rx['NumberSend'];	

    require INC_PATH_CLASS.'PHPMailer/PHPMailerAutoload.php';

    $mail = new PHPMailer;

    if($isSMTP > 0){
        $mail->IsSMTP(); 
        $mail->SMTPDebug = 0; 
        $mail->Debugoutput = 'html';
        $mail->SMTPAuth = $SmtpAuth; 
        if($SmtpSecure!=''){
            $mail->SMTPSecure = $SmtpSecure; 
        }
        $mail->SMTPKeepAlive = true; 					
        $mail->Host = $SmtpHost;
        $mail->Port = $SmtpPort;
        $mail->Username = $SmtpUsername;
        $mail->Password = $SmtpPassword;
    } 

    $mail->setFrom(MAIL_SEND, $Operatore);

    $mail->addAddress($Email, $Nome.' '.$Cognome);

    $mail->isHTML(true);

    $mail->Subject = $oggetto_mail.' | '.$NOMEHOTEL;

    $messaggio = $contenuto_mail;
    
    $mail->msgHTML($messaggio, dirname(__FILE__));

    $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';

    if (!$mail->send()) {

        echo "Mailer Error: " . $mail->ErrorInfo;

        $prt->_goto(BASE_URL_SITO.'prenotazioni/'); 

    } else {

        $update = "UPDATE hospitality_guest SET DataVoucherRecSend = '".date('Y-m-d')."', DataValiditaVoucher = '".$DataValiditaVoucher."', IdMotivazione = ".$tag_voucher." WHERE Id = ".$id_prenotazione;
        $dbMysqli->query($update);
        #inserimento traccia invii
        $insert = "INSERT INTO hospitality_traccia_email_buoni_voucher(idsito,id_richiesta,NumPreno,oggetto,contenuto,data_invio) VALUES('".$idsito."','".$Id."','".$NumeroPrenotazione."','".addslashes($oggetto_mail)."','".addslashes($contenuto_mail)."','".date('Y-m-d H:i:s')."')";
        $dbMysqli->query($insert);

        
    }                 

}
 


?>