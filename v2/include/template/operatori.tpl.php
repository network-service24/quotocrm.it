<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
    <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <section class="content">
        <div class="box radius6">
            <div class="box-body">
                <h2> Gestione Operatori Reception
                    <span>&#10230;</span> <small>gestione degli operatori abilitati all'uso</small></h2>
                    <div style="float:right"><a href="javascript:;" id="attiva_legenda" data-toogle="tooltip" title="Clicca per leggere!" class="h4">Help <i class="fa fa-life-ring text-info" aria-hidden="true"></i></a></div>  
                         <div class="clearfix"></div>
                          <div class="alert alert-profila  alert-default-profila alert-dismissable text-black" id="legenda"  style="display:none">
                            <div class="lineheight10">
                                <h5><i class="fa fa-exclamation-triangle text-orange"></i> <b>LEGENDA:</b> gli operatori in
                                    <?=NOME_AMMINISTRAZIONE?> si possono aggiungere, ma viene negata la possibilità di cancellarli!
                                    Comunque siete liberi di disabilitare l'operatore che desiderate!</h5>
                                <small><i class="fa fa-exclamation-triangle text-orange"></i> Perchè se l'operatore avesse già
                                    effettuato qualche preventivo, rimarrebbe memorizzato!</small>
                                <h5><i class="fa fa-exclamation-circle text-info"></i> <b>LEGENDA:</b> gli operatori in
                                    <?=NOME_AMMINISTRAZIONE?> possono avere la propria email personalizata, è neccessario però che
                                    sia sempre del dominio del vostro sito e/o che risieda sui nostri server! <span class="text-red">Esempio:
                                        operatore@dominiosito.xx</span></h5>
                                <small><i class="fa fa-exclamation-circle text-info"></i> Se avete il servizio IMAP di GMAIL non è
                                    un problema! (ossia le caselle sono le nostre, ma avete acquistato un servizio da GMAIL).
                                    L'importante è che l'email siano sempre del dominio che risiede sulle nostre macchine o del
                                    dominio che vi è stato assegnato in fase di setup!</small>
                                <div style="clear:both;height:10px"></div>
                                <small><i class="fa fa-exclamation-triangle text-red"></i> Non è vietato, ma è altamente
                                    sconsigliato usare una casella email: .....@gmail.com!</small>
                            </div>
                        </div>
                        <script>
                           $(document).ready(function(){
                             $("#attiva_legenda").on("click",function(){
                               $("#legenda").slideToggle("slow");
                             })
                           })
                         </script>
                <br>              
                <?php   echo $xcrud->render(); ?>
                <?=$ajax_complete?>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- ./wrapper -->
<?php include_module('footer.inc.php'); ?>