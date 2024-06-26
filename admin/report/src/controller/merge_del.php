<?php

$nomesito    = $_GET['azione'];
$idsito      = $_GET['param'];
$data_report = $_GET['valore'];


if ($idsito  != '') {

    if (file_exists(BASE_PATH_SITO . "report/document/" . $idsito . "/" . $nomesito  . "_qto_" . $data_report . ".pdf")) {
        unlink(BASE_PATH_SITO . "report/document/" . $idsito . "/" . $nomesito . "_qto_" . $data_report . ".pdf"); 
    }
    if (file_exists(BASE_PATH_SITO . "report/document/" . $idsito . "/merge_" . $nomesito  . "_" . $data_report . ".pdf")) {
        unlink(BASE_PATH_SITO . "report/document/".$idsito."/merge_".$nomesito."_".$data_report.".pdf");
    }
    if (file_exists(BASE_PATH_SITO . "report/document/" . $idsito . "/" . $nomesito  . "_chiusura_" . $data_report . ".pdf")) {
        unlink(BASE_PATH_SITO . "report/document/".$idsito."/".$nomesito."_chiusura_".$data_report.".pdf");
    }
    $dbMysqli->query("DELETE FROM report_clienti WHERE idsito = ".$idsito." AND data_report = '".flip_data($data_report)."'");
    $dbMysqli->query("DELETE FROM report_quoto_dati WHERE idsito = ".$idsito." AND data_report = '".flip_data($data_report)."'");



    header('Location:' . BASE_URL_ADMIN . 'report/archivio/');
}



?>