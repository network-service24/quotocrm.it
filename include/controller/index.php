<?php


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
		$numeroGiorni_    = dateDifference($prima_data,$seconda_data);
		$numeroGiorniADR  = ($numeroGiorni_+1);
	}
	if($_REQUEST['date'] == ''){
		$numeroGiorni_    = dateDifference(date('Y').'-01-01',date('Y-m-d'));
		$numeroGiorniADR  = ($numeroGiorni_+1);
		$prima_data   = date('Y').'-01-01';
		$seconda_data = date('Y-m-d');
	}
	###################################################################

/** @var PerformizeFunctions $fun */
$fun->setDatesFromRequest($_REQUEST['date']??null);


	/**
	 * * Codice per il plugin da attivare o disattivare
	 * * del info-box ADR
	 */
	$checkADR = $fun->check_configurazioni(IDSITO,'check_adr');

    $_tot_invii=$fun->tot_invii();
    $_tot_preventivi=$fun->tot_preventivi();
    $_tot_prenotazioni=$fun->tot_prenotazioni();
    $_tot_prenotazioni_periodo=$fun->tot_prenotazioni_periodo();
    $_tot_prenotazioni_archiviate=$fun->tot_preno_archiviate();
    $_tot_conferme=$fun->tot_conferme();
    $_tot_conferme_periodo=$fun->tot_conferme_periodo();
    $tot_fatturato=$fun->tot_fatturato();
    $tot_fatturato_periodo=$fun->tot_fatturato_periodo();


	if($_tot_invii!==0 && $_tot_prenotazioni!==0){
		$TassoConversione     = $fun->tot_conversioni($_tot_invii,($_tot_prenotazioni+$_tot_prenotazioni_archiviate));
	}
	/**
	 ** Codice per le comparazioni
	 ** valori espressi in percentuale
	 ** default: da anno ad anno precedente
	 ** oppure in base alla query impostata
	 */
	if(ANNO_ATTIVAZIONE != date('Y')){

        $_tot_preventivi_periodo=$fun->tot_preventivi_periodo();

		if($_tot_preventivi > 0){
			$percPrevCon = number_format(((($_tot_preventivi-$_tot_preventivi_periodo)/$_tot_preventivi_periodo*100)),0,',','.');
			if(strstr($percPrevCon,"-")){
				//$colorSegno  =  'text-red';
				$iconaSegno  = '<i class="fa fa-arrow-down text-red" data-toggle="tooltip" title="Valore inferiore rispetto allo stesso periodo dell\'anno precedente"></i>';
				$segno       = '';
			}else{
				$segno       = '+';
				//$colorSegno  = 'text-green';
				$iconaSegno  = '<i class="fa fa-arrow-up text-green" data-toggle="tooltip" title="Valore superiore rispetto allo stesso periodo dell\'anno precedente"></i>';
			}
			if($_tot_preventivi == $_tot_preventivi_periodo){
				$segno      = '';
				$colorSegno = '';
				$textSegno  = '';
				$iconaSegno = '';
			}
			$textSegno   = ' &#10230; rispetto allo stesso periodo dell\'anno precedente';
			$PercentualePreventiviConfronto = '<span class="'.$colorSegno.'">'.$segno.$percPrevCon.' %</span>'.$textSegno;
		}
		if($_tot_conferme > 0){
			$percTratCon = number_format(((($_tot_conferme-$_tot_conferme_periodo)/$_tot_conferme_periodo*100)),0,',','.');
			if(strstr($percTratCon,"-")){
				//$colorSegnoC  =  'text-red';

				$iconaSegnoC  = '<i class="fa fa-arrow-down text-red" data-toggle="tooltip" title="Valore inferiore rispetto allo stesso periodo dell\'anno precedente"></i>';
				$segnoC       = '';
			}else{
				$segnoC       = '+';
				//$colorSegnoC  = 'text-green';
				$iconaSegnoC  = '<i class="fa fa-arrow-up text-green" data-toggle="tooltip" title="Valore superiore rispetto allo stesso periodo dell\'anno precedente"></i>';
			}


			if($_tot_conferme == $_tot_conferme_periodo){
				$segnoC      = '';
				$colorSegnoC = '';
				$textSegnoC  = '';
				$iconaSegnoC = '';
			}
			$textSegnoC   = ' &#10230; rispetto allo stesso periodo dell\'anno precedente';
			$PercentualeTrattativeConfronto = '<span class="'.$colorSegnoC.'">'.$segnoC.$percTratCon.' %</span>'.$textSegnoC;
		}
		if($_tot_prenotazioni > 0){
			$percPrenCon = number_format(((($_tot_prenotazioni-$_tot_prenotazioni_periodo)/$_tot_prenotazioni_periodo*100)),0,',','.');
			if(strstr($percPrenCon,"-")){
				//$colorSegnoP  =  'text-red';
				$iconaSegnoP  = '<i class="fa fa-arrow-down text-red" data-toggle="tooltip" title="Valore inferiore rispetto allo stesso periodo dell\'anno precedente"></i>';
				$segnoP       = '';
			}else{
				$segnoP       = '+';
				//$colorSegnoP  = 'text-green';
				$iconaSegnoP  = '<i class="fa fa-arrow-up text-green" data-toggle="tooltip" title="Valore superiore rispetto allo stesso periodo dell\'anno precedente"></i>';
			}
			if($_tot_prenotazioni == $_tot_prenotazioni_periodo){
				$segnoP      = '';
				$colorSegnoP = '';
				$textSegnoP  = '';
				$iconaSegnoP = '';
			}
			$textSegnoP   = ' &#10230; rispetto allo stesso periodo dell\'anno precedente';
			$PercentualePrenotazioniConfronto  = '<span class="'.$colorSegnoP.'">'.$segnoP.$percPrenCon.' %</span>'.$textSegnoP;
		}
		if($tot_fatturato > 0){
			$percFatturatoCon = number_format(((($tot_fatturato-$tot_fatturato_periodo)/$tot_fatturato_periodo*100)),0,',','.');
			if(strstr($percFatturatoCon,"-")){
				//$colorSegnoF  =  'text-red';
				$iconaSegnoF  = '<i class="fa fa-arrow-down text-red" data-toggle="tooltip" title="Valore inferiore rispetto allo stesso periodo dell\'anno precedente"></i>';
				$segnoF       = '';
			}else{
				$segnoF       = '+';
				//$colorSegnoF  = 'text-green';
				$iconaSegnoF  = '<i class="fa fa-arrow-up text-green" data-toggle="tooltip" title="Valore superiore rispetto allo stesso periodo dell\'anno precedente"></i>';
			}
			if($tot_fatturato == $tot_fatturato_periodo){
				$segnoF      = '';
				$colorSegnoF = '';
				$textSegnoF  = '';
				$iconaSegnoF = '';
			}
			$textSegnoF   = ' &#10230; rispetto allo stesso periodo dell\'anno precedente';
			$PercentualeFatturatoConfronto  = '<span class="'.$colorSegnoF.'">'.$segnoF.$percFatturatoCon.' %</span>'.$textSegnoF;
		}

		if($fun->tot_invii_periodo()!=0 && $_tot_prenotazioni_periodo!=0){
			$TassoConversioneConfronto = $fun->tot_conversioni($fun->tot_invii_periodo(),($_tot_prenotazioni_periodo+$fun->tot_preno_archiviate_periodo()));
		}

		$textSegnoConversioni   = ' &#10230; tasso per lo stesso periodo dell\'anno precedente';
		$ConversioniConfronto  = '<span class="">'.$TassoConversioneConfronto.'</span>'.$textSegnoConversioni;
		if($TassoConversione > $TassoConversioneConfronto){
			$segnoConversione       = '<i class="fa fa-arrow-up text-green" data-toggle="tooltip" title="Valore superiore rispetto allo stesso periodo dell\'anno precedente"></i>';
		}
		if($TassoConversione < $TassoConversioneConfronto){
			$segnoConversione       = '<i class="fa fa-arrow-down text-red" data-toggle="tooltip" title="Valore inferiore rispetto allo stesso periodo dell\'anno precedente"></i>';
		}
		if($TassoConversione == $TassoConversioneConfronto){
			$segnoConversione       = '';
		}
	}

	/**
	 ** Codice per le comparazioni
	 !! END!!
	 */
	###################################################################
	/**
	 ** Codice per la realizzazione del grafico
	 ** Preventivi e Prenotazioni
	 */
if(!in_array(IDSITO,MODULI_INDEX)){
       global $dbMysqli;
	   $diff_anni = (date('Y')-ANNO_ATTIVAZIONE);
	   $anniprima = (date('Y')-$diff_anni);
		   for($i=$anniprima; $i<=date('Y'); $i++){
			   $lista_anni .='<option value="'.$i.'" '.(($_REQUEST['querydate']=='' || $i==$_REQUEST['querydate'])?'selected="selected"':'').'>'.$i.'</option>';
		   }

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
/* 		$select = "SELECT COUNT(Id) as tot_prev FROM hospitality_guest
				WHERE DataRichiesta >= '$firstDayOfMonth' AND DataRichiesta <= '$lastDayOfMonth'
				AND TipoRichiesta = 'Preventivo' AND idsito = ".IDSITO; */
		$select = "SELECT 
						COUNT(g.Id) as tot_prev
					FROM 
						hospitality_guest as g
					WHERE 
						g.TipoRichiesta = 'Preventivo'
					AND
						g.Hidden = 0
					AND
						g.Chiuso = 0
					AND
						g.Accettato = 0
					AND
						g.NoDisponibilita = 0
					AND 
						g.idsito = " . IDSITO . "
					AND 
						(g.DataRichiesta >= '" . $firstDayOfMonth . "' 
					AND 
						g.DataRichiesta <= '" . $lastDayOfMonth. "')";				
		$res = $dbMysqli->query($select);
		$rws = $res[0];
		$tot_prev = $rws['tot_prev'];
		$array_data_prev[] = $tot_prev;

		// Query SQL per il tipo 'Conferma' gestendo sia DataRichiesta che DataChiuso
/* 		$select2 = "SELECT COUNT(Id) as tot_conf FROM hospitality_guest
					WHERE (DataRichiesta >= '$firstDayOfMonth' AND DataRichiesta <= '$lastDayOfMonth'
					OR DataChiuso >= '$firstDayOfMonth' AND DataChiuso <= '$lastDayOfMonth')
					AND TipoRichiesta = 'Conferma' AND idsito = ".IDSITO; */
		$select2 = "SELECT 
						COUNT(g.Id) as tot_conf
					FROM 
						hospitality_guest as g
					WHERE 
						g.TipoRichiesta = 'Conferma'
					AND
						g.Hidden = 0
					AND
						g.Disdetta = 0			
					AND 
						g.Chiuso = 1 
					AND 
						(g.IdMotivazione IS NULL OR g.DataRiconferma IS NOT NULL)
					AND 
						g.CheckinOnlineClient = 0
					AND 
						g.NoDisponibilita = 0
					AND 
						g.idsito = " . IDSITO. "
					AND 
						(g.DataRichiesta >= '" . $firstDayOfMonth . "' 
					AND 
						g.DataRichiesta <= '" . $lastDayOfMonth . "')";	
		$res2 = $dbMysqli->query($select2);
		$rws2 = $res2[0];
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
		$res3 = $dbMysqli->query($select3);
		$rws3 = $res3[0];
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

	$JSGrafico = "  <script src=\"".BASE_URL_SITO."js/plugins/echarts/echarts-all.js\"></script>
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
													restore: { show: false },
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
							});
						});
					</script>"."\r\n";
}
if(CHECKINONLINE == 0){
	$modale = $fun->modaleComunicazioni();
}
//$modale_numPrev = $fun->modaleNumeroPreventivi(IDSITO);
	/**
	 ** Codice per la realizzazione del grafico
	 ** Preventivi e Prenotazioni
	 !! END!
	 */
