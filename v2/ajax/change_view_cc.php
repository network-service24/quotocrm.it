<?php

require($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");
error_reporting(0);

$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password, $dbname) or die ("Error connecting to database");
mysqli_set_charset($conn, 'utf8');

$idCarta     = $_REQUEST['idCarta'];

mysqli_query($conn, 'UPDATE hospitality_carte_credito SET visibile = 0  WHERE Id = ' .$idCarta);

?>
