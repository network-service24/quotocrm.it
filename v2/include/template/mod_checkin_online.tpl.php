<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<style>
    div.error { display: none; }
    input.error { border:2px dashed red !important; }
    select.error { border:2px dashed red !important; }               
</style>
<div class="content-wrapper">
<?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <section class="content">
        <div class="box radius6">
            <div class="box-body">
                <h2 class="page-header linea_green" id="DatiRichiesta">
                    <i class="fa fa-book text-green"></i> Dati Richiesta
                </h2>
                <form id="checkin_form" role="form" method="post" action="<?=$_SERVER['REQUEST_URI']?>">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-5">
                        <!-- left column -->
                        <div class="form-group">
                            <label for="Lingua">Lingua</label>                        
                                <select id="lingua" name="Lingua" class="form-control" tabindex="1">
                                    <?=$ListaLingua?>
                                </select>
                        </div>
                    </div><!-- colonna left -->
                    <div class="col-md-5">
                    </div>
                    <div class="col-md-1"></div>
                </div><!-- chiusura row -->

                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-5">
                        <!-- left column -->
                        <div class="form-group">
                            <label for="NumeroPrenotazione">Prefisso o Numerazione Derivata</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                    <input type="text" name="Prefisso" placeholder="Inserire il numero di riferimento della prenotazione in vostro possesso!"
                                    class="form-control" value="<?=$Prefisso?>" tabindex="1">
                            </div>
                        </div>
                    </div><!-- colonna left -->
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="NumeroPrenotazione">Numero Prenotazione <small>progessiva di QUOTO!</small></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                    <input type="text" name="NumeroPrenotazione" placeholder="Inserire solo numeri e non caratteri"
                                    class="form-control" value="<?=$NumeroPrenotazione?>" tabindex="1" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                </div><!-- chiusura row -->
              
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            <!-- left column -->
                            <div class="form-group">
                                <label for="ChiPrenota">Operatore</label>
                                <select id="ChiPrenota" name="ChiPrenota" class="form-control" tabindex="3">
                                    <?php echo $NomiOperatori ?>
                                </select>

                            </div>

                        </div><!-- colonna left -->
                        <div class="col-md-5">
                            <!-- right column -->
                            <div class="form-group">
                                <label for="EmailSegretaria">Email Operatore</label>
                                <select id="EmailSegretaria" name="EmailSegretaria" class="form-control" tabindex="4">
                                    <option value="0">Attendere...</option>
                                    <?=$EmailSegretaria ?>
                                </select>
                            </div>
                        </div><!-- colonna right -->
                        <div class="col-md-1"></div>
                    </div><!-- chiusura row -->
                    <br>
                    <h2 class="page-header linea_red" id="DatiCliente">
                        <i class="fa fa-user text-red"></i> Dati Cliente
                    </h2>

                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-5">
                                <!-- left column -->
                                <label for="Nome">Nome</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input class="form-control" type="text" id="Nome" name="Nome" value="<?=$Nome?>"  placeholder="Nome" tabindex="5" />
                                </div>
                            </div><!-- colonna left -->
                            <div class="col-md-5">
                                <!-- right column -->
                                <label for="Cognome">Cognome</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" id="Cognome" name="Cognome" placeholder="Cognome" value="<?=$Cognome?>" class="form-control"
                                        tabindex="6">
                                </div>
                            </div><!-- colonna right -->
                            <div class="col-md-1"></div>
                        </div><!-- chiusura row -->
                        <br>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-5">
                                <!-- left column -->
                                <label for="Email">Email</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    <input type="email" id="Email" name="Email" value="<?=$Email?>" placeholder="Email" class="form-control"
                                        tabindex="7">
                                </div>
                            </div><!-- colonna left -->
                            <div class="col-md-5">
                                <div class="col-md-4">
                                    <label for="Cellulare">Pre <small>(int)</small></label>
                                    <select id="PrefissoInternazionale" name="PrefissoInternazionale" class="form-control"  required>
                                        <?=$ListaPrefissi?>
                                    </select>
                                </div>
                                <div class="col-md-8">
                                    <!-- right column -->
                                    <label for="Cellulare">Cellulare <small>per invio tramite Whatsapp</small></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        <input type="text" id="Cellulare" name="Cellulare"  value="<?=$Cellulare?>" placeholder="Esempio formato: 333 3333333 oppure 3333333333 oppure 333.3333333" class="form-control"
                                            tabindex="8">
                                    </div>
                                </div><!-- colonna right -->
                            </div>
                            <div class="col-md-1"></div>
                        </div><!-- chiusura row -->
           

                    <br>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            <!-- left column -->
                            <div class="form-group">
                                <label for="TipoRichiesta">Target Cliente</label>
                                <select id="TipoVacanza" name="TipoVacanza" class="form-control" tabindex="9">
                                    <?=$Target?>
                                </select>
                            </div>
                        </div><!-- colonna left -->
                        <div class="col-md-6"></div>
                    </div><!-- chiusura row -->
                    <br>
                    <h2 class="page-header linea_orange">
                        <i class="fa fa-calendar text-orange"></i> Dati Prenotazione
                    </h2>
                    <div id="notti" style="width:100%;text-align:center"></div>
                    <br>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            <!-- left column -->
                            <div class="control-group">
                                <label for="DataArrivo" class="control-label">Data Arrivo</label>
                                <div class="controls">
                                    <div class="input-group">
                                        <label for="DataArrivo" class="input-group-addon btn">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </label>
                                        <input id="DataArrivo" name="DataArrivo" type="text" value="<?=$DataArrivo?>" class="date-picker form-control"
                                            tabindex="10" autocomplete="off" />
                                    </div>
                                </div>
                            </div>
                        </div><!-- colonna left -->
                        <div class="col-md-5">
                            <!-- right column -->
                            <div class="control-group">
                                <label for="DataPartenza" class="control-label">Data Partenza</label>
                                <div class="controls">
                                    <div class="input-group">
                                        <label for="DataPartenza" class="input-group-addon btn">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </label>
                                        <input id="DataPartenza" name="DataPartenza" type="text" value="<?=$DataPartenza?>" class="date-picker form-control"
                                            tabindex="11" autocomplete="off" />
                                    </div>
                                </div>
                            </div>
                        </div><!-- colonna right -->
                        <div class="col-md-1"></div>
                    </div><!-- chiusura row -->
                    <br>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-2">
                            <!-- left column -->
                            <div class="form-group">
                                <label for="NumeroAdulti">Numero Adulti</label>
                                <select id="NumeroAdulti" name="NumeroAdulti" class="form-control" tabindex="12"
                                    >
                                    <option value="" selected="selected">--</option>
                                    <?=$NumeriA?>
                                </select>
                            </div>
                        </div><!-- colonna left -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="NumeroBambini">Numero Bambini</label>
                                <select name="NumeroBambini" id="NumeroBambini" class="form-control" tabindex="13">
                                    <option value="" selected="selected">--</option>
                                    <?=$NumeriB?>
                                </select>
                            </div>
                        </div>
        
                        <div class="col-md-5">
                            <!-- right column -->
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group" id="EtaBambini1" style="display:none">
                                        <label for="etaBambini">Età 1°</label>
                                        <select id="EtaB1" name="EtaBambini1" class="form-control" tabindex="14">
                                            <option value="" selected="selected">--</option>
                                            <?=$etaBimbi1?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group" id="EtaBambini2" style="display:none">
                                        <label for="etaBambini">Età 2°</label>
                                        <select id="EtaB2" name="EtaBambini2" class="form-control" tabindex="15">
                                            <option value="" selected="selected">--</option>
                                            <?=$etaBimbi2?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group" id="EtaBambini3" style="display:none">
                                        <label for="etaBambini">Età 3°</label>
                                        <select id="EtaB3" name="EtaBambini3" class="form-control" tabindex="16">
                                            <option value="" selected="selected">--</option>
                                            <?=$etaBimbi3?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group" id="EtaBambini4" style="display:none">
                                        <label for="etaBambini">Età 4°</label>
                                        <select id="EtaB4" name="EtaBambini4" class="form-control" tabindex="17">
                                            <option value="" selected="selected">--</option>
                                            <?=$etaBimbi4?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group" id="EtaBambini5" style="display:none">
                                        <label for="etaBambini">Età 5°</label>
                                        <select id="EtaB5" name="EtaBambini5" class="form-control" tabindex="17">
                                            <option value="" selected="selected">--</option>
                                            <?=$etaBimbi5?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group" id="EtaBambini6" style="display:none">
                                        <label for="etaBambini">Età 6°</label>
                                        <select id="EtaB6" name="EtaBambini6" class="form-control" tabindex="17">
                                            <option value="" selected="selected">--</option>
                                            <?=$etaBimbi6?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div><!-- colonna right -->
                    

                        <div class="col-md-1"></div>
                    </div><!-- chiusura row -->
               
                    <h2 class="page-header linea_aqua">
                        <i class="fa fa-inbox text-aqua"></i> Informazioni
                    </h2>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            <!-- left column -->
                            <div class="form-group">
                                <label for="FontePrenotazione">Fonte Prenotazione</label>
                                <select name="FontePrenotazione" class="form-control" tabindex="42">
                                    <option value="" selected="selected">--</option>
                                    <?=$ListaFonti?>
                                </select>
                            </div>
                        </div><!-- colonna left -->
                        <div class="col-md-5">

                        </div><!-- colonna right -->
                        <div class="col-md-1"></div>
                    </div><!-- chiusura row -->
            </div><!-- /.box-body -->
            <div class="box-footer text-center">

                <input type="hidden" name="idsito" value="<?=IDSITO?>">
                <input type="hidden" name="action" value="modif">
                <input type="hidden" name="CheckinOnlineClient" value="1">
                <input type="hidden" name="Id" value="<?=$Id?>">
                <div id="view_form_loading"></div>
                <button type="submit" class="btn btn-primary" id="bottone_salva">MODIFICA PRENOTAZIONE</button>
            </div>
            </form>
        </div>
</div>

</section><!-- /.content -->
</div><!-- ./wrapper -->
<?=$js?>
<?php include_module('footer.inc.php'); ?>