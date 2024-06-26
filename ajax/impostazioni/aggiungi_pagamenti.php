<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_pagamenti' && $_REQUEST['TipoPagamento'] !=''){

            $idsito        = $_REQUEST['idsito'];
            $Lingua        = 'it';
            $TipoPagamento = $_REQUEST['TipoPagamento'];
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

            $insert ="INSERT INTO hospitality_tipo_pagamenti(
                                                            idsito,
                                                            Lingua,
                                                            TipoPagamento,
                                                            ApiKeyNexi,
                                                            SegretKeyNexi,
                                                            ApiKeyStripe,
                                                            serverURL,
                                                            tid,
                                                            kSig,
                                                            ShopUserRef,
                                                            EmailPayPal,
                                                            mastercard,
                                                            visa,
                                                            amex,
                                                            diners,
                                                            Abilitato,
                                                            Ordine
                                                            ) 
                                                            VALUES 
                                                            (
                                                            '".$idsito."',
                                                            '".$Lingua."',
                                                            '".$TipoPagamento."',
                                                            '".$ApiKeyNexi."',
                                                            '".$SegretKeyNexi."',
                                                            '".$ApiKeyStripe."',
                                                            '".$serverURL."',
                                                            '".$tid."',
                                                            '".$kSig."',
                                                            '".$ShopUserRef."',
                                                            '".$EmailPayPal."',
                                                            '".$mastercard."',
                                                            '".$visa."',
                                                            '".$amex."',
                                                            '".$diners."',
                                                            '".$Abilitato."',
                                                            '".$Ordine."'
                                                            )";
            $result = $dbMysqli->query($insert);
            $pagamenti_id = $dbMysqli->getInsertId($result);

            $insert1 ="INSERT INTO hospitality_tipo_pagamenti_lingua(pagamenti_id,idsito,lingue,Pagamento,Descrizione) VALUES ('".$pagamenti_id."','".$idsito."','it','','')";
            $dbMysqli->query($insert1);

            $insert2 ="INSERT INTO hospitality_tipo_pagamenti_lingua(pagamenti_id,idsito,lingue,Pagamento,Descrizione) VALUES ('".$pagamenti_id."','".$idsito."','en','','')";
            $dbMysqli->query($insert2);

            $insert3 ="INSERT INTO hospitality_tipo_pagamenti_lingua(pagamenti_id,idsito,lingue,Pagamento,Descrizione) VALUES ('".$pagamenti_id."','".$idsito."','fr','','')";
            $dbMysqli->query($insert3);

            $insert4 ="INSERT INTO hospitality_tipo_pagamenti_lingua(pagamenti_id,idsito,lingue,Pagamento,Descrizione) VALUES ('".$pagamenti_id."','".$idsito."','de','','')";
            $dbMysqli->query($insert4);
	}
?>