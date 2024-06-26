<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
    <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <section class="content">
        <div class="box radius6">
            <div class="box-body">
            <div id="result_ban"></div>
                <h2>
                    <div class="row">
                        <div class="col-md-6"> Gestione Banner Informativo sulla Landing page</div>
                        <div class="col-md-6 text-right">
                            <?php if($check==0){?>
                                <button id="ContentBan" type="button" class="btn btn-info btn-sm" data-toogle="tooltip" title="Popola i contenuti FAC SIMILE per il banner covid 19" style="position:relative;">
                                    <i class="fa fa-comment"></i> Precarica contenuti FAC SIMILE Banner Covid
                                </button>
                            <?}?>
                            <script>
                                $(document).ready(function() {
                                    $("#ContentBan").on("click",function(){

                                        var dati = "idsito=<?=IDSITO?>";
                                            $.ajax({
                                                url: "<?=BASE_URL_SITO?>ajax/popola_banner_covid_landing.php",
                                                type: "POST",
                                                data: dati,
                                                    success: function(data) {
                                                        $("#result_ban").html('<div class="alert alert-success alert-dismissable"><p>Contenuto banner inserito!</p></div>');
                                                            setTimeout(function(){
                                                                $("#result_ban").fadeOut(200);
                                                                location.reload();
                                                            },3000);
                                                    }
                                                });
                                            return false;
                                        });
                                });
                            </script>
                        </div>
                    </div>
                </h2>
                <?php   echo $xcrud->render(); ?>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- ./wrapper -->
<?php include_module('footer.inc.php'); ?>