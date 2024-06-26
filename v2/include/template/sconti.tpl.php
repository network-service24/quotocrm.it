<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
  <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
  <section class="content">
    <div class="box radius6">
      <div class="box-body">

      <?
                        if($_REQUEST['azione'] != '') {
                            echo'<script>$(function() {$("#res_back").fadeOut(2000); })</script>'."\r\n";
                        }
                       if($_REQUEST['azione'] == 'ko') {
                            echo '<div id="res_back" class="alert alert-danger">
                                        <i class="fa fa-warning"></i> Email non inviata!!
                                    </div>';
                        }
                        if($_REQUEST['azione'] == 'ok') {
                            echo '<div id="res_back" class="alert alert-info">
                                        <i class="fa fa-check"></i> Email inviata correttamente.!!
                                    </div>';
                        }  
                    ?>

                    <?php   echo $xcrud2->render(); ?>
                    <?php   echo $xcrud2->stile; ?>
      </div>
    </div>
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php include_module('footer.inc.php'); ?>