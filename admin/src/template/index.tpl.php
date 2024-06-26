<? include_once(INC_PATH_MODULI_ADMIN.'header.inc.php'); ?>

<? include_once(INC_PATH_MODULI_ADMIN.'navbar.inc.php'); ?>

<? include_once(INC_PATH_MODULI_ADMIN.'sidebar.inc.php'); ?>

<?=$autocomplete_siti ?>

<div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">

                                    <div class="page-body">
                                        <div class="row">
                                            <!-- task, page, download counter  start -->
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card bg-c-yellow update-card">
                                                    <div class="card-block">
                                                        <div class="row align-items-end">
                                                            <div class="col-8">
                                                                <h4 class="text-white"><?=tot_clienti(1)?></h4>
                                                                <h6 class="text-white m-b-0">Clienti <small>attivi</small></h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <i class="fa fa-bar-chart fa-3x"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update : h <?=date('H:i')?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card bg-c-green update-card">
                                                    <div class="card-block">
                                                        <div class="row align-items-end">
                                                            <div class="col-8">
                                                                <h4 class="text-white"><?=tot_siti(1)?></h4>
                                                                <h6 class="text-white m-b-0">Siti <small>attivi</small></h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <i class="fa fa-bar-chart fa-3x"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update : h <?=date('H:i')?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card bg-c-pink update-card">
                                                    <div class="card-block">
                                                        <div class="row align-items-end">
                                                            <div class="col-8">
                                                                <h4 class="text-white"><?=tot_utenti(1)?></h4>
                                                                <h6 class="text-white m-b-0">Utenti <small>attivi</small></h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <i class="fa fa-bar-chart fa-3x"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update : h <?=date('H:i')?></p>
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="col-xl-3 col-md-6">
                                                <div class="card  update-card">
                                                    <div class="card-block">
                                                        <div class="row align-items-end">
                                                            <div class="col-12 text-center p-t-20">
                                                                <img src="<?=BASE_URL_SITO?>class/resize.class.php?src=<?=BASE_PATH_SITO?>img/logo_network_2021.png&w=220&h=0&a=c&q=100">
                                                            </div>
                                                        </div>  
                                                    </div>
                                                 <div class="card-footer"></div> 
                                                </div>
                                            </div>
                                        </div>                                       
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Vai Siti Web
                                                    <a href="javascript:;">
                                                        <i class="fa fa-exclamation-circle text-info" title="Questo filtro è COMPLETO, selezionando il sito si viene re-diretti automaticamente"></i>
                                                    </a>
                                                </h5>                            
                                                    <div class="card-header-right">
                                                        <ul class="list-unstyled card-option">
                                                            <li><i class="feather icon-maximize full-card"></i></li>
                                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                                            <li><i class="feather icon-trash-2 close-card"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="card-block">   
                                                    <form action="<?=BASE_URL_ADMIN?>siti/" method="post" name="filtro_ricerca_sito" id="filtro_ricerca_sito">   
                                                    <input type="hidden" name="azione" value="ricerca" />      
                                                        <select class="js-example-data-array col-sm-12 form-control" id="lista_siti" name="idsito"></select>                                               
                                                    </form>
                                                    <?=$js_custom_select_siti?>
                                            </div>
                                        </div>
                                    <? include_once(INC_PATH_MODULI_ADMIN.'backtop.inc.php'); ?>  
                            </div>
                        </div>
    <!-- /.content -->
   <? include_once(INC_PATH_MODULI_ADMIN.'footer.inc.php'); ?>