<? include_module('header.inc.php'); ?>

<? include_module('navbar.inc.php'); ?>

<? include_module('sidebar.inc.php'); ?>
<?=$js_script?>
<div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                <? include_module('breadcrumb.inc.php'); ?>
                                    <div class="page-body">
                                    <div class="card">
                                                <div class="card-block">

                                                      <div class="row">
                                                      <?php include(BASE_PATH_SITO.'newsletter/include/template/moduli/menu.inc.php');?>
                                                          <div class="col-md-10">
                                                          <h2>ANTEPRIMA MODELLO <?=NOME_CLIENT_EMAIL?></h2>
                                                          <div class="radius6" style="padding:10px"><?php echo $dati['template']; ?></div>       
                                                          </div>
                                                      </div>
                                                    <? include_module('backtop.inc.php'); ?> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

    <!-- /.content -->
    <? include_module('footer.inc.php'); ?>