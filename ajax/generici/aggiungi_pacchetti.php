<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_pa'){

			$idsito = $_REQUEST['idsito'];
            $abilitato   = $_REQUEST['abilitato'];
			$tipo_pacchetto  = $dbMysqli->escape($_REQUEST['tipo_pacchetto']);

            $insert ="INSERT INTO hospitality_tipo_pacchetto(idsito,Lingua,TipoPacchetto,Abilitato)  VALUES ('".$idsito."','it','".$tipo_pacchetto."','".$abilitato."')";
            $dbMysqli->query($insert);

	}

?>