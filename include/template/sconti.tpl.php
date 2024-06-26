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
                                                <h5>Codici Sconto</h5>                                              
                                            </div>
                                                <div class="card-block">
                                                        <?
                                                            if($_REQUEST['azione'] != '') {
                                                                echo'<script>$(function() {$("#res_back").fadeOut(2000); })</script>'."\r\n";
                                                            }
                                                            if($_REQUEST['azione'] == 'ko') {
                                                                echo '<div id="res_back" class="alert alert-danger">
                                                                            <i class="fa fa-warning"></i> Email non inviata!!
                                                                        </div>';
                                                            }
                                                            if($_REQUEST['azione'] == 'ok') {
                                                                echo '<div id="res_back" class="alert alert-info">
                                                                            <i class="fa fa-check"></i> Email inviata correttamente.!!
                                                                        </div>';
                                                            }  
                                                        ?>

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