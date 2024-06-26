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
                    hospitality_guest.CheckinOnlineClient = 1 
				AND 
					hospitality_guest.NoDisponibilita = 0";

	$rec = $dbMysqli->query($select);
	
	foreach($rec as $key => $row){


				if($row['CheckinInviato']==1){
					$ico_check = '<li><i class="fa fa-vcard text-light-blue" data-toggle="tooltip" title="Modulo Check-In Online inviato"></i></li>';
				}else{
					$ico_check = '';
				}

				$check = '	<ul class="check"><li>'.$fun->func_cc($row['Id'],$row['idsito']).'</li>'.$ico_benve.$ico_preCheck.$ico_recens.$ico_rebuonoV.$ico_quest.$ico_check.$ico_vouch.'</ul>';


							$action = ' <div class="btn-group dropdown-split-default"  id="azioniPrev">
											<a type="button"  class="cursore dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="fa fa-ellipsis-h fa-2x fa-fw"></i>
											</a>
											<div class="dropdown-menu">
												'.(($row['PrefissoInternazionale']!='' && $row['Cellulare']!='')?'<a class="dropdown-item waves-effect waves-light" href="'.BASE_URL_SITO.'send_whatsapp_checkin_ext/send/'.$row['Id'].'" target="_blank"><i class="fa fa-whatsapp text-green"></i> Invia Check-In Online con Whatsapp</a>':'').'
												<a class="dropdown-item waves-effect waves-light" href="'.BASE_URL_SITO.'send_checkin_ext/send/'.$row['Id'].'"><i class="fa fa-vcard "></i> Invia Check-In Online</a>
												<div class="dropdown-divider"></div>
												<a class="dropdown-item waves-effect waves-light" href="'.BASE_URL_SITO.'checkinonline-modifica_proposta_esterna/edit/'.$row['Id'].'"><i class="fa fa-edit text-warning"></i> Modifica la prenotazione esterna</a>
												<a class="dropdown-item waves-effect waves-light" href="javascript:validator_cestino(\''.BASE_URL_SITO.'checkinonline-prenotazioni_esterne/'.$row['Id'].'/delete/\');"><i class="fa fa-trash text-danger"></i> Elimina definitivamente</a>
											</div>
										</div>';

							$data[] = array(

									"op"             => $fun->get_operatore($row['ChiPrenota'],$row['idsito']),																		
									"nr"             => $row['Prefisso'].$row['NumeroPrenotazione'],
									"fonte"          => $fun->bg_fonte($row['Id']),
									"tipo"           => $fun->bg_tipo($row['TipoVacanza']),
									"data"           => gira_data($row['DataRichiesta']),
									"cliente"        => '<b>'.$row['Nome'].' '.$row['Cognome'].'</b>',
									"email"          => '<i class="fa fa-envelope fa-fw cursore" data-toogle="tooltip" title="'.$row['Email'].'"></i>',
									"lingua"         => '<img src="'.BASE_URL_SITO.'img/flags/'.$row['Lingua'].'.png" class="image_flag">',
									"arrivo"         => gira_data($row['DataArrivo']),
									"partenza"       => gira_data($row['DataPartenza']),
									"a"				 => $row['NumeroAdulti'],
									"b" 			 => $row['NumeroBambini'],
									"data_chiuso"    => gira_data($row['DataChiuso']),
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
