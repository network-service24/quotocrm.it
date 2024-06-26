<?php

include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");

error_reporting(0); 
        
$username   = DB_SUITEWEB_USER;
$password   = DB_SUITEWEB_PASSWORD;
$host       = DB_SUITEWEB_HOST;
$dbname     = DB_SUITEWEB_NAME;

$conn = mysqli_connect($host, $username, $password,$dbname) or die ("Error connecting to database");
mysqli_set_charset($conn,'utf8');

 $id_regione = $_REQUEST['id_regione'];


echo '<option value=""></option>'; 

$query = "SELECT * FROM province WHERE codice_regione = '".$id_regione ."' ORDER BY nome_provincia ASC";
$result      = mysqli_query($conn,$query) or die();
while($row = mysqli_fetch_assoc($result)) {
	
	echo '<option value="'.$row['codice_provincia'].'">'.$row['sigla_provincia'].'</option>';
	
}	
?>