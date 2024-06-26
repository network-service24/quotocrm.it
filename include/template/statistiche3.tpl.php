<? include_module('header.inc.php'); ?>

<? include_module('navbar.inc.php'); ?>

<? include_module('sidebar.inc.php'); ?>


<div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                <? include_module('breadcrumb.inc.php'); ?>
                                    <div class="page-body">
                                      <div class="text-center"><h3> ATTENZIONE: la raccolta dati di Analytics Universal si è conclusa il 30 giugno 2023</h3></div>
                                    <div class="card">
                                                <div class="card-block">
                                                            <div class="row">
                                                                <div class="col-md-1"></div>
                                                                <div class="col-md-3 text-right"> <label><b> Data Conferma o Data Prenotazione </b></label></div>
                                                                <div class="col-md-4">
                                                            

                                                                        <form name="relation_requestdate" class="form-inline" id="relation_requestdate" method="POST" action="<?=$_SERVER['REQUEST_URI']?>">
                                                                        
                                                                                <input type="date" placeholder="Dal" id="DataRichiesta_dal" autocomplete="off"  class="form-control m-r-10" name="DataRichiesta_dal" value="<?=$_REQUEST['DataRichiesta_dal']?>" data-date-end-date="-1d">
                                                        
                                                                                <input type="date" placeholder="Al"  id="DataRichiesta_al" autocomplete="off"  class="form-control m-r-10" name="DataRichiesta_al" value="<?=$_REQUEST['DataRichiesta_al']?>" data-date-end-date="-1d">
                                                                
                                                                                <input type="hidden" name="action" value="request_date">
                                                                                <button id="pul_search_date" class="btn btn-success btn-sm m-l-30" type="button">Filtra</button>
                                                                            
                                                                        </form>
                                                                        <script>
                                                                            $(document).ready(function(){
                                                                                $("#pul_search_date").on("click",function(){
                                                                                    var dal = $("#DataRichiesta_dal").val();
                                                                                    var dal_ = dal.split("/");

                                                                                        $("#relation_requestdate").attr('action','<?=BASE_URL_SITO?>grafici-statistiche3/')
                                                                                        $("#relation_requestdate").submit();
                                                                                
                                                                                })
                                                                            })
                                                                        </script>
                                                                    
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
                                            
                                                                                            $("#filter_year").attr('action','<?=BASE_URL_SITO?>grafici-statistiche3/')
                                                                                            $("#filter_year").submit();
                                                                                        
                                                                                    })
                                                                                    })
                                                                                </script>
                                                                            </form>
                                                                        </small>
                                                                    </div>
                                                                </div>

                                                        <div class="clearfix p-b-20"></div>
                                                        <div id="view_loading_statistiche"></div>
                                                        <div class="clearfix p-b-20"></div>
                                                          <div class="row">
                                                              <div class="<?=($split_graph == true?'col-md-6 col-sm-6 col-xs-6':'col-md-12 col-sm-12 col-xs-12')?> text-center">
                                                              <?
                                                                if($_REQUEST['action']=='check_date'){
                                                                    echo '<b>DAL</b><br>';
                                                                    echo ($_REQUEST['DataArrivo_dal']!=''?'<b>Arrivi</b> '.gira_data($_REQUEST['DataArrivo_dal']):'').' '.($_REQUEST['DataPartenza_dal']!=''?' <b>Partenze</b> '.gira_data($_REQUEST['DataPartenza_dal']):'');
                                                                }
                                                                if($_REQUEST['action']=='check_year'){
                                                                  echo (strlen($_REQUEST['querydate'])>1?'<b>Anno</b> '.$_REQUEST['querydate']:'<b>Ultimo Mese</b>');
                                                                }
                                                                if($_REQUEST['action']=='request_date'){
                                                                  echo ($_REQUEST['DataRichiesta_dal']!=''?'<b>Data Prenotazione Dal</b> '.gira_data($_REQUEST['DataRichiesta_dal']):'').' '.($_REQUEST['DataRichiesta_al']!=''?' <b>Data Prenotazione Al</b> '.gira_data($_REQUEST['DataRichiesta_al']):'');
                                                                }
                                                              ?>

                                                              </div>
                                                              <div class="col-md-6 col-sm-6 col-xs-6 text-center" <?=($split_graph == true?'':'style="display:none"')?>>
                                                              <?
                                                                if($_REQUEST['action']=='check_date'){
                                                                  echo '<b>AL</b><br>';
                                                                  echo ($_REQUEST['DataArrivo_al']!=''?'<b>Arrivi</b> '.gira_data($_REQUEST['DataArrivo_al']):'').' '.($_REQUEST['DataPartenza_al']!=''?' <b>Partenze</b> '.gira_data($_REQUEST['DataPartenza_al']):'');
                                                                }
                                                              ?>
                                                              </div>
                                                          </div>
                                                          <?=($_REQUEST['action']=='check_date'?'<br>':'')?>
                                                          <div class="clearfix p-b-20"></div>
                                                          <div class="row">
                                                              <div class="<?=($split_graph == true?'col-md-6 col-sm-6 col-xs-6':'col-md-12 col-sm-12 col-xs-12')?>">

                                                                      <? if($tot >0){?>
                                                                        <?if($array_fatturato>0){?>
                                                                          <div class="row">
                                                                          <div class="col-md-12 col-sm-12 col-xs-12">
                                                                            <div class="box no-radius">
                                                                                <div class="box-header with-border">
                                                                                  <h3 class="box-title" style="width:100%!important">Fatturato per <b>fonti di prenotazione</b> </h3>
                                                                                </div>
                                                                                <div class="clearfix p-b-20"></div>
                                                                                <div class="box-body" style="height: 100%; margin: 0">
                                                                                <div class="row">
                                                                                  <div class="col-md-4">

                                                                                      <?=$legenda?>

                                                                                      <div class="clearfix" style="padding-top:30px">&nbsp;</div>
                                                                                      <?=$legendaD?>

                                                                                  </div>
                                                                                  <div class="col-md-7 text-center">
                                                                                   
                                                                                    <div id="pieChart" style="width:100%; height:550px"></div>
                                                                                  </div>
                                                                                </div>
                                                                                  <div class="col-md-1 text-center"></div>
                                                                                </div><!-- /.box-body -->
                                                                                <div class="box-footer">
                                                                               
                                                                                </div>
                                                                              </div>
                                                                          </div>
                                                                        </div>
                                                                      <?}?>
                                                                    <?}?>
                                                                    <?if(!empty($array_fatturatoS) || !is_null($array_fatturatoS)){?>
                                                                          <div class="clearfix p-b-20"></div>
                                                                              <div class="box no-radius">
                                                                                <div class="box-header with-border">
                                                                                  <h3 class="box-title">Dettaglio <b>fatturato</b> per fonte: <b>Sito Web</b> e <b>Landing Page</b> </h3>
                                                                                </div>
                                                                                <div class="clearfix p-b-20"></div>
                                                                                <div class="box-body">
                                                                                  <div class="row">
                                                                                    <div class="col-md-4">
                                                                                        <?=$legendaS?>
                                                                                    </div>
                                                                                    <div class="col-md-7 text-center">
                                                                                     
                                                                                      <div id="pieChart2" style="width:100%; height:550px"></div>
                                                                                    </div>
                                                                                    <div class="col-md-1 text-center"></div>
                                                                                  </div>
                                                                                </div>
                                                                                <div class="box-footer">
                                                                              
                                                                                </div>
                                                                              </div> 

                                                                    <?}?>
                                                                      <? if($totTARGET >0){?>
                                                                        <?if($array_fatturatoTARGET>0){?>
                                                                        <div class="clearfix p-b-20"></div>
                                                                          <!-- DONUT CHART -->
                                                                          <div class="box no-radius">
                                                                            <div class="box-header with-border">
                                                                              <h3 class="box-title">Fatturato per <b>Target Clienti</b> </h3>
                                                                            </div>
                                                                            <div class="clearfix p-b-20"></div>
                                                                            <div class="box-body">
                                                                                <div class="row">
                                                                                    <div class="col-md-4">
                                                                                     
                                                                                        <?=$legendaT?>
                                                                                    </div>
                                                                                    <div class="col-md-7 text-center">
                                                                                     
                                                                                      <div id="pieChart4" style="width:100%; height:550px"></div>
                                                                                    </div>
                                                                                    <div class="col-md-1 text-center"></div>
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
                                                                        <div class="clearfix p-b-20"></div>
                                                                          <!-- DONUT CHART -->
                                                                          <div class="box no-radius">
                                                                            <div class="box-header with-border">
                                                                              <h3 class="box-title">Fatturato per <b>Operatori</b></h3>
                                                                            </div>
                                                                            <div class="clearfix p-b-20"></div>
                                                                            <div class="box-body">
                                                                                <div class="row">
                                                                                    <div class="col-md-4">
                                                                                      
                                                                                        <?=$legendaOP?>
                                                                                    </div>
                                                                                    <div class="col-md-7 text-center">
                                                                                     
                                                                                      <div id="pieChart3" style="width:100%; height:550px"></div>
                                                                                    </div>
                                                                                    <div class="col-md-1 text-center"></div>
                                                                                  </div>
                                                                            </div>
                                                                            <div class="box-footer">
                                                                            
                                                                            </div>
                                                                          </div>
                                                                          <!-- /.box -->
                                                                      <?}?>
                                                                    <?}?>

                                                                    <? if($totTemplate >0){?>
                                                                        <?if($array_fatturatoTemplate>0){?>
                                                                        <div class="clearfix p-b-20"></div>
                                                                          <!-- DONUT CHART -->
                                                                          <div class="box no-radius">
                                                                            <div class="box-header with-border">
                                                                              <h3 class="box-title">Fatturato per <b>Template Landing Page</b></h3>
                                                                            </div>
                                                                            <div class="clearfix p-b-20"></div>
                                                                            <div class="box-body">
                                                                                <div class="row">
                                                                                    <div class="col-md-4">
                                                                                       
                                                                                        <?=$legendaTP?>
                                                                                    </div>
                                                                                    <div class="col-md-7 text-center">
                                                                                      
                                                                                      <div id="pieChart5" style="width:100%; height:550px"></div>
                                                                                    </div>
                                                                                    <div class="col-md-1 text-center"></div>
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
                                                                        <div class="clearfix p-b-20"></div>
                                                                          <div class="row">
                                                                          <div class="col-md-12 col-sm-12 col-xs-12">
                                                                            <div class="box no-radius">
                                                                                <div class="box-header with-border">
                                                                                  <h3 class="box-title" style="width:100%!important">Fatturato per <b>fonti di prenotazione</b> </h3>
                                                                                </div>
                                                                                <div class="clearfix p-b-20"></div>
                                                                                <div class="box-body" style="height: 100%; margin: 0">
                                                                                <div class="row">
                                                                                  <div class="col-md-4">
                                                                                    
                                                                                      <?=$legenda2?>
                                                                                  </div>
                                                                                  <div class="col-md-7 text-center">
                                                                                   
                                                                                    <div id="pieChart_bis" style="width:100%; height:550px"></div>
                                                                                  </div>
                                                                                  <div class="col-md-1 text-center"></div>
                                                                                </div>

                                                                                </div><!-- /.box-body -->
                                                                                <div class="box-footer">
                                                                                 
                                                                                </div>
                                                                              </div>
                                                                          </div>
                                                                        </div>
                                                                      <?}?>
                                                                    <?}?>
                                                                    <?if(!empty($array_fatturatoS2) || !is_null($array_fatturatoS2)){?>
                                                                          <div class="clearfix p-b-20"></div>
                                                                              <div class="box no-radius">
                                                                                <div class="box-header with-border">
                                                                                  <h3 class="box-title"><b>Dettaglio</b> del fatturato: fonte di prenotazione <b>Sito Web</b> </h3>
                                                                                  <div class="clearfix p-b-20"></div>
                                                                                  <div class="box-tools pull-right">
                                                                                </div>
                                                                                <div class="box-body">
                                                                                  <div class="row">
                                                                                    <div class="col-md-4">
                                                                                        
                                                                                        <?=$legendaS2?>
                                                                                    </div>
                                                                                    <div class="col-md-7 text-center">
                                                                                      
                                                                                      <div id="pieChart2_bis" style="width:100%; height:550px"></div>
                                                                                    </div>
                                                                                    <div class="col-md-1 text-center"></div>
                                                                                  </div>
                                                                                </div>
                                                                                <div class="box-footer">
                                                                               
                                                                                </div>
                                                                              </div>

                                                                    <?}?>
                                                                      <? if($totTARGET2 >0){?>
                                                                        <?if($array_fatturatoTARGET2>0){?>
                                                                        <div class="clearfix p-b-20"></div>
                                                                          <!-- DONUT CHART -->
                                                                          <div class="box no-radius">
                                                                            <div class="box-header with-border">
                                                                              <h3 class="box-title">Fatturato per <b>Target Clienti</b> </h3>
                                                                            </div>
                          
                                                                            <div class="clearfix p-b-20"></div>
                                                                            <div class="box-body">
                                                                                <div class="row">
                                                                                    <div class="col-md-4">
                                                                                        
                                                                                        <?=$legendaT2?>
                                                                                    </div>
                                                                                    <div class="col-md-7 text-center">
                                                                                     
                                                                                      <div id="pieChart4_bis" style="width:100%; height:550px"></div>
                                                                                    </div>
                                                                                    <div class="col-md-1 text-center"></div>
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
                                                                        <div class="clearfix p-b-20"></div>
                                                                          <!-- DONUT CHART -->
                                                                          <div class="box no-radius">
                                                                            <div class="box-header with-border">
                                                                              <h3 class="box-title">Fatturato per <b>Operatori</b></h3>
                                                                            </div>
                                                                            <div class="clearfix p-b-20"></div>
                                                                            <div class="box-body">
                                                                                <div class="row">
                                                                                    <div class="col-md-4">
                                                                                        
                                                                                        <?=$legendaOP2?>
                                                                                    </div>
                                                                                    <div class="col-md-7 text-center">
                                                                                     
                                                                                      <div id="pieChart3_bis" style="width:100%; height:550px"></div>
                                                                                    </div>
                                                                                    <div class="col-md-1 text-center"></div>
                                                                                  </div>
                                                                            </div>
                                                                            <div class="box-footer">
                                                                             
                                                                            </div>
                                                                          </div>
                                                                          <!-- /.box -->
                                                                      <?}?>
                                                                    <?}?>

                                                                    <? if($totTemplate2 >0){?>
                                                                        <?if($array_fatturatoTemplate2>0){?>
                                                                        <div class="clearfix p-b-20"></div>
                                                                          <!-- DONUT CHART -->
                                                                          <div class="box no-radius">
                                                                            <div class="box-header with-border">
                                                                              <h3 class="box-title">Fatturato per <b>Template Landing Page</b></h3>
                                                                            </div>
                                                                            <div class="clearfix p-b-20"></div>
                                                                            <div class="box-body">
                                                                                <div class="row">
                                                                                    <div class="col-md-4">
                                                                                       
                                                                                        <?=$legendaTP2?>
                                                                                    </div>
                                                                                    <div class="col-md-7 text-center">
                                                                                    
                                                                                      <div id="pieChart5_bis" style="width:100%; height:550px"></div>
                                                                                    </div>
                                                                                    <div class="col-md-1 text-center"></div>
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