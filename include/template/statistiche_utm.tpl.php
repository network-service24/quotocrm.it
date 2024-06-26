<? include_module('header.inc.php'); ?>

<? include_module('navbar.inc.php'); ?>

<? include_module('sidebar.inc.php'); ?>

<?php include(BASE_PATH_SITO.'js/statistiche_GA4.inc.js.php');?>  

<style>
.table td, .table th {
    padding: 10px !important;
    vertical-align: top !important;
    border: 0px 0px 0px 0px !important;
}
</style>

<div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                        <? include_module('breadcrumb.inc.php'); ?>
                                                <div class="page-body">
                                                                <div class="alert alert-default text-center text-black">
                                                                <ul>
                                                                    <li><b>LEGENDA:</b> i preventivi,  le prenotazioni e/o ..in trattativa se <b>cestinate</b> vengono escluse da qualsiasi calcolo statistico!</li>
                                                                    <li>Per <b>non escludere</b> i preventivi, le prenotazioni e/o le conferme in trattativa dai moduli statistici è altamente consigliato <b>archiviarle</b>!</li>                                        
                                                                </ul>
                                                                </div>
                                                                <div class="card">
                                                                    <div class="card-block">
                                                                        <div class="row">
                                                                            <div class="col-md-3"></div>
                                                                            <div class="col-md-2 text-right"> <label> Periodo</label> <i class="fa fa-question-circle" data-toggle="tooltip" Title="Se a causa di una mole di dati piuttosto consistente, il filtro non riuscisse ad elaborare la query, abbassare il range temporale"></i></div>
                                                                            <div class="col-md-2">                                                           
                                                                                <form id="statistiche" name="statistiche" method="post" action="<?=$_SERVER['REQUEST_URI']?>">
                                                                                    <div class="form-group">
                                                                                            <input placeholder="Imposta una query di ricerca" class="form-control periodo" id="demo" name="date" type="text" autocomplete="off">
                                                                                    </div>
                                                                                    <input type="hidden" name="action" value="request_date">
                                                                                </form>                                                                    
                                                                            </div>
                                                                            <div class="col-md-5 text-right"></div>
                                                                        </div>
                                                                        <div class="clearfix p-b-20"></div>
                                                                        <h4 class="text-center"></h4>
                                                                        <div class="row">

                                                                            <div class="col-md-12">               
                                                                                <div id="loadingQ"></div>
                                                                                <div id="statisticheQ"></div>
                                                                                <script>
                                                                                    $(document).ready(function() {
                                                                                        $("#loadingQ").html('<div class="col-md-12 text-center"><img src="<?=BASE_URL_SITO?>img/Ellipsis-1s-200px.svg"></div></div><div class="row"><div class="col-md-12 text-center"><small>Attendere il termine del caricamento dati!</small></div>');
                                                                                        $.ajax({								 
                                                                                            type: "POST",								 
                                                                                            url: "<?=BASE_URL_SITO?>ajax/statistiche/statistiche_utm.php",								 
                                                                                            data: "idsito=<?=IDSITO?>&filter_query=<?=$filter_query?>&action=<?=$_REQUEST['action']?>&DataRichiesta_dal=<?=$DataRichiesta_dal?>&DataRichiesta_al=<?=$DataRichiesta_al?>",
                                                                                            dataType: "html",
                                                                                                success: function(msg){
                                                                                                    $("#statisticheQ").html(msg);
                                                                                                    $("#loadingQ").hide();
                                                                                                },
                                                                                                error: function(){
                                                                                                    alert("Risultato non raggiunto, si prega di riprovare abbassando il range temporale!"); 
                                                                                                }
                                                                                        });                        
                                                                                    });
                                                                                </script>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>  

                                                            </div>
                                                        </div>                                                             
                                                        <div class="clearfix"></div>
                                                    <? include_module('backtop.inc.php'); ?> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

    <!-- /.content -->
    <? include_module('footer.inc.php'); ?>