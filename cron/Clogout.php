<?php
//session_start();
include($_SERVER['DOCUMENT_ROOT'].'/include/settings.inc.php');

unset($_SESSION['accesso']);
unset($_SESSION['superuser']);
$_SESSION['accesso'] = 'negato';

header("Location: ".BASE_URL_SITO."cron/Clogin.php");
exit;; 

?>