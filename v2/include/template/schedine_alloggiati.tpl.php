<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
    <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <section class="content">
        <div class="box radius6">
            <div class="box-body">
                <h2> Gestione P.S. Schede Alloggiati per la Questura
                    <span>&#10230;</span> <small>P.S. compilate dai clienti</small></h2>
                    <div style="float:right"><a href="javascript:;" id="attiva_legenda8" data-toogle="tooltip" title="Clicca per leggere!" class="h4">Help <i class="fa fa-life-ring text-info"></i></a></div>
                    <div class="clearfix"></div>
                    <div class="alert alert-profila  alert-default-profila alert-dismissable text-black" id="legenda8"  style="display:none">
                            <i class="fa fa-exclamation-circle text-info fa-2x"></i> 
                            <p>
                                Esite una remota possibilità che l'utente che si appresta a compilare il modulo di Check-In Online, 
                                se debba impiegare del tempo per inserire magari 4 persone (<em>i componenti di tutto il soggiorno</em>), 
                                potrebbe scoraggiarsi! <br>(<em>anche perchè di solito e norma questa operazione viene eseguita della reception</em>).<br>
                                Quindi grazie al campo "<b>Esito Compilazione</b>", potete controllare se l'utente ha compilato correttamente tutto il modulo 
                                ed entrando in modifica <b>terminare al suo posto l'operazione</b>.<br>
                                Il nostro consiglio sta nell'invogliare gli ospiti a portare a termine la compilazione del Check-In, magari <b>con qualche piccolo incentivo</b>!<br>
                                <small><b>ESEMPIO:</b><em> "Se compilate il Modulo di Check-In Online portando a termine tutta l'operazione, al vostro arrivo in Hotel avrete un aperitivo in Omaggio!"</em></small><br>
                                <small>Sicuramente con la vostra esperienza e capacità sarete in grado di proporre incentivi più accattivanti e mirati al successo della loro pubblicazione!!</small>
                            </p>
                    </div> 
                    <script>
                           $(document).ready(function(){
                             $("#attiva_legenda8").on("click",function(){
                               $("#legenda8").slideToggle("slow");
                             })
                           })
                    </script>                                             
                <? 
                    if($_GET['azione'] == ''){  
                        echo $xcrud->render();
                    }else{
                        echo $pulsante_indietro;
                        echo $xcrud2->render('edit',$_REQUEST['azione']);
                        //echo ($tot_componenti>0?$componenti->render():'');
                        echo $componenti->render();
                    } 
                ?>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- ./wrapper -->
<?php 
    if(check_configurazioni(IDSITO,'check_notifiche_push')==1){
        echo $notifiche_js;
    }
?>
<?php include_module('footer.inc.php'); ?>