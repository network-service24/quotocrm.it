<?php
/**
 * CRM and CMS
 * @author Marcello Visigalli < marcello.visigalli@gmail.com >
 * @version 3.0
 * @name SuiteWeb
 * CODICE PER GESTIONE STATI,REGIONE,PROVINCIE,COMUNI
 */

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

if($_REQUEST['id_stato']){
	$select      = "SELECT * FROM regioni WHERE id_stato = ".$_REQUEST['id_stato']." ORDER BY nome_regione ASC";
	$arrayresult = $dbMysqli->query($select);
	foreach($arrayresult as $key => $value){
		$output .= '<option value="'.$value['codice_regione'].'">'.$value['nome_regione'].'</option>'."\r\n";
	}
	
	echo  '<option selected="selected" value="">scegli la regione</option>'.$output;
}

if($_REQUEST['codice_regione']){
	$select      = "SELECT * FROM province WHERE codice_regione = ".$_REQUEST['codice_regione']." ORDER BY sigla_provincia ASC";
	$arrayresult = $dbMysqli->query($select);
	foreach($arrayresult as $key => $value){
		$output .= '<option value="'.$value['codice_provincia'].'">'.$value['sigla_provincia'].'</option>'."\r\n";
	}
	echo '<option selected="selected" value="">scegli la provincia</option>'.$output;
}

if($_REQUEST['codice_provincia']){
	$select      = "SELECT * FROM comuni WHERE codice_provincia = ".$_REQUEST['codice_provincia']." ORDER BY nome_comune ASC";
	$arrayresult = $dbMysqli->query($select);
	foreach($arrayresult as $key => $value){
		$output .= '<option value="'.$value['codice_comune'].'">'.$value['nome_comune'].'</option>'."\r\n";
	}
	echo '<option selected="selected" value="">scegli il comune</option>'.$output;
}


?>
