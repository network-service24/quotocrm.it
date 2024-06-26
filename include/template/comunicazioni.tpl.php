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
                                                <h5>Comunicazioni da Network Service</h5>                                              
                                            </div>
                                                <div class="card-block">
                                                    <div class="alert alert-info text-black">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                        <p><i class="fa fa-exclamation-circle text-info"></i> In questa sezione trovate il riepilogo di tutte le
                                                            comunicazione <b>da</b> Network Service <b>a</b> Voi.
                                                            Possono essere di carattere informativo, upgrade o update del software e/o a scopo didattico!</p>
                                                        <p><i class="fa fa-exclamation-circle text-info"></i> Le comunicazioni con data di fine pubblicazione
                                                            in <b>rosso</b> sono scadute!</p>
                                                        <p><i class="fa fa-exclamation-circle text-info" aria-hidden="true"></i> Le comunicazione <b>attive</b>,
                                                            oltre ad essere presenti nella pagina di riepilogo ed aprirsi automaticamente al momento del log-in
                                                            in QUOTO, le trovate nella barra in alto sulla destra.</p>
                                                    </div>
                                                    <?php echo $content;?>
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