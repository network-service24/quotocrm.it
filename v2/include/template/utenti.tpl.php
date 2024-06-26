<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
    <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <section class="content">
        <div class="box radius6">
            <div class="box-body">
                <?php
                        if(!$_REQUEST['azione']){ 
                            echo $pulsante_aggiungi; 
                            echo $xcrud_suiteweb->render(); 
                        }
                        if($_REQUEST['azione']=='add'){
                            echo $html;
                        }                    
                        if($_REQUEST['azione']=='edit' && $_REQUEST['param'] != ''){
                            echo $content;
                        }
                    ?>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- ./wrapper -->
<?php include_module('footer.inc.php'); ?>