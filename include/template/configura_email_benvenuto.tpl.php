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
                                                <h5>Invio automatico dell'Email di Benvenuto</h5>                                              
    
                                            </div>
                                                <div class="card-block">
                                                    <p>
                                                    Abilita l'invio automatico dell'Email di Benvenuto al cliente dopo la data di Check-in 
                                                    <br><span>&#10230;</span> 
                                                    <small>imposta quanti giorni DOPO il Check-in deve arrivare l'Email di Benvenuto al cliente.</small></p>  
                                                        <p><i class="fa fa-exclamation-circle text-black"></i> L'e-mail automatica di Benvenuto, partirà (se impostata) sulle Prenotazioni Confermate, dopo il controllo per la sua spedizione che avviene ogni giorno alle ore 17:10</p>
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