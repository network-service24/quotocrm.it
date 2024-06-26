<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_soggiorno'){

            $idsito    = $_REQUEST['idsito'];
            $Abilitato = $_REQUEST['Abilitato'];
            $TipoSoggiorno  = $dbMysqli->escape($_REQUEST['TipoSoggiorno']);


            $insert ="INSERT INTO hospitality_tipo_soggiorno(idsito,Lingua,TipoSoggiorno,Abilitato) VALUES ('".$idsito."','it','". $TipoSoggiorno."','". $Abilitato."')";
            $dbMysqli->query($insert);

	}
?>