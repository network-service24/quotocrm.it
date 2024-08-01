<?php
if($_REQUEST['azione'] == 'send' && $_REQUEST['param'] != '') {

    if($_REQUEST['valore']=='no'){  

        $update = "UPDATE hospitality_guest SET Voucher_send = 0, Chiuso = 1, Visibile = 1, DataChiuso = '".date('Y-m-d H:i:s')."' WHERE Id = ".$_REQUEST['param'];
        $dbMysqli->query($update);

        $_REQUEST['voucher']       = 'no';
        $_REQUEST['provenienza']   = 'voucher';
        $_REQUEST['id_richiesta']  = $_REQUEST['param'];
        include($_SERVER['DOCUMENT_ROOT'].'/include/template/moduli/logs.inc.php');
        $redirect ='<form action="'.BASE_URL_SITO.'prenotazioni/" method="POST" name="redirect" id="redirect">
                        <input type="hidden" name="idrichiesta" value="'.$_GET['param'].'">
                    </form>
                    <script>$(document).ready(function(){$("#redirect").submit();});</script>';
        //header('Location:'.BASE_URL_SITO.'prenotazioni/vau/ok_no');

    }else{ 
         // query per i dati della richiesta
        $query = $dbMysqli->query("SELECT * FROM hospitality_guest  WHERE Id = ".$_REQUEST['param']);
        $dati = $query[0];        

        // assegno alcune variabili
        $IdRichiesta    = $dati['Id'];
        $idsito         = $dati['idsito'];
        $Nome           = stripslashes($dati['Nome']);
        $Cognome        = stripslashes($dati['Cognome']);
        $Email          = $dati['Email'];
        $Operatore      = $dati['ChiPrenota'];
        $EmailOperatore = $dati['EmailSegretaria'];
        $Lingua         = $dati['Lingua']; 

        include($_SERVER['DOCUMENT_ROOT'].'/lingue/lang.php');

        $selS = 'SELECT siti.*,
                        utenti.logo,
                        comuni.nome_comune as comune,
                        province.sigla_provincia as prov
                        FROM siti 
                        INNER JOIN utenti ON utenti.idsito = siti.idsito
                        INNER JOIN comuni ON comuni.codice_comune = siti.codice_comune
                        INNER JOIN province ON province.codice_provincia = siti.codice_provincia
                        WHERE siti.idsito = "'.$idsito.'"';
        $recs =  $dbMysqli->query($selS);
        $rows =  $recs[0];
        $sito_tmp    = str_replace("http://","",$rows['web']);
        $sito_tmp    = str_replace("www.","",$sito_tmp);
        if($rows['https']==1){
            $http = 'https://';
        }else{
            $http = 'http://';
        }
        $SitoWeb   = $http.'www.'.$sito_tmp;   
        $logo      = $rows['logo'];   
        $NomeHotel = $rows['nome'];
        $EmailHotel= $rows['email'];            
        $tel       = $rows['tel'];
        $fax       = $rows['fax'];
        $cap       = $rows['cap'];
        $indirizzo = $rows['indirizzo'];
        $comune    = $rows['comune'];
        $prov      = $rows['prov'];
        $directory_sito = str_replace(".it","",$sito_tmp);
        $directory_sito = str_replace(".com","",$directory_sito);
        $directory_sito = str_replace(".net","",$directory_sito);
        $directory_sito = str_replace(".biz","",$directory_sito);
        $directory_sito = str_replace(".eu","",$directory_sito);
        $directory_sito = str_replace(".de","",$directory_sito);
        $directory_sito = str_replace(".es","",$directory_sito);
        $directory_sito = str_replace(".fr","",$directory_sito);

       $link = (URL_LANDING.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$idsito.'_c').'/voucher/');

       $check_invio_voucher_hotel = $fun->check_configurazioni(IDSITO,'check_email_voucher_hotel');

        //date_default_timezone_set('Etc/UTC');
        $qr = "SELECT * FROM hospitality_smtp WHERE idsito = ".$idsito." AND Abilitato = 1";  
        $ri = $dbMysqli->query($qr);
        $rx = $ri[0];
        if(is_array($rx)) {
            if($rx > count($rx))
                $isSMTP = count($rx); 
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

        if($check_invio_voucher_hotel==1){
            $mail->AddCC($EmailHotel, $Nome.' '.$Cognome);
        }

        $mail->isHTML(true);

        $mail->Subject = str_replace("[cliente]",$Nome.' '.$Cognome,OGGETTO_VAUCHER).' - '.$NomeHotel;

        include BASE_PATH_SITO.'email_template/voucher_mail.php';
        
        $mail->msgHTML($messaggio, dirname(__FILE__));
        $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
        if (!$mail->send()) {
                    echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
                $update = "UPDATE hospitality_guest SET Voucher_send = 1, Chiuso = 1, Visibile = 1, DataChiuso = '".date('Y-m-d H:i:s')."' WHERE Id = ".$IdRichiesta;
                $dbMysqli->query($update);

                $_REQUEST['voucher']       = 'si';
                $_REQUEST['provenienza']   = 'voucher';
                $_REQUEST['id_richiesta']  = $_REQUEST['param'];
                include($_SERVER['DOCUMENT_ROOT'].'/include/template/moduli/logs.inc.php');
                $redirect ='<form action="'.BASE_URL_SITO.'prenotazioni/" method="POST" name="redirect" id="redirect">
                                <input type="hidden" name="id_prenotazione" value="'.$_GET['param'].'">
                            </form>
                            <script>$(document).ready(function(){$("#redirect").submit();});</script>';


        }                 
             
    } 
 
}