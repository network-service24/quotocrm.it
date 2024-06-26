<?php include_module('header.inc.php') ?>
<link href="<?=BASE_URL_SITO?>css/bootstrap-social.min.css" rel="stylesheet">
<link href="<?=BASE_URL_SITO?>css/ekko-lightbox.min.css" rel="stylesheet">
<link href="<?=BASE_URL_SITO?>css/dark.min.css" rel="stylesheet">
<script src="<?=BASE_URL_SITO?>js/ekko-lightbox.min.js"></script>
<script src="<?=BASE_URL_SITO?>js/responsiveslides.min.js"></script>
<link href="<?=BASE_URL_SITO?>css/responsiveslides.min.css" rel="stylesheet" />
<link href="<?=BASE_URL_SITO?>css/<?=$FoglioStile?>" rel="stylesheet">
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCEhD0s4UEJdItPacNMZNLE_aoyLYGAHL8"></script>
<?=$js_script?>
<?=$init_map?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
<?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
          <!-- Main content -->
          <section class="content">
          <!-- general form elements -->
          <div class="box radius6">

                  <div class="box-body" >

                  <h2 class="page-header">
                    <div class="row">
                    <div class="col-md-2 text-right">
                          <?=$PulsanteIndietro?>
                      </div>
                      <div class="col-md-10 text-left">
                          <i class="fa fa-windows"></i> Anteprima Landing page <b>Default</b> di Preventivo e/o Conferma <small style="font-size:50%">(FAC SIMILE, NON IMPUTABILE)</small> 
                      </div>
                    </div>
                  </h2>
              <? if(!$_REQUEST['azione']){ ?>
                  <div class="row">
                    <div class="col-md-1"></div>
                      <div class="col-md-10">
                        <div class="alert alert-dismissable cassetto-info">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <!-- Cambio di stile -->
                            <form name="change_stile" method="post" action="<?=$_SERVER['REQUEST_URI']?>">
                               <div class="row">
                               <div class="col-md-2"></div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label>Scegli lo stile colori per le <span class="text-orange">e-mail</span> e la <span class="text-orange">landing page</span> del tuo QUOTO!</label>
                                      <select class="form-control" name="fogliostile">
                                        <option value="hospitality-item.min.css" <?=($FoglioStile =='hospitality-item.min.css'?'selected="selected"':'')?>>Scala colori di default</option>
                                        <option value="hospitality-item-mare.min.css" <?=($FoglioStile =='hospitality-item-mare.min.css'?'selected="selected"':'')?>>Scala colori più freddi</option>
                                        <option value="hospitality-item-montagna.min.css" <?=($FoglioStile =='hospitality-item-montagna.min.css'?'selected="selected"':'')?>>Scala colori  più caldi</option>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                        <input type="hidden" name="action" value="modif_stile">
                                        <input type="hidden" name="temp" value="<?=$_REQUEST['temp']?>" />
                                        <input type="hidden" name="id_stile" value="<?=$IdStile?>">
                                        <button type="submit" class="btn btn-success" style="margin-top:25px">Salva</button>
                                  </div>
                                  <div class="col-md-2"></div>
                               </div>
                             </form>
                        </div>
                      </div>
                    <div class="col-md-1"></div>
                  </div>
                  <div class="clear"></div>
                <!-- Fine cambio di stile -->
              <?}?>
                <!-- Page Content -->
             <!-- Se esiste almeno una richiesta inserita si vede l'anteprima -->
           <?php if($tot > 0){?>
               <div class="container animated zoomIn ">
                    <div class="col-md-3"><p class="lead"><?=($Logo ==''?'<i class="fa fa-bed fa-5x fa-fw"></i>':'<img src="'.BASE_URL_SUITEWEB.'uploads/loghi_siti/'.$Logo.'" />')?></p></div>
                    <div class="col-md-9">
                        <div id="contenuto">
                            <div class="thumbnail">
                               <?=$TopImage?>
                               <br>
                               <div class="caption-full">
                                  <?php if($TipoRichiesta=='Conferma' && $Chiuso == 0){?>
                                  <?if($AccontoRichiesta != 0 || $AccontoLibero != 0 || $AccontoPercentuale != 0 || $AccontoImporto != 0) {?>
                                       <div class="thumbnail caption" id="carta" <?=$stile?>>
                                          <div class="row">
                                            <div class="col-md-12">
                                                <div class="caption-full">
                                                <h1><?=ucfirst($Nome)?> <?=ucfirst($Cognome)?>
                                                <small> <i class="fa fa-long-arrow-right fa-sx"></i> <?=OFFERTA?> nr. <?=$NumeroPrenotazione?> <?=DEL?> <?=$DataRichiesta?> </small></h1>

                                                <?if($AccontoRichiesta != 0 || $AccontoLibero != 0 || $AccontoPercentuale != 0 || $AccontoImporto != 0) {?>
                                                    <h3><?=SCADENZA_OFFERTA?> <span class="text-red"><?=$DataScadenza?></span></h3>
                                                <?}else{?>
                                                    <h3><?=SCADENZA?> <?=OFFERTA?> <span class="text-red"><?=$DataScadenza?></span></h3>
                                                <?}?>

                                                  <?
                                                    if($ordinamento_pagamenti){
                                                      foreach ($ordinamento_pagamenti as $chiave_pagamenti => $valore_pagamenti) {
                                                        echo $valore_pagamenti;
                                                      }
                                                    }
                                                  ?>
                                                </div>
                                             </div>
                                          </div>
                                        </div>
                                   <?}?>      <!-- FORM CARTA -->
                                  <?}?>


                                  <div class="row">
                                      <div class="col-md-9">
                                        <h1>
                                          <em>
                                             <?=($TipoRichiesta == 'Preventivo'?IL_SUO.' '.PREVENTIVO:CONFERMA)?> <?=DA?>  <?=$NomeCliente?> <br>
                                            <small class="small_dark"><?=OFFERTA?> nr. <?=$NumeroPrenotazione?> <?=DEL?> <?=$DataRichiesta?> <small>&nbsp;&nbsp;<?=SCADENZA?> <span class="text-red"><?=$DataScadenza?></span></small></small>
                                          </em>
                                        </h1>
                                      </div>
                                      <div class="col-md-2" id="allineamento">
                                          <div><small><b><?=CREATA_DA?></b><br><em><?=($disable==false?$Operatore:'')?></em></small></div>
                                      </div>
                                      <div class="col-md-1">
                                          <div><?=($ImgOp==''?'<img src="'.BASE_URL_SITO.'img/receptionists.png" style="width:50px;height:50px" class="img-circle">':'<img src="'.BASE_URL_SITO.'uploads/'.IDSITO.'/'.$ImgOp.'" style="width:50px;height:50px" class="img-circle">')?></div>
                                      </div>
                                  </div>

                                          <? if($TipoRichiesta == 'Preventivo'){
                                            if($Testo != ''){
                                              echo'<div class="row">
                                                    <div class="col-md-12">
                                                      <div class="caption">';
                                                    echo $Testo;
                                                    echo'</div>
                                                </div>
                                              </div>';
                                            }
                                          }else{
                                            if($TestoConferma != ''){
                                              echo'<div class="row">
                                                    <div class="col-md-12">
                                                      <div class="caption">';
                                                    echo $TestoConferma;
                                                    echo'</div>
                                                </div>
                                              </div>';
                                            }
                                          }
                                            ?>

                                 <br>
                               <div class="row">
                                <div class="col-md-6">
                                <div class="alert alert-success alert-dismissable">
                                  <div class="row">
                                      <div class="col-md-4">
                                         <div align="center" > <i class="fa fa-calendar fa-5x color_calendar"></i> </div>
                                      </div>
                                      <div class="col-md-8">
                                        <div align="center" class="blu-text-head"><h3><?=DATA_ARRIVO?></h3><h2><?=$DataArrivo?></h2></div>
                                      </div>
                                  </div>
                                </div>
                                </div>
                                <div class="col-md-6">
                                <div class="alert alert-success alert-dismissable">
                                  <div class="row">
                                        <div class="col-md-4">
                                            <div align="center" > <i class="fa fa-calendar fa-5x color_calendar"></i> </div>
                                        </div>
                                        <div class="col-md-8">
                                          <div align="center" class="blu-text-head"><h3><?=DATA_PARTENZA?></h3><h2><?=$DataPartenza?></h2></div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12"><?=$proposta?></div>
                              </div>
                              <?=$infohotel?>
                                 <?=$Eventi?>
                                    <div class="row" id="b_map" style="display:none">
                                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                          <a name="start_map"></a>
                                          <div><i id="close" class="fa fa-times-circle-o fa-2x" aria-hidden="true" style="cursor:pointer !important"></a></i></div>
                                          <iframe id="frame_lp"  src="<?=BASE_URL_SITO?>include/controller/gmap.php" frameborder="0" width="100%" height="334px"></iframe>
                                      </div>
                                   </div>
                                 <script>
                                  $("#close").click(function(){
                                          $("#b_map").css("display","none");
                                      });
                                  </script>

                                 <?=$PuntidiInteresse?>
                                    <div class="row" id="b_map_pdi" style="display:none">
                                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                          <a name="start_map_pdi"></a>
                                          <div><i id="close_pdi" class="fa fa-times-circle-o fa-2x" aria-hidden="true" style="cursor:pointer !important"></a></i></div>
                                          <iframe id="frame_lp_pdi"  src="<?=BASE_URL_SITO?>include/controller/gmap.php" frameborder="0" width="100%" height="334px"></iframe>
                                      </div>
                                   </div>
                                 <script>
                                  $("#close_pdi").click(function(){
                                          $("#b_map_pdi").css("display","none");
                                      });
                                  </script>
                                <?=$carosello?>
                                <?=$Mappa?>
                                <?=$condizioni_generali?>
                            </div>


                            <div class="row">
                              <div class="col-md-12">
                                <h3><?=ANCORA_DOMANDE?></h3>
                                <button href="#" class="btn btn-warning"><i class="fa fa-comments-o fa-2x"></i> <?=SCRIVICI_SE_HAI_BISOGNO?></button>
                                 <br><br>
                                  <div class="row">
                                      <div class="col-lg-8 col-md-8">
                                       <b class="red-text"><?=$NomeCliente?></b><br> <?=$Indirizzo?> <?=$Localita?> - <?=$Cap?> (<?=$Provincia?>) - <?=$SitoWeb?>
                                      </div>
                                        <div class="col-md-4 text-right">
                                             <?=$Tripadvisor?>
                                             <?=$Facebook?>
                                             <?=$Twitter?>
                                             <?=$GooglePlus?>
                                             <?=$Instagram?>
                                             <?=$Linkedin?>
                                             <?=$Pinterest?>
                                        </div>
                                  </div>
                                <hr class="line_white">
                              <div class="right copyright"><small>Powered By QUOTO! - <a href="http://www.network-service.it">Network Service s.r.l.</a> <span id="licenza">&copy;</span> <?=date('Y')?></small> </div>
                              </div>
                            </div>

                    </div>
              </div>
            </div>
           <?}else{?>
              Per visualizzare un'anteprima della Landing page inserire almeno una richiesta!
          <?}?>
        </div>
      </div>
    </section>
</div>
<?php include_module('footer.inc.php'); ?>
