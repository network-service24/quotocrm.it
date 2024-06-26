<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_servizio_aggiuntivo'){

            $idsito              = $_REQUEST['idsito'];
            $Icona               = $_REQUEST['Icona'];
            $PrezzoServizio      = str_replace(",",".",$_REQUEST['PrezzoServizio']);
            $PercentualeServizio = str_replace(",",".",$_REQUEST['PercentualeServizio']);
            $CalcoloPrezzo       = $_REQUEST['CalcoloPrezzo'];
            $TipoServizio        = $dbMysqli->escape($_REQUEST['TipoServizio']);
            $Ordine              = $_REQUEST['Ordine'];

            $insert ="INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,PercentualeServizio,CalcoloPrezzo,Abilitato,Ordine) VALUES ('".$idsito."','it','". $Icona."','". $TipoServizio."','". $PrezzoServizio."','". $PercentualeServizio."','". $CalcoloPrezzo."','1','". $Ordine."')";
            $dbMysqli->query($insert);

	}
?>