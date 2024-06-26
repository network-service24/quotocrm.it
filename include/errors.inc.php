<?php
/**
 ** GESTIONE DEL ERROR REPORTING
 */

//error_reporting(E_ALL &~E_NOTICE &~E_WARNING);
error_reporting(E_ALL & ~E_NOTICE); //tutto tranne i notice

ini_set('display_errors', 0);
ini_set('display_startup_errors', 1);
ini_set('error_log', $_SERVER['DOCUMENT_ROOT'].'/log/php_errors.log');