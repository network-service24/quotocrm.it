<? include_module('header.inc.php'); ?>

<? include_module('navbar.inc.php'); ?>

<? include_module('sidebar.inc.php'); ?>

    <div class="pcoded-content">
            <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST" name="form_ext" id="form_ext">
                        <div class="card bg_proposta_yellow" id="fixed_menu_proposte">
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-8">
                                        <h2 class="text-primary">Modifica Prenotazione Esterna per Check-in OnLine</h2> 
                                        <div class="clearfix p-b-30"></div>
                                        <ul id="menu_proposta">
                                            <li><a href="#" onclick="scroll_to('richiesta',250, 1000);"  class="text-black f-18">Dati Richiesta</a></li>
                                            <li><a href="#" onclick="scroll_to('clienti',250, 1000);"  class="text-black f-18">Dati Clienti</a></li>
                                            <li><a href="#" onclick="scroll_to('prenotazione',250, 1000);" class="text-black f-18">Dati Prenotazione</a></li>
                                            <li><a href="#" onclick="scroll_to('informazioni',250, 1000);" class="text-black f-18">Informazioni</a></li>
                                            <li></li>
                                            <li class="p-0"><a href="<?=BASE_URL_SITO?>dashboard-index/" class="btn btn-primary btn-sm"><i class="fa fa-home fa-2x fa-fw"></i></a></li>
                                            <li class="p-0"><button type="submit" id="bottone_salva" onclick="check_prezzo()" class="btn btn-success">Modifica Prenotazione</button></li>
                                        </ul> 
                                        <div id="view_form_loading"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <!-- CAMPI HIDDEN --> 
                                        <input type="hidden" name="AbilitaInvio" id="AbilitaInvio" value="1">
                                        <input type="hidden" name="Id" id="Id" value="<?=$Id?>">
                                        <input type="hidden" name="CheckinOnlineClient" value="1">
                                        <input type="hidden" name="idsito" id="idsito" value="<?=IDSITO?>">
                                        <input type="hidden" name="DataRichiesta" id="DataRichiesta" value="<?=($DataRichiesta==''?$DataDiOggi:$DataRichiesta)?>">
                                        <input type="hidden" name="action" id="action" value="modif">
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <div class="page-body">
                                                <div class="row" id="content_proposte_ext">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-8">            
                                                        <div class="card bg_blocchi_proposta" id="richiesta">
                                                            <div class="card-block">
                                                                <h5 class="text-primary f-w-600">Dati Richiesta</h5>
                                                                <div class="row m-t-30">
                                                                    <div class="col-md-1 f-w-600">Lingua</div>
                                                                    <div class="col-md-8"> 
                                                                        <select name="Lingua" id="Lingua" class="form-control image-picker" required>
                                                                            <?=$ListaLingue?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-3"></div>
                                                                </div>
                                                                <div class="row m-t-30">
                                                                    <div class="col-md-4"> 
                                                                        <div class="form-group">
                                                                            <label for="NumeroPrenotazione" class="control-label"><b>Numero di prenotazione di QUOTO</b></label>
                                                                            <input type="text" name="NumeroPrenotazione" id="NumeroPrenotazione" class="form-control" value="<?=$NumeroPrenotazione?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4"> 
                                                                        <div class="form-group">
                                                                            <label for="" class="control-label"><b>Prefisso o numerazione derivata</b></label>
                                                                            <input type="text" name="Prefisso" id="Prefisso" placeholder="Inserire riferimento prenotazione in possesso!" class="form-control" value="<?=$Prefisso?>" required >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row m-t-10">
                                                                    <div class="col-md-4"> 
                                                                        <div class="form-group">
                                                                            <label for="" class="control-label"><b>Operatore</b></label>
                                                                                <select name="ChiPrenota" id="ChiPrenota" class="form-control" required>
                                                                                    <?=$Operatori?>
                                                                                </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label  class="control-label"><b>Email Operatore</b></label>
                                                                            <select id="EmailSegretaria" name="EmailSegretaria" class="form-control" required>
                                                                                <option value="0">Attendere...</option>
                                                                                <?=$EmailAssociata ?>
                                                                            </select>
                                                                        </div>                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card bg_blocchi_proposta" id="clienti">
                                                            <div class="card-block">
                                                                <h5 class="text-primary f-w-600">Dati Clienti</h5>      
                                                                <div class="row m-t-10">
                                                                    <div class="col-md-4"> 
                                                                        <div  class="form-group">
                                                                            <label  class="control-label"><b>Nome</b></label>                                                                          
                                                                            <input type="text" name="Nome" id="Nome" class="form-control" value="<?=$Nome?>" required>                                                                           
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label  class="control-label"><b>Cognome</b></label>
                                                                            <input type="text" name="Cognome" id="Cognome" class="form-control" value="<?=$Cognome?>" required>
                                                                        </div>                                                        
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label  class="control-label"><b>Email</b></label>
                                                                            <input type="email" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,}" required name="Email" id="Email" class="form-control" value="<?=$Email?>">
                                                                        </div>                                                                                                                          
                                                                    </div>
                                                                </div>
                                                                <div class="row m-t-10">
                                                                    <div class="col-md-4"> 
                                                                        <div class="form-group">
                                                                            <label for="NumeroPrenotazione" class="control-label"><b>Prefisso Internazionale</b></label>
                                                                            <select id="PrefissoInternazionale" name="PrefissoInternazionale" class="form-control"  required>
                                                                                <?=$ListaPrefissi?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label  class="control-label"><b>Telefono Mobile</b> <i class="fa fa-question-circle" data-toggle="tooltip" title="" aria-hidden="true" data-original-title="Per inviare messaggi da WhatsApp è necessario l'utilizzo di WhatsApp Business, altrimenti bisogna inserire il numero del cliente nella rubrica"></i></label>
                                                                            <input type="text" name="Cellulare" id="Cellulare" class="form-control" value="<?=$Cellulare?>">
                                                                        </div>                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="row m-t-10">
                                                                    <div class="col-md-8">
                                                                        <div class="form-group">
                                                                            <label  class="control-label"><b>Target Cliente</b></label>
                                                                                <select name="TipoVacanza_" id="TipoVacanza_" class="js-example-basic-multiple form-control TipoVacanza" multiple="multiple" required>
                                                                                    <?=$target?>
                                                                                </select>
                                                                                <input type="hidden" name="TipoVacanza" id="TipoVacanza" value="<?=$TipoVacanza?>">
                                                                        </div>                                                        
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                        <div class="card bg_blocchi_proposta" id="prenotazione">
                                                            <div class="card-block">
                                                                <h5 class="text-primary f-w-600">Dati Prenotazione  <text id="notti"></text>  </h5>
                                                                <div class="row m-t-10">
                                                                    <div class="col-md-4"> 
                                                                        <div class="form-group">
                                                                            <label for="DataArrivo" class="control-label"><b>Data di Arrivo</b></label>
                                                                            <input type="date" name="DataArrivo" id="DataArrivo" class="form-control" value="<?=$DataArrivo?>" min="<?=$DataDiOggi?>" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label class="control-label"><b>Data di Partenza</b></label>
                                                                            <input type="date" name="DataPartenza" id="DataPartenza" class="form-control" value="<?=$DataPartenza?>" min="<?=$DataDiDomani?>" required>
                                                                        </div>                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="row m-t-10">
                                                                    <div class="col-md-2"> 
                                                                        <div class="form-group">
                                                                            <label class="control-label"><b>Numero Adulti</b></label>            
                                                                                <select name="NumeroAdulti" id="NumeroAdulti" class="form-control" required>
                                                                                    <?=$NumeroAdulti?>
                                                                                </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="form-group">
                                                                            <label  class="control-label"><b>Numero Bambini</b></label>
                                                                                <select name="NumeroBambini" id="NumeroBambini" class="form-control">
                                                                                    <?=$NumeroBambini?>
                                                                                </select>
                                                                        </div>                                                        
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <div class="row">
                                                                            <div class="col-md-2">
                                                                                <div class="form-group" id="EtaBambini1" style="display:none">
                                                                                    <label for="etaBambini"><b>Età 1°</b></label>
                                                                                    <select id="EtaB1" name="EtaBambini1" class="form-control">
                                                                                        <option value="" selected="selected">--</option>
                                                                                        <?=$etaBimbi1?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <div class="form-group" id="EtaBambini2" style="display:none">
                                                                                    <label for="etaBambini"><b>Età 2°</b></label>
                                                                                    <select id="EtaB2" name="EtaBambini2" class="form-control">
                                                                                        <option value="" selected="selected">--</option>
                                                                                        <?=$etaBimbi2?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <div class="form-group" id="EtaBambini3" style="display:none">
                                                                                    <label for="etaBambini"><b>Età 3°</b></label>
                                                                                    <select id="EtaB3" name="EtaBambini3" class="form-control">
                                                                                        <option value="" selected="selected">--</option>
                                                                                        <?=$etaBimbi3?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <div class="form-group" id="EtaBambini4" style="display:none">
                                                                                    <label for="etaBambini"><b>Età 4°</b></label>
                                                                                    <select id="EtaB4" name="EtaBambini4" class="form-control">
                                                                                        <option value="" selected="selected">--</option>
                                                                                        <?=$etaBimbi4?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <div class="form-group" id="EtaBambini5" style="display:none">
                                                                                    <label for="etaBambini"><b>Età 5°</b></label>
                                                                                    <select id="EtaB5" name="EtaBambini5" class="form-control">
                                                                                        <option value="" selected="selected">--</option>
                                                                                        <?=$etaBimbi5?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <div class="form-group" id="EtaBambini6" style="display:none">
                                                                                    <label for="etaBambini"><b>Età 6°</b></label>
                                                                                    <select id="EtaB6" name="EtaBambini6" class="form-control">
                                                                                        <option value="" selected="selected">--</option>
                                                                                        <?=$etaBimbi6?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>                                                                   
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card bg_blocchi_proposta" id="informazioni">
                                                                <div class="card-block">
                                                                <h5 class="text-primary f-w-600">Informazioni</h5>
                                                                <div class="row m-t-10">
                                                                    <div class="col-md-4"> 
                                                                        <div class="form-group">
                                                                            <label class="control-label"><b>Fonte Prenotazione</b></label>            
                                                                                <select name="FontePrenotazione" id="FontePrenotazione" class="form-control" required>
                                                                                    <?=$ListaFonti?>
                                                                                </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                     
                                                                    </div>
                                                                </div>


                                                                <?=$content;?>   
                                                                <? include_module('backtop.inc.php'); ?> 
                                                            </div>
                                                        </div>

                                                    </div> 
                                                    <div class="col-md-3"></div>
                                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </div>

    <?php echo $js; ?>
    <!-- /.content -->
    <? include_module('footer.inc.php'); ?>