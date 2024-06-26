<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

$delete = "DELETE FROM hospitality_check_modifica WHERE id = ".$_REQUEST['id'];
$dbMysqli->query($delete);

?>