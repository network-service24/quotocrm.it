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
	$select = "SELECT * FROM hospitality_log_accessi  WHERE idsito = ".$_REQUEST['idsito'];
	$rec = $dbMysqli->query($select);
	
	foreach($rec as $key => $row){


							$data[] = array(
                                "id"        => $row['id'],	
                                "operatore" => $row['nome_utente'],																	
                                "host"      => $row['host'],
                                "ip"        => $row['remote'],
                                "user"      => $row['user_agent'],
                                "data"      => date('d-m-Y H:i:s',$row['data_ora'])
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
