<?
include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");
error_reporting(0); 
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password,$dbname) or die ("Error connecting to database");
mysqli_set_charset($conn,'utf8');

$server  = '';
$user    = '';
$pass    = '';
$idsito  = $_REQUEST['idsito'];


$qry     = "SELECT * FROM hospitality_imap_email  WHERE Portale = 'italyfamilyhotels.it' AND idsito = ".$idsito."  AND Abilitato = 1 ORDER BY Id DESC";
$sq      = mysqli_query($conn,$qry);
$row     = mysqli_fetch_assoc($sq);
   
    $server  = $row['ServerEmail'];
    $user    = $row['UserEmail'];
    $pass    = $row['PasswordEmail']; 
    $idsito  = $row['idsito']; 

    if($user !='' && $pass !=''){ 

        //azzero varibaili
        $NumeroPrenotazione = '';
        $FontePrenotazione  = '';
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
        $TestoNote          = '';
        $Note               = '';
        $AbilitaInvio       = '';
        $risultato          = '';
        $chiave             = '';
        $valore             = '';
        $risultato          = '';
        $Lingua             = '';
        $EtaBambini         = '';
        $nome_tmp           = '';
        $Trattamento        = '';
        $Camere             = '';        

        $q = "SELECT * FROM hospitality_data_import_terzo_portale WHERE idsito = ".$idsito." ORDER BY Id DESC";
        $sel = mysqli_query($conn,$q);
        $rws = mysqli_fetch_assoc($sel);
        $data_import_tmp_ = explode(" ",$rws['data']);
        $data_import_tmp  = explode("-",$data_import_tmp_[0]);
        $data_i_giorno    = $data_import_tmp[0];
        $data_i_mese      = $data_import_tmp[1];
        $data_i_anno      = $data_import_tmp[2];
        $ora_i_mail       = $data_import_tmp_[1];
        $mesi_i=  array("01"         => "January", 
                         "02"        => "February",
                         "03"        => "March",
                         "04"        => "April",
                         "05"        => "May",
                         "06"        => "June",
                         "07"        => "July",
                         "08"        => "August",
                         "09"        => "September",
                         "10"        => "October",
                         "11"        => "November",
                         "12"        => "December"); 

        $data_import = $data_i_anno.' '.$mesi_i[$data_i_mese].' '.$data_i_giorno;
        $last_data_import = $rws['data'];
 
        if(strstr($server,'gmail')){
            //connessione a gmail
            $inbox = imap_open('{imap.gmail.com:993/imap/ssl}INBOX',$user,$pass) or die('Cannot connect to Gmail: ' . imap_last_error());
            // grab emails
            $emails = imap_search($inbox,'SUBJECT "ITALY FAMILY HOTELS" SINCE "'.$data_import.'"');
           
            // if emails risponde ciclo
            if($emails) {

                $array_contenuti_email = array();

                    foreach($emails as $key => $mail) {
                           

                        $headerInfo = imap_fetch_overview($inbox,$mail,0);
                        $headerInfo = $headerInfo[0];
            
                        $data_arrivo_mail_tmp1 = explode(",",$headerInfo->date);
                        $data_arrivo_mail_tmp = explode("+",$data_arrivo_mail_tmp1[1]);
                        $data_arrivo_mail = trim($data_arrivo_mail_tmp[0]);

                        $mesi=array("Jan" => "01","Feb" => "02","Mar" => "03","Apr" => "04","May" => "05","Jun" => "06","Jul" => "07","Aug" => "08","Sep" => "09","Oct" => "10","Nov" => "11","Dec" => "12"); 


                        $data_mail_tmp = explode(" ",$data_arrivo_mail);
                        $data_giorno = $data_mail_tmp[0];
                        $data_mese   = $data_mail_tmp[1];
                        $data_anno   = $data_mail_tmp[2];
                        $ora_mail    = $data_mail_tmp[3];

                        if(strlen($data_giorno)==1)$data_giorno='0'.$data_giorno;
                        $maildata = $data_anno.'-'.$mesi[$data_mese].'-'.$data_giorno.' '.$ora_mail;

                            if($maildata > $last_data_import){ 

                                if(strstr($headerInfo->subject,'ITALY FAMILY HOTELS')){ 

                                    $body = imap_body($inbox, $mail);
                
                                    $righe = imap_qprint($body);
                       
                                    $tipo_modulo = 'IF_P';

                                    $arr_field['IF_P']      = array('Codice' => 'Codice email');                

                                    $array_contenuti_email[$tipo_modulo][] =array('BODY' => $righe); 

                                }// fine provenineza da italyfamilyhotels.it

                            }

                    }// fine foreach

            } // fine if controllo emails classe
       
            if(!empty($array_contenuti_email)){

              foreach($array_contenuti_email as $key => $value){
                      
                    if($key != ''){

                            
                     foreach($value as $k => $val){

                         //azzero varibaili
                        $NumeroPrenotazione = '';
                        $FontePrenotazione  = '';
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
                        $TestoNote          = '';
                        $Note               = '';
                        $AbilitaInvio       = '';
                        $risultato          = '';
                        $chiave             = '';
                        $valore             = '';
                        $risultato          = '';
                        $Lingua             = '';
                        $EtaBambini         = '';
                        $nome_tmp           = '';
                        $Trattamento        = '';
                        $Camere             = '';
            

       
                                            $email_body = trim($val['BODY']); 
                                            $email_body = str_replace('&quot;','"',$email_body);

                                            preg_match_all('(<div id="code" style="display:none;visibility:hidden;">(.*?)</div>)', $email_body ,$result);

                                            $valore = $result[1];
                                            foreach ($valore as $y => $v) {
                                                $risultato = json_decode($v,true);
                                            }

                                            $conn2 = mysqli_connect($host, $username, $password,$dbname) or die ("Error connecting to database");
                                            mysqli_set_charset($conn2,'utf8');
                                         
                                            $sel2               = "SELECT NumeroPrenotazione FROM hospitality_guest WHERE idsito = ".$idsito." ORDER BY NumeroPrenotazione DESC";
                                            $res2               = mysqli_query($conn2,$sel2);
                                            $rws                = mysqli_fetch_assoc($res2);
                                            $NumeroPrenotazione =  (intval($rws['NumeroPrenotazione'])+1); 
                                            //
                                            $FontePrenotazione  =   'italyfamilyhotels.it';
                                            $DataRichiesta      =   date('Y-m-d');
                                            $TipoRichiesta      =   'Preventivo';
                                            $Nome               =   $risultato['nome'];
                                            $Cognome            =   $risultato['cognome'];
                                            $Email              =   $risultato['email'];
                                            $Cellulare          =   $risultato['telefono'];
                                            $Lingua             =   'it';          
                                            $DataArrivo         =   $risultato['data_arrivo'];            
                                            $DataPartenza       =   $risultato['data_partenza'];                                                                                                                         
                                            $NumeroAdulti       =   $risultato['adulti'];
                                            $NumeroBambini      =   $risultato['bambini'];
                                            $EtaBambini         =   @implode(",", $risultato['eta_bambini']);

                                            $TestoNote  = str_replace(","," ",$risultato['messaggio']);
                                            $Note        = ($NumeroBambini > '0'?'Età: '.$EtaBambini."\r\n":'').($TestoNote!=''?'Note: '.$TestoNote:'');
                                            $AbilitaInvio       = '0';

                                    if($Nome != '' &&  $Cognome != '' && $Email != ''){
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
                                                            VALUES ('" . $idsito . "',
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
                                           mysqli_query($conn2,$insert);
                                        }                           
                             } // fine foreach value  

                        } // fine if se la chiave key è vuota

                    }// fine foeach array contenuti email               

                $syncro = "INSERT INTO hospitality_data_import_terzo_portale(idsito,data) VALUES('".$idsito."','".date('Y-m-d H:i:s')."')";
                mysqli_query($conn2,$syncro);
            }

            // chiudi la imap connection
            imap_expunge($inbox);
            imap_close($inbox);


        }else{

            
            $inbox = imap_open('{'.$server.':993/imap/ssl}INBOX',$user,$pass) or die('Cannot connect to NWSCloud: ' . imap_last_error());

            $search = 'SUBJECT "ITALY FAMILY HOTELS"';
            $emails = imap_search($inbox, $search);

            if($emails) {

                $array_contenuti_email = array();

                    foreach($emails as $key => $mail) {
                           

                        $headerInfo = imap_fetch_overview($inbox,$mail,0);
                        $headerInfo = $headerInfo[0];
            
                        $data_arrivo_mail_tmp1 = explode(",",$headerInfo->date);
                        $data_arrivo_mail_tmp = explode("+",$data_arrivo_mail_tmp1[1]);
                        $data_arrivo_mail = trim($data_arrivo_mail_tmp[0]);

                        $mesi=array("Jan" => "01","Feb" => "02","Mar" => "03","Apr" => "04","May" => "05","Jun" => "06","Jul" => "07","Aug" => "08","Sep" => "09","Oct" => "10","Nov" => "11","Dec" => "12"); 


                        $data_mail_tmp = explode(" ",$data_arrivo_mail);
                        $data_giorno = $data_mail_tmp[0];
                        $data_mese   = $data_mail_tmp[1];
                        $data_anno   = $data_mail_tmp[2];
                        $ora_mail    = $data_mail_tmp[3];

                        if(strlen($data_giorno)==1)$data_giorno='0'.$data_giorno;
                        $maildata = $data_anno.'-'.$mesi[$data_mese].'-'.$data_giorno.' '.$ora_mail;


                            // se la data di arrivo email è maggiore della data dell'ultima importazione
                            if($maildata > $last_data_import){ 

                                if(strstr($headerInfo->subject,'ITALY FAMILY HOTELS')){ 

                                    $body = imap_body($inbox, $mail);
                
                                    $righe = imap_qprint($body);
                       
                                    $tipo_modulo = 'IF_P';

                                    $arr_field['IF_P']      = array('Codice' => 'Codice email');                

                                    $array_contenuti_email[$tipo_modulo][] =array('BODY' => $righe); 

                                }// fine provenineza da italyfamilyhotels.it

                            }

                    }// fine foreach

            } // fine if controllo emails classe
               
            if(!empty($array_contenuti_email)){

              foreach($array_contenuti_email as $key => $value){
                      
                    if($key != ''){

                            
                     foreach($value as $k => $val){

                         //azzero varibaili
                        $NumeroPrenotazione = '';
                        $FontePrenotazione  = '';
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
                        $TestoNote          = '';
                        $Note               = '';
                        $AbilitaInvio       = '';
                        $risultato          = '';
                        $chiave             = '';
                        $valore             = '';
                        $risultato          = '';
                        $Lingua             = '';
                        $EtaBambini         = '';
                        $nome_tmp           = '';
                        $Trattamento        = '';
                        $Camere             = '';
            

       
   
                                            $email_body = trim($val['BODY']); 
                                            $email_body = str_replace('&quot;','"',$email_body);

                                            preg_match_all('(<b>(.*?)</b>)', $email_body ,$result);
                                            preg_match_all('(<td>(.*?)</td>)', $email_body ,$content);
                                          
                                            $risultato = $content[1];


                                            $conn2 = mysqli_connect($host, $username, $password,$dbname) or die ("Error connecting to database");
                                            mysqli_set_charset($conn2,'utf8');
                                         
                                            $sel2               = "SELECT NumeroPrenotazione FROM hospitality_guest WHERE idsito = ".$idsito." ORDER BY NumeroPrenotazione DESC";
                                            $res2               = mysqli_query($conn2,$sel2);
                                            $rws                = mysqli_fetch_assoc($res2);
                                            $NumeroPrenotazione =  (intval($rws['NumeroPrenotazione'])+1); 
                                            //
                                            $FontePrenotazione  =   'italyfamilyhotels.it';
                                            $DataRichiesta      =   date('Y-m-d');
                                            $TipoRichiesta      =   'Preventivo';
                                            $Nome               =   $risultato[0];
                                            $Cognome            =   $risultato[1];
                                            $Email              =   $risultato[2];
                                            $Cellulare          =   $risultato[3];
                                            if(strlen($risultato[4])==10 && strstr($risultato[4],"/")){
                                                $DataArrivo_         =   explode("/",$risultato[4]);            
                                                $DataPartenza_       =   explode("/",$risultato[5]);
                                                $DataArrivo          =   $DataArrivo_[2].'-'.$DataArrivo_[1].'-'.$DataArrivo_[0];
                                                $DataPartenza        =   $DataPartenza_[2].'-'.$DataPartenza_[1].'-'.$DataPartenza_[0];
                                                $NumeroAdulti        =   $risultato[6];
                                                if($risultato[7]!=''){
                                                    $NumeroBambini      =   $risultato[7];
                                                    $EtaBambini         =   $risultato[8];
                                                }
                                            }else{
                                                $TestoNote           =   str_replace(","," ",$risultato[4]); 
                                                $DataArrivo_         =   explode("/",$risultato[5]);            
                                                $DataPartenza_       =   explode("/",$risultato[6]); 
                                                $DataArrivo          =   $DataArrivo_[2].'-'.$DataArrivo_[1].'-'.$DataArrivo_[0];
                                                $DataPartenza        =   $DataPartenza_[2].'-'.$DataPartenza_[1].'-'.$DataPartenza_[0];                                                                                                                        
                                                $NumeroAdulti        =   $risultato[7];
                                                if($risultato[8]!=''){
                                                    $NumeroBambini      =   $risultato[8];
                                                    $EtaBambini         =   $risultato[9];
                                                }                                            
                                            }
                                            $Lingua                 =   'it';   
                                            $Note                   = ($NumeroBambini > '0'?'Età: '.$EtaBambini."\r\n":'').($TestoNote!=''?'Note: '.$TestoNote:'');
                                            $AbilitaInvio           = '0';

                                    if($Nome != '' &&  $Cognome != '' && $Email != ''){
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
                                                            VALUES ('" . $idsito . "',
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
                                         mysqli_query($conn2,$insert);
                                        }                           
                             } // fine foreach value  

                        } // fine if se la chiave key è vuota

                    }// fine foeach array contenuti email               

                $syncro = "INSERT INTO hospitality_data_import_terzo_portale(idsito,data) VALUES('".$idsito."','".date('Y-m-d H:i:s')."')";
                mysqli_query($conn2,$syncro);
            }

            // chiudi la imap connection
            imap_expunge($inbox);
            imap_close($inbox);


        }

}// fine if tabella dei valori imap è vuota
mysqli_close($conn);
mysqli_close($conn2);
?>