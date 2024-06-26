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
					hospitality_template_background.*	
				FROM 
					hospitality_template_background 
				WHERE 
					hospitality_template_background.idsito = ".$_REQUEST['idsito']."
                AND
                    hospitality_template_background.TemplateName != 'default'
                AND
                    hospitality_template_background.TemplateName != 'smart'
                ORDER BY 
                    hospitality_template_background.Ordine ";

	$rec = $dbMysqli->query($select);
    
    $checkLastCustomT = false;

	foreach($rec as $key => $row){

        switch($row['TemplateType']){
            case 'custom4':
            case 'custom5':
            case 'custom6':
            case 'custom7':
            case 'custom8':
            case 'custom9':
                $checkLastCustomT = true;
            break;
            default:
                $checkLastCustomT = false;
            break;
        }  

                        $modale =' <div class="modal fade" id="ModaleUpdateTemplateCustom'.$row['Id'].'" tabindex="-1" role="dialog" aria-labelledby="ModaleLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Modifica Template Custom</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                            <form method="POST" id="form_mod_template_custom'.$row['Id'].'" name="form_mod_template_custom">
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-3 text-left">
                                                                            <label>Nome Template</label>
                                                                        </div>
                                                                        <div class="col-md-7">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-laptop fa-fw"></i></span>
                                                                                <input type="text" class="form-control" id="TemplateName'.$row['Id'].'" name="TemplateName" value="'.$row['TemplateName'].'" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <div id="viewFont'.$row['Id'].'">  
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-3 text-left">
                                                                            <label>Font</label>
                                                                        </div>
                                                                        <div class="col-md-7">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-font fa-fw"></i></span>
                                                                                <select name="Font" id="Font'.$row['Id'].'" class="form-control" style="height:auto"">   
                                                                                    <option value="\'Lato\', sans-serif" '.($row['Font']=='\'Lato\', sans-serif'?'selected="selected"':'').'>Lato</option>   
                                                                                    <option value="\'Lora\', serif" '.($row['Font']=='\'Lora\', serif'?'selected="selected"':'').'>Lora</option>   
                                                                                    <option value="\'Open Sans\', sans-serif" '.($row['Font']=='\'Open Sans\', sans-serif'?'selected="selected"':'').'>Open Sans</option>   
                                                                                    <option value="\'Playfair Display\', serif" '.($row['Font']=='\'Playfair Display\', serif'?'selected="selected"':'').'>PlayFair Display</option>   
                                                                                    <option value="\'Raleway\', sans-serif" '.($row['Font']=='\'Raleway\', sans-serif'?'selected="selected"':'').'>Raleway</option>   
                                                                                    <option value="\'Roboto\', sans-serif" '.($row['Font']=='\'Roboto\', sans-serif'?'selected="selected"':'').'>Roboto</option>   
                                                                                    <option value="\'Roboto Slab\', serif" '.($row['Font']=='\'Roboto Slab\', serif'?'selected="selected"':'').'>Roboto Slab</option>   
                                                                                    <option value="\'Ubuntu\', sans-serif" '.($row['Font']=='\'Ubuntu\', sans-serif'?'selected="selected"':'').'>Ubuntu</option>   
                                                                                    <option value="\'Montserrat\', sans-serif" '.($row['Font']=='\'Montserrat\', sans-serif'?'selected="selected"':'').'>Montserrat</option>
                                                                                </select>
                                                                            </div>  
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                                <div class="form-group" id="viewBgColor'.$row['Id'].'">  
                                                                    <div class="row">
                                                                        <div class="col-md-3 text-left">
                                                                            <label>Colore Principale Template</label>
                                                                        </div>
                                                                        <div class="col-md-1 text-left">                                            	                                                     
                                                                            '.$fun->color_selector($row['Id'],$row['idsito'],$row['Background']).'
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group"  id="view2Color'.$row['Id'].'">  
                                                                    <div class="row">
                                                                        <div class="col-md-3 text-left">
                                                                            <label>Colore Pulsanti Template</label>
                                                                        </div>
                                                                        <div class="col-md-7">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-paint-brush fa-fw"></i></span>
                                                                                <input type="text" class="form-control" id="Pulsante'.$row['Id'].'" name="Pulsante" value="'.$row['Pulsante'].'" style="background-color:'.$row['Pulsante'].';color:#FFFFFF;" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-md-3 text-left">
                                                                            <label>Top Immagine Template</label>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <span class="text-black f-12 text-center">Una volta scelto il file, non dimenticare di cliccare sul pulsante "Upload"</span>
                                                                            <div class="input-group">
                                                                            <span class="input-group-addon"><i class="fa fa-fw fa-photo"></i></span>
                                                                            <input type="file" class="form-control"  name="file3_" id="file3_'.$row['Id'].'">
                                                                            <button type="button" class="btn btn-mini" id="btn_upload3'.$row['Id'].'">Upload</button>
                                                                            </div>
                                                                            <div id="result_file3'.$row['Id'].'"></div>
                                                                            <input type="hidden"  id="Immagine3'.$row['Id'].'" name="Immagine3" />
                                                                        </div>
                                                                    </div>                            
                                                                </div>
                                                                <div class="form-group" id="viewImmagine2Input'.$row['Id'].'">
                                                                    <div class="row">
                                                                        <div class="col-md-3 text-left">
                                                                            <label>Background Immagine Proposte</label>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <span class="text-black f-12 text-center">Una volta scelto il file, non dimenticare di cliccare sul pulsante "Upload"</span>
                                                                            <div class="input-group">
                                                                            <span class="input-group-addon"><i class="fa fa-fw fa-photo"></i></span>
                                                                            <input type="file" class="form-control"  name="file4_" id="file4_'.$row['Id'].'">
                                                                            <button type="button" class="btn btn-mini" id="btn_upload4'.$row['Id'].'">Upload</button>
                                                                            </div>
                                                                            <div id="result_file4'.$row['Id'].'"></div>
                                                                            <input type="hidden"  id="Immagine4'.$row['Id'].'" name="Immagine4" />
                                                                        </div>
                                                                    </div>                            
                                                                </div>
                                                                <div class="form-group" id="viewVideoInput'.$row['Id'].'" style="display:none">  
                                                                    <div class="row">
                                                                        <div class="col-md-3 text-left">
                                                                            <label>Id Video Template</label>
                                                                            <div class="clearfix"></div>
                                                                            <span class="f-11">Se possedete un canale YouTube <i class="fa fa-angle-double-right"></i></span>
                                                                        </div>
                                                                        <div class="col-md-7">     
                                                                            <div class="f-11"><i class="fa fa-2x fa-exclamation-triangle text-warning" data-toggle="tooltip" title="Youtube -> condividi -> incorpora -> copia ed incolla solo url dell\'iframe"></i> <b>Legenda:</b> Da youtube clicca su <b>"condividi"</b>, <b>"incorpora"</b>,<br>e copia <b>solo l\'url </b>che trovi nel src="" del iframe
                                                                            <br><i class="fa fa-photo fa-2x cursore text-warning" id="viewScreen'.$row['Id'].'" title="Clicca per visualizzare l\'esempio"></i><div id="screenshotVideo'.$row['Id'].'" style="display:none"><img src="/img/screenvideoquoto.png"></div>
                                                                            <script>
                                                                                $(function(){
                                                                                    $( "#viewScreen'.$row['Id'].'" ).on( "click", function() {
                                                                                        if($( "#screenshotVideo'.$row['Id'].'" ).is(":visible")){
                                                                                            $( "#screenshotVideo'.$row['Id'].'" ).hide();
                                                                                        }else{
                                                                                            $( "#screenshotVideo'.$row['Id'].'" ).show();
                                                                                        }
                                                                                        
                                                                                      });
                                                                                    });
                                                                            </script>
                                                                        </div>
                                                                        <div class="clearfix"></div>                                       	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-youtube fa-fw"></i></span>
                                                                                <input type="text" class="form-control" id="Video'.$row['Id'].'" name="Video" value="'.$row['Video'].'" placeholder="https://www.youtube.com/embed/sH-dI5BkljY?si=VCsAvR-ifuHuMxqx"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>                                                                                                                                                                                                   
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-12 text-center">
                                                                            <input type="hidden" name="Id" id="Id'.$row['Id'].'" value="'.$row['Id'].'">
                                                                            <input type="hidden" name="BackgroundScelto" id="BackgroundScelto'.$row['Id'].'">
                                                                            <input type="hidden" name="action" value="mod_template_custom">
                                                                            <button type="button" class="btn btn-warning col-md-5" data-dismiss="modal" aria-label="Close">CHIUDI</button>
                                                                            <button type="submit" class="btn btn-primary col-md-5">SALVA</button>
                                                                        </div>
                                                                    </div>
                                                                </div>                                 
                                                            </form>  
                                                            <script>
                                                                $(document).ready(function(){ 

                                                                    $("#Background'.$row['Id'].'").on("change",function(){
                                                                        var Background = $("#Background'.$row['Id'].' option:selected").val();
                                                                        $.ajax({
                                                                            url: "'.BASE_URL_SITO.'ajax/templates/carica_colori_custom.php",
                                                                            type: "POST",
                                                                            data: "action=get_color&idsito='.$row['idsito'].'&Background="+Background+"",
                                                                            dataType: "html",
                                                                            success: function(msg) {
                                                                                $("#Pulsante'.$row['Id'].'").val(msg); 
                                                                                $("#Pulsante'.$row['Id'].'").css("background-color",msg);
                                                                                $("#Pulsante'.$row['Id'].'").css("color","#FFFFFF");
                                                                                $("#BackgroundScelto'.$row['Id'].'").val(Background);
                                                                            }
                                                                        });
                                                                        return false;
                                                                    });

                                                                    //CARICO IMMAGINE										
                                                                    $("#btn_upload3'.$row['Id'].'").on("click",function(){
                                                                        formdata = new FormData();
                                                                        if($("#file3_'.$row['Id'].'").prop(\'files\').length > 0)
                                                                        {
                                                                            file =$("#file3_'.$row['Id'].'").prop(\'files\')[0];
                                                                            formdata.append("file3_", file);
                                                                        }
                                                                        $.ajax({
                                                                            url: "' . BASE_URL_SITO . 'ajax/templates/upload_immagine_custom.php?idsito='.$row['idsito'].'",
                                                                            type: "POST",
                                                                            data: formdata,
                                                                            processData: false,
                                                                            contentType: false,
                                                                            success: function (result3) {
                                                                                console.log(result3);
                                                                                if(result3 != ""){
                                                                                    $("#Immagine3'.$row['Id'].'").val(result3);
                                                                                    $("#result_file3'.$row['Id'].'").html("<small class=\"text-green\">Il file è stato caricato con successo!</small>");
                                                                                }else{
                                                                                    $("#result_file3'.$row['Id'].'").html("<small class=\"text-red\">Prima di cliccare sul pulsante \"Upload\", scegli il file da caricare sul server!</small>");
                                                                                }
                                                                            }
                                                                        });
                                                                        return false;
                                                                    });

                                                                    //CARICO IMMAGINE 2										
                                                                    $("#btn_upload4'.$row['Id'].'").on("click",function(){
                                                                        formdata = new FormData();
                                                                        if($("#file4_'.$row['Id'].'").prop(\'files\').length > 0)
                                                                        {
                                                                            file =$("#file4_'.$row['Id'].'").prop(\'files\')[0];
                                                                            formdata.append("file4_", file);
                                                                        }
                                                                        $.ajax({
                                                                            url: "' . BASE_URL_SITO . 'ajax/templates/upload_immagine2_custom.php?idsito='.$row['idsito'].'",
                                                                            type: "POST",
                                                                            data: formdata,
                                                                            processData: false,
                                                                            contentType: false,
                                                                            success: function (result4) {
                                                                                console.log(result4);
                                                                                if(result4 != ""){
                                                                                    $("#Immagine4'.$row['Id'].'").val(result4);
                                                                                    $("#result_file4'.$row['Id'].'").html("<small class=\"text-green\">Il file è stato caricato con successo!</small>");
                                                                                }else{
                                                                                    $("#result_file4'.$row['Id'].'").html("<small class=\"text-red\">Prima di cliccare sul pulsante \"Upload\", scegli il file da caricare sul server!</small>");
                                                                                }
                                                                            }
                                                                        });
                                                                        return false;
                                                                    });

                                                                    $("#form_mod_template_custom'.$row['Id'].'").submit(function(){  
                                                                        var TemplateName = $("#TemplateName'.$row['Id'].'").val();
                                                                        var Font         = $("#Font'.$row['Id'].' option:selected").val();
                                                                        var Backgr       = $("#BackgroundScelto'.$row['Id'].'").val();
                                                                        var Pulsante     = $("#Pulsante'.$row['Id'].'").val();
                                                                        var Id           = $("#Id'.$row['Id'].'").val();
                                                                        var Immagine     = $("#Immagine3'.$row['Id'].'").val();
                                                                        var Immagine2    = $("#Immagine4'.$row['Id'].'").val();
                                                                        var Video        = $("#Video'.$row['Id'].'").val();
                                                                        $.ajax({
                                                                            url: "'.BASE_URL_SITO.'ajax/templates/save_template_custom.php",
                                                                            type: "POST",
                                                                            data: "action=save_template_custom&idsito='.$row['idsito'].'&Id="+Id+"&TemplateName="+TemplateName+"&Font="+Font+"&Background="+Backgr+"&Pulsante="+Pulsante+"&Immagine="+Immagine+"&Immagine2="+Immagine2+"&Video="+Video+"",
                                                                            dataType: "html",
                                                                            success: function(result) {
                                                                                $("#ModaleUpdateTemplateCustom'.$row['Id'].'").modal("hide");
                                                                                $("#template_custom").DataTable().ajax.reload();    
                                                                            }
                                                                        });
                                                                        return false;                                     
                                                                    });

                                                                });
                                                            </script>                  
                                                    </div>
                                                </div>
                                            </div>           
                                        </div>'."\r\n";
                            $modaleVideo = '<div class="modal fade" id="ModaleVideo'.$row['Id'].'" tabindex="-1" role="dialog" aria-labelledby="ModaleLabel" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content" style="width:600px!important">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title"><i class="fa fa-youtube fa-fw text-red"></i> Video Template</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                                <iframe width="560" height="315" src="'.$row['Video'].'" frameborder="0" allow="accelerometer;clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                        </div>
                                                </div>
                                            </div>';
 							$actionVideo = ' <a href="#" id="openModVideo'.$row['Id'].'"><i class="fa fa-youtube fa-3x fa-fw text-red"></i></a>
                                            <script>
                                                $(document).ready(function(){ 
                                                    $("#openModVideo'.$row['Id'].'").on("click",function(){
                                                        $("#ModaleVideo'.$row['Id'].'").modal("show"); 
                                                    });
                                                });
                                            </script>';  

                            $action = ' <div class="btn-group dropdown-split-default"  id="azioniPrev">
                                            <a type="button"  class="cursore dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-ellipsis-h fa-2x fa-fw"></i>
                                            </a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item waves-effect waves-light" href="#" id="modifica'.$row['Id'].'"><i class="fa fa-edit text-orange"></i> Modifica </a>
                                                <script>
                                                    $(document).ready(function(){ 
                                                        $("#modifica'.$row['Id'].'").on("click",function(){
                                                            $("#ModaleUpdateTemplateCustom'.$row['Id'].'").modal("show"); 
                                                            '.($checkLastCustomT == true?
                                                            '
                                                                $("#viewVideoInput'.$row['Id'].'").show(); 
                                                                $("#viewImmagine2Input'.$row['Id'].'").hide();
                                                                $("#viewFont'.$row['Id'].'").hide();
                                                                $("#viewBgColor'.$row['Id'].'").hide();
                                                                $("#view2Color'.$row['Id'].'").hide();
                                                            '
                                                            :'').'
                                                        });
                                                    });
                                                </script>
                                                '.($row['Visibile']==0?
                                                '<a class="dropdown-item waves-effect waves-light" href="#" id="abilita'.$row['Id'].'"><i class="fa fa-eye text-green"></i> Visibile <span class="f-10">(in crea proposta)</span></a>'
                                                :
                                                '<a class="dropdown-item waves-effect waves-light" href="#" id="disabilita'.$row['Id'].'"><i class="fa fa-eye-slash text-gray"></i> Non Visibile  <span class="f-10">(in crea proposta)</span></a>'
                                                ).'
                                                <script>
                                                    $(document).ready(function(){ 
                                                        $("#abilita'.$row['Id'].'").on("click",function(){
                                                            $.ajax({
                                                                url: "'.BASE_URL_SITO.'ajax/templates/switch_template.php",
                                                                type: "POST",
                                                                data: "action=switch_t&idsito='.$row['idsito'].'&id='.$row['Id'].'&Visibile=1",
                                                                dataType: "html",
                                                                success: function(data) {
                                                                    $("#template_custom").DataTable().ajax.reload();    
                                                                }
                                                            });
                                                            return false;
                                                        });
                                                        $("#disabilita'.$row['Id'].'").on("click",function(){
                                                            $.ajax({
                                                                url: "'.BASE_URL_SITO.'ajax/templates/switch_template.php",
                                                                type: "POST",
                                                                data: "action=switch_t&idsito='.$row['idsito'].'&id='.$row['Id'].'&Visibile=0",
                                                                dataType: "html",
                                                                success: function(data) {
                                                                    $("#template_custom").DataTable().ajax.reload();    
                                                                }
                                                            });
                                                            return false;                                                           
                                                        });
                                                    });
                                                </script>  
                                            </div>
                                        </div>';  
                                        
                            $selectOrdine = '  <select class="form-control ordina" id="OrdineRow'.$row['Id'].'" name="OrdineRow" style="height:auto;padding:2px!important;width:80%!important">
                                                    <option value="0" '.($row['Ordine']==''?'selected="selected"':'').'></option>                       
                                                    <option value="1" '.($row['Ordine']==1?'selected="selected"':'').'>1</option>
                                                    <option value="2" '.($row['Ordine']==2?'selected="selected"':'').'>2</option>
                                                    <option value="3" '.($row['Ordine']==3?'selected="selected"':'').'>3</option>
                                                    <option value="4" '.($row['Ordine']==4?'selected="selected"':'').'>4</option>
                                                    <option value="5" '.($row['Ordine']==5?'selected="selected"':'').'>5</option>
                                                    <option value="6" '.($row['Ordine']==6?'selected="selected"':'').'>6</option>
                                                    <option value="7" '.($row['Ordine']==7?'selected="selected"':'').'>7</option>
                                                    <option value="8" '.($row['Ordine']==8?'selected="selected"':'').'>8</option>
                                                    <option value="9" '.($row['Ordine']==9?'selected="selected"':'').'>9</option>
                                                    <option value="10" '.($row['Ordine']==10?'selected="selected"':'').'>10</option>
                                                </select>
                                                <script>
                                                    $(document).ready(function(){ 
                                                        $("#OrdineRow'.$row['Id'].'").on("change",function(){
                                                            var OrdineRow = $("#OrdineRow'.$row['Id'].' option:selected").val(); 
                                                                $.ajax({
                                                                    url: "'.BASE_URL_SITO.'ajax/templates/ordine_template.php",
                                                                    type: "POST",
                                                                    data: "action=order_template&idsito='.$row['idsito'].'&Id='.$row['Id'].'&OrdineRow="+OrdineRow+"",
                                                                    dataType: "html",
                                                                    success: function(data) {
                                                                        $("#template_custom").DataTable().ajax.reload();    
                                                                    }
                                                                });
                                                                return false;                                
                                                        });
                                                    });
                                                </script>';


							$data[] = array(
                                        "ico"        => '<img class="p-r-5" src="'.BASE_URL_SITO.'img/'.$row['Thumb'].'" style="width:40px" data-toggle="tooltip" title="Template '.$row['TemplateName'].'">',
                                        "nome"       => $row['TemplateName'],
                                        "font"       => ($checkLastCustomT == true?'<span class="f-10">Setting Font non contemplato</span>':$row['Font']),
                                        "colore"     => ($checkLastCustomT == true?'<span class="f-10">Setting Colore non contemplato</span>':'<label class="badge f-11" style="background:'.$row['Background'].'">'.$row['Background'].'</label>'),
                                        "pulsante"   => ($checkLastCustomT == true?'<span class="f-10">Setting Colore secondario non contemplato</span>':'<label class="badge f-11" style="background:'.$row['Pulsante'].'">'.$row['Pulsante'].'</label>'),
                                        "top"        => ($row['Immagine']!=''?'<a href="'.BASE_URL_SITO.'uploads/'.$row['idsito'].'/'.$row['Immagine'].'" data-lightbox="roadtrip"><img src="'.BASE_URL_SITO.'class/resize.class.php?src='.BASE_PATH_SITO.'uploads/'.$row['idsito'].'/'.$row['Immagine'].'&w=140&a=c&q=100"></a>':''),
                                        "background" => ($row['Immagine2']!=''?'<a href="'.BASE_URL_SITO.'uploads/'.$row['idsito'].'/'.$row['Immagine2'].'" data-lightbox="roadtrip"><img src="'.BASE_URL_SITO.'class/resize.class.php?src='.BASE_PATH_SITO.'uploads/'.$row['idsito'].'/'.$row['Immagine2'].'&w=140&a=c&q=100"></a>':($checkLastCustomT == true?'<span class="f-10">Input Immagine secondaria non contemplato</span>':'')),
                                        "video"      => ($checkLastCustomT == true?($row['Video']!=''?$actionVideo.$modaleVideo:''):'<span class="f-10">Input YouTube Video non contemplato</span>'),
                                        "ordine"     => '<span class="ordinamento">'.$row['Ordine'].'</span>'.$selectOrdine,
                                        "visibile"   => ($row['Visibile']==0?'<i class="fa fa-eye-slash text-gray"></i>':'<i class="fa fa-eye text-green"></i>'),
                                        "action"     => $action.$modale,
          
							);
                           
                            $checkLastCustomT = false;
                            
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
