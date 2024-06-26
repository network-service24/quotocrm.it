<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
  <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
  <section class="content">
    <div class="box radius6">
      <div class="box-body">

        <?php

          $totale = '';
          $numero_valori = count($output);
          foreach ($output as $key => $value) {
            $totale += $value;
          }
          $media = $totale/$numero_valori;
          echo number_format($media,2,'.',',');
      ?>
      </div>
    </div>
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php include_module('footer.inc.php'); ?>