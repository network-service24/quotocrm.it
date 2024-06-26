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
                                                <h5>Configura Questionario Customer Satisfaction</h5>                                              
                                            </div>
                                                <div class="card-block">
                                                    <div class="row">
                                                        <div class="col-md-2"></div>
                                                        <div class="col-md-8">
                                                            <div class="alert alert-info text-black">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                <ul>
                                                                    <li>
                                                                      - Abilita l'invio dell'e-mail di Questionario prima/dopo la data di Check-Out!
                                                                    </li>
                                                                    <li>
                                                                        - Imposta il numero di giorni per il CS
                                                                    </li>
                                                                    <li>
                                                                       - Se impostata l'e-mail automatica d'invio Questionario sulle Prenotazioni Confermate, partirà ogni giorno alle ore 10:00
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2"></div>
                                                    </div>
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