<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_precheckin'){

            $idsito    = $_REQUEST['idsito'];
            $abilitato = $_REQUEST['abilitato'];
            $etichetta   = $dbMysqli->escape($_REQUEST['etichetta']);


            $insert ="INSERT INTO hospitality_precheckin(idsito,Lingua,etichetta,abilitato) VALUES ('".$idsito."','it','". $etichetta."','". $abilitato."')";
            $result = $dbMysqli->query($insert);
            $id_precheckin = $dbMysqli->getInsertId($result);

            $insert1 ="INSERT INTO hospitality_precheckin_lingua(id_precheckin,idsito,Lingua,oggetto,testo) VALUES ('".$id_precheckin."','".$idsito."','it','','')";
            $dbMysqli->query($insert1);

            $insert2 ="INSERT INTO hospitality_precheckin_lingua(id_precheckin,idsito,Lingua,oggetto,testo) VALUES ('".$id_precheckin."','".$idsito."','en','','')";
            $dbMysqli->query($insert2);

            $insert3 ="INSERT INTO hospitality_precheckin_lingua(id_precheckin,idsito,Lingua,oggetto,testo) VALUES ('".$id_precheckin."','".$idsito."','fr','','')";
            $dbMysqli->query($insert3);

            $insert4 ="INSERT INTO hospitality_precheckin_lingua(id_precheckin,idsito,Lingua,oggetto,testo) VALUES ('".$id_precheckin."','".$idsito."','de','','')";
            $dbMysqli->query($insert4);

	}
?>