<? include_module('header.inc.php'); ?>

<? include_module('navbar.inc.php'); ?>

<? include_module('sidebar.inc.php'); ?>


<div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                <? include_module('breadcrumb.inc.php'); ?>
                                    <div class="page-body">
                                    <div class="card">
                                            <div class="card-header">
                                                <h5>Statistiche in base all'anagrafica cliente inserita in QUOTO!!</h5>                                              
                                                <div class="card-header-right">
                                                    <ul class="list-unstyled card-option">
                                                        <li><i class="feather icon-maximize full-card"></i></li>
                                                        <!-- 
                                                        <li><i class="feather icon-minus minimize-card"></i></li>
                                                        <li><i class="feather icon-trash-2 close-card"></i></li> 
                                                        -->
                                                    </ul>
                                                </div>
                                            </div>
                                                <div class="card-block">  
                                                   <div class="row">            
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                <div class="col-md-4"></div>
                                                                <div class="col-md-3 text-center">
                                                                    <form method="post" name="filter_year" id="filter_year">
                                                                        <label>Anno</label>
                                                                        <input type="hidden" name="action" value="check_year">
                                                                        <select  name="querydate" class="form-control" onchange="submit()">
                                                                            <?=$lista_anni?>
                                                                        </select>                                        
                                                                    </form>                                                        
                                                                </div>
                                                            </div>
                                                        </div>
                                                       
                                                        <div class="col-md-4">
                                                            <form name="relation_requestdate" id="relation_requestdate" method="POST" action="<?=$_SERVER['REQUEST_URI']?>">
                                                                <div class="row">                                                                 
                                                                    <div class="col-md-6 text-center">                          
                                                                        <label>Prenotazioni confermate <b>Dal</b></label>
                                                                        <input type="date" id="DataRichiesta_dal" autocomplete="off"  class="form-control" name="DataRichiesta_dal" value="<?=$_REQUEST['DataRichiesta_dal']?>">
                                                                
                                                                    </div> 
                                                                    <div class="col-md-6 text-center">                          
                                                                        <label>Prenotazioni confermate <b>Dal</b></label>
                                                                        <input type="date" id="DataRichiesta_al" autocomplete="off"  class="form-control" name="DataRichiesta_al" value="<?=$_REQUEST['DataRichiesta_al']?>">                                    
                                                                    </div>                                                          
                                                                </div>
                                                                <div class="clearfix p-b-10"></div>                         
                                                                <div class="row">
                                                                    <div class="col-md-12 text-center">                                               
                                                                        <input type="hidden" name="action" value="request_date">
                                                                        <button class="btn btn-success btn-sm" type="submit">Filtra</button>                                                                     
                                                                    </div>                                                             
                                                                </div> 
                                                            </form> 
                                                        </div>
                                                    </div>          
                                                    <div class="clearfix p-b-30"></div>                                                 
                                                    <?php  echo $tabella; ?>
                                                    <? include_module('backtop.inc.php'); ?> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

    <!-- /.content -->
    <? include_module('footer.inc.php'); ?>