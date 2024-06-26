<?php
include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");
 error_reporting(0); 
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password, $dbname) or die ("Error connecting to database");

	$checkbox_value = explode(',',$_REQUEST['checkbox_value']);
	$idsito         = $_REQUEST['idsito'];
	$cestino        = $_REQUEST['cestino'];
	if($cestino == 1){
		if(is_array($checkbox_value) && !empty($checkbox_value)){ 
			foreach ($checkbox_value as $key => $value) {
	
				$sel = "SELECT NumeroPrenotazione FROM hospitality_guest WHERE Id = '".$value."' AND idsito = ".$idsito;
				$res = mysqli_query($conn,$sel);
				$row = mysqli_fetch_assoc($res);
				
				mysqli_query($conn,"UPDATE  hospitality_guest SET Hidden = 1 WHERE Id = '".$value."' AND idsito = ".$idsito);
				
			}
		}
	}else{
		if(is_array($checkbox_value) && !empty($checkbox_value)){ 
			foreach ($checkbox_value as $key => $value) {
	
				$sel = "SELECT NumeroPrenotazione FROM hospitality_guest WHERE Id = '".$value."' AND idsito = ".$idsito;
				$res = mysqli_query($conn,$sel);
				$row = mysqli_fetch_assoc($res);
				
				mysqli_query($conn,"DELETE FROM hospitality_guest WHERE Id = '".$value."' AND idsito = ".$idsito);
				mysqli_query($conn,"DELETE FROM hospitality_richiesta WHERE id_richiesta = '".$value."'");
				mysqli_query($conn,"DELETE FROM hospitality_proposte WHERE id_richiesta = '".$value."'");
				mysqli_query($conn,"DELETE FROM hospitality_check_modifica WHERE id_richiesta = '".$value."' AND idsito = ".$idsito);
				mysqli_query($conn,"DELETE FROM hospitality_chat WHERE id_guest = '".$value."' AND idsito = ".$idsito); 
				mysqli_query($conn,"DELETE FROM hospitality_chat_notify WHERE NumeroPrenotazione = '".$row['NumeroPrenotazione']."' AND idsito = ".$idsito);
				mysqli_query($conn,"DELETE FROM hospitality_customer_satisfaction WHERE id_richiesta = '".$value."' AND idsito = ".$idsito); 
				mysqli_query($conn,"DELETE FROM hospitality_recensioni_send WHERE id_richiesta = '" . $value . "' AND idsito = " . $idsito); 
				mysqli_query($conn,"DELETE FROM hospitality_relazione_servizi_proposte WHERE id_richiesta = '".$value. "' AND idsito = " . $idsito);
	
				mysqli_query($conn,"DELETE FROM hospitality_rel_pagamenti_preventivi WHERE id_richiesta = '".$value. "' AND idsito = " . $idsito);
				mysqli_query($conn,"DELETE FROM hospitality_relazione_sconto_proposte WHERE id_richiesta = '".$value. "' AND idsito = " . $idsito);
				mysqli_query($conn,"DELETE FROM hospitality_relazione_visibili_servizi_proposte WHERE id_richiesta = '".$value. "' AND idsito = " . $idsito);
				mysqli_query($conn,"DELETE FROM hospitality_altri_pagamenti WHERE id_richiesta = '".$value."' AND idsito = ".$idsito); 
				mysqli_query($conn,"DELETE FROM hospitality_carte_credito WHERE id_richiesta = '".$value."' AND idsito = ".$idsito); 
				mysqli_query($conn,"DELETE FROM hospitality_template_link_landing WHERE id_richiesta = '".$value."' AND idsito = '".$idsito."'");
				mysqli_query($conn,"DELETE FROM hospitality_checkin WHERE Prenotazione = '".$row['NumeroPrenotazione']."' AND idsito = ".$idsito);   
				mysqli_query($conn,"DELETE FROM hospitality_fonti_provenienza WHERE NumeroPrenotazione = '".$row['NumeroPrenotazione']."' AND idsito = ".$idsito);
				
				mysqli_query($conn,"DELETE FROM hospitality_contenuti_web_lingua WHERE IdRichiesta = '".$value."' AND idsito = '".$idsito."'");
				mysqli_query($conn,"DELETE FROM hospitality_traccia_email WHERE IdRichiesta = '".$value."' AND Idsito = '".$idsito."'");
				mysqli_query($conn,"DELETE FROM hospitality_client_id WHERE NumeroPrenotazione = '".$row['NumeroPrenotazione']."' AND Idsito = '".$idsito."'");
				
			}
		}
	}


	mysqli_close($conn);
?>