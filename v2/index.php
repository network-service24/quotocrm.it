<?php
include($_SERVER['DOCUMENT_ROOT'].'/v2/include/settings.inc.php');
// Carico la classe principale
require($_SERVER['DOCUMENT_ROOT'].'/v2/xcrud/xcrud.php');
include($_SERVER['DOCUMENT_ROOT'].'/v2/include/function.inc.php');

    // Thema "bootstrap"
    Xcrud_config::$theme = 'bootstrap';

    // creo l'istanza
    $xcrud = Xcrud::get_instance();


	/**
	 * ! classe per redirect in javascript
	 */
	include(INC_PATH_CLASS.'printer.class.php');
	$prt = new printer();

if(MANUTENZIONE==0){

	// imposta la lingua italiana
    $xcrud->language('it');

	if(!empty($_SESSION['utente']) && is_array($_SESSION['utente'])) {
		if($_SESSION['utente'] > count($_SESSION['utente']))
			$ArryaUtente = count($_SESSION['utente']);
	}else{
		$ArryaUtente = 0;
	}
    // Dopo l'istanza di xcrud (che ha fatto partire la sessione) controllo l'utente
    if($ArryaUtente < 1)
    //if(!isset($_COOKIE['cookie_utente']))
    {
		// rimando al login
		//$prt->_goto(BASE_URL_SITO.'login.php');
        header("Location: ".BASE_URL_ROOT."login.php");

        die("Stai per essere reindirizzato alla pagina di login");
    }

    // Recupero i dati dell'utente'
    $db = Xcrud_db::get_instance();

	$charset='UTF8';
	// inizializzo la connessione al DATABASE ITALIA ABC
	$xcrud_suiteweb = Xcrud::get_instance();
	$xcrud_suiteweb->connection(DB_SUITEWEB_USER,DB_SUITEWEB_PASSWORD,DB_SUITEWEB_NAME,DB_SUITEWEB_HOST);
	// imposta la lingua italiana
	$xcrud_suiteweb->language('it');
	// oggetto Database per connessione al DATABASE ITALIA ABC
	$dbsuiteweb_params 	= array(DB_SUITEWEB_USER,DB_SUITEWEB_PASSWORD,DB_SUITEWEB_NAME,DB_SUITEWEB_HOST,$charset);
	$db_suiteweb			= Xcrud_db::get_instance($dbsuiteweb_params);

	$db_suiteweb->query('SELECT utenti.*, siti.https,siti.email, siti.web,siti.nome, siti.data_start_hospitality,siti.website,siti.checkin_online_hospitality,siti.API_hospitality,siti.IdAccountAnalytics,siti.IdPropertyAnalytics,siti.ViewIdAnalytics FROM utenti  INNER JOIN siti ON siti.idsito = utenti.idsito  WHERE utenti.idutente = "'.$_SESSION['utente']['idutente'].'"');
	$DatiUtente = $db_suiteweb->row();


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
	define('PROPERTY_ID_ANALYTICS_GA4',$DatiUtente['PropertyIdAnalyticsGA4']);
	$_SESSION['PROPERTY_ID_ANALYTICS_GA4'] = PROPERTY_ID_ANALYTICS_GA4;
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
	define('DATA_ATTIVAZIONE',date('Y-m-d',$data_attivazione));
	define('ANNO_ATTIVAZIONE',$data_attivazione_tmp[0]);
	# check per amministra sito se non checcato allora
	# non abilitato la syncronia dei form del sito
	define('CHECK_WEBSITE',$DatiUtente['website']);
	$ico = explode("#",ico_operatore(IDSITO,$_SESSION['user_accesso']));
	define('ICONAUTENTE', $ico[0]);
	define('NOMEUTENTEACCESSI', $ico[1]);

	$_SESSION['BASE_URL'] = BASE_URL_SITO;

	define('NUMERO_SERVIZI',30);

	if(check_numero_servizi(IDSITO) > NUMERO_SERVIZI) { 
		define('DISABLED_CHECKBOX', 1);
	}else{
		define('DISABLED_CHECKBOX', 0);
	}
	////////////
	// creazione della directory dedicata al cliente per deposito file
	if (!file_exists(BASE_PATH_SITO."uploads/".IDSITO)) {
		mkdir(BASE_PATH_SITO."uploads/".IDSITO );
		chmod(BASE_PATH_SITO."uploads/".IDSITO,0755);
	}
	// fine ############################################################

	// IF per rendere visibile codice solo per sito di TEST
	if(IDSITO  == 1740){
		define('VISIBILE',	'1');
	}else{
		define('VISIBILE',	'0');
	}
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
	if(file_exists(INC_PATH_SITO.'controller/'.$Template.'.php'))
    {
    	include(INC_PATH_SITO.'controller/'.$Template.'.php');
    }
    //carico il template
    if(file_exists(INC_PATH_SITO.'template/'.$Template.'.tpl.php'))
    {
    	include(INC_PATH_SITO.'template/'.$Template.'.tpl.php');
    }
    else
    {
    	include(INC_PATH_SITO.'template/error404.tpl.php');
    }
close_session();
}else{

	header("Location: ".BASE_URL_SITO."manutenzione.php");

}

