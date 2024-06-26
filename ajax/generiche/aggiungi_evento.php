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

if($_REQUEST['action']=='add_evento'){

    $idsito     = $_REQUEST['idsito'];
    $Abilitato  = $_REQUEST['Abilitato'];
    $coordinate = str_replace("(","",$_REQUEST['Coordinate']);
    $coordinate = str_replace(")","",$coordinate);
    $coordinate = str_replace(",","",$coordinate);
    $Evento     = $dbMysqli->escape($_REQUEST['Evento']);
    $Immagine   = $_REQUEST['Immagine'];
    $DataInizio = $_REQUEST['DataInizio'];
    $DataFine   = $_REQUEST['DataFine'];
    $OraFine    = $_REQUEST['OraFine'];
    $OraInizio  = $_REQUEST['OraInizio'];
    $Indirizzo  = $dbMysqli->escape($_REQUEST['Indirizzo']);

	$insert = "INSERT INTO  hospitality_eventi (
                                                idsito,
                                                Evento,
                                                Immagine,
                                                DataInizio,
                                                DataFine,
                                                OraInizio,
                                                OraFine,
                                                Indirizzo,
                                                Coordinate
                                                ,Abilitato
                                                ) 
                                                VALUES(
                                                    '".$idsito."',
                                                    '".$Evento."',
                                                    '".$Immagine."',
                                                    '".$DataInizio."',
                                                    '".$DataFine."',
                                                    '".$OraInizio."',
                                                    '".$OraFine."',
                                                    '".$Indirizzo."',
                                                    pointfromtext('POINT(".$coordinate.")'),
                                                    '".$Abilitato."'
                                                    )";
	$dbMysqli->query($insert);
}

?>