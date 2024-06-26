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
                                                <h5>Gestione Condizioni Generali <small>(e politiche di cancellazione per Voucher)</small></h5>                                              
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
                                                            <div class="alert alert-info text-black text-center" id="legenda"  style="display:none">
                                                            <p>Se volete creare delle politiche di cancellazione e/o condizioni generali dedicate solo ai <b>voucher</b>; sarà sufficiente scegliere la tipologia (tipo) "<b>voucher</b>"; <small>(le politiche così verranno automaticamente associate ai voucher!)</small></p>
                                                            <p>In caso contrario, se non create delle politiche dedicate ai voucher, il sistema mostrerà quelle associate al preventivo di partenza!</p>  
                                                            <p>ATTENZIONE: non inserire più politiche per Voucher, il software ne gestisce solo una, se ne inserite molteplici, l'ultima sarà quella presa in considerazione!</p> 
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
                                                    <?php  echo $content; //echo $xcrud->render(); ?>  
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