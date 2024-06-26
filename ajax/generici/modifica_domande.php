<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_do'){

            $id           = $_REQUEST['id'];
            $idsito       = $_REQUEST['idsito'];
            $abilitato    = $_REQUEST['abilitato'];
            $Ordine       = $_REQUEST['Ordine'];
            $Domanda      = $dbMysqli->escape($_REQUEST['Domanda']);

            $update ="UPDATE hospitality_domande SET Domanda   = '".$Domanda."', Abilitato = '".$abilitato."', Ordine = '".$Ordine."' WHERE Id =  ".$id." AND idsito = ".$idsito;
            $dbMysqli->query($update);

	}

?>