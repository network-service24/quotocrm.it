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
            <h2>Statistiche in base all'anagrafica cliente inserita in QUOTO!!</h2>  
            <h3>
              <div class="row">
                  <div class="col-md-1"></div>
                      <div class="col-md-2 text-left">
                        <small>
                          <form method="post" name="filter_year" id="filter_year">
                          <label>Anno</label>
                              <input type="hidden" name="action" value="check_year">
                              <select  name="querydate" class="form-control" onchange="submit()">
                                  <?=$lista_anni?>
                              </select>                                        
                          </form> 
                        </small> 
                      </div>
                      <div class="col-md-2 text-center"><label><small>oppure</small></label><br><span>&#10230;</span> </div>
                      <div class="col-md-6 text-right">
                        <small>
                        <form name="relation_requestdate" id="relation_requestdate" method="POST" action="<?=$_SERVER['REQUEST_URI']?>">
                              <div class="col-md-4 text-center">                          
                                    <label>Confronta <small>Prenotazioni confermate</small> <b>Dal</b></label>
                                      <input type="text" id="DataRichiesta_dal" autocomplete="off"  class="date-picker form-control" name="DataRichiesta_dal" value="<?=$_REQUEST['DataRichiesta_dal']?>">
                              </div>
                              <div class="col-md-4 text-center">
                                    <label>Confronta <small>Prenotazioni confermate</small> <b>Al</b></label>
                                      <input type="text" id="DataRichiesta_al" autocomplete="off"  class="date-picker form-control" name="DataRichiesta_al" value="<?=$_REQUEST['DataRichiesta_al']?>">                                      
                                </div>
                                <div class="col-md-1">
                                <label>&nbsp;</label>
                                    <input type="hidden" name="action" value="request_date">
                                    <button class="btn btn-success btn-md" type="submit">Filtra</button> 
                                </div> 
                            </form>                        
                        </small> 
                      </div>
                    <div class="col-md-1"></div>
              </div> 
              </h3>
              <br>                                                  
              <?php  echo $tabella; ?>
              <?=$js_date?>
          </div>
      </div> 
    </section><!-- /.content -->
</div><!-- ./wrapper -->

<?php include_module('footer.inc.php'); ?>