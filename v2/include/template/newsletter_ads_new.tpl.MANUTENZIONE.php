<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
    <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <section class="content">
        <div class="box radius6">
            <div class="box-body">
                <h2>
                  <div class="row">
                      <div class="col-md-2">
                        Filtri <span>&#10230;</span> Avanzati:
                      </div>
                      <div class="col-md-3  text-right"> <label><b> Prenotazioni confermate </b> <br><small>solo sul fatturato</small></label></div>
                      <div class="col-md-3 text-center">
                        <div class="row">

                            <form name="relation_requestdate" id="relation_requestdate" method="POST" action="<?=$_SERVER['REQUEST_URI']?>">
                              <div class="col-md-5">
                                      <input type="text" placeholder="Dal" id="DataRichiesta_dal" autocomplete="off"  class="date-picker form-control" name="DataRichiesta_dal" value="<?=$_REQUEST['DataRichiesta_dal']?>"  data-date-end-date="-1d">
                              </div>
                              <div class="col-md-5">
                                      <input type="text" placeholder="Al"  id="DataRichiesta_al" autocomplete="off"  class="date-picker form-control" name="DataRichiesta_al" value="<?=$_REQUEST['DataRichiesta_al']?>" data-date-end-date="-1d">
                                </div>
                                <div class="col-md-1">
                                    <input type="hidden" name="action" value="request_date">
                                    <button id="pul_search_date" class="btn btn-success btn-md" type="submit" style="margin-top:-5px!important">Filtra</button>
                                </div>
                            </form>
                          </div>
                      </div>
                      <div class="col-md-2 text-right">
                        <label><b>Filtra per Anno</b> </label>
                      </div>
                      <div class="col-md-2 text-center">
                        <small>
                          <form method="post" name="filter_year" id="filter_year">
                              <input type="hidden" name="action" value="check_year">
                              <select  name="querydate" id="querydate" class="form-control" onchange="submit();">
                                  <?=$lista_anni?>
                              </select>
                          </form>
                        </small>
                      </div>
                    </div>
                </h2>
              
              </div>
              <?=$js_date?>
            </div>
            <div id="view_loading_statistiche"></div>
            <?=$js_load?>
            <div id="fatturatoN" class="box radius6">
                  <div class="box-header with-border">
                    <div class="text-center" style="width:100%!important">
                        <p>
                          <span id="blink_ppc"><b>[Nuovo Modulo]</b></span><br/>
                          <?php if(IS_NETWORK_SERVICE_USER == 1){?>
                            <div class="alert alert-profila  alert-default-profila alert-dismissable text-black">
                            Visibile solo per Operatore Network<br />
                            <b>Legenda:</b> Ogni giorno (03:00 AM) i dati di <img src="<?=BASE_URL_SITO?>img/ic_analytics.png" style="width:16px;vertical-align:top"> <b>Google Analytics</b> vengono sincronizzati automaticamente da una procedura in background, ma se desiderate rilanciare lo script di sincronizzazione, potete farlo tramite il pulsante qui sotto!  
                          <?=$js_syncro_analytics?>  
                          </div>  
                        <?}?>
                        </p> 
                    </div>
                      <h3 class="box-title" style="width:100%!important">Totale <b>Fatturato Newsletter Ads</b> <img src="<?=BASE_URL_SITO?>img/analytics.png" style="width:32px;height:32px"/><?=($totalePPCn>0?' <span>&#10230;</span> <span class="text-success" style="font-size: 30px;"><i class="fa fa-euro"></i> '.number_format($totalePPCn,2,',','.').'</span>':'')?></h3>
                     

                    <div class="box-tools pull-right">
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div>
                  <div class="box-body">

                      <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                          <?
                            if($_REQUEST['action']=='check_year'){
                              echo (strlen($_REQUEST['querydate'])>1?'<b>Anno</b> '.$_REQUEST['querydate']:'<b>Ultimo Mese</b>');
                            }
                            if($_REQUEST['action']=='request_date'){
                              echo ($_REQUEST['DataRichiesta_dal']!=''?'<b>Data Prenotazione Dal</b> '.$_REQUEST['DataRichiesta_dal']:'').' '.($_REQUEST['DataRichiesta_al']!=''?' <b>Data Prenotazione Al</b> '.$_REQUEST['DataRichiesta_al']:'');
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
                                      <h3 class="box-title">Fonte di prenotazione <b>Newsletter Ads</b>: per campagne.</h3>
                                      <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                      </div>
                                    </div>
                                    <div class="box-body">
                              
                                      <div class="row">
                                        <div class="col-md-4">
                                    
                                            <?=$legendaSn_BOX?>
                                        </div>
                                        <div class="col-md-8 text-center">
                                          <p><b>Grafico interattivo valori dinamici espressi in € e %</b> <small>(visibili solo se diversi da 0 e solo su prenotazioni confermate)</small></p>
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
