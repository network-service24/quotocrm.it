<?
	$select   = "SELECT anagrafica.idanagra FROM siti INNER JOIN utenti ON utenti.idsito = siti.idsito INNER JOIN anagrafica ON anagrafica.idanagra = utenti.idanagra WHERE siti.idsito = ".$_REQUEST['param'];
	$result   = $dbMysqli->query($select);
	$record   = $result[0];
	$idanagra = $record['idanagra'];

	header('Location:'.BASE_URL_ADMIN.'clienti/sw/'.$idanagra);