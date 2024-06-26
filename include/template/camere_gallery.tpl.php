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
                                                <h5>Gestione delle immagini per la camera: <?=urldecode($_REQUEST['param'])?></h5>                                              
                                            </div>
                                                <div class="card-block">
                                                    <div style="line-height:18px!important">
                                                        <span class="f-11">
                                                            <i class="fa fa-exclamation-circle text-info" aria-hidden="true"></i> 
                                                            <b>Dimensione max accettata: 2.048 KByte (2MB) e 32 DPI di risoluzione (Formato Web)!!</b> Per ottenere un aspetto uniforme salvare tutte le immagini della stessa dimensione!
                                                        </span>
                                                    </div>
                                                    <div class="clearfix p-b-30"></div>
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