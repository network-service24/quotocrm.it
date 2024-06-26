<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_motivazione'){

            $idsito               = $_REQUEST['idsito'];
            $id                   = $_REQUEST['id'];
            $motivazione_id       = $_REQUEST['motivazione_id'];
            $lingua               = $_REQUEST['lingue'];
            $Motivazione          = $dbMysqli->escape($_REQUEST['Motivazione']);
            $Oggetto              = $dbMysqli->escape($_REQUEST['Oggetto']);
            $Descrizione          = $dbMysqli->escape($_REQUEST['Descrizione']);

            $update ="  UPDATE hospitality_tipo_voucher_cancellazione_lingua  SET lingue = '".$lingua."', Motivazione = '".$Motivazione."', Oggetto = '".$Oggetto."', Descrizione = '".$Descrizione."' WHERE Id = ".$id." AND idsito =  ".$idsito;
                           
            $dbMysqli->query($update);

	}
#######################################################################################################################

header('Location:'.BASE_URL_SITO.'disponibilita-add_motivazioni/'. $motivazione_id .'/');

#######################################################################################################################
?>