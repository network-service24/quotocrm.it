<?
/**
 ** Elimina la prenotaziome esterna
 */
if($_REQUEST['azione']!='' && $_REQUEST['param']=='delete'){

    $dbMysqli->query("DELETE FROM hospitality_guest WHERE Id = '".$_REQUEST['azione']."'");
    $prt->_goto(BASE_URL_SITO.'checkinonline-prenotazioni_esterne/');
}
/**
 ** Alert per send avvenuto con successo
 */
if($_REQUEST['azione'] == 'checkin' && $_REQUEST['param'] == 'ok') {
    $content =  '<div class="alert alert-success" id="alertSend">
                    Email per il Check-in Online inviata con successo.
                </div>
                <script>
                    $(document).ready(function(){
                        setTimeout(function(){ 
                            $("#alertSend").hide("slow");
                        }, 2000);
                    })
                </script>';
}

$giorniCheckin = $fun->check_recall_checkinonline(IDSITO);
if($giorniCheckin!='' || $giorniCheckin=='0'){
    $boxCheckin ='  <div class="row">
                            <div class="col-md-1"><i class="fa fa-send-o fa-2x fa-fw text-black"></i></div>
                            <div class="col-md-11">E-mail per il <b>Check-In OnLine</b> del cliente è configurata in automatico <b>' . ($giorniCheckin != '' && $giorniCheckin != 0 ? ': ' . $giorniCheckin . ' ' . ($giorniCheckin == 1 ? 'giorno' : 'giorni') . ' prima ' : ' il giorno stesso ') . ' dal CheckIn</b></div>
                        </div>'."\r\n";
}


# INTERFACCIA CRUD DATATABLE
$content .='   <!-- Table datatable-->
               <table id="esterne" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';

$content .='               
                            <th class="notexport">Op</th>
                            <th>Nr.</th>
                            <th>Fonte</th>
                            <th>Tipo</th>
                            <th>Data</th>
                            <th>Nome e Cognome</th>
                            <th>Email</th>
                            <th class="notexport">Lg</th>
                            <th>Arrivo</th>
                            <th>Partenza</th>
                            <th>A</th>
                            <th>B</th>                         
                            <th>Prenotazione</th>
                            <th>Notifiche</th>'."\r\n";

$content .='                <th>Azioni</th>
                        </tr>
                    </thead>

                </table> '."\r\n";
$content .='<style>
                #azioniPrev .dropdown-toggle::after {
                    display: none !important;

                }
            </style>'."\r\n";
# CODICE JS PER ESECUZIONE INSERT,UPDATE;DELETE E DATATABLE
$content .='<script>

            $(document).ready(function() {'."\r\n";


$content .='   
                //INIZIALIZZO I TOOLTIP
                $(\'[data-tooltip="tooltip"]\').tooltip();


                // CONFIG DATATABLE
                var table = $("#esterne").DataTable( {

                    responsive: true,
                    processing:true,
                    oLanguage: {sProcessing: "<div class=\'cell preloader5 loader-block\'><div class=\'circle-5 l loader-warning\'></div><div class=\'circle-5 m loader-warning\'></div><div class=\'circle-5 r loader-warning\'></div></div><span class=\'text-primary f-w-400 f-14 f-s-intial\'>QUOTO! sta caricando i dati...<br><span class=\'\'>Attendere!!</span></span>"},
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
                        buttons: [,                       
                    \'pageLength\',                    
                        {
                            extend: \'collection\',
                            className: \'buttonExport\',
                            text: \'Esporta\',
                            buttons: [  
                                { 
                                    extend: \'excel\', 
                                    text: \'Excel\',
                                    exportOptions: {
                                        columns: \':not(.notexport)\'
                                    }, 
                                },  
                                { 
                                    extend: \'print\', 
                                    text: \'Stampa\',
                                    exportOptions: {
                                        columns: \':not(.notexport)\'
                                    }, 
                                }
                                
                            ]
                        },
                        /*{ extend: \'colvis\', text: \'Colonne visibili\' }*/
                    ],			
                    "ajax": "'.BASE_URL_SITO.'crud/proposte/prenotazioni_esterne.crud.php?idsito='.IDSITO.'",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='    
                        { "data": "op","class":"text-center"},
                        { "data": "nr"},          
                        { "data": "fonte"},
                        { "data": "tipo"},
                        { "data": "data","type":"date","class":"text-center"}, 
                        { "data": "cliente"}, 
                        { "data": "email","class":"text-center"}, 
                        { "data": "lingua","class":"text-center"}, 
                        { "data": "arrivo","type":"date","class":"text-center"}, 
                        { "data": "partenza","type":"date","class":"text-center"}, 
                        { "data": "a","class":"text-center"}, 
                        { "data": "b","class":"text-center"},
                        { "data": "data_chiuso","type":"date","class":"text-center"}, 
                        { "data": "check","class":"text-center"},'."\r\n";

        $content .='    { "data": "action","class":"text-center"}
                    ],';

        $content .='    "columnDefs": [
                           {"targets": [0,6,7,10,11,13,14], "orderable": false}

                        ],

                    })'."\r\n";      
     
    

    $content .='   // ORDINAMENTO TABELLA
                    table.order( [ 1, \'DESC\' ] ).draw();

                    $("#esterne_processing").removeClass("card"); 
                   

                    '."\r\n";


$content .='
                    $(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");
                    $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");'."\r\n";


$content .='})
        </script>';


?>
