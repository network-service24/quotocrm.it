<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<?=$js_eq?>

<div class="content-wrapper">
<?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <!-- Main content -->
    <div class="content" <?=(CHECKINONLINE==1?'style="opacity:0.2;"':'')?>>
            <?=$script_modale;?>
            <?=$modale;?>

                  <?if($permessi['DASH']==1){?>
                      <form id="statistiche" name="statistiche" method="post">
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
                          <div class="col-md-4 col-sm-4 col-xs-12">
                            <div style="float:left;margin-top:40px;"><a href="javascript:;" id="attiva_legenda2" data-toogle="tooltip" title="Clicca per leggere!" class="h4">Help <i class="fa fa-life-ring text-info" aria-hidden="true"></i></a></div>  
                            <div class="clearfix"></div>
                          </div>
                      </form>
                          <?=$js_filtro?>

                          <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="box radius6">
                                  <div class="box-header">
                                    <div class="row">
                                      <div class="col-md-3">
                                      <i class="fa fa-bar-chart"></i>
                                    </div>
                                    <div class="col-md-6 text-center">
                                    <h5 class="box-title" style="cursor:pointer;" data-toogle="tooltip" data-html="true" title="Il previsionale delle <br>Conferme in Trattativa<br> entrerà in statistica solo dopo la chiusura in <br><b>Prenotazioni Confermate</b>">Previsioni in entrata <i class="fa fa-life-ring text-info" aria-hidden="true"></i></h5>
                                  </div>
                                      <div class="col-md-3">
                                        <div class="pull-right box-tools">
                                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="box-body">
                                    <div class="row">
                                      <?php if(tot_fatturato_buoni_voucher()!=false){?>
                                          <div class="col-md-3" style="font-weight:bold;font-size:13px">
                                            <p>Buoni Voucher</p><div style="cursor:pointer;z-index:9;position:absolute;top:0;left:95%;width:100%"><i class="fa fa-question-circle text-orange" aria-hidden="true" data-toogle="tooltip" title="Il valore in euro è il presunto fatturato derivato dai Buoni Voucher che siano solamente stati emessi, o che siano in conferme in trattativa o già ri-confermati in prenotazioni!"></i></div>
                                            <i class="fa fa-euro"></i> <?=tot_fatturato_buoni_voucher()?> <?=numero_buoni_voucher()?>
                                          </div>
                                          <div class="col-md-1" style="height:50px;border-right:1px #000 solid">&nbsp;</div>
                                        <?}?>
                                        <div class="col-md-<?=(tot_fatturato_buoni_voucher()!=false?'3':'5')?>" style="font-weight:bold;font-size:<?=(tot_fatturato_buoni_voucher()!=false?'12px':'16px')?>">
                                          <p>Preventivi generati</p><div style="cursor:pointer;z-index:9;position:absolute;top:0;left:95%;width:100%"><i class="fa fa-question-circle text-info" aria-hidden="true" data-toogle="tooltip" title="Somma totale dei preventivi inviati. Nel caso di più proposte all'interno dello stesso preventivo, è stata presa la media matematica delle proposte presenti."></i></div>
                                          <i class="fa fa-euro"></i> <?=tot_fatturato_prev()?>
                                        </div>
                                        <div class="col-md-1" style="height:50px;border-right:1px #000 solid">&nbsp;</div>
                                        <div class="col-md-<?=(tot_fatturato_buoni_voucher()!=false?'4':'6')?>" style="font-weight:bold;font-size:<?=(tot_fatturato_buoni_voucher()!=false?'13px':'16px')?>">
                                          <p>Conferme in Trattativa</p>
                                          <i class="fa fa-euro"></i> <?=tot_fatturato_conf()?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>
                     
                      <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="alert alert-profila  alert-default-profila alert-dismissable text-black" id="legenda2"  style="display:none">
                          <p>E' possibile filtrare i risultati degli Info-Box per query già pre-impostate (oggi, domani, ecc) oppure è possibile settare un range di date!
                          Le richieste cestinate non alterano i risultati statitici, ma interagisco solo se eliminate definitivamente!</p>  
                          <p>Il numero dei preventivi inseriti ed inviati, cosi come il numero delle prenotazioni confermate, comprende anche i preventivi e le prenotazioni archiviate!</p>                          
                          <p>Potrebbero esserci delle sottili differenze tra gli infoBox ed i grafici statistici dedicati; questo perchè gli InfoBox sono frutto dei risultati ottenuti interamente ed esclusivamente da QUOTO!, invece i risultati statistici grafici dedicati variano negli anni interagendo, nei primi anni con tabelle di tracciabilità ADS e succesivmanete dal 2021 interagendo con Analytics!</p>
                          </div>
                          <script>
                           $(document).ready(function(){
                             $("#attiva_legenda2").on("click",function(){
                               $("#legenda2").slideToggle("slow");
                             })
                           })
                         </script>
                        </div>
                      </div>
                      <br>
                      <div class="row">

                        <div class="col-md-2 col-sm-6 col-xs-12">
                          <div class="info-box bg-green radius6 animated zoomIn del2">
                          <span class="info-box-icon"><i class="fa fa-envelope"></i></span>
                           <div class="info-box-content">
                             <span class="info-box-text">Preventivi</span>
                              <span class="info-box-number text12 lineheight25" style="white-space:nowrap!important">Inseriti <?=tot_preventivi()?> - Inviati <?=tot_invii()?></span>
                              <div class="progress">
                                <div class="progress-bar" style="width: <?=$PercentualePrevInviati?>%"></div>
                              </div>
                              <span class="progress-description" data-toogle="tooltip" title="<?=$PercentualePrevInviati?>% di preventivi inviati sui preventivi inseriti!">
                                    <?=$PercentualePrevInviati?>% inviati sugli inseriti
                              </span>
                            </div>
                          </div>
                        </div><!-- /.col -->


                        <!-- fix for small devices only -->
                        <div class="clearfix visible-sm-block"></div>

                        <div class="col-md-2 col-sm-6 col-xs-12">
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
                        </div><!-- /.col -->


                        <div class="col-md-2 col-sm-6 col-xs-12">
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
                        </div><!-- /.col -->


                        <div class="col-md-2 col-sm-6 col-xs-12">
                          <div class="info-box bg-red radius6 animated zoomIn del1">
                            <span class="info-box-icon"><i class="fa fa-minus-circle"></i></span>
                            <div class="info-box-content">
                              <span class="info-box-text">Prenotazioni</span>
                              <span class="info-box-number text12 "><span data-toogle="tooltip" title="Disdette">Disd.<?=tot_disdetta()?></span> - <span data-toogle="tooltip" title="Annullate">Annul.<?=tot_annullate()?></span> - <span data-toogle="tooltip" title="Archiviate">Arch.<?=tot_preno_archiviate()?></span></span>
                            <?php
                                  $euro_disdette = tot_fatturato_disdette();
                                  $euro_annullate = tot_fatturato_annullate();
                              ?>
                              <?=($PercentualePrenotazioniDisdette != '' || $PercentualePrenotazioniDisdette != 0 ? '<small style="font-size:12px!important">'.$euro_disdette.' € disdette '.$PercentualePrenotazioniDisdette.'%</small>' : '' )?>
                              <div class="claer:both;"></div>
                              <?=($PercentualeAnnullate != '' || $PercentualeAnnullate != 0 ? '<small style="font-size:12px!important">'.$euro_annullate.' € annul. '.$PercentualeAnnullate.'%</small>' : '' )?>
                              </span>
                            </div><!-- /.info-box-content -->
                          </div><!-- /.info-box -->
                        </div><!-- /.col -->

                        <div class="col-md-2 col-sm-6 col-xs-12">
                          <div class="info-box bg-maroon radius6 animated zoomIn del5">
                            <span class="info-box-icon"><i class="fa fa-calculator"></i></span>
                            <div class="info-box-content">
                              <span class="info-box-text">Tasso di conversione</span>
                              <span class="info-box-number"><?=$TassoConversione?></span>
                              <div class="progress">
                                <div class="progress-bar" style="width: <?=$TassoConversione?>"></div>
                              </div>
                              <span class="progress-description" data-toogle="tooltip" title="<?=$TassoConversione?> Tasso di Conversione">
                              <?=$TassoConversione?> Tasso di Conversione
                              </span>
                            </div><!-- /.info-box-content -->
                          </div><!-- /.info-box -->
                        </div><!-- /.col -->

                        <div class="col-md-2 col-sm-6 col-xs-12">
                          <div class="info-box bg-fuchsia radius6 animated zoomIn del6">
                            <span class="info-box-icon"><i class="fa fa-euro"></i></span>
                            <div class="info-box-content">
                              <span class="info-box-text">Fatturato</span>
                              <span class="info-box-number"><?=tot_fatturato()?></span>
                              <div class="progress  bg-fuchsia">
                                <div class="progress-bar"></div>
                              </div>
                              <span class="progress-description" data-toogle="tooltip" title="<?=tot_fatturato()?> Fatturato generato da QUOTO!">
                                Fatturato QUOTO!
                              </span>
                            </div><!-- /.info-box-content -->
                          </div><!-- /.info-box -->
                        </div><!-- /.col -->

                      </div><!-- /.row -->
                    <?}?>
                      <div class="clearfix"></div>
                      <?php echo ckeck_notify_chat_modal(IDSITO)?>
                      <div class="row row-eq-height" id="infobox1">
                      <div class="col-md-4 col-sm-4 col-xs-12">
                          <div class="box radius6 col-eq-height animated zoomIn">
                                <div class="box-header">
                                  <div class="pull-right box-tools">
                                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                      <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                  </div>
                                  <h5 class="box-title">Chat in attesa di risposta!</h5> <?= count_notify_chat(IDSITO)?>
                                </div>
                                <div class="box-body" id="chat_pending" style="min-height:300px;max-height:400px;">
                                  <div id="load_chat_notify_pre"></div>
                                  <div id="load_chat_notify"></div>
                                  <?=$js_chat?>
                                </div>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <div class="row row-eq-height">
                          <div class="box radius6 col-eq-height animated zoomIn">
                                  <div class="box-header">
                                    <div class="pull-right box-tools">
                                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                    <h5 class="box-title">
                                      Proposte bloccate in fase di modifica!
                                      <small style="padding-left:10px">
                                        <a href="javascript:;" id="attiva_legenda_info_blocco" data-toogle="tooltip" data-html="true" title="<div class='text-left'>
                                              Se si ha un solo operatore attivo in QUOTO, 
                                              la lista delle proposte bloccate è dovuta solo perchè l'operatore ha cliccato dentro la modifica della proposta senza salvarla,
                                              ma in questo caso non si esercita un vero e proprio blocco, volendo potete anche ignorare questo box di avviso!
                                          </div>">
                                          Info <i class="fa fa-life-ring text-info"></i>
                                        </a>
                                      </small>
                                    </h5> 
                                  </div>
                                  <div class="box-body" id="proposte_block" style="min-height:300px;max-height:400px;">
                                      <div id="load_check_modifica_pre"></div>
                                      <div id="load_check_modifica"></div>
                                      <?=$js_modifica?>
                                  </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                       
                          <div class="box radius6 col-eq-height animated zoomIn" id="heigh_eq">
                                <div class="box-header">
                                  <div class="pull-right box-tools">
                                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                      <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                  </div>
                                  <h5 class="box-title">Performance per Camera  <small style="padding-left:50px"><a href="javascript:;" id="attiva_legenda_info1" data-toogle="tooltip" data-html="true" title="<div class='text-left'>
                                    Il fatturato della performace per camera è calcolato solo sul <b>Prezzo Camera</b> e <b>non comprende</b> i Servizi Aggiuntivi od ulteriori importi che compongono la somma del soggiorno della conferma e/o prenotazione!<br /> 
                                    Di fatto questo determina una discrepanza con il box informativo sopra riportato del <b>Totale Fatturato</b><br />
                                    Inoltre se sono state vendute camere successivamente <b>disattivate</b> , il totale del fatturato di tutte le camere sotto elencate, sarà sicuramente diverso dal <b>Totale Fatturato</b> citato dall'info box dedicato!</div>">Help <i class="fa fa-life-ring text-info"></i></a></small></h5>
                                  <? if($_REQUEST['date']!= ''){?>
                                    <br><small>Questo risultato è l'unico che non tiene in considerazione il filtro applicato in alto a sinistra, ma visualizza sempre il risultato complessivo dell'anno <?='<b class="text-red">'.date('Y').'</b>'?>!</small>
                                  <?}?>
                                  <br>

                                  
                                </div>
                                <?if(!in_array(IDSITO,MODULI_INDEX)){?>   
                                  <? echo $ajax_leadtime_and_performance?>
                                  <div class="box-body" id="performance_room" >
                                      <div class="text-center">  <div id="preno_camera_pre"></div></div>
                                        <div id="prenotazioni_camera"></div>
                                  </div>
                                <?}else{?>
                                  <div class="box-body" id="performance_room" >
                                      <div class="text-center text-gray"> Modulo Performance per Camera disabilitate da Network Service!</div>                                       
                                  </div>
                                <?}?>
                          </div>
                      
                        </div>

                      </div>
                  <?if(!in_array(IDSITO,MODULI_INDEX)){?>           
                      <div class="clearfix"></div>
                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12 ">
                          <div class="box radius6 col-eq-height animated zoomIn">
                                <div class="box-header">
                                  <div class="pull-right box-tools">
                                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                      <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                  </div>
                                  <h5 class="box-title">LeadTime Prenotazioni &nbsp;<i class="fa fa-hourglass-end"></i></h5>
                                </div>
                                <div class="box-body">
                                    <div class="text-center">  <div id="leadtime_pre"></div></div>
                                      <div id="leadtime"></div>
                                </div>
                          </div>
                        </div>
                      </div>
                    <?}?>
                    <?if(!in_array(IDSITO,MODULI_INDEX)){?>
                      <div class="clearfix"></div>
                      <div class="row row-eq-height" id="infobox2">
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="box radius6 col-eq-height animated zoomIn">
                                <div class="box-header">
                                  <div class="pull-right box-tools">
                                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                      <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                  </div>
                                  <h5 class="box-title">Prenotazioni da <i class="fa fa-question text-info" data-placement="right" data-toggle="tooltip" data-html="true" title="<div class=text-left>Il fatturato delle prenotazioni per provenienza di device è calcolato solo sulle <b>Prenotazioni Confermate</b> e <b>non comprende</b> quelle in Conferma in Trattativa!</div>"></i></h5>
                                </div>
                                <div class="box-body">
                                    <?=prenotazioni_device()?>
                                </div>
                          </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="box radius6 col-eq-height animated zoomIn">
                                <div class="box-header">
                                  <div class="pull-right box-tools">
                                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                      <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                  </div>
                                  <h5 class="box-title">Prenotazioni con <i class="fa fa-question text-info" data-placement="right" data-toggle="tooltip" data-html="true" title="<div class=text-left>Il fatturato delle prenotazioni con tipologia di template usato è calcolato solo sulle <b>Prenotazioni Confermate</b> e <b>non comprende</b> quelle in Conferma in Trattativa!</div>"></i></h5>
                                </div>
                                <div class="box-body">
                                    <?=fatturato_template()?>
                                </div>
                          </div>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12 ">
                        <div class="box radius6 col-eq-height animated zoomIn">
                                <div class="box-header">
                                  <div class="pull-right box-tools">
                                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                      <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                  </div>
                                  <h5 class="box-title">Prenotazioni per <i class="fa fa-question text-info" data-placement="right" data-toggle="tooltip" data-html="true" title="<div class=text-left>Il fatturato delle prenotazioni per fonte è calcolato solo sulle <b>Prenotazioni Confermate</b> e <b>non comprende</b> quelle in Conferma in Trattativa!</div>"></i></h5>
                                </div>
                                <div class="box-body">
                                      <?=prenotazioni_fonte()?>
                                </div>
                          </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                          <div class="box radius6 col-eq-height animated zoomIn" style="min-height:120px!important;">
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
                    <?}?>
                    
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
                                            });
                                        });
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
                      <?if(!in_array(IDSITO,MODULI_INDEX)){?>                   
                      <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
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
                                        <!--<div class="col-md-3 text-left"><oppure filtra per</div>-->
                                        <div class="col-md-6"><small>per filtri avanzati, usare l'area dedicata! (Statistiche QUOTO!)</small>
                                        <div class="inline">
                                          <!--<form name="relation_requestdate" id="relation_requestdate" method="POST" action="<?=$_SERVER['REQUEST_URI']?>" class="inline-flex">
                                                <input placeholder="Richieste Dal" type="text" id="DataRichiesta_dal" autocomplete="off"  class="date-picker form-control h-medio" name="DataRichiesta_dal" value="<?=$_REQUEST['DataRichiesta_dal']?>">
                                                &nbsp;&nbsp;-&nbsp;&nbsp;<input  placeholder="Richieste Al"  type="text" id="DataRichiesta_al" autocomplete="off"  class="date-picker form-control h-medio" name="DataRichiesta_al" value="<?=$_REQUEST['DataRichiesta_al']?>">
                                                <input type="hidden" name="action" value="request_date">
                                                &nbsp;&nbsp;<button class="btn btn-success btn-xs" type="submit">Filtra</button>
                                          </form>-->
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
                      <?}?>

                </div>
          <?if(!in_array(IDSITO,MODULI_INDEX)){?>   
            <?=$js_grafici?>
          <?}?>
            </section><!-- /.content -->
          </div><!-- /.content-wrapper -->
        <?=$js?>
            <?php if(CHECKINONLINE==1){?>
              <div class="modal fade" id="info-checkinonline"  role="dialog" aria-labelledby="myinfo-checkinonline">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">CRM QUOTO! by Network Service</h4>
                  </div>
                  <div class="modal-body">
                    <p>Il CRM QUOTO!, è abilitato solo per l'uso del <b>modulo di Check-in OnLine</b>!</p>
                    <p>Il Modulo di Check-in OnLine rimarrà attivo fino al <b>31/10/2020</b>!</p>
                    <p>Se desiderate maggiori informazioni in merito all'uso e/o all'acquisto del CRM completo,
                    potete contattare il responsabile assistenza del software</p>
                    <p><i class="fa fa-envelope text-green"></i>&nbsp; &nbsp;<a href="mailto:<?=MAIL_ASSISTENZA?>?subject=Richiesta informazioni in merito al CRM QUOTO!" class="text-green"><?=MAIL_ASSISTENZA?></a></p>
                    <p><b>Cosa posso fare con il modulo di Check-in OnLine?</b></p>
                    <p>Le voci di menù operative abilitate del CRM QUOTO! sono:
                      <ul>
                        <li>Configurazioni -> Config.Accessi <br><small class="text-green">Per la personalizzazione del tuo operatore</small>
                        <ul>
                            <li>Operatori</li>
                            <li>Gestione Permessi</li>
                          </ul>
                      </li>
                        <li>Configurazioni -> Config.Autoresponder -> Check-in Online Email<br><small class="text-green">Per la configurazione dell'invio automatico dell'email</small></li>
                        <li>Check-in Online <br><small class="text-green">Per la gestione di tutto il modulo</small>
                          <ul>
                            <li>Aggiungi prenotazione</li>
                            <li>Prenotazioni da fonti esterne</li>
                            <li>P.S.Schedine Alloggiati</li>
                            <li>Gestione Box Info Check-in</li>
                          </ul>
                        </li>
                      </ul>
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <script>
              $(document).ready(function(){
                $("#info-checkinonline"). modal('show');
              })
            </script>
        <?}?>

      <?php 
          if(check_configurazioni(IDSITO,'check_notifiche_push')==1){
            echo (n_checkin(1)>0?'<script>
                      $( document ).ready(function() {
                          $("body").one("mouseover",function(){
                              open_notifica("Ciao <b>'.NOMEHOTEL.'</b> oggi sono stati compilati <b class=\"text16\">'.n_checkin(1).'</b>  checkin online"," ","plain","bottom-right","warning",5000,"#ff6849");
                          });
                      });
                  </script>':'')."\r\n";
          }
      ?>

<?php include_module('footer.inc.php'); ?>
