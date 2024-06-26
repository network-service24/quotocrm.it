<?
$select = "SELECT hospitality_dizionario.etichetta,hospitality_dizionario_lingua.testo FROM hospitality_dizionario
			INNER JOIN hospitality_dizionario_lingua ON hospitality_dizionario_lingua.id_dizionario = hospitality_dizionario.id
			WHERE hospitality_dizionario_lingua.Lingua = '".$Lingua."'
			AND hospitality_dizionario_lingua.idsito = ".$idsito;
$result = $dbMysqli->query($select);
$tot_l = sizeof($result);
if($tot_l > 0){
	foreach ($result as $key => $value) {
		define($value['etichetta'],$value['testo']);
	}
}else{
	define( 'SOLUZIONECONFERMATA','Soluzione Confermata');
	define( 'DATISOGGIORNO','Dati del soggiorno:');
	define( 'TIPOSOGGIORNO','Tipo soggiorno:');
	define( 'DATAARRIVO','Data arrivo:');
	define( 'DATAPARTENZA','Data partenza:');
	define( 'SISTEMAZIONE','Sistemazione:');
	define( 'CAPIENZAADULTI','<b>Capienza Adulti:</b>');
	define( 'CAPIENZABAMBINI','<b>Capienza Bambini:</b>');
	define( 'METRATURA','<b>Metratura:</b>');
	define('SERVIZICAMERA','<b>Servizi in camera:</b>');
	define('PRENOTAZIONE', 'Prenotazione');
	define('CONFERMA','Conferma');
	define('PREVENTIVO','Preventivo');
	define('NOTE','Note:');
	define('TXTLINK1','Clicca qui per vedere la pagina di ');
	define('TXTLINK2',' a te dedicata per la tua vacanza da sogno:');
	define('PAGINARISERVATA','Pagina Web riservata a:');
	define('SALUTI','I nostri migliori saluti.');
	define('OFFERTA_DETTAGLIO','Vai al dettaglio dell\'offerta');
	define('PAGAMENTO','Come effettuare il pagamento dell\'acconto');

	define('OGGETTO', 'Dopo essere stato nostro ospite, le chiediamo una sua opinione sui nostri servizi');
	define('TESTOMAIL', 'Gentile [cliente], fiduciosi che il suo soggiorno presso la nostra struttura ricettiva sia stato di suo gradimento, la invitiamo a cliccare sul link che trova in basso nella mail, in pochi minuti potrà dare una sua opinione sui servizi relativi al nostro hotel.');
	define('VAI_AL_QUEST', 'Vai al questionario');	
}

?>

                               