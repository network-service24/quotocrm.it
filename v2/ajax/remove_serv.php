<?php
include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");
 error_reporting(0); 
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password,$dbname) or die ("Error connecting to database");
mysqli_set_charset($conn,'utf8');


	$idsito    = $_REQUEST['idsito'];
    $n_prop    = $_REQUEST['n_prop'];
    $id_serv   = $_REQUEST['id_serv'];



    $delete = "DELETE FROM hospitality_relazione_servizi_proposte WHERE id = ".$id_serv."";
    mysqli_query($conn,$delete) or die();




	mysqli_close($conn);
?>