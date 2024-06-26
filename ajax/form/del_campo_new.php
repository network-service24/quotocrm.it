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

 $action = $_REQUEST['action'];
 $idsito = $_REQUEST['idSito']; 
 $idform = $_REQUEST['idForm'];
 $idcampo = $_REQUEST['idCampo']; 

	if($action=='delField'){

				$delete1 = "DELETE FROM hospitality_form_contenuti WHERE id='".$idcampo."'";
				$dbMysqli->query($delete1);
				$delete2 = "DELETE FROM hospitality_form_contenuti_lang WHERE id_campo'".$idcampo."'";
				$dbMysqli->query($delete2);				

	}

?>