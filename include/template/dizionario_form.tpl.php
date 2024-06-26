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
                                                <h5>Gestione Dizionario del Form dedicato </h5>                                              
                                            </div>
                                                <div class="card-block">
                                                    <div style="float:right">
                                                        <button class="btn btn-primary btn-sm" id="closeButtonBoxInfo">
                                                            Chiudi legenda <i class="fa fa-times" data-toggle="tooltip" title="Chiudi sincronizzazioni attive"></i>
                                                        </button> 
                                                        <button class="btn btn-primary btn-sm" id="openButtonBoxInfo">
                                                            Visualizza legenda <i class="fa fa-angle-double-down" data-toggle="tooltip" title="Visualizza sincronizzazioni attive"></i>
                                                        </button> 
                                                    </div>
                                                        <div class="clearfix p-b-10"></div>
                                                        <div class="alert alert-info text-black" id="legenda"  style="display:none">
                                                            <div class="row">
                                                                <div class="col-md-2"></div>
                                                                <div class="col-md-8 text-center">
                                                                    <ul>
                                                                        <li>Le variabili che iniziano per <b>"Response"</b> compilano i campi dell'e-mail in risposta all'invio del form</li>
                                                                        <!-- <li>Le variabili che iniziano per <b>"Form"</b> compilano i campi del form solo per le vecchie API. (non servono per il WidgetForm)</li> -->
                                                                    </ul>
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