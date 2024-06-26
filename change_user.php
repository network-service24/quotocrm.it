<?php
  include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
  include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

    if($_REQUEST['idsito']){
      /**LISTA UTENTI CON ACCESSI DI LIVELLO */
      $utenti_result = 'SELECT * FROM utenti_quoto WHERE idsito = '.base64_decode($_REQUEST['idsito']).' AND abilitato = 1 AND utenti = 0';
      $array_res = $dbMysqli->query($utenti_result);
      if(sizeof($array_res)>0){
        foreach($array_res as $key => $record_utenti){
            $lista_utenti .= '<option value="'.$record_utenti['username'].'">'.$record_utenti['nome'].'</option>';
        }
      }
      /** FINE LISTA UTENTI CON ACCESSI DI LIVELLO */
    }
    $username   = DB_USER;
    $password   = DB_PASSWORD;
    $host       = HOST;
    $dbname     = DATABASE;
    // imposto il charset UTF-8
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

    try
    {
        // connessione al db via PDO
        $db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options);

    }
    catch(PDOException $ex)
    {
         die("Fallita la connessione al database: " . $ex->getMessage());
    }
    // This statement configures PDO to throw an exception when it encounters
    // an error.  This allows us to use try/catch blocks to trap database errors.
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // This statement configures PDO to return database rows from your database using an associative
    // array.  This means the array will have string indexes, where the string value
    // represents the name of the column in your database.
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // imposto anche il browser in UTF-8
   // header('Content-Type: text/html; charset=utf-8');

    session_destroy();
    session_start();


    // This variable will be used to re-display the user's username to them in the
    // login form if they fail to enter the correct password.  It is initialized here
    // to an empty value, which will be shown if the user has not submitted the form.
    $submitted_username = '';

    // This if statement checks to determine whether the login form has been submitted
    // If it has, then the login code is run, otherwise the form is displaye

    if($_REQUEST['action']=='Login_change' && $_REQUEST['idsito']!='')
    {
        // This query retreives the user's information from the database using
        // their username.
        $query = "SELECT utenti.*,
                        utenti_quoto.nome,
                        utenti_quoto.utenti,
                        utenti_quoto.unique_display,
                        utenti_quoto.config1,
                        utenti_quoto.config2,
                        utenti_quoto.config3,
                        utenti_quoto.config4,
                        utenti_quoto.config5,
                        utenti_quoto.config6,
                        utenti_quoto.dashboard_box,
                        utenti_quoto.statistiche,
                        utenti_quoto.crea_proposta,
                        utenti_quoto.preventivi,
                        utenti_quoto.conferme,
                        utenti_quoto.prenotazioni,
                        utenti_quoto.profila,
                        utenti_quoto.giudizi,
                        utenti_quoto.archivio,
                        utenti_quoto.schedine,
                        utenti_quoto.content_email,
                        utenti_quoto.content_landing,
                        utenti_quoto.anteprima_email,
                        utenti_quoto.anteprima_landing,
                        utenti_quoto.screenshots,
                        utenti_quoto.comunicazioni,
                        siti.web as cliente
                    FROM utenti
                    INNER JOIN siti ON siti.idsito = utenti.idsito
                    LEFT JOIN utenti_quoto ON utenti_quoto.idsito = utenti.idsito
                    WHERE 1 = 1
                    AND ((utenti.username = :username AND utenti.password = :password) OR (utenti_quoto.username = :username AND utenti_quoto.password = :password AND utenti_quoto.abilitato = 1))
                    AND utenti.blocco_accesso = 0
                    AND siti.hospitality = 1
                    AND siti.data_start_hospitality <= '".date('Y-m-d')."'
                    AND siti.data_end_hospitality > '".date('Y-m-d')."'";

        // The parameter values
        $query_params = array(
            ':username' => $_REQUEST['username'],
            ':password' => base64_encode($_REQUEST['password'])
        );

        try
        {
            // Execute the query against the database
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex)
        {
            // Note: On a production website, you should not output $ex->getMessage().
            // It may provide an attacker with helpful information about your code.
            die("Interrogazione fallita: " . $ex->getMessage());
        }

        // This variable tells us whether the user has successfully logged in or not.
        // We initialize it to false, assuming they have not.
        // If we determine that they have entered the right details, then we switch it to true.
        $login_ok = false;

        // Retrieve the user data from the database.  If $row is false, then the username
        // they entered is not registered.
        $row = $stmt->fetch();
        if($row)
        {
            $login_ok = true;
        }

        // If the user logged in successfully, then we send them to the private members-only page
        // Otherwise, we display a login failed message and show the login form again
        if($login_ok)
        {

            $_SESSION['user_accesso'] = $_REQUEST['username'];
            $_SESSION['pass_accesso'] = base64_encode($_REQUEST['password']);

            // rimuovo i dati sensibili prima di salvare la sessione
            unset($row['Password']);

            // This stores the user's data into the session at the index 'user'.
            // We will check this index on the private members-only page to determine whether
            // or not the user is logged in.  We can also use it to retrieve
            // the user's details.
            $_SESSION['provenienza'] = $_REQUEST['provenienza'];
            $_SESSION['utente'] = $row;

            // salvo il log degli accessi
            ########################################################
            $user    = DB_USER;
            $pass    = DB_PASSWORD;
            $host_qt = HOST;
            $db      = DATABASE;
            $op      = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
            $db_qt   = new PDO("mysql:host={$host_qt};dbname={$db};charset=utf8", $user, $pass, $op);

            $sql = "INSERT INTO
                        hospitality_log_accessi
                        (idsito,utente,nome_utente,host,remote,user_agent,data_ora)
                    VALUES
                        ('".$_SESSION['utente']['idsito']."',
                        '".$_SESSION['utente']['username']."',
                        '".$_SESSION['utente']['cliente']."',
                        '".$_SERVER['HTTP_HOST']."',
                        '".$_SERVER['REMOTE_ADDR']."',
                        '".$_SERVER['HTTP_USER_AGENT']."',
                        '".mktime(date('H'),date('i'),date('s'),date('m'),date('d'),date('Y'))."')";
            $db_qt->query($sql);
            ########################################################

            // salvao la sessione utente in un cookie
            //setcookie("cookie_utente",$_SESSION['utente']['idutente']);


            // Redirect the user to the private members-only page.
           header("Location: ".BASE_URL_SITO."dashboard-index/");

            die("Stai per essere reindirizzato a QUOTO!");
        }
        else
        {
            // Tell the user they failed
            $LoginFailed = '<div class="alert alert-danger m-t-20">Dati di accesso non validi</div>';

            // Show them their username again so all they have to do is enter a new
            // password.  The use of htmlentities prevents XSS attacks.  You should
            // always use htmlentities on user submitted values before displaying them
            // to any users (including the user that submitted them).  For more information:
            // http://en.wikipedia.org/wiki/XSS_attack
            $submitted_username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8');
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

    <section class="login-block bloccovideo">
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
                    <div class="form-group m-t-40">

            <div class="login-box card">
                <div class="card-body">
                  <form class="form-horizontal form-material" action="change_user.php" method="post" id="FormLogin_change" name="FormLogin_change">
                      <?php if(MANUTENZIONE == 0){ ?>
                          <? if($LoginFailed) echo $LoginFailed ?>
                          <div id="view_loading_login"></div>
                        </br>
                      <div id="content_login">
                        <div class="text-center"><h2>Disconnetti e cambia utente sul nuovo CRM QUOTO v.<?=VERSIONE?></h2></div>
                            <?php if($_REQUEST['idsito']){?>
                                <div class="form-group">
                                  <div class="col-xs-12 text-center">
                                    <div class="user-thumb text-center">
                                    <?php if($_REQUEST['icona_utente']!=''){?><img alt="thumbnail" class="img-circle" width="100" src="<?=BASE_URL_SITO?>img/<?=base64_decode($_REQUEST['icona_utente'])?>"><?}?> </div>
                                    <label><b><?=base64_decode($_REQUEST['nome_utente'])?></b> </br>Cambia Utente</label>
                                  </div>
                                </div>
                                  <div class="form-group m-t-40">
                                      <div class="col-xs-12">
                                          <select  name="username" required="" class="form-control">
                                            <option value="">selezione utente</option>
                                              <?=$lista_utenti?>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-xs-12">
                                            <div class="nput-group-append input-group">
                                                <input type="password" name="password" id="view_password" required="" value="<?php echo $pw_cookie?>" class="form-control" placeholder="Password" />
                                                <span class="input-group-addon bg-warning" id="view" style="cursor: pointer;" title="Clicca per vedere o nascondere la password"><i class="fa fa-eye" id="open"></i></span>
                                            </div>
                                      </div>
                                  </div>
                                  <div class="form-group text-center m-t-20">
                                      <div class="col-xs-12">
                                          <input type="hidden" name="idsito" value="<?=$_REQUEST['idsito']?>">
                                          <input type="hidden" name="nome_utente" value="<?=$_REQUEST['nome_utente']?>">
                                          <input type="hidden" name="action" value="Login_change">
                                          <button class="btn btn-info btn-md btn-block text-uppercase waves-effect waves-light" type="submit">RI-Entra in <?=NOME_AMMINISTRAZIONE?></button>
                                      </div>
                                  </div>
                            <?}else{?>
                                  <div class="alert alert-warning">Hai raggiunto questa pagina senza avere i permessi di accesso!<br />Vai alla schermata di LogIn.</div>
                            <?}?>
                          <?}else{?>
                              <div class="alert alert-warning">Il CRM è temporaneamente in manutenzione per aggiornamenti. Torneremo online il prima possibile!<br />Per maggiori informazioni o interventi sul tuo sito contatta lo staff Network Service.<br /><a href="mailto:aggiornamenti@network-service.it">aggiornamenti@network-service.it</a></div>
                          <?}?>
                      </div>
                  </form>
                    <div class="col-xs-12 text-center m-t-20">
                      <a href="<?=BASE_URL_SITO?>login.php">&larr; Torna al login!</a>
                    </div>
                    <div class="col-xs-12 text-center m-t-20">
                        <small><?=NOME_AMMINISTRAZIONE?> <b>v</b> <?=VERSIONE?><br> Copyright <span id="licenza">&copy;</span> <?=date('Y')?> <a href="http://www.network-service.it">Network Service s.r.l.</a></small>
                    </div>
                </div>
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
          $('#view').on('click', function () {
              if($('#view_password').attr('type')=='password'){
                  $('#view_password').attr('type','text');
                  $('#open').removeClass('fa-eye');
                  $('#open').addClass('fa-eye-slash');
              }else{
                  $('#view_password').attr('type','password');
                  $('#open').removeClass('fa-eye-slash');
                  $('#open').addClass('fa-eye');
              }
          });
          $("#FormLogin_change").on("submit",function(){
              $("#view_loading_login").html('<div class="row"><div class="col-md-12 text-center"><img src="<?=BASE_URL_SITO?>img/Ellipsis-1s-200px.gif" alt="Login al CRM QUOTO v.<?=VERSIONE?>"></div></div><div class="row"><div class="col-md-12 text-center"><small>Attendere il termine dell\'operazione di Login!</small></div></div>');
              $("#content_login").hide();
          });
        });
    </script>
</body>

</html>
