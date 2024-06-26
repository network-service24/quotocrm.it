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
                                                <div class="row">
                                                    <div class="col-md-4"><h5>Gestione Template Landing Page</h5></div>
                                                    <div class="col-md-8 text-left">
                                                        <?=$fun->get_legenda_template(IDSITO)?>
                                                    </div>
                                                </div>                                           
                                            </div>
                                                <div class="card-block">
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