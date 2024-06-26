<?php
if ($_GET['azione']) {
    $content .= '   <div class="row">
                        <div class="col-md-5">
                            <div class="z-depth-right-0 waves-effect">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p>Per poter utilizzare il campo <b>"Filtra i risultati"</b> e rivedere la lista completa dei clienti marketing, resetta la query cliccando sul pulsante</p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-md-12 text-center">
                                                <a href="' . BASE_URL_ADMIN . 'report/index/" class="btn btn-inverse btn-sm">Reset</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>  
                    </div>' . "\r\n";
}
# INTERFACCIA CRUD DATATABLE

$content .='   <!-- Table datatable-->
               <table id="associazioni" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13" style="width:100%">
                    <thead>
                        <tr>
                            <th style="width:5%">IdSito</th>
                            <th style="width:15%" class="nowrap">Sito Web</th>
                            <th style="width:15%" class="text-center">QUOTO</th>
                            <th style="width:20%" class="text-center">Crea Report</th>
                        </tr>
                    </thead>       
                </table> '."\r\n";


# CODICE JS PER ESECUZIONE INSERT,UPDATE;DELETE E DATATABLE
$content .='<script>

                    $(document).ready(function() {

                            // CONFIG DATATABLE
                            var table = $("#associazioni").DataTable( {

                                responsive: true,
                                processing:true,
                                oLanguage: {sProcessing: "<div class=\'loader-block\' style=\'z-index:9999999!important\'><div class=\'preloader6\'><hr></div></div><span class=\'text-primary f-w-400 f-14 f-s-intial\'>Attendere QUOTO! Manager sta caricando i dati...!</span>"},
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
                                "ajax": "'.BASE_URL_ADMIN.'crud/report/report.crud.php'.($_REQUEST['azione']!=''?'?idsito='.$_REQUEST['azione']:'').'",
                                "columns": [

                                    { "data": "idsito" },
                                    { "data": "web" },  
                                    { "data": "quoto" },
                                    { "data": "action" }
                                ],
                                "columnDefs": [
                                            {"targets": [3], "orderable": false}

                                            ]
                            });   
                            // ORDINAMENTO TABELLA
                            table.order( [ 0, \'DESC\' ] ).draw();
                            $(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");
                            $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");
                             $("#associazioni_processing").removeClass("card");
                          
                    }); 


                    function get_modal_content(idsito){

                        $(\'#update\'+idsito).on(\'show.bs.modal\', function (event) {
                            var button              = $(event.relatedTarget);
                            var idsito              = button.data(\'idsito\');
                            var IdAccountAnalytics  = button.data(\'account\');
                            var IdPropertyAnalytics = button.data(\'property\');
                            var ViewIdAnalytics     = button.data(\'view\');
                            var ds_accounts         = button.data(\'adwords\');
                            var act_facebook        = button.data(\'facebook\');
                            var Adwords_ads_CSV     = button.data(\'csvadwords\');
                            var Facebook_ads_CSV    = button.data(\'csvfacebook\');
                            var web                 = button.data(\'web\');
                            var modal               = $(this);
                            modal.find(\'.modal-title\').text(\'Aggiorna gli account per \' + web);
                            modal.find(\'.modal-body input[name="idsito"]\').val(idsito);
                            modal.find(\'.modal-body input[name="IdAccountAnalytics"]\').val(IdAccountAnalytics);
                            modal.find(\'.modal-body input[name="IdPropertyAnalytics"]\').val(IdPropertyAnalytics);
                            modal.find(\'.modal-body input[name="ViewIdAnalytics"]\').val(ViewIdAnalytics);
                            modal.find(\'.modal-body input[name="ds_accounts"]\').val(ds_accounts);
                            modal.find(\'.modal-body input[name="act_facebook"]\').val(act_facebook);
                            modal.find(\'.modal-body input[name="Adwords_ads_CSV"]\').val(Adwords_ads_CSV);
                            modal.find(\'.modal-body input[name="Facebook_ads_CSV"]\').val(Facebook_ads_CSV);
                          })
                    }

                    function get_modal_syncro_content(idsito){

                        $(\'#syncro\'+idsito).on(\'show.bs.modal\', function (event) {
                            var button              = $(event.relatedTarget);
                            var idsito              = button.data(\'idsito\');
                            var ViewIdAnalytics     = button.data(\'view\');
                            var ds_accounts         = button.data(\'adwords\');
                            var act_facebook        = button.data(\'facebook\');
                            var Adwords_ads_CSV     = button.data(\'csvadwords\');
                            var Facebook_ads_CSV    = button.data(\'csvfacebook\');
                            var web                 = button.data(\'web\');
                            var provenienza         = button.data(\'provenienza\');
                            var modal               = $(this);
                            modal.find(\'.modal-title\').text(\'Sincronizza i dati di \' + web + \' per \' + provenienza);
                            modal.find(\'.modal-body input[name="idsito"]\').val(idsito);
                            modal.find(\'.modal-body input[name="ViewIdAnalytics"]\').val(ViewIdAnalytics);
                            modal.find(\'.modal-body input[name="ds_accounts"]\').val(ds_accounts);
                            modal.find(\'.modal-body input[name="act_facebook"]\').val(act_facebook);
                            modal.find(\'.modal-body input[name="Adwords_ads_CSV"]\').val(Adwords_ads_CSV);
                            modal.find(\'.modal-body input[name="Facebook_ads_CSV"]\').val(Facebook_ads_CSV);
                            modal.find(\'.modal-body input[name="provenienza"]\').val(provenienza);
                            modal.find(\'.modal-body input[name="web"]\').val(web);
                            if(provenienza == "facebook"){
                                $("#nascondi_date"+idsito).hide();
                                $("#nascondi_pul"+idsito).hide();
                            }else{
                                $("#nascondi_date"+idsito).show();
                                $("#nascondi_pul"+idsito).show();
                            }
                            if(provenienza == "analytics"){
                                $("#Legenda"+idsito).html("<div class=\'alert alert-warning\'><p>Attenzione: il setting dell\'account analytics deve contenere tutte le dimension e le metriche da interrogare!</p></div>");
                                $("#Legenda"+idsito).show();
                                setTimeout(function(){ $("#Legenda"+idsito).hide(\'slow\'); }, 3000);
                            }else{
                                $("#Legenda"+idsito).hide();
                            }
                        })
                    }

                    function get_reload_table(){
                        var table = $(\'#associazioni\').DataTable();
                        table.ajax.reload();
                    }
                
            </script>'."\r\n";

if ($_GET['azione']) { 
    $content .='<script>           
                    $( document ).ready(function() {
                        $("#associazioni_filter").hide();
                        $(".dt-buttons").hide();
                    });
                </script>'."\r\n";
}
