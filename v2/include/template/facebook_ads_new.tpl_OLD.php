<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
    <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <section class="content">
<?//if(IS_NETWORK_SERVICE_USER == 1){?>
        <div class="box radius6">
            <div class="box-body">
              <h2>
                <div class="row">
                    <div class="col-md-2">
                      Filtri <span>&#10230;</span> Avanzati:
                    </div>
                    <div class="col-md-3  text-right"> <label><b> Conferme </b> <br><small>solo sul fatturato</small></label></div>
                    <div class="col-md-3 text-center">
                      <div class="row">

                          <form name="relation_requestdate" id="relation_requestdate" method="POST" action="<?=$_SERVER['REQUEST_URI']?>">
                            <div class="col-md-5">
                                    <input type="text" placeholder="Dal" id="DataRichiesta_dal" autocomplete="off"  class="date-picker form-control" name="DataRichiesta_dal" value="<?=$_REQUEST['DataRichiesta_dal']?>" data-date-end-date="-1d">
                            </div>
                            <div class="col-md-5">
                                    <input type="text" placeholder="Al"  id="DataRichiesta_al" autocomplete="off"  class="date-picker form-control" name="DataRichiesta_al" value="<?=$_REQUEST['DataRichiesta_al']?>" data-date-end-date="-1d">
                              </div>
                              <div class="col-md-1">
                                  <input type="hidden" name="action" value="request_date">
                                  <button id="pul_search_date" class="btn btn-success btn-md" type="button" style="margin-top:-5px!important">Filtra</button>
                              </div>
                          </form>
                          <script>
                                  $(document).ready(function(){
                                    $("#pul_search_date").on("click",function(){
                                      var dal = $("#DataRichiesta_dal").val();
                                      var dal_ = dal.split("/");
                                      if(parseInt(dal_[2]) < 2021){
                                        $("#relation_requestdate").attr('action','<?=BASE_URL_SITO?>grafici-facebook_ads/')
                                        $("#relation_requestdate").submit();
                                      }else{
                                        $("#relation_requestdate").attr('action','<?=BASE_URL_SITO?>grafici-facebook_ads_new/')
                                        $("#relation_requestdate").submit();
                                      }
                                    })
                                  })
                              </script>
                        </div>
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
                            <script>
                                  $(document).ready(function(){
                                    $("#querydate").on("change",function(){
                                      var filtro = $(this).val();
                                      if(parseInt(filtro) < 2021){
                                        $("#filter_year").attr('action','<?=BASE_URL_SITO?>grafici-facebook_ads/')
                                        $("#filter_year").submit();
                                      }else{
                                        $("#filter_year").attr('action','<?=BASE_URL_SITO?>grafici-facebook_ads_new/')
                                        $("#filter_year").submit();
                                      }
                                    })
                                  })
                              </script>
                        </form>
                      </small>
                    </div>
                  </div>
              </h2>
              <div class="text-center"><p>Se si filtrano i risultati per anno e si sceglie un <b>anno inferiore al 2021</b>, si verrà rediretti al <b>al metodo tradizionale di elaborazione dati</b>, stesso discorso vale anche per i filtri data sulle Prenotazioni Confermate!</p></div>
            </div>
              <?=$js_date?>
            </div>
            <div id="view_loading_statistiche"></div>
            <?=$js_load?>

            <div id="fatturatoN" class="box radius6">
                  <div class="box-header with-border">
                    <div class="text-center " style="width:100%!important">
                        <p>
                          <span id="blink_ppc"><b>[Nuovo Modulo]</b></span><br/>
                          <?php if(IS_NETWORK_SERVICE_USER == 1){?>
<!--                             <div class="alert alert-profila  alert-default-profila alert-dismissable text-black">
                            Visibile solo per Operatore Network<br />
                            <b>Legenda:</b> Ogni giorno (03:00 AM) i dati di <img src="<?=BASE_URL_SITO?>img/ic_analytics.png" style="width:16px;vertical-align:top"> <b>Google Analytics</b> vengono sincronizzati automaticamente da una procedura in background, ma se desiderate rilanciare lo script di sincronizzazione, potete farlo tramite il pulsante qui sotto!  
                            <?=$js_syncro_analytics?>
                            </div>   -->
                        <?}?>
                        </p>
                    </div>
                    <h3 class="box-title" style="width:100%!important">Totale <b>Fatturato Facebook Ads</b> <i class="fa fa-facebook-square fa-2x" style="color:#3B5897"></i> <?=($totaleFBn>0?' <span>&#10230;</span> <span class="text-success" style="font-size: 30px;"><i class="fa fa-euro"></i> '.number_format($totaleFBn,2,',','.').'</span>':'')?></h3>
                  

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
                      <?php if($messageN){?>
                          <div class="row">
                              <div class="col-md-12 col-sm-12 col-xs-12 text-center text-warning">
                                <?=$messageN?>
                              </div>
                          </div>
                      <?}?>
                      <?=($_REQUEST['action']=='check_date'?'<br>':'')?>
                      <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12">

                                

                                  <div class="box no-radius">
                                    <div class="box-header with-border">
                                    <h3 class="box-title">Fonte di prenotazione <b>Facebook Ads</b>: per campagne social.</h3>
                                  
                                      <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                      </div>
                                    </div>
                                    <div class="box-body">
                                    
                                      <div class="row">
                                        <div class="col-md-6">

                                            <?=$legendaSn_BOX?>
                                        </div>
                                        <div class="col-md-6 text-center">
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


            </div>

          <?=$js_toggle?>
        <?=$js_script_grafici?>
<?//}else{?>
<!--   <div class="box radius6">
      <div class="box-body">
        <div class="row">
            <div class="col-md-2"><img src="/img/manutenzione.png" style="height:120px;width:auto"></div>
            <div class="col-md-10 text-center"> <h1>L'area è in momentanea manutenzione: <br>Stiamo lavorando per migliorare i dati statistici di QUOTO</h1></div>
        </div>
      </div>
    </div> -->
<?//}?>
  </section><!-- /.content -->
</div><!-- ./wrapper -->
<?php include_module('footer.inc.php'); ?>
