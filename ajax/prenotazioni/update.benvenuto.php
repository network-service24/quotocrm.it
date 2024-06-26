<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

	$id     = $_REQUEST['id'];
    $value  = $_REQUEST['value'];

        $query = 'UPDATE hospitality_guest SET Visibile = '.$value.' WHERE Id = '.$id;
        $dbMysqli->query($query);


?>