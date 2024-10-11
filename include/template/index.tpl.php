<? include_module('header.inc.php'); ?>

<? include_module('navbar.inc.php'); ?>

<? include_module('sidebar.inc.php'); ?>

<?php include(BASE_PATH_SITO.'js/index.inc.js.php');?>   

<div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                <? include_module('breadcrumb.inc.php'); ?>
                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-md-3 text-center">
                                                <form id="statistiche" name="statistiche" method="post" action="<?=$_SERVER['REQUEST_URI']?>">
                                                    <div class="form-group">
                                                        <div class="input-group  input-group-primary">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-filter"></i>
                                                            </div>
                                                            <input placeholder="Imposta una query di ricerca" class="form-control" id="demo" name="date" type="text" autocomplete="off"> 
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-md-9 text-left"> <!-- <span class="f-11 text-gray">Se il filtro data non è impostato, di default la query filtrerà i dati per l'anno in corso: <?=date('Y');?></span> --></div>
                                        </div>   
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="card">
                                                <div class="card-block"> 
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <h4 class="text-primary f-w-600"><?=$fun->tot_preventivi()?> <small class="f-11"> - inviati <?=$fun->tot_invii()?></small></h4>
                                                                <h6 class="text-muted m-b-0">Preventivi <i class="fa fa-question-circle text-primary cursore" data-toggle="tooltip" title="Totale dei preventivi inseriti: sono inclusi anche quelli non più visibili sotto la voce Preventivi perchè trasformati in trattative!" aria-hidden="true"></i> <?=$iconaSegno?></h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <i class="ti-layout-media-right-alt f-28"></i>
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="card-footer bg-c-blue">
                                                    <div class="row align-items-center">
                                                        <div class="col-9">
                                                            <p class="text-white m-b-0 f-11 nowrap"><?=$PercentualePreventiviConfronto;?></p>
                                                        </div>
                                                        <div class="col-3 text-right">
                                                            <i class="ti-layout text-white f-16"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                                                    
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card">
                                                <div class="card-block"> 
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <h4 class="text-primary f-w-600"><?=$fun->tot_conferme()?></h4>
                                                                <h6 class="text-muted m-b-0">...... in Trattativa <!-- <?=$iconaSegnoC?> --></h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <i class="fa fa-credit-card f-28"></i>
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="card-footer bg-c-blue">
                                                    <div class="row align-items-center">
                                                        <div class="col-9">
                                                            <!-- <p class="text-white m-b-0 f-11 nowrap"><?=$PercentualeTrattativeConfronto;?></p> -->
                                                        </div>
                                                        <div class="col-3 text-right">
                                                            <i class="ti-headphone-alt text-white f-16"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card">
                                                <div class="card-block"> 
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <h4 class="text-primary f-w-600"><?=$fun->tot_prenotazioni()?></h4>
                                                                <h6 class="text-muted m-b-0">Prenotazioni Confermate <?=$iconaSegnoP?></h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <i class="fa fa-h-square f-28"></i>
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="card-footer bg-c-blue">
                                                    <div class="row align-items-center">
                                                        <div class="col-9">
                                                            <p class="text-white m-b-0 f-11 nowrap"><?=$PercentualePrenotazioniConfronto;?></p>
                                                        </div>
                                                        <div class="col-3 text-right">
                                                            <i class="fa fa-bed text-white f-16"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                                      
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card">
                                                <div class="card-block"> 
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <h4 class="text-primary f-w-600"><?=$TassoConversione?></h4>
                                                                <h6 class="text-muted m-b-0">Tasso di Conversione <?=$segnoConversione?></h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <i class="fa fa-calculator f-28"></i>
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="card-footer bg-c-blue">
                                                    <div class="row align-items-center">
                                                        <div class="col-9">
                                                            <p class="text-white m-b-0 f-11 nowrap"><?=$ConversioniConfronto?></p>
                                                        </div>
                                                        <div class="col-3 text-right">
                                                            <i class="ti-pulse text-white f-16"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                                       
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="card">
                                                <div class="card-block"> 
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <h4 class="text-primary f-w-600">
                                                                    <div class="text-center">  
                                                                        <div id="leadtime_pre"></div>
                                                                    </div>
                                                                    <div id="leadtime"></div>
                                                                </h4>
                                                                <h6 class="text-muted m-b-0">Leadtime</h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <i class="fa fa-calendar f-28"></i>
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="card-footer bg-c-blue text-white">
                                                    <div class="row align-items-center">
                                                        <div class="col-10 nowrap">
                                                            <span class="f-11">Tempo medio da Preventivo a Conferma/Prenotazione</span>
                                                        </div>
                                                        <div class="col-2 text-right nowrap">
                                                            <i class="ti-pulse   text-white f-16"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                                                    
                                        </div>

                                        <div class="col-md-3">
                                            <div class="card">
                                                <div class="card-block"> 
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <h4 class="text-primary f-w-600">
                                                                    <div class="text-center">  
                                                                        <div id="bookingwindow_pre"></div>
                                                                    </div>
                                                                    <div id="bookingwindow"></div>
                                                                </h4>
                                                                <h6 class="text-muted m-b-0">Booking Window</h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <i class="fa fa-calendar f-28"></i>
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="card-footer bg-c-blue text-white">
                                                    <div class="row align-items-center">
                                                        <div class="col-9">
                                                            <span class="f-11">Tempo medio dalla Prenotazione al Check-In</span>
                                                        </div>
                                                        <div class="col-3 text-right nowrap">
                                                            <i class="ti-pulse  text-white f-16"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                                      
                                        </div>
                                       
                                        <?if($checkADR==1){?>
                                            <div class="col-md-3">
                                             <div class="card">
                                                <div class="card-block"> 
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <h4 class="text-primary f-w-600"><i class="fa fa-euro"></i> <?=number_format($fun->ADR(),2,',','.');?></h4>
                                                                <h6 class="text-muted m-b-0"><b>ADR su QUOTO!</b> <i class="fa fa-question-circle text-primary cursore" data-toggle="tooltip" data-html="true" title="<div class='text-left p-2'>Valore medio per notte che generano le camere vendute in un determinato periodo.</div><div class='text-center'>FORMULA:<br>fatturato camera <br><img src='/img/diviso.png'><br> notti vendute</div>"></i></h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <i class="fa fa-euro f-28"></i>
                                                            </div>
                                                        </div> 
                                                </div>
                                                <div class="card-footer bg-c-blue text-white">
                                                    <div class="row align-items-center">
                                                        <div class="col-9">
                                                            <span class="f-11">Valore medio su <?=$numeroGiorniADR?> gg.</span>
                                                        </div>
                                                        <div class="col-3 text-right nowrap">
                                                            <i class="ti-pulse   text-white f-16"></i>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div> 
                                            </div>
                                        <?}?>
                                 
                                        <div class="col-md-3">
                                        <div class="card">
                                                <div class="card-block"> 
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <h4 class="text-primary f-w-600"><i class="fa fa-euro"></i> <?=$fun->tot_fatturato()?></h4>
                                                                <h6 class="text-muted m-b-0">Fatturato <?=$iconaSegnoF?></h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <i class="fa fa-euro f-28"></i>
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="card-footer bg-c-blue text-white">
                                                    <div class="row align-items-center">
                                                        <div class="col-9">
                                                            <p class="text-white m-b-0 f-11 nowrap"><?=$PercentualeFatturatoConfronto?></p>
                                                        </div>
                                                        <div class="col-3 text-right nowrap">
                                                            <i class="ti-pulse text-white f-16"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      
                                        </div>
                                    
                                     <div class="row row-eq-height" id="rigaArrivi">
                                        <div class="col-md-6">
                                            <div class="card col-eq-height">
                                                <div class="card-header">       
                                                    <div class="row">
                                                        <div class="col-md-8"><h5>Proposte bloccate dall'operatore .... in fase di modifica!  </h5> </div>
                                                        <div class="col-md-4 text-right"><small><a href="javascript:;" id="SbloccaAll">Sblocca tutto! <i class="fa fa-chain-broken"></i></a></small></div>
                                                    </div>
                                                    <script>
                                                        $(document).ready(function(){
                                                            $("#SbloccaAll").on("click",function(){
                                                                if (window.confirm("ATTENZIONE: Sicuro di voler sbloccare tutto?")){
                                                                    $.ajax({
                                                                        url: "<?=BASE_URL_SITO?>ajax/generici/sblocca_all.php",
                                                                        type: "POST",
                                                                        data: "idsito=<?=IDSITO?>",
                                                                        dataType: "html",
                                                                        success: function(data) {
                                                                            location.reload();
                                                                        }
                                                                    });
                                                                    return false;
                                                                }
                                                            });
                                                        });
                                                    </script>    
                                                </div>
                                                <div class="card-block" id="proposte_block"> 
                                                    <?php echo $fun->ckeck_modifica(IDSITO)?>
                                                </div> 
                                                <div class="clearfix p-b-30"></div>  
                                            </div>  
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card col-eq-height">
                                                <div class="card-header">
                                                    <h5>Arrivi di ... </h5>   
                                                </div>
                                                <div class="card-block" style="max-height:400px!important" id="arrivi_block">
                                                    <div class="row">
                                                        <div class="col-md-1"></div>
                                                        <div class="col-md-4">
                                                            <form method="POST" id="form_arrivi" action="<?=BASE_URL_SITO?>dashboard-index/">
                                                                <input type="hidden" name="ggg" value="dinamica">    
                                                                <input type="date" id="DataFiltro" autocomplete="off"  class="form-control" name="date_fl" value="<?=($_REQUEST['date_fl']==''?($_REQUEST['date_arr']!=''?$_REQUEST['date_arr']:''):$_REQUEST['date_fl'])?>">
                                                            </form>                                                       
                                                        </div>
                                                        <div class="col-md-2"><button class="btn <?=($_REQUEST['date_fl']!=''?'btn-info':'btn-primary')?>" type="button" id="button_form_arrivi">Filtra</button></div>
                                                        <div class="col-md-2">
                                                            <form method="POST" action="<?=BASE_URL_SITO?>dashboard-index/">
                                                                <button class="btn <?=($_REQUEST['date_arr']==date('Y-m-').(date('d')+1)?'btn-info':'btn-primary')?>" type="submit">Domani</button>
                                                                <input type="hidden" name="ggg" value="domani">
                                                                <input type="hidden" name="date_arr" value="<?=date('Y-m-').(date('d')+1)?>">
                                                            </form>                                                        
                                                        </div>
                                                        <div class="col-md-2">
                                                            <form method="POST" action="<?=BASE_URL_SITO?>dashboard-index/">
                                                                <button class="btn <?=($_REQUEST['date_arr']== date('Y-m-d')?'btn-info':'btn-primary')?>" type="submit">Oggi</button>
                                                                <input type="hidden" name="ggg" value="oggi"><input type="hidden" name="date_arr" value="<?=date('Y-m-d')?>">
                                                            </form>                                                        
                                                        </div>
                                                        <div class="col-md-1"></div>
                                                    </div>
                                                    <script>
                                                        $(document).ready(function(){
                                                            $("#button_form_arrivi").on("click",function(){
                                                                $("#form_arrivi").submit();
                                                            })
                                                        })
                                                    </script>
                                                    <div class="clearfix p-b-20"></div> 
                                                    <?=$fun->arriviOggi(IDSITO);?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?if(!in_array(IDSITO,MODULI_INDEX)){?>   
                                        <div class="clearfix"></div>
                                        <div class="card">
                                            <div class="card-header">
                                                 <h5 style="width:100%!important">
                                                 <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="inline" style="width:100%!important">
                                                            Andamento delle Richieste per il&nbsp;&nbsp;
                                                            <form method="post" class="float-right-10">
                                                                <select  name="querydate" class="h-input-medio" onchange="submit()">
                                                                    <?=$lista_anni?>
                                                                </select> 
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                </h5>  

                                                <div class="card-block"> 
                                                    <div class="row">
                                                        <div class="col-md-1"></div>
                                                        <div class="col-md-9 text-center">
                                                            <div class="chart">
                                                                <div id="bar-chart" style="width:100%; height:400px;"></div>
                                                            </div>
                                                        </div>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      
                                        <? echo $JSGrafico?>
                                        <div class="clearfix"></div>
                                    <?}?>
                                    <? include_module('backtop.inc.php'); ?>        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
             
    <?=$modale;?>
    <?php //echo $modale_numPrev?>
 
    <!-- /.content -->
    <? include_module('footer.inc.php'); ?>