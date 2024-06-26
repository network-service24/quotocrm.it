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
					hospitality_dizionario.etichetta,
                    hospitality_dizionario_lingua.*	
				FROM 
					hospitality_dizionario 
                INNER JOIN 
                    hospitality_dizionario_lingua
                ON
                    hospitality_dizionario_lingua.id_dizionario = hospitality_dizionario.id
				WHERE 
					hospitality_dizionario.idsito = ".$_REQUEST['idsito']." 
                AND
                    hospitality_dizionario_lingua.idsito = ".$_REQUEST['idsito']." 
                AND
                    hospitality_dizionario.etichetta = 'INFORMATIVA_PRIVACY'";

	$rec = $dbMysqli->query($select);


	
	foreach($rec as $key => $row){


                        $modalUpdate = '<div class="modal fade" id="ModaleUpdatePolicy'.$row['id'].'" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Modifica Privacy Policy</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-1"></div>
                                                            <div class="col-md-9">
                                                                    <form method="POST" id="form_up_policy'.$row['id'].'" name="form_up_policy" method="POST" action="'.BASE_URL_SITO.'ajax/generici/modifica_policy.php">
                                                                    
                                                                        <div class="form-group">
                                                                            <div class="row">
                                                                                <div class="col-md-1 text-left">
                                                                                    <label>Lingua</label>
                                                                                </div>
                                                                                <div class="col-md-7 text-left">
                                                                                    <img src="'.BASE_URL_SITO.'img/flags/'.$row['Lingua'].'.png" class="image_flag">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="alert alert-default text-black f-13">
                                                                                        {SHORT TAG} Che si possono usare!<br>
                                                                                        {!rag_soc!},  {!indirizzo!} - {!cap!} {!citta!} {!provincia!}, {!p_iva!}
                                                                                   </div>
                                                                                </div>
                                                                            </div>
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


							$action = ' <a class="" href="#" id="modifica'.$row['id'].'"><i class="fa fa-edit fa-2x fa-fw text-orange"></i></a>
                                        <script>
                                            $(document).ready(function(){ 
                                                $("#modifica'.$row['id'].'").on("click",function(){
                                                    $("#ModaleUpdatePolicy'.$row['id'].'").modal("show"); 
                                                });
                                            });
                                        </script>';

							$Modal = '	<a href="#" class="text-black" data-toggle="modal" data-target="#contenuto'.$row['id'].'">
													<i class="fa fa-comment fa-2x fa-fw"></i>
												</a>
												<div class="modal fade" id="contenuto'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
													<div class="modal-dialog modal-lg" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="exampleModalLongTitle">Descrizione Privacy Policy <img src="'.BASE_URL_SITO.'img/flags/'.$row['Lingua'].'.png" class="image_flag"></h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
																</button>
															</div>
															<div class="modal-body text-left">
																'.$row['testo'].'
															</div>
														</div>
													</div>
												</div>';

							$data[] = array(

                                        "variabile"                   =>    ucwords(strtolower(str_replace("_"," ",$row['etichetta']))),
                                        "lingua"                      =>    '<img src="'.BASE_URL_SITO.'img/flags/'.$row['Lingua'].'.png" class="image_flag">',
                                        "contenuto"                   =>    $Modal,
                                        "data_modifica"               =>    ($row['data_modifica']!=''?$fun->gira_data($row['data_modifica']):''),
                                        "action"                      =>    $action.$modalUpdate
 
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
