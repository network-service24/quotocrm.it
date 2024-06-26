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
                                                <h5>Gestione Tipologia Pagamenti</h5>                                              
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
                                                    <div id="legenda"  style="display:none">                                    
                                                            <div class="row">
                                                                <div class="col-md-3"></div>
                                                                <div class="col-md-6 alert alert-info text-black">                                                                 
                                                                    <p><i class="fa fa-exclamation-triangle text-black"></i> La caparra si può impostare e/o modificare anche dentro la richiesta!!</p>                                                                   
                                                                </div>
                                                                <div class="col-md-3"></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-3"></div>
                                                                <div class="col-md-6">
                                                                    <div class="alert alert-danger text-center">
                                                                        <p>ATTENZIONE: Lo staff di Network Service s.r.l. vuole ricordarvi che dal Gennaio 2020 è scongliato usare <br><b>Il modulo di pagamento con Carta di Credito a garanzia</b> (utilizzando il POS alla reception)!<br>Il modulo in questione non rispetta le norme vigenti e non vi tutela!</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3"></div>
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

                                                    <?php echo $content; ?>
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