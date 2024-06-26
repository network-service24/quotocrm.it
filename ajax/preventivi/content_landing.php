<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

$TipoRichiesta  =   $_REQUEST['tiporichiesta'];
$Id             =   $_REQUEST['id_richiesta'];
$idsito         =   $_REQUEST['idsito'];
$Lingua         =   $_REQUEST['lingua'];

// query per testo alternativo landing page
$select = "SELECT Testo,Id FROM hospitality_contenuti_web_lingua WHERE IdRichiesta = ".$Id." AND idsito = ".$idsito." AND Lingua = '".$Lingua."' ORDER BY Id DESC";
$res = $dbMysqli->query($select);
$tot = sizeof($res);

if($tot>0){
    $TestoAlternativo = $res[0]['Testo'];
}
else{
    // query per testo default landing page
    $sele = "SELECT Testo FROM hospitality_contenuti_web WHERE TipoRichiesta = '".$TipoRichiesta."' AND idsito = ".$idsito." AND Lingua = '".$Lingua."' AND Abilitato = 1";
    $re = $dbMysqli->query($sele);
    $v = $re[0];
    $TestoAlternativo = stripslashes($v['Testo']);
}
       



echo $TestoAlternativo;

?>