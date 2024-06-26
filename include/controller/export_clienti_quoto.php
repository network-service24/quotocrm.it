<?php
error_reporting(0);
if($_REQUEST['action']=='export'){
    include($_SERVER['DOCUMENT_ROOT'].'/include/settings.inc.php');
    include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");
    include($_SERVER['DOCUMENT_ROOT'].'/include/function.inc.php');

    function fatturato_conf($id,$idsito){
        global $dbMysqli;
    
        $sel = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                    FROM hospitality_guest
                    INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                    WHERE hospitality_guest.Id = ".$id."
                    AND hospitality_guest.idsito = ".$idsito."
                    AND hospitality_guest.Hidden = 0
                    AND hospitality_guest.Disdetta = 0
                    AND hospitality_guest.NoDisponibilita = 0
                    AND hospitality_guest.TipoRichiesta = 'Conferma'";
        $res = $dbMysqli->query($sel);        
        $rwc = $res[0];
    
            return number_format($rwc['fatturato'],2,',','.');
        
    }
    ini_set("memory_limit", "1024M");

    // output headers so that the file is downloaded rather than displayed
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=export_'.$_REQUEST['idsito'].'_'.date('d-m-Y').'.csv');
    header('Pragma: no-cache');
    error_reporting(0);
    // create a file pointer connected to the output stream
    $output = fopen('php://output', 'w');

    // output the column headings
    fputcsv($output, array('Tipo Richiesta', 'Fonte Prenotazione', 'Target', 'Lingua', 'Nome', 'Cognome', 'Email','Telefono', 'Data Arrivo', 'Data Partenza','Adulti','Bambini', 'Data Prenotazione', 'Prenotazione Confermata', 'Prenotazione Disdetta', 'Motivazione Disdetta', ' P. Annullata', 'Motivazione Annullamento', 'Questionario', 'Consenso Trattamento dati', 'Consenso invio Marketing', 'Fatturato'),';');

    if($_REQUEST['TipoSoggiorno']!='' || $_REQUEST['TipoCamere']!=''){
          $inner = ' INNER JOIN hospitality_richiesta ON hospitality_richiesta.id_richiesta = hospitality_guest.Id ';
          $campo = ', hospitality_richiesta.TipoCamere, hospitality_richiesta.TipoSoggiorno ';
    }
    if($_REQUEST['IdMotivazione']!=''){
        $inner2 = ' INNER JOIN hospitality_tipo_voucher_cancellazione ON hospitality_tipo_voucher_cancellazione.Id = hospitality_guest.IdMotivazione ';
        $campo2 = ', hospitality_tipo_voucher_cancellazione.Motivazione';
    }
    if($_REQUEST['NoDisponibilita']!=''){
        $inner3 = ' INNER JOIN hospitality_motivi_disdetta ON hospitality_motivi_disdetta.IdRichiesta = hospitality_guest.Id';
        $campo3 = ', hospitality_motivi_disdetta.Motivo,hospitality_motivi_disdetta.MotivoCustom';
    }
    $q = "SELECT hospitality_guest.* ".$campo." ".$campo2." ".$campo3." FROM hospitality_guest ".$inner." ".$inner2." ".$inner3." WHERE hospitality_guest.idsito = ".$_REQUEST['idsito']." AND hospitality_guest.hidden = 0 ";

    if($_REQUEST['TipoSoggiorno']!=''){
          $q .= ' AND hospitality_richiesta.TipoSoggiorno = '.$_REQUEST['TipoSoggiorno'].' ';
    }
    if($_REQUEST['TipoCamere']!=''){
          $q .= ' AND hospitality_richiesta.TipoCamere = '.$_REQUEST['TipoCamere'].' ';
    }

    if($_REQUEST['DataScadenza']!=''){
        $q  .= " AND hospitality_guest.DataScadenza >= '".$_REQUEST['DataScadenza']."'";
    }
    if($_REQUEST['DataArrivo']!='' && $_REQUEST['DataPartenza'] ==''){
        $q  .= " AND hospitality_guest.DataArrivo >= '".$_REQUEST['DataArrivo']."'";
    }
    if($_REQUEST['DataArrivo']!='' && $_REQUEST['DataPartenza'] !=''){
        $q  .= " AND hospitality_guest.DataArrivo >= '".$_REQUEST['DataArrivo']."' AND hospitality_guest.DataPartenza <= '".$_REQUEST['DataPartenza']."'";
    }
    if($_REQUEST['DataRichiesta_dal']!='' && $_REQUEST['DataRichiesta_al'] ==''){
        $q  .= " AND hospitality_guest.DataRichiesta >= '".$_REQUEST['DataRichiesta_dal']."'";
    }
    if($_REQUEST['DataRichiesta_dal']!='' && $_REQUEST['DataRichiesta_al'] !=''){
        $q  .= " AND hospitality_guest.DataRichiesta >= '".$_REQUEST['DataRichiesta_dal']."' AND hospitality_guest.DataRichiesta <= '".$_REQUEST['DataRichiesta_al']."'";
    }
    if($_REQUEST['Arrivo_dal']!='' && $_REQUEST['Arrivo_al'] ==''){
        $q  .= " AND hospitality_guest.DataArrivo >= '".$_REQUEST['Arrivo_dal']."'";
    }
    if($_REQUEST['Arrivo_dal']!='' && $_REQUEST['Arrivo_al'] !=''){
        $q  .= " AND hospitality_guest.DataArrivo >= '".$_REQUEST['Arrivo_dal']."' AND hospitality_guest.DataArrivo <= '".$_REQUEST['Arrivo_al']."'";
    }
    if($_REQUEST['DataPrenotazione_dal']!='' && $_REQUEST['DataPrenotazione_al'] ==''){
        $q  .= " AND hospitality_guest.DataArrivo >= '".$_REQUEST['DataPrenotazione_dal']."'";
    }
    if($_REQUEST['DataPrenotazione_dal']!='' && $_REQUEST['DataPrenotazione_al'] !=''){
        $q  .= " AND hospitality_guest.DataChiuso >= '".$_REQUEST['DataPrenotazione_dal']."' AND hospitality_guest.DataChiuso <= '".$_REQUEST['DataPrenotazione_al']."'";
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
    if($_REQUEST['NoDisponibilita']!=''){
        $q .= " AND hospitality_guest.NoDisponibilita = '".$_REQUEST['NoDisponibilita']."' ";
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
    if($_REQUEST['anno']){
		$q .= " AND 
					((YEAR(hospitality_guest.DataRichiesta) = '".$_REQUEST['anno']."') OR (YEAR(hospitality_guest.DataChiuso) = '".$_REQUEST['anno']."'))";
	}
    $q .= " ORDER BY hospitality_guest.DataRichiesta DESC,hospitality_guest.TipoRichiesta ASC,hospitality_guest.Chiuso DESC,hospitality_guest.DataChiuso DESC ";

    $rec = $dbMysqli->query($q);

    $valori = array();
    $fatturato = '';

    foreach ($rec as $key => $val) {

        if($val['TipoRichiesta'] == 'Conferma'){
            $fatturato = fatturato_conf($val['Id'],$val['idsito']);
        }else{
            $fatturato ='';
        }
 

        $valori = array($val['TipoRichiesta'],$val['FontePrenotazione'],$val['TipoVacanza'],$val['Lingua'],$val['Nome'],$val['Cognome'],$val['Email'],$val['Cellulare'],gira_data($val['DataArrivo']),gira_data($val['DataPartenza']),$val['NumeroAdulti'],$val['NumeroBambini'],($val['DataChiuso']!=''?gira_data($val['DataChiuso']):''),($val['Chiuso']==1?'Si':'No'),($val['Disdetta']==1?'Si':'No'),$val['Motivazione'],($val['NoDisponibilita']==1?'Si':'No'),($val['Motivo']!='Altro'?$val['Motivo']:$val['Motivo'].' '.$val['MotivoCustom']),$val['CS_inviato'],$val['CheckConsensoPrivacy'],$val['CheckConsensoMarketing'],$fatturato);
        fputcsv($output,$valori,';');

    }
    fclose($output);
}
