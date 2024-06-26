<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/function.inc.php");

        $idsito     = $_REQUEST['idsito'];
        $nome       = $_REQUEST['nome'];
        $cognome    = $_REQUEST['cognome'];
        $email      = $_REQUEST['email'];

		$sel = "	SELECT
						hospitality_guest.*
					FROM
						hospitality_guest
					WHERE
						hospitality_guest.Nome = '".$dbMysqli->escape($nome)."'
					AND
						hospitality_guest.Cognome = '".$dbMysqli->escape($cognome)."'
					AND
						hospitality_guest.Email = '".$dbMysqli->escape($email)."'
					AND
						hospitality_guest.idsito = ".$idsito."
					ORDER BY
                        hospitality_guest.DataRichiesta DESC,
                        hospitality_guest.DataChiuso DESC,
                        hospitality_guest.TipoRichiesta DESC,
                        hospitality_guest.Id DESC";
		$rs = $dbMysqli->query($sel);
		$tot = sizeof($rs);






			$output = '';
			$Camere          = '';
			$data_alernativa = '';
			$saldo           = '';
			$etichetta_saldo = '';
			$DPartenza       = '';
			$DArrivo         = '';
			$DNotti          = '';

			foreach($rs as $key => $value){


				$Id                 = $value['Id'];
				$idsito             = $value['idsito'];
                $NumeroPrenotazione = $value['NumeroPrenotazione'];
                $DataRichiesta      = $fun->gira_data($value['DataRichiesta']);
                $DataChiuso         = $fun->gira_data_noHour($value['DataChiuso']);
				$idsito             = $value['idsito'];
				$AccontoRichiesta   = $value['AccontoRichiesta'];
				$AccontoLibero      = $value['AccontoLibero'];
				$Nome               = stripslashes($value['Nome']);
				$Cognome            = stripslashes($value['Cognome']);
				$Email              = $value['Email'];
				$Arrivo_tmp         = explode("-",$value['DataArrivo']);
				$Arrivo             = $Arrivo_tmp[2].'-'.$Arrivo_tmp[1].'-'.$Arrivo_tmp[0];
				$Partenza_tmp       = explode("-",$value['DataPartenza']);
				$Partenza           = $Partenza_tmp[2].'-'.$Partenza_tmp[1].'-'.$Partenza_tmp[0];
				$start              = mktime(24,0,0,$Arrivo_tmp[1],$Arrivo_tmp[2],$Arrivo_tmp[0]);
				$end                = mktime(01,0,0,$Partenza_tmp[1],$Partenza_tmp[2],$Partenza_tmp[0]);
				$formato            = "%a";
				$Notti              = dateDiff($value['DataArrivo'],$value['DataPartenza'],$formato);




					$output .= '<div class="card" id="block'.$Id.'">
                                    <div class="card-block">
                                        <div id="view'.$Id.'" class="cursore f-14"><i class="fa fa-angle-double-right m-r-10"></i>
										'.($value['TipoRichiesta']=='Preventivo'?'Preventivo Nr. '.$NumeroPrenotazione.' del '.$DataRichiesta:($value['Chiuso']==1?'Prenotazione':'Conferma').' Nr. '.$NumeroPrenotazione.' del '.($value['Chiuso']==1?$DataChiuso:$DataRichiesta)).'
										</div>
                                        <div id="hid'.$Id.'" class="m-t-10 m-l-20 f-12" style="display:none">';

					$select = "SELECT hospitality_proposte.Id as IdProposta,hospitality_proposte.NomeProposta, hospitality_proposte.PrezzoL,hospitality_proposte.PrezzoP,hospitality_guest.TipoRichiesta,hospitality_guest.idsito,
										hospitality_guest.AccontoRichiesta,hospitality_guest.Nome,hospitality_guest.Cognome,hospitality_guest.AccontoLibero,
										hospitality_proposte.AccontoPercentuale,hospitality_proposte.AccontoImporto,hospitality_proposte.AccontoTesto,
										hospitality_guest.Email,hospitality_guest.DataArrivo,hospitality_guest.DataPartenza,hospitality_guest.Chiuso,hospitality_guest.Id as id_richiesta
								FROM hospitality_proposte
								INNER JOIN hospitality_guest ON hospitality_guest.Id = hospitality_proposte.id_richiesta
								WHERE hospitality_guest.Id = " . $Id . " AND hospitality_guest.idsito = " . $idsito . " ORDER BY hospitality_proposte.Id ASC";
					$res = $dbMysqli->query($select);
					$tot = sizeof($res);
					if ($tot > 0) {
						$Camere = '';
						$sistemazioneP = '';
						$sistemazioneC = '';
						$n = 1;
						$data_alernativa = '';
						$saldo = '';
						$etichetta_saldo = '';
						$DPartenza = '';
						$DArrivo = '';
						$DNotti = '';
						foreach ($res as $key => $value) {

							$PrezzoL = number_format($value['PrezzoL'], 2, ',', '.');
							$PrezzoP = number_format($value['PrezzoP'], 2, ',', '.');
							$IdProposta = $value['IdProposta'];
							$IdRichiesta = $value['id_richiesta'];
							$PrezzoPC = $value['PrezzoP'];
							$idsito = $value['idsito'];
							$AccontoRichiesta = $value['AccontoRichiesta'];
							$AccontoLibero = $value['AccontoLibero'];
							$NomeProposta = $value['NomeProposta'];
							$Nome = stripslashes($value['Nome']);
							$Cognome = stripslashes($value['Cognome']);
							$Email = $value['Email'];
							$Arrivo_tmp = explode("-", $value['DataArrivo']);
							$Arrivo = $Arrivo_tmp[2] . '-' . $Arrivo_tmp[1] . '-' . $Arrivo_tmp[0];
							$Partenza_tmp = explode("-", $value['DataPartenza']);
							$Partenza = $Partenza_tmp[2] . '-' . $Partenza_tmp[1] . '-' . $Partenza_tmp[0];
							$start = mktime(24, 0, 0, $Arrivo_tmp[1], $Arrivo_tmp[2], $Arrivo_tmp[0]);
							$end = mktime(01, 0, 0, $Partenza_tmp[1], $Partenza_tmp[2], $Partenza_tmp[0]);
							$formato = "%a";
							$Notti = dateDiff($value['DataArrivo'], $value['DataPartenza'], $formato);
							$AccontoPercentuale = $value['AccontoPercentuale'];
							$AccontoImporto = $value['AccontoImporto'];
							$AccontoTesto = stripslashes($value['AccontoTesto']);
							// date alternative
							$se = "SELECT hospitality_proposte.Arrivo,hospitality_proposte.Partenza FROM hospitality_proposte  WHERE hospitality_proposte.Id = " . $IdProposta . " ";
							$re = $dbMysqli->query($se);
							$rc = $re[0];
							if (is_array($rc)) {
								if ($rc > count($rc)) {
									$tt = count($rc);
								}

							} else {
								$tt = 0;
							}
							if ($tt > 0) {
								$DArrivo_tmp = explode("-", $rc['Arrivo']);
								$DArrivo = $DArrivo_tmp[2] . '-' . $DArrivo_tmp[1] . '-' . $DArrivo_tmp[0];
								$DPartenza_tmp = explode("-", $rc['Partenza']);
								$DPartenza = $DPartenza_tmp[2] . '-' . $DPartenza_tmp[1] . '-' . $DPartenza_tmp[0];
								$Dstart = mktime(24, 0, 0, $DArrivo_tmp[1], $DArrivo_tmp[2], intval($DArrivo_tmp[0]));
								$Dend = mktime(01, 0, 0, $DPartenza_tmp[1], $DPartenza_tmp[2], intval($DPartenza_tmp[0]));
								$formato = "%a";
								$DNotti = $fun->dateDiff($rc['Arrivo'], $rc['Partenza'], $formato);
							}

							if ($AccontoRichiesta != 0 && $AccontoLibero == 0) {
								$saldo = ($PrezzoPC - ($PrezzoPC * $AccontoRichiesta / 100));
								$acconto = number_format(($PrezzoPC * $AccontoRichiesta / 100), 2, ',', '.');
							}
							if ($AccontoRichiesta == 0 && $AccontoLibero != 0) {
								$saldo = ($PrezzoPC - $AccontoLibero);
								$acconto = number_format($AccontoLibero, 2, ',', '.');
							}

							if ($AccontoPercentuale != 0 && $AccontoImporto == 0) {
								$saldo = ($PrezzoPC - ($PrezzoPC * $AccontoPercentuale / 100));
								$acconto = number_format(($PrezzoPC * $AccontoPercentuale / 100), 2, ',', '.');
							}
							if ($AccontoPercentuale == 0 && $AccontoImporto != 0) {
								if ($AccontoImporto >= 1) {
									$etichetta_caparra = '';
								} else {
									$etichetta_caparra = '<br />Carta di Credito a garanzia';
								}
								$saldo = ($PrezzoPC - $AccontoImporto);
								$acconto = number_format($AccontoImporto, 2, ',', '.');
								//$acconto = 'Carta di Credito a garanzia';
							}
							if ($PrezzoPC == $saldo) {
								$etichetta_saldo = ' Cifra a saldo €.0,00';
							} else {
								if($AccontoPercentuale == 0 && $AccontoImporto <= 1) {
									$saldo   = $PrezzoPC;
								}
								$etichetta_saldo = 'Cifra a saldo €.' . number_format(floatval($saldo), 2, ',', '.');
							}

							$select2 = "SELECT hospitality_richiesta.*,hospitality_tipo_camere.TipoCamere,hospitality_tipo_soggiorno.TipoSoggiorno
										FROM hospitality_richiesta
										INNER JOIN hospitality_tipo_camere ON hospitality_tipo_camere.Id = hospitality_richiesta.TipoCamere
										INNER JOIN hospitality_tipo_soggiorno ON hospitality_tipo_soggiorno.Id = hospitality_richiesta.TipoSoggiorno
										WHERE hospitality_richiesta.id_proposta = " . $IdProposta . " AND hospitality_richiesta.id_richiesta = " . $IdRichiesta;
							$res2 = $dbMysqli->query($select2);
							$Camere = '';
							if ($rc['Arrivo'] != '' && $rc['Partenza'] != '') {
								if ($value['TipoRichiesta'] == 'Preventivo') {
									if ($Arrivo != $DArrivo || $Partenza != $DPartenza) {
										$data_alernativa = '<b>Date alternative</b><br>Arrivo <i class=\'fa fa-angle-right\'></i> ' . $DArrivo . ' - Partenza <i class=\'fa fa-angle-right\'></i> ' . $DPartenza . ' - per notti: ' . $DNotti . '<br>';
									}
								} elseif ($value['TipoRichiesta'] == 'Conferma') {
									if ($rc['Arrivo'] != $value['DataArrivo']) {
										$Arrivo = $DArrivo;
									}
									if ($rc['Partenza'] != $value['DataPartenza']) {
										$Partenza = $DPartenza;
									}
								}
							}
							foreach ($res2 as $ky => $val) {
								$Camere .= '<span class="nowrap">
												<b>'.$val['TipoSoggiorno'].'</b><br>
												<span class="m-l-10"><i class="fa fa-caret-right"></i> '.$val['TipoCamere'].'</span><br><span class="m-l-10"><i class="fa fa-caret-right"></i> '.($val['NumAdulti']!=0?'  A: '.$val['NumAdulti']:'').($val['NumBambini']!=0?' B: '.$val['NumBambini']:'').($val['EtaB']!='' || $val['EtaB']!=0?' età: '.$val['EtaB']:'').' - €. '.number_format($val['Prezzo'],2,',','.').'</span>
											</span>
											<br>';
							}

							if ($value['TipoRichiesta'] == 'Preventivo') {

								$sistemazioneP .= '<b>' . $n . ') PROPOSTA</b><br>' . ($NomeProposta != '' ? '' . $NomeProposta . '<br>' : '') . '<b>' . $Nome . ' ' . $Cognome . '</b> - <em>' . $Email . '</em><br>Arrivo <i class=\'fa fa-angle-right\'></i> ' . $Arrivo . ' - Partenza <i class=\'fa fa-angle-right\'></i> ' . $Partenza . '<br>' . $data_alernativa . $Camere . '  <i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>  Prezzo Proposto €.' . $PrezzoP . '<div class="clearfix p-b-20"></div>';

							} else {

								$sistemazioneC .= '<b>SOLUZIONE CONFERMATA</b><br>' . ($NomeProposta != '' ? '' . $NomeProposta . '<br>' : '') . '<b>' . $Nome . ' ' . $Cognome . '</b> - <em>' . $Email . '</em><br>Arrivo <i class=\'fa fa-angle-right\'></i> ' . $Arrivo . ' - Partenza <i class=\'fa fa-angle-right\'></i> ' . $Partenza . '<br> ' . $data_alernativa . $Camere . ' <i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i> Prezzo Proposto €.' . $PrezzoP . '<br /> ' . ($acconto != '' ? '<i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Caparra versata o da prelevare €.' . $acconto . '' : '') . '<br>' . $etichetta_saldo . '<div class="clearfix"></div>';

							}

							$n++;
							$data_alernativa = '';
							$DPartenza = '';
							$DArrivo = '';
							$DNotti = '';
						}

						if ($sistemazioneP != '') {
							$sistemazione = $sistemazioneP;
						}
						if ($sistemazioneC != '') {
							$sistemazione = $sistemazioneC;
						}

						$output .= ' ' . $sistemazione . '';

					} else {
						$output .= 'Preventivo da completare';

					}


			        $output .= '        </div>
                                    </div>
                                </div>';

                    $JSoutput .='
                                        $("#view'.$Id.'").on("click",function(){
                                            $("#hid'.$Id.'").slideToggle();
                                        });';

			}

		if(sizeof($rs)>0){
			$rd = $idsito;
			echo '<div class="card bg_blocchi_proposta" id="storico'.$rd.'">
                    <div class="card-block">
                        <span class="f-16 f-w-600 text-center">Storico del cliente:</span>
                            <br><br>
                        <div class="f-13 scroll p-r-10" style="height:'.(sizeof($rs)>=5?'700px':'auto').';overflow-y:auto;overflow-x:auto;" id="viewStorico'.$rd.'">
                            '.$output.'
                            <script>
                                $(document).ready(function(){
                                    '.$JSoutput.'
                                })
                            </script>
                        </div>
                    </div>
                </div>';
		}

?>
