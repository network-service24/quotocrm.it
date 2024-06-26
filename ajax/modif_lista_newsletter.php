<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

    $idlista   = $_REQUEST['idlista'];
    $nomelista = addslashes($_REQUEST['nomelista']);
	$idsito    = $_REQUEST['idsito'];

    $dbMysqli->query("UPDATE mailing_newsletter_nome_liste SET nome_lista = '".$nomelista."' WHERE id = '".$idlista."' AND idsito = ".$idsito);

?>