<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_t_ta'){

            $idsito               = $_REQUEST['idsito'];
            $id_tariffe           = $_REQUEST['id_tariffe'];
            $lingua               = $_REQUEST['lingua'];
            $tariffa              = $dbMysqli->escape($_REQUEST['tariffa']);
            $testo                = $dbMysqli->escape($_REQUEST['testo']);


            $insert ="INSERT INTO hospitality_condizioni_tariffe_lingua(id_tariffe,idsito,Lingua,tariffa,testo) VALUES ('".$id_tariffe."','".$idsito."','".$lingua."','". $tariffa."','". $testo."')";
            $dbMysqli->query($insert);

	}
?>