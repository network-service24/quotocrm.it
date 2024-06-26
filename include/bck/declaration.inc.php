<?php
/**
 * CRM
 * @author Marcello Visigalli < marcello.visigalli@gmail.com >
 * @name QUOTO!
 */
include("$_SERVER['DOCUMENT_ROOT']/class/MysqliDb.php");

$dbMysqli  = new MysqliDb (HOST, DB_USER, DB_PASSWORD, DATABASE);

$dbMysqli_suiteweb  = new MysqliDb (HOST, DB_USER, DB_PASSWORD, DATABASE);

/** classe per redirect in javascript */
include('$_SERVER['DOCUMENT_ROOT']/class/printer.class.php');
$prt = new printer();

/** classe per funzioni codice php */
include('$_SERVER['DOCUMENT_ROOT']/class/functions.class.php');
$fun = new functions();

/** classe per log php */
include('$_SERVER['DOCUMENT_ROOT']/class/class.mylib.php');
$log = new Logging();
$log->lfile('$_SERVER['DOCUMENT_ROOT']/tmp/log_'.$_SESSION['IDSITO'].'.txt');
?>
