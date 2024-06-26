<?php
include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");
 //error_reporting(0); 
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password, $dbname) or die ("Error connecting to database");

$idsito             = $_REQUEST['idsito'];
$NumeroPrenotazione = $_REQUEST['NumeroPrenotazione'];

if(is_array($_REQUEST['Provenienza']) && ! empty($_REQUEST['Provenienza'])){
    $prov = '';
    $time = '';
    foreach($_REQUEST['Provenienza'] as $key => $value)	{

        $prov = mysqli_real_escape_string($conn,$_REQUEST['Provenienza'][$key]);
        $time = mysqli_real_escape_string($conn,$_REQUEST['Timeline'][$key]);

        $update = "UPDATE hospitality_fonti_provenienza SET Provenienza = '".$prov."', Timeline = '".$time."' WHERE Id = ".$key ." AND idsito = ".$idsito." AND NumeroPrenotazione = ".$NumeroPrenotazione; 
        mysqli_query($conn,$update);

    }

}else{
    $prov_ = mysqli_real_escape_string($conn,$_REQUEST['Provenienza']);
    $time_ = mysqli_real_escape_string($conn,$_REQUEST['Timeline']);

    $insert = "INSERT INTO hospitality_fonti_provenienza(idsito,NumeroPrenotazione,Provenienza,Timeline) VALUES('".$idsito."','".$NumeroPrenotazione."','".$prov_."','".$time_."')"; 
    mysqli_query($conn,$insert);

}

mysqli_close($conn);
?>