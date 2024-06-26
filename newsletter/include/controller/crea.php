<?php
$js_Check_email ='
<script>
/* check sul campo email in tempo reale, se email esiste CNAME */
    $( document ).ready(function() {
        if($(\'#destinatario\').val() != \'\'){
            var EmailCliente = $(\'#destinatario\').val().trim();
            var EmailOperatore = \''.MAIL_CHECK.'\';
            if(EmailCliente.length>=2){
                $.ajax({        
                    type: "POST",         
                    url: "'.BASE_URL_SITO.'ajax/check_valid_email.php",        
                    data: "EmailCliente=" + EmailCliente + "&EmailOperatore=" + EmailOperatore,
                    dataType: "html",        
                    success: function(data){
                        var classe = \'\';
                        if(data == \'valid\'){
                            $("#check_email").html(\'<small class="text-green">dominio email valido ed esistente</small>\');
                            $("#bottone_salva").removeAttr("disabled");
                        }else{
                            $("#check_email").html(\'<small class="text-red">dominio email non valido ed inesistente</small>\');
                            $("#bottone_salva").attr("disabled","true");
                        }
                        
                    },
                    error: function(){
                        alert("Chiamata fallita, si prega di riprovare..."); 
                    }
                });
            }else{
                $("#bottone_salva").removeAttr("disabled");
            }
        }

            $("#destinatario").bind("keyup focusout mouseenter", function () { 
                var EmailCliente = $("#destinatario").val().trim();
                var EmailOperatore = "'.MAIL_CHECK.'";
                if(EmailCliente.length>=2){
                    $.ajax({        
                    type: "POST",         
                    url: "'.BASE_URL_SITO.'ajax/check_valid_email.php",        
                    data: "EmailCliente=" + EmailCliente + "&EmailOperatore=" + EmailOperatore,
                    dataType: "html",        
                        success: function(data){
                            var classe = "";
                            if(data == "valid"){
                                $("#check_email").html(\'<small class="text-green">dominio email valido ed esistente</small>\');
                                $("#bottone_salva").removeAttr("disabled");
                            }else{
                                $("#check_email").html(\'<small class="text-red">dominio email non valido ed inesistente</small>\');
                                $("#bottone_salva").attr("disabled","true");
                            }
                            
                        },
                        error: function(){
                            alert("Chiamata fallita, si prega di riprovare..."); 
                        }
                    });
                }else{
                    $("#bottone_salva").removeAttr("disabled");
                }
            });
    });
</script>'."\r\n";

$sql   = "SELECT * FROM mailing_newsletter_nome_liste WHERE idsito = ".IDSITO." ORDER BY nome_lista ASC";
$array   = $dbMysqli->query($sql);
foreach($array as $key => $value){
		$liste.= '<option value="'.$value['id'].'">'.$value['nome_lista'].'</option>';
}

$sql2   = "SELECT * FROM mailing_newsletter_template WHERE idsito = ".IDSITO." ORDER BY nome_template ASC";
$array2   = $dbMysqli->query($sql2);
foreach($array2 as $key2 => $value2){
		$template .= '<option value="'.$value2['id'].'" '.($_REQUEST['id_template']==$value2['id']?'selected="selected"':'').'>'.$value2['nome_template'].'</option>';
}
if($_REQUEST['id_template']!=''){
	$sql3   = "SELECT template,lingua FROM mailing_newsletter_template WHERE id = ".$_REQUEST['id_template']." AND idsito = ".IDSITO."";
	$res2   = $dbMysqli->query($sql3);
	$rows   = $res2[0];
	$testo  = $rows['template'];
	$lingua = $rows['lingua'];
}
$q = "SELECT * FROM hospitality_smtp WHERE idsito = ".IDSITO." AND Abilitato = 1";  
$r = $dbMysqli->query($q);
$rc = $r[0];
$NumSend   = $rc['NumberSend'];
$GiornoSettimana = date('w',strtotime(date('Y-m-d')));


if($_REQUEST['action']=='send_mail'){

	$qr = "SELECT * FROM hospitality_smtp WHERE idsito = ".IDSITO." AND Abilitato = 1";  
	$ri = $dbMysqli->query($qr);
	$rx = $ri[0];
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


		if($_REQUEST['id_lista']!=''){

				$qry = "SELECT 
							mailing_newsletter.id,
							mailing_newsletter.idsito,
							mailing_newsletter.nome,
							mailing_newsletter.cognome,
							mailing_newsletter.email,
							mailing_newsletter_nome_liste.nome_lista 
						FROM 
							mailing_newsletter 
						INNER JOIN 
							mailing_newsletter_nome_liste ON mailing_newsletter_nome_liste.id = mailing_newsletter.id_lista 
						WHERE 
							mailing_newsletter_nome_liste.id = ".$_REQUEST['id_lista']." 
						AND
							mailing_newsletter.idsito = ".IDSITO." 
						AND
							mailing_newsletter.attivo = 1 
						ORDER BY 
							mailing_newsletter.nome ASC";  
				$rex = $dbMysqli->query($qry);
				$numero_invii = sizeof($rex);
				setcookie('NUMNERO_INVII', $numero_invii,0);
				$contenuto            = '';
				$indirizzo_email      = '';
				$indirizzo_nominativo = '';
				$messaggio            = '';
				#invio multiplo tramite id_lista
			
				if($NumberSend >= $numero_invii){
					if($numero_invii > 0){
						foreach($rex as $key => $value){	

							$mail = new PHPMailer;

								$indirizzo_email = $value['email'];
								$indirizzo_nominativo = $value['nome'].' '.$value['cognome'];
											
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

						
								$mail->setFrom(MAIL_SEND, NOMEHOTEL);

								//$mail->addReplyTo(EMAILHOTEL, NOMEHOTEL);

								$mail->addAddress($indirizzo_email,$indirizzo_nominativo);
								

								$mail->isHTML(true);

								$mail->Subject = str_replace("[cliente]",$value['nome'].' '.$value['cognome'], $_REQUEST['oggetto']).' | '.NOMEHOTEL;

								$contenuto = str_replace("[cliente]",$value['nome'].' '.$value['cognome'], $_REQUEST['testo']);

								$contenuto = str_replace("[struttura]",NOMEHOTEL, $contenuto );
								
								$messaggio = '<div style="clear:both"></div><div style="width:100%;text-align:center"><a style="-webkit-appearance:button;-moz-appearance:button;appearance:button;text-decoration:none;background-color:#00acc1;color:#FFFFFF;height:auto;width:auto;padding:5px" href="mailto:'.EMAILHOTEL.'">Clicca qui per rispondere a: '.NOMEHOTEL.'</a></div><div style="clear:both"></div>'.$contenuto.'<div style="clear:both"></div><p style="text-align:center;padding-top:15px;font-size:12px"><strong><a href="'.BASE_URL_SUITEWEB.'v2/consensi/newsletter_quoto.php?val='.base64_encode($value['id'].'#'.$value['idsito']).'" style="color:#212b35;text-decoration:none;" >Annulla l\'iscrizione/unsubscribe</a></b></p><div style="clear:both"></div><div style="width:100%;text-align:center"><a style="-webkit-appearance:button;-moz-appearance:button;appearance:button;text-decoration:none;background-color:#00acc1;color:#FFFFFF;height:auto;width:auto;padding:5px" href="mailto:'.EMAILHOTEL.'">Clicca qui per rispondere a: '.NOMEHOTEL.'</a></div>';
								
								$mail->msgHTML($messaggio, dirname(__FILE__));

								$mail->AltBody = 'Per visualizzare il messaggio, si prega di utilizzare un visualizzatore e-mail compatibile con HTML!';

								$mail->send();



						}	
						#scalo invii
						$NumeberRimasti = ($NumberSend-$numero_invii);
						$update = "UPDATE hospitality_smtp SET NumberSend = ".$NumeberRimasti." WHERE idsito = ".IDSITO ;
						$dbMysqli->query($update);

						$TestoRequest = addslashes($_REQUEST['testo']);
						
						$insert = "INSERT INTO 
									mailing_newsletter_spedite 
									(idsito,
									id_lista,
									invii,
									id_template,
									data_invio,
									destinatario,
									oggetto,
									testo) 
									VALUES 
									('".IDSITO."',
									'".$_REQUEST['id_lista']."',
									'".$numero_invii."',
									'".$_REQUEST['id_template']."',
									'".$_REQUEST['data_invio']."',
									'".$_REQUEST['destinatario']."',
									'".$_REQUEST['oggetto']."',
									'".$TestoRequest."')";
						$dbMysqli->query($insert);

						$prt->_goto(BASE_URL_SITO.'newsletter/'.URL_CLIENT_EMAIL.'-crea/ok/'.$numero_invii.'/');                
					}else{
						$prt->_goto(BASE_URL_SITO.'newsletter/'.URL_CLIENT_EMAIL.'-crea/ko');  
					}
			}else{
				$prt->alertgo('Invii rimasti insufficienti!',BASE_URL_SITO.'newsletter/'.URL_CLIENT_EMAIL.'-crea/');  
			}		
		}
		if($_REQUEST['destinatario']!=''){

			$mail = new PHPMailer;
			#invio singolo
			if($NumberSend >= 1){

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
								
					$mail->setFrom(MAIL_SEND, NOMEHOTEL);

					//$mail->addReplyTo(EMAILHOTEL, NOMEHOTEL);

					$mail->addAddress($_REQUEST['destinatario'],$_REQUEST['destinatario']);

					$mail->isHTML(true);

					$mail->Subject = $_REQUEST['oggetto'].' | '.NOMEHOTEL;
			
					$messaggio = str_replace("[struttura]",NOMEHOTEL, '<div style="clear:both"></div><div style="width:100%;text-align:center"><a style="-webkit-appearance:button;-moz-appearance:button;appearance:button;text-decoration:none;background-color:#00acc1;color:#FFFFFF;height:auto;width:auto;padding:5px" href="mailto:'.EMAILHOTEL.'">Clicca qui per rispondere a: '.NOMEHOTEL.'</a></div><div style="clear:both"></div>'.$_REQUEST['testo'].'<div style="clear:both"></div><p style="text-align:center;padding-top:15px;font-size:12px"><strong><a href="mailto:'.EMAILHOTEL.'?subject=Richiesta di cancellazione da '.NOME_CLIENT_EMAIL.' di QUOTO&body=L\'utente '.$_REQUEST['destinatario'].' non desidera più ricevere email da '.NOME_CLIENT_EMAIL.' di QUOTO!" style="color:#212b35;text-decoration:none;">Annulla l\'iscrizione/unsubscribe</a></b></p><div style="clear:both"></div><div style="width:100%;text-align:center"><a style="-webkit-appearance:button;-moz-appearance:button;appearance:button;text-decoration:none;background-color:#00acc1;color:#FFFFFF;height:auto;width:auto;padding:5px" href="mailto:'.EMAILHOTEL.'">Clicca qui per rispondere a: '.NOMEHOTEL.'</a></div>');
					
					$mail->msgHTML($messaggio, dirname(__FILE__));

					$mail->AltBody = 'Per visualizzare il messaggio, si prega di utilizzare un visualizzatore e-mail compatibile con HTML!';

					if (!$mail->send()) {
								echo "Mailer Error: " . $mail->ErrorInfo;
					} else {

						#scalo invii
						$NumeberRimasti = ($NumberSend-1);
						$update = "UPDATE hospitality_smtp SET NumberSend = ".$NumeberRimasti." WHERE idsito = ".IDSITO ;
						$dbMysqli->query($update);

						$TestoRequest = addslashes($_REQUEST['testo']);


						$insert = "INSERT INTO 
									mailing_newsletter_spedite 
									(idsito,
									id_lista,
									invii,
									id_template,
									data_invio,
									destinatario,
									oggetto,
									testo) 
									VALUES 
									('".IDSITO."',
									'".$_REQUEST['id_lista']."',
									'1',
									'".$_REQUEST['id_template']."',
									'".$_REQUEST['data_invio']."',
									'".$_REQUEST['destinatario']."',
									'".$_REQUEST['oggetto']."',
									'".$TestoRequest."')";
						$dbMysqli->query($insert);
						$prt->_goto(BASE_URL_SITO.'newsletter/'.URL_CLIENT_EMAIL.'-crea/ok/1/'); 
					} 
					                
				}else{
					$prt->alertgo('Invii rimasti insufficienti!',BASE_URL_SITO.'newsletter/'.URL_CLIENT_EMAIL.'-crea/');  
				}
		
			}

}
if($_REQUEST['azione'] == 'ok') {
	$msg = '<div class="alert alert-success" id="risultato_invio">
			   <i class="fa fa-check"></i> N° <b>'.$_REQUEST['param'].'</b> '.NOME_CLIENT_EMAIL.' inviate con successo. <span>&#10230;</span>  <small>(attendere il reload della pagina!)</small>
		   </div>
		   <script>                                                                                                   
				$(document).ready(function() {                                                                                  
						setTimeout(function(){
							$(\'#risultato_invio\').hide();
							window.location.replace(\''.BASE_URL_SITO.'newsletter/'.URL_CLIENT_EMAIL.'-crea/\');
						},3000);
				});
	   		</script>';
}                   
if($_REQUEST['azione'] == 'ko') {
	$msg = '<div class="alert alert-danger" id="risultato_invio">
			   <i class="fa fa-check"></i> Email '.NOME_CLIENT_EMAIL.' NON inviate.
		   </div>
		   <script>                                                                                                   
				$(document).ready(function() {                                                                                  
						setTimeout(function(){
							$(\'#risultato_invio\').hide();
							window.location.replace(\''.BASE_URL_SITO.'newsletter/'.URL_CLIENT_EMAIL.'-crea/\');
						},3000);
				});
	   		</script>';
}  
$js_script_editor ='
 <script>
    $(function(){ 

		// $("#preview").on("click",function(){
		// 	$("#screenshots").modal("show");  
		// });   
		$("#form_mail").on("submit",function(){
			if ($(this).valid()){
				$("#view_mail_loading").html(\'<div class="clearfix" style="height:20px">&nbsp;</div><div class="row"><div class="col-md-12 text-center"><img src="'.BASE_URL_SITO.'img/logo_loading_mail.png" alt="QUOTO v2" style="max-width:50%;"><div class="clearfix">&nbsp;</div><img src="'.BASE_URL_SITO.'img/Ellipsis-1s-200px.gif" alt="Invio Email da E-Messenger per CRM QUOTO v2"></div></div><div class="row"><div class="col-md-12 text-center"><small>Invio in corso..., attendere il suo termine, prima di cambiare schermata!</small></div></div><div class="clearfix"  style="height:10px">&nbsp;</div>\');
				$("#content_mail").hide();
			}
		})  
		CKEDITOR.replace("testo");
			$(".textarea").wysihtml5();                                               
    });        
</script>';
$js_script_editor .='<script type="text/javascript" src="'.BASE_URL_SITO.'js/ckeditor/ckeditor.js"></script>'."\r\n";  
$js_script_editor .='<script type="text/javascript">
                        CKEDITOR.config.toolbar = [
                                        [\'Source\',\'-\',\'Maximize\'],[\'Format\',\'Font\',\'FontSize\'],
                                        [\'Bold\',\'Italic\',\'Underline\',\'StrikeThrough\',\'-\',\'Cut\',\'Copy\',\'Paste\',\'PasteText\',\'PasteFromWord\',\'-\',\'Outdent\',\'Indent\'],
                                        [\'NumberedList\',\'BulletedList\',\'-\',\'JustifyLeft\',\'JustifyCenter\',\'JustifyRight\',\'JustifyBlock\'],
                                        [\'Image\',\'Table\',\'Link\',\'TextColor\',\'BGColor\']
                                    ] ;
                        CKEDITOR.config.autoGrow_onStartup = true;
                        CKEDITOR.config.extraPlugins = \'autogrow\';
                        CKEDITOR.config.autoGrow_minHeight = 400;
                        CKEDITOR.config.autoGrow_maxHeight = 600;
                        CKEDITOR.config.autoGrow_bottomSpace = 50;           
				</script>'."\r\n";

$js_script_select .='				
	<script>
		$(document).ready(function(){ 
			if($("#destinatario").val()!=""){
				//$("#list_group").hide();
				$("#id_lista").prop("disabled", true);
			}else{
				//$("#list_group").show(); 
				$("#id_lista").prop("disabled", false);
			} 
			$("#destinatario").on("focusout keyup keypress select",function(){
				if($("#destinatario").val()!=""){
					//$("#list_group").hide();
					$("#id_lista").prop("disabled", true);
				}else{
					//$("#list_group").show(); 
					$("#id_lista").prop("disabled", false);
				} 
			});
			if($("#id_lista").val()!=""){
				//$("#dest_group").hide();
				$("#destinatario").prop("disabled", true);
			}else{
				//$("#dest_group").show(); 
				$("#destinatario").prop("disabled", false);
			} 
			$("#id_lista").on("change",function(){
				if($("#id_lista").val()!=""){
					//$("#dest_group").hide();
					$("#destinatario").prop("disabled", true);
				}else{
					//$("#dest_group").show(); 
					$("#destinatario").prop("disabled", false);
				} 
			});                            
		});        
	</script>'."\r\n";	

?>
