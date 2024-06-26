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
		
$array	= $_REQUEST['item'];

if ($_POST['update'] == "update"){
	
	$count = 1;
	foreach ($array as $idval) {
		$query = "UPDATE hospitality_form_contenuti set ordinamento =" . $count . " WHERE id=" . $idval;
		$dbMysqli->query($query);
		$count ++;	
	}
	echo ' <div class="alert alert-success alert-dismissable">Tutti salvato! senza aggiornare la pagina!</div>';
}

?>