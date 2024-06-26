<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='get_color'){

            $idsito    = $_REQUEST['idsito'];
            $Template  = $_REQUEST['Template'];

            $select = "SELECT Background FROM hospitality_template_background WHERE idsito =  ".$idsito." AND TemplateName = '".$Template."'";
            $result = $dbMysqli->query($select);
            $record = $result[0];

            echo $record['Background'];
	}


?>