<?
    # VARIABILI DI SETTINGS
    $nomeTabella    = 'utenti_admin';
    $parametro      = 'idutente';
   
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
    $content .= ' <form name="form_insert" id="form_insert" method="post" >
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
                                    <label>Username</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-male"></i></span>
                                        <input type="text" class="form-control" id="username"  name="username" placeholder="username" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 text-right">
                                    <label>Password</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa-fw fa fa-user-secret"></i></span>
                                        <input type="text" class="form-control" id="password"  name="password" placeholder="password" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 text-right">
                                    <label>Blocco Accesso</label> 
                                </div>
                                <div class="col-md-9">
                                    <input type="checkbox" id="blocco_accesso" value="1" name="blocco_accesso" />   
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                        <div class="row">
                            <div class="col-md-3 text-right">
                                <label>Data Creazione</label>
                            </div>
                            <div class="col-md-9">
                                <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                    <input type="date" class="form-control" id="data_creazione_"  name="data_creazione" required />
                                    <!--<input type="hidden"  id="data_creazione" name="data_creazione" />-->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 text-right">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-envelope"></i></span>
                                        <input type="text" class="form-control" id="utente_email"  name="utente_email" placeholder="email" required/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 text-right">
                                    <label>Nome</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-edit"></i></span>
                                        <input type="text" class="form-control" id="utente_nome"  name="utente_nome" placeholder="nome"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 text-right">
                                    <label>Cognome</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-edit"></i></span>
                                        <input type="text" class="form-control" id="utente_cognome"  name="utente_cognome" placeholder="cognome"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                       '."\r\n";

    $content .='     <div class="form-group text-right">
                            <input type="hidden" name="action" value="insert" />
                            <input type="hidden" name="tabella" value="'.$nomeTabella.'" />
                            <input type="hidden" name="order" value="idutente" />
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
$content .= ' <form name="form_update" id="form_update" method="post" >
                    <div id="load_db_date"></div>
                    <input type="hidden" id="id_update" name="id">  
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
$content .= '           <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 text-right"><label>ID Utente</label></div>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-barcode"></i></span>
                                        <input type="text" class="form-control" id="idutente_update" name="idutente" readonly="readonly" />
                                    </div>
                                </div>
                            </div>
                        </div>  '."\r\n"; 
                        
$content .= '   
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 text-right">
                                    <label></label>
                                </div>
                                <div class="col-md-9">
                                    <div id="logo_view"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3 text-right">
                                            <label>Logo</label>
                                        </div>
                                        <div class="col-md-9">
                                            <small class="text-info">Una volta scelto il file, non dimenticare di cliccare sul pulsante "Upload"</small>
                                            <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-tasks"></i></span>
                                            <input type="file" class="form-control"  name="file_logo" id="file_logo">
                                            <button type="button" class="btn btn-mini" id="btn_upload">Upload</button>
                                            </div>
                                            <div id="result_file"></div>
                                            <input type="hidden"  id="logo" name="logo" />
                                        </div>
                                    </div>

                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 text-right">
                                    <label>Username</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-male"></i></span>
                                        <input type="text" class="form-control" id="username_update"  name="username" placeholder="username"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 text-right">
                                    <label>Password</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa-fw fa fa-user-secret"></i></span>
                                        <input type="text" class="form-control" id="password_update"  name="password" placeholder="password"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 text-right">
                                    <label>Blocco Accesso</label> 
                                </div>
                                <div class="col-md-9">
                                    <input type="checkbox" id="blocco_accesso_update"   name="blocco_accesso"/>   
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                        <div class="row">
                            <div class="col-md-3 text-right">
                                <label>Data Creazione</label>
                            </div>
                            <div class="col-md-9">
                                <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                    <input type="date" class="form-control" id="data_creazione_update_"  name="data_creazione" />
                                    <!--<input type="hidden"  id="data_creazione_update"  name="data_creazione" />-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 text-right">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-envelope"></i></span>
                                        <input type="text" class="form-control" id="utente_email_update"  name="utente_email" placeholder="email"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 text-right">
                                    <label>Nome</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-edit"></i></span>
                                        <input type="text" class="form-control" id="utente_nome_update"  name="utente_nome" placeholder="nome"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 text-right">
                                    <label>Cognome</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-edit"></i></span>
                                        <input type="text" class="form-control" id="utente_cognome_update"  name="utente_cognome" placeholder="cognome"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                       '."\r\n";                  

$content .='     <div class="form-group text-right">
                       <input type="hidden" name="action" value="update" />
                       <input type="hidden" name="tabella" value="'.$nomeTabella.'" />
                       <input type="hidden" name="order" value="idutente" />
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

$content .='                <th>idutente</th>
                            <th>Logo</th>
                            <th>Nome</th>
                            <th>Cognome</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Email</th>
                            <th>Accesso</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    
                </table>

            </div>'."\r\n";


# CODICE JS PER ESECUZIONE INSERT,UPDATE;DELETE E DATATABLE
$content .='<script>
            $(document).ready(function() {

                $(\'[data-tooltip="tooltip"]\').tooltip();

                // CONFIG DATATABLE
                var table = $("#'.$nomeTabella.'").DataTable( {

                    responsive: true,
                    processing:true,
                                       oLanguage: {sProcessing: "<div class=\'loader-block\' style=\'z-index:9999999!important\'><div class=\'preloader3\'><div class=\'circ1 loader-warning\'></div><div class=\'circ2 loader-warning\'></div><div class=\'circ3 loader-warning\'></div><div class=\'circ4 loader-warning\'></div></div></div><span class=\'text-warning f-w-400 f-13 f-s-intial\'>QUOTO! Manager sta caricando i dati...<br><span class=\'\'>Attendere!!</span></span>"},
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
                    "ajax": "'.BASE_URL_ADMIN.'crud/superuser.crud.php",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='    { "data": "idutente" ,"class":"text-center"},
                        { "data": "logo" ,"class":"text-center"},
                        { "data": "nome" },
                        { "data": "cognome" },
                        { "data": "username" },
                        { "data": "password","class":"text-center"},
                        { "data": "email" ,"class":"text-center"},
                        { "data": "blocca_accesso","class":"text-center"},
                        { "data": "action","class":"text-center"}
                    ],					
                    "columnDefs": [
						 {"targets": [1,2,3,4,5,6,7,8], "orderable": false}
					]';

    $content .=' }); 

                // ORDINAMENTO TABELLA
                table.order( [ 0, \'DESC\' ] ).draw();
                $(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");
                $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");

                $("#utenti_admin_processing").removeClass("card");

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
                $("#blocco_accesso_update").click(function() {
                    if($("#blocco_accesso_update").is(":checked")){
                        $("#blocco_accesso_update").attr("value","1");
                    }else{
                        $("#blocco_accesso_update").attr("value","0");
                        $("#blocco_accesso_update").attr("checked",false);
                    }
                });
                $("#is_admin_update").click(function() {
                    if($("#is_admin_update").is(":checked")){
                        $("#is_admin_update").attr("value","1");
                    }else{
                        $("#is_admin_update").attr("value","0");
                        $("#is_admin_update").attr("checked",false);
                    }
                });


                // INSERT
                $("#form_insert").submit(function(){
                    var dati  = $("#form_insert").serialize();
                    var table = $(\'#'.$nomeTabella.'\').DataTable();

                    $("#view_form_ins_loading_up").html(\'<div class="col-md-12 text-center"><div class="loader-block"><div class="preloader3"><div class="circ1 loader-warning"></div><div class="circ2 loader-warning"></div><div class="circ3 loader-warning"></div><div class="circ4 loader-warning"></div></div></div></div><div class="col-md-12 text-center"><small class="text-success">Salvataggio in corso..., attendere il termine!</small></div>\');
                    $("#view_form_ins_loading_down").html(\'<div class="col-md-12 text-center"><div class="loader-block"><div class="preloader3"><div class="circ1 loader-warning"></div><div class="circ2 loader-warning"></div><div class="circ3 loader-warning"></div><div class="circ4 loader-warning"></div></div></div></div><div class="col-md-12 text-center"><small class="text-success">Salvataggio in corso..., attendere il termine!</small></div>\');
                    $("#bnt_save_ins_up").hide();   
                    $("#bnt_save_ins_down").hide();

                        $.ajax({
                            url: "'.BASE_URL_ADMIN.'crud/superuser.crud.php",
                            type: "POST",
                            data: dati,
                                success: function(data) {
                                    _alert("<i class=\"fa fa-plus\"></i> Aggiunta record","Aggiunto record con successo!");  
                                    $("#add").slideToggle();                         
                                    table.ajax.reload();
                                    $("#view_form_ins_loading_up").hide();
                                    $("#view_form_ins_loading_down").hide();
                                    $("#bnt_save_ins_up").show();   
                                    $("#bnt_save_ins_down").show();
                                },
                                error: function(){
                                    alert("Chiamata fallita, si prega di riprovare...");
                                }
                        });
                        return false; // con false senza refresh della pagina
                    });
				//CARICO IL LOGO										
                $("#btn_upload").on("click",function(){
                    formdata = new FormData();
                    if($("#file_logo").prop(\'files\').length > 0)
                    {
                        file =$("#file_logo").prop(\'files\')[0];
                        formdata.append("file_logo", file);
                    }
                    $.ajax({
                        url: "' . BASE_URL_ADMIN . 'ajax/superuser/upload_logo_superuser.php",
                        type: "POST",
                        data: formdata,
                        processData: false,
                        contentType: false,
                        success: function (result) {
                            console.log(result);
                            if(result != ""){
                        
                                $("#logo").val(result);
                                $("#result_file").html("<small class=\"text-green\">Il file è stato caricato con successo!</small>");
                            }else{
                                $("#result_file").html("<small class=\"text-red\">Prima di cliccare sul pulsante \"Upload\", scegli il file da caricare sul server!</small>");
                            }
                        }
                    });
                    return false;
                });
														
                // UPDATE
                $("#form_update").submit(function(){
                    var dati = $("#form_update").serialize();
                    var table = $(\'#'.$nomeTabella.'\').DataTable();

                    $("#view_form_loading_up").html(\'<div class="col-md-12 text-center"><div class="loader-block"><div class="preloader3"><div class="circ1 loader-warning"></div><div class="circ2 loader-warning"></div><div class="circ3 loader-warning"></div><div class="circ4 loader-warning"></div></div></div></div><div class="col-md-12 text-center"><small class="text-success">Salvataggio in corso..., attendere il termine!</small></div>\');
                    $("#view_form_loading_down").html(\'<div class="col-md-12 text-center"><div class="loader-block"><div class="preloader3"><div class="circ1 loader-warning"></div><div class="circ2 loader-warning"></div><div class="circ3 loader-warning"></div><div class="circ4 loader-warning"></div></div></div></div><div class="col-md-12 text-center"><small class="text-success">Salvataggio in corso..., attendere il termine!</small></div>\');
                    $("#bnt_save_up").hide();   
                    $("#bnt_save_down").hide();


                        $.ajax({
                            url: "'.BASE_URL_ADMIN.'ajax/superuser/update_utente_admin.php",
                            type: "POST",
                            data: dati,
                            success: function(data){
                                _alert("<i class=\"fa fa-edit\"></i> Modifica record","Record aggiornato con successo!");  
                                    table.ajax.reload();
                                    $("#mod").slideToggle();   
                                    $("#chiudi_update").hide();
                                    $("#view_form_loading_up").hide();
                                    $("#view_form_loading_down").hide();
                                    $("#bnt_save_up").show();   
                                    $("#bnt_save_down").show();
                            },
                            error: function(){
                                alert("Chiamata fallita, si prega di riprovare...");
                            }
                        });
                        return false; // con false senza refresh della pagina
                });


            });

            //FUNZIONE CHE POPOLA CONTENUTI INPUT PER LA MODIFICA
            function get_content_update(id){

                var idutente = id;

                    $("#chiudi_update").show(300);
                    $("#chiudi_update_down").show(300);
                    $("#mod").show(300);
                    $("#add").hide(300);
                    $("#aggiungi").hide(300);

                   
                   $.ajax({								 
                        type: "POST",								 
                        url: "'.BASE_URL_ADMIN.'crud/date.update.superuser.crud.php",								 
                        data: "tabella='.$nomeTabella.'&parametro='.$parametro.'&id=" + idutente,
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
                        url: "'.BASE_URL_ADMIN.'crud/superuser.crud.php",
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