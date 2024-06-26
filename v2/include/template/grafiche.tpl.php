<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
    <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <section class="content">
        <div class="box radius6">
            <div class="box-body">
                <h2> Gestione Template Landing Page
                    <span>&#10230;</span> <small>gestione dei templates</small></h2>
                <div style="line-height:10px">
                    <h5><i class="fa fa-info-circle text-info"></i> <b>LEGENDA:</b> scegli il <b>template
                            predefinito!</b> Il colore identificativo del template, <b>definisce sopra ogni cosa il colore secondario delle email</b> inviate al cliente</h5>
                    <h5><i class="fa fa-exclamation-triangle text-orange" aria-hidden="true"></i> <b>ATTENZIONE:</b>
                        all'interno di <b>ogni proposta</b> hai comunque la possibilità di <b>cambiarlo</b> per ogni
                        cliente!</h5>
                </div>
                <br>
                <h2>Scelta e configurazione del Template predefinito</h2>
                <?php   echo $xcrud->render(); ?>
                <h5><i class="fa fa-exclamation-circle text-info"></i> <b>LEGENDA:</b> Inserire un'immagine <b>TOP</b>
                    ed un'immagine di <b>BACKGROUND</b> per il template <b>SMART</b> ed i 3 <b>CUSTOM TEMPLATES</b>! Se non si caricheranno immagini
                    dedicate, il software popolerà i templates con immagini demo!</h5>
                <h5><i class="fa fa-exclamation-triangle text-orange" aria-hidden="true"></i> <b>ATTENZIONE:</b> per il
                    <b>template DEFAULT</b>, il <b>TOP</b> Immagine viene gestito (come sempre) alla voce di menù <b>"Contenuti
                        Landing"</b>!</h5>
                <br>
                <h2>Configura il templates: Smart</h2>
                <?php   echo $xcrud_smart->render(); ?>
                <br>
                <script>     
                    $(document).ready(function(){
                        var i = 0;
                        var speed = 500;
                        link = setInterval(function() {
                            i++;
                            $("#blink_temp").css('color', i%2 == 1 ? '#DD4B39' : '#2C3B41');
                        },speed);
                    });   
                </script>
                <h4 id="blink_temp"><b>[Nuovo modulo]</b></h4>
                <h2>Configura e personalizza i 3 custom templates - <small>E' possibile modificarli ed anche rinominarli</small></h2>
                <h5><i class="fa fa-exclamation-triangle text-info" aria-hidden="true"></i> <b>ATTENZIONE:</b> modificando il <b>nome del template</b>, contemporaneamente andrete a rinominare anche il nome della <b>"Gallery Target"</b> ed il nome dei <b>"Contenuti Landing page per target"</b>, associati al template stesso!</h5>
                <h5><i class="fa fa-exclamation-triangle text-orange" aria-hidden="true"></i> <b>ATTENZIONE:</b> inserire il nome del template con caratteri minuscoli e <b>senza</b> trattini ,underscore o caratteri particolari!</h5>
                <?php   echo $xcrud2->render(); ?>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- ./wrapper -->
<?php include_module('footer.inc.php'); ?>