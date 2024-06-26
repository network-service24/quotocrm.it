<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
 error_reporting(0); 
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password,$dbname) or die ("Error connecting to database");
mysqli_set_charset($conn,'utf8');

	$id         = $_REQUEST['id'];
    $idsito     = $_REQUEST['idsito'];
    $attivo     = $_REQUEST['attivo'];

    $update     = "UPDATE mailing_newsletter SET attivo = ".$attivo." WHERE id = ".$id." AND idsito = ".$idsito ;
    mysqli_query($conn,$update);
    
    echo $update;

	mysqli_close($conn);
?>