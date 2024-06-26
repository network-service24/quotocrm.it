<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_motivazioni'){

            $idsito               = $_REQUEST['idsito'];
            $motivazione_id       = $_REQUEST['motivazione_id'];
            $lingua               = $_REQUEST['lingue'];
            $Motivazione          = $dbMysqli->escape($_REQUEST['Motivazione']);
            $Oggetto              = $dbMysqli->escape($_REQUEST['Oggetto']);
            $Descrizione          = $dbMysqli->escape($_REQUEST['Descrizione']);

            $insert ="INSERT INTO hospitality_tipo_voucher_cancellazione_lingua(motivazione_id,idsito,lingue,Motivazione,Oggetto,Descrizione) VALUES ('".$motivazione_id."','".$idsito."','".$lingua."','". $Motivazione."','". $Oggetto."','". $Descrizione."')";
            $dbMysqli->query($insert);

	}
#######################################################################################################################

header('Location:'.BASE_URL_SITO.'disponibilita-add_motivazioni/'. $motivazione_id .'/');

#######################################################################################################################
?>