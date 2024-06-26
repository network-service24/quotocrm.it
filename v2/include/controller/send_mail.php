<?php
if($_GET['azione'] == 'send' && $_GET['param'] != '') {
    
         // query per i dati della richiesta
        $db->query("SELECT * FROM hospitality_guest  WHERE Id = ".$_GET['param']);
        $dati = $db->row();        
       // giro le date in formato IT
        $DataA_tmp        = explode("-",$dati['DataArrivo']);
        $DataArrivo       = $DataA_tmp[2].'/'.$DataA_tmp[1].'/'.$DataA_tmp[0];
        $DataP_tmp        = explode("-",$dati['DataPartenza']);
        $DataPartenza     = $DataP_tmp[2].'/'.$DataP_tmp[1].'/'.$DataP_tmp[0];
        // assegno alcune variabili
        $IdRichiesta      = $dati['Id'];
        $AccontoRichiesta = $dati['AccontoRichiesta'];
        $AccontoLibero    = $dati['AccontoLibero'];
        $TemplateEmail    = $dati['TemplateEmail'];
        $AbilitaInvio     = $dati['AbilitaInvio'];
        $TipoRichiesta    = $dati['TipoRichiesta'];
        $Nome             = stripslashes($dati['Nome']);
        $Cognome          = stripslashes($dati['Cognome']);
        $NumeroAdulti     = $dati['NumeroAdulti'];
        $NumeroBambini    = $dati['NumeroBambini'];  
        $EtaBambini1      = $dati['EtaBambini1']; 
        $EtaBambini2      = $dati['EtaBambini2']; 
        $EtaBambini3      = $dati['EtaBambini3']; 
        $EtaBambini4      = $dati['EtaBambini4'];       
        $Email            = $dati['Email'];
        $Operatore        = $dati['ChiPrenota'];
        if($Operatore == ''){
                $Operatore = NOMEHOTEL;
        }
        $EmailOperatore = $dati['EmailSegretaria'];
        if($EmailOperatore == ''){
                $EmailOperatore = EMAILHOTEL;
        }  
        $Note           = $dati['Note'];
        $Lingua         = $dati['Lingua'];  


        include($_SERVER['DOCUMENT_ROOT'].'/v2/lingue/lang.php');

        if($AbilitaInvio==1){           

                $_soluzioneconf     =     SOLUZIONECONFERMATA;         
                $_datisoggiorno     =     DATISOGGIORNO;
                $_tiposoggiorno     =     TIPOSOGGIORNO;
                $_dataarrivo        =     DATAARRIVO;
                $_datapartenza      =     DATAPARTENZA;
                $_sistemazione      =     SISTEMAZIONE;
                $_note              =     NOTE;                              
                $_txtlink1          =     TXTLINK1;
                $_txtlink2          =     TXTLINK2;
                $_paginariservata   =     PAGINARISERVATA;
                $_saluti            =     SALUTI_H;
                $_offerta_dettaglio =     OFFERTA_DETTAGLIO;
                $_pagamento         =     PAGAMENTO;
                $_acconto           =     ACCONTO;
                $_tiporichiesta     =     ($dati['TipoRichiesta']=='Preventivo'?PREVENTIVO:CONFERMA);                              

        $db->query("SELECT 
            hospitality_proposte.Id as IdProposta,
            hospitality_proposte.CheckProposta as CheckProposta,
            hospitality_proposte.PrezzoL as PrezzoL,
            hospitality_proposte.PrezzoP as PrezzoP,
            hospitality_proposte.AccontoPercentuale as AccontoPercentuale,
            hospitality_proposte.AccontoImporto as AccontoImporto
            FROM hospitality_proposte
            WHERE hospitality_proposte.id_richiesta = ".$_REQUEST['param']."
            GROUP BY hospitality_proposte.Id");
            $rec = $db->result();
            $PrezzoPC           = '';
            $AccontoPercentuale = '';
            $AccontoImporto     = '';
            foreach ($rec as $key => $value) {
                $PrezzoPC           = $value['PrezzoP']; 
                $AccontoPercentuale = $value['AccontoPercentuale'];
                $AccontoImporto     = $value['AccontoImporto'];
            }
    

                // query per i contenuti testuali ed oggetto della email  in base alla lingua ed al tipo di richiesta    
                $db->query("SELECT * FROM hospitality_contenuti_email WHERE TipoRichiesta = '".$TipoRichiesta."' AND Lingua = '".$Lingua ."' AND idsito = ".IDSITO);
                $rw = $db->row();          
                
                // query per alcuni dati inerenti al cliente: nome, Email, SitoWeb
                $db_suiteweb->query('SELECT siti.*,
                                            comuni.nome_comune as comune,
                                            province.sigla_provincia as prov
                                            FROM siti 
                                            INNER JOIN comuni ON comuni.codice_comune = siti.codice_comune
                                            INNER JOIN province ON province.codice_provincia = siti.codice_provincia
                                            WHERE siti.idsito = "'.$_SESSION['IDSITO'].'"');
                $rows =  $db_suiteweb->row();
                $sito_tmp    = str_replace("http://","",$rows['web']);
                $sito_tmp    = str_replace("www.","",$sito_tmp);
                if($rows['https']==1){
                    $http = 'https://';
                }else{
                    $http = 'http://';
                }
                $SitoWeb   = $http.'www.'.$sito_tmp;                
                $tel       = $rows['tel'];
                $fax       = $rows['fax'];
                $cap       = $rows['cap'];
                $indirizzo = $rows['indirizzo'];
                $comune    = $rows['comune'];
                $prov      = $rows['prov'];

                $directory_sito = str_replace(".it","",$sito_tmp);
                $directory_sito = str_replace(".com","",$directory_sito);
                $directory_sito = str_replace(".net","",$directory_sito);
                $directory_sito = str_replace(".biz","",$directory_sito);
                $directory_sito = str_replace(".eu","",$directory_sito);
                $directory_sito = str_replace(".de","",$directory_sito);
                $directory_sito = str_replace(".es","",$directory_sito);
                $directory_sito = str_replace(".fr","",$directory_sito);

                #tipo di template usato
                $grafica = check_template($rows['idsito']);
                $chek_l_t = check_landing_template($rows['idsito'],$IdRichiesta);

                if($chek_l_t != 'smart'){
                    $chek_l_t = check_landing_type_template($rows['idsito'],$IdRichiesta);
                }

                if($grafica != 'default'){
                    $grafica = check_landing_type_template($rows['idsito'],$IdRichiesta);
                }

                if($chek_l_t!=''){
                    
                    switch($dati['TipoRichiesta']) {
                        case "Preventivo":
                           if($chek_l_t=='default'){
                                $link = (URL_LANDING.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$rows['idsito'].'_p').'/count/');                        
                           }else{
                               $link = (URL_LANDING.$chek_l_t.'/'.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$rows['idsito'].'_p').'/count/');
                           }                
                        break;
                        case "Conferma":
                           if($chek_l_t=='default'){
                                $link = (URL_LANDING.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$rows['idsito'].'_c').'/count/');           
                            }else{
                                $link = (URL_LANDING.$chek_l_t.'/'.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$rows['idsito'].'_c').'/count/');
                            }
                        break;   
                    }

                }else{

                    switch($dati['TipoRichiesta']) {
                        case "Preventivo":
                           if($grafica=='default'){
                                $link = (URL_LANDING.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$rows['idsito'].'_p').'/count/');                 
                           }else{
                                $link = (URL_LANDING.$grafica.'/'.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$rows['idsito'].'_p').'/count/');
                           }                
                        break;
                        case "Conferma":
                           if($grafica=='default'){
                                $link = (URL_LANDING.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$rows['idsito'].'_c').'/count/');               
                            }else{
                                $link = (URL_LANDING.$grafica.'/'.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$rows['idsito'].'_c').'/count/');
                            }
                        break;   
                    }

                }



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
        //include INC_PATH_CLASS.'PHPMailer/class.smtp.php';
        $mail = new PHPMailer;
        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        /*
        $mail->SMTPDebug = 0;
        $mail->Debugoutput = 'html';
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPKeepAlive = true; // SMTP connection will not close after each email sent, reduces SMTP overhead            
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = "network.service.rimini@gmail.com";
        $mail->Password = "1106Rimini74";
        */
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
        $mail->Subject = str_replace("[cliente]",$Nome.' '.$Cognome, $rw['Oggetto']).' - '.NOMEHOTEL;

          if($TipoRichiesta == 'Preventivo') { 
            include_once BASE_PATH_SITO.'email_template/preventivo_mail.php';
            // azzero link per evitare il conteggio in automatico 
            $link = '';
          }
        
          if($TipoRichiesta == 'Conferma') { 
            include_once BASE_PATH_SITO.'email_template/conferma_mail.php';
            // azzero link per evitare il conteggio in automatico 
            $link = '';
          }

        
            $mail->msgHTML($messaggio, dirname(__FILE__));
            $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
            if (!$mail->send()) {
                        echo "Mailer Error: " . $mail->ErrorInfo;
            } else {
                // update della tabella hospitality_guest dove si segna l'invio e la data dell'invio stesso
                $db->query("UPDATE hospitality_guest SET Inviata = 1, DataInvio = '".date('Y-m-d')."', MetodoInvio = 'E-mail' WHERE Id = ".$IdRichiesta);

               
                ##LOG##
                if($TipoRichiesta=='Conferma'){
                    $_REQUEST['spedito'] = 'Conferma';
                }
                if($TipoRichiesta=='Preventivo'){
                    $_REQUEST['spedito'] = 'Preventivo';
                }
                $_REQUEST['id_richiesta'] = $_GET['param'];
                $_REQUEST['action']       = 'send';
                include($_SERVER['DOCUMENT_ROOT'].'/v2/include/template/moduli/logs.inc.php');
                ##LOG##

                // ritorno alla pagina concierge
                if($TipoRichiesta=='Conferma'){
                    $prt->_goto(BASE_URL_SITO.'conferme/res/ok');
                    // header('Location:'.BASE_URL_SITO.'conferme/res/ok');
                }
                if($TipoRichiesta=='Preventivo'){
                    $prt->_goto(BASE_URL_SITO.'preventivi/res/ok');
                    //header('Location:'.BASE_URL_SITO.'preventivi/res/ok');
                }

  
            }                 
             
         }else{
             
            if($TipoRichiesta=='Conferma'){
                $prt->_goto(BASE_URL_SITO.'conferme/res/ko');
                 //header('Location:'.BASE_URL_SITO.'conferme/res/ko');
            }
            if($TipoRichiesta=='Preventivo'){
                $prt->_goto(BASE_URL_SITO.'preventivi/res/ko');
                //header('Location:'.BASE_URL_SITO.'preventivi/res/ko');
            }
             
         }       
 
}