<?

echo		$sel = "SELECT 
                            hospitality_codice_sconto.cod,
                            hospitality_codice_sconto.imp_sconto 
                    FROM 
                        hospitality_codice_sconto
                    WHERE 
                        hospitality_codice_sconto.id = ".$_REQUEST['azione'];
		$res = $db->query($sel);				
		$rws  = $db->row($res);

        $codice            = $rws['cod'];
        $sconto            = $rws['imp_sconto'];
	
        $qr = "SELECT * FROM hospitality_smtp WHERE idsito = ".IDSITO." AND Abilitato = 1";  
        $ri = $db->query($qr);
        $rx = $db->row($ri);
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

		$msg 	.= '<html>
					<head>
						<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
						<title>QUOTO!</title>
					</head>
					<body>
						<table class="tbl_body" cellpadding="0px" cellspacing="0px" border="0px" align="center">
								<tr>
								<td class="title">
										<img src="https://'.$_SERVER['HTTP_HOST'].'/img/logo.png" /><br />
									<h2>Codice di Sconto</h2>
								</td>
							</tr>
							<tr>
								<td valign="top">
									Gentile <b>Operatore Network Service</b>,<br>
									Siamo lieti di fornirle questo codice: <b>'.$codice.'</b>,<br>
									grazie al quale potrà usufruire di una percentuale di sconto del <b>'.$sconto.'%</b>,<br>
									per la prenotazione di un soggiorno presso la nostra struttura ricettiva! 
								</td>
							</tr>
						</table>	                          
					 </body>
					</html>';

		$body 	= $msg;
		$mail->setFrom('no-reply@quoto.online', 'QUOTO!');
		$mail->addAddress('marcello@network-service.it', 'QUOTO!');		
		$mail->Subject    = 'Codice si sconto applicabile per la prenotazione di un soggiorno presso la nostra struttura ricettiva!';
		$mail->MsgHTML($body);

		if(!$mail->Send()) {
			header('Location:'.BASE_URL_SITO.'generiche-sconti/ko'); 
		} else {
			header('Location:'.BASE_URL_SITO.'generiche-sconti/ok'); 
		}
