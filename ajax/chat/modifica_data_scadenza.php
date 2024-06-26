<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

$id_richiesta     = $_REQUEST['id_richiesta'];
$idsito           = $_REQUEST['idsito'];

if($_REQUEST['action']=='change'){
    if($_REQUEST['DataScadenza']!=''){

        $dbMysqli->query("UPDATE hospitality_guest SET DataScadenza = '".$_REQUEST['DataScadenza']."' WHERE Id = ".$id_richiesta." AND idsito = ".$idsito."");
    }
}
?>