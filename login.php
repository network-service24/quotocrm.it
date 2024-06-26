<?php
      
            header("Expires: on, 01 Jan 1970 00:00:00 GMT");
            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header("Cache-Control: no-store, no-cache, must-revalidate");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");

            require($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");

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
            // Questo statement configura PDO per generare un'eccezione quando incontra un errore. 
            // Ciò ci consente di utilizzare blocchi try/catch per catturare gli errori del database.
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Questo statement configura PDO per restituire righe dal database utilizzando un array associativo. 
            // Ciò significa che l'array avrà indici di tipo stringa, dove il valore della stringa rappresenta il nome della colonna nel tuo database.
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            $_SESSION = array();

            // Questa variabile verrà utilizzata per mostrare di nuovo all'utente il suo nome utente nel 
            // modulo di accesso se non riesce a inserire la password corretta. Viene inizializzata qui con 
            // un valore vuoto, che verrà mostrato se l'utente non ha inviato il modulo.
            $submitted_username = '';

            // Questo statement if controlla se il modulo di accesso è stato inviato. 
            // Se lo è stato, viene eseguito il codice di accesso, altrimenti viene visualizzato il modulo.
            if(!empty($_REQUEST))
            {
                // Questa query recupera le informazioni dell'utente dal database utilizzando il loro nome utente.
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
                                siti.web as cliente,
                                siti.data_start_hospitality
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
                    // Eseguire la query sul database.
                    $stmt = $db->prepare($query);
                    $result = $stmt->execute($query_params);
                }
                catch(PDOException $ex)
                {
                    // Nota: Su un sito web in produzione, non dovresti stampare $ex->getMessage(). 
                    // Potrebbe fornire a un attacker informazioni utili sul tuo codice.
                    die("Interrogazione fallita: " . $ex->getMessage());
                }

                // Questa variabile ci indica se l'utente ha effettuato l'accesso con successo o meno. 
                // La inizializziamo a false, assumendo che non lo abbiano fatto. Se determiniamo che 
                // hanno inserito le informazioni corrette, allora la impostiamo su true.
                $login_ok = false;

                // Recuperare i dati dell'utente dal database. Se $row è falso, 
                // allora il nome utente che hanno inserito non è registrato.
                $row = $stmt->fetch();
                if($row)
                {
                    $login_ok = true;
                }

                // Se l'utente ha effettuato l'accesso con successo, lo reindirizziamo alla pagina riservata ai membri. 
                // Altrimenti, visualizziamo un messaggio di accesso fallito e mostriamo nuovamente il modulo di accesso.
                if($login_ok)
                {

                    $_SESSION['user_accesso'] = $_REQUEST['username'];
                    $_SESSION['pass_accesso'] = base64_encode($_REQUEST['password']);

                    // rimuovo i dati sensibili prima di salvare la sessione
                    unset($row['Password']);

                    // Questo codice memorizza i dati dell'utente nella sessione all'indice 'user'. 
                    // Successivamente, controlleremo questo indice nella pagina riservata ai membri 
                    // per determinare se l'utente ha effettuato l'accesso o meno. 
                    // Possiamo anche utilizzarlo per recuperare i dettagli dell'utente.
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

					if((isset($_REQUEST['user_admin']))){
						$DatiLog 	= explode('#',$_REQUEST['user_admin']); // separo
                        $_SESSION['user_admin'] = $_REQUEST['user_admin'];
						$_SESSION['super_user'] = $DatiLog[0];
						$_SESSION['super_pass'] = $DatiLog[1];
					}
                    if($_SESSION['utente']['data_start_hospitality'] > DATA_QUOTO_V3){
                        header("Location: ".BASE_URL_SITO."dashboard-index/");
                    }else{

                        include_once($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");
                        $checkUI = $fun->check_configurazioni($_SESSION['utente']['idsito'],'check_interfaccia');
                        if($checkUI == 1){
                            header("Location: ".BASE_URL_SITO."dashboard-index/");
                        }else{
                            header("Location: ".BASE_URL_SITO."v2/dashboard-index/");
                        }                         
                    
                    }


                    die("Stai per essere reindirizzato a QUOTO!");
                }
                else
                {
                    // Comunicare all'utente che ha fallito.
                    $LoginFailed = '<div class="alert alert-danger m-t-20">Dati di accesso non validi</div>';

                    // Mostra loro di nuovo nome utente in modo che tutto ciò che devono fare è inserire una nuova password.
                    // L'uso di htmlentities previene gli attacchi XSS. Dovresti sempre utilizzare htmlentities sui valori inviati 
                    // dagli utenti prima di visualizzarli a qualsiasi utente (compreso l'utente che li ha inviati). 
                    // Per ulteriori informazioni: http://en.wikipedia.org/wiki/XSS_attack
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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!-- validate password css -->
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
    </style>
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
                <div class="col-sm-12">
                 <?php if(MANUTENZIONE == 0){ ?>
                    <?php if($_POST['pass_scaduta'] == 0){ ?>
                        <!-- Authentication card start -->

                        <div class="text-center">
                                <img src="<?=BASE_URL_SITO?>img/logotipo_quoto_2021.png" alt="QUOTO!"> 
                        </div>
                        <div class="auth-box card">
                            <div class="card-block z-depth-0">
                                <form class="md-float-material form-material" action="login.php" method="post" id="FormLogin" name="FormLogin">
                                        <div class="text-center"><h2>Accedi a <?=NOME_AMMINISTRAZIONE?></h2></div>
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
                                                    <div class="nput-group-append input-group">
                                                        <input type="password" name="password" id="view_password" required="" value="<?php echo $pw_cookie?>" class="form-control" placeholder="Password" />
                                                        <span class="input-group-addon bg-warning" id="view" style="cursor: pointer;" data-toggle="tooltip" title="Clicca per vedere o nascondere la password"><i class="fa fa-eye" id="open"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="d-flex no-block align-items-center">
                                                    <div class="checkbox checkbox-primary p-t-0">
                                                        <input id="checkbox-signup" type="checkbox" name="remember_cookie" <?php echo $remember_cookie?> />
                                                        <label for="checkbox-signup"> Ricordami <i class="fa fa-info-circle text-info cursore" data-toggle="tooltip" data-html="true"  title="Il checkbox <em>Ricordami</em>, salva i dati d'accesso in cookies, questi rimarranno memorizzati sempre e solo fino alla chiusura definitiva del browser!"></i></label>
                                                    </div>
                                                    <div class="ml-auto">
                                                        <i class="fa fa-lock m-r-5 text-muted"></i> <a href="lost_password.php" id="to-recover" class="text-muted" data-toggle="tooltip" data-html="true"  title="Per il recupero dei tuoi dati d'accesso, ti verrà richiesto l'inserimento del dominio del sito e dell'email associati a QUOTO!">Smarrito gli accessi?</a>
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
                                                    <a href="javascript:;" id="UserAction" class="btn btn-success btn-md btn-block waves-effect waves-light text-center"><small><i class="fa fa-user"></i> Crea primo account d'accesso!</small></a>
                                                </div>
                                            </div>
                                </form>
                                <!-- primi  dati di accesso -->
                                <form name="form_create_user" id="FormAddUser" method="post" style="display:none" class="form-horizontal form-material" >
                                    <div class="text-center"><h2>Crea il tuo primo accesso!</h2></div>
                                    <div class="form-group">
                                        <div class="col-xs-12 m-t-40">
                                            <div id="risultato"></div>
                                            <input type="text" name="username" id="username" class="form-control" placeholder="Crea una UserName" required />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <input type="text" name="password" id="password" class="pr-password form-control" placeholder="Crea una Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="La password deve contenere un numero e una lettera maiuscola e minuscola e almeno 8 caratteri e non più di 18"  minlength="8" maxlength="18" required />
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
                                    <small><?=NOME_AMMINISTRAZIONE?> <b>v</b> <span data-toogle="tooltip" title="<?=EXPLANE_VERSIONE?>"><?=VERSIONE?></span><br> Copyright <span class="cursore" id="licenza">&copy;</span> <?=date('Y')?> <a href="https://www.network-service.it" target="_blank">Network Service s.r.l.</a></small>
                                </div>

                    <?}else{?>
                        <div class="alert alert-warning">Il CRM è temporaneamente in manutenzione per aggiornamenti programmati.<br />Torneremo online il prima possibile!<br />Per maggiori informazioni o interventi sul tuo sito contatta lo staff Network Service.<br /><a href="mailto:support@quoto.travel">support@quoto.travel</a></div>
                    <?}?>

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
    <script type="text/javascript">
        var _iub = _iub || [];
        _iub.csConfiguration = {
            cookiePolicyId: 173284,
            siteId: 265459,
            lang: "it"
        };
        (function (w, d) {
            var loader = function () { var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src = "//cdn.iubenda.com/cookie_solution/iubenda_cs.js"; tag.parentNode.insertBefore(s, tag); };
            if (w.addEventListener) { w.addEventListener("load", loader, false); } else if (w.attachEvent) { w.attachEvent("onload", loader); } else { w.onload = loader; }
        })(window, document);
    </script>
   
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
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

            $("#UserAction").on('click', function () {
                $(".pr-password").passwordRequirements({
                    numCharacters: 8,
                    useLowercase:true,
                    useUppercase:true,
                    useNumbers:true,
                    useSpecial:false
                });
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
                    url: "<?=BASE_URL_SITO?>ajax/login/send_mail_conferma_primo_account.php",
                    type: "POST",
                    data: datiform,
                    dataType: "html",
                    success: function(data) {
                            $("#risultato").html('<div class="alert alert-info">'+data+'</div>');
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
                        url: "<?=BASE_URL_SITO?>ajax/login/check_valid_email.php",
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
                window.open('<?=BASE_URL_SITO?>licenza.html', 'licenza', 'location=no,menubar=no,status=no,toolbar=no,scrollbars=no,resizable=no,top=500,left=500,width=400,height=120');
            });
            $("#FormLogin").on("submit",function(){
                $("#view_loading_login").html('<div class="row"><div class="col-md-12 text-center"><img src="<?=BASE_URL_SITO?>img/Ellipsis-1s-200px.gif" alt="Login al CRM QUOTO v.<?=VERSIONE?>"></div></div><div class="row"><div class="col-md-12 text-center"><small>Attendere il termine dell\'operazione di Login!</small></div></div>');
                $("#content_login").hide();
            });
        });
    </script>
</body>
</html>