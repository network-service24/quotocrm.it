 <?php
	include($_SERVER['DOCUMENT_ROOT'].'/include/settings.inc.php');
  include($_SERVER['DOCUMENT_ROOT'].'/include/declaration.inc.php');
//  unset($_SESSION['utente']);
//	unset($_SESSION);
 session_destroy();
  $prt->_goto(BASE_URL_ADMIN.'login.php');
  exit;
  //header("Location:".BASE_URL_ADMIN."login.php",true);
 // die("Stai per essere reindirizzato alla pagina di login");

