<?
$record     = $fun->getContentComunicazioni($_REQUEST['azione']);
$Id         = $record[0]['Id']; 
$DataInizio = $record[0]['DataInizio'];   
$DataFine   = $record[0]['DataFine'];   
$Titolo     = $record[0]['Titolo'];   
$Testo      = $record[0]['Testo'];   
$Abilitato  = $record[0]['Abilitato'];   
$Visibile   = $record[0]['Visibile'];   

$content .= '<p><a href="'.BASE_URL_ADMIN.'comunicazioni/" class="btn btn-grd-warning btn-sm"><i class="fa fa-arrow-left fa-fw"></i> Torna alle comunicazioni</a></p>';

$content .= ' <form name="form_update" id="form_update" method="post" action="'.BASE_URL_ADMIN.'ajax/comunicazioni/update_comunicazioni.php" >
                    <div id="load_db_date"></div>
                    <input type="hidden" id="id_update" name="Id" value="'.$Id.'">  
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8 text-right">
                            <div id="view_form_loading_up"></div>
                            <button type="submit" class="btn btn-success btn-sm btn-out-dotted" id="btn_save_up"><i class="fa fa-save fa-fw"></i> Modifica record</button>     
                        </div>
                        <div class="col-md-2"></div>
                    </div>  
                    <div style="width:100%;height:30px"></div>  
                    <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">'."\r\n";
                        
$content .= '        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 text-right">
                                    <label>Data Inizio</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-male"></i></span>
                                        <input type="date" class="form-control" id="DataInizio_update"  name="DataInizio" value="'.$DataInizio.'" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 text-right">
                                    <label>Data Fine</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa-fw fa fa-user-secret"></i></span>
                                        <input type="date" class="form-control" id="DataFine_update"  name="DataFine" value="'.$DataFine.'" required />
                                    </div>
                                </div>
                            </div>
                        </div>


                    <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 text-right">
                                    <label>Titolo</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-envelope"></i></span>
                                        <input type="text" class="form-control" id="Titolo_update"  name="Titolo" value="'.$Titolo.'"  required/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 text-right">
                                    <label>Testo</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <textarea class="form-control Width100" id="Testo_update"  name="Testo">'.$Testo.'</textarea>
                                        <!-- Custom js -->
                                        <script type="text/javascript" src="'.BASE_URL_SITO.'js/ckeditor/ckeditor.js"></script>
                                        <script>    
                                            $(function() {
                                                    CKEDITOR.replace(\'Testo\');
                                                    $(".textarea").wysihtml5();                                 
                                            });                                                                           
                                            CKEDITOR.config.toolbar = [
                                                        [\'Source\',\'-\',\'Maximize\'],
                                                        [\'Bold\',\'Italic\',\'Underline\',\'StrikeThrough\',\'-\',\'Cut\',\'Copy\',\'Paste\',\'PasteText\',\'PasteFromWord\',\'-\',\'Outdent\',\'Indent\',\'NumberedList\',\'BulletedList\',\'-\',\'JustifyLeft\',\'JustifyCenter\',\'JustifyRight\',\'JustifyBlock\',\'Table\',\'Image\',\'Link\',\'TextColor\',\'BGColor\'],
                                                     ] ; 
                                            CKEDITOR.config.autoGrow_onStartup = true;
                                            CKEDITOR.config.extraPlugins = \'autogrow\';
                                            CKEDITOR.config.autoGrow_minHeight = 100;
                                            CKEDITOR.config.autoGrow_maxHeight = 300;
                                            CKEDITOR.config.width = 800;
                                            CKEDITOR.config.autoGrow_bottomSpace = 50;           
                                    </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 text-right">
                                    <label>Abilitato</label> 
                                </div>
                                <div class="col-md-9">
                                    <input type="checkbox" id="Abilitato_update"  name="Abilitato"  '.($Abilitato==1?'checked="checked"':'').' value="'.$Abilitato.'"/>  
                                </div>
                            </div>
                        </div>
                         <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 text-right">
                                    <label>Visibile</label> 
                                </div>
                                <div class="col-md-9">
                                    <input type="checkbox" id="Visibile_update"  name="Visibile" '.($Visibile==1?'checked="checked"':'').' value="'.$Visibile.'" /> 
                                </div>
                            </div>
                        </div>
                       '."\r\n";                  

$content .='     <div class="form-group text-right">
                       <input type="hidden" name="action" value="update" />
                       <input type="hidden" name="tabella" value="comunicazioni" />
                       <input type="hidden" name="order" value="Id" />
                       <input type="hidden" name="typeorder" value="DESC" />
                       <div id="view_form_loading_down"></div>
                       <button type="submit" class="btn btn-success btn-sm" id="btn_save_down"><i class="fa fa-save fa-fw"></i> Modifica record</button>              
                   </div>
               </div>
               <div class="col-md-2"></div>
               </div>
               </form>'."\r\n";


# CODICE JS PER ESECUZIONE INSERT,UPDATE;DELETE E DATATABLE
$content .='<script>
            $(document).ready(function() {

                // VALORIZZO I CHECKBOX PER INSERT
                $("#Abilitato").click(function() {
                    if($("#Abilitato").is(":checked")){
                        $("#Abilitato").attr("value","1");
                        $("#Abilitato").attr("checked",true);
                    }else{
                        $("#Abilitato").attr("value","0");
                        $("#Abilitato").attr("checked",false);
                    }
                });
                $("#Visibile").click(function() {
                    if($("#Visibile").is(":checked")){
                        $("#Visibile").attr("value","1");
                        $("#Visibile").attr("checked",true);
                    }else{
                        $("#Visibile").attr("value","0");
                        $("#Visibile").attr("checked",false);
                    }
                });
                
                $(\'[data-tooltip="tooltip"]\').tooltip();


                // VALORIZZO I CHECKBOX PER UPDATE
                $("#Abilitato_update").click(function() {
                    if($("#Abilitato_update").is(":checked")){
                        $("#Abilitato_update").attr("value","1");
                        $("#Abilitato_update").attr("checked",true);
                    }else{
                        $("#Abilitato_update").attr("value","0");
                        $("#Abilitato_update").attr("checked",false);
                    }
                });
                $("#Visibile_update").click(function() {
                    if($("#Visibile_update").is(":checked")){
                        $("#Visibile_update").attr("value","1");
                        $("#Visibile_update").attr("checked",true);
                    }else{
                        $("#Visibile_update").attr("value","0");
                        $("#Visibile_update").attr("checked",false);
                    }
                });

            });


            </script>';
?>