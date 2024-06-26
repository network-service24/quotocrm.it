<?php


require($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");
error_reporting(0); 
        
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password, $dbname) or die ("Error connecting to database");
mysqli_set_charset($conn, 'utf8');	
		
$id_richiesta     = $_REQUEST['id_richiesta'];
$idsito           = $_REQUEST['idsito'];

if($_REQUEST['action']=='change'){
    if($_REQUEST['DataScadenza']!=''){
        
        if(strstr($_REQUEST['DataScadenza'],'/')){
            $dataS_tmp = explode("/",$_REQUEST['DataScadenza']);
        }
        if(strstr($_REQUEST['DataScadenza'],'-')){
            $dataS_tmp = explode("/",$_REQUEST['DataScadenza']);
        }

        $dataS = $dataS_tmp[2].'-'.$dataS_tmp[1].'-'.$dataS_tmp[0];

        mysqli_query($conn,"UPDATE hospitality_guest SET DataScadenza = '".$dataS."' WHERE Id = ".$id_richiesta." AND idsito = ".$idsito."");
    }
}
?>