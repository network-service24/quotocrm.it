<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
    <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <section class="content">
        <div class="box radius6">
            <div class="box-body">
                <h2> Gestione Galleria Immagini
                    <span>&#10230;</span> <small>gestione del modulo galleria immagini</small></h2>
                    <h5><i class="fa fa-exclamation-circle text-info"></i> Dimensione massima consigliata: 97.66 MByte (1MB) e 32 DPI di risoluzione (Formato Web)!!</h5>
                <h5><i class="fa fa-exclamation-triangle text-orange"></i> Perchè la gallery possa avere un aspetto
                    uniforme, vi consigliamo di salvare tutte le immagini della stessa dimensione.
                    Al momento dell'upload il software chiede il ridimensionamento dell'immagine, adottate lo stesso
                    criterio per tutte!</h5>
                <h5><i class="fa fa-exclamation-circle text-red"></i> La photogallery, nella landing page apparirà in
                    ordine Random, ossia ad ogni ricarico o apertura della pagina l'ordinamento delle immagini cambierà
                    in maniera casuale!</h5>
                <?php   echo $xcrud->render(); ?>
                <label class="label bg-red">12</label> è il limite massimo di Immagini !!
                <br><br>
                <script>     
                    $(document).ready(function(){
                        var i = 0;
                        var speed = 500;
                        link = setInterval(function() {
                            i++;
                            $("#blink_target_gallery").css('color', i%2 == 1 ? '#DD4B39' : '#2C3B41');
                        },speed);
                    });   
                </script>
                <h4 id="blink_target_gallery"><b>[Nuovo modulo]</b></h4>
                <h2> Gestione Galleria Immagini per target (personalizzabili)
                    <span>&#10230;</span> <small>gestione delle gallerie immagini per ogni target</small></h2>
                <h5><i class="fa fa-exclamation-circle text-info"></i> Le photogallery per Target, saranno associate automaticamente ai template landing page relativi!</h5>
                <h5><i class="fa fa-exclamation-circle text-info"></i> Per inserire le immagini in ogni Target Gallery, entra in modifica! Ricorda che il totale immagini caricate delle 3 gallery non deve superare le 36 foto! <small>(automaticamente sparisce il tasto aggiungi)</small></h5>
                <h5><i class="fa fa-exclamation-triangle text-info" aria-hidden="true"></i> <b>ATTENZIONE:</b> modificando il <b>Target Gallery</b>, contemporaneamente andrete a rinominare anche il nome del <b>"Nome Template"</b> ed il nome dei <b>"Contenuti Landing page per target"</b>, associati al target stesso!</h5>
                <h5><i class="fa fa-exclamation-triangle text-orange" aria-hidden="true"></i> <b>ATTENZIONE:</b> inserire il nome della gallery <b>senza</b>, trattini ,underscore, spazi o caratteri particolari!</h5>
                <?php   echo $xcrud2->render(); ?>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- ./wrapper -->
<?php include_module('footer.inc.php'); ?>