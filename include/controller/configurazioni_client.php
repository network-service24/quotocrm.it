<?php

$select = "SELECT siti.CheckNumberRows FROM siti WHERE siti.idsito = ".IDSITO;
$result = $dbMysqli->query($select);
$record = $result[0];

$CheckNumberRows = $record['CheckNumberRows'];

$content .= '<div class="row">
                <div class="col-md-8">
                    <div id="res"></div>
                    <div class="row m-t-10">
                        <div class="col-md-2 nowrap text-left">
                            <label class="f-w-600">Limita Record <i class="fa fa-exclamation-circle text-info" data-toggle="tooltip" title="Limita record solo all\'anno in corso più gli ultimi sei mesi dello scorso anno in Preventivi, Conferme, Prenotazioni ed in Profila ed Esporta, perchè la tua lista nel Database è corposamente numerosa"></i></label>
                        </div>
                        <div class="col-md-1 text-left">
                            <input type="checkbox"  name="CheckNumberRows_" id="CheckNumberRows_" '.($CheckNumberRows==1?'checked="checked"':'').' value="'.$CheckNumberRows.'" disabled="disabled"/>
                            <input type="hidden"   id="CheckNumberRows"  name="CheckNumberRows" value="'.$CheckNumberRows.'"/> 
                        </div>
                        <div class="col-md-1 text-left">
                            <!--<button type="button" class="btn btn-primary btn-sm" id="salva">Salva</button>--> 
                        </div>
                        <div class="col-md-8"><i class="fa fa-long-arrow-left"></i> Per abilitare questo parametro contattare Network Service!</div>
                    </div>
                </div>
            <div class="col-md-3"></div>
        </div>      
        <script>
                $(document).ready(function(){


                    $("#CheckNumberRows_").click(function() {
                        if($("#CheckNumberRows_").is(":checked")){
                            $("#CheckNumberRows_").attr("value","1");
                            $("#CheckNumberRows").attr("value","1");
                        }else{
                            $("#CheckNumberRows_").attr("value",0);
                            $("#CheckNumberRows_").attr("checked",0);
                            $("#CheckNumberRows").attr("value",0);
                        }
                    });
                    // UPDATE MAP
                    $("#salva").on("click",function(){
                        var CheckNumberRows = $(\'#CheckNumberRows\').val(); 
                            $.ajax({
                                url: "'.BASE_URL_SITO.'ajax/generici/limite_record.update.php",
                                type: "POST",
                                data: "idsito='.IDSITO.'&CheckNumberRows="+CheckNumberRows+"",
                                success: function(msg){  
                                    $("#res").html(\'<div class="clearfix p-b-30"></div><div class="alert alert-info"><p>Dati salvati con successo!</p></div>\');
                                    setTimeout(function(){ 
                                        $("#res").hide(); 
                                    }, 2000);
                                },
                                error: function(){
                                    alert("Chiamata fallita, si prega di riprovare...");
                                }
                            });
                            return false; // con false senza refresh della pagina
                    });
                });
            </script> 
            <div class="clearfix p-b-30"></div>'."\r\n";
# INTERFACCIA CRUD DATATABLE
$content .='   <!-- Table datatable-->
               <table id="configurazioni" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';

$content .='          
                            <th style="width:45%">Parametro</th>
                            <th style="width:45%">Descrzione</th>
                            <th style="width:5%">Abilitato</th>
                            <th style="width:5%"></th>
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
                var table = $("#configurazioni").DataTable( {
                                                               
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
							[ 50, 100, 200, 400, 800, -1 ],
							[  \'50 record\', \'100 record\', \'200 risultati\', \'400 risultati\', \'800 risultati\', \'Tutti\' ]
                        ],	
                        buttons: [

                    \'pageLength\',                    


                    ],			
                    "ajax": "'.BASE_URL_SITO.'crud/setting/configurazioni.crud.php?idsito='.IDSITO.'",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='    { "data": "parametro"},  
                        { "data": "descrizione"},        
                        { "data": "valore","class":"text-center"},
                        { "data": "action","class":"text-center"},
                    ],';
        $content .='    "columnDefs": [
                              {"targets": [0, 1,2], "orderable": false} 

                        ]
                    })
    

                    // ORDINAMENTO TABELLA
                    table.order( [ 0, \'DESC\' ] ).draw();
                    $("#configurazioni_processing").removeClass("card"); 

                    $(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");
                    $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");'."\r\n";


$content .='})
        </script>';
?>