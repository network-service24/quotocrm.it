<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
    <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
<?php  
    $check_rec_punteggio = check_recensioni_punteggio(IDSITO);
    if($check_rec_punteggio > 0){
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
                    <script language="javascript">_alert("Invio Recensioni per data di ChekOut Bloccato","E\' stato abilitato l\'invio delle recensioni tramite range di punteggio, se si desidera utilizzare questo modulo, disabilitare l\'altro!")</script>'."\r\n";
    }
    echo $overfade;
?>
    <section class="content">
        <div class="box radius6">
            <div class="box-body">
                    <h2>Abilita invio per la Richiesta di recensioni su TripAdvisor, send e-mail prima/dopo la data di check Out <span>&#10230;</span> <small>Imposta il numero di giorni per l'invio</small></h2>
                    <h5><i class="fa fa-exclamation-triangle text-orange"></i> L'e-mail automatica di Richiesta Recensioni TripAdvisor partirà se impostata ogni giorno alle ore 10:10</h5>
                    <?php      
                        if($check_rec_punteggio == 0){ 
                            echo $xcrud->render('edit',$id);                
                            echo $xcrud2->render('edit',$id); 
                            echo $xcrud_reselling->render(); 
                        }
                     ?>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- ./wrapper -->
<?php include_module('footer.inc.php'); ?> 