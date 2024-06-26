<? include_module('header.inc.php'); ?>

<? include_module('navbar.inc.php'); ?>

<? include_module('sidebar.inc.php'); ?>

<?php  
    $check_rec_data = $fun->check_recensioni_data(IDSITO);
    if($check_rec_data > 0){
        $overfade = '<style>
                            div.fadeMe {
                            opacity:    0.5; 
                            background: #000; 
                            width:      100%;
                            height:     100%; 
                            z-index:    10;
                            top:        0; 
                            left:       0; 
                            position:   fixed; 
                            }
                    </style>
                    <script language="javascript">_alert("Invio Recensioni per range punteggio Bloccato","E\' stato abilitato l\'invio delle recensioni tramite data di CheckOut, se si desidera utilizzare questo modulo, disabilitare l\'altro!")</script>'."\r\n";
    }
    echo $overfade;
?>
<div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                <? include_module('breadcrumb.inc.php'); ?>
                                    <div class="page-body">
                                    <div class="card">
                                            <div class="card-header">
                                                <h5>Configura Modulo Recensioni</h5>                                              
                                            </div>
                                                <div class="card-block">
                                                    <p>Abilita invio della richiesta di recensioni; invia e-mail in base al range di punteggio ottenuto dalla Customer Satisfaction</p>
                                                        <p><i class="fa fa-exclamation-circle text-black"></i> L'e-mail automatica di Richiesta Recensioni TripAdvisor partirà se impostata ogni giorno alle ore 10:15</p>
                                                        <?php      
                                                            if($check_rec_data == 0){ 
                                                               echo $content;
                                                            }
                                                        ?>
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