<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
    <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <section class="content">
        <div class="box radius6">
            <div class="box-body">
                <script>     
                    $(document).ready(function(){
                        var i = 0;
                        var speed = 500;
                        link = setInterval(function() {
                            i++;
                            $("#blink_servizi").css('color', i%2 == 1 ? '#DD4B39' : '#2C3B41');
                        },speed);
                    });   
                </script>
                <h4 id="blink_servizi"><b>[Nuovo modulo]</b></h4>
                <?=$etichetta_explane_percentuale;?>
                <?php   echo $xcrud_conf->render(); ?> 
                <div style="float:right">
                    <button class="btn btn-primary btn-sm" id="closeButtonBoxInfo">
                        Chiudi legenda <i class="fa fa-times" data-toggle="tooltip" title="Chiudi"></i>
                    </button> 
                    <button class="btn btn-primary btn-sm" id="openButtonBoxInfo">
                        Visualizza legenda <i class="fa fa-angle-double-down" data-toggle="tooltip" title="Visualizza"></i>
                    </button> 
                </div>
                <div class="clearfix p-b-10"></div>
                    <div class="alert alert-default text-black" id="legenda"  style="display:none">

                        <div class="clearfix p-b-10"></div>
                        <p>Il <b>numero massimo di Servizi Aggiunti è <span class="text-red" style="font-size:18px!important"><?=NUMERO_SERVIZI?></span></b>, se si <b>pareggia</b> questo numero i checkbox (in creazione e/o modifica preventivo per rendere i servizi visibili o non visibili in ogni proposta), <b>verranno rimossi automaticamente</b>!</p>  
                        <p> 
                        <b>INCLUSI:</b> se selezionate i servizi come inclusi, controllate che almeno siano servizi aggiuntivi <b>che abbiano un costo</b>, se dovete inserire <b>servizi aggiuntivi gratuiti</b> è consigliabile creare una descrizione testuale<br> <em>(esempio in: Proposte/Pacchetti)</em>
                        <ol>
                            <li>che siano già compresi nelle varie proposte di soggiorno che andate a compilare!</li>
                            <li>Inoltre <b>non selezionate come inclusi i servizi a persona</b> altrimenti viene disabilitato il pulsante del calcolo, a meno che non abbiate già un prezzo unico (<em>quindi un prezzo non a persona</em>) che appunto non necessiti di calcoli!</li>
                        </ol>
                        <b>IMPORTANTE</b>
                        <ol>
                            <li>Se avete inserito nella lista uno o più servizi aggiuntivi <b>"A Percentuale"</b> <b class="text-red">è sconsigliato abilitare la gestione lato client</b> (landing page)!</li>
                            <li><b>In alternativa</b> se volete abilitare la gestione lato client, ricordatevi di non selezionare il servizio <b>"A Percentuale"</b> durante la creazione della proposta di soggiorno!</li>
                            <li>Questo perchè se il servizio è pre-selezionato da voi, il calcolo della percentuale avverrà sempre e solo sull'importo del soggiorno da voi proposto e non sul totale modificato dal cliente finale che può aggiungere o meno nuovi servizi!</li>
                        </ol>
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
                <?php   echo $xcrud->render(); ?>  
            </div>
        </div>              
    </section><!-- /.content -->
</div><!-- ./wrapper -->
<?php include_module('footer.inc.php'); ?>