<? include_module('header.inc.php'); ?>

<? include_module('navbar.inc.php'); ?>

<? include_module('sidebar.inc.php'); ?>


<div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                <? include_module('breadcrumb.inc.php'); ?>
                                    <div class="page-body">
                                                     <div class="card">
                                                        <div class="card-block">
                                                            <div class="row">
                                                                <div class="col-md-2  text-right"> <label><b> Conferme </b> <br><small>solo sul fatturato</small></label></div>
                                                                <div class="col-md-6 text-center">
                                                            

                                                                        <form name="relation_requestdate" class="form-inline" id="relation_requestdate" method="POST" action="<?=$_SERVER['REQUEST_URI']?>">
                                                                        
                                                                                <input type="date" placeholder="Dal" id="DataRichiesta_dal" autocomplete="off"  class="form-control m-r-10" name="DataRichiesta_dal" value="<?=$_REQUEST['DataRichiesta_dal']?>" data-date-end-date="-1d">
                                                        
                                                                                <input type="date" placeholder="Al"  id="DataRichiesta_al" autocomplete="off"  class="form-control m-r-10" name="DataRichiesta_al" value="<?=$_REQUEST['DataRichiesta_al']?>" data-date-end-date="-1d">
                                                                
                                                                                <input type="hidden" name="action" value="request_date">
                                                                                <button id="pul_search_date" class="btn btn-success btn-sm m-l-30" type="submit">Filtra</button>
                                                                            
                                                                        </form>

                                                                    
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
                                                                            </form>
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div id="view_loading_statistiche"></div>
                                                        <?=$js_load?>
                                <div id="fatturatoN" class="card">
                                    <div class="card-block">

                                    <div class="text-center" style="width:100%!important"><b>Metodo raccolta dati tramite Tracking Ads</b></div>
                                        <h5 class="box-title" style="width:100%!important">Totale <b>Fatturato Google Ads</b> <img src="<?=BASE_URL_SITO?>img/gads.png" style="width:32px;height:32px"/><?=($totalePPCn>0?' <span>&#10230;</span> <span class="text-success" style="font-size: 30px;"><i class="fa fa-euro"></i> '.number_format($totalePPCn,2,',','.').'</span>':'')?></h5>  
                                              <div class="box-body">
                                                  <div class="row m-t-10">
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
                                                  </div>
                                                  <?php if($messagen){?>
                                                      <div class="row  m-t-10">
                                                          <div class="col-md-12 col-sm-12 col-xs-12 text-center text-warning">
                                                            <?=$messagen?>
                                                          </div>
                                                      </div>
                                                  <?}?>
                                                  <div class="row  m-t-10">
                                                      <div class="col-md-12 col-sm-12 col-xs-12">                               
                                                        <h5 class="box-title">Fonte di prenotazione <b>Google Ads</b></h5>
                                                          <div class="box-body">                             
                                                            <div class="row m-t-10">
                                                              <div class="col-md-1"></div>  
                                                              <div class="col-md-10">                                    
                                                                  <?=$legendaSn_BOX?>
                                                              </div>
                                                              <div class="col-md-1"></div> 
                                                            </div>
                                                            <div class="row m-t-10">
                                                              <div class="col-md-1"></div>  
                                                              <div class="col-md-10 text-center">
                                                                <div id="pieChartNew" style="width:100%; height:550px"></div>
                                                              </div>
                                                              <div class="col-md-1"></div>  
                                                            </div>
                                                          </div>
                                                    </div>
                                                    <?=$js_script_grafici?>
                                                    <? include_module('backtop.inc.php'); ?> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

    <!-- /.content -->
    <? include_module('footer.inc.php'); ?>