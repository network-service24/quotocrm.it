<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_mo'){

			$idsito = $_REQUEST['idsito'];
            $abilitato   = $_REQUEST['abilitato'];
			$motivazione  = $dbMysqli->escape($_REQUEST['motivazione']);

            $insert ="INSERT INTO hospitality_tipo_voucher_cancellazione(idsito,Lingua,Motivazione,Abilitato)  VALUES ('".$idsito."','it','".$motivazione."','".$abilitato."')";
            $dbMysqli->query($insert);

	}

?>