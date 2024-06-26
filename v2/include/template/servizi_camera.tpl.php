<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
  <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
  <section class="content">
    <div class="box radius6">
      <div class="box-body">
        <h5><i class="fa fa-exclamation-triangle text-red"></i> Non inserire punteggiatura o caratteri speciali nella
          descrizione del servizio in camera! Comuqnue il software li rimuoverà per voi!</h5>
          <h5><i class="fa fa-exclamation-triangle text-red"></i> ATTENZIONE: Se modificate l'etichetta di un servizio dopo che questo è stato già associato ad una camera, andrebbe ri-associato alla camera stessa, eliminando l'associazione della vecchia etichetta , sostituendo l'associazione con il nuovo servizio modificato!</h5>
          <h5><i class="fa fa-exclamation-triangle text-red"></i> ATTENZIONE: Le etichette che definiscono il servizio; quella che identifica il nome al servizio e l'etichetta in lingua Italiana devono corrispondere, altrimenti non vengono visualizzate!</h5>
          <?php   echo $xcrud->render(); ?>
      </div>
    </div>
  </section><!-- /.content -->
</div><!-- ./wrapper -->
<?php include_module('footer.inc.php'); ?>