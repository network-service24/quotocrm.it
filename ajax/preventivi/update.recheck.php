<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

	$idsito = $_REQUEST['idsito'];
    $value  = $_REQUEST['value'];

        $query = 'UPDATE siti SET CheckNumberRows =  '.$value.' WHERE idsito = '.$idsito;
        $dbMysqli->query($query);


?>