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
	$select2  = "SELECT 
                    distinct(hospitality_dizionario_lingua.id_dizionario)	
                FROM 
                    hospitality_dizionario 
                INNER JOIN 
                    hospitality_dizionario_lingua
                ON
                    hospitality_dizionario_lingua.id_dizionario = hospitality_dizionario.id
                WHERE 
                    hospitality_dizionario.idsito = ".$_REQUEST['idsito']." 
                AND
                    hospitality_dizionario.Lingua = 'it'
                AND
                    hospitality_dizionario.etichetta = 'TESTOMAIL_RECENSIONE' OR hospitality_dizionario.etichetta = 'OGGETTO_RECENSIONE'
                AND
                    hospitality_dizionario_lingua.idsito = ".$_REQUEST['idsito']."
                AND
                    hospitality_dizionario_lingua.Lingua = 'it' ";

	$res    = $dbMysqli->query($select2);
    foreach($res as $ky => $rows){
        $id_dizionario[] = $rows['id_dizionario'];
    }


    	$select  = "SELECT 
					hospitality_recensioni_range.*	
				FROM 
					hospitality_recensioni_range 
				WHERE 
					hospitality_recensioni_range.idsito = ".$_REQUEST['idsito']." ";

	$rec = $dbMysqli->query($select);

	foreach($rec as $key => $row){

                           $modale .=' <div class="modal fade" id="ModaleUpdateRecensioniPunteggio'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="ModaleLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Modifica  Setting Recensioni Punteggio</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                            <form method="POST" id="form_mod_recensioni_punteggio'.$row['id'].'" name="form_mod_recensioni_punteggio">
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <label>Range di punteggio DA</label>
                                                                        </div>
                                                                        <div class="col-md-7">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-navicon fa-fw"></i></span>
                                                                                <select class="form-control" id="punteggio_da'.$row['id'].'" name="punteggio_da" required style="height:auto">
                                                                                    <option value="1" '.($row['punteggio_da']=='1'?'selected="selected"':'').'>1</option>
                                                                                    <option value="2" '.($row['punteggio_da']=='2'?'selected="selected"':'').'>2</option>
                                                                                    <option value="3" '.($row['punteggio_da']=='3'?'selected="selected"':'').'>3</option>
                                                                                    <option value="4" '.($row['punteggio_da']=='4'?'selected="selected"':'').'>4</option>
                                                                                    <option value="5" '.($row['punteggio_da']=='5'?'selected="selected"':'').'>5</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">  
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <label>Range di punteggio A</label>
                                                                    </div>
                                                                    <div class="col-md-7">                                            	                                                     
                                                                        <div class="input-group input-group-primary">
                                                                            <span class="input-group-addon"><i class="fa fa-navicon fa-fw"></i></span>
                                                                            <select class="form-control" id="punteggio_a'.$row['id'].'" name="punteggio_a" required style="height:auto">
                                                                                <option value="1" '.($row['punteggio_a']=='1'?'selected="selected"':'').'>1</option>
                                                                                <option value="2" '.($row['punteggio_a']=='2'?'selected="selected"':'').'>2</option>
                                                                                <option value="3" '.($row['punteggio_a']=='3'?'selected="selected"':'').'>3</option>
                                                                                <option value="4" '.($row['punteggio_a']=='4'?'selected="selected"':'').'>4</option>
                                                                                <option value="5" '.($row['punteggio_a']=='5'?'selected="selected"':'').'>5</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>  
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <label>Abilita</label>
                                                                        </div>
                                                                        <div class="col-md-1">                                            	                                                     
                                                                            <input type="checkbox" class="form-control" id="abilita'.$row['id'].'" name="abilita" value="'.$row['abilita'].'" '.($row['abilita']==1?'checked="checked"':'').'/>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-12 text-center">
                                                                            <input type="hidden" name="id" id="id'.$row['id'].'" value="'.$row['id'].'">
                                                                            <button type="button" class="btn btn-warning col-md-5" data-dismiss="modal" aria-label="Close">CHIUDI</button>
                                                                            <button type="submit" class="btn btn-primary col-md-5">SALVA</button>
                                                                        </div>
                                                                    </div>
                                                                </div>                                 
                                                            </form> 
                                                            </div> 
                                                            <div class="col-md-2"></div>
                                                            </div>                      
                                                            <script>
                                                                $(document).ready(function() {

                                                                    $("#abilita'.$row['id'].'").click(function() {
                                                                        if($("#abilita'.$row['id'].'").is(":checked")){
                                                                            $("#abilita'.$row['id'].'").attr("value","1");
                                                                        }else{
                                                                            $("#abilita'.$row['id'].'").attr("value",false);
                                                                            $("#abilita'.$row['id'].'").attr("checked",false);
                                                                        }
                                                                    });

                                                                    $("#form_mod_recensioni_punteggio'.$row['id'].'").submit(function () {   
                                                                        var  punteggio_da   = $("#punteggio_da'.$row['id'].' option:selected").val(); 
                                                                        var  punteggio_a    = $("#punteggio_a'.$row['id'].' option:selected").val(); 
                                                                        var  id             = $("#id'.$row['id'].'").val(); 
                                                                        var  abilita        = $("#abilita'.$row['id'].'").val(); 
                                                                        $.ajax({
                                                                            url: "'.BASE_URL_SITO.'ajax/configurazioni/modifica_recensioni_punteggio.php",
                                                                            type: "POST",
                                                                            data: "action=mod_rp&id="+id+"&idsito='.$row['idsito'].'&punteggio_da="+punteggio_da+"&punteggio_a="+punteggio_a+"&abilita="+abilita+"",
                                                                            dataType: "html",
                                                                            success: function(data) {
                                                                                $("#ModaleUpdateRecensioniPunteggio'.$row['id'].'").modal("hide");
                                                                                $("#recensioni_punteggio").DataTable().ajax.reload();    
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
                                        
                                                '.($row['abilita']==0?
                                                '<a class="dropdown-item waves-effect waves-light" href="#" id="check_abilita'.$row['id'].'"><i class="fa fa-eye text-green"></i> Abilita</a>'
                                                :
												'<a class="dropdown-item waves-effect waves-light" href="#" id="check_disabilita'.$row['id'].'"><i class="fa fa-eye-slash text-gray"></i> Disabilita</a>'
                                                ).'
											    <script>
                                                    $(document).ready(function(){ 
                                                        $("#check_abilita'.$row['id'].'").on("click",function(){
                                                            $.ajax({
                                                                url: "'.BASE_URL_SITO.'ajax/configurazioni/switch_recensioni_punteggio.php",
                                                                type: "POST",
                                                                data: "action=switch_rp&idsito='.$row['idsito'].'&id='.$row['id'].'&abilita=1",
                                                                dataType: "html",
                                                                success: function(data) {
                                                                    $("#recensioni_punteggio").DataTable().ajax.reload();    
                                                                }
                                                            });
                                                            return false;
                                                        });
                                                        $("#check_disabilita'.$row['id'].'").on("click",function(){
                                                            $.ajax({
                                                                url: "'.BASE_URL_SITO.'ajax/configurazioni/switch_recensioni_punteggio.php",
                                                                type: "POST",
                                                                data: "action=switch_rp&idsito='.$row['idsito'].'&id='.$row['id'].'&abilita=0",
                                                                dataType: "html",
                                                                success: function(data) {
                                                                    $("#recensioni_punteggio").DataTable().ajax.reload();    
                                                                }
                                                            });
                                                            return false;                                                           
                                                        });
                                                    });
                                                </script>    
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-effect waves-light" href="#" id="modifica'.$row['id'].'"><i class="fa fa-edit text-orange"></i> Modifica </a>
                                                <script>
                                                    $(document).ready(function(){ 
                                                        $("#modifica'.$row['id'].'").on("click",function(){
                                                            $("#ModaleUpdateRecensioniPunteggio'.$row['id'].'").modal("show"); 
                                                        });
                                                    });
                                                </script>                                            
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-effect waves-light" href="'.BASE_URL_SITO.'questionario-configura_oggetto_recensioni_punteggio/'.$id_dizionario[0].'/"><i class="fa fa-comment-o text-green"></i> Gestione testi Oggetto </a>  
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-effect waves-light" href="'.BASE_URL_SITO.'questionario-configura_mail_recensioni_punteggio/'.$id_dizionario[1].'/"><i class="fa fa-comment-o text-green"></i> Gestione testi E-Mail </a>                                                                                                   
                                            </div>
										</div>';                                              

							$data[] = array(

                                        "da"                 =>    $row['punteggio_da'],
                                        "a"                  =>    $row['punteggio_a'],
                                        "oggetto"            =>    $fun->ControlloTestiInseritiOggettoRecensioniPunteggio($id_dizionario[0],$row['idsito']),
                                        "testo"              =>    $fun->ControlloTestiInseritiMailRecensioniPunteggio($id_dizionario[1],$row['idsito']),
                                        "abilitato"          =>    ($row['abilita']==0?'<i class="fa fa-times text-danger"></i>':'<i class="fa fa-check text-success"></i>'),
                                        "action"             =>   $action.$modale
 
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
