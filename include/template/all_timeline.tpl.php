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
                                                <h5> Timeline: linea temporale delle operazioni compiute </h5>                                              
                                                <div class="card-header-right">
                                                    <ul class="list-unstyled card-option">
                                                        <li><i class="feather icon-maximize full-card"></i></li>
                                                        <!-- 
                                                        <li><i class="feather icon-minus minimize-card"></i></li>
                                                        <li><i class="feather icon-trash-2 close-card"></i></li> 
                                                        -->
                                                    </ul>
                                                </div>
                                            </div>
                                                <div class="card-block latest-update-card">

                                                    <div class="row">
                                                        <div class="col-md-10">
                                                            <?=$h2?>
                                                        </div>
                                                        <div class="col-md-2" style="padding:20px 40px 0px 0px;text-align:right">
                                                            <a class="btn btn-warning btn-sm" href="<?=BASE_URL_SITO?>grafici-anagrafiche_clienti/"><i class="fa fa-arrow-left"></i> Torna
                                                            indietro</a>
                                                        </div>
                                                    </div>
                                                
                                                    <?=$timeline?>

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