<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
  <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
  <section class="content">
    <div class="box radius6">
      <div class="box-body">
        <h2>
          Auto configuratore con dati di default
        </h2>
        <?php
         if(CHECKINONLINE==1){
            $messaggio .= 'Ora siete totalmente autonomi...!!<br><br>
                            Potete iniziare ad usufruire del Modulo di Chek-in OnLine.<br><br>
                            Tramite la voce di menù <b>Checkin OnLine -> Aggiungi Prenotazione</b>, potete aggiungere una breve anagrafica con i dati di riferimento della prenotazione, compreso la fonte di provenienza (Booking.com, Expedia e vari Booking Engine, ecc).<br><br>
                            Come potete notare le altre voci di menù nella sidebar di sinistra sono disabilitate, verranno attivate solo dopo la sottoscrizione di un contratto per QUOTO!<br><br>
                            Per l\'uso del Modulo di Check-in Online siete totalmente abilitati, compreso la configurazione delle email automatiche.<br><br>
                            Se desiderate che il software invii ai vostri clienti autonomamente la mail per la richiesta di compilazione del modulo di check-in online, QUOTO ve ne offre l\'opportunità portandosi in <b>Configurazioni -> Config.Autoresponder -> Check-in online Email</b><br><br>
                            Buon lavoro!';
            echo $messaggio;
         }else{
            $messaggio .= '<h2>L\'auto configuratore ha inserito i dati principali di default in Italiano ed Inglese!</h2>
                    <h3><b>ATTENZIONE:</b> la configurazione di '.NOME_AMMINISTRAZIONE.' va completata!</h3><br>
                    <h4>Devono essere modificate tutte <b>le immagini</b> come:</h4><br>
                    <a class="btn btn-success" href="'.BASE_URL_SITO.'generiche-gallery/"><i class="fa fa-picture-o"></i> Gallery landing</a><br><br> 
                    <a class="btn btn-default bg-orange" href="'.BASE_URL_SITO.'disponibilita-camere/"><i class="fa fa-bed"></i> Gallery per ogni camera</a><br><br>
                    Sempre all\'interno della schermata di modifica delle camere è fondamentale <b>associare i servizi alle camere</b>, selezionando uno o più checkbox per ogni camera!<br><br>
                    Per completare i contenuti di ogni landing page è neccessario inserire un\'immagine rappresentativa della vostra struttura, la quale farà da <b>top image della Landing Page</b><br><br>
                    <a class="btn btn-default bg-black" href="'.BASE_URL_SITO.'contenuti_web/"><i class="fa fa-paint-brush"></i> Immagine landing page</a><br><br>                
                    Per completare la configurazione del software è altamente consigliabile inserire<br><br>
                    <a href="'.BASE_URL_SITO.'generiche-eventi/" class="btn btn-success"><i class="fa fa-calendar-o"></i> Eventi per Landing Page</a><br><br>
                    <a href="'.BASE_URL_SITO.'generiche-punti_interesse/" class="btn btn-success"><i class="fa fa-map"></i> Punti di Interesse per Landing Page</a><br><br>';
            $messaggio .= 'Ora siete totalmente autonomi...!!<br>';
            echo $messaggio;
            echo $copia;
         }
          ?>
      </div>
    </div>
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php include_module('footer.inc.php'); ?>