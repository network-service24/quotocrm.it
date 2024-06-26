<?

$content .='   <style>#tableQ .ordinamento {display:none; }</style>
                <!-- Table datatable-->
                    <table id="tableQ" class="small display dataTable table table-striped table-hover table-bordered table-sm"  style="width:100%">
                        <thead>
                            <tr>';

                    $content .='<th>Sito</th>  
                                <th>Tipo</th>            
                                <th>Nr.</th>
                                <th>Fonte</th>
                                <th>Target</th>
                                <th style="white-space:nowrap!important">Data Rich.</th>
                                <th>Nome Cognome</th>
                                <th>Email</th>
                                <th>Lingua</th>
                                <th>Arrivo</th>
                                <th>Partenza</th>
                                <th style="white-space:nowrap!important">Data Preno.</th>
                            </tr>
                        </thead>
                     
                    </table> '."\r\n";
    // CONFIG DATATABLE
$content .=' <script>

$(document).ready(function() {
    var table = $("#tableQ").DataTable( {


        responsive: true,
        processing:true,
        oLanguage: {sProcessing: "<div class=\'loader-block\' style=\'z-index:9999999!important\'><div class=\'preloader6\'><hr></div></div><span class=\'text-primary f-w-400 f-14 f-s-intial\'>QUOTO! Manager sta caricando i dati...<br><span class=\'\'>Attendere!!</span></span>"},
        "paging": true,
            "pagingType": "simple_numbers",    
            "language": {
                 "search": "<div class=\"text-center\"><small>La query può essere formata da valori colonna concatenati</small></div><br>Filtra i risultati:",
                 "info": "Visualizza pagina _PAGE_ di _PAGES_ per _TOTAL_ righe",
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
                [ 20, 30, 50, -1 ],
                [ \'20 risultati\', \'30 risultati\', \'50 risultati\', \'Tutti\' ]
            ],	
            buttons: [ \'pageLength\',
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
            }
        ],
        "ajax": "'.BASE_URL_ADMIN.'crud/richieste_quoto.php",				
        "columns": ['."\r\n";

    $content .='{ "data": "sito" },
                { "data": "Tipo" },
                { "data": "NumeroPrenotazione" },
                { "data": "Fonte" },           
                { "data": "Target" },
                { "data": "DataRichiesta" },
                { "data": "NomeCognome" }, 
                { "data": "Email" },
                { "data": "Lingua" },
                { "data": "DataArrivo" },
                { "data": "DataPartenza" },
                { "data": "DataChiuso" }
            ],';


    $content .='    "columnDefs": [
                    { "width": "5%", "targets":[2,8]}
                ]'."\r\n";
$content .=' }); 

        // ORDINAMENTO TABELLA
        table.order( [ 5, \'DESC\' ] ).draw();
        $(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");
        $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");
        $("#tableQ_processing").removeClass("card");
    })
</script>';