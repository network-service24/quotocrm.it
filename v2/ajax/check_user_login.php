<?php
include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");

error_reporting(0); 

$username   = DB_SUITEWEB_USER;
$password   = DB_SUITEWEB_PASSWORD;
$host       = DB_SUITEWEB_HOST;
$dbname     = DB_SUITEWEB_NAME;

$conn = mysqli_connect($host, $username, $password, $dbname) or die ("Error connecting to database");

    $username    = $_REQUEST['username'];

	if($username){ 

        $sel   = "SELECT * FROM utenti WHERE username = '".$username."'";
        $r     = mysqli_query($conn,$sel);
        $check_user = mysqli_num_rows($r);
        echo $check_user;
    
    
    }
	mysqli_close($conn);
?>