<?
$NumeroRecord = $fun->countRowsPrenotazioni(IDSITO);
if($NumeroRecord > NUMERO_RECORD){ 

            // ----------------------------------------------------------------
            //    C A L C O L O   D E L   N U M E R O   D I   P A G I N E
            $righe_per_pagina = RIGHE_PER_PAGINA;
            $url_base = BASE_URL_SITO."prenotazioni/";
            $pagine_vicine = PAGINE_VICINE;
            // ricavo il numero totale di record
            $tot_righe = $fun->numeroRecordPrenotazioni(IDSITO);
            // totale pagine
            $tot_pagine = ceil($tot_righe / $righe_per_pagina);

            // ----------------------------------------------------------------
            //                 P A G I N A   C O R R E N T E
            $pagina_corrente = isset($_GET['pag']) ? (int)$_GET['pag'] : 1;
            // se la pagina corrente è minore di 1
            if($pagina_corrente < 1)  {
            header('location: ' . $url_base);
            exit();
            }
            // se la pagina corrente è maggiore dell'ultima pagina
            if($pagina_corrente > $tot_pagine) {
            header('location: ' . $fun->crea_url($url_base, $tot_pagine));
            exit();
            }
            //               M E N U  P A G I N A Z I O N E
            $link_paginazione = $fun->paginazione($tot_pagine, $url_base, $pagina_corrente, $pagine_vicine);
            // ----------------------------------------------------------------
            # VARIABILI
            $variabili .= '&pagina_corrente='.$pagina_corrente.'';
            $variabili .= '&righe_per_pagina='.$righe_per_pagina.'';

}
$check_pms5 = $fun->check_5stelle_pms(IDSITO);
$check_pmsB = $fun->check_bedzzlePMS(IDSITO);
$check_pmsE = $fun->check_ericsoftpms(IDSITO);

$variabili .= '&action='.$_REQUEST['action'].'';
$variabili .= '&Operatore='.$_REQUEST['Operatore'].'';
$variabili .= '&TipoSoggiorno='.$_REQUEST['TipoSoggiorno'].'';
$variabili .= '&TipoCamere='.$_REQUEST['TipoCamere'].'';
$variabili .= '&NumeroPrenotazione='.$_REQUEST['NumeroPrenotazione'].'';
$variabili .= '&TipoRichiesta='.$_REQUEST['TipoRichiesta'].'';
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
$variabili .= '&Chiuso='.$_REQUEST['Chiuso'].'';
$variabili .= '&Disdetta='.$_REQUEST['Disdetta'].'';
$variabili .= '&IdMotivazione='.$_REQUEST['IdMotivazione'].'';
$variabili .= '&CS_inviato='.$_REQUEST['CS_inviato'].'';
$variabili .= '&CheckConsensoPrivacy='.$_REQUEST['CheckConsensoPrivacy'].'';
$variabili .= '&CheckConsensoMarketing='.$_REQUEST['CheckConsensoMarketing'].'';
$variabili .= '&Archivia='.$_REQUEST['Archivia'].'';
$variabili .= '&Hidden='.$_REQUEST['Hidden'].'';
$variabili .= '&DataPrenotazione_dal='.$_REQUEST['DataPrenotazione_dal'].'';
$variabili .= '&DataPrenotazione_al='.$_REQUEST['DataPrenotazione_al'].'';
$variabili .= '&Arrivo_dal='.$_REQUEST['Arrivo_dal'].'';
$variabili .= '&Arrivo_al='.$_REQUEST['Arrivo_al'].'';
$variabili .= '&campagna='.$_REQUEST['campagna'].'';

$contoAllaRovescia = $fun->contoallarovescia(MINUTI_RICARICA,'prenotazioni');


$giorniReselling = $fun->check_recall_reselling(IDSITO);
if($giorniReselling!='' || $giorniReselling == '0'){
    $boxReselling ='  <div class="row">
                            <div class="col-md-1"><i class="fa fa-send-o fa-2x fa-fw text-black"></i></div>
                            <div class="col-md-11">E-mail di <b>Benvenuto</b> e/o di ReSelling è configurata per l\'invio automatico <b>' . ($giorniReselling != '' && $giorniReselling != 0 ? ': ' . $giorniReselling . ' ' . ($giorniReselling == 1 ? 'giorno' : 'giorni') . ' dopo ' : ' il giorno stesso ') . ' il CheckIn</b></div>
                        </div>'."\r\n";
}
$giorniPrecheckin = $fun->check_recall_precheckin(IDSITO);
if($giorniPrecheckin!='' || $giorniPrecheckin =='0'){
    $boxPrecheckin ='  <div class="row">
                            <div class="col-md-1"><i class="fa fa-send-o fa-2x fa-fw text-black"></i></div>
                            <div class="col-md-11">E-mail di <b>Pre-Checkin</b> e/o Informativa è configurata per l\'invio automatico <b>' . ($giorniPrecheckin != '' && $giorniPrecheckin != 0 ? ': ' . $giorniPrecheckin . ' ' . ($giorniPrecheckin == 1 ? 'giorno' : 'giorni') . ' prima ' : ' il giorno stesso ') . ' dal CheckIn</b></div>
                        </div>'."\r\n";
}
$giorniCheckin = $fun->check_recall_checkinonline(IDSITO);
if($giorniCheckin!='' || $giorniCheckin=='0'){
    $boxCheckin ='  <div class="row">
                            <div class="col-md-1"><i class="fa fa-send-o fa-2x fa-fw text-black"></i></div>
                            <div class="col-md-11">E-mail per il <b>Check-In OnLine</b> del cliente è configurata in automatico <b>' . ($giorniCheckin != '' && $giorniCheckin != 0 ? ': ' . $giorniCheckin . ' ' . ($giorniCheckin == 1 ? 'giorno' : 'giorni') . ' prima ' : ' il giorno stesso ') . ' dal CheckIn</b></div>
                        </div>'."\r\n";
}
$giorniRecensioni = $fun->check_recall_recensioni(IDSITO);
if($giorniRecensioni!='' || $giorniRecensioni=='0'){
    $boxRecensioni ='  <div class="row">
                            <div class="col-md-1"><i class="fa fa-send-o fa-2x fa-fw text-black"></i></div>
                            <div class="col-md-11">L\'invio della Richiesta Recensioni <b>TripAdvisor</b> è configurata in automatico <b>' . ($giorniRecensioni != '' && $giorniRecensioni != 0 ? ': ' . $giorniRecensioni . ' ' . ($giorniRecensioni == 1 ? 'giorno' : 'giorni') : ' il giorno stesso ') . ' dal CheckOut</b></div>
                        </div>'."\r\n";
}
$giorniCS = $fun->check_recall_cs(IDSITO);
if($giorniCS!='' || $giorniCS=='0'){
    $boxCS ='  <div class="row">
                    <div class="col-md-1"><i class="fa fa-send-o fa-2x fa-fw text-black"></i></div>
                    <div class="col-md-11">L\'invio del <b>Questionario</b> è configurato in automatico <b>' . ($giorniCS != '' && $giorniCS != 0 ? ': ' . $giorniCS . ' ' . ($giorniCS == 1 ? 'giorno' : 'giorni') : ' il giorno stesso ') . ' dal CheckOut</b></div>
                </div>'."\r\n";
}
if($giorniReselling!='' || $giorniPrecheckin!='' || $giorniCheckin!='' || $giorniRecensioni!='' || $giorniCS!=''){
    $boxRecall = '  <button class="btn btn-primary btn-sm f-left cursore" id="closeButtonBoxInfo">
                        Chiudi box autoresponder attivi <i class="fa fa-times" data-toggle="tooltip" title="Chiudi box autoresponder attivi"></i>
                    </button> 
                    <button class="btn btn-primary btn-sm f-left cursore" id="openButtonBoxInfo">
                        Visualizza autoresponder attivi <i class="fa fa-angle-double-down" data-toggle="tooltip" title="Visualizza autoresponder attivi"></i>
                    </button> 
                    <div class="clearfix p-b-10"></div>
                    <div class="row row-eq-height"  id="boxInfo">
                        <div class="col-md-6">
                            <div class="card col-eq-height">
                                <div class="card-header">
                                    <h5 class="text-primary">AUTORESPONDER ATTIVI</h5>                                                                                        
                                </div>
                                <div class="card-block">
                                    '.$boxReselling.$boxPrecheckin.$boxCheckin.$boxRecensioni.$boxCS.'
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card col-eq-height">
                                <div class="card-header">
                                    <h5 class="text-primary">LEGENDA</h5>                                                                                        
                                </div>
                                <div class="card-block f-12">
                                    <div class="row">
                                        <div class="col-md-1"><i class="fa fa-exclamation-circle fa-2x fa-fw text-black"></i></div>
                                        <div class="col-md-11">
                                            Se il filtro della ricerca avanzata non dovesse produrre risultati e comunque siete in possesso di una nominativo cliente che ha soggiornato presso la vostra struttura, <b>probabilmente</b> fa riferimento ad una <b>prenotazione esterna</b> inserita manualmente dal <b>modulo di check-in online.</b>
                                            '.($check_pmsE==1?'
                                            <br><br>
                                            <b>La sincronizzazioni con il PMS EricSoft è attiva:</b>
                                            <style>
                                                    .ul_legend {
                                                        padding-left: 10;
                                                        list-style-type:circle;
                                                        margin-bottom: 0;
                                                    }
                                            </style>
                                            <ul class="ul_legend">
                                                <li>Il Bot di Ericsoft passa circa ogni mezz\'ora; il loro codice inserisce le prenotazioni che trova in QUOTO sul PMS.</li>
                                                <li>Se si è modificata la prenotazione con QUOTO e si vuole modificarla di conseguenza anche sul PMS; si deve cliccare sul pulsante con icona di modifica (che subito dopo scomparirà).</li>
                                                <li>Se si desidera cancellare una prenotazione inserita nel PMS si deve cliccare sul pulsante con icona del cestino (che subito dopo scomparirà).</li>
                                                <li>Il passaggio immediatamente successivo deve essere quello di CESTINARE la prenotazione stessa, cliccando sul pulsante in fondo a destra "Elimina".</li>
                                                <li> Altrimenti al passaggio dopo quello della cancellazione il Bot di Ericsoft potrebbe ricaricarla nuovamente sul PMS.</li>
                                            </ul>':'').'       
                                        </div>
                                    </div>
                                    <div class="clearfix p-b-20"></div>                               
                                </div>
                            </div>
                        </div>
                    </div>  '."\r\n";                    
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
                            <th>Chat</th>                    
                            <th><span data-toggle="tooltip" title="Data Prenotazione">Prenotazione</span></th>
                            <th style="width:12%">Notifiche</th>'."\r\n";

if($check_pms5==1 || $check_pmsB==1 || $check_pmsE==1){
    $content .='             <th style="width:6%">PMS</th>'."\r\n";
}                            


$content .='                <th>Azioni</th>
                        </tr>
                    </thead>

                </table> '."\r\n";
$content .= '<div class="dataTables_info" id="conferme_info_serverSide" role="status" aria-live="polite">Visualizza pagina '.($_GET['pag']==''?1:$_GET['pag']).' di '.$tot_pagine.' per '.$tot_righe.' righe</div>'."\r\n";
$content .= $link_paginazione.''."\r\n";
$content .='<style>
                '.($NumeroRecord > NUMERO_RECORD?'
                .pagination{
                    position:absolute!important;
                    right:20px!important;
                }
                #conferme_info{
                    display: none !important;
                } 
                .buttons-page-length {
                    display: none !important;
                }
                ':'
                #conferme_info_serverSide{
                    display: none !important;
                } 
                ').' 
            </style>'."\r\n";
# CODICE JS PER ESECUZIONE INSERT,UPDATE;DELETE E DATATABLE
$content .='<script>
            //FUNZIONI UTILI A POPOLARE IL TABELLARE RIGA PER RIGA IN AJAX
            function get_operatore(Operatore, idsito, id){

                $("#get_operatore_pre"+id+"").html(\'<img src="'.BASE_URL_SITO.'img/loader_performance.gif" style="width:40px;height:10px" />\');
                $("#get_operatore"+id+"").load("'.BASE_URL_SITO.'ajax/preventivi/get_operatore.php?idsito="+idsito+"&id="+id+"&Operatore="+Operatore+"", function() {
                    $("#get_operatore_pre"+id+"").hide();
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
                        url: "'.BASE_URL_SITO.'crud/proposte/prenotazioni.update.crud.php",								 
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

                    responsive: true,
                    processing:true,
                    oLanguage: {sProcessing: "<div class=\'cell preloader5 loader-block\'><div class=\'circle-5 l loader-warning\'></div><div class=\'circle-5 m loader-warning\'></div><div class=\'circle-5 r loader-warning\'></div></div><span class=\'text-primary f-w-400 f-14 f-s-intial\'>QUOTO! sta caricando i dati...<br><span class=\'\'>Attendere!!</span></span>"},
                    "paging": '.($NumeroRecord > NUMERO_RECORD?'false':'true').',
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
                            text:      \'<i class="fa fa-send fa-2x fa-fw"></i> Aggiungi a '.NOME_CLIENT_EMAIL.' \',
                            titleAttr: \'Aggiungi a  '.NOME_CLIENT_EMAIL.'\',
                            className: \'buttonSelezioni\',
                            attr: {id: \'add_all_newsletter\'},
                            action: function () {
                                    var checkbox_value = "";
                                    $("input[name=Id]").each(function () {
                                        var ischecked = $(this).is(":checked");
                                        if (ischecked) {
                                            checkbox_value += $(this).val() + ",";
                                        }
                                    });

                                    if(checkbox_value){
                                        if (window.confirm("ATTENZIONE: Sicuro di voler aggiungere questo/i utente/i a E-MESSENGER?")){

                                            $("#modale_upselling").load("'.BASE_URL_SITO.'ajax/generici/add_inlist_mailing.php?idsito='.IDSITO.'&checkbox="+checkbox_value);

                                        }

                                    }else{
                                        _alert("<i class=\"fa fa-inbox \"></i> Esito:","<b>Selezionare</b> le prenotazioni prima di cliccare il pulsante!"); 
                                    }
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
                                                            _alert("<i class=\"fa fa-inbox \"></i> Esito:","Prenotazione/i sono state archiviate!"); 
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
                            text:      \'<i class="fa fa-user fa-2x fa-fw"></i> Cestina \',
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
                                                            _alert("<i class=\"fa fa-trash \"></i> Esito:","Prenotazione/i sono state cestinate!"); 
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

                                { extend: \'excel\', text: \'Excel\' },  
                                { extend: \'copy\', text: \'Copia\' },
                                { extend: \'print\', text: \'Stampa\' },
                                
                            ]
                        },
                        { extend: \'colvis\', text: \'Colonne visibili\' }*/
                    ],			
                    "ajax": "'.BASE_URL_SITO.'crud/proposte/prenotazioni.crud.php?idsito='.IDSITO.''.$variabili.'",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='    { "data": "id","class":"text-center"},
                        { "data": "op","class":"text-center"},
                        { "data": "nr","class":"text-center"},          
                        { "data": "fonte"},
                        { "data": "tipo"},
                        { "data": "data","class":"text-center nowrap"}, 
                        { "data": "cliente"}, 
                        { "data": "email","class":"text-center"}, 
                        { "data": "lingua","class":"text-center"}, 
                        { "data": "arrivo","class":"text-center nowrap"}, 
                        { "data": "partenza","class":"text-center nowrap"}, 
                        { "data": "a","class":"text-center"}, 
                        { "data": "b","class":"text-center"},
                        { "data": "chat","class":"text-center"},
                        { "data": "data_chiuso","class":"text-center nowrap"}, 
                        { "data": "check","class":"text-center"},'."\r\n";
    if($check_pms5==1 || $check_pmsB==1 || $check_pmsE==1){ 
        $content .='    { "data": "pms","class":"text-center"},'."\r\n"; 
    }    
        $content .='    { "data": "action","class":"text-center"}
                    ],';
    if($check_pms5==1 || $check_pmsB==1 || $check_pmsE==1){    
        $content .='    "columnDefs": [
                           {"targets": [0,1,7,8,11,12,13,15,16,17], "orderable": false}

                        ],'."\r\n";
    }else{
        $content .='    "columnDefs": [
                           {"targets": [0,1,7,8,11,12,13,15,16], "orderable": false}

                        ],'."\r\n";  
    }
        $content .='})'."\r\n";      
     
    

    $content .='   // ORDINAMENTO TABELLA
                    table.order( [ 14, \'DESC\' ] ).draw();

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

                    '.($NumeroRecord > NUMERO_RECORD?'$("#preventivi_filter").hide();':'$(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");').'
                    $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");'."\r\n";



$content .='})
        </script>
        <div id="modale_upselling"></div>';

/** CODICE PER FAR RIAPRIRE IL BOX DI DETTAGLIO DELLO STESSO PREVENTIVO MODIFICATO */
if($_REQUEST['id_prenotazione']){
    $content .= '   <script>
                        $(document).ready(function(){
                            get_content_update('.$_REQUEST['id_prenotazione'].');  
                            setTimeout(function() { 
                                $("#row_'.$_REQUEST['id_prenotazione'].'").find("td").addClass(\'selected\');
                            }, 2000);
                        });
                    </script>'."\r\n";
}

?>
