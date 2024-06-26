<?php
error_reporting(0); 

$qry     = "SELECT * FROM hospitality_imap_email  WHERE idsito = ".IDSITO." AND Abilitato = 1 ORDER BY Id DESC";
$sq      = $db->query($qry);
$row     = $db->row($sq); 
$server  = $row['ServerEmail'];
$user    = $row['UserEmail'];
$pass    = $row['PasswordEmail']; 

if($user !='' && $pass !=''){ 

    if(strstr($server,'gmail')){

        //connessione a gmail
        $inbox = imap_open('{imap.gmail.com:993/imap/ssl}INBOX',$user,$pass) or die('Cannot connect to Gmail: ' . imap_last_error());

        // grab emails
        $emails = imap_search($inbox,'ALL');


        $tipo_modulo           = '';
        $FontePrenotazione     = '';
        $maildata              = '';
        $array_contenuti_email = '';
        $arr_field             = '';
        $body                  = '';
        $righe                 = '';
        $NumeroPrenotazione    = '';
        $FontePrenotazione     = '';
        $MessageId             = '';
        $DataRichiesta         = '';
        $TipoRichiesta         = '';
        $Nome                  = '';
        $Cognome               = '';
        $Email                 = '';
        $Cellulare             = '';
        $Lingua                = '';              
        $DataArrivo            = ''; 
        $DataPartenza          = '';
        $NumeroAdulti          = '';
        $NumeroBambini         = '';
        $Note                  = '';
        $AbilitaInvio          = '';
        $valore                = '';
        $risultato             = '';
        $Trattamento           = ''; 
        $headerInfo            = '';  
        $maildata              = '';     

        $q = "SELECT * FROM hospitality_data_import WHERE idsito = ".IDSITO." ORDER BY Id DESC";
        $sel = $db->query($q);
        $rws = $db->row($sel);
        $last_data_import = $rws['data'];


        // if emails risponde ciclo
        if($emails) {
                                            
                foreach($emails as $mail) {
                    
                    $headerInfo = imap_headerinfo($inbox,$mail);

                    $data_arrivo_mail_tmp1 = explode(",",$headerInfo->date);
                    $data_arrivo_mail_tmp = explode("+",$data_arrivo_mail_tmp1[1]);
                    $data_arrivo_mail = trim($data_arrivo_mail_tmp[0]);

                    $mesi=array("Jan" => "01","Feb" => "02","Mar" => "03","Apr" => "04","May" => "05","Jun" => "06","Jul" => "07","Aug" => "08","Sept" => "09","Oct" => "10","Nov" => "11","Dec" => "12"); 


                    $data_mail_tmp = explode(" ",$data_arrivo_mail);
                    $data_giorno = $data_mail_tmp[0];
                    $data_mese   = $data_mail_tmp[1];
                    $data_anno   = $data_mail_tmp[2];
                    $ora_mail    = $data_mail_tmp[3];

                    if(strlen($data_giorno)==1)$data_giorno='0'.$data_giorno;
                    $maildata = $data_anno.'-'.$mesi[$data_mese].'-'.$data_giorno.' '.$ora_mail;

                        // se la data di arrivo email è maggiore della data dell'ultima importazione
                        if($maildata > $last_data_import){ 

                            if(strstr($headerInfo->subject,'Info-Alberghi.com')){ 

                                $emailStructure = imap_fetchstructure($inbox,$mail);

                                if(!isset($emailStructure->parts)) {
                                     $body = imap_body($inbox, $mail, FT_PEEK);
                                }
                                // decript dei contenuti della email
                                $righe = imap_qprint($body);

                                // provenienza Info Alberghi
                                $tipo_modulo = 'IA_P';
                                                     
                                $arr_field['IA_P']     = array('Nome' => 'Mittente','Telefono' => 'Telefono','Adulti' => 'Adulti','Bambini' => 'Bambini','Arrivo' => 'Arrivo','Partenza' => 'Partenza','Trattamento' => 'Trattamento','Note' => 'Richiesta');
                      
                              
                                $array_contenuti_email[$tipo_modulo][] =array('SENDER' => $headerInfo->reply_toaddress,'HD' => $headerInfo->subject,'BODY' => $righe,'DATA' => $data_arrivo_mail);
                 

                            }// fine provenineza da Info Alebrghi

                        }// fine controlla data dell'ultima importazione


                }// fine foreach

        } // fine if controllo emails classe

        // azzero variabili
        $NumeroPrenotazione = '';
        $FontePrenotazione  = '';
        $MessageId          = '';
        $DataRichiesta      = '';
        $TipoRichiesta      = '';
        $Nome               = '';
        $Cognome            = '';
        $Email              = '';
        $Cellulare          = '';
        $Lingua             = '';              
        $DataArrivo         = ''; 
        $DataPartenza       = '';
        $NumeroAdulti       = '';
        $NumeroBambini      = '';
        $bambini_eta        = '';
        $Note               = '';
        $AbilitaInvio       = '';
        $valore             = '';
        $risultato          = '';
        $Trattamento        = '';
        $email_body         = '';
        $chiave             = '';
        $valore             = '';
        $risultato          = '';
        $value = '';
        $key = '';
        $val = '';


        if(!empty($array_contenuti_email)){

                    foreach($array_contenuti_email as $key => $value){
                          
                        if($key != ''){    

                            foreach($value as $k => $val){
                                                  
                                        $v = $val;
                                                           
                                        $email_body     = trim(strip_tags($v['BODY'],'<b>')); 

                                        preg_match_all("(<b>(.*?)</b>)", $email_body ,$content);
                                        preg_match_all("(</b>(.*?)<b>)", $email_body ,$result);

                                 
                                        $chiave = $content[1];
                                        $valore = $result[1];
                                        $risultato = array ();
                                        for ($i = 0; $i < count ($chiave); $i++){
                                            $risultato[$chiave[$i]] = $valore[$i];                               
                                        }

                                        $sel2               = "SELECT NumeroPrenotazione FROM hospitality_guest WHERE idsito = ".IDSITO." ORDER BY NumeroPrenotazione DESC";
                                        $res2               = $db->query($sel2);
                                        $rws                = $db->row($res2);
                                        $NumeroPrenotazione =  (intval($rws['NumeroPrenotazione'])+1); 
                                        //
                                        $FontePrenotazione = 'Info Alberghi';
                                        
                                        $DataRichiesta     =   date('Y-m-d');
                                        $TipoRichiesta     =   'Preventivo';
                                        $nome_tmp          =   explode(" ", $risultato[$arr_field[$key]['Nome']]);
                                        $Nome              =   $nome_tmp[0];
                                        $Cognome           =   $nome_tmp[1];
                                        $Email             =   ($risultato[$arr_field[$key]['Email']]==''?$val['SENDER']:$risultato[$arr_field[$key]['Email']]);
                                        $Cellulare         =   $risultato[$arr_field[$key]['Telefono']];
                                        $Lingua            =   'it';
                                        // giro la data di arrivo                                                                 
                                        $data_arr_tmp      = explode("/", $risultato[$arr_field[$key]['Arrivo']]);               
                                        $DataArrivo        = $data_arr_tmp[2]."-".$data_arr_tmp[1]."-".$data_arr_tmp[0]; 
                                        // giro la data di partenza                         
                                        $data_par_tmp      = explode("/", $risultato[$arr_field[$key]['Partenza']]);
                                        $DataPartenza      = $data_par_tmp[2]."-".$data_par_tmp[1]."-".$data_par_tmp[0];
                                        $NumeroAdulti      = $risultato[$arr_field[$key]['Adulti']];
                                        $NumeroBambini_tmp = explode(" ",$risultato[$arr_field[$key]['Bambini']]);
                                        $NumeroBambini     = $NumeroBambini_tmp[0];
                                        $bambini_eta       = 'Bambini: '.$NumeroBambini_tmp[2].$NumeroBambini_tmp[3];
                                        $Trattamento       = 'Trattamento: '.$risultato[$arr_field[$key]['Trattamento']]."\r\n";
                                        $Note              = ($NumeroBambini_tmp[2] != ''?$bambini_eta:'').' '.($risultato[$arr_field[$key]['Trattamento']] != ''?$Trattamento:'').' '.$risultato[$arr_field[$key]['Note']];
                                        $AbilitaInvio      = '0';


                                          
                                        $insert =  "INSERT INTO hospitality_guest(idsito,
                                                                                    id_politiche,
                                                                                    FontePrenotazione,                                                                              
                                                                                    DataRichiesta,
                                                                                    TipoRichiesta,
                                                                                    Nome,
                                                                                    Cognome,
                                                                                    Email,
                                                                                    NumeroPrenotazione,
                                                                                    Cellulare,
                                                                                    Lingua,
                                                                                    DataArrivo,
                                                                                    DataPartenza,
                                                                                    NumeroAdulti,
                                                                                    NumeroBambini,
                                                                                    Note,
                                                                                    AbilitaInvio) 
                                                        VALUES ('" . IDSITO . "',
                                                                '0',
                                                                '" . $FontePrenotazione . "',                                                          
                                                                '" . $DataRichiesta . "',
                                                                '" . $TipoRichiesta . "',
                                                                '" . addslashes($Nome). "',
                                                                '" . addslashes($Cognome) . "',
                                                                '" . $Email . "',
                                                                '" . $NumeroPrenotazione . "',
                                                                '" . $Cellulare . "',
                                                                '" . $Lingua . "',
                                                                '" . $DataArrivo . "',
                                                                '" . $DataPartenza . "',
                                                                '" . $NumeroAdulti . "',
                                                                '" . $NumeroBambini . "',
                                                                '" . addslashes($Note) . "',
                                                                '" . $AbilitaInvio . "')";
                                        $db->query($insert);

                         } // fine foreach value                       
                                            
                    } // fine if se la chiave key è vuota

                }// fine foeach array contenuti email 
                $syncro = "INSERT INTO hospitality_data_import(idsito,data) VALUES('".IDSITO."','".date('Y-m-d H:i:s')."')";
                $db->query($syncro);
        }
        // chiudi la imap connection
        imap_expunge($inbox);
        imap_close($inbox);




    }else{

        require(INC_PATH_CLASS.'email_reader.php');
        $emails = New Email_reader();
        $emails->inbox();
        $total  = count($emails->inbox);

        // azzero tutte le varibaile
        $tipo_modulo           = '';
        $FontePrenotazione     = '';
        $maildata              = '';
        $array_contenuti_email = '';
        $arr_field             = '';
        $righe                 = '';
        $NumeroPrenotazione    = '';
        $FontePrenotazione     = '';
        $MessageId             = '';
        $DataRichiesta         = '';
        $TipoRichiesta         = '';
        $Nome                  = '';
        $Cognome               = '';
        $Email                 = '';
        $Cellulare             = '';
        $Lingua                = '';              
        $DataArrivo            = ''; 
        $DataPartenza          = '';
        $NumeroAdulti          = '';
        $NumeroBambini         = '';
        $bambini_eta           = '';
        $Note                  = '';
        $AbilitaInvio          = '';
        $valore                = '';
        $risultato             = '';
        $Trattamento           = '';
        $email                 = ''; 
        $maildata              = '';        

        $q = "SELECT * FROM hospitality_data_import WHERE idsito = ".IDSITO." ORDER BY Id DESC";
        $sel = $db->query($q);
        $rws = $db->row($sel);
        $last_data_import = $rws['data'];


        for($i=$total-1;$i>=0;$i--) {
            $email = $emails->inbox[$i];

            $data_arrivo_mail_tmp = explode("+",$email['header']->MailDate);
            $data_arrivo_mail = trim($data_arrivo_mail_tmp[0]);

            $mesi=array("Jan" => "01","Feb" => "02","Mar" => "03","Apr" => "04","May" => "05","Jun" => "06","Jul" => "07","Aug" => "08","Sept" => "09","Oct" => "10","Nov" => "11","Dec" => "12");       

            $data_mail_tmp = explode(" ",$data_arrivo_mail);
            $data_mail = $data_mail_tmp[0];
            $ora_mail  = $data_mail_tmp[1];
            $data_m = explode("-",$data_mail);
            if(strlen($data_m[0])==1)$data_m[0]='0'.$data_m[0];
            $maildata = $data_m[2].'-'.$mesi[$data_m[1]].'-'.$data_m[0].' '.$ora_mail;


                // se la data di arrivo email è maggiore della data dell'ultima importazione
                if($maildata > $last_data_import){  

                    // decript dei contenuti della email
                    $righe = imap_qprint($email['body']);

                        // provenienza Info Alberghi
                    if(strstr($email['header']->subject,'Info-Alberghi.com')){

                        $tipo_modulo = 'IA_P';
                                             
                        $arr_field['IA_P']     = array('Nome' => 'Mittente','Telefono' => 'Telefono','Adulti' => 'Adulti','Bambini' => 'Bambini','Arrivo' => 'Arrivo','Partenza' => 'Partenza','Trattamento' => 'Trattamento','Note' => 'Richiesta');
              
                        //$array_contenuti_email[$tipo_modulo][] =array('ID' => $email['header']->message_id,'SENDER' => $email['header']->senderaddress,'HD' => $email['header']->subject,'BODY' => $righe,'DATA' => $data_arrivo_mail);
                        $array_contenuti_email[$tipo_modulo][] =array('SENDER' => $email['header']->reply_toaddress,'HD' => $email['header']->subject,'BODY' => $righe,'DATA' => $data_arrivo_mail);
         

                    }// fine provenineza da Info Alebrghi

                }// fine controlla data dell'ultima importazione
           
        }//fine ciclo lettura imap

        //azzero varibaili
        $NumeroPrenotazione = '';
        $FontePrenotazione  = '';
        $MessageId          = '';
        $DataRichiesta      = '';
        $TipoRichiesta      = '';
        $Nome               = '';
        $Cognome            = '';
        $Email              = '';
        $Cellulare          = '';
        $Lingua             = '';              
        $DataArrivo         = ''; 
        $DataPartenza       = '';
        $NumeroAdulti       = '';
        $NumeroBambini      = '';
        $bambini_eta        = '';
        $Note               = '';
        $AbilitaInvio       = '';
        $valore             = '';
        $risultato          = '';
        $Trattamento        = '';
        $chiave             = '';
        $valore             = '';
        $risultato          = '';


        if(!empty($array_contenuti_email)){

                    foreach($array_contenuti_email as $key => $value){
                          
                        if($key != ''){    

                            foreach($value as $k => $val){
                                                  
                                        $v = $val;
                                                           
                                        $email_body     = trim(strip_tags($v['BODY'],'<b>')); 

                                        preg_match_all("(<b>(.*?)</b>)", $email_body ,$content);
                                        preg_match_all("(</b>(.*?)<b>)", $email_body ,$result);

                                 
                                        $chiave = $content[1];
                                        $valore = $result[1];
                                        $risultato = array ();
                                        for ($i = 0; $i < count ($chiave); $i++){
                                            $risultato[$chiave[$i]] = $valore[$i];                               
                                        }

                                        $sel2               = "SELECT NumeroPrenotazione FROM hospitality_guest WHERE idsito = ".IDSITO." ORDER BY NumeroPrenotazione DESC";
                                        $res2               = $db->query($sel2);
                                        $rws                = $db->row($res2);
                                        $NumeroPrenotazione =  (intval($rws['NumeroPrenotazione'])+1); 
                                        //
                                        $FontePrenotazione = 'Info Alberghi';
                                        
                                        $DataRichiesta     =   date('Y-m-d');
                                        $TipoRichiesta     =   'Preventivo';
                                        $nome_tmp          =   explode(" ", $risultato[$arr_field[$key]['Nome']]);
                                        $Nome              =   $nome_tmp[0];
                                        $Cognome           =   $nome_tmp[1];
                                        $Email             =   ($risultato[$arr_field[$key]['Email']]==''?$val['SENDER']:$risultato[$arr_field[$key]['Email']]);
                                        $Cellulare         =   $risultato[$arr_field[$key]['Telefono']];
                                        $Lingua            =   'it';
                                        // giro la data di arrivo                                                                 
                                        $data_arr_tmp      = explode("/", $risultato[$arr_field[$key]['Arrivo']]);               
                                        $DataArrivo        = $data_arr_tmp[2]."-".$data_arr_tmp[1]."-".$data_arr_tmp[0]; 
                                        // giro la data di partenza                         
                                        $data_par_tmp      = explode("/", $risultato[$arr_field[$key]['Partenza']]);
                                        $DataPartenza      = $data_par_tmp[2]."-".$data_par_tmp[1]."-".$data_par_tmp[0];
                                        $NumeroAdulti      = $risultato[$arr_field[$key]['Adulti']];
                                        $NumeroBambini_tmp = explode(" ",$risultato[$arr_field[$key]['Bambini']]);
                                        $NumeroBambini     = $NumeroBambini_tmp[0];
                                        $bambini_eta       = 'Bambini: '.$NumeroBambini_tmp[2].$NumeroBambini_tmp[3];
                                        $Trattamento       = 'Trattamento: '.$risultato[$arr_field[$key]['Trattamento']]."\r\n";
                                        $Note              = ($NumeroBambini_tmp[2] != ''?$bambini_eta:'').' '.($risultato[$arr_field[$key]['Trattamento']] != ''?$Trattamento:'').' '.$risultato[$arr_field[$key]['Note']];
                                        $AbilitaInvio      = '0';


                                          
                                        $insert =  "INSERT INTO hospitality_guest(idsito,
                                                                                    id_politiche,
                                                                                    FontePrenotazione,                                                                              
                                                                                    DataRichiesta,
                                                                                    TipoRichiesta,
                                                                                    Nome,
                                                                                    Cognome,
                                                                                    Email,
                                                                                    NumeroPrenotazione,
                                                                                    Cellulare,
                                                                                    Lingua,
                                                                                    DataArrivo,
                                                                                    DataPartenza,
                                                                                    NumeroAdulti,
                                                                                    NumeroBambini,
                                                                                    Note,
                                                                                    AbilitaInvio) 
                                                        VALUES ('" . IDSITO . "',
                                                                '0',
                                                                '" . $FontePrenotazione . "',                                                          
                                                                '" . $DataRichiesta . "',
                                                                '" . $TipoRichiesta . "',
                                                                '" . addslashes($Nome). "',
                                                                '" . addslashes($Cognome) . "',
                                                                '" . $Email . "',
                                                                '" . $NumeroPrenotazione . "',
                                                                '" . $Cellulare . "',
                                                                '" . $Lingua . "',
                                                                '" . $DataArrivo . "',
                                                                '" . $DataPartenza . "',
                                                                '" . $NumeroAdulti . "',
                                                                '" . $NumeroBambini . "',
                                                                '" . addslashes($Note) . "',
                                                                '" . $AbilitaInvio . "')";
                                        $db->query($insert);


                         } // fine foreach value                       
                                            
                    } // fine if se la chiave key è vuota

                }// fine foeach array contenuti email 
            $syncro = "INSERT INTO hospitality_data_import(idsito,data) VALUES('".IDSITO."','".date('Y-m-d H:i:s')."')";
            $db->query($syncro);
        }
        
    } // if gmail oppure altro server    

}// fine if tabella dei valori imap è vuota