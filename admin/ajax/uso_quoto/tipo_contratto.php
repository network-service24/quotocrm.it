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

$id_tipo_contratto = $_REQUEST['id_tipo_contratto'];

$select  = "SELECT * FROM tipo_contratto WHERE id_tipo_contratto = ".$id_tipo_contratto;
$res = $dbMysqli->query($select);
$rwc = $res[0];
$output = $rwc['nome_contratto'];
switch($rwc['id_tipo_contratto']){
    case 1:
        $color = 'text-pink';
    break;
    case 2:
        $color = 'text-gray';
    break;
    case 3:
        $color = 'text-purple';
    break;
}

echo '<span class="'.$color.'">'.$output.'</span>';
