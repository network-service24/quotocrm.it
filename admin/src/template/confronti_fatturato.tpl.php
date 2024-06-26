<? include_once(INC_PATH_MODULI_ADMIN.'header.inc.php'); ?>

<? include_once(INC_PATH_MODULI_ADMIN.'navbar.inc.php'); ?>

<? include_once(INC_PATH_MODULI_ADMIN.'sidebar.inc.php'); ?>

<?php include(BASE_PATH_SITO.'js/confronti_fatturato.inc.js.php');?>  

<div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page-header start -->
                                    <div class="page-header">
                                        <div class="row align-items-end">
                                            <div class="col-lg-8">
                                                <div class="page-header-title">
                                                    <div class="d-inline">
                                                        <h4>Confronti fatturato Quoto</h4>
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="page-header-breadcrumb">
                                                    <ul class="breadcrumb-title">
                                                        <li class="breadcrumb-item">
                                                            <a href="<?=BASE_URL_ADMIN?>dashboard-index/"> <i class="feather icon-home"></i> </a>
                                                        </li>
                                                        <li class="breadcrumb-item"><a href="<?=$_SERVER['REQUEST_URI']?>">Confronti fatturato Quoto</a>
                                                        </li>
    
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="page-body">

                                    <div class="card">
                                        <div class="card-block">
                                            <div class="row">
                                                <div class="col-md-3"></div>                                            
                                                <div class="col-md-6">                                                           
                                                    <form id="statistiche" name="statistiche" method="post" action="<?=$_SERVER['REQUEST_URI']?>">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-2 text-right"><b>Periodo</b></div>
                                                                <div class="col-md-4"> <input placeholder="Imposta una query di ricerca" class="form-control periodo text-center" id="demo" name="date" type="text" autocomplete="off"></div>
                                                                <div class="col-md-2 text-center"><span class="f-11">Confronta con</span></div>
                                                                <div class="col-md-4"><input  class="form-control periodo text-center" id="confronto" name="confronto" type="text" autocomplete="off" readonly></div>
                                                            </div>                             
                                                        </div>
                                                        <input type="hidden" name="action" value="request_date">
                                                    </form>                                                                    
                                                </div>
                                                <div class="col-md-3 text-right"></div>
                                            </div>
                                            <div id="loading"></div>
                                        </div>
                                    </div>      

                                    <div class="card">
                                            <div class="card-header">
                                                <h5>Confronti fatturato clienti attivi QUOTO</h5> 
                                           
                                                 <div class="card-header-right">
                                                    <ul class="list-unstyled card-option">
                                                        <li>                                                                
                                                            <form method="POST" id="form_export" name="form_export" action="<?=BASE_URL_ADMIN?>/src/controller/export_fatturato_quoto.php">
                                                                <input type="hidden" name="action" value="export">
                                                                <input type="hidden" name="date" value="<?=$_REQUEST['date']?>">
                                                                <button type="submit" class="btn btn-inverse btn-sm" data-toggle="tooltip" title="Esporta in Excel">Esporta</button>                               
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                                <div class="card-block">
                                                    <?=$content?>
                                                    <? include_once(INC_PATH_MODULI_ADMIN.'backtop.inc.php'); ?>  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

    <!-- /.content -->
    <? include_once(INC_PATH_MODULI_ADMIN.'footer.inc.php'); ?>