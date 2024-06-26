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



	$action              = $_REQUEST['action'];
	$id                  = $_REQUEST['id'];
	$param               = $_REQUEST['param'];
	$data                = array();

	#######################################################################################################################


	$q = $dbMysqli->rawQuery("SHOW COLUMNS FROM utenti_admin");

	foreach ($q as $key => $value) {

		if($_REQUEST[$value['Field']]==true){
				$campi_tabella[$value['Field']] = $_REQUEST[$value['Field']];
		}

	}

    switch($action){
		
        case "insert":
			$campi_tabella['password'] = base64_encode($_REQUEST['password']);
            $dbMysqli->insert('utenti_admin',$campi_tabella);
        break;

        case "update":
            $dbMysqli->where($param,$id);
            $dbMysqli->update('utenti_admin',$campi_tabella);
        break;

        case "delete":
            $dbMysqli->where($param,$id);
            $dbMysqli->delete('utenti_admin');
        break;

    }



	#######################################################################################################################

	# QUERY PER COMPILARE IL DATATABLE
	$s  = "SELECT * FROM utenti_admin";

	$rec = $dbMysqli->query($s);
	
	foreach($rec as $key => $row){


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
						// Send Button
						$sendButton       = "<button class='btn btn-sm btn-success update btn-custom' id='send_".$row['idutente']."' data-id='".$row['utente_nome']."' title='Invia dati di accesso operatore'><i class='fa fa-send fa-fw'></i></button>
											<script>
												$(document).ready(function(){
													$('#send_".$row['idutente']."').on('click',function(){
														var nome_utente = $('#send_".$row['idutente']."').data('id');
														if (window.confirm('ATTENZIONE: Sicuro di voler inviare la mail a '+nome_utente+'?')) {
															$.ajax({
																url: '".BASE_URL_ADMIN."ajax/superuser/send_dati.php',
																type: 'POST',
																data: 'idutente=".$row['idutente']."&action=send',
																dataType: 'html',
																success: function(data) {
																	_alert('<i class=\"fa fa-envelope\"></i> Invio E-mail',' Dati di accesso a ".NOME_SUPER_ADMIN." inviati con successo!'); 
																	$('#utenti_admin').DataTable().ajax.reload();                                                                                                 
																}
															}); 
														}                                            
													});
												});
											</script>";

						// Update Button
						$updateButton       = "<button class='btn btn-sm btn-warning update btn-custom' data-id='".$row['idutente']."' onclick='get_content_update(".$row['idutente'].")' title='Modifica'><i class='fa fa-edit fa-fw'></i></button>";
						// Delete Button
						$deleteButton       = "<button class='btn btn-sm btn-danger btn-custom' data-id='".$row['idutente']."' onclick='if(confirm(\"Sei sicuro di eliminare il record?\") == true){ get_delete(".$row['idutente'].")}' title='Elimina'><i class='fa fa-remove fa-fw'></i></button>";

						$action = $sendButton." ".$updateButton." ".$deleteButton;

						$data[] = array(
							"idutente"   => '<span class="coded-badge badge badge-success">'.$row['idutente'].'</span>',
							"logo"       => '<div class="text-center">'.($row['logo']!=''?'<img src="'.BASE_URL_SITO.'class/resize.class.php?src='.BASE_PATH_SITO.'uploads/loghi_superuser/'.$row['logo'].'&w=140&a=c&q=100" class="img-60">':'').'</div>',
							"nome"       => $row['utente_nome'],
                            "cognome"    => $row['utente_cognome'],
                            "username"   => $row['username'],
							"password"   => $passwordModal,
							"email"      => '<a href="mailto:'.$row['utente_email'].'"><i class="fa fa-envelope text-green" title="'.$row['utente_email'].'" data-toogle="tooltip" aria-hidden="true"></i></a>',
							"blocca_accesso" => ($row['blocco_accesso']==0?'<i class="fa fa-unlock text-green"></i>':'<i class="fa fa-lock text-red"></i>'),
							"action"     => '<div class="nowrap">'.$action.'</div>'
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
