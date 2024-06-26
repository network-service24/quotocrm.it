<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_pacchetti'){

            $idsito                     = $_REQUEST['idsito'];
            $id                         = $_REQUEST['id'];
            $lingua                     = $_REQUEST['lingua'];
            $pacchetto                  = $dbMysqli->escape($_REQUEST['pacchetto']);
            $descrizione                = $dbMysqli->escape($_REQUEST['descrizione']);

           $update ="UPDATE hospitality_tipo_pacchetto_lingua  SET lingue = '".$lingua."', Pacchetto = '".$pacchetto."', Descrizione = '".$descrizione."' WHERE Id = ".$id." AND idsito =  ".$idsito;
                           
            $dbMysqli->query($update);

	}

?>