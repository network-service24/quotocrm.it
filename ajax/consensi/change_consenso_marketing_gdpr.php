<?php


require($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
error_reporting(0); 
        
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password, $dbname) or die ("Error connecting to database");
mysqli_set_charset($conn, 'utf8');	
		
$id_richiesta     = $_REQUEST['id_richiesta'];
$valore_marketing = $_REQUEST['valore_marketing'];

if($valore_marketing==1){
	$text = 'Il consenso all\'invio di materiale marketing è stato abilitato da una vostra azione il '.date('d-m-Y H.i.s').', la responsabilità di questa scelta è totalmente a vostro carico liberando Network Service da ogni onere ed obbligo!';
}else{
	$text = 'Il consenso all\'invio di materiale marketing è stato disabilitato da una vostra azione il '.date('d-m-Y H.i.s').'!';
}

mysqli_query($conn,'UPDATE hospitality_guest SET CheckConsensoMarketing = '.$valore_marketing.'  WHERE Id = ' . $id_richiesta.'');

$select = "SELECT * FROM log_consenso_notifiche WHERE id_richiesta = ".$id_richiesta;
$res = mysqli_query($conn,$select);
$row = mysqli_fetch_assoc($res);
$tot = mysqli_num_rows($res);

if($tot>0){
	mysqli_query($conn,"UPDATE log_consenso_notifiche SET data = '".date('Y-m-d H:i:s')."', log = '".addslashes($text)."'  WHERE Id = ".$row['id']."");
}else{
	mysqli_query($conn,"INSERT INTO log_consenso_notifiche (id_richiesta,data,log) VALUES('".$id_richiesta."','".date('Y-m-d H:i:s')."','".addslashes($text)."')");
}


?>