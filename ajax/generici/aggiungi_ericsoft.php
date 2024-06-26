<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_es'){

            $idsito                 = $_REQUEST['idsito'];
            $Abilitato              = $_REQUEST['Abilitato'];
            $UrlHost                = $_REQUEST['UrlHost'];
            $LicenzaId              = $_REQUEST['LicenzaId'];
            $ProviderCode           = $_REQUEST['ProviderCode'];
            $ProviderApiKey         = $_REQUEST['ProviderApiKey'];
            $PMS                    = $_REQUEST['PMS'];

            $insert ="INSERT INTO hospitality_ericsoftbooking(idsito,UrlHost,LicenzaId,ProviderCode,ProviderApiKey,PMS,Abilitato)  VALUES ('".$idsito."','".$UrlHost."','".$LicenzaId."','".$ProviderCode."','".$ProviderApiKey."','".$PMS."','".$Abilitato."')";
            $dbMysqli->query($insert);

	}

?>