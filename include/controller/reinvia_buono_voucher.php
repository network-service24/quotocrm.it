<?php
if($_GET['azione'] == 'send' && $_GET['param'] != '') {

        $select = "  SELECT 
                        hospitality_traccia_email_buoni_voucher.*,
                        hospitality_guest.Email,
                        hospitality_guest.Nome,
                        hospitality_guest.Cognome
                    FROM 
                        hospitality_traccia_email_buoni_voucher
                    INNER JOIN 
                        hospitality_guest
                    ON 
                        hospitality_guest.Id = hospitality_traccia_email_buoni_voucher.id_richiesta                       
                    WHERE 
                        hospitality_traccia_email_buoni_voucher.id_richiesta = ".$_REQUEST['param']."
                    AND
                        hospitality_traccia_email_buoni_voucher.idsito = ".IDSITO;

        $result = $dbMysqli->query($select);
        $dati   = $result[0];        

        $NumeroPrenotazione = $dati['NumeroPrenotazione'];
        $Email              = $dati['Email'];
        $Nome               = stripslashes($dati['Nome']);
        $Cognome            = stripslashes($dati['Cognome']);
        $oggetto            = stripslashes($dati['oggetto']);
        $contenuto          = stripslashes($dati['contenuto']); 
        $Operatore          = $dati['ChiPrenota'];

        //date_default_timezone_set('Etc/UTC');
        $qr = "SELECT * FROM hospitality_smtp WHERE idsito = ".IDSITO." AND Abilitato = 1";  
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
        $mail->Subject = $oggetto;

        $messaggio = '<html>
                        <head>
                            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                            <title>QUOTO!</title>
                            </head>
                            <body>
                                <table cellpadding="0" cellspacing="0" width="100%" border="0">
                                <tr>
                                    <td align="left" valign="top">
                                        '.$contenuto.'
                                    </td>
                                </tr>
                                </table>
                            </body>
                        </html>'; 	
        
        $mail->msgHTML($messaggio, dirname(__FILE__));
        $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
        if (!$mail->send()) {
                 echo "Mailer Error: " . $mail->ErrorInfo;
        } else {

            $sel = "SELECT count FROM hospitality_traccia_email_buoni_voucher  WHERE id_richiesta = ".$_REQUEST['param'];
            $res = $dbMysqli->query($sel);
            $rec = $res[0];

            if($rec['count']==0){
                $new_count = 2;
            }else{
                $new_count = ($rec['count']+1);
            }


            $update = "UPDATE hospitality_traccia_email_buoni_voucher SET count = ".$new_count." WHERE id_richiesta = ".$_REQUEST['param'];
            $dbMysqli->query($update);

            $prt->alertgo('Buono voucher inviato con successo!',BASE_URL_SITO.'buoni_voucher/');
        }                              
 
}