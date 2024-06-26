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
					hospitality_listino_camere.*	
				FROM 
					hospitality_listino_camere 
				WHERE 
					hospitality_listino_camere.idsito = ".$_REQUEST['idsito']." 
                AND
                    hospitality_listino_camere.IdCamera = ".$_REQUEST['id'];

	$rec = $dbMysqli->query($select);

    $record          = $fun->listino_attivo($_REQUEST['idsito']);
    $IdNumeroListino = $record['Id'];
    $Listino         = $record['Listino'];

	foreach($rec as $key => $row){

                            $modale .=' <div class="modal fade" id="ModaleUpdateListinoCamera'.$row['Id'].'" tabindex="-1" role="dialog" aria-labelledby="ModaleLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Modifica Listino Camera '.urldecode($_REQUEST['camera']).'</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <form method="POST" id="form_mod_l_camere'.$row['Id'].'" name="form_mod_l_camere">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <label><b>Listino</b></label>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <label><b>Trattamento soggiorno</b></label>
                                                                </div>
                                                            </div>
                                                        </div>                                       
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <select name="IdNumeroListino" id="IdNumeroListino'.$row['Id'].'" class="form-control" style="height:auto">
                                                                        <option value="'.$IdNumeroListino.'">'.$Listino.'</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <select name="IdSoggiorno" id="IdSoggiorno'.$row['Id'].'" class="form-control" style="height:auto">
                                                                        '.$fun->get_soggiorni($row['IdSoggiorno'],$row['idsito']).'
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
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
                                                                    <input type="text" name="PrezzoCamera" id="PrezzoCamera'.$row['Id'].'" value="'.$row['PrezzoCamera'].'" class="form-control" placeholder="000.00" required />
                                                                </div>

                                                            </div>
                                                        </div>
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-12 text-center">
                                                                            <input type="hidden" name="Id" id="Id'.$row['Id'].'" value="'.$row['Id'].'">
                                                                            <input type="hidden" name="IdCamera" id="IdCamera'.$row['Id'].'"  value="'.$row['IdCamera'].'">
                                                                            <button type="button" class="btn btn-warning col-md-5" data-dismiss="modal" aria-label="Close">CHIUDI</button>
                                                                            <button type="submit" class="btn btn-primary col-md-5">SALVA</button>
                                                                        </div>
                                                                    </div>
                                                                </div>                                 
                                                            </form>                       
                                                            <script>
                                                                $(document).ready(function() {

                                                                    $("#form_mod_l_camere'.$row['Id'].'").submit(function () {  
                                                                        var  Id              = $("#Id'.$row['Id'].'").val();   
                                                                        var  IdCamera        = $("#IdCamera'.$row['Id'].'").val();
                                                                        var  IdSoggiorno     = $("#IdSoggiorno'.$row['Id'].'").val();  
                                                                        var  IdNumeroListino = $("#IdNumeroListino'.$row['Id'].'").val();   
                                                                        var  PeriodoDal      = $("#PeriodoDal'.$row['Id'].'").val();
                                                                        var  PeriodoAl       = $("#PeriodoAl'.$row['Id'].'").val(); 
                                                                        var  PrezzoCamera    = $("#PrezzoCamera'.$row['Id'].'").val(); 
                                                                        $.ajax({
                                                                            url: "'.BASE_URL_SITO.'ajax/disponibilita/modifica_listino_camera.php",
                                                                            type: "POST",
                                                                            data: "action=mod_l_camera&Id="+Id+"&idsito='.$row['idsito'].'&PeriodoDal="+PeriodoDal+"&PeriodoAl="+PeriodoAl+"&PrezzoCamera="+PrezzoCamera+"&IdCamera="+IdCamera+"&IdSoggiorno="+IdSoggiorno+"&IdNumeroListino="+IdNumeroListino+"",
                                                                            dataType: "html",
                                                                            success: function(data) {
                                                                                $("#ModaleUpdateListinoCamera'.$row['Id'].'").modal("hide");
                                                                                $("#add_listino_camera").DataTable().ajax.reload();    
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
                                            <a class="dropdown-item waves-effect waves-light" href="'.BASE_URL_SITO.'disponibilita-duplica_listino/'.$row['Id'].'/'.$row['IdCamera'].'/"><i class="fa fa-plus text-black"></i> Duplica</a>                                             
                                            <div class="dropdown-divider"></div>
                                            '.($row['Abilitato']==0?
                                            '<a class="dropdown-item waves-effect waves-light" href="#" id="abilita'.$row['Id'].'"><i class="fa fa-eye text-green"></i> Abilita</a>'
                                            :
                                            '<a class="dropdown-item waves-effect waves-light" href="#" id="disabilita'.$row['Id'].'"><i class="fa fa-eye-slash text-gray"></i> Disabilita</a>'
                                            ).'
                                            <script>
                                                $(document).ready(function(){ 
                                                    $("#abilita'.$row['Id'].'").on("click",function(){
                                                        $.ajax({
                                                            url: "'.BASE_URL_SITO.'ajax/disponibilita/switch_listino_camera.php",
                                                            type: "POST",
                                                            data: "action=switch_listino&idsito='.$row['idsito'].'&Id='.$row['Id'].'&Abilitato=1",
                                                            dataType: "html",
                                                            success: function(data) {
                                                                $("#add_listino_camera").DataTable().ajax.reload();    
                                                            }
                                                        });
                                                        return false;
                                                    });
                                                    $("#disabilita'.$row['Id'].'").on("click",function(){
                                                        $.ajax({
                                                            url: "'.BASE_URL_SITO.'ajax/disponibilita/switch_listino_camera.php",
                                                            type: "POST",
                                                            data: "action=switch_listino&idsito='.$row['idsito'].'&Id='.$row['Id'].'&Abilitato=0",
                                                            dataType: "html",
                                                            success: function(data) {
                                                                $("#add_listino_camera").DataTable().ajax.reload();    
                                                            }
                                                        });
                                                        return false;                                                           
                                                    });
                                                });
                                            </script>                                               
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item waves-effect waves-light" href="#" id="modifica'.$row['Id'].'"><i class="fa fa-edit text-orange"></i> Modifica </a>
                                                <script>
                                                    $(document).ready(function(){ 
                                                        $("#modifica'.$row['Id'].'").on("click",function(){
                                                            $("#ModaleUpdateListinoCamera'.$row['Id'].'").modal("show"); 
                                                        });
                                                    });
                                                </script>                                                             
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-effect waves-light" href="#" id="delete_camera'.$row['Id'].'"><i class="fa fa-times text-red"></i> Elimina</a>
                                                <script>
                                                    $(document).ready(function(){ 
                                                        $("#delete_camera'.$row['Id'].'").on("click",function(){
                                                            if (window.confirm("ATTENZIONE: Sicuro di voler eliminare questo Listino Camera?")){
                                                                $.ajax({
                                                                    url: "'.BASE_URL_SITO.'ajax/disponibilita/delete_listino_camera.php",
                                                                    type: "POST",
                                                                    data: "action=del_l_camera&idsito='.$row['idsito'].'&Id='.$row['Id'].'",
                                                                    dataType: "html",
                                                                    success: function(data) {
                                                                        $("#add_listino_camera").DataTable().ajax.reload();    
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
                                    "listino"     => $fun->get_nome_listino($row['IdNumeroListino'],$row['idsito']),
                                    "trattamento" => $fun->get_nome_soggiorno($row['IdSoggiorno'],$row['idsito']),
                                    "dal"         => $fun->gira_data($row['PeriodoDal']),
                                    "al"          => $fun->gira_data($row['PeriodoAl']),
                                    "prezzo"      => '<i class="fa fa-euro p-r-5"></i>'. number_format($row['PrezzoCamera'],2,',','.'),
                                    "abilitato"   => ($row['Abilitato'] == 0?'<i class="fa fa-times text-danger"></i>': '<i class="fa fa-check text-success"></i>'),
                                    "action"      => $action.$modale
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
