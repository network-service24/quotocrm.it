<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

	$idlista = $_REQUEST['idlista'];
	$idsito  = $_REQUEST['idsito'];

    $dbMysqli->query("DELETE FROM mailing_newsletter_nome_liste WHERE id = '".$idlista."' AND idsito = ".$idsito);
    $dbMysqli->query("DELETE FROM mailing_newsletter WHERE id_lista = '".$idlista."' AND idsito = ".$idsito);

?>