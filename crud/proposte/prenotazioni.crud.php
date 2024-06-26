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
	$directory        = '';
	$linkPreview      = '';
	$grafica          = '';
	$chek_l_t         = '';
	$check            = '';
	$pagina_corrente  = $_REQUEST['pagina_corrente'];
	$righe_per_pagina = $_REQUEST['righe_per_pagina'];
	$prima_riga       = ($pagina_corrente - 1) * $righe_per_pagina;

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
									hospitality_guest.TipoRichiesta = 'Conferma'
								AND 
									hospitality_guest.Archivia = 0
								AND 
									hospitality_guest.Chiuso = 1
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
        if($_REQUEST['TipoRichiesta']!=''){
          if($_REQUEST['TipoRichiesta']=='Preventivo'){
              $andSelect  .= " AND hospitality_guest.TipoRichiesta =  '".$_REQUEST['TipoRichiesta']."'";
          }elseif($_REQUEST['TipoRichiesta']=='Conferma'){
              $andSelect  .= " AND hospitality_guest.TipoRichiesta =  '".$_REQUEST['TipoRichiesta']."'";
              $andSelect  .= " AND hospitality_guest.Chiuso =  0";
          }elseif($_REQUEST['TipoRichiesta']=='ConfermaC'){
              $andSelect  .= " AND hospitality_guest.TipoRichiesta =  'Conferma'";
              $andSelect  .= " AND hospitality_guest.Chiuso =  1";
          }
        }

		if($_REQUEST['TipoSoggiorno']!='' && $_REQUEST['TipoCamere']==''){
			$join      = " INNER JOIN hospitality_richiesta ON hospitality_richiesta.id_richiesta = hospitality_guest.Id";
			$andSelect .= " AND hospitality_richiesta.TipoSoggiorno =  ".$_REQUEST['TipoSoggiorno']."";
		}
        if($_REQUEST['TipoCamere']!='' && $_REQUEST['TipoSoggiorno']==''){
            $join        = " INNER JOIN hospitality_richiesta ON hospitality_richiesta.id_richiesta = hospitality_guest.Id";
            $andSelect  .= " AND hospitality_richiesta.TipoCamere = ".$_REQUEST['TipoCamere']."";
        }
		if($_REQUEST['TipoCamere']!='' && $_REQUEST['TipoSoggiorno']!=''){
            $join        = " INNER JOIN hospitality_richiesta ON hospitality_richiesta.id_richiesta = hospitality_guest.Id";
            $andSelect  .= " AND hospitality_richiesta.TipoCamere = ".$_REQUEST['TipoCamere']."";
			$andSelect  .= " AND hospitality_richiesta.TipoSoggiorno =  ".$_REQUEST['TipoSoggiorno']."";
        }
		if($_REQUEST['NumeroPrenotazione']!=''){
			$andSelect  .= " AND hospitality_guest.NumeroPrenotazione = ".$_REQUEST['NumeroPrenotazione']."";
		}
		if($_REQUEST['Operatore']!=''){
			$andSelect  .= " AND hospitality_guest.ChiPrenota = '".$_REQUEST['Operatore']."'";
		}
        if($_REQUEST['Lingua']!=''){
            $andSelect  .= " AND hospitality_guest.Lingua =  '".$_REQUEST['Lingua']."'";
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
        if($_REQUEST['Chiuso']!=''){
            $andSelect  .= " AND hospitality_guest.Chiuso =  ".$_REQUEST['Chiuso']."";
        }
        if($_REQUEST['Disdetta']!=''){
            $andSelect  .= " AND hospitality_guest.Disdetta =  ".$_REQUEST['Disdetta']."";
        }
        if($_REQUEST['CS_inviato']!=''){
            $andSelect  .= " AND hospitality_guest.CS_inviato =  ".$_REQUEST['CS_inviato']."";
        }
        if($_REQUEST['IdMotivazione']!=''){
          $andSelect  .= " AND hospitality_guest.IdMotivazione =  ".$_REQUEST['IdMotivazione']."";
        }
        if($_REQUEST['NoDisponibilita']!=''){
          $andSelect  .= " AND hospitality_guest.NoDisponibilita =  ".$_REQUEST['NoDisponibilita']."";
        }
        if($_REQUEST['CheckConsensoPrivacy']!=''){
            $andSelect  .= " AND hospitality_guest.CheckConsensoPrivacy =  ".$_REQUEST['CheckConsensoPrivacy']."";
        }
        if($_REQUEST['CheckConsensoMarketing']!=''){
            $andSelect  .= " AND hospitality_guest.CheckConsensoMarketing =  ".$_REQUEST['CheckConsensoMarketing']."";
        }
        if($_REQUEST['Archivia']!=''){
            $andSelect  .= " AND hospitality_guest.Archivia =  ".$_REQUEST['Archivia']."";
        }
        if($_REQUEST['Hidden']!=''){
            $andSelect  .= " AND hospitality_guest.Hidden =  ".$_REQUEST['Hidden']."";
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
		if($_REQUEST['Arrivo_dal']!='' && $_REQUEST['Arrivo_al'] ==''){
			$andSelect  .= " AND hospitality_guest.DataArrivo >= '".$_REQUEST['Arrivo_dal']."'";
		}
		if($_REQUEST['Arrivo_dal']!='' && $_REQUEST['Arrivo_al'] !=''){
			$andSelect  .= " AND hospitality_guest.DataArrivo >= '".$_REQUEST['Arrivo_dal']."' AND hospitality_guest.DataArrivo <= '".$_REQUEST['Arrivo_al']."'";
		}
		if($_REQUEST['DataPrenotazione_dal']!='' && $_REQUEST['DataPrenotazione_al'] ==''){
			$andSelect  .= " AND hospitality_guest.DataArrivo >= '".$_REQUEST['DataPrenotazione_dal']."'";
		}
		if($_REQUEST['DataPrenotazione_dal']!='' && $_REQUEST['DataPrenotazione_al'] !=''){
			$andSelect  .= " AND hospitality_guest.DataChiuso >= '".$_REQUEST['DataPrenotazione_dal']."' AND hospitality_guest.DataChiuso <= '".$_REQUEST['DataPrenotazione_al']."'";
		}	


	}


$check_pms5 = $fun->check_5stelle_pms($_REQUEST['idsito']);
$check_pmsB = $fun->check_bedzzlePMS($_REQUEST['idsito']);
$check_pmsE = $fun->check_ericsoftpms($_REQUEST['idsito']);

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
					hospitality_guest.TipoRichiesta = 'Conferma'  
				AND 
					hospitality_guest.Hidden = 0 
				AND 
					hospitality_guest.Archivia = 0 
				AND 
					hospitality_guest.Disdetta = 0 					
				AND 
					hospitality_guest.Chiuso = 1 
                AND 
                    (hospitality_guest.IdMotivazione IS NULL OR hospitality_guest.DataRiconferma IS NOT NULL)
                AND 
                    hospitality_guest.CheckinOnlineClient = 0
				AND 
					hospitality_guest.NoDisponibilita = 0
				".$andSelect ." 
				".$andSelectFilter." 
				".$andSelectFilterCampagn." ";
// ## LIMITARE LE RIGHE SE IL JSON NON RIESCE A CARICARE TUTTE LE ROWS ##
if($checkNumberPrev == 1){
	$select .= " AND
					(hospitality_guest.DataRichiesta >= '".$anno_precedente."' OR hospitality_guest.DataChiuso >= '".$anno_precedente."')";
} 				
	$select .= " ORDER BY
					hospitality_guest.DataChiuso
				DESC ";

if($pagina_corrente!='' && $righe_per_pagina!=''){
	$select .=" LIMIT ".$prima_riga.", ".$righe_per_pagina."";
}
	$rec = $dbMysqli->query($select);


	
	foreach($rec as $key => $row){


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
							//$func_chat_column   =  $fun->func_chat_column($row['NumeroPrenotazione'],$row['DataInvio'],$row['DataScadenza'],$row['DataChiuso'],$row['DataArrivo'],$row['idsito'],$row['Id'],'prenotazioni');
 							$func_chat_column   = '	<script>
														$(function(){
															func_chat_column('.$row['NumeroPrenotazione'].',"'.($row['DataInvio']==''?'null':$row['DataInvio']).'","'.($row['DataScadenza']==''?'null':$row['DataScadenza']).'","'.($row['DataChiuso']==''?'null':urlencode($row['DataChiuso'])).'","'.($row['DataArrivo']==''?'null':$row['DataArrivo']).'",'.$row['idsito'].','.$row['Id'].',"prenotazioni");
														})													
													</script>
													<div id="func_chat_column_pre'.$row['Id'].'"></div>
													<div id="func_chat_column'.$row['Id'].'"></div>';  


							$DataArrivo   = $fun->get_data_arrivo_conferma($row['DataArrivo'],$row['Id']);
							$DataPartenza = $fun->get_data_partenza_conferma($row['DataPartenza'],$row['Id']);

							if($check_pms5==1){
								$buttonPMS = $fun->buottonPms5Stelle($row['Id'],$row['idsito'],'prenotazioni');
							}
							if($check_pmsE==1){
								$buttonPMS = $fun->buottonPmsEricsoft($row['Id'],$row['idsito'],'prenotazioni');
							}
							if($check_pmsB==1){
								$buttonPMS = $fun->buottonPmsBedzzle($row['Id'],$row['idsito'],'prenotazioni');
							}							
							if($row['CS_inviato']==1){
								$ico_quest = '<li><i class="fa fa-star text-info" data-toggle="tooltip" title="Questionario Inviato"></i></li>';
							}else{
								$ico_quest = '';
							}
							if($row['CheckinInviato']==1){
								$ico_check = '<li><i class="fa fa-vcard text-light-blue" data-toggle="tooltip" title="Modulo Check-In Online inviato"></i></li>';
							}else{
								$ico_check = '';
							}
							if($row['Voucher_send']==1){
								$ico_vouch = '<li><i class="fa fa-ticket text-purple" data-toggle="tooltip" title="Voucher Prenotazione inviato"></i></li>';
							}else{
								$ico_vouch = '';
							}
							if($fun->check_email_upselling($row['Id'],$row['idsito'])!=''){
								$ico_benve = '<li>'.$fun->check_email_upselling($row['Id'],$row['idsito']).'</li>';
							}else{
								$ico_benve = '';
							}
							if($fun->check_email_precheckin($row['Id'],$row['idsito'])!=''){
								$ico_preCheck = '<li>'.$fun->check_email_precheckin($row['Id'],$row['idsito']).'</li>';
							}else{
								$ico_preCheck = '';
							}
							if($row['IdMotivazione']!=''){
								$ico_rebuonoV = '<li><i  class="fa fa-tag blink text-green" data-toogle="tooltip" title="Questa prenotazione proviene da un Buono Voucher ri-confermato dopo variazione delle date soggiorno!"></i></li>';
							}else{
								$ico_rebuonoV = '';
							} 
							if($row['recensione_inviata']==1){
								$tipo       = $fun->tipoRecensioneImpostata($row['idsito']);
								$ico_recens = '<li><i class="fa fa-tripadvisor text-green" data-toogle="tooltip" data-html="true" title="Richiesta di recensione '.$tipo.' su TripAdvisor inviata!"></i></li>';
							}else{
								$ico_recens = '';
							}
							$check = '	<ul class="check"><li>'.$fun->func_cc($row['Id'],$row['idsito']).'</li>'.$ico_benve.$ico_preCheck.$ico_recens.$ico_rebuonoV.$ico_quest.$ico_check.$ico_vouch.'</ul>';

							if($check_pms5==1 || $check_pmsB==1 || $check_pmsE==1){ 
								$data[] = array(
									"DT_RowId"       => 'row_'.$row['Id'],
									"id"             => '<input type="checkbox" value="'.$row['Id'].'" name="Id" id="riga'.$row['Id'].'" class="seleziona">',
									"op"             => $get_operatore,																		
									"nr"             => '<a href="'.BASE_URL_SITO.'timeline/'.$row['NumeroPrenotazione'].'" class="f-12" title="Timeline"  data-toogle="tooltip">'.$row['NumeroPrenotazione'].'</a>',
									"fonte"          => $bg_fonte,
									"tipo"           => $bg_tipo,
									"data"           => '<span class="ordinamento">'.$row['DataRichiesta'].'</span>'.$fun->gira_data($row['DataRichiesta']),
									"cliente"        => '<b>'.stripslashes($row['Nome']).' '.stripslashes($row['Cognome']).'</b>',
									"email"          => '<i class="fa fa-envelope fa-fw cursore" data-toogle="tooltip" title="'.$row['Email'].'"></i>',
									"lingua"         => '<img src="'.BASE_URL_SITO.'img/flags/'.$row['Lingua'].'.png" class="image_flag">',
									"arrivo"         => '<span class="ordinamento">'.$row['DataArrivo'].'</span>'.$DataArrivo,
									"partenza"       => '<span class="ordinamento">'.$row['DataPartenza'].'</span>'.$DataPartenza,
									"a"              => $row['NumeroAdulti'],
									"b"              => $row['NumeroBambini'],
									"chat"           => $func_chat_column,
									"data_chiuso"    => '<span class="ordinamento">'.$row['DataChiuso'].'</span>'.$fun->gira_data($row['DataChiuso']),
									"check"          => $check,
									"pms"            => $buttonPMS,
									"action"         => '<a href="#" data-toogle="tooltip" title="Apri Azioni" onclick="get_content_update('.$row['Id'].')" class="selRow"><i class="fa fa-angle-double-up fa-2x fa-fw"></i></a>'

								);
							}else{
								$data[] = array(
									"DT_RowId"       => 'row_'.$row['Id'],
									"id"             => '<input type="checkbox" value="'.$row['Id'].'" name="Id" id="riga'.$row['Id'].'" class="seleziona">',
									"op"             => $get_operatore,																		
									"nr"             => '<a href="'.BASE_URL_SITO.'timeline/'.$row['NumeroPrenotazione'].'" class="f-12" title="Timeline"  data-toogle="tooltip">'.$row['NumeroPrenotazione'].'</a>',
									"fonte"          => $bg_fonte,
									"tipo"           => $bg_tipo,
									"data"           => '<span class="ordinamento">'.$row['DataRichiesta'].'</span>'.$fun->gira_data($row['DataRichiesta']),
									"cliente"        => '<b>'.stripslashes($row['Nome']).' '.stripslashes($row['Cognome']).'</b>',
									"email"          => '<i class="fa fa-envelope fa-fw cursore" data-toogle="tooltip" title="'.$row['Email'].'"></i>',
									"lingua"         => '<img src="'.BASE_URL_SITO.'img/flags/'.$row['Lingua'].'.png" class="image_flag">',
									"arrivo"         => '<span class="ordinamento">'.$row['DataArrivo'].'</span>'.$DataArrivo,
									"partenza"       => '<span class="ordinamento">'.$row['DataPartenza'].'</span>'.$DataPartenza,
									"a"              => $row['NumeroAdulti'],
									"b"              => $row['NumeroBambini'],
									"chat"           => $func_chat_column,
									"data_chiuso"    => '<span class="ordinamento">'.$row['DataChiuso'].'</span>'.$fun->gira_data($row['DataChiuso']),
									"check"          => $check,
									"action"         => '<a href="#" data-toogle="tooltip" title="Apri Azioni" onclick="get_content_update('.$row['Id'].')" class="selRow"><i class="fa fa-angle-double-up fa-2x fa-fw"></i></a>'

								);							
							}

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

?>
