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
                                                <h5>Timeline: linea temporale delle operazioni compiute</h5>  
                                            </div>
                                                <div class="card-block latest-update-card">
                                                    <div class="row">
                                                    <div class="col-md-10">
                                                        <h2> Operazioni compiute per: <span class="text-blue">
                                                            <?=$Cognome?>
                                                            <?=$Nome?></span></h2>
                                                    </div>
                                                    <div class="col-md-2" style="padding:20px 40px 0px 0px;text-align:right">
                                                        <a class="btn btn-warning btn-sm" href="javascript:history.back(-1);"><i class="fa fa-arrow-left"></i> Torna
                                                        indietro</a>
                                                    </div>
                                                    </div>
                                                        <div class="latest-update-box">
                                                            <div class="row p-b-15">
                                                                <div class="col-auto text-right update-meta">
                                                                    <p class="text-muted m-b-0 d-inline"><?=$DataRichiesta?></p>
                                                                    <i class="p-l-10 fa-2x fa fa-briefcase text-primary  update-icon"></i>
                                                                </div>
                                                                <div class="col">
                                                                    <h6 class="text-black"><b>Richiesta di preventivo</b><?=($valore_provenienza!=''?'&nbsp;&nbsp;&nbsp;<small>Percorso referer : <b>'.$valore_provenienza.'</b></small>':'')?></h6>
                                                                    <p class="text-muted m-b-0"> Arrivo della richiesta <b>N°<?=$NumeroPrenotazione?></b></p>
                                                                </div>
                                                            </div>
                                                    <hr>    
                                                    <? if($DataInvio==''){?>
                                                            <div class="row p-b-15">
                                                                <div class="col-auto text-right update-meta">
                                                                    <p class="text-muted m-b-0 d-inline">Non inviato</p>
                                                                    <i class="p-l-10 fa-2x fa fa-send-o text-gray  update-icon"></i>
                                                                </div>
                                                                <div class="col">
                                                                    <h6>Proposta soggiorno</h6>
                                                                </div>
                                                            </div>
                                                    <?}else{?>
                                                        <div class="row p-b-15">
                                                                <div class="col-auto text-right update-meta">
                                                                    <p class="text-muted m-b-0 d-inline"><?=$DataInvio?></p>
                                                                    <i class="p-l-10 fa-2x fa fa-send text-primary  update-icon"></i>
                                                                </div>
                                                                <div class="col">
                                                                    <h6>Proposta soggiorno</h6>
                                                                     Inviato il preventivo con proposta/e di soggiorno <?=($MetodoInvio_p != '' ? '<small>(Tramite: '.$MetodoInvio_p.')</small>' : '')?>
                                                                </div>
                                                            </div>
                                                            <div class="row p-b-15">
                                                                <div class="col-auto text-right update-meta">
                                                                    <p class="text-muted m-b-0 d-inline"><?=$DataScad?></p>
                                                                    <i class="p-l-10 fa-2x fa fa-clock-o text-primary  update-icon"></i>
                                                                </div>
                                                                <div class="col">
                                                                    <h6>Scadenza <b>Stand by:</b> in attesa della conferma della proposta da parte del cliente</h6>
                                                                   
                                                                </div>
                                                            </div>
                                                    <?}?>
                                                     <hr>
                                                    <? if($DataScadenza=='' && $DataInvioCC == ''){?>
                                                            <div class="row p-b-15">
                                                                <div class="col-auto text-right update-meta">
                                                                    <p class="text-muted m-b-0 d-inline">Non inviato</p>
                                                                    <i class="p-l-10 fa-2x fa fa-send-o text-gray  update-icon"></i>
                                                                </div>
                                                                <div class="col">
                                                                    <h6>Conferma in attesa</h6>
                                                                </div>
                                                            </div>
                                                    <?}else{?>
                                                           <div class="row p-b-15">
                                                                <div class="col-auto text-right update-meta">
                                                                    <p class="text-muted m-b-0 d-inline"><?=$DataInvioCT?></p>
                                                                    <i class="p-l-10 fa-2x fa fa-credit-card text-primary  update-icon"></i>
                                                                </div>
                                                                <div class="col">
                                                                 <h6><b>Stand by:</b> in attesa della conferma della proposta da parte del cliente</h6>
                                                                      Inviata conferma in attesa del pagamento acconto per il soggiorno <?=($MetodoInvio_c != '' ? '<small>(Tramite: '.$MetodoInvio_c.')</small>' : '')?>
                                                                   
                                                                </div>
                                                            </div>
                                                            <div class="row p-b-15">
                                                                <div class="col-auto text-right update-meta">
                                                                    <p class="text-muted m-b-0 d-inline">
                                                                <?=$DataScadenza?></p>
                                                                    <i class="p-l-10 fa-2x fa fa-clock-o text-primary  update-icon"></i>
                                                                </div>
                                                                <div class="col">
                                                                        <h6>Scadenza della Conferma in attesa ...</h6>
                                                                </div>
                                                            </div>
                                                    <?}?>
                                                     <hr>
                                                    <?=$chat?>

                                                    <?=$upselling?>

                                                    <?=$buono_voucher?>

                                                    <? if($DataInvioCC == ''){ ?>
                                                            <div class="row p-b-15">
                                                                <div class="col-auto text-right update-meta">
                                                                    <p class="text-muted m-b-0 d-inline  p-r-10">Non chiusa</p>
                                                                    <i class="p-l-10 fa-2x fa fa-key text-gray  update-icon"></i>
                                                                </div>
                                                                <div class="col">
                                                                    <h6>Prenotazione non confermata</h6>
                                                                </div>
                                                            </div>
                                                    <?}else{?>

                                                            <div class="row p-b-15">
                                                                <div class="col-auto text-right update-meta">
                                                                    <p class="text-muted m-b-0 d-inline">  <?=$DataInvioCC ?></p>
                                                                    <i class="p-l-10 fa-2x fa fa-key text-primary  update-icon"></i>
                                                                </div>
                                                                <div class="col">
                                                                        <h6>Prenotazione confermata</h6>
                                                                </div>
                                                            </div>

                                                    <?}?>
                                                     <hr>
                                                    <? if($DataCheckOut_val == 1 || $DataCheckOut  == ''){ ?>

                                                            <div class="row p-b-15">
                                                                <div class="col-auto text-right update-meta">
                                                                    <p class="text-muted m-b-0 d-inline  p-r-10">No Out</p>
                                                                    <i class="p-l-10 fa-2x fa fa-calendar text-gray  update-icon"></i>
                                                                </div>
                                                                <div class="col">
                                                                    <h6>Check Out</h6>
                                                                </div>
                                                            </div>
                                                    <?}else{?>

                                                            <div class="row p-b-15">
                                                                <div class="col-auto text-right update-meta">
                                                                    <p class="text-muted m-b-0 d-inline"><?=$DataCheckOut ?></p>
                                                                    <i class="p-l-10 fa-2x fa fa-calendar text-primary  update-icon"></i>
                                                                </div>
                                                                <div class="col">
                                                                        <h6>Check Out</h6>
                                                                  Il <small>Sig.re/ra</small> <b>
                                                                <?=$Cognome?>
                                                                <?=$Nome?></b> ha lasciato la nostra struttura
                                                                </div>
                                                            </div>                                                     

                                                    <?}?>
                                                     <hr>
                                                    <? if($DataInvioCQ ==''){?>
                                                           <div class="row p-b-15">
                                                                <div class="col-auto text-right update-meta">
                                                                    <p class="text-muted m-b-0 d-inline  p-r-10">Questionario</p>
                                                                    <i class="p-l-10 fa-2x fa fa-star text-gray  update-icon"></i>
                                                                </div>
                                                            </div>
                                                    <?}else{?>
                                                    
                                                            <div class="row p-b-15">
                                                                <div class="col-auto text-right update-meta">
                                                                    <p class="text-muted m-b-0 d-inline"><?=$DataInvioCQ ?></p>
                                                                    <i class="p-l-10 fa-2x fa fa-star text-primary  update-icon"></i>
                                                                </div>
                                                                <div class="col">
                                                                        <h6>Data di invio Questionario</h6>
                                                                    Invio del questionario per la Customer Satisfaction
                                                                </div>
                                                            </div>   
  
                                                    <?}?>


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