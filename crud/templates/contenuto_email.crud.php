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


    	$select  = "SELECT 
					hospitality_contenuti_email.*	
				FROM 
					hospitality_contenuti_email 
				WHERE 
					hospitality_contenuti_email.idsito = ".$_REQUEST['idsito']."";

	$rec = $dbMysqli->query($select);

	foreach($rec as $key => $row){

                           $modale .=' <div class="modal fade" id="ModaleUpdate'.$row['Id'].'" tabindex="-1" role="dialog" aria-labelledby="ModaleLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Modifica Contenuto Email: '.$row['TipoRichiesta'].'</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                            <form method="POST" id="form_mod_contenuto_email'.$row['Id'].'" name="form_mod_contenuto_email" action="'.BASE_URL_SITO.'ajax/templates/modifica_testo_email.php">
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-2 text-left">
                                                                            <label>Lingua</label>
                                                                        </div>
                                                                        <div class="col-md-1 text-left">                                            	                                                     
                                                                            <img src="'.BASE_URL_SITO.'img/flags/'.$row['Lingua'].'.png" class="image_flag">
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-2 text-left">
                                                                            <label>Oggetto</label>
                                                                        </div>
                                                                        <div class="col-md-8">   
                                                                            <div class="clearfix f-11 f-left">SHORT-TAG utilizzabile : [cliente] </div>                                        	                                                     
                                                                            <input type="text" class="form-control" id="Oggetto'.$row['Id'].'" name="Oggetto" value="'.$row['Oggetto'].'"/>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                                <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-2 text-left">
                                                                        <label>Messaggio</label>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div class="text-left">
                                                                            <a href="javascript: window.open(\'https://www.wordhtml.com/\',\'WordHtml\',\'left=500,top=200,width=1024,height=768\');" title="Copia ed incolla testo word ripulito per html">
                                                                                <i class="fa fa-file-word-o"></i> 
                                                                                <span class="f-10">
                                                                                    Copia ed incolla testo word ripulito per html
                                                                                </span>
                                                                            </a>
                                                                        </div>
                                                                         <textarea class="form-control Width100" id="Messaggio'.$row['Id'].'"  name="Messaggio" style="width:100%">'.$row['Messaggio'].'</textarea>
                                                                         <!-- Custom js -->
                                                                         <script type="text/javascript" src="'.BASE_URL_SITO.'js/ckeditor/ckeditor.js"></script>
                                                                         <script>    
                                                                                 $(function() {
                                                                                         CKEDITOR.replace(\'Messaggio'.$row['Id'].'\');
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
                                                                            <input type="hidden" name="Id" id="Id'.$row['Id'].'" value="'.$row['Id'].'">
                                                                            <input type="hidden" name="idsito" value="'.$row['idsito'].'">
                                                                            <input type="hidden" name="action" value="mod_content_email">
                                                                            <button type="button" class="btn btn-warning col-md-5" data-dismiss="modal" aria-label="Close">CHIUDI</button>
                                                                            <button type="submit" class="btn btn-primary col-md-5">SALVA</button>
                                                                        </div>
                                                                    </div>
                                                                </div>                                 
                                                            </form>                    
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
                                                '<a class="dropdown-item waves-effect waves-light" href="#" id="check_abilita'.$row['Id'].'"><i class="fa fa-eye text-green"></i> Abilita</a>'
                                                :
												'<a class="dropdown-item waves-effect waves-light" href="#" id="check_disabilita'.$row['Id'].'"><i class="fa fa-eye-slash text-gray"></i> Disabilita</a>'
                                                ).'
											    <script>
                                                    $(document).ready(function(){ 
                                                        $("#check_abilita'.$row['Id'].'").on("click",function(){
                                                            $.ajax({
                                                                url: "'.BASE_URL_SITO.'ajax/templates/switch_contenuto_email.php",
                                                                type: "POST",
                                                                data: "action=switch_contenuto_email&idsito='.$row['idsito'].'&Id='.$row['Id'].'&Abilitato=1",
                                                                dataType: "html",
                                                                success: function(data) {
                                                                    $("#contenuto_email").DataTable().ajax.reload();    
                                                                }
                                                            });
                                                            return false;
                                                        });
                                                        $("#check_disabilita'.$row['Id'].'").on("click",function(){
                                                            $.ajax({
                                                                url: "'.BASE_URL_SITO.'ajax/templates/switch_contenuto_email.php",
                                                                type: "POST",
                                                                data: "action=switch_contenuto_email&idsito='.$row['idsito'].'&Id='.$row['Id'].'&Abilitato=0",
                                                                dataType: "html",
                                                                success: function(data) {
                                                                    $("#contenuto_email").DataTable().ajax.reload();    
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
                                                            $("#ModaleUpdate'.$row['Id'].'").modal("show"); 
                                                        });
                                                    });
                                                </script>                                            
                              
                                            </div>
										</div>';                                              

							$data[] = array(

                                        "lingua"    => '<img src="'.BASE_URL_SITO.'img/flags/'.$row['Lingua'].'.png" class="image_flag">',
                                        "tipo"      => ($row['TipoRichiesta']=='Preventivo'?'<b class="text-info">'.$row['TipoRichiesta'].'</b>':'<b class="text-success">'.$row['TipoRichiesta'].'</b>'),
                                        "oggetto"   => $row['Oggetto'],
                                        "messaggio" => $row['Messaggio'],
                                        "abilitato" => ($row['Abilitato'] == 0?'<i class="fa fa-times text-danger"></i>': '<i class="fa fa-check text-success"></i>'),
                                        "action"    => $action.$modale,
          
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
