<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/function.inc.php");

if($_REQUEST['action'] == 'send') {   

    $idutente = $_REQUEST['idutente'];

    $select = "SELECT * FROM utenti_admin WHERE idutente = ".$idutente;  
    $result = $dbMysqli->query($select);
    $record = $result[0];

    $NomeUtente    = $record['utente_nome'];
    $CognomeUtente = $record['utente_cognome'];
    $EmailUtente   = $record['utente_email'];
    $username      = $record['username'];
    $password      = $record['password']; 

    $SmtpAuth     = true;
    $SmtpHost     = 'pro.eu.turbo-smtp.com';
    $SmtpPort     = 587;
    $SmtpUsername = 'info@network-service.it';
    $SmtpPassword = 'TesD1300524!';
   

        require INC_PATH_CLASS.'PHPMailer/PHPMailerAutoload.php';

        $mail = new PHPMailer;
        /** se turbo smtp dovesse essere disattivato come servizio, sarà sufficiente commentare queste poche righe */
        $mail->IsSMTP(); 
        $mail->SMTPDebug     = 0; 
        $mail->Debugoutput   = 'html';
        $mail->SMTPAuth      = $SmtpAuth; 
        $mail->SMTPKeepAlive = true; 					
        $mail->Host          = $SmtpHost;
        $mail->Port          = $SmtpPort;
        $mail->Username      = $SmtpUsername;
        $mail->Password      = $SmtpPassword;
        /** fine */
        $mail->setFrom(MAIL_SEND, NOME_AMMINISTRAZIONE);
        $mail->addAddress($EmailUtente, $NomeUtente.' '.$CognomeUtente);
        $mail->isHTML(true);
        $mail->Subject = 'I dati per accedere a '.NOME_SUPER_ADMIN;

        $messaggio 	= top_email(1);

    echo    $messaggio 	.= '<table class="tbl_body" cellpadding="0px" cellspacing="0px" border="0px" align="center">
                                <tr>
                                <td class="title">
                                        <img src="'.BASE_URL_SITO.'img/logo.png" /><br />
                                    <h2>Dati di Accesso a '.NOME_SUPER_ADMIN.'</h2>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    Ciao <b>'.$NomeUtente.'</b><br />
                                    <br />
                                    Ecco la tua Username: <b>'.$username.'</b><br />
                                    Ecco la tua Password: <b>'.base64_decode($password).'</b><br />
                                    <br />
                                    Ricorda l\'url per accedere al Back-Office di '.NOME_SUPER_ADMIN.' è: <b>'.BASE_URL_ADMIN.'login.php</b><br />
                                    <br />
                                    Questo messaggio è stato generato automaticamente, per tanto non rispondere direttamente a questa e-mail. 
                                </td>
                            </tr>
                        </table>';

        $messaggio 	.= footer_email(1);

        
        $mail->msgHTML($messaggio, dirname(__FILE__));
        $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
        $mail->send();      
             
     
 
}