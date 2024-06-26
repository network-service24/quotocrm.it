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
          Gestione Tickets
          <span>&#10230;</span> <small>apri un ticket</small>
        </h2>
        <?=$css?>
        <div class="alert alert-default alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <div class="row">
            <div class="col-md-1"><i class="fa fa-exclamation-triangle fa-3x text-info"></i></div>
            <div class="col-md-10">
              I ticket aperti, verranno elaborati entro 12/48 dalla data di invio del ticket stesso. La creazione del
              ticket vi verrà confermata con una e-mail.!!<br>
              Nel momento in cui, l'operatore dedicato, risponderà al vostro ticket in fase di <b>"Lavorazione"</b>, il
              ticket verrà <b>"Chiuso"</b> e la conferma vi sarà notifcata tramite una e-mail di riepilogo.<br>
              Se la vostra richiesta dovesse risultare troppo complessa da risolvere con un unico ticket..., potete
              riaprire tutti i ticket che volete senza limiti di numero.
            </div>
          </div>
        </div>

        <? echo $xcrud_suiteweb->render(); ?>
        <?=$js_script?>
      </div>
    </div>
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php include_module('footer.inc.php'); ?>