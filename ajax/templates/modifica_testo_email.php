<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_content_email'){

            $idsito    = $_REQUEST['idsito'];
            $Id        = $_REQUEST['Id'];
            $Oggetto   = $dbMysqli->escape($_REQUEST['Oggetto']);
            $Messaggio = $dbMysqli->escape($_REQUEST['Messaggio']);


            $update ="UPDATE hospitality_contenuti_email SET Oggetto = '".$Oggetto."', Messaggio = '".$Messaggio."' WHERE Id = ".$Id." AND idsito = ".$idsito."";
            $dbMysqli->query($update);

	}

#######################################################################################################################

header('Location:'.BASE_URL_SITO.'templates-contenuti_email/');

#######################################################################################################################
?>