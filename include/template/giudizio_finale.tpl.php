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
                                                            <div class="col-md-5 text-right">
                                                                <label>
                                                                    Periodo
                                                                </label>
                                                            <i class="fa fa-question-circle" data-toggle="tooltip" title="Richiedere i risultati filtrandoli per anno!"></i>
                                                        </div>
                                                            <div class="col-md-2 text-center">                   
                                                                <form method="post">
                                                                    <select name="querydate" class="form-control h-input-medio" onchange="submit()">
                                                                    <?=$lista_anni?>
                                                                    </select>
                                                                </form>
                                                            </div>
                                                            <div class="col-md-5"></div>                                                             
                                                        </div> 
                                                        <div class="clearfix p-b-30"></div>
                                                    
                                                        <?php if(sizeof($record)>0){?>

                                                                <div class="row">
                                                                <div class="col-md-1"></div>
                                                                    <div class="col-md-10 text-center">
                                                                        <div class="chart">
                                                                            <div id="graph" style="width:100%; height:400px;"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?=$js_grafico?>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-block">
                                                                <div class="card-header">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <h2 id="bordato"> 
                                                                                <span id="etichetta" style="font-size:22px!important">Valutazioni medie per Ospite</span>
                                                                            </h2>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div style="float:right">
                                                                                <button class="btn btn-primary btn-sm" id="closeButtonBoxInfo">
                                                                                    Nascondi legenda <i class="fa fa-times" data-toggle="tooltip" title="Nascondi"></i>
                                                                                </button> 
                                                                                <button class="btn btn-primary btn-sm" id="openButtonBoxInfo">
                                                                                    Visualizza legenda <i class="fa fa-angle-double-down" data-toggle="tooltip" title="Visualizza"></i>
                                                                                </button> 
                                                                            </div> 
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="alert alert-profila  alert-default-profila alert-dismissable text-black text-center" id="legenda"  style="display:none">
                                                                Il cambio colore dell'icona busta è determinato solo dall'invio manuale dell'email che viene esercitato cliccando sulla busta di colore blu.
                                                                <br>
                                                                Nulla interagisce con gli invii automatici delle recensioni sia a punteggio che per filtro temporale, i quali hanno la loro icona di notifica (<i class="fa fa-tripadvisor"></i>) nell'area "Prenotazioni"!
                                                                <div style="clear:both;height:20px"></div>
                                                                <h5>
                                                                LEGENDA:    <img src="<?=BASE_URL_SITO?>img/emoji/bad.png" style="width:20px;height:20px" data-toogle="tooltip" title="Bad [valore = 1]">(1)
                                                                            <img src="<?=BASE_URL_SITO?>img/emoji/semi_bad.png" style="width:20px;height:20px" data-toogle="tooltip" title="Semi Bad  [valore = 2]">(2)
                                                                            <img src="<?=BASE_URL_SITO?>img/emoji/medium.png" style="width:20px;height:20px" data-toogle="tooltip" title="Medium  [valore = 3]">(3)
                                                                            <img src="<?=BASE_URL_SITO?>img/emoji/semi_good.png" style="width:20px;height:20px" data-toogle="tooltip" title="Semi Good  [valore = 4]">(4)
                                                                            <img src="<?=BASE_URL_SITO?>img/emoji/good.png" style="width:20px;height:20px" data-toogle="tooltip" title="Good  [valore = 5]">(5)

                                                                </h5>
                                                        </div>     
                                                        <script>
                                                            $(document).ready(function(){
                                                                $("#closeButtonBoxInfo").hide();
                                                                $("#closeButtonBoxInfo").on("click",function(){
                                                                        $("#closeButtonBoxInfo").hide();
                                                                        $("#openButtonBoxInfo").show();
                                                                        $("#legenda").hide(300);                           
                                                                });
                                                                $("#openButtonBoxInfo").on("click",function(){
                                                                        $("#openButtonBoxInfo").hide();
                                                                        $("#closeButtonBoxInfo").show();
                                                                        $("#legenda").show(300);                           
                                                                }); 
                                                            })
                                                        </script> 
                                                    <div class="clearfix p-t-30 p-b-30"></div>
                                                    <?=$tabella;?>
                                                    <? include_module('backtop.inc.php'); ?> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<?=$js_date?> 
<?php 
  if(check_configurazioni(IDSITO,'check_notifiche_push')==1){
    echo $notifiche_js;
  }
?>
    <!-- /.content -->
    <? include_module('footer.inc.php'); ?>