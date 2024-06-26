<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_be'){

            $idsito                 = $_REQUEST['idsito'];
            $Abilitato              = $_REQUEST['Abilitato'];
            $UrlHost                = $_REQUEST['UrlHost'];
            $ProxyAuth              = $_REQUEST['ProxyAuth'];
            $VendorAccount          = $_REQUEST['VendorAccount'];
            $HotelAccount           = $_REQUEST['HotelAccount'];
            $UrlHostSetting         = $_REQUEST['UrlHostSetting'];
            $ProxyAuthSetting       = $_REQUEST['ProxyAuthSetting'];
            $VendorAccountSetting   = $_REQUEST['VendorAccountSetting'];
            $HotelAccountSetting    = $_REQUEST['HotelAccountSetting'];            
            $PMS                    = $_REQUEST['PMS'];

            $insert ="INSERT INTO hospitality_bedzzlebooking(idsito,UrlHost,ProxyAuth,VendorAccount,HotelAccount,UrlHostSetting,ProxyAuthSetting,VendorAccountSetting,HotelAccountSetting,PMS,Abilitato)  VALUES ('".$idsito."','".$UrlHost."','".$ProxyAuth."','".$VendorAccount."','".$HotelAccount."','".$UrlHostSetting."','".$ProxyAuthSetting."','".$VendorAccountSetting."','".$HotelAccountSetting."','".$PMS."','".$Abilitato."')";
            $dbMysqli->query($insert);

	}

?>