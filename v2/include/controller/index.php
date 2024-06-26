<?php
$giorni2 = mktime (0,0,0,date('m'),(date('d')+2),date('Y'));
$data_giorni2_view = date('d/m/Y',$giorni2);
$giorni1 = mktime (0,0,0,date('m'),(date('d')+1),date('Y'));
$data_giorni1_view = date('d/m/Y',$giorni1);

if($_REQUEST['querydate']=='' && $_REQUEST['action']==''){

	$prima_data   = date('Y').'-01-01';
	$seconda_data = date('Y').'-12-31';
	$filter_query = " AND DataRichiesta >= '".$prima_data."' AND DataRichiesta <= '".$seconda_data."' ";

	$prima_data_p   = date('Y').'-01-01';
	$seconda_data_p = date('Y').'-12-31';
	$filter_query_p = " AND DataArrivo >= '".$prima_data_p."' AND DataPartenza <= '".$seconda_data_p."' ";

}elseif($_REQUEST['querydate']!='' && $_REQUEST['action']!='check_date' && $_REQUEST['aciton']!='request_date'){

	$prima_data   = $_REQUEST['querydate'].'-01-01';
	$seconda_data = $_REQUEST['querydate'].'-12-31';
	$filter_query = " AND DataRichiesta >= '".$prima_data."' AND DataRichiesta <= '".$seconda_data."' ";

	$prima_data_p   = $_REQUEST['querydate'].'-01-01';
	$seconda_data_p = $_REQUEST['querydate'].'-12-31';
	$filter_query_p = " AND DataArrivo >= '".$prima_data_p."' AND DataPartenza <= '".$seconda_data_p."' ";
}
if($_REQUEST['action']=='request_date'){

	$DataRichiesta_dal_tmp = explode("/",$_REQUEST['DataRichiesta_dal']);
	$DataRichiesta_dal = $DataRichiesta_dal_tmp[2].'-'.$DataRichiesta_dal_tmp[1].'-'.$DataRichiesta_dal_tmp[0].' 00:00:00';
	$DataRichiesta_al_tmp = explode("/",$_REQUEST['DataRichiesta_al']);
	$DataRichiesta_al = $DataRichiesta_al_tmp[2].'-'.$DataRichiesta_al_tmp[1].'-'.$DataRichiesta_al_tmp[0].' 23:59:59';

	$filter_query = " AND DataChiuso >= '".$DataRichiesta_dal."' AND DataChiuso <= '".$DataRichiesta_al."'";
}
if($_REQUEST['action']=='request_date_p'){

	$DataPrenotazione_dal_tmp = explode("/",$_REQUEST['DataPrenotazione_dal_preno']);
	$DataPrenotazione_dal = $DataPrenotazione_dal_tmp[2].'-'.$DataPrenotazione_dal_tmp[1].'-'.$DataPrenotazione_dal_tmp[0];
	$DataPrenotazione_al_tmp = explode("/",$_REQUEST['DataPrenotazione_al_preno']);
	$DataPrenotazione_al = $DataPrenotazione_al_tmp[2].'-'.$DataPrenotazione_al_tmp[1].'-'.$DataPrenotazione_al_tmp[0];
	$filter_query_p = " AND DataArrivo >= '".$DataPrenotazione_dal."' AND DataPartenza <= '".$DataPrenotazione_al."'";
}

if($_REQUEST['date']!= ''){
	$date_tmp         = explode("-",$_REQUEST['date']);
	$data_1_tmp       = trim($date_tmp[0]);
	$data_2_tmp       = trim($date_tmp[1]);
	$prima_data_tmp   = explode("/",$data_1_tmp);
	$seconda_data_tmp = explode("/",$data_2_tmp);
	$prima_data       = $prima_data_tmp[2].'-'.$prima_data_tmp[1].'-'.$prima_data_tmp[0];
	$primo_anno       = $prima_data_tmp[2];
	$seconda_data     = $seconda_data_tmp[2].'-'.$seconda_data_tmp[1].'-'.$seconda_data_tmp[0];
	$secondo_anno     = $seconda_data_tmp[2];
	$prima_data_it    = $prima_data_tmp[0].'-'.$prima_data_tmp[1].'-'.$prima_data_tmp[2];
	$seconda_data_it  = $seconda_data_tmp[0].'-'.$seconda_data_tmp[1].'-'.$seconda_data_tmp[2];
	$prima_data_p     = $prima_data_tmp[2].'-'.$prima_data_tmp[1].'-'.$prima_data_tmp[0].'';
	$seconda_data_p   =  $seconda_data_tmp[2].'-'.$seconda_data_tmp[1].'-'.$seconda_data_tmp[0].'';
}

$diff_anni = (date('Y')-ANNO_ATTIVAZIONE);
$anniprima = (date('Y')-$diff_anni);
	for($i=$anniprima; $i<=date('Y'); $i++){
		$lista_anni .='<option value="'.$i.'" '.(($_REQUEST['querydate']=='' || $i==$_REQUEST['querydate'])?'selected="selected"':'').'>'.$i.'</option>';
	}


$mese = 1;
//for($mese==1; $mese<=12; $mese++){
//
//	$select = "SELECT COUNT(Id) as tot_prev FROM hospitality_guest  WHERE MONTH(DataRichiesta) = '".$mese."'  AND TipoRichiesta = 'Preventivo' AND idsito = ".IDSITO;
//	$res = $db->query($select);
//	$rws = $db->row($res);
//	$tot_prev = $rws['tot_prev'];
//	$array_data_prev[]	= $tot_prev;
//
//	$select2 = "SELECT COUNT(Id) as tot_conf FROM hospitality_guest  WHERE (MONTH(DataRichiesta) = '".$mese."' OR MONTH(DataChiuso) = '".$mese."') AND TipoRichiesta = 'Conferma'  AND idsito = ".IDSITO;
//	$res2 = $db->query($select2);
//	$rws2 = $db->row($res2);
//	$tot_conf = $rws2['tot_conf'];
//	$array_data_conf[]	= $tot_conf;
//
//	$select3 = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
//                            FROM hospitality_guest
//                            INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
//							WHERE 1 = 1";
//
//	if($_REQUEST['action']=="request_date"){
//				$select3 .= "  AND (MONTH(DataRichiesta) = '".$mese."' OR MONTH(DataChiuso) = '".$mese."') ";
//				//$select3 .= $filter_query;
//	}else{
//				$select3 .= "  AND (MONTH(hospitality_guest.DataArrivo) = '".$mese."' OR MONTH(hospitality_guest.DataPartenza) = '".$mese."')";
//				$select3 .= $filter_query_p;
//	}
//
//	$select3 .= "           AND hospitality_guest.idsito = ".IDSITO."
//                            AND hospitality_guest.Disdetta = 0
//							AND hospitality_guest.Hidden = 0
//							AND hospitality_guest.TipoRichiesta = 'Conferma' ";
//  	$res3 = $db->query($select3);
//	$rws3 = $db->row($res3);
//	$fatturato = $rws3['fatturato'];
//	if($fatturato == '')$fatturato = 0;
//	$array_fatturato[]	= $fatturato;
//
//
//
//
//}



// Per ogni mese dell'anno corrente
for ($mese = 1; $mese <= 12; $mese++) {
	if($_REQUEST['querydate']){
		// Calcola il primo e l'ultimo giorno del mese
		$firstDayOfMonth = date('Y-m-01', strtotime($_REQUEST['querydate'] . '-' . $mese));
		$lastDayOfMonth = date('Y-m-t', strtotime($_REQUEST['querydate'] . '-' . $mese));
	}else{
		// Calcola il primo e l'ultimo giorno del mese
		$firstDayOfMonth = date('Y-m-01', strtotime(date('Y') . '-' . $mese));
		$lastDayOfMonth = date('Y-m-t', strtotime(date('Y') . '-' . $mese));
	}

    // Query SQL per contare le richieste di tipo 'Preventivo' per il mese
    $select = "SELECT COUNT(Id) as tot_prev FROM hospitality_guest 
               WHERE DataRichiesta >= '$firstDayOfMonth' AND DataRichiesta <= '$lastDayOfMonth'
               AND TipoRichiesta = 'Preventivo' AND idsito = ".IDSITO;
    $res = $db->query($select);
    $rws = $db->row($res);
    $tot_prev = $rws['tot_prev'];
    $array_data_prev[] = $tot_prev;

    // Query SQL per il tipo 'Conferma' gestendo sia DataRichiesta che DataChiuso
    $select2 = "SELECT COUNT(Id) as tot_conf FROM hospitality_guest
                WHERE (DataRichiesta >= '$firstDayOfMonth' AND DataRichiesta <= '$lastDayOfMonth'
                OR DataChiuso >= '$firstDayOfMonth' AND DataChiuso <= '$lastDayOfMonth')
                AND TipoRichiesta = 'Conferma' AND idsito = ".IDSITO;
    $res2 = $db->query($select2);
    $rws2 = $db->row($res2);
    $tot_conf = $rws2['tot_conf'];
    $array_data_conf[] = $tot_conf;

    // Adatta analogamente la query del fatturato
    $select3 = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                FROM hospitality_guest
                INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                WHERE (DataRichiesta >= '$firstDayOfMonth' AND DataRichiesta <= '$lastDayOfMonth'
                OR DataChiuso >= '$firstDayOfMonth' AND DataChiuso <= '$lastDayOfMonth')
                AND idsito = ".IDSITO."
                AND Disdetta = 0 AND Hidden = 0 AND TipoRichiesta = 'Conferma'";
    $res3 = $db->query($select3);
    $rws3 = $db->row($res3);
    $fatturato = $rws3['fatturato'] ?? 0;
    $array_fatturato[] = $fatturato;
}


if(is_array($array_data_prev)){
	$data_prev = implode(',',$array_data_prev);
}
if(is_array($array_data_conf)){
	$data_conf = implode(',',$array_data_conf);
}
if(is_array($array_fatturato)){
	$data_fatt = implode(',',$array_fatturato);
}





$data_arr_tmp = explode('/',$_REQUEST['date_arr']);
$data_arr = $data_arr_tmp[2].'-'.$data_arr_tmp[1].'-'.$data_arr_tmp[0];
$date_fl_tmp = explode('/',$_REQUEST['date_fl']);
$date_fl = $date_fl_tmp[2].'-'.$date_fl_tmp[1].'-'.$date_fl_tmp[0];

// Query per filtrare ed estrapolare gli arrivi per il checkin in hotel, filtro per OGGI, DOMANI, e filtro DATA
$sel = "SELECT hospitality_guest.*,hospitality_checkin.Prenotazione as SiCheckin FROM hospitality_guest
        LEFT OUTER JOIN hospitality_checkin ON (hospitality_checkin.Prenotazione = hospitality_guest.NumeroPrenotazione AND hospitality_checkin.idsito = hospitality_guest.idsito)
		WHERE hospitality_guest.DataArrivo = '".($_REQUEST['date_fl']==''?($_REQUEST['date_arr']==''?date('Y-m-d'):$data_arr):$date_fl)."'
		AND hospitality_guest.TipoRichiesta = 'Conferma'
		AND hospitality_guest.Chiuso = 1
		AND hospitality_guest.Disdetta = 0
		AND hospitality_guest.Archivia = 0
		AND hospitality_guest.idsito = ".IDSITO." GROUP BY hospitality_guest.NumeroPrenotazione";
$res = $db->query($sel);
$rec = $db->result($res);
if(sizeof($rec)>0){

	if($_REQUEST['date_fl']){
		$data_fl_tmp     = explode("/",$_REQUEST['date_fl']);
		$data_fl_estesa_ = date('D, d M Y',mktime(0,0,0,$data_fl_tmp[1],$data_fl_tmp[0],$data_fl_tmp[2]));
		$dt_tmp          = explode(",",$data_fl_estesa_);
		$dt_tmp_         = explode(" ",$dt_tmp[1]);
		$data_fl_estesa  = $array_giorni[$dt_tmp[0]].', '.$dt_tmp_[1].' '.$array_mesi[$dt_tmp_[2]].' '.$dt_tmp_[3];
	}
	if($_REQUEST['date_arr']){
		$data_d_tmp            = explode("/",$_REQUEST['date_arr']);
		$data_dinamica_estesa_ = date('D, d M Y',mktime(0,0,0,$data_d_tmp[1],$data_d_tmp[0],$data_d_tmp[2]));
		$dt_d_tmp              = explode(",",$data_dinamica_estesa_);
		$dt_d_tmp_             = explode(" ",$dt_d_tmp[1]);
		$data_dinamica_estesa  = $array_giorni[$dt_d_tmp[0]].', '.$dt_d_tmp_[1].' '.$array_mesi[$dt_d_tmp_[2]].' '.$dt_d_tmp_[3];
	}
	$arrivi_eichetta = ($_REQUEST['ggg']!='dinamica'?($_REQUEST['ggg']==''?'oggi':$data_dinamica_estesa):$data_fl_estesa);

	$arrivi .=' <table class="table table-striped">
				<tr>
		          <th><small>Nr.</small></th>
		          <th><small>Tipo</small></th>
		          <th><small>Lingua</small></th>
		          <th><small>Cliente</small></th>
		          <th><small>Persone</small></th>
		          <th><small>Arrivo</small></th>
		          <th><small>Partenza</small></th>
		          <th class="text-center"><small>Soggiorno</small></th>
		          <th class="text-center"><small>Email</small></th>
		          <th class="text-center"><small>CheckIn</small></th>
		      </tr>';
	foreach ($rec as $k => $val) {
		$data_a_tmp = explode("-",$val['DataArrivo']);
		$data_arrivo = $data_a_tmp[2].'-'.$data_a_tmp[1].'-'.$data_a_tmp[0];
		$data_p_tmp = explode("-",$val['DataPartenza']);
		$data_partenza = $data_p_tmp[2].'-'.$data_p_tmp[1].'-'.$data_p_tmp[0];
		$arrivi .='<tr>
		                  <td><small>'.($val['CheckinOnlineClient']==1?$val['Prefisso'].' ':'').''.$val['NumeroPrenotazione'].'</small></td>
		                  <td><small>'.$val['TipoVacanza'].'</small></td>
		                  <td><img src="'.BASE_URL_SITO.'img/flags/mini/'.$val['Lingua'].'.png"></td>
		                  <td><small>'.stripslashes($val['Nome']).' '.stripslashes($val['Cognome']).'</small></td>
		                  <td><small><b>A.</b>'.$val['NumeroAdulti'].' '.($val['NumeroBambini']!='0'?'<b>B.</b>'.$val['NumeroBambini']:'').'</small></td>
		                  <td><small>'.$data_arrivo.'</small></td>
		                  <td><small>'.$data_partenza.'</small></td>
		                  <td class="text-center">'.($val['CheckinOnlineClient']==0?'<a href="#" data-toggle="modal" data-target="#myModal'.$val['Id'].'" title="Visualizza il soggiorno"><i class="glyphicon glyphicon-comment"></i></a>':'<small>'.$val['FontePrenotazione'].'</small>').'</td>
		                  <td class="text-center"><a href="mailto:'.$val['Email'].'?subject=Rif.Prenotazione Numero '.($val['CheckinOnlineClient']==1?$val['Prefisso'].' '.$val['NumeroPrenotazione']:$val['NumeroPrenotazione']).'" title="'.$val['Email'].'"><i class="fa fa-envelope"></i></a></td>
		                  <td class="text-center"><small><small>'.($val['SiCheckin']!=''?'Compilato':'Non compilato').'</small></small></td>
		              </tr>';

		$arrivi .='<div class="modal fade" id="myModal'.$val['Id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">In Arrivo ...</h4>
				      </div>
				      <div class="modal-body">
				        '.conferma_in_arrivo($val['Id']).'
				      </div>
				    </div>
				  </div>
				</div>';


	}
	$arrivi .= '</table>';
}else{
	if($_REQUEST['date_fl']){
		$data_fl_tmp     = explode("/",$_REQUEST['date_fl']);
		$data_fl_estesa_ = date('D, d M Y',mktime(0,0,0,$data_fl_tmp[1],$data_fl_tmp[0],$data_fl_tmp[2]));
		$dt_tmp          = explode(",",$data_fl_estesa_);
		$dt_tmp_         = explode(" ",$dt_tmp[1]);
		$data_fl_estesa  = $array_giorni[$dt_tmp[0]].', '.$dt_tmp_[1].' '.$array_mesi[$dt_tmp_[2]].' '.$dt_tmp_[3];
	}
	if($_REQUEST['date_arr']){
		$data_d_tmp            = explode("/",$_REQUEST['date_arr']);
		$data_dinamica_estesa_ = date('D, d M Y',mktime(0,0,0,$data_d_tmp[1],$data_d_tmp[0],$data_d_tmp[2]));
		$dt_d_tmp              = explode(",",$data_dinamica_estesa_);
		$dt_d_tmp_             = explode(" ",$dt_d_tmp[1]);
		$data_dinamica_estesa  = $array_giorni[$dt_d_tmp[0]].', '.$dt_d_tmp_[1].' '.$array_mesi[$dt_d_tmp_[2]].' '.$dt_d_tmp_[3];
	}
	$arrivi          ='<h3 class="text-center">Non ci sono arrivi '.($_REQUEST['ggg']!='dinamica'?($_REQUEST['ggg']==''?'oggi':$data_dinamica_estesa):$data_fl_estesa).'!</h3>';
}


// Query per filtrare ele operazioni effettuate dagli operatori di QUOTO
$select = "SELECT * FROM hospitality_operatori WHERE idsito = ".IDSITO." AND Abilitato = 1";
$r      = $db->query($select);
$re     = $db->result($r);

$op .=' <table class="table table-striped">
			<tr>
			  <th></th>
	          <th></th>
	          <th><small>Preventivi Inviati</small></th>
	          <th><small>Accettati</small></th>
	          <th><small>Conferme ...<small>(da inviare)</small></small></th>
	          <th><small>Preno Chiuse</small></th>
	          <th><small>Disdette</small></th>
	          <th><small>Archiviate</small></th>
	      </tr>';


$sele            = '';
$seleC           = '';
$selex           = '';
$seleCl          = '';
$seleA           = '';
$n_accettate     = '';
$n_inviate       = '';
$n_conf          = '';
$n_prenotazioni  = '';
$operatore       = '';
$email_operatore = '';

foreach ($re as $c => $vl) {

	$operatore       = trim(addslashes($vl['NomeOperatore']));
	$email_operatore = trim($vl['EmailSegretaria']);
    if($vl['img']!=''){
        $img = '<img src="'.BASE_URL_ROOT.'uploads/'.IDSITO.'/'.$vl['img'].'" class="img-circle" data-toogle="tooltip" title="Operatore: '.$operatore.'" style="width:18px;height:18px">';
    }else{
         $img = '<i class="fa fa-user" data-toogle="tooltip" title="Operatore: '.$operatore.'"></i>';
    }

		// PREVENTIVI ACCETTATI
		$sele   = "SELECT COUNT(Id) as n_accettate FROM hospitality_guest WHERE TipoRichiesta = 'Preventivo' AND ChiPrenota = '".$operatore."'  AND idsito = ".IDSITO." AND Archivia = 0 AND Accettato = 1 ".$filter_query."";
		$ris    = $db->query($sele);
		$record = $db->row($ris);

		$n_accettate = $record['n_accettate'];


		//PREVENTIVI INVIATI
		$selex   = "SELECT COUNT(Id) as n_inviate FROM hospitality_guest WHERE TipoRichiesta = 'Preventivo' AND ChiPrenota = '".$operatore."'  AND idsito = ".IDSITO." AND Archivia = 0 AND Inviata = 1 AND DataInvio IS NOT NULL ".$filter_query."";
		$risx    = $db->query($selex);
		$recordx = $db->row($risx);

		$n_inviate = $recordx['n_inviate'];


		//CONFERME IN ATTESA
		$seleC   = "SELECT COUNT(Id) as n_conf FROM hospitality_guest WHERE TipoRichiesta = 'Conferma' AND ChiPrenota = '".$operatore."'  AND idsito = ".IDSITO." AND Archivia = 0 AND Chiuso = 0 AND DataInvio IS  NULL ".$filter_query."";
		$risC    = $db->query($seleC);
		$recordC = $db->row($risC);

		$n_conf = $recordC['n_conf'];


		//PRENO CHIUSEA
		$seleCl   = "SELECT COUNT(Id) as n_prenotazioni FROM hospitality_guest WHERE TipoRichiesta = 'Conferma' AND ChiPrenota = '".$operatore."'  AND idsito = ".IDSITO." AND Disdetta = 0 AND Archivia = 0 AND Chiuso = 1 AND DataChiuso IS NOT NULL ".$filter_query."";
		$risCl    = $db->query($seleCl);
		$recordCl = $db->row($risCl);

		$n_prenotazioni = $recordCl['n_prenotazioni'];

		//PRENO DISDETTE
		$seleD   = "SELECT COUNT(Id) as n_disdette FROM hospitality_guest WHERE TipoRichiesta = 'Conferma' AND ChiPrenota = '".$operatore."'  AND idsito = ".IDSITO." AND Disdetta = 1 AND Archivia = 0 AND Chiuso = 1 AND DataChiuso IS NOT NULL ".$filter_query."";
		$risD    = $db->query($seleD);
		$recordD = $db->row($risD);

		$n_disdette = $recordD['n_disdette'];

		//PRENO ARCHIVIATE
		$seleA   = "SELECT COUNT(Id) as tot_preno_archiv FROM hospitality_guest  WHERE TipoRichiesta = 'Conferma' AND ChiPrenota = '".$operatore."'  AND idsito = ".IDSITO."  AND Archivia = 1 AND Chiuso = 1 AND DataChiuso IS NOT NULL ".$filter_query."";
		$risA    = $db->query($seleA);
		$recordA = $db->row($risA);

		$n_archiviate = $recordA['tot_preno_archiv'];


		$op .='<tr>
				  <td class="text-center">'.$img.'</td>
	              <td><b style="white-space: nowrap;">'.(strlen($operatore)<=11?$operatore:substr($operatore,0,11).'...').'</b></td>
	              <td class="text-center" style="white-space: nowrap;"><div class="cerchio">'.$n_inviate.'</div>&nbsp;&nbsp;<i class="fa fa-envelope text-green"></i></td>
	              <td class="text-center" style="white-space: nowrap;"><div class="cerchio">'.$n_accettate.'</div>&nbsp;&nbsp;<i class="fa fa-check text-blue"></i></td>
	              <td class="text-center" style="white-space: nowrap;"><div class="cerchio">'.$n_conf.'</div>&nbsp;&nbsp;<i class="fa fa-bed text-yellow"></i></td>
	              <td class="text-center" style="white-space: nowrap;"><div class="cerchio">'.$n_prenotazioni.'</div>&nbsp;&nbsp;<i class="fa fa-h-square text-aqua"></i></td>
	              <td class="text-center" style="white-space: nowrap;"><div class="cerchio">'.$n_disdette.'</div>&nbsp;&nbsp;<i class="fa fa-minus-circle text-red"></i></td>
	              <td class="text-center" style="white-space: nowrap;"><div class="cerchio">'.$n_archiviate.'</div>&nbsp;&nbsp;<i class="fa fa-font text-purple"></i></td>
		        </tr>';


}

$op .= '</table>';

if(CHECKINONLINE != 1){
	####MODALE PER COMUNICAZIONI A TUTTI GLI UTENTI QUOTO######
	$db_suiteweb->query('SELECT * FROM comunicazioni WHERE DataInizio <= "'.date('Y-m-d').'" AND DataFine > "'.date('Y-m-d').'" AND Abilitato = 1 ORDER BY Id DESC LIMIT 1');
	$recSW = $db_suiteweb->row();
	if($recSW){
		$script_modale = '<script type="text/javascript">
							if(leggiCookie(\'primo_ingresso\')==""){
								$(window).load(function(){
									$(\'#comunicazioni\').modal(\'show\');
								});
							}
								scriviCookie(\'primo_ingresso\',\'modal\');
						</script>';

		$modale ='<div class="modal fade" id="comunicazioni" tabindex="-1" role="dialog" aria-labelledby="comunicazioni">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<a class="close" data-dismiss="modal">×</a>
								<h4 class="modal-title" id="comunicazioni"><b>'.$recSW['Titolo'].'</b></h4>
							</div>
							<div class="modal-body">
								<small>La comunicazione rimarrà attiva e visibile fino al '.gira_data($recSW['DataFine']).'</small>
								<div style="clear:both;height:8px"></div>
								'.$recSW['Testo'].'
							</div>
						</div>
					</div>
				</div>';
	}
}
$check=check_setup();
if($check!= 0){
	###################################################################
	if(tot_invii()!=0 && tot_preventivi()!=0){
		$PercentualePrevInviati          = ceil((100*tot_invii())/tot_preventivi());
	}
	if(tot_conferme()!=0 && tot_invii()!=0){
		$PercentualeConferme             = ceil(100*tot_conferme()/tot_invii());
	}
	if(tot_prenotazioni()!=0 && tot_invii()!=0){
		$PercentualePrenotazioni         = ceil(100*tot_prenotazioni()/tot_invii());
	}
	if(tot_disdetta()!=0 && tot_prenotazioni()!=0){
		$PercentualePrenotazioniDisdette = ceil(number_format(((100*tot_fatturato_disdette())/tot_fatturato()),2));
	}
	if(tot_annullate()!=0 && tot_conferme()!=0 && tot_fatturato_annullate(1) != 0 && tot_fatturato(1) != 0){
		$PercentualeAnnullate = number_format((((tot_fatturato_annullate(1)/tot_fatturato(1))*100)),2,',','.');
	}
	if(tot_invii()!=0 && tot_prenotazioni()!=0){
		$TassoConversione  = tot_conversioni(tot_invii(),(tot_prenotazioni()+tot_preno_archiviate()));
	}
	###################################################################
}

$p_data = $_REQUEST['p_data'];
$s_data = $_REQUEST['s_data'];
$date   = $_REQUEST['date'];
$data_tmp = explode("-", trim($date));
$dataChiusoDa_ = explode("/",trim($data_tmp[0]));
$dataChiusoA_ = explode("/",trim($data_tmp[1]));
$dataChiusoDa = $dataChiusoDa_[2].'-'.$dataChiusoDa_[0].'-'.$dataChiusoDa_[1].' 00:00:00';
$dataChiusoA = $dataChiusoA_[2].'-'.$dataChiusoA_[0].'-'.$dataChiusoA_[1].' 23:59:59';
$p_anno = $dataChiusoDa_[2];
$s_anno = $dataChiusoA_[2];


function tot_fatturatoC($idsito){
	global $db,$date,$dataChiusoDa,$dataChiusoA;
  
  
	$query = 'SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
				FROM hospitality_guest
				INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
				WHERE 1=1
				AND hospitality_guest.idsito = '.$idsito.'
				AND hospitality_guest.Chiuso = 1
				AND hospitality_guest.Hidden = 0
				AND hospitality_guest.NoDisponibilita = 0
				AND hospitality_guest.Disdetta = 0
				AND hospitality_guest.TipoRichiesta = "Conferma"
				AND '.($date==''?' (hospitality_guest.DataChiuso >= "'.date('Y').'-01-01 00:00:00" AND hospitality_guest.DataChiuso <= "'.date('Y').'-12-31 23:59:59")':' (hospitality_guest.DataChiuso >= "'.$dataChiusoDa.'" AND hospitality_guest.DataChiuso <= "'.$dataChiusoA.'")').'';
	$result = $db->query($query);
	$rwc    = $db->row($result);
  
		if(is_array($rwc)) {
		  if($rwc > count($rwc)) // se la pagina richiesta non esiste
			  $tot = count($rwc); // restituire la pagina con il numero più alto che esista
		  }else{
			  $tot = 0;
	  }
	  if($tot > 0){
		  return $rwc['fatturato'];
	  }  
  
  }
  
  
  function prenotazioni_per_camera($idsito){
	  global $db,$date,$s_anno,$p_anno,$dataChiusoDa,$dataChiusoA;
  
	  $sel = "SELECT hospitality_tipo_camere.Id as IdCamera, hospitality_tipo_camere.TipoCamere as Camera
			  FROM hospitality_tipo_camere 
			  WHERE hospitality_tipo_camere.idsito = ".$idsito." 
			  AND hospitality_tipo_camere.Abilitato = 1 
			  ORDER BY TipoCamere ASC";
	  $r   = $db->query($sel);
	  $array_record = $db->result($r);
  
	  if(sizeof($array_record)>0){
  
		  $op .=' <table class="xcrud-list table table-striped table-hover table-bordered">
					  <tr>
						  <th class="text-left col-md-3 nowrap"><small>Camere</small></th>
						  <th class="text-center col-md-1 nowrap"><small>Nr.Camere</small></th>
						  <th class="text-right col-md-2 nowrap"><small>Fatturato</small></th>
						  <th class="text-center col-md-1 nowrap"><small>%</small></th>
				  </tr>';
  
		  $percentuale           = '';
		  $totale_camere_vendute = '';
		  $ADR                   = '';
		  $totale_cd             = '';
		  $totale                = '';
		  $rec                   = '';
		  $rec2                  = '';
		  $DataApertura          = '';
		  $DataChiusura          = '';
		  $giorni_totali         = '';
		  $tariffa_media         = '';
		  $datediff              = '';
  
		  if($date == ''){
			  $anno = ' AND YEAR(DataChiuso) >= "'.date('Y').'" AND YEAR(DataChiuso) <= "'.date('Y').'" ';
		  }else{
			  $anno = ' AND YEAR(DataChiuso) >= "'.$p_anno.'" AND YEAR(DataChiuso) <= "'.$s_anno.'" ';
		  }
  
		  $c = 0;
		  foreach ($array_record as $key => $vl) {
  
			  $select3 ='SELECT hospitality_guest.DataArrivo as data_apertura
						  FROM hospitality_guest
						  WHERE 1=1
							'.$anno.'
						  AND hospitality_guest.idsito = '.$idsito.'
						  AND hospitality_guest.Chiuso = 1
						  AND hospitality_guest.Disdetta = 0
						  AND hospitality_guest.NoDisponibilita = 0
						  AND hospitality_guest.TipoRichiesta = "Conferma"
						  ORDER BY DataArrivo ASC LIMIT 1';
			  $res3  = $db->query($select3);
			  $rec3 = $db->row($res3);
			  $DataApertura = strtotime($rec3['data_apertura']);
  
			  $select4 ='SELECT hospitality_guest.DataPartenza as data_chiusura
						  FROM hospitality_guest
						  WHERE 1=1
						  '.$anno.'
						  AND hospitality_guest.idsito = '.$idsito.'
						  AND hospitality_guest.Chiuso = 1
						  AND hospitality_guest.Disdetta = 0
						  AND hospitality_guest.NoDisponibilita = 0
						  AND hospitality_guest.TipoRichiesta = "Conferma"
						  ORDER BY DataPartenza DESC LIMIT 1';
			  $res4  = $db->query($select4);
			  $rec4 = $db->row($res4);
			  $DataChiusura = strtotime($rec4['data_chiusura']);
  
			  $datediff = ($DataChiusura - $DataApertura);
			  $giorni_totali = round($datediff / (60 * 60 * 24));

  
			  $select ='SELECT SUM(hospitality_richiesta.Prezzo) as fatturato, COUNT(hospitality_richiesta.TipoCamere) as nCamere
						  FROM hospitality_guest
						  INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
						  INNER JOIN hospitality_richiesta ON hospitality_richiesta.id_richiesta = hospitality_guest.Id
						  WHERE 1=1
						  AND hospitality_richiesta.TipoCamere = '.$vl['IdCamera'].'
						  AND hospitality_guest.idsito = '.$idsito.'
						  AND hospitality_guest.Chiuso = 1
						  AND hospitality_guest.Disdetta = 0
						  AND hospitality_guest.NoDisponibilita = 0
						  AND '.($date == ''?' hospitality_guest.DataChiuso >= "'.date('Y').'-01-01" AND hospitality_guest.DataChiuso <= "'.date('Y').'-12-31"': ' hospitality_guest.DataChiuso >= "'.$dataChiusoDa.'" AND hospitality_guest.DataChiuso <= "'.$dataChiusoA.'"').'
						  AND hospitality_guest.TipoRichiesta = "Conferma" ';
			  $res  = $db->query($select);
			  $rec  = $db->row($res);
  
			  $select2 ='SELECT COUNT(hospitality_richiesta.TipoCamere) as TotCamere
						  FROM hospitality_guest
						  INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
						  INNER JOIN hospitality_richiesta ON hospitality_richiesta.id_richiesta = hospitality_guest.Id
						  WHERE 1=1
						  AND hospitality_guest.idsito = '.$idsito.'
						  AND hospitality_guest.Chiuso = 1
						  AND hospitality_guest.Disdetta = 0
						  AND hospitality_guest.NoDisponibilita = 0
						  AND '.($date == ''?' hospitality_guest.DataChiuso >= "'.date('Y').'-01-01" AND hospitality_guest.DataChiuso <= "'.date('Y').'-12-31"': ' hospitality_guest.DataChiuso >= "'.$dataChiusoDa.'" AND hospitality_guest.DataChiuso <= "'.$dataChiusoA.'"').'
						  AND hospitality_guest.TipoRichiesta = "Conferma" ';
			  $res2  = $db->query($select2);
			  $rec2  = $db->row($res2);
  
			  if($rec2['TotCamere']>0){
				  $totale_camere_vendute = $rec2['TotCamere'];
  
				  $percentuale = ((100*$rec['nCamere'])/$totale_camere_vendute);
				  $percentuale =  number_format($percentuale,2,',','.');
				  $percentuale = str_replace(",00", "",$percentuale).' %';
				  if(tot_fatturatoC(IDSITO)>0 && $rec['nCamere']>0){
					  $ADR = (tot_fatturatoC(IDSITO)/$rec['nCamere']);
				  }else{
					  $ADR = 0;
				  }
			  }else{
				  $percentuale = 0;
				  $ADR = 0;
			  }
			  switch($c){
				  case 0:
					  $color = '';
					  $ico   = 'fa fa-bed text-red';
				  break;
				  case 1:
					  $color = '';
					  $ico   = 'fa fa-bed text-green';
				  break;
				  case 2:
					  $color = '';
					  $ico   = 'fa fa-bed text-lime';
				  break;
				  case 3:
					  $color = '';
					  $ico   = 'fa fa-bed text-teal';
				  break;
				  case 4:
					  $color = '';
					  $ico   = 'fa fa-bed text-maroon';
				  break;
				  case 5:
					  $color = '';
					  $ico   = 'fa fa-bed text-blue';
				  break;
				  default:
					  $color =  'style="color:'.colorGen().'"';
					  $ico   = 'fa fa-bed';
				  break;
			  }
  
			  if($rec['nCamere']!= 0){
				$tariffa_media = ($rec['fatturato']/$giorni_totali/$rec['nCamere']);				
			  }else{
				$tariffa_media = 0;
			  }
  
			  $op .='<tr>
						  <td class="text-left nowrap"><small><i class="'.$ico.'" '.$color.'></i> &nbsp; '.$vl['Camera'].'</small></td>
						  <td class="text-center nowrap"><small>'.$rec['nCamere'].'</small></td>
						  <td class="text-right nowrap"><small>'.($rec['fatturato']>0?number_format($rec['fatturato'],2,',','.'):'0,00').' <i class="fa fa-euro"></i></small></td>
						  <td class="text-center nowrap"><small>'.$percentuale.'</small></td>
					  </tr>';
  
			$c++;
		  }
  
		  $op .= '</table>';
  
		  return $op;
	  }else{
		  return 'Nessun risultato!';
	  }
  
  }

$js = ' <script>
					$(document).ready(function(){

							checkScreenDimensionIndex();

									$.fn.datepicker.defaults.format = "dd/mm/yyyy";
											$( "#DataRichiesta_dal" ).datepicker({
														numberOfMonths: 1,
														language:"it",
														showButtonPanel: true
											});
											$( "#DataRichiesta_al" ).datepicker({
													numberOfMonths: 1,
													language:"it",
													showButtonPanel: true
											});
											$( "#DataPrenotazione_dal_preno_f" ).datepicker({
												numberOfMonths: 1,
												language:"it",
												showButtonPanel: true
											});
											$( "#DataPrenotazione_al_preno_f" ).datepicker({
												numberOfMonths: 1,
												language:"it",
												showButtonPanel: true
											});

					});
					$(document).load($(window).bind("resize", checkScreenDimensionIndex));
				</script>'."\r\n";

$js_chat = '
<script>
	function print_chat_notify(){
		$("#load_chat_notify_pre").html(\'<img src="'.BASE_URL_SITO.'img/loader_performance.gif" style="width:180px;height:auto" /><br />QUOTO sta caricando le <b>chat in attesa di risposta</b>, attendere...!\');

		$("#load_chat_notify").load("'.BASE_URL_SITO.'ajax/load_chat_notify.php?idsito='.IDSITO.'", function() {
			$("#load_chat_notify_pre").hide();
		});
	}
	$(document).ready(function() {	
		print_chat_notify();
	});
</script>'."\r\n";

$js_modifica = '
<script>
	function print_check_modifica(){
		$("#load_check_modifica_pre").html(\'<img src="'.BASE_URL_SITO.'img/loader_performance.gif" style="width:180px;height:auto" /><br />QUOTO sta caricando le <b>proposte in fase di modifica</b>, attendere...!\');

		$("#load_check_modifica").load("'.BASE_URL_SITO.'ajax/load_check_modifica.php?idsito='.IDSITO.'", function() {
			$("#load_check_modifica_pre").hide();
		});
	}
	$(document).ready(function() {	
		print_check_modifica();
	});
</script>'."\r\n";

$js_eq = '
<script>
	/**
	* !ON LOAD EQUALIZZA
	*/
	$(document).ready(function() {
		var highestBox = 400;
		var heigthRow = $("#infobox1").height();
		var new_height = (heigthRow - 20);
		if(highestBox > heigthRow){
			$("#performance_room").attr("style", "height:"+new_height+"px;overflow-y:auto;overflow-x:auto;");
			$("#performance_room").addClass("scroll");
			$("#chat_pending").attr("style", "height:"+new_height+"px;overflow-y:auto;overflow-x:auto;");
			$("#chat_pending").addClass("scroll");
			$("#proposte_block").attr("style", "height:"+new_height+"px;overflow-y:auto;overflow-x:auto;");
			$("#proposte_block").addClass("scroll");		
		}else{
			$("#performance_room").attr("style", "height:"+heigthRow+"px;overflow-y:auto;overflow-x:auto;");
			$("#performance_room").addClass("scroll");
			$("#chat_pending").attr("style", "height:"+heigthRow+"px;overflow-y:auto;overflow-x:auto;");
			$("#chat_pending").addClass("scroll");
			$("#proposte_block").attr("style", "height:"+heigthRow+"px;overflow-y:auto;overflow-x:auto;");
			$("#proposte_block").addClass("scroll");
		}
    $(".row-eq-height").each(function() {
        var heights = $(this).find(".col-eq-height").map(function() {
            return $(this).outerHeight();
				}).get(), maxHeight = Math.max.apply(null, heights);
				$(this).find(".col-eq-height").outerHeight(maxHeight);
		});
});

</script>'."\r\n";

$ajax_leadtime_and_performance .= '
<script>
	/**
	* LOAD DIV LEADTIME
	*/
	function print_leadtime(){
			$("#leadtime_pre").html(\'<img src="'.BASE_URL_SITO.'img/loader_performance.gif" style="width:180px;height:auto" /><br />QUOTO sta calcolando il tuo <b>LeadTime</b>, attendere...!\');

			$("#leadtime").load("'.BASE_URL_SITO.'ajax/load_leadtime.php?idsito='.IDSITO.'&p_data='.$p_data.'&s_data='.$s_data.'", function() {
          $("#leadtime_pre").hide();
      });
	}
	/**
	* LOAD DIV PERFORMANCE
	*/
	function print_performance(){
		$("#preno_camera_pre").html(\'<img src="'.BASE_URL_SITO.'img/loader_performance.gif" style="width:180px;height:auto" /><br />QUOTO sta calcolando le <b>performance per camera</b>, attendere...!\');

		$("#prenotazioni_camera").load("'.BASE_URL_SITO.'ajax/performance_camere.php?idsito='.IDSITO.'&date='.$_REQUEST['date'].'&p_data='.$p_data.'&s_data='.$s_data.'&p_anno='.$primo_anno.'&s_anno='.$secondo_anno.'", function() {
        	$("#preno_camera_pre").hide();
    	});
	}
	function print_performance_deafult(){
		$("#preno_camera_pre").html(\'<img src="'.BASE_URL_SITO.'img/loader_performance.gif" style="width:180px;height:auto" /><br />QUOTO sta calcolando le <b>performance per camera</b>, attendere...!\');

		$("#prenotazioni_camera").load("'.BASE_URL_SITO.'ajax/performance_camere.php?idsito='.IDSITO.'&p_data='.$p_data.'&s_data='.$s_data.'&p_anno='.$primo_anno.'&s_anno='.$secondo_anno.'", function() {
        	$("#preno_camera_pre").hide();
    	});
	}
	$(document).ready(function() {'."\r\n";

if($_REQUEST['date'] == ''){
$ajax_leadtime_and_performance .= 'print_performance();'."\r\n";
}else{
$ajax_leadtime_and_performance .= 'print_performance_deafult();'."\r\n";
}
$ajax_leadtime_and_performance .= 'print_leadtime();
	});
</script>'."\r\n";

$permessi = check_permessi();

$js_grafici .= "
<script>
	$(function () {
		// ==============================================================
		// Bar chart option
		// ==============================================================
		var myChart = echarts.init(document.getElementById('bar-chart'));

		// specify chart configuration item and data
		option = {
				tooltip: {
						trigger: 'axis'
				},
				legend: {
						data: ['Richieste Preventivo', 'Prenotazioni']
				},
				toolbox: {
						show: true,
						feature: {
								dataView: { show: true, readOnly: false },
								magicType: { show: true, type: ['line', 'bar'] },
								restore: { show: true },
								saveAsImage: { show: true }
						}
				},
				color: [\"#55ce63\", \"#009efb\"],
				calculable: true,
				xAxis: [{
						type: 'category',
						data: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre']
				}],
				yAxis: [{
						type: 'value'
				}],
				series: [{
								name: 'Richieste Preventivo',
								type: 'bar',
								data: [".$data_prev."],
								markPoint: {
										data: [
												{ type: 'max', name: 'Max' },
												{ type: 'min', name: 'Min' }
										]
								},
								markLine: {
										data: [
												{ type: 'average', name: 'Media' }
										]
								}
						},
						{
								name: 'Prenotazioni',
								type: 'bar',
								data: [".$data_conf."],
								markPoint: {
										data: [
												{ },
												{ }
										]
								},
								markLine: {
										data: [
												{ type: 'average', name: 'Media' }
										]
								}
						}
				]
		};
		// use configuration item and data specified to show chart
		myChart.setOption(option, true), $(function() {
				function resize() {
						setTimeout(function() {
								myChart.resize()
						}, 100)
				}
				$(window).on(\"resize\", resize), $(\".sidebartoggler\").on(\"click\", resize)
		});"."\r\n";

if($permessi['DASH']==1){
	/*	$js_grafici .= "
		// ==============================================================
		// Line chart
		// ==============================================================
		var dom = document.getElementById(\"main\");
		var mytempChart = echarts.init(dom);
		var app = {};
		option = null;
		option = {

				tooltip: {
						trigger: 'axis'
				},
				legend: {
						data: ['Fatturato']
				},
				toolbox: {
						show: true,
						feature: {
								dataView: { show: true, readOnly: false },
								magicType: { show: true, type: ['line', 'bar'] },
								restore: { show: true },
								saveAsImage: { show: true }
						}
				},
				color: [\"#dd4b39\", \"#009efb\"],
				calculable: true,
				xAxis: [{
						type: 'category',
						boundaryGap: false,
						data: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre']
				}],
				yAxis: [{
						type: 'value',
						axisLabel: {
								formatter: '{value} €'
						}
				}],

				series: [{
								name: 'Fatturato',
								type: 'line',
								color: ['#000'],
								data: [".$data_fatt."],
								markPoint: {
										data: [
												{ type: 'max', name: 'Max' },
												{ type: 'min', name: 'Min' }
										]
								},
								itemStyle: {
										normal: {
												lineStyle: {
														shadowColor: 'rgba(0,0,0,0.3)',
														shadowBlur: 10,
														shadowOffsetX: 8,
														shadowOffsetY: 8
												}
										}
								},
								markLine: {
										data: [
												{ type: 'average', name: 'Media' }
										]
								}
						},

				]
		};

		if (option && typeof option === \"object\") {
				mytempChart.setOption(option, true), $(function() {
						function resize() {
								setTimeout(function() {
										mytempChart.resize()
								}, 100)
						}
						$(window).on(\"resize\", resize), $(\".sidebartoggler\").on(\"click\", resize)
				});
		}"."\r\n";*/
}

$js_grafici .= '
	});

</script>'."\r\n";



$js_filtro = '
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
	<script src="'.BASE_URL_SITO.'plugins/daterangepicker/daterangepicker.js"></script>
	<script>
	    moment.locale(\'it\');
		$(\'#demo\').daterangepicker({
		    format: \'DD/MM/YYYY\',
	        locale: { 
		        cancelLabel: \'Cancella\',
		        applyLabel: \'Applica\',
		        fromLabel: \'Da\',
		        toLabel: \'A\',
		        customRangeLabel: \'Imposta date\',
				daysOfWeek: [
										\'Do\',
										\'Lu\',
										\'Ma\',
										\'Me\',
										\'Gi\',
										\'Ve\',
										\'Sa\'
								],
				monthNames: [
										\'Gennaio\',
										\'Febbraio\',
										\'Marzo\',
										\'Aprile\',
										\'Maggio\',
										\'Giugno\',
										\'Luglio\',
										\'Agosto\',
										\'Settembre\',
										\'Ottobre\',
										\'Novembre\',
										\'Dicembre\'
								]
	} ,
	ranges: {
	\'Oggi\': [moment(), moment()],
	\'Ieri\': [moment().subtract(1, \'days\'), moment().subtract(1, \'days\')],
	\'Ultimi 7 Giorni\': [moment().subtract(6, \'days\'), moment()],
	\'Ultimi 30 Giorni\': [moment().subtract(29, \'days\'), moment()],
	\'Questo Mese\': [moment().startOf(\'month\'), moment().endOf(\'month\')],
	\'Mese Precedente\': [moment().subtract(1, \'month\').startOf(\'month\'), moment().subtract(1, \'month\').endOf(\'month\')]
	},
	startDate: moment().subtract(29, \'days\'),
	endDate: moment()
	},
	function (start, end) {
		$(\'#demo\').html(start.format(\'MMMM D, YYYY\') + \' - \' + end.format(\'MMMM D, YYYY\'));
		}
	);'."\r\n";

	if($_REQUEST['date']==''){

		$js_filtro .= '$(\'#demo\').val("01/01/'.date('Y').'" + \' - \' + "'.date('d/m/Y').'");'."\r\n";

	}else{
		$js_filtro .= '$(\'#demo\').val("'.$data_1_tmp.'" + \' - \' + "'.$data_2_tmp.'");'."\r\n";
	}


$js_filtro .= '$("#demo").on("change", function(){
					$("#statistiche").submit();
				});'."\r\n";
$js_filtro .= '</script>'."\r\n";
