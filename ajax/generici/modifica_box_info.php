<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_boxinfo'){

            $id           = $_REQUEST['id'];
            $idsito       = $_REQUEST['idsito'];
            $abilitato    = $_REQUEST['abilitato'];
            $titolo  = $dbMysqli->escape($_REQUEST['titolo']);

            $update ="UPDATE hospitality_boxinfo_checkin SET Titolo   = '".$titolo."', Abilitato = '".$abilitato."' WHERE Id =  ".$id." AND idsito = ".$idsito;
            $dbMysqli->query($update);

	}

?>