<?php getExecutionTime();?>
<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=NOME_AMMINISTRAZIONE?> <?=VERSIONE?> | <?=NAME_ADMIN?></title>
    <meta name="description" content="CRM pensato per gli HOTEL: <?=NOME_AMMINISTRAZIONE?> <?=VERSIONE?> | <?=NAME_ADMIN?>">
    <meta name="author" content="<?=NAME_ADMIN?>">
    <!-- Favicon icon -->
    <link rel="icon" type="image/x-icon"  href="<?=BASE_URL_SITO?>favicon.ico">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?=BASE_URL_SITO?>bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/da6d3ea52f.js"></script>
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?=BASE_URL_SITO?>plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=BASE_URL_SITO?>dist/css/AdminLTE.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?=BASE_URL_SITO?>dist/css/skins/skin-green.min.css">

    <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>plugins/image-picker/image-picker.css">

    <link rel="stylesheet" href="<?=BASE_URL_SITO?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <link rel="stylesheet" href="<?=BASE_URL_SITO?>css/custom.css.php">
    <!-- toast CSS -->
    <link rel="stylesheet" href="<?=BASE_URL_SITO?>material/assets/plugins/toast-master/css/jquery.toast.css">

    <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>css/jquery.notify.css" />

    <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>css/animate.min.css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="<?=BASE_URL_SITO?>js/functions.js"></script>
    <!-- jQuery 2.1.4 -->
    <script src="<?=BASE_URL_SITO?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- ALERT -->
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>css/_alert.css" />
    <script src="<?=BASE_URL_SITO?>js/_alert.js"></script>
    <!-- setting varibili in js-->
    <?php include_module('variabili_js.inc.php');?>
    <!-- switch -->
    <?php include(BASE_PATH_SITO.'include/template/moduli/switch.inc.php')?>

    <script src="<?=BASE_URL_SITO?>js/library.inc.js.php"></script>
    <script>
        $(document).ready(function(){
          risoluzioneVideo();
        });
	</script>
  </head>
  <body class="hold-transition skin-green sidebar-mini fixed <?if($_SERVER['REQUEST_URI']=='/v2/newsletter/index/'?'fix-header fix-sidebar card-no-border':'')?>">
  <div class="wrapper">
