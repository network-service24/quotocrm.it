<?
$check_pms5 = $fun->check_5stelle_pms(IDSITO);
$check_pmsB = $fun->check_bedzzlePMS(IDSITO);
$check_pmsE = $fun->check_ericsoftpms(IDSITO);

$variabili .= '&action='.$_REQUEST['action'].'';
$variabili .= '&TipoSoggiorno='.$_REQUEST['TipoSoggiorno'].'';
$variabili .= '&NumeroPrenotazione='.$_REQUEST['NumeroPrenotazione'].'';
$variabili .= '&Operatore='.$_REQUEST['Operatore'].'';
$variabili .= ($_REQUEST['DataInvio']!=''?'&DataInvio='.$_REQUEST['DataInvio']:'');
$variabili .= '&FontePrenotazione='.$_REQUEST['FontePrenotazione'].'';
$variabili .= '&TipoVacanza='.$_REQUEST['TipoVacanza'].'';
$variabili .= '&Nome='.$_REQUEST['Nome'].'';
$variabili .= '&Cognome='.$_REQUEST['Cognome'].'';
$variabili .= '&Email='.$_REQUEST['Email'].'';
$variabili .= '&NoDisponibilita='.$_REQUEST['NoDisponibilita'].'';
$variabili .= '&DataScadenza='.$_REQUEST['DataScadenza'].'';
$variabili .= '&DataArrivo='.$_REQUEST['DataArrivo'].'';
$variabili .= '&DataPartenza='.$_REQUEST['DataPartenza'].'';
$variabili .= '&DataRichiesta_dal='.$_REQUEST['DataRichiesta_dal'].'';
$variabili .= '&DataRichiesta_al='.$_REQUEST['DataRichiesta_al'].'';
$variabili .= '&Lingua='.$_REQUEST['Lingua'].'';
$variabili .= '&Aperture='.$_REQUEST['Aperture'].'';
$variabili .= '&chat='.$_REQUEST['chat'].'';

$contoAllaRovescia = $fun->contoallarovescia(MINUTI_RICARICA,'conferme');


$giorniRecall = $fun->check_recall_conferme(IDSITO);
if($giorniRecall!='' || $giorniRecall=='0'){
    $boxRecall = '  <button class="btn btn-primary btn-sm f-left cursore" id="closeButtonBoxInfo">
                        Chiudi box autoresponder attivi <i class="fa fa-times" data-toggle="tooltip" title="Chiudi box sincronizzazioni e autoresponder attivi"></i>
                    </button> 
                    <button class="btn btn-primary btn-sm f-left cursore" id="openButtonBoxInfo">
                         Visualizza autoresponder attivi <i class="fa fa-angle-double-down" data-toggle="tooltip" title="Visualizza sincronizzazioni e autoresponder attivi"></i>
                    </button> 
                    <div class="clearfix p-b-10"></div>
                    <div class="row row-eq-height"  id="boxInfo">
                            <div class="col-md-6">
                            <div class="card col-eq-height">
                                <div class="card-header">
                                    <h5 class="text-primary">AUTORESPONDER CONFERME</h5>                                                                                        
                                </div>
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-md-1"><i class="fa fa-send-o fa-2x fa-fw text-black"></i></div>
                                        <div class="col-md-11">E-mail di ReCall Conferme è configurata per l\'invio automatico: <b>'.$giorniRecall .' giorni prima</b> della Scadenza</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>'; 
}
# INTERFACCIA CRUD DATATABLE
$content .='   <!-- Table datatable-->
               <table id="conferme" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';

$content .='               <th></th>
                            <th>Op</th>
                            <th>Nr.</th>
                            <th>Fonte</th>
                            <th>Target</th>
                            <th><span data-toggle="tooltip" title="Data Richiesta">Data</span></th>
                            <th>Nome e Cognome</th>
                            <th>Email</th>
                            <th><span data-toggle="tooltip" title="Lingua">Lg</span></th>
                            <th>Arrivo</th>
                            <th>Partenza</th>
                            <th>A</th>
                            <th>B</th>
                            <th><span data-toggle="tooltip" title="Data e metodo d\'invio">Invio</span></th>
                            <th>Aperto</th>  
                            <th>Chat</th>                           
                            <th><span data-toggle="tooltip" title="Data Scadenza">Scadenza</span></th>
                            <th>Notifiche</th>'."\r\n";
if($check_pms5==1 || $check_pmsB==1 || $check_pmsE==1){
    $content .='             <th style="width:5%">PMS</th>'."\r\n";
}                            
$content .='                 <th>Azioni</th>
                        </tr>
                    </thead>

                </table> '."\r\n";

# CODICE JS PER ESECUZIONE INSERT,UPDATE;DELETE E DATATABLE
$content .='<script>
            //FUNZIONI UTILI A POPOLARE IL TABELLARE RIGA PER RIGA IN AJAX
                function get_operatore(Operatore, idsito, id){

                    $("#get_operatore_pre"+id+"").html(\'<img src="'.BASE_URL_SITO.'img/loader_performance.gif" style="width:40px;height:10px" />\');
                    $("#get_operatore"+id+"").load("'.BASE_URL_SITO.'ajax/preventivi/get_operatore.php?idsito="+idsito+"&id="+id+"&Operatore="+Operatore+"", function() {
                        $("#get_operatore_pre"+id+"").hide();
                    });
                }
                function conta_click(id, idsito, data_invio, data_scadenza){

                    $("#conta_click_pre"+id+"").html(\'<img src="'.BASE_URL_SITO.'img/loader_performance.gif" style="width:40px;height:10px" />\');
                    $("#conta_click"+id+"").load("'.BASE_URL_SITO.'ajax/preventivi/conta_click.php?idsito="+idsito+"&id="+id+"&data_invio="+data_invio+"&data_scadenza="+data_scadenza+"", function() {
                        $("#conta_click_pre"+id+"").hide();
                    });
                }
                function func_chat_column(NumeroPrenotazione, DataInvio, DataScadenza, DataChiuso, DataArrivo, idsito, id, provenienza){

                    $("#func_chat_column_pre"+id+"").html(\'<img src="'.BASE_URL_SITO.'img/loader_performance.gif" style="width:40px;height:10px" />\');
                    $("#func_chat_column"+id+"").load("'.BASE_URL_SITO.'ajax/preventivi/func_chat_column.php?idsito="+idsito+"&id="+id+"&NumeroPrenotazione="+NumeroPrenotazione+"&DataInvio="+DataInvio+"&DataScadenza="+DataScadenza+"&DataChiuso="+DataChiuso+"&DataArrivo="+DataArrivo+"&provenienza="+provenienza+"", function() {
                        $("#func_chat_column_pre"+id+"").hide();
                    });
                }
            // FINE
            //FUNZIONE CHE POPOLA CONTENUTI INPUT PER LA MODIFICA
            function get_content_update(id){

                   $.ajax({								 
                        type: "POST",								 
                        url: "'.BASE_URL_SITO.'crud/proposte/conferme.update.crud.php",								 
                        data: "id="+id,
                        dataType: "html",
                            success: function(data){
                                $("#load_db_date").html(data);
                            },
                            error: function(){
                                alert("Chiamata fallita, si prega di riprovare..."); 
                            }
                    });  
                        
            }
            $(document).ready(function() {'."\r\n";


$content .='   //EQUALIZZO BOX DETTAGLI
                var highestBox = 400;
                var heigthRow = $("#boxInfo").height();
                var new_height = (heigthRow - 20);
                $(".row-eq-height").each(function() {
                    var heights = $(this).find(".col-eq-height").map(function() {
                    return $(this).outerHeight();
                        }).get(), maxHeight = Math.max.apply(null, heights);
                        $(this).find(".col-eq-height").outerHeight(maxHeight);
                });

                //INIZIALIZZO I TOOLTIP
                $(\'[data-tooltip="tooltip"]\').tooltip();


                // CONFIG DATATABLE
                var table = $("#conferme").DataTable( {
                    order: [[2, \'desc\'],[5, \'desc\']], 
                    responsive: true,
                    processing:true,
                    oLanguage: {sProcessing: "<div class=\'cell preloader5 loader-block\'><div class=\'circle-5 l loader-primary\'></div><div class=\'circle-5 m loader-primary\'></div><div class=\'circle-5 r loader-primary\'></div></div><span class=\'text-primary f-w-400 f-14 f-s-intial\'>QUOTO! sta caricando i dati...<br><span class=\'\'>Attendere!!</span></span>"},
                    "paging": true,
						"pagingType": "simple_numbers",    
						"language": {
							 "search": "Filtro rapido:",
							 "info": "Visualizza pagina _PAGE_ di _PAGES_ per _TOTAL_ righe",
                             "emptyTable": " ",
							 "paginate": {
								 "previous": "Precedente",
								 "next":"Successivo",
							 },
							 buttons: {
								pageLength: {                                
									_: "Mostra %d record",
                                    \'-1\': "Mostra tutto"
								}
							}
						},
                        dom: \'Bfrtip\',
						lengthMenu: [
							[ 30, 40, 60, 100, -1 ],
							[ \'30 record\', \'40 record\', \'60 record\', \'100 record\', \'Tutti\' ]
                        ],	
                        buttons: [
                        {
                            text:      \'<i class="fa fa-square-o fa-2x fa-fw"></i> seleziona\',
                            titleAttr: \'Seleziona tutti\',
                            className: \'buttonSelect\',
                            attr: {id: \'buttSelect\'},
                            action: function () {
                                $(".seleziona").prop("checked", true);

                            }
                        },
                        {
                            text:      \'<i class="fa fa-check-square-o fa-2x fa-fw"></i> deseleziona\',
                            titleAttr: \'Togli selezione a tutti\',
                            className: \'buttonUnSelect\',
                            attr: {id: \'buttUnSelect\'},
                            action: function () {
                                $(".seleziona").prop("checked", false);
                            }
                        },
                        {
                            text:      \'<i class="fa fa-2x fa-fw '.($_REQUEST['chat']=='last_contact'?'fa-comments-o text-red':'fa-comments text-black').'"></i> '.($_REQUEST['chat']=='last_contact'?'Reset Ultime Chat':'Ultime Chat').'\',
                            titleAttr: \'Ultime Chat\',
                            className: \'buttonSelezioni\',
                            attr: {id: \'check_last_chat\'},
                            action: function () {
                                '.($_REQUEST['chat']=='last_contact'?'document.location=\''.BASE_URL_SITO.'conferme/\';':'$("#form_last_contact").submit();').'
                            }
                        },
                        {
                            text:      \'<i class="fa fa-inbox fa-2x fa-fw"></i> Archivia\',
                            titleAttr: \'Archivia conferme selezionati\',
                            className: \'buttonSelezioni\',
                            attr: {id: \'archivia_all\'},
                            action: function () {
                              
                                    var checkbox_value = "";
                                    $("input[name=Id]").each(function () {
                                        var ischecked = $(this).is(":checked");
                                        if (ischecked) {
                                            checkbox_value += $(this).val() + ",";
                                        }
                                    });
                                    if(checkbox_value){
                                        if (window.confirm("ATTENZIONE: Sicuro di voler archiviare i conferme selezionati?")){
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/generici/archivia_all.php",
                                                type: "POST",
                                                data: "idsito='.IDSITO.'&checkbox_value="+checkbox_value,
                                                dataType: "html",
                                                success: function(data) {
                                                            _alert("<i class=\"fa fa-inbox \"></i> Esito:","Conferma/e sono state archiviate!"); 
                                                            setTimeout(function(){
                                                                location.reload();
                                                            }, 1000);  
                                                    }
                                            });
                                            return false; // con false senza refresh della pagina
                                        }
                                    }else{
                                            _alert("<i class=\"fa fa-inbox \"></i> Attenzione:","Selezionare prima di cliccare il pulsante!"); 
                                    }

                            }
                        },
                         {
                            text:      \'<i class="fa fa-trash fa-2x fa-fw"></i> Cestina \',
                            titleAttr: \'Cestina conferme selezionati\',
                            className: \'buttonSelezioni\',
                            attr: {id: \'delete_all\'},
                            action: function () {
                                    var checkbox_value = "";
                                    $("input[name=Id]").each(function () {
                                        var ischecked = $(this).is(":checked");
                                        if (ischecked) {
                                            checkbox_value += $(this).val() + ",";
                                        }
                                    });
                                    if(checkbox_value){
                                        if (window.confirm("ATTENZIONE: Sicuro di voler mettere le richieste selezionate nel cestino?")){
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/generici/delete_all.php",
                                                type: "POST",
                                                data: "idsito='.IDSITO.'&cestino=1&checkbox_value="+checkbox_value,
                                                dataType: "html",
                                                success: function(data) {
                                                            _alert("<i class=\"fa fa-trash \"></i> Esito:","Conferma/e sono state cestinate!"); 
                                                            setTimeout(function(){
                                                                location.reload();
                                                            }, 1000);   
                                                    }
                                            });
                                            return false; // con false senza refresh della pagina
                                        }

                                    }else{
                                            _alert("<i class=\"fa fa-trash \"></i> Attenzione:","Selezionare prima di cliccare il pulsante!"); 

                                    }
                            }
                        },                        
                        {

                            text:      \'<i class="fa fa-search fa-2x fa-fw"></i> Ricerca avanzata\',
                            titleAttr: \'Ricerca Avanzata\',
                            className: \'buttonSearch\',
                            attr: {id: \'buttonSearch\'},
                            action: function ( e, dt, node, config ) {
                                $("#myModalASearch").modal("show");
                            }
                        },
                    \'pageLength\',                    
                    /* {
                            extend: \'collection\',
                            className: \'buttonExport\',
                            text: \'Esporta\',
                            buttons: [  
                                { extend: \'copy\', text: \'Copia\' },
                                { extend: \'excel\', text: \'Excel\' },  
                                { extend: \'print\', text: \'Stampa\' },
                                
                            ]
                        },
                        { extend: \'colvis\', text: \'Colonne visibili\' }*/
                    ],			
                    "ajax": "'.BASE_URL_SITO.'crud/proposte/conferme.crud.php?idsito='.IDSITO.''.$variabili.'",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='    { "data": "id","class":"text-center"},
                        { "data": "op","class":"text-center"},
                        { "data": "nr","class":"text-center"},          
                        { "data": "fonte"},
                        { "data": "tipo"},
                        { "data": "data","type":"date","class":"text-center nowrap"}, 
                        { "data": "cliente"}, 
                        { "data": "email","class":"text-center"}, 
                        { "data": "lingua","class":"text-center"}, 
                        { "data": "arrivo","type":"date","class":"text-center nowrap"}, 
                        { "data": "partenza","type":"date","class":"text-center nowrap"}, 
                        { "data": "a","class":"text-center"}, 
                        { "data": "b","class":"text-center"},
                        { "data": "invio","type":"date","class":"text-center"},
                        { "data": "aperto","class":"text-center"},
                        { "data": "chat","class":"text-center"},
                        { "data": "scadenza","class":"text-center nowrap"}, 
                        { "data": "check","class":"text-center"},'."\r\n"; 
    if($check_pms5==1 || $check_pmsB==1 || $check_pmsE==1){ 
        $content .='    { "data": "pms","class":"text-center"},'."\r\n"; 
    }                        
        $content .='    { "data": "action","class":"text-center"}
                    ],';
     if($check_pms5==1 || $check_pmsB==1 || $check_pmsE==1){                    
        $content .='    "columnDefs": [
                           {"targets": [0,1,7,8,11,12,14,15,17,18,19], "orderable": false}

                        ],

                    })'."\r\n"; 
     }else{

        $content .='    "columnDefs": [
                           {"targets": [0,1,7,8,11,12,13,14,15,17,18], "orderable": false}

                        ]
                    })'."\r\n";      
     }   

        $content .='
                    $("#conferme_processing").removeClass("card"); 

                    $(\'#conferme tbody\').on( \'click\', \'td:last-child\', function () {

                        $(\'#conferme tbody\').find("i").removeClass("colorArrow");
                        $(\'#conferme tbody\').find("td").removeClass("selected");
                        $(\'#conferme tbody\').find("a[title=\"Timeline\"]").removeClass("linkNumP");

                        if ($(this).hasClass(\'selected\') ) {

                            $(this).removeClass(\'selected\');
                            $(this).parent().find("td").removeClass(\'selected\');
                            $(this).parent().find("a[title=\"Timeline\"]").removeClass("linkNumP");
                            $(this).find("i").removeClass("colorArrow");
                            $("#infobox").hide(300);
                            $("#closeButtonInfoBox").hide(300);

                        }else{

                            table.$(\'td:last-child.selected\').removeClass(\'selected\');
                            $(this).parent().find("td").addClass(\'selected\');
                            $(this).find("i").addClass("colorArrow");
                            $(this).parent().find("a[title=\"Timeline\"]").addClass("linkNumP");
                            $("#infobox").show(300);
                            $("#closeButtonInfoBox").show(300);                                                                               
                            if($("#boxInfo").is(":visible")){
                                $("html, body").animate({  
                                    scrollTop: 350
                                }, 200);
                            }else{
                                $("html, body").animate({  
                                    scrollTop: 0
                                }, 200);

                            }                         
                        } 
                    });                    

                    '."\r\n";


$content .='      
                        if($("input[class=\'seleziona\']").prop(\'checked\')==true) {
                            $("button[class=\'dt-button buttonUnSelect\']").show();
                            $("button[class=\'dt-button buttonSelect\']").hide();
                        }else{
                            $("button[class=\'dt-button buttonUnSelect\']").hide();
                            $("button[class=\'dt-button buttonSelect\']").show();
                        }
                        
                        $("button[class=\'dt-button buttonSelect\']").on("click",function(){
                            $("button[class=\'dt-button buttonUnSelect\']").show();
                            $("button[class=\'dt-button buttonSelect\']").hide();
                        });
                        $("button[class=\'dt-button buttonUnSelect\']").on("click",function(){
                            $("button[class=\'dt-button buttonUnSelect\']").hide();
                            $("button[class=\'dt-button buttonSelect\']").show();
                        });'."\r\n";


$content .='        $("#boxInfo").hide();    
                    $("#openButtonBoxInfo").show();
                    $("#closeButtonBoxInfo").hide();
                    $("#closeButtonBoxInfo").on("click",function(){
                            $("#closeButtonBoxInfo").hide();
                            $("#openButtonBoxInfo").show();
                            $("#boxInfo").hide(300);                           
                    });
                     $("#openButtonBoxInfo").on("click",function(){
                            $("#openButtonBoxInfo").hide();
                            $("#closeButtonBoxInfo").show();
                            $("#boxInfo").show(300);                           
                    }); 

                    $(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");
                    $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");'."\r\n";

$content .='})
        </script>';

if($fun->check_configurazioni(IDSITO,'check_notifiche_push')==1){
    $content .= $fun->notifica_mancata_click(IDSITO,'Conferma');
    $content .= '<script>$( document ).ready(function() {if(ContatoreConferme > 0){open_notifica("Ciao <b>" + NomeHotel + "</b> ricordati che hai ancora <b class=\"text16\">" + ContatoreConferme + "</b> conferme da inviare"," ","plain","bottom-right","error",5000,"#000000");}});</script>'."\r\n";
}
/** CODICE PER FILTRO ULTIME CHAT */
$content .= '   <form name="form_last_contact" id="form_last_contact" method="POST" action="'.$_SERVER['REQUEST_URI'].'">
                    <input type="hidden" name="idsito" value="'.IDSITO.'">
                    <input type="hidden" name="chat" value="last_contact">
                </form>'."\r\n";

/** CODICE PER FAR RIAPRIRE IL BOX DI DETTAGLIO DELLA STESSA CONFERMA MODIFICATA */
if($_REQUEST['id_conferma']){
    $content .= '   <script>
                        $(document).ready(function(){
                            get_content_update('.$_REQUEST['id_conferma'].');  
                            setTimeout(function() { 
                                $("#row_'.$_REQUEST['id_conferma'].'").find("td").addClass(\'selected\');
                            }, 2000);
                        });
                    </script>'."\r\n";
}
?>
