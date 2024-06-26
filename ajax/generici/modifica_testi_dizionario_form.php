<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_dizionario_form'){

        $testo            = $dbMysqli->escape($_REQUEST['testo']);
        $id               = $_REQUEST['id'];
        $lingua           = $_REQUEST['lingua'];
        $idsito           = $_REQUEST['idsito'];

        $update ="  UPDATE dizionario_form_quoto_lingue  SET Lingua = '".$lingua."', testo =  '".$testo."' WHERE id = ".$id." AND idsito =  ".$idsito;

        $dbMysqli->query($update);

	}

?>