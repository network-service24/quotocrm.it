<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_cs'){

            $idsito            = $_REQUEST['idsito'];
            $Abilitato         = $_REQUEST['Abilitato'];
            $Pms               = $_REQUEST['Pms'];
            $UrlHost           = $_REQUEST['UrlHost'];
            $Provider          = $_REQUEST['Provider'];
            $Code              = $_REQUEST['Code'];

            $insert ="INSERT INTO hospitality_pms(idsito,Pms,UrlHost,Provider,Code,Abilitato)  VALUES ('".$idsito."','".$Pms."','".$UrlHost."','".$Provider."','".$Code."','".$Abilitato."')";
            $dbMysqli->query($insert);

	}

?>