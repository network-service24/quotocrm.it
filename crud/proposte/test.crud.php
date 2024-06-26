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
	$pagina_corrente  = $_REQUEST['pagina_corrente'];
	$righe_per_pagina = $_REQUEST['righe_per_pagina'];
	$prima_riga = ($pagina_corrente - 1) * $righe_per_pagina;

	# QUERY PER COMPILARE IL DATATABLE
	$select  = "SELECT 
					*		
				FROM 
					hospitality_guest  
				WHERE 
					hospitality_guest.idsito = ".$_REQUEST['idsito']."
                AND 
					hospitality_guest.Archivia = 1
                AND 
					(YEAR(hospitality_guest.DataRichiesta) = '".$_REQUEST['anno']."' OR YEAR(hospitality_guest.DataChiuso) = '".$_REQUEST['anno']."') ";
	if($pagina_corrente!='' && $righe_per_pagina!=''){
		$select .=" LIMIT ".$prima_riga.", ".$righe_per_pagina."";
	}				
				
	$rec = $dbMysqli->query($select);

	
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
                                        "richiesta"      => $TipoRichiesta,
                                        "fonte"          => $fun->bg_fonte($row['Id']),
                                        "tipo"           => $fun->bg_tipo($row['TipoVacanza']),
                                        "cliente"        => '<b>'.$row['Nome'].' '.$row['Cognome'].'</b>',
                                        "email"          => $row['Email'],
                                        "lingua"         => '<img src="'.BASE_URL_SITO.'img/flags/'.$row['Lingua'].'.png" class="image_flag">',
                                        "arrivo"         => gira_data($row['DataArrivo']),
                                        "partenza"       => gira_data($row['DataPartenza']),
                                        "riepilogo"      => $riepilogoModal,
										"disdetta"       => $fun->si_no($row['Disdetta']),
										"annullata"      => $fun->si_no($row['NoDisponibilita']),
										"action"         => '<a href="javascript:validator_ri_abilita(\''.BASE_URL_SITO.'ri_attiva_archiviate/'.$row['Id'].'\');" title="Ri Abilita"><i class="fa fa-repeat fa-2x fa-fw" aria-hidden="true"></i></a>'

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

?>
