<? include_module('header.inc.php'); ?>

<? include_module('navbar.inc.php'); ?>

<? include_module('sidebar.inc.php'); ?>

<?php echo $jsScript; ?>

<div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                <? include_module('breadcrumb.inc.php'); ?>
                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <div class="row">
                                                        <div class="col-md-2 text-center"></div>
                                                                <div class="col-md-3 text-center">
                                                                    <form method="post" name="filter_year" id="filter_year">
                                                                        <label>Filtra per Anno</label>
                                                                        <select  name="anno" class="form-control text-center" onchange="submit()">
                                                                            <?=$lista_anni?>
                                                                        </select>
                                                                    </form>
                                                                </div>
                                                                <div class="col-md-2 text-center"></div>
                                                                <div class="col-md-3 text-center">
                                                                    <form method="post" name="filter_data" id="filter_data">
                                                                        <label>Filtra per Data gli Operatori</label>
                                                                        <input type="date" name="data" class="form-control text-center" onchange="submit()" value="<?=$_REQUEST['data']?>"/>
                                                                    </form>
                                                                </div>
                                                                <div class="col-md-2 text-center"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row row-eq-height" id="PerformanceCamere">
                                            <div class="col-md-6">
                                                <div class="card col-eq-height">
                                                    <div class="card-header">
                                                        <h5>Performance Camera <b>anno</b></h5>
                                                    </div>
                                                    <div class="card-block" id="proposte_block">
                                                        <div id="preno_camera_pre"></div>
                                                        <div id="prenotazioni_camera"></div>
                                                    </div>
                                                    <div class="clearfix p-b-30"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card col-eq-height">
                                                    <div class="card-header">
                                                        <h5>Performance Operatore per <b>data</b> <small>(se la data non è impostata il primo filtro è per l'anno <?=date('Y')?> in corso)</small></h5>
                                                    </div>
                                                    <div class="card-block scroll" id="LavoroOperatori" style="min-height:400px">
                                                        <?php echo $fun->statisticheOperatore($_REQUEST['data'],IDSITO);?>
                                                    </div>
                                                    <div class="clearfix p-b-30"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix p-b-30"></div>
                                        <? include_module('backtop.inc.php'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    <!-- /.content -->
    <? include_module('footer.inc.php'); ?>
