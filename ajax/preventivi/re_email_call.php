<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


$id     = $_REQUEST['id'];
$idsito = $_REQUEST['idsito'];

$q = $dbMysqli->query('SELECT DataAzione FROM hospitality_traccia_email_cron WHERE IdRichiesta = ' . $id . ' AND Idsito = ' . $idsito . ' AND TipoReInvio = "ReCall" ORDER BY Id DESC');
if (sizeof($q) > 0) {
    $rec = $q[0];
    $check = '<i class="fa fa-repeat" data-toggle="tooltip" title="Invio ReCall del preventivo avvenuto il ' . $fun->gira_data($rec['DataAzione']) . '"></i>';
    echo $check;
} else {
    echo '';
}
    
?>