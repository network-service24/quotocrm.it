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



	$action                  = $_REQUEST['action'];
	$tabella                 = $_REQUEST['tabella'];
	$param                   = $_REQUEST['param'];
	$id                      = $_REQUEST['id'];
    $order                   = $_REQUEST['order'];
	$typeorder               = $_REQUEST['typeorder'];
	$provenienza             = $_REQUEST['provenienza'];
	$where                   = urldecode($_REQUEST['where']);
	$join                    = urldecode($_REQUEST['join']);
	$campiQuery              = urldecode($_REQUEST['campiQuery']);
	$groupBy                 = urldecode($_REQUEST['groupBy']);
	$record                  = '';
	$data                    = array();

	#######################################################################################################################

	$q = $dbMysqli->rawQuery("SHOW COLUMNS FROM ".$tabella);

	foreach ($q as $key => $value) {

		if($_REQUEST[$value['Field']]==true){
				$campi_tabella[$value['Field']] = $_REQUEST[$value['Field']];
		}

	}

		switch($action){

			case "insert":
				$dbMysqli->insert($tabella,$campi_tabella);
			break;
	
			case "update":
				$dbMysqli->where($param,$id);
				$dbMysqli->update($tabella,$campi_tabella);
			break;
	
			case "delete":
				$dbMysqli->where($param,$id);
				$dbMysqli->delete($tabella);
			break;
	
		}
	


	#######################################################################################################################

	# QUERY PER COMPILARE IL DATATABLE
	$s  = " SELECT 
		".($campiQuery!=''?$campiQuery:'*')." 
			FROM ".$tabella." 
		".($join!=''?$join:'')." 
		".($where!=''?$where:'')." 
		".($groupBy!=''?$groupBy:'')."
		".($order!=''?'ORDER BY '.$order.' '.$typeorder.'':'')." ";

	$rec = $dbMysqli->query($s);

	$array_moduli = array();

	$servArray        = array();
	$ArrserviziAttivi = array();
	$serviziAttivi    = '';
	$value            = '';

	foreach($rec as $key => $row){


				# in BASE ALLA TABELLA CAMBIANO I CAMPI
				switch($tabella){
					case 'anagrafica':

							$record = implode('|',$row);
						
							// clienti
							$sitiButton   = "<a href='".BASE_URL_ADMIN."siti/cl/".$row['idanagra']."' class='btn btn-sm btn-info btn-outline-danger btn-custom' title='Siti'><i class='fa fa-laptop fa-fw'></i></a>";
							// utenti
							$utentiButton = "<a href='".BASE_URL_ADMIN."utenti/cl/".$row['idanagra']."' class='btn btn-sm btn-warning btn-outline-warning btn-custom' title='Utente o Utenti'><i class='fa fa-users fa-fw'></i></a>";							
							// Update Button
							$updateButton = "<button class='btn btn-sm btn-warning update btn-custom' data-id='".$row['idanagra']."' onclick='get_content_update(".$row['idanagra'].")' title='Modifica'><i class='fa fa-edit fa-fw'></i></button>";
							// Delete Button
							$deleteButton = "<button class='btn btn-sm btn-danger btn-custom' data-id='".$row['idanagra']."' onclick='if(confirm(\"Sei sicuro di eliminare il record?\") == true){ get_delete(".$row['idanagra'].")}' title='Elimina'><i class='fa fa-remove fa-fw'></i></button>";
							
							$action = $sitiButton." ".$utentiButton." ".$updateButton." ".$deleteButton;

							$regione_     = $fun->getRegione($row['codice_regione']);
							$regione      = $regione_['nome_regione'];
							$provincia_   = $fun->getProvincia($row['codice_provincia']);
							$provincia    = $provincia_['sigla_provincia'];
							$comune_      = $fun->getComune($row['codice_comune']);
							$comune       = $comune_['nome_comune'];

							$data[] = array(
								"idanagra"    => '<span class="coded-badge badge badge-warning text-white">'.$row['idanagra'].'</span>',																		
								"status"      => $fun->getNomeStatus($row['id_status']),
								"contenzioso" => '<div class="nowrap">'.($row['contenzioso'] =='N'?'Solvibile <i class="fa fa-dot-circle-o text-green"></i>':'Insolvente <i class="fa fa-dot-circle-o text-red"></i>').'</div>',
								"rag_soc"     => $row['rag_soc'],
								"comune"      => '<div class="nowrap">'.$comune.'<br>'.trim($row['indirizzo']).'<br>'.$row['cap'].' ('.$provincia.')<br>'.$regione.'</div>',
								"tel"         => '<div class="nowrap">'.$row['tel'].'<br>'.$row['cell'].'</div>',
								"email"       => $row['email'],
								"action"      => '<div class="nowrap">'.$action.'</div>'

							);

						
					break;
					case 'siti':

						$record = implode('|',$row);
						$loginQuoto = "<form action='".BASE_URL_SITO."login.php' method='post' traget='_self'>
											<input type='hidden' name='username' value='".$row['username']."' />
											<input type='hidden' name='password' value='".base64_decode($row['password'])."'/>
											<input type='hidden' name='user_admin' value='".$_SESSION['utente']['username']."#".base64_decode($_SESSION['utente']['password'])."'/>
											<button type='submit' class='btn btn-mini btn-default' data-toogle='tooltip' title='Login verso ".NOME_AMMINISTRAZIONE." ".$row['web']."'><img src='".BASE_URL_SITO."img/q.png' style='width:20px'></button>
										</form>";
						//$loginQuoto         = "<a  href='".BASE_URL_ADMIN."jump_quoto/".$row['username']."/".$row['password']."/' data-toogle='tooltip' title='Login a Quoto' class='btn btn-mini btn-info'><img src='".BASE_URL_SITO."img/logo_quoto_2021.png' style='width:18px'> Login</a>";
						// clienti
						$clientiButton      = "<a href='".BASE_URL_ADMIN."jump_clienti/sw/".$row['idsito']."' class='btn btn-sm btn-danger btn-outline-danger btn-custom' title='Cliente'><i class='fa fa-user fa-fw'></i></a>";							
						// utenti
						$utentiButton       = "<a href='".BASE_URL_ADMIN."utenti/sw/".$row['idsito']."' class='btn btn-sm btn-warning btn-outline-warning btn-custom' title='Utente o Utenti'><i class='fa fa-users fa-fw'></i></a>";							
						// Update Button
						$updateButton       = "<button class='btn btn-sm btn-warning update btn-custom' data-id='".$row['idsito']."' onclick='get_content_update(".$row['idsito'].")' title='Modifica'><i class='fa fa-edit fa-fw'></i></button>";
						// Delete Button
						$deleteButton       = "<button class='btn btn-sm btn-danger btn-custom' data-id='".$row['idsito']."' onclick='if(confirm(\"Sei sicuro di eliminare il record?\") == true){ get_delete(".$row['idsito'].")}' title='Elimina'><i class='fa fa-remove fa-fw'></i></button>";
											

						
						$action = $clientiButton." ".$utentiButton." ".$updateButton." ".$deleteButton;


						$servArray = explode(",",$row['servizi_attivi']);
						foreach ($servArray as $key => $value) {

							switch($value){
								case 'Quoto':
								case 'Quoto TR':
									$ArrserviziAttivi[] = '<span class="pcoded-badge badge '.($row['data_end_hospitality']>=date('Y-m-d')?'badge-success':'badge-danger').'">'.$value.'</span>';
								break;
								case 'Quoto Demo':
									$ArrserviziAttivi[] = '<span class="pcoded-badge badge badge-inverse">'.$value.'</span>';
								break;
								default:
									$ArrserviziAttivi[] = '<testo class="text-gray f-11">'.$value.'</testo>';
								break;
							}
						}
						$serviziAttivi = implode("<br>",$ArrserviziAttivi);

		
						$data[] = array(
							"idsito"          => '<span class="coded-badge badge badge-info">'.$row['idsito'].'</span>',
							"servizi_attivi"  => (($row['servizi_attivi']!='' && $row['servizi_attivi']!='null')?$serviziAttivi:''),
							"web"             => '<a class="f-13" href="'.($row['https']==1?'https://':'http://').$row['web'].'" target="_blank" title="Vai al sito del cliente">'.$row['web'].'</a>'.(strstr($row['servizi_attivi'],'WordPress')?' <span class="p-l-10" style="cursor:pointer;" data-tooggle="tooltip" title="Sito realizzato in WordPress"><i class="fa fa-wordpress"></i>':'').($row['WidgetFormQuoto']==1?'<i class="fa fa-code fa-fw text-orange p-l-10" style="cursor:pointer;" data-toggle="tooltip" title="Il cliente usa il Widget Form di QUOTO!"></i>':''),
							"email"           => '<div class="text-center"><a href="mailto:'.$row['email'].'" title="'.$row['email'].'" class="text-center"><i class="fa fa-envelope" style="color:#1CC9A7"></i></a></div>',
							"id_status"       => $fun->getNomeStatus($row['id_status']),
							"start"           => '<span class="ordinamento">'.$row['data_start_hospitality'].'</span>'.$fun->gira_data($row['data_start_hospitality']),
							"end"             => '<span class="ordinamento">'.$row['data_end_hospitality'].'</span>'.($row['data_end_hospitality']>=date('Y-m-d')?$fun->gira_data($row['data_end_hospitality']):'<testo class="text-danger">'.$fun->gira_data($row['data_end_hospitality']).'</testo>'),
							"login"           => ($row['id_status']==1 || $row['id_status']==8?$loginQuoto:''),
							"action"          => '<div class="nowrap">'.$action.'</div>'
						);

					
				break;
				case "utenti":

						$record = implode('|',$row);

						$passwordModal    = '<a href="#" data-toggle="modal" data-target="#viewPass'.$row['idutente'].'"><i class="fa fa-barcode fa-2x"></i></a>
												<div class="modal fade" id="viewPass'.$row['idutente'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
													<div class="modal-dialog" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="exampleModalLabel">Clicca sugli asterischi per decriptare la pasword</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
																</button>
															</div>
															<div class="modal-body">
															<iframe src="'.BASE_URL_ADMIN.'ajax/superuser/decrypt_password.php?pass='.$row['password'].'"  width="100%" height="40" style="border:none;"></iframe>
															</div>
														</div>
													</div>
												</div>';    
						// clienti
						$clientiButton      = "<a href='".BASE_URL_ADMIN."clienti/ut/".$row['idanagra']."' class='btn btn-sm btn-danger btn-outline-danger btn-custom' title='Cliente'><i class='fa fa-user fa-fw'></i></a>";							
						// utenti
						$sitiButton         = "<a href='".BASE_URL_ADMIN."siti/ut/".$row['idsito']."' class='btn btn-sm btn-info btn-outline-warning btn-custom' title='Siti'><i class='fa fa-laptop fa-fw'></i></a>";							
						// Update Button
						$updateButton       = "<button class='btn btn-sm btn-warning update btn-custom' data-id='".$row['idutente']."' onclick='get_content_update(".$row['idutente'].")' title='Modifica'><i class='fa fa-edit fa-fw'></i></button>";
						// Delete Button
						$deleteButton       = "<button class='btn btn-sm btn-danger btn-custom' data-id='".$row['idutente']."' onclick='if(confirm(\"Sei sicuro di eliminare il record?\") == true){ get_delete(".$row['idutente'].")}' title='Elimina'><i class='fa fa-remove fa-fw'></i></button>";

						$action 	= $clientiButton." ".$sitiButton." ".$updateButton." ".$deleteButton;

						$data[] = array(
							"idutente"   => '<span class="coded-badge badge badge-success">'.$row['idutente'].'</span>',
							"web"        => '<span class="coded-badge badge badge-info">'.$row['web'].'</span>',
							"cliente"    => '<span class="coded-badge badge badge-'.($row['is_admin']==1?'inverse':'warning').' text-white">'.($row['is_admin']==1?'Operatore: '.$row['ut_nome'].' '.$row['ut_cognome']:$row['rag_soc']).'</span>',
							"logo"       => '<div class="text-center">'.($row['logo']!=''?'<img src="'.BASE_URL_SITO.'class/resize.class.php?src='.BASE_PATH_SITO.'uploads/loghi_siti/'.$row['logo'].'&w=140&a=c&q=100" class="img-60">':'').'</div>',
							"username"   => $row['username'],
							"password"   => $passwordModal,
							"email"      => '<a href="mailto:'.$row['ut_email'].'"><i class="fa fa-envelope text-green" title="'.$row['ut_email'].'" data-toogle="tooltip" aria-hidden="true"></i></a>',
							"blocca_accesso" => ($row['blocco_accesso']==0?'<i class="fa fa-unlock text-green"></i>':'<i class="fa fa-lock text-red"></i>'),
							"action"     => '<div class="nowrap">'.$action.'</div>'
						);
					
				break;

		}

		$servArray        = array();
		$ArrserviziAttivi = array();
		$serviziAttivi    = '';
		$value            = '';
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
