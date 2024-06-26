<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/include/settings.inc.php');

	include_once($_SERVER['DOCUMENT_ROOT'].'/include/declaration.inc.php');

	include_once($_SERVER['DOCUMENT_ROOT'].'/include/function.inc.php');

//	session_start();
	
	if(!empty($_SESSION['utente']) && is_array($_SESSION['utente'])) {
		if($_SESSION['utente'] > count($_SESSION['utente']))
			$ArraySuperUser = count($_SESSION['utente']);
	}else{
		$ArraySuperUser = 0;
	}

    if($ArraySuperUser == 0)
    {
		$prt->_goto(BASE_URL_ADMIN.'login.php');
        //header("Location: ".BASE_URL_ADMIN."login.php");
        //die("Stai per essere reindirizzato alla pagina di login");
    }

	$select ='SELECT * FROM utenti_admin WHERE idutente = "'.$_SESSION['utente']['idutente'].'"';
	$Result = $dbMysqli->query($select);
	$DatiUtente = $Result[0];

	define('NOMEUTENTE',$DatiUtente['utente_nome']);
	define('EMAILUTENTE',$DatiUtente['utente_email']);
	define('IDUTENTE',$DatiUtente['idutente']);
	define('AVATAR',$DatiUtente['logo']);

	// fine ############################################################

	error_reporting(E_ALL ^ E_NOTICE);

	if(!isset($_GET['template']))
	{
		$Template = '/';
	}
	else $Template = $_GET['template'];

	// se nell'url è presente il trattino medio "-", allora sono in un sottomenu
	if(substr_count($Template,'-') > 0) {
		$array_template = explode('-',$Template);
		$Sezione 	= $array_template[0];
		$Template 	= $array_template[1];
	}

	// genero le variabili per la gestione dei menu attivi
	$ActiveMenu[$Template] 		= 'active'; 			// menu semplice
	$ActiveMenu[$Sezione] 		= 'active'; 			// menu semplice


	// carico il controller generale del template
	if(file_exists(BASE_PATH_ADMIN.'src/controller/'.$Template.'.php'))
    {
    	include(BASE_PATH_ADMIN.'src/controller/'.$Template.'.php');
    }
    //carico il template
    if(file_exists(BASE_PATH_ADMIN.'src/template/'.$Template.'.tpl.php'))
    {
    	include(BASE_PATH_ADMIN.'src/template/'.$Template.'.tpl.php');
    }
    else
    {
    	include(BASE_PATH_ADMIN.'src/template/error404.tpl.php');
    }


#chiudo le connessioni!
	$dbMysqli->disconnect();
	$dbMysqli_suiteweb->disconnect();
?>
