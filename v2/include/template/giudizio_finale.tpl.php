<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
  <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
  <section class="content">
    <div class="box radius6">
      <div class="box-body">
        <h2> Statistiche relative ai questionari di soddisfazione cliente
          <span>&#10230;</span> <small>statistiche di customer satisfaction</small></h2>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">
                <div class="row">
                    <div class="col-md-4 text-left">                   
                          <form method="post" class="float-right-10">
                          <label for="querydate" class="">Anno</label>
                            <select name="querydate" class="form-control h-input-medio" onchange="submit()">
                              <?=$lista_anni?>
                            </select>
                          </form>
                    </div>
                    <div class="col-md-1 text-center"><label><small>oppure</small></label><br><span>&#10230;</span> </div>
                      <div class="col-md-7 text-right">
                        <small>
                        <form name="relation_requestdate" id="relation_requestdate" method="POST" action="<?=$_SERVER['REQUEST_URI']?>">
                              <div class="col-md-5 text-center">                          
                                    <label><small>Complazione Questionario</small> <b>Dal</b></label>
                                      <input type="text" id="DataRichiesta_dal" autocomplete="off"  class="date-picker form-control" name="DataRichiesta_dal" value="<?=$_REQUEST['DataRichiesta_dal']?>">
                              </div>
                              <div class="col-md-5 text-center">
                                    <label><small>Complazione Questionario</small> <b>Al</b></label>
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

                  </div> 
                </h3>
                <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body">
              <?php if(sizeof($record)>0){?>
                <div class="chart">
                  <div id="graph" style="width:100%; height:400px;"></div>
                </div>
              <?php } ?>
              </div><!-- /.box-body -->
            </div>
          </div>
        </div>
        <?=$js_grafico?>
        <div style="clear:both;height:20px"></div>
        <h5>
          LEGENDA:    <img src="https://www.quoto.online/img/emoji/bad.jpg" style="width:20px;height:20px" data-toogle="tooltip" title="Bad [valore = 1]">(1)
                      <img src="https://www.quoto.online/img/emoji/semi_bad.jpg" style="width:20px;height:20px" data-toogle="tooltip" title="Semi Bad  [valore = 2]">(2)
                      <img src="https://www.quoto.online/img/emoji/medium.jpg" style="width:20px;height:20px" data-toogle="tooltip" title="Medium  [valore = 3]">(3)
                      <img src="https://www.quoto.online/img/emoji/semi_good.jpg" style="width:20px;height:20px" data-toogle="tooltip" title="Semi Good  [valore = 4]">(4)
                      <img src="https://www.quoto.online/img/emoji/good.jpg" style="width:20px;height:20px" data-toogle="tooltip" title="Good  [valore = 5]">(5)

        </h5>
        <div style="clear:both;height:20px"></div>
        <?=$tabella;?>
      </div>
    </div>
  </section><!-- /.content -->
</div><!-- ./wrapper -->
<?=$js_date?> 
<?php 
  if(check_configurazioni(IDSITO,'check_notifiche_push')==1){
    echo $notifiche_js;
  }
?>
<?php include_module('footer.inc.php'); ?>
