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
                                                <div class="card-block">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <h2 class="page-header">
                                                            <?=$icona_carta?> &nbsp;
                                                            <?=$Nome.' '.$Cognome?>
                                                        </h2>
                                                    </div><!-- /.col -->
                                                    <div class="col-md-4">
                                                        <div class="text-right">
                                                            <a class="btn btn-warning" href="<?=BASE_URL_SITO.$link?>"><i class="fa fa-arrow-left"></i>
                                                                Torna indietro </a>
                                                        </div>
                                                    </div><!-- /.col -->
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <? echo check_conferma($_REQUEST['id_richiesta'])?>
                                                    </div><!-- /.col -->
                                                </div>
                                                <br><br>
                                                <div class="row" id="attention">
                                                    <div class="col-md-12">
                                                        <?if($visibile == 1 && $Dvisibile == 1){?>
                                                        <div class="col-md-1">
                                                            <b>ATTENZIONE:</b>
                                                        </div>
                                                        <div class="col-md-11">
                                                            <b>In base alle nuove Informative</b><br>
                                                            Se saranno trascorsi 12 Mesi o più dal
                                                            <?=$DataInserimento?>, (<em>data di inserimento della Carta di Credito</em>), i dati (<em>Carta,
                                                                Num.Carta, Scadenza,CVV</em>) verranno automaticamente eliminati.<br>
                                                            Se invece desiderate o avete la neccessità di eliminarli prima di questo termine, potete
                                                            agire sul pulsante "<b>Elimina i dati della Carta di Credito</b>".
                                                        </div>
                                                        <?}else{?>
                                                        <div class="col-md-1">
                                                            <b>ATTENZIONE:</b>
                                                        </div>
                                                        <div class="col-md-11">
                                                            <?if($Dvisibile == 0){?>
                                                            Sono trascorsi 12 Mesi o più dal
                                                            <?=$DataInserimento?>, (<em>data di inserimento della Carta di Credito</em>), quindi i dati
                                                            sono stati eliminati automaticamente dal software!<br>
                                                            <?}else{?>
                                                            Avete scelto voi l'opzione di eliminare i dati della Carta di Credito prima dei 24 mesi!
                                                            <?}?>
                                                        </div>
                                                        <?}?>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-6 table-responsive">
                                                        <table class="table">
                                                            <tr>
                                                                <th style="width:50%">N. Rif. Conferma soggiorno</th>
                                                                <td>
                                                                    <?=$IdRichiesta?>/
                                                                    <?=$NumeroPrenotazione?>
                                                                </td>
                                                            </tr>
                                                            <? if($acconto!=''){?>
                                                            <tr>
                                                                <th style="width:50%">Caparra da prelevare</th>
                                                                <td>
                                                                    <?=$acconto?>
                                                                </td>
                                                            </tr>
                                                            <?}?>
                                                            <tr>
                                                                <th style="width:50%">Nome e Cognome dell'intestatario del Soggiorno</th>
                                                                <td>
                                                                    <?=$Nome.' '.$Cognome?>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <?if($visibile == 1 && $Dvisibile == 1){?>
                                                            <table class="table" id="view_cc">
                                                                <tr>
                                                                    <th style="width:50%">Data dell'inserimento dati carta di Credito:</th>
                                                                    <td>
                                                                        <?=$DataInserimento?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th style="width:50%">Carta:</th>
                                                                    <td>
                                                                        <?=ucfirst($Carta)?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th style="width:50%">Numero Carta:</th>
                                                                    <td>
                                                                        <?=$NumeroCarta_hidden?>
                                                                        <div id="visible" style="display:none">
                                                                            <?=$NumeroCarta?>
                                                                        </div>
                                                                        <?=$script_hide_cc?>
                                                                    </td>
                                                                <tr>
                                                                    <th>Intestatario Carta:</th>
                                                                    <td>
                                                                        <?=$Intestatario?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Scadenza:</th>
                                                                    <td>
                                                                        <?=$Scadenza?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Codice CVV2 </th>
                                                                    <td>
                                                                        <?=$CVV?>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <button type="button" class="btn btn-default" id="del_cc"><i class="fa fa-times-circle text-red"></i>
                                                                        Elimina i dati della Carta di Credito</button>
                                                                </div>
                                                            </div>
                                                            <?=$script_change_view?>
                                                        <?}?>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h3>Check Card <small>controlla il numero di carta</small></h3>
                                                        <section>
                                                            <?=$script_skeuocard_top?>
                                                            <!-- START FORM -->
                                                            <div class="credit-card-input no-js" id="skeuocard">
                                                                <p class="no-support-warning">
                                                                    Probabilmente hai il javascript disabilitato, oppure stai usando un browser che non
                                                                    supporta lo script!
                                                                </p>
                                                                <label for="cc_type">Card Type</label>
                                                                <select name="cc_type">
                                                                    <option value="">...</option>
                                                                    <option value="visa">Visa</option>
                                                                    <option value="discover">Discover</option>
                                                                    <option value="mastercard">MasterCard</option>
                                                                    <option value="maestro">Maestro</option>
                                                                    <option value="jcb">JCB</option>
                                                                    <option value="unionpay">China UnionPay</option>
                                                                    <option value="amex">American Express</option>
                                                                    <option value="dinersclubintl">Diners Club</option>
                                                                </select>
                                                                <label for="cc_number">Card Number</label>
                                                                <input type="text" name="cc_number" id="cc_number" placeholder="XXXX XXXX XXXX XXXX"
                                                                    maxlength="19" size="19">
                                                                <label for="cc_exp_month">Expiration Month</label>
                                                                <input type="text" name="cc_exp_month" id="cc_exp_month" placeholder="00">
                                                                <label for="cc_exp_year">Expiration Year</label>
                                                                <input type="text" name="cc_exp_year" id="cc_exp_year" placeholder="00">
                                                                <label for="cc_name">Cardholder's Name</label>
                                                                <input type="text" name="cc_name" id="cc_name" placeholder="John Doe">
                                                                <label for="cc_cvc">Card Validation Code</label>
                                                                <input type="text" name="cc_cvc" id="cc_cvc" placeholder="123" maxlength="3" size="3">
                                                            </div>
                                                            <!-- END FORM -->
                                                            <?=$script_skeuocard?>
                                                        </section>
                                                    </div>
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