<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<?=$js_scripts?>
<div class="content-wrapper">
<?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <section class="content">
        <div class="box radius6">
            <div class="box-body">
                <h2>Archivio Preventivi, Conferme, Prenotazioni</h2>
                <div class="btn-group btn-group-100">
                <? include(INC_PATH_MODULI.'dimension.inc.php'); ?>
                    <button type="button" class="btn bg-maroon">Azioni</button>
                    <button type="button" class="btn bg-maroon dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu"> 
                        <li><a  data-toggle="modal" data-target="#myModalASearch" href="#"><i class="fa fa-search orange" aria-hidden="true"></i> Ricerca avanzata</a></li>
                        <li><a id="disarchivia_all" href="#"><i class="fa fa-external-link orange" aria-hidden="true"></i> Ri-Abilita i selezionati</a></li>
                        <li><a id="delete_all" href="#"><i class="fa fa-remove red" aria-hidden="true"></i> Elimina i selezionati</a></li>
                        <?php 
                        if(IDSITO != 102 && IDSITO != 2408){
                            if(ANNO_ATTIVAZIONE != date('Y')){
                                    $annoPassato = (date('Y')-1);
                                    $numP        = check_non_archiviate(IDSITO,$annoPassato);
                                if($numP > 0){?>
                                    <li>&nbsp;</li>
                                    <li>
                                        <a data-toggle="tooltip" title="Ci sono ancora <?=$numP?> record da archiviare!" onClick="if(window.confirm('Sicuro di voler archiviare <?=$numP?> preventivi/prenotazioni delll\'anno <?=$annoPassato?>?')){ location.replace('<?=BASE_URL_SITO?>archivia_anno/&action=archiviaAnno&idsito=<?=IDSITO?>&anno=<?=$annoPassato?>&nP=<?=$numP?>');}" href="javascript:;"><i class="fa fa-database"></i> <span>Archivia tutto il <?=$annoPassato;?></span></a>
                                    </li>  
                                <?}
                            }
                        }
                        ?>
                    </ul>
                </div>
                <? include(INC_PATH_MODULI.'search.inc.php'); ?>
                <div id="risultato"></div>
                <div id="risultato_dis"></div>
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
<?php include_module('footer.inc.php'); ?>