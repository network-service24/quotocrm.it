<?php
/**
 * CRM and CMS
 * @author Marcello Visigalli <a marcello.visigalli@gmail.com >
 * @version 3.0
 * @name SuiteWeb
 * CRUD for insert, update, delete query in ajax
 */
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


$password = $fun->hidden_password(base64_decode($_REQUEST['pass']));

echo'
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="'.BASE_URL_SITO.'files/assets/css/style.css">
    <!-- Jquery -->
    <script type="text/javascript" src="'.BASE_URL_SITO.'files/bower_components/jquery/js/jquery.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="'.BASE_URL_SITO.'files/assets/icon/font-awesome/css/font-awesome.min.css">
    <script type="text/javascript" src="'.BASE_URL_SITO.'js/custom_functions.js"></script>'."\r\n";
echo 
    '<testo class="f-16">'.$password.'</testo>';

?>