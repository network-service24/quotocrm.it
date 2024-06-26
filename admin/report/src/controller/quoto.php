<?
	if ($_REQUEST['idsito'] != '') {

        $idsito            = $_POST['idsito'];
      
        $web               = $_POST['web'];
      
        $startdate         = $_POST['datastart'];
      
        $enddate           = $_POST['dataend'];
      
        $data_report       = $_POST['data_report'];

			function tot_preventiviR($idsito,$startdate,$enddate){
				global $dbMysqli;
				$sel = $dbMysqli->query('SELECT COUNT(Id) as tot_preventivi FROM hospitality_guest  WHERE TipoRichiesta = "Preventivo" AND idsito = '.$idsito.'  AND Hidden = 0 AND  DataRichiesta >= "'.$startdate.'" AND DataRichiesta <= "'.$enddate.'"');
				$rw  = $sel[0];
				return $rw['tot_preventivi'];
			}
			function tot_inviiR($idsito,$startdate,$enddate){
				global $dbMysqli;
				$sel = $dbMysqli->query('SELECT COUNT(Id) as tot_invii FROM hospitality_guest  WHERE TipoRichiesta = "Preventivo" AND idsito = '.$idsito.' AND Chiuso = 0 AND Hidden = 0 AND DataInvio != "" AND DataRichiesta >= "'.$startdate.'" AND DataRichiesta <= "'.$enddate.'"');
				$rws = $sel[0];
				return $rws['tot_invii'];
			}
			function tot_preno_archiviateR($idsito,$startdate,$enddate){
				global $dbMysqli;
				$sel = $dbMysqli->query('SELECT COUNT(Id) as tot_prenotazioni FROM hospitality_guest  WHERE TipoRichiesta = "Conferma" AND idsito = '.$idsito.' AND Hidden = 0 AND Chiuso = 1 AND Archivia = 1 AND DataRichiesta >= "'.$startdate.'" AND DataRichiesta <= "'.$enddate.'"');
				$rwc = $sel[0];
				return $rwc['tot_prenotazioni'];
			}
			function tot_prenotazioniR($idsito,$startdate,$enddate){
				global $dbMysqli;
				$sel = $dbMysqli->query('SELECT COUNT(Id) as tot_prenotazioni FROM hospitality_guest  WHERE TipoRichiesta = "Conferma" AND idsito = '.$idsito.' AND Disdetta = 0  AND Hidden = 0 AND DataRichiesta >= "'.$startdate.'" AND DataRichiesta <= "'.$enddate.'"');
				$rwc = $sel[0];
				return $rwc['tot_prenotazioni'];
			}
			function tot_fatturatoR($idsito,$startdate,$enddate){
				global $dbMysqli;
				$sel = $dbMysqli->query('SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
			                            FROM hospitality_guest
			                            INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
			                            WHERE 1=1
			                            AND hospitality_guest.idsito = '.$idsito.'
										AND hospitality_guest.NoDisponibilita = 0
										AND hospitality_guest.Hidden = 0
										AND hospitality_guest.Disdetta = 0
										AND hospitality_guest.TipoRichiesta = "Conferma"
			                            AND ((hospitality_guest.DataRichiesta >= "'.$startdate.'" AND hospitality_guest.DataRichiesta <= "'.$enddate.'") OR (DATE(hospitality_guest.DataChiuso)>= "'.$startdate.'" AND DATE(hospitality_guest.DataChiuso) <= "'.$enddate.'"))');
				$rwc = $sel[0];
				return number_format($rwc['fatturato'],2,',','.');
			}
			function tot_conversioniR($tot_invii,$tot_prenotazioni){
				$conversioni = @((100*$tot_prenotazioni)/$tot_invii);
				if(is_int($conversioni)){
					$conversioni = $conversioni;
				}else{
					$conversioni =	number_format($conversioni,2,',','.');
				}
				return str_replace(",00", "",$conversioni).' %';
			}



				function colorGenR() {

				    $caratteri_disponibili ="abcdef1234567890";
				    $colore = "";
				    for($i = 0; $i<6; $i++){
				        $colore .= substr($caratteri_disponibili,rand(0,strlen($caratteri_disponibili)-1),1);
				    }
				    return '#'.$colore;
				}



				$select = "SELECT FontePrenotazione, Abilitato FROM hospitality_fonti_prenotazione WHERE idsito = ".$idsito."";
				$rws = $dbMysqli->query($select);
				$tot = sizeof($rws);
				if($tot>0){
				    foreach ($rws as $key => $value) {

				        $select2 = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
				                                FROM hospitality_guest
				                                INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
				                                WHERE hospitality_guest.FontePrenotazione = '".$value['FontePrenotazione']."'
				                                AND((hospitality_guest.DataRichiesta >= '".$startdate."' AND hospitality_guest.DataRichiesta <= '".$enddate."') OR (DATE(hospitality_guest.DataChiuso)>= '".$startdate."' AND DATE(hospitality_guest.DataChiuso) <= '".$enddate."'))
				                                AND hospitality_guest.idsito = ".$idsito."
												AND hospitality_guest.NoDisponibilita = 0
												AND hospitality_guest.Disdetta = 0
												AND hospitality_guest.Hidden = 0
				                                AND hospitality_guest.TipoRichiesta = 'Conferma' ";
				        $res2 = $dbMysqli->query($select2);
				        $rws2 = $res2[0];
				        $fatturato = $rws2['fatturato'];
				        if($fatturato == '')$fatturato = 0;
				        $array_fatturato[$value['FontePrenotazione'].'_'.$value['Abilitato']]  = $fatturato;

				    }

				    $k = '';
				    foreach ($array_fatturato as $k => $v) {

				        $k_tmp     =explode("_",$k);
				        $k         = $k_tmp[0];
				        $abilitato = $k_tmp[1];

				        switch(strtolower($k)){
				            case 'sito web':
				                $color = '#f39c12';
				                $highlight = '#f39c12';
				                $label = 'Sito Web';
				            break;
				            case 'posta elettronica':
				                $color = '#f56954';
				                $highlight = '#f56954';
				                $label = 'Posta Elettronica';
				            break;
				            case 'info alberghi':
				                $color = '#605ca8';
				                $highlight = '#605ca8';
				                $label = 'Info Alberghi';
				            break;
				            case 'gabiccemare.com':
				                $color = '#dd4b39';
				                $highlight = '#dd4b39';
				                $label = 'gabiccemare.com';
				            break;
				            case 'reception':
				                $color = '#39cccc';
				                $highlight = '#39cccc';
				                $label = 'Reception';
				            break;
				            case 'telefono':
				                $color = '#f012be';
				                $highlight = '#f012be';
				                $label = 'Telefono';
				            break;
				            case 'telefonata':
				                $color = '#f012be';
				                $highlight = '#f012be';
				                $label = 'Telefonata';
				            break;
				            case 'whatsapp':
				                $color = '#00a65a';
				                $highlight = '#00a65a';
				                $label = 'Whatsapp';
				            break;
				            case 'facebook':
				                $color = '#3c8dbc';
				                $highlight = '#3c8dbc';
				                $label = 'Facebook';
				            break;
				            default:
				                $color = colorGenR();
				                $highlight = colorGenR();
				                $label = $k;
				            break;

				        }

				        $torta .= '{'."\r\n";
				        $torta .= 'value: '.$v.','."\r\n";
				        $torta .= 'color: "'.$color.'",'."\r\n";
				        $torta .= 'highlight: "'.$hightlight.'",'."\r\n";
				        $torta .= 'label: "'.$label.'"'."\r\n";
				        $torta .= '},'."\r\n";

				        $totale += $v;

				        $td_fonti .= '<tr>
								        <td class="col-md-6">
								        	<input type="text" name="etichetta_fatturato_fonti[]"  class=" form-control no_border_input font20Bold text-center" value="'.$label.' '.($abilitato==0?' (non attivo)':'').'" />
								        </td>
								        <td class="col-md-6">
								        	<input type="text" name="valore_fatturato_fonti[]"  class=" form-control no_border_input font20Bold text-center" value="'.number_format($v,2,',','.').'" />
								        </td>
				        			</tr>';


				    }



					$td_fonti .= '<tr><td class="col-md-6 font20Bold text-center"><b>TOTALE</b></td><td class="col-md-6"><input type="text" name="totale_fatturato_fonti"  class=" form-control no_border_input font20Bold text-center" value="'.number_format($totale,2,',','.').'" /></td></tr>';
				}

				//PROVENINEZA DA SITO Web


				function fatturatoTotaleSitoWeb($n_format=null,$idsito,$startdate,$enddate){
					global $dbMysqli;
								
					$sel = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
								FROM hospitality_guest
								INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
								WHERE 1=1
								AND hospitality_guest.idsito = ".$idsito."
								AND hospitality_guest.FontePrenotazione = 'Sito Web'
								AND hospitality_guest.NoDisponibilita = 0
								AND hospitality_guest.Hidden = 0
								AND hospitality_guest.Disdetta = 0
								AND hospitality_guest.TipoRichiesta = 'Conferma'
								AND ((hospitality_guest.DataRichiesta >= '".$startdate."' AND hospitality_guest.DataRichiesta <= '".$enddate."') OR (hospitality_guest.DataChiuso IS NOT NULL AND DATE(hospitality_guest.DataChiuso) >= '$startdate' AND DATE(hospitality_guest.DataChiuso) <= '$enddate'))";
					$rw = $dbMysqli->query($sel);
					$rwc = $rw[0];
					if($n_format){
						return $rwc['fatturato'];
					}else{
						return number_format($rwc['fatturato'],2,',','.');
					}
				
				}
				$sel = "SELECT SUM(fatturato) as fatt,
								sorgente,
								media
						FROM (
							SELECT 
								CASE 
									WHEN TipoRichiesta = 'Conferma' THEN
										hospitality_proposte.PrezzoP
									ELSE
										0
								END as fatturato,
									hospitality_utm_ads.utm_source as sorgente,
									hospitality_utm_ads.utm_medium as media
							FROM hospitality_guest
										INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
										INNER JOIN 
										hospitality_utm_ads 
									ON 
										(hospitality_utm_ads.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione
									AND
										hospitality_utm_ads.idsito = hospitality_guest.idsito)                   
							WHERE 1 = 1
							AND ((hospitality_guest.DataRichiesta >= '$startdate' AND hospitality_guest.DataRichiesta <= '$enddate') OR (hospitality_guest.DataChiuso IS NOT NULL AND DATE(hospitality_guest.DataChiuso) >= '$startdate' AND DATE(hospitality_guest.DataChiuso) <= '$enddate'))
								AND hospitality_guest.idsito = " . $idsito . "
								AND hospitality_guest.FontePrenotazione = 'Sito Web'
								AND hospitality_guest.Disdetta = 0
								AND hospitality_guest.NoDisponibilita = 0
								AND hospitality_guest.Hidden = 0
								AND hospitality_utm_ads.idsito = " . $idsito . "
						) as sub
					GROUP BY sorgente, media";

				$rws_ = $dbMysqli->query($sel);

				foreach ($rws_ as $y => $va) {
					if($va['sorgente']!=''){
						$array_fatturatoS[] = array('fatturato' => $va['fatt'],'source' => $va['sorgente'], 'medium' => $va['media']);
					}
				}


				if(!empty($array_fatturatoS) || !is_null($array_fatturatoS)){
				
				    foreach ($array_fatturatoS as $y => $val) {



				            $totaleS += $val['fatturato'];

				       		$td_provenienza .= '<tr>
										        <td class="col-md-6">
										        	<input type="text" name="etichetta_fatturato_sito[]"  class=" form-control no_border_input font20Bold text-center" value="'.$val['source'].'-'.$val['medium'].'" />
										        </td>
										        <td class="col-md-6">
										        	<input type="text" name="valore_fatturato_sito[]"  class=" form-control no_border_input font20Bold text-center" value="'.number_format($val['fatturato'],2,',','.').'" />
										        </td>
				        					</tr>';

				        
				 
				    }
					$fattSitoweb = fatturatoTotaleSitoWeb(1,$idsito,$startdate,$enddate);

					if($totaleS < $fattSitoweb) {
						$totaleDiff = ($fattSitoweb - $totaleS); 
						$td_provenienza .= '<tr>
												<td class="col-md-6"><input type="text" name="etichetta_fatturato_sito[]"  class=" form-control no_border_input font20Bold text-center" value="Referrer/Altro" /></td>
												<td class="col-md-6"><input type="text" name="valore_fatturato_sito[]"  class=" form-control no_border_input font20Bold text-center" value="'.number_format($totaleDiff,2,',','.').'" /></td>
											</tr>';
					}
						$td_provenienza .= '<tr><td class="col-md-6 font20Bold text-center"><b>TOTALE</b> (Sito Web)</td><td class="col-md-6"><input type="text" name="totale_fatturato_sito"  class=" form-control no_border_input font20Bold text-center" value="'.number_format(($totaleS+$totaleDiff),2,',','.').'" /></td></tr>';
				}

				// FATTURATO PER OPERATORI
				//
				// Query per filtrare ele operazioni effettuate dagli operatori di QUOTO
				$select15 = "SELECT * FROM hospitality_operatori WHERE idsito = ".$idsito."";
				$rws15 = $dbMysqli->query($select15);

				$totOperatore = sizeof($rws15);
				if($totOperatore>0){

				    $operatore = '';
				    $abilitatoOP = '';

				    foreach ($rws15 as $key15 => $value15) {

				        $operatore = trim(addslashes($value15['NomeOperatore']));
				        $abilitatoOP = $value15['Abilitato'];


				                $select16  = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
				                                        FROM hospitality_guest
				                                        INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
				                                        WHERE hospitality_guest.ChiPrenota = '".$operatore."'
				                                        AND ((hospitality_guest.DataRichiesta >= '".$startdate."' AND hospitality_guest.DataRichiesta <= '".$enddate."') OR (DATE(hospitality_guest.DataChiuso)>= '".$startdate."' AND DATE(hospitality_guest.DataChiuso) <= '".$enddate."'))
				                                        AND hospitality_guest.idsito = ".$idsito."
														AND hospitality_guest.NoDisponibilita = 0
				                                        AND hospitality_guest.DataRichiesta IS NOT NULL
				                                        AND hospitality_guest.Disdetta = 0
														AND hospitality_guest.Hidden = 0
				                                        AND hospitality_guest.TipoRichiesta = 'Conferma' ";
				                $res16 = $dbMysqli->query($select16);
				                $rws16 = $res16[0];
				                $fatturatoOperatore = $rws16['fatturato'];
				                if($fatturatoOperatore == '')$fatturatoOperatore = 0;
				                $array_fatturatoOperatore[$operatore.'_'.$abilitatoOP]  = $fatturatoOperatore;
				    }
				    $z = '1';
				    foreach ($array_fatturatoOperatore as $ky => $val) {

				        $ky_tmp      =explode("_",$ky);
				        $ky          = $ky_tmp[0];
				        $abilitatoOP = $ky_tmp[1];

				        switch(($z)){
				            case '1':
				                $colorOP = '#f39c12';
				                $highlightOP = '#f39c12';

				            break;
				            case '2':
				                $colorOP = '#f56954';
				                $highlightOP = '#f56954';

				            break;
				            case '3':
				                $colorOP = '#605ca8';
				                $highlightOP = '#605ca8';

				            break;
				            case '4':
				                $colorOP = '#39cccc';
				                $highlightOP = '#39cccc';

				            break;
				            case '5':
				                $colorOP = '#f012be';
				                $highlightOP = '#f012be';

				            break;
				            case '6':
				                $colorOP = '#00a65a';
				                $highlightOP = '#00a65a';

				            break;
				            case '7':
				                $colorOP = '#3c8dbc';
				                $highlightOP = '#3c8dbc';

				            break;
				            default:
				                $colorOP = colorGenR();
				                $highlight = colorGenR();

				            break;

				        }

				        $tortaOP .= '{'."\r\n";
				        $tortaOP .= 'value: '.$val.','."\r\n";
				        $tortaOP .= 'color: "'.$colorOP.'",'."\r\n";
				        $tortaOP .= 'highlight: "'.$hightlightOP.'",'."\r\n";
				        $tortaOP .= 'label: "'.$ky.'"'."\r\n";
				        $tortaOP .= '},'."\r\n";

				        $totaleOP += $val;


				        $td_operatori .= '<tr>
									        <td class="col-md-6">
									        	<input type="text" name="etichetta_fatturato_operatori[]"  class=" form-control no_border_input font20Bold text-center" value="'.$ky.' '.($abilitatoOP==0?' (non attivo)':'').'" />
									        </td>
									        <td class="col-md-6">
									        	<input type="text" name="valore_fatturato_operatori[]"  class=" form-control no_border_input font20Bold text-center" value="'.number_format($val,2,',','.').'" />
									        </td>
				        				</tr>';

				    $z++;
				    }


				        $td_operatori .= '<tr><td class="col-md-6 font20Bold text-center"><b>TOTALE</b></td><td class="col-md-6"><input type="text" name="totale_fatturato_operatori"  class=" form-control no_border_input font20Bold text-center" value="'.number_format($totaleOP,2,',','.').'" /></td></tr>';

				}
				//PER TARGET CLIENTE
				$select18 = "SELECT Target FROM hospitality_target WHERE idsito = ".$idsito." ORDER BY Id ASC";
				$rws18 = $dbMysqli->query($select18);

				$totTARGET = sizeof($rws18);
				if($totTARGET>0){
				    foreach ($rws18 as $key18 => $value18) {

				        $select19 = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
				                                FROM hospitality_guest
				                                INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
				                                WHERE hospitality_guest.TipoVacanza = '".$value18['Target']."'
				                                AND ((hospitality_guest.DataRichiesta >= '".$startdate."' AND hospitality_guest.DataRichiesta <= '".$enddate."') OR (DATE(hospitality_guest.DataChiuso)>= '".$startdate."' AND DATE(hospitality_guest.DataChiuso) <= '".$enddate."'))
				                                AND hospitality_guest.idsito = ".$idsito."
												AND hospitality_guest.NoDisponibilita = 0
				                                AND hospitality_guest.Disdetta = 0
												AND hospitality_guest.Hidden = 0
				                                AND hospitality_guest.TipoRichiesta = 'Conferma' ";
				        $res19 = $dbMysqli->query($select19);
				        $rws19 = $res19[0];
				        $fatturatoTARGET = $rws19['fatturato'];
				        if($fatturatoTARGET == '')$fatturatoTARGET = 0;
				        if($fatturatoTARGET != '' || $fatturatoTARGET != 0){

				                $array_fatturatoTARGET[$value18['Target']]  = $fatturatoTARGET;
				        }

				    }

				if(isset($array_fatturatoTARGET)){
				    foreach ($array_fatturatoTARGET as $T => $vT) {

				        switch(strtolower($T)){
				            case 'family':
				                $colorT = '#f39c12';
				                $highlightT = '#f39c12';
				                $labelT = 'Family';
				            break;
				            case 'business':
				                $colorT = '#f56954';
				                $highlightT = '#f56954';
				                $labelT = 'Business';
				            break;
				            case 'benessere':
				                $colorT = '#d81b60';
				                $highlightT = '#d81b60';
				                $labelT = 'Benessere';
				            break;
				            case 'fiera':
				                $colorT = '#605ca8';
				                $highlightT = '#605ca8';
				                $labelT = 'Fiera';
				            break;
				            case 'bike':
				                $colorT = '#39cccc';
				                $highlightT = '#39cccc';
				                $labelT = 'Bike';
				            break;
				            case 'sport':
				                $colorT = '#f012be';
				                $highlightT = '#f012be';
				                $labelT = 'Sport';
				            break;
				            case 'divertimento':
				                $colorT = '#00a65a';
				                $highlightT = '#00a65a';
				                $labelT = 'Divertimento';
				            break;
				            case 'romantico':
				                $colorT = '#f012be';
				                $highlightT = '#f012be';
				                $labelT = 'Romantico';
				            break;
				            case 'culturale':
				                $colorT = '#3c8dbc';
				                $highlightT = '#3c8dbc';
				                $labelT = 'Culturale';
				            break;
				            case 'enogastronomico':
				                $colorT = '#39cccc';
				                $highlightT = '#39cccc';
				                $labelT = 'Enogastronomico';
				            break;
				            default:
				                $colorT = colorGenR();
				                $highlightT = colorGenR();
				                $labelT = $T;
				            break;

				        }

				        $tortaT .= '{'."\r\n";
				        $tortaT .= 'value: '.$vT.','."\r\n";
				        $tortaT .= 'color: "'.$colorT.'",'."\r\n";
				        $tortaT .= 'highlight: "'.$hightlightT.'",'."\r\n";
				        $tortaT .= 'label: "'.$labelT.'"'."\r\n";
				        $tortaT .= '},'."\r\n";

				        $totaleT += $vT;

				        $td_target .= '<tr>
									        <td class="col-md-6">
									        	<input type="text" name="etichetta_fatturato_target[]"  class=" form-control no_border_input font20Bold text-center" value="'.$labelT.'" />
									        </td>
									        <td class="col-md-6">
									        	<input type="text" name="valore_fatturato_target[]"  class=" form-control no_border_input font20Bold text-center" value="'.number_format($vT,2,',','.').'" />
									        </td>
				        				</tr>';


				    }
				}


				        $td_target .= '<tr><td class="col-md-6 font20Bold text-center"><b>TOTALE</b></td><td class="col-md-6"><input type="text" name="totale_fatturato_target"  class=" form-control no_border_input font20Bold text-center" value="'.number_format($totaleT,2,',','.').'" /></td></tr>';
				}

				$script_legenda = ' <script>
										$(function() {
											$.notify({ 
												title:    \'LEGENDA\', 
												body:     \'I caratteri speciali: esempio <b>&euro;</b> oppure <b>%</b>, vengono introdotti nella stampa PDF, NON tentare di inserirli in questo step!\', 
												icon:     \'fa fa-exclamation-triangle\', 
												position: \'top-center\', 
												timeout: 3000,
												showTime: 100,
												forever: false
											}); 
										});
									</script>'."\r\n";

		    }
