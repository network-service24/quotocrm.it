<?php

    include($_SERVER['DOCUMENT_ROOT'].'/v2/include/settings.inc.php');

            
    $username   = DB_SUITEWEB_USER;
    $password   = DB_SUITEWEB_PASSWORD;
    $host       = DB_SUITEWEB_HOST;
    $dbname     = DB_SUITEWEB_NAME;

    $usernameQ   = DB_USER;
    $passwordQ   = DB_PASSWORD;
    $hostQ       = HOST;
    $dbnameQ     = DATABASE;


    require_once($_SERVER['DOCUMENT_ROOT'].'/v2/class/MysqliDb.php');


    $db_suiteweb = new MysqliDb($host, $username, $password, $dbname);
    $db_quoto    = new MysqliDb($hostQ, $usernameQ, $passwordQ, $dbnameQ);


    if($_REQUEST['action'] == 'send_email_no_dispo') {

                switch($_REQUEST['motivo']){
                    case "Assenza Disponibilità":
                        $content = $_REQUEST['testo_email_no_dispo'];
                    break;
                    case "Struttura Ricettiva Chiusa":
                        $content = $_REQUEST['2testo_email_no_dispo'];
                    break;
                    case "Altro":
                        $content = $_REQUEST['3testo_email_no_dispo'];
                    break;
                }
                    
                // query per i dati della richiesta
                $select = "SELECT * FROM hospitality_guest  WHERE Id = ".$_REQUEST['id_richiesta'];
                $dati_ = $db_quoto->query($select);
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
                        $oggetto_p = 'Gentile '.$Nome.' '.$Cognome.' per la sua richiesta di soggiorno non abbiamo disponibilità'; 
                        $noreply   = 'Questa e-mail è stata inviata automaticamente dal software, non rispondere a questa e-mail!'; 
                    break;
                    case "en":
                        $oggetto = 'Dear '.$Nome.' '.$Cognome.' your confirmation No.'.$NumeroPrenotazione.' of proposed stay at our accommodation has been canceled!';
                        $noreply = 'This email was sent automatically by the software, do not reply to this email!';   
                    break;
                    case "fr":
                        $oggetto = 'Cher '.$Nome.' '.$Cognome.' votre numéro de confirmation '.$NumeroPrenotazione.' du séjour proposé dans notre hébergement a été annulé!'; 
                        $noreply = 'Ce courriel a été envoyé automatiquement par le logiciel, ne répond pas à cet email!';  
                    break;
                    case "de":
                        $oggetto = 'Lieber '.$Nome.' '.$Cognome.' Ihre Bestätigungsnummer '.$NumeroPrenotazione.' des vorgeschlagenen Aufenthalts in unserer Unterkunft wurde abgesagt!';
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
                $rows_ = $db_suiteweb->query($sel);
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
                $rx_= $db_quoto->query($qr);
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
                                                <img src="'.BASE_URL_SUITEWEB.'v2/uploads/loghi_siti/'.$logo.'"><br><br>
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

                    $update = "UPDATE hospitality_guest SET NoDisponibilita = 1 WHERE Id = ".$IdRichiesta;
                    $db_quoto->query($update);

                    $insert = "INSERT INTO hospitality_motivi_disdetta (
                                                                            idsito,
                                                                            IdRichiesta,
                                                                            NumeroPrenotazione,
                                                                            Motivo,
                                                                            MotivoCustom,
                                                                            Testo,
                                                                            DataOperazione) 
                                                                            VALUES(
                                                                                '".$_REQUEST['idsito']."',
                                                                                '".$IdRichiesta."',
                                                                                '".$NumeroPrenotazione."',
                                                                                '".$_REQUEST['motivo']."',
                                                                                '".addslashes($_REQUEST['motivo_custom'])."',
                                                                                '".addslashes($_REQUEST['testo_email_no_dispo'])."',
                                                                                '".date('Y-m-d H:i:s')."')"; 
                    $db_quoto->query($insert);

                    //$prt->_goto(BASE_URL_SITO.'conferme/dispo/ok'); 
                    //header('Location:'.BASE_URL_SITO.'preventivi/dispo/ok');


                        
        } 

?>