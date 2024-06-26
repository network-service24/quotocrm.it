<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


$IdRichiesta = $_REQUEST['IdRichiesta'];
$idsito      = $_REQUEST['idsito'];

$now = mktime(date('h'), 0, 0, date('m'), date('d'), date('Y'));
$trentaMin = mktime(date('h'), (date('i') + 30), 0, date('m'), date('d'), date('Y'));

$select = "SELECT * FROM hospitality_user_online WHERE online_timestamp != '' AND online_timestamp >= '" . $now . "' AND online_timestamp <= '" . $trentaMin . "' AND IdRichiesta = " . $IdRichiesta . " AND idsito = " . $idsito . "  ORDER BY online_timestamp DESC";
$execut = $dbMysqli->query($select);
$online = sizeof($execut);
if ($online > 0) {
    $user_online = '<i class="fa fa-user text-green Blink" data-toggle="tooltip" title="Utente Online! Controllo temporale per 30 minuti!"></i>';
} else {
    $user_online = '';
}
echo $user_online;
       
?>