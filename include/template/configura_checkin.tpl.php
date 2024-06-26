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
                                                <h5>Configura l'invio automatico del Modulo Check-in online</h5>                                              
                                            </div>
                                                <div class="card-block">
                                                    <p>
                                                    Abilita l'invio automatico del Modulo Check-in online, al cliente prima della data del Check-in 
                                                    <br><span>&#10230;</span> <small>imposta quanti giorni PRIMA del Check-in deve arrivare il Modulo Check-in al cliente.</small>
                                                    </p>
                                                    <p><i class="fa fa-exclamation-circle text-black"></i> L'e-mail automatica partirà (se impostata) ogni giorno alle ore 09:40</p>
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