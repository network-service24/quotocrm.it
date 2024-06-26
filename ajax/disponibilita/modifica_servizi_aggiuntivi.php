<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_servizi_aggiuntivi'){

            $idsito              = $_REQUEST['idsito'];
            $Id                  = $_REQUEST['Id'];
            if($_REQUEST['Icona']==''){
                $select = "SELECT Icona FROM hospitality_tipo_servizi WHERE Id = ".$Id;
                $img = $dbMysqli->query($select);
                $rec = $img[0];
                $Icona = $rec['Icona'];
            }else{
                $Icona = $_REQUEST['Icona'];
            }

            $PrezzoServizio      = str_replace(",",".",$_REQUEST['PrezzoServizio']);
            $PercentualeServizio = str_replace(",",".",$_REQUEST['PercentualeServizio']);
            $CalcoloPrezzo       = $_REQUEST['CalcoloPrezzo'];
            $TipoServizio        = $dbMysqli->escape($_REQUEST['TipoServizio']);
            $Ordine              = $_REQUEST['Ordine'];

            $update ="UPDATE hospitality_tipo_servizi SET Icona ='".$Icona."', TipoServizio = '". $TipoServizio."', PrezzoServizio = '". $PrezzoServizio."', PercentualeServizio = '". $PercentualeServizio."' , CalcoloPrezzo = '". $CalcoloPrezzo."', Ordine = '". $Ordine."' WHERE Id = ".$Id." AND idsito = ".$idsito;
            $dbMysqli->query($update);

	}
?>