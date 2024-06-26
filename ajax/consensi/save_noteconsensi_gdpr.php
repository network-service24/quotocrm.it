<?php


require($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
error_reporting(0); 
        
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password, $dbname) or die ("Error connecting to database");
mysqli_set_charset($conn, 'utf8');	
		
$id                  = $_REQUEST['id'];
$valore_noteconsensi = $_REQUEST['valore_noteconsensi'];

 
$update = 'UPDATE mailing_newsletter SET NoteConsensi = "'.$valore_noteconsensi.'"  WHERE Id = ' . $id.'';
mysqli_query($conn,$update);

$select = 'SELECT NoteConsensi FROM mailing_newsletter  WHERE Id = ' . $id.'';
$result = mysqli_query($conn,$select);
$row = mysqli_fetch_assoc($result);

echo $row['NoteConsensi'];

?>