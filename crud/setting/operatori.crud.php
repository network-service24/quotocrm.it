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
					*		
				FROM 
					hospitality_operatori  
				WHERE 
					hospitality_operatori.idsito = ".$_REQUEST['idsito']." ";

	$rec = $dbMysqli->query($select);


	
	foreach($rec as $key => $row){


                        $modalUpdate = '<div class="modal fade" id="ModaleUpdateOperatori'.$row['Id'].'" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Modifica Operatore</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-1"></div>
                                                            <div class="col-md-9">
                                                                    <form method="POST" id="form_up_op'.$row['Id'].'" name="form_up_op">
                                                                    
                                                                        <div class="form-group">
                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                    <label>Avatar Operatore</label>
                                                                                </div>
                                                                                <div class="col-md-7 text-left">
                                                                                '.($row['img']!=''?'<img src="'.BASE_URL_SITO.'class/resize.class.php?src='.BASE_PATH_SITO.'uploads/'.$row['idsito'].'/'.$row['img'].'&w=80&a=c&q=100">':'<i class="fa fa-image fa-4x fa-fw"></i>').'
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                    <label>Immagine Operatore</label>
                                                                                </div>
                                                                                <div class="col-md-7">
                                                                                    <small class="text-info">Una volta scelto il file, non dimenticare di cliccare sul pulsante "Upload"</small>
                                                                                    <div class="input-group">
                                                                                    <span class="input-group-addon"><i class="fa fa-fw fa-photo"></i></span>
                                                                                    <input type="file" class="form-control"  name="file_img" id="file_img'.$row['Id'].'">
                                                                                    <button type="button" class="btn btn-mini" id="btn_upload'.$row['Id'].'">Upload</button>
                                                                                    </div>
                                                                                    <div id="result_file'.$row['Id'].'"></div>
                                                                                    <input type="hidden"  id="img'.$row['Id'].'" name="img" value="'.($row['img']!=''?$row['img']:'').'"/>
                                                                                </div>
                                                                            </div>
                                                                        </div> 
                                                                        <div class="form-group">  
                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                    <label>Nome Operatore</label>
                                                                                </div>
                                                                                <div class="col-md-7">                                            	                                                     
                                                                                    <div class="input-group input-group-primary">
                                                                                        <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                                                                        <input type="text" class="form-control" id="NomeOperatore'.$row['Id'].'" name="NomeOperatore" value="'.$row['NomeOperatore'].'" required/>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div> 
                                                                        <div class="form-group">  
                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                    <label>Email Operatore</label>
                                                                                </div>
                                                                                <div class="col-md-7">
                                                                                    <div class="input-group input-group-primary">
                                                                                        <span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
                                                                                        <input type="text" class="form-control" id="EmailSegretaria'.$row['Id'].'" name="EmailSegretaria" value="'.$row['EmailSegretaria'].'" required />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">  
                                                                            <div class="row">
                                                                                <div class="col-md-12 text-center">
                                                                                <input type="hidden" name="id" id="id'.$row['Id'].'" value="'.$row['Id'].'">
                                                                                    <button type="button" class="btn btn-warning col-md-5" data-dismiss="modal" aria-label="Close">CHIUDI</button>
                                                                                    <button type="submit" class="btn btn-primary col-md-5">MODIFICA</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>                                 
                                                                    </form>
                                                                </div>
                                                                <div class="col-md-2"></div>
                                                            </div>                     
                                                            <script>
                                                                $(document).ready(function() {
                                                                    $("#btn_upload'.$row['Id'].'").on("click",function(){
                                                                        formdata = new FormData();
                                                                        if($("#file_img'.$row['Id'].'").prop(\'files\').length > 0)
                                                                        {
                                                                            file = $("#file_img'.$row['Id'].'").prop(\'files\')[0];
                                                                            formdata.append("file_img", file);
                                                                        }
                                                                        $.ajax({
                                                                            url: "' . BASE_URL_SITO . 'ajax/generici/upload_img_operatore.php?idsito='.$row['idsito'].'",
                                                                            type: "POST",
                                                                            data: formdata,
                                                                            processData: false,
                                                                            contentType: false,
                                                                            success: function (result) {
                                                                                console.log(result);
                                                                                if(result != ""){                                               
                                                                                    $("#img'.$row['Id'].'").val(result);
                                                                                    $("#result_file'.$row['Id'].'").html("<small class=\"text-green\">Il file è stato caricato con successo!</small>");
                                                                                }else{
                                                                                    $("#result_file'.$row['Id'].'").html("<small class=\"text-red\">Prima di cliccare sul pulsante \"Upload\", scegli il file da caricare sul server!</small>");
                                                                                }
                                                                            }
                                                                        });
                                                                        return false;
                                                                    });
                                                                    $("#form_up_op'.$row['Id'].'").submit(function () {   
                                                                        var  NomeOperatore  = $("#NomeOperatore'.$row['Id'].'").val(); 
                                                                        var  EmailOperatore = $("#EmailSegretaria'.$row['Id'].'").val(); 
                                                                        var  img            = $("#img'.$row['Id'].'").val(); 
                                                                        var  id             = $("#id'.$row['Id'].'").val();         
                                                                        $.ajax({
                                                                            url: "'.BASE_URL_SITO.'ajax/generici/modifica_operatore.php",
                                                                            type: "POST",
                                                                            data: "action=mod_op&id="+id+"&idsito='.$row['idsito'].'&NomeOperatore="+NomeOperatore+"&EmailOperatore="+EmailOperatore+"&img="+img+"",
                                                                            dataType: "html",
                                                                            success: function(data) {
                                                                                $("#ModaleUpdateOperatori'.$row['Id'].'").modal("hide");
                                                                                $("#operatori").DataTable().ajax.reload();    
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
												<a class="dropdown-item waves-effect waves-light" href="#" id="modifica'.$row['Id'].'"><i class="fa fa-edit text-orange"></i> Modifica </a>
                                                <script>
                                                    $(document).ready(function(){ 
                                                        $("#modifica'.$row['Id'].'").on("click",function(){
                                                            $("#ModaleUpdateOperatori'.$row['Id'].'").modal("show"); 
                                                        });
                                                    });
                                                </script>
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
                                                                url: "'.BASE_URL_SITO.'ajax/generici/switch_operatore.php",
                                                                type: "POST",
                                                                data: "action=switch_op&idsito='.$row['idsito'].'&id='.$row['Id'].'&Abilitato=1",
                                                                dataType: "html",
                                                                success: function(data) {
                                                                    $("#operatori").DataTable().ajax.reload();    
                                                                }
                                                            });
                                                            return false;
                                                        });
                                                        $("#disabilita'.$row['Id'].'").on("click",function(){
                                                            $.ajax({
                                                                url: "'.BASE_URL_SITO.'ajax/generici/switch_operatore.php",
                                                                type: "POST",
                                                                data: "action=switch_op&idsito='.$row['idsito'].'&id='.$row['Id'].'&Abilitato=0",
                                                                dataType: "html",
                                                                success: function(data) {
                                                                    $("#operatori").DataTable().ajax.reload();    
                                                                }
                                                            });
                                                            return false;                                                           
                                                        });
                                                    });
                                                </script>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-effect waves-light" href="#" id="delete_op'.$row['Id'].'"><i class="fa fa-times text-red"></i> Elimina</a>
                                                <script>
                                                    $(document).ready(function(){ 
                                                        $("#delete_op'.$row['Id'].'").on("click",function(){
                                                            if (window.confirm("ATTENZIONE: Sicuro di voler eliminare questo operatore?")){
                                                                $.ajax({
                                                                    url: "'.BASE_URL_SITO.'ajax/generici/delete_operatore.php",
                                                                    type: "POST",
                                                                    data: "action=del_op&idsito='.$row['idsito'].'&id='.$row['Id'].'",
                                                                    dataType: "html",
                                                                    success: function(data) {
                                                                        $("#operatori").DataTable().ajax.reload();    
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

                                        "img"                   =>    ($row['img']!=''?'<a href="'.BASE_URL_SITO.'uploads/'.$row['idsito'].'/'.$row['img'].'" data-lightbox="roadtrip"><img src="'.BASE_URL_SITO.'class/resize.class.php?src='.BASE_PATH_SITO.'uploads/'.$row['idsito'].'/'.$row['img'].'&w=80&a=c&q=100"></a>':'<i class="fa fa-image fa-4x fa-fw"></i>'),
                                        "nome"                  =>    $row['NomeOperatore'],
                                        "email"                 =>    $row['EmailSegretaria'],
                                        "abilitato"             =>    ($row['Abilitato']==1?'<i class="fa fa-check text-green"></i>':'<i class="fa fa-times text-red"></i>'),
                                        "action"                =>    $action.$modalUpdate
 
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
