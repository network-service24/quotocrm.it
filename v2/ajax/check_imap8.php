<?

include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");
error_reporting(0); 
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password, $dbname) or die ("Error connecting to database");

$idsito = $_REQUEST['idsito'];

$qry     = "SELECT * FROM hospitality_imap_email  WHERE Portale = 'bimboinviaggio.com' AND idsito = ".$idsito." AND Abilitato = 1 ORDER BY Id DESC";
$sq      = mysqli_query($conn,$qry);
$row     = mysqli_fetch_array($sq); 
$server  = $row['ServerEmail'];
$user    = $row['UserEmail'];
$pass    = $row['PasswordEmail']; 

if($user !='' && $pass !=''){ 

    if(strstr($server,'gmail')){

        //connessione a gmail
        $inbox = imap_open('{imap.gmail.com:993/imap/ssl}INBOX',$user,$pass) or die('<p class="text-red">Cannot connect to Gmail: ' . imap_last_error().'</p>');
        if($inbox){
            echo '<p class="text-green">Esistono dati accessibili per i valori IMAP GMAIL inseriti</p>';
        }

    }elseif(strstr($server,'ex2')){
                //connessione a gmail
                $inbox = imap_open('{'.$server .':993/imap/ssl}INBOX',$user,$pass) or die('<p class="text-red">Cannot connect to Exchange: ' . imap_last_error().'</p>');
                if($inbox){
                    echo '<p class="text-green">Esistono dati accessibili per i valori IMAP EXCHANGE inseriti</p>';
                }
    }else{

        $inbox2 = imap_open('{'.$server.'/notls}', $user, $pass) or die('<p class="text-red">Cannot connect to '.$server.': ' . imap_last_error().'</p>');
        if($inbox2){
             echo '<p class="text-green">Esistono dati accessibili per i valori IMAP inseriti</p>';
        }
        
    } // if gmail oppure altro server    

}else{
    echo '<p class="text-maroon">Accessi IMAP vuoti!</p>';
}// fine if tabella dei valori imap è vuota
?>