<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

$delete = "DELETE FROM hospitality_check_modifica WHERE idsito = ".$_REQUEST['idsito'];
$dbMysqli->query($delete);

?>