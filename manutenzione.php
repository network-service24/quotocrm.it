<?php

    require("include/settings.inc.php");

      $frase_manutenzione = 'Il CRM è temporaneamente in manutenzione per aggiornamenti programmati.<br />Torneremo online il prima possibile!';
      //$frase_manutenzione = 'Il CRM è in manutenzione per importanti novità.<br />Stiamo caricando la nuova release di QUOTO!<br>Torneremo online entro 2 giorni circa!';

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
    <title><?=NOME_AMMINISTRAZIONE?> v.<?=VERSIONE?></title>
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

    <section class="login-block bloccovideo ">
        <video autoplay muted loop><source src="<?=BASE_URL_SITO?>video/login.mp4" type="video/mp4"></video>
    
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="text-center">
                        <img src="<?=BASE_URL_SITO?>img/logotipo_quoto_2021.png" alt="QUOTO!"> 
                    </div>
                </div>
            </div>
            <div class="auth-box card">
                <div class="card-block z-depth-0">
                  <div class="text-center"><h2>Quoto Engagement <br>&<br> Customer Satisfaction</h2></div>
                  <div class="alert alert-warning text-center"><?=$frase_manutenzione?><br />Per maggiori informazioni contatta lo staff Network Service.<br /><a href="mailto:support@quoto.travel">support@quoto.travel</a></div>
            </div>
        </div>
        <div class="clearfix p-t-10"></div>
        <!-- logo Network Service New-->
        <div class="row">
            <div class="col-md-12 text-center">
                <img src="<?=BASE_URL_SITO?>class/resize.class.php?src=<?=BASE_PATH_SITO?>img/logo_network_2021.png&w=250&h=0&a=c&q=100">
            </div>
        </div>

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
    <script type="text/javascript">
        var _iub = _iub || [];
        _iub.csConfiguration = {
            cookiePolicyId: 703738,
            siteId: 265459,
            lang: "it"
        };
        (function (w, d) {
            var loader = function () { var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src = "//cdn.iubenda.com/cookie_solution/iubenda_cs.js"; tag.parentNode.insertBefore(s, tag); };
            if (w.addEventListener) { w.addEventListener("load", loader, false); } else if (w.attachEvent) { w.attachEvent("onload", loader); } else { w.onload = loader; }
        })(window, document);
    </script>
    <script>
        $(document).ready(function () {

            $('#email').bind("keyup focusout", function () { 
                var EmailCliente = $('#email').val();
                var EmailOperatore = '<?=MAIL_NETWORK?>';
                if(EmailCliente.length>=2){
                    $.ajax({        
                        type: "POST",         
                        url: "<?=BASE_URL_SITO?>ajax/check_valid_email.php",        
                        data: "EmailCliente=" + EmailCliente + "&EmailOperatore=" + EmailOperatore,
                        dataType: "html",        
                        success: function(data){
                            var classe = '';
                            if(data == 'valid'){
                                $("#check_email").html('<small class="text-green">email valida ed esistente</small>');
                                $("#resend_account").removeAttr("disabled");
                            }else{
                                $("#check_email").html('<small class="text-red">email non valida ed inesistente</small>');
                                    $("#resend_account").attr("disabled","true");
                            }           
                        },
                        error: function(){
                            alert("Chiamata fallita, si prega di riprovare..."); 
                        }
                    });
                }else{
                    $("#resend_account").removeAttr("disabled");
                }
                
            });

        });
    </script> 

  </body>
</html>
