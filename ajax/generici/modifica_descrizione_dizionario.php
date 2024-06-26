<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_dizionario'){

        $id              = $_REQUEST['id'];
        $idsito          = $_REQUEST['idsito'];
        $descrizione     = $dbMysqli->escape($_REQUEST['descrizione']);

        $update ="UPDATE hospitality_dizionario SET                                                   
                                                    descrizione   = '".$descrizione."'
                                                WHERE
                                                    id =  ".$id."
                                                AND
                                                    idsito = ".$idsito;

        $dbMysqli->query($update);



	}

?>