<?php

require($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");

include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

require($_SERVER['DOCUMENT_ROOT']."/include/function.inc.php");

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
            header('Content-Type: text/html; charset=utf-8');
            
session_destroy();
            session_start();

    
        if(!empty($_POST))
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
                                utenti_admin.utente_email = :email ";
                
                // The parameter values
                $query_params = array(
                    ':email' => $_POST['email']
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
                $form_ok = false;
                
                // Retrieve the user data from the database.  If $row is false, then the username
                // they entered is not registered.
                $row = $stmt->fetch();
                if($row)
                {
                    $form_ok = true;
                }
                
                // If the user logged in successfully, then we send them to the private members-only page
                // Otherwise, we display a login failed message and show the login form again
                if($form_ok)
                {
                    
	
                    require (INC_PATH_CLASS.'PHPMailer/PHPMailerAutoload.php');
						
			
						$NomeUtente = $row['utente_nome'].' '.$row['utente_cognome'];
			
			            $mail 	= new PHPMailer(); 
						$msg 	.= top_email(1);
						$msg 	.= '<table class="tbl_body" cellpadding="0px" cellspacing="0px" border="0px" align="center">
												<tr>
												<td class="title">
														<img src="'.BASE_URL_SITO.'img/logo.png" /><br />
													<h2>Recupero Password !! '.NOME_AMMINISTRAZIONE.'</h2>
												</td>
											</tr>
											<tr>
												<td valign="top">
													<b>'.$NomeUtente.'</b>.<br />
													Abbiamo ricevuto la richiesta di <b>RECUPERO PASSWORD</b> relativo alla tua email <b>'.$row['utente_email'].'</b>.<br />
													<br />
													Ecco la tua Username: <b>'.$row['username'].'</b><br />
													Ecco la tua Password: <b>'.base64_decode($row['password']).'</b><br />
													<br />
													Richiesta pervenuta dall\'indirizzo IP: '.$_SERVER['REMOTE_ADDR'].' alle ore '.date('H:i:s').' del giorno '.date('d-m-Y').'. 
												</td>
											</tr>
										</table>';
				
						$msg 	.= footer_email(1);
			
						$body 	= $msg;

                        $mail->IsSMTP(); 
                        $mail->SMTPDebug = 0; 
                        $mail->Debugoutput = 'html';
                        $mail->SMTPAuth = SMTPAUTH; 
                        $mail->SMTPKeepAlive = true; 					
                        $mail->Host = SMTPHOST;
                        $mail->Port = SMTPPORT;
                        $mail->Username = SMTPUSERNAME;
                        $mail->Password = SMTPPASSWORD; 

						$mail->SetFrom(MAIL_ASSISTENZA, NOME_AMMINISTRAZIONE);
						$address = $_POST['email'];
						$mail->AddAddress($address);			
						$mail->Subject    = "Recupero Password!! ".NOME_AMMINISTRAZIONE;
						$mail->MsgHTML($body);
			
						if(!$mail->Send()) {
							$MsgForm_ko = '<div class="alert alert-danger" style="font-size: 12px !important;">'.$mail->ErrorInfo.'</div>';
						} else {
						  $MsgForm_ok = '<div class="alert alert-info" style="font-size: 12px !important;">Email inviata correttamente.<br />Riceverai presto i dati di accesso per QUOTO Manager!.</div>';
						}


                }
                else
                {
                    // Tell the user they failed
                    $MsgForm_ko = '<div class="alert alert-danger" style="font-size: 12px !important;">Email per la richiesta della username e password non valida!</div>';
                    

                }
            }      	
	
	


?>
<!DOCTYPE html>
<html lang="it">

<head>
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

                        <!-- Authentication card start -->
                        <form class="md-float-material form-material" action="lost_password.php" method="post">
                            <div class="text-center">
                            <img src="<?=BASE_URL_SITO?>img/logotipo_quoto_2021.png" alt="QUOTO!"> 
                            </div>
                            <div class="auth-box card">
                                <div class="card-block">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-left">Recupera le tue credenziali</h3>
                                    </div>
                                </div>
                                <? if($MsgForm_ok) echo $MsgForm_ok ?>
                                <? if($MsgForm_ko) echo $MsgForm_ko ?>

                                    <div class="form-group form-primary">
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Inserisci l'email associata al tuo account!"/>
                                        <span id="check_email"></span>

                                        </div>       
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">                            
                                            <button type="submit" id="resend_account" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Invia Richiesta</button> 
                                        </div>
                                        <div class="col-md-2"></div>
                                    </div>
                               

                                <p class="f-w-600 text-right m-r-20"><a href="<?=BASE_URL_ADMIN?>login.php">&larr; torna al Login.</a></p>
                                </div>
                            </div>
                        </form>
                        <!-- end of form -->

                            <div class="col-md-12 text-center">
                                <img src="<?=BASE_URL_SITO?>class/resize.class.php?src=<?=BASE_PATH_SITO?>img/logo_network_2021.png&w=250&h=0&a=c&q=100">
                            </div>

                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->

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
</body>

</html>
