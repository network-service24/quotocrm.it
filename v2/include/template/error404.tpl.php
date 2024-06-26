<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
    <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <section class="content">
        <div class="box radius6">
            <div class="box-body">

                <div class="error-page">
                    <h2 class="headline text-info"> 404</h2>
                    <div class="error-content">
                        <h3><i class="fa fa-warning text-yellow"></i>Pagina non trovata!</h3>
                        <p>
                            La pagina ricercata non è presente
                        </p>
                        <script>
                            $(document).ready(function(){
                                setTimeout(function() { 
                                    document.location='<?=BASE_URL_SITO?>dashboard-index/';
                                }, 500);
                            })
                        </script> 
                    </div><!-- /.error-content -->
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- ./wrapper -->
<?php include_module('footer.inc.php'); ?>