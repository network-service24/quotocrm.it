<?
include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");
error_reporting(0); 
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysql_connect($host, $username, $password) or die ("Error connecting to database");
mysql_select_db($dbname);
mysql_set_charset('utf8', $conn);

$server  = '';
$user    = '';
$pass    = '';
$idsito  = $_REQUEST['idsito'];


$qry     = "SELECT * FROM hospitality_imap_email  WHERE Portale = 'info-alberghi.com' AND idsito = ".$idsito."  AND Abilitato = 1 ORDER BY Id DESC";
$sq      = mysql_query($qry);
$row     = mysql_fetch_assoc($sq);
    
    $server  = $row['ServerEmail'];
    $user    = $row['UserEmail'];
    $pass    = $row['PasswordEmail']; 
    $idsito  = $row['idsito']; 
   //connessione a gmail
/*     $inbox = imap_open('{imap.gmail.com:993/imap/ssl}INBOX',$user,$pass) or die('Cannot connect to Gmail: ' . imap_last_error());
    $emails = imap_search($inbox,'ALL');   */



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
            $Note                  = '';
            $AbilitaInvio          = '';
            $valore                = '';
            $risultato             = '';
            $Trattamento           = '';
            $email                 = ''; 
            $maildata              = ''; 
            $flex                  = '';
            $checkin               = '';
            $checkout              = '';
            $adult                 = '';
            $meal_plan             = '';
            $d_flessibili          = '';
            $bambini_eta_tmp       = '';
            $plus                  = ''; 
            $Lingua                = '';                  

            $q = "SELECT * FROM hospitality_data_import WHERE idsito = ".$idsito." ORDER BY Id DESC";
            $sel = mysql_query($q);
            $rws = mysql_fetch_assoc($sel);
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
                    //if($maildata > $last_data_import){  

                        // decript dei contenuti della email
                        $righe = imap_qprint($email['body']);

                            // provenienza Info Alberghi
                        if(strstr($email['header']->subject,'Info-Alberghi.com')){

                            $tipo_modulo = 'IA_P';
                                                 
                            $arr_field['IA_P']     = array('Codice' => 'Codice email');
                                      
                            $array_contenuti_email[$tipo_modulo][] =array('SENDER' => $email['header']->reply_toaddress,'HD' => $email['header']->subject,'BODY' => $righe,'DATA' => $data_arrivo_mail);         

                        }// fine provenineza da Info Alebrghi

                  ///  }// fine controlla data dell'ultima importazione
               
            }//fine ciclo lettura imap


            
print_r($righe);
         

?>