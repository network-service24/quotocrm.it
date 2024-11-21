<?php
include($_SERVER['DOCUMENT_ROOT'].'/include/settings.inc.php');
include($_SERVER['DOCUMENT_ROOT'].'/include/function.inc.php');
include($_SERVER['DOCUMENT_ROOT'].'/include/declaration.inc.php');

date_default_timezone_set('Europe/Rome');
setlocale(LC_TIME, 'it_IT.UTF8');

require $_SERVER['DOCUMENT_ROOT'].'/class/PHPMailer/PHPMailerAutoload.php';

    function inviaMail($mail_send,$destinatari,$oggetto, $messaggio){
	  
	  	$mail 	 = new PHPMailer;
        $msg 	.= top_email(1);
        $msg 	.= $messaggio;      
        $msg 	.= footer_email(1);
        $msg  .= '<br><br><div align="center">Questa e-mail è stata inviata automaticamente dal software, non rispondere a questa e-mail!</div>';

        $body  = $msg;

        $mail->SetFrom($mail_send);     
        $mail->AddAddress($destinatari);               
        $mail->Subject = $oggetto;
        $mail->MsgHTML($body);
        
        $mail->Send();

    }

/** 
 * ! invio delle email se il cliente ha attivo un contratto QUOTO, 
 * ! come cliente ha lo status diverso da DISDETTO
 */
		$select = "	SELECT 
						siti.*
					FROM 
						siti 
					WHERE 
						siti.hospitality = 1 
					AND 
						siti.data_end_hospitality > '".date('Y-m-d')."'
					AND 
						siti.id_status <> 5
					GROUP BY 
						siti.idsito
					ORDER BY 
						siti.data_start_hospitality DESC";

		$record = $dbMysqli->query($select);

		if(sizeof($record) > 0){

		$n_giorni         = '';
		$data             = '';
		$p_giorni         = '';
		$datap            = '';
		$q_giorni         = '';
		$dataq            = '';
		$m_giorni         = '';
		$datam            = '';
		$datac_demo       = '';
		$c_giorni_demo    = '';
		
		$new_day          = '';				
		$new_day_neg      = '';
		$messaggio        = '';
		$NomeCliente      = '';
		$TipoQuoto        = '';
		$demo             = '';
		$demo_di          = '';
		$disdetto         = '';
		$disdetto_cliente = '';
		$sendAttivo       = false;
		$sendScad1        = false;
		$sendScad5        = false;
		$sendScad40       = false;
		$sendPromo200     = false;
		$sendScad1        = false;
		$sendScad15       = false;
		$listaClienti     = '';

		foreach ($record as $y => $v) {
			
				$NomeCliente  = $v['nome'];

				$array_servizi = explode(",",$v['servizi_attivi']);

				if(in_array('Quoto',$array_servizi)){

					$TipoQuoto = 'QUOTO V3';

				}elseif(in_array('Quoto TR',$array_servizi)){

					$TipoQuoto = 'QUOTO V3 TRIENNALE';

				}

				# il giorno dopo l'installazione di un QUOTO si avvisano i commerciali dell'avvenuta installazione!
                $n_giorni = mktime (0,0,0,date('m'),(date('d')-1),date('Y'));
                
                $data = date('Y-m-d',$n_giorni);

				if($v['data_start_hospitality'] == $data){



						$messaggio = '<table class="tbl_body" cellpadding="0px" cellspacing="0px" border="0px" align="center">
											<tr>
											<td class="title">
												<img src="'.BASE_URL_SITO.'img/logotipo_quoto_2021.png" /><br />
												<h2>'.$TipoQuoto.' è stato attivato per '.$v['web'].' in data '.gira_data($v['data_start_hospitality']).'</h2>
											</td>
										</tr>
										<tr>
											<td valign="top">
											    <h2>Sito: '.$v['web'].' </h2>
											    <h2>Telefono: '.$v['tel'].' </h2>
											    <h2>Email: '.$v['email'].' </h2>
											    <h2>Attivo dal: '.gira_data($v['data_start_hospitality']).' al '.gira_data($v['data_end_hospitality']).'</h2>
											</td>
										</tr>
										
										<tr>
											<td valign="top">
											</td>
										</tr>							
									</table>';				


							$sendAttivo = true;
							$listaClienti .= 'Clienti attiviati oggi : '.$NomeCliente.'<hr>'."\r\n";

							inviaMail(MAIL_SEND,$MAIL_COMMERCIALI, ''.$TipoQuoto.' attivato ieri il '.gira_data($v['data_start_hospitality']), $messaggio);
							inviaMail(MAIL_SEND,$MAIL_SERENA_QT, 'COPIA: '.$TipoQuoto.' attivato ieri il '.gira_data($v['data_start_hospitality']), $messaggio);
							inviaMail(MAIL_SEND,$MAIL_MARCELLO , 'COPIA DI CONTROLLO '.$TipoQuoto.' attivato ieri il '.gira_data($v['data_start_hospitality']), $messaggio);
				}

				# un giorno prima della scadenza si avvisa il commerciale del QUOTO in scadenza
                $p_giorni = mktime (0,0,0,date('m'),(date('d')+1),date('Y'));
                
                $datap = date('Y-m-d',$p_giorni);

                if($v['data_end_hospitality'] == $datap){


						$messaggio = '<table class="tbl_body" cellpadding="0px" cellspacing="0px" border="0px" align="center">
											<tr>
											<td class="title">
												<img src="'.BASE_URL_SITO.'img/logotipo_quoto_2021.png" /><br />
												<h2>'.$TipoQuoto.' è in scadenza per '.$v['web'].' in data '.gira_data($v['data_end_hospitality']).'</h2>
											</td>
										</tr>
										<tr>
											<td valign="top">
											    <h2>Sito: '.$v['web'].' </h2>
											    <h2>Telefono: '.$v['tel'].' </h2>
											    <h2>Email: '.$v['email'].' </h2>
											    <h2>Attivo dal: '.gira_data($v['data_start_hospitality']).' al '.gira_data($v['data_end_hospitality']).'</h2>
											</td>
										</tr>
										
										<tr>
											<td valign="top">
											</td>
										</tr>							
									</table>';				

					$sendScad1 = true;
					$listaClienti .= 'Clienti in scadenza domani : '.$NomeCliente.'<hr>'."\r\n";

							inviaMail(MAIL_SEND,$MAIL_COMMERCIALI, ''.$TipoQuoto.' in scadenza domani il '.gira_data($v['data_end_hospitality']), $messaggio);
							inviaMail(MAIL_SEND,$MAIL_MARCELLO , 'COPIA DI CONTROLLO '.$TipoQuoto.' in scadenza domani il '.gira_data($v['data_end_hospitality']), $messaggio);
							inviaMail(MAIL_SEND,$MAIL_SERENA_QT, 'COPIA: '.$TipoQuoto.' in scadenza domani il '.gira_data($v['data_end_hospitality']), $messaggio);
							inviaMail(MAIL_SEND,$MAIL_ANTONIO , ''.$TipoQuoto.' in scadenza domani il '.gira_data($v['data_end_hospitality']), $messaggio);
				}

				# 5 giorni prima della scadenza si avvisa il commerciale del QUOTO DEMO e disdetti in scadenza con flag no rinnovo = 1
                $c_giorni_demo = mktime (0,0,0,date('m'),(date('d')+5),date('Y'));
                
                $datac_demo = date('Y-m-d',$c_giorni_demo);

                if($v['data_end_hospitality'] == $datac_demo){

					if($v['no_rinnovo_hospitality'] == 1){

						if(in_array('Quoto Demo',$array_servizi)){
							$della_demo       = ' della DEMO ';
							$demo_di          = 'DEMO di ';
							$demo             = 'DEMO';
							$disdetto         = '';
							$disdetto_cliente = '';
						}else{
							$della_demo       = '';
							$demo             = '';
							$demo_di          = '';
							$disdetto         = 'Il cliente ha richiesto la disdetta!';
							$disdetto_cliente = '(DISDETTO)';
						}

						$messaggio = '<table class="tbl_body" cellpadding="0px" cellspacing="0px" border="0px" align="center">
											<tr>
											<td class="title">
												<img src="'.BASE_URL_SITO.'img/logotipo_quoto_2021.png" /><br />
												<h2>Mancano 5 giorni alla scadenza '.$della_demo.' di '.$TipoQuoto.' per '.$v['web'].'  (<em>scadenza il: '.gira_data($v['data_end_hospitality']).'</em>)</h2>
											</td>
										</tr>
										<tr>
											<td valign="top">
											    <h2>Sito: '.$v['web'].' </h2>
											    <h2>Telefono: '.$v['tel'].' </h2>
											    <h2>Email: '.$v['email'].' </h2>
											    <h2>'.$demo.' '.$TipoQuoto.' Attivo dal: '.gira_data($v['data_start_hospitality']).' al '.gira_data($v['data_end_hospitality']).'</h2>
											    '.($disdetto!=''?'<h2>'.$disdetto.'</h2>':'').'
											</td>
										</tr>
										
										<tr>
											<td valign="top">
											</td>
										</tr>							
									</table>';				


						$sendScad5 = true;
						$listaClienti .= 'Clienti in scadenza fra 5 giorni : '.$NomeCliente.'<hr>'."\r\n";

						    inviaMail(MAIL_SEND,$MAIL_COMMERCIALI, ''.$demo_di.' QUOTO V.3 '.$disdetto_cliente.' in scadenza fra 5 giorni il '.gira_data($v['data_end_hospitality']), $messaggio);
							inviaMail(MAIL_SEND,$MAIL_SERENA_QT, 'COPIA: '.$demo_di.' QUOTO V.3 '.$disdetto_cliente.' in scadenza fra 5 giorni il '.gira_data($v['data_end_hospitality']), $messaggio);
							inviaMail(MAIL_SEND,$MAIL_MARCELLO , 'COPIA DI CONTROLLO: '.$demo_di.' QUOTO V.3 '.$disdetto_cliente.' in scadenza fra 5 giorni il '.gira_data($v['data_end_hospitality']), $messaggio);
					}
				}								

				# 40 giorni prima della scadenza si avvisa il cliente e il commerciale del QUOTO in scadenza
                $m_giorni = mktime (0,0,0,date('m'),(date('d')+40),date('Y'));
                
                $datam = date('Y-m-d',$m_giorni);

                if($v['data_end_hospitality'] == $datam){

					if($v['no_rinnovo_hospitality'] == 0){

						$messaggio = '<table class="tbl_body" cellpadding="0px" cellspacing="0px" border="0px" align="center">
											<tr>
											<td class="title">
												<img src="'.BASE_URL_SITO.'img/logotipo_quoto_2021.png" /><br />
												<h2>Mancano 40 giorni alla scadenza del vostro '.$TipoQuoto.'!</h2>
											</td>
										</tr>
										<tr>
											<td valign="top">
											    <h2>Sito: '.$v['web'].' </h2>
											    <h2>Telefono: '.$v['tel'].' </h2>
											    <h2>Email: '.$v['email'].' </h2>
											    <h2>Attivo dal: '.gira_data($v['data_start_hospitality']).' al '.gira_data($v['data_end_hospitality']).'</h2>
											</td>
										</tr>
										
										<tr>
											<td valign="top">
											</td>
										</tr>							
									</table>';				


						$sendScad40 = true;	
						$listaClienti .= 'Clienti in scadenza fra 40 giorni : '.$NomeCliente.'<hr>'."\r\n";

							inviaMail(MAIL_SEND,$MAIL_COMMERCIALI, ''.$TipoQuoto.' in scadenza fra 40 giorni il '.gira_data($v['data_end_hospitality']), $messaggio);
							inviaMail(MAIL_SEND,$MAIL_SERENA_QT, 'COPIA: '.$TipoQuoto.' in scadenza fra 40 giorni il '.gira_data($v['data_end_hospitality']), $messaggio);
							inviaMail(MAIL_SEND,$MAIL_MARCELLO , 'COPIA DI CONTROLLO: '.$TipoQuoto.' in scadenza fra 40 giorni il '.gira_data($v['data_end_hospitality']), $messaggio);
					}
				}

			
				# QUOTO in scadenza, quando mancano 15 giorni viene inviata al cliente questa email di rinnovo
                $q_giorni = mktime (0,0,0,date('m'),(date('d')+15),date('Y'));
                
                $dataq = date('Y-m-d',$q_giorni);

			if($v['data_end_hospitality'] == $dataq){

				if($v['no_rinnovo_hospitality'] == 0){	
	             	
					if(in_array('Quoto',$array_servizi)){	
					
						$messaggio = '<table class="tbl_body" cellpadding="0px" cellspacing="0px" border="0px" align="center">
											<tr>
											<td class="title">
												<img src="'.BASE_URL_SITO.'img/logotipo_quoto_2021.png" /><br />
												<h2>Mancano 15 giorni alla scadenza del vostro QUOTO!</h2>
											</td>
										</tr>
										<tr>
											<td valign="top">
													Ciao '.$NomeCliente.', 
													<br><br>
													ricevi questa mail perchè voglio informarti che da oggi avrai la possibilità di Risparmiare ben 200 euro sul tuo canone annuo di Quoto!
													<br><br>
													Come sai il canone attuale è di 790 Euro più IVA ma oggi lo puoi modificare firmando il nuovo contratto Triennale da 590 Euro più IVA all’anno.
													<br><br>
													Come devi fare per aderire?
													<br><br>
													Semplicissimo, scarica il contratto a questo link ——> <a href="https://www.network-service.it/download/contratto_Quoto_2021_1_o_3_anni.pdf"><b>Contratto Quoto Triennale</b></a>.
													<br><br>
													<b>IMPORTANTE:</b>
													<br><br>
													Bastera’ timbrarlo e inviarlo al nostro indirizzo email info@network-service.it  <b>PRIMA DELLA SCADENZA</b> annuale è necessario che arrivi entro la data di rinnovo
													<br><br>
													<span style="font-size:13px;font-weight:bold">(Entro 15 giorni da oggi)</span>, fuori da questi termini non sarà possibile per quest\'anno attivare questa promozione.
													<br><br>
													P.S.: E’ un opportunita’ e non un obbligo.
													<br><br>
													Se hai domande contattaci o scrivi a: riccardo@network-service.it.													
													<br><br>
													Buon lavoro !
													<br><br>
													Riccardo Schiappa - Web Consultant
													<br>
													Network Service Srl
											</td>										
										</tr>																				
										<tr>
											<td valign="top">
											</td>
										</tr>							
									</table>';	
									
						$sendPromo200 = true;
						$listaClienti .= 'Clienti ai quali è stata inviata e-mail di promo risparmio 200 : '.$NomeCliente.'<hr>'."\r\n";

							inviaMail(MAIL_SEND,$v['email'], ' Importante: risparmia 200 euro', $messaggio);
							inviaMail(MAIL_SEND,$MAIL_COMMERCIALI, 'Importante: risparmia 200 euro QUOTO V.3', $messaggio);
							inviaMail(MAIL_SEND,$MAIL_SERENA_QT, 'COPIA: Importante: risparmia 200 euro QUOTO V.3', $messaggio);
							inviaMail(MAIL_SEND,$MAIL_MARCELLO , 'COPIA DI CONTROLLO: Importante: risparmia 200 euro QUOTO V.3', $messaggio);	

					}elseif(in_array('Quoto TR',$array_servizi)){

						$messaggioTR = '<table class="tbl_body" cellpadding="0px" cellspacing="0px" border="0px" align="center">
											<tr>
											<td class="title">
												<img src="'.BASE_URL_SITO.'img/logotipo_quoto_2021.png" /><br />
												<h2>Mancano 15 giorni alla scadenza del vostro QUOTO!</h2>
											</td>
										</tr>
										<tr>
											<td valign="top">
												Ciao '.$NomeCliente.',
												<br><br>
												il tuo contratto TRIENNALE di Quoto! scade tra 15 giorni, se vuoi mantenere il contratto triennale che si rinnova tacitamente
												<br><br>
												per altri 3 anni al prezzo di favore di 590,00 euro + iva, non dovrai fare nulla, in caso contrario, se vorrai rinnovarlo ma con un contratto
												<br><br>
												annuale al prezzo ufficiale di 790,00 euro + iva, dovrai comunicarcelo entro 7 giorni a partire da oggi a questa mail:
												<br><br>
												support@quoto.travel
												<br><br><br>											
												Auguriamo buon lavoro
												<br><br>
												Il Team di Quoto!  
												<br><br>
												Network Service Srl
											</td>										
										</tr>																				
										<tr>
											<td valign="top">
											</td>
										</tr>							
									</table>';				


						$sendScad15 = true;
						$listaClienti .= 'Clienti QUOTO triennale in scadenza fra 15 giorni : '.$NomeCliente.'<hr>'."\r\n";

							inviaMail(MAIL_SEND,$v['email'], ' Il tuo QUOTO triennale scade fra 15 giorni', $messaggioTR);
							inviaMail(MAIL_SEND,$MAIL_COMMERCIALI, 'Il tuo QUOTO V.3 triennale scade fra 15 giorni', $messaggioTR);
							inviaMail(MAIL_SEND,$MAIL_SERENA_QT, 'COPIA: Il tuo QUOTO V.3 triennale scade fra 15 giorni', $messaggioTR);
							inviaMail(MAIL_SEND,$MAIL_MARCELLO , 'COPIA DI CONTROLLO: Il tuo QUOTO V.3 triennale scade fra 15 giorni', $messaggioTR);
					}

				}
			}

				$disdetto_cliente = '';
				$disdetto         = '';
				$demo             = '';
				$demo_di          = '';
				$TipoQuoto        = ''; //azzero variabile


		}//end foreach
		if(	$sendAttivo   == true ||
			$sendScad1    == true ||
			$sendScad5    == true ||
			$sendScad40   == true ||
			$sendPromo200 == true ||
			$sendScad15   == true){
			echo '### ESEGUITO INVIO ########## MAIL <br>'."\r\n";
			echo $listaClienti;
		}else{
			echo '### NESSUN INVIO ########## MAIL'."\r\n";
		}

	}else{
		//Nessun invio
		echo '### NESSUN INVIO ########## MAIL'."\r\n";
	}//end if record

?>
