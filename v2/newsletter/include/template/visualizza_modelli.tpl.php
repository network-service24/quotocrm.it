<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
<?php include(BASE_PATH_SITO.'newsletter/include/template/moduli/breadcrumb.inc.php') ?>
  <section class="content">
    <div class="box radius6">
      <div class="box-body">

        <div class="row">
          <?php include(BASE_PATH_SITO.'newsletter/include/template/moduli/menu.inc.php');?>
            <div class="col-md-10">
            <h2>VISUALIZZA MODELLI <?=NOME_CLIENT_EMAIL?></h2>
            <table id="TabellaLayout" class="xcrud-list table table-striped table-hover table-bordered table-sm">
                <thead>
                    <tr class="xcrud-th">
                        <th class="th-sm" style="width:50%">Nome Modello</th>
                        <th class="th-sm text-center" style="width:5%">Lingua</th>
                        <th class="th-sm text-center" style="width:5%">Preview</th>
                        <th class="th-sm text-center" style="width:5%">Modifica</th>
                        <th class="th-sm text-center" style="width:5%">Elimina</th>
                    </tr>
                </thead>
                <?php echo $content; ?>
            </table>
            <script>
                $(document).ready(function () {
                    $('#TabellaLayout').DataTable({
                        "paging": true // false to disable pagination (or any other option)
                    });
                    $('.dataTables_length').addClass('bs-select');
                });
            </script>
            </div>
        </div>
      </div>
    </div>
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php include_module('footer.inc.php'); ?>