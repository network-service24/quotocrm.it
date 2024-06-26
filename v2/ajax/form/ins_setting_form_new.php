<?php
 include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");

 error_reporting(0); 

 require_once BASE_PATH_SITO. '/class/MysqliDb.php';

 $db_form = new MysqliDb(HOST,DB_USER,DB_PASSWORD,DATABASE);

				
	if($_REQUEST['action']=='ins_setting'){

		$idSito                   = $_REQUEST['idsito'];

		$idForm                   = $_REQUEST['idform'];

		$chiave_sito_recaptcha    = $_REQUEST['chiave_sito_recaptcha'];

		$chiave_segreta_recaptcha = $_REQUEST['chiave_segreta_recaptcha'];


		$update = "UPDATE hospitality_form_testata SET chiave_sito_recaptcha = '".$chiave_sito_recaptcha."', chiave_segreta_recaptcha = '".$chiave_segreta_recaptcha."' WHERE id = '".$idForm."' AND idsito = '".$idSito."' ";
		$db_form->query($update);

		
	}

?>