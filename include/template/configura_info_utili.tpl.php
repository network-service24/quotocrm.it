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
                                                <h5>Configura email per Info Utili</h5>                                              
                                            </div>
                                                <div class="card-block">
                                                    <p>
                                                    Abilita l'invio automatico dell'Email info utili al cliente prima della data del Check-in
                                                    <br><span>&#10230;</span> <small> imposta quanti giorni PRIMA del Check-in deve arrivare l'Email info Utili al cliente</small></p>
                                                    <p><i class="fa fa-exclamation-circle text-black"></i> L'e-mail automatica se impostata, partirà ogni giorno alle ore 09:30</p>
                                                    <?php   //echo $xcrud->render('edit',$id); ?>                
                                                    <?php  // echo $xcrud2->render('edit',$id); ?>                                              
                                                    <?php  // echo $xcrud3->render(); ?> 
                                                    <?php   echo $content; ?>
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