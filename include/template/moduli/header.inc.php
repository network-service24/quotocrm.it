<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?=NOME_AMMINISTRAZIONE?> v.<?=VERSIONE?></title>
        <!-- Nome della Web Application -->
        <meta name="application-name" content="<?=NOME_AMMINISTRAZIONE?> v.<?=VERSIONE?>">
        <!-- Autore -->
        <meta name="author" content="<?=AUTHOR?>">
        <!-- Proprietario del Software -->
        <meta name="copyright" content="<?=NAME_ADMIN?>">
        <!-- Editor usato -->
        <meta name="generator" content="<?=GENERATOR?>">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="<?=BASE_URL_SITO?>favicon/favicon.ico" type="image/x-icon">
        <!-- Jquery -->
        <script type="text/javascript" src="<?=CDN_URL_SITO?>files/bower_components/jquery/js/jquery.min.js"></script>
        <!-- Required Jquery -->
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.bundle.min.js"></script> -->
        <script type="text/javascript" src="<?=CDN_URL_SITO?>files/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?=CDN_URL_SITO?>files/bower_components/popper.js/js/popper.min.js"></script>
        <script type="text/javascript" src="<?=CDN_URL_SITO?>files/bower_components/bootstrap/js/bootstrap.min.js"></script>   
        <!-- Required Fremwork -->
        <link rel="stylesheet" type="text/css" href="<?=CDN_URL_SITO?>files/bower_components/bootstrap/css/bootstrap.min.css">
        <!-- Google font-->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
        <!-- sweet alert framework -->
        <link rel="stylesheet" type="text/css" href="<?=CDN_URL_SITO?>files/bower_components/sweetalert/css/sweetalert.css">
        <!-- light-box css -->
        <link rel="stylesheet" type="text/css" href="<?=CDN_URL_SITO?>files/bower_components/ekko-lightbox/css/ekko-lightbox.css">
        <!-- lightbox Fremwork -->
        <link rel="stylesheet" type="text/css" href="<?=CDN_URL_SITO?>files/bower_components/lightbox2/css/lightbox.min.css">
        <!-- themify-icons line icon -->
        <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>files/assets/icon/themify-icons/themify-icons.css">
        <!-- Font Awesome 4.7.0-->
        <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>files/assets/icon/font-awesome/css/font-awesome.min.css">
        <!-- <script type='text/javascript' src='https://kit.fontawesome.com/bb19c175f4.js?ver=3.8.0' id='font-awesome-pro-js'></script> -->
        <!-- flag icon framework css -->
        <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>files/assets/icon/flag-icons/css/flag-icon.css">
        <!-- ico font -->
        <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>files/assets/icon/icofont/css/icofont.css">
        <!-- animation nifty modal window effects css -->
        <link rel="stylesheet" type="text/css" href="<?=CDN_URL_SITO?>files/assets/css/component.css">
        <!-- feather Awesome -->
        <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>files/assets/icon/feather/css/feather.css">
        <!-- Notification.css -->
        <link rel="stylesheet" type="text/css" href="<?=CDN_URL_SITO?>files/assets/pages/notification/notification.css">
        <!-- Switch component css -->
        <link rel="stylesheet" type="text/css" href="<?=CDN_URL_SITO?>files/bower_components/switchery/css/switchery.min.css">
        <!-- Style.css -->
        <link rel="stylesheet" type="text/css" href="<?=CDN_URL_SITO?>files/assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="<?=CDN_URL_SITO?>files/assets/css/jquery.mCustomScrollbar.css">
        <!-- Date-time picker css -->
        <link rel="stylesheet" type="text/css" href="<?=CDN_URL_SITO?>files/assets/pages/advance-elements/css/bootstrap-datetimepicker.css">
        <!-- Date-Dropper css -->
        <link rel="stylesheet" type="text/css" href="<?=CDN_URL_SITO?>files/bower_components/datedropper/css/datedropper.min.css">
        <!-- Color Picker css -->
        <link rel="stylesheet" type="text/css" href="<?=CDN_URL_SITO?>files/bower_components/spectrum/css/spectrum.css">
        <!-- Mini-color css -->
        <link rel="stylesheet" type="text/css" href="<?=CDN_URL_SITO?>files/bower_components/jquery-minicolors/css/jquery.minicolors.css">
        <!-- list css -->
        <link rel="stylesheet" type="text/css" href="<?=CDN_URL_SITO?>files/assets/pages/list-scroll/list.css">
        <link rel="stylesheet" type="text/css" href="<?=CDN_URL_SITO?>files/bower_components/stroll/css/stroll.css"> 
        <!-- radial chart -->
        <link rel="stylesheet" href="<?=CDN_URL_SITO?>files/assets/pages/chart/radial/css/radial.css" type="text/css" media="all">
        <!-- Chartlist chart css -->
        <link rel="stylesheet" href="<?=CDN_URL_SITO?>files/bower_components/chartist/css/chartist.css" type="text/css" media="all">
        <!-- Select 2 css -->
        <link rel="stylesheet" href="<?=CDN_URL_SITO?>files/bower_components/select2/css/select2.min.css">
        <!-- Multi Select css -->
        <link rel="stylesheet" type="text/css" href="<?=CDN_URL_SITO?>files/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css">
        <link rel="stylesheet" type="text/css" href="<?=CDN_URL_SITO?>files/bower_components/multiselect/css/multi-select.css">
        <!-- Alert custom.css,js -->
        <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>css/_alert.css">
        <script type="text/javascript" src="<?=BASE_URL_SITO?>js/_alert.js"></script>
        
        <link rel="stylesheet" type="text/css" href="<?=CDN_URL_SITO?>css/jquery.notify.css" />

        <script type="text/javascript" src="<?=BASE_URL_SITO?>js/custom_functions.js"></script>
        <?php
            echo'<link href="'.CDN_URL_SITO.'plugin/switchery/dist/switchery.min.css" rel="stylesheet" />'."\r\n";
            echo'<script src="'.CDN_URL_SITO.'plugin/switchery/dist/switchery.min.js"></script>'."\r\n";
            echo '<script>
                    $(document).ready(function() {

                    var elems = Array.prototype.slice.call(document.querySelectorAll(\'.js-switch\'));
                                $(\'.js-switch\').each(function() {
                                    new Switchery($(this)[0], { color: \'#e85a31\'
                                                            , secondaryColor    : \'#dfdfdf\'
                                                            , jackColor         : \'#fff\'
                                                            , jackSecondaryColor: null
                                                            , className         : \'switchery\'
                                                            , disabled          : false
                                                            , disabledOpacity   : 0.5
                                                            , speed             : \'0.1s\'
                                                            , size              : \'small\' });

                                });
                        $(\'.js-example-basic-multiple\').select2();
                    });
                </script>'."\r\n";
        
        ?>
        <!--  custom.functions .js -->
        <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>css/custom.css">
        <!-- toast CSS -->
        <link rel="stylesheet" href="<?=CDN_URL_SITO?>plugin/toast-master/css/jquery.toast.css">
        <script src="<?=CDN_URL_SITO?>plugin/toast-master/js/jquery.toast.js"></script>
        <!--  copia e incolla .js -->
        <script src="<?=CDN_URL_SITO?>plugin/clipboard.js-master/dist/clipboard.min.js"></script>
        <!--  libreria js -->
        <script src="<?=BASE_URL_SITO?>js/library.inc.js.php"></script>

        <? include_module('switch.js.inc.php'); ?>
        <?php
            echo '<!-- Data Table Css -->'."\r\n";
            echo '<link rel="stylesheet" type="text/css" href="'.CDN_URL_SITO.'css/dataTables.bootstrap4.min.css">'."\r\n";
            echo '<link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" rel="stylesheet">'."\r\n";
            echo '<link href="https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.dataTables.min.css" rel="stylesheet">'."\r\n";
            echo '<link href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css" rel="stylesheet"> '."\r\n";  
            echo '<!-- data-table js -->'."\r\n";
            echo '<script type="text/javascript" src="'.CDN_URL_SITO.'plugin/moment-2.29.1/moment-with-locales.js"></script>'."\r\n"; 
            echo '<script type="text/javascript" src="'.CDN_URL_SITO.'js/jquery.dataTables.min.js"></script>   '."\r\n";        
            echo '<script type="text/javascript" src="'.CDN_URL_SITO.'js/dataTables.bootstrap4.min.js"></script>'."\r\n";
            echo '<script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"></script>'."\r\n";
            echo '<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>'."\r\n";
            echo '<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>'."\r\n";
            echo '<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.3/js/buttons.flash.min.js"></script> '."\r\n";
            echo '<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> '."\r\n";
            echo '<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> '."\r\n";
            echo '<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> '."\r\n";
            echo '<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.3/js/buttons.html5.min.js"></script> '."\r\n";
            echo '<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.3/js/buttons.print.min.js"></script>  '."\r\n";
            echo '<script type="text/javascript" src="//cdn.datatables.net/plug-ins/1.11.4/sorting/formatted-numbers.js"></script>'."\r\n";
            echo '<script src="'.CDN_URL_SITO.'files/assets/pages/data-table/extensions/buttons/js/buttons.colVis.min.js"></script>'."\r\n";
            echo '<!-- Bootstrap date-time-picker js -->'."\r\n";
            echo '<script type="text/javascript" src="'.CDN_URL_SITO.'files/assets/pages/advance-elements/moment-with-locales.min.js"></script>'."\r\n";
            echo '<script type="text/javascript" src="'.CDN_URL_SITO.'files/bower_components/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>'."\r\n";
            echo '<script type="text/javascript" src="'.CDN_URL_SITO.'files/assets/pages/advance-elements/bootstrap-datetimepicker.min.js"></script>'."\r\n";
            echo '<script type="text/javascript" src="https://cdn.datatables.net/scroller/2.0.7/js/dataTables.scroller.min.js"></script>'."\r\n";
        ?>

    </head>
<body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded" vertical-nav-type="offcanvas">
        <div class="pcoded-overlay-box"></div>
            <div class="pcoded-container navbar-wrapper">