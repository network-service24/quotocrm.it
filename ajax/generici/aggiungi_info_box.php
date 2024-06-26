<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_ib'){

            $idsito      = $_REQUEST['idsito'];
            $abilitato   = $_REQUEST['abilitato'];
            $titolo      = $dbMysqli->escape($_REQUEST['titolo']);

            $insert ="INSERT INTO hospitality_info_box(idsito,Titolo,Abilitato)  VALUES ('".$idsito."','".$titolo."','".$abilitato."')";
            $dbMysqli->query($insert);

	}

?>