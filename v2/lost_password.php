<?php

            require("include/settings.inc.php");

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
            header('Content-Type: text/html; charset=utf-8');
            
            session_start();
            $_SESSION = array();
    
        if(!empty($_POST))
            {
                // This query retreives the user's information from the database using
                // their username.
                $query = "SELECT siti.web,utenti_quoto.username,utenti_quoto.password,anagrafica.nome,anagrafica.cognome,anagrafica.rag_soc  
                            FROM utenti 
                            inner join anagrafica on anagrafica.idanagra = utenti.idanagra 
                            inner join siti on siti.idsito= utenti.idsito 
                            INNER JOIN utenti_quoto ON utenti_quoto.idsito = utenti.idsito 
                            WHERE siti.web = :web and siti.email = :email and utenti.blocco_accesso = 0
                            AND utenti_quoto.utenti = 1 ";
                
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

                    
	
				   		require_once(INC_PATH_CLASS.'PHPMailer/class.phpmailer.php');
						require(INC_PATH_SITO."function.inc.php");
			
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
													Salve '.$NomeCliente.'.<br />
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
													Se avete ricevuto questa e-mail per errore o non siete i diretti interessati, cortesemente, inoltrate una segnalazione <a href="mailto:'.MAIL_ASSISTENZA.'">'.MAIL_ASSISTENZA.'</a> oppure contattate l\'utente <a href="mailto:'.MAIL_ADMIN.'">'.MAIL_ADMIN.'</a>.<br />
													Per maggiori informazioni contattare l\'amministrazione all\'indirizzo <a href="mailto:'.MAIL_NETWORK.'">'.MAIL_NETWORK.'</a>.<br />
													<br />
													Richiesta pervenuta dall\'indirizzo IP: '.$_SERVER['REMOTE_ADDR'].' alle ore '.date('H:i:s').' del giorno '.date('d-m-Y').'. 
												</td>
											</tr>
										</table>';
				
						$msg 	.= footer_email(1);
		                $msg    .= '<br><br><div align="center">Questa e-mail è stata inviata automaticamente dal software, non rispondere a questa e-mail!</div>';
						$body 	= $msg;
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
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper" class="login-register login-sidebar" style="background-image:url(<?=BASE_URL_SITO?>material/assets/images/background/login-quoto.jpg);">
        <div class="login-box card">
            <div class="card-body">
            <a href="javascript:void(0)" class="text-center db"><img src="<?=BASE_URL_SITO?>img/logo.png" alt="QUOTO!" style="width:100%" /></a>
                <div class="form-group m-t-40">
                    <div class="col-xs-12">
                        <b class="login-box-msg">Recupero Password</b>
                            <form action="lost_password.php" method="post" class="form-horizontal form-material"> 
                                <? if($MsgForm_ok) echo $MsgForm_ok ?>
                                <? if($MsgForm_ko) echo $MsgForm_ko ?>               
                                <div class="form-group m-t-40">
                                    <div class="col-xs-12">
                                        <input type="text" name="web" class="form-control" placeholder="Inserire il tuo dominio senza http://" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Inserire l'email associata al dominio" required />
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
                            <small>Copyright <span id="licenza">&copy;</span> <?=date('Y')?> <a href="http://www.network-service.it">Network Service s.r.l.</a></small>  
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
    <script src="<?=BASE_URL_SITO?>assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>  
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
