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
                                                <h5> Auto configuratore con dati di default</h5>                                              

                                            </div>
                                                <div class="card-block">
                                                    <div class="row">
                                                        <div class="col-md-2"></div>
                                                        <div class="col-md-8 text-center">
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
                                                                $messaggio .= '<h2>L\'auto configuratore ha inserito i dati principali di default!</h2>
                                                                        <h3><b>ATTENZIONE:</b> la configurazione di '.NOME_AMMINISTRAZIONE.' va completata!</h3><br>
                                                                        <h4>Devono essere modificate <b>le immagini</b> di default con le vostre:</h4><br>
                                                                        <a class="" href="'.BASE_URL_SITO.'generiche-gallery/"><i class="fa fa-picture-o fa-2x  p-r-20"></i> Gallery landing <i class="p-r-20 fa fa-external-link fa-flip-horizontal"></i></a><br><br> 
                                                                        <a class="" href="'.BASE_URL_SITO.'disponibilita-camere/"><i class="fa fa-bed fa-2x p-r-20"></i> Gallery per ogni camera <i class="p-r-20 fa fa-external-link fa-flip-horizontal"></i></a><br><br>
                                                                        Sempre all\'interno della modifica camere è fondamentale <b>associare i servizi alle camere</b>, selezionando uno o più checkbox per ogni camera!<br><br>
                                                                        <span class="f-10">Preview Servizi in Camera</span><br><a id="hover-image" href="#"><i class="fa fa-picture-o fa-3x text-warning"></i></a><img id="image-hovering" src="'.BASE_URL_SITO.'img/associa_servizi.png" style="display:none;width:80%;z-index:999;">
                                                                        <br><br>
                                                                        Per completare i contenuti di ogni landing page è neccessario inserire un\'immagine rappresentativa della vostra struttura che farà da <b>top image della pagina!</b><br><br>
                                                                        <a class="" href="'.BASE_URL_SITO.'templates-contenuti_template/"><i class="fa fa-paint-brush fa-2x p-r-20"></i> Immagine landing page <i class="p-r-20 fa fa-external-link fa-flip-horizontal"></i></a><br><br>                
                                                                        In configurazioni generiche <b>associare gli Info Box Tag ai templates</b>, selezionando uno o più checkbox!<br><br>
                                                                        <span class="f-10">Preview InfoBox</span><br><a id="hover-image2" href="#"><i class="fa fa-picture-o fa-3x text-success"></i></a><img id="image-hovering2" src="'.BASE_URL_SITO.'img/associa_infobox.png" style="display:none;width:80%;z-index:999;">
                                                                        <br><br>
                                                                        E\' altamente consigliabile inserire gli <b>Eventi</b> ed i <b>Punti d\'Interesse</b>, visibili in tutti i layout template tranne l\'ultimo nuovo template!<br><br>
                                                                        <a href="'.BASE_URL_SITO.'generiche-eventi/" class=""><i class="fa fa-calendar-o fa-2x p-r-20"></i> Eventi per Landing Page <i class="p-r-20 fa fa-external-link fa-flip-horizontal"></i></a><br><br>
                                                                        <a href="'.BASE_URL_SITO.'generiche-punti_interesse/" class=""><i class="fa fa-map fa-2x p-r-20"></i> Punti di Interesse per Landing Page <i class="p-r-20 fa fa-external-link fa-flip-horizontal"></i></a><br><br><br>';
                                                                $messaggio .= '<h4>Ora siete totalmente autonomi...!!</h4><br>';
                                                                echo $messaggio;
                                                                echo $copia;
                                                            }
                                                        ?> 
                                                        <script>
                                                            $(document).ready(function(){

                                                                var yOff = +300;
                                                                var xOff = -500; 
                                                                /** 
                                                                 *! MOUSE OVER IMMAGINI ASSOCIA SERVIZI-CAMERE 
                                                                 */
                                                                $("#hover-image").mouseover(function (e) {
                                                                    $("#image-hovering")
                                                                        .css("position", "absolute")
                                                                        .css("top", (e.pageY - yOff) + "px")
                                                                        .css("left", (e.pageX + xOff) + "px")
                                                                        .fadeIn("fast");
                                                                });
                                                                $("#hover-image").mouseout(function () {
                                                                    $("#image-hovering").hide();
                                                                });   
                                                                /** 
                                                                 *! MOUSE OVER IMMAGINI ASSOCIA INFOBOX-TEMPLATE 
                                                                 */                                                                
                                                                $("#hover-image2").mouseover(function (e) {
                                                                    $("#image-hovering2")
                                                                        .css("position", "absolute")
                                                                        .css("top", (e.pageY - yOff) + "px")
                                                                        .css("left", (e.pageX + xOff) + "px")
                                                                        .fadeIn("fast");
                                                                });
                                                                $("#hover-image2").mouseout(function () {
                                                                    $("#image-hovering2").hide();
                                                                });                                                                
                                                            });                                
                                                        </script>                                                            
                                                        </div>
                                                        <div class="col-md-2"></div>
                                                    </div> 
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