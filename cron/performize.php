<?php
require($_SERVER['DOCUMENT_ROOT'] . '/include/settings.inc.php');
require($_SERVER['DOCUMENT_ROOT'] . '/include/declaration.inc.php');

date_default_timezone_set('Europe/Rome');

require $_SERVER['DOCUMENT_ROOT'] . '/class/PHPMailer/PHPMailerAutoload.php';


$isSMTP = 1;
$send_mail = 'info@quotocrm.it';
$Operatore = 'Network Service';

$dati = ['Email' => 'andrea@performize.it', 'Nome' => 'Mario', 'Cognome' => 'Rossi'];
extract($dati);

$rows = ['nome' => 'Nome'];

$messaggio = '<p>Email di test con turbo-smtp ' . date('Y-m-d H:i:s');
$_oggetto = 'Test turbo-smtp ' . date('Y-m-d H:i:s');

$SmtpAuth = true;
$SmtpHost = 'pro.eu.turbo-smtp.com';
$SmtpPort = 587;
$SmtpSecure = 'tls';
$SmtpUsername = 'info@network-service.it';
$SmtpPassword = 'TesD1300524!';
$NumberSend = 1;


$mail = new PHPMailer;

//$mail->SMTPAutoTLS = false;
// invio tramite SMTP
if ($isSMTP > 0) {
    $mail->IsSMTP();
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = 'html';
    $mail->SMTPAuth = $SmtpAuth;
    if ($SmtpSecure != '') {
        $mail->SMTPSecure = $SmtpSecure;
    }
    $mail->SMTPKeepAlive = true;
    $mail->Host = $SmtpHost;
    $mail->Port = $SmtpPort;
    $mail->Username = $SmtpUsername;
    $mail->Password = $SmtpPassword;
}

$mail->setFrom($send_mail, $Operatore);
//$mail->addReplyTo($EmailOperatore, $Operatore);
$mail->addAddress($dati['Email'], $dati['Nome'] . ' ' . $dati['Cognome']);
$mail->isHTML(true);
$mail->Subject = str_replace("[cliente]", $Nome . ' ' . $Cognome, $_oggetto) . ' | ' . ucfirst($rows['nome']);


$mail->msgHTML($messaggio, dirname(__FILE__));
$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';

if ($mail->send()) {
    echo 'inviata';
} else {
    echo 'errore: ' . $mail->ErrorInfo;  // Stampa l'errore
}


