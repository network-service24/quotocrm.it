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
                                                <h5>Se il sito utilizza il form creato da QUOTO!</h5>                                              
                                            </div>
                                                <div class="card-block">
                                                        <p>Abilita le lingue per il Form dedicato al tuo Sito Web e/o Landing Page<span>&#10230;</span> <small>Abilita le lingue</small></p>
                                                        <div class="alert alert-info text-black">
                                                            <div class="text-center">          
                                                            <p class="text-blue"><i class="fa fa-exclamation-triangle text-orange" aria-hidden="true"></i>  Al termine dell'inserimento delle lingue per abilitare il pulsante sul menù di sinistra <b>"Crea Form"</b>, clicca sul pulsante qui sotto!</p>
                                                            <div class="clearfix"></div>
                                                            <button onclick="location.href=<?php echo $_SERVER['REQUEST_URI']?>" class="btn btn-info ">Sync Reload</button>
                                                            <div class="clearfix" style="padding-top:20px"></div>
                                                            <p class="text-blue"><i class="fa fa-exclamation-circle text-info" aria-hidden="true"></i> <small>Se vengono aggiunte lingue dopo aver creato il form, è neccessario eliminare il form attuale e ri-crealo..., è un'operazione di pochi secondi!</small></p>
                                                            </div>
                                                        </div>
                                                        <p> il checkbox "API di QUOTO" deve essere flaggato <span>&#10230;</span>  <small>questa opzione permette la gestione dei trattamenti e/o tipologia camere per il form direttamente da QUOTO!</small></p>
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