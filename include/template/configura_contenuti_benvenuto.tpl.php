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
                                                    $valEtichetta = ucwords(strtolower(str_replace("_"," ",$_REQUEST['param'])));                                              
                                                    $valEtichetta = str_replace("Reselling","Email di Benvenuto",$valEtichetta);
                                                ?>
                                                <h5>Gestione dei contenuti <em class="f-12">[<?=$valEtichetta?>]</em> per E-mail di Benvenuto</h5>                                              
                                            </div>
                                                <div class="card-block">        
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