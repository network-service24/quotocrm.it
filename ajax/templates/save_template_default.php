<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='save_template_default'){

            $Id                 = $_REQUEST['Id'];
            $idsito             = $_REQUEST['idsito'];
            $Template           = $_REQUEST['Template'];
            $BackgroundCellLink = $_REQUEST['BackgroundCellLink'];

            $update ="UPDATE hospitality_template_landing  SET Template = '".$Template."', BackgroundCellLink = '".$BackgroundCellLink."' WHERE Id = ".$Id." AND idsito =  ".$idsito;                         
            $dbMysqli->query($update);

	}
?>