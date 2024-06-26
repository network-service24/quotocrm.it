<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_listino'){

            $idsito    = $_REQUEST['idsito'];
            $Listino   = $_REQUEST['Listino'];
            $Abilitato = $_REQUEST['Abilitato'];


            $insert ="INSERT INTO hospitality_numero_listini(idsito,Listino,Abilitato) VALUES ('".$idsito."','".$Listino."','".$Abilitato."')";
            $result = $dbMysqli->query($insert);
            $lastId = $dbMysqli->getInsertId($result);

            $update = "UPDATE hospitality_numero_listini SET Abilitato = 0 WHERE Id != ".$lastId;
            $dbMysqli->query($update);


	}
?>