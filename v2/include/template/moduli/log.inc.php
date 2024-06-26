<?php

// include mylib.php (contains Logging class)
include($_SERVER['DOCUMENT_ROOT'].'/v2/class/class.mylib.php');

// Logging class initialization
$log = new Logging();

// set path and name of log file (optional)
$log->lfile($_SERVER['DOCUMENT_ROOT'].'/v2/tmp/mylog.txt');

// write message to the log file
$log->lwrite('['.$_SERVER['SERVER_NAME'].'] ['.$_SERVER['SERVER_ADDR'].'] ['.$_SERVER['SERVER_SOFTWARE'].'] ['.$_SERVER['REQUEST_URI'].'] ['.$_SERVER['REMOTE_ADDR'].' '.$_SERVER['REMOTE_USER'].'] ['.$_SERVER['HTTP_USER_AGENT'].']');


// close log file
$log->lclose();

?>