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


        $select = "SELECT hospitality_dizionario.etichetta,hospitality_dizionario_lingua.testo FROM hospitality_dizionario
                    INNER JOIN hospitality_dizionario_lingua ON hospitality_dizionario_lingua.id_dizionario = hospitality_dizionario.id
                    WHERE hospitality_dizionario.idsito = ".IDSITO."
                    AND hospitality_dizionario_lingua.Lingua = '".$Lingua."'
                    AND hospitality_dizionario_lingua.idsito = ".IDSITO;
        $res = $db->query($select);
        $rec = $db->result($res);
        foreach($rec as $key => $value) {
            $etichetta[$value['etichetta']]=$value['testo'];
        }

        $_oggetto           =     $etichetta['OGGETTO_RECENSIONE'];
        $_testo             =     $etichetta['TESTOMAIL_RECENSIONE']; 
        $_datarichiesta     =     $etichetta['DATA_RICHIESTA'];
        $_txtlink4          =     $etichetta['TXTLINK4'];
        $_paginariservata   =     $etichetta['PAGINARISERVATA'];
        $_saluti            =     $etichetta['SALUTI_H'];
        $_noreplay          =     $etichetta['NO_REPLAY_EMAIL'];


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

        $sel    = "SELECT 
                        Tripadvisor 
                    FROM 
                        hospitality_social 
                    WHERE 
                        hospitality_social.idsito = ".IDSITO."" ;

                $res    = $db->query($sel);
                $record = $db->row($res);

                $link = $record['Tripadvisor'];

   
        
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
        $mail->Subject = str_replace("[cliente]",$Nome.' '.$Cognome,$_oggetto).' | '.ucfirst($rows['nome']);
   
        $IdSito = IDSITO;
        include BASE_PATH_SITO.'email_template/manual_recensioni_send.php';        

        
        $mail->msgHTML($messaggio, dirname(__FILE__));
        $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
        if (!$mail->send()) {
                    echo "Mailer Error: " . $mail->ErrorInfo;
        } else {

                ##LOG##
                $_REQUEST['spedito'] = 'RecensioniManuali';
                $_REQUEST['id_richiesta'] = $_GET['param'];
                $_REQUEST['action']       = 'send_recensioni';
                include($_SERVER['DOCUMENT_ROOT'].'/v2/include/template/moduli/logs.inc.php');
                ##LOG##

                $update = "UPDATE hospitality_guest SET recensione_inviata = 1 WHERE Id = ".$IdRichiesta;
                $db->query($update);
                $update2 = "INSERT  INTO hospitality_traccia_email_cron (IdRichiesta,Idsito,DataAzione,TipoReInvio) VALUES ('".$IdRichiesta."','".IDSITO."','".date('Y-m-d H:i:s')."','RecensioniSend')";
                $db->query($update2);

                $prt->_goto(BASE_URL_SITO.'prenotazioni/recensioni/ok'); 
                 //header('Location:'.BASE_URL_SITO.'prenotazioni/recensioni/ok');


        }                 
             
     
 
}