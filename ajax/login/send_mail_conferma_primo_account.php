<?php


include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/function.inc.php");
	


 	if($_REQUEST['action']=='check_user' && $_REQUEST['username']!=''  && $_REQUEST['password']!=''  && ($_REQUEST['email_quoto']!='' && strstr($_REQUEST['email_quoto'],'@'))){
 

		 function verifyCaptcha($response,$remoteip){

		   
		    $url  = "https://www.google.com/recaptcha/api/siteverify";
		    $url .= "?secret="  .urlencode(stripslashes('6LeFyQ4UAAAAAFqi2ZpmjUWBXRGp4PlX8U3aER3Q'));
		    $url .= "&response=".urlencode(stripslashes($response));
		    $url .= "&remoteip=".urlencode(stripslashes($remoteip));
		   

		    $response = file_get_contents($url);
		    $response = json_decode($response,true);
		   
		    return (object) $response;
		  }

	    
		if (isset($_REQUEST["g-recaptcha-response"])){

			$remoteip  = $_SERVER["REMOTE_ADDR"];
			$recaptcha = $_REQUEST["g-recaptcha-response"];

			$response = verifyCaptcha($recaptcha,$remoteip);

			if ($response->success) { 


				$nome        = addslashes($_REQUEST['nome']);
				$username    = addslashes($_REQUEST['username']);
				$password    = base64_encode($_REQUEST['password']);
				$email_quoto = $_REQUEST['email_quoto'];
				
				
				$query         = "SELECT
										siti.idsito,
										siti.email,
										siti.nome
									FROM
										siti
									WHERE
									 	siti.email = '".$email_quoto."' 						 								 	
									AND 
									 	siti.hospitality = 1 
									AND 
									 	siti.data_start_hospitality <= '".date('Y-m-d')."' 
									AND 
									 	siti.data_end_hospitality > '".date('Y-m-d')."'";

				$res           = $dbMysqli->query($query);
				$check_email   = sizeof($res);
				$row           = $res[0];
				$idsito        = $row['idsito'];
				$email_cliente = $row['email'];
				$nome_cliente  = $row['nome'];
				$link          = 'Clicca qui!!';


				if($check_email>0){


				        $sel   = "SELECT * FROM utenti_quoto WHERE idsito =  '".$idsito."'";
				        $r     = $dbMysqli->query($sel);
				        $check = sizeof($r);

				        if($check>0){

				            $alert = 'Hai già creato il tuo primo accesso a QUOTO!<br>Per recuperare i tuoi dati <a href="lost_password.php">CLICCA QUI</a>';

				        }else{

							$s   = "SELECT * FROM utenti_quoto WHERE username = '".$username."'";
							$re  = $dbMysqli->query($s);
							$chk_user = sizeof($re);

							$s2   = "SELECT * FROM utenti_quoto WHERE password = '".$password."'";
							$re2  = $dbMysqli->query($s2);
							$chk_pass = sizeof($re2);

							$s3   = "SELECT * FROM utenti WHERE password = '".$password."'";
							$re3  = $dbMysqli->query($s3);
							$chk_pass_super = sizeof($re3);

					        if($chk_user>0 || $chk_pass>0 || $chk_pass_super>0){							

					            $alert = 'La '.($chk_user>0?'UserName':'').' '.($chk_pass>0?'PassWord':'').' '.($chk_pass_super>0?'PassWord':'').' inserita è già in uso!';
									
					        }else{					
							
									$insert = "INSERT INTO utenti_quoto(idsito,
																		nome,
																		username,
																		password,
																		utenti,
																		config1,
																		config2,
																		config3,
																		config4,
																		config5,
																		config6,
																		dashboard_box,
																		statistiche,
																		crea_proposta,
																		preventivi,
																		conferme,
																		prenotazioni,
																		profila,
																		giudizi,
																		archivio,
																		schedine,
																		content_email,
																		content_landing,
																		anteprima_email,
																		anteprima_landing,
																		screenshots,
																		comunicazioni,
																		data_account,
																		abilitato) 
																		VALUES('".$idsito."',
																		'".addslashes($nome_cliente)."',
																		'".$username."',
																		'".$password."',
																		'1',
																		'1',
																		'1',
																		'1',
																		'1',
																		'1',
																		'1',
																		'1',
																		'1',
																		'1',
																		'1',
																		'1',
																		'1',
																		'1',
																		'1',
																		'1',
																		'1',
																		'1',
																		'1',
																		'1',
																		'1',													
																		'1',
																		'1',
																		'".date('Y-m-d')."',
																		'0')";
									$dbMysqli->query($insert);

										

									require (INC_PATH_CLASS.'PHPMailer/PHPMailerAutoload.php');
								        $mail 	= new PHPMailer(); 

										$msg 	.= top_email(1);
										$msg .= '<style>
													.btn-warning {
														    color: #fff;
														    background-color: #f0ad4e;
														    border-color: #eea236;
														}
														.btn {
														    display: inline-block;
														    padding: 6px 12px;
														    margin-bottom: 0;
														    font-size: 14px;
														    font-weight: normal;
														    line-height: 1.428571429;
														    text-align: center;
														    white-space: nowrap;
														    vertical-align: middle;
														    cursor: pointer;
														    background-image: none;
														    border: 1px solid transparent;
														    border-radius: 4px;
														    -webkit-user-select: none;
														    -moz-user-select: none;
														    -ms-user-select: none;
														    -o-user-select: none;
														    user-select: none;
												</style>';
										$msg 	.= '<table class="tbl_body" cellpadding="0px" cellspacing="0px" border="0px" align="center">
																<tr>
																<td class="title">
																	<img src="'.BASE_URL_SITO.'img/logo.png" /><br />
																	<h2>Verifica il tuo indirizzo email ed abilita accesso a QUOTO!</h2>
																</td>
															</tr>
															<tr>
																<td valign="top">									
																	Grazie per aver scelto QUOTO!<br>
																	 Hai inserito <b>'.$email_quoto.'</b> come indirizzo email per il tuo account QUOTO. Si prega di verificare questo indirizzo e-mail facendo clic sul pulsante qui sotto:
																	<br><br>
																</td>
															</tr>
															<tr>
																<td valign="top">									
																	La tua UserName = <b>'.$_REQUEST['username'].'</b>
																	<br><br>
																	<div align="center">
																		<a href="'.BASE_URL_SITO.'abilita_account.php?v='.base64_encode($idsito).'" class="btn btn-warning">Verifica</a>
																	</div>
																</td>
															</tr>							
															<tr>
																<td><div align="center"><b>Oppure verifica usando questo link</b> (copia ed incolla nel browser):</div></td>
															</tr>
															<tr>
																<td><div align="center"> '.BASE_URL_SITO.'abilita_account.php?v='.base64_encode($idsito).'</div></td>
															</tr>													
															<tr>
																<td valign="top">
																</td>
															</tr>							
														</table>';

										$msg 	.= footer_email(1);
										$msg    .= '<br><br><div align="center">Questa e-mail è stata inviata automaticamente dal software, non rispondere a questa e-mail!</div>';
										$body 	= $msg;

										$mail->IsSMTP(); 
										$mail->SMTPDebug = 0; 
										$mail->Debugoutput = 'html';
										$mail->SMTPAuth = SMTPAUTH; 
										$mail->SMTPKeepAlive = true; 					
										$mail->Host = SMTPHOST;
										$mail->Port = SMTPPORT;
										$mail->Username = SMTPUSERNAME;
										$mail->Password = SMTPPASSWORD; 
										
										$mail->SetFrom(MAIL_SEND, NOME_AMMINISTRAZIONE);

										$mail->AddAddress($email_cliente);
										$mail->AddAddress(MAIL_ADMIN);
										$mail->AddAddress(MAIL_ASSISTENZA);
													
										$mail->Subject    = 'Verifica il tuo indirizzo email ed abilita accesso a QUOTO!';
										$mail->MsgHTML($body);
										$mail->Send();

								$alert = 'La creazione del tuo account per acccedere a QUOTO è andata a buon fine.<br>A breve riceverai un\'email per verificare i dati inseriti ed abilitare definitivamente il tuo account!';

						}

				    }


				}else{

					$alert = 'L\'email inserita NON è associata a QUOTO!<br>Riprova oppure contatta Network Service s.r.l.';
				}

			}else{

			       $alert = 'Controllo codice CAPTCHA negativo!';
			}

		}
		
	}else{
			$alert = 'Campi input non compilati oppure errati!';
	}

echo $alert;

mysqli_close($conn_sui);
?>