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
					hospitality_lingue_form.*		
				FROM 
                    hospitality_lingue_form  
				WHERE 
                    hospitality_lingue_form.idsito = ".$_REQUEST['idsito']." ";

	$rec = $dbMysqli->query($select);


	
	foreach($rec as $key => $row){




							$action = ' <a href="#" id="delete_lg'.$row['id'].'"><i class="fa fa-times fa-2x fa-fw text-red"></i></a>
                                        <script>
                                            $(document).ready(function(){ 
                                                $("#delete_lg'.$row['id'].'").on("click",function(){
                                                    if (window.confirm("ATTENZIONE: Sicuro di voler eliminare questa Lingua?")){
                                                        $.ajax({
                                                            url: "'.BASE_URL_SITO.'ajax/generici/delete_lingua.php",
                                                            type: "POST",
                                                            data: "action=del_lg&idsito='.$row['idsito'].'&id='.$row['id'].'",
                                                            dataType: "html",
                                                            success: function(data) {
                                                                $("#lingue").DataTable().ajax.reload();    
                                                            }
                                                        });
                                                        return false;
                                                    }
                                                });
                                            });
                                        </script>';


							$data[] = array(
                  
                                        "lingua"                =>    '<img src="'.BASE_URL_SITO.'img/flags/'.$row['codlingua'].'.png" class="image_flag">',
                                        "action"                =>    $action
 
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
