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

$idsito = $_REQUEST['idsito'];

$select  = "SELECT * FROM assistenze_quoto WHERE idsito = ".$idsito;
$res = $dbMysqli->query($select);
$rwc = $res[0];


echo $rwc['comunicazioni'];
