<? include_module('header.inc.php'); ?>

<? include_module('navbar.inc.php'); ?>

<? include_module('sidebar.inc.php'); ?>


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
                                                                  <form action="<?=$_SERVER['REQUEST_URI']?>" method="post" name="frminsesrt" id="frminsesrt" >
                                                                    <h2>CREA UN NUOVO MODELLO <?=NOME_CLIENT_EMAIL?></h2>
                                                                    <div class="form-group">
                                                                      <label>Lingua</label>
                                                                      <select name="lingua" id="lingua" class="form-control">
                                                                              <option value="" selected="selected">Scegli una lingua</option>
                                                                              <option value="it">it</option>
                                                                              <option value="en">en</option>
                                                                              <option value="de">de</option>
                                                                              <option value="fr">fr</option>
                                                                          </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                      <label>Nome Modello</label>
                                                                      <input name="nome_template" type="text" class="form-control" id="nome_template" required/>
                                                                    </div>
                                                                    <div class="form-group">
                                                                              <label>Modello Email</label>
                                                                              <div class="alert alert-profila alert-default-profila alert-dismissable">
                                                                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                                  <p> E' possibile personalizzare il contenuto del template inserendo la variabile [cliente] e la variabile [struttura] </p>                                             
                                                                                  <p>Al momento dell'invio dell'email <?=NOME_CLIENT_EMAIL?>, il sistema sostituirà [cliente] con il nome ed il cognome del contatto e [struttura] con l'intestazione della vostra attività.</p>
                                                                              </div> 
                                                                              <!-- <div class="text-right"><small id="preview"><i class="fa fa-picture-o"></i>  Screenshots preview per aiutarti a caricare immagini dentro l'HTMLAREA!</small></div> -->
                                                                        <div class="clearfix"></div>
                                                                              <textarea name="template" class="xcrud-input xcrud-texteditor form-control editor-loaded"  id="template"></textarea> 
                                                                              <?=$js_script_editor?>                            
                                                                          </div>
                                                                    <div class="form-group">
                                                                      <button type="submit" class="btn  btn-success">Salva</button>
                                                                      <input name="action" type="hidden" value="insert_template" />
                                                                      <input name="idsito" type="hidden" value="<?=IDSITO?>" />
                                                                    </div>
                                                                  </form>        
                                                            </div>
                                                        </div>

                                                </div><!-- /.content-wrapper -->
                                                <div class="modal fade in" id="screenshots"  role="dialog">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title">Usare il TAB <b>"Carica"</b> per caricare le immagini!</h4>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                <img src="<?=BASE_URL_SITO.'img/screenshot_upload_image.png'?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                    <? include_module('backtop.inc.php'); ?> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

<?php include_module('footer.inc.php'); ?>