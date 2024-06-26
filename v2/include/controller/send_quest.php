<?php
if($_GET['azione'] == 'send' && $_GET['param'] != '') {
    
         // query per i dati della richiesta
        $db->query("SELECT * FROM hospitality_guest  WHERE Id = ".$_GET['param']);
        $dati = $db->row();        

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
        $Lingua         = $dati['Lingua']; 


        include($_SERVER['DOCUMENT_ROOT'].'/v2/lingue/lang.php');


        $db_suiteweb->query('SELECT siti.*,utenti.logo,
                                    comuni.nome_comune as comune,
                                    province.sigla_provincia as prov
                                    FROM siti 
                                    INNER JOIN utenti ON utenti.idsito = siti.idsito
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


        $grafica = check_template($rows['idsito']);
        $chek_l_t = check_landing_template($rows['idsito'],$IdRichiesta);
        if($chek_l_t != 'smart'){
            $chek_l_t = check_landing_type_template($rows['idsito'],$IdRichiesta);
        }

        if($grafica != 'default'){
            $grafica = check_landing_type_template($rows['idsito'],$IdRichiesta);
        }

        if($chek_l_t!=''){

            if($chek_l_t=='default'){
                $link = (URL_LANDING.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.IDSITO.'_c').'/questionario/');                          
            }else{
                $link = (URL_LANDING.$chek_l_t.'/'.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$rows['idsito'].'_c').'/questionario/');
            } 
            
        }else{

            if($grafica=='default'){
                $link = (URL_LANDING.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.IDSITO.'_c').'/questionario/');                          
            }else{
                $link = (URL_LANDING.$grafica.'/'.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$rows['idsito'].'_c').'/questionario/');
            }                

        }        

        unset($googl);
        
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
        $mail->Subject = str_replace("[cliente]",$Nome.' '.$Cognome,OGGETTO).' - '.NOMEHOTEL;
   

        include BASE_PATH_SITO.'email_template/questionario_mail.php';        

        
        $mail->msgHTML($messaggio, dirname(__FILE__));
        $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
        if (!$mail->send()) {
                    echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
                $update = "UPDATE hospitality_guest SET CS_inviato = 1 WHERE Id = ".$IdRichiesta;
                $db->query($update);

                $prt->_goto(BASE_URL_SITO.'prenotazioni/qes/ok'); 
                 //header('Location:'.BASE_URL_SITO.'prenotazioni/qes/ok');


        }                 
             
     
 
}