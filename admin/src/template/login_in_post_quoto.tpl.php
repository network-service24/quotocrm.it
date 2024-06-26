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
                                                <h5>
                                                    Log In | <?=NOME_AMMINISTRAZIONE?>
                                                </h5>                                              
                                                <div class="card-header-right">
                                                    <ul class="list-unstyled card-option">
                                                        <li><i class="feather icon-maximize full-card"></i></li>
                                                        <li><i class="feather icon-minus minimize-card"></i></li>
                                                        <li><i class="feather icon-trash-2 close-card"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                                <div class="card-block">
                                                    <?=$content;?>   
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