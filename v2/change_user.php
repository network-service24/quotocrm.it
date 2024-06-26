<?php
header('Location:https://www.quotocrm.it/change_user.php');
exit;
    require("include/settings.inc.php");

	//error_reporting(0);

    $username   = DB_SUITEWEB_USER;
    $password   = DB_SUITEWEB_PASSWORD;
    $host       = DB_SUITEWEB_HOST;
    $dbname     = DB_SUITEWEB_NAME;

    if($_REQUEST['idsito']){
      /**LISTA UTENTI CON ACCESSI DI LIVELLO */
      $conn_suiteweb = mysqli_connect($host, $username, $password, $dbname) or die ("Error connecting to database suiteweb");
      mysqli_set_charset($conn, 'utf8');
      $utenti_result = mysqli_query($conn_suiteweb,'SELECT * FROM utenti_quoto WHERE idsito = '.base64_decode($_REQUEST['idsito']).' AND abilitato = 1 AND utenti = 0');
      while($record_utenti = mysqli_fetch_assoc($utenti_result)){
        $lista_utenti .= '<option value="'.$record_utenti['username'].'">'.$record_utenti['nome'].'</option>';
      }
      /** FINE LISTA UTENTI CON ACCESSI DI LIVELLO */
    }
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

    session_start();
    $_SESSION = array();

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
            ':password' => $_REQUEST['password']
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
            $_SESSION['pass_accesso'] = $_REQUEST['password'];

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

            //$prt->_goto(BASE_URL_SITO.'dashboard-index/');
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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?=NOME_AMMINISTRAZIONE?> <?=VERSIONE?> | <?=NAME_ADMIN?>">
    <meta name="author" content="<?=NAME_ADMIN?>">
    <!-- Favicon icon -->
    <link rel="icon" type="image/x-icon"  href="<?=BASE_URL_SITO?>img/favicon.ico">
    <title><?=NOME_AMMINISTRAZIONE?> <?=VERSIONE?> | <?=NAME_ADMIN?></title>
    <!-- Bootstrap Core CSS -->
    <link href="<?=BASE_URL_SITO?>material/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?=BASE_URL_SITO?>material/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="<?=BASE_URL_SITO?>material/css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style>
    .content_slogan .slogan1{
            position:absolute;
            left:calc(100% - 70%);
            top:10%;
            font-size:30px;
            white-space:nowrap;
            color:#FFF;
            font-family: 'Questrial', sans-serif;
            text-shadow:
            -1px -1px 0 #333,
            1px -1px 0 #333,
            -1px 1px 0 #333,
            1px 1px 0 #333;
            opacity:1;
            transition:all 1s ease;

        }
        .padding10_all{
          padding:10px;
        }
        @media  (max-width: 600px) {
            .content_slogan .slogan1{
              display:none;
            }
        }

</style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">
        <div class="login-register" style="background-image:url(<?=BASE_URL_SITO?>material/assets/images/background/login-register.jpg);">
          <div class="content_slogan">
              <div class="slogan1">Disconnetti e cambia utente sul nuovo CRM QUOTO v.2</div>
          </div>
            <div class="login-box card">
                <div class="card-body">
                  <form class="form-horizontal form-material" action="change_user.php" method="post" id="FormLogin_change" name="FormLogin_change">
                    <a href="javascript:void(0)" class="text-center db"><img src="<?=BASE_URL_SITO?>img/logo.png" alt="QUOTO!" style="width:100%" /></a>
                      </br>
                      <?php if(MANUTENZIONE == 0){ ?>
                          <? if($LoginFailed) echo $LoginFailed ?>
                          <div id="view_loading_login"></div>
                        </br>
                      <div id="content_login">
                            <?php if($_REQUEST['idsito']){?>
                                <div class="form-group">
                                  <div class="col-xs-12 text-center">
                                    <div class="user-thumb text-center"> <img alt="thumbnail" class="img-circle" width="100" src="<?=BASE_URL_SITO?>dist/img/<?=base64_decode($_REQUEST['icona_utente'])?>"></div>
                                    <label><?=base64_decode($_REQUEST['nome_utente'])?> </br>Cambia Utente</label>
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
                                          <div class="input-group-append input-group">
                                              <input type="password" name="password" id="view_password" required="" value="" class="form-control" placeholder="Password" />
                                              <span title="Clicca per vedere o nascondere la password" class="add-on input-group-text" style="cursor: pointer;" id="view">
                                                  <i class="fas fa-eye" id="open"></i>
                                              </span>
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
                    <div class="clear m-t-20"></div>
                </div>
              </div>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?=BASE_URL_SITO?>material/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?=BASE_URL_SITO?>material/assets/plugins/popper/popper.min.js"></script>
    <script src="<?=BASE_URL_SITO?>material/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?=BASE_URL_SITO?>material/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?=BASE_URL_SITO?>material/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?=BASE_URL_SITO?>material/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="<?=BASE_URL_SITO?>material/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="<?=BASE_URL_SITO?>material/assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="<?=BASE_URL_SITO?>material/js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="<?=BASE_URL_SITO?>material/assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>

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
              $("#view_loading_login").html('<div class="row"><div class="col-md-12 text-center"><img src="<?=BASE_URL_SITO?>img/Ellipsis-1s-200px.gif" alt="Login al CRM QUOTO v2"></div></div><div class="row"><div class="col-md-12 text-center"><small>Attendere il termine dell\'operazione di Login!</small></div></div>');
              $("#content_login").hide();
          });
        });
    </script>
</body>

</html>
