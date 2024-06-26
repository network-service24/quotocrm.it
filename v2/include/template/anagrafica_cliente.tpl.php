<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
<?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <!-- Main content -->
    <section class="content">
      <div class="box radius6">
          <div class="box-body">
            <h2>Completa la tua anagrafica</h2>                                                     
            <?php   
                echo $xcrud_suiteweb->render('view',$_REQUEST['azione']); 
                echo $xcrud->render('edit',$_SESSION['idsocial']); 
              ?>
          </div>
      </div> 
    </section><!-- /.content -->
</div><!-- ./wrapper -->
<?php include_module('footer.inc.php'); ?>