<?php

$nomesito    = $_GET['azione'];
$idsito      = $_GET['param'];
$idreport    = $_GET['valore'];
$data_report = $_GET['back'];


if ($idreport != '') {

    if (file_exists(BASE_PATH_ADMIN . "report/document/" . $idsito . "/" . $nomesito  . '_qto_' . $data_report . '.pdf')) {
        unlink(BASE_PATH_ADMIN . "report/document/" . $idsito . "/" . $nomesito . '_qto_' . $data_report . '.pdf'); 
    }

    $dbMysqli->query("UPDATE report_clienti SET quoto = '' WHERE quoto = " . $idreport." AND idsito = ".$idsito);
    $dbMysqli->query("DELETE FROM report_quoto_dati WHERE Id = " . $idreport);



    header('Location:' . BASE_URL_ADMIN . 'report/archivio/');
}




?>