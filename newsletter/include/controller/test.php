<?php
require INC_PATH_CLASS.'PHPMailer/PHPMailerAutoload.php';
$mail = new PHPMailer;

$mail->IsSMTP(); // enable SMTP
$mail->Mailer = "smtp"; 
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = "quoto.realsender.com";
$mail->Port = 25; // or 587
$mail->Username = "test-367082";
$mail->Password = "AwGLwz92Jo";


$mail->From = "marcello@network-service.it";
$mail->FromName = "Marcello";



$mail->addAddress('marcello@network-service.it','Marcello');

$mail->isHTML(true);

$mail->Subject = str_replace("[cliente]",$value['nome'].' '.$value['cognome'], $_REQUEST['oggetto']).' | '.NOMEHOTEL;



$messaggio = 'Prova';
$mail->msgHTML($messaggio, dirname(__FILE__));

$mail->AltBody = 'Per visualizzare il messaggio, si prega di utilizzare un visualizzatore e-mail compatibile con HTML!';

$mail->send();

?>