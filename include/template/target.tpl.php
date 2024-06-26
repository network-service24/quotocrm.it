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
                                                <h5>Gestione Target clienti, puoi aggiungere voci a quelle di default, per targhettizzare i clienti</h5>                                              

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
                                                        <div class="alert alert-default text-black text-center" id="legenda"  style="display:none">
                                                            <ul>
                                                                <li>Se avete <b>rinominato un Template</b> con un'etichetta che <b>non appare nella lista dei Target Clienti</b>, ricordatevi di <b>crearla</b> altrimenti il testo dedicato non verrà associato al template</li>
                                                                <li>Aggiungendo o modificando il nome del Target, dovete rispettare alcune regole; <b>non inserire caratteri particolari</b> (<em>viene accettato solo il simbolo -</em>) e <b>non inserire spazi vuoti</b>!</li>
                                                            </ul>
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
                                                        <div class="clearfix p-b-20"></div> 
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