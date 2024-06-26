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
          Timeline
          <span>&#10230;</span> <small> linea temporale delle operazioni compiute </small>
        </h2>
        <div class="row">
          <div class="col-md-10">
            <h2> Operazioni compiute per: <span class="text-blue">
                <?=$Cognome?>
                <?=$Nome?></span></h2>
          </div>
          <div class="col-md-2" style="padding:20px 40px 0px 0px;text-align:right">
            <a class="btn btn-warning" href="javascript:history.back(-1);"><i class="fa fa-arrow-left"></i> Torna
              indietro</a>
          </div>
        </div>

        <ul class="timeline">
          <li class="time-label">
            <span class="bg-red">
              <?=$DataRichiesta?>
            </span>
          </li>
          <li>
            <i class="fa fa-envelope bg-blue"></i>
            <div class="timeline-item">
              <h3 class="timeline-header"><b>Richiesta di preventivo</b>
                <?=($valore_provenienza!=''?'&nbsp;&nbsp;&nbsp;<small>Percorso referer : <b>'.$valore_provenienza.'</b></small>':'')?>
              </h3>
              <div class="timeline-body">
                Arrivo della richiesta <b>N°
                  <?=$NumeroPrenotazione?></b>
              </div>
            </div>
          </li>
          <? if($DataInvio==''){?>
              <li class="time-label">
                <span class="bg-gray">
                  <small class="text-white">Non inviato</small>
                </span>
              </li>
              <li>
                <i class="fa fa-table bg-gray text-white"></i>
                <div class="timeline-item bg-gray">
                  <h3 class="timeline-header no-border text-white">Proposta soggiorno</h3>
                </div>
              </li>
          <?}else{?>
              <li class="time-label">
                <span class="bg-green">
                  <?=$DataInvio?>
                </span>
              </li>
              <li>
                <i class="fa fa-table bg-aqua"></i>
                <div class="timeline-item">
                  <h3 class="timeline-header no-border"><b>Proposta soggiorno</b></h3>
                  <div class="timeline-body">
                    Inviato il preventivo con proposta/e di soggiorno <?=($MetodoInvio_p != '' ? '<small>(Tramite: '.$MetodoInvio_p.')</small>' : '')?>
                  </div>
                </div>
              </li>
              <li>
                <i class="fa fa-pause bg-red"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fa fa-clock-o"></i> Scadenza il:
                    <?=$DataScad?></span>
                  <h3 class="timeline-header"> <b>Stand by:</b> in attesa della conferma della proposta da parte del
                    cliente</h3>

                </div>
              </li>
          <?}?>
          <? if($DataScadenza=='' && $DataInvioCC == ''){?>
              <li class="time-label">
                <span class="bg-gray">
                  <small class="text-white">Non inviata</small>
                </span>
              </li>
              <li>
                <i class="fa fa-credit-card bg-gray text-white"></i>
                <div class="timeline-item bg-gray">
                  <h3 class="timeline-header no-border text-white">Conferma in attesa</h3>
                </div>
              </li>
          <?}else{?>
              <li class="time-label">
                <span class="bg-light-blue">
                  <?=$DataInvioCT?>
                </span>
              </li>
              <li>
                <i class="fa fa-credit-card bg-yellow"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fa fa-clock-o"></i> Scadenza il:
                    <?=$DataScadenza?></span>
                  <h3 class="timeline-header"><b>Conferma in attesa ...</b></h3>
                  <div class="timeline-body">
                    Inviata conferma in attesa del pagamento acconto per il soggiorno <?=($MetodoInvio_c != '' ? '<small>(Tramite: '.$MetodoInvio_c.')</small>' : '')?>
                  </div>

                </div>
              </li>
          <?}?>
          <?=$chat?>
          <?=$upselling?>
          <?=$buono_voucher?>
          <? if($DataInvioCC == ''){ ?>
              <li class="time-label">
                <span class="bg-gray">
                  <small class="text-white">Non chiusa</small>
                </span>
              </li>
              <li>
                <i class="fa fa-h-square bg-gray text-white"></i>
                <div class="timeline-item bg-gray">
                  <h3 class="timeline-header no-border text-white">Prenotazione chiusa</h3>
                </div>
              </li>
          <?}else{?>
              <li class="time-label">
                <span class="bg-teal">
                  <?=$DataInvioCC ?>
                </span>
              </li>
              <li>
                <i class="fa fa-h-square bg-purple"></i>
                <div class="timeline-item">
                  <h3 class="timeline-header no-border"><b>Prenotazione chiusa</b></h3>
                </div>
              </li>
          <?}?>
          <? if($DataCheckOut_val == 1 || $DataCheckOut  == ''){ ?>
              <li class="time-label">
                <span class="bg-gray">
                  <small class="text-white">No Out</small>
                </span>
              </li>
              <li>
                <i class="fa fa-sign-out bg-gray text-white"></i>
                <div class="timeline-item bg-gray">
                  <h3 class="timeline-header no-border text-white">Check Out</h3>
                </div>
              </li>
          <?}else{?>
              <li class="time-label">
                <span class="bg-maroon">
                  <?=$DataCheckOut ?>
                </span>
              </li>
              <li>
                <i class="fa fa-sign-out bg-blue"></i>
                <div class="timeline-item">
                  <h3 class="timeline-header"><b>Check Out</b></h3>
                  <div class="timeline-body">
                    Il <small>Sig.re/ra</small> <b>
                      <?=$Cognome?>
                      <?=$Nome?></b> ha lasciato la nostra struttura
                  </div>
                </div>
              </li>
          <?}?>
          <? if($DataInvioCQ ==''){?>
              <li>
                <i class="fa fa-question bg-gray text-white"></i>
                <div class="timeline-item bg-gray">
                  <h3 class="timeline-header no-border text-white">Questionario</h3>
                </div>
              </li>
          <?}else{?>
              <li>
                <i class="fa fa-question bg-yellow"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fa fa-clock-o"></i> Data di invio:
                    <?=$DataInvioCQ ?></span>
                  <h3 class="timeline-header"><b>Questionario</b></h3>
                  <div class="timeline-body">
                    Invio del questionario per la Customer Satisfaction
                  </div>
                </div>
              </li>
          <?}?>
          <li>
            <i class="fa fa-clock-o bg-gray"></i>
          </li>
        </ul>
      </div>
    </div>
  </section><!-- /.content -->

</div><!-- ./wrapper -->
<?php include_module('footer.inc.php'); ?>