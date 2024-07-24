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
close_session();
include($_SERVER['DOCUMENT_ROOT']."/include/function.inc.php");

	$data             = array();
	$directory        = '';
	$linkPreview      = '';
	$grafica          = '';
	$chek_l_t         = '';
	$pagina_corrente  = $_REQUEST['pagina_corrente'];
	$righe_per_pagina = $_REQUEST['righe_per_pagina'];
	$righe_per_pagina = $_REQUEST['righe_per_pagina'];
	$prima_riga       = ($pagina_corrente - 1) * $righe_per_pagina;

	if($_REQUEST['chat']=='last_contact'){

		$sel = "SELECT
						hospitality_guest.Id as id_guest
					FROM
						hospitality_chat_notify
					INNER JOIN
						hospitality_guest ON hospitality_guest.NumeroPrenotazione = hospitality_chat_notify.NumeroPrenotazione
					WHERE
						hospitality_chat_notify.idsito = ".$_REQUEST['idsito']."
					AND
						hospitality_guest.idsito = ".$_REQUEST['idsito']."
					AND
						hospitality_guest.TipoRichiesta = 'Preventivo'
					AND
						hospitality_guest.Hidden = 0
					AND
						hospitality_guest.Archivia = 0
					AND
						hospitality_guest.Chiuso = 0
					AND
						hospitality_guest.Accettato = 0
					AND
						hospitality_guest.NoDisponibilita = 0
					GROUP BY
						hospitality_chat_notify.NumeroPrenotazione
					ORDER by
						hospitality_chat_notify.NumeroPrenotazione DESC";
		$array_id  = $dbMysqli->query($sel);

		if(sizeof($array_id)>0){
			foreach ($array_id as $key => $value) {
				if($value['operator']==0){
					$lista_id_[] = $value['id_guest'];
				}
			}
 			if(empty($lista_id_)  || is_null($lista_id_)){
				$lista_id_[] = 0;
			}
			$andSelectFilterLast = " AND hospitality_guest.Id IN (".implode(",",$lista_id_).")";
		}

	}

    if($_REQUEST['action']=='unique_filter'){

        if($_REQUEST['Aperture']!=''){

            $lista_id_     = array();
            $lista_id_full = array();
            $lista_id      = array();
            $aperture      = '';

            if($_REQUEST['Aperture'] == 0){

                $sel = "SELECT hospitality_guest.Id,hospitality_guest.DataRichiesta,COUNT(hospitality_traccia_email.Id) as conteggio
                            FROM
                                hospitality_guest
                            RIGHT OUTER JOIN
                                hospitality_traccia_email ON hospitality_traccia_email.IdRichiesta = hospitality_guest.Id
                            WHERE hospitality_guest.idsito = ".$_REQUEST['idsito']."
                                AND hospitality_guest.TipoRichiesta = 'Preventivo'
                                AND hospitality_guest.Archivia = 0
                                AND hospitality_guest.Chiuso = 0
                                AND hospitality_guest.Accettato = 0
                            GROUP BY hospitality_traccia_email.IdRichiesta";
                $array_id  = $dbMysqli->query($sel);

                if(sizeof($array_id)>0){
                    foreach ($array_id as $key => $value) {

                        $aperture = $value['conteggio'];

                        if($aperture!= 0){
                            $lista_id_[] = $value['Id'];
                        }
                    }
                }


                $sel2 = "SELECT hospitality_guest.Id,hospitality_guest.DataRichiesta
                            FROM
                                hospitality_guest
                            WHERE hospitality_guest.idsito = ".$_REQUEST['idsito']."
                                AND hospitality_guest.TipoRichiesta = 'Preventivo'
                                AND hospitality_guest.Archivia = 0
                                AND hospitality_guest.Chiuso = 0
                                AND hospitality_guest.Accettato = 0";
                $array_id2   = $dbMysqli->query($sel2);

                if(sizeof($array_id2)>0){
                    foreach ($array_id2 as $ky => $val) {
                        $lista_id_full[] = $val['Id'];
                    }
                }
                $lista_id = array_diff($lista_id_full,$lista_id_);

            }
            if($_REQUEST['Aperture'] == 1){

                $sel = "SELECT hospitality_guest.Id,hospitality_guest.DataRichiesta, COUNT(hospitality_traccia_email.Id) as conteggio
                            FROM
                            hospitality_guest
                            LEFT JOIN
                            hospitality_traccia_email ON hospitality_traccia_email.IdRichiesta = hospitality_guest.Id
                            WHERE hospitality_guest.idsito = ".$_REQUEST['idsito']."
                            AND hospitality_guest.TipoRichiesta = 'Preventivo'
                            AND hospitality_guest.Archivia = 0
                            AND hospitality_guest.Chiuso = 0
                            AND hospitality_guest.Accettato = 0
                            GROUP BY hospitality_traccia_email.IdRichiesta";
                $array_id   = $dbMysqli->query($sel);

                if(sizeof($array_id)>0){
                    foreach ($array_id as $key => $value) {

                        $aperture = $value['conteggio'];

                        if($aperture!= 0){
                            $lista_id[] = $value['Id'];
                        }
                    }
                }
            }
            if(empty($lista_id)  || is_null($lista_id)){
                $lista_id[] = 0;
            }
            $andSelectFilter = " AND hospitality_guest.Id IN (".implode(",",$lista_id).")";


        }
    }


	if($_REQUEST['TipoSoggiorno']!=''){
		$join      = "INNER JOIN hospitality_richiesta ON hospitality_richiesta.id_richiesta = hospitality_guest.Id";
		$andSelect = " AND hospitality_richiesta.TipoSoggiorno =  '".$_REQUEST['TipoSoggiorno']."'";
	}
	 /* ! SE IL PERMESSO E' IMPOSTATO LE RICHIESTE VENGONO FILTRATE PER OPERATORE */
    $permessi_unique = $fun->check_permessi();
    if($permessi_unique['UNIQUE']==1){
        $andSelect .= " AND hospitality_guest.ChiPrenota =  '".$_SESSION['NOMEUTENTEACCESSI']."'";
    }

	if($_REQUEST['action']=='search'){

		if($_REQUEST['campagna']!=''){
					$select = " SELECT
									hospitality_guest.Id
								FROM
									hospitality_guest
								INNER JOIN
									hospitality_utm_ads ON hospitality_utm_ads.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione
								WHERE
									hospitality_guest.idsito = ".$_REQUEST['idsito']."
								AND
									hospitality_guest.TipoRichiesta = 'Preventivo'
								AND
									hospitality_guest.Archivia = 0
								AND
									hospitality_guest.Chiuso = 0
								AND
									hospitality_guest.Accettato = 0
								AND
									hospitality_guest.FontePrenotazione = 'Sito Web'
								AND
									hospitality_utm_ads.idsito = ".$_REQUEST['idsito']."
								AND
									hospitality_utm_ads.utm_source = '".$_REQUEST['campagna']."'";
				$array_id  = $dbMysqli->query($select);
				if(sizeof($array_id)>0){
					foreach ($array_id as $key => $value) {
							$lista_id[] = $value['Id'];

					}
				}
			if(empty($lista_id)  || is_null($lista_id)){
				$lista_id[] = 0;
			}

			$andSelectFilterCampagn = " AND hospitality_guest.Id IN (".implode(",",$lista_id).")";
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
		if($_REQUEST['Inviata']!= ''){
			if($_REQUEST['Inviata']== 'NO'){
				$andSelect  .= " AND hospitality_guest.Inviata is Null AND DataInvio is Null";
			}else{
				$andSelect  .= " AND hospitality_guest.Inviata is not Null AND DataInvio is not Null";
			}
		}
	}

	$anno_precendente_ = mktime(0, 0, 0, '06', '01', (date('Y')-1));
	$anno_precedente   = date('Y-m-d', $anno_precendente_);
	$checkNumberPrev = $fun->checkNumberRows($_REQUEST['idsito']);

	# QUERY PER COMPILARE IL DATATABLE
	$select  = "SELECT
					hospitality_guest.*
				FROM
					hospitality_guest
				".$join."
				WHERE
					hospitality_guest.idsito = ".$_REQUEST['idsito']."
				AND
					hospitality_guest.TipoRichiesta = 'Preventivo'
				AND
					hospitality_guest.Hidden = 0
				AND
					hospitality_guest.Archivia = 0
				AND
					hospitality_guest.Chiuso = 0
				AND
					hospitality_guest.Accettato = 0
				AND
					hospitality_guest.NoDisponibilita = 0
				".$andSelect ."
				".$andSelectFilter."
				".$andSelectFilterCampagn."
				".$andSelectFilterLast." ";

	// ## LIMITARE LE RIGHE SE IL JSON NON RIESCE A CARICARE TUTTE LE ROWS ##
 	if($checkNumberPrev == 1){
		$select .= "AND
						hospitality_guest.DataRichiesta >= '".$anno_precedente."' ";
	}

	$select .= "ORDER BY
					hospitality_guest.DataRichiesta
				DESC ";
if(!$_REQUEST['action']){
	if($pagina_corrente!='' && $righe_per_pagina!=''){
		$select .=" LIMIT ".$prima_riga.", ".$righe_per_pagina."";
	}
}
	$rec = $dbMysqli->query($select);

	$giorno_scad      = '';
	$get_operatore    = '';
	$bg_fonte         = '';
	$bg_tipo          = '';
	$dataRichiesta    = '';
	$arrivo           = '';
	$partenza         = '';
	$get_invio        = '';
	$check_proposta   = '';
	$conta_click      = '';
	$func_chat_column = '';
	$DataScadenza     = '';
	$utenti_online    = '';
	$re_email_call    = '';
	$gia_presente     = '';

	foreach($rec as $key => $row){



/* 							$giorno_scad      = '<span class = "f-10">- '.$fun->dateDiff(date('Y-m-d'),$row['DataScadenza'],"%a").' gg. alla scadenza</span>';
							$get_operatore    = $fun->get_operatore($row['ChiPrenota'],$row['idsito']);
							$bg_fonte         = $fun->bg_fonte($row['Id']);
							$bg_tipo          = $fun->bg_tipo($row['TipoVacanza']);
							$dataRichiesta    = $fun->gira_data($row['DataRichiesta']);
							$arrivo           = $fun->gira_data($row['DataArrivo']);
							$partenza         = $fun->gira_data($row['DataPartenza']);
							$get_invio        = $fun->get_invio($row['DataInvio'],$row['Id']);
							$check_proposta   = $fun->check_proposta($row['NumeroPrenotazione'],$row['idsito']);
							$conta_click      = $fun->conta_click($row['Id'],$row['idsito'],$row['DataInvio'],$row['DataScadenza']);
							$func_chat_column = $fun->func_chat_column($row['NumeroPrenotazione'],$row['DataInvio'],$row['DataScadenza'],$row['DataChiuso'],$row['DataArrivo'],$row['idsito'],$row['Id'],'preventivi');
							$DataScadenza     = $fun->gira_data($row['DataScadenza']);
							$utenti_online    = $fun->utenti_online($row['idsito'],$row['Id']);
							$re_email_call    = $fun->re_email_call($row['Id'],$row['idsito']); */
							$giorno_scad      = '<span class="f-10">- '.$fun->dateDiff(date('Y-m-d'),$row['DataScadenza'],"%a").' gg. alla scadenza</span>';
							$dataRichiesta    = $fun->gira_data($row['DataRichiesta']);
							$arrivo           = $fun->gira_data($row['DataArrivo']);
							$partenza         = $fun->gira_data($row['DataPartenza']);
							$DataScadenza     = ($row['DataScadenza']!=''?$fun->gira_data($row['DataScadenza']):'');


							$get_operatore   = '<script>
													$(function(){
														get_operatore("'.($row['ChiPrenota']==''?'null':urlencode($row['ChiPrenota'])).'",'.$row['idsito'].','.$row['Id'].');
													})
												</script>
												<div id="get_operatore_pre'.$row['Id'].'"></div>
												<div id="get_operatore'.$row['Id'].'"></div>';

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

							$check_proposta   = '<script>
													$(function(){
														check_proposta('.$row['NumeroPrenotazione'].','.$row['idsito'].');
													})
												</script>
												<div id="check_proposta_pre'.$row['NumeroPrenotazione'].'"></div>
												<div id="check_proposta'.$row['NumeroPrenotazione'].'"></div>';

							$conta_click   = '<script>
													$(function(){
														conta_click('.$row['Id'].','.$row['idsito'].',"'.($row['DataInvio']==''?'null':$row['DataInvio']).'","'.($row['DataScadenza']==''?'null':$row['DataScadenza']).'");
													})
												</script>
												<div id="conta_click_pre'.$row['Id'].'"></div>
												<div id="conta_click'.$row['Id'].'"></div>';


 							$func_chat_column   = '	<script>
													$(function(){
														func_chat_column('.$row['NumeroPrenotazione'].',"'.($row['DataInvio']==''?'null':$row['DataInvio']).'","'.($row['DataScadenza']==''?'null':$row['DataScadenza']).'","'.($row['DataChiuso']==''?'null':$row['DataChiuso']).'","'.($row['DataArrivo']==''?'null':$row['DataArrivo']).'",'.$row['idsito'].','.$row['Id'].',"preventivi");
													})
												</script>
												<div id="func_chat_column_pre'.$row['Id'].'"></div>
												<div id="func_chat_column'.$row['Id'].'"></div>';

							$utenti_online   = '<script>
													$(function(){
														utenti_online('.$row['idsito'].','.$row['Id'].');
													})
												</script>
												<div id="utenti_online_pre'.$row['Id'].'"></div>
												<div id="utenti_online'.$row['Id'].'"></div>';


							$re_email_call   = '<script>
													$(function(){
														re_email_call('.$row['Id'].','.$row['idsito'].');
													})
												</script>
												<div id="re_email_call_pre'.$row['Id'].'"></div>
												<div id="re_email_call'.$row['Id'].'"></div>';

							$gia_presente   = '<script>
													$(function(){
														gia_presente('.$row['Id'].','.$row['idsito'].',"'.($row['Nome']==''?'null':urlencode($row['Nome'])).'","'.($row['Cognome']==''?'null':urlencode($row['Cognome'])).'","'.($row['Email']==''?'null':$row['Email']).'");
													})
												</script>
												<!--<span id="gia_presente_pre'.$row['Id'].'"></span>-->
												<span id="gia_presente'.$row['Id'].'"></span>';

							$data[] = array(
								"DT_RowId"       => 'row_'.$row['Id'],
								"id"             => '<input type="checkbox" value="'.$row['Id'].'" name="Id" id="riga'.$row['Id'].'" class="seleziona">',
								"op"             => $get_operatore,
								"nr"             => '<a href="'.BASE_URL_SITO.'timeline/'.$row['NumeroPrenotazione'].'" class="f-12" title="Timeline"  data-toogle="tooltip">'.$row['NumeroPrenotazione'].'</a>',
								"fonte"          => $bg_fonte,
								"tipo"           => $bg_tipo,
								"data"           => '<span class="ordinamento">'.$row['DataRichiesta'].'</span>'.$dataRichiesta,
								"cliente"        => '<b>'.stripslashes($row['Nome']).' '.stripslashes($row['Cognome']).'</b>'.$gia_presente,
								"email"          => '<i class="fa fa-envelope fa-fw cursore" data-toogle="tooltip" title="'.$row['Email'].'"></i>',
								"lingua"         => '<img src="'.BASE_URL_SITO.'img/flags/'.$row['Lingua'].'.png" class="image_flag">',
								"arrivo"         => '<span class="ordinamento">'.$row['DataArrivo'].'</span>'.$arrivo,
								"partenza"       => '<span class="ordinamento">'.$row['DataPartenza'].'</span>'.$partenza,
								"a"              => $row['NumeroAdulti'],
								"b"              => $row['NumeroBambini'],
								"invio"          => $get_invio.'<br>'.($check_proposta==false?'<label class="badge badge-inverse-danger f-10">Da completare</label>':''),
								"aperto"         => $conta_click,
								"chat"           => $func_chat_column,
								"scadenza"       => '<span class="ordinamento">'.$row['DataScadenza'].'</span>'.($row['DataScadenza'] < date('Y-m-d')?'<span class="text-gray">'.$DataScadenza.'</span>':$DataScadenza.'<br>'.$giorno_scad),
								"recall"         => '<ul class="check"><li>'.$utenti_online.'</li><li>'.$re_email_call.'</li></ul>',
								"action"         => '<a href="#" data-toogle="tooltip" title="Apri Azioni" onclick="get_content_update('.$row['Id'].')" class="selRow"><i class="fa fa-angle-double-up fa-2x fa-fw"></i></a>'

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

