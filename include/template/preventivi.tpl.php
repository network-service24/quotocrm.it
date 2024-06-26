<? include_module('header.inc.php'); ?>

<? include_module('navbar.inc.php'); ?>

<? include_module('sidebar.inc.php'); ?>


<div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                <? include_module('breadcrumb.inc.php'); ?>
                                    <div class="page-body">
                                            <?=$infoBox?>                                                                       
                                            <div id="load_db_date"></div> 
                                            <?=$contoAllaRovescia;?>
                                            <div class="clearfix p-b-20"></div>
                                            <div class="card">
                                                <div class="card-block">
                                                    <?=$content?>
                                                   <? include_module('backtop.inc.php'); ?>                                  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    <? include(INC_PATH_MODULI.'search.inc.php'); ?>    
    <!-- /.content -->
 <? include_module('footer.inc.php'); ?>