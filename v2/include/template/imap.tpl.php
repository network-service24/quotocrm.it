<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
    <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <section class="content">
        <div class="box radius6">
            <div class="box-body">
                <h2> Dati Server IMAP E-mail
                    <span>&#10230;</span> <small>configurazione per la e-mail dedicata all'importazione dei dati dai
                        portali</small></h2>
                    <h5>
                          <span class="btn bg-red btn-xs" >Info-Alberghi</span> <div class="clearfix"></div>
                          Compilare i campi HotelID, Type (di default=tutte) ed il campo UrlApi (lasciare il valore di default).
                          Per rendere possibile la sincro con i dati di Info-Alberghi comunicare a loro il nominativo del cliente, e lo abiliteranno all'uso dell'api, una volta ottenuto questo,
                          consultare il Back-Office dell API per scoprire l'Hotel-ID del cliente (Accessi reperibili in Suiteweb sotto www.network-service.it).
                    </h5>
                   
<!--                     <h5>
                          <span class="btn bg-green btn-xs" >ItalyFamilyHotels</span> <div class="clearfix"></div>
                            Attenzione per questo portale è abilitata l'apertura della casella IMAP solo per account GMAIL
                    </h5> -->
                    <br>

                    <h5><a href="#" class="btn bg-maroon btn-xs" id="openBtn2">Check</a> Controlla il giusto funzionamento
                        (per <b>GabicceMare</b>) altrimenti se restituisce errore, disattiva subito il servizio per cercare
                        la soluzione e riprova!</h5>
                    <h5><a href="#" class="btn bg-green btn-xs" id="openBtn3">Check</a> Controlla il giusto funzionamento
                        (per <b>ItalyfamilyHotels</b>) altrimenti se restituisce errore, disattiva subito il servizio per cercare
                        la soluzione e riprova!</h5>
                    <h5><a href="#" class="btn btn-warning btn-xs" id="openBtn4">Check</a> Controlla il giusto funzionamento
                        (per <b>riccioneinhotel</b>) altrimenti se restituisce errore, disattiva subito il servizio per cercare
                        la soluzione e riprova!</h5>
                        <h5><a href="#" class="btn btn-primary btn-xs" id="openBtn5">Check</a> Controlla il giusto funzionamento
                        (per <b>cesenaticobellavita</b>) altrimenti se restituisce errore, disattiva subito il servizio per cercare
                        la soluzione e riprova!</h5>
                        <h5><a href="#" class="btn bg-purple btn-xs" id="openBtn6">Check</a> Controlla il giusto funzionamento
                        (per <b>familygo</b>) altrimenti se restituisce errore, disattiva subito il servizio per cercare
                        la soluzione e riprova!</h5>
                    <h5><a href="#" class="btn btn-danger btn-xs" id="openBtn7">Check</a> Controlla il giusto funzionamento
                        (per <b>ItalybikeHotels</b>) altrimenti se restituisce errore, disattiva subito il servizio per cercare
                        la soluzione e riprova!</h5>
                        <h5><a href="#" class="btn bg-teal btn-xs" id="openBtn8">Check</a> <span class="text-gray">Controlla il giusto funzionamento
                        (per <b>BimboInViaggio</b>) altrimenti se restituisce errore, disattiva subito il servizio per cercare
                        la soluzione e riprova!</span>  -> <b class="text-red">sospeso</b></h5>
                        <h5><a href="#" class="btn bg-blue btn-xs" id="openBtn9">Check</a> <span class="text-gray">Controlla il giusto funzionamento
                        (per <b>Hotel-facile.it</b>) altrimenti se restituisce errore, disattiva subito il servizio per cercare
                        la soluzione e riprova!</span>  -> <b class="text-yellow">work in progress</b></h5>
                        <h5><a href="#" class="btn bg-purple btn-xs" id="openBtn10">Check</a> <span class="text-gray">Controlla il giusto funzionamento
                        (per <b>AllInclusiveHotels.it</b>) altrimenti se restituisce errore, disattiva subito il servizio per cercare
                        la soluzione e riprova!</span>  -> <b class="text-yellow">work in progress</b></h5>
                <?php echo $xcrud->render(); ?>
                <?=$js_ajax?>
                <div id="controllo"></div>
                <div id="controllo2"></div>
                <div id="controllo3"></div>
                <div id="controllo4"></div>
                <div id="controllo5"></div>
                <div id="controllo6"></div>
                <div id="controllo7"></div>
                <div id="controllo8"></div>
                <div id="controllo9"></div>
                <div id="controllo10"></div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- ./wrapper -->
<?php include_module('footer.inc.php'); ?>
