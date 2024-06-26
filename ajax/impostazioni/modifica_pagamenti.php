<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_pagamenti'){

            $idsito        = $_REQUEST['idsito'];
            $Lingua        = 'it';
            $Id            = $_REQUEST['Id'];
            $ApiKeyNexi    = $_REQUEST['ApiKeyNexi'];
            $SegretKeyNexi = $_REQUEST['SegretKeyNexi'];
            $ApiKeyStripe  = $_REQUEST['ApiKeyStripe'];
            $serverURL     = $_REQUEST['serverURL'];
            $tid           = $_REQUEST['tid'];
            $kSig          = $_REQUEST['kSig'];
            $ShopUserRef   = $_REQUEST['ShopUserRef'];
            $EmailPayPal   = $_REQUEST['EmailPayPal'];
            $mastercard    = $_REQUEST['mastercard'];
            $visa          = $_REQUEST['visa'];
            $amex          = $_REQUEST['amex'];
            $diners        = $_REQUEST['diners'];
            $Abilitato     = $_REQUEST['Abilitato'];
            $Ordine        = $_REQUEST['Ordine'];

            $update ="UPDATE hospitality_tipo_pagamenti SET ApiKeyNexi    = '".$ApiKeyNexi."',
                                                            SegretKeyNexi = '".$SegretKeyNexi."',
                                                            ApiKeyStripe  = '".$ApiKeyStripe."',
                                                            serverURL     = '".$serverURL."',
                                                            tid           = '".$tid."',
                                                            kSig          = '".$kSig."',
                                                            ShopUserRef   = '".$ShopUserRef."',
                                                            EmailPayPal   = '".$EmailPayPal."',
                                                            mastercard    = '".$mastercard."',
                                                            visa          = '".$visa."',
                                                            amex          = '".$amex."',
                                                            diners        = '".$diners."',
                                                            Abilitato     = '".$Abilitato."',
                                                            Ordine        = '".$Ordine."'
                                                        WHERE
                                                            Id = ".$Id."
                                                        AND
                                                            idsito = ".$idsito;
            $dbMysqli->query($update);

	}
?>