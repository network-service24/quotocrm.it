<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

$idsito = $_REQUEST['idsito'];
$Id = $_REQUEST['id'];

if($idsito != '' && $Id != ''){

    $sql = "SELECT SUM(DISTINCT(p.PrezzoP)) as num
                FROM hospitality_guest g
                INNER JOIN hospitality_proposte p ON p.id_richiesta = g.Id
                WHERE g.Id = ".$Id."
                AND g.idsito = $idsito";

    $result = $dbMysqli_sviluppo_quoto->query($sql);
    $record = $result[0];
    $cdPrice = count($result) > 0 ? $record['num'] : 0;
    
    echo number_format($cdPrice, 2, ',', '.');
}

?>
