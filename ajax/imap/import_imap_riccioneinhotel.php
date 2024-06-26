<?
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
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


$qry     = "SELECT * FROM hospitality_imap_email  WHERE Portale = 'riccioneinhotel.com' AND idsito = ".$idsito."  AND Abilitato = 1 ORDER BY Id DESC";
$sq      = mysqli_query($conn,$qry);
$row     = mysqli_fetch_assoc($sq);
    
    $server  = $row['ServerEmail'];
    $user    = $row['UserEmail'];
    $pass    = $row['PasswordEmail']; 
    $idsito  = $row['idsito']; 

    if($user !='' && $pass !=''){ 

        if(strstr($server,'gmail')){

            //connessione a gmail
            $inbox = imap_open('{imap.gmail.com:993/imap/ssl}INBOX',$user,$pass) or die('Cannot connect to Gmail: ' . imap_last_error());

            // grab emails
            $emails = imap_search($inbox,'ALL');
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

            $q = "SELECT * FROM hospitality_data_import_quarto_portale WHERE idsito = ".$idsito." ORDER BY Id DESC";
            $sel = mysqli_query($conn,$q);
            $rws = mysqli_fetch_assoc($sel);
            $last_data_import = $rws['data'];


            // if emails risponde ciclo
            if($emails) {

                $array_contenuti_email = array();
                                                
                    foreach($emails as $mail) {
                        
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

                                if(strstr($headerInfo->subject,'riccioneinhotel.com')){ 

                                    $body = imap_body($inbox, $mail, FT_PEEK);

                                    $righe = imap_qprint($body);
 
                                    $tipo_modulo = 'RH_P';

                                    $arr_field['RH_P']      = array('Codice' => 'Codice email');                

                                    $array_contenuti_email[$tipo_modulo][] =array('BODY' => $righe); 

                                }// fine provenineza da gabiccemare.com

                            }// fine controlla data dell'ultima importazione


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
            

       
                                            $email_body     = trim($val['BODY']); 
                                            $email_body = str_replace('&quot;','"',$email_body);

                                            preg_match_all('(<div id="email-code" style="display: none; max-height: 0px; font-size: 0px; overflow: hidden; mso-hide: all">(.*?)</div>)', $email_body ,$result);

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
                                            $FontePrenotazione  = 'riccioneinhotel.com';
                                            
                                            $DataRichiesta      =   date('Y-m-d');
                                            $TipoRichiesta      =   'Preventivo';
                                            $nome_tmp = explode(' ',$risultato['nome']);
                                            if($nome_tmp[1]!=''){
                                                $Nome          =   $nome_tmp[0];
                                                $Cognome       =   $nome_tmp[1];
                                            }else{
                                                $Nome          =   $risultato['nome'];
                                                $Cognome       =   '';
                                            }

                                            $Email         =   $risultato['email'];
                                            $Cellulare     =   $risultato['telefono'];
                                            $Lingua             =   'it';

                                            $data_arr_tmp  = explode("/",$risultato['arrivo']);              
                                            $DataArrivo   = $data_arr_tmp[2]."-".$data_arr_tmp[1]."-".$data_arr_tmp[0];   
                                            $data_par_tmp  = explode("/",$risultato['partenza']);              
                                            $DataPartenza = $data_par_tmp[2]."-".$data_par_tmp[1]."-".$data_par_tmp[0];                                                                                                                             

                                            $Trattamento  = $risultato['trattamento']; 
                                            $NumeroAdulti  = $risultato['rooms'][0]['adulti'];
                                            $NumeroBambini = $risultato['rooms'][0]['bambini'];
                                            $EtaBambini    = $risultato['rooms'][0]['eta_bambini'];

                                            $plus = '';
                                            if(count($risultato['rooms']) > 1){
                                                foreach ($risultato['rooms'] as $x => $vv) {
                                                    if($x != 0){
                                                        $plus .= 'Altra camera'."\r\n";
                                                        $plus .= 'Adulti: '.$vv['adulti']."\r\n";
                                                        $plus .= 'Bambini: '.$vv['bambini']."\r\n";
                                                        $plus .= 'Età: '.$vv['eta_bambini']."\r\n";                                                          
                                                    }
                                                }
                                            }


                                            $TestoNote  = str_replace(","," ",$risultato['messaggio']);
                                            $Note        = ($Trattamento != ''?'Trattamento: '.$Trattamento."\r\n":'').($NumeroBambini > '0'?'Età: '.$EtaBambini."\r\n":'').$plus."\r\n".($TestoNote!=''?'Note: '.$TestoNote:'');
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

                $syncro = "INSERT INTO hospitality_data_import_quarto_portale(idsito,data) VALUES('".$idsito."','".date('Y-m-d H:i:s')."')";
                mysqli_query($conn2,$syncro);
            }

            // chiudi la imap connection
            imap_expunge($inbox);
            imap_close($inbox);




        }else{

            require(INC_PATH_CLASS.'email_reader.php');
            $emails = New Email_reader();
            $emails->inbox();
            $total  = count($emails->inbox);

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

            $q = "SELECT * FROM hospitality_data_import_quarto_portale WHERE idsito = ".$idsito." ORDER BY Id DESC";
            $sel = mysqli_query($conn,$q);
            $rws = mysqli_fetch_assoc($sel);
            $last_data_import = $rws['data'];

            $array_contenuti_email = array();
            
            for($i=$total-1;$i>=0;$i--) {
                $email = $emails->inbox[$i];

                $data_arrivo_mail_tmp = explode("+",$email['header']->MailDate);
                $data_arrivo_mail = trim($data_arrivo_mail_tmp[0]);

                $mesi=array("Jan" => "01","Feb" => "02","Mar" => "03","Apr" => "04","May" => "05","Jun" => "06","Jul" => "07","Aug" => "08","Sep" => "09","Oct" => "10","Nov" => "11","Dec" => "12");       

                $data_mail_tmp = explode(" ",$data_arrivo_mail);
                $data_mail = $data_mail_tmp[0];
                $ora_mail  = $data_mail_tmp[1];
                $data_m = explode("-",$data_mail);
                if(strlen($data_m[0])==1)$data_m[0]='0'.$data_m[0];
                $maildata = $data_m[2].'-'.$mesi[$data_m[1]].'-'.$data_m[0].' '.$ora_mail;

                    // se la data di arrivo email è maggiore della data dell'ultima importazione
                    if($maildata > $last_data_import){  
                   
                        // provenienza gabiccemare.com
                        if((strstr($email['header']->subject,'Richiesta')) && (strstr($email['header']->subject,'riccioneinhotel.com'))){

                          // decript dei contenuti della email                
                            $righe = imap_qprint($email['body']);

                            $tipo_modulo = 'RH_P';

                            $arr_field['RH_P']      = array('Codice' => 'Codice email');              

                            $array_contenuti_email[$tipo_modulo][] =array('BODY' => $righe);         

                        }// fine provenineza da gabiccemare.com

                    }// fine controlla data dell'ultima importazione

            }//fine ciclo lettura imap

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
            
         
   
                                            $email_body     = trim($val['BODY']); 
                                            $email_body = str_replace('&quot;','"',$email_body);

                                            preg_match_all('(<div id="email-code" style="display: none; max-height: 0px; font-size: 0px; overflow: hidden; mso-hide: all">(.*?)</div>)', $email_body ,$result);

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
                                            $FontePrenotazione  = 'riccioneinhotel.com';
                                            
                                            $DataRichiesta      =   date('Y-m-d');
                                            $TipoRichiesta      =   'Preventivo';
                                            $nome_tmp = explode(' ',$risultato['nome']);
                                            if($nome_tmp[1]!=''){
                                                $Nome          =   $nome_tmp[0];
                                                $Cognome       =   $nome_tmp[1];
                                            }else{
                                                $Nome          =   $risultato['nome'];
                                                $Cognome       =   '';
                                            }

                                            $Email         =   $risultato['email'];
                                            $Cellulare     =   $risultato['telefono'];
                                            $Lingua             =   'it';

                                            $data_arr_tmp  = explode("/",$risultato['arrivo']);              
                                            $DataArrivo   = $data_arr_tmp[2]."-".$data_arr_tmp[1]."-".$data_arr_tmp[0];   
                                            $data_par_tmp  = explode("/",$risultato['partenza']);              
                                            $DataPartenza = $data_par_tmp[2]."-".$data_par_tmp[1]."-".$data_par_tmp[0];                                                                                                                             

                                            $Trattamento  = $risultato['trattamento']; 
                                            $NumeroAdulti  = $risultato['camera'][0]['adulti'];
                                            $NumeroBambini = $risultato['camera'][0]['bambini'];
                                            $EtaBambini    = $risultato['camera'][0]['eta_bambini'];

                                            $plus = '';
                                            if(count($risultato['camera']) > 1){
                                                foreach ($risultato['camera'] as $x => $vv) {
                                                    if($x != 0){
                                                        $plus .= 'Altra camera'."\r\n";
                                                        $plus .= 'Adulti: '.$vv['adulti']."\r\n";
                                                        $plus .= 'Bambini: '.$vv['bambini']."\r\n";
                                                        $plus .= 'Età: '.$vv['eta_bambini']."\r\n";                                                          
                                                    }
                                                }
                                            }


                                            $TestoNote  = str_replace(","," ",$risultato['messaggio']);
                                            $Note        = ($Trattamento != ''?'Trattamento: '.$Trattamento."\r\n":'').($NumeroBambini > '0'?'Età: '.$EtaBambini."\r\n":'').$plus."\r\n".($TestoNote!=''?'Note: '.$TestoNote:'');
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

                $syncro = "INSERT INTO hospitality_data_import_quarto_portale(idsito,data) VALUES('".$idsito."','".date('Y-m-d H:i:s')."')";
               mysqli_query($conn2,$syncro);
            }
            
        } // if gmail oppure altro server    

    }// fine if tabella dei valori imap è vuota
mysqli_close($conn);
mysqli_close($conn2);
?>