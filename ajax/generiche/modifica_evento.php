<?php

/**
 * CRM and CMS
 * @author Marcello Visigalli <a marcello.visigalli@gmail.com >
 * @version 3.0
 * @name SuiteWeb
 * CRUD for insert, update, delete query in ajax
 */
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

if($_REQUEST['action']=='mod_evento'){

    $idsito     = $_REQUEST['idsito'];
    $Id         = $_REQUEST['Id'];
    $Abilitato  = $_REQUEST['Abilitato'];
    $coordinate = str_replace("(","",$_REQUEST['Coordinate']);
    $coordinate = str_replace(")","",$coordinate);
    $coordinate = str_replace(",","",$coordinate);
    $Evento     = $dbMysqli->escape($_REQUEST['Evento']);

    if($_REQUEST['Immagine']==''){
        $select = "SELECT Immagine FROM hospitality_eventi WHERE Id = ".$Id;
        $img = $dbMysqli->query($select);
        $rec = $img[0];
        $Immagine = $rec['Immagine'];
    }else{
        $Immagine = $_REQUEST['Immagine'];
    }
    $DataInizio = $_REQUEST['DataInizio'];
    $DataFine   = $_REQUEST['DataFine'];
    $OraFine    = $_REQUEST['OraFine'];
    $OraInizio  = $_REQUEST['OraInizio'];
    $Indirizzo  = $dbMysqli->escape($_REQUEST['Indirizzo']);

	$update = "UPDATE hospitality_eventi SET
                                            Evento     = '".$Evento."',
                                            Immagine   = '".$Immagine."',
                                            DataInizio = '".$DataInizio."',
                                            DataFine   = '".$DataFine."',
                                            OraInizio  = '".$OraInizio."',
                                            OraFine    = '".$OraFine."',
                                            Indirizzo  = '".$Indirizzo."',
                                            Coordinate = pointfromtext('POINT(".$coordinate.")'),
                                            Abilitato  = '".$Abilitato."'
                                        WHERE
                                            Id = ".$Id."
                                        AND 
                                            idsito = ".$idsito;
	$dbMysqli->query($update);
}

?>