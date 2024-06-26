<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

	$idproposta = $_REQUEST['idproposta'];
	$p = "DELETE FROM hospitality_proposte WHERE Id = ".$idproposta;
	$dbMysqli->query($p);
	$r = "DELETE FROM hospitality_relazione_servizi_proposte WHERE id_proposta = ".$idproposta;
	$dbMysqli->query($r);
	$s = "DELETE FROM hospitality_richiesta WHERE id_proposta = ".$idproposta;
	$dbMysqli->query($s);

?>