<? include_once(INC_PATH_MODULI_ADMIN.'header.inc.php'); ?>

<? include_once(INC_PATH_MODULI_ADMIN.'navbar.inc.php'); ?>

<? include_once(INC_PATH_MODULI_ADMIN.'sidebar.inc.php'); ?>

<div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                <? include_module('breadcrumb.inc.php'); ?>
                                    <div class="page-body">
                                    <div class="card">
                                            <div class="card-header">
                                                <h5>Report uso di <?=NOME_AMMINISTRAZIONE?> da parte dei clienti attivi e/o scaduti</h5>
                                                <?=$provenienza?>
                                                <div class="card-header-right">
                                                    <ul class="list-unstyled card-option">
                                                        <li><i class="feather icon-maximize full-card"></i></li>
                                                        <li><i class="feather icon-minus minimize-card"></i></li>
                                                        <li><i class="feather icon-trash-2 close-card"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                                <div class="card-block">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <p>Visualizza anche gli <a href="https://www.quotocrm.it/admin/uso_quoto/&scaduti=1"><i class="fa fa-area-chart text-danger"></i> Scaduti</a></p>
                                                    </div>
                                                </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <form method="POST" id="form_filtro" name="form_filtro" action="<?=$_SERVER['REQUEST_URI']?>">
                                                                <div class="row">
                                                                        <div class="col-md-4">
                                                                            <select name="idsito" id="idsito" class="chosen-select form-control text-left">
                                                                                <option value="">--</option>
                                                                                <?=$lista_siti?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-1" style="padding-left:0px!important;">
                                                                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i> Filtra</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                        </div>
                                                        <div class="col-md-3 text-center" style="float:right!important">
                                                                <form method="POST" id="form_export" name="form_export" action="<?=BASE_URL_ADMIN?>/src/controller/export_email_quoto.php">
                                                                    <input type="hidden" name="action" value="export">
                                                                    <button type="submit" class="btn btn-default"><i class="fa fa-file-o"></i> Esporta</button>
                                                                </form>
                                                            </div>
                                                        <div class="col-md-3 text-right" style="float:right!important">
                                                            <form method="POST" id="form_order" name="form_order" action="<?=$_SERVER['REQUEST_URI']?>">
                                                                <div class="row">
                                                                        <div class="col-md-4  text-right" style="float:right!important;padding-right:5px!important;padding-left:5px!important;">
                                                                                <button type="submit" class="btn btn-default"><i class="fa fa-sort"></i> Ordina</button>
                                                                        </div>
                                                                        <div class="col-md-4 text-right" style="float:right!important;padding-right:5px!important;padding-left:5px!important;">
                                                                            <input type="hidden" name="action" value="ordina">
                                                                            <select name="ordina" id="ordina" class="form-control">
                                                                                <option value="" <?=($_REQUEST['ordina']==''?'selected="selected"':'')?>>--</option>
                                                                                <option value="ASC" <?=($_REQUEST['ordina']=='ASC'?'selected="selected"':'')?>>Data scadenza ASC</option>
                                                                                <option value="DESC" <?=($_REQUEST['ordina']=='DESC'?'selected="selected"':'')?>>Data scadenza DESC</option>
                                                                                <!--
                                                                                <option value="conversione_asc" <?=($_REQUEST['ordina']=='conversione_asc'?'selected="selected"':'')?>>Tasso conversione ASC</option>
                                                                                <option value="conversione_desc" <?=($_REQUEST['ordina']=='conversione_desc'?'selected="selected"':'')?>>Tasso conversione DESC</option>
                                                                                -->
                                                                                <option value="fatturato_asc" <?=($_REQUEST['ordina']=='fatturato_asc'?'selected="selected"':'')?>>Fatturato ASC</option>
                                                                                <option value="fatturato_desc" <?=($_REQUEST['ordina']=='fatturato_desc'?'selected="selected"':'')?>>Fatturato DESC</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>

                                                    </div>
                                                        <br>
                                                        <script>
                                                            function totale_fatturato(idsito){
                                                                $("#totale_fatturato_pre"+idsito+"").html('<img src="<?=BASE_URL_SITO?>img/loader_performance.gif" style="width:40px;height:10px" />');
                                                                $("#totale_fatturato"+idsito+"").load("<?=BASE_URL_ADMIN?>ajax/uso_quoto/totale_fatturato.php?idsito="+idsito+"", function() {
                                                                    $("#totale_fatturato_pre"+idsito+"").hide();
                                                                });
                                                            }
                                                            function totale_fatturato_anno(idsito,inizio,fine){
                                                                $("#totale_fatturato_anno_pre"+idsito+"").html('<img src="<?=BASE_URL_SITO?>img/loader_performance.gif" style="width:40px;height:10px" />');
                                                                $("#totale_fatturato_anno"+idsito+"").load("<?=BASE_URL_ADMIN?>ajax/uso_quoto/totale_fatturato_anno.php?idsito="+idsito+"&inizio="+inizio+"&fine="+fine+"", function() {
                                                                    $("#totale_fatturato_anno_pre"+idsito+"").hide();
                                                                });
                                                            }
                                                            function totale_fatturato_anno(idsito,inizio,fine){
                                                                $("#totale_fatturato_anno_pre"+idsito+"").html('<img src="<?=BASE_URL_SITO?>img/loader_performance.gif" style="width:40px;height:10px" />');
                                                                $("#totale_fatturato_anno"+idsito+"").load("<?=BASE_URL_ADMIN?>ajax/uso_quoto/totale_fatturato_anno.php?idsito="+idsito+"&inizio="+inizio+"&fine="+fine+"", function() {
                                                                    $("#totale_fatturato_anno_pre"+idsito+"").hide();
                                                                });
                                                            }
                                                            function totale_fatturato_anno_precedente(idsito,inizio,fine){
                                                                $("#totale_fatturato_anno_precedente_pre"+idsito+"").html('<img src="<?=BASE_URL_SITO?>img/loader_performance.gif" style="width:40px;height:10px" />');
                                                                $("#totale_fatturato_anno_precedente"+idsito+"").load("<?=BASE_URL_ADMIN?>ajax/uso_quoto/totale_fatturato_anno.php?idsito="+idsito+"&inizio="+inizio+"&fine="+fine+"", function() {
                                                                    $("#totale_fatturato_anno_precedente_pre"+idsito+"").hide();
                                                                });
                                                            }
                                                            function log_accessi(idsito,ips_network_service){
                                                                $("#log_accessi_pre"+idsito+"").html('<img src="<?=BASE_URL_SITO?>img/loader_performance.gif" style="width:40px;height:10px" />');
                                                                $("#log_accessi"+idsito+"").load("<?=BASE_URL_ADMIN?>ajax/uso_quoto/log_accessi.php?idsito="+idsito+"&ips_network_service="+ips_network_service+"", function() {
                                                                    $("#log_accessi_pre"+idsito+"").hide();
                                                                });
                                                            }
                                                            function scadenza_quoto(idsito){
                                                                $("#scadenza_quoto_pre"+idsito+"").html('<img src="<?=BASE_URL_SITO?>img/loader_performance.gif" style="width:40px;height:10px" />');
                                                                $("#scadenza_quoto"+idsito+"").load("<?=BASE_URL_ADMIN?>ajax/uso_quoto/scadenza_quoto.php?idsito="+idsito+"", function() {
                                                                    $("#scadenza_quoto_pre"+idsito+"").hide();
                                                                });
                                                            }
                                                        </script>
                                                        <div class="accordion-block">
                                                            <div class="accordion-box" id="single-open">
                                                                <?php

                                                                    echo quoto_attivi();
                                                                    if($_REQUEST['scaduti']==1){
                                                                        echo quoto_scaduti();
                                                                    }

                                                                ?>
                                                            </div>
                                                        </div>
                                                     <? include_once(INC_PATH_MODULI_ADMIN.'backtop.inc.php'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

    <!-- /.content -->
      <? include_once(INC_PATH_MODULI_ADMIN.'footer.inc.php'); ?>
