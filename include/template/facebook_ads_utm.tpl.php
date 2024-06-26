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
                                        <li><b>LEGENDA:</b> i preventivi, le prenotazioni e/o ..in trattativa se <b>cestinate</b> vengono escluse da qualsiasi calcolo statistico!</li>
                                        <li>Per <b>non escludere</b> i preventivi, le prenotazioni e/o le conferme in trattativa dai moduli statistici è altamente consigliato <b>archiviarle</b>!</li>                                        
                                    </ul>
                                </div>
                                <div class="card">
                                    <div class="card-block">
                                            <div class="row">
                                                <div class="col-md-1 col-sm-1 col-xs-1"></div>
                                                <div class="col-md-10 col-sm-10 col-xs-10">
                                                    <div class="row">
                                                        <div class="col-md-3"><a href="<?=BASE_URL_SITO?>grafici-statistiche_utm/" class="btn btn-default btn-mini">&lt;&lt; Vai alla statistiche</a></div>
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
                                                    <div id="view_loading_statistiche"></div>
                                                    <?= $js_load ?>
                                                    <h5><i class="fa fa-facebook-square fa-2x" style="color:#3B5897"></i>  Fonte di prenotazione <b>Facebook Ads</b>: per campagne social. <span class="f-11">(tracciabilità ottenuta da UTM QUOTO)</span></h5>
                                                    <div class="clearfix p-b-20"></div>
                                                    <?= $legendaSn_BOX ?>
                                                </div>
                                                <div class="col-md-1 col-sm-1 col-xs-1"></div>
                                            </div>
                                            <? include_module('backtop.inc.php'); ?> 
                              
                                        </div>
                                    </div>
                                </div>
                            </div>
    <!-- /.content -->
    <? include_module('footer.inc.php'); ?>