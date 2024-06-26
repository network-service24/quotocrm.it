<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_listino'){

            $idsito    = $_REQUEST['idsito'];
            $Id        = $_REQUEST['Id'];
            $Listino   = $_REQUEST['Listino'];
            $Abilitato = $_REQUEST['Abilitato'];


            $update ="UPDATE hospitality_numero_listini SET Listino = '".$Listino."', Abilitato = '".$Abilitato."' WHERE Id = ".$Id." AND idsito = ".$idsito ;
            $dbMysqli->query($update);

            if($_REQUEST['Abilitato']==1){
                $update2 = "UPDATE hospitality_numero_listini SET Abilitato = 0 WHERE Id != ".$Id;
                $dbMysqli->query($update2);
            }


	}
?>