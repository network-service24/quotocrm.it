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

				
	if($_REQUEST['action']=='ins_setting'){

		$idSito                   = $_REQUEST['idsito'];

		$idForm                   = $_REQUEST['idform'];

		$chiave_sito_recaptcha    = $_REQUEST['chiave_sito_recaptcha'];

		$chiave_segreta_recaptcha = $_REQUEST['chiave_segreta_recaptcha'];


		$update = "UPDATE hospitality_form_testata SET chiave_sito_recaptcha = '".$chiave_sito_recaptcha."', chiave_segreta_recaptcha = '".$chiave_segreta_recaptcha."' WHERE id = '".$idForm."' AND idsito = '".$idSito."' ";
		$dbMysqli->query($update);

		
	}

?>