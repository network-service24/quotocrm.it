<?php
/**
 * CRM and CMS
 * @author Marcello Visigalli <a marcello.visigalli@gmail.com >
 * @version 3.0
 * @name SuiteWeb
 * CRUD for insert, update, delete query in ajax
 */

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/function.inc.php");

	$data             = array();
	$pagina_corrente  = $_REQUEST['pagina_corrente'];
	$righe_per_pagina = $_REQUEST['righe_per_pagina'];
	$prima_riga       = ($pagina_corrente - 1) * $righe_per_pagina;


 	if($_REQUEST['action']=='search'){

		if($_REQUEST['Motivo']!=''){
			$sel = "SELECT
							hospitality_guest.Id as id_guest
						FROM
							hospitality_motivi_disdetta
						INNER JOIN
							hospitality_guest ON hospitality_guest.Id = hospitality_motivi_disdetta.IdRichiesta
						WHERE
							hospitality_motivi_disdetta.idsito = ".$_REQUEST['idsito']."
						AND
							hospitality_motivi_disdetta.Motivo = '".$_REQUEST['Motivo']."'
						AND
							hospitality_guest.idsito = ".$_REQUEST['idsito']."
						AND
							hospitality_guest.NoDisponibilita = 1
						ORDER by
							hospitality_motivi_disdetta.NumeroPrenotazione DESC";
			$array_id  = $dbMysqli->query($sel);

			if(sizeof($array_id)>0){
				foreach ($array_id as $key => $value) {
					$lista_id_[] = $value['id_guest'];
				}
				if(empty($lista_id_)  || is_null($lista_id_)){
					$lista_id_[] = 0;
				}
				$andSelectFilter = " AND hospitality_guest.Id IN (".implode(",",$lista_id_).")";
			}
		}

		if($_REQUEST['NumeroPrenotazione']!=''){
			$andSelect  .= " AND hospitality_guest.NumeroPrenotazione = ".$_REQUEST['NumeroPrenotazione']."";
		}
		if($_REQUEST['Operatore']!=''){
			$andSelect  .= " AND hospitality_guest.ChiPrenota = '".$_REQUEST['Operatore']."'";
		}
		if($_REQUEST['FontePrenotazione']!=''){
			$andSelect  .= " AND hospitality_guest.FontePrenotazione = '".$_REQUEST['FontePrenotazione']."'";
		}
		if($_REQUEST['TipoVacanza']!=''){
			$andSelect  .= " AND hospitality_guest.TipoVacanza LIKE '%".$_REQUEST['TipoVacanza']."%'";
		}
		if($_REQUEST['Nome']!=''){
			$andSelect  .= " AND hospitality_guest.Nome LIKE '%".$dbMysqli->escape($_REQUEST['Nome'])."%'";
		}
		if($_REQUEST['Cognome']!=''){
			$andSelect  .= " AND hospitality_guest.Cognome LIKE '%".$dbMysqli->escape($_REQUEST['Cognome'])."%'";
		}
		if($_REQUEST['Nome']!='' && $_REQUEST['Cognome']!=''){
			$andSelect  .= " AND hospitality_guest.Nome LIKE '%".$_REQUEST['Nome']."%' AND hospitality_guest.Cognome LIKE '%".$_REQUEST['Cognome']."%'";
		}
		if($_REQUEST['Email']!=''){
			$andSelect  .= " AND hospitality_guest.Email = '".$_REQUEST['Email']."'";
		}
		if($_REQUEST['NoDisponibilita']!=''){
			$andSelect  .= " AND hospitality_guest.NoDisponibilita = '".$_REQUEST['NoDisponibilita']."'";
		}
		if($_REQUEST['DataInvio']!=''){
			$andSelect  .= " AND hospitality_guest.DataInvio = '".$_REQUEST['DataInvio']."'";
		}
		if($_REQUEST['DataScadenza']!=''){
			$andSelect  .= " AND hospitality_guest.DataScadenza >= '".$_REQUEST['DataScadenza']."'";
		}
		if($_REQUEST['DataArrivo']!='' && $_REQUEST['DataPartenza'] ==''){
			$andSelect  .= " AND hospitality_guest.DataArrivo >= '".$_REQUEST['DataArrivo']."'";
		}
		if($_REQUEST['DataArrivo']!='' && $_REQUEST['DataPartenza'] !=''){
			$andSelect  .= " AND hospitality_guest.DataArrivo >= '".$_REQUEST['DataArrivo']."' AND hospitality_guest.DataPartenza <= '".$_REQUEST['DataPartenza']."'";
		}

		if($_REQUEST['DataRichiesta_dal']!='' && $_REQUEST['DataRichiesta_al'] ==''){
			$andSelect  .= " AND hospitality_guest.DataRichiesta >= '".$_REQUEST['DataRichiesta_dal']."'";
		}
		if($_REQUEST['DataRichiesta_dal']!='' && $_REQUEST['DataRichiesta_al'] !=''){
			$andSelect  .= " AND hospitality_guest.DataRichiesta >= '".$_REQUEST['DataRichiesta_dal']."' AND hospitality_guest.DataRichiesta <= '".$_REQUEST['DataRichiesta_al']."'";
		}
		if($_REQUEST['Lingua']!=''){
			$andSelect  .= " AND hospitality_guest.Lingua= '".$_REQUEST['Lingua']."'";
		}
	}


	# QUERY PER COMPILARE IL DATATABLE
	$select  = "SELECT
					*
				FROM
					hospitality_guest
				WHERE
					hospitality_guest.idsito = ".$_REQUEST['idsito']."
				AND
					hospitality_guest.NoDisponibilita = 1
				AND
					hospitality_guest.Archivia = 0
				AND
					hospitality_guest.Hidden = 0
				AND
					hospitality_guest.CheckinOnlineClient = 0
				AND
					hospitality_guest.Chiuso = 0
				".$andSelect ."
				".$andSelectFilter." ";
if(!$_REQUEST['action']){
	if($pagina_corrente!='' && $righe_per_pagina!=''){
		$select .=" ORDER BY Id DESC LIMIT ".$prima_riga.", ".$righe_per_pagina."";
	}
}
$rec = $dbMysqli->query($select);


	$bg_fonte         = '';
	$bg_tipo          = '';

	foreach($rec as $key => $row){


				if($row['TipoRichiesta']=='Preventivo'){
					$TipoRichiesta  = '<label class="badge badge-default bg-warning f-11">'.$row['TipoRichiesta'].'</label><div classs="clearfix"></div> <span clas="f-10">'.gira_data($row['DataRichiesta']).'</span>';
					$riepilogoModal = '	<a href="#" class="btn btn-inverse btn-mini" data-toggle="modal" data-target="#proposta'.$row['Id'].'">Dettaglio</a>';

					$TitoloModale   =  'Preventivo proposto Nr. '.$row['Id'].'/'.$row['NumeroPrenotazione'].' - operatore '.$row['ChiPrenota'].'';
				}else{
					if($row['Chiuso']=='1'){
						$TipoRichiesta  =  '<label class="badge badge-default bg-success f-11 nowrap">Prenotazione Confermata</label><div classs="clearfix"></div> <span clas="f-10">'.gira_data($row['DataChiuso']).'</span>';
						$riepilogoModal = '	<a href="#" class="btn btn-inverse btn-mini" data-toggle="modal" data-target="#proposta'.$row['Id'].'">Dettaglio</a>';

						$TitoloModale   =  'Proposta confermata Nr. '.$row['Id'].'/'.$row['NumeroPrenotazione'].' - operatore '.$row['ChiPrenota'].'';
					}else{
						$TipoRichiesta  = '<label class="badge badge-default bg-info f-11 nowrap">'.$row['TipoRichiesta'].' in trattativa</label><div classs="clearfix"></div> <span clas="f-10">'.gira_data($row['DataRichiesta']).'</span>';
						$riepilogoModal = '	<a href="#" class="btn btn-inverse btn-mini" data-toggle="modal" data-target="#proposta'.$row['Id'].'">Dettaglio</a>';

						$TitoloModale   =  'Prenotazione confermata Nr. '.$row['Id'].'/'.$row['NumeroPrenotazione'].' - operatore '.$row['ChiPrenota'].'';
					}
				}
				$riepilogoModal .=	'<div class="modal fade" id="proposta'.$row['Id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<p class="modal-title f-14">'.$TitoloModale.'</p>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body text-left">
														'.$fun->dettaglio_profila($row['Id'],$row['NumeroPrenotazione'],$row['TipoRichiesta'],$row['idsito']).'
													</div>
												</div>
											</div>
										</div>';
				$action = ' <div class="btn-group dropdown-split-default"  id="azioniPrev">
								<a type="button"  class="cursore dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fa fa-ellipsis-h fa-2x fa-fw"></i>
								</a>
								<div class="dropdown-menu">';

				$record        = $fun->CheckMotivazioneAnnullate($row['Id'],$row['idsito']);
				$Motivo        = $record['Motivo'];
				$DataReContact = $record['DataReContact'];

			if(strstr($Motivo,'Assenza Disponibilità') || strstr($Motivo,'Non Disponibile')){
				if(is_null($DataReContact) || empty($DataReContact)){
				$action .= '		<a class="dropdown-item waves-effect waves-light" href="#" data-toggle="modal" data-target="#back_disponibilita'.$row['Id'].'"><i class="fa fa-send text-orange"></i> Invia Email per ritorno della Disponibilità</a>
									<div class="dropdown-divider"></div>';
				}else{
					$action .= '	<a class="dropdown-item waves-effect waves-light">Il cliente è stato ricontattato in data '.$fun->gira_data($DataReContact).'</a>
									<div class="dropdown-divider"></div>';
				}
			}
				$action .= '		<a class="dropdown-item waves-effect waves-light" href="javascript:validator_ri_abilita(\''.BASE_URL_SITO.'ri_abilita_annullate/'.$row['Id'].'\');" title="Ri Abilita"><i class="fa fa-repeat fa-2x fa-fw" aria-hidden="true"></i> Ri Abilita</a>
								</div>
							</div>';
				$modalD = '<div class="modal fade" id="back_disponibilita'.$row['Id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLongTitle">Contenuto e-mail per tornata disponibilità</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body text-left">
											<iframe height="650px" width="100%" frameborder="0" scrolling="no" allowtransparency="true" src="'.BASE_URL_SITO.'back_disponibile/'.$row['Id'].'/"></iframe>
										</div>
									</div>
								</div>
							</div>'."\r\n";

							if (strstr($row['MultiStruttura'], '?')) {

								$multi_ = explode('?', $row['MultiStruttura']);
								$multi = $multi_[1];

								if (strstr($multi, '&')) {
									$multi_ = explode('&', $row['MultiStruttura']);
									$multi = $multi_[1];
								} else {
									$multi = $row['MultiStruttura'];
								}

								if (strstr($multi, '=')) {
									$multi_ = explode('=', $row['MultiStruttura']);
									$multi = $multi_[1];
								} else {
									$multi = $row['MultiStruttura'];
								}

							} elseif (strstr($row['MultiStruttura'], '&')) {

								$multi_ = explode('&', $row['MultiStruttura']);
								$multi = $multi_[1];

								if (strstr($multi, '?')) {
									$multi_ = explode('&', $row['MultiStruttura']);
									$multi = $multi_[1];
								} else {
									$multi = $row['MultiStruttura'];
								}

								if (strstr($multi, '=')) {
									$multi_ = explode('=', $row['MultiStruttura']);
									$multi = $multi_[1];
								} else {
									$multi = $row['MultiStruttura'];
								}

							} else {

								$multi = $row['MultiStruttura'];

							}

							if (strstr($row['MultiStruttura'], 'captcha=error')) {
								$multi_ = explode('?', $row['MultiStruttura']);
								$multi = $multi_[0];
							}

							switch ($row['FontePrenotazione']) {

								case 'Sito Web':

									$bg_fonte = '<label class="badge badge-default bg-warning f-12">
												<a href="javascript:;" class="f-12 text-white" data-toggle="modal" data-target="#referer' . $row['Id'] . '" id="openIframe' . $row['Id'] . '" title="Percorso referer">
												' . $row['FontePrenotazione'] . ' /Landing
												</a>
											</label>' . ($row['MultiStruttura'] != '' ? '<div class="clearfix"></div><span class="f-10">' . (strlen($multi) <= 30 ? $multi : substr($multi, 0, 30) . '...') . '</span>' : '') . '
											<div class="modal fade" id="referer' . $row['Id'] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
												<div class="modal-dialog" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title text-black" id="exampleModalLabel">Percorso di provenienza dettagliato!</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
															<iframe id="iframe' . $row['Id'] . '" height="30px" width="100%" frameborder="0" scrolling="no" allowtransparency="true" src=""></iframe>
														</div>
													</div>
												</div>
											</div>
											<script>
											$( document ).ready(function() {
												$("#openIframe' . $row['Id'] . '").on("click",function(){
													$("#iframe' . $row['Id'] . '").attr("src","https://' . $_SERVER['HTTP_HOST'] . '/referer_utm/' . $row['NumeroPrenotazione'] . '/");
												});
											});
											</script>';
									break;

								case $row['FontePrenotazione']:
										$bg_fonte = '<label class="badge badge-default bg-success f-11">' . $row['FontePrenotazione'] . '</label>';
									break;
								case '':
										$bg_fonte = '<label class="badge badge-inverse-danger f-10">Da impostare</label>';
									break;
							}

							if ($row['TipoVacanza']) {
								$array_value = explode(",", $row['TipoVacanza']);
								$bg_tipo = '';
								if (is_array($array_value)) {
									foreach ($array_value as $key => $val) {
										$bg_tipo .= '<label class="badge badge-default bg-info f-11 text-left">' . $val . '</label><div class="clearfix"></div>';
									}
								} else {
									$bg_tipo = '<label class="badge badge-default bg-info f-11 text-left">' . $row['TipoVacanza'] . '</label>';
								}

							} else {
								$bg_tipo = '<label class="badge badge-inverse-danger f-10">Da impostare</label>';
							}

							if ($row['DataInvio']) {
								$value = date('d-m-Y', strtotime($row['DataInvio']));
								$get_invio        =  '<span class="nowrap f-12">' . $value . ($row['MetodoInvio'] != '' ? '<br /><small>Tramite: ' . $row['MetodoInvio'] . '</small>' : '') . '</span>';
							} else {
								$get_invio        =  '<label class="badge badge-inverse-danger f-10">Da Inviare</label>';
							}

							$conta_click   = '<script>
													$(function(){
														conta_click('.$row['Id'].','.$row['idsito'].',"'.($row['DataInvio']==''?'null':$row['DataInvio']).'","'.($row['DataScadenza']==''?'null':$row['DataScadenza']).'");
													})
												</script>
												<div id="conta_click_pre'.$row['Id'].'"></div>
												<div id="conta_click'.$row['Id'].'"></div>';
							$motivazione_conferme_annullate   = '<script>
													$(function(){
														motivazione_conferme_annullate('.$row['Id'].','.$row['idsito'].');
													})
												</script>
												<div id="motivazione_conferme_annullate_pre'.$row['Id'].'"></div>
												<div id="motivazione_conferme_annullate'.$row['Id'].'"></div>';

							$data[] = array(

                                        "nr"             => $row['NumeroPrenotazione'],
                                        "richiesta"      => $TipoRichiesta,
                                        "fonte"          => $bg_fonte,
                                        "tipo"           => $bg_tipo,
                                        "cliente"        => '<b>'.stripslashes($row['Nome']).' '.stripslashes($row['Cognome']).'</b>',
                                        "email"          => $row['Email'],
                                        "lingua"         => '<img src="'.BASE_URL_SITO.'img/flags/'.$row['Lingua'].'.png" class="image_flag">',
                                        "arrivo"         => gira_data($row['DataArrivo']),
                                        "partenza"       => gira_data($row['DataPartenza']),
                                        "riepilogo"      => $riepilogoModal,
                                        "invio"          => $get_invio,
								        "aperto"         => $conta_click,
                                        "check"          => $fun->check_no_disponibilita($row['Id'],$row['TipoRichiesta'],$row['idsito']),
                                        "motivo"         => $motivazione_conferme_annullate,
                                        "action"         => $modalD .$action

							);

	}

 	$json_data = array(
						"draw"            => 1,
						"recordsTotal"    => sizeof($rec) ,
						"recordsFiltered" => sizeof($rec),
						"data" 			  => $data
						);



if(empty($json_data) || is_null($json_data)){
	$json_data = NULL;
}else{
	$json_data = json_encode($json_data);
}
	  echo $json_data;

#######################################################################################################################

?>
