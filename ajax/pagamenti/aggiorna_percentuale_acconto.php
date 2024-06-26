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

if($_REQUEST['action']=='mod_acconto'){

    $Acconto = $_REQUEST['Acconto'];
    $Id      = $_REQUEST['Id'];
    $idsito  = $_REQUEST['idsito'];

    $update = "UPDATE hospitality_acconto_pagamenti SET Acconto = ".$Acconto." WHERE Id = ".$Id." AND idsito = ".$idsito;
    $dbMysqli->query($update);

}

?>