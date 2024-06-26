<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

$idsito             = $_REQUEST['idsito'];
$NumeroPrenotazione = $_REQUEST['NumeroPrenotazione'];

if(is_array($_REQUEST['Provenienza']) && ! empty($_REQUEST['Provenienza'])){
    $prov = '';
    $time = '';
    foreach($_REQUEST['Provenienza'] as $key => $value)	{

        $prov = $dbMysqli->escape($_REQUEST['Provenienza'][$key]);
        $time = $dbMysqli->escape($_REQUEST['Timeline'][$key]);

        $update = "UPDATE hospitality_fonti_provenienza SET Provenienza = '".$prov."', Timeline = '".$time."' WHERE Id = ".$key ." AND idsito = ".$idsito." AND NumeroPrenotazione = ".$NumeroPrenotazione; 
        $dbMysqli->query($update);

    }

}else{
    $prov_ = $dbMysqli->escape($_REQUEST['Provenienza']);
    $time_ = $dbMysqli->escape($_REQUEST['Timeline']);

    $insert = "INSERT INTO hospitality_fonti_provenienza(idsito,NumeroPrenotazione,Provenienza,Timeline) VALUES('".$idsito."','".$NumeroPrenotazione."','".$prov_."','".$time_."')"; 
    $dbMysqli->query($insert);

}

?>