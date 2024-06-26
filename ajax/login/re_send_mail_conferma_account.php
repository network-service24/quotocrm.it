<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/function.inc.php");


if($_POST['mod_password']!='' && $_POST['username_check']!=''  && ($_POST['email_quoto']!='' && strstr($_POST['email_quoto'],'@'))){
 
$username      = $_POST['username_check'];
$password      = $_POST['mod_password'];
$email_account = $_POST['email_quoto'];
$nome_cliente  = $_POST['nome_cliente'];
$idsito        = $_POST['idsito'];
								
										require_once(INC_PATH_CLASS.'PHPMailer/class.phpmailer.php');
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
														}
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
																	Ciao '.$nome_cliente.' <br>
																	 Hai inserito <b>'.$email_account.'</b> come indirizzo email e <b>'.$username.'</b> come username per il tuo account QUOTO!. Si prega di abilitare l\'accont facendo clic sul pulsante qui sotto:
																	<br><br>
																</td>
															</tr>
															<tr>
																<td valign="top">									
																	La tua nuova PassWord è <b>'.$password.'</b>
																	<br><br>';
											$msg 	.= '			<div align="center">
																		<a href="'.BASE_URL_SITO.'abilita_modifica_account.php?v='.base64_encode($idsito).'" class="btn btn-warning">Verifica</a>
																	</div>
																</td>
															</tr>							
															<tr>
																<td><div align="center"><b>Oppure verifica usando questo link</b> (copia ed incolla nel browser):</div></td>
															</tr>
															<tr>
																<td><div align="center"> '.BASE_URL_SITO.'abilita_modifica_account.php?v='.base64_encode($idsito).'</div></td>
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

										$mail->AddAddress($email_account);
										$mail->AddAddress(MAIL_ADMIN);
													
										$mail->Subject    = 'Verifica il tuo indirizzo email ed abilita accesso a QUOTO!';
										$mail->MsgHTML($body);
										$mail->Send();

										$alert = 'Re-Invio email per verifica nuovo account avvenuto con successo!';
								}

echo $alert;


?>