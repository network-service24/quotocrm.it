<?php

include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");
 error_reporting(0); 
$user = DB_SUITEWEB_USER;
$pass = DB_SUITEWEB_PASSWORD;
$h    = DB_SUITEWEB_HOST;
$db   = DB_SUITEWEB_NAME;

$conn_suiteweb = mysqli_connect($h, $user, $pass, $db) or die ("Error connecting to database suiteweb");


$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password, $dbname) or die ("Error connecting to database");
mysqli_set_charset($conn, 'utf8');
date_default_timezone_set('Europe/Rome');
setlocale(LC_TIME, 'it_IT.UTF8');

 	if($_REQUEST['action']=='add_chat'){

		    function check_template($idsito){
		        global $conn;

		        $sel      = "SELECT * FROM hospitality_template_landing WHERE idsito = ".$idsito."";
		        $res      = mysqli_query($conn,$sel);
		        $record   = mysqli_fetch_assoc($res);
		        $template = $record['Template'];
		        
		        return $template;
		    }
		    function check_landing_template($idsito,$idrichiesta){
		        global $conn;

		        $sel    = "SELECT hospitality_template_background.TemplateName FROM hospitality_guest 
		                    INNER JOIN hospitality_template_background ON hospitality_template_background.Id = hospitality_guest.id_template
		                    WHERE hospitality_guest.idsito = ".$idsito."  AND hospitality_guest.Id = ".$idrichiesta."
		                    ORDER BY hospitality_guest.DataRichiesta DESC,hospitality_guest.Id DESC";

		        $res    = mysqli_query($conn,$sel);
		        $record = mysqli_fetch_assoc($res);
		        $TemplateName = $record['TemplateName'];

		        return $TemplateName;
		    }


				$insert ="INSERT INTO hospitality_chat(idsito,
														NumeroPrenotazione,
														id_guest,
														lang,
														user,
														chat,
														data,
														operator) 
														VALUES ('".$_REQUEST['idsito']."',
														'".$_REQUEST['NumeroPrenotazione']."',
														'".$_REQUEST['id_guest']."',
														'".$_REQUEST['lang']."',
														'".($_REQUEST['operatore']!='' ? addslashes($_REQUEST['operatore']) : addslashes($_REQUEST['user']))."',														
														'".addslashes($_REQUEST['chat'])."',
														'".date('Y-m-d H:i:s')."',
														'1')";

				mysqli_query($conn,$insert);
				
				$delete_n = "DELETE FROM hospitality_chat_notify WHERE idsito = ".$_REQUEST['idsito']." AND NumeroPrenotazione = ".$_REQUEST['NumeroPrenotazione']."";
				mysqli_query($conn,$delete_n);

                $s = 'SELECT siti.*,
                            comuni.nome_comune as comune,
                            province.sigla_provincia as prov,
                            utenti.logo
                            FROM siti 
                            INNER JOIN comuni ON comuni.codice_comune = siti.codice_comune
                            INNER JOIN province ON province.codice_provincia = siti.codice_provincia
                            INNER JOIN utenti ON utenti.idsito = siti.idsito 
                            WHERE siti.idsito = "'.$_REQUEST['idsito'].'"';
				$ss = mysqli_query($conn_suiteweb,$s);
				$rows = mysqli_fetch_assoc($ss); 
                $sito_tmp    = str_replace("http://","",$rows['web']);
                $sito_tmp    = str_replace("www.","",$sito_tmp);
                $SitoWeb     = 'http://www.'.$sito_tmp;
                $tel       = $rows['tel'];
                $fax       = $rows['fax'];
                $cap       = $rows['cap'];
                $indirizzo = $rows['indirizzo'];
                $comune    = $rows['comune'];
                $prov      = $rows['prov']; 
                $Logo      = $rows['logo'];               

                $directory_sito = str_replace(".it","",$sito_tmp);
                $directory_sito = str_replace(".com","",$directory_sito);
                $directory_sito = str_replace(".net","",$directory_sito);
                $directory_sito = str_replace(".biz","",$directory_sito);
                $directory_sito = str_replace(".eu","",$directory_sito);
                $directory_sito = str_replace(".de","",$directory_sito);
                $directory_sito = str_replace(".es","",$directory_sito);
                $directory_sito = str_replace(".fr","",$directory_sito);


		      // query per i dati della richiesta
		        $d = mysqli_query($conn,"SELECT * FROM hospitality_guest  WHERE Id = ".$_REQUEST['id_guest']);
		        $dati = mysqli_fetch_assoc($d);        
		       // giro le date in formato IT
		        $DataA_tmp      = explode("-",$dati['DataArrivo']);
		        $DataArrivo     = $DataA_tmp[2].'/'.$DataA_tmp[1].'/'.$DataA_tmp[0];
		        $DataP_tmp      = explode("-",$dati['DataPartenza']);
		        $DataPartenza   = $DataP_tmp[2].'/'.$DataP_tmp[1].'/'.$DataP_tmp[0];
		        // assegno alcune variabili
		        $IdRichiesta    = $dati['Id'];
		        $TemplateEmail  = $dati['TemplateEmail'];
		        $AbilitaInvio   = $dati['AbilitaInvio'];
		        $TipoRichiesta  = $dati['TipoRichiesta'];
		        $Nome           = $dati['Nome'];
		        $Cognome        = $dati['Cognome'];
		        $NumeroAdulti   = $dati['NumeroAdulti'];
		        $NumeroBambini  = $dati['NumeroBambini'];  
		        $EtaBambini1    = $dati['EtaBambini1']; 
		        $EtaBambini2    = $dati['EtaBambini2']; 
		        $EtaBambini3    = $dati['EtaBambini3']; 
		        $EtaBambini4    = $dati['EtaBambini4'];       
		        $Email          = $dati['Email'];
		        $Operatore      = $dati['ChiPrenota'];
		        if($Operatore == ''){
		                $Operatore = ucfirst($rows['nome']);
		        }
		        $EmailOperatore = $dati['EmailSegretaria'];
		        if($EmailOperatore == ''){
		                $EmailOperatore = $rows['email'];
		        }  
		        $Note           = $dati['Note'];
		        $Lingua         = $dati['Lingua'];  

				$select = "SELECT hospitality_dizionario.etichetta,hospitality_dizionario_lingua.testo FROM hospitality_dizionario
							INNER JOIN hospitality_dizionario_lingua ON hospitality_dizionario_lingua.id_dizionario = hospitality_dizionario.id
							WHERE hospitality_dizionario_lingua.Lingua = '".$Lingua."'
							AND hospitality_dizionario_lingua.idsito = ".$_REQUEST['idsito'];
				$res = mysqli_query($conn,$select);


					while ($value = mysqli_fetch_assoc($res)) {
						define($value['etichetta'],$value['testo']);
					}

						$_txtlink1          =     TXTLINK1;
		                $_txtlink2          =     TXTLINK2;
		                $_paginariservata   =     PAGINARISERVATA;
		                $_saluti            =     SALUTI_H;
		                $_offerta_dettaglio =     OFFERTA_DETTAGLIO;
		                $_tiporichiesta     =     ($dati['TipoRichiesta']=='Preventivo'?PREVENTIVO:CONFERMA); 



		                $grafica = check_template($rows['idsito']);
		                $chek_l_t = check_landing_template($rows['idsito'],$IdRichiesta);

		                if($chek_l_t!=''){
		                    
		                    switch($dati['TipoRichiesta']) {
		                       case "Preventivo":
		                           if($chek_l_t=='default'){
		                                $link = (URL_LANDING.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$rows['idsito'].'_p').'/chat/');                         
		                           }else{
		                               $link = (URL_LANDING.$chek_l_t.'/'.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$rows['idsito'].'_p').'/chat/');
		                           }                
		                           break;
		                       case "Conferma":
		                           if($chek_l_t=='default'){
		                                $link = (URL_LANDING.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$rows['idsito'].'_c').'/chat/');                   
		                            }else{
		                                $link = (URL_LANDING.$chek_l_t.'/'.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$rows['idsito'].'_c').'/chat/');
		                            }
		                           break;   
		                    }

		                }else{

		                    switch($dati['TipoRichiesta']) {
		                       case "Preventivo":
		                           if($grafica=='default'){
		                                $link = (URL_LANDING.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$rows['idsito'].'_p').'/chat/');                        
		                           }else{
		                                $link = (URL_LANDING.$grafica.'/'.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$rows['idsito'].'_p').'/chat/');
		                           }                
		                           break;
		                       case "Conferma":
		                           if($grafica=='default'){
		                                $link = (URL_LANDING.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$rows['idsito'].'_c').'/chat/');                   
		                            }else{
		                                $link = (URL_LANDING.$grafica.'/'.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$rows['idsito'].'_c').'/chat/');
		                            }
		                           break;   
		                    }

		                }


						$qr = "SELECT * FROM hospitality_smtp WHERE idsito = ".$rows['idsito']." AND Abilitato = 1";  
						$ri = mysqli_query($conn,$qr);
						$isSMTP = mysqli_num_rows($ri);
						if($isSMTP > 0){
							$rx = mysqli_fetch_assoc($ri);

							$SmtpAuth     = $rx['SMTPAuth'];
							$SmtpHost     = $rx['SMTPHost'];
							$SmtpPort     = $rx['SMTPPort'];
							$SmtpSecure   = $rx['SMTPSecure'];
							$SmtpUsername = $rx['SMTPUsername'];
							$SmtpPassword = $rx['SMTPPassword'];
							$NumberSend   = $rx['NumberSend'];
						}
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
				        $mail->setFrom(MAIL_SEND, $Operatore);
				        //$mail->addReplyTo($EmailOperatore, $Operatore);
				        $mail->addAddress($dati['Email'], $dati['Nome'].' '.$dati['Cognome']);
				        $mail->isHTML(true);
				        $mail->Subject = str_replace("[cliente]",$Nome.' '.$Cognome,OGGETTO_RE_CHAT).' - '.ucfirst($rows['nome']);

				        include BASE_PATH_SITO.'email_template/chat_mail.php';

				        
			            $mail->msgHTML($messaggio, dirname(__FILE__));
			            $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
			            $mail->send()  ;             




	}
mysqli_close($conn_suiteweb);
mysqli_close($conn);
?>