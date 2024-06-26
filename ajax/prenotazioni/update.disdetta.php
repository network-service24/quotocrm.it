<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


        $query = $dbMysqli->query("SELECT * FROM hospitality_guest  WHERE Id = ".$_REQUEST['id']);
        $dati = $query[0];        

        // assegno alcune variabili
        $DataA_tmp          = explode("-",$dati['DataArrivo']);
        $DataArrivo         = $DataA_tmp[2].'/'.$DataA_tmp[1].'/'.$DataA_tmp[0];
        $DataP_tmp          = explode("-",$dati['DataPartenza']);
        $DataPartenza       = $DataP_tmp[2].'/'.$DataP_tmp[1].'/'.$DataP_tmp[0];
        $IdRichiesta        = $dati['Id'];
        $idsito             = $dati['idsito'];
        $Nome               = stripslashes($dati['Nome']);
        $Cognome            = stripslashes($dati['Cognome']);
        $Email              = $dati['Email'];
        $Operatore          = $dati['ChiPrenota'];
        $EmailOperatore     = $dati['EmailSegretaria'];
        $Lingua             = $dati['Lingua']; 
        $NumeroPrenotazione = $dati['NumeroPrenotazione'];
      

        include_once(BASE_PATH_SITO.'/lingue/lang.php');

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
        $tel       = $rows['tel'];
        $fax       = $rows['fax'];
        $cap       = $rows['cap'];
        $indirizzo = $rows['indirizzo'];
        $comune    = $rows['comune'];
        $prov      = $rows['prov'];


        //date_default_timezone_set('Etc/UTC');
        $qr = "SELECT * FROM hospitality_smtp WHERE idsito = ".$idsito." AND Abilitato = 1";  
        $ri = $dbMysqli->query($qr);
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

        $mail->Subject = str_replace("[cliente]",$Nome.' '.$Cognome,OGGETTO_DISDETTA).' - '.$NomeHotel;

        include BASE_PATH_SITO.'email_template/disdetta_mail.php';
        
        $mail->msgHTML($messaggio, dirname(__FILE__));
        $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
        if (!$mail->send()) {
                    echo "Mailer Error: " . $mail->ErrorInfo;
        } else {

                $query = 'UPDATE hospitality_guest SET Disdetta = 1 WHERE Id = '.$IdRichiesta;
                $dbMysqli->query($query);

                $_REQUEST['voucher']       = 'si';
                $_REQUEST['provenienza']   = 'disdetta';
                $_REQUEST['id_richiesta']  = $_REQUEST['param'];
                 include(BASE_PATH_SITO.'/include/template/moduli/logs.inc.php');



        }                 
             

?>