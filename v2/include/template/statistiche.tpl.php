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
                      <div class="col-md-3">
                        Filtri <span>&#10230;</span> Avanzati <a href="javascript:;" id="view_avanzati"><span class="pull-right" style="display:none" id="expand"><i class="fa fa-expand text-green"  aria-hidden="true"></i> <small>espandi</small></span> <span class="pull-right" id="compress"><i class="fa fa-compress text-red" aria-hidden="true"></i> <small>comprimi</small></span></a>
                      </div>
                      <div class="col-md-3 text-right"><small><a href="<?=BASE_URL_SITO.'grafici-statistiche/'?>"><i class="fa fa-refresh"></i> reset filtri</a></small></div>
                      <div class="col-md-4 text-right">
                        <label><b>Filtra per Anno</b> </label>
                      </div>
                      <div class="col-md-2 text-center">
                        <small>
                          <form method="post" name="filter_year" id="filter_year">
                              <input type="hidden" name="action" value="check_year">
                              <select  name="querydate" id="querydate" class="form-control">
                                  <?=$lista_anni?>
                              </select>
                          </form>
                          <script>
                                  $(document).ready(function(){
                                    $("#querydate").on("change",function(){
                                      var filtro = $(this).val();
                                      if(parseInt(filtro) >= 2021){
                                        $("#filter_year").attr('action','<?=BASE_URL_SITO?>grafici-statistiche3/')
                                        $("#filter_year").submit();
                                      }else{
                                        $("#filter_year").attr('action','<?=BASE_URL_SITO?>grafici-statistiche/')
                                        $("#filter_year").submit();
                                      }
                                    })
                                  })
                              </script>
                        </small>
                      </div>
                    </div>
                </h2>
                <div class="text-center"><p>Filtrando i risultati <b>per anno</b> e scegliendo un <b>anno superiore al 2020</b>, si verrà rediretti al <b>al nuovo metodo di elaborazione dati</b> (API Analytics), stesso discorso vale per i filtri sulle <b>Prenotazioni Confermate</b>!<br>Invece  <b>sulle date di confronto</b> NON si viene rediretti, ma si rimane sulla schermata d'ingresso!</p></div>
              <div id="avanzati">
                <div class="clearfix"></div>
                        <div class="row">
                          <div class="col-md-12">
                            <small><i class="fa fa-arrow-down" style="padding-top:20px"></i> Confronta le date di arrivo e le date di partenza delle prenotazioni confermate;
                              incrociate tra un periodo ed un altro mostreranno a video due grafici di comparazione!
                            </small>
                          </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="row">
                            <form name="relation_checkdate" id="relation_checkdate" method="POST" action="<?=$_SERVER['REQUEST_URI']?>">
                              <div class="col-md-2">
                                <p>Confronta date di soggiorno <b>Dal</b></p>
                                    <div class="row">
                                        <div class="col-md-6">
                                          <label>Arrivo</label>
                                          <input type="text" id="DataArrivo_dal" autocomplete="off"  class="date-picker form-control" name="DataArrivo_dal" value="<?=$_REQUEST['DataArrivo_dal']?>">
                                        </div>
                                        <div class="col-md-6">
                                          <label>Partenza</label>
                                          <input type="text" id="DataPartenza_dal" autocomplete="off"  class="date-picker form-control" name="DataPartenza_dal" value="<?=$_REQUEST['DataPartenza_dal']?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                  <p>Confronta date di soggiorno <b>Al</b></p>
                                    <div class="row">
                                        <div class="col-md-6">
                                          <label>Arrivo</label>
                                          <input type="text" id="DataArrivo_al" autocomplete="off"  class="date-picker form-control" name="DataArrivo_al" value="<?=$_REQUEST['DataArrivo_al']?>">
                                        </div>
                                        <div class="col-md-6">
                                          <label>Partenza</label>
                                          <input type="text" id="DataPartenza_al" autocomplete="off"  class="date-picker form-control" name="DataPartenza_al" value="<?=$_REQUEST['DataPartenza_al']?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div style="clear:both;height:57px">&nbsp;</div>
                                    <input type="hidden" name="action" value="check_date">
                                    <button class="btn btn-success btn-md" type="submit">Filtra</button>
                                </div>
                            </form>
                            <div class="col-md-1">&nbsp;</div>
                            <form name="relation_requestdate" id="relation_requestdate" method="POST" action="<?=$_SERVER['REQUEST_URI']?>" >
                              <div class="col-md-2">
                                <div style="clear:both;height:30px">&nbsp;</div>
                                    <label>Prenotazioni confermate <b>Dal</b></label>
                                      <input type="text" id="DataRichiesta_dal" autocomplete="off"  class="date-picker form-control" name="DataRichiesta_dal" value="<?=$_REQUEST['DataRichiesta_dal']?>">
                              </div>
                              <div class="col-md-2 ">
                                  <div style="clear:both;height:30px">&nbsp;</div>
                                    <label>Prenotazioni confermate <b>Al</b></label>
                                      <input type="text" id="DataRichiesta_al" autocomplete="off"  class="date-picker form-control" name="DataRichiesta_al" value="<?=$_REQUEST['DataRichiesta_al']?>">
                                </div>
                                <div class="col-md-1 text-left">
                                    <div style="clear:both;height:57px">&nbsp;</div>
                                    <input type="hidden" name="action" value="request_date">
                                    <button id="pul_search_date" class="btn btn-success btn-md" type="button">Filtra</button>
                                </div>
                            </form>
                            <script>
                                  $(document).ready(function(){
                                    $("#pul_search_date").on("click",function(){
                                      var dal = $("#DataRichiesta_dal").val();
                                      var dal_ = dal.split("/");
                                      if(parseInt(dal_[2]) >= 2021){
                                        $("#relation_requestdate").attr('action','<?=BASE_URL_SITO?>grafici-statistiche3/')
                                        $("#relation_requestdate").submit();
                                      }else{
                                        $("#relation_requestdate").attr('action','<?=BASE_URL_SITO?>grafici-statistiche/')
                                        $("#relation_requestdate").submit();
                                      }
                                    })
                                  })
                              </script>
                          </div>
                      </div>
                  </div>
              <?=$js_date?>
            </div>
            <div id="view_loading_statistiche"></div>
            <?=$js_load?>
            <div id="fatturato" class="box radius6">
                  <div class="box-header with-border">
                    <h3 class="box-title" style="width:100%!important">Statistiche <b>Fatturato</b> </h3>
                    <div class="box-tools pull-right">
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div>
                  <div class="box-body">

                      <div class="row">
                          <div class="<?=($split_graph == true?'col-md-6 col-sm-6 col-xs-6':'col-md-12 col-sm-12 col-xs-12')?> text-center">
                          <?
                            if($_REQUEST['action']=='check_date'){
                                echo '<b>DAL</b><br>';
                                echo ($_REQUEST['DataArrivo_dal']!=''?'<b>Arrivi</b> '.$_REQUEST['DataArrivo_dal']:'').' '.($_REQUEST['DataPartenza_dal']!=''?' <b>Partenze</b> '.$_REQUEST['DataPartenza_dal']:'');
                            }
                            if($_REQUEST['action']=='check_year'){
                              echo (strlen($_REQUEST['querydate'])>1?'<b>Anno</b> '.$_REQUEST['querydate']:'<b>Ultimo Mese</b>');
                            }
                            if($_REQUEST['action']=='request_date'){
                              echo ($_REQUEST['DataRichiesta_dal']!=''?'<b>Data Prenotazione Dal</b> '.$_REQUEST['DataRichiesta_dal']:'').' '.($_REQUEST['DataRichiesta_al']!=''?' <b>Data Prenotazione Al</b> '.$_REQUEST['DataRichiesta_al']:'');
                            }
                          ?>

                          </div>
                          <div class="col-md-6 col-sm-6 col-xs-6 text-center" <?=($split_graph == true?'':'style="display:none"')?>>
                          <?
                            if($_REQUEST['action']=='check_date'){
                              echo '<b>AL</b><br>';
                              echo ($_REQUEST['DataArrivo_al']!=''?'<b>Arrivi</b> '.$_REQUEST['DataArrivo_al']:'').' '.($_REQUEST['DataPartenza_al']!=''?' <b>Partenze</b> '.$_REQUEST['DataPartenza_al']:'');
                            }
                          ?>
                          </div>
                      </div>
                      <?=($_REQUEST['action']=='check_date'?'<br>':'')?>
                      <div class="row">
                          <div class="<?=($split_graph == true?'col-md-6 col-sm-6 col-xs-6':'col-md-12 col-sm-12 col-xs-12')?>">

                                  <? if($tot >0){?>
                                    <?if($array_fatturato>0){?>
                                      <div class="row">
                                      <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="box no-radius">
                                            <div class="box-header with-border">
                                              <h3 class="box-title" style="width:100%!important">Fatturato per <b>fonti di prenotazione</b> </h3>
                                              <div class="box-tools pull-right">
                                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                              </div>
                                            </div>
                                            <div class="box-body" style="height: 100%; margin: 0">
                                            <div class="row">
                                              <div class="col-md-4">
                                                  <p><b>Valori espressi in €</b> <small>(tutti visibili)</small></p>
                                                  <?=$legenda?>
                                              </div>
                                              <div class="col-md-8 text-center">
                                                <p><b>Grafico interattivo valori dinamici espressi in € e %</b> <small>(visibili solo se diversi da 0)</small></p>
                                                <div id="pieChart" style="width:100%; height:550px"></div>
                                              </div>
                                            </div>

                                            </div><!-- /.box-body -->
                                            <div class="box-footer">
                                              <small>Se il <b>TOTALE</b> non dovesse corrispondere al valore del fatturato riportato nella <b>DashBoard</b>, probabilmente avete eliminato una o più <b>fonti di prenotazione</b> nel corso dell'anno!</small>
                                            </div>
                                          </div>
                                      </div>
                                    </div>
                                  <?}?>
                                <?}?>
                                <?if($array_fatturatoS['Organico']>0 || $array_fatturatoS['Diretto']>0  || $array_fatturatoS['Facebook']>0  || $array_fatturatoS['Newsletter']>0 || $array_fatturatoS['PPC']>0 || $array_fatturatoS['Referral/Altro']>0){?>

                                          <div class="box no-radius">
                                            <div class="box-header with-border">
                                              <h3 class="box-title"><b>Dettaglio</b> del fatturato: fonte di prenotazione <b>Sito Web</b> </h3>
                                              <div class="box-title">
                                                  <small>Suddivisione delle <b>fonte Sito Web</b>: se la provenienza deriva da una campagna social, un Pay x Click, da un risultato di indicizzazione organica, da una richiesta proveniente da una landing page dedicata, oppure da una entrata diretta nel vostro sito.</small>
                                              </div>
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
                                                  <div id="pieChart2" style="width:100%; height:550px"></div>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="box-footer">
                                            <?if($_REQUEST['querydate']=='2017'){?>
                                              <small>Filtro valido dal <b>05/07/2017</b> in poi..., quindi potrebbero esserci delle  differenze tra il totale fatturato <b>"fonti di prenotazione Sito Web"</b> ed il totale del <b>"dettaglio fonte di prenotazione Sito Web".</b> Questa incongruenza la dovreste riscontrate solo fino allo scadere dell'anno 2017!</small>
                                            <?}?>
                                            </div>
                                          </div>

                                <?}?>
                                  <? if($totTARGET >0){?>
                                    <?if($array_fatturatoTARGET>0){?>
                                      <!-- DONUT CHART -->
                                      <div class="box no-radius">
                                        <div class="box-header with-border">
                                          <h3 class="box-title">Fatturato per <b>Target Clienti</b> </h3>

                                          <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                          </div>
                                        </div>
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <p><b>Valori espressi in €</b></p>
                                                    <?=$legendaT?>
                                                </div>
                                                <div class="col-md-8 text-center">
                                                  <p><b>Grafico interattivo valori dinamici espressi in € e %</b> <small>(visibili solo se diversi da 0)</small></p>
                                                  <div id="pieChart4" style="width:100%; height:550px"></div>
                                                </div>
                                              </div>
                                        </div>
                                        <div class="box-footer">

                                        </div>
                                      </div>
                                      <!-- /.box -->
                                  <?}?>
                                <?}?>
                                  <? if($totOperatore >0){?>
                                    <?if($array_fatturatoOperatore>0){?>
                                      <!-- DONUT CHART -->
                                      <div class="box no-radius">
                                        <div class="box-header with-border">
                                          <h3 class="box-title">Fatturato per <b>Operatori</b></h3>

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
                                                    <?=$legendaOP?>
                                                </div>
                                                <div class="col-md-8 text-center">
                                                  <p><b>Grafico interattivo valori dinamici espressi in € e %</b> <small>(visibili solo se diversi da 0)</small></p>
                                                  <div id="pieChart3" style="width:100%; height:550px"></div>
                                                </div>
                                              </div>
                                        </div>
                                        <div class="box-footer">
                                          <small>Se il <b>TOTALE</b> non dovesse corrispondere al valore del fatturato riportato nella <b>DashBoard</b>, probabilmente avete eliminato uno o più <b>Operatori</b> nel corso dell'anno!</small>
                                        </div>
                                      </div>
                                      <!-- /.box -->
                                  <?}?>
                                <?}?>

                                <? if($totTemplate >0){?>
                                    <?if($array_fatturatoTemplate>0){?>
                                      <!-- DONUT CHART -->
                                      <div class="box no-radius">
                                        <div class="box-header with-border">
                                          <h3 class="box-title">Fatturato per <b>Template Landing Page</b></h3>

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
                                                    <?=$legendaTP?>
                                                </div>
                                                <div class="col-md-8 text-center">
                                                  <p><b>Grafico interattivo valori dinamici espressi in € e %</b> <small>(visibili solo se diversi da 0)</small></p>
                                                  <div id="pieChart5" style="width:100%; height:550px"></div>
                                                </div>
                                              </div>
                                        </div>
                                        <div class="box-footer">

                                        </div>
                                      </div>
                                      <!-- /.box -->
                                  <?}?>
                                <?}?>
                          </div>

                          <div class="col-md-6 col-sm-6 col-xs-6" <?=($split_graph == true?'':'style="display:none"')?>>


                                  <? if($tot2 >0){?>
                                    <?if($array_fatturato2>0){?>
                                      <div class="row">
                                      <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="box no-radius">
                                            <div class="box-header with-border">
                                              <h3 class="box-title" style="width:100%!important">Fatturato per <b>fonti di prenotazione</b> </h3>
                                              <div class="box-tools pull-right">
                                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                              </div>
                                            </div>
                                            <div class="box-body" style="height: 100%; margin: 0">
                                            <div class="row">
                                              <div class="col-md-4">
                                                  <p><b>Valori espressi in €</b> <small>(tutti visibili)</small></p>
                                                  <?=$legenda2?>
                                              </div>
                                              <div class="col-md-8 text-center">
                                                <p><b>Grafico interattivo valori dinamici espressi in € e %</b> <small>(visibili solo se diversi da 0)</small></p>
                                                <div id="pieChart_bis" style="width:100%; height:550px"></div>
                                              </div>
                                            </div>

                                            </div><!-- /.box-body -->
                                            <div class="box-footer">
                                              <small>Se il <b>TOTALE</b> non dovesse corrispondere al valore del fatturato riportato nella <b>DashBoard</b>, probabilmente avete eliminato una o più <b>fonti di prenotazione</b> nel corso dell'anno!</small>
                                            </div>
                                          </div>
                                      </div>
                                    </div>
                                  <?}?>
                                <?}?>
                                <?if($array_fatturatoS2['Organico']>0 || $array_fatturatoS2['Diretto']>0  || $array_fatturatoS2['Facebook']>0  || $array_fatturatoS2['Newsletter']>0 || $array_fatturatoS2['PPC']>0 || $array_fatturatoS2['Referral/Altro']>0){?>

                                          <div class="box no-radius">
                                            <div class="box-header with-border">
                                              <h3 class="box-title"><b>Dettaglio</b> del fatturato: fonte di prenotazione <b>Sito Web</b> </h3>
                                              <div class="box-title">
                                                  <small>Ulteriore suddivisione delle <b>fonte Sito Web</b>: se la provenienza deriva da una campagna social, un Pay x Click, da un risultato di indicizzazione organica, oppure da una entrata diretta nel vostro sito, ecc.</small>
                                              </div>
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
                                                    <?=$legendaS2?>
                                                </div>
                                                <div class="col-md-8 text-center">
                                                  <p><b>Grafico interattivo valori dinamici espressi in € e %</b> <small>(visibili solo se diversi da 0)</small></p>
                                                  <div id="pieChart2_bis" style="width:100%; height:550px"></div>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="box-footer">
                                            <?if($_REQUEST['querydate']=='2017'){?>
                                              <small>Filtro valido dal <b>05/07/2017</b> in poi..., quindi potrebbero esserci delle  differenze tra il totale fatturato <b>"fonti di prenotazione Sito Web"</b> ed il totale del <b>"dettaglio fonte di prenotazione Sito Web".</b> Questa incongruenza la riscontrate solo fino allo scadere di questo anno solare!</small>
                                            <?}?>
                                            </div>
                                          </div>

                                <?}?>
                                  <? if($totTARGET2 >0){?>
                                    <?if($array_fatturatoTARGET2>0){?>
                                      <!-- DONUT CHART -->
                                      <div class="box no-radius">
                                        <div class="box-header with-border">
                                          <h3 class="box-title">Fatturato per <b>Target Clienti</b> </h3>

                                          <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                          </div>
                                        </div>
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <p><b>Valori espressi in €</b></p>
                                                    <?=$legendaT2?>
                                                </div>
                                                <div class="col-md-8 text-center">
                                                  <p><b>Grafico interattivo valori dinamici espressi in € e %</b> <small>(visibili solo se diversi da 0)</small></p>
                                                  <div id="pieChart4_bis" style="width:100%; height:550px"></div>
                                                </div>
                                              </div>
                                        </div>
                                        <div class="box-footer">

                                        </div>
                                      </div>
                                      <!-- /.box -->
                                  <?}?>
                                <?}?>
                                  <? if($totOperatore2 >0){?>
                                    <?if($array_fatturatoOperatore2>0){?>
                                      <!-- DONUT CHART -->
                                      <div class="box no-radius">
                                        <div class="box-header with-border">
                                          <h3 class="box-title">Fatturato per <b>Operatori</b></h3>

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
                                                    <?=$legendaOP2?>
                                                </div>
                                                <div class="col-md-8 text-center">
                                                  <p><b>Grafico interattivo valori dinamici espressi in € e %</b> <small>(visibili solo se diversi da 0)</small></p>
                                                  <div id="pieChart3_bis" style="width:100%; height:550px"></div>
                                                </div>
                                              </div>
                                        </div>
                                        <div class="box-footer">
                                          <small>Se il <b>TOTALE</b> non dovesse corrispondere al valore del fatturato riportato nella <b>DashBoard</b>, probabilmente avete eliminato uno o più <b>Operatori</b> nel corso dell'anno!</small>
                                        </div>
                                      </div>
                                      <!-- /.box -->
                                  <?}?>
                                <?}?>

                                <? if($totTemplate2 >0){?>
                                    <?if($array_fatturatoTemplate2>0){?>
                                      <!-- DONUT CHART -->
                                      <div class="box no-radius">
                                        <div class="box-header with-border">
                                          <h3 class="box-title">Fatturato per <b>Template Landing Page</b></h3>

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
                                                    <?=$legendaTP2?>
                                                </div>
                                                <div class="col-md-8 text-center">
                                                  <p><b>Grafico interattivo valori dinamici espressi in € e %</b> <small>(visibili solo se diversi da 0)</small></p>
                                                  <div id="pieChart5_bis" style="width:100%; height:550px"></div>
                                                </div>
                                              </div>
                                        </div>
                                        <div class="box-footer">

                                        </div>
                                      </div>
                                      <!-- /.box -->
                                  <?}?>
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
