<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_be'){

            $Id                     = $_REQUEST['id'];
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

            $update ="UPDATE hospitality_bedzzlebooking SET 
                                                            UrlHost               = '".$UrlHost."',
                                                            ProxyAuth             = '".$ProxyAuth."',
                                                            VendorAccount         = '".$VendorAccount."',
                                                            HotelAccount          = '".$HotelAccount."',
                                                            UrlHostSetting        = '".$UrlHostSetting."',
                                                            ProxyAuthSetting      = '".$ProxyAuthSetting."',
                                                            VendorAccountSetting  = '".$VendorAccountSetting."',
                                                            HotelAccountSetting   = '".$HotelAccountSetting."',
                                                            PMS                   = '".$PMS."', 
                                                            Abilitato             = '".$Abilitato."' 
                                                        WHERE 
                                                            Id =  ".$Id." 
                                                        AND 
                                                            idsito = ".$idsito;
            $dbMysqli->query($update);

	}

?>