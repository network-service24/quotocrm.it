<?php
/**
 * TODO:
 * ! Una volta pubblicato il nuovo QUOTO v3 eliminare 3 file cron da https://cronjob.suiteweb.it e riprodurli su ServerPlan
 * * /avvisi_rinnovi/sendQuoto.php
 * * /avvisi_rinnovi/invioAvvisoLoginQuoto.php
 * * /avvisi_rinnovi/sync_scadenze_hospitality.php
 */
//session_start();

include($_SERVER['DOCUMENT_ROOT'].'/include/settings.inc.php');
include($_SERVER['DOCUMENT_ROOT'].'/include/declaration.inc.php');

if($_SESSION['accesso']=='negato'){

    header('location:'.BASE_URL_SITO.'cron/Clogin.php');

    exit;
}

if($_REQUEST['superuser']=='operatore_network') $_SESSION['superuser']='operatore_network';
    if($_REQUEST['superuser']=='operatore_network' || $_SESSION['superuser']=='operatore_network'){



        $query = "SELECT utenti.idsito, siti.web 
                    FROM utenti 
                    INNER JOIN siti ON siti.idsito = utenti.idsito 
                    WHERE 1=1
                    AND utenti.blocco_accesso = 0 
                    AND siti.hospitality = 1
                    AND siti.data_start_hospitality <= '".date('Y-m-d')."' 
                    AND siti.data_end_hospitality > '".date('Y-m-d')."'
                    ORDER BY siti.web ASC";
        $res      = $dbMysqli->query($query);

        foreach($res as $key => $record){
            $listasiti .='<option value="'.$record['idsito'].'">'.$record['web'].'</option>';

        }

$voci ='<script>
            function check(url) {
                if (window.confirm("ATTENZIONE: Sicuro di voler lanciare il CRON?")) {
                    location.href = url;
                } else {

                }
            }
        </script>'."\r\n";
$voci .='<p>ATTENZIONE: una volta cliccato un link, si aprirà un alert che vi informa dell\'operazione in atto, se si prosegue confermando, il file di CRON verrà lanciato senza poterlo sospendere!</p>
        <ul>
            <li>
                <a href="javascript:check(\'https://'.$_SERVER['HTTP_HOST'].'/cron/re_call.php\');">Lancia re_call preventivi</a>
            </li>
            <li>
                <a href="javascript:check(\'https://'.$_SERVER['HTTP_HOST'].'/cron/re_send.php\');">Lancia re_send conferme</a>
            </li>
            <li>
                <a href="javascript:check(\'https://'.$_SERVER['HTTP_HOST'].'/cron/re_selling.php\');">Lancia re_selling email di benvenuto</a>
            </li>
            <li>
                <a href="javascript:check(\'https://'.$_SERVER['HTTP_HOST'].'/cron/re_checkin.php\');">Lancia re_checkin email prima di effettuare il checkin</a>
            </li>
            <li>
                <a href="javascript:check(\'https://'.$_SERVER['HTTP_HOST'].'/cron/cs_send.php\');">Lancia cs_send email del questionario</a>
            </li>
            <li>
                <a href="javascript:check(\'https://'.$_SERVER['HTTP_HOST'].'/cron/pre_checkin.php\');">Lancia pre_checkin email per la compilazione del checkin online</a>
            </li>
            <li>
                <a href="javascript:check(\'https://'.$_SERVER['HTTP_HOST'].'/cron/azzera_smtp.php\');">Lancia azzera_smtp codice per azzerare contatore SMTP</a>
            </li>
            <li>
                <a href="javascript:check(\'https://'.$_SERVER['HTTP_HOST'].'/cron/listino_parity.php\');">Lancia sincronizzazione listino con Channel Manager ParityRate</a>
            </li>
            <li>
                <a href="javascript:check(\'https://'.$_SERVER['HTTP_HOST'].'/cron/recensioni_send.php\');">Lancia richiesta recensioni</a>
            </li>
            <li>
                <a href="javascript:check(\'https://'.$_SERVER['HTTP_HOST'].'/cron/recensioni_punteggio_send.php\');">Lancia richiesta recensioni a punteggio</a>
            </li>
        </ul>
        <div style="clear:both;height:10px"></div>
        <h2>File di CRON (personalizzati) con variabili:</h2>
        <div class="row">
            <div class="col-md-4">
                <p><label>Sito</label> 
                <select name="idsito" id="idsito" class="form-control">
                    <option value="1740">test.suiteweb.it</option>
                    '.$listasiti.'
                </select>
                </p>
                <p><label>Data</label><input type="date" name="data" id="data" value="'.date('Y-m-d').'" class="form-control" /></p>
                <p><a href="'.BASE_URL_SITO.'cron/index.php" class="btn btn-warning" >Reset Variabili</a> <button type="button" class="btn btn-success" name="invio" id="set">Imposta Variabili</button></p>
            </div>
            <div class="col-md-8"></div>
        </div>
        <div style="clear:both;height:20px"></div>
        <p>Una volta impostate le variabili puoi cliccare sui link che avranno modificato il loro indirizzo, da generico <small>(azzurro)</small> a personalizzato <small>(arancio)</small>!</p>
        <div id="variabili_set"></div>
        <ul>
            <li>
            <div id="re_call_test"></div>
            </li>
            <li>
                <div id="re_send_test"></div>
            </li>
            <li>
                <div id="re_selling_test"></div>
            </li>
            <li>
                <div id="re_checkin_test"></div>
            </li>
            <li>
                <div id="cs_send_test"></div>
            </li>
            <li>
                <div id="pre_checkin_test"></div>
            </li>
            <li>
                <div id="azzera_smtp_test"></div>              
            </li>
            <li>
                <div id="listino_parity_test"></div>              
            </li>
            <li>
                <div id="recensioni_send_test"></div>              
            </li>
           <li>
                <div id="recensioni_punteggio_send_test"></div>              
            </li>
        </ul>';
    }else{
        $voci ='<ul>
                    <li>
                        re_call preventivi
                    </li>
                    <li>
                        re_send conferme
                    </li>
                    <li>
                        re_selling email di benvenuto
                    </li>
                    <li>
                        re_checkin email prima di effettuare il checkin
                    </li>
                    <li>
                        cs_send email del questionario
                    </li>
                    <li>
                        pre_checkin email per la compilazione del checkin online
                    </li>
                    <li>
                        azzera_smtp codice per azzerare contatore SMTP
                    </li>
                    <li>
                        sincro listino parity
                    </li>
                    <li>
                        richiesta recensioni
                    </li>
                    <li>
                        richiesta recensioni a punteggio
                    </li>
                </ul>';
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
        <div class="content p-20">
            <div class="row">
                <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <?php
                            echo '<div class="row"><div class="col-md-10"><h1>Lista dei cron</h1></div><div class="col-md-2"><a href="Clogout.php" class="btn btn-info"><i class="fa fa-power-off"></i> Logout</a></div></div>';
                            echo $voci;
                        ?>
                        <br><br>
                        <div class="col-md-2"><a href="<?=BASE_URL_SITO?>log/list.php"  class="btn bg-purple"><i class="fa fa-list"></i> Log CRON (Ufficiali)</a></div>
                        <!-- <div class="col-md-2"><a href="<?=BASE_URL_SITO?>cron/test/log/list.php"  class="btn bg-black"><i class="fa fa-list"></i> Log CRON (di test e/o personalizzati)</a></div> -->
                    </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    <!-- jQuery 2.1.4 -->
    <script src="<?=BASE_URL_SITO?>plugin/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?=BASE_URL_SITO?>plugin/bootstrap/js/bootstrap.min.js"></script>
    <?php echo'
    <script>
            $(document).ready(function(){

                $("#re_call_test").html("<a href=\"javascript:check(\'https://'.$_SERVER['HTTP_HOST'].'/cron/test/re_call_test.php\');\">Lancia re_call preventivi (full di test)</a>");

                $("#re_send_test").html("<a href=\"javascript:check(\'https://'.$_SERVER['HTTP_HOST'].'/cron/test/re_send_test.php\');\">Lancia re_send conferme (full di test)</a>");

                $("#re_selling_test").html("<a href=\"javascript:check(\'https://'.$_SERVER['HTTP_HOST'].'/cron/test/re_selling_test.php\');\">Lancia re_selling email di benvenuto (full di test)</a>");

                $("#re_checkin_test").html("<a href=\"javascript:check(\'https://'.$_SERVER['HTTP_HOST'].'/cron/test/re_checkin_test.php\');\">Lancia re_checkin email prima di effettuare il checkin (full di test)</a>");

                $("#cs_send_test").html("<a href=\"javascript:check(\'https://'.$_SERVER['HTTP_HOST'].'/cron/test/cs_send_test.php\');\">Lancia cs_send email del questionario (full di test)</a>");

                $("#pre_checkin_test").html("<a href=\"javascript:check(\'https://'.$_SERVER['HTTP_HOST'].'/cron/test/pre_checkin_test.php\');\">Lancia pre_checkin email per la compilazione del checkin online (full di test)</a>");

                $("#azzera_smtp_test").html("<a href=\"javascript:check(\'https://'.$_SERVER['HTTP_HOST'].'/cron/test/azzera_smtp_test.php\');\">Lancia azzera_smtp codice per azzerare contatore SMTP (full di test)</a>");

                $("#listino_parity_test").html("<a href=\"javascript:check(\'https://'.$_SERVER['HTTP_HOST'].'/cron/test/listino_parity_test.php\');\">Lancia sincronizzazione listino con Channel Manager ParityRate (full di test)</a>");

                $("#recensioni_send_test").html("<a href=\"javascript:check(\'https://'.$_SERVER['HTTP_HOST'].'/cron/test/recensioni_send_test.php\');\">Lancia richiesta recensioni (full di test)</a>");

                $("#recensioni_punteggio_send_test").html("<a href=\"javascript:check(\'https://'.$_SERVER['HTTP_HOST'].'/cron/test/recensioni_punteggio_send_test.php\');\">Lancia richiesta recensioni a punteggio (full di test)</a>");

                $("#set").on("click",function(){

                    var data = $("#data").val();
                    var idsito = $("#idsito").val();

                    var url_re_call_test        = "https://'.$_SERVER['HTTP_HOST'].'/cron/test/re_call_test.php?data=" + data + "&idsito=" + idsito;
                    var url_re_send_test        = "https://'.$_SERVER['HTTP_HOST'].'/cron/test/re_send_test.php?data=" + data + "&idsito=" + idsito;
                    var url_re_selling_test     = "https://'.$_SERVER['HTTP_HOST'].'/cron/test/re_selling_test.php?data=" + data + "&idsito=" + idsito;
                    var url_re_checkin_test     = "https://'.$_SERVER['HTTP_HOST'].'/cron/test/re_checkin_test.php?data=" + data + "&idsito=" + idsito;
                    var url_cs_send_test        = "https://'.$_SERVER['HTTP_HOST'].'/cron/test/cs_send_test.php?data=" + data + "&idsito=" + idsito;
                    var url_pre_checkin_test    = "https://'.$_SERVER['HTTP_HOST'].'/cron/test/pre_checkin_test.php?data=" + data + "&idsito=" + idsito;
                    var url_azzera_smtp_test    = "https://'.$_SERVER['HTTP_HOST'].'/cron/test/azzera_smtp_test.php?data=" + data + "&idsito=" + idsito;
                    var url_listino_parity_test = "https://'.$_SERVER['HTTP_HOST'].'/cron/test/listino_parity_test.php?data=" + data + "&idsito=" + idsito;
                    var url_recensioni_send_test = "https://'.$_SERVER['HTTP_HOST'].'/cron/test/recensioni_send_test.php?data=" + data + "&idsito=" + idsito;
                    var url_recensioni_punteggio_send_test = "https://'.$_SERVER['HTTP_HOST'].'/cron/test/recensioni_punteggio_send_test.php?data=" + data + "&idsito=" + idsito;


                    $("#re_call_test").html("<a href=\"javascript:check(\'"+url_re_call_test+"\');\" class=\"text-orange\">Lancia re_call preventivi (a doc di test)</a>");

                    $("#re_send_test").html("<a href=\"javascript:check(\'"+url_re_send_test+"\');\" class=\"text-orange\">Lancia re_send conferme (a doc di test)</a>");

                    $("#re_selling_test").html("<a href=\"javascript:check(\'"+url_re_selling_test+"\');\" class=\"text-orange\">Lancia re_selling email di benvenuto (a doc di test)</a>");

                    $("#re_checkin_test").html("<a href=\"javascript:check(\'"+url_re_checkin_test+"\');\" class=\"text-orange\">Lancia re_checkin email prima di effettuare il checkin (a doc di test)</a>");

                    $("#cs_send_test").html("<a href=\"javascript:check(\'"+url_cs_send_test+"\');\" class=\"text-orange\">Lancia cs_send email del questionario (a doc di test)</a>");

                    $("#pre_checkin_test").html("<a href=\"javascript:check(\'"+url_pre_checkin_test+"\');\" class=\"text-orange\">Lancia pre_checkin email per la compilazione del checkin online (a doc di test)</a>");
                    
                    $("#azzera_smtp_test").html("<a href=\"javascript:check(\'"+url_azzera_smtp_test+"\');\" class=\"text-orange\">Lancia azzera_smtp codice per azzerare contatore SMTP (a doc di test)</a>");
                   
                    $("#listino_parity_test").html("<a href=\"javascript:check(\'"+url_listino_parity_test+"\');\" class=\"text-orange\">Lancia sincronizzazione listino con Channel Manager ParityRate (a doc di test)</a>");

                    $("#recensioni_send_test").html("<a href=\"javascript:check(\'"+url_recensioni_send_test+"\');\" class=\"text-orange\">Lancia  richiesta recensioni (a doc di test)</a>");

                    $("#recensioni_punteggio_send_test ").html("<a href=\"javascript:check(\'"+url_recensioni_punteggio_send_test+"\');\" class=\"text-orange\">Lancia  richiesta recensioni a punteggio (a doc di test)</a>");

                    $("#variabili_set").html("<p style=\"color:green\">Le variabili sono state impostate!</p>");
                    setTimeout(function(){
                        $("#variabili_set").hide();
                      }, 3000);
                });
            });
        </script>';
        ?>
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
  </body>
</html>