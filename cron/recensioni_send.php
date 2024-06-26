<?php
include($_SERVER['DOCUMENT_ROOT'].'/include/settings.inc.php');
include($_SERVER['DOCUMENT_ROOT'].'/include/declaration.inc.php');

date_default_timezone_set('Europe/Rome');

require $_SERVER['DOCUMENT_ROOT'].'/class/PHPMailer/PHPMailerAutoload.php';

       
         // query per i dati della richiesta
        $sel = "SELECT hospitality_guest.*, hospitality_giorni_recensioni.numero_giorni
                FROM hospitality_guest 
                INNER JOIN hospitality_giorni_recensioni ON hospitality_giorni_recensioni.idsito = hospitality_guest.idsito
                WHERE 1 = 1
                AND hospitality_guest.TipoRichiesta = 'Conferma' 
                AND hospitality_guest.Chiuso = 1 
                AND hospitality_guest.Archivia = 0 
                AND hospitality_guest.Disdetta = 0 
                AND hospitality_guest.NoDisponibilita = 0
                AND hospitality_guest.recensione_inviata = 0
                AND hospitality_guest.CheckinOnlineClient = 0
                AND (hospitality_guest.IdMotivazione is Null OR hospitality_guest.DataRiconferma is Not Null)
                AND hospitality_giorni_recensioni.abilita = 1 ";
        $qy  = $dbMysqli->query($sel);
        $tot = sizeof($qy);
        if($tot > 0){        
            
            $myfile = fopen($path_cron.'log/log_recensioni_send.txt', 'w'); 

            foreach($qy as $key => $dati){

                $n_giorni           = '';
                $IdRichiesta        = '';
                $IdSito             = '';
                $Nome               = '';
                $Cognome            = '';   
                $Email              = '';
                $Operatore          = '';
                $EmailOperatore     = '';
                $Lingua             = ''; 
                $TipoVacanza        = ''; 
                $oggetto            = '';
                $testomail          = '';
                $messaggio          = ''; 
                $NumeroPrenotazione = '';                



                if($dati['numero_giorni']!= '0'){
                    if(strstr($dati['numero_giorni'],'-')){                    
                        $n_giorni = mktime (0,0,0,date('m'),(date('d')+str_replace('-','',intval($dati['numero_giorni']))),date('Y'));
                    }elseif(strstr($dati['numero_giorni'],'+')){
                        $n_giorni = mktime (0,0,0,date('m'),(date('d')-str_replace('+','',intval($dati['numero_giorni']))),date('Y'));
                    }                
                }else{
                    $n_giorni = mktime (0,0,0,date('m'),date('d'),date('Y'));
                }                

                $data = date('Y-m-d',$n_giorni);

                if($dati['DataPartenza'] == $data){
                    
       
                            $IdRichiesta        = $dati['Id'];
                            $IdSito             = $dati['idsito'];
                            $Nome               = stripslashes($dati['Nome']);
                            $Cognome            = stripslashes($dati['Cognome']);   
                            $Email              = $dati['Email'];
                            $Operatore          = $dati['ChiPrenota'];
                            $EmailOperatore     = $dati['EmailSegretaria'];
                            $Lingua             = $dati['Lingua']; 
                            $TipoVacanza        = $dati['TipoVacanza'];
                            $NumeroPrenotazione = $dati['NumeroPrenotazione'];



                            $select = "SELECT hospitality_dizionario.etichetta,hospitality_dizionario_lingua.testo FROM hospitality_dizionario
                                        INNER JOIN hospitality_dizionario_lingua ON hospitality_dizionario_lingua.id_dizionario = hospitality_dizionario.id
                                        WHERE hospitality_dizionario.idsito = ".$IdSito."
                                        AND hospitality_dizionario_lingua.Lingua = '".$Lingua."'
                                        AND hospitality_dizionario_lingua.idsito = ".$IdSito;
                            $res = $dbMysqli->query($select);
                                foreach ($res as $key => $value) {
                                    $etichetta[$value['etichetta']]=$value['testo'];
                                }

                                $_oggetto           =     $etichetta['OGGETTO_RECENSIONE'];
                                $_testo             =     $etichetta['TESTOMAIL_RECENSIONE']; 
                                $_datarichiesta     =     $etichetta['DATA_RICHIESTA'];
                                $_txtlink4          =     $etichetta['TXTLINK4'];
                                $_paginariservata   =     $etichetta['PAGINARISERVATA'];
                                $_saluti            =     $etichetta['SALUTI_H'];
                                $_noreplay          =     $etichetta['NO_REPLAY_EMAIL'];

                          
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
                                $sito_tmp  = str_replace("http://","",$rows['web']);
                                $sito_tmp  = str_replace("www.","",$sito_tmp);
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


                                $sel    = "SELECT 
                                                Tripadvisor 
                                            FROM 
                                                hospitality_social 
                                            WHERE 
                                                hospitality_social.idsito = ".$IdSito."" ;
            
                                $res    = $dbMysqli->query($sel);
                                $record = $res[0];
                                
                                $link = $record['Tripadvisor'];

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
                                $mail->Subject = str_replace("[cliente]",$Nome.' '.$Cognome,$_oggetto).' | '.ucfirst($rows['nome']);
                                
                                include $path_cron.'email_template/recensioni_send.php';    
                             
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

                                $dbMysqli->query("UPDATE hospitality_guest SET recensione_inviata = 1 WHERE Id = ".$IdRichiesta);

                                $dbMysqli->query("INSERT  INTO hospitality_traccia_email_cron (IdRichiesta,Idsito,DataAzione,TipoReInvio) VALUES ('".$IdRichiesta."','".$IdSito."','".date('Y-m-d H:i:s')."','RecensioniSend')");
                        
                                echo 'Inviata: '.' ID '.$IdRichiesta.' NR. '.$NumeroPrenotazione.' IDSITO '.$IdSito."\r\n"; 

               }// end controllo data
            } // end while  
            fclose($myfile);        
        }// end tot > 0

?>
