<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_t_do'){

            $idsito                     = $_REQUEST['idsito'];
            $domanda_id                 = $_REQUEST['domanda_id'];
            $lingua                     = $_REQUEST['lingua'];
            $Domanda                    = $dbMysqli->escape($_REQUEST['Domanda']);


            $insert ="INSERT INTO hospitality_domande_lingua(domanda_id,idsito,lingue,Domanda) VALUES ('".$domanda_id."','".$idsito."','".$lingua."','". $Domanda."')";
            $dbMysqli->query($insert);

	}
?>