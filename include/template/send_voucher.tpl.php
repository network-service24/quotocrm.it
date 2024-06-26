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
                                                <?php
                                                    if($_REQUEST['voucher']=='no'){
                                                        echo '<h5>Chiusura della prenotazione, attendere....</h5>';
                                                    }else{
                                                        echo '<h5>Invio e-Mail in corso e chiusura della prenotazione, attendere....</h5>';
                                                    }
                                                ?>
                                            </div>
                                                <div class="card-block">
                                                    <?=$redirect?>
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
