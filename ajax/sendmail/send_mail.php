<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

if($_REQUEST['azione'] == 'send' && $_REQUEST['param'] != '') {
   
         // query per i dati della richiesta
        $select = "SELECT * FROM hospitality_guest  WHERE Id = ".$_REQUEST['param'];
        $result = $dbMysqli->query($select);
        $dati   = $result[0];        
       // giro le date in formato IT
        $DataA_tmp        = explode("-",$dati['DataArrivo']);
        $DataArrivo       = $DataA_tmp[2].'/'.$DataA_tmp[1].'/'.$DataA_tmp[0];
        $DataP_tmp        = explode("-",$dati['DataPartenza']);
        $DataPartenza     = $DataP_tmp[2].'/'.$DataP_tmp[1].'/'.$DataP_tmp[0];
        // assegno alcune variabili
        $IdRichiesta      = $dati['Id'];
        $idsito           = $dati['idsito'];
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
        $EmailOperatore   = $dati['EmailSegretaria'];
        $Note             = $dati['Note'];
        $Lingua           = $dati['Lingua'];  


        include_once(BASE_PATH_SITO.'/lingue/lang.php');

      

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

        $sel =" SELECT 
                    hospitality_proposte.Id as IdProposta,
                    hospitality_proposte.CheckProposta as CheckProposta,
                    hospitality_proposte.PrezzoL as PrezzoL,
                    hospitality_proposte.PrezzoP as PrezzoP,
                    hospitality_proposte.AccontoPercentuale as AccontoPercentuale,
                    hospitality_proposte.AccontoImporto as AccontoImporto
                FROM hospitality_proposte
                WHERE hospitality_proposte.id_richiesta = ".$_REQUEST['param']."
                GROUP BY hospitality_proposte.Id";
            $rec = $dbMysqli->query($sel);
            $PrezzoPC           = '';
            $AccontoPercentuale = '';
            $AccontoImporto     = '';
            foreach ($rec as $key => $value) {
                $PrezzoPC           = $value['PrezzoP']; 
                $AccontoPercentuale = $value['AccontoPercentuale'];
                $AccontoImporto     = $value['AccontoImporto'];
            }
    

                // query per i contenuti testuali ed oggetto della email  in base alla lingua ed al tipo di richiesta    
                $selQ = "SELECT * FROM hospitality_contenuti_email WHERE TipoRichiesta = '".$TipoRichiesta."' AND Lingua = '".$Lingua ."' AND idsito = ".$idsito;
                $resQ = $dbMysqli->query($selQ);
                $rw   = $resQ[0];          
                
                // query per alcuni dati inerenti al cliente: nome, Email, SitoWeb
                $selS = 'SELECT siti.*,
                                utenti.logo,
                                comuni.nome_comune as comune,
                                province.sigla_provincia as prov
                                FROM siti 
                                INNER JOIN utenti ON utenti.idsito = siti.idsito
                                INNER JOIN comuni ON comuni.codice_comune = siti.codice_comune
                                INNER JOIN province ON province.codice_provincia = siti.codice_provincia
                                WHERE siti.idsito = "'.$idsito.'"';
                $recs =  $dbMysqli->query($selS);
                $rows =  $recs[0];
                $sito_tmp    = str_replace("http://","",$rows['web']);
                $sito_tmp    = str_replace("www.","",$sito_tmp);
                if($rows['https']==1){
                    $http = 'https://';
                }else{
                    $http = 'http://';
                }
                $SitoWeb   = $http.'www.'.$sito_tmp;  
                $logo      = $rows['logo'];    
                $NomeHotel = $rows['nome'];          
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
                $grafica = $fun->check_template($rows['idsito']);
                $chek_l_t = $fun->check_landing_template($rows['idsito'],$IdRichiesta);

                if($chek_l_t != 'smart'){
                    $chek_l_t = $fun->check_landing_type_template($rows['idsito'],$IdRichiesta);
                }

                if($grafica != 'default'){
                    $grafica = $fun->check_landing_type_template($rows['idsito'],$IdRichiesta);
                }

                if($chek_l_t!=''){
                    
                    switch($dati['TipoRichiesta']) {
                        case "Preventivo":
                           if($chek_l_t=='default'){
                                $link = (BASE_URL_LANDING.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$rows['idsito'].'_p').'/count/');                        
                           }else{
                               $link = (BASE_URL_LANDING.$chek_l_t.'/'.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$rows['idsito'].'_p').'/count/');
                           }                
                        break;
                        case "Conferma":
                           if($chek_l_t=='default'){
                                $link = (BASE_URL_LANDING.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$rows['idsito'].'_c').'/count/');           
                            }else{
                                $link = (BASE_URL_LANDING.$chek_l_t.'/'.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$rows['idsito'].'_c').'/count/');
                            }
                        break;   
                    }

                }else{

                    switch($dati['TipoRichiesta']) {
                        case "Preventivo":
                           if($grafica=='default'){
                                $link = (BASE_URL_LANDING.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$rows['idsito'].'_p').'/count/');                 
                           }else{
                                $link = (BASE_URL_LANDING.$grafica.'/'.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$rows['idsito'].'_p').'/count/');
                           }                
                        break;
                        case "Conferma":
                           if($grafica=='default'){
                                $link = (BASE_URL_LANDING.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$rows['idsito'].'_c').'/count/');               
                            }else{
                                $link = (BASE_URL_LANDING.$grafica.'/'.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$rows['idsito'].'_c').'/count/');
                            }
                        break;   
                    }

                }

     

        $qr = "SELECT * FROM hospitality_smtp WHERE idsito = ".$idsito." AND Abilitato = 1";  
        $ri = $dbMysqli->query($qr);
        if(sizeof($ri)>0){
            $rx = $ri[0];
            $isSMTP = count($ri); 
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
        $mail->setFrom(MAIL_SEND, $Operatore);
        //$mail->addReplyTo($EmailOperatore, $Operatore);
        $mail->addAddress($dati['Email'], $dati['Nome'].' '.$dati['Cognome']);
        $mail->isHTML(true);
        $mail->Subject = str_replace("[cliente]",$Nome.' '.$Cognome, $rw['Oggetto']).' - '.$NomeHotel;

      
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
                $dbMysqli->query("UPDATE hospitality_guest SET Inviata = 1, DataInvio = '".date('Y-m-d')."', MetodoInvio = 'E-mail' WHERE Id = ".$IdRichiesta);

               
                ##LOG##
                if($TipoRichiesta=='Conferma'){
                    $_REQUEST['spedito'] = 'Conferma';
                }
                if($TipoRichiesta=='Preventivo'){
                    $_REQUEST['spedito'] = 'Preventivo';
                }
                $_REQUEST['id_richiesta'] = $_REQUEST['param'];
                $_REQUEST['action']       = 'send';
                include(BASE_PATH_SITO.'/include/template/moduli/logs.inc.php');
                ##LOG##

  
            }                 
             

}