<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
    <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <section class="content">
        <div class="box radius6">
            <div class="box-body">
                <?=$msg?>
                <?=$SbMsg?>
                <?=($_REQUEST['azione']!=''?'<p class="text-info text-center">'.$msgsyncro.'</p>':'')?>
                <?=check_data_syncro_listino_parity(IDSITO)?>
                <? //echo $form_ricerca?>
                <?=$SyncroMsg?>
                <h3><i class="fa fa-exclamation-triangle text-orange"></i> ATTENZIONE: il listino di QUOTO può essere usato solo se non ci sono moduli di sincronizzazioni con booking engine o channel manager, abilitati!</h3>

                    <?php  if($parity == 0){ echo $xcrud->render('edit',$id); }?>
                    <h3>Inserire la camera, il trattamento, il periodo ed il prezzo!</h3>
                    <h4>L'nserimento dei prezzi di listino può anche essere gestito dettagliatamente per ogni tipologia di camera  <span>&#10230;</span> alla voce di menù <a href="<?=BASE_URL_SITO?>disponibilita-camere/"><b>Camere</b></a></h4>
                    <?php   echo $TipoListino->render(); ?>

            </div>
        </div>
    </section><!-- /.content -->
</div><!-- ./wrapper -->
<?php  if($parity == 0){?><?=$legenda?><?}?>
<?php include_module('footer.inc.php'); ?>
