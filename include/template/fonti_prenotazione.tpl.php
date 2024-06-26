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
                                                    <div style="float:right">                                                                
                                                        <button class="btn btn-primary btn-sm" id="closeButtonBoxInfo">
                                                            Nascondi legenda <i class="fa fa-times" data-toggle="tooltip" title="Nascondi"></i>
                                                        </button> 
                                                        <button class="btn btn-primary btn-sm" id="openButtonBoxInfo">
                                                            Visualizza legenda <i class="fa fa-angle-double-down" data-toggle="tooltip" title="Visualizza"></i>
                                                        </button> 
                                                    </div>  
                                                    <div class="clearfix p-b-10"></div>
                                                            <div class="alert alert-info text-black text-center" id="legenda"  style="display:none">
                                                                <p>
                                                                    La Fonte di Prenotazione <b>"Sito Web / Landing"</b>, non è possibile modificarla, eliminarla ne disabilitarla, l'etichetta è utile al setting del software per i moduli statistici, deve rimanere tale!
                                                                </p>
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