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
	$select = "SELECT * FROM comunicazioni ORDER BY DataInizio DESC";
	$rec = $dbMysqli->query($select);
	
	foreach($rec as $key => $row){

							$Modal = '	<a href="#" class="text-black" data-toggle="modal" data-target="#comunicazione'.$row['Id'].'">
													<i class="fa fa-comment fa-2x fa-fw"></i>
												</a>
												<div class="modal fade" id="comunicazione'.$row['Id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
													<div class="modal-dialog modal-lg" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="exampleModalLongTitle">Descrizione Comunicazione</h5>
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

							$data[] = array(
                                "dal"                       => '<span class="ordinamento">'.$row['DataInizio'].'</span>'.gira_data($row['DataInizio']),
                                "al"                        => ($row['DataFine']< date('Y-m-d')?'<span class="text-red">'.gira_data($row['DataFine']).'</span>':gira_data($row['DataFine'])),															
                                "titolo"                    => $row['Titolo'],
                                "comunicazione"             => $Modal,
                                "abilitato"                 => ($row['Abilitato']==0?'<i class="fa fa-times text-red"></i>':'<i class="fa fa-check text-green"></i>'),
                                "visibile"                  => ($row['Visibile']==0?'<i class="fa fa-times text-red"></i>':'<i class="fa fa-check text-green"></i>')
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
