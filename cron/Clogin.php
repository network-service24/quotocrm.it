<?php
//session_start();

include($_SERVER['DOCUMENT_ROOT'].'/include/settings.inc.php');

$check = 1;

if($_REQUEST['action']=='lg'){

    $usr    = $_REQUEST["usr"];
    $pws    = $_REQUEST["pws"];
    $super  = $_REQUEST["superuser"];

    if($usr == "Op_network" && $pws == "Service_2022"){ 

        $check = 1;

        $_SESSION["accesso"] = 'abilitato'; 

        header('location:'.BASE_URL_SITO.'cron/index.php'.($super!=''?'?superuser='.$super:''));

        exit;

    }else{ 

        $Failed              = '<div class = "alert alert-danger">Dati di accesso non validi</div>';

        $_SESSION["accesso"] = 'negato'; 

        $check = 0;
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Amministrazione dei CRON dedicati a <?=NOME_AMMINISTRAZIONE?> v.<?=VERSIONE?></title>
    <!-- Nome della Web Application -->
    <meta name="application-name" content="<?=NOME_AMMINISTRAZIONE?> v.<?=VERSIONE?>">
    <!-- Autore -->
    <meta name="author" content="<?=AUTHOR?>">
    <!-- Proprietario del Software -->
    <meta name="copyright" content="<?=NAME_ADMIN?>">
    <!-- Favicon icon -->
    <link rel="icon" href="<?=BASE_URL_SITO?>favicon/favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>files/bower_components/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>files/assets/icon/font-awesome/css/font-awesome.min.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>files/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>css/custom.css">
    <!-- mio Style.css -->
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>css/style.css">
    <!-- Jquery -->
    <script type="text/javascript" src="<?=BASE_URL_SITO?>js/jquery-3.5.1.js"></script>
    <!-- validate password css -->
    <link rel="stylesheet" href="<?=BASE_URL_SITO?>validate-password/css/jquery.passwordRequirements.css" />

</head>

<body class="fix-menu">
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->

    <section class="login-block bloccovideo">
        <video autoplay muted loop><source src="<?=BASE_URL_SITO?>video/login2.mp4" type="video/mp4"></video>
    
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                        <div class="text-center">
                                <img src="<?=BASE_URL_SITO?>img/logotipo_quoto_2021.png" alt="QUOTO!"> 
                        </div>
                        <div class="auth-box card">
                            <div class="card-block z-depth-0">
                              <div class="text-center"><h2>Area riservata ai developer<//h2></div>
                                <form action="Clogin.php" method="post">
                                  <?if($Failed) echo $Failed;?>
                                    <div class="form-group">
                                      <input type="text" name="usr" id="usr" class="form-control" placeholder="UserName" autocomplete="new_password">
                                    </div>
                                    <div class="form-group">
                                      <input type="text" name="pws" id="pws" class="form-control" placeholder="PassWord" autocomplete="new_password">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-right">
                                            <a href="javascript:;" id="slide_super" data-toogle="tooltip" title=" Campo per SuperUser"><i class="fa fa-sign-in"></i></a>
                                        </div>
                                    </div>
                                    <div class="form-group" id="super" style="display:none">
                                        <input type="text" name="superuser" id="superuser" class="form-control"  placeholder="SuperUser" autocomplete="new_password">
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="hidden" name="action" id="action" value="lg"/>
                                            <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
                                        </div>
                                  </div>
                                </form>
                                <div class="col-xs-12 text-center m-t-40">
                                    <small><?=NOME_AMMINISTRAZIONE?> <b>v</b> <span data-toogle="tooltip" title="<?=EXPLANE_VERSIONE?>"><?=VERSIONE?></span><br> Copyright <span id="licenza">&copy;</span> <?=date('Y')?> <a href="https://www.network-service.it" target="_blank">Network Service s.r.l.</a></small>
                                </div>
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
            <div class="clearfix p-t-10"></div>
            <!-- logo Network Service New-->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <img src="<?=BASE_URL_SITO?>class/resize.class.php?src=<?=BASE_PATH_SITO?>img/logo_network_2021.png&w=250&h=0&a=c&q=100">
                    </div>
                </div>
        </div>
        <!-- end of container-fluid -->
        
    </section>

    <!-- Required Jquery -->
    <script type="text/javascript" src="<?=BASE_URL_SITO?>files/bower_components/jquery/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?=BASE_URL_SITO?>files/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?=BASE_URL_SITO?>files/bower_components/popper.js/js/popper.min.js"></script>
    <script type="text/javascript" src="<?=BASE_URL_SITO?>files/bower_components/bootstrap/js/bootstrap.min.js"></script>
    <!-- validate password js -->
    <script src="<?=BASE_URL_SITO?>validate-password/js/jquery.passwordRequirements.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="<?=BASE_URL_SITO?>files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="<?=BASE_URL_SITO?>files/bower_components/modernizr/js/modernizr.js"></script>
    <script type="text/javascript" src="<?=BASE_URL_SITO?>files/bower_components/modernizr/js/css-scrollbars.js"></script>
    <!-- i18next.min.js -->
    <script type="text/javascript" src="<?=BASE_URL_SITO?>files/bower_components/i18next/js/i18next.min.js"></script>
    <script type="text/javascript" src="<?=BASE_URL_SITO?>files/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js"></script>
    <script type="text/javascript" src="<?=BASE_URL_SITO?>files/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js"></script>
    <script type="text/javascript" src="<?=BASE_URL_SITO?>files/bower_components/jquery-i18next/js/jquery-i18next.min.js"></script>
    <script type="text/javascript" src="<?=BASE_URL_SITO?>files/assets/js/common-pages.js"></script>

    <script>
        $("#slide_super").click(function() {
            $("#super").slideToggle( "slow" );
        });
    </script>
  </body>
</html>