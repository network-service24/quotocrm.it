<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_mo'){

            $id           = $_REQUEST['id'];
            $idsito       = $_REQUEST['idsito'];
            $abilitato    = $_REQUEST['abilitato'];
            $motivazione  = $dbMysqli->escape($_REQUEST['motivazione']);

            $update ="UPDATE hospitality_tipo_voucher_cancellazione SET Motivazione   = '".$motivazione."', Abilitato = '".$abilitato."' WHERE Id =  ".$id." AND idsito = ".$idsito;
            $dbMysqli->query($update);

	}

?>