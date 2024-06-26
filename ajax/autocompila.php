<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");



  // query per i dati della richiesta
    $d     = "SELECT Nome,Cognome,Email,Cellulare FROM hospitality_guest  WHERE idsito = ".$_REQUEST['idsito']." AND Email = '".$_REQUEST['Email']."'";
    $dati_ = $dbMysqli->query($d);
	$dati  = $dati_[0];      

    $Nome           = $dati['Nome'];
    $Cognome        = $dati['Cognome'];
	$Cellulare      = $dati['Cellulare'];
    $Email          = $dati['Email'];
	
	echo'<script type="text/javascript">
					$(document).ready(function() {
								$("#Nome").val(\''.$Nome.'\');
								$("#Cellulare").val(\''.$Cellulare.'\');
								$("#Cognome").val(\''.$Cognome.'\');
					});
			</script>';	



?>