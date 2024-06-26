<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_cs'){

            $Id                = $_REQUEST['id'];
            $idsito            = $_REQUEST['idsito'];
            $Abilitato         = $_REQUEST['Abilitato'];
            $Pms               = $_REQUEST['Pms'];
            $UrlHost           = $_REQUEST['UrlHost'];
            $Provider          = $_REQUEST['Provider'];
            $Code              = $_REQUEST['Code'];

            $update ="UPDATE hospitality_pms SET Pms = '".$Pms."',UrlHost = '".$UrlHost."',Provider  = '".$Provider."',Code   = '".$Code."', Abilitato = '".$Abilitato."' WHERE Id =  ".$Id." AND idsito = ".$idsito;
            $dbMysqli->query($update);

	}

?>