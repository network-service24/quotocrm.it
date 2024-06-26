<?php
/**
 * *CRM 
 * @author Marcello Visigalli < marcello.visigalli@gmail.com >
 * @version 2.3.1
 * ?Data INIZIO sviluppo, restyling e stesura codice [26-04-2022]
 * ?Data FINE sviluppo, restyling e stesura codice [09-06-2023]
 * *name QUOTO!
 */
/**
 ** SETTING DEL DEFAULT TIME
 */ 
date_default_timezone_set('Europe/Rome');
setlocale(LC_TIME, 'it_IT.UTF8');
 /**
 ** APERTURA DELLA SESSIONE
 */ 
session_start();
/**
 ** GESTIONE DEL ERROR REPORTING
 */ 
//error_reporting(0);
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set('error_log', $_SERVER['DOCUMENT_ROOT'].'/log/v3_php_errors.log');
ini_set('display_errors', false);
ini_set('display_startup_errors', TRUE);

/**
 ** ALZARE IL MEMORY LIMIT
 */ 
/*ini_set('memory_limit', '1024M');*/
/**
 ** PARAMETRI DURATA SESSIONE
 */ 
ini_set("session.gc_maxlifetime", '172800');
session_set_cookie_params('172800'); 
// ESEMPI DURATA SESSIONE
/**
60*60 = 3600 (1h)
60*60*10 = 36000 (10h)
60*60*24 = 86400 (24h, 1d)
60*60*24*2 = 172800 (48h, 2d)
60*60*24*7 = 604800 (48h, 7d)
*/

// INFORMAZIONI GENERICHE

define("AUTHOR"              ,  "Marcello Visigalli");
define("LINK_SITO", 			"http://www.quotocrm.it/");
define("NOME_AMMINISTRAZIONE", 	"QUOTO!");
define("NOME_SUPER_ADMIN", 	    "QUOTO! Manager");
define("MAIL_ADMIN", 			"marcello@network-service.it");
define("NAME_ADMIN", 			"V.M. Developer By Network Service s.r.l.");
define("GENERATOR",				"Visual Studio Code");
###############################################################
/**
 * * 2 = major release;
 * * 0 = minor release;
 * * 0 = revision;
 * * Version:
 * * Alpha (non completa);
 * * Beta (più avanzata dell’alpha);
 * * RC (candidata a diventare stabile);
 * * LTS (stabile a lungo supporto);
 * * Messa online Giugno 2019
 */
define("VERSIONE", 			"2.3.1 Beta");
define("EXPLANE_VERSIONE", 	"Più avanzata dell’alpha e candidata a diventare stabile");

###############################################################
define("MAIL_ASSISTENZA", 	    "support@quoto.travel");
define("MAIL_NETWORK",          "info@network-service.it");
define("MAIL_CHECK",            "info@quotocrm.it");
define("MAIL_SEND",             "no-reply@quotocrm.it");
define("NOME_CLIENT_EMAIL",     "E-MESSENGER");
define("URL_CLIENT_EMAIL",      "emessenger");
/**
 * ------------------------------------------------------------------------
 *|   DATABASE PER QUOTOCRM                                                |
 * ------------------------------------------------------------------------
 */
define("HOST", 					"185.81.4.13");
define("DB_USER", 				"quotocrm_quotocrm");
define("DB_PASSWORD",			"aya)VfUC9g8S");
define("DATABASE", 				"quotocrm_v3_nws");
/**
 * ------------------------------------------------------------------------
 *| DATABASE RELATIVO A SUITEWEB CHE NON ESISTE PIU' QUINDI E' DI QUOTOCRM |
 *| nel software non dovrebbero più esserci connesioni chiamate suiteweb   |
 *| ma per sicurezza le dichiaro                                           |
 * ------------------------------------------------------------------------
 */
define("DB_SUITEWEB_HOST", 		"185.81.4.13");
define("DB_SUITEWEB_USER", 		"quotocrm_quotocrm");
define("DB_SUITEWEB_PASSWORD",	"aya)VfUC9g8S");
define("DB_SUITEWEB_NAME", 		"quotocrm_v3_nws");

define("CDN_URL_SITO", 		"https://cdn.quotocrm.it/");
define("CDN_PATH_SITO",		"/var/www/vhosts/cdn.quotocrm.it/");

define("BASE_URL_SITO", 		"https://".$_SERVER['HTTP_HOST']."/");
define("BASE_PATH_SITO",		$_SERVER['DOCUMENT_ROOT']."/");

define("BASE_URL_ADMIN", 		"https://".$_SERVER['HTTP_HOST']."/admin/");
define("BASE_PATH_ADMIN",		$_SERVER['DOCUMENT_ROOT']."/admin/");
$_SESSION['BASE_URL']           = BASE_URL_ADMIN;
define("INC_PATH_MODULI_ADMIN", BASE_PATH_ADMIN."src/template/moduli/");

define("INC_PATH_NEWSLETTER", 	BASE_PATH_SITO."newsletter/include/");

define("BASE_URL_LANDING", 		'https://offerta.quotocrm.it/');

define("INC_PATH_CLASS", 		BASE_PATH_SITO."class/");
define("INC_PATH_SITO", 		BASE_PATH_SITO."include/");
define("IMG_PATH_SITO", 		BASE_PATH_SITO."img/");
define("UPLOADS_PATH_SITO",     BASE_PATH_ADMIN."uploads/");

define("INC_PATH_MODULI", 		BASE_PATH_SITO."include/template/moduli/");
define("INC_PATH_CONTROLLER", 	BASE_PATH_SITO."include/controller/");

define("URL_LANDING",			BASE_URL_LANDING);
$_SESSION['URL_LANDING']    =   BASE_URL_LANDING;

/**
 * ------------------------------------------------------------------------
 **| lista di IP di connessione internet per Network Service               |
 * ------------------------------------------------------------------------
 */
define('REMOTE_ADDRESS', $_SERVER['REMOTE_ADDR']);
define("IP_EUTELIA"    , "62.94.141.47");
define("IP_FASTWEB"    , "93.63.81.21");
define("IP_VODAFONE"   , "93.145.108.235");
define("IP_VODAFONE2"  , "5.89.51.153");
define("IP_NEW"        , "81.29.177.128");
define('IP_ANDREA'     , '217.61.62.216');

$ips_network_service = array(
								IP_EUTELIA,
								IP_FASTWEB,
								IP_VODAFONE,
								IP_VODAFONE2,
								IP_NEW,
								IP_ANDREA
							);
if(in_array($_SERVER['REMOTE_ADDR'], $ips_network_service )){
	define('IS_NETWORK_SERVICE_USER',1);
}else{
	define('IS_NETWORK_SERVICE_USER',0);
}
/**
 * ------------------------------------------------------------------------
 **| se diverso da 0 l'applicazione disabilita l'accesso                   |
 * ------------------------------------------------------------------------
 */
define('MANUTENZIONE',			0);

define('DATA_SERVIZI_VISIBILI',	'2021-02-22');
define('ITA_DATA_SERVIZI_VISIBILI',	'22-02-2021');

// prima di questa data si caricano i moduli OLD in crea proposte, ecc.!!
define('DATA_QUOTO_V2',	'2019-05-26');
$_SESSION['DATA_QUOTO_V2'] = DATA_QUOTO_V2;
/**
 * * DATA_CRYPT_CARTE
 * ------------------------------------------------------------------------
 * | impostare la data lo stesso giorno della pubblicazione di QUOTO v3    |
 * ------------------------------------------------------------------------
 */
define('DATA_CRYPT_CARTE',	'2024-04-15');
/**
 * * DATA DI MESSA ONLINE DI QUOTO V.3
 * --------------------------------------------------------------------------
 * |  dopo questa data di pubblicazione del nuovo QUOTO gli utenti           |
 * |  non avranno la possibilità di switchare verso la vecchia interfaccia!  |
 * --------------------------------------------------------------------------
 */
define('DATA_QUOTO_V3',	'2024-04-18');
$_SESSION['DATA_QUOTO_V3'] = DATA_QUOTO_V3;
/**
 * * NUMERO MASSIMO DI INFO BOX TAG DA INSERIRE
 * --------------------------------------------------------------------------
 * |  è stato deciso che il munero massimo sia 5                             |
 * --------------------------------------------------------------------------
 */
define('NUM_INFOBOXTAG',	5);
$_SESSION['NUM_INFOBOXTAG'] = NUM_INFOBOXTAG;
/**
 * * variabili utili per i file CRON!!
 */
$send_mail       = 'no-reply@quotocrm.it';
$path_cron       = '$_SERVER['DOCUMENT_ROOT']/';
$UrlLanding      = BASE_URL_LANDING;
$BaseUrlSito     = BASE_URL_SITO;
$BaseUrlSuiteweb = 'https://www.quotocrm.it/';
/**
 * * VARIABILI UTILI ALLA PAGINAZIONE TRA PHP E DATABLE JQUERY
 * ------------------------------------------------------------------------------------
 * |  MINUTI DOPO I QUALI SI RICARICANO LE PAGINE (preventivi, conferme, prenotazioni) |
 * ------------------------------------------------------------------------------------
 */
define('MINUTI_RICARICA',5);
/**
 * * VARIABILI UTILI ALLA PAGINAZIONE TRA PHP E DATABLE JQUERY
 * --------------------------------------------------------------------------
 * |  RIGHE_PER_PAGINA = 30  												 |
 * |  PAGINE_VICINE = 3   											         |
 * |  NUMERO_RECORD = 800                                                    |
 * --------------------------------------------------------------------------
 */
define('RIGHE_PER_PAGINA',30);
define('PAGINE_VICINE',3);
define('NUMERO_RECORD',900);
/**
 * * variabili indirizzi email degli operatori Network
 */
$MAIL_MARCELLO           = 'marcello@network-service.it';
$MAIL_SERENA             = 'serena@network-service.it';
$MAIL_SERENA_QT          = 'support@quoto.travel';
$MAIL_ANTONIO            = 'antonio@network-service.it';
$MAIL_RICCARDO           = 'riccardo@network-service.it';
$MAIL_WEBMARKETING       = 'webmarketing@network-service.it';
$MAIL_WEBMARKETING_STAFF = 'marketing.staff@network-service.it';
$MAIL_NICOLA             = 'nicola@network-service.it';
$MAIL_AGGIORNAMENTI      = 'aggiornamenti@network-service.it';
$MAIL_MARKETING          = 'marketing@network-service.it'; 
$MAIL_COMMERCIALI        = 'commerciali@network-service.it';

/**
 * * definizione degli IDSITO per i quali la index viene caricata con meno moduli
 * ! elenco: garganomizar;campingmiravalle,touringhotelrimini
 */
define('MODULI_INDEX', array(2030,1560,102));
?>
