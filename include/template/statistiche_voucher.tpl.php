<? include_module('header.inc.php'); ?>

<? include_module('navbar.inc.php'); ?>

<? include_module('sidebar.inc.php'); ?>


<div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                <? include_module('breadcrumb.inc.php'); ?>
                                    <div class="page-body">
                                        <div class="card">
                                            <div class="card-block">
                                                <form name="relation_requestdate" id="relation_requestdate" method="POST" action="<?=$_SERVER['REQUEST_URI']?>">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            Filtri <span>&#10230;</span> Avanzati:
                                                        </div>
                                                        <div class="col-md-4 text-center">
                                                            <small><a href="<?=BASE_URL_SITO?>grafici-statistiche_voucher/"><i class="fa fa-refresh" aria-hidden="true"></i> reset filtri</a></small>
                                                        </div>
                                                        <div class="col-md-4"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row"> 
                                                        <div class="col-md-1 text-right">
                                                            <label><b>Azione</b> </label>
                                                        </div>
                                                        <div class="col-md-1 text-right">
                                                            <select  name="DataRiconferma" class="form-control">
                                                                <option value="" selected>--</option>
                                                                <option value="sale" <?=($_REQUEST['DataRiconferma']=='sale'?'selected':'')?> >Ri-Confermata</option>
                                                                <option value="wait" <?=($_REQUEST['DataRiconferma']=='wait'?'selected':'')?> >In attesa di variazione</option>
                                                                <option value="pending" <?=($_REQUEST['DataRiconferma']=='pending'?'selected':'')?> >per fase di modifica</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2 text-right">
                                                            <label><b>Motivazione</b> </label>
                                                        </div>
                                                        <div class="col-md-2 text-right">
                                                            <select  name="motivazione" class="form-control">
                                                                <?=$motiv?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2  text-right"> <label><b> Prenotazioni </b><br><small>Data prentazione</small></label></div>
                                                        <div class="col-md-3 text-center">
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                        <input type="date" placeholder="Dal" id="DataVoucherRecSend_dal" autocomplete="off"  class="form-control" name="DataVoucherRecSend_dal" value="<?=$_REQUEST['DataVoucherRecSend_dal']?>">
                                                                </div>
                                                                <div class="col-md-5">
                                                                        <input type="date" placeholder="Al"  id="DataVoucherRecSend_al" autocomplete="off"  class="form-control" name="DataVoucherRecSend_al" value="<?=$_REQUEST['DataVoucherRecSend_al']?>">
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <input type="hidden" name="action" value="request_date">
                                                                        <button class="btn btn-success btn-sm m-l-30" type="submit">Filtra</button>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                </form>
                                            </div>                                                 
                                        </div>                                               
                                        <div id="view_loading_statistiche"></div>
                                        <?=$js_load?>
                                        <div class="card">
                                            <div class="card-block">                                        
                                                <div id="fatturatoN">
                                                    <div class="row">
                                                        <div class="col-md-4">Statistiche sulle variazioni di soggiorno <b>motivate</b>... </div>
                                                        <div class="col-md-1">
                                                            <form id="form_export" method="post" name="form_export" action="<?=BASE_URL_SITO?>include/controller/export_disdette_quoto.php">
                                                                <input type="hidden" name="action" value="export">
                                                                <input type="hidden" name="idsito" value="<?=IDSITO?>">
                                                                <input type="hidden" name="DataVoucherRecSend_dal" value="<?=$_REQUEST['DataVoucherRecSend_dal']?>">
                                                                <input type="hidden" name="DataVoucherRecSend_al" value="<?=$_REQUEST['DataVoucherRecSend_al']?>">
                                                                <input type="hidden" name="motivazione" value="<?=$_REQUEST['motivazione']?>">
                                                                <input type="hidden" name="DataRiconferma" value="<?=$_REQUEST['DataRiconferma']?>">
                                                                <a href="#" class="btn btn-primary btn-sm" onclick="document.getElementById('form_export').submit();" id="pulsante_esporta"><i class="fa fa-file-excel-o" aria-hidden="true"></i> <span style="margin-left: 10px!important;">Esporta CSV</span></a>
                                                            </form>
                                                        </div>
                                                        <div class="col-md-7"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                      
                                        <div class="card">
                                            <div class="card-block"> 
                                                        <div class="row">
                                                            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                                            <?
                                                                if($_REQUEST['action']=='check_year'){
                                                                echo (strlen($_REQUEST['querydate'])>1?'<b>Anno</b> '.$_REQUEST['querydate']:'<b>Ultimo Mese</b>');
                                                                }
                                                                if($_REQUEST['action']=='request_date'){
                                                                echo ($_REQUEST['DataVoucherRecSend_dal']!=''?'<b>Data Prenotazione Dal</b> '.gira_data($_REQUEST['DataVoucherRecSend_dal']):'').' '.($_REQUEST['DataVoucherRecSend_al']!=''?' <b>Data Prenotazione Al</b> '.gira_data($_REQUEST['DataVoucherRecSend_al']):'');
                                                                }
                                                            ?>

                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-xs-6 text-center">
                                                            <?
                                                                if($_REQUEST['action']=='check_date'){
                                                                echo '<b>AL</b><br>';
                                                                echo ($_REQUEST['DataArrivo_al']!=''?'<b>Arrivi</b> '.gira_data($_REQUEST['DataArrivo_al']):'').' '.($_REQUEST['DataPartenza_al']!=''?' <b>Partenze</b> '.gira_data($_REQUEST['DataPartenza_al']):'');
                                                                }
                                                            ?>
                                                            </div>
                                                        </div>
                                                        <?php if($messagen){?>
                                                            <div class="row">
                                                                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-warning">
                                                                    <?=$messagen?>
                                                                </div>
                                                            </div>
                                                        <?}?>
                                                        <?=($_REQUEST['action']=='check_date'?'<br>':'')?>
                                                        <div class="row">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <h3>Lista variazioni prenotazioni con buono voucher</h3>
                                                                            <small><?=$legenda?></small>
                                                                        </div>
                                                                    </div>
                                                                    <br>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <h3>Grafico buoni voucher</h3>
                                                                                    <?=$legendaN?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-7 text-center">
                                                                            <div id="pieChartNew" style="width:100%; height:550px"></div>
                                                                        </div>
                                                                        <div class="col-md-1 text-center"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?=$js_toggle?>
                                                    <?=$js_script_grafici?>
                                                    <? include_module('backtop.inc.php'); ?> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

    <!-- /.content -->
    <? include_module('footer.inc.php'); ?>