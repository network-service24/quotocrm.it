<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/include/settings.inc.php');

require_once($_SERVER['DOCUMENT_ROOT'].'/include/declaration.inc.php');

require_once($_SERVER['DOCUMENT_ROOT'].'/include/function.inc.php');


if(MANUTENZIONE==0){

    // controllo l'utente
    if(sizeof($_SESSION['utente']) < 1)
    //if(!isset($_COOKIE['cookie_utente']))
    {
		// rimando al login
		$prt->_goto(BASE_URL_SITO.'login.php');
        //header("Location: ".BASE_URL_SITO."login.php");

        die("Stai per essere reindirizzato alla pagina di login");
	}

    // Recupero i dati dell'utente'
	$select = 'SELECT utenti.*, siti.website,siti.https,siti.email, siti.web,siti.nome, siti.checkin_online_hospitality,siti.data_start_hospitality,siti.API_hospitality,siti.IdAccountAnalytics,siti.IdPropertyAnalytics,siti.ViewIdAnalytics FROM utenti  INNER JOIN siti ON siti.idsito = utenti.idsito  WHERE utenti.idutente = "'.$_SESSION['utente']['idutente'].'"';
	$result = $dbMysqli->query($select);
	$DatiUtente = $result[0];


	$dir_tmp  = str_replace("http://","",$DatiUtente['web']);
	$dir_tmp  = str_replace("www.","",$dir_tmp);
	$dir_sito = str_replace(".it","",$dir_tmp);
	$dir_sito = str_replace(".com","",$dir_sito);
	$dir_sito = str_replace(".net","",$dir_sito);
	$dir_sito = str_replace(".biz","",$dir_sito);
	$dir_sito = str_replace(".eu","",$dir_sito);
	$dir_sito = str_replace(".de","",$dir_sito);
	$dir_sito = str_replace(".es","",$dir_sito);
	$dir_sito = str_replace(".fr","",$dir_sito);

	define('NOMEUTENTE',$DatiUtente['nome']);
	define('EMAILUTENTE',$DatiUtente['ut_email']);
	define('EMAILHOTEL',$DatiUtente['email']);
	define('NOMEHOTEL',$DatiUtente['nome']);
	define('IDUTENTE',$DatiUtente['idutente']);
	define('USER',$DatiUtente['username']);
	define('PASS',$DatiUtente['password']);
	define('ISADMIN',$DatiUtente['is_admin']);
	define('CHECKINONLINE',$DatiUtente['checkin_online_hospitality']);
	define('DIRECTORYSITO',$dir_sito);
	$_SESSION['DIRECTORYSITO'] = $dir_sito;
	define('IDSITO',$DatiUtente['idsito']);
	define('FORM_SUL_SITO',$DatiUtente['API_hospitality']);
	define('ID_ACCOUNT_ANALYTICS',$DatiUtente['IdAccountAnalytics']);
	define('ID_PROPERTY_ANALYTICS',$DatiUtente['IdPropertyAnalytics']);
	define('VIEW_ID_ANALYTICS',$DatiUtente['ViewIdAnalytics']);
	define('SITOWEB',str_replace("http://","",$DatiUtente['web']));
	$_SESSION['IDSITO'] = $DatiUtente['idsito'];
	if($DatiUtente['https']== 1){
		$http_header = 'https://';
	}else{
		$http_header = 'http://';
	}
	define('HTTPHEADER',$http_header);
	define('AVATAR',$DatiUtente['logo']);
	# calcolo della data di attivazione del software in mktime
	# utile per la funzione di syncro con i form dei siti
	$data_attivazione_tmp = explode("-",$DatiUtente['data_start_hospitality']);
	$data_attivazione = mktime(0,0,0,$data_attivazione_tmp[1],$data_attivazione_tmp[2],$data_attivazione_tmp[0]);
	define('DATA_ATTIVAZIONE',$data_attivazione);
	define('ANNO_ATTIVAZIONE',$data_attivazione_tmp[0]);
	# check per amministra sito se non checcato allora
	# non abilitato la syncronia dei form del sito
	define('CHECK_WEBSITE',$DatiUtente['website']);
	$ico = explode("#",ico_operatore(IDSITO,$_SESSION['user_accesso']));
	define('ICONAUTENTE', $ico[0]);
	define('NOMEUTENTEACCESSI', $ico[1]);

	$_SESSION['BASE_URL'] = BASE_URL_SITO;

	define('NUMERO_SERVIZI',60);

	if(check_numero_servizi(IDSITO) > NUMERO_SERVIZI) { 
		define('DISABLED_CHECKBOX', 1);
	}else{
		define('DISABLED_CHECKBOX', 0);
	}


	$_SESSION['BASE_URL'] = BASE_URL_SITO;
	////////////
	// creazione della directory dedicata al cliente per deposito file
	if (!file_exists(BASE_PATH_SITO."uploads/".IDSITO)) {
		mkdir(BASE_PATH_SITO."uploads/".IDSITO );
		chmod(BASE_PATH_SITO."uploads/".IDSITO,0755);
	}


    // fine ############################################################

	/** @var PerformizeFunctions $fun */

	global $fun;
	require_once $_SERVER['DOCUMENT_ROOT'].'/class/PerformizeFunctions.php';
	$fun=new PerformizeFunctions($dbMysqli,IDSITO);

//	error_reporting(0);

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
	if(file_exists(INC_PATH_NEWSLETTER.'controller/'.$Template.'.php'))
    {
    	include(INC_PATH_NEWSLETTER.'controller/'.$Template.'.php');
    }
    //carico il template
    if(file_exists(INC_PATH_NEWSLETTER.'template/'.$Template.'.tpl.php'))
    {
    	include(INC_PATH_NEWSLETTER.'template/'.$Template.'.tpl.php');
    }
    else
    {
    	include(INC_PATH_NEWSLETTER.'template/error404.tpl.php');
    }

}else{

	header("Location: ".BASE_URL_SITO."manutenzione.php");

}
?>
