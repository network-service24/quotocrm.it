<?php
if($_GET['azione'] == 'send' && $_GET['param'] != '') {
    
         // query per i dati della richiesta
        $sel  = $dbMysqli->query("SELECT * FROM hospitality_guest  WHERE Id = ".$_GET['param']);
        $dati = $sel[0];        

        // assegno alcune variabili
        $IdRichiesta    = $dati['Id'];
        $Nome           = stripslashes($dati['Nome']);
        $Cognome        = stripslashes($dati['Cognome']);  
        $Email          = $dati['Email'];
        $Operatore      = $dati['ChiPrenota'];
        if($Operatore == ''){
                $Operatore = NOMEHOTEL;
        }
        $EmailOperatore = $dati['EmailSegretaria'];
        if($EmailOperatore == ''){
                $EmailOperatore = EMAILHOTEL;
        }  
        $Lingua = $dati['Lingua']; 
        $idsito = $dati['idsito'];

        include($_SERVER['DOCUMENT_ROOT'].'/lingue/lang.php');


        $select = $dbMysqli->query('SELECT siti.*,utenti.logo,
                                    comuni.nome_comune as comune,
                                    province.sigla_provincia as prov
                                    FROM siti 
                                    INNER JOIN utenti ON utenti.idsito = siti.idsito
                                    INNER JOIN comuni ON comuni.codice_comune = siti.codice_comune
                                    INNER JOIN province ON province.codice_provincia = siti.codice_provincia
                                    WHERE siti.idsito = "'.$_SESSION['IDSITO'].'"');
        $rows =  $select[0];
        $sito_tmp    = str_replace("http://","",$rows['web']);
        $sito_tmp    = str_replace("www.","",$sito_tmp);
        if($rows['https']==1){
            $http = 'https://';
        }else{
            $http = 'http://';
        }
        $SitoWeb   = $http.'www.'.$sito_tmp;        
        $logo      = $rows['logo'];
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

       $link = (URL_LANDING.'checkin/'.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.IDSITO).'/index/');

       $qr = "SELECT * FROM hospitality_smtp WHERE idsito = ".IDSITO." AND Abilitato = 1";  
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
        //$mail->addReplyTo($EmailOperatore, $Operatore);
        $mail->addAddress($Email, $Nome.' '.$Cognome);
        $mail->isHTML(true);
        $mail->Subject = str_replace("[cliente]",$Nome.' '.$Cognome,OGGETTO_CHECKIN).' - '.NOMEHOTEL;
   

        include BASE_PATH_SITO.'email_template/sendcheckin_mail.php';        
        
        $mail->msgHTML($messaggio, dirname(__FILE__));
        $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }else{
            $update = "UPDATE hospitality_guest SET CheckinInviato = 1 WHERE Id = ".$IdRichiesta;
            $dbMysqli->query($update);
            
            $prt->_goto(BASE_URL_SITO.'checkinonline-prenotazioni_esterne/checkin/ok');

        }
     
 
}