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
					hospitality_politiche_lingua.*	
				FROM 
					hospitality_politiche_lingua 
				WHERE 
					hospitality_politiche_lingua.idsito = ".$_REQUEST['idsito']." 
                AND
                    hospitality_politiche_lingua.id_politiche = ".$_REQUEST['id']." ";

	$rec = $dbMysqli->query($select);


	
	foreach($rec as $key => $row){

                        $modale = '<div class="modal fade" id="ModaleUpdateTestoPolitiche'.$row['id'].'" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Modifica Testo Condizioni e/o politiche generali</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-1"></div>
                                                            <div class="col-md-9">
                                                                    <form method="POST" id="form_up_politiche'.$row['id'].'" name="form_up_politiche" method="POST" action="'.BASE_URL_SITO.'ajax/generici/modifica_testo_politiche.php">
                                                                    
                                                                        <div class="form-group">
                                                                            <div class="row">
                                                                                <div class="col-md-1 text-left">
                                                                                    <label>Lingua</label>
                                                                                </div>
                                                                                <div class="col-md-9 text-left">
                                                                                    '.$fun->SelectLingue('Lingua','Lingua',$row['Lingua']).'
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="text-left">
                                                                                        <a href="javascript: window.open(\'https://www.wordhtml.com/\',\'WordHtml\',\'left=500,top=200,width=1024,height=768\');" title="Copia ed incolla testo word ripulito per html">
                                                                                            <i class="fa fa-file-word-o"></i> 
                                                                                            <span class="f-10">
                                                                                                Copia ed incolla testo word ripulito per html
                                                                                            </span>
                                                                                        </a>
                                                                                    </div>
                                                                                    <div class="input-group">
                                                                                        <textarea class="form-control Width100" id="testo'.$row['id'].'"  name="testo" style="width:100%">'.$row['testo'].'</textarea>
                                                                                        <!-- Custom js -->
                                                                                        <script type="text/javascript" src="'.BASE_URL_SITO.'js/ckeditor/ckeditor.js"></script>
                                                                                        <script>    
                                                                                            $(function() {
                                                                                                    CKEDITOR.replace(\'testo'.$row['id'].'\');
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
                                                                                            CKEDITOR.config.width = 800;
                                                                                            CKEDITOR.config.autoGrow_bottomSpace = 50;           
                                                                                    </script>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">  
                                                                            <div class="row">
                                                                                <div class="col-md-12 text-center">
                                                                                    <input type="hidden" name="id"  value="'.$row['id'].'">
                                                                                    <input type="hidden" name="id_politiche"  value="'.$row['id_politiche'].'">
                                                                                    <input type="hidden" name="idsito"  value="'.$row['idsito'].'">
                                                                                    <input type="hidden" name="action"  value="mod_policy">
                                                                                    <button type="button" class="btn btn-warning col-md-5" data-dismiss="modal" aria-label="Close">CHIUDI</button>
                                                                                    <button type="submit" class="btn btn-primary col-md-5">MODIFICA</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>                                 
                                                                    </form>
                                                                </div>
                                                                <div class="col-md-2"></div>
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
                                            <a class="dropdown-item waves-effect waves-light" href="#" id="modifica'.$row['id'].'"><i class="fa fa-edit text-orange"></i> Modifica </a>
                                                <script>
                                                    $(document).ready(function(){ 
                                                        $("#modifica'.$row['id'].'").on("click",function(){
                                                            $("#ModaleUpdateTestoPolitiche'.$row['id'].'").modal("show"); 
                                                        });
                                                    });
                                                </script>                                               
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-effect waves-light" href="#" id="delete_testo_politiche'.$row['id'].'"><i class="fa fa-times text-red"></i> Elimina</a>
                                                <script>
                                                    $(document).ready(function(){ 
                                                        $("#delete_testo_politiche'.$row['id'].'").on("click",function(){
                                                            if (window.confirm("ATTENZIONE: Sicuro di voler eliminare questo Record?")){
                                                                $.ajax({
                                                                    url: "'.BASE_URL_SITO.'ajax/generici/delete_testo_politiche.php",
                                                                    type: "POST",
                                                                    data: "action=del_t_p&idsito='.$row['idsito'].'&id='.$row['id'].'",
                                                                    dataType: "html",
                                                                    success: function(data) {
                                                                        $("#add_condizioni").DataTable().ajax.reload();    
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

                                        "lingua"        =>    '<img src="'.BASE_URL_SITO.'img/flags/'.$row['Lingua'].'.png" class="image_flag">',
                                        "testo"          =>    (strlen($row['testo'])>300?substr($row['testo'], 0, 300).'...<em class="f-12">continua</em>':$row['testo']),
                                        "action"        =>    $action.$modale
 
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
