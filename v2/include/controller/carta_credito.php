<?php

	$db->query('SELECT hospitality_carte_credito.*,hospitality_guest.Nome,hospitality_guest.Cognome,hospitality_guest.NumeroPrenotazione,hospitality_guest.AccontoRichiesta,
				hospitality_guest.AccontoLibero,hospitality_guest.Chiuso,hospitality_guest.Archivia,hospitality_guest.Hidden
				FROM hospitality_carte_credito
				INNER JOIN hospitality_guest ON hospitality_guest.Id = hospitality_carte_credito.id_richiesta
				WHERE hospitality_carte_credito.id_richiesta = '.$_REQUEST['id_richiesta'].' AND hospitality_carte_credito.idsito = '.IDSITO);
	$rows               =  $db->row();
	$Nome               = stripslashes($rows['Nome']);
	$Cognome            = stripslashes($rows['Cognome']);
	$chiuso             = $rows['Chiuso'];
	$archivia           = $rows['Archivia'];
	$Hidden             = $rows['Hidden'];
	$NumeroPrenotazione = $rows['NumeroPrenotazione'];
	$AccontoRichiesta   = $rows['AccontoRichiesta'];
	$AccontoLibero      = $rows['AccontoLibero'];
	$IdRichiesta        = $rows['id_richiesta'];
	$Carta              = $rows['carta'];
	$idCarta            = $rows['Id'];
	$visibile           = $rows['visibile'];
	for($i==0; $i<4; $i++){
			$star .= '*';
	}
	//$NumeroCarta_hidden = '<span id="hid">'.substr(base64_decode($rows['numero_carta']),0,-10).' <span id="vedi">'.$star.' '.$star.' <i class="fa fa-question" title="Clicca per visualizzare" style="cursor:pointer;cursor:hand;"></i></span></span>';
	//$NumeroCarta        = base64_decode($rows['numero_carta']);
	if($rows['data_inserimento'] >= DATA_CRYPT_CARTE){
		$decryption_iv      = '1234567891011121';
		$ciphering          = "AES-128-CTR";
		$decryption_key     = "W3docs";
		$decryption         = openssl_decrypt($rows['numero_carta'], $ciphering, $decryption_key, $options, $decryption_iv);
		$NumeroCarta_hidden = '<span id="hid">'.substr($decryption,0,-10).' <span id="vedi">'.$star.' '.$star.' <i class="fa fa-question" title="Clicca per visualizzare" style="cursor:pointer;cursor:hand;"></i></span></span>';
		$NumeroCarta        = $decryption;
	}else{
		$NumeroCarta_hidden = '<span id="hid">'.substr(base64_decode($rows['numero_carta']),0,-10).' <span id="vedi">'.$star.' '.$star.' <i class="fa fa-question" title="Clicca per visualizzare" style="cursor:pointer;cursor:hand;"></i></span></span>';
		$NumeroCarta        = base64_decode($rows['numero_carta']);
	}
	$Intestatario       = $rows['intestatario'];
	$Scadenza           = $rows['scadenza'];
	$CVV                = $rows['cvv'];
	$DataIns            = explode("-",$rows['data_inserimento']);
	$DataInserimento    = $DataIns[2].'-'.$DataIns[1].'-'.$DataIns[0];
	$n_g = differenza_date($rows['data_inserimento'],date('Y-m-d'),'g');
	if($n_g >= 730){
		$Dvisibile = 0;
	}else{
		$Dvisibile = 1;
	}

	switch($Carta){
		case"mastercard":
			$icona_carta = '<i class="fa fa-cc-mastercard fa-2x fa-fw text-orange"></i>';
		break;
		case"visa":
			$icona_carta = '<i class="fa fa-cc-visa fa-2x fa-fw text-blue"></i>';
		break;
		case"amex":
			$icona_carta = '<i class="fa fa-cc-amex fa-2x fa-fw text-aqua"></i>';
		break;
		case"dinersclub":
			$icona_carta = 'i class="fa fa-cc-diners-club fa-2x fa-fw text-light-blue"></i>';
		break;
		default:
			$icona_carta = '<i class="fa fa-credit-card fa-2x fa-fw text-light-blue"></i>';
		break;
	}
	$db->query("SELECT  hospitality_proposte.PrezzoP as PrezzoP,hospitality_proposte.AccontoPercentuale as AccontoPercentuale,
            hospitality_proposte.AccontoImporto as AccontoImporto
            FROM hospitality_proposte
            WHERE hospitality_proposte.id_richiesta = ".$_REQUEST['id_richiesta']."");
            $rec = $db->result();
            $PrezzoPC = '';
            foreach ($rec as $key => $value) {
                $PrezzoPC           = $value['PrezzoP'];
                $AccontoPercentuale = $value['AccontoPercentuale'];
        		$AccontoImporto     = $value['AccontoImporto'];
            }

    if($AccontoRichiesta != 0 && $AccontoLibero == 0) {
        $acconto = '<b>€. '.number_format(($PrezzoPC*$AccontoRichiesta/100),2,',','.').'</b>';
    }
    if($AccontoPercentuale != 0 && $AccontoImporto == 0) {
        $acconto = '<b>€. '.number_format(($PrezzoPC*$AccontoPercentuale/100),2,',','.').'</b>';
    }
    if($AccontoRichiesta == 0 && $AccontoLibero != 0) {
        $acconto = '<b>€. '.number_format($AccontoLibero,2,',','.').'</b>';
    }
    if($AccontoPercentuale == 0 && $AccontoImporto != 0) {

		if($AccontoImporto >= 1){
			$acconto = '<b>€. '.number_format($AccontoImporto,2,',','.').'</b>';
		  }else{
			$acconto = '<b>Carta di Credito a Garanzia</b>';
		  }
		}
		if($Hidden == 0){
			if($archivia == 0){
				if($chiuso == 0){
					$link='conferme/';
				}else{
					$link ='prenotazioni/';
				}
			}else{
				$link='archivio/';
			}
		}else{
			$link='cestino/';
		}

$script_hide_cc = "<script>
											$(document).ready(function(){
												$('#vedi').click(function(){
														$('#visible').removeAttr('style');
														$('#hid').css('display','none');
												});
											});
									</script>"."\r\n";

$script_change_view = "<script>
													$(document).ready(function(){
															$('#del_cc').click(function(){
																		if (window.confirm(\"ATTENZIONE: Sicuro di voler eliminare i dati della Carta di Credito?\")){
																				$.ajax({
																								url: \"".BASE_URL_SITO."ajax/change_view_cc.php\",
																								type: \"POST\",
																								data: \"idCarta=".$idCarta."\",
																								dataType: \"html\",
																								success: function(data) {
																												$(\"#view_cc\").remove();
																												$(\"#attention\").remove();
																												$(\"#del_cc\").remove();
																										}
																							});
																						return false;
																		}
															});
													});
											</script> "."\r\n";

$script_skeuocard_top = " <link rel=\"stylesheet\" href=\"".BASE_URL_SITO."skeuocard/styles/skeuocard.reset.css\" />
													<link rel=\"stylesheet\" href=\"".BASE_URL_SITO."skeuocard/styles/skeuocard.css\" />
													<script src=\"".BASE_URL_SITO."skeuocard/javascripts/vendor/cssua.min.js\"></script>"."\r\n";

$script_skeuocard = "	<script src=\"".BASE_URL_SITO."skeuocard/javascripts/vendor/demo.fix.js\"></script>
											<script src=\"".BASE_URL_SITO."skeuocard/javascripts/skeuocard.js\"></script>
											<script>
														$(document).ready(function(){
															var isBrowserCompatible =
																$('html').hasClass('ua-ie-10') ||
																$('html').hasClass('ua-webkit') ||
																$('html').hasClass('ua-firefox') ||
																$('html').hasClass('ua-opera') ||
																$('html').hasClass('ua-chrome');

															if(isBrowserCompatible){
																window.card = new Skeuocard($(\"#skeuocard\"), {
																	debug: false
																});
															}
														});
											</script>"."\r\n";
	?>
