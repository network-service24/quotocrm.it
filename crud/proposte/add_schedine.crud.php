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

	$stati = $fun->getListaStati();
	$lista_stati ='<option value="" '.($row['nome_stato']==''?'selected="selected"':'').'>--</option>';
	foreach($stati as $key => $value){
		$lista_stati .='<option value="'.$value['nome_stato'].'" '.($row['Cittadinanza']==$value['nome_stato']?'selected="selected"':'').'>'.$value['nome_stato'].'</option>';
	}
	$lista_statiNascita ='<option value="" '.($row['StatoNascita']==''?'selected="selected"':'').'>--</option>';
	foreach($stati as $key => $value){
		$lista_statiNascita .='<option value="'.$value['nome_stato'].'" '.($row['StatoNascita']==$value['nome_stato']?'selected="selected"':'').'>'.$value['nome_stato'].'</option>';
	}
	
	$province = $fun->getListaProvince();
	$lista_province ='<option value="" '.($row['sigla_provincia']==''?'selected="selected"':'').'>--</option>';
	foreach($province as $key => $value){
		$lista_province .='<option value="'.$value['sigla_provincia'].'" '.($row['Provincia']==$value['sigla_provincia']?'selected="selected"':'').'>'.$value['sigla_provincia'].'</option>';
	}
	$lista_provinceNascita ='<option value="" '.($row['sigla_provincia']==''?'selected="selected"':'').'>--</option>';
	foreach($province as $key => $value){
		$lista_provinceNascita .='<option value="'.$value['sigla_provincia'].'" '.($row['ProvinciaNascita']==$value['sigla_provincia']?'selected="selected"':'').'>'.$value['sigla_provincia'].'</option>';
	}
	
	$comuni = $fun->getListaComuni();
	$lista_comuni ='<option value="" '.($row['nome_comune']==''?'selected="selected"':'').'>--</option>';
	foreach($comuni as $key => $value){
		$lista_comuni .='<option value="'.$value['nome_comune'].'" '.($row['Citta']==$value['nome_comune']?'selected="selected"':'').'>'.$value['nome_comune'].'</option>';
	}
	# QUERY PER COMPILARE IL DATATABLE
    	$select  = "SELECT 
						hospitality_checkin.*		
					FROM 
						hospitality_checkin  
					WHERE 
                        hospitality_checkin.Prenotazione = ".$_REQUEST['prenotazione']." 
                    AND 
						hospitality_checkin.idsito = ".$_REQUEST['idsito']." 
					AND 
						hospitality_checkin.session_id IS NULL";

	$rec = $dbMysqli->query($select);
	
	foreach($rec as $key => $row){

		$modale =' <div class="modal fade" id="ModaleUpdateScheda'.$row['Id'].'" tabindex="-1" role="dialog" aria-labelledby="ModaleTargetLabel" aria-hidden="true" style="display: none;">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title">Modifica componente</h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
								</div>
								<div class="modal-body">
											<form name="mod_scheda" id="mod_scheda'.$row['Id'].'" method="POST">
												<div class="row">
													<div class="col-md-3">
														<label class="f-w-600">Nr.Preno</label>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<input class="form-control" type="text"  value="'.$row['Prenotazione'].'" name="Prenotazione"  readonly="readonly">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-3">
														<label class="f-w-600">Componente</label>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<select class="form-control" name="TipoComponente" style="height:auto!important">
																<option value="Capo Famiglia" '.($row['TipoComponente']=='Capo Famiglia'?'selected="selected"':'').'>Capo Famiglia</option>
																<option value="Familiare" '.($row['TipoComponente']=='Familiare'?'selected="selected"':'').'>Familiare</option>
																<option value="Capo Gruppo" '.($row['TipoComponente']=='Capo Gruppo'?'selected="selected"':'').'>Capo Gruppo</option>
																<option value="Membro Gruppo" '.($row['TipoComponente']=='Membro Gruppo'?'selected="selected"':'').'>Membro Gruppo</option>
																<option value="Ospite Singolo" '.($row['TipoComponente']=='Ospite Singolo'?'selected="selected"':'').'>Ospite Singolo</option>
															</select>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-3">
														<label class="f-w-600">Documento</label>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<select class="form-control" name="TipoDocumento" style="height:auto!important">
																<option value="Carta di Identità" '.($row['TipoDocumento']=='Carta di Identità'?'selected="selected"':'').'>Carta di Identità</option>
																<option value="Passaporto" '.($row['TipoDocumento']=='Passaporto'?'selected="selected"':'').'>Passaporto</option>
																<option value="Patente" '.($row['TipoDocumento']=='Patente'?'selected="selected"':'').'>Patente</option>
															</select>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-3">
														<label class="f-w-600">Nr.Documento</label>
													</div>
													<div class="col-md-7">
														<div class="form-group">
														<input class="form-control" type="text" value="'.$row['NumeroDocumento'].'" name="NumeroDocumento" >
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-3">
														<label class="f-w-600">Comune Emissione</label>
													</div>
													<div class="col-md-7">
														<div class="form-group">
														<input class="form-control" type="text" value="'.$row['ComuneEmissione'].'" name="ComuneEmissione" >
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-3">
														<label class="f-w-600">Stato Emissione</label>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<select class="form-control" name="StatoEmissione" style="height:auto!important">
																'.$lista_stati.'
															</select>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-3">
														<label class="f-w-600">Data Rilascio</label>
													</div>
													<div class="col-md-7">
														<div class="form-group">
														<input class="form-control" type="date" value="'.$row['DataRilascio'].'" name="DataRilascio" >
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-3">
														<label class="f-w-600">Data Scadenza</label>
													</div>
													<div class="col-md-7">
														<div class="form-group">
														<input class="form-control" type="date" value="'.$row['DataScadenza'].'" name="DataScadenza" >
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-3">
														<label class="f-w-600">Nome</label>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<input class="form-control" type="text" value="'.$row['Nome'].'" name="Nome" />
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-3">
														<label class="f-w-600">Cognome</label>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<input class="form-control" type="text" value="'.$row['Cognome'].'" name="Cognome" />
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-3">
														<label class="f-w-600">Sesso</label>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<select class="form-control" name="Sesso" style="height:auto!important">
																	<option value="Maschio" '.($row['Sesso']=='Maschio'?'selected="selected"':'').'>Maschio</option>
																	<option value="Femmina" '.($row['Sesso']=='Femmina'?'selected="selected"':'').'>Femmina</option>
															</select>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-3">
														<label class="f-w-600">Cittadinanza</label>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<select class="form-control" name="Cittadinanza" id="CittadinanzaM" style="height:auto!important">
																'.$lista_stati.'
															</select>
														</div>
													</div>
												</div>
											<div id="cittadino_italianoM">
												<div class="row">
													<div class="col-md-3">
														<label class="f-w-600">Provincia</label>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<select class="form-control" name="Provincia" style="height:auto!important">
																'.$lista_province.'
															</select>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-3">
														<label class="f-w-600">Città</label>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<input class="form-control" type="text" value="'.$row['Citta'].'" name="Citta"/>
														</div>
													</div>
												</div>
											</div>
											<div id="cittadino_esteroM">
												<div class="row">
													<div class="col-md-3">
														<label class="f-w-600 nowrap">Stato/regione/provincia (ESTERO)</label>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<input class="form-control" type="text" value="'.$row['ProvinciaBis'].'" name="ProvinciaBis"/>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-3">
														<label class="f-w-600 nowrap">Città (ESTERO)</label>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<input class="form-control" type="text" value="'.$row['CittaBis'].'" name="CittaBis" />
														</div>
													</div>
												</div>
											</div>
												<div class="row">
													<div class="col-md-3">
														<label class="f-w-600">Indirizzo</label>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<input class="form-control" type="text" value="'.$row['Indirizzo'].'" name="Indirizzo"/>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-3">
														<label class="f-w-600">Cap</label>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<input class="form-control" type="text" value="'.$row['Cap'].'" name="Cap"/>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-3">
														<label class="f-w-600">Data Nascita</label>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<input class="form-control" type="date" value="'.$row['DataNascita'].'" name="DataNascita"/>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-3">
														<label class="f-w-600">Stato Nascita</label>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<select class="form-control" name="StatoNascita" id="StatoNascitaM" style="height:auto!important">
																'.$lista_statiNascita.'
															</select>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-3">
														<label class="f-w-600">Luogo Nascita</label>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<input class="form-control" type="text" value="'.$row['LuogoNascita'].'"  name="LuogoNascita"  />
														</div>
													</div>
												</div>
											<div id="nascita_esteroM">
												<div class="row">
													<div class="col-md-3">
														<label class="f-w-600 nowrap">Stato/regione/provincia (ESTERO)</label>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<input class="form-control" type="text" value="'.$row['ProvinciaNascitaBis'].'" name="ProvinciaNascitaBis"  />
														</div>
													</div>
												</div>                        
												<div class="row">
													<div class="col-md-3">
														<label class="f-w-600 nowrap">Luogo Nascita (ESTERO)</label>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<input class="form-control" type="text" value="'.$row['LuogoNascitaBis'].'" name="LuogoNascitaBis"  />
														</div>
													</div>
												</div>
											</div>
												<div class="row">
													<div class="col-md-3">
														<label class="f-w-600 nowrap">Note</label>
													</div>
													<div class="col-md-7">
														<div class="form-group">
														<textarea class="form-control" name="Note" id="Note">'.$row['Note'].'</textarea>
														</div>
													</div>
												</div>               
												<div class="form-group">  
													<div class="row">
														<div class="col-md-12 text-center">   
															<input type="hidden" name="Id"  value="'.$row['Id'].'"> 
															<input type="hidden" name="lang"  value="'.$row['lang'].'">     
															<input type="hidden" name="NumeroPersone"  value="'.$row['NumeroPersone'].'">                            
															<input type="hidden" name="idsito"  value="'.IDSITO.'">
															<input type="hidden" name="action"  value="mod_schedina">
															<button type="button" class="btn btn-warning col-md-5" data-dismiss="modal" aria-label="Close">CHIUDI</button>
															<button type="submit" class="btn btn-primary col-md-5">SALVA</button>
														</div>
													</div>
												</div>
											</form>
											<script>
											$(document).ready(function() {
												$("#mod_scheda'.$row['Id'].'").submit(function () {   
													var  valori = $("#mod_scheda'.$row['Id'].'").serialize(); 
													$.ajax({
														url: "'.BASE_URL_SITO.'ajax/generici/modifica_schedina.php",
														type: "POST",
														data: valori,
														dataType: "html",
														success: function(data) {
															$("#ModaleUpdateScheda'.$row['Id'].'").modal("hide");
															$("#add_schedine").DataTable().ajax.reload();    
														}
													});
													return false; // con false senza refresh della pagina                                       
												});
											});
										</script>                    
								</div>
							</div>
						</div>           
					</div>'."\r\n";
							$action = ' <div class="btn-group dropdown-split-default"  id="azioniPrev">
											<a type="button"  class="cursore dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="fa fa-ellipsis-h fa-2x fa-fw"></i>
											</a>
											<div class="dropdown-menu">	
											<a class="dropdown-item waves-effect waves-light" href="#" id="modifica'.$row['Id'].'"><i class="fa fa-edit text-orange"></i> Modifica </a>
											<script>
												$(document).ready(function(){ 
													$("#modifica'.$row['Id'].'").on("click",function(){
														$("#ModaleUpdateScheda'.$row['Id'].'").modal("show"); 
													});
												});
											</script> 
											<div class="dropdown-divider"></div>
											<a class="dropdown-item waves-effect waves-light" href="#" id="delete_'.$row['Id'].'"><i class="fa fa-times text-red"></i> Elimina</a>
											<script>
												$(document).ready(function(){ 
													$("#delete_'.$row['Id'].'").on("click",function(){
														if (window.confirm("ATTENZIONE: Sicuro di voler eliminare questo Record?")){
															$.ajax({
																url: "'.BASE_URL_SITO.'ajax/generici/delete_scheda.php",
																type: "POST",
																data: "action=del_scheda&idsito='.$row['idsito'].'&Id='.$row['Id'].'",
																dataType: "html",
																success: function(data) {
																	$("#add_schedine").DataTable().ajax.reload();    
																}
															});
															return false;
														}
													});
												});
											</script>
											</div>
										</div>';

							$data[] = array(
															
									"nr"                 => '<a class="f-13" href="'.BASE_URL_SITO.'timeline/'.$row['Prenotazione'].'">'.$row['Prenotazione'].'</a>',
									"lg"                 => '<img src="'.BASE_URL_SITO.'img/flags/'.$row['Lingua'].'.png" class="image_flag">',
                                    "documento"          => ($row['Documento']!=''?'<a href="'.BASE_URL_LANDING.'checkin/uploads/'.$row['Documento'].'" target="_blank"><i class="fa fa-file-o" aria-hidden="true"></i></a>':'<span class="f-11 text-gray">Nessun file è stato caricato!</span>'),
									"componente"         => $row['TipoComponente'],
                                    "nome"               => $row['Nome'],
                                    "cognome"            => $row['Cognome'],
                                    "cittadinanza"       => $row['Cittadinanza'],
									"action"             => $action.$modale 
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
