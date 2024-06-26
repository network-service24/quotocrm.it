<?php
error_reporting(0);
if($_REQUEST['action']=='export'){
    include($_SERVER['DOCUMENT_ROOT'].'/v2/include/settings.inc.php');
    require($_SERVER['DOCUMENT_ROOT'].'/v2/xcrud/xcrud.php');
    include($_SERVER['DOCUMENT_ROOT'].'/v2/include/function.inc.php');

    $xcrud = Xcrud::get_instance();

    $db = Xcrud_db::get_instance();


    // output headers so that the file is downloaded rather than displayed
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=export_'.$_REQUEST['idsito'].'_'.date('d-m-Y').'.csv');
    header('Pragma: no-cache');
    error_reporting(0);
    // create a file pointer connected to the output stream
    $output = fopen('php://output', 'w');

    // output the column headings
    fputcsv($output, array('Tipo Richiesta', 'Fonte Prenotazione', 'Target', 'Lingua', 'Nome', 'Cognome', 'Email', 'Data Arrivo', 'Data Partenza', 'Data Prenotazione', 'Prenotazione Confermata', 'Prenotazione Disdetta', 'Motivazione Disdetta', 'Questionario', 'Consenso Trattamento dati', 'Consenso invio Marketing'),';');

    if($_REQUEST['TipoSoggiorno']!='' || $_REQUEST['TipoCamere']!=''){
          $inner = ' INNER JOIN hospitality_richiesta ON hospitality_richiesta.id_richiesta = hospitality_guest.Id ';
          $campo = ', hospitality_richiesta.TipoCamere, hospitality_richiesta.TipoSoggiorno ';
    }

        $inner2 = ' INNER JOIN hospitality_tipo_voucher_cancellazione ON hospitality_tipo_voucher_cancellazione.Id = hospitality_guest.IdMotivazione ';
        $campo2 = ', hospitality_tipo_voucher_cancellazione.Motivazione';

    $q = "SELECT hospitality_guest.* ".$campo." ".$campo2." FROM hospitality_guest ".$inner." ".$inner2." WHERE hospitality_guest.idsito = ".$_REQUEST['idsito']."  AND hospitality_guest.DataRiconferma is Null ";

    if($_REQUEST['TipoSoggiorno']!=''){
          $q .= ' AND hospitality_richiesta.TipoSoggiorno = '.$_REQUEST['TipoSoggiorno'].' ';
    }
    if($_REQUEST['TipoCamere']!=''){
          $q .= ' AND hospitality_richiesta.TipoCamere = '.$_REQUEST['TipoCamere'].' ';
    }

    if($_REQUEST['DataArrivo']!='' || $_REQUEST['DataPartenza'] ==''){
      $data_dal_tmp_     = explode("/",$_REQUEST['DataArrivo']);
      $data_dal         = $data_dal_tmp_[2].'-'.$data_dal_tmp_[1].'-'.$data_dal_tmp_[0];
      $data_al_tmp_      = explode("/",$_REQUEST['DataPartenza']);
      $data_al          = $data_al_tmp_[2].'-'.$data_al_tmp_[1].'-'.$data_al_tmp_[0];
    }
    if($_REQUEST['DataArrivo']!='' && $_REQUEST['DataPartenza'] ==''){
        $q .= " AND hospitality_guest.DataArrivo >= '".$data_dal."' ";
    }
    if($_REQUEST['DataArrivo']!='' && $_REQUEST['DataPartenza'] !=''){
        $q .= " AND (hospitality_guest.DataArrivo >= '".$data_dal."' AND hospitality_guest.DataPartenza <= '".$data_al."') ";
    }
    if($_REQUEST['TipoRichiesta']!=''){
        if($_REQUEST['TipoRichiesta']=='Preventivo'){
         $q .= " AND hospitality_guest.TipoRichiesta = '".$_REQUEST['TipoRichiesta']."' ";
        }elseif($_REQUEST['TipoRichiesta']=='Conferma'){
            $q .= " AND hospitality_guest.TipoRichiesta = '".$_REQUEST['TipoRichiesta']."' ";
            $q .= " AND hospitality_guest.Chiuso = 0 ";
        }elseif($_REQUEST['TipoRichiesta']=='ConfermaC'){
            $q .= " AND hospitality_guest.TipoRichiesta = 'Conferma' ";
            $q .= " AND hospitality_guest.Chiuso = 1 ";
        }
    }
    if($_REQUEST['TipoVacanza']!=''){
         $q .= " AND hospitality_guest.TipoVacanza = '".$_REQUEST['TipoVacanza']."' ";
    }
    if($_REQUEST['Nome']!=''){
        $$q .= " AND hospitality_guest.Nome LIKE '%".$_REQUEST['Nome']."%' ";
    }
    if($_REQUEST['Cognome']!=''){
       $q .= " AND hospitality_guest.Cognome LIKE '%".$_REQUEST['Cognome']."%' ";
    }
    if($_REQUEST['FontePrenotazione']!=''){
        $q .= " AND hospitality_guest.FontePrenotazione = '".$_REQUEST['FontePrenotazione']."' ";
    }
    if($_REQUEST['Chiuso']!=''){
        $q .= " AND hospitality_guest.Chiuso = '".$_REQUEST['Chiuso']."' ";
    }
    if($_REQUEST['Disdetta']!=''){
        $q .= " AND hospitality_guest.Disdetta = '".$_REQUEST['Disdetta']."' ";
    }
    if($_REQUEST['CS_inviato']!=''){
        $q .= " AND hospitality_guest.CS_inviato = '".$_REQUEST['CS_inviato']."' ";
    }
    if($_REQUEST['Lingua']!=''){
        $q .= " AND hospitality_guest.Lingua = '".$_REQUEST['Lingua']."' ";
    }
    if($_REQUEST['CheckConsensoPrivacy']!=''){
        $q .= " AND hospitality_guest.CheckConsensoPrivacy = '".$_REQUEST['CheckConsensoPrivacy']."' ";
    }
    if($_REQUEST['CheckConsensoMarketing']!=''){
        $q .= " AND hospitality_guest.CheckConsensoMarketing = '".$_REQUEST['CheckConsensoMarketing']."' ";
    }
    if($_REQUEST['IdMotivazione']!=''){
        $q .= " AND hospitality_guest.IdMotivazione = '".$_REQUEST['IdMotivazione']."' ";
    }
    $q .= " ORDER BY hospitality_guest.DataRichiesta DESC,hospitality_guest.TipoRichiesta ASC,hospitality_guest.Chiuso DESC,hospitality_guest.DataChiuso DESC ";



    $qy = $db->query($q);
    $rec = $db->result($qy);
    $valori = array();

    foreach ($rec as $key => $val) {

    $valori = array($val['TipoRichiesta'],$val['FontePrenotazione'],$val['TipoVacanza'],$val['Lingua'],$val['Nome'],$val['Cognome'],$val['Email'],gira_data($val['DataArrivo']),gira_data($val['DataPartenza']),($val['DataChiuso']!=''?gira_data($val['DataChiuso']):''),($val['Chiuso']==1?'Si':'No'),($val['Disdetta']==1?'Si':'No'),$val['Motivazione'],$val['CS_inviato'],$val['CheckConsensoPrivacy'],$val['CheckConsensoMarketing']);
    fputcsv($output,$valori,';');

    }
    fclose($output);
}
