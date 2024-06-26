<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
    <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <section class="content">
        <div class="box radius6">
            <div class="box-body">
                <h2> Gestione contenuti Template
                    <span>&#10230;</span> <small>gestione dei contenuti, immagini ed abbinamento moduli</small></h2>
                <?php   echo $xcrud->render(); ?>
                <?php   echo $xcrud_conferma->render(); ?>
                <script>     
                    $(document).ready(function(){
                        var i = 0;
                        var speed = 500;
                        link = setInterval(function() {
                            i++;
                            $("#blink_custom1").css('color', i%2 == 1 ? '#DD4B39' : '#2C3B41');
                            $("#blink_custom2").css('color', i%2 == 1 ? '#DD4B39' : '#2C3B41');
                            $("#blink_custom3").css('color', i%2 == 1 ? '#DD4B39' : '#2C3B41');
                        },speed);
                    });   
                </script>
                <h4 id="blink_custom1"><b>[Nuovo modulo]</b></h4>
                <?php   echo $xcrud_family->render(); ?>
                <h4 id="blink_custom2"><b>[Nuovo modulo]</b></h4>
                <?php   echo $xcrud_bike->render(); ?>
                <h4 id="blink_custom3"><b>[Nuovo modulo]</b></h4>
                <?php   echo $xcrud_romantico->render(); ?>
                <?php   echo $xcrud_questionario->render(); ?>
                <?php   echo $xcrud_voucher->render(); ?>
                <?php   echo $xcrud_voucher_recupero->render(); ?>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- ./wrapper -->
<?php include_module('footer.inc.php'); ?>