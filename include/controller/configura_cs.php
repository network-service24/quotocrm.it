<?php
    $select = "SELECT * FROM hospitality_giorni_cs WHERE idsito = ".IDSITO;
    $res    = $dbMysqli->query($select);
    $tot    = sizeof($res); 
    if($tot == 0){
        $insert = "INSERT INTO hospitality_giorni_cs(idsito) VALUES('".IDSITO."')";
        $ins    = $dbMysqli->query($insert);
        $id     = $dbMysqli->getInsertId($ins);
    }else{
        $id = $rw['id'];
    }

     # INTERFACCIA CRUD DATATABLE
    $content .='   <!-- Table datatable-->
                   <table id="questionario" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                        <thead>
                            <tr>';
    
    $content .='          
                                <th>Numero giorni PRIMA o DOPO il Check Out</th>
                                <th>Contenuti Oggetto Mail presenti</th>
                                <th>Contenuti Testo Mail presenti</th>
                                <th>Abilita Invio Automatico</th>
                                <th style="width:4%"></th>
                            </tr>
                        </thead>
    
                    </table> '."\r\n";
    $content .='<style>
                    #azioniPrev .dropdown-toggle::after {
                        display: none !important;
                    }
                    #questionario_filter{
                        display: none !important;
                    }
                    .dt-buttons{
                        display: none !important;
                    }
                    #questionario_info{
                        display: none !important;
                    }
                </style>'."\r\n";
    # CODICE JS PER ESECUZIONE INSERT,UPDATE;DELETE E DATATABLE
    $content .='<script>
    
                var editor; // use a global for the submit and return data rendering in the examples
    
                $(document).ready(function() {'."\r\n";
    
    
    $content .='                                                                     

                    //INIZIALIZZO I TOOLTIP
                    $(\'[data-tooltip="tooltip"]\').tooltip();
    
                    // CONFIG DATATABLE
                    var table = $("#questionario").DataTable( {
                                                                   
                        responsive: true,
                        processing:true,
                        oLanguage: {sProcessing: " <div class=\'cell preloader5 loader-block\'><div class=\'circle-5 l loader-warning\'></div><div class=\'circle-5 m loader-warning\'></div><div class=\'circle-5 r loader-warning\'></div></div><span class=\'text-primary f-w-400 f-14 f-s-intial\'>QUOTO! sta caricando i dati...<br><span class=\'\'>Attendere!!</span></span>"},
                        "paging": false,
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
                                [ 1],
                                [  \'1 record\']
                            ],	
                            buttons: [
                        \'pageLength\',                    
    
                        ],			
                        "ajax": "'.BASE_URL_SITO.'crud/configurazioni/questionario.crud.php?idsito='.IDSITO.'",
                        "deferRender": true,
                        "columns": ['."\r\n";
    
            $content .='    { "data": "numero","class":"text-center"},  
                            { "data": "oggetto","class":"text-center"},
                            { "data": "testo","class":"text-center"},
                            { "data": "abilitato","class":"text-center"},         
                            { "data": "action","class":"text-center"}
                        ],';
            $content .='    "columnDefs": [
                                  {"targets": [0,1,2,3,4], "orderable": false} 
    
                            ]
                        })
        
    
                        // ORDINAMENTO TABELLA
                        table.order( [ 0, \'ASC\' ] ).draw();
                        $("#questionario_processing").removeClass("card"); 
    
                        $(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");
                        $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");'."\r\n";
    
    
    $content .='})
            </script>';
    ?>
    
    
            