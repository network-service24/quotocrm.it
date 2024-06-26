<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_pa'){

            $id           = $_REQUEST['id'];
            $idsito       = $_REQUEST['idsito'];
            $abilitato    = $_REQUEST['abilitato'];
            $tipo_pacchetto  = $dbMysqli->escape($_REQUEST['tipo_pacchetto']);

            $update ="UPDATE hospitality_tipo_pacchetto SET TipoPacchetto   = '".$tipo_pacchetto."', Abilitato = '".$abilitato."' WHERE Id =  ".$id." AND idsito = ".$idsito;
            $dbMysqli->query($update);

	}

?>