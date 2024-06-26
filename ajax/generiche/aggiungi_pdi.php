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

if($_REQUEST['action']=='add_pdi'){

    $idsito         = $_REQUEST['idsito'];
    $Abilitato      = $_REQUEST['Abilitato'];
    $coordinate     = str_replace("(","",$_REQUEST['Coordinate']);
    $coordinate     = str_replace(")","",$coordinate);
    $coordinate     = str_replace(",","",$coordinate);
    $PuntoInteresse = $dbMysqli->escape($_REQUEST['PuntoInteresse']);
    $Immagine       = $_REQUEST['Immagine'];
    $Indirizzo      = $dbMysqli->escape($_REQUEST['Indirizzo']);
    $Ordine         = $_REQUEST['Ordine'];

	$insert = "INSERT INTO  hospitality_pdi (
                                                idsito,
                                                PuntoInteresse,
                                                Immagine,
                                                Indirizzo,
                                                Coordinate,
                                                Abilitato,
                                                Ordine
                                                ) 
                                                VALUES(
                                                    '".$idsito."',
                                                    '".$PuntoInteresse."',
                                                    '".$Immagine."',
                                                    '".$Indirizzo."',
                                                    pointfromtext('POINT(".$coordinate.")'),
                                                    '".$Abilitato."',
                                                    '".$Ordine."'
                                                    )";
	$dbMysqli->query($insert);
}

?>