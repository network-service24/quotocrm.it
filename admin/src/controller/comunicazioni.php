<?
    # VARIABILI DI SETTINGS
    $nomeTabella    = 'comunicazioni';
    $parametro      = 'Id';
    # INTERFACCIA PER INSERIMENTO DATI
    $content .= '<!--<p><button type="button" class="btn btn-grd-primary btn-sm" id="aggiungi"><i class="fa fa-plus fa-fw"></i> Aggiungi record</button></p>-->';
    $content .= '<div id="add" style="display:none">
                 <div class="p-20 z-depth-right-1 waves-effect">
                 <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="row">
                                <div class="col-md-3 text-right">                            
                                </div>
                                <div class="col-md-9">
                                    <h2>Aggiungi un nuovo record!</h2>
                                </div>
                            </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <div style="width:100%;height:30px"></div>';
    $content .= ' <form name="form_insert" id="form_insert" method="post" action="'.BASE_URL_ADMIN.'ajax/comunicazioni/insert_comunicazioni.php">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8 text-right">
                            <div id="view_form_ins_loading_up"></div>
                            <button type="submit" class="btn btn-success btn-sm btn-out-dotted" id="btn_save_ins_up"><i class="fa fa-save fa-fw"></i> Salva nuovo record</button>     
                        </div>
                        <div class="col-md-2"></div>
                    </div>  
                    <div style="width:100%;height:30px"></div>  
                    <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">'."\r\n";
    $content .= '      
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 text-right">
                                    <label>Data Inizio</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-male"></i></span>
                                        <input type="date" class="form-control" id="DataInizio"  name="DataInizio"  required />
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
                                        <input type="date" class="form-control" id="DataFine"  name="DataFine"  required />
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
                                        <input type="text" class="form-control" id="Titolo"  name="Titolo" required/>
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
                                        <textarea class="form-control Width100" id="Testo" rows="3" name="Testo"></textarea>
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
                                    <input type="checkbox" id="Abilitato" value="1" checked="checked" name="Abilitato" />   
                                </div>
                            </div>
                        </div>
                         <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 text-right">
                                    <label>Visibile</label> 
                                </div>
                                <div class="col-md-9">
                                    <input type="checkbox" id="Visibile" value="1" checked="checked" name="Visibile" />   
                                </div>
                            </div>
                        </div>
                       '."\r\n";

    $content .='     <div class="form-group text-right">
                            <input type="hidden" name="action" value="insert" />
                            <input type="hidden" name="tabella" value="'.$nomeTabella.'" />
                            <input type="hidden" name="order" value="Id" />
                            <input type="hidden" name="typeorder" value="DESC" />
                            <div id="view_form_ins_loading_down"></div>
                            <button type="submit" class="btn btn-success btn-sm" id="btn_save_ins_down"><i class="fa fa-save fa-fw"></i> Salva nuovo record</button>              
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                    </div>
                    </form>'."\r\n";

$content .='</div>
            <br><br>
            </div>'."\r\n";

# INTERFACCIA PER MODIFICA DATI
$content .=' <button type="button" class="btn btn-info btn-sm btn-out" id="chiudi_update" style="display:none"><i class="fa fa-minus fa-fw"></i> Chiudi finestra modifica</button>
                <div id="mod" style="display:none"><br><br>
                    <div class="p-20 z-depth-right-1 waves-effect">  
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="row">
                                    <div class="col-md-3 text-right">                            
                                    </div>
                                    <div class="col-md-9">
                                        <h2>Modifica il record!</h2>
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    <div style="width:100%;height:30px"></div>'."\r\n";                    
$content .= ' <form name="form_update" id="form_update" method="post" action="'.BASE_URL_ADMIN.'ajax/comunicazioni/update_comunicazioni.php" >
                    <div id="load_db_date"></div>
                    <input type="hidden" id="id_update" name="Id">  
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
                                        <input type="date" class="form-control" id="DataInizio_update"  name="DataInizio"  required />
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
                                        <input type="date" class="form-control" id="DataFine_update"  name="DataFine"  required />
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
                                        <input type="text" class="form-control" id="Titolo_update"  name="Titolo" required/>
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
                                        <textarea class="xcrud-texteditor form-control editor-loaded" id="Testo_update"  name="Testo"></textarea>
                                        <script>
                                            $(function() {
                                                setTimeout(function() { 
                                                    CKEDITOR.replace(\'Testo_update\');
                                                    var editor = $(".textarea").wysihtml5();    
                                                }, 2000);   
                           
                                            });
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
                                    <input type="checkbox" id="Abilitato_update"  name="Abilitato" />  
                                </div>
                            </div>
                        </div>
                         <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 text-right">
                                    <label>Visibile</label> 
                                </div>
                                <div class="col-md-9">
                                    <input type="checkbox" id="Visibile_update"  name="Visibile" /> 
                                </div>
                            </div>
                        </div>
                       '."\r\n";                  

$content .='     <div class="form-group text-right">
                       <input type="hidden" name="action" value="update" />
                       <input type="hidden" name="tabella" value="'.$nomeTabella.'" />
                       <input type="hidden" name="order" value="Id" />
                       <input type="hidden" name="typeorder" value="DESC" />
                       <div id="view_form_loading_down"></div>
                       <button type="submit" class="btn btn-success btn-sm" id="btn_save_down"><i class="fa fa-save fa-fw"></i> Modifica record</button>              
                   </div>
               </div>
               <div class="col-md-2"></div>
               </div>
               </form>'."\r\n";

$content .='</div>
       <br><br>
       </div>'."\r\n";

# INTERFACCIA CRUD DATATABLE
$content .='   
                <!-- Table datatable-->
                <table id="'.$nomeTabella.'" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';

$content .='                <th>Id</th>
                            <th>Data Inizio</th>
                            <th>Data Fine</th>
                            <th>Titolo</th>
                            <th>Testo</th>
                            <th>Abilitato</th>
                            <th>Visibile</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    
                </table>

            </div>'."\r\n";



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

                // CONFIG DATATABLE
                var table = $("#'.$nomeTabella.'").DataTable( {

                    responsive: true,
                    processing:true,
                    oLanguage: {sProcessing: "<div class=\'loader-block\' style=\'z-index:9999999!important\'><div class=\'preloader6\'><hr></div></div><span class=\'text-info f-w-400 f-14 f-s-intial\'>QUOTO! Manager sta caricando i dati...<br><span class=\'\'>Attendere!!</span></span>"},
                    "paging": true,
						"pagingType": "simple_numbers",    
						"language": {
							 "search": "Filtra i risultati:",
							 "info": "Visualizza pagina _PAGE_ di _PAGES_ per _TOTAL_ righe",
                             "emptyTable": " ",
							 "paginate": {
								 "previous": "Precedente",
								 "next":"Successivo",
							 },
							 buttons: {
								pageLength: {
									_: "Mostra %d elementi",
                                    \'-1\': "Mostra tutto"
								}
							}
						},
                        dom: \'Bfrtip\',
						lengthMenu: [
							[ 10, 25, 50, 100, -1 ],
							[ \'10 risultati\', \'25 risultati\', \'50 risultati\', \'100 risultati\', \'Tutti\' ]
                        ],	
                        buttons: [ \'pageLength\',
                        {
                            text:      \'<i class="fa fa-plus fa-2x fa-fw"></i> Aggiungi\',
                            className: \'buttonSelezioni  f-left p-r-10\',
                            attr: {id: \'aggiungi\'},
                        },
                        {
                            extend: \'collection\',
                            className: \'buttonExport\',
                            text: \'Esporta\',
                            buttons: [  
                                { extend: \'copy\', text: \'Copia\' }, 
                                { extend: \'excel\', text: \'Excel\' },  
                                { extend: \'csv\', text: \'CSV\' },  
                                { extend: \'pdf\', text: \'PDF\' },  
                                { extend: \'print\', text: \'Stampa\' }
                            ]
                        },
                    ],					
                    "ajax": "'.BASE_URL_ADMIN.'crud/comunicazioni.crud.php",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='    { "data": "Id" ,"class":"text-center"},
                        { "data": "DataInizio" ,"type":"date","class":"text-center"},
                        { "data": "DataFine" ,"type":"date","class":"text-center"},
                        { "data": "Titolo" },
                        { "data": "Testo","class":"text-center" },
                        { "data": "Abilitato", "class":"text-center"},
                        { "data": "Visibile","class":"text-center"},
                        { "data": "action","class":"text-center"}
                    ],					
                    "columnDefs": [
						 {"targets": [3,4,5,6], "orderable": false}
					]';

    $content .=' }); 

                // ORDINAMENTO TABELLA
                table.order( [ 0, \'DESC\' ] ).draw();
                $(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");
                $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");
                $("#comunicazioni_processing").removeClass("card");

                // SLIDE TOOGLE
                $( "#aggiungi" ).click(function() {
                    $( "#add" ).slideToggle( "slow", function() {
                        // Animation complete.
                    });
                });
 
                $("#chiudi_update").on("click",function(){
                    $("#mod").hide("slow");
                    $("#aggiungi").show("slow");
                    $("#chiudi_update").hide("slow");
                    $("#chiudi_update_down").hide("slow");
                });
                $("#chiudi_update_down").on("click",function(){
                    $("#mod").hide("slow");
                    $("#aggiungi").show("slow");
                    $("#chiudi_update_down").hide("slow");
                    $("#chiudi_update").hide("slow");
                });

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

            //FUNZIONE CHE POPOLA CONTENUTI INPUT PER LA MODIFICA
            function get_content_update(id){


                    $("#chiudi_update").show(300);
                    $("#chiudi_update_down").show(300);
                    $("#mod").show(300);
                    $("#add").hide(300);
                    $("#aggiungi").hide(300);

                   
                   $.ajax({								 
                        type: "POST",								 
                        url: "'.BASE_URL_ADMIN.'crud/date.update.comunicazioni.crud.php",								 
                        data: "tabella='.$nomeTabella.'&parametro='.$parametro.'&id=" + id,
                        dataType: "html",
                            success: function(data){
                                $("#load_db_date").html(data);
                                scroll(\'mod\', 50, 5000); 
                                $("#chiudi_insert").hide(300);
                                $("#chiudi_insert_top").hide(300);
                            },
                            error: function(){
                                alert("Chiamata fallita, si prega di riprovare..."); 
                            }
                    });  
                        
            }
            function get_delete(id){
                var tabella = "'.$nomeTabella.'";
                var action  = "delete";
                var param   = "'.$parametro.'";
                var table   = $(\'#'.$nomeTabella.'\').DataTable();

                    $.ajax({
                        url: "'.BASE_URL_ADMIN.'crud/comunicazioni.crud.php",
                        type: "POST",
                        data: "action="+action+"&tabella="+tabella+"&id="+id+"&param="+param,
                        success: function(data){
                                _alert("<i class=\"fa fa-remove\"></i> Eliminazione record","Record cancellato con successo!"); 
                                table.ajax.reload();
                        },
                        error: function(){
                            alert("Chiamata fallita, si prega di riprovare...");
                        }
                    });
                    return false; // con false senza refresh della pagina
                
            }
            </script>';
?>