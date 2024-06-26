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
                                                <div style="float:right">
                                                        <button class="btn btn-primary btn-sm" id="closeButtonBoxInfo">
                                                            Nascondi legenda <i class="fa fa-times" data-toggle="tooltip" title="Nascondi"></i>
                                                        </button> 
                                                        <button class="btn btn-primary btn-sm" id="openButtonBoxInfo">
                                                            Visualizza legenda <i class="fa fa-angle-double-down" data-toggle="tooltip" title="Visualizza"></i>
                                                        </button> 
                                                    </div>
                                                    <div class="clearfix p-b-10"></div>
                                                    <div id="legenda" class="alert alert-info text-black text-center"  style="display:none">
                                                        <div class="lineheight10">
                                                           <p> 
                                                                Attenzione a cancellare gli operatori creati in precedenza, perchè se l'operatore avesse già effettuato qualche preventivo, salterebbe la sua associazione!
                                                                <br>
                                                                Sarebbe più consigliabile disabilitare l'operatore senza così eliminarlo!
                                                                <br>
                                                                Se modificate il nome dell'operatore durante attività inoltrata di QUOTO!, le associazioni fatte per operatore sui preventivi, in trattativa e prenotazioni salteranno e dovranno essere ri-associate!
                                                                <br>
                                                                Questa operazione se necessaria sarebbe meglio eseguirla ad inizio stagione oppure alla fine della stagione lavorativa!
                                                            </p>
                                                        </div>
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
                                                    <?=$content;?>   
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