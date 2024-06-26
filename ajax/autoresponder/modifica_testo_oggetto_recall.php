<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_oggetto'){

            $idsito                     = $_REQUEST['idsito'];
            $id                         = $_REQUEST['id'];
            $lingua                     = $_REQUEST['lingua'];
            $oggetto                    = $dbMysqli->escape($_REQUEST['oggetto']);

            $update ="  UPDATE hospitality_dizionario_lingua  SET Lingua = '".$lingua."', testo =  '".$oggetto."' WHERE id = ".$id." AND idsito =  ".$idsito;
            $dbMysqli->query($update);

	}
?>