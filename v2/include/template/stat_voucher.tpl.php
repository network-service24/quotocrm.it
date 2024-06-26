<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
    <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <section class="content">
        <div class="box radius6">
            <div class="box-body">
                <h3>
                  <div class="row">
                      <div class="col-md-4">
                        Filtri <span>&#10230;</span> Avanzati:
                      </div>
                      <div class="col-md-4 text-center">
                        <small><a href="<?=BASE_URL_SITO?>grafici-stat_voucher/"><i class="fa fa-refresh" aria-hidden="true"></i> reset filtri</a></small>
                      </div>
                      <div class="col-md-4"></div>
                    </div>
                    <h3>
                    <div class="row">
                    <form name="relation_requestdate" id="relation_requestdate" method="POST" action="<?=$_SERVER['REQUEST_URI']?>">
                      <div class="col-md-2 text-right">
                          <label><b>Motivazione</b> </label>
                        </div>
                        <div class="col-md-2 text-right">
                          <select  name="motivazione" class="form-control">
                                    <?=$motiv?>
                          </select>
                        </div>
                        <div class="col-md-2  text-right"> <label><b> Prenotazioni disdette </b><br><small>Data prentazione</small></label></div>
                        <div class="col-md-3 text-center">
                            <div class="row">
                                  <div class="col-md-5">
                                          <input type="text" placeholder="Dal" id="DataVoucherRecSend_dal" autocomplete="off"  class="date-picker form-control" name="DataVoucherRecSend_dal" value="<?=$_REQUEST['DataVoucherRecSend_dal']?>">
                                  </div>
                                  <div class="col-md-5">
                                          <input type="text" placeholder="Al"  id="DataVoucherRecSend_al" autocomplete="off"  class="date-picker form-control" name="DataVoucherRecSend_al" value="<?=$_REQUEST['DataVoucherRecSend_al']?>">
                                    </div>
                                    <div class="col-md-1">
                                        <input type="hidden" name="action" value="request_date">
                                        <button class="btn btn-success btn-md" type="submit" style="margin-top:-5px!important">Filtra</button>
                                    </div>
                              </div>
                        </div>
                      </form>
                      <div class="col-md-2 text-right">
                        <label><b>Filtra per Anno</b> </label>
                      </div>
                      <div class="col-md-1 text-center">
                        <small>
                          <form method="post" name="filter_year" id="filter_year">
                              <input type="hidden" name="action" value="check_year">
                              <select  name="querydate" class="form-control" onchange="submit()">
                                  <?=$lista_anni?>
                              </select>
                          </form>
                        </small>
                      </div>
                    </div>
                </h3>
              </div>
              <?=$js_date?>
            </div>
            <div id="view_loading_statistiche"></div>
            <?=$js_load?>
            <div id="fatturatoN" class="box radius6">
                  <div class="box-header with-border">
                      <h3 class="box-title" style="width:100%!important;display:inline!important">
                      <div class="row">
                        <div class="col-md-4">Valori numeri e grafico statistico sulle disdette <b>motivate</b>... </div>
                        <div class="col-md-1">
                            <form id="form_export" method="post" name="form_export" action="<?=BASE_URL_SITO?>include/controller/export_disdette_quoto.php">
                                <input type="hidden" name="action" value="export">
                                <input type="hidden" name="idsito" value="<?=IDSITO?>">
                                <input type="hidden" name="DataVoucherRecSend_dal" value="<?=$_REQUEST['DataVoucherRecSend_dal']?>">
                                <input type="hidden" name="DataVoucherRecSend_al" value="<?=$_REQUEST['DataVoucherRecSend_al']?>">
                                <input type="hidden" name="motivazione" value="<?=$_REQUEST['motivazione']?>">
                                <a href="#" class="btn btn-default btn-xs" onclick="document.getElementById('form_export').submit();" id="pulsante_esporta"><i class="fa fa-file-excel-o black" aria-hidden="true"></i> <span style="margin-left: 10px!important;color:#363636 !important;">Esporta CSV</span></a>
                            </form>
                        </div>
                        <div class="col-md-7">           
                          <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                          </div>
                        </div>
                      </div>
                    </h3>
                  </div>
                  <div class="box-body">

                      <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                          <?
                            if($_REQUEST['action']=='check_year'){
                              echo (strlen($_REQUEST['querydate'])>1?'<b>Anno</b> '.$_REQUEST['querydate']:'<b>Ultimo Mese</b>');
                            }
                            if($_REQUEST['action']=='request_date'){
                              echo ($_REQUEST['DataVoucherRecSend_dal']!=''?'<b>Data Prenotazione Dal</b> '.$_REQUEST['DataVoucherRecSend_dal']:'').' '.($_REQUEST['DataVoucherRecSend_al']!=''?' <b>Data Prenotazione Al</b> '.$_REQUEST['DataVoucherRecSend_al']:'');
                            }
                          ?>

                          </div>
                          <div class="col-md-6 col-sm-6 col-xs-6 text-center">
                          <?
                            if($_REQUEST['action']=='check_date'){
                              echo '<b>AL</b><br>';
                              echo ($_REQUEST['DataArrivo_al']!=''?'<b>Arrivi</b> '.$_REQUEST['DataArrivo_al']:'').' '.($_REQUEST['DataPartenza_al']!=''?' <b>Partenze</b> '.$_REQUEST['DataPartenza_al']:'');
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

                                
                        
                                  <div class="box no-radius">
                                    <div class="box-header with-border">
                                      <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                      </div>
                                    </div>
                                    <div class="box-body">
                              
                                      <div class="row">
                                        <div class="col-md-4">
                                            <div class="row">
                                              <div class="col-md-12">
                                                  <h4>Lista prenotazioni disdette per TAG motivazione.</h4>
                                                  <?=$legenda?>
                                              </div>
                                              <div class="col-md-12">
                                                  <h4>Numero prenotazioni disdette per TAG motivazione.</h4>
                                                  <?=$legendaN?>
                                              </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8 text-center">
                                          <div id="pieChartNew" style="width:100%; height:550px"></div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="box-footer">

                                    </div>
                                  </div>

                             

                          </div>

                      </div>
                  </div>
            </div> 
      <?=$js_toggle?>
  <?=$js_script_grafici?>

    <!-- ============================================================== -->
  </section><!-- /.content -->
</div><!-- ./wrapper -->
<?php include_module('footer.inc.php'); ?>
