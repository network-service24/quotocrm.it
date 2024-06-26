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

	$data        = array();
	$anno_precendente_ = mktime(0, 0, 0, '06', '01', (date('Y')-1));
	$anno_precedente   = date('Y-m-d', $anno_precendente_);
	$checkNumberPrev = $fun->checkNumberRows($_REQUEST['idsito']);

	# QUERY PER COMPILARE IL DATATABLE
	$select = "	SELECT 
					*
				FROM 
					hospitality_guest  
				WHERE 
					hospitality_guest.idsito = ".$_REQUEST['idsito']." 
				AND 
					hospitality_guest.Nome != '' 
				AND 
					hospitality_guest.Email != '' 
				AND 
					(hospitality_guest.Cognome != '' 
				OR 
					hospitality_guest.Cognome != '-' 
				OR 
					hospitality_guest.Cognome != '.' ) 
				GROUP BY
					hospitality_guest.Cognome";
// ## LIMITARE LE RIGHE SE IL JSON NON RIESCE A CARICARE TUTTE LE ROWS ##
if($checkNumberPrev == 1){
	$select .= "AND
					hospitality_guest.DataRichiesta >= '".$anno_precedente."' ";
} 
	$rec = $dbMysqli->query($select);
	
	foreach($rec as $key => $row){

							$action = '<form name="crea_da_anagra" method="POST" action="'.BASE_URL_SITO.'crea_proposta/">
											<input type="hidden" name="Nome" value="'.stripslashes($row['Nome']).'">
											<input type="hidden" name="Cognome" value="'.stripslashes($row['Cognome']).'">
											<input type="hidden" name="Email" value="'.$row['Email'].'">
											<input type="hidden" name="Cellulare" value="'.$row['Cellulare'].'">
											<input type="hidden" name="PrefissoInternazionale" value="'.$row['PrefissoInternazionale'].'">
											<input type="hidden" name="provenienza" value="rubrica">
											<button type="submit" class="btn btn-out btn-info btn-square f-11"><i class="fa fa-edit"></i> Crea Proposta Soggiorno</button>
										</form>'."\r\n"; 	

							$action2 = '<div class="btn-group dropdown-split-default"  id="azioniPrev">
											<a type="button"  class="cursore dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="fa fa-ellipsis-h fa-2x fa-fw"></i>
											</a>
											<div class="dropdown-menu">
												<a class="dropdown-item waves-effect waves-light" href="#" id="storico'.$row['Id'].'"><i class="fa fa-sitemap text-orange"></i> Storico cliente </a>
												<script>
													$(document).ready(function(){ 
														$("#storico'.$row['Id'].'").on("click",function(){
	
															$.ajax({        
																type: "POST",         
																url: "'.BASE_URL_SITO.'ajax/anagrafica/storico_cliente.php",        
																data: "idsito='.$row['idsito'].'&nome='.stripslashes($row['Nome']).'&cognome='.stripslashes($row['Cognome']).'&email='.$row['Email'].'",
																dataType: "html",        
																success: function(msg){
																	$("#storico_cliente'.$row['Id'].'").html(msg);  
																	$("#ModaleStorico'.$row['Id'].'").modal("show");  
																},
																error: function(){
																	alert("Chiamata fallita, si prega di riprovare..."); 
																}
															})
															
														});
													});
												</script> 
											</div>
										</div>'."\r\n";  

							$modale =' <div class="modal fade" id="ModaleStorico'.$row['Id'].'" tabindex="-1" role="dialog" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
														<div class="modal-header">
															<h4 class="modal-title">Ulteriori informazioni del cliente!</h4>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
														</div>
														<div class="modal-body" id="storico_cliente'.$row['Id'].'">
														</div>
												</div>
											</div>           
										</div>'."\r\n";

							$data[] = array(
								"Id"          => $row['Id'],
								"nome"        => stripslashes($row['Nome']),
								"cognome"     => stripslashes($row['Cognome']),																	
								"email"       => $row['Email'],
								"cellulare"   => $row['Cellulare'],
								"action"      => $action,
								"action2"     => $action2.$modale

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
