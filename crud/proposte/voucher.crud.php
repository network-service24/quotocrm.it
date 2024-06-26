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

	$data        = array();

	# QUERY PER COMPILARE IL DATATABLE
    	$select  = "SELECT 
					*		
				FROM 
					hospitality_guest  
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
                    hospitality_guest.DataValiditaVoucher IS NOT NULL 
                AND 
                    hospitality_guest.IdMotivazione IS NOT NULL 
                AND 
                    hospitality_guest.DataRiconferma IS NULL
				AND 
					hospitality_guest.NoDisponibilita = 0";

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
							if($row['IdMotivazione']){
								$ico_rebuonoV = '<li><i  class="fa fa-tag blink text-green" data-toogle="tooltip" title="Questa prenotazione proviene da un Buono Voucher ri-confermato dopo variazione delle date soggiorno!"></i></li>';
							}else{
								$ico_rebuonoV = '';
							} 
				if($row['recensione_inviata']==1){
					$ico_recens = '<li><i class="fa fa-tripadvisor text-green" data-toogle="tooltip" data-html="true" title="Richiesta di recensione su TripAdvisor inviata!"></i></li>';
				}else{
					$ico_recens = '';
				}
				$check = '	<ul class="check"><li>'.$fun->func_cc($row['Id'],$row['idsito']).'</li>'.$ico_benve.$ico_preCheck.$ico_recens.$ico_rebuonoV.$ico_quest.$ico_check.$ico_vouch.'</ul>';
					
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
						$TitoloModale   =  'Prfenotazione confermata Nr. '.$row['Id'].'/'.$row['NumeroPrenotazione'].' - operatore '.$row['ChiPrenota'].'';
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

				$directory   = $fun->DirectorySito($row['idsito']);
				$linkPreviewVoucher =   (BASE_URL_LANDING.$directory.'/'.base64_encode($row['Id'].'_'.$row['idsito'].'_c').'/voucher_rec/');   

							$action = ' <div class="btn-group dropdown-split-default"  id="azioniPrev">
											<a type="button"  class="cursore dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="fa fa-ellipsis-h fa-2x fa-fw"></i>
											</a>
											<div class="dropdown-menu">
												<a class="dropdown-item waves-effect waves-light" href="'.$linkPreviewVoucher.'" target="_blank"><i class="fa fa-search text-info"></i> Visualizza buono voucher</a>
												<div class="dropdown-divider"></div>
												<a class="dropdown-item waves-effect waves-light" href="'.BASE_URL_SITO.'reinvia_buono_voucher/send/'.$row['Id'].'"><i class="fa fa-tag text-orange"></i> Re-invia buono voucher</a>
												<div class="dropdown-divider"></div>
												<a class="dropdown-item waves-effect waves-light" href="'.BASE_URL_SITO.'modifica_proposta/edit/'.$row['Id'].'"><i class="fa fa-edit text-warning"></i> Edita la prenotazione per variare le date di soggiorno</a>
												<a class="dropdown-item waves-effect waves-light" href="javascript:validator_cestino(\''.BASE_URL_SITO.'buoni_voucher/'.$row['Id'].'/delete/\');"><i class="fa fa-trash text-danger"></i> Cestina</a>
											</div>
										</div>';

							$data[] = array(

									"op"             => $fun->get_operatore($row['ChiPrenota'],$row['idsito']),																		
									"nr"             => '<a href="'.BASE_URL_SITO.'timeline/'.$row['NumeroPrenotazione'].'" class="f-12" title="Timeline"  data-toogle="tooltip">'.$row['NumeroPrenotazione'].'</a>',
									"fonte"          => $fun->bg_fonte($row['Id']),
									"tipo"           => $fun->bg_tipo($row['TipoVacanza']),
									"data"           => gira_data($row['DataRichiesta']),
									"cliente"        => '<b>'.stripslashes($row['Nome']).' '.stripslashes($row['Cognome']).'</b>',
									"email"          => '<i class="fa fa-envelope fa-fw cursore" data-toogle="tooltip" title="'.$row['Email'].'"></i>',
									"lingua"         => '<img src="'.BASE_URL_SITO.'img/flags/'.$row['Lingua'].'.png" class="image_flag">',
									"arrivo"         => gira_data($row['DataArrivo']),
									"partenza"       => gira_data($row['DataPartenza']),
									"data_chiuso"    => gira_data($row['DataChiuso']),
                                    "riepilogo"      => $riepilogoModal,
									"check"          => $check,
									"motivo"         => $fun->motivazione_scadenza($row['Id'],$row['idsito'],$row['DataValiditaVoucher'],$row['IdMotivazione']),
									"action"         => $action 
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
