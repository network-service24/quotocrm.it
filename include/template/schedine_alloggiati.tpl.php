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
                                                        <h2> Gestione P.S. Schede Alloggiati per la Questura
                                                            <span>&#10230;</span> <small>P.S. compilate dai clienti</small></h2>
                                                            <div style="float:right">
                                                                <button class="btn btn-primary btn-sm" id="closeButtonBoxInfo">
                                                                    Chiudi legenda aiuti! <i class="fa fa-times" data-toggle="tooltip" title="Chiudi legenda aiuti!"></i>
                                                                </button> 
                                                                <button class="btn btn-primary btn-sm" id="openButtonBoxInfo">
                                                                    Visualizza legenda aiuti! <i class="fa fa-angle-double-down" data-toggle="tooltip" title="Visualizza legenda aiuti!"></i>
                                                                </button> 
                                                            </div>
                                                            <div class="clearfix p-b-10"></div>
                                                            <div class="alert alert-info text-black" id="legenda"  style="display:none"> 
                                                                    <p>
                                                                        Esite una remota possibilità che l'utente che si appresta a compilare il modulo di Check-In Online, 
                                                                        se debba impiegare del tempo per inserire magari 4 persone (<em>i componenti di tutto il soggiorno</em>), 
                                                                        potrebbe scoraggiarsi! <br>(<em>anche perchè di solito e norma questa operazione viene eseguita della reception</em>).<br>
                                                                        Quindi grazie al campo "<b>Esito Compilazione</b>", potete controllare se l'utente ha compilato correttamente tutto il modulo 
                                                                        ed entrando in modifica <b>terminare al suo posto l'operazione</b>.<br>
                                                                        Il nostro consiglio sta nell'invogliare gli ospiti a portare a termine la compilazione del Check-In, magari <b>con qualche piccolo incentivo</b>!<br>
                                                                        <b>ESEMPIO:</b><em> "Se compilate il Modulo di Check-In Online portando a termine tutta l'operazione, al vostro arrivo in Hotel avrete un aperitivo in Omaggio!"</em>><br>
                                                                        Sicuramente con la vostra esperienza e capacità sarete in grado di proporre incentivi più accattivanti e mirati al successo della loro pubblicazione!!>
                                                                    </p>
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
                                                        <? 
                                                        echo $content;
/*                                                             if($_GET['azione'] == ''){  
                                                                echo $xcrud->render();
                                                            }else{
                                                                echo $pulsante_indietro;
                                                                echo $xcrud2->render('edit',$_REQUEST['azione']);
                                                                //echo ($tot_componenti>0?$componenti->render():'');
                                                                echo $componenti->render();
                                                            }  */
                                                        ?>
                                                    <? include_module('backtop.inc.php'); ?> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        <?php 
            if(check_configurazioni(IDSITO,'check_notifiche_push')==1){
                echo $notifiche_js;
            }
        ?>
    <!-- /.content -->
    <? include_module('footer.inc.php'); ?>