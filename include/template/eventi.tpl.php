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
                                                <h5>Gestione Eventi</h5>                                              
                                            </div>
                                                <div class="card-block">
                                                    <p><i class="fa fa-exclamation-circle text-info"></i> Gli Eventi si vedranno nella landing page se
                                                        la <b>data di inizio evento</b> sarà <b>maggiore o uguale</b> alla <b>data di arrivo</b> della
                                                        richiesta presente in
                                                        <?=NOME_AMMINISTRAZIONE?>!</p>
                                                    <p><i class="fa fa-exclamation-circle text-info"></i> Gli Eventi si vedranno nella landing page in
                                                         base alla data d'inizio dell'evento, dal più recente al più lontano!</p>
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