<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


	$idsito    = $_REQUEST['idsito'];
    $n_prop    = $_REQUEST['n_prop'];
    $id_serv   = $_REQUEST['id_serv'];



    $delete = "DELETE FROM hospitality_relazione_servizi_proposte WHERE id = ".$id_serv."";
    $dbMysqli->query($delete) or die();


?>