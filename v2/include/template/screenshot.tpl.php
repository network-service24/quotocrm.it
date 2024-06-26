<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
  <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
  <section class="content">
    <div class="box radius6">
      <div class="box-body">
        <h2> Screenshot di esempio di
          <?=NOME_AMMINISTRAZIONE?>
          <?=VERSIONE?>
          <span>&#10230;</span> <small>
            <?=NAME_ADMIN?></small></h2>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box  no-border">
              <div class="box-header with-border">
                <h3 class="box-title">Screenshot d'esempio</h3>: naturalmente i contenuti che vedete sono un fac
                simile!
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="box-group" id="accordion">
                  <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                  <div class="panel box box-success">
                    <div class="box-header with-border">
                      <h4 class="box-title">
                        <a class="collapsed" aria-expanded="false" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                          La mail che riceve il cliente inviata dall'area Preventivi
                        </a>
                      </h4>
                    </div>
                    <div aria-expanded="true" id="collapseOne" class="panel-collapse collapse in">
                      <div class="box-body">
                        <img src="<?=BASE_URL_SITO?>img/1.jpg">
                      </div>
                    </div>
                  </div>
                  <div class="panel box box-success">
                    <div class="box-header with-border">
                      <h4 class="box-title">
                        <a aria-expanded="false" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                          La landing page dedicata al cliente che presenta le proposte di soggiorno
                        </a>
                      </h4>
                    </div>
                    <div aria-expanded="false" id="collapseTwo" class="panel-collapse collapse">
                      <div class="box-body">
                        <img src="<?=BASE_URL_SITO?>img/2.jpg">
                      </div>
                    </div>
                  </div>
                  <div class="panel box box-success">
                    <div class="box-header with-border">
                      <h4 class="box-title">
                        <a aria-expanded="false" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                          La mail che riceve il cliente e l'operatore dove viene indicata la scelta che il cliente ha
                          effettuata dalla landing page
                        </a>
                      </h4>
                    </div>
                    <div aria-expanded="false" id="collapseThree" class="panel-collapse collapse">
                      <div class="box-body">
                        <div class="row">
                          <div class="col-md-6">
                            Copia Cliente<br>
                            <img src="<?=BASE_URL_SITO?>img/3.jpg">
                          </div>
                          <div class="col-md-6">
                            Hotel<br>
                            <img src="<?=BASE_URL_SITO?>img/3.1.jpg">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="panel box box-success">
                    <div class="box-header with-border">
                      <h4 class="box-title">
                        <a class="collapsed" aria-expanded="false" data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                          La mail che riceve il cliente inviata dall'area Conferme
                        </a>
                      </h4>
                    </div>
                    <div style="height: 0px;" aria-expanded="false" id="collapse4" class="panel-collapse collapse">
                      <div class="box-body">
                        <img src="<?=BASE_URL_SITO?>img/4.jpg">
                      </div>
                    </div>
                  </div>
                  <div class="panel box box-success">
                    <div class="box-header with-border">
                      <h4 class="box-title">
                        <a aria-expanded="false" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                          La landing page dedicata al cliente al quale viene confermata definitavemente la sua scelta
                          di soggiorno
                        </a>
                      </h4>
                    </div>
                    <div aria-expanded="false" id="collapse5" class="panel-collapse collapse">
                      <div class="box-body">
                        <img src="<?=BASE_URL_SITO?>img/5.jpg">
                      </div>
                    </div>
                  </div>
                  <div class="panel box box-success">
                    <div class="box-header with-border">
                      <h4 class="box-title">
                        <a aria-expanded="false" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse5_1">
                          La mail che riceve il l ciente dopo aver reso la conferma in attesa una prenotazione chiusa
                        </a>
                      </h4>
                    </div>
                    <div aria-expanded="false" id="collapse5_1" class="panel-collapse collapse">
                      <div class="box-body">
                        <img src="<?=BASE_URL_SITO?>img/5.1.jpg">
                      </div>
                    </div>
                  </div>
                  <div class="panel box box-success">
                    <div class="box-header with-border">
                      <h4 class="box-title">
                        <a aria-expanded="false" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse6">
                          La landing page dedicata al cliente per il Voucher di riepilogo che il cliente può stampare
                          come promemoria
                        </a>
                      </h4>
                    </div>
                    <div aria-expanded="false" id="collapse6" class="panel-collapse collapse">
                      <div class="box-body">
                        <img src="<?=BASE_URL_SITO?>img/6.jpg">
                      </div>
                    </div>
                  </div>
                  <div class="panel box box-success">
                    <div class="box-header with-border">
                      <h4 class="box-title">
                        <a class="collapsed" aria-expanded="false" data-toggle="collapse" data-parent="#accordion" href="#collapse7">
                          La mail che riceve il cliente e che lo invita a compilare il questionario di soddisfazione
                        </a>
                      </h4>
                    </div>
                    <div style="height: 0px;" aria-expanded="false" id="collapse7" class="panel-collapse collapse">
                      <div class="box-body">
                        <img src="<?=BASE_URL_SITO?>img/7.jpg">
                      </div>
                    </div>
                  </div>
                  <div class="panel box box-success">
                    <div class="box-header with-border">
                      <h4 class="box-title">
                        <a aria-expanded="false" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse8">
                          La landing page dedicata al cliente per rispondere al questionare di Customer Satisfaction
                        </a>
                      </h4>
                    </div>
                    <div aria-expanded="false" id="collapse8" class="panel-collapse collapse">
                      <div class="box-body">
                        <img src="<?=BASE_URL_SITO?>img/8.jpg">
                      </div>
                    </div>
                  </div>
                  <div class="panel box box-success">
                    <div class="box-header with-border">
                      <h4 class="box-title">
                        <a aria-expanded="false" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse7_1">
                          La mail che riceve il cliente ogni qualvolta che l'operatore risponde ad una chat
                        </a>
                      </h4>
                    </div>
                    <div aria-expanded="false" id="collapse7_1" class="panel-collapse collapse">
                      <div class="box-body">
                        <img src="<?=BASE_URL_SITO?>img/7.1.jpg">
                      </div>
                    </div>
                  </div>
                  <div class="panel box box-success">
                    <div class="box-header with-border">
                      <h4 class="box-title">
                        <a aria-expanded="false" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse9">
                          La mail che riceve il cliente e che lo invita a compilare il modulo di Check-In OnLine
                        </a>
                      </h4>
                    </div>
                    <div aria-expanded="false" id="collapse9" class="panel-collapse collapse">
                      <div class="box-body">
                        <img src="<?=BASE_URL_SITO?>img/9.jpg">
                      </div>
                    </div>
                  </div>
                  <div class="panel box box-success">
                    <div class="box-header with-border">
                      <h4 class="box-title">
                        <a aria-expanded="false" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse9_1">
                          La landing page dedicata al cliente per compilare il modulo di Check-In OnLine
                        </a>
                      </h4>
                    </div>
                    <div aria-expanded="false" id="collapse9_1" class="panel-collapse collapse">
                      <div class="box-body">
                        <div class="row">
                          <div class="col-md-6">
                            <img src="<?=BASE_URL_SITO?>img/9.1.jpg">
                          </div>
                          <div class="col-md-6">
                            <img src="<?=BASE_URL_SITO?>img/9.2.jpg">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- /.box-body -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php include_module('footer.inc.php'); ?>