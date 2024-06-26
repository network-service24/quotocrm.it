<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_foto'){

            $idsito   = $_REQUEST['idsito'];
            $Immagine = $_REQUEST['Immagine'];

            $insert ="INSERT INTO hospitality_gallery(idsito, Immagine, Abilitato) VALUES ('".$idsito."', '". $Immagine."','1')";
            $dbMysqli->query($insert);
	}
?>