<?php


include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");
            error_reporting(0); 
        
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password, $dbname) or die ("Error connecting to database quoto");
mysqli_set_charset($conn, 'utf8');
		
$array	= $_REQUEST['item'];

if ($_POST['update'] == "update"){
	
	$count = 1;
	foreach ($array as $idval) {
		$query = "UPDATE hospitality_form_contenuti set ordinamento =" . $count . " WHERE id=" . $idval;
		mysqli_query($conn,$query) or die('Error, insert query failed');
		$count ++;	
	}
	echo ' <div class="alert alert-success alert-dismissable">Tutti salvato! senza aggiornare la pagina!</div>';
}

mysqli_close($conn);
?>