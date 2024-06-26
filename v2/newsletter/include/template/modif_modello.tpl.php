<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<?=$js_script?>
<div class="content-wrapper">
<?php include(BASE_PATH_SITO.'newsletter/include/template/moduli/breadcrumb.inc.php') ?>
  <section class="content">
    <div class="box radius6">
      <div class="box-body">

        <div class="row">
        <?php include(BASE_PATH_SITO.'newsletter/include/template/moduli/menu.inc.php');?>
            <div class="col-md-10">
                  <form action="<?=$_SERVER['REQUEST_URI']?>" method="post" name="frminsesrt" id="frminsesrt" >
                    <h2>MODIFICA MODELLO <?=NOME_CLIENT_EMAIL?></h2>
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
        </div>
      </div>
    </div>
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php include_module('footer.inc.php'); ?>