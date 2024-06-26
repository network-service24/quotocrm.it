<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
    <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <section class="content">
        <div class="box radius6">
            <div class="box-body">
                <h2>
                    Gestione Target clienti, puoi aggiungere voci a quelle di default, per targhettizzare i clienti
                    <span>&#10230;</span> <small>Target clienti</small>
                </h2>
                <div style="float:right"><a href="javascript:;" id="attiva_legenda" data-toogle="tooltip" title="Clicca per leggere!" class="h4">Help <i class="fa fa-life-ring text-info" aria-hidden="true"></i></a></div>  
                    <div class="clearfix"></div>
                        <div class="alert alert-profila  alert-default-profila alert-dismissable text-black" id="legenda"  style="display:none">
                            <?=$FormMsg?>
                            <div class="clearfix"></div>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="fa fa-exclamation-triangle text-orange" aria-hidden="true"></i> <b>Attenzione:</b> se volete accoppiare un <b>Target Name</b> con un <b>Template Custom</b> modificandone il nome, dovete rispettare alcune regole; <b>non inserire caratteri particolari</b> (<em>viene accettato solo il simbolo -</em>) e <b>non inserire spazi vuoti</b>!</h5>
                    </div>
                        <script>
                           $(document).ready(function(){
                             $("#attiva_legenda").on("click",function(){
                               $("#legenda").slideToggle("slow");
                             })
                           })
                         </script>
                <?php   echo $xcrud->render(); ?>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- ./wrapper -->
<?php include_module('footer.inc.php'); ?>
