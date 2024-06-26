<?

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
error_reporting(0); 
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password, $dbname) or die ("Error connecting to database");

$idsito = $_REQUEST['idsito'];

$qry     = "SELECT * FROM hospitality_imap_email  WHERE Portale = 'info-alberghi.com' AND idsito = ".$idsito." AND Abilitato = 1 ORDER BY Id DESC";
$sq      = mysqli_query($conn,$qry);
$row     = mysqli_fetch_array($sq); 
$server  = $row['ServerEmail'];
$user    = $row['UserEmail'];
$pass    = $row['PasswordEmail']; 

if($user !='' && $pass !=''){ 

    if(strstr($server,'gmail')){

        //connessione a gmail
        $inbox = imap_open('{imap.gmail.com:993/imap/ssl}INBOX',$user,$pass) or die('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-remove"></i></button><p class="text-red">info-alberghi.com: Cannot connect to Gmail: ' . imap_last_error().'</p></div>');
        if($inbox){
            echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-remove"></i></button><p>info-alberghi.com: Esistono dati accessibili per i valori IMAP GMAIL inseriti</p></div>';
        }


    }else{

        $inbox2 = imap_open('{'.$server.'/notls}', $user, $pass) or die('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-remove"></i></button><p class="text-red">info-alberghi.com: Cannot connect to '.$server.': ' . imap_last_error().'</p></div>');
        if($inbox2){
             echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-remove"></i></button><p>info-alberghi.com: Esistono dati accessibili per i valori IMAP inseriti</p></div>';
        }
        
    } // if gmail oppure altro server    

}else{
    echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-remove"></i></button><p>info-alberghi.com: Accessi IMAP vuoti!</p></div>';
}// fine if tabella dei valori imap è vuota
?>