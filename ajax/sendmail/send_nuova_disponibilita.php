<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


    if($_REQUEST['action'] == 'send_email_dispo') {


                $content = $_REQUEST['testo_email_dispo'];

                // query per i dati della richiesta
                $select = "SELECT * FROM hospitality_guest  WHERE Id = ".$_REQUEST['id_richiesta'];
                $dati_ = $dbMysqli->query($select);
                $dati = $dati_[0];        
                //                  assegno alcune variabili
                $IdRichiesta        =       $dati['Id'];
                $NumeroPrenotazione =       $dati['NumeroPrenotazione'];
                $Nome               =       stripslashes($dati['Nome']);
                $Cognome            =       stripslashes($dati['Cognome']); 
                $Email              =       $dati['Email'];
                $Operatore          =       $dati['ChiPrenota'];
                $EmailOperatore     =       $dati['EmailSegretaria'];
                $Lingua             =       $dati['Lingua']; 

                switch($Lingua){
                    case "it": 
                        $oggetto_p = 'Gentile '.$Nome.' '.$Cognome.', per la sua richiesta di soggiorno è tornata disponibilità'; 
                        $noreply   = 'Questa e-mail è stata inviata automaticamente dal software, non rispondere a questa e-mail!'; 
                    break;
                    case "en":
                        $oggetto = 'Dear '.$Nome.' '.$Cognome.', availability is back for your stay request';
                        $noreply = 'This email was sent automatically by the software, do not reply to this email!';   
                    break;
                    case "fr":
                        $oggetto = 'Cher '.$Nome.' '.$Cognome.', la disponibilité est de retour pour votre demande de séjour'; 
                        $noreply = 'Ce courriel a été envoyé automatiquement par le logiciel, ne répond pas à cet email!';  
                    break;
                    case "de":
                        $oggetto = 'Lieber '.$Nome.' '.$Cognome.', die Verfügbarkeit für Ihre Aufenthaltsanfrage ist zurück';
                        $noreply = 'Diese E-Mail wurde von der Software automatisch gesendet wird, antworten Sie nicht auf diese E-Mail!';   
                    break;
                }


                $sel = 'SELECT siti.*,
                                            comuni.nome_comune as comune,
                                            province.sigla_provincia as prov,
                                            utenti.logo
                                            FROM siti 
                                            INNER JOIN utenti ON utenti.idsito = siti.idsito
                                            INNER JOIN comuni ON comuni.codice_comune = siti.codice_comune
                                            INNER JOIN province ON province.codice_provincia = siti.codice_provincia
                                            WHERE siti.idsito = "'.$_REQUEST['idsito'].'"';
                $rows_ = $dbMysqli->query($sel);
                $rows = $rows_[0]; 

                $sito_tmp    = str_replace("http://","",$rows['web']);
                $sito_tmp    = str_replace("www.","",$sito_tmp);
                if($rows['https']==1){
                    $http = 'https://';
                }else{
                    $http = 'http://';
                }
                $SitoWeb         = $http.'www.'.$sito_tmp;  
                $NomeStruttura   = $rows['nome'];              
                $tel             = $rows['tel'];
                $fax             = $rows['fax'];
                $cap             = $rows['cap'];
                $indirizzo       = $rows['indirizzo'];
                $comune          = $rows['comune'];
                $prov            = $rows['prov'];
                $emailHotel      = $rows['email'];
                $logo            = $rows['logo'];

                $indirizzo_completo =   '<b>'.$NomeStruttura.'</b><br>
                '.$indirizzo.' - '.$cap.' '.$comune.' ('.$prov.')<br>
                Tel. '.$tel.'  E-mail: '.$emailHotel;


                //date_default_timezone_set('Etc/UTC');
                $qr = "SELECT * FROM hospitality_smtp WHERE idsito = ".$_REQUEST['idsito']." AND Abilitato = 1";  
                $rx_= $dbMysqli->query($qr);
                $rx = $rx_[0];    
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
            
                    $mail->setFrom(MAIL_SEND, $NomeStruttura);

                    //$mail->addReplyTo(EMAILHOTEL, NOMEHOTEL);

                    $mail->addAddress($Email, $Nome.' '.$Cognome);

                    $mail->isHTML(true);

                    $mail->Subject = $oggetto_p;

                    $contenuto = str_replace("[cliente]",$Nome.' '.$Cognome, $content);

                    $contenuto = str_replace("[struttura]",$indirizzo_completo, $contenuto);


                    $messaggio = '<html>
                                    <head>
                                        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                                        <title>QUOTO!</title>
                                    </head>
                                    <body>
                                        <table cellpadding="0" cellspacing="0" width="100%" border="0">
                                            <tr>
                                                <td align="left" valign="top">
                                                <img src="'.BASE_URL_SITO.'v2/uploads/loghi_siti/'.$logo.'"><br><br>
                                                    '.$contenuto.'
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top" style="height:30px">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top" style="height:30px"><span  style="font-size:11px;color:#666666">'.$noreply.'</span></td>
                                            </tr> 
                                            <tr>
                                                <td align="left" valign="top"><span  style="font-size:11px;">Powered By QUOTO! - Network Service s.r.l</span></td>
                                            </tr>                                       
                                        </table>
                                    </body>
                                </html>'; 

                    $mail->msgHTML($messaggio, dirname(__FILE__));

                    $mail->AltBody = 'Per visualizzare il messaggio, si prega di utilizzare un visualizzatore e-mail compatibile con HTML!';

                    $mail->send();
                    
                    $update = "UPDATE hospitality_motivi_disdetta  SET DataReContact = '".date('Y-m-d H:i:s')."' WHERE IdRichiesta = ".$_REQUEST['id_richiesta']." AND idsito = ".$_REQUEST['idsito'];
                    $dbMysqli->query($update);

            ##LOGS OPERAZIONI
            $log->lwrite('idsito = '.$_REQUEST['idsito'].', operatore = '.$_SESSION['user_accesso'].', IP = '.$_SERVER['REMOTE_ADDR'].', numero_prenotazione = '.$NumeroPrenotazione.', inviata email per tornata disponibilita');
            $log->lclose(); 
                        
        } 

?>