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
                                                    <h5>Profila ed Esporta per l'anno <?=$_REQUEST['azione']?></h5>                                                                                         
                                                </div>
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
    <? include(INC_PATH_MODULI.'search.profila.inc.php'); ?>    
    <!-- /.content -->
 <? include_module('footer.inc.php'); ?>