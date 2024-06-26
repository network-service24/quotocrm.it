<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
  <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
  <section class="content">
    <div class="box radius6">
      <div class="box-body">
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <div class="row">
              <div class="col-md-10">
                <h3>Nr.Rich: <b class="text-red">
                    <?=$row['Id']?></b> Nr.Rif: <b class="text-red">
                    <?=$row['NumeroPrenotazione']?></b> Nome: <b class="text-green">
                    <?=stripslashes($row['Nome'])?></b> Cognome: <b class="text-green">
                    <?=stripslashes($row['Cognome'])?></b></h3>
                  <div class="clearfix"></div>
                <?=dettaglio_richiesta($row['NumeroPrenotazione'],$row['idsito'])?> <br>
              </div>
              <div class="col-md-2">
                <div class="text-right">
                  <h3>
                    <a class="btn btn-warning" href="javascript:history.back(-1);"><i class="fa fa-arrow-left"></i>
                      Torna indietro </a>
                  </h3>
                </div>
              </div><!-- /.col -->
            </div>
            <? //echo $form_data_scadenza?>
            <div class="row">
              <div class="col-md-12">
                <form id="form_chat" name="form_chat" method="post">
                  <div class="form-group">
                  <label for="op">Cambia operatore <a href="javascript:;" id="attiva_legenda_info_fonti" data-toogle="tooltip" data-html="true" title="<div class=\'text-left\'>Se sei un operatore diverso da chi ha creato il preventivo e/o la conferma,puoi cambiare!</div>"><i class="fa fa-life-ring text-info"></i></a></label>
                    <select class="form-control"name="operatore" id="operatore" >
                      <?=$Operatori?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="Messaggio">Hotel Chat</label>
                    <textarea class="form-control" rows="10" name="chat" id="chat" required></textarea>
                  </div>
                  <input type="hidden" name="id_guest" value="<?=$row['Id']?>">
                  <input type="hidden" name="NumeroPrenotazione" value="<?=$row['NumeroPrenotazione']?>">
                  <input type="hidden" name="user" value="<?=$row['ChiPrenota']?>">
                  <input type="hidden" name="lang" value="<?=$row['Lingua']?>">
                  <input type="hidden" name="idsito" value="<?=$row['idsito']?>">
                  <input type="hidden" name="action" value="add_chat">
                  <button type="submit" class="btn btn-primary" style="float:right!important;" title="<?=$title?>" <?=$command?> >Invia</button>
                </form>
                <?=$js_chat?>
                <?=$js_chat_load?>
                <br><br><br>
                <div id="balloon"></div>
              </div>
            </div>
          </div>
          <div class="col-md-2"></div>
        </div>
      </div>
    </div>
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php include_module('footer.inc.php'); ?>