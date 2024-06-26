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
                                            <div class="card-header">
                                                <h5>Gestione Tipologia Soggiorni</h5>                                              
                                            </div>
                                                <div class="card-block">
                                                    <div style="float:right">
                                                        <button class="btn btn-primary btn-sm" id="closeButtonBoxInfo">
                                                            Chiudi legenda e sincronizzazioni attive <i class="fa fa-times" data-toggle="tooltip" title="Chiudi sincronizzazioni attive"></i>
                                                        </button> 
                                                        <button class="btn btn-primary btn-sm" id="openButtonBoxInfo">
                                                            Visualizza legenda e sincronizzazioni attive <i class="fa fa-angle-double-down" data-toggle="tooltip" title="Visualizza sincronizzazioni attive"></i>
                                                        </button> 
                                                    </div>
                                            
                                                        <div class="clearfix p-b-10"></div>
                                                            <div class="alert alert-info text-black" id="legenda"  style="display:none">
                                                                <?=$msg?>
                                                                <?=$FormMsg?>
                                                                <? if($fun->check_ericsoftbooking(IDSITO) == 1){?>
                                                                    <p class="text-right"><a href="<?=BASE_URL_SITO?>update_syncro_eb/sg/" class="btn bg-light-blue btn-sm" id="resynchBtn">Re-Synch</a><br>Sincronizza/Ri-sincronizza i tipi di soggiorno se hai aggiunto una o più tipologie nuove su Ericsoft Booking!</p>
                                                                <?}?>
                                                                <? if($fun->check_bedzzlebooking(IDSITO) == 1){?>
                                                                    <p class="text-right"><a href="<?=BASE_URL_SITO?>update_syncro_bedzzle/sg/" class="btn btn-danger btn-sm" id="resynchBtn">Re-Synch</a><br>Sincronizza/Ri-sincronizza i tipi di soggiorno se hai aggiunto una o più tipologie nuove su Bedzzle Booking/PMS!</p>
                                                                <?}?>
                                                                <? if($fun->check_simplebooking(IDSITO) == 1){?>
                                                                    <p class="text-right"><a href="<?=BASE_URL_SITO?>update_syncro_sb/sg/" class="btn bg-purple btn-sm" id="resynchBtn">Re-Synch</a><br>Ri-sincronizza i tipi di soggiorno se hai aggiunto una o più tipologie nuove su SimpleBooking!</p>
                                                                    <?php   if(IS_NETWORK_SERVICE_USER==1){
                                                                                echo'<p class="text-right"><i class="fa fa-exclamation-triangle text-orange"></i> Solo l\'operatore Network Service vede il pulsante per eliminare le tipologie di soggiorno sincronizzate, se dovesse essere neccessario re-sincronizzare da SimpleBooking:<br>per esempio se i nomi delle tipologie sono stati modificati, disabilitare i soggiorni interessati, re-sincronizzare e successivamente eliminare i soggiorni vecchi!</p>';
                                                                            }
                                                                    ?>
                                                                <?}?>
                                                                <?=$SyncroMsg?>
                                                                <?=$legenda?>
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
                                                    <?php   echo $content; ?>
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
