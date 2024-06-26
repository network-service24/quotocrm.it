<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
    <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <section class="content">
        <div class="box radius6">
            <div class="box-body">            
                <h2>Cestino: svuota, ripristina! </h2>
                    <div class="btn-group btn-group-100">
                    <? include(INC_PATH_MODULI.'dimension.inc.php'); ?>
                    <div class="clearfix"></div>
                    <div class="alert alert-default text-center text-black">
                        <ul style="list-style-type:none;">
                            <li><b>LEGENDA:</b> le prenotazioni e/o le conferme ...in trattativa, se cestinate <b>saranno escluse da qualsiasi calcolo statistico</b> di QUOTO! è altamente consigliabile <b>archiviarle</b>!</li>
                            <li>Archiviandole inoltre ne beneficerà l'usabilità delle voci d'uso giornaliero del CRM che <b>saranno molto più fluide e veloci</b>!!</li>
                            <li><b class="text-red">ATTENZIONE:</b> <b>se eliminate definitivamente</b> una prenotazione e/o una ..in trattativa, <b>saranno perse per sempre</b> e quindi totalmente escluse dai moduli statistici!!</li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                    <button type="button" class="btn bg-maroon">Azioni</button>
                    <button type="button" class="btn bg-maroon dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu"> 
                        <li><a  data-toggle="modal" data-target="#myModalASearch" href="#"><i class="fa fa-search orange" aria-hidden="true"></i> Ricerca avanzata</a></li>
                        <li class="divider"></li>
                        <li><a  id="delete_all" href="#"><i class="fa fa-search red" aria-hidden="true"></i>Elimina definitivamente</a></li>
                        <li><a  id="resave_all" href="#"><i class="fa fa-search green" aria-hidden="true"></i>Ripristina</a></li>
                    </ul>
                </div>
                <?=$js_script_delete?>
                <?=$js_script_resave?>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">  
                        <div  id="checkAll" style="cursor:pointer"><small><i class="fa fa-check-square-o"></i> Seleziona tutti</small></div> 
                    </div>
                </div> 
                <? include(INC_PATH_MODULI.'search.inc.php'); ?>   
                <div id="risultato_del"></div> 
                <div id="risultato_resave"></div> 
                <?php   echo $xcrud->render(); ?>
                <?if(check_configurazioni(IDSITO,'check_pagination')==1){echo'<div style=\"clear:both\"></div><small>Per eliminare la memoria della pagina scelta nel menù di paginazione, ripassare sempre dalla pagina N° 1</small><div style=\"clear:both\"></div>';echo $js_pagination;}?>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- ./wrapper -->
<?=notifica_mancata_click(IDSITO,'Conferma');?>
<?=$notifiche_js?>
<?php include_module('footer.inc.php'); ?>