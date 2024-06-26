<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='get_color'){

            $idsito     = $_REQUEST['idsito'];
            $Background = $_REQUEST['Background'];

            $select = "SELECT Pulsante FROM hospitality_template_colori WHERE idsito =  ".$idsito." AND Background = '".$Background."'";
            $result = $dbMysqli->query($select);
            $record = $result[0];

            echo $record['Pulsante'];
	}


?>