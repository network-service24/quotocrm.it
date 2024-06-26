<?php
if($_GET['azione'] == 'send' && $_GET['param'] != '') {

         // query per i dati della richiesta
        $db->query("SELECT * FROM hospitality_guest  WHERE Id = ".$_GET['param']);
        $dati = $db->row();        
       // giro le date in formato IT
        $DataA_tmp        = explode("-",$dati['DataArrivo']);
        $DataArrivo       = $DataA_tmp[2].'/'.$DataA_tmp[1].'/'.$DataA_tmp[0];
        $DataP_tmp        = explode("-",$dati['DataPartenza']);
        $DataPartenza     = $DataP_tmp[2].'/'.$DataP_tmp[1].'/'.$DataP_tmp[0];
        // assegno alcune variabili
        $IdRichiesta        = $dati['Id'];
        $NumeroPrenotazione = $dati['NumeroPrenotazione'];
        $Nome               = stripslashes($dati['Nome']);
        $Cognome            = stripslashes($dati['Cognome']); 
        $Email              = $dati['Email'];
        $Operatore          = $dati['ChiPrenota'];
        if($Operatore == ''){
                $Operatore = NOMEHOTEL;
        }
        $EmailOperatore = $dati['EmailSegretaria'];
        if($EmailOperatore == ''){
                $EmailOperatore = EMAILHOTEL;
        }  
        $Lingua         = $dati['Lingua']; 

        include($_SERVER['DOCUMENT_ROOT'].'/v2/lingue/lang.php');

       
        $_datisoggiorno     =     DATISOGGIORNO;
        $_dataarrivo        =     DATAARRIVO;
        $_datapartenza      =     DATAPARTENZA;
 

        $db_suiteweb->query('SELECT siti.*,
                                    comuni.nome_comune as comune,
                                    province.sigla_provincia as prov
                                    FROM siti 
                                    INNER JOIN comuni ON comuni.codice_comune = siti.codice_comune
                                    INNER JOIN province ON province.codice_provincia = siti.codice_provincia
                                    WHERE siti.idsito = "'.$_SESSION['IDSITO'].'"');
        $rows =  $db_suiteweb->row();
        $sito_tmp    = str_replace("http://","",$rows['web']);
        $sito_tmp    = str_replace("www.","",$sito_tmp);
        if($rows['https']==1){
            $http = 'https://';
        }else{
            $http = 'http://';
        }
        $SitoWeb   = $http.'www.'.$sito_tmp;             
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



        //date_default_timezone_set('Etc/UTC');
        $qr = "SELECT * FROM hospitality_smtp WHERE idsito = ".IDSITO." AND Abilitato = 1";  
        $ri = $db->query($qr);
        $rx = $db->row($ri);
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
        //include INC_PATH_CLASS.'PHPMailer/class.smtp.php';
        $mail = new PHPMailer;
        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        //$mail->SMTPDebug = 0;
        //$mail->Debugoutput = 'html';
        //$mail->Host = 'smtp.gmail.com';
        //$mail->SMTPKeepAlive = true; // SMTP connection will not close after each email sent, reduces SMTP overhead            
        //$mail->Port = 587;
        //$mail->SMTPSecure = 'tls';
        //$mail->SMTPAuth = true;
        //$mail->Username = "network.service.rimini@gmail.com";
        //$mail->Password = "1106Rimini74";
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
        $mail->Subject = str_replace("[cliente]",$Nome.' '.$Cognome,OGGETTO_DISPONIBILITA).' - '.NOMEHOTEL;

        include BASE_PATH_SITO.'email_template/disponibilita_mail.php';
        
        $mail->msgHTML($messaggio, dirname(__FILE__));
        $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
        if (!$mail->send()) {
                    echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
                $db->query("UPDATE hospitality_guest SET NoDisponibilita = 1 WHERE Id = ".$_GET['param']);
                
                $prt->_goto(BASE_URL_SITO.'preventivi/dispo/ok'); 
                //header('Location:'.BASE_URL_SITO.'preventivi/dispo/ok');


        }                 
             
 
}