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
                      <div class="col-md-3  text-right"> <label><b> Prenotazioni confermate </b> </label></div>
                      <div class="col-md-3 text-center">
                        <div class="row">

                            <form name="relation_requestdate" id="relation_requestdate" method="POST" action="<?=$_SERVER['REQUEST_URI']?>">
                              <div class="col-md-5">
                                      <input type="text" placeholder="Dal" id="DataRichiesta_dal" autocomplete="off"  class="date-picker form-control" name="DataRichiesta_dal" value="<?=$_REQUEST['DataRichiesta_dal']?>">
                              </div>
                              <div class="col-md-5">
                                      <input type="text" placeholder="Al"  id="DataRichiesta_al" autocomplete="off"  class="date-picker form-control" name="DataRichiesta_al" value="<?=$_REQUEST['DataRichiesta_al']?>">
                                </div>
                                <div class="col-md-1">
                                    <input type="hidden" name="action" value="request_date">
                                    <button class="btn btn-success btn-md" type="submit" style="margin-top:-5px!important">Filtra</button>
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
                              <select  name="querydate" class="form-control" onchange="submit()">
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
            <div id="fatturato" class="box radius6">
                  <div class="box-header with-border">
                      <h3 class="box-title" style="width:100%!important">Totale <b>Fatturato Google Ads</b> <?=($totalePPC>0?' <span>&#10230;</span> <span class="text-success"><i class="fa fa-euro"></i> '.number_format($totalePPC,2,',','.').'</span>':'')?></h3>
                      <small><i class="fa fa-exclamation-circle text-info"></i> <b>InfoDesk:</b> dal periodo che va dalla vostra attivazione di QUOTO sino al 10-10-2019 le campagne Google Ads verranno riunite sotto una unica voce <b>"Altre campagne"</b>; dalla suddetta data in poi ogni "Prenotazione confermata" proveniente da una campagna PPC verrà <b>classificata con il nome della campagna</b> stessa!</small>
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
                      <?php if($message){?>
                          <div class="row">
                              <div class="col-md-12 col-sm-12 col-xs-12 text-center text-warning">
                                <?=$message?>
                              </div>
                          </div>
                      <?}?>
                      <?=($_REQUEST['action']=='check_date'?'<br>':'')?>
                      <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12">

                                <?if(($totalePPC)>0){?>

                                  <div class="box no-radius">
                                    <div class="box-header with-border">
                                      <h3 class="box-title">Fonte di prenotazione <b>PPC di Google</b>: suddivisione per campagne.</h3>
                                      <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                      </div>
                                    </div>
                                    <div class="box-body">
                                      <div class="row">
                                        <div class="col-md-4">
                                            <p><b>Valori espressi in €</b> <small>(tutti visibili)</small></p>
                                            <?=$legendaS?>
                                        </div>
                                        <div class="col-md-8 text-center">
                                          <p><b>Grafico interattivo valori dinamici espressi in € e %</b> <small>(visibili solo se diversi da 0)</small></p>
                                          <div id="pieChart" style="width:100%; height:550px"></div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="box-footer">

                                    </div>
                                  </div>

                                <?}?>

                          </div>

                      </div>
                  </div>
            </div>


            </div>
            <?=$js_toggle?>

          <?=$js_script_grafici?>

  </section><!-- /.content -->
</div><!-- ./wrapper -->
<?php include_module('footer.inc.php'); ?>
