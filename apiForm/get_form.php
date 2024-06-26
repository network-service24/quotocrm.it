<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invio form in corso.....| QUOTO!</title>
<?
/**
 ** setting definizioni
 */
include($_SERVER['DOCUMENT_ROOT'].'/include/settings.inc.php');
/**
 ** classe per invio mail
 */
require INC_PATH_CLASS.'PHPMailer/PHPMailerAutoload.php';

$mail_quoto       = new PHPMailer;
$mail_quoto_hotel = new PHPMailer;
/**
 ** funzioni PHP per esecuzoine del codice e stamp a video del form
 */
include_once(BASE_PATH_SITO.'apiForm/function.form.php');
/**
 ** classe MySqli per connessioni al DB
 */
require_once INC_PATH_CLASS . 'MysqliDb.php';

$DB_QUOTO = new MysqliDb(HOST, DB_USER, DB_PASSWORD, DATABASE);
/**
 ** ri-valorizzazione delle variabili in REQUEST
 */
$id_form            = trim($_REQUEST['id_form']);
$idsito             = trim($_REQUEST['idsito']); 
$id_lang            = trim($_REQUEST['id_lang']);
$urlback            = trim($_REQUEST['urlback']);
$language           = trim($_REQUEST['language']);

$captcha            = trim($_REQUEST['captcha']);
$jquery             = trim($_REQUEST['jquery']);
$fontawesome        = trim($_REQUEST['fontawesome']);
$bootstrap          = trim($_REQUEST['bootstrap']);

$res                = trim($_REQUEST['res']);
$tracking           = trim($_REQUEST['tracking']);
$_ga                = trim($_REQUEST['_ga']);
$NumeroPrenotazione = trim($_REQUEST['NumeroPrenotazione']);
$action             = trim($_REQUEST['action']);
$testo_form         = $_REQUEST['testo_form'];
?>
<!--
/**
** se la variabile Jquery è istanziata a true viene incluso il framework
*/
-->
<?php if($jquery==1){ ?>
    <script type="text/javascript" src="<?=BASE_URL_SITO?>apiForm/js/jquery-3.1.1.min.js"></script>
<?}?>
<!--
/**
** se la variabile fontawesome è istanziata a true viene inclusa la libreria
*/
-->
<?php if($fontawesome==1){ ?>
    <script src="https://use.fontawesome.com/da6d3ea52f.js"></script>
<?}?>
<!--
/**
** librerie Js e CSS
*/
-->
<link type="text/css" href="<?=BASE_URL_SITO?>apiForm/js/jquery_ui/jquery-ui.min.css" rel="Stylesheet" />
<script type="text/javascript" src="<?=BASE_URL_SITO?>apiForm/js/jquery_ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?=BASE_URL_SITO?>apiForm/js/jquery_ui/datapicker-lang/jquery.ui.datepicker-<?=($language == ''?'it':$language)?>.min.js"></script>						
<script type="text/javascript" src="<?=BASE_URL_SITO?>apiForm/js/jquery.validate.min.js"></script>
<link type="text/css" href="<?=BASE_URL_SITO?>apiForm/css/form_quoto.css" rel="Stylesheet" />
<!--
/**
** e la variabile bootstrap è istanziata a true viene inclusa la libreria js e css di bootstrap 5
*/
-->
<?php if($bootstrap==1){ ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<?}?>
<!--
/**
** funzioni utili alla renderFormQuoto() in Js
*/
-->
<?php include(BASE_PATH_SITO.'apiForm/function.js.php');?>
<!--
/**
** libreria api.js per ReCaptcha
*/
-->
<?php echo ($language=='it'?'<script src="https://www.google.com/recaptcha/api.js" async defer></script>':'<script src="https://www.google.com/recaptcha/api.js?hl='.$language.'" async defer></script>')."\r\n";?>
<style>
.wrapper {
  width: 600px; /*largezza del blocco*/
  height:400px; /*indichimo altezza del blocco*/
  transform: translate(-50%, -50%);
  position: absolute; 
  top: 50%; 
  left: 50%;
}

</style>
</head>

<body style="background-color:transparent">




<!--
/**
** controllo se il cliente è abilitato all'uso di QUOTO!
*/
-->
<?php

    $id_form_control             = (isset($_GET['id_form'])?$_GET['id_form']:'');
    $idsito_control              = (isset($_GET['idsito'])?$_GET['idsito']:''); 
    $id_lang_control             = (isset($_GET['id_lang'])?$_GET['id_lang']:'');
    $urlback_control             = (isset($_GET['urlback'])?$_GET['urlback']:'');
    $language_control            = (isset($_GET['language'])?$_GET['language']:'');
    $captcha_control             = (isset($_GET['captcha'])?$_GET['captcha']:'');
    $jquery_control              = (isset($_GET['jquery'])?$_GET['jquery']:'');
    $fontawesome_control         = (isset($_GET['fontawesome'])?$_GET['fontawesome']:'');
    $bootstrap_control           = (isset($_GET['bootstrap'])?$_GET['bootstrap']:'');
    $res_control                 = (isset($_GET['res'])?$_GET['res']:'');
    $tracking_control            = (isset($_GET['tracking'])?$_GET['tracking']:'');
    $_ga_control                 = (isset($_GET['_ga'])?$_GET['_ga']:'');
    $NumeroPrenotazione_control  = (isset($_GET['NumeroPrenotazione'])?$_GET['NumeroPrenotazione']:'');
    $action_control              = (isset($_GET['action'])?$_GET['action']:'');
    $testo_form_control          = (isset($_GET['testo_form'])?$_GET['testo_form']:'');



if( $id_form_control            ||
    $idsito_control             ||
    $id_lang_control            ||
    $urlback_control            ||
    $language_control           ||
    $captcha_control            ||
    $jquery_control             ||
    $fontawesome_control        ||
    $bootstrap_control          ||
    $res_control                ||
    $tracking_control           ||
    $_ga_control                ||
    $NumeroPrenotazione_control ||
    $action_control             ||
    $testo_form_control) {

    /**
     ** se l'utente tenta un accesso via stringa url passando le variabili in GET dal browser, stampa avviso a video!
     */

        echo '<div class="wrapper"> 
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <b>Non sei in possesso dei permessi necessari per accedere a quest\'area dedicata del CRM QUOTO!</b>
                            <br /><br />
                            <small> 
                                <em>Contattare:</em><br />
                                <b>Network Service srl</b><br />
                                Via Valentini A. e L., 11 47922 Rimini (RN), Italia <br />
                                <b>Tel:</b> +39 0541790062 | <b>Fax:</b> +39 054177865<br />
                                <b>Email:</b> info@network-service.it<br />
                                <b>Ticket:</b> support@quoto.travel
                            </small>
                        </div>
                    </div>
                </div>'."\r\n";

} else { 

                                       
    $check_cliente = dati_cliente($idsito);
    /**
     ** se il cliente è abilitato all'uso di QUOTO, stampa a video il form!
     */
    if(sizeof($check_cliente) > 0){
        if(empty($_REQUEST['res']) || $_REQUEST['res']!='sent'){
            echo'   <script>
                        $(document).ready(function() {
                            /**
                             * ! RITARDO APERTURA FORM
                             * */
                            setTimeout(function(){
                                $("#loader-content-quoto").fadeOut(200);
                                $("#form-show-quoto").fadeIn();
                            }, 2000);
                        });
                    </script>'."\r\n";
            echo'   
                        <div id="loader-content-quoto">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                    <div id="welcome-quoto">
                                        <img src="'.BASE_URL_SITO.'/apiForm/img/logo_loading.png" class="logo-loader">
                                        <div class="clearfix"></div>
                                        <img src="'.BASE_URL_SITO.'/apiForm/img/Ellipsis-1s-200px.svg" alt="Modulo dedicato al CRM QUOTO v2">
                                        <div class="clearfix"></div>
                                        <div id="text-quoto">
                                            <small>
                                                Loading Form CRM QUOTO!
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>'."\r\n";
        }
        renderFormQuoto($id_form,$idsito,$language,$urlback,$captcha,$jquery,$fontawesome,$bootstrap,$res,$tracking,$_ga,$NumeroPrenotazione,$testo_form);
    }else{
        /**
         ** altrimenti stampa avviso a video
         */
        echo'<div class="wrapper">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <b>Il Form abbinato al CRM QUOTO! non è stato creato!</b>
                        <br /><br />
                        <small>Oppure:</small>
                        <ul>
                            <li> avete inserito qualche variabile di configurazione non corretta!</li>
                            <li> state tentando di usufruire del servizio con dati di accesso non autorizzati da Network Service!</li>
                        </ul>
                        <br />
                        <small> 
                            <em>Contattare:</em><br />
                            <b>Network Service srl</b><br />
                            Via Valentini A. e L., 11 47922 Rimini (RN), Italia <br />
                            <b>Tel:</b> +39 0541790062 | <b>Fax:</b> +39 054177865<br />
                            <b>Email:</b> info@network-service.it<br />
                            <b>Ticket:</b> support@quoto.travel
                        </small>
                    </div>
                </div>
            </div>'."\r\n";
    }

}

?>

</body>
</html>