<?

if($_REQUEST['azione']!='' && $_REQUEST['param']=='delete'){
        $dbMysqli->query("UPDATE hospitality_guest SET Hidden = 1 WHERE Id = '".$_REQUEST['azione']."'");

        $NPre = $fun->getlastNumPreno($_REQUEST['azione']);
        $fun->popola_status_parity(IDSITO,$NPre,7);
        
        header('location:'.BASE_URL_SITO.'buoni_voucher/');
}

# INTERFACCIA CRUD DATATABLE
$content .='   <!-- Table datatable-->
               <table id="annullate" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';

$content .='                <th class="notexport">Op.</th>
                            <th>Nr.</th>
                            <th>Fonte</th>
                            <th>Target</th>
                            <th>Nome e Cognome</th>
                            <th>Email</th>
                            <th class="notexport">Lg</th>
                            <th>Arrivo</th>
                            <th>Partenza</th>
                            <th>Prenotazione</th>
                            <th>Proposta</th>
                            <th class="notexport">Notifiche</th>
                            <th>Motivazione</th>
                            <th class="notexport"></th>
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

            $(document).ready(function() {


                //INIZIALIZZO I TOOLTIP
                $(\'[data-tooltip="tooltip"]\').tooltip();


                // CONFIG DATATABLE
                var table = $("#annullate").DataTable( {
                    order: [[1, \'desc\']],                                       
                    responsive: true,
                    processing:true,
                    oLanguage: {sProcessing: " <div class=\'cell preloader5 loader-block\'><div class=\'circle-5 l loader-warning\'></div><div class=\'circle-5 m loader-warning\'></div><div class=\'circle-5 r loader-warning\'></div></div><span class=\'text-primary f-w-400 f-14 f-s-intial\'>QUOTO! sta caricando i dati...<br><span class=\'\'>Attendere!!</span></span>"},
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
							[ 10, 50, 100, 200, 400, -1 ],
							[  \'10 record\', \'50 record\', \'100 risultati\', \'200 risultati\', \'400 risultati\', \'Tutti\' ]
                        ],	
                        buttons: [
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
                    ],			
                    "ajax": "'.BASE_URL_SITO.'crud/proposte/voucher.crud.php?idsito='.IDSITO.'",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='    { "data": "op","class":"text-center"},
                        { "data": "nr","class":"text-center"},       
                        { "data": "fonte"},
                        { "data": "tipo"},
                        { "data": "cliente","class":"nowrap"}, 
                        { "data": "email","class":"nowrap"}, 
                        { "data": "lingua","class":"text-center"}, 
                        { "data": "arrivo","type":"date","class":"text-center nowrap"}, 
                        { "data": "partenza","type":"date","class":"text-center nowrap"},
                        { "data": "data_chiuso","type":"date","class":"text-center nowrap"},  
                        { "data": "riepilogo","class":"text-center"}, 
                        { "data": "check","class":"text-center"},
                        { "data": "motivo","class":"text-center"},
                        { "data": "action","class":"text-center"}
                    ],';
        $content .='    "columnDefs": [
                              {"targets": [0,5,6,9,10,11,12,13], "orderable": false}  

                        ]
                    })
    

                    // ORDINAMENTO TABELLA

                    $("#annullate_processing").removeClass("card"); 

                    $(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");
                    $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");'."\r\n";


$content .='})
            </script>';     
  
?>
