<? include_module('header.inc.php'); ?>

<? include_module('navbar.inc.php'); ?>

<? include_module('sidebar.inc.php'); ?>


<div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                <? include_module('breadcrumb.inc.php'); ?>
                                    <div class="page-body">
                                    <div class="card">
                                                <div class="card-block">
                                                    <div id="result_ban"></div>
                                                    <h2>
                                                        <div class="row">
                                                            <div class="col-md-8"> Gestione Banner Info nel modulo di Check-In Online</div>
                                                            <div class="col-md-4 text-right">
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
                                                                                    url: "<?=BASE_URL_SITO?>ajax/generici/popola_banner_covid.php",
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
                                                    <?php   echo $content; ?>
                                                    <? include_module('backtop.inc.php'); ?> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

    <!-- /.content -->
    <? include_module('footer.inc.php'); ?>