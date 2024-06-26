<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
    <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <section class="content">
        <div class="box radius6">
            <div class="box-body">
                <h2> Gestione Fonti Prenotazione</h2>
                <div style="float:right"><a href="javascript:;" id="attiva_legenda" data-toogle="tooltip" title="Clicca per leggere!" class="h4">Help <i class="fa fa-life-ring text-info" aria-hidden="true"></i></a></div>  
                    <div class="clearfix"></div>
                        <div class="alert alert-profila  alert-default-profila alert-dismissable text-black" id="legenda"  style="display:none">
                            <h4><i class="fa fa-exclamation-triangle text-orange" aria-hidden="true"></i> 
                                <small>La Fonte di Prenotazione <b>"Sito Web / Landing"</b>, non è possibile modificarla ne eliminarla, l'etichetta è utile al setting del software per i moduli statistici, deve rimanere tale!</small>
                            </h4>
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