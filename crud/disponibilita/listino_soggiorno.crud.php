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
					hospitality_listino_soggiorni.*	
				FROM 
					hospitality_listino_soggiorni 
				WHERE 
					hospitality_listino_soggiorni.idsito = ".$_REQUEST['idsito']." 
                AND
                    hospitality_listino_soggiorni.IdSoggiorno = ".$_REQUEST['id'];

	$rec = $dbMysqli->query($select);


	foreach($rec as $key => $row){

                            $modale .=' <div class="modal fade" id="ModaleUpdateListinoSoggiorno'.$row['Id'].'" tabindex="-1" role="dialog" aria-labelledby="ModaleLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Modifica Listino Soggiorno</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <form method="POST" id="form_mod_l_soggiorni'.$row['Id'].'" name="form_mod_l_soggiorni">
                                                        <div class="form-group">
                                                            <div class="row">

                                                                <div class="col-md-3">
                                                                    <b>Dal</b>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <b>Al</b>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <b>Prezzo</b>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">

                                                                <div class="col-md-3  p-l-50">
                                                                    <input type="date" name="PeriodoDal" id="PeriodoDal'.$row['Id'].'" value="'.$row['PeriodoDal'].'" class="form-control" required/>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <input type="date" name="PeriodoAl" id="PeriodoAl'.$row['Id'].'" value="'.$row['PeriodoAl'].'" class="form-control" required />
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <input type="text" name="Prezzo" id="Prezzo'.$row['Id'].'" value="'.$row['Prezzo'].'" class="form-control" placeholder="000.00" required />
                                                                </div>

                                                            </div>
                                                        </div>
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-12 text-center">
                                                                            <input type="hidden" name="Id" id="Id'.$row['Id'].'" value="'.$row['Id'].'">
                                                                            <input type="hidden" name="IdSoggiorno" id="IdSoggiorno'.$row['Id'].'"  value="'.$row['IdSoggiorno'].'">
                                                                            <button type="button" class="btn btn-warning col-md-5" data-dismiss="modal" aria-label="Close">CHIUDI</button>
                                                                            <button type="submit" class="btn btn-primary col-md-5">SALVA</button>
                                                                        </div>
                                                                    </div>
                                                                </div>                                 
                                                            </form>                       
                                                            <script>
                                                                $(document).ready(function() {

                                                                    $("#form_mod_l_soggiorni'.$row['Id'].'").submit(function () {  
                                                                        var  Id          = $("#Id'.$row['Id'].'").val();   
                                                                        var  IdSoggiorno = $("#IdSoggiorno'.$row['Id'].'").val();  
                                                                        var  PeriodoDal  = $("#PeriodoDal'.$row['Id'].'").val();
                                                                        var  PeriodoAl   = $("#PeriodoAl'.$row['Id'].'").val(); 
                                                                        var  Prezzo      = $("#Prezzo'.$row['Id'].'").val(); 
                                                                        $.ajax({
                                                                            url: "'.BASE_URL_SITO.'ajax/disponibilita/modifica_listino_soggiorno.php",
                                                                            type: "POST",
                                                                            data: "action=mod_l_soggiorno&Id="+Id+"&idsito='.$row['idsito'].'&PeriodoDal="+PeriodoDal+"&PeriodoAl="+PeriodoAl+"&Prezzo="+Prezzo+"&IdSoggiorno="+IdSoggiorno+"",
                                                                            dataType: "html",
                                                                            success: function(data) {
                                                                                $("#ModaleUpdateListinoSoggiorno'.$row['Id'].'").modal("hide");
                                                                                $("#add_listino_soggiorno").DataTable().ajax.reload();    
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
                                            <a class="dropdown-item waves-effect waves-light" href="'.BASE_URL_SITO.'disponibilita-duplica_listino_soggiorno/'.$row['Id'].'/'.$row['IdSoggiorno'].'/"><i class="fa fa-plus text-black"></i> Duplica</a>                                             
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item waves-effect waves-light" href="#" id="modifica'.$row['Id'].'"><i class="fa fa-edit text-orange"></i> Modifica </a>
                                                <script>
                                                    $(document).ready(function(){ 
                                                        $("#modifica'.$row['Id'].'").on("click",function(){
                                                            $("#ModaleUpdateListinoSoggiorno'.$row['Id'].'").modal("show"); 
                                                        });
                                                    });
                                                </script>                                                             
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-effect waves-light" href="#" id="delete_soggiorno'.$row['Id'].'"><i class="fa fa-times text-red"></i> Elimina</a>
                                                <script>
                                                    $(document).ready(function(){ 
                                                        $("#delete_soggiorno'.$row['Id'].'").on("click",function(){
                                                            if (window.confirm("ATTENZIONE: Sicuro di voler eliminare questo Listino Soggiorno?")){
                                                                $.ajax({
                                                                    url: "'.BASE_URL_SITO.'ajax/disponibilita/delete_listino_soggiorno.php",
                                                                    type: "POST",
                                                                    data: "action=del_l_soggiorno&idsito='.$row['idsito'].'&Id='.$row['Id'].'",
                                                                    dataType: "html",
                                                                    success: function(data) {
                                                                        $("#add_listino_soggiorno").DataTable().ajax.reload();    
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
                                    "dal"       => $fun->gira_data($row['PeriodoDal']),
                                    "al"        => $fun->gira_data($row['PeriodoAl']),
                                    "prezzo"    => '<i class="fa fa-euro p-r-5"></i>'. number_format($row['Prezzo'],2,',','.'),
                                    "abilitato" => ($row['Abilitato'] == 0?'<i class = "fa fa-times text-danger"></i>': '<i class = "fa fa-check text-success"></i>'),
                                    "action"    => $action.$modale
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
