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
include($_SERVER['DOCUMENT_ROOT']."/include/function.inc.php");

$idsito_  = explode("_",$_REQUEST['idsito']);
$idsito = $idsito_[0];

$select = "SELECT web,nome FROM siti WHERE idsito = " . $idsito;
$res = $dbMysqli->query($select);
$row = $res[0];

echo strtoupper($row['nome'])."\r\n".$row['web'];