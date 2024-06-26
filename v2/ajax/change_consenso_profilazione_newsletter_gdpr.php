<?php


require($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");
error_reporting(0); 
        
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password, $dbname) or die ("Error connecting to database");
mysqli_set_charset($conn, 'utf8');	
		
$id    = $_REQUEST['id'];
$valore_profilazione = $_REQUEST['valore_profilazione'];

if($valore_profilazione==1){
	$text = 'Il consenso alla profilazione è stato abilitato da una vostra azione il '.date('d-m-Y H.i.s').', la responsabilità di questa scelta è totalmente a vostro carico liberando Network Service da ogni onere ed obbligo!';
}else{
	$text = 'Il consenso alla profilazione è stato disabilitato da una vostra azione il '.date('d-m-Y H.i.s').'!';
}

mysqli_query($conn,'UPDATE mailing_newsletter SET CheckConsensoProfilazione = '.$valore_profilazione.'  WHERE Id = ' . $id.'');

?>