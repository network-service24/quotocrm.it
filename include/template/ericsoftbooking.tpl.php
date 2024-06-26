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
                                                <h5>Dati Account Ericsoft Booking</h5>                                              
                                            </div>
                                                <div class="card-block">
                                                        <div class="alert alert-info text-black">
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                            <p><i class="fa fa-exclamation-triangle text-orange" aria-hidden="true"></i> <b>ATTENZIONE:</b> la sincronizzazione con il PMS di Ericsoft è possibile solo se il cliente ha acquistato il <b>Channel Manager </b>ossia la <b>Suite di Ericsoft</b> (<em>questo il volere di Ericsoft</em>)!</p>
                                                        </div>
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