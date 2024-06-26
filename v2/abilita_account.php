<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include(INC_PATH_SITO.'function.inc.php');
error_reporting(0); 


	$user = DB_SUITEWEB_USER;
	$pass = DB_SUITEWEB_PASSWORD;
	$h    = DB_SUITEWEB_HOST;
	$db   = DB_SUITEWEB_NAME;

	$conn_sui = mysqli_connect($h, $user, $pass,$db) or die ("Error connecting to database");


 	if($_REQUEST['v']!=''){

	 		$idsito = base64_decode($_REQUEST['v']);

			
			$query         = "SELECT
									siti.idsito,
									siti.email
								FROM
									siti
								WHERE
								 	siti.idsito = ".$idsito." 						 								 	
								AND 
								 	siti.hospitality = 1 
								AND 
								 	siti.data_start_hospitality <= '".date('Y-m-d')."' 
								AND 
								 	siti.data_end_hospitality > '".date('Y-m-d')."'";

			$res           = mysqli_query($conn_sui,$query);
			$check_quoto   = mysqli_num_rows($res);

		if($check_quoto>0){

	 		$update = "UPDATE utenti_quoto SET abilitato = 1 WHERE idsito = ".$idsito;
	 		mysqli_query($conn_sui,$update);		

	 		$select = "SELECT username,password FROM utenti_quoto WHERE idsito = ".$idsito;
	 		$result = mysqli_query($conn_sui,$select);
	 		$row = mysqli_fetch_assoc($result);
	 		$username = $row['username'];
	 		$password = $row['password'];

	 		$output = '<div id="content-logo">
							<img src="'.BASE_URL_SITO.'img/logo.png" >
							<div style="clear:both"></div>
							<div id="welcome">
									<img src="'.BASE_URL_SITO.'img/Ellipsis-1s-200px.svg" alt="Stai per essere re-diretto in QUOTO!">
									<div style="clear:both;height:50px"></div>
								<div id="text">
									ATTENDI qualche istante....<br> Stai per essere indirizzato a QUOTO! 
									<div class="clear small">Il tuo IP ('.$_SERVER['REMOTE_ADDR'].')</div>
								</div>
							</div>
						</div>

						<form  action="'.BASE_URL_SITO.'login.php" method="post" name="form_phpmv" id="form_phpmv">
							<input type="hidden" name="username"  value="'.$username.'"/>
							<input type="hidden" name="password" value="'.base64_decode($password).'"/>
						</form>
						<script language="JavaScript"> 
							$(document).ready(function(){
							    setTimeout(function(){
							       $("#content-logo").fadeOut(200);
							       $("#form_phpmv").submit();
							   }, 3000); 
						    })
						</script>';

		}else{

			$output = '<div id="content-logo"><img src="'.BASE_HTTPS_SITO.'img/logo.png"/><div style="clear:both;height:50px"></div>Stai tentando di accedere senza autorizzazione a QUOTO!<br> Il tuo IP ('.$_SERVER['REMOTE_ADDR'].') verrà registrato!</div>';

		}

	}else{

		$output = '<div id="content-logo"><img src="'.BASE_HTTPS_SITO.'img/logo.png"/><div style="clear:both;height:50px"></div>Il codice variabile non è riconosciuto<br> Il tuo IP ('.$_SERVER['REMOTE_ADDR'].') verrà registrato!</div>';

	}


mysqli_close($conn_sui);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Verifica Email e Account di QUOTO!</title>
	<!-- jQuery 2.1.4 -->
    <script src="<?=BASE_URL_SITO?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <style>
    @import url(https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic);
        body{
            font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;
    		font-weight: 400;   	
        }
		#content-logo{
		 	position:absolute;
			top:  50%;
			left: 50%;
			text-align:center;
			-webkit-transition: all .3s ease;
			transform: translate(-50%,-50%);
		}
		#welcome{
		 	position:relative;
			text-align:center;
		}
		#text{
		 	position:relative;
			text-align:center;
		}
		.small{
			font-size: 85%;
		}
		.clear{
			clear:both;
		}
</style>
</head>
	<body>
		<?=$output;?>
	</body>
</html>