<?php
global $prt,$dbMysqli;

if ($_REQUEST['param'] == 'sync') {
    $pms = $_REQUEST['valore'];
    $idPrenotazione = $_REQUEST['azione'];
    $pms_info = $_REQUEST['pms_info'] ?? 'modified';

    // Ericsoft
    if ($pms == 'E') {
        $sqlUpdate = "UPDATE hospitality_data_syncro_pms 
        SET pms_info = 'modified' 
        WHERE id_prenotazione = $idPrenotazione AND idsito = " . IDSITO . " AND TypePms = 'E'";
        $dbMysqli->query($sqlUpdate);
        if ($pms_info == 'modified') {
            $sqlUpdate = "UPDATE hospitality_data_syncro_pms 
                             SET pms_info = '$pms_info'  
                           WHERE id_prenotazione = $idPrenotazione 
                             AND idsito = " . IDSITO . " 
                             AND TypePms = 'E'";
            $dbMysqli->query($sqlUpdate);
        }
        else if ($pms_info == 'canceled') {
            $sqlUpdate = "UPDATE hospitality_data_syncro_pms 
                             SET pms_info = '$pms_info'  
                           WHERE id_prenotazione = $idPrenotazione 
                             AND idsito = " . IDSITO . " 
                             AND TypePms = 'E'";
            $dbMysqli->query($sqlUpdate);
/*             $sqlDelete = "DELETE FROM hospitality_data_syncro_pms 
                                 WHERE id_prenotazione = $idPrenotazione 
                                   AND idsito = " . IDSITO . " 
                                   AND TypePms = 'E'";
            $db->query($sqlDelete); */
        }
    }
}

$prt->_goto(BASE_URL_SITO . ''.$_REQUEST['prov'].'/');
