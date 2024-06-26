<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<?=$css?>
<div class="content-wrapper">
<?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <section class="content">
        <div class="box radius6">
            <div class="box-body">
                <h2>Buoni voucher emessi</h2>
                <?=$msg?>
                <div class="btn-group btn-group-100">
                <? include(INC_PATH_MODULI.'dimension.inc.php'); ?>
                    <button type="button" class="btn bg-maroon">Azioni</button>
                    <button type="button" class="btn bg-maroon dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu"> 
                        <li><a  data-toggle="modal" data-target="#myModalASearch" href="#"><i class="fa fa-search orange" aria-hidden="true"></i> Ricerca avanzata</a></li>
                        <li class="divider"></li>
                        <li><a id="add_all_newsletter" href="#"><img src="<?=BASE_URL_SITO?>img/emessenger.png" class="small_ico_emessenger"> Aggiungi i selezionati ad <?=NOME_CLIENT_EMAIL?></a></li>
                        <li class="divider"></li>
                        <li>
                            <form style="padding: 3px 20px !important;" id="form_export" name="form_export" action="https://www.quoto.online/include/controller/export_buoni_voucher.php">
                                <input type="hidden" name="action" value="export">
                                <input type="hidden" name="idsito" value="<?=IDSITO?>">
                                <input type="hidden" name="Lingua" value="<?=$_REQUEST['Lingua']?>">
                                <input type="hidden" name="TipoRichiesta" value="<?=$_REQUEST['TipoRichiesta']?>">
                                <input type="hidden" name="FontePrenotazione" value="<?=$_REQUEST['FontePrenotazione']?>">
                                <input type="hidden" name="TipoVacanza" value="<?=$_REQUEST['TipoVacanza']?>">
                                <input type="hidden" name="Nome" value="<?=$_REQUEST['Nome']?>">
                                <input type="hidden" name="Cognome" value="<?=$_REQUEST['Cognome']?>">
                                <input type="hidden" name="DataArrivo" value="<?=$_REQUEST['DataArrivo']?>">
                                <input type="hidden" name="DataPartenza" value="<?=$_REQUEST['DataPartenza']?>">
                                <input type="hidden" name="CS_inviato" value="<?=$_REQUEST['CS_inviato']?>">
                                <input type="hidden" name="Chiuso" value="<?=$_REQUEST['Chiuso']?>">
                                <input type="hidden" name="Disdetta" value="<?=$_REQUEST['Disdetta']?>">
                                <input type="hidden" name="CheckConsensoPrivacy" value="<?=$_REQUEST['CheckConsensoPrivacy']?>">
                                <input type="hidden" name="CheckConsensoMarketing" value="<?=$_REQUEST['CheckConsensoMarketing']?>">
                                <input type="hidden" name="TipoCamere" value="<?=$_REQUEST['TipoCamere']?>">
                                <input type="hidden" name="TipoSoggiorno" value="<?=$_REQUEST['TipoSoggiorno']?>">
                                <input type="hidden" name="IdMotivazione" value="<?=$_REQUEST['IdMotivazione']?>">
                                <a href="#" onclick="document.getElementById('form_export').submit();" id="pulsante_esporta"><i class="fa fa-file-excel-o black" aria-hidden="true"></i> <span style="margin-left: 10px!important;color:#363636 !important;">Esporta CSV</span></a>
                            </form>
                            </li>

                        <li><a id="delete_all" href="#"><i class="fa fa-remove red" aria-hidden="true"></i> Elimina i selezionati</a></li>
                    </ul>
                </div>
                <? include(INC_PATH_MODULI.'search.inc.php'); ?>
                <?=$js_ajax?>
                <?=$js_script_delete?>
                <?=$js_script_mailing?>
                <?=$js_script_data_export?>
                <div id="risultato"></div>
                <div id="risultato_dis"></div>
                <div id="risultato_newsletter"></div>
                <div style="clear:both;height:5px"></div>
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">  
                        <div id="checkAll" style="cursor:pointer"><small><i class="fa fa-check-square-o"></i> Seleziona tutti</small></div>
                    </div>
                </div>
                <?php   echo $xcrud->render(); ?>
                <?//if(check_configurazioni(IDSITO,'check_pagination')==1){echo'<div style=\"clear:both\"></div><small>Per eliminare la memoria della pagina scelta nel menù di paginazione, ripassare sempre dalla pagina N° 1</small><div style=\"clear:both\"></div>';echo $js_pagination;}?>
                <?if(check_configurazioni(IDSITO,'check_pagination')==1){echo'<div id="legendaPagination"></div>';echo $js_pagination;}?>
            </div>
        </div>
    </section><!-- /.content -->

</div><!-- ./wrapper -->
<div id="modale_upselling"></div>
<?php include_module('footer.inc.php'); ?>