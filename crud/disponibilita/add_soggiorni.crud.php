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
					hospitality_tipo_soggiorno_lingua.*	
				FROM 
					hospitality_tipo_soggiorno_lingua 
				WHERE 
					hospitality_tipo_soggiorno_lingua.idsito = ".$_REQUEST['idsito']." 
                AND
                    hospitality_tipo_soggiorno_lingua.soggiorni_id = ".$_REQUEST['id']." ";

	$rec = $dbMysqli->query($select);


	
	foreach($rec as $key => $row){

                        $modale = '<div class="modal fade" id="ModaleUpdateTestoSoggiorni'.$row['Id'].'" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content" style="width:100%">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Modifica contenuti per il Soggiorno</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body  p-l-50 p-r-50">

                                                                    <form method="POST" id="form_up_soggiorni'.$row['Id'].'" name="form_up_soggiorni" action="'.BASE_URL_SITO.'ajax/disponibilita/modifica_testo_soggiorno.php">
                                                                    
                                                                        <div class="form-group">
                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                    <label>Lingua</label>
                                                                                </div>
                                                                                <div class="col-md-7">
                                                                                    '.$fun->SelectLingue('lingue','lingue'.$row['Id'],$row['lingue']).'
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                         <div class="form-group">
                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                    <label>Soggiorno</label>
                                                                                </div>
                                                                                <div class="col-md-7">
                                                                                    <input type="text" name="Soggiorno" id="Soggiorno'.$row['Id'].'" value="'.$row['Soggiorno'].'" class="form-control" required>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                        <div class="row">
                                                                            <div class="col-md-3">
                                                                                <label>Descrizione</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-2">
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <div class="text-left">
                                                                                    <a href="javascript: window.open(\'https://www.wordhtml.com/\',\'WordHtml\',\'left=500,top=200,width=1024,height=768\');" title="Copia ed incolla testo word ripulito per html">
                                                                                        <i class="fa fa-file-word-o"></i> 
                                                                                        <span class="f-10">
                                                                                            Copia ed incolla testo word ripulito per html
                                                                                        </span>
                                                                                    </a>
                                                                                </div>
                                                                                 <textarea class="form-control" id="Descrizione'.$row['Id'].'"  name="Descrizione" style="width:100%">'.$row['Descrizione'].'</textarea>
                                                                                 <!-- Custom js -->
                                                                                 <script type="text/javascript" src="'.BASE_URL_SITO.'js/ckeditor/ckeditor.js"></script>
                                                                                 <script>    
                                                                                         $(function() {
                                                                                                 CKEDITOR.replace(\'Descrizione'.$row['Id'].'\');
                                                                                                 $(".textarea").wysihtml5();                                 
                                                                                         });                                                                           
                                                                                         CKEDITOR.config.toolbar = [
                                                                                                     [\'Source\',\'-\',\'Maximize\'],
                                                                                                     [\'Bold\',\'Italic\',\'Underline\',\'StrikeThrough\',\'-\',\'Cut\',\'Copy\',\'Paste\',\'-\',\'Outdent\',\'Indent\',\'NumberedList\',\'BulletedList\',\'-\',\'JustifyLeft\',\'JustifyCenter\',\'JustifyRight\',\'JustifyBlock\',\'Table\',\'Link\',\'TextColor\',\'BGColor\'],
                                                                                                 ] ; 
                                                                                         CKEDITOR.config.autoGrow_onStartup = true;
                                                                                         CKEDITOR.config.extraPlugins = \'autogrow\';
                                                                                         CKEDITOR.config.autoGrow_minHeight = 250;
                                                                                         CKEDITOR.config.autoGrow_maxHeight = 500;
                                                                                         CKEDITOR.config.width = 570;
                                                                                         CKEDITOR.config.autoGrow_bottomSpace = 50;           
                                                                                 </script>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                        <div class="form-group">  
                                                                            <div class="row">
                                                                                <div class="col-md-12 text-center">
                                                                                    <input type="hidden" name="Id"  id="Id'.$row['Id'].'" value="'.$row['Id'].'">
                                                                                    <input type="hidden" name="soggiorni_id"  id="soggiorni_id'.$row['soggiorni_id'].'" value="'.$row['soggiorni_id'].'">
                                                                                    <input type="hidden" name="idsito"  value="'.$row['idsito'].'">
                                                                                    <input type="hidden" name="action"  value="mod_soggiorno">
                                                                                    <button type="button" class="btn btn-warning col-md-5" data-dismiss="modal" aria-label="Close">CHIUDI</button>
                                                                                    <button type="submit" class="btn btn-primary col-md-5">MODIFICA</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>                                 
                                                                    </form>

                                                            </div>
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
                                                            $("#ModaleUpdateTestoSoggiorni'.$row['Id'].'").modal("show"); 
                                                        });
                                                    });
                                                </script>                                               
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-effect waves-light" href="#" id="delete_testo_soggiorni'.$row['Id'].'"><i class="fa fa-times text-red"></i> Elimina</a>
                                                <script>
                                                    $(document).ready(function(){ 
                                                        $("#delete_testo_soggiorni'.$row['Id'].'").on("click",function(){
                                                            if (window.confirm("ATTENZIONE: Sicuro di voler eliminare questo Record?")){
                                                                $.ajax({
                                                                    url: "'.BASE_URL_SITO.'ajax/disponibilita/delete_testo_soggiorno.php",
                                                                    type: "POST",
                                                                    data: "action=del_t_soggiorni&idsito='.$row['idsito'].'&Id='.$row['Id'].'",
                                                                    dataType: "html",
                                                                    success: function(data) {
                                                                        $("#add_soggiorni").DataTable().ajax.reload();    
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

                                        "lingue"      => '<img src = "'.BASE_URL_SITO.'img/flags/mini/'.$row['lingue'].'.png">',
                                        "soggiorno"   => $row['Soggiorno'],
                                        "descrizione" => $row['Descrizione'],
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
