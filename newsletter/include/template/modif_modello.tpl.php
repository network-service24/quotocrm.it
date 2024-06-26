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
                                            <div class="card-header">
                                                <h5>MODIFICA MODELLO <?=NOME_CLIENT_EMAIL?></h5>                                              
                                            </div>
                                                <div class="card-block">
                                                <div class="row">
                                                      <?php include(BASE_PATH_SITO.'newsletter/include/template/moduli/menu.inc.php');?>
                                                          <div class="col-md-10">
                                                                <form action="<?=$_SERVER['REQUEST_URI']?>" method="post" name="frminsesrt" id="frminsesrt" >
                                                                  
                                                                  <div class="form-group">
                                                                    <label>Lingua</label>
                                                                    <select name="lingua" id="lingua" class="form-control">
                                                                            <option value="" selected="selected">Scegli una lingua</option>
                                                                            <option value="it" <?=($dati['lingua']=='it'?'selected="selected"':'')?>>it</option>
                                                                            <option value="en" <?=($dati['lingua']=='en'?'selected="selected"':'')?>>en</option>
                                                                            <option value="de" <?=($dati['lingua']=='de'?'selected="selected"':'')?>>de</option>
                                                                            <option value="fr" <?=($dati['lingua']=='fr'?'selected="selected"':'')?>>fr</option>
                                                                        </select>
                                                                  </div>
                                                                  <div class="form-group">
                                                                    <label>Nome Modello</label>
                                                                    <input name="nome_template" type="text" class="form-control" id="nome_template" value="<?=$dati['nome_template']?>" required/>
                                                                  </div>
                                                                  <div class="form-group">
                                                                            <label>Modello</label>
                                                                            <div class="alert alert-profila alert-default-profila alert-dismissable">
                                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                                <p> E' possibile personalizzare il contenuto del template inserendo la variabile [cliente] e la variabile [struttura] </p>                                             
                                                                                <p>Al momento dell'invio dell'email <?=NOME_CLIENT_EMAIL?>, il sistema sostituirà [cliente] con il nome ed il cognome del contatto e [struttura] con l'intestazione della vostra attività.</p>
                                                                            </div> 
                                                                            <div class="clearfix"></div>
                                                                            <textarea name="template" class="xcrud-input xcrud-texteditor form-control editor-loaded"  id="template"><?=$dati['template']?></textarea> 
                                                                            <?=$js_script_editor?>                            
                                                                  </div>
                                                                  <div class="form-group">
                                                                    <button type="submit" class="btn  btn-success">Modifica</button>
                                                                    <input name="action" type="hidden" value="modif_template" />
                                                                    <input name="id" type="hidden" value="<?=$dati['id']?>" />
                                                                  </div>
                                                                </form>        
                                                          </div>
                                                    <? include_module('backtop.inc.php'); ?> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

    <!-- /.content -->
    <? include_module('footer.inc.php'); ?>