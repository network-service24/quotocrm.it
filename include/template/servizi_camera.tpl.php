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
                                                <h5>Servizi in Camera</h5>                                              
                                            </div>
                                                <div class="card-block">
                                                    <div style="float:right">
                                                        <button class="btn btn-primary btn-sm" id="closeButtonBoxInfo">
                                                            Chiudi legenda <i class="fa fa-times" data-toggle="tooltip" title="Chiudi"></i>
                                                        </button> 
                                                        <button class="btn btn-primary btn-sm" id="openButtonBoxInfo">
                                                            Visualizza legenda <i class="fa fa-angle-double-down" data-toggle="tooltip" title="Visualizza"></i>
                                                        </button> 
                                                    </div>
                                                    <div class="clearfix p-b-10"></div>
                                                    <div  id="legenda" class="alert alert-info text-black" style="display:none">
                                                        <div class="text-center">
                                                            <span class="f-13">
                                                                Se modificate l'etichetta di un servizio dopo che questo è stato associato ad una camera, dovrà essere ri-associato alla camera stessa!
                                                                    <div class="clearfix p-b-10"></div>
                                                                L'etichetta del Servizio ed il nome del Servizio stesso in lingua Italiana devono corrispondere, altrimenti non verrà visualizzato!
                                                            </span>
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
                                                    <div class="clearfix p-b-30"></div>
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