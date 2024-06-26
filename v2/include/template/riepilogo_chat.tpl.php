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
          Riepilogo di tutta la discussione in Chat
        </h2>
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <div class="row">
              <div class="col-md-10">
                <h3>Nr.Rich: <b class="text-red">
                    <?=$rw['Id']?></b> Nr.Rif: <b class="text-red">
                    <?=$rw['NumeroPrenotazione']?></b> Nome: <b class="text-green">
                    <?=stripslashes($rw['Nome'])?></b> Cognome: <b class="text-green">
                    <?=stripslashes($rw['Cognome'])?></b></h3>
                <div class="clearfix"></div>
                <?=dettaglio_richiesta($rw['NumeroPrenotazione'],$rw['idsito'])?> <br>
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
            <div class="row">
              <div class="col-md-12">
                <div id="balloon">
                  <?=$riepilogo?>
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