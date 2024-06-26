<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_domande'){

            $idsito                     = $_REQUEST['idsito'];
            $id                         = $_REQUEST['id'];
            $lingua                     = $_REQUEST['lingua'];
            $Domanda                    = $dbMysqli->escape($_REQUEST['Domanda']);

           $update ="UPDATE hospitality_domande_lingua  SET lingue = '".$lingua."', Domanda = '".$Domanda."' WHERE Id = ".$id." AND idsito =  ".$idsito;

            $dbMysqli->query($update);

	}

?>