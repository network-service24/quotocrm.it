<? include_module('header.inc.php'); ?>

<? include_module('navbar.inc.php'); ?>

<? include_module('sidebar.inc.php'); ?>


<div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                <? include_module('breadcrumb.inc.php'); ?>
                                    <div class="page-body">
                                    <div class="text-center"><h3> ATTENZIONE: la raccolta dati di Analytics Universal si è conclusa il 30 giugno 2023</h3></div>
                                    <div class="card">
                                                        <div class="card-block">
                                                            <div class="row">
                                                                <div class="col-md-2  text-right"> <label><b> Conferme </b> <br><small>solo sul fatturato</small></label></div>
                                                                <div class="col-md-6 text-center">
                                                            

                                                                        <form name="relation_requestdate" class="form-inline" id="relation_requestdate" method="POST" action="<?=$_SERVER['REQUEST_URI']?>">
                                                                        
                                                                                <input type="date" placeholder="Dal" id="DataRichiesta_dal" autocomplete="off"  class="form-control m-r-10" name="DataRichiesta_dal" value="<?=$_REQUEST['DataRichiesta_dal']?>" data-date-end-date="-1d">
                                                        
                                                                                <input type="date" placeholder="Al"  id="DataRichiesta_al" autocomplete="off"  class="form-control m-r-10" name="DataRichiesta_al" value="<?=$_REQUEST['DataRichiesta_al']?>" data-date-end-date="-1d">
                                                                
                                                                                <input type="hidden" name="action" value="request_date">
                                                                                <button id="pul_search_date" class="btn btn-success btn-sm m-l-30" type="submit">Filtra</button>
                                                                            
                                                                        </form>

                                                                    
                                                                </div>
                                                                <div class="col-md-2 text-right">
                                                                    <label><b>Filtra per Anno</b> </label>
                                                                </div>
                                                                <div class="col-md-2 text-center">
                                                                    <small>
                                                                        <form method="post" name="filter_year" id="filter_year">
                                                                            <input type="hidden" name="action" value="check_year">
                                                                            <select  name="querydate" id="querydate" class="form-control" onchange="submit()">
                                                                                <?=$lista_anni?>
                                                                            </select>
                                                                            </form>
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div id="view_loading_statistiche"></div>
                                                        <?= $js_load ?>

                                    <div id="fatturatoN" class="card">
                                    <div class="card-block">

                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                                <?
                                                if ($_REQUEST['action'] == 'check_year') {
                                                    echo(strlen($_REQUEST['querydate']) > 1 ? '<b>Anno</b> ' . $_REQUEST['querydate'] : '<b>Ultimo Mese</b>');
                                                }
                                                if ($_REQUEST['action'] == 'request_date') {
                                                    echo ($_REQUEST['DataRichiesta_dal'] != '' ? '<b>Data Prenotazione Dal</b> ' . gira_data($_REQUEST['DataRichiesta_dal']) : '') . ' ' . ($_REQUEST['DataRichiesta_al'] != '' ? ' <b>Data Prenotazione Al</b> ' . gira_data($_REQUEST['DataRichiesta_al']) : '');
                                                }
                                                ?>

                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-6 text-center">
                                                <?
                                                if ($_REQUEST['action'] == 'check_date') {
                                                    echo '<b>AL</b><br>';
                                                    echo ($_REQUEST['DataArrivo_al'] != '' ? '<b>Arrivi</b> ' . gira_data($_REQUEST['DataArrivo_al']) : '') . ' ' . ($_REQUEST['DataPartenza_al'] != '' ? ' <b>Partenze</b> ' . gira_data($_REQUEST['DataPartenza_al']) : '');
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <?php if ($messagen) { ?>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-warning">
                                                    <?= $messagen ?>
                                                </div>
                                            </div>
                                        <? } ?>
                                        <?= ($_REQUEST['action'] == 'check_date' ? '<br>' : '') ?>
                                            <div class="clearfix p-b-20"></div>
                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-10">
                                                    <div class="text-center" style="width:100%!important"><b>Metodo raccolta dati tramite Analytics</b></div>
                                                        <h5>Fonte di prenotazione <b>Newsletter Ads</b> <img src="<?= BASE_URL_SITO ?>img/analytics.png" style="width:32px;height:32px"/>: per campagne.</h5>
                                                        <div class="clearfix p-b-20"></div>
                                                        <?= $legendaSn_BOX ?>
                                                    </div>
                                                    <div class="col-md-1"></div>
                                                </div>

                                            <?= $js_toggle ?>

                                            <? include_module('backtop.inc.php'); ?> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

    <!-- /.content -->
    <? include_module('footer.inc.php'); ?>