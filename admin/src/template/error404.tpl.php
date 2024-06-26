<!DOCTYPE html>
<html lang="it" class="no-js">

<head>
    <meta charset="utf-8">
    <title>QUOTO! | Network Service s.r.l.</title>
    <meta name="description" content="Flat able 404 Error page design">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Codedthemes">
    <!-- ============== Resources style ============== -->
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>files/extra-pages/404/1/css/style.css">
    <script type="text/javascript" src="<?=BASE_URL_SITO?>files/bower_components/jquery/js/jquery.min.js"></script>  
</head>

<body class="bubble">
    <canvas id="canvasbg"></canvas>
    <canvas id="canvas"></canvas>
    <!-- Your logo on the top left -->
    <a href="<?=BASE_URL_ADMIN?>index/" class="logo-link" title="back home">
        <img src="<?=BASE_URL_SITO?>img/logo_quoto_2021_w.png" class="logo" alt="QUOTO">
    </a>
    <div class="content">
        <div class="content-box">
            <div class="big-content">
                <!-- Main squares for the content logo in the background -->
                <div class="list-square">
                    <span class="square"></span>
                    <span class="square"></span>
                    <span class="square"></span>
                </div>
                <!-- Main lines for the content logo in the background -->
                <div class="list-line">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </div>
                <!-- The animated searching tool -->
                <i class="fa fa-search color" aria-hidden="true"></i>
                <!-- div clearing the float -->
                <div class="clear"></div>
            </div>
            <!-- Your text -->
            <h1>Oops! Errore 404 file non trovato.</h1>
            <p>La pagina che stavi cercando non esiste.
                <br> Pensiamo che la pagina potrebbe essere stata spostata o rimossa.</p>

                <br><br>
                <h2>Tra qualche istante verrete re-diretti alla Dashboard di <?=NOME_AMMINISTRAZIONE?></h2>
                <script>
                    $(document).ready(function(){
                        setTimeout(function() { 
                            document.location='<?=BASE_URL_ADMIN?>dashboard-index/';
                        }, 2000);
                    })
                </script> 
        </div>
    </div>
    <footer class="light">
        <ul>
            <li><a href="mailto:support@quoto.travel">Support</a></li>
            <li><a href="https://www.facebook.com/networkservice" target="_blank"><i class="fa fa-facebook"></i></a></li>
            <li><a href="https://www.linkedin.com/company/1249917/" target="_blank"><i class="fa fa-linkedin"></i></a></li>
        </ul>
    </footer>
    <script src="<?=BASE_URL_SITO?>files/extra-pages/404/1/js/jquery.min.js"></script>
    <script src="<?=BASE_URL_SITO?>files/extra-pages/404/1/js/bootstrap.min.js"></script>
    <!-- Bubble plugin -->
    <script src="<?=BASE_URL_SITO?>files/extra-pages/404/1/js/bubble.js"></script>
</body>

</html>
