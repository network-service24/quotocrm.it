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
		

$id_campo = $_REQUEST['id_campo'];


	$query = "SELECT id_campo as idcontent, label, campo FROM hospitality_form_contenuti_lang WHERE id_campo =" . $id_campo." AND id_lang = 1";
	$sel   = $dbMysqli->query($query);
	$row   = $sel[0];

	function clean_string($stringa){

		$clean_title = str_replace( "!", "", $stringa );
		$clean_title = str_replace( "?", "", $clean_title );
		$clean_title = str_replace( "|", "", $clean_title );
		$clean_title = str_replace( ":", "", $clean_title );
		$clean_title = str_replace( "+", "", $clean_title );
		$clean_title = str_replace( "à", "a", $clean_title );
		$clean_title = str_replace( "è", "e", $clean_title );
		$clean_title = str_replace( "é", "e", $clean_title );
		$clean_title = str_replace( "ì", "i", $clean_title );
		$clean_title = str_replace( "ò", "o", $clean_title );
		$clean_title = str_replace( "ù", "u", $clean_title );
		$clean_title = str_replace( "n.", "", $clean_title );
	    $clean_title = str_replace( "€", "", $clean_title );
	    $clean_title = str_replace( "%", "", $clean_title );	
		$clean_title = str_replace( ".", "", $clean_title );
		$clean_title = str_replace( ",", "", $clean_title );
		$clean_title = str_replace( ";", "", $clean_title );
		$clean_title = str_replace( "-", "", $clean_title );
		$clean_title = str_replace( "'", "", $clean_title );
		$clean_title = str_replace( "*", "", $clean_title );
		$clean_title = str_replace( "/", "", $clean_title );
		$clean_title = str_replace( "\"", "", $clean_title );
		$clean_title = str_replace( "+", "_", $clean_title );
		$clean_title = strtolower($clean_title);
		$clean_title = trim($clean_title);
		$clean_title = str_replace( " ", "_", $clean_title );

		return($clean_title);
	}


        $name = clean_string($row['label']);
      

        $update = "UPDATE hospitality_form_contenuti SET name = '".$name."' WHERE id =" . $row['idcontent'];
        $dbMysqli->query($update);


	echo $name;


?>