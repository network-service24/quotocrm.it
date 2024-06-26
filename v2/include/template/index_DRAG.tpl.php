<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<?=$js_eq?>
<div class="content-wrapper">
<?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <!-- Main content -->
    <section class="content">
            <?=$script_modale;?>
            <?=$modale;?>

            <?if($permessi['DASH']==1){?>
                <form id="statistiche" name="statistiche" method="post">
                  <small><b>Legenda:</b> E' possibile filtrare i risultati degli Info-Box per query già pre-impostate (oggi, domani, ecc) oppure è possibile settare un range di date!
                   Le richieste cestinate non alterano i risultati statitici, ma interagisco solo se eliminate definitivamente!</small>
                  <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label>Imposta i filtri per gli Info-Box da questo campo di ricerca!</label>
                          <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input placeholder="Applica la query di ricerca e clicca sul pulsante FILTRA" class="form-control" id="demo" name="date" type="text" autocomplete="off">
                            </div><!-- /.input group -->
                          </div>
                    </div>
                    <div class="col-md-1 col-sm-2 col-xs-12">
                          <div style="margin-top:25px!important">
                            <button type="submit" class="btn btn-success"><i class="fa fa-refresh" aria-hidden="true"></i> FILTRA</button>
                          </div>
                    </div>
                    <div class="col-md-1 col-sm-2 col-xs-12">
                          <div style="margin-top:25px!important">
                            <span>&#10230;</span> <span>&#10230;</span> <span>&#10230;</span>
                          </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <div style="margin-top:25px!important">
                        <?
                        if($_REQUEST['date']!= ''){
                          echo'Risultati filtro per il periodo dal <b>'.$prima_data_it.'</b> al <b>'.$seconda_data_it.'</b>';
                        }else{
                          echo'<h4>I risultati dei <b>Box Informativi</b> sono dell\'anno in corso: <b  class="text-red">'.date('Y').'</b></h4>';
                        }
                        ?>
                      </div>
                    </div>
                  </div>
                </form>
                <br>
            <?}?>
            <?if($permessi['DASH']==1){?>
              <div class="grid-stack" data-gs-width="12" data-gs-animate="yes">
                      <div class="grid-stack-item" data-gs-x="0" data-gs-y="0" data-gs-width="2" data-gs-height="2">
                          <div class="grid-stack-item-content">
                            <div class="info-box bg-green radius6 animated zoomIn del2">
                            <span class="info-box-icon"><i class="fa fa-envelope"></i></span>
                             <div class="info-box-content">
                               <span class="info-box-text">Preventivi</span>
                                <span class="info-box-number text12 lineheight25">Inseriti <?=tot_preventivi()?> - Inviati <?=tot_invii()?></span>
                                <div class="progress">
                                  <div class="progress-bar" style="width: <?=$PercentualePrevInviati?>%"></div>
                                </div>
                                <span class="progress-description" data-toogle="tooltip" title="<?=$PercentualePrevInviati?>% di preventivi inviati sui preventivi inseriti!">
                                      <?=$PercentualePrevInviati?>% inviati sugli inseriti
                                </span>
                              </div>
                            </div>
                          </div>
                      </div>
                      <div class="grid-stack-item" data-gs-x="2" data-gs-y="0" data-gs-width="2" data-gs-height="2">
                          <div class="grid-stack-item-content">
                            <div class="info-box bg-yellow radius6 animated zoomIn del3">
                              <span class="info-box-icon"><i class="fa fa-bed"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">Conferme in trattativa</span>
                                <span class="info-box-number"><?=tot_conferme()?></span>
                                <div class="progress">
                                  <div class="progress-bar" style="width: <?=$PercentualeConferme?>%"></div>
                                </div>
                                <span class="progress-description" data-toogle="tooltip" title="<?=$PercentualeConferme?>% delle conferme inviate sui preventivi inviati!">
                                      <?=$PercentualeConferme?>% conferme sui preventivi inviati
                                </span>
                              </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                          </div>
                      </div>
                      <div class="grid-stack-item" data-gs-x="4" data-gs-y="0" data-gs-width="2" data-gs-height="2">
                          <div class="grid-stack-item-content">
                            <div class="info-box bg-aqua radius6 animated zoomIn del4">
                              <span class="info-box-icon"><i class="fa fa-h-square"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">Prenotazioni Confermate</span>
                                <span class="info-box-number"><?=tot_prenotazioni()?></span>
                                <div class="progress">
                                  <div class="progress-bar" style="width: <?=$PercentualePrenotazioni?>%"></div>
                                </div>
                                <span class="progress-description" data-toogle="tooltip" title="<?=$PercentualePrenotazioni?>% delle prenotazioni chiuse sui preventivi inviati!">
                                      <?=$PercentualePrenotazioni?>% prenotazioni sui preventivi inviati
                                </span>
                              </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                          </div>
                      </div>
                      <div class="grid-stack-item" data-gs-x="6" data-gs-y="0" data-gs-width="2" data-gs-height="2">
                          <div class="grid-stack-item-content">
                            <div class="info-box bg-red radius6 animated zoomIn del1">
                              <span class="info-box-icon"><i class="fa fa-minus-circle"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">Prenotazioni</span>
                                <span class="info-box-number text12 lineheight25">Disdette <?=tot_disdetta()?> - Archiviate <?=tot_preno_archiviate()?></span>
                                <div class="progress">
                                  <div class="progress-bar" style="width: <?=$PercentualePrenotazioniDisdette?>%"></div>
                                </div>
                                <span class="progress-description" data-toogle="tooltip" title="<?=$PercentualePrenotazioniDisdette?>% delle prenotazioni disdette sulle prenotazioni chiuse!">
                                <?=$PercentualePrenotazioniDisdette?>% prenotazioni disdette su chiuse
                                </span>
                              </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                          </div>
                      </div>
                      <div class="grid-stack-item" data-gs-x="8" data-gs-y="0" data-gs-width="2" data-gs-height="2">
                          <div class="grid-stack-item-content">
                            <div class="info-box bg-maroon radius6 animated zoomIn del5">
                              <span class="info-box-icon"><i class="fa fa-calculator"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">Tasso di conversione</span>
                                <span class="info-box-number"><?=$TassoConversione?></span>
                                <div class="progress">
                                  <div class="progress-bar" style="width: <?=$TassoConversione?>%"></div>
                                </div>
                                <span class="progress-description" data-toogle="tooltip" title="<?=$TassoConversione?>% Tasso di Conversione">
                                <?=$TassoConversione?>% Tasso di Conversione
                                </span>
                              </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                          </div>
                      </div>
                      <div class="grid-stack-item" data-gs-x="10" data-gs-y="0" data-gs-width="2" data-gs-height="2">
                          <div class="grid-stack-item-content">
                            <div class="info-box bg-fuchsia radius6 animated zoomIn del6">
                              <span class="info-box-icon"><i class="fa fa-euro"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">Fatturato</span>
                                <span class="info-box-number"><?=tot_fatturato()?></span>
                                <div class="progress  bg-fuchsia">
                                  <div class="progress-bar"></div>
                                </div>
                                <span class="progress-description" data-toogle="tooltip" title="<?=tot_fatturato()?> Fatturato Prenotazioni Chiuse">
                                  Fatturato Prenotazioni Chiuse
                                </span>
                              </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                          </div>
                      </div>
                      <div class="grid-stack-item" data-gs-x="0" data-gs-y="2" data-gs-width="12" data-gs-height="6">
                          <div class="grid-stack-item-content">
                            <div class="row row-eq-height" id="infobox1">
                              <div class="col-md-2 col-sm-12 col-xs-12">
                                <div class="box radius6 col-eq-height animated zoomIn">
                                      <div class="box-header">
                                        <div class="pull-right box-tools">
                                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                        </div>
                                        <h5 class="box-title">Prenotazioni da</h5>
                                      </div>
                                      <div class="box-body">
                                          <?=prenotazioni_device()?>
                                      </div>
                                </div>
                              </div>
                              <div class="col-md-2 col-sm-12 col-xs-12">
                                <div class="box radius6 col-eq-height animated zoomIn">
                                      <div class="box-header">
                                        <div class="pull-right box-tools">
                                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                        </div>
                                        <h5 class="box-title">Prenotazioni con</h5>
                                      </div>
                                      <div class="box-body">
                                          <?=fatturato_template()?>
                                      </div>
                                </div>
                              </div>
                              <div class="col-md-2 col-sm-12 col-xs-12">
                                <div class="box radius6 col-eq-height animated zoomIn">
                                      <div class="box-header">
                                        <div class="pull-right box-tools">
                                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                        </div>
                                        <h5 class="box-title">Prenotazioni per</h5>
                                      </div>
                                      <div class="box-body">
                                            <?=prenotazioni_fonte()?>
                                      </div>
                                </div>
                              </div>
                              <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="box radius6 col-eq-height animated zoomIn" id="heigh_eq">
                                      <div class="box-header">
                                        <div class="pull-right box-tools">
                                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                        </div>
                                        <h5 class="box-title">Performance per Camera</h5>
                                      </div>
                                      <div class="box-body" id="performance_room" >
                                        <?=prenotazioni_per_camera()?>
                                      </div>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                    <?}?>
                      <div class="grid-stack-item" data-gs-x="0" data-gs-y="8" data-gs-width="12" data-gs-height="4">
                          <div class="grid-stack-item-content">
                            <div class="row row-eq-height" id="infobox2">
                            <div class="col-md-6 col-sm-6 col-xs-12 ">
                                <div class="box radius6 col-eq-height animated zoomIn">
                                      <div class="box-header">
                                        <div class="pull-right box-tools">
                                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                        </div>
                                        <h5 class="box-title">LeadTime Prenotazioni &nbsp;<i class="fa fa-hourglass-end"></i></h5>
                                      </div>
                                      <div class="box-body">
                                            <?=leadtime_prenotazioni()?>
                                      </div>
                                </div>
                              </div>
                              <div class="col-md-6 col-sm-6 col-xs-12 ">
                                <div class="box radius6 col-eq-height animated zoomIn">
                                      <div class="box-header">
                                        <div class="pull-right box-tools">
                                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                        </div>
                                        <h5 class="box-title">Prenotazioni post UpSelling</h5>
                                      </div>
                                      <div class="box-body">
                                      <small>Fatturato delle Prenotazioni Confermate, solo dopo l'invio di una e-mail di UpSelling e solo se la relativa prenotazione viene modificata!</small>
                                      <?=fatturato_post_upselling()?>
                                      </div>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>


                      <div class="grid-stack-item" data-gs-x="0" data-gs-y="12" data-gs-width="12" data-gs-height="4">
                          <div class="grid-stack-item-content">
                            <div class="row row-eq-height">
                              <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="box radius6 col-eq-height">
                                    <div class="box-header">
                                        <div class="pull-right box-tools">
                                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                        </div>
                                        <i class="fa fa-h-square text-aqua"></i>
                                        <h3 class="box-title">
                                          <div class="inline">
                                            Arrivi di <?=$arrivi_eichetta?>
                                            <form method="post" class="float-right-10">
                                              <input type="hidden" name="ggg" value="dinamica">
                                              <button class="btn <?=($_REQUEST['date_fl']!=''?'btn-info':'')?> btn-xs" type="submit" style="float:right!important">Filtra</button>
                                              <input type="text" id="DataFiltro" autocomplete="off"  class="date-picker form-control h-w-input h-w-input-mozilla" name="date_fl" value="<?=($_REQUEST['date_fl']==''?($_REQUEST['date_arr']!=''?$_REQUEST['date_arr']:''):$_REQUEST['date_fl'])?>">
                                          <script>
                                              $(document).ready(function() {
                                                  $("#DataFiltro").datepicker({
                                                      numberOfMonths: 1,
                                                      language:"it",
                                                      showButtonPanel: true
                                                  })
                                              })
                                          </script>
                                            </form>
                                            <form method="post" class="float-right-10">
                                            <button class="btn <?=($_REQUEST['date_arr']==$data_giorni1_view?'btn-warning':'btn-success')?> btn-xs" type="submit">Domani</button>
                                            <input type="hidden" name="ggg" value="domani">
                                            <input type="hidden" name="date_arr" value="<?=$data_giorni1_view?>">
                                            </form>
                                            <form method="post" class="float-right-10">
                                            <button class="btn <?=($_REQUEST['date_arr']== date('d/m/Y')?'btn-danger':'btn-success')?> btn-xs" type="submit">Oggi</button>
                                            <input type="hidden" name="ggg" value="oggi"><input type="hidden" name="date_arr" value="<?=date('d/m/Y')?>">
                                            </form>

                                          </div>
                                        </h3>
                                    </div>
                                    <div class="box-body no-padding">
                                        <div class="table-responsive">
                                            <?=$arrivi?>
                                        </div>
                                    </div>
                                    <!--<div class="box-footer"></div>-->
                                </div>
                              </div>
                              <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="box radius6 col-eq-height">
                                    <div class="box-header">
                                        <div class="pull-right box-tools">
                                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                        </div>
                                        <i class="fa fa-users text-red"></i>
                                        <h3 class="box-title">
                                          <div class="inline">
                                          Operatori
                                              <form method="post" class="float-right-10">
                                                <select  name="querydate" class="form-control h-input-medio" onchange="submit()">
                                                  <?=$lista_anni?>
                                                </select>
                                              </form>
                                          </div>
                                        </h3>
                                    </div>
                                    <div class="box-body no-padding">
                                        <div class="table-responsive">
                                            <?=$op?>
                                        </div>
                                    </div>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                      <div class="grid-stack-item" data-gs-x="0" data-gs-y="12" data-gs-width="12" data-gs-height="12">
                          <div class="grid-stack-item-content">
                            <div class="box radius6">
                                <div class="box-header with-border">
                                  <h3 class="box-title" style="width:100%!important">
                                    <div class="row">
                                      <div class="col-md-3">
                                        <div class="inline">
                                          Andamento delle Richieste del
                                            <form method="post" class="float-right-10">
                                              <select  name="querydate" class="form-control h-input-medio" onchange="submit()">
                                                <?=$lista_anni?>
                                              </select>
                                            </form>
                                          </div>
                                        </div>
                                        <div class="col-md-2 text-left">oppure filtra per</div>
                                        <div class="col-md-3">
                                          <div class="inline">
                                            <form name="relation_requestdate" id="relation_requestdate" method="POST" action="<?=$_SERVER['REQUEST_URI']?>" class="inline-flex">
                                                  <input placeholder="Richieste Dal" type="text" id="DataRichiesta_dal" autocomplete="off"  class="date-picker form-control h-medio" name="DataRichiesta_dal" value="<?=$_REQUEST['DataRichiesta_dal']?>">
                                                  &nbsp;&nbsp;-&nbsp;&nbsp;<input  placeholder="Richieste Al"  type="text" id="DataRichiesta_al" autocomplete="off"  class="date-picker form-control h-medio" name="DataRichiesta_al" value="<?=$_REQUEST['DataRichiesta_al']?>">
                                                  <input type="hidden" name="action" value="request_date">
                                                  &nbsp;&nbsp;<button class="btn btn-success btn-xs" type="submit">Filtra</button>
                                            </form>
                                          </div>
                                        </div>
                                      </div>
                                  </h3>
                                  <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                  </div>
                                </div>
                                <div class="box-body">
                                  <div class="chart">
                                      <div id="bar-chart" style="width:100%; height:400px;"></div>
                                  </div>
                                </div><!-- /.box-body -->
                              </div>
                          </div>
                      </div>
                    <?if($permessi['DASH']==1){?>
                      <div class="grid-stack-item" data-gs-x="0" data-gs-y="14" data-gs-width="12" data-gs-height="10">
                          <div class="grid-stack-item-content">
                            <div class="box radius6">
                                <div class="box-header with-border">
                                  <h3 class="box-title">
                                    <div class="row">
                                        <div class="col-md-6">
                                          <div class="inline">
                                            Fatturato prenotazioni confermate del
                                              <form method="post" class="float-right-10">
                                                <select  name="querydate" class="form-control h-input-medio" onchange="submit()">
                                                  <?=$lista_anni?>
                                                </select>
                                              </form>
                                            </div>
                                          </div>
                                          <div class="col-md-3 text-left">oppure filtra per</div>
                                          <div class="col-md-3">
                                            <div class="inline">
                                              <form name="relation_requestdate" id="relation_requestdate" method="POST" action="<?=$_SERVER['REQUEST_URI']?>" class="inline-flex">
                                                    <input placeholder="Arrivi" type="text" id="DataPrenotazione_dal_preno_f" autocomplete="off"  class="date-picker form-control h-medio" name="DataPrenotazione_dal_preno" value="<?=$_REQUEST['DataPrenotazione_dal_preno']?>">
                                                    &nbsp;&nbsp;e&nbsp;&nbsp;<input  placeholder="Partenze"  type="text" id="DataPrenotazione_al_preno_f" autocomplete="off"  class="date-picker form-control h-medio" name="DataPrenotazione_al_preno" value="<?=$_REQUEST['DataPrenotazione_al_preno']?>">
                                                    <input type="hidden" name="action" value="request_date_p">
                                                    &nbsp;&nbsp;<button class="btn btn-success btn-xs" type="submit">Filtra</button>
                                              </form>
                                            </div>
                                          </div>
                                        </div>
                                  </h3>
                                  <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                  </div>
                                </div>
                                <div class="box-body">
                                  <div class="chart">
                                  <div id="main" style="width:100%; height:550px;"></div>
                                  </div>
                                </div><!-- /.box-body -->
                              </div>
                          </div>
                      </div>
                    <?}?>
                  </div>

                <?=$js_grafici?>
            </section><!-- /.content -->
          </div><!-- /.content-wrapper -->
          <?=$js?>
    <?php include_module('footer.inc.php'); ?>
