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
                $query = "SELECT siti.web,utenti.username,utenti.password,anagrafica.nome,anagrafica.cognome,anagrafica.rag_soc  
                            FROM utenti 
                            inner join anagrafica on anagrafica.idanagra = utenti.idanagra 
                            inner join siti on siti.idsito= utenti.idsito 
                            WHERE siti.web = :web and siti.email = :email and utenti.blocco_accesso = 0";
                
                // The parameter values
                $query_params = array(
                    ':web' => $_POST['web'],
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
			
						$NomeCliente = $row['nome'].' '.$row['cognome'];
						if($NomeCliente=='')$NomeCliente = $row['rag_soc'];
			
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
													Salve <b>'.$NomeCliente.'</b>.<br />
													Abbiamo ricevuto la richiesta di <b>RECUPERO PASSWORD</b> relativo al dominio <b>'.$row['web'].'</b>.<br />
													<br />
													Ecco il suo attuale Username: <b>'.$row['username'].'</b><br />
													Ecco la sua attuale Password: <b>'.base64_decode($row['password']).'</b><br />
													<br />
													Cogliamo l\'occasione per ricordarle alcune regole per la sicurezza del suo sito.<br />
													<br />
													E\' fortemente sconsigliato scrivere o stampare questi dati di accesso, persone non autorizzate potrebbero impossesarsi di tali dati ed entrare 
													nel pannello di controllo. Consigliamo per cui di memorizzare username e password e non divulgarle a persone estranee.<br />
													<br />
													Questo messaggio è stato generato automaticamente dal servizio di RECUPERO PASSWORD, per tanto non rispondere direttamente a questa e-mail.<br />
													Se avete ricevuto questa e-mail per errore o non siete i diretti interessati, cortesemente, inoltrate una segnalazione <a href="mailto:'.MAIL_ASSISTENZA.'">'.MAIL_ASSISTENZA.'</a>.<br />
													Per maggiori informazioni contattare l\'amministrazione all\'indirizzo <a href="mailto:'.MAIL_NETWORK.'">'.MAIL_NETWORK.'</a>.<br />
													<br />
													Richiesta pervenuta dall\'indirizzo IP: '.$_SERVER['REMOTE_ADDR'].' alle ore '.date('H:i:s').' del giorno '.date('d-m-Y').'. 
												</td>
											</tr>
										</table>';
				
						$msg 	.= footer_email(1);
		                $msg    .= '<br><br><div align="center">Questa e-mail è stata inviata automaticamente dal software, non rispondere a questa e-mail!</div>';
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
						$address = $_REQUEST['email'];
						//$address = MAIL_ADMIN;
						$mail->AddAddress($address);			
						$mail->Subject    = "Recupero Password!! ".NOME_AMMINISTRAZIONE;
						$mail->MsgHTML($body);
			
						if(!$mail->Send()) {
							$MsgForm_ko = '<div class="alert alert-danger">'.$mail->ErrorInfo.'</div>';
						} else {
						  $MsgForm_ok = '<div class="alert alert-info">Email inviata correttamente.<br />Riceverà presto i dati di accesso per QUOTO!</div>';
						}

                }
                else
                {
                    // Tell the user they failed
                    $MsgForm_ko = '<div class="alert alert-danger">Dati inseriti per la richiesta della username e password non validi</div>';
                    

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
                        <div class="col-xs-12">
                             <div class="text-center"><h2>Recupera Accessi!</h2></div>
                                <form action="lost_password.php" method="post" class="form-horizontal form-material"> 
                                    <? if($MsgForm_ok) echo $MsgForm_ok ?>
                                    <? if($MsgForm_ko) echo $MsgForm_ko ?>               
                                    <div class="form-group m-t-40">
                                        <div class="col-xs-12">
                                            <input type="text" name="web" class="form-control" placeholder="Inserire il sito che hai associato a QUOTO senza https://" required />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <input type="email" name="email" id="email" class="form-control" placeholder="Inserire l'email del sito associato a QUOTO" required />
                                            <span id="check_email"></span>
                                        </div>
                                    </div>
                                    <div class="form-group text-center m-t-20">
                                        <div class="col-xs-12">                                      
                                            <button type="submit" class="btn btn-info btn-md btn-block text-uppercase waves-effect waves-light"  id="resend_account" >Invia Richiesta</button> 
                                        </div>
                                    </div>                                
                                    <div class="form-group text-right m-t-20">
                                        <div class="col-xs-12">                                      
                                        <a href="login.php">&larr; Torna al login</a>
                                        </div>
                                    </div>
                                </form>
                            <div class="col-xs-12 text-center">
                                <small>Il recupero accessi automatizzato funziona solo se avete già creato il vostro primo accesso al software QUOTO</small>  
                            </div>
                            <div class="col-xs-12 text-center m-t-40">
                                <small>Copyright <span id="licenza">&copy;</span> <?=date('Y')?> <a href="https://www.network-service.it" target="_blank">Network Service s.r.l.</a></small>  
                            </div>
                        </div>
                    </div>
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
