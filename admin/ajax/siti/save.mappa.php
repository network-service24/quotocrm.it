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

    if($_REQUEST['LatLng'] != ''){

        $idsito = $_REQUEST['idsito'];

        $LatLng = str_replace(",", " ", $_REQUEST['LatLng']);

   echo     $update = "UPDATE siti SET coordinate = pointfromtext('POINT(".$LatLng.")') WHERE idsito = ".$idsito;
	    $dbMysqli->query($update);
    }

?>