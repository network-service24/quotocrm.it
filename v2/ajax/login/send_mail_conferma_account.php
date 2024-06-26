<?php

include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/v2/include/declaration.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/v2/include/function.inc.php");


 	if($_POST['action']=='check_pass' && $_POST['mod_password']!='' && $_POST['username_check']!=''  && ($_POST['email_quoto']!='' && strstr($_POST['email_quoto'],'@'))){
 

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

						$password      = addslashes($_POST['mod_password']);
						$username      = addslashes($_POST['username_check']);
						$email_account = $_POST['email_quoto'];			
						
						$query         = "SELECT
												siti.idsito,
												siti.email,
												siti.nome,
												utenti.idutente
											FROM
												siti
											INNER JOIN 
												utenti 
											ON 
												utenti.idsito = siti.idsito
											WHERE
												siti.email = '".$email_account."' 	
											AND 
												utenti.username = '".$username."' 			 								 	
											AND 
												utenti.blocco_accesso = 0
											AND 
												siti.hospitality = 1 
										   	AND 
												siti.data_start_hospitality <= '".date('Y-m-d')."' 
										   	AND 
												siti.data_end_hospitality > '".date('Y-m-d')."'";

						$res           = $dbMysqli_suiteweb->query($query);
						$check_email   = sizeof($res);
						$row           = $res[0];
						$idsito        = $row['idsito'];
						$idutente      = $row['idutente'];
						$email_cliente = $row['email'];
						$nome_cliente  = $row['nome'];
						$link          = 'Clicca qui!!';


						if($check_email>0){


						
								$select       = "SELECT
														*
													FROM
														utenti_password
													WHERE
														utenti_password.password = '".$password."'
													AND
														utenti_password.idutente = '".$idutente ."'
													AND
														utenti_password.idsito = '".$idsito ."'";

								$risult        = $dbMysqli_suiteweb->query($select);
								$check_pass    = sizeof($risult);

								if($check_pass == 0){


										#inserimento della nuova PASSWORD NELLA TABELLA CRONOLOGIA PASSWORD
										$insert = "INSERT INTO utenti_password(idutente,idsito,password) VALUES('".$idutente."','".$idsito."','".$password."')";
										$dbMysqli_suiteweb->query($insert);
										#update password account di suiteweb tabella utenti
										$update = "UPDATE utenti SET password = '".$password."', blocco_accesso = 1, data_account = '".date('Y-m-d')."' WHERE idutente = '".$idutente."' ";
										$dbMysqli_suiteweb->query($update);
										#select tabella pannelli esterni
										$select = "SELECT * FROM pannelli_esterni WHERE idsito = ".$idsito." AND nome_pannello LIKE 'Entra in Quoto!'";
										$result = $dbMysqli_suiteweb->query($select);
										$check_pannelli = sizeof($result);
										if($check_pannelli>0){
											$Idpannello = $result[0]['idpannello'];
											#update password account di suiteweb tabella utenti
											$update2 = "UPDATE pannelli_esterni SET valore_2 = '".$password."' WHERE idpannello = ".$Idpannello;
											$dbMysqli_suiteweb->query($update2);
										}
								
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
																	La tua nuova PassWord è <b>'.$_REQUEST['mod_password'].'</b>
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

										$mail->AddAddress($email_cliente);
										$mail->AddAddress(MAIL_ADMIN);
													
										$mail->Subject    = 'Verifica il tuo indirizzo email ed abilita accesso a QUOTO!';
										$mail->MsgHTML($body);
										$mail->Send();

										$alert = 'L\'aggiornamento della tua PassWord è andato a buon fine!<br>
													A breve riceverai un\'email per verificare i dati inseriti ed abilitare definitivamente il tuo nuovo accesso al software!<br>
													Se non trovi l\'email appena inviata prova a controllare la directory di SPAM<br>
													<div id="risultato_resend"></div>
													<form  method="POST" name="form_p_resend" id="form_p_resend" >
														oppure
														<input type="hidden" name="username_check" value="'.$username.'"/>
														<input type="hidden" name="mod_password" value="'.$_REQUEST['mod_password'].'"/>
														<input type="hidden" name="email_quoto" value="'.$email_account.'"/>
														<input type="hidden" name="idsito" value="'.$idsito.'"/>
														<input type="hidden" name="nome_cliente" value="'.$nome_cliente.'"/>
														<a href="javascript:;" id="ReSendVerifyAccount" class="btn btn-warning btn-md btn-xs waves-effect waves-light text-center">
															<i class="fa fa-envelope"></i> Re-invia email di verifica account creato oggi!
														</a>
													</form>
													<script>
													$("#ReSendVerifyAccount").on("click", function () {
														var dati = $("#form_p_resend").serialize();
														$.ajax({
															url: "'.BASE_URL_SITO.'ajax/login/re_send_mail_conferma_account.php",
															type: "POST",
															data: dati,
															dataType: "html",
															success: function(data) {
																	$("#mess").hide();
																	$("#risultato_resend").html("<div class=\"alert alert-warning text-center\">"+data+"</div>");
																	$("#form_p_resend").hide();
																}
														});
														return false; 
													});
													</script>
													<a href="'.BASE_URL_SITO.'login.php">&larr; Torna al login!</a>';
								}else{

									$alert = 'La password scelta è già stata usata! Cambiala!
												<form  action="'.BASE_URL_SITO.'login.php" method="POST" name="form_p_recheck" id="form_p_recheck" >
													<input type="hidden" name="pass_scaduta" value="1"/>
													<a href="javascript:;" id="sendForm">Ricomincia la procedura!</a>
												</form> 
												<script language="JavaScript">
													$("#sendForm").on("click",function(){
														document.form_p_recheck.submit();
													});					
												</script>';
								}
						}else{

							$alert = 'L\'email o la username inserite NON sono associate a QUOTO!<br>Riprova oppure contatta Network Service s.r.l.
										<form  action="'.BASE_URL_SITO.'login.php" method="POST" name="form_p_recheck" id="form_p_recheck" >
											<input type="hidden" name="pass_scaduta" value="1"/>
											<a href="javascript:;" id="sendForm">Ricomincia la procedura!</a>
										</form> 
										<script language="JavaScript">
											$("#sendForm").on("click",function(){
												document.form_p_recheck.submit();
											});	
										</script>';
						}	

			}else{

						$alert = 'Controllo codice CAPTCHA negativo!
									<form  action="'.BASE_URL_SITO.'login.php" method="POST" name="form_p_recheck" id="form_p_recheck" >
										<input type="hidden" name="pass_scaduta" value="1"/>
										<a href="javascript:;" id="sendForm">Ricomincia la procedura!</a>
									</form> 
									<script language="JavaScript">
										$("#sendForm").on("click",function(){
											document.form_p_recheck.submit();
										});	
									</script>';
			}


		}else{

				$alert = 'Controllo codice CAPTCHA negativo!								
							<form  action="'.BASE_URL_SITO.'login.php" method="POST" name="form_p_recheck" id="form_p_recheck" >
								<input type="hidden" name="pass_scaduta" value="1"/>
								<a href="javascript:;" id="sendForm">Ricomincia la procedura!</a>
							</form> 
							<script language="JavaScript">
								$("#sendForm").on("click",function(){
									document.form_p_recheck.submit();
								});	
							</script>';
		}

		
		
	}else{
			$alert = 'Campi input non compilati oppure errati!								
						<form  action="'.BASE_URL_SITO.'login.php" method="POST" name="form_p_recheck" id="form_p_recheck" >
							<input type="hidden" name="pass_scaduta" value="1"/>
							<a href="javascript:;" id="sendForm">Ricomincia la procedura!</a>
						</form> 
						<script language="JavaScript">
							$("#sendForm").on("click",function(){
								document.form_p_recheck.submit();
							});	
						</script>';
	}

echo $alert;


?>