<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
  <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
  <section class="content">
    <div class="box radius6">
      <div class="box-body">
        <h2> Se il sito utilizza il form creato da QUOTO!</h2>
           <h3> il checkbox "API di QUOTO" deve essere flaggato (Si) <span>&#10230;</span>  <small>questa opzione permette la gestione dei trattamenti e/o tipologia camere per il form direttamente da QUOTO!</small></h3>
          <?php   echo $xcrud_suiteweb->render(); ?>

          <h2>Abilita le lingue per il Form dedicato al tuo Sito Web e/o Landing Page<span>&#10230;</span> <small>Abilita le lingue</small></h2>
          <div class="alert alert-profila alert-default-profila alert-dismissable text-black">
            <div class="text-center">          
            <p class="text-blue"><i class="fa fa-exclamation-triangle text-orange" aria-hidden="true"></i>  Al termine dell'inserimento delle lingue per abilitare il pulsante sul menù di sinistra <b>"Crea Form"</b>, clicca sul pulsante qui sotto!</p>
              <div class="clearfix"></div>
              <button onclick="location.href=<?php echo $_SERVER['REQUEST_URI']?>" class="btn btn-info ">Sync Reload</button>
              <div class="clearfix" style="padding-top:20px"></div>
              <p class="text-blue"><i class="fa fa-exclamation-circle text-info" aria-hidden="true"></i> <small>Se vengono aggiunte lingue dopo aver creato il form, è neccessario eliminare il form attuale e ri-crealo..., è un'operazione di pochi secondi!</small></p>
            </div>
          </div>
          <?php   echo $xcrud->render(); ?>
      </div>
    </div>
  </section><!-- /.content -->
</div><!-- ./wrapper -->
<?php include_module('footer.inc.php'); ?>