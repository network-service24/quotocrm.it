<?php
	############################################################################################
	# nuovi form QUOTO ::: marcello@network-service.it ::: 01/07/2021
	############################################################################################
	function dati_cliente($idsito){
		global $DB_QUOTO;
		$s = "SELECT siti.nome,

								siti.web,
									siti.email,
									siti.email_alternativa_form_quoto,
									siti.indirizzo,
									siti.cap,
									siti.tel,
									siti.fax,
									siti.https,
									anagrafica.rag_soc,
									anagrafica.p_iva,
									utenti.logo,
									utenti.idutente,
									comuni.nome_comune,
									province.nome_provincia,
									province.sigla_provincia,
									stati.nome_stato
					FROM siti
					INNER JOIN utenti ON utenti.idsito = siti.idsito
					INNER JOIN anagrafica ON anagrafica.idanagra = utenti.idanagra
					INNER JOIN comuni ON comuni.codice_comune = siti.codice_comune
					INNER JOIN province ON province.codice_provincia = siti.codice_provincia
					INNER JOIN stati ON stati.id_stato = siti.id_stato
					WHERE siti.idsito = " . $idsito . "
					AND utenti.blocco_accesso = 0
					AND siti.hospitality = 1
					AND siti.data_start_hospitality <= '" . date('Y-m-d') . "'
					AND siti.data_end_hospitality > '" . date('Y-m-d') . "'";
					$re  = $DB_QUOTO->query($s);
					$rec = $re[0];
		return $rec;
	}

	// funzione per controllo captcha
	function verifyCaptcha($response, $remoteip, $chiave_segreta_recaptcha){

		$url = "https://www.google.com/recaptcha/api/siteverify";
		$url .= "?secret=" . urlencode(stripslashes($chiave_segreta_recaptcha));
		$url .= "&response=" . urlencode(stripslashes($response));
		$url .= "&remoteip=" . urlencode(stripslashes($remoteip));

		$response = file_get_contents($url);
		$response = json_decode($response, true);

		return (object) $response;
	}

	// funzione per ripulire in minima parte una stringa
	function mini_clean($stringa){

		$clean_title = str_replace( "*", "", $stringa );
		$clean_title = str_replace( "'", "", $clean_title );
		$clean_title = str_replace( "/", "", $clean_title );
		$clean_title = str_replace( "\"", "", $clean_title );
		$clean_title = trim($clean_title);

		return($clean_title);
	}
	// funzione per il top email
	function top_email($hotel,$base_url){

		$top = "<html xmlns=\"http://www.w3.org/1999/xhtml\">
				<head>
					<meta http-equiv=\"content-type\" content=\"text/html; charset=UTF-8\">
					<title>".$hotel."</title>
					<link rel=\"stylesheet\" type=\"text/css\" href=\"".$base_url."css/style_email.css\" />
					<style>
						@charset \"UTF-8\";

					@font-face {
					font-family: 'Source Sans Pro';
					font-style: normal;
					font-weight: 300;
					src: local('Source Sans Pro Light'), local('SourceSansPro-Light'), url(".$base_url."css/fonts/toadOcfmlt9b38dHJxOBGNbE_oMaV8t2eFeISPpzbdE.woff) format('woff');
					}
					@font-face {
					font-family: 'Source Sans Pro';
					font-style: normal;
					font-weight: 400;
					src: local('Source Sans Pro'), local('SourceSansPro-Regular'), url(".$base_url."css/fonts/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff');
					}
					@font-face {
					font-family: 'Source Sans Pro';
					font-style: normal;
					font-weight: 700;
					src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(".$base_url."css/fonts/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format('woff');
					}

					@font-face {
					font-family: 'Vollkorn';
					font-style: normal;
					font-weight: 400;
					src: local('Vollkorn Regular'), local('Vollkorn-Regular'), url(".$base_url."css/fonts/BCFBp4rt5gxxFrX6F12DKvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
					}
					@font-face {
					font-family: 'Vollkorn';
					font-style: normal;
					font-weight: 700;
					src: local('Vollkorn Bold'), local('Vollkorn-Bold'), url(".$base_url."css/fonts/wMZpbUtcCo9GUabw9JODeobN6UDyHWBl620a-IRfuBk.woff) format('woff');
					}

					body { background-image:url(".$base_url."img/bg-mail.jpg); background-position:top left; background-repeat:no-repeat; background-color:#FFFFFF; margin:0 auto; font-family:Tahoma,Geneva,sans-serif; font-size:11px; }
					a{ text-decoration:none; color:#333333; }
					h2{ font-size:12pt; }
					.tbl_body { width:850px; font-size:9pt; background-color:#FFFFFF; border-collapse:collapse; }
					.tbl_body td { padding:5px; }
					td{white-space: nowrap;}
					.tbl_body .spacer_td { border-top:solid 1px #999999; background-color:#EEEEEE; height:30px; }
					.tbl_body .spacer_btm_td { border-bottom:solid 1px #999999; height:15px; }
					.title{ background-color:#FFFFFF; color:#333333; font-size:13pt; }
					.footer{ background-color:#BBBBBB; color:#666666; font-size:8pt;padding:10px 3px; }
					.footer a{ color:#EEEEEE; }
					</style>
				</head>
				<body>
				<table class=\"tbl_body\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\">
					<tr>
						<td align=\"left\" valign=\"top\">";

		return($top);
	}
	// funzione per il footer email
	function footer_email(){

		$footer = '   </td>
					</tr>
				</table>
			</body>
		</html>';

		return($footer);
	}
	// funzione per controllo doppi inserimenti in quoto
	function check_double_syncro_form_sito($idsito,$NumeroPrenotazione){
		global $DB_QUOTO;
		
			$select = "SELECT COUNT(NumeroPrenotazione) as numero FROM hospitality_guest WHERE idsito = ".$idsito." AND NumeroPrenotazione = ".$NumeroPrenotazione." AND TipoRichiesta = 'Preventivo'";
			$res    = $DB_QUOTO->query($select);
			$row    = $res[0];

			return $row['numero'];
	}
	// funzione per assegnare un nuovo numero di prenotazione
	function NewNumeroPreno($idsito){
		global $DB_QUOTO;
		
			$select = "SELECT NumeroPrenotazione FROM hospitality_guest WHERE idsito = ".$idsito." ORDER BY NumeroPrenotazione DESC";
			$res    = $DB_QUOTO->query($select);
			$rws    = $res[0];
			$numero_prenotazione =  (intval($rws['NumeroPrenotazione'])+1);
			
			return $numero_prenotazione;
	}

	// funzione da id lingua a stringa lingua
	function from_id_to_cod($value){

			switch($value) {
					case"1":
						$cod_lang = 'it';
					break;
					case"2":
						$cod_lang = 'en';
					break;
					case"3":
						$cod_lang = 'fr';
					break;
					case"4":
						$cod_lang = 'de';
					break;
					case"5":
						$cod_lang = 'es';
					break;
					case"6":
						$cod_lang = 'ru';
					break;
					case"7":
						$cod_lang = 'nl';
					break;
					case"8":
						$cod_lang = 'pl';
					break;
					case"9":
						$cod_lang = 'hu';
					break;

					case"10":
						$cod_lang = 'pt';
					break;

					case"11":
						$cod_lang = 'ae';
					break;

					case"12":
						$cod_lang = 'cz';
					break;

					case"13":
						$cod_lang = 'cn';
					break;
					case"14":
						$cod_lang = 'br';
					break;
					case"15":
						$cod_lang = 'jp';
					break;

				}


			return $cod_lang;
	}
	// funzione per ripulire stringa
    function field_clean($stringa){

        $clean_title = str_replace( "!", "", $stringa );
        $clean_title = str_replace( "?", "", $clean_title );
        $clean_title = str_replace( ":", "", $clean_title );
        $clean_title = str_replace( "+", "", $clean_title );
        $clean_title = str_replace( "à", "a", $clean_title );
        $clean_title = str_replace( "è", "e", $clean_title );
        $clean_title = str_replace( "é", "e", $clean_title );
        $clean_title = str_replace( "ì", "i", $clean_title );
        $clean_title = str_replace( "ò", "o", $clean_title );
        $clean_title = str_replace( "ù", "u", $clean_title );
        $clean_title = str_replace( "n.", "", $clean_title );
        $clean_title = str_replace( ".", "", $clean_title );
        $clean_title = str_replace( ",", "", $clean_title );
        $clean_title = str_replace( ";", "", $clean_title );
        $clean_title = str_replace( "'", "", $clean_title );
        $clean_title = str_replace( "*", "", $clean_title );
        $clean_title = str_replace( "/", "", $clean_title );
        $clean_title = str_replace( "\"", "", $clean_title );
        $clean_title = str_replace( " ", "", $clean_title );
        $clean_title = strtolower($clean_title);
        $clean_title = trim($clean_title);
    
        return($clean_title);
	}

	function get_captcha_form($id_form, $id_sito){
		global $DB_QUOTO;
	
		$q = "	SELECT
					chiave_sito_recaptcha,
					chiave_segreta_recaptcha
				FROM
					hospitality_form_testata
				WHERE
					hospitality_form_testata.idsito = '".$id_sito."'
				AND 
					hospitality_form_testata.id = '".$id_form."'";
	
		$res    = $DB_QUOTO->query($q);
		$record = $res[0];
		return $record;
	}
	// query per estarpolare i nome delle etichette campi aggiuntivi
	function label_input($idsito,$id_form,$id_lingua,$name_input){
		global $DB_QUOTO;

		$q = "	SELECT
					form_contenuti_lang.label
				FROM
					form_contenuti 
				INNER JOIN 
					form_contenuti_lang 
				ON
					form_contenuti_lang.id_campo = form_contenuti.id 
				WHERE
					form_contenuti.id_sito = '".$idsito."'
				AND
					form_contenuti.name = '".$name_input."'
				AND 
					form_contenuti.id_form = '".$id_form."'
				AND 
					form_contenuti_lang.id_sito = '".$idsito."'
				AND 
					form_contenuti_lang.id_form = '".$id_form."'
				AND 
					form_contenuti_lang.id_lang = '".$id_lingua."' ";
			$res = $DB_QUOTO->query($q);
			$row = $res[0];
			$etichetta = $row['label'];
			str_replace("+"," ",$etichetta);

			return $etichetta;
	}
	/* Controlla che la data sia della forma gg/mm/aaaa oppure gg-mm-aaaa oppure gg.mm.aaaa */
	function data_inserimento($variabile){

		//sostituisce lo slash ed il puntocon il trattino
		$variabile=str_replace("/", "-", $variabile);
		$variabile=str_replace(".", "-", $variabile);

		//controlla che la data sia formattata secondo lo standard gg-mm-aaaa; in tal caso
		//continua con i controlli, altrimenti restituisce false ed esce dalla funzione
		if(preg_match("#^\d{2}-\d{2}-\d{4}$#",$variabile)){

			//separa i componenti della data in array, usando il trattino come elemento
			//separatore, quindi usa la funzione checkdate per controllarli
			$data = explode("-",$variabile);

			if(checkdate($data[1],$data[0],$data[2]))
				$output = true;
			else
				$output = false;

		}else{
			$output =  false;
		}
		return $output;
	}

	function get_form_new($id_form, $id_sito, $id_lingua, $hput = null){
		global $DB_QUOTO;
		$form = array();
		$q = "	SELECT
					fh.*,
					fh.id AS idForm,
					fhl.*
				FROM
					hospitality_form_testata AS fh,
					hospitality_form_testata_lang AS fhl
				WHERE
					fh.idsito = '".$id_sito."'
					AND fh.id = '".$id_form."'
					AND fh.id = fhl.id_form
					AND fhl.id_lang = '".$id_lingua."'";
	
		$res    = $DB_QUOTO->query($q);
		foreach($res as $key => $row){
			$form['header'][$row['tipo_label']] = $row;
		}
	
		$q1 = "	SELECT
					fcl.parametri as parametri_campo,
					fc.id AS idContent,
					fc.*,
					fcl.*,
					fi.params as params,
					fi.component_name AS tipo,
					fi.type AS sottotipo
				FROM
					hospitality_form_contenuti AS fc,
					hospitality_form_contenuti_lang AS fcl,
					hospitality_form_campi AS fi
				WHERE
					fc.id = fcl.id_campo
					AND fc.id_sito = '".$id_sito."'
					".($hput?' AND fc.attivo = \'1\'':'')."
					AND fc.id_form = '".$id_form."'
					AND fcl.id_lang = '".$id_lingua."'
					AND fi.id = fc.id_tipo_input
				order by
					fc.ordinamento asc";
		$res1    = $DB_QUOTO->query($q1);
		foreach($res1 as $key1 => $row1){
			$form['content'][$row1['id']] = $row1;
		}
	
		return $form;
	}

		/* estrapola i dati per compilare il form */
		function renderFormQuoto($id_form,$idsito,$language,$urlback,$captcha=null,$jquery=null,$fontawesome=null,$bootstrap=null,$res=null,$tracking=null,$_ga=null,$NumeroPrenotazione=null,$testo_form=null){

			global $DB_QUOTO,$DB_QUOTO,$mail_quoto,$mail_quoto_hotel,$_REQUEST;
	
			$sito 			 = $idsito;
			$type 			 = $captcha;
			$BaseUrl         = BASE_URL_SITO;
			$lang_dizionario = $language;

            session_start();
            if (empty($_SESSION['token'])) {
              $_SESSION['token'] = bin2hex(random_bytes(32));
            }
            $sessiontoken = $_SESSION['token'];

			switch($language){
				case 'it':
						 $id_lang = 1;
					break;
				case 'en':
						 $id_lang = 2;
					break;
				case 'fr':
						 $id_lang = 3;
					break;
				case 'de':	
						 $id_lang = 4;
					break;
				case 'es':	
						$id_lang = 5;
				   break;
				case 'ru':	
						$id_lang = 6;
					break;
				default:
						 $id_lang = 2;
					break;
			}
	
			$k   = $id_lang; 
	
	
			$content = '';
	
			/**
			 *! GESTIONE INVIO EMAIL E SALVATGGIO DATI
			*  
			**/	
			if ($_REQUEST['action'] == 'send') {

if (!empty($_REQUEST['token'])) {
    if (hash_equals($_REQUEST['sessiontoken'], $_REQUEST['token'])) {
         // Proceed to process the form data


	
						$urlback              = $_REQUEST['urlback'];
						$language             = $_REQUEST['language'];
						$id_lingua 			  = $_REQUEST['id_lingua'];
						$lang_dizionario      = $_REQUEST['lang_dizionario'];
						$Ip                   = $_REQUEST['REMOTE_ADDR'];
						$Agent                = $_REQUEST['HTTP_USER_AGENT'];	
						$percorso             = $_REQUEST['percorso'];
						$multi                = $_REQUEST['hotel'];
						$responseform_oggetto = $_REQUEST['oggetto_email'];
	
						/**
						 * !DIZIONARIO FORM
						 */
	
						$select = "SELECT dizionario_form_quoto.etichetta,dizionario_form_quoto_lingue.testo FROM dizionario_form_quoto
									INNER JOIN dizionario_form_quoto_lingue ON dizionario_form_quoto_lingue.id_dizionario = dizionario_form_quoto.id
									WHERE dizionario_form_quoto_lingue.Lingua = '".$lang_dizionario."'
									AND dizionario_form_quoto.etichetta LIKE '%RESPONSE_FORM%'
									AND dizionario_form_quoto_lingue.idsito = ".$_REQUEST['id_sito'];
						$res = $DB_QUOTO->query($select);
						foreach($res as $key => $value){
							define($value['etichetta'],$value['testo']);
	
						}
						
	
						$responseform['nome'][$lang_dizionario]                 = RESPONSE_FORM_NOME;
						$responseform['cognome'][$lang_dizionario]              = RESPONSE_FORM_COGNOME;
						$responseform['email'][$lang_dizionario]                = RESPONSE_FORM_EMAIL;
						$responseform['telefono'][$lang_dizionario]             = RESPONSE_FORM_TELEFONO;
					
						$responseform['arrivo'][$lang_dizionario]               = RESPONSE_FORM_ARRIVO;
						$responseform['partenza'][$lang_dizionario]             = RESPONSE_FORM_PARTENZA;
					
						$responseform['arrivo_alternativo'][$lang_dizionario]   = RESPONSE_FORM_ARRIVO_ALTERNATIVO;
						$responseform['partenza_alternativo'][$lang_dizionario] = RESPONSE_FORM_PARTENZA_ALTERNATIVO;
						$responseform['adulti_totale'][$lang_dizionario]        = RESPONSE_FORM_TOTALE_ADULTI;
						$responseform['bambini_totale'][$lang_dizionario]       = RESPONSE_FORM_TOTALE_BAMBINI;
					
						$responseform['adulti'][$lang_dizionario]               = RESPONSE_FORM_ADULTI;
						$responseform['bambini'][$lang_dizionario]              = RESPONSE_FORM_BAMBINI;
						$responseform['bambini_eta'][$lang_dizionario]          = RESPONSE_FORM_BAMBINI_ETA;
					
						$responseform['sistemazione'][$lang_dizionario]         = RESPONSE_FORM_SISTEMAZIONE;
						$responseform['trattamento'][$lang_dizionario]          = RESPONSE_FORM_TRATTAMENTO;
						$responseform['target'][$lang_dizionario]               = RESPONSE_FORM_TARGET;
					
						$responseform['messaggio'][$lang_dizionario]            = RESPONSE_FORM_MESSAGGIO;
						$responseform['codice_sconto'][$lang_dizionario]        = RESPONSE_FORM_CODICE_SCONTO;
						$responseform['h1'][$lang_dizionario]                   = RESPONSE_FORM_H1;
	

						$r = dati_cliente($_REQUEST['id_sito']);

						$EmailStruttura    = $r['email'];					
						$email_alternativa = $r['email_alternativa_form_quoto'];
						$Hotel             = $r['nome'];
						$sito_tmp          = str_replace("http://","",$r['web']);
						$sito_tmp          = str_replace("https://","",$sito_tmp);
						if($r['https']==1){
							$http = 'https://';
						}else{
							$http = 'http://';
						}
						$SitoWeb   = $http.$sito_tmp;
						$SitoHotel = $SitoWeb;
	
						$riferimenti_hotel .= '<img src="'.BASE_URL_SITO.'img/q.png" align="left" style="margin-right:10px;margin-left:10px;" alt="CRM QUOTO! By Network Service srl" title="CRM QUOTO! By Network Service srl"><br /><strong>'.$Hotel.'</strong><br />';
						$riferimenti_hotel .= $r['indirizzo'].' '.$r['cap'].' '.$r['nome_comune'].' ('.$r['sigla_provincia'].'), '.$r['nome_stato'].' - Tel:+39 '.$r['tel'].' | Fax: +39 '.$r['fax'].'<br />';
						$riferimenti_hotel .= 'Web: <a href="'.$SitoHotel.'">'.$r['web'].'</a> | Email: <a href="mailto:'.$EmailStruttura.'">'.$EmailStruttura.'</a>';
	
						$idutente                                   = $r['idutente'];
						$logo                                       = $r['logo'];
	
						$EmailHotel        							= $_REQUEST['destinatario_email'];
						$urlback                                    = $_REQUEST['urlback'];
	
						$ritorno                                    = $_REQUEST['ritorno'];
	
						$nome                                       = ucfirst($_REQUEST['nome']);
						$cognome                                    = ucfirst($_REQUEST['cognome']);
						$email                                      = $_REQUEST['email'];
						$telefono                                   = $_REQUEST['telefono'];
	
						$arrivo                                     = $_REQUEST['data_arrivo'];
						$partenza                                   = $_REQUEST['data_partenza'];
	
						if(data_inserimento($arrivo) == true){
							$arrivo_ok = 1;
						}else{
							$arrivo_ok = 0;
						}
						if(data_inserimento($partenza) == true){
							$partenza_ok = 1;
						}else{
							$partenza_ok = 0;
						}
	
						$DataArrivo                                 = $_REQUEST['DataArrivo'];
						$DataPartenza                               = $_REQUEST['DataPartenza'];
	
						$TipoVacanza                                = $_REQUEST['TipoVacanza'];
	
						$adulti                                     = $_REQUEST['adulti'];
						$bambini                                    = $_REQUEST['bambini'];
						$bambini_eta                                = $_REQUEST['bambini_eta'];
	
						$messaggio                                  = $_REQUEST['messaggio'];
						$codice_sconto                              = $_REQUEST['codice_sconto'];
	
						$multi                                      = $_REQUEST['hotel'];
	
					
	
	
						$msg .= top_email($Hotel,$BaseUrl);
	
						$msg .= '<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">
										<tr>
											<td valign="top">
												<div style="clear:both" style="height:10px">&nbsp;</div><div style="width:100%;text-align:center"><a style="-webkit-appearance:button;-moz-appearance:button;appearance:button;text-decoration:none;background-color:#00ACC1;color:#FFFFFF;height:auto;width:auto;padding:5px" href="mailto:'.$EmailHotel.'">Clicca qui per rispondere a: '.$Hotel.'</a></div>
											</td>
										</tr>
									</table>';
	
						$msg .= '
											<img src="'.$BaseUrl.'uploads/loghi_siti/' . $logo . '" alt="Logo Struttura">
											<h1  class="title">' . $responseform['h1'][$lang_dizionario] . '</h1>
												<table cellpadding="0" cellspacing="0" width="100%"  border="0" align="center">';
	
							$msg .= '           <tr>
													<td align="left" valign="top" style="width:30%"><b>' . $responseform['nome'][$lang_dizionario] . '</b></td>
													<td align="left" valign="top" style="width:70%">' . $nome . '</td>
												</tr>
												<tr>
													<td align="left" valign="top" style="width:30%"><b>' . $responseform['cognome'][$lang_dizionario] . '</b></td>
													<td align="left" valign="top" style="width:70%">' . $cognome . '</td>
												</tr>
												<tr>
													<td align="left" valign="top" style="width:30%"><b>' . $responseform['email'][$lang_dizionario] . '</b></td>
													<td align="left" valign="top" style="width:70%">' . $email . '</td>
												</tr>';
	
						if ($telefono != '') {
							$msg .= '      <tr>
													<td align="left" valign="top" style="width:30%"><b>' . $responseform['telefono'][$lang_dizionario] . '</b></td>
													<td align="left" valign="top" style="width:70%">' . $telefono . '</td>
												</tr>';
						}
						if ($codice_sconto != '') {
							$msg .= '      <tr>
													<td align="left" valign="top" style="width:30%"><b>' . $responseform['codice_sconto'][$lang_dizionario] . '</b></td>
													<td align="left" valign="top" style="width:70%">' . $codice_sconto . '</td>
												</tr>';
						}
						$msg .= '      <tr>
													<td align="left" valign="top" style="width:30%"><b>' . $responseform['arrivo'][$lang_dizionario] . '</b></td>
													<td align="left" valign="top" style="width:70%">' . $arrivo . '</td>
												</tr>
												<tr>
													<td align="left" valign="top" style="width:30%"><b>' . $responseform['partenza'][$lang_dizionario] . '</b></td>
													<td align="left" valign="top" style="width:70%">' . $partenza . '</td>
												</tr>';
						if ($DataArrivo != '' || $DataPartenza != '') {
							$msg .= '      <tr>
												<td align="left" valign="top" style="width:30%"><b>' . $responseform['arrivo_alternativo'][$lang_dizionario] . '</b></td>
												<td align="left" valign="top" style="width:70%">' . $DataArrivo . '</td>
											</tr>
											<tr>
												<td align="left" valign="top" style="width:30%"><b>' . $responseform['partenza_alternativo'][$lang_dizionario] . '</b></td>
												<td align="left" valign="top" style="width:70%">' . $DataPartenza . '</td>
											</tr>';
						}
						$msg .= '        <tr>
													<td align="left" valign="top" style="width:30%"><b>' . $responseform['adulti_totale'][$lang_dizionario] . '</b></td>
													<td align="left" valign="top" style="width:70%">' . $adulti . '</td>
													</tr>';
						if ($bambini != '') {
							$msg .= '      <tr>
														<td align="left" valign="top" style="width:30%"><b>' . $responseform['bambini_totale'][$lang_dizionario] . '</b></td>
														<td align="left" valign="top" style="width:70%">' . $bambini . '</td>
													</tr>';
						}
	
						#aggiunta campi dinamici tramite sutieweb
						$x = 0;
						for($x==0; $x<=10; $x++){
							if($_REQUEST['nuovo_campo_'.$x] != ''){
								$msg .= '   <tr>
												<td align="left" valign="top" style="width:30%"><b>' . label_input($_REQUEST['id_sito'],$_REQUEST['id_form'],$id_lingua,'nuovo_campo_'.$x). '</b></td>
												<td align="left" valign="top" style="width:70%">' .$_REQUEST['nuovo_campo_'.$x]. '</td>
											</tr>';
	
							}
						}
	
	
						if ($TipoVacanza != '') {
							$msg .= '      <tr>
														<td align="left" valign="top" style="width:30%"><b>' . $responseform['target'][$lang_dizionario] . '</b></td>
														<td align="left" valign="top" style="width:70%">' . $gt->translate($TipoVacanza , $lang_dizionario,'it',true). '</td>
													</tr>';
						}
						$msg .= ' </table>';
	
						$i = 0;
						$n_righe = 5;
			
	
							$msg .= '<table cellpadding="4" cellspacing="4" width="100%" border="0" align="center">';
	
							for($i==0; $i<=$n_righe; $i++){
						
								$msg .= '    <tr>';
								if ($_REQUEST['TipoSoggiorno_'.$i]!= '') {
									$msg .= '
												<td align="left" valign="top"><b>' . $responseform['trattamento'][$lang_dizionario] . '</b></td>
												<td align="left" valign="top">' . $_REQUEST['TipoSoggiorno_'.$i] . '</td>
											';
								}
								if ($_REQUEST['NumeroCamere_'.$i]!= '') {
									$msg .= '
												<td align="left" valign="top"><b>nr.</b></td>
												<td align="left" valign="top">' . $_REQUEST['NumeroCamere_'.$i] . '</td>
											';
								}
								if ($_REQUEST['TipoCamere_'.$i]!= '') {
									$msg .= '
												<td align="left" valign="top"><b>' . $responseform['sistemazione'][$lang_dizionario] . '</b></td>
												<td align="left" valign="top">' . $_REQUEST['TipoCamere_'.$i] . '</td>
											';
								}
								if ($_REQUEST['NumAdulti_'.$i] != '') {
									$msg .= '
												<td align="left" valign="top"><b>' . $responseform['adulti'][$lang_dizionario] . '</b></td>
												<td align="left" valign="top">' . $_REQUEST['NumAdulti_'.$i]. '</td>
											';
								}
								if ($_REQUEST['NumBambini_'.$i]!= '') {
									$msg .= '
												<td align="left" valign="top"><b>' . $responseform['bambini'][$lang_dizionario] . '</b></td>
												<td align="left" valign="top">' . $_REQUEST['NumBambini_'.$i]. '</td>
											';
								}
								if ($_REQUEST['EtaB1_'.$i] != '') {
									$msg .= '
												<td align="left" valign="top"><b>' . $responseform['bambini_eta'][$lang_dizionario] . '</b></td>
												<td align="left" valign="top">' . $_REQUEST['EtaB1_'.$i] . ''.($_REQUEST['EtaB2_'.$i] != ''?', '.$_REQUEST['EtaB2_'.$i]:'').''.($_REQUEST['EtaB3_'.$i] != ''?', '.$_REQUEST['EtaB3_'.$i]:'').''.($_REQUEST['EtaB4_'.$i] != ''?', '.$_REQUEST['EtaB4_'.$i]:'').''.($_REQUEST['EtaB5_'.$i] != ''?', '.$_REQUEST['EtaB5_'.$i]:'').''.($_REQUEST['EtaB6_'.$i] != ''?', '.$_REQUEST['EtaB6_'.$i]:'').'</td>
										';
								}
								$msg .= ' </tr>';
							}
							$msg .= '   </table>';
					
	
						if ($messaggio != '') {
							$msg .= '<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">
										<tr>
											<td align="left" valign="top" style="width:30%"><b>' . $responseform['messaggio'][$lang_dizionario] . '</b></td>
											<td align="left" valign="top" style="width:70%">' . wordwrap($messaggio, 120, "<br />\n",true) . '</td>
										</tr>
									</table>';
						}
	
						$msg .= '  <table  cellpadding="0" cellspacing="0" width="100%" border="0" align="center">
										<tr>
											<td valign="top" class="footer" style="padding:10px 3px; text-align:left;">
												'.$riferimenti_hotel.'
											</td>
										</tr>
									</table>';
	
						$msg .= footer_email();
	
						$msg .= '<table cellpadding="0" cellspacing="0" width="850px" border="0" align="center">
										<tr>
											<td valign="top">
												<p style="margin: 0;font-size: 11px;line-height: 14px;text-align: right"><em>Questa e-mail è stata inviata automaticamente, non rispondere a questa e-mail!</em></p>
											</td>
										</tr>
									</table>';
	
	
	
						$msg_hotel .= top_email($Hotel,$BaseUrl);
	
						$msg_hotel .= '<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">
											<tr>
												<td valign="top">
													<div style="clear:both" style="height:10px">&nbsp;</div><div style="width:100%;text-align:center"><a style="-webkit-appearance:button;-moz-appearance:button;appearance:button;text-decoration:none;background-color:#00ACC1;color:#FFFFFF;height:auto;width:auto;padding:5px" href="mailto:'.$email.'">Clicca qui per rispondere a: '.$nome.' '.$cognome.'</a></div>
												</td>
											</tr>
										</table>';
	
						$msg_hotel .= '
											<img src="'.$BaseUrl.'uploads/loghi_siti/' . $logo . '">
											<h1  class="title">' . $responseform['h1'][$lang_dizionario] . '</h1>
											<table cellpadding="0" cellspacing="0" width="100%"  border="0" align="center">';
	
						$msg_hotel .= '           <tr>
													<td align="left" valign="top" style="width:30%"><b>' . $responseform['nome'][$lang_dizionario] . '</b></td>
													<td align="left" valign="top" style="width:70%">' . $nome . '</td>
												</tr>
												<tr>
													<td align="left" valign="top" style="width:30%"><b>' . $responseform['cognome'][$lang_dizionario] . '</b></td>
													<td align="left" valign="top" style="width:70%">' . $cognome . '</td>
												</tr>
												<tr>
													<td align="left" valign="top" style="width:30%"><b>' . $responseform['email'][$lang_dizionario] . '</b></td>
													<td align="left" valign="top" style="width:70%">' . $email . '</td>
												</tr>';
	
						if ($telefono != '') {
							$msg_hotel .= '      <tr>
													<td align="left" valign="top" style="width:30%"><b>' . $responseform['telefono'][$lang_dizionario] . '</b></td>
													<td align="left" valign="top" style="width:70%">' . $telefono . '</td>
												</tr>';
						}
						if ($codice_sconto != '') {
							$msg_hotel .= '      <tr>
													<td align="left" valign="top" style="width:30%"><b>' . $responseform['codice_sconto'][$lang_dizionario] . '</b></td>
													<td align="left" valign="top" style="width:70%">' . $codice_sconto . '</td>
												</tr>';
						}
						$msg_hotel .= '      <tr>
													<td align="left" valign="top" style="width:30%"><b>' . $responseform['arrivo'][$lang_dizionario] . '</b></td>
													<td align="left" valign="top" style="width:70%">' . $arrivo . '</td>
												</tr>
												<tr>
													<td align="left" valign="top" style="width:30%"><b>' . $responseform['partenza'][$lang_dizionario] . '</b></td>
													<td align="left" valign="top" style="width:70%">' . $partenza . '</td>
												</tr>';
						if ($DataArrivo != '' || $DataPartenza != '') {
							$msg_hotel .= '      <tr>
												<td align="left" valign="top" style="width:30%"><b>' . $responseform['arrivo_alternativo'][$lang_dizionario] . '</b></td>
												<td align="left" valign="top" style="width:70%">' . $DataArrivo . '</td>
												</tr>
												<tr>
												<td align="left" valign="top" style="width:30%"><b>' . $responseform['partenza_alternativo'][$lang_dizionario] . '</b></td>
												<td align="left" valign="top" style="width:70%">' . $DataPartenza . '</td>
												</tr>';
						}
						$msg_hotel .= '        <tr>
													<td align="left" valign="top" style="width:30%"><b>' . $responseform['adulti_totale'][$lang_dizionario] . '</b></td>
													<td align="left" valign="top" style="width:70%">' . $adulti . '</td>
													</tr>';
						if ($bambini != '') {
							$msg_hotel .= '      <tr>
														<td align="left" valign="top" style="width:30%"><b>' . $responseform['bambini_totale'][$lang_dizionario] . '</b></td>
														<td align="left" valign="top" style="width:70%">' . $bambini . '</td>
													</tr>';
						}
						#aggiunta campi dinamici tramite sutieweb
						$x = 0;
						for($x==0; $x<=10; $x++){
							if($_REQUEST['nuovo_campo_'.$x] != ''){
								$msg_hotel .= '   <tr>
														<td align="left" valign="top" style="width:30%"><b>' . label_input($_REQUEST['id_sito'],$_REQUEST['id_form'],$id_lingua,'nuovo_campo_'.$x). '</b></td>
														<td align="left" valign="top" style="width:70%">' .$_REQUEST['nuovo_campo_'.$x]. '</td>
													</tr>';
	
							}
						}
	
						if ($TipoVacanza != '') {
							$msg_hotel .= '      <tr>
														<td align="left" valign="top" style="width:30%"><b>' . $responseform['target'][$lang_dizionario] . '</b></td>
														<td align="left" valign="top" style="width:70%">' . $gt->translate($TipoVacanza , $lang_dizionario,'it',true). '</td>
													</tr>';
						}
						if ($multi != '') {
							$msg_hotel .= '   <tr>
												<td align="left" valign="top" style="width:30%"><b>Provenienza</b></td>
												<td align="left" valign="top" style="width:70%">' . $multi . '</td>
											</tr>';
						}
						$msg_hotel .= ' </table>';
	
	
						$n_righe = 5;
						$i=0;
	
							$msg_hotel .= '<table cellpadding="2" cellspacing="2" width="100%" border="0" align="center">';
	
							for($i==0; $i<=$n_righe; $i++){
	
								$msg_hotel .= '    <tr>';
								if ($_REQUEST['TipoSoggiorno_'.$i]!= '') {
									$msg_hotel .= '
												<td align="left" valign="top"><b>' . $responseform['trattamento'][$lang_dizionario] . '</b></td>
												<td align="left" valign="top">' . $_REQUEST['TipoSoggiorno_'.$i] . '</td>
											';
								}
								if ($_REQUEST['NumeroCamere_'.$i]!= '') {
									$msg_hotel .= '
												<td align="left" valign="top"><b>nr.</b></td>
												<td align="left" valign="top">' . $_REQUEST['NumeroCamere_'.$i] . '</td>
											';
								}
								if ($_REQUEST['TipoCamere_'.$i]!= '') {
									$msg_hotel .= '
												<td align="left" valign="top"><b>' . $responseform['sistemazione'][$lang_dizionario] . '</b></td>
												<td align="left" valign="top">' . $_REQUEST['TipoCamere_'.$i] . '</td>
											';
								}
								if ($_REQUEST['NumAdulti_'.$i] != '') {
									$msg_hotel .= '
												<td align="left" valign="top"><b>' . $responseform['adulti'][$lang_dizionario] . '</b></td>
												<td align="left" valign="top">' . $_REQUEST['NumAdulti_'.$i]. '</td>
											';
								}
								if ($_REQUEST['NumBambini_'.$i]!= '') {
									$msg_hotel .= '
												<td align="left" valign="top"><b>' . $responseform['bambini'][$lang_dizionario] . '</b></td>
												<td align="left" valign="top">' . $_REQUEST['NumBambini_'.$i]. '</td>
											';
								}
								if ($_REQUEST['EtaB1_'.$i] != '') {
									$msg_hotel .= '
												<td align="left" valign="top"><b>' . $responseform['bambini_eta'][$lang_dizionario] . '</b></td>
												<td align="left" valign="top">' . $_REQUEST['EtaB1_'.$i] . ''.($_REQUEST['EtaB2_'.$i] != ''?', '.$_REQUEST['EtaB2_'.$i]:'').''.($_REQUEST['EtaB3_'.$i] != ''?', '.$_REQUEST['EtaB3_'.$i]:'').''.($_REQUEST['EtaB4_'.$i] != ''?', '.$_REQUEST['EtaB4_'.$i]:'').''.($_REQUEST['EtaB5_'.$i] != ''?', '.$_REQUEST['EtaB5_'.$i]:'').''.($_REQUEST['EtaB6_'.$i] != ''?', '.$_REQUEST['EtaB6_'.$i]:'').'</td>
										';
								}
								$msg_hotel .= ' </tr>';
							}
							$msg_hotel .= '   </table>';
						
	
						if ($messaggio != '') {
							$msg_hotel .= '<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">
										<tr>
											<td align="left" valign="top" style="width:30%"><b>' . $responseform['messaggio'][$lang_dizionario] . '</b></td>
											<td align="left" valign="top" style="width:70%">' . wordwrap($messaggio, 120, "<br />\n",true) . '</td>
										</tr>
									</table>';
						}
	
						/* $msg_hotel .=  get_timeline($percorso,$SitoWeb); */
	
	
						$msg_hotel .= '  <table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">
										<tr>
											<td valign="top" class="footer" style="padding:10px 3px; text-align:left;">
												'.$riferimenti_hotel.'
											</td>
										</tr>
									</table>';
	
						$msg_hotel .= footer_email();
	
						$msg_hotel .= '<table cellpadding="0" cellspacing="0" width="850px" border="0" align="center">
											<tr>
												<td valign="top">
													<p style="margin: 0;font-size: 11px;line-height: 14px;text-align: right"><em>Questa e-mail è stata inviata automaticamente, non rispondere a questa e-mail!</em></p>
												</td>
											</tr>
										</table>';
											
				/* SE IL FORM E' PER UN SITO USA IL CAPTCHA*/
				if($type == 1)	{						
	
	
							$record = get_captcha_form($_REQUEST['id_form'], $_REQUEST['id_sito']);
							$chiave_segreta_recaptcha = $record['chiave_segreta_recaptcha'];
	
							if (isset($_REQUEST["g-recaptcha-response"])) {
	
										$remoteip  = $_SERVER["REMOTE_ADDR"];
										 $recaptcha = $_REQUEST["g-recaptcha-response"]; 
	
										$response = verifyCaptcha($recaptcha, $remoteip, $chiave_segreta_recaptcha);
	
										if ($response->success) {
				
	
											if ($nome != '' && $cognome != '' && $email != '' && $arrivo_ok == 1 && $partenza_ok == 1 && $_REQUEST['TipoSoggiorno_1'] != '' && $adulti != '') {
	
												$qr = "SELECT * FROM hospitality_smtp WHERE idsito = ".$_REQUEST['idsito']." AND Abilitato = 1";  
												$ri = $DB_QUOTO->query($qr);
												$rx = $ri[0];
												if(is_array($rx)) {
													if($rx > count($rx))
														$isSMTP = count($rx); 
												}else{ 	
													$isSMTP = 0;
												}
												$SmtpAuth     = $rx['SMTPAuth'];
												$SmtpHost     = $rx['SMTPHost'];
												$SmtpPort     = $rx['SMTPPort'];
												$SmtpSecure   = $rx['SMTPSecure'];
												$SmtpUsername = $rx['SMTPUsername'];
												$SmtpPassword = $rx['SMTPPassword'];
												$NumberSend   = $rx['NumberSend'];	
	
												if($isSMTP > 0){
													$mail_quoto->IsSMTP(); 
													$mail_quoto->SMTPDebug = 0; 
													$mail_quoto->Debugoutput = 'html';
													$mail_quoto->SMTPAuth = $SmtpAuth; 
													if($SmtpSecure!=''){
														$mail_quoto->SMTPSecure = $SmtpSecure; 
													}
													$mail_quoto->SMTPKeepAlive = true; 					
													$mail_quoto->Host = $SmtpHost;
													$mail_quoto->Port = $SmtpPort;
													$mail_quoto->Username = $SmtpUsername;
													$mail_quoto->Password = $SmtpPassword;
												} 
	
												$mail_quoto->setFrom(MAIL_SEND, $Hotel);
												$mail_quoto->addReplyTo($EmailHotel, $Hotel);
												$mail_quoto->addAddress($email, $nome.' '.$cognome);
												$mail_quoto->isHTML(true);
												$mail_quoto->Subject = $responseform_oggetto;
												$mail_quoto->msgHTML($msg, dirname(__FILE__));
												$mail_quoto->AltBody = 'To view the message, please use an HTML compatible email viewer!';
												$mail_quoto->send();
	
												if($isSMTP > 0){
													$mail_quoto_hotel->IsSMTP(); 
													$mail_quoto_hotel->SMTPDebug = 0; 
													$mail_quoto_hotel->Debugoutput = 'html';
													$mail_quoto_hotel->SMTPAuth = $SmtpAuth; 
													if($SmtpSecure!=''){
														$mail_quoto_hotel->SMTPSecure = $SmtpSecure; 
													}
													$mail_quoto_hotel->SMTPKeepAlive = true; 					
													$mail_quoto_hotel->Host = $SmtpHost;
													$mail_quoto_hotel->Port = $SmtpPort;
													$mail_quoto_hotel->Username = $SmtpUsername;
													$mail_quoto_hotel->Password = $SmtpPassword;
												} 
	
												$mail_quoto_hotel->setFrom(MAIL_SEND, $Hotel);
												$mail_quoto_hotel->addAddress($EmailHotel, $Hotel);
 												if($email_alternativa!=''){
													$array_alternativa = array();
													$array_alternativa = explode(",",$email_alternativa);
													foreach ($array_alternativa as $key => $value) {
														$mail_quoto_hotel->addAddress($value, $Hotel);
													}
												} 
												$mail_quoto_hotel->isHTML(true);
												$mail_quoto_hotel->Subject = $responseform_oggetto;
												$mail_quoto_hotel->msgHTML($msg_hotel, dirname(__FILE__));
												$mail_quoto_hotel->AltBody = 'To view the message, please use an HTML compatible email viewer!';
												$mail_quoto_hotel->send();
						
	
													$data_richiesta = date('Y-m-d');
	
													$id_lingua      =  $_REQUEST['id_lingua'];
													$lingua         =  from_id_to_cod($id_lingua);
	
													$numero_prenotazione = NewNumeroPreno($_REQUEST['id_sito']);
													$cellulare           = field_clean($_REQUEST['telefono']);
	
													$dataAtmp            = explode("-",$_REQUEST['data_arrivo']);

													$data_arrivo         = $dataAtmp[2].'-'.$dataAtmp[1].'-'.$dataAtmp[0];
							
													$dataPtmp            = explode("-",$_REQUEST['data_partenza']);
					 
													$data_partenza       = $dataPtmp[2].'-'.$dataPtmp[1].'-'.$dataPtmp[0];
							
													$dataAtmpAlternativa = explode("-",$_REQUEST['DataArrivo']);
							
													$DataArrivo          = $dataAtmpAlternativa[2].'-'.$dataAtmpAlternativa[1].'-'.$dataAtmpAlternativa[0];
							
													$dataPtmpAlternativa = explode("-",$_REQUEST['DataPartenza']);
					 
													$DataPartenza        = $dataPtmpAlternativa[2].'-'.$dataPtmpAlternativa[1].'-'.$dataPtmpAlternativa[0];
							
	
													$n_righe = 5;
													$i=0;
													$RigheCompilate  = '';
													for($i==0; $i<=$n_righe; $i++){
														$RigheCompilate  .= ($_REQUEST['TipoSoggiorno_'.$i]!=''?' - Trattamento: '.$_REQUEST['TipoSoggiorno_'.$i]:'').' '.($_REQUEST['NumeroCamere_'.$i]!=''?' &#10230; Nr.: ' .$_REQUEST['NumeroCamere_'.$i].'  ':'').' '.($_REQUEST['TipoCamere_'.$i]!=''?' &#10230; Sistemazione: '.$_REQUEST['TipoCamere_'.$i]:'').' '.($_REQUEST['NumAdulti_'.$i]!=''?' &#10230; Nr.Adulti: '.$_REQUEST['NumAdulti_'.$i]:'').' '.($_REQUEST['NumBambini_'.$i]!=''?' &#10230; Nr.Bambini: '.$_REQUEST['NumBambini_'.$i]:'').' '.($_REQUEST['EtaB1_'.$i] != ''?' &#10230; Età: '.$_REQUEST['EtaB1_'.$i]:'').''.($_REQUEST['EtaB2_'.$i] != ''?', '.$_REQUEST['EtaB2_'.$i]:'').''.($_REQUEST['EtaB3_'.$i] != ''?', '.$_REQUEST['EtaB3_'.$i]:'').''.($_REQUEST['EtaB4_'.$i] != ''?', '.$_REQUEST['EtaB4_'.$i]:'').''.($_REQUEST['EtaB5_'.$i] != ''?', '.$_REQUEST['EtaB5_'.$i]:'').''.($_REQUEST['EtaB6_'.$i] != ''?', '.$_REQUEST['EtaB6_'.$i]:'')."\r\n";
													}
	
													#aggiunta campi dinamici tramite sutieweb
													$RigheDinamiche = '';
													$x = 0;
													for($x==0; $x<=10; $x++){
														if($_REQUEST['nuovo_campo_'.$x] != ''){
															$RigheDinamiche .= ' - '.label_input($_REQUEST['id_sito'],$_REQUEST['id_form'],$id_lingua,'nuovo_campo_'.$x).': ' .$_REQUEST['nuovo_campo_'.$x]."\r\n";
														}
													}
													
													$note           =  (($multi!='' || $multi!='--')?addslashes($multi)."\r\n":'');
													$note          .=  (($_REQUEST['DataArrivo']!='' || $_REQUEST['DataPartenza']!='')?"\r\n".'Data Arrivo Alternativa: '.$_REQUEST['DataArrivo'].' Data Partenza Alternativa: '.$_REQUEST['DataPartenza']."\r\n":'');
													$note          .=  ($RigheCompilate!=''?"\r\n".$RigheCompilate."\r\n":'');
													$note          .=  ($RigheDinamiche!=''?"\r\n".$RigheDinamiche."\r\n":'');
													$note          .=  ($_REQUEST['messaggio']!=''?"\r\n".'Note: '.$_REQUEST['messaggio']:'');
													
													$ConsensoMarketing    = ($_REQUEST['marketing']=='on'?1:0);
													$ConsensoProfilazione = ($_REQUEST['profilazione']=='on'?1:0);
													$ConsensoPrivacy      = ($_REQUEST['privacy']=='checkbox' || $_REQUEST['privacy']=='consenso'?1:0);
	
													$insert = "INSERT INTO 
																hospitality_guest(
																					idsito,
																					id_politiche,
																					MultiStruttura,
																					Nome,
																					Cognome,
																					EmailSegretaria,
																					Cellulare,
																					Email,
																					NumeroPrenotazione,
																					DataArrivo,
																					DataPartenza,
																					FontePrenotazione,
																					Note,
																					TipoRichiesta,
																					TipoVacanza,
																					Lingua,
																					NumeroAdulti,
																					NumeroBambini,
																					DataRichiesta,
																					CheckConsensoPrivacy,
																					CheckConsensoMarketing,
																					CheckConsensoProfilazione,
																					Ip,
																					Agent,
																					CodiceSconto) 
																VALUES (
																		'".$_REQUEST['id_sito']."',
																		'0',
																		'".addslashes($multi)."',
																		'".addslashes($nome)."',
																		'".addslashes($cognome)."',
																		'".$EmailStruttura."',
																		'".$telefono."',
																		'".$email."',
																		'".$numero_prenotazione."',
																		'".$data_arrivo."',
																		'".$data_partenza."',
																		'Sito Web',
																		'".addslashes($note)."',
																		'Preventivo',
																		'".$TipoVacanza."',
																		'".$lingua."',
																		'".$adulti."',
																		'".$bambini."',
																		'".$data_richiesta."',
																		'".$ConsensoPrivacy."',
																		'".$ConsensoMarketing."',
																		'".$ConsensoProfilazione."',
																		'".$Ip."',
																		'".$Agent."',
																		'".addslashes($codice_sconto)."'
																		)";
													$DB_QUOTO->query($insert);
	
														// SALVO IL CLIENT ID DI ANALYTICS IN TABELLA RELAZIONALE DI QUOTO
														$insertclientId = "INSERT INTO hospitality_client_id(idsito,NumeroPrenotazione,CLIENT_ID) VALUES('".$_REQUEST['id_sito']."','".$numero_prenotazione."','".$_REQUEST['CLIENT_ID']."')";
														$DB_QUOTO->query($insertclientId);
													
													// CODICE PER IL TRACCIAMENTO DELLA PROVENINEZA DA CAMPAGNA FB, PPC
													$Tracking = urldecode($_REQUEST['tracking']);
													if($Tracking){
														if((strstr($Tracking,'facebook')) && (strstr($Tracking,'utm_campaign'))){
															$array_traccia = explode('utm_campaign=',$Tracking);
															$track_tmp     = explode('&fbclid', $array_traccia[1]);
															$track         = 'facebook';
															$campagna      = $track_tmp[0];  
															$daDove        = '';
														}elseif((strstr($Tracking,'campagna')) && (strstr($Tracking,'gclid'))){
															$array_traccia = explode('campagna=',$Tracking);
															$track_tmp     = explode('&gclid', $array_traccia[1]);
															$track         = 'google';
															$campagna      = $track_tmp[0];  
															$daDove        = '';
														}elseif((strstr($Tracking,'email') || strstr($Tracking,'newsletter')) && strstr($Tracking,'utm_campaign')){
															$array_traccia = explode('utm_campaign=',$Tracking);
															$campagna      = $array_traccia[1];
															$track         = 'newsletter';
															$daDove        = '';
														}elseif((strstr($Tracking,'facebook')) && (!strstr($Tracking,'utm_campaign'))){
															$track         = 'facebook';
															$campagna      = '';  
															$daDove        = '';  
														}elseif((strstr($Tracking,'gclid')) && (!strstr($Tracking,'facebook')) && (!strstr($Tracking,'campagna'))){
															$track         = 'google';
															$campagna      = '';  
															$daDove        = '';  
														}elseif((!strstr($Tracking,'facebook')) && (!strstr($Tracking,'utm_campaign')) && (!strstr($Tracking,'campagna')) && (!strstr($Tracking,'gclid'))){
															$track         = '';
															$campagna      = ''; 
															$daDove        =  $Tracking;                                     
														}
					
														$insert_tracking = "INSERT INTO hospitality_tracking_ads
																						(idsito,
																						NumeroPrenotazione,
																						Url,
																						Tracking,
																						Campagna)
																					VALUES
																						('".$_REQUEST['id_sito']."',
																						'".$numero_prenotazione."',
																						'".addslashes($daDove)."',
																						'".addslashes($track)."',
																						'".addslashes($campagna)."')";
														$DB_QUOTO->query($insert_tracking);
													}
	
													$syncro = "INSERT INTO hospitality_data_syncro(idsito,data) VALUES('".$_REQUEST['id_sito']."','".date('Y-m-d H:i:s')."')";
													$DB_QUOTO->query($syncro);
	
													// ritorno alla pagina OK
													$content ='
																<form  action="'.$_REQUEST['urlback'].'?res=sent" name="form_response_q" id="form_response_q"  method="post">
																	<input type="hidden" name="testo_form" value="'.$_REQUEST['testo_form'].'"/>
																	<input type="hidden" name="NumeroPrenotazione" value="'.$numero_prenotazione.'"/>
																	<input type="hidden" name="idsito" value="'.$_REQUEST['id_sito'].'"/>
																</form>'."\r\n";
	
													 $content .='<script language="JavaScript">
																	document.form_response_q.submit();
																</script>'."\r\n"; 
	
											} else {
	
												$message = 'ATTENZIONE: Potrebbero esserci alcuni campi obbligatori non compilati!';
												$content = '<script language="javascript">alert("' . $message . '");history.go(-1)</script>';
											}
	
										} else {
	
											// ritorno alla pagina KO
											$message = 'Controllo CAPTCHA negativo!';
											$content = '<script language="javascript">alert("' . $message . '");document.location="' . $_REQUEST['urlback'] . '?resp_captcha=error"</script>';
	
	
										}
	
	
									}else{
										// ritorno alla pagina KO
										$message = 'Controllo CAPTCHA mancante, senza il form non viene spedito, contattare amminisratore del sito!';
										$content = '<script language="javascript">alert("' . $message . '");document.location="' . $_REQUEST['urlback'] . '?resp_captcha=error"</script>';
	
									}// if recaptcha
	
					}else{
				


						if ($nome != '' && $cognome != '' && $email != '' && $arrivo_ok == 1 && $partenza_ok == 1 && $_REQUEST['TipoSoggiorno_1'] != '' && $adulti != '') {
																
							$qr = "SELECT * FROM hospitality_smtp WHERE idsito = ".$_REQUEST['idsito']." AND Abilitato = 1";  
							$ri = $DB_QUOTO->query($qr);
							$rx = $ri[0];
							if(is_array($rx)) {
								if($rx > count($rx))
									$isSMTP = count($rx); 
							}else{ 	
								$isSMTP = 0;
							}
							$SmtpAuth     = $rx['SMTPAuth'];
							$SmtpHost     = $rx['SMTPHost'];
							$SmtpPort     = $rx['SMTPPort'];
							$SmtpSecure   = $rx['SMTPSecure'];
							$SmtpUsername = $rx['SMTPUsername'];
							$SmtpPassword = $rx['SMTPPassword'];
							$NumberSend   = $rx['NumberSend'];	
	
							if($isSMTP > 0){
								$mail_quoto->IsSMTP(); 
								$mail_quoto->SMTPDebug = 0; 
								$mail_quoto->Debugoutput = 'html';
								$mail_quoto->SMTPAuth = $SmtpAuth; 
								if($SmtpSecure!=''){
									$mail_quoto->SMTPSecure = $SmtpSecure; 
								}
								$mail_quoto->SMTPKeepAlive = true; 					
								$mail_quoto->Host = $SmtpHost;
								$mail_quoto->Port = $SmtpPort;
								$mail_quoto->Username = $SmtpUsername;
								$mail_quoto->Password = $SmtpPassword;
							} 
	
							$mail_quoto->setFrom(MAIL_SEND, $Hotel);
							$mail_quoto->addReplyTo($EmailHotel, $Hotel);
							$mail_quoto->addAddress($email, $nome.' '.$cognome);
							$mail_quoto->isHTML(true);
							$mail_quoto->Subject = $responseform_oggetto;
							$mail_quoto->msgHTML($msg, dirname(__FILE__));
							$mail_quoto->AltBody = 'To view the message, please use an HTML compatible email viewer!';
							$mail_quoto->send();
	
							if($isSMTP > 0){
								$mail_quoto_hotel->IsSMTP(); 
								$mail_quoto_hotel->SMTPDebug = 0; 
								$mail_quoto_hotel->Debugoutput = 'html';
								$mail_quoto_hotel->SMTPAuth = $SmtpAuth; 
								if($SmtpSecure!=''){
									$mail_quoto_hotel->SMTPSecure = $SmtpSecure; 
								}
								$mail_quoto_hotel->SMTPKeepAlive = true; 					
								$mail_quoto_hotel->Host = $SmtpHost;
								$mail_quoto_hotel->Port = $SmtpPort;
								$mail_quoto_hotel->Username = $SmtpUsername;
								$mail_quoto_hotel->Password = $SmtpPassword;
							} 
	
							$mail_quoto_hotel->setFrom(MAIL_SEND, $Hotel);
							$mail_quoto_hotel->addAddress($EmailHotel, $Hotel);
							if($email_alternativa!=''){
								$array_alternativa = array();
								$array_alternativa = explode(",",$email_alternativa);
								foreach ($array_alternativa as $key => $value) {
									$mail_quoto_hotel->addAddress($value, $Hotel);
								}
							} 
							$mail_quoto_hotel->isHTML(true);
							$mail_quoto_hotel->Subject = $responseform_oggetto;
							$mail_quoto_hotel->msgHTML($msg_hotel, dirname(__FILE__));
							$mail_quoto_hotel->AltBody = 'To view the message, please use an HTML compatible email viewer!';
							$mail_quoto_hotel->send();
	
	
								$data_richiesta = date('Y-m-d');
	
								$id_lingua      =  $_REQUEST['id_lingua'];
								$lingua         =  from_id_to_cod($id_lingua);
	
								$numero_prenotazione = NewNumeroPreno($_REQUEST['id_sito']);
								$cellulare           = field_clean($_REQUEST['telefono']);
	
								$dataAtmp            = explode("/",$_REQUEST['data_arrivo']);
								$dataAtmp2           = explode("-",$_REQUEST['data_arrivo']);
	
								if($dataAtmp[1]!=''){
									$data_A_tmp = $dataAtmp;
								}elseif($dataAtmp2[1]!=''){
									$data_A_tmp = $dataAtmp2;
								}
	
								$data_arrivo    =  $data_A_tmp[2].'-'.$data_A_tmp[1].'-'.$data_A_tmp[0];
	
								$dataPtmp       =  explode("/",$_REQUEST['data_partenza']);
								$dataPtmp2      =  explode("-",$_REQUEST['data_partenza']);
	
								if($dataPtmp[1]!=''){
									$data_P_tmp = $dataPtmp;
								}elseif($dataPtmp2[1]!=''){
									$data_P_tmp = $dataPtmp2;
								}
	
								$data_partenza  =  $data_P_tmp[2].'-'.$data_P_tmp[1].'-'.$data_P_tmp[0];
	
								$dataAtmpAlternativa       =  explode("/",$_REQUEST['DataArrivo']);
								$dataAtmp2Alternativa      =  explode("-",$_REQUEST['DataArrivo']);
	
								if($dataAtmpAlternativa[1]!=''){
									$data_A_tmp_alt = $dataAtmpAlternativa;
								}elseif($dataAtmp2Alternativa[1]!=''){
									$data_A_tmp_alt = $dataAtmp2Alternativa;
								}
	
								$DataArrivo    =  $data_A_tmp_alt[2].'-'.$data_A_tmp_alt[1].'-'.$data_A_tmp_alt[0];
	
								$dataPtmpAlternativa       =  explode("/",$_REQUEST['DataPartenza']);
								$dataPtmp2Alternativa      =  explode("-",$_REQUEST['DataPartenza']);
	
								if($dataPtmpAlternativa[1]!=''){
									$data_P_tmp_alt = $dataPtmpAlternativa;
								}elseif($dataAtmp2Alternativa[1]!=''){
									$data_P_tmp_alt = $dataPtmpAlternativa;
								}
	
								$DataPartenza  =  $data_P_tmp_alt[2].'-'.$data_P_tmp_alt[1].'-'.$data_P_tmp_alt[0];
	
	
								$n_righe = 5;
								$i=0;
								$RigheCompilate  = '';
								for($i==0; $i<=$n_righe; $i++){
									$RigheCompilate  .= ($_REQUEST['TipoSoggiorno_'.$i]!=''?' - Trattamento: '.$_REQUEST['TipoSoggiorno_'.$i]:'').' '.($_REQUEST['NumeroCamere_'.$i]!=''?' &#10230; Nr.: ' .$_REQUEST['NumeroCamere_'.$i].'  ':'').' '.($_REQUEST['TipoCamere_'.$i]!=''?' &#10230; Sistemazione: '.$_REQUEST['TipoCamere_'.$i]:'').' '.($_REQUEST['NumAdulti_'.$i]!=''?' &#10230; Nr.Adulti: '.$_REQUEST['NumAdulti_'.$i]:'').' '.($_REQUEST['NumBambini_'.$i]!=''?' &#10230; Nr.Bambini: '.$_REQUEST['NumBambini_'.$i]:'').' '.(strlen($_REQUEST['EtaB1_'.$i]) <= 2 && $_REQUEST['EtaB1_'.$i] != ''?' &#10230; Età: '.$_REQUEST['EtaB1_'.$i]:'').''.($_REQUEST['EtaB2_'.$i] != ''?', '.$_REQUEST['EtaB2_'.$i]:'').''.($_REQUEST['EtaB3_'.$i] != ''?', '.$_REQUEST['EtaB3_'.$i]:'').''.($_REQUEST['EtaB4_'.$i] != ''?', '.$_REQUEST['EtaB4_'.$i]:'').''.($_REQUEST['EtaB5_'.$i] != ''?', '.$_REQUEST['EtaB5_'.$i]:'').''.($_REQUEST['EtaB6_'.$i] != ''?', '.$_REQUEST['EtaB6_'.$i]:'')."\r\n";
								}
								#aggiunta campi dinamici tramite sutieweb
								$RigheDinamiche = '';
								$x = 0;
								for($x==0; $x<=10; $x++){
									if($_REQUEST['nuovo_campo_'.$x] != ''){
										$RigheDinamiche .= ' - '.label_input($_REQUEST['id_sito'],$_REQUEST['id_form'],$id_lingua,'nuovo_campo_'.$x).': ' .$_REQUEST['nuovo_campo_'.$x]."\r\n";
									}
								}
								$note           =  (($multi!='' || $multi!='--')?addslashes($multi)."\r\n":'');	
								$note          .=  (($_REQUEST['DataArrivo']!='' || $_REQUEST['DataPartenza']!='')?"\r\n".'Data Arrivo Alternativa: '.$_REQUEST['DataArrivo'].' Data Partenza Alternativa: '.$_REQUEST['DataPartenza']."\r\n":'');
								$note          .=  ($RigheCompilate!=''?"\r\n".$RigheCompilate."\r\n":'');
								$note          .=  ($RigheDinamiche!=''?"\r\n".$RigheDinamiche."\r\n":'');
								$note          .=  ($_REQUEST['messaggio']!=''?"\r\n".'Note: '.$_REQUEST['messaggio']:'');
								
								$ConsensoMarketing    = ($_REQUEST['marketing']=='on'?1:0);
								$ConsensoProfilazione = ($_REQUEST['profilazione']=='on'?1:0);
								$ConsensoPrivacy      = ($_REQUEST['privacy']=='checkbox' || $_REQUEST['privacy']=='consenso'?1:0);
	
	
								$insert = "INSERT INTO 
											hospitality_guest(
																idsito,
																id_politiche,
																MultiStruttura,
																Nome,
																Cognome,
																EmailSegretaria,
																Cellulare,
																Email,
																NumeroPrenotazione,
																DataArrivo,
																DataPartenza,
																FontePrenotazione,
																Note,
																TipoRichiesta,
																TipoVacanza,
																Lingua,
																NumeroAdulti,
																NumeroBambini,
																DataRichiesta,
																CheckConsensoPrivacy,
																CheckConsensoMarketing,
																CheckConsensoProfilazione,
																Ip,
																Agent,
																CodiceSconto) 
											VALUES (
													'".$_REQUEST['id_sito']."',
													'0',
													'".addslashes($multi)."',
													'".addslashes($nome)."',
													'".addslashes($cognome)."',
													'".$EmailStruttura."',
													'".$telefono."',
													'".$email."',
													'".$numero_prenotazione."',
													'".$data_arrivo."',
													'".$data_partenza."',
													'Sito Web',
													'".addslashes($note)."',
													'Preventivo',
													'".$TipoVacanza."',
													'".$lingua."',
													'".$adulti."',
													'".$bambini."',
													'".$data_richiesta."',
													'".$ConsensoPrivacy."',
													'".$ConsensoMarketing."',
													'".$ConsensoProfilazione."',
													'".$Ip."',
													'".$Agent."',
													'".addslashes($codice_sconto)."'
													)";
								$DB_QUOTO->query($insert);
	
									// SALVO IL CLIENT ID DI ANALYTICS IN TABELLA RELAZIONALE DI QUOTO
									$insertclientId = "INSERT INTO hospitality_client_id(idsito,NumeroPrenotazione,CLIENT_ID) VALUES('".$_REQUEST['id_sito']."','".$numero_prenotazione."','".$_REQUEST['CLIENT_ID']."')";
									$DB_QUOTO->query($insertclientId);
								// CODICE PER IL TRACCIAMENTO DELLA PROVENINEZA DA CAMPAGNA FB, PPC
								$Tracking = urldecode($_REQUEST['tracking']);
								if($Tracking){
									if((strstr($Tracking,'facebook')) && (strstr($Tracking,'utm_campaign'))){
										$array_traccia = explode('utm_campaign=',$Tracking);
										$track_tmp     = explode('&fbclid', $array_traccia[1]);
										$track         = 'facebook';
										$campagna      = $track_tmp[0];  
										$daDove        = '';
									}elseif((strstr($Tracking,'campagna')) && (strstr($Tracking,'gclid'))){
										$array_traccia = explode('campagna=',$Tracking);
										$track_tmp     = explode('&gclid', $array_traccia[1]);
										$track         = 'google';
										$campagna      = $track_tmp[0];  
										$daDove        = '';
									}elseif((strstr($Tracking,'email') || strstr($Tracking,'newsletter')) && strstr($Tracking,'utm_campaign')){
										$array_traccia = explode('utm_campaign=',$Tracking);
										$campagna      = $array_traccia[1];
										$track         = 'newsletter';
										$daDove        = '';
									}elseif((strstr($Tracking,'facebook')) && (!strstr($Tracking,'utm_campaign'))){
										$track         = 'facebook';
										$campagna      = '';  
										$daDove        = '';  
									}elseif((strstr($Tracking,'gclid')) && (!strstr($Tracking,'facebook')) && (!strstr($Tracking,'campagna'))){
										$track         = 'google';
										$campagna      = '';  
										$daDove        = '';  
									}elseif((!strstr($Tracking,'facebook')) && (!strstr($Tracking,'utm_campaign')) && (!strstr($Tracking,'campagna')) && (!strstr($Tracking,'gclid'))){
										$track         = '';
										$campagna      = ''; 
										$daDove        =  $Tracking;                                     
									}
	
									$insert_tracking = "INSERT INTO hospitality_tracking_ads
																	(idsito,
																	NumeroPrenotazione,
																	Url,
																	Tracking,
																	Campagna)
																VALUES
																	('".$_REQUEST['id_sito']."',
																	'".$numero_prenotazione."',
																	'".addslashes($daDove)."',
																	'".addslashes($track)."',
																	'".addslashes($campagna)."')";
									$DB_QUOTO->query($insert_tracking);
								}
	
								$syncro = "INSERT INTO hospitality_data_syncro(idsito,data) VALUES('".$_REQUEST['id_sito']."','".date('Y-m-d H:i:s')."')";
								$DB_QUOTO->query($syncro);
						
								// ritorno alla pagina OK
								$content ='
											<form  action="'.$_REQUEST['urlback'].'?res=sent" name="form_response_q" id="form_response_q"  method="post">
												<input type="hidden" name="testo_form" value="'.$_REQUEST['testo_form'].'"/>
												<input type="hidden" name="NumeroPrenotazione" value="'.$numero_prenotazione.'"/>
												<input type="hidden" name="idsito" value="'.$_REQUEST['id_sito'].'"/>
											</form>'."\r\n";
	
								 $content .='<script language="JavaScript">
												document.form_response_q.submit();
											</script>'."\r\n"; 
						} else {
	
							$message = 'ATTENZIONE: Potrebbero esserci alcuni campi obbligatori non compilati!';
							$content = '<script language="javascript">alert("' . $message . '");history.go(-1)</script>';
						}
	
					}

				}
    } else {
		$mess = 'ATTENZIONE: si registra un tentativo anomalo di invio il form!  Il token di controllo non corrisponde!';
		$mes_error = '<script language="javascript">alert("' . $mess . '");history.go(-1)</script>';
		echo $mes_error;
    }
}			
			if($_REQUEST['res'] == 'sent'){
				$content = '	<script id="pushDataLayerQuoto">
									window.dataLayer = window.dataLayer || []; 
									dataLayer.push({\'event\': \'Init\', \'NumeroPrenotazione\': \''.$_REQUEST['NumeroPrenotazione'].'#'.$_REQUEST['idsito'].'\'});
								</script>'."\r\n";
				$content .= '	<script>
									$(function() {
										//sposto il dataLayer sotto il metatag title
										$("#pushDataLayerQuoto").insertAfter(\'title\');
									});
								</script>'."\r\n";
				$content .= '	<div id="responseForm" class="responseForm">'.stripslashes(urldecode($_REQUEST['testo_form'])).'</div>'."\r\n";
	
			}else{
					if(!$_REQUEST['action']){
						$dati = $_REQUEST;
	
						$q = "  SELECT 
									hospitality_lingue_form.codlingua, 
									hospitality_lista_lingue.id_lang 
								FROM 
									hospitality_lista_lingue, hospitality_lingue_form 
								WHERE 
									hospitality_lingue_form.idsito = '".$sito."' 
								AND 
									hospitality_lingue_form.codlingua = hospitality_lista_lingue.codice 
								ORDER BY
									hospitality_lista_lingue.id_lang asc";
						$res    = $DB_QUOTO->query($q);
						foreach($res as $key => $row){
							$lingue[$row['id_lang']] = $row['codlingua'];
						}
	
						$rec = get_captcha_form($id_form,$sito);
						$chiave_sito_recaptcha = $rec['chiave_sito_recaptcha'];
	
						$q = "SELECT https,web,UrlFormWeb,nome as struttura  FROM siti WHERE idsito = '".$sito."'";
						$result = $DB_QUOTO->query($q);
						$sitoWeb = $result[0];
						$struttura = $sitoWeb['struttura'];
	
						$form = array();
	
						$form[$k] = get_form_new($id_form,$sito,$k, true);

						$etichetta_eta_ = explode(",",$eta_params[$k]);
						$etichetta_eta  = $etichetta_eta_[0];
	
					

	
						$content .= '<div id="form-show-quoto" style="display:none">';
						if($form[$k]['header']['destinatario_email']['show_h1'] == 1){
							$content .= '<h2>'.$form[$k]['header']['nome_form']['descrizione'].'</h2>';
						}
						$form_ref = (isset($form[$k]['header']['nome_form']['form_ref']) && $form[$k]['header']['nome_form']['form_ref'] != '')?$form[$k]['header']['nome_form']['form_ref']:$id_form.'_'.rand(0,999999);


						$content .= '	<form class="form_quoto" name="form_'.$form_ref.'" id="form_'.$form_ref.'" action="'.BASE_URL_SITO.'apiForm/get_form.php" method="post" enctype="multipart/form-data" >
											<input type="hidden" name="destinatario_email" value="'.$form[$k]['header']['destinatario_email']['descrizione'].'" />';
						$content .= '		<input type="hidden" name="testo_form" value="'.($k == 6?urldecode($form[$k]['header']['testo_form']['descrizione']):$form[$k]['header']['testo_form']['descrizione']).'" />
											<input type="hidden" name="oggetto_email" value="'.$form[$k]['header']['oggetto_email']['descrizione'].'" />';										
						$content .= '		<input type="hidden" name="id_sito" value="'.$sito.'" />
											<input type="hidden" name="idsito" value="'.$sito.'" />
											<input type="hidden" name="id_form" value="'.$id_form.'" />
											<input type="hidden" name="id_lingua" value="'.$k.'" />
											<input type="hidden" name="id_lang" value="'.$k.'" />
											<input type="hidden" name="captcha" value="'.$captcha.'" />
											<input type="hidden" name="jquery" value="'.$jquery.'" />
											<input type="hidden" name="fontawesome" value="'.$fontawesome.'" />
											<input type="hidden" name="bootstrap" value="'.$bootstrap.'" />
											<input type="hidden" name="action" value="send" />				
											<input type="hidden" name="language" value="'.$lingue[$k].'" />
											<input type="hidden" name="lang_dizionario" value="'.$lang_dizionario.'" />
											<input type="hidden" name="REMOTE_ADDR" value="'.$_SERVER['REMOTE_ADDR'].'" />
											<input type="hidden" name="HTTP_USER_AGENT" value="'.$_SERVER['HTTP_USER_AGENT'].'" />
											<input type="hidden" name="urlback" value="'.$urlback.'" />
											<input type="hidden" name="adulti" id="adulti'.$sito.'" value="" />
											<input type="hidden" name="bambini" id="bambini'.$sito.'" value="" />
											<input type="hidden" name="_ga" value="'.$_REQUEST['_ga'].'" />
											<input type="hidden" name="tracking" id="tracking" value="'.$_REQUEST['tracking'].'"/>
											<input type="hidden" name="token" id="token" value="'.$sessiontoken.'" />
											<div id="load_client_id"></div>
											<div class="sw_body_form_fields">';
	
	
						//estraggo i parametri per il rendering del form
						$fields_rules = 'privacy:{required:true},';
						$error_messages = 'privacy:{required:\'\'},';
	
	
						foreach($form[$k]['content'] as $kx =>$vx){
							$parametri = '';
							switch($vx['tipo']){
								case 'E-mail':
										if($vx['obbligatorio']==1) {
											$fields_rules .= $vx['name'].':{required:true, email:true},';
											$error_messages .= $vx['name'].':{ required:\'\', email:\'mail non valida\'},';
										}
									break;
								case 'Lista Nazioni':
										$sqls = 'SELECT * FROM stati order by nome_stato;';
										$province = $DB_QUOTO->query($sqls);
										$parametri .= '<option value="">---</option>';
										foreach($province as $ks => $vs){
											$parametri .= '<option value="'.$vs['id_stato'].'">'.$vs['nome_stato'].'</option>';
										}
									break;
								case 'Lista province':
										$w = '';
										if(isset($codice_regione))
										$w = 'where codice_regione="'.$codice_regione.'"';
										$sqlp = 'SELECT * FROM province '.$w.' order by nome_provincia;';
										$province = $DB_QUOTO->query($sqlp);
										$parametri .= '<option value="">---</option>';
										foreach($province as $ks => $vs){
											$parametri .= '<option value="'.$vs['id_provincia'].'">'.$vs['nome_provincia'].'</option>';
										}
									break;
								case 'Checkbox Multipla':
										//gestione delle checkbox multiple
										$vx['parametri_campo'] = urldecode($vx['parametri_campo']);
										$raw = explode(',',$vx['parametri_campo']);
										foreach($raw as $k_ => $v_){
											$parametriCheck = explode('=',$v_);
											$lbl_rand = $vx['name'].'_'.md5(mktime().rand(0,9999999));
											$parametri .= '<div id="box_'.$lbl_rand.'">';
											if(count($parametriCheck) == 2){
												$parametri .= '<input type="checkbox" value="'.$parametriCheck[0].'" name="'.$vx['name'].'[]" '.(($dati[$vx['name']]==$parametriCheck[1])?'checked="true"':'').' id="'.$lbl_rand.'" /><label for="'.$lbl_rand.'"> '.$parametriCheck[1].'</label><br />';
											}
											else{
												$parametri .= '<input type="checkbox" value="'.$v_.'" name="'.$vx['name'].'[]" '.(($dati[$vx['name']]==$v_)?'checked="true"':'').' id="'.$lbl_rand.'" /><label for="'.$lbl_rand.'"> '.$v_.'</label><br />';
											}
											$parametri .= '</div>';
										}
									break;
								case 'Select Area':
										if($vx['obbligatorio']==1) {
											$fields_rules .= $vx['name'].':{ selectTextNotEquals: "'.$vx['label'].'" },';
											$error_messages .= $vx['name'].':{ selectTextNotEquals: "Scegli un valore!" },';
										}
										$vx['parametri_campo'] = urldecode($vx['parametri_campo']);
										$raw = explode(',',$vx['parametri_campo']);
										foreach($raw as $kp => $vp){
											$comp = explode('=', trim($vp));
											if(count($comp) > 1){
												$parametri .= '<option value="'.$comp[0].'" '.($dati[$vx['name']]==$comp[0]?' selected="selected" ':'').' >'.trim($comp[1]).'</option>';
											}else{
												$parametri .= '<option '.(urldecode($vx['label'])==trim($comp[0])?'value=""':'value="'.trim($comp[0]).'"').' '.($dati[$vx['name']]==$comp[0]?' selected="selected" ':'').' >'.trim($comp[0]).'</option>';
											}
										}
									break;
								//modifica ale per radiobutton #################################################
								################################################################################
								case 'Radio (almeno 2 item)':
										$vx['parametri_campo'] = urldecode($vx['parametri_campo']);
										$campiRadio = explode(',',$vx['parametri_campo']);
										$c = 0;
										foreach($campiRadio as $kr => $vr){
											$parametriRadio = explode('=',$vr);
											$lbl_rand = $vx['name'].'_'.md5(mktime().rand(0,9999999));
											$parametri .= '<div id="box_'.$lbl_rand.'">';
											if(count($parametriRadio) == 2){
												$parametri .= '<input type="radio" value="'.$parametriRadio[0].'" name="'.$vx['name'].'" '.(($c==0 || $dati[$vx['name']]==$parametriRadio[1])?'checked="true"':'').' id="'.$lbl_rand.'" /><label for="'.$lbl_rand.'"> '.$parametriRadio[1].'</label><br />';
											}
											else{
												$parametri .= '<input type="radio" value="'.$vr.'" name="'.$vx['name'].'" '.(($c==0 || $dati[$vx['name']]==$vr)?'checked="true"':'').' id="'.$lbl_rand.'" /><label for="'.$lbl_rand.'"> '.$vr.'</label><br />';
											}
											$parametri .= '</div>';
											$c++;
										}
									break;
	
								default:
										if($vx['obbligatorio']==1) {
											$fields_rules .= $vx['name'].':{required:true},';
											$error_messages .= $vx['name'].':{ required:\'\' },';
										}
									break;
							}
	
							$output = $vx['campo'];
							if($vx['sottotipo']=='textarea'){
								if(!strstr($output,'</textarea>')){
									$output = $output.'</textarea>';
								}
							}
	
							$output = str_replace('[liste]',$liste,$output);
							$output = str_replace('[valore]',($dati[$vx['name']]?$dati[$vx['name']]:''),$output);
							if($placeholder != ''){
								$output = str_replace('[placeholder]',urldecode($vx['label']),$output);
							}else{
								$output = str_replace('[placeholder]','',$output);
	
							}
							if($captcha==0 || $captcha == ''){
	
									$output = str_replace('<div class="g-recaptcha" data-sitekey="[chiavesito]"></div>','',$output);
							
							}
							$output = str_replace('[chiavesito]',$chiave_sito_recaptcha,$output);
							$output = str_replace('[parametri]',$parametri,$output);
							$output = str_replace('required',($vx['obbligatorio']==1?'req':''),$output);
	
	
							$content .= $output;
	
	
						}// fine foreach
	
	
						$content .= '	</div>';
	
						//preparo il contenitore JS per la validazione campi form
						$fields_rules = substr($fields_rules,0,(strlen($fields_rules)-1));
						$error_messages = substr($error_messages,0,(strlen($error_messages)-1));
						$id_form_response = 'form_response_'.mktime();
	
						$err_mess_2_array = array(	1 => 'Attenzione, è già stata inviata un\'email con questo indirizzo. Per inviare il modulo occorre attendere qualche minuto. Grazie',
													2 => 'Attention, you\'ve already sent an email with this address. To send the form you have to wait a few minutes. thanks',
													3 => 'Attention, vous avez déjà envoyé un e-mail à cette adresse. Pour envoyer le formulaire, vous devez attendre quelques minutes. merci',
													4 => 'Achtung, Sie haben bereits eine E-Mail geschickt mit dieser Adresse. Um das Formular, das Sie ein paar Minuten warten müssen, senden. dank');
	
						$err_mess_2 = $err_mess_2_array[1];
						switch($k){
							case 1:
							case 2:
							case 3:
							case 4:
									$err_mess_2 = $err_mess_2_array[$k];
								break;
							default:
									$err_mess_2 = $err_mess_2_array[2];
								break;
						}

	
						$validazione .='<script type="text/javascript">
											$(function(){
												$.validator.addMethod("selectTextNotEquals", function (value, select, arg) {
													return arg != $(select).find(\'option:selected\').text();
												}, "Il valore non deve essere uguale all\'etichetta del campo!");
					
												var validator = $("[nomeForm]").validate({
													rules:{[fields_rules]},
													messages:{[error_messages]}
												});';
						$validazione .='	});
										</script>';
	
						$validazione = str_replace('[nomeForm]','#form_'.$form_ref,$validazione);
						$validazione = str_replace('[fields_rules]',$fields_rules,$validazione);
						$validazione = str_replace('[error_messages]',$error_messages,$validazione);
	
						if ($form[$k]['header']['id_iubenda']['descrizione'] != '') {
							switch($k){
								case 1:
									$txt_consenso .= '<input name="privacy" type="checkbox" id="consenso" value="consenso" required />  Do il consenso al trattamento dei dati -  <a href="//www.iubenda.com/privacy-policy/'.$form[$k]['header']['id_iubenda']['descrizione'].'" class="iubenda-nostyle no-brand iubenda-embed txtprivacy" title="Privacy Policy">Visualizza Informativa</a>';
									break;
								case 2:
									$txt_consenso .= '<input name="privacy" type="checkbox" id="consenso" value="consenso" required /> Accept Privacy policy - <a href="//www.iubenda.com/privacy-policy/'.$form[$k]['header']['id_iubenda']['descrizione'].'" class="iubenda-nostyle no-brand iubenda-embed txtprivacy" title="Privacy Policy">View Consent</a>';
								break;
								case 3:
									$txt_consenso .= '<input name="privacy" type="checkbox" id="consenso" value="consenso" required /> J\'ai lu la politique de confidentialité - <a href="//www.iubenda.com/privacy-policy/'.$form[$k]['header']['id_iubenda']['descrizione'].'" class="iubenda-nostyle no-brand iubenda-embed txtprivacy" title="Privacy Policy">Consulter le consentement</a>';
								break;
								case 4:	
									$txt_consenso .= '<input name="privacy" type="checkbox" id="consenso" value="consenso" required /> Ich habe die Datenschutzerklärung gelesen - <a href="//www.iubenda.com/privacy-policy/'.$form[$k]['header']['id_iubenda']['descrizione'].'" class="iubenda-nostyle no-brand iubenda-embed txtprivacy" title="Privacy Policy">Einverständniserklärung</a>';
								break;
								case 5:
									$txt_consenso .= '<input name="privacy" type="checkbox" id="consenso" value="consenso" required /> Acepto la política de privacidad - <a href="//www.iubenda.com/privacy-policy/'.$form[$k]['header']['id_iubenda']['descrizione'].'" class="iubenda-nostyle no-brand iubenda-embed txtprivacy" title="Privacy Policy">Ver consentimiento</a>';
								break;
								case 6:
									$txt_consenso .= '<input name="privacy" type="checkbox" id="consenso" value="consenso" required /> Я прочитал политику конфиденциальности - <a href="//www.iubenda.com/privacy-policy/'.$form[$k]['header']['id_iubenda']['descrizione'].'" class="iubenda-nostyle no-brand iubenda-embed txtprivacy" title="Privacy Policy">Просмотр согласия</a>';
								break;
								case 7:
								case 8:	
								case 9:
								case 10:
								case 11:
								case 12:
								case 13:
								case 14:
								case 15:
								case 16:
									$txt_consenso .= '<input name="privacy" type="checkbox" id="consenso" value="consenso" required /> Accept Privacy policy - <a href="//www.iubenda.com/privacy-policy/'.$form[$k]['header']['id_iubenda']['descrizione'].'" class="iubenda-nostyle no-brand iubenda-embed txtprivacy" title="Privacy Policy">View Consent</a>';
								break;
							}
							$txt_consenso .= '<script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src = "//cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>'."\r\n";

						} else {
	
							$sel = "SELECT 
										* 
									FROM 
										hospitality_dizionario 
									INNER JOIN 
										hospitality_dizionario_lingua 
									ON 
										hospitality_dizionario_lingua.id_dizionario = hospitality_dizionario.id 
									WHERE
										hospitality_dizionario.etichetta = 'INFORMATIVA_PRIVACY'
									AND
										hospitality_dizionario.idsito = '".$sito."'
									AND
										hospitality_dizionario_lingua.idsito = '".$sito."'
									AND 
										hospitality_dizionario_lingua.Lingua = '".$lingue[$k]."'";
							$result = $DB_QUOTO->query($sel);
							$txtcons= $result[0];
	
							$daticlienti    = dati_cliente($sito);
							$testo_consenso = str_replace('{!rag_soc!}',$daticlienti['rag_soc'],$txtcons['testo']);
							$testo_consenso = str_replace('{!indirizzo!}',$daticlienti['indirizzo'],$testo_consenso );
							$testo_consenso = str_replace('{!cap!}',$daticlienti['cap'],$testo_consenso );
							$testo_consenso = str_replace('{!citta!}',$daticlienti['comune'],$testo_consenso );
							$testo_consenso = str_replace('{!provincia!}',$daticlienti['sigla_provincia'],$testo_consenso );
							$testo_consenso = str_replace('{!p_iva!}',$daticlienti['p_iva'],$testo_consenso );
	
							$txt_consenso = $form[$k]['header']['text_consenso']['descrizione'].'
											<div class="modal fade" id="privacy'.$k.'" tabindex="-1" aria-labelledby="privacy'.$k.'Label" aria-hidden="true">
												<div class="modal-dialog modal-fullscreen">
													<div class="modal-content">
														<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Privacy Policy</h5>
															<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
														</div>
														<div class="modal-body">
															'.$testo_consenso.'
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
														</div>
													</div>
												</div>
											</div>';
						}
						
	
						$content .= '		<div class="formprivacy">'.$txt_consenso.'</div>
											<div class="clearfix"></div>
											<div class="ca"></div>
											<div id="latestform">
												<div class="ca"></div>
											</div>											
											<div class="forminvio" style="display:block;clear:both;">
												<script>
												$(document).ready(function(){
													setTimeout(EQR, 5000);
												});
												</script>
													<div class="ca10"></div>	
													<div id="view_send_form_loading"></div>
													<div class="ca10"></div>												
													<button class="btn btn-primary SW-submit" type="submit" form_rel="#form_'.$form_ref.'">
														'.($form[$k]['header']['testo_submit']['descrizione']!=''?$form[$k]['header']['testo_submit']['descrizione']:'Submit').'
													</button>
												<div class="ca"></div>
												<div class="clearfix"></div>
												<div class="ca10"></div>'."\r\n";
											
													switch($language){
														case"it":
															$text_req = 'campo obbligatorio';
														break;
														case"en":
															$text_req = 'required field';
														break;
														case"fr":
															$text_req = 'champ obligatoire';
														break;
														case"de":
															$text_req = 'Pflichtfeld';
														break;
														default:
															$text_req = 'required field';
														break;
													}
											
						$content .= '			<span class="txtprivacy">* '.$text_req.'</span>
												<div class="ca"></div>
											</div>
											<div style="display:none"><input type="hidden" name="sessiontoken" id="sessiontoken" value="'.$sessiontoken.'" /></div>
										</form>'."\r\n";
						$content .= $validazione.'
								</div>
								<div class="ca"></div>';	
					}
				}
			
			echo $content;
		}