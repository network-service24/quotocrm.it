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
		
$label    = $_REQUEST['label'];
$id_campo = $_REQUEST['id_campo'];


		$query = "SELECT campo FROM hospitality_form_contenuti_lang WHERE id =" . $id_campo;
		$sel   = $dbMysqli->query($query);
		$row   = $sel[0];


        $input = strstr($row['campo'],'placeholder="');
        $input = substr($input,13,1000);
        $input = explode('"',$input);
        $input = str_replace($input[0],$label,$row['campo']);

	$update = "UPDATE hospitality_form_contenuti_lang SET campo = '".$input."', label = '".$label."' WHERE id =" . $id_campo;
	$dbMysqli->query($update);

	echo $input;

?>