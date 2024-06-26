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
					utenti_quoto.*		
				FROM 
					utenti_quoto  
				WHERE 
					utenti_quoto.idsito = ".$_REQUEST['idsito']." ";

	$rec = $dbMysqli->query($select);


	
	foreach($rec as $key => $row){

                            $passwordModal    = '<a href="#" data-toggle="modal" data-target="#viewPass'.$row['id'].'"><i class="fa fa-barcode fa-2x"></i></a>
                                                    <div class="modal fade" id="viewPass'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

							$action = ' <div class="btn-group dropdown-split-default"  id="azioniPrev">
											<a type="button"  class="cursore dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="fa fa-ellipsis-h fa-2x fa-fw"></i>
											</a>
											<div class="dropdown-menu">
												<a class="dropdown-item waves-effect waves-light" href="#" id="modifica'.$row['id'].'"><i class="fa fa-edit text-orange"></i> Modifica </a>
                                                <script>
                                                    $(document).ready(function(){ 
                                                        $("#modifica'.$row['id'].'").on("click",function(){
                                                            document.location=\''.BASE_URL_SITO.'accessi-utenti/edit/'.$row['id'].'\';
                                                        });
                                                    });
                                                </script>
												<div class="dropdown-divider"></div>
                                                '.($row['abilitato']==0?
                                                '<a class="dropdown-item waves-effect waves-light" href="#" id="abilita'.$row['id'].'"><i class="fa fa-eye text-green"></i> Abilita</a>'
                                                :
												'<a class="dropdown-item waves-effect waves-light" href="#" id="disabilita'.$row['id'].'"><i class="fa fa-eye-slash text-gray"></i> Disabilita</a>'
                                                ).'
											    <script>
                                                    $(document).ready(function(){ 
                                                        $("#abilita'.$row['id'].'").on("click",function(){
                                                            $.ajax({
                                                                url: "'.BASE_URL_SITO.'ajax/generici/switch_utenti.php",
                                                                type: "POST",
                                                                data: "action=switch_utenti&idsito='.$row['idsito'].'&id='.$row['id'].'&abilitato=1",
                                                                dataType: "html",
                                                                success: function(data) {
                                                                    $("#utenti").DataTable().ajax.reload();    
                                                                }
                                                            });
                                                            return false;
                                                        });
                                                        $("#disabilita'.$row['id'].'").on("click",function(){
                                                            $.ajax({
                                                                url: "'.BASE_URL_SITO.'ajax/generici/switch_utenti.php",
                                                                type: "POST",
                                                                data: "action=switch_utenti&idsito='.$row['idsito'].'&id='.$row['id'].'&abilitato=0",
                                                                dataType: "html",
                                                                success: function(data) {
                                                                    $("#utenti").DataTable().ajax.reload();    
                                                                }
                                                            });
                                                            return false;                                                           
                                                        });
                                                    });
                                                </script>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-effect waves-light" href="#" id="delete_utenti'.$row['id'].'"><i class="fa fa-times text-red"></i> Elimina</a>
                                                <script>
                                                    $(document).ready(function(){ 
                                                        $("#delete_utenti'.$row['id'].'").on("click",function(){
                                                            if (window.confirm("ATTENZIONE: Sicuro di voler eliminare questo utenti?")){
                                                                $.ajax({
                                                                    url: "'.BASE_URL_SITO.'ajax/generici/delete_utenti.php",
                                                                    type: "POST",
                                                                    data: "action=del_utenti&idsito='.$row['idsito'].'&id='.$row['id'].'",
                                                                    dataType: "html",
                                                                    success: function(data) {
                                                                        $("#utenti").DataTable().ajax.reload();    
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

                                        "tipo"      => $fun->check_superuser($row['utenti']),
                                        "nome"      => $row['nome'],
                                        "sesso"     => $fun->ico_sesso($row['Sesso']),
                                        "user"      => $row['username'],
                                        "pass"      => $passwordModal,
                                        "abilitato" => ($row['abilitato'] == 1?'<i class = "fa fa-check text-green"></i>': '<i class="fa fa-times text-red"></i>'),
                                        "action"    => $action
 
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
