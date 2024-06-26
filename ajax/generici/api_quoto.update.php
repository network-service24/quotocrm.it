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

    $idsito            = $_REQUEST['idsito'];
    $API_hospitality     = $_REQUEST['API_hospitality'];


	$update = "UPDATE siti SET API_hospitality = ".$API_hospitality." WHERE idsito = ".$idsito;
	$dbMysqli->query($update);


?>