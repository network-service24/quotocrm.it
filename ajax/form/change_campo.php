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
		
$id_tipo_input = $_REQUEST['id_tipo_input'];
$id_campo      = $_REQUEST['id_campo'];
$obb           = $_REQUEST['obb'];
$name          = strtolower($_REQUEST['name']);
$label         = urldecode($_REQUEST['label']);
$idContent     = $_REQUEST['idContent'];

		$query = "SELECT params FROM hospitality_form_campi WHERE id =" . $id_tipo_input;
		$sel   = $dbMysqli->query($query);
		$row   = $sel[0];

        $input = str_replace('[name]',$name ,$row['params']);
        $input = str_replace('[id]',$idContent ,$input);
        $input = str_replace('[placeholder]',$label,$input);
        $input = str_replace('[obbligatorio]',($obb==0?'':'required'),$input);

	$update = "UPDATE hospitality_form_contenuti_lang SET campo = '".$input."', label = '".$label."' WHERE id =" . $id_campo;
	$dbMysqli->query($update);

	echo $input;

?>