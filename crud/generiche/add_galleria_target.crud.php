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
					hospitality_tipo_gallery_target.*	
				FROM 
					hospitality_tipo_gallery_target 
				WHERE 
					hospitality_tipo_gallery_target.idsito = ".$_REQUEST['idsito']."
                AND
                    hospitality_tipo_gallery_target.IdTipoGallery = ".$_REQUEST['id']."";

	$rec = $dbMysqli->query($select);


	
	foreach($rec as $key => $row){

        $modale = '<div class="modal fade" id="ModaleUpdateGalleriaTarget'.$row['Id'].'" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Modifica Target Gallery: '.urldecode($_REQUEST['etichetta']).'</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" id="form_mod_galleria_target'.$row['Id'].'" name="form_mod_galleria_target">                                          
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3 text-center">
                                                    <label>Immagine</label>
                                                </div>
                                                <div class="col-md-7">
                                                    <small class="text-info">Una volta scelto il file, non dimenticare di cliccare sul pulsante "Upload"</small>
                                                    <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-photo"></i></span>
                                                    <input type="file" class="form-control"  name="file_" id="file_'.$row['Id'].'">
                                                    <button type="button" class="btn btn-mini" id="btn_upload'.$row['Id'].'">Upload</button>
                                                    </div>
                                                    <div id="result_file'.$row['Id'].'"></div>
                                                    <input type="hidden"  id="Immagine'.$row['Id'].'" name="Immagine" />
                                                </div>
                                            </div>                            
                                        </div>
                                        <div class="form-group">  
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <input type="hidden"  id="Id'.$row['Id'].'" name="Id" value="'.$row['Id'].'" />
                                                    <input type="hidden"  id="IdTipoGallery'.$row['Id'].'" name="IdTipoGallery" value="'.$row['IdTipoGallery'].'" />
                                                    <button type="button" class="btn btn-warning col-md-5" data-dismiss="modal" aria-label="Close">CHIUDI</button>
                                                    <button type="submit" class="btn btn-primary col-md-5">SALVA</button>
                                                </div>
                                            </div>
                                        </div>                                 
                                    </form> 
                                    <script>
                                    $(document).ready(function() {

                                        //CARICO ICONA										
                                        $("#btn_upload'.$row['Id'].'").on("click",function(){
                                            formdata = new FormData();
                                            if($("#file_'.$row['Id'].'").prop(\'files\').length > 0)
                                            {
                                                file =$("#file_'.$row['Id'].'").prop(\'files\')[0];
                                                formdata.append("file_", file);
                                            }
                                            $.ajax({
                                                url: "' . BASE_URL_SITO . 'ajax/generiche/upload_foto_gallery_target.php?idsito='.$row['idsito'].'",
                                                type: "POST",
                                                data: formdata,
                                                processData: false,
                                                contentType: false,
                                                success: function (result) {
                                                    console.log(result);
                                                    if(result != ""){
                                                        $("#Immagine'.$row['Id'].'").val(result);
                                                        $("#result_file'.$row['Id'].'").html("<small class=\"text-green\">Il file è stato caricato con successo!</small>");
                                                    }else{
                                                        $("#result_file'.$row['Id'].'").html("<small class=\"text-red\">Prima di cliccare sul pulsante \"Upload\", scegli il file da caricare sul server!</small>");
                                                    }
                                                }
                                            });
                                            return false;
                                        });                                       

                                        $("#form_mod_galleria_target'.$row['Id'].'").submit(function () {  
                                            var  Immagine     = $("#Immagine'.$row['Id'].'").val();
                                            var IdTipoGallery = $("#IdTipoGallery'.$row['Id'].'").val();
                                            var  Id           = $("#Id'.$row['Id'].'").val();  
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/generiche/modifica_fotogallery_target.php",
                                                type: "POST",
                                                data: "action=mod_foto&idsito='.$row['idsito'].'&Immagine="+Immagine+"&Id="+Id+"&IdTipoGallery="+IdTipoGallery+"",
                                                dataType: "html",
                                                success: function(data) {
                                                    $("#ModaleUpdateGalleriaTarget'.$row['Id'].'").modal("hide");
                                                    $("#add_gallery_target").DataTable().ajax.reload();    
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
                                            '.($row['Abilitato']==0?
                                            '<a class="dropdown-item waves-effect waves-light" href="#" id="abilita'.$row['Id'].'"><i class="fa fa-eye text-green"></i> Abilita</a>'
                                            :
                                            '<a class="dropdown-item waves-effect waves-light" href="#" id="disabilita'.$row['Id'].'"><i class="fa fa-eye-slash text-gray"></i> Disabilita</a>'
                                            ).'
                                            <script>
                                                $(document).ready(function(){ 
                                                    $("#abilita'.$row['Id'].'").on("click",function(){
                                                        $.ajax({
                                                            url: "'.BASE_URL_SITO.'ajax/generiche/switch_immagine_target.php",
                                                            type: "POST",
                                                            data: "action=switch_immagine_target&idsito='.$row['idsito'].'&Id='.$row['Id'].'&Abilitato=1",
                                                            dataType: "html",
                                                            success: function(data) {
                                                                $("#add_gallery_target").DataTable().ajax.reload();    
                                                            }
                                                        });
                                                        return false;
                                                    });
                                                    $("#disabilita'.$row['Id'].'").on("click",function(){
                                                        $.ajax({
                                                            url: "'.BASE_URL_SITO.'ajax/generiche/switch_immagine_target.php",
                                                            type: "POST",
                                                            data: "action=switch_immagine_target&idsito='.$row['idsito'].'&Id='.$row['Id'].'&Abilitato=0",
                                                            dataType: "html",
                                                            success: function(data) {
                                                                $("#add_gallery_target").DataTable().ajax.reload();    
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
                                                            $("#ModaleUpdateGalleriaTarget'.$row['Id'].'").modal("show"); 
                                                        });
                                                    });
                                                </script> 
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-effect waves-light" href="#" id="delete_foto_gallery_target'.$row['Id'].'"><i class="fa fa-times text-red"></i> Elimina</a>
                                                <script>
                                                    $(document).ready(function(){ 
                                                        $("#delete_foto_gallery_target'.$row['Id'].'").on("click",function(){
                                                            if (window.confirm("ATTENZIONE: Sicuro di voler eliminare questa Foto?")){
                                                                $.ajax({
                                                                    url: "'.BASE_URL_SITO.'ajax/generiche/delete_foto_gallery_target.php",
                                                                    type: "POST",
                                                                    data: "action=del_foto_g_t&idsito='.$row['idsito'].'&Id='.$row['Id'].'",
                                                                    dataType: "html",
                                                                    success: function(data) {
                                                                        $("#add_gallery_target").DataTable().ajax.reload();    
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

                                        "immagine"    => ($row['Immagine']!=''?'<a href="'.BASE_URL_SITO.'uploads/'.$row['idsito'].'/'.$row['Immagine'].'" data-lightbox="roadtrip"><img src="'.BASE_URL_SITO.'class/resize.class.php?src='.BASE_PATH_SITO.'uploads/'.$row['idsito'].'/'.$row['Immagine'].'&w=240&h=120&a=c&q=100"></a>':''),
                                        "abilitato"   => ($row['Abilitato']==0?'<i class="fa fa-times text-danger"></i>':'<i class="fa fa-check text-success"></i>'),
                                        "action"       => $action.$modale
 
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
