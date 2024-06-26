<?php
if ($_GET['azione']) {
    $content = '   <div class="row">
                        <div class="col-md-5">
                            <div class="z-depth-right-0 waves-effect">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p>Per poter utilizzare il campo <b>"Filtra i risultati"</b> e rivedere l\'archivio completo, resetta la query cliccando sul pulsante</p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-md-12 text-center">
                                                <a href="' . BASE_URL_ADMIN . 'report/archivio/" class="btn btn-inverse btn-sm">Reset</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>  
                    </div>' . "\r\n";
}
# INTERFACCIA CRUD DATATABLE
$content .='    <style>#archivio .ordinamento {display:none; }</style>
                <!-- Table datatable-->
                <table id="archivio" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13" style="width:100%">
                    <thead>
                        <tr>
                            
                            <th class="nowrap">Cliente</th>
                            <th class="nowrap">Data Report</th>
                            <th class="text-center">Quoto</th>
                            <th class="text-center nowrap"></th>
                        </tr>
                    </thead>       
                </table> '."\r\n";


# CODICE JS PER ESECUZIONE INSERT,UPDATE;DELETE E DATATABLE
$content .='<script>

                    $(document).ready(function() {

                            // CONFIG DATATABLE
                            var table = $("#archivio").DataTable( {

                                responsive: true,
                                processing:true,
                                oLanguage: {sProcessing: "<div class=\'loader-block\' style=\'z-index:9999999!important\'><div class=\'preloader6\'><hr></div></div><span class=\'text-primary f-w-400 f-14 f-s-intial\'>Attendere QUOTO! Manager sta caricando i dati....!</span>"},
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
                                    [ 20, 30, 50, -1 ],
                                    [ \'20 risultati\', \'30 risultati\', \'50 risultati\', \'Tutti\' ]
                                ],	
                                buttons: [ \'pageLength\',
                              
                                ],				
                                "ajax": "'.BASE_URL_ADMIN.'crud/report/archivio.crud.php'.($_REQUEST['azione']!=''?'?idsito='.$_REQUEST['azione']:'').($_REQUEST['param']!=''?'&data_report='.$_REQUEST['param']:'').'",
                                "columns": [
                                    { "data": "web","class":"text-left" },  
                                    { "data": "data_report","class":"text-center" },
                                    { "data": "quoto","class":"text-center" },
                                    { "data": "action","class":"text-center" }
                                ],
                                "columnDefs": [
                                            {"targets": [2,3], "orderable": false}

                                            ]
                            });   
                            // ORDINAMENTO TABELLA
                            table.order([ 1, \'DESC\' ] ).draw();
                            $(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");
                            $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");
                           $("#archivio_processing").removeClass("card");
                    }); 
                 
                    $(function(){
                        $(document).tooltip();
                        $( ".tool_archivio" ).tooltip({
                            position: {
                                my: "center bottom-20",
                                at: "center top",
                                using: function( position, feedback ) {
                                  $( this ).css( position );
                                  $( "<div>" )
                                    .addClass( "arrow" )
                                    .addClass( feedback.vertical )
                                    .addClass( feedback.horizontal )
                                    .appendTo( this );
                                }
                              }
                        });
                    });
                
            </script>'."\r\n";
if ($_GET['azione']) { 
    $content .='<script>           
                    $( document ).ready(function() {
                        $("#archivio_filter").hide();
                        $(".dt-buttons").hide();
                    });
                </script>'."\r\n";
}