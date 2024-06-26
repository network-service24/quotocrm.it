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
						hospitality_checkin.*		
					FROM 
						hospitality_checkin  
					WHERE 
						hospitality_checkin.idsito = ".$_REQUEST['idsito']." 
					AND 
						hospitality_checkin.session_id IS NOT NULL";

	$rec = $dbMysqli->query($select);
	
	foreach($rec as $key => $row){

							$action = ' <div class="btn-group dropdown-split-default"  id="azioniPrev">
											<a type="button"  class="cursore dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="fa fa-ellipsis-h fa-2x fa-fw"></i>
											</a>
											<div class="dropdown-menu">	
												<a class="dropdown-item waves-effect waves-light" href="'.BASE_URL_SITO.'checkinonline-send_schedina/'.$row['idsito'].'/'.$row['NumeroPersone'].'/'.$row['Prenotazione'].'/"><i class="fa fa-envelope text-blue"></i> Invia E-Mail alla Questura</a>
												<div class="dropdown-divider"></div>
												<a class="dropdown-item waves-effect waves-light" href="'.BASE_URL_SITO.'include/controller/export_schedina.php?IdPrenotazione='.$row['Id'].'&idsito='.$row['idsito'].'&NumPreno='.$row['Prenotazione'].'"><i class="fa fa-file-excel-o  text-green"></i> Esporta Schedina Alloggiati</a>
                                                <a class="dropdown-item waves-effect waves-light" href="'.BASE_URL_SITO.'checkinonline-print_schedina/'.$row['idsito'].'/'.$row['NumeroPersone'].'/'.$row['Prenotazione'].'/"><i class="fa fa-print  text-red"></i> Stampa Schedina Alloggiati</a>
												<div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-effect waves-light" href="'.BASE_URL_SITO.'checkinonline-mod_schedine_alloggiati/'.$row['Id'].'/'.$row['Prenotazione'].'/"><i class="fa fa-edit text-warning"></i> Modifica Schedina</a>
                                                <a class="dropdown-item waves-effect waves-light" href="javascript:validator(\''.BASE_URL_SITO.'checkinonline-delete_schedina/'.$row['idsito'].'/'.$row['Id'].'/'.$row['Prenotazione'].'/\');"><i class="fa fa-trash text-danger"></i> Elimina Schedina P.S. e tutti i suoi componenti</a>
											</div>
										</div>';

							$data[] = array(
															
									"nr"                 => '<a class="f-13" href="'.BASE_URL_SITO.'timeline/'.$row['Prenotazione'].'">'.$row['Prenotazione'].'</a>',
									"soggiorno"          => $fun->get_checkin($row['Prenotazione'],$row['idsito']),
									"lg"                 => $row['lang'],
									"n_persone"          => $row['NumeroPersone'],
									"componente"         => $row['TipoComponente'],
									"tipo_documento"     => $row['TipoDocumento'],
                                    "documento"          => ($row['Documento']!=''?'<a href="'.BASE_URL_LANDING.'checkin/uploads/'.$row['Documento'].'" target="_blank"><i class="fa fa-file-o" aria-hidden="true"></i></a>':'<span class="f-11 text-gray">Nessun file è stato caricato!</span>'),
                                    "emissione"          => $row['ComuneEmissione'],
                                    "nome"               => $row['Nome'],
                                    "cognome"            => $row['Cognome'],
                                    "data_compilazione"  => $fun->gira_data($row['data_compilazione']),
                                    "esito_compilazione" => $fun->count_row_compilate($row['Prenotazione'],$row['idsito']),
									"action"             => $action 
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
