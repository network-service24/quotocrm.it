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
                                                <h5>Dati Server IMAP E-mail</h5>                                              

                                            </div>
                                                <div class="card-block">
                                                    <div class="alert alert-info text-black f-12">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <i class="icofont icofont-close-line-circled"></i>
                                                        </button>                                                  
                                                        <span class="btn bg-red btn-mini">Info-Alberghi</span> <div class="clearfix"></div>
                                                        <p class="f-12">
                                                            Compilare i campi HotelID, Type (di default=tutte) ed il campo UrlApi (lasciare il valore di default).
                                                            Per rendere possibile la sincro con i dati di Info-Alberghi comunicare a loro il nominativo del cliente, e lo abiliteranno all'uso dell'api, una volta ottenuto questo,
                                                            consultare il Back-Office dell API per scoprire l'Hotel-ID del cliente (Accessi reperibili in Suiteweb sotto www.network-service.it).
                                                        </p>
                                                    </div>
                                                    <p class="f-12"><a href="#" class="btn bg-maroon btn-mini" id="openBtn2">Check</a> Controlla il giusto funzionamento
                                                        (per <b>GabicceMare</b>) altrimenti se restituisce errore, disattiva subito il servizio per cercare
                                                        la soluzione e riprova!</p>

                                                    <p class="f-12"><a href="#" class="btn bg-green btn-mini" id="openBtn3">Check</a> Controlla il giusto funzionamento
                                                        (per <b>ItalyfamilyHotels</b>) altrimenti se restituisce errore, disattiva subito il servizio per cercare
                                                        la soluzione e riprova!</p>

                                                    <p class="f-12"><a href="#" class="btn btn-warning btn-mini" id="openBtn4">Check</a> Controlla il giusto funzionamento
                                                        (per <b>riccioneinhotel</b>) altrimenti se restituisce errore, disattiva subito il servizio per cercare
                                                        la soluzione e riprova!</p>

                                                        <p class="f-12"><a href="#" class="btn btn-primary btn-mini" id="openBtn5">Check</a> Controlla il giusto funzionamento
                                                        (per <b>cesenaticobellavita</b>) altrimenti se restituisce errore, disattiva subito il servizio per cercare
                                                        la soluzione e riprova!</p>

                                                        <p class="f-12"><a href="#" class="btn bg-purple btn-mini" id="openBtn6">Check</a> Controlla il giusto funzionamento
                                                        (per <b>familygo</b>) altrimenti se restituisce errore, disattiva subito il servizio per cercare
                                                        la soluzione e riprova!</p>

                                                    <p class="f-12"><a href="#" class="btn btn-danger btn-mini" id="openBtn7">Check</a> Controlla il giusto funzionamento
                                                        (per <b>ItalybikeHotels</b>) altrimenti se restituisce errore, disattiva subito il servizio per cercare
                                                        la soluzione e riprova!</p>

                                                        <p class="f-12"><a href="#" class="btn bg-teal btn-mini" id="openBtn8">Check</a> Controlla il giusto funzionamento
                                                        (per <b>spahotelscollection</b>) altrimenti se restituisce errore, disattiva subito il servizio per cercare
                                                        la soluzione e riprova!



                                                    <div id="controllo"></div>
                                                    <div id="controllo2"></div>
                                                    <div id="controllo3"></div>
                                                    <div id="controllo4"></div>
                                                    <div id="controllo5"></div>
                                                    <div id="controllo6"></div>
                                                    <div id="controllo7"></div>
                                                    <div id="controllo8"></div>                            
                                                    <?php echo $content; ?>
                                                    <?=$js_ajax?>
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
