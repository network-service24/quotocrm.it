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
                                                <h5>Gestione Box Informativi Tag nel Template &#10230; <label class="badge badge-danger f-18"><testo id="count_infobox"></testo>/<?=NUM_INFOBOXTAG?></label> Info Box Tag &#10230; <testo class="f-11 text-gray">(numero massimo)</testo></h5>                                              
                                            </div>
                                                <div class="card-block">
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