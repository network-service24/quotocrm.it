<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");

error_reporting(0); 

$username   = DB_SUITEWEB_USER;
$password   = DB_SUITEWEB_PASSWORD;
$host       = DB_SUITEWEB_HOST;
$dbname     = DB_SUITEWEB_NAME;

$conn = mysqli_connect($host, $username, $password, $dbname) or die ("Error connecting to database");

    $email    = $_REQUEST['email'];

	if($email){ 

        $sel   = "SELECT * FROM siti WHERE email = '".$email."'";
        $r     = mysqli_query($conn,$sel);
        $check_email = mysqli_num_rows($r);
        echo $check_email;
    
    
    }
	mysqli_close($conn);
?>