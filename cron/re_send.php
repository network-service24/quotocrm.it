<?php 
include($_SERVER['DOCUMENT_ROOT'].'/include/settings.inc.php');
include($_SERVER['DOCUMENT_ROOT'].'/include/declaration.inc.php');

date_default_timezone_set('Europe/Rome');

require $_SERVER['DOCUMENT_ROOT'].'/class/PHPMailer/PHPMailerAutoload.php';

   function check_template($idsito){
        global $dbMysqli;

        $sel      = "SELECT * FROM hospitality_template_landing WHERE idsito = ".$idsito."";
        $res      = $dbMysqli->query($sel);
        $record   = $res[0];
        $template = $record['Template'];
        
        return $template;
    }
    function check_landing_template($idsito,$idrichiesta){
        global $dbMysqli;

        $sel    = "SELECT hospitality_template_background.TemplateName FROM hospitality_guest 
                    INNER JOIN hospitality_template_background ON hospitality_template_background.Id = hospitality_guest.id_template
                    WHERE hospitality_guest.idsito = ".$idsito."  AND hospitality_guest.Id = ".$idrichiesta."
                    ORDER BY hospitality_guest.DataRichiesta DESC,hospitality_guest.Id DESC";

        $res    = $dbMysqli->query($sel);
        $record = $res[0];
        $TemplateName = $record['TemplateName'];

        return $TemplateName;
    }

    function check_landing_type_template($idsito, $idrichiesta){
        global $dbMysqli;
    
        $sel = "SELECT hospitality_template_background.TemplateType FROM hospitality_guest
                    INNER JOIN hospitality_template_background ON hospitality_template_background.Id = hospitality_guest.id_template
                    WHERE hospitality_guest.idsito = " . $idsito . " AND hospitality_guest.Id = " . $idrichiesta."
                    ORDER BY hospitality_guest.DataRichiesta DESC,hospitality_guest.NumeroPrenotazione DESC";
    
        $res          = $dbMysqli->query($sel);
        $record       = $res[0];
        $TemplateType = $record['TemplateType'];
    
        return $TemplateType;
    }    

         // query per i dati della richiesta
        $sel = "SELECT hospitality_guest.*, hospitality_giorni_recall_conferme.numero_giorni 
                FROM hospitality_guest 
                INNER JOIN hospitality_giorni_recall_conferme ON hospitality_giorni_recall_conferme.idsito = hospitality_guest.idsito
                WHERE 1 = 1
                AND hospitality_guest.TipoRichiesta = 'Conferma' 
                AND hospitality_guest.Inviata = 1 
                AND hospitality_guest.Chiuso = 0 
                AND hospitality_guest.Disdetta = 0
                AND hospitality_guest.Archivia = 0
                AND hospitality_guest.NoDisponibilita = 0
                AND hospitality_guest.Visibile = 1 
                AND hospitality_giorni_recall_conferme.abilita = 1 
                AND hospitality_guest.DataScadenza =  (CURRENT_DATE + INTERVAL hospitality_giorni_recall_conferme.numero_giorni  DAY)";
        $qy  = $dbMysqli->query($sel);
        $tot = sizeof($qy);;
        if($tot > 0){

            $myfile = fopen($path_cron.'log/log_resend.txt', 'w'); 

            foreach($qy as $key => $dati){
                
                
                $messaggio          = '';
                $DataArrivo         = '';
                $DataPartenza       = '';
                $IdRichiesta        = '';
                $IdSito             = '';
                $TemplateEmail      = '';
                $AccontoRichiesta   = '';
                $AccontoLibero      = '';              
                $AbilitaInvio       = '';
                $TipoRichiesta      = '';
                $Nome               = '';
                $Cognome            = '';
                $NumeroAdulti       = '';
                $NumeroBambini      = '';  
                $EtaBambini1        = ''; 
                $EtaBambini2        = '';
                $EtaBambini3        = ''; 
                $EtaBambini4        = '';       
                $Email              = '';
                $Operatore          = '';
                $EmailOperatore     = '';
                $Note               = '';
                $Lingua             = '';
                $PrezzoPC           = ''; 
                $link               = '';
                $NumeroPrenotazione = '';  
                

                $n_giorni = mktime (0,0,0,date('m'),(date('d')+$dati['numero_giorni']),date('Y'));
                
                $data = date('Y-m-d',$n_giorni);

                if($dati['DataScadenza'] == $data){

                       // giro le date in formato IT
                        $DataA_tmp          = explode("-",$dati['DataArrivo']);
                        $DataArrivo         = $DataA_tmp[2].'/'.$DataA_tmp[1].'/'.$DataA_tmp[0];
                        $DataP_tmp          = explode("-",$dati['DataPartenza']);
                        $DataPartenza       = $DataP_tmp[2].'/'.$DataP_tmp[1].'/'.$DataP_tmp[0];
                        // assegno alcune variabili
                        $IdRichiesta        = $dati['Id'];
                        $AccontoRichiesta   = $dati['AccontoRichiesta'];
                        $AccontoLibero      = $dati['AccontoLibero'];
                        $IdSito             = $dati['idsito'];
                        $TemplateEmail      = $dati['TemplateEmail'];
                        $AbilitaInvio       = $dati['AbilitaInvio'];
                        $TipoRichiesta      = $dati['TipoRichiesta'];
                        $NumeroPrenotazione = $dati['NumeroPrenotazione'];
                        $Nome               = stripslashes($dati['Nome']);
                        $Cognome            = stripslashes($dati['Cognome']);
                        $NumeroAdulti       = $dati['NumeroAdulti'];
                        $NumeroBambini      = $dati['NumeroBambini'];  
                        $EtaBambini1        = $dati['EtaBambini1']; 
                        $EtaBambini2        = $dati['EtaBambini2']; 
                        $EtaBambini3        = $dati['EtaBambini3']; 
                        $EtaBambini4        = $dati['EtaBambini4'];       
                        $Email              = $dati['Email'];
                        $Operatore          = $dati['ChiPrenota'];
                        $EmailOperatore     = $dati['EmailSegretaria'];
                        $Note               = $dati['Note'];
                        $Lingua             = $dati['Lingua'];  


                            $select = "SELECT hospitality_dizionario.etichetta,hospitality_dizionario_lingua.testo FROM hospitality_dizionario
                                        INNER JOIN hospitality_dizionario_lingua ON hospitality_dizionario_lingua.id_dizionario = hospitality_dizionario.id
                                        WHERE hospitality_dizionario.idsito = ".$IdSito."
                                        AND hospitality_dizionario_lingua.Lingua = '".$Lingua."'
                                        AND hospitality_dizionario_lingua.idsito = ".$IdSito;
                            $res = $dbMysqli->query($select);
                                foreach ($res as $ky => $value) {
                                    $etichetta[$value['etichetta']]=$value['testo'];
                                }

                                $_oggetto           =     $etichetta['OGGETTO_RESEND_CONFERMA'];
                                $_testo             =     $etichetta['TESTOMAIL_RESEND_CONFERMA']; 
                                $_soluzioneconf     =     $etichetta['SOLUZIONECONFERMATA'];         
                                $_datisoggiorno     =     $etichetta['DATISOGGIORNO'];
                                $_tiposoggiorno     =     $etichetta['TIPOSOGGIORNO'];
                                $_datarichiesta     =     $etichetta['DATA_RICHIESTA'];
                                $_dataarrivo        =     $etichetta['DATAARRIVO'];
                                $_datapartenza      =     $etichetta['DATAPARTENZA'];
                                $_sistemazione      =     $etichetta['SISTEMAZIONE'];
                                $_note              =     $etichetta['NOTE'];                              
                                $_txtlink1          =     $etichetta['TXTLINK1'];
                                $_txtlink3          =     $etichetta['TXTLINK3'];
                                $_acconto_offerta   =     $etichetta['ACCONTO_OFFERTA'];
                                $_paginariservata   =     $etichetta['PAGINARISERVATA'];
                                $_saluti            =     $etichetta['SALUTI_H'];
                                $_offerta_dettaglio =     $etichetta['OFFERTA_DETTAGLIO'];
                                $_pagamento         =     $etichetta['PAGAMENTO'];
                                $_acconto           =     $etichetta['ACCONTO'];
                                $_noreplay          =     $etichetta['NO_REPLAY_EMAIL'];
                                $_tiporichiesta     =     ($dati['TipoRichiesta']=='Preventivo'?$etichetta['PREVENTIVO']:$etichetta['CONFERMA']);                           

                        $p = $dbMysqli->query("SELECT 
                                                hospitality_proposte.Id as IdProposta,
                                                hospitality_proposte.CheckProposta as CheckProposta,
                                                hospitality_proposte.PrezzoL as PrezzoL,
                                                hospitality_proposte.PrezzoP as PrezzoP,
                                                hospitality_proposte.AccontoPercentuale as AccontoPercentuale,
                                                hospitality_proposte.AccontoImporto as AccontoImporto
                                                FROM hospitality_proposte
                                                WHERE hospitality_proposte.id_richiesta = ".$IdRichiesta."
                                                GROUP BY hospitality_proposte.Id");
                            $PrezzoPC           = '';
                            $AccontoPercentuale = '';
                            $AccontoImporto     = '';
                            foreach ($p as $k => $value) {
                                $PrezzoPC           = $value['PrezzoP']; 
                                $AccontoPercentuale = $value['AccontoPercentuale'];
                                $AccontoImporto     = $value['AccontoImporto']; 
                            }
                    

                                // query per i contenuti testuali ed oggetto della email  in base alla lingua ed al tipo di richiesta    
                                $c_e = $dbMysqli->query("SELECT * FROM hospitality_contenuti_email WHERE TipoRichiesta = '".$TipoRichiesta."' AND Lingua = '".$Lingua ."' AND idsito = ".$IdSito);
                                $rw = $c_e[0];          
                                
                                // query per alcuni dati inerenti al cliente: nome, Email, SitoWeb
                                $sit = $dbMysqli->query('SELECT siti.*,utenti.logo,
                                                            comuni.nome_comune as comune,
                                                            province.sigla_provincia as prov
                                                            FROM siti 
                                                            INNER JOIN utenti ON utenti.idsito = siti.idsito
                                                            INNER JOIN comuni ON comuni.codice_comune = siti.codice_comune
                                                            INNER JOIN province ON province.codice_provincia = siti.codice_provincia
                                                            WHERE siti.idsito = "'.$IdSito.'"');
                                $rows =  $sit[0];
                                $logo      = $rows['logo'];
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

                                $grafica = check_template($IdSito);
                                $chek_l_t = check_landing_template($IdSito,$IdRichiesta);

                                if($chek_l_t != 'smart'){
                                    $chek_l_t = check_landing_type_template($IdSito,$IdRichiesta);
                                }
                
                                if($grafica != 'default'){
                                    $grafica = check_landing_type_template($IdSito,$IdRichiesta);
                                }

                                if($chek_l_t!=''){
                                    
                                   if($chek_l_t=='default'){
                                        $link = ($UrlLanding.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$IdSito.'_c').'/count/');                     
                                   }else{
                                        $link = ($UrlLanding.$chek_l_t.'/'.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$IdSito.'_c').'/count/');
                                   }                
                  
                                }else{

                                   if($grafica=='default'){
                                        $link = ($UrlLanding.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$IdSito.'_c').'/count/');                      
                                   }else{
                                        $link = ($UrlLanding.$grafica.'/'.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$IdSito.'_c').'/count/');
                                   }                

                                }

                                // query per configurazioni SMTP
                                $qr = "SELECT * FROM hospitality_smtp WHERE idsito = ".$IdSito." AND Abilitato = 1";  
                                $ri = $dbMysqli->query($qr);
                                $isSMTP = sizeof($ri);
                                if($isSMTP > 0){
                                    $rx = $ri[0];

                                    $SmtpAuth     = $rx['SMTPAuth'];
                                    $SmtpHost     = $rx['SMTPHost'];
                                    $SmtpPort     = $rx['SMTPPort'];
                                    $SmtpSecure   = $rx['SMTPSecure'];
                                    $SmtpUsername = $rx['SMTPUsername'];
                                    $SmtpPassword = $rx['SMTPPassword'];
                                    $NumberSend   = $rx['NumberSend'];
                                }
                       
                        $mail = new PHPMailer;

                        // invio tramite SMTP
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

                        $mail->setFrom($send_mail, $Operatore);
                        //$mail->addReplyTo($EmailOperatore, $Operatore);
                        $mail->addAddress($dati['Email'], $dati['Nome'].' '.$dati['Cognome']);
                        $mail->isHTML(true);
                        $mail->Subject = str_replace("[cliente]",$Nome.' '.$Cognome,$_oggetto);

                        include $path_cron.'email_template/resend_conferma_mail.php';
                        // azzero link per evitare il conteggio in automatico 
                        $link = '';
                        
                        $mail->msgHTML($messaggio, dirname(__FILE__));
                        $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';

                        if($mail->send()){
                            $txt = date('d-m-Y H:i:s').' - Inviata: '.' ID '.$IdRichiesta.' NR. '.$NumeroPrenotazione.' IDSITO '.$IdSito.' '. $SitoWeb."\r\n";
                        }else{
                            $txt = date('d-m-Y H:i:s').' - Errore invio Email per  ID '.$IdRichiesta.' NR. '.$NumeroPrenotazione.' IDSITO '.$IdSito.' '. $SitoWeb.': ' . $mail->ErrorInfo."\r\n";			    
                            //scrivo anche su stderror in modo da poter gestire mail di alert 	
                            fwrite(STDERR, $txt);
                        }

                        fwrite($myfile, $txt);

                        $dbMysqli->query("INSERT  INTO hospitality_traccia_email_cron (IdRichiesta,Idsito,DataAzione,TipoReInvio) VALUES ('".$IdRichiesta."','".$IdSito."','".date('Y-m-d H:i:s')."','ReSend')");
                        
                        echo 'Inviata: '.' ID '.$IdRichiesta.' NR. '.$NumeroPrenotazione.' IDSITO '.$IdSito."\r\n"; 
               }// end controllo data
            } // end while
            fclose($myfile);
        }// end tot > 0

?>
