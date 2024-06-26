<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include(INC_PATH_SITO.'function.inc.php');
 error_reporting(0); 

	$username   = DB_USER;
	$password   = DB_PASSWORD;
	$host       = HOST;
	$dbname     = DATABASE;

	$conn = mysqli_connect($host, $username, $password, $dbname) or die ("Errore connesione database");
    mysqli_set_charset($conn,'utf8');

	$user = DB_USER;
	$pass = DB_PASSWORD;
	$h    = HOST;
	$db   = DATABASE;

	$conn_sui = mysqli_connect($h, $user, $pass, $db) or die ("Error connecting to database");
	mysqli_set_charset($conn_sui,'utf8');	


 	if($_REQUEST['action']=='send' && $_REQUEST['id_richiesta']!='' && $_REQUEST['email_utente']!=''){
 		
		$id_richiesta = $_REQUEST['id_richiesta'];
		$email_utente = $_REQUEST['email_utente'];

		$query              = 'SELECT DataRichiesta,NumeroPrenotazione,idsito FROM hospitality_guest WHERE Id = "'.$id_richiesta.'"';
		$res                = mysqli_query($conn,$query);
		$r                  = mysqli_fetch_assoc($res);
		$NumeroPrenotazione = $r['NumeroPrenotazione'];
		$data_richiesta      = gira_data($r['DataRichiesta']);


		$suite    = 'SELECT web,https FROM siti WHERE idsito = "'.$r['idsito'].'"';
		$resu     = mysqli_query($conn_sui,$suite);
		$rows     = mysqli_fetch_assoc($resu);

		$sito_tmp = str_replace("http://","",$rows['web']);
		$sito_tmp = str_replace("www.","",$sito_tmp);
		$http     = ($rows['https']==1?'https://':'http://');
		$sitoweb  = $http.'www.'.$sito_tmp;		


		$testo_mail = '<p>Vuoi modificare i consensi GDPR per la tua scelta di soggiorno sul preventivo Nr.'.$NumeroPrenotazione.'  del '.$data_richiesta.' proveniente dal software QUOTO per il sito '.$sitoweb.'<br>Clicca sul link per raggiungere la pagina a te dedicata!</p>
							<span style="font-size:80%;color:#666">Would you like to change the GDPR consents for your choice of stay on the estimate  Nr.'.$NumeroPrenotazione.' of the '.$data_richiesta.' coming from the QUOTO software for site '.$sitoweb.'<br>Click on the link to reach the page dedicated to you!</span>';
	

						require_once(INC_PATH_CLASS.'PHPMailer/class.phpmailer.php');
				        $mail 	= new PHPMailer(); 

						$msg 	.= top_email(1);
						$msg 	.= '<table class="tbl_body" cellpadding="0px" cellspacing="0px" border="0px" align="center">
												<tr>
												<td class="title">
													<img src="'.BASE_URL_SITO.'img/logo.png" /><br />
													<h2>'.$email_utente.'</h2>
												</td>
											</tr>
											<tr>
												<td valign="top">
													'.$testo_mail.'
													<br><br>
												</td>
											</tr>
											<tr>
												<td><b>Link alla tua pagina personale:</b> <a style="color:#004080" href="'.BASE_URL_SITO.'consensi/quoto.php?val='.base64_encode($id_richiesta.'#'.$email_utente).'">GDPR Consensi</a></td>
											</tr>
											<tr>
												<td valign="top">
												</td>
											</tr>							
										</table>';

						$msg 	.= footer_email(1);
						$msg    .= '<br><br><div align="center">Questa e-mail è stata inviata automaticamente dal software, non rispondere a questa e-mail!</div>';
						$body 	= $msg;
						$mail->SetFrom(MAIL_SEND, NOME_AMMINISTRAZIONE);

						$mail->AddAddress($email_utente);
									
						$mail->Subject    = 'Modifica i consensi GDPR per la proposta di soggiorno proveniente da QUOTO per il sito: '.$sitoweb.'! (Change GDPR consents!)';
						$mail->MsgHTML($body);
						$mail->Send();




	}
mysqli_close($conn_q);
mysqli_close($conn);
?>