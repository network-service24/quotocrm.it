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
                                                <h5>Invio automatico dei ReCall conferme in trattativa</h5>                                              
                                            </div>
                                                <div class="card-block">
                                                    <p>
                                                        Abilita l'invio automatico per il Recall dell'email di scelta del metodo di pagamento della caparra da parte del cliente
                                                        <br><span>&#10230;</span> 
                                                        <small>imposta il numero di giorni prima della data di scadenza impostata nella conferma in trattativa entro i quali dovrà essere inviata la mail di ReCall.</small>
                                                    </p>  
                                                    <p><i class="fa fa-exclamation-circle text-black"></i> L'e-mail automatica partirà (se ) ogni giorno alle ore 08:30</p> 
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