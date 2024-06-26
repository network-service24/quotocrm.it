<?php
header('Location:https://www.quotocrm.it/login.php');
exit;
            header("Expires: on, 01 Jan 1970 00:00:00 GMT");
            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header("Cache-Control: no-store, no-cache, must-revalidate");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");

            require($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");

     		//error_reporting(0);

            $username   = DB_SUITEWEB_USER;
            $password   = DB_SUITEWEB_PASSWORD;
            $host       = DB_SUITEWEB_HOST;
            $dbname     = DB_SUITEWEB_NAME;
            $LoginFailed = false;
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
            // If it has, then the login code is run, otherwise the form is displayed
            if(!empty($_REQUEST))
            {
                // This query retreives the user's information from the database using
                // their username.
                $query = "SELECT utenti.*,
                                utenti_quoto.nome as nome_utente,
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
                   // controllo i 3 mesi per modifica pass
                 /*  if(IS_NETWORK_SERVICE_USER==0){
                        if($row['is_admin']==0){ // solo per i clienti 
                            $data_ = explode("-",$row['data_account']);
                            $d = $data_[2];
                            $m = $data_[1];
                            $y = $data_[0];

                            $check_date = mktime (0,0,0,($m+3),$d,$y);
                            $data_account = date('Y-m-d',$check_date);   
                            if(date('Y-m-d')>=$data_account){
                                $login_ok = false;
                                echo '
                                        <form  action="'.BASE_URL_SITO.'login.php" method="POST" name="form_p_check" id="form_p_check" >
                                            <input type="hidden" name="pass_scaduta" id="pass_scaduta"  value="1"/>
                                        </form>'."\r\n";
                                    
                                echo '  <script language="JavaScript">
                                                document.form_p_check.submit();
                                        </script>'."\r\n";
                                exit;
                            }
                        }
                    }*/

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

					// utilizzo dei cookie per ricordare i dati di login
					if(isset($_REQUEST["remember_cookie"]) || isset($_COOKIE["remember_cookie"])){

						setcookie("un_cookie", $_SESSION['utente']['username']);
						setcookie("pw_cookie", $_SESSION['utente']['password']);
						setcookie("remember_cookie", 'checked');

					}else{
						setcookie("un_cookie", null);
						setcookie("pw_cookie", null);
						setcookie("remember_cookie", null);

						$un_cookie = '';
						$pw_cookie = '';
						$remember_cookie = '';
					}


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


		if(isset($_COOKIE["un_cookie"])){
			$un_cookie = $_COOKIE["un_cookie"];
		}else{
			$un_cookie = '';
		}
		if(isset($_COOKIE["pw_cookie"])){
			$pw_cookie = $_COOKIE["pw_cookie"];
		}else{
			$pw_cookie = '';
		}
		if(isset($_COOKIE["remember_cookie"])){
			$remember_cookie = $_COOKIE["remember_cookie"];
		}else{
			$remember_cookie = '';
		}

    // anti SQL INJECTION

?>
<!DOCTYPE html>
<html lang="en">

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
    <link rel="stylesheet" href="<?=BASE_URL_SITO?>validate-password/css/jquery.passwordRequirements.css" />
    <style>
        @media  (max-width: 600px) {
            .g-recaptcha {
            -webkit-transform: scale(.80);
            transform: scale(.80);
            -webkit-transform-origin: 0 0;
            transform-origin: 0 0;
            }
        }
        .content_slogan .slogan1{
                position:absolute;
                left:200px;
                top:50%;
                font-size:60px;
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
            #username_check::placeholder {
                color: #00acd6 !important;
                font-size: 13px;
            }
            #mod_password::placeholder {
                color: #ff851b !important;
                font-size: 13px;
            }
            #email_quoto::placeholder {
                color: #00acd6 !important;
                font-size: 13px;
            }
    </style>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <section id="wrapper" class="login-register login-sidebar" style="background-image:url(<?=BASE_URL_SITO?>material/assets/images/background/login-quoto.jpg);">
    <div class="content_slogan">
        <div class="slogan1">Benvenuti sul nuovo CRM QUOTO v.2</div>
    </div>
        <div class="login-box card">
            <div class="card-body">
            <?php if($_POST['pass_scaduta'] == 0){ ?>
                    <form class="form-horizontal form-material" action="login.php" method="post" id="FormLogin" name="FormLogin">
                        <a href="javascript:void(0)" class="text-center db"><img src="<?=BASE_URL_SITO?>img/logo.png" alt="QUOTO!" style="width:100%" /></a>
                        <?php if(MANUTENZIONE == 0){ ?>
                            <? if($LoginFailed) echo $LoginFailed ?>
                            <div id="view_loading_login"></div>
                            <div id="content_login">
                                <div class="form-group m-t-40">
                                    <div class="col-xs-12">
                                        <input type="text" name="username" value="<?php echo $un_cookie?>" required="" class="form-control" placeholder="Nome Utente"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <div class="input-group-append input-group">
                                            <input type="password" name="password" id="view_password" required="" value="<?php echo $pw_cookie?>" class="form-control" placeholder="Password" />
                                            <span title="Clicca per vedere o nascondere la password" class="add-on input-group-text" style="cursor: pointer;" id="view">
                                                <i class="fas fa-eye" id="open"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="d-flex no-block align-items-center">
                                         <div class="checkbox checkbox-primary p-t-0">
                                            <input id="checkbox-signup" type="checkbox" name="remember_cookie" <?php echo $remember_cookie?> />
                                            <label for="checkbox-signup"> Ricordami </label>
                                        </div>
                                        <div class="ml-auto">
                                            <i class="fas fa-lock m-r-5 text-muted"></i> <a href="lost_password.php" id="to-recover" class="text-muted">Smarrito gli accessi?</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center m-t-20">
                                    <div class="col-xs-12">
                                        <button class="btn btn-info btn-md btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
                                    </div>
                                </div>
                            </div>
                                <div class="form-group m-b-0">
                                    <div class="col-sm-12 text-center">
                                        <a href="javascript:;" id="UserAction" class="btn btn-success btn-md btn-block waves-effect waves-light text-center"><small><i class="fas fa-user"></i> Crea primo account d'accesso!</small></a>
                                    </div>
                                </div>

                        <?}else{?>
                            <div class="alert alert-warning">Il CRM è temporaneamente in manutenzione per aggiornamenti. Torneremo online il prima possibile!<br />Per maggiori informazioni o interventi sul tuo sito contatta lo staff Network Service.<br /><a href="mailto:aggiornamenti@network-service.it">aggiornamenti@network-service.it</a></div>
                        <?}?>
                    </form>
                    <!-- primi  dati di accesso -->
                    <form name="form_create_user" id="FormAddUser" method="post" style="display:none" class="form-horizontal form-material" >
                    <a href="javascript:void(0)" class="text-center db"><img src="<?=BASE_URL_SITO?>img/logo.png" alt="QUOTO!" style="width:100%" /></a>
                        <div class="form-group">
                            <div class="col-xs-12 m-t-40">
                                <div id="risultato"></div>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Crea una UserName" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input type="text" name="password" id="password" class="form-control" placeholder="Crea una Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="La password deve contenere un numero e una lettera maiuscola e minuscola e almeno 8 caratteri e non più di 18"  minlength="8" maxlength="18" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input type="email" name="email_quoto" id="email_quoto" class="form-control" placeholder="Email registrata ed associata a Quoto" required />
                                <span id="check_email"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 text-center">
                                <div class="g-recaptcha" data-sitekey="6LeFyQ4UAAAAAEUgNPA1pIUaF6CQyXKtizfcoToS"></div>
                            </div>
                        </div>
                        <input type="hidden" name="action" value="check_user" />
                        <button type="submit" id="CreaUser" class="btn btn-info btn-md btn-block text-uppercase waves-effect waves-light">Crea</button>
                    </form>
                <?}?>
                <!-- modulo password scaduta -->
                <?php if($_POST['pass_scaduta'] == 1){?>
                        <form name="form_mod_pass" id="FormModPass" method="post"  class="form-horizontal form-material" >
                        <a href="javascript:void(0)" class="text-center db"><img src="<?=BASE_URL_SITO?>img/logo.png" alt="QUOTO!" style="width:100%" /></a>
                        <div class="m-t-40"></div>    
                        <div id="mess" class="alert alert-danger text-center">La Password per accedere a QUOTO! è scaduta! <br>Crea la tua nuova password!</div>     
                            <div class="form-group">
                                <div class="col-xs-12 m-t-40">
                                    <div id="risultato_pass"></div>
                                    <input type="text" name="username_check"  id="username_check" value="<?php echo $un_cookie?>"  class="form-control" placeholder="Inserisci la User che usi per accedere a Quoto" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">   
                                    <input type="text" name="mod_password" id="mod_password" class="pr-password form-control" placeholder="Crea la tua nuova Password"  autocomplete="off" minlength="8" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <input type="email" name="email_quoto" id="email_quoto" class="form-control" placeholder="Inserisci Email registrata ed associata a Quoto" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12 text-center">
                                    <div class="g-recaptcha" data-sitekey="6LeFyQ4UAAAAAEUgNPA1pIUaF6CQyXKtizfcoToS"></div>
                                </div>
                            </div>
                            <input type="hidden" name="action" value="check_pass" />
                            <button type="submit" id="CreaUser" class="btn btn-info btn-md btn-block text-uppercase waves-effect waves-light">Crea</button>
                        </form>
                    <?}?>
                    <div class="row m-t-40"  id="ContentAction2" style="display:none">
                        <br>
                        <div class="col-md-6 text-left">

                        </div>
                        <div class="col-md-6 text-right">
                            <a href="javascript:;" id="LoginAction">&larr; Torna al login!</a>
                        </div>
                        <br>
                    </div>
                    <div class="col-xs-12 text-center m-t-40">
                        <small><?=NOME_AMMINISTRAZIONE?> <b>v</b> <span data-toogle="tooltip" title="<?=EXPLANE_VERSIONE?>"><?=VERSIONE?></span><br> Copyright <span id="licenza">&copy;</span> <?=date('Y')?> <a href="https://www.network-service.it">Network Service s.r.l.</a></small>
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
    <script src="<?=BASE_URL_SITO?>validate-password/js/jquery.passwordRequirements.min.js"></script>
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

            $(".pr-password").passwordRequirements({
                    numCharacters: 8,
                    useLowercase:true,
                    useUppercase:true,
                    useNumbers:true,
                    useSpecial:false
             });


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

            $("#UserAction").on('click', function () {
                $('#FormLogin').hide();
                $('#FormAddUser').show();
                $('#nome').val('');
                $('#username').val('');
                $('#password').val('');
                $('#email_quoto').val('');
                $("#ContentAction2").show();
            });
            $("#LoginAction").on('click', function () {
                $('#FormAddUser').hide();
                $('#FormLogin').show();
                $("#ContentAction").show();
                $("#ContentAction2").hide();
            });
            $("#FormAddUser").on('submit', function () {
                var datiform = $('#FormAddUser').serialize();
                $.ajax({
                    url: "<?=BASE_URL_SITO?>ajax/send_mail_conferma_account.php",
                    type: "POST",
                    data: datiform,
                    dataType: "html",
                    success: function(data) {
                            $("#risultato").html('<div class="alert alert-danger">'+data+'</div>');
                            setTimeout(function(){
                            $("#risultato").fadeOut(200);
                            location.reload();
                            }, 6000);
                        }
                });
                return false; // con false senza refresh della pagina
            });
        $('#email_quoto').bind("keyup focusout", function () {
                var EmailCliente = $('#email_quoto').val();
                var EmailOperatore = '<?=MAIL_CHECK?>';
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
                                $("#CreaUser").removeAttr("disabled");
                            }else{
                                $("#check_email").html('<small class="text-red">email non valida ed inesistente</small>');
                                $("#CreaUser").attr("disabled","true");
                            }
                        },
                        error: function(){
                            alert("Chiamata fallita, si prega di riprovare...");
                        }
                    });
                }else{
                    $("#CreaUser").removeAttr("disabled");
                }

            });


            $("#FormModPass").on('submit', function () {
                var dati = $('#FormModPass').serialize();
                $.ajax({
                    url: "<?=BASE_URL_SITO?>ajax/login/send_mail_conferma_account.php",
                    type: "POST",
                    data: dati,
                    dataType: "html",
                    success: function(data) {
                            $("#mess").hide();
                            $("#risultato_pass").html('<div class="alert alert-info text-center">'+data+'</div>');
                        }
                });
                return false; 
            });


            $("#licenza").click(function () {
                window.open('<?=BASE_URL_SITO?>licenza.html', 'licenza', 'toolbar=no,scrollbars=no,resizable=no,top=500,left=500,width=400,height=120');
            });
            $("#FormLogin").on("submit",function(){
                $("#view_loading_login").html('<div class="row"><div class="col-md-12 text-center"><img src="<?=BASE_URL_SITO?>img/Ellipsis-1s-200px.gif" alt="Login al CRM QUOTO v2"></div></div><div class="row"><div class="col-md-12 text-center"><small>Attendere il termine dell\'operazione di Login!</small></div></div>');
                $("#content_login").hide();
            });
        });
    </script>
</body>
</html>
