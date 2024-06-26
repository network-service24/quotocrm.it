<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
    <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <section class="content">
        <div class="box radius6">
            <div class="box-body">
                <h2> Gestione Condizioni Generali <small>(e politiche di cancellazione per Voucher)</small>
                    <span>&#10230;</span> <small>Condizioni Generali <small><small>(e politiche di cancellazione per Voucher)</small></small></h2>
                    <div style="float:right"><a href="javascript:;" id="attiva_legenda" data-toogle="tooltip" title="Clicca per leggere!" class="h4">Help <i class="fa fa-life-ring text-info" aria-hidden="true"></i></a></div>  
                    <div class="clearfix"></div>
                        <div class="alert alert-profila  alert-default-profila alert-dismissable text-black" id="legenda"  style="display:none">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="fa fa-exclamation-triangle text-orange" aria-hidden="true"></i> Se volete creare delle politiche di cancellazione e/o condizioni generali dedicate solo ai <b>voucher</b>; sarà sufficiente scegliere la tipologia (tipo)"<b>voucher</b>"; <small>(le politiche così verranno automaticamente associate ai voucher!)</small></h5>
                        <h5>in caso contrario, se non create delle politiche dedicate ai voucher, il sistema mostrerà quelle associate al preventivo di partenza!</h5>  
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