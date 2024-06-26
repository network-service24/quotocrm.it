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

		if($_REQUEST['TipoSoggiorno']!=''){
			$join      = " INNER JOIN hospitality_richiesta ON hospitality_richiesta.id_richiesta = hospitality_guest.Id";
			$andSelect .= " AND hospitality_richiesta.TipoSoggiorno =  ".$_REQUEST['TipoSoggiorno']."";
		}
		if($_REQUEST['TipoCamere']!=''){
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
		if($_REQUEST['Email']!=''){
			$andSelect  .= " AND hospitality_guest.Email = '".$_REQUEST['Email']."'";
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
	# QUERY PER COMPILARE IL DATATABLE
	$select  = "SELECT 
					*		
				FROM 
					hospitality_guest  
					".$join."
				WHERE 
					hospitality_guest.idsito = ".$_REQUEST['idsito']." 
				AND 
					hospitality_guest.Hidden = 1 ";
	$select  .=	  $andSelect." ";
	if(!$_REQUEST['action']){
		if($pagina_corrente!='' && $righe_per_pagina!=''){
			$select .=" LIMIT ".$prima_riga.", ".$righe_per_pagina."";
		}
	}
	$rec = $dbMysqli->query($select);

	// ## LIMITARE LE RIGHE SE IL JSON NON RIESCE A CARICARE TUTTE LE ROWS ##
	/*
	if(sizeof($rec)>1000){
		$rec = array_slice($rec, 0, 1000);
	}else{
		$rec = $rec;
	} 
	*/	
	
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


							$data[] = array(
										"id"             => '<input type="checkbox" value="'.$row['Id'].'" name="Id" id="riga'.$row['Id'].'" class="seleziona">',
                                        "nr"             => $row['NumeroPrenotazione'],
                                        "richiesta"      => '<span class="ordinamento">'.$row['DataRichiesta'].'</span>'.$TipoRichiesta,
                                        "fonte"          => $fun->bg_fonte($row['Id']),
                                        "tipo"           => $fun->bg_tipo($row['TipoVacanza']),
                                        "cliente"        => '<b>'.stripslashes($row['Nome']).' '.stripslashes($row['Cognome']).'</b>',
                                        "email"          => $row['Email'],
                                        "lingua"         => '<img src="'.BASE_URL_SITO.'img/flags/'.$row['Lingua'].'.png" class="image_flag">',
                                        "arrivo"         => gira_data($row['DataArrivo']),
                                        "partenza"       => gira_data($row['DataPartenza']),
                                        "riepilogo"      => $riepilogoModal,
										"disdetta"       => $fun->si_no($row['Disdetta']),
										"annullata"      => $fun->si_no($row['NoDisponibilita']),
										"action"         => '<a href="javascript:validator_ri_abilita(\''.BASE_URL_SITO.'ri_abilita_cestinate/'.$row['Id'].'\');" title="Ri Abilita"><i class="fa fa-repeat fa-2x fa-fw" aria-hidden="true"></i></a>'

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
