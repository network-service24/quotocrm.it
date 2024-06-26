<?php
ob_start();
            include_once($_SERVER['DOCUMENT_ROOT'].'/include/settings.inc.php');

            include_once($_SERVER['DOCUMENT_ROOT'].'/include/declaration.inc.php');

            $username   = DB_USER;
            $password   = DB_PASSWORD;
            $host       = HOST;
            $dbname     = DATABASE;
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
            //header('Content-Type: text/html; charset=utf-8');
            //session_start();

           session_destroy();
            session_start();


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

                $query = "SELECT 
                                *
                            FROM 
                                utenti_admin
                            WHERE 
                                utenti_admin.blocco_accesso = 0
                            AND 
                                utenti_admin.username = :username 
                            AND 
                                utenti_admin.password = :password ";

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

                    $_SESSION['utente'] = $row;

					$_SESSION['user_admin'] = $_SESSION['utente']['username'];
					$_SESSION['pass_admin'] = $_SESSION['utente']['password'];
                    ob_get_clean();
                    //$prt->_goto(BASE_URL_ADMIN.'index/');
                    header("Location: ".BASE_URL_ADMIN."index/");
                    die("Stai per essere reindirizzato a QUOTO!");
                }
                else
                {
                    // Tell the user they failed
                    $LoginFailed = '<div class="alert alert-danger m-t-20">Dati di accesso non validi</div>';

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
    <title>Super Amministrazione di <?=NOME_AMMINISTRAZIONE?> v.<?=VERSIONE?></title>
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
                                <form class="md-float-material form-material" action="<?BASE_URL_ADMIN?>login.php" method="post" id="FormLogin" name="FormLogin">
                                        <div class="text-center"><h2>Accedi come <br>Superuser a <?=NOME_AMMINISTRAZIONE?> Manager</h2></div>
                                        <? if($LoginFailed) echo $LoginFailed ?>
                                        <div id="view_loading_login"></div>
                                        <div id="content_login">
                                            <div class="form-group m-t-40">
                                                <div class="col-xs-12">
                                                    <input type="text" name="username"  required="" class="form-control" placeholder="Nome Utente"/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-xs-12">
                                                    <div class="nput-group-append input-group">
                                                        <input type="password" name="password" id="view_password" required="" value="" class="form-control" placeholder="Password" />
                                                        <span class="input-group-addon bg-warning" id="view" style="cursor: pointer;" title="Clicca per vedere o nascondere la password"><i class="fa fa-eye" id="open"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group text-center m-t-20">
                                                <div class="col-xs-12">
                                                    <button class="btn btn-info btn-md btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
                                                </div>
                                            </div>
                                        </div>
                                </form>
                                <div class="forgot-phone text-right f-right">
                                    <a href="lost_password.php" class="text-right f-w-600"> Recupero password!</a>
                                </div>
                                <div class="col-xs-12 text-center m-t-40">
                                    <small><?=NOME_AMMINISTRAZIONE?> <b>v</b> <span data-toogle="tooltip" title="<?=EXPLANE_VERSIONE?>"><?=VERSIONE?></span><br> Copyright <span class="cursore" id="licenza">&copy;</span> <?=date('Y')?> <a href="https://www.network-service.it" target="_blank">Network Service s.r.l.</a></small>
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




            $("#licenza").click(function () {
                window.open('<?=BASE_URL_SITO?>licenza.html', 'licenza', 'location=no,menubar=no,status=no,toolbar=no,scrollbars=no,resizable=no,top=500,left=500,width=400,height=120');
            });
            $("#FormLogin").on("submit",function(){
                $("#view_loading_login").html('<div class="row"><div class="col-md-12 text-center"><img src="<?=BASE_URL_SITO?>img/Ellipsis-1s-200px.gif" alt="Login al CRM QUOTO v3"></div></div><div class="row"><div class="col-md-12 text-center"><small>Attendere il termine dell\'operazione di Login!</small></div></div>');
                $("#content_login").hide();
            });
        });
    </script>
</body>
</html>