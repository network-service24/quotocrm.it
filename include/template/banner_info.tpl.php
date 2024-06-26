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
                                            <div class="card-header">
                                                <h5>Gestione Banner Informativo sulla Landing pag</h5>                                              
                                            </div>
                                                <div class="card-block">
                                                    <div style="float:right">
                                                        <button class="btn btn-primary btn-sm" id="closeButtonBoxInfo">
                                                            Nascondi legenda <i class="fa fa-times" data-toggle="tooltip" title="Nascondi"></i>
                                                        </button> 
                                                        <button class="btn btn-primary btn-sm" id="openButtonBoxInfo">
                                                            Visualizza legenda <i class="fa fa-angle-double-down" data-toggle="tooltip" title="Visualizza"></i>
                                                        </button> 
                                                    </div>
                                                    <div class="clearfix p-b-10"></div>
                                                    <div id="legenda" style="display:none"> 
                                                            <div class="row">
                                                                <div class="col-md-2"></div>
                                                                <div class="col-md-8 alert alert-info text-black text-center">                                                                 
                                                                    <p>Il banner-info nel template della landing page dedicata al cliente, appare come una linguetta sul lato sinistro della grafica.<br>Cliccandoci si apre una modale con i contenuti!</p>                                                                   
                                                                </div>
                                                                <div class="col-md-2"></div>
                                                            </div>                                                                                                                                                                  
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
                                                    <div id="result_ban"></div>
                                                    <?php if($check==0){?>
                                                        <button id="ContentBan" type="button" class="btn btn-info btn-sm" data-toogle="tooltip" title="Popola i contenuti FAC SIMILE per il banner covid 19" style="position:relative;">
                                                            <i class="fa fa-comment"></i> Precarica contenuti FAC SIMILE Banner Covid
                                                        </button>
                                                        <div class="clearfix p-b-10"></div>
                                                    <?}?>
                                                    <script>
                                                        $(document).ready(function() {
                                                            $("#ContentBan").on("click",function(){

                                                                var dati = "idsito=<?=IDSITO?>";
                                                                    $.ajax({
                                                                        url: "<?=BASE_URL_SITO?>ajax/generici/popola_banner_covid_landing.php",
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