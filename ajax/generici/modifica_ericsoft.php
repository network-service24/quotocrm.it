<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_es'){

            $Id                     = $_REQUEST['id'];
            $idsito                 = $_REQUEST['idsito'];
            $Abilitato              = $_REQUEST['Abilitato'];
            $UrlHost                = $_REQUEST['UrlHost'];
            $LicenzaId              = $_REQUEST['LicenzaId'];
            $ProviderCode           = $_REQUEST['ProviderCode'];
            $ProviderApiKey         = $_REQUEST['ProviderApiKey'];
            $PMS                    = $_REQUEST['PMS'];

            $update ="UPDATE hospitality_ericsoftbooking SET UrlHost = '".$UrlHost."',LicenzaId = '".$LicenzaId."',ProviderCode  = '".$ProviderCode."',ProviderApiKey   = '".$ProviderApiKey."',PMS   = '".$PMS."', Abilitato = '".$Abilitato."' WHERE Id =  ".$Id." AND idsito = ".$idsito;
            $dbMysqli->query($update);

	}

?>