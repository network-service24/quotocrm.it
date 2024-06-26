<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_do'){

            $idsito      = $_REQUEST['idsito'];
            $abilitato   = $_REQUEST['abilitato'];
            $Ordine      = $_REQUEST['Ordine'];
            $Domanda     = $dbMysqli->escape($_REQUEST['Domanda']);

            $insert ="INSERT INTO hospitality_domande(idsito,Lingua,Domanda,Abilitato,Ordine)  VALUES ('".$idsito."','it','".$Domanda."','".$abilitato."','".$Ordine."')";
            $dbMysqli->query($insert);

	}

?>