<?php
include($_SERVER['DOCUMENT_ROOT'].'/include/settings.inc.php');
include($_SERVER['DOCUMENT_ROOT'].'/include/declaration.inc.php');

date_default_timezone_set('Europe/Rome');
setlocale(LC_TIME, 'it_IT.UTF8');

require $_SERVER['DOCUMENT_ROOT'].'/class/PHPMailer/PHPMailerAutoload.php';

    function inviaMail($mail_send,$destinatari,$oggetto, $messaggio){
	  
	  	$mail 	 = new PHPMailer;

        $msg 	.= $messaggio;      

        $msg  .= '<br><br><div align="center">Questa e-mail è stata inviata automaticamente dal software, non rispondere a questa e-mail!</div>';

        $body  = $msg;

        $mail->SetFrom($mail_send);     
        $mail->AddAddress($destinatari);               
        $mail->Subject = $oggetto;
        $mail->MsgHTML($body);
        
        $mail->Send();

    }
	function gira_data($data)
    {
        $data = explode(" ", $data);
        $data_tmp = explode("-", $data[0]);
        $new_data = $data_tmp[2].'-'.$data_tmp[1].'-'.$data_tmp[0];
        return $new_data;
    }

	$sql = 'SELECT 
				siti.*
			FROM 
				siti 	 
			WHERE 
				siti.hospitality = 1 
			AND 
				siti.no_rinnovo_hospitality = 0 
			AND 
				siti.data_start_hospitality <> "" 
			AND 
				siti.data_end_hospitality >= "'.date('Y-m-d').'"
			ORDER BY 
				siti.data_end_hospitality DESC';

	$res = $dbMysqli->query($sql);

	$new_date      = '';
	$data_anno     = '';
	$data_tri_anno = '';
	$new_tri_date  = '';

	$tot = sizeof($res);

	if($tot > 0){

		foreach ($res as $y => $row) {

				if($row['data_end_hospitality'] == date('Y-m-d')){

					$array_servizi = explode(",",$row['servizi_attivi']);

					if(in_array('Quoto',$array_servizi)){

								$data_anno = mktime (0,0,0,date('m'),date('d'),(date('Y')+1));
								$new_date = date('Y-m-d',$data_anno);

								$update = "UPDATE siti SET data_end_hospitality = '".$new_date."', note_servizio_quoto = '".$row['note_servizio_quoto']."<br>Rinnovato contratto QUOTO annuale dal ".gira_data($row['data_end_hospitality'])." al ".gira_data($new_date)."' WHERE idsito = ".$row['idsito'];
								$dbMysqli->query($update);

								$txt .= '### RINNOVO ANNUALE ESEGUITO ########## CLIENTE '.$row['web'].'<br>'."\r\n";

						        echo '### RINNOVO ANNUALE ESEGUITO ########## CLIENTE '.$row['web'].'<br>'."\r\n";
					}else{
								$txt .= '### NESSUNA OPERAZIONE DI RINNOVO ANNUALE ########## CLIENTE '.$row['web'].'<br>'."\r\n";

						        echo '### NESSUNA OPERAZIONE DI RINNOVO ANNUALE ########## CLIENTE '.$row['web'].'<br>'."\r\n";
					}


					if(in_array('Quoto TR',$array_servizi)){
						
								$data_tri_anno = mktime (0,0,0,date('m'),date('d'),(date('Y')+3));
								$new_tri_date = date('Y-m-d',$data_tri_anno);

								$update = "UPDATE siti SET data_end_hospitality = '".$new_tri_date."', note_servizio_quoto = '".$row['note_servizio_quoto']."<br>Rinnovato contratto QUOTO triennale dal ".gira_data($row['data_end_hospitality'])." al ".gira_data($new_tri_date)."' WHERE idsito = ".$row['idsito'];
								$dbMysqli->query($update);

								$txt .= '### RINNOVO TRIENNALE ESEGUITO ########## CLIENTE '.$row['web'].'<br>'."\r\n";

						        echo '### RINNOVO TRIENNALE ESEGUITO ########## CLIENTE '.$row['web'].'<br>'."\r\n";
					}else{
								$txt .= '### NESSUNA OPERAZIONE DI RINNOVO TRIENNALE ########## CLIENTE '.$row['web'].'<br>'."\r\n";

						        echo '### NESSUNA OPERAZIONE DI RINNOVO TRIENNALE ########## CLIENTE '.$row['web'].'<br>'."\r\n";
					}


				}else{
						$txt .= '### NESSUNA OPERAZIONE DI RINNOVO ##########'.'<br>'."\r\n";

						echo '### NESSUNA OPERAZIONE DI RINNOVO ##########'.'<br>'."\r\n";
				}

			}		
	}else{
			$txt .= '### NESSUN QUOTO ATTIVO ##########'.'<br>'."\r\n";

			echo '### NESSUN QUOTO ATTIVO ##########'.'<br>'."\r\n";
	}


	inviaMail(MAIL_SEND,$MAIL_MARCELLO, 'AGGIORNAMENTI SCADENZE SU QUOTO MANAGER v3 '.date('d-m-Y'), $txt);

?>