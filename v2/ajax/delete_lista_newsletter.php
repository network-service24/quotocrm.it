<?php
include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");
 error_reporting(0); 
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password, $dbname) or die ("Error connecting to database");

	$idlista = $_REQUEST['idlista'];
	$idsito  = $_REQUEST['idsito'];

    mysqli_query($conn,"DELETE FROM mailing_newsletter_nome_liste WHERE id = '".$idlista."' AND idsito = ".$idsito);
    mysqli_query($conn,"DELETE FROM mailing_newsletter WHERE id_lista = '".$idlista."' AND idsito = ".$idsito);



	mysqli_close($conn);
?>