<?php
error_reporting(0);

    include($_SERVER['DOCUMENT_ROOT'].'/v2/include/settings.inc.php');
    require($_SERVER['DOCUMENT_ROOT'].'/v2/xcrud/xcrud.php');
    include($_SERVER['DOCUMENT_ROOT'].'/v2/include/function.inc.php');

    $xcrud = Xcrud::get_instance();

    $db = Xcrud_db::get_instance();

    $riepilogo = '';
    $valori    = array();
    $val       = array();

    // output headers so that the file is downloaded rather than displayed
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=export_schedina_alloggiati_'.$_REQUEST['NumPreno'].'_'.$_REQUEST['idsito'].'_'.date('d-m-Y').'.csv');
    header('Pragma: no-cache');
    error_reporting(0);
    // create a file pointer connected to the output stream
    $output = fopen('php://output', 'w');

    // output the column headings
    fputcsv($output, array('Tipo Componente', 'Tipo Documento', 'Numero Documento', 'Comune di Emissione', 'Stato di Emissione', 'Data Rilascio', 'Data Scadenza', 'Nome', 'Cognome', 'Sesso', 'Cittadinanza', 'Indirizzo', utf8_decode('Città'), 'Provincia', 'CAP', 'Data di Nascita', 'Stato di Nascita', 'Luogo di Nascita', 'Provincia di Nascita', 'Note'),';');

    $select = "SELECT * FROM hospitality_checkin WHERE Prenotazione = ".$_REQUEST['NumPreno']." AND idsito = ".$_REQUEST['idsito']."";
    $qy     = $db->query($select);
    $rec    = $db->result($qy);
   


    $select2 = "SELECT * FROM hospitality_guest WHERE NumeroPrenotazione = ".$_REQUEST['NumPreno']." AND idsito = ".$_REQUEST['idsito']." AND TipoRichiesta = 'Conferma' AND Chiuso = 1";
    $qy2     = $db->query($select2);
    $row    = $db->row($qy2);

    $riepilogo = 'Prenotazione Nr. '.$row['NumeroPrenotazione'].', ospiti Nr. '.($row['NumeroAdulti']+$row['NumeroBambini']).', presso la nostra stuttura ricettiva dal '.gira_data($row['DataArrivo']).' al '.gira_data($row['DataPartenza']).' ';


    foreach ($rec as $key => $val) {

        $valori = array(utf8_decode($val['TipoComponente']),utf8_decode($val['TipoDocumento']),$val['NumeroDocumento'],utf8_decode($val['ComuneEmissione']),$val['StatoEmissione'],($val['DataRilascio']!='0000-00-00'?gira_data($val['DataRilascio']):''),($val['DataScadenza']!='0000-00-00'?gira_data($val['DataScadenza']):''),$val['Nome'],$val['Cognome'],$val['Sesso'],$val['Cittadinanza'],utf8_decode($val['Indirizzo']),($val['lang']=='it'?utf8_decode($val['Citta']):utf8_decode($val['CittaBis'])),($val['lang']=='it'?$val['Provincia']:$val['ProvinciaBis']),$val['cap'],gira_data($val['DataNascita']),$val['StatoNascita'],($val['lang']=='it'?utf8_decode($val['LuogoNascita']):utf8_decode($val['LuogoNascitaBis'])),($val['lang']=='it'?$val['ProvinciaNascita']:$val['ProvinciaNascitaBis']),utf8_decode($val['Note']),$riepilogo);

        fputcsv($output,$valori,';');

    }
    $val = array($riepilogo,'','','','','','','','','','','','','','','','','','','','');
    fputcsv($output,$val,';');


    fclose($output);

