<? include_once(INC_PATH_MODULI_ADMIN.'header.inc.php'); ?>

<? include_once(INC_PATH_MODULI_ADMIN.'navbar.inc.php'); ?>

<? include_once(INC_PATH_MODULI_ADMIN.'sidebar.inc.php'); ?>

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
                                                        <h4>Archivio Report</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="page-header-breadcrumb">
                                                    <ul class="breadcrumb-title">
                                                        <li class="breadcrumb-item">
                                                            <a href="<?=BASE_URL_ADMIN?>index/"> <i class="feather icon-home"></i> </a>
                                                        </li>
                                                        <li class="breadcrumb-item"><a href="<?=$_SERVER['REQUEST_URI']?>">archivio</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="page-body">
                                    <div class="card">
                                            <div class="card-header">
                                                <h5>ARCHIVIO REPORT CLIENTI MARKETING</h5> 
                                                <?=$provenienza?>                                                                                              
                                            </div>
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