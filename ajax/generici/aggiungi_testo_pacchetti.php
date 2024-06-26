<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_t_pa'){

            $idsito                     = $_REQUEST['idsito'];
            $pacchetto_id               = $_REQUEST['pacchetto_id'];
            $lingua                     = $_REQUEST['lingua'];
            $pacchetto                  = $dbMysqli->escape($_REQUEST['pacchetto']);
            $descrizione                = $dbMysqli->escape($_REQUEST['descrizione']);


            $insert ="INSERT INTO hospitality_tipo_pacchetto_lingua(pacchetto_id,idsito,lingue,Pacchetto,Descrizione) VALUES ('".$pacchetto_id."','".$idsito."','".$lingua."','". $pacchetto."','". $descrizione."')";
            $dbMysqli->query($insert);

	}
?>