<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_ta'){

			$idsito = $_REQUEST['idsito'];
			$etichetta  = $dbMysqli->escape($_REQUEST['etichetta']);

            $insert ="INSERT INTO hospitality_condizioni_tariffe(idsito,Lingua,etichetta)  VALUES ('".$idsito."','it','".$etichetta."')";
            $dbMysqli->query($insert);

	}

?>