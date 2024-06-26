<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?=NOME_SUPER_ADMIN?> v.<?=VERSIONE?></title>
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
        <!-- Google font-->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
        <!-- Required Fremwork -->
        <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>files/bower_components/bootstrap/css/bootstrap.min.css">
        <!-- sweet alert framework -->
        <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>files/bower_components/sweetalert/css/sweetalert.css">
        <!-- lightbox Fremwork -->
        <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>files/bower_components/lightbox2/css/lightbox.min.css">
        <!-- themify-icons line icon -->
        <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>files/assets/icon/themify-icons/themify-icons.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>files/assets/icon/font-awesome/css/font-awesome.min.css">
        <!-- flag icon framework css -->
        <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>files/assets/icon/flag-icons/css/flag-icon.css">
        <!-- ico font -->
        <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>files/assets/icon/icofont/css/icofont.css">
        <!-- animation nifty modal window effects css -->
        <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>files/assets/css/component.css">
        <!-- feather Awesome -->
        <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>files/assets/icon/feather/css/feather.css">
        <!-- Notification.css -->
        <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>files/assets/pages/notification/notification.css">
        <!-- Switch component css -->
        <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>files/bower_components/switchery/css/switchery.min.css">
        <!-- Style.css -->
        <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>files/assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>files/assets/css/jquery.mCustomScrollbar.css">
        <!-- Date-time picker css -->
        <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>files/assets/pages/advance-elements/css/bootstrap-datetimepicker.css">
        <!-- Date-range picker css  -->
        <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>files/bower_components/bootstrap-daterangepicker/css/daterangepicker.css">
        <!-- Date-Dropper css -->
        <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>files/bower_components/datedropper/css/datedropper.min.css">
        <!-- Color Picker css -->
        <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>files/bower_components/spectrum/css/spectrum.css">
        <!-- Mini-color css -->
        <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>files/bower_components/jquery-minicolors/css/jquery.minicolors.css">
        <!-- list css -->
        <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>files/assets/pages/list-scroll/list.css">
        <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>files/bower_components/stroll/css/stroll.css"> 
        <!-- radial chart -->
        <link rel="stylesheet" href="<?=BASE_URL_SITO?>files/assets/pages/chart/radial/css/radial.css" type="text/css" media="all">
        <!-- Select 2 css -->
        <link rel="stylesheet" href="<?=BASE_URL_SITO?>files/bower_components/select2/css/select2.min.css">
        <!-- Multi Select css -->
        <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>files/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css">
        <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>files/bower_components/multiselect/css/multi-select.css">
        <!-- Jquery -->
        <script type="text/javascript" src="<?=BASE_URL_SITO?>js/jquery-3.5.1.js"></script>      
        <!-- Alert custom.css,js -->
        <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>css/_alert.css">
        <script type="text/javascript" src="<?=BASE_URL_SITO?>js/_alert.js"></script>
        
        <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>css/jquery.notify.css" />

        <script type="text/javascript" src="<?=BASE_URL_SITO?>js/custom_functions.js"></script>
        <script>
            $(document).ready(function() {

            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                        $('.js-switch').each(function() {
                            new Switchery($(this)[0], { color: '#00acc1'
                                                    , secondaryColor    : '#dfdfdf'
                                                    , jackColor         : '#fff'
                                                    , jackSecondaryColor: null
                                                    , className         : 'switchery'
                                                    , disabled          : false
                                                    , disabledOpacity   : 0.5
                                                    , speed             : '0.1s'
                                                    , size              : 'small' });

                        });
                $('.js-example-basic-multiple').select2();
            });
        </script> 

        <? include_once(BASE_PATH_ADMIN.'src/template/moduli/switch.libraries.inc.php'); ?>
        
        <script src="<?=BASE_URL_SITO?>plugin/clipboard.js-master/dist/clipboard.min.js"></script>
        <!--  custom.functions .js -->
        <link rel="stylesheet" type="text/css" href="<?=BASE_URL_ADMIN?>css/custom.css">
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