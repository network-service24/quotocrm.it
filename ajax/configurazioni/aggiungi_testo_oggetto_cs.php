<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_t_cs'){

            $idsito                     = $_REQUEST['idsito'];
            $id_dizionario              = $_REQUEST['id_dizionario'];
            $lingua                     = $_REQUEST['lingua'];
            $oggetto                    = $dbMysqli->escape($_REQUEST['oggetto']);


            $insert ="INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES ('".$id_dizionario."','".$idsito."','".$lingua."','". $oggetto."')";
            $dbMysqli->query($insert);

	}
?>