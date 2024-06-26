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
                        dizionario_form_quoto.*
                    FROM 
                        dizionario_form_quoto 
                    WHERE 
                        dizionario_form_quoto.idsito = ".$_REQUEST['idsito']." 
					AND
						dizionario_form_quoto.etichetta LIKE '%RESPONSE_%'";

	$rec = $dbMysqli->query($select);


	$numero = 1;
	foreach($rec as $key => $row){

 							$action = ' <div class="btn-group dropdown-split-default"  id="azioniPrev">
											<a type="button"  class="cursore dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="fa fa-ellipsis-h fa-2x fa-fw"></i>
											</a>
											<div class="dropdown-menu">                                                             
                                                <div class="dropdown-divider"></div>                                                         
                                                <a class="dropdown-item waves-effect waves-light" href="'.BASE_URL_SITO.'setting-add_mod_dizionario_form/'.$row['id'].'/'.$row['etichetta'].'/"><i class="fa fa-comment-o text-green"></i> Gestione testi dizionario form </a>                                         
                                            </div>
										</div>';                                               

							$data[] = array(
                                        
                                        "etichetta"   => ucwords(strtolower(str_replace("_"," ",$row['etichetta']))),
                                        "testi"       => $fun->ControlloTestiInseritiDizionarioForm($row['id'],$row['idsito']),
                                        "action"      => $action
 
							);
        $numero++;
	}

 	$json_data = array(
						"draw"            => 1,
						"recordsTotal"    => sizeof($rec),
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
