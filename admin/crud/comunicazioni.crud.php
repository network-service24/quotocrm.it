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


	$action              = $_REQUEST['action'];
	$id                  = $_REQUEST['id'];
	$param               = $_REQUEST['param'];
	$data                = array();

	#######################################################################################################################


	$q = $dbMysqli->rawQuery("SHOW COLUMNS FROM comunicazioni");

	foreach ($q as $key => $value) {

		if($_REQUEST[$value['Field']]==true){
				$campi_tabella[$value['Field']] = $_REQUEST[$value['Field']];
		}

	}

    switch($action){
		
        case "insert":
			$dbMysqli->insert('comunicazioni',$campi_tabella);
        break;

        case "update":
		    $dbMysqli->where($param,$id);
            $dbMysqli->update('comunicazioni',$campi_tabella);
        break;

        case "delete":
            $dbMysqli->where($param,$id);
            $dbMysqli->delete('comunicazioni');
        break;

    }



	#######################################################################################################################

	# QUERY PER COMPILARE IL DATATABLE
	$s  = "SELECT * FROM comunicazioni";

	$rec = $dbMysqli->query($s);
	
	foreach($rec as $key => $row){


						$record = implode('|',$row);

						$testoModal    = '<a href="#" data-toggle="modal" data-target="#view'.$row['Id'].'"><i class="fa fa-comment"></i></a>
												<div class="modal fade" id="view'.$row['Id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
													<div class="modal-dialog modal-lg" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title">'.$row['Titolo'].'</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
																</button>
															</div>
															<div class="modal-body text-left">
															    '.$row['Testo'].'
															</div>
														</div>
													</div>
												</div>';       
						// Update Button
						$updateButton       = "<a class='btn btn-sm btn-warning update btn-custom' data-id='".$row['Id']."' href='".BASE_URL_ADMIN."mod.comunicazioni/".$row['Id']."/' title='Modifica'><i class='fa fa-edit fa-fw'></i></a>";
						// Delete Button
						$deleteButton       = "<button class='btn btn-sm btn-danger btn-custom' data-id='".$row['Id']."' onclick='if(confirm(\"Sei sicuro di eliminare il record?\") == true){ get_delete(".$row['Id'].")}' title='Elimina'><i class='fa fa-remove fa-fw'></i></button>";

						$action = $updateButton." ".$deleteButton;

						$data[] = array(
							"Id"        => $row['Id'],
							"DataInizio"=> gira_data($row['DataInizio']),
                            "DataFine"  => gira_data($row['DataFine']),
                            "Titolo"    => $row['Titolo'],
							"Testo"     => $testoModal,
							"Abilitato" => ($row['Abilitato']==1?'<i class="fa fa-check text-green"></i>':'<i class="fa fa-times text-red"></i>'),
							"Visibile"  => ($row['Visibile']==1?'<i class="fa fa-check text-green"></i>':'<i class="fa fa-times text-red"></i>'),
							"action"    => '<div class="nowrap">'.$action.'</div>'
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
