<? include_module('header.inc.php'); ?>

<? include_module('navbar.inc.php'); ?>

<? include_module('sidebar.inc.php'); ?>


<div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                <? include_module('breadcrumb.inc.php'); ?>
                                    <div class="page-body">
                                        <div class="alert alert-danger text-center text-black">
                                            <ul>
                                                <li><b>LEGENDA:</b> le prenotazioni e/o le conferme ...in trattativa, se cestinate <b>saranno escluse da qualsiasi calcolo statistico</b> di <?=NOME_AMMINISTRAZIONE?> è altamente consigliabile <b>archiviarle</b>!</li>
                                                <li>Archiviandole inoltre ne beneficerà l'usabilità delle voci d'uso giornaliero del CRM che <b>saranno molto più fluide e veloci</b>!!</li>
                                                <li><b class="text-red">ATTENZIONE:</b> <b>se eliminate definitivamente</b> una prenotazione e/o una ..in trattativa, <b>saranno perse per sempre</b> e quindi totalmente escluse dai moduli statistici!!</li>
                                            </ul>
                                        </div>
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5>Cestino: svuota,ripristina!</h5>                                                                                         
                                                </div>
                                                <div class="card-block">
                                                    <?=$content?>
                                                   <? include_module('backtop.inc.php'); ?>                                  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <? include(INC_PATH_MODULI.'search.archivia.inc.php'); ?>  
    <!-- /.content -->
 <? include_module('footer.inc.php'); ?>