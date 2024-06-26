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
                                                <h5>Listini</h5>
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
                                                    <div  id="legenda" style="display:none">
                                                        <?php echo $fun->check_data_syncro_listino_parity(IDSITO)?>
                                                        <?php echo $legenda;?>
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
                                                    <?php  echo $content; ?>
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