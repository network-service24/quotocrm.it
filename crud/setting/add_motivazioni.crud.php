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
					hospitality_tipo_voucher_cancellazione_lingua.*	
				FROM 
					hospitality_tipo_voucher_cancellazione_lingua 
				WHERE 
					hospitality_tipo_voucher_cancellazione_lingua.idsito = ".$_REQUEST['idsito']." 
                AND
                    hospitality_tipo_voucher_cancellazione_lingua.motivazione_id = ".$_REQUEST['id']." ";

	$rec = $dbMysqli->query($select);


	
	foreach($rec as $key => $row){

                        $modale = '<div class="modal fade" id="ModaleUpdateTestoMotivazioni'.$row['Id'].'" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content" style="width:100%">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Modifica contenuti email per emissione buoni voucher</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body  p-l-50 p-r-50">

                                                                    <form method="POST" id="form_up_motivazioni'.$row['Id'].'" name="form_up_motivazioni" method="POST" action="'.BASE_URL_SITO.'ajax/generici/modifica_testo_motivazioni.php">
                                                                    
                                                                        <div class="form-group">
                                                                            <div class="row">
                                                                                <div class="col-md-2">
                                                                                    <label>Lingua</label>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    '.$fun->SelectLingue('lingue','lingue',$row['lingue']).'
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                         <div class="form-group">
                                                                            <div class="row">
                                                                                <div class="col-md-2">
                                                                                    <label>Motivazione</label>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input type="text" name="Motivazione" id="Motivazione'.$row['Id'].'" value="'.$row['Motivazione'].'" class="form-control" required>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group"> 
                                                                            <div class="row">
                                                                                <div class="col-md-2">
                                                                                    <label>Oggetto email</label>
                                                                                </div>
                                                                                <div class="col-md-9 text-right">
                                                                                    <div class="alert alert-info text-black f-11 text-center">Durante la compilazione del <b>oggetto email</b> è possibile e consigliato l\'uso di SHORT TAG !<br> <b>LISTA DEGLI SHORT TAG DISPONIBILI:</b> [cliente] e [numeropreno] </div>
                                                                                </div>
                                                                            </div>                                    
                                                                            <div class="row">
                                                                                <div class="col-md-2">
                                                                                    
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input type="text" name="Oggetto" id="Oggetto'.$row['Id'].'" value="'.$row['Oggetto'].'" class="form-control" required>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="row">
                                                                                <div class="col-md-2">
                                                                                    <label>Contenuto email</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-2">

                                                                                </div>
                                                                                <div class="col-md-9 text-right">
                                                                                    <div class="alert alert-info text-black f-11 text-center">Durante la compilazione del <b>contenuto email</b> è possibile e consigliato l\'uso di SHORT TAG !<br> <b>LISTA DEGLI SHORT TAG DISPONIBILI:</b> [cliente], [caparra], [numeropreno], [emailhotel], [linkvoucher] e [struttura]</div>
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
                                                                                        <textarea class="form-control Width100" id="Descrizione'.$row['Id'].'"  name="Descrizione" style="width:100%">'.$row['Descrizione'].'</textarea>
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
                                                                                    <input type="hidden" name="id"  value="'.$row['Id'].'">
                                                                                    <input type="hidden" name="motivazione_id"  value="'.$row['motivazione_id'].'">
                                                                                    <input type="hidden" name="idsito"  value="'.$row['idsito'].'">
                                                                                    <input type="hidden" name="action"  value="mod_motivazione">
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
                                                            $("#ModaleUpdateTestoMotivazioni'.$row['Id'].'").modal("show"); 
                                                        });
                                                    });
                                                </script>                                               
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-effect waves-light" href="#" id="delete_testo_motivazioni'.$row['Id'].'"><i class="fa fa-times text-red"></i> Elimina</a>
                                                <script>
                                                    $(document).ready(function(){ 
                                                        $("#delete_testo_motivazioni'.$row['Id'].'").on("click",function(){
                                                            if (window.confirm("ATTENZIONE: Sicuro di voler eliminare questo Record?")){
                                                                $.ajax({
                                                                    url: "'.BASE_URL_SITO.'ajax/generici/delete_testo_motivazioni.php",
                                                                    type: "POST",
                                                                    data: "action=del_t_m&idsito='.$row['idsito'].'&id='.$row['Id'].'",
                                                                    dataType: "html",
                                                                    success: function(data) {
                                                                        $("#add_motivazioni").DataTable().ajax.reload();    
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

                                        "lingue"               =>    '<img src="'.BASE_URL_SITO.'img/flags/'.$row['lingue'].'.png" class="image_flag">',
                                        "motivo"               =>    $row['Motivazione'],
                                        "oggetto"              =>    (strlen($row['Oggetto'])>50?substr($row['Oggetto'],         0, 50).'...<em class="f-12">continua</em>':$row['Oggetto']),
                                        "descrizione"          =>    (strlen($row['Descrizione'])>300?substr($row['Descrizione'], 0, 300).'...<em class="f-12">continua</em>':$row['Descrizione']),
                                        "action"               =>    $action.$modale
 
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
