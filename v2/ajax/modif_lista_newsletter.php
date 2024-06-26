<?php
include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");
 error_reporting(0); 
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password, $dbname) or die ("Error connecting to database");

    $idlista   = $_REQUEST['idlista'];
    $nomelista = addslashes($_REQUEST['nomelista']);
	$idsito    = $_REQUEST['idsito'];

    mysqli_query($conn,"UPDATE mailing_newsletter_nome_liste SET nome_lista = '".$nomelista."' WHERE id = '".$idlista."' AND idsito = ".$idsito);



	mysqli_close($conn);
?>