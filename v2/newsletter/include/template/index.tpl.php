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

            <div class="pull-right">
              <!-- <button id="add_insert" type="button" class="btn  btn-primary"><i class="fa fa-plus"></i> Inserisci un nuovo utente</button> -->
              <button id="open_forminsert" type="button" class="btn  btn-success"><i class="fa fa-plus"></i> Inserisci nuova lista</button>
              <!-- <a href="<?=BASE_URL_SITO.'newsletter/simplecsvimport/'?>"  class="btn  btn-warning"><i class="fa fa-save"></i> Importa lista da file CSV</a> -->
            </div>
                          
              <div style="display:none;" id="notaint">
                  <form action="<?=$_SERVER['REQUEST_URI']?>" method="post" name="frminsesrt" id="frminsesrt" >
                    <h2>INSERISCI UNA NUOVA LISTA</h2>
                    <div class="form-group">
                      <label>Nome Lista</label>
                      <input name="nome_lista" type="text" class="form-control" id="nome_lista" required/>
                    </div>
                    <!-- <div class="form-group">
                      <label>Visibile</label>
                      <select name="visibile" id="visibile" class="form-control">
                            <option value="1" selected="selected">SI</option>
                            <option value="0">NO</option>
                          </select>
                    </div> -->
                    <div class="form-group">
                      <button type="submit" class="btn  btn-success">Salva</button>
                      <input name="action" type="hidden" value="insertL" />
                      <input name="idsito" type="hidden" value="<?=IDSITO?>" />
                    </div>
                  </form>
              </div>
              <br>
              <div style="display:none;" id="add">

                        <form action="<?=$_SERVER['REQUEST_URI']?>" method="post" name="insert" id="insert" >
                        <h2>INSERISCI UN NUOVO UTENTE</h2>
                          <div class="form-group">
                            <label>Lista</label>
                                <select name="id_lista" id="id_lista" class="form-control" required >
                                <option value="" selected="selected">--</option>
                                        <?php echo $lista?>
                                  </select>
                          </div>
                          <div class="form-group">
                              <label>Nome</label>
                              <input name="nome" type="text" class="form-control" id="nome" required />
                          </div>
                          <div class="form-group">
                              <label>Cognome</label>
                              <input name="cognome" type="text" class="form-control"  id="cognome" required />
                          </div>
                          <div class="form-group">
                              <label>Email</label>
                              <input name="email" type="text" class="form-control"  id="email" required />
                              <span id="check_email"></span>
                              <?
                                if(check_configurazioni(IDSITO,'check_verify_email')== 1){
                                    echo $js_Check_email;
                                }
                            ?>
                          </div>
                          <div class="form-group">
                              <label>Lingua</label>
                              <select name="lingua" id="lingua" class="form-control" required >
                                  <option value="" selected="selected">--</option>
                                  <option value="it">it</option>
                                  <option value="en">en</option>
                                  <option value="de">de</option>
                                  <option value="fr">fr</option>
                                </select>
                          </div>
                          <div class="form-group">                           
                                  <button type="submit" class="btn  btn-success" id="bottone_salva">Inserisci nominatvo</button>
                                  <input name="action" type="hidden" value="insert" />
                                  <input name="idsito" type="hidden" value="<?=IDSITO?>" />
                                  <input name="data" type="hidden" value="<?=date('Y-m-d')?>" />
                                  <input type="hidden" name="ip" value="<?=$_SERVER['REMOTE_ADDR']?>">
                                  <input type="hidden" name="agent" value="<?=$_SERVER['HTTP_USER_AGENT']?>">   
                                  <input name="CheckConsensoPrivacy" type="hidden" value="1" />
                                  <input name="CheckConsensoMarketing" type="hidden" value="0" />
                            </div>
                        </form>
                </div>
                  <?=$iscritti?>           
            </div>
        </div>
      </div>
    </div>
</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php include_module('footer.inc.php'); ?>