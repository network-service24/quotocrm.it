<?
if($_REQUEST['azione']=='crea_form'){


		require_once BASE_PATH_SITO. '/class/MysqliDb.php';
		$db_form = new MysqliDb(HOST,DB_USER,DB_PASSWORD,DATABASE);
		$db_form_suite = new MysqliDb(DB_SUITEWEB_HOST,DB_SUITEWEB_USER,DB_SUITEWEB_PASSWORD,DB_SUITEWEB_NAME);

		$nuovo = array(1=>'Nuovo campo',
						2=>'New field',
						3=>'New field',
						4=>'New field',
						5=>	'New field',
						6=>	'New field',
						7=>	'New field',
						8=>	'New field',
						9=>	'New field',
						10=>'New field',
						11=>'New field',
						12=>'New field',
						13=>'New field',
						14=>'New field',
						15=>'New field',
						16=>'New field');

		$errore = array( 1=>'Il campo [label] e\' obbligatorio',
						2=>'The field [label] is mandatory',
						3=>'The field [label] is mandatory',
						4=>'The field [label] is mandatory',
						5=>	'The field [label] is mandatory',
						6=>	'The field [label] is mandatory',
						7=>	'The field [label] is mandatory',
						8=>	'The field [label] is mandatory',
						9=>	'The field [label] is mandatory',
						10=>'The field [label] is mandatory',
						11=>'The field [label] is mandatory',
						12=>'The field [label] is mandatory',
						13=>'The field [label] is mandatory',
						14=>'The field [label] is mandatory',
						15=>'The field [label] is mandatory',
						16=>'The field [label] is mandatory');



				$lingue = getLingueSito(IDSITO);
				$nomeForm = 'Form richiesta informazioni QUOTO sito';
				$template_mail_custom = '';
				$css = '';
				$template_form_custom = '';

				function get_captcha_sito($id_sito){
					global $db_form_suite;
				
					$q = "	SELECT
								chiave_sito_recaptcha,
								chiave_segreta_recaptcha
							FROM
								siti
							WHERE
								siti.idsito = '".$id_sito."'";
				
					$res    = $db_form_suite->query($q);
					$record = $res[0];
					return $record;
				}
				$rec_captcha = get_captcha_sito(IDSITO);
				if($rec_captcha['chiave_sito_recaptcha']!= '' && $rec_captcha['chiave_segreta_recaptcha']!= ''){
					$chiave_sito_recaptcha    = $rec_captcha['chiave_sito_recaptcha'];
					$chiave_segreta_recaptcha = $rec_captcha['chiave_segreta_recaptcha'];
				}else{
					$chiave_sito_recaptcha    = '';
					$chiave_segreta_recaptcha = '';
				}
				//inserimento nella tabella form_header
				$f_header = array(
					"idsito" => IDSITO,
					"form_ref" => date('Ymdhis').rand(0,999999),
					"chiave_sito_recaptcha" => $chiave_sito_recaptcha,
					"chiave_segreta_recaptcha" => $chiave_segreta_recaptcha
				);
				$id_form = $db_form->insert("hospitality_form_testata",$f_header);

				//inserimento elementi in lingua del form header

				$oggetto = array(	1=>'Richiesta per '.NOMEHOTEL.'',
									2=>'Request for '.NOMEHOTEL.'',
									3=>'Demande de '.NOMEHOTEL.'',	
									4=>'Anfrage für '.NOMEHOTEL.'',
									5=>'Solicitud '.NOMEHOTEL.'',
									6=>'Запрос на '.NOMEHOTEL.'',
									7=>'Request for '.NOMEHOTEL.'',
									8=>'Request for '.NOMEHOTEL.'',
									9=>'Request for '.NOMEHOTEL.'',
									10=>'Request for '.NOMEHOTEL.'',
									11=>'Request for '.NOMEHOTEL.'',
									12=>'Request for '.NOMEHOTEL.'',
									13=>'Request for '.NOMEHOTEL.'',
									14=>'Request for '.NOMEHOTEL.'',
									15=>'Request for '.NOMEHOTEL.'',
									16=>'Request for '.NOMEHOTEL.''
								);

				$destinatario = array(  1=>EMAILHOTEL, 
										2=>EMAILHOTEL, 
										3=>EMAILHOTEL,	
										4=>EMAILHOTEL,
										5=>EMAILHOTEL,
										6=>EMAILHOTEL,
										7=>EMAILHOTEL,
										8=>EMAILHOTEL,
										9=>EMAILHOTEL,
										10=>EMAILHOTEL,
										11=>EMAILHOTEL,
										12=>EMAILHOTEL,
										13=>EMAILHOTEL,
										14=>EMAILHOTEL,
										15=>EMAILHOTEL,
										16=>EMAILHOTEL
									);

				$testo = array( 1=>'Grazie per averci contattato, ti risponderemo al più presto.<br />
									ATTENZIONE: alcuni programmi di posta come <b>GMail</b>, <b>Libero Mail</b>, ecc., potrebbero inserire erroneamente la nostra risposta di preventivo tra le <b>Promozioni/Offerte</b> o in <b>Spam</b>. <br />
									Ti invitiamo pertanto a controllare tali cartelle e a trascinare il tuo preventivo nella cartella <b>Principale</b>.',
								2=>'Thank you for your request. We\'ll contact you soon.<br />
									ATTENTION: some e-mail programs such as <b>GMail</b>, <b>Libero Mail</b>, etc., may mistakenly insert our quote response among the <b>Promotions/Offers</b> or in <b>Spam</b>.<br />
									We therefore encourage you to check these folders and drag your quote to the <b>Main</b> folder.',
								3=>'Nous vous remercions de votre demande. Nous vous contacterons bientôt<br />
									ATTENTION: certains programmes de messagerie tels que <b>GMail</b>, <b>Libero Mail</b>, etc., peuvent par erreur insérer notre réponse de devis parmi les <b>Promotions/Offres</b> sur dans <b>Spam</b>.<br />
									Nous vous encourageons donc à vérifier ces dossiers et à faire glisser votre devis vers le dossier <b>Principal</b>.',
								4=>'Vielen Dank für Ihre Anfrage. Wir werden Sie in Kürze kontaktieren<br />
									ACHTUNG: Einige Mail-Programme wie <b>GMail</b>, <b>Libero Mail</b> usw. fügen möglicherweise fälschlicherweise unsere Antwort auf das Zitat unter <b>Promotions/Angebote</b> ein in <b>Spam</b>. <br />
									Wir empfehlen Ihnen daher, diese Ordner zu überprüfen und Ihr Angebot in den Ordner <b>Haupt-</b> zu ziehen.',
								5=>'Gracias por su solicitud. Nos pondremos en contacto con usted pronto<br />
									ATENCIÓN: algunos programas de correo como <b>GMail</b>, <b>Libero Mail</b>, etc., pueden insertar por error nuestra respuesta de presupuesto entre las <b>Promociones/Ofertas</b> en en <b>Spam</b>. <br />
									Por lo tanto, le recomendamos que compruebe estas carpetas y arrastre su presupuesto a la carpeta <b>Principal</b>.',
								6=>'Спасибо за ваш запрос. Мы свяжемся с вами скоро<br />
									ВНИМАНИЕ: некоторые почтовые программы, такие как <b>GMail</b>, <b>Libero Mail</b> и т. Д., Могут по ошибке вставить наш ответ в цитату среди <b>Акции/Предложения</b> на в <b>спаме</b>. <br />
									Поэтому мы рекомендуем вам проверить эти папки и перетащить вашу цитату в папку <b>главный</b>.',
								7=>'Thank you for your request. We\'ll contact you soon<br />
									ATTENTION: some e-mail programs such as <b>GMail</b>, <b>Libero Mail</b>, etc., may mistakenly insert our quote response among the <b>Promotions/Offers</b> or in <b>Spam</b>.<br />
									We therefore encourage you to check these folders and drag your quote to the <b>Main</b> folder.',
								8=>'Thank you for your request. We\'ll contact you soon<br />
									ATTENTION: some e-mail programs such as <b>GMail</b>, <b>Libero Mail</b>, etc., may mistakenly insert our quote response among the <b>Promotions/Offers</b> or in <b>Spam</b>.<br />
									We therefore encourage you to check these folders and drag your quote to the <b>Main</b> folder.',
								9=>'Thank you for your request. We\'ll contact you soon<br />
									ATTENTION: some e-mail programs such as <b>GMail</b>, <b>Libero Mail</b>, etc., may mistakenly insert our quote response among the <b>Promotions/Offers</b> or in <b>Spam</b>.<br />
									We therefore encourage you to check these folders and drag your quote to the <b>Main</b> folder.',
								10=>'Thank you for your request. We\'ll contact you soon<br />
									ATTENTION: some e-mail programs such as <b>GMail</b>, <b>Libero Mail</b>, etc., may mistakenly insert our quote response among the <b>Promotions/Offers</b> or in <b>Spam</b>.<br />
									We therefore encourage you to check these folders and drag your quote to the <b>Main</b> folder.',
								11=>'Thank you for your request. We\'ll contact you soon<br />
									ATTENTION: some e-mail programs such as <b>GMail</b>, <b>Libero Mail</b>, etc., may mistakenly insert our quote response among the <b>Promotions/Offers</b> or in <b>Spam</b>.<br />
									We therefore encourage you to check these folders and drag your quote to the <b>Main</b> folder.',
								12=>'Thank you for your request. We\'ll contact you soon<br />
									ATTENTION: some e-mail programs such as <b>GMail</b>, <b>Libero Mail</b>, etc., may mistakenly insert our quote response among the <b>Promotions/Offers</b> or in <b>Spam</b>.<br />
									We therefore encourage you to check these folders and drag your quote to the <b>Main</b> folder.',
								13=>'Thank you for your request. We\'ll contact you soon<br />
									ATTENTION: some e-mail programs such as <b>GMail</b>, <b>Libero Mail</b>, etc., may mistakenly insert our quote response among the <b>Promotions/Offers</b> or in <b>Spam</b>.<br />
									We therefore encourage you to check these folders and drag your quote to the <b>Main</b> folder.',
								14=>'Thank you for your request. We\'ll contact you soon<br />
									ATTENTION: some e-mail programs such as <b>GMail</b>, <b>Libero Mail</b>, etc., may mistakenly insert our quote response among the <b>Promotions/Offers</b> or in <b>Spam</b>.<br />
									We therefore encourage you to check these folders and drag your quote to the <b>Main</b> folder.',
								15=>'Thank you for your request. We\'ll contact you soon<br />
									ATTENTION: some e-mail programs such as <b>GMail</b>, <b>Libero Mail</b>, etc., may mistakenly insert our quote response among the <b>Promotions/Offers</b> or in <b>Spam</b>.<br />
									We therefore encourage you to check these folders and drag your quote to the <b>Main</b> folder.',
								16=>'Thank you for your request. We\'ll contact you soon<br />
									ATTENTION: some e-mail programs such as <b>GMail</b>, <b>Libero Mail</b>, etc., may mistakenly insert our quote response among the <b>Promotions/Offers</b> or in <b>Spam</b>.<br />
									We therefore encourage you to check these folders and drag your quote to the <b>Main</b> folder.'
							);



				$consensoPrivacy = array(
											1 => '<input name="privacy" type="checkbox" id="consenso" value="consenso" required /> Do il consenso al trattamento dei dati - <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#privacy1">Visualizza Informativa</a>'."\r\n",
											2 => '<input name="privacy" type="checkbox" id="consenso" value="consenso" required /> Accept Privacy policy - <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#privacy2">View Consent</a>'."\r\n",
											3 => '<input name="privacy" type="checkbox" id="consenso" value="consenso" required /> Accepter la politique de confidentialité - <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#privacy3">Consulter le consentement</a>'."\r\n",
											4 => '<input name="privacy" type="checkbox" id="consenso" value="consenso" required /> Akzeptieren Sie die Datenschutzerklärung - <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#privacy4">Einverständniserklärung</a>'."\r\n",
											5 => '<input name="privacy" type="checkbox" id="consenso" value="consenso" required /> Acepto la política de privacidad - <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#privacy5">Ver consentimiento</a>'."\r\n",
											6 => '<input name="privacy" type="checkbox" id="consenso" value="consenso" required /> Принять политику конфиденциальности - <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#privacy6">Просмотр согласия</a>'."\r\n",
											7 => '<input name="privacy" type="checkbox" id="consenso" value="consenso" required /> Accept Privacy policy - <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#privacy7">View Consent</a>'."\r\n",
											8 => '<input name="privacy" type="checkbox" id="consenso" value="consenso" required /> Accept Privacy policy - <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#privacy8">View Consent</a>'."\r\n",
											9 => '<input name="privacy" type="checkbox" id="consenso" value="consenso" required /> Accept Privacy policy - <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#privacy9">View Consent</a>'."\r\n",
											10 => '<input name="privacy" type="checkbox" id="consenso" value="consenso" required /> Accept Privacy policy - <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#privacy10">View Consent</a>'."\r\n",
											11 => '<input name="privacy" type="checkbox" id="consenso" value="consenso" required /> Accept Privacy policy - <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#privacy11">View Consent</a>'."\r\n",
											12 => '<input name="privacy" type="checkbox" id="consenso" value="consenso" required /> Accept Privacy policy - <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#privacy12">View Consent</a>'."\r\n",
											13 => '<input name="privacy" type="checkbox" id="consenso" value="consenso" required /> Accept Privacy policy - <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#privacy13">View Consent</a>'."\r\n",
											14 => '<input name="privacy" type="checkbox" id="consenso" value="consenso" required /> Accept Privacy policy - <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#privacy14">View Consent</a>'."\r\n",
											15 => '<input name="privacy" type="checkbox" id="consenso" value="consenso" required /> Accept Privacy policy - <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#privacy15">View Consent</a>'."\r\n",
											16 => '<input name="privacy" type="checkbox" id="consenso" value="consenso" required /> Accept Privacy policy - <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#privacy16">View Consent</a>'."\r\n"
										);

				$pagina_contatti = array(
											1=>'',
											2=>'',
											3=>'',
											4=>'',
											5=>'',
											6=>'',
											7=>'',
											8=>'',
											9=>'',
											10=>'',
											11=>'',
											12=>'',
											13=>'',
											14=>'',
											15=>'',
											16=>''
										);



				$pagina_grazie = array(
										1=>'',
										2=>'',
										3=>'',
										4=>'',
										5=>'',
										6=>'',
										7=>'',
										8=>'',
										9=>'',
										10=>'',
										11=>'',
										12=>'',
										13=>'',
										14=>'',
										15=>'',
										16=>''
									);

				$nome = array(
								1=>'Nome',
								2=>'Name',
								3=>'Nom',
								4=>'Name',
								5=>'Nombre',
								6=>urlencode('Имя'),
								7=>'Name',
								8=>'Name',
								9=>'Name',
								10=>'Name',
								11=>'Name',
								12=>'Name',
								13=>'Name',
								14=>'Name',
								15=>'Name',
								16=>'Name'
							);

				$cognome = array(
									1=>'Cognome',
									2=>'Surname',
									3=>'Prenom',
									4=>'Vorname',
									5=>'Apellidos',
									6=>urlencode('Фамилия'),
									7=>'Surname',
									8=>'Surname',
									9=>'Surname',
									10=>'Surname',
									11=>'Surname',
									12=>'Surname',
									13=>'Surname',
									14=>'Surname',
									15=>'Surname',
									16=>'Surname'
								);

				$labelemail = array(
									1=>'Email',
									2=>'Email',
									3=>'Email',
									4=>'Email',
									5=>'Email',
									6=>urlencode('Адрес электронной почты'),
									7=>'Email',
									8=>'Email',
									9=>'Email',
									10=>'Email',
									11=>'Email',
									12=>'Email',
									13=>'Email',
									14=>'Email',
									15=>'Email',
									16=>'Email'
								);



				$telefono = array(
									1=>'Telefono',
									2=>'Phone',
									3=>'Téléphone',
									4=>'Telefon',
									5=>'Teléfono',
									6=>urlencode('Телефон'),
									7=>'Phone',
									8=>'Phone',
									9=>'Phone',
									10=>'Phone',
									11=>'Phone',
									12=>'Phone',
									13=>'Phone',
									14=>'Phone',
									15=>'Phone',
									16=>'Phone'
								);
				$eta = array(
									1=>'Età',
									2=>'Age',
									3=>'Âge',
									4=>'Alter',
									5=>'Edad',
									6=>urlencode('Возраст'),
									7=>'Age',
									8=>'Age',
									9=>'Age',
									10=>'Age',
									11=>'Age',
									12=>'Age',
									13=>'Age',
									14=>'Age',
									15=>'Age',
									16=>'Age'
								);
				$eta_params = array(
									1=>'Età,inferiore ad 1,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16',
									2=>'Age,less than 1,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16',
									3=>'Âge,moins de 1,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16',
									4=>'Alter,weniger als 1,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16',
									5=>'Edad,menos de 1,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16',
									6=>urlencode('Возраст,менее 1,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16'),
									7=>'Age,< 1,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16',
									8=>'Age,< 1,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16',
									9=>'Age,< 1,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16',
									10=>'Age,< 1,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16',
									11=>'Age,< 1,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16',
									12=>'Age,< 1,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16',
									13=>'Age,< 1,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16',
									14=>'Age,< 1,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16',
									15=>'Age,< 1,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16',
									16=>'Age,< 1,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16'
								);

				$adulti = array(
									1=>'Adulti',
									2=>'Adults',
									3=>'Adultes',
									4=>'Erwachsene',
									5=>'Adultos',
									6=>urlencode('Взрослые'),
									7=>'Adults',
									8=>'Adults',
									9=>'Adults',
									10=>'Adults',
									11=>'Adults',
									12=>'Adults',
									13=>'Adults',
									14=>'Adults',
									15=>'Adults',
									16=>'Adults'
								);

				$arrivo = array(
								1=>'Arrivo',
								2=>'Arrival',
								3=>'Arrivée',
								4=>'Ankunft',
								5=>'Entrante',
								6=>urlencode('Заезд'), 
								7=>'Arrival',
								8=>'Arrival',
								9=>'Arrival',
								10=>'Arrival',
								11=>'Arrival',
								12=>'Arrival',
								13=>'Arrival',
								14=>'Arrival',
								15=>'Arrival',
								16=>'Arrival'
							);

				$partenza = array(
									1=>'Partenza',
									2=>'Departure',
									3=>'Départ',
									4=>'Abreise',
									5=>'Dejando',
									6=>urlencode('Выезд'), 
									7=>'Departure',
									8=>'Departure',
									9=>'Departure',
									10=>'Departure',
									11=>'Departure',
									12=>'Departure',
									13=>'Departure',
									14=>'Departure',
									15=>'Departure',
									16=>'Departure'
								);
								
				$plus_date = array(
												1=>'aggiungi date alternative',
												2=>'add alternative dates',
												3=>'ajouter des dates alternatives',
												4=>'Alternative Ankunft',
												5=>'agregar fechas alternativas',
												6=>urlencode('добавить альтернативные даты'), 
												7=>'add alternative dates',
												8=>'add alternative dates',
												9=>'add alternative dates',
												10=>'add alternative dates',
												11=>'add alternative dates',
												12=>'add alternative dates',
												13=>'add alternative dates',
												14=>'add alternative dates',
												15=>'add alternative dates',
												16=>'add alternative dates'
											);

				$arrivo_alternativo = array(
												1=>'Arrivo alternativo',
												2=>'Alternative arrival',
												3=>'Arrivée alternative',
												4=>'Alternative Ankunft',
												5=>'Llegada alternativa',
												6=>urlencode('Альтернативное прибытие'), 
												7=>'Alternative arrival',
												8=>'Alternative arrival',
												9=>'Alternative arrival',
												10=>'Alternative arrival',
												11=>'Alternative arrival',
												12=>'Alternative arrival',
												13=>'Alternative arrival',
												14=>'Alternative arrival',
												15=>'Alternative arrival',
												16=>'Alternative arrival'
											);

				$partenza_alternativo = array(
												1=>'Partenza alternativa',
												2=>'Alternative departure',
												3=>'Départ alternatif',
												4=>'Alternative Abfahrt',
												5=>'Salida alternativa',
												6=>urlencode('Альтернативный выезд'), 
												7=>'Alternative departure',
												8=>'Alternative departure',
												9=>'Alternative departure',
												10=>'Alternative departure',
												11=>'Alternative departure',
												12=>'Alternative departure',
												13=>'Alternative departure',
												14=>'Alternative departure',
												15=>'Alternative departure',
												16=>'Alternative departure'
											);

					$adulti_params = array(
											1=>'Adulti,1,2,3,4,5,6,7,8,9,10',
											2=>'Adults,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20',
											3=>'Adultes,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20',
											4=>'Erwachsene,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20',
											5=>'Adultos,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20',
											6=>urlencode('Взрослые,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20'),
											7=>'Adults,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20',
											8=>'Adults,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20',
											9=>'Adults,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20',
											10=>'Adults,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20',
											11=>'Adults,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20',
											12=>'Adults,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20',
											13=>'Adults,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20',
											14=>'Adults,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20',
											15=>'Adults,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20',
											16=>'Adults,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20'
										);

					$bambini = array(
										1=>'Bambini',
										2=>'Children',
										3=>'Enfants',
										4=>'Kinder',
										5=>'Niños',
										6=>urlencode('Дети'), 
										7=>'Children',
										8=>'Children',
										9=>'Children',
										10=>'Children',
										11=>'Children',
										12=>'Children',
										13=>'Children',
										14=>'Children',
										15=>'Children',
										16=>'Children'
									);

					$bambini_params = array(
											1=>'Bambini,1,2,3,4,5,6',
											2=>'Children,1,2,3,4,5,6',
											3=>'Enfants,1,2,3,4,5,6',
											4=>'Kinder,1,2,3,4,5,6',
											5=>'Niños,1,2,3,4,5,6',
											6=>urlencode('Дети,1,2,3,4,5,6'),
											7=>'Children,1,2,3,4,5,6',
											8=>'Children,1,2,3,4,5,6',
											9=>'Children,1,2,3,4,5,6',
											10=>'Children,1,2,3,4,5,6',
											11=>'Children,1,2,3,4,5,6',
											12=>'Children,1,2,3,4,5,6',
											13=>'Children,1,2,3,4,5,6',
											14=>'Children,1,2,3,4,5,6',
											15=>'Children,1,2,3,4,5,6',
											16=>'Children,1,2,3,4,5,6'
										);
										

				$add_room = array(
									1=>'aggiungi camera',
									2=>'add room',
									3=>'ajouter de la place',
									4=>'Raum hinzufügen',
									5=>'agregar habitación',
									6=>urlencode('добавить комнату'),
									7=>'add room',
									8=>'add room',
									9=>'add room',
									10=>'add room',
									11=>'add room',
									12=>'add room',
									13=>'add room',
									14=>'add room',
									15=>'add room',
									16=>'add room'
								);										

				$messaggio = array(
									1=>'Messaggio',
									2=>'Message',
									3=>'Message',
									4=>'Message',
									5=>'Enviar',
									6=>urlencode('Cообщение'), 
									7=>'Message',
									8=>'Message',
									9=>'Message',
									10=>'Message',
									11=>'Message',
									12=>'Message',
									13=>'Message',
									14=>'Message',
									15=>'Message',
									16=>'Message'
								);

				$trattamento 	= array(
										1=>'Trattamento',
										2=>'Treatment',
										3=>'Traitement',
										4=>'Behandlung',
										5=>'Tratamiento',
										6=>urlencode('лечение'), 
										7=>'Treatment',
										8=>'Treatment',
										9=>'Treatment',
										10=>'Treatment',
										11=>'Treatment',
										12=>'Treatment',
										13=>'Treatment',
										14=>'Treatment',
										15=>'Treatment',
										16=>'Treatment'
									);


			$trattamento_params = array(
										1 => 'Trattamento,Bed & Breakfast,Mezza Pensione,Pensione Completa,Solo Pernotto',
										2 => 'Treatment,Full Board,Half Board,Bed & Breakfast',
										3 => 'Traitement,Pension Complete,Demi-Pension,Chambre + petit déjeuner',
										4 => 'Behandlung,Vollpension,Halbpension,Bed & Breakfast',
										5 => 'Tratamiento,Alojamiento y desayuno, media pensión, pensión completa',
										6 => urlencode('лечение,полный пансион, полупансион,  кровать и завтрак'),
										7 => 'Treatment,Full Board,Half Board,Bed & Breakfast',
										8 => 'Treatment,Full Board,Half Board,Bed & Breakfast',
										9 => 'Treatment,Full Board,Half Board,Bed & Breakfast',
										10 => 'Treatment,Full Board,Half Board,Bed & Breakfast',
										11 => 'Treatment,Full Board,Half Board,Bed & Breakfast',
										12 => 'Treatment,Full Board,Half Board,Bed & Breakfast',
										13 => 'Treatment,Full Board,Half Board,Bed & Breakfast',
										14 => 'Treatment,Full Board,Half Board,Bed & Breakfast',
										15 => 'Treatment,Full Board,Half Board,Bed & Breakfast',
										16 => 'Treatment,Full Board,Half Board,Bed & Breakfast'
									);
	


				$tipo_vacanza 	= array(
									1=>'Tipo vacanza',
									2=>'Vacation type',
									3=>'Type de vacances',
									4=>'Urlaubsart',
									5=>'Tipo de vacaciones',
									6=>urlencode('Тип отдыха'), 
									7=>'Vacation type',
									8=>'Vacation type',
									9=>'Vacation type',
									10=>'Vacation type',
									11=>'Vacation type',
									12=>'Vacation type',
									13=>'Vacation type',
									14=>'Vacation type',
									15=>'Vacation type',
									16=>'Vacation type'
								);
			$vacanza_params = array(
								1=>'Tipo vacanza,Family,Business,Fiera,Benessere,Bike,Sport,Divertimento,Romantica,Culturale,Generica',
								2=>'Vacation type,Family,Business,Fair,Wellness,Bike,Sport,Fun,Romantic,Cultural,Generic',
								3=>'Type de vacances,Famille,Entreprise,Foire,Bien-être,Vélo,Sport,Fun,Romantique,Culturel,Générique',
								4=>'Urlaubsart,Familie,Geschäft,Messe,Wellness,Fahrrad,Sport,Spaß,Romantik,Kultur,Generisch',
								5=>'Tipo de vacaciones,Familia,Negocios,Feria,Bienestar,Bicicleta,Deporte,Diversión,Romántico,Cultural,Genérico',
								6=>urlencode('Тип отдыха,Семейный,Бизнес,Ярмарка,Оздоровительный,Велосипед,Спорт,Развлечения,Романтический,Культурный,Общий'),
								7=>'Vacation type,Family,Business,Fair,Wellness,Bike,Sport,Fun,Romantic,Cultural,Generic',
								8=>'Vacation type,Family,Business,Fair,Wellness,Bike,Sport,Fun,Romantic,Cultural,Generic',
								9=>'Vacation type,Family,Business,Fair,Wellness,Bike,Sport,Fun,Romantic,Cultural,Generic',
								10=>'Vacation type,Family,Business,Fair,Wellness,Bike,Sport,Fun,Romantic,Cultural,Generic',
								11=>'Vacation type,Family,Business,Fair,Wellness,Bike,Sport,Fun,Romantic,Cultural,Generic',
								12=>'Vacation type,Family,Business,Fair,Wellness,Bike,Sport,Fun,Romantic,Cultural,Generic',
								13=>'Vacation type,Family,Business,Fair,Wellness,Bike,Sport,Fun,Romantic,Cultural,Generic',
								14=>'Vacation type,Family,Business,Fair,Wellness,Bike,Sport,Fun,Romantic,Cultural,Generic',
								15=>'Vacation type,Family,Business,Fair,Wellness,Bike,Sport,Fun,Romantic,Cultural,Generic',
								16=>'Vacation type,Family,Business,Fair,Wellness,Bike,Sport,Fun,Romantic,Cultural,Generic'
							);									
			$tipo_camera 	= array(
									1=>'Tipo camera',
									2=>'Room type',
									3=>'Type de chambre',
									4=>'Zimmertyp',
									5=>'Tipo de habitación',
									6=>urlencode('Тип комнаты'), 
									7=>'Room type',
									8=>'Room type',
									9=>'Room type',
									10=>'Room type',
									11=>'Room type',
									12=>'Room type',
									13=>'Room type',
									14=>'Room type',
									15=>'Room type',
									16=>'Room type'
								);
			$camera_params 	= array(
									1=>'Tipo camera,singola,doppia,matrimoniale,tripla,suite',
									2=>'Room type,single,double,triple,suite',
									3=>'Type de chambre,simple,double,triple,suite',
									4=>'Zimmertyp,Einzel,Doppel,Dreibettzimmer,Suite',
									5=>'Tipo de habitación,individual,doble,triple,suite',
									6=>urlencode('Тип комнаты,одноместный,двухместный,двухместный,трехместный,люкс'), 
									7=>'Room type,single,double,double room,triple,suite',
									8=>'Room type,single,double,double room,triple,suite',
									9=>'Room type,single,double,double room,triple,suite',
									10=>'Room type,single,double,double room,triple,suite',
									11=>'Room type,single,double,double room,triple,suite',
									12=>'Room type,single,double,double room,triple,suite',
									13=>'Room type,single,double,double room,triple,suite',
									14=>'Room type,single,double,double room,triple,suite',
									15=>'Room type,single,double,double room,triple,suite',
									16=>'Room type,single,double,double room,triple,suite'
								);
			$num_camere 	= array(
									1=>'Nr.camere',
									2=>'Nr.Rooms',
									3=>'Nr.Chambres',
									4=>'Nr.Zimmer',
									5=>'Nr.Habitaciones',
									6=>urlencode('Номер комнаты'), 
									7=>'Nr.Rooms',
									8=>'Nr.Rooms',
									9=>'Nr.Rooms',
									10=>'Nr.Rooms',
									11=>'Nr.Rooms',
									12=>'Nr.Rooms',
									13=>'Nr.Rooms',
									14=>'Nr.Rooms',
									15=>'Nr.Rooms',
									16=>'Nr.Rooms'
								);
			$numcamere_params = array(
									1=>'Nr.camere,1,2,3,4,5,6,7,8,9,10',
									2=>'Nr.Rooms,1,2,3,4,5,6,7,8,9,10',
									3=>'Nr.Chambres,1,2,3,4,5,6,7,8,9,10',
									4=>'Nr.Zimmer,1,2,3,4,5,6,7,8,9,10',
									5=>'Nr.Habitaciones,1,2,3,4,5,6,7,8,9,10',
									6=>urlencode('Номер комнаты,1,2,3,4,5,6,7,8,9,10'),
									7=>'Nr.Rooms,1,2,3,4,5,6,7,8,9,10',
									8=>'Nr.Rooms,1,2,3,4,5,6,7,8,9,10',
									9=>'Nr.Rooms,1,2,3,4,5,6,7,8,9,10',
									10=>'Nr.Rooms,1,2,3,4,5,6,7,8,9,10',
									11=>'Nr.Rooms,1,2,3,4,5,6,7,8,9,10',
									12=>'Nr.Rooms,1,2,3,4,5,6,7,8,9,10',
									13=>'Nr.Rooms,1,2,3,4,5,6,7,8,9,10',
									14=>'Nr.Rooms,1,2,3,4,5,6,7,8,9,10',
									15=>'Nr.Rooms,1,2,3,4,5,6,7,8,9,10',
									16=>'Nr.Rooms,1,2,3,4,5,6,7,8,9,10'
								);

				$etichetta_marketing = array(
											1=>'Acconsento a ricevere offerte esclusive e novità',
											2=>'I agree to receive exclusive offers and news',
											3=>'J\'accepte de recevoir des offres exclusives et des actualités',
											4=>'Ich bin damit einverstanden, exklusive Angebote und Neuigkeiten zu erhalten',
											5=>'Acepto recibir ofertas y novedades exclusivas',
											6=>'Я согласен получать эксклюзивные предложения и новости ',
											7=>'I agree to receive exclusive offers and news',
											8=>'I agree to receive exclusive offers and news',
											9=>'I agree to receive exclusive offers and news',
											10=>'I agree to receive exclusive offers and news',
											11=>'I agree to receive exclusive offers and news',
											12=>'I agree to receive exclusive offers and news',
											13=>'I agree to receive exclusive offers and news',
											14=>'I agree to receive exclusive offers and news',
											15=>'I agree to receive exclusive offers and news',
											16=>'I agree to receive exclusive offers and news'
											);

				$t_form = array(    
									1=>'',	
									2=>'',
									3=>'',
									4=>'',
									5=>'',
									6=>'',
									7=>'',
									8=>'',
									9=>'',
									10=>'',
									11=>'',
									12=>'',
									13=>'',
									14=>'',
									15=>'',
									16=>''
								);

				$t_mail = array( 
									1=>'',	
									2=>'',
									3=>'',
									4=>'',
									5=>'',
									6=>'',
									7=>'',
									8=>'',
									9=>'',
									10=>'',
									11=>'',
									12=>'',
									13=>'',
									14=>'',
									15=>'',
									16=>''
								);

				$nome_form = array(	
									1=>'Form richiesta informazioni QUOTO '.SITOWEB.'', 
									2=>'Information Request QUOTO '.SITOWEB.'',	
									3=>'Formulaire de demande d\'informations QUOTO '.SITOWEB.'',
									4=>'Informationsanforderungsformular QUOTO '.SITOWEB.'',
									5=>'Formulario de solicitud de información QUOTO '.SITOWEB.'',
									6=>'Форма запроса информации '.SITOWEB.'',
									7=>'Information Request QUOTO '.SITOWEB.'',
									8=>'Information Request QUOTO '.SITOWEB.'',
									9=>'Information Request QUOTO '.SITOWEB.'',
									10=>'Information Request QUOTO '.SITOWEB.'',
									11=>'Information Request QUOTO '.SITOWEB.'',
									12=>'Information Request QUOTO '.SITOWEB.'',
									13=>'Information Request QUOTO '.SITOWEB.'',
									14=>'Information Request QUOTO '.SITOWEB.'',
									15=>'Information Request QUOTO '.SITOWEB.'',
									16=>'Information Request QUOTO '.SITOWEB.''
								);

				$testo_submit = array(	
										1=>'Invia richiesta',
										2=>'Send Request',
										3=>'Envoyer demande',
										4=>'Anfrage senden',
										5=>'Enviar consulta',
										6=>'Отправить запрос',
										7=>'Send Request',
										8=>'Send Request',
										9=>'Send Request',
										10=>'Send Request',
										11=>'Send Request',
										12=>'Send Request',
										13=>'Send Request',
										14=>'Send Request',
										15=>'Send Request',
										16=>'Send Request'
									);

				$codice_sconto 	= array(
										1=>'Codice Sconto',
										2=>'Discount code',
										3=>'Code de réduction',
										4=>'Rabattcode',
										5=>'Código de descuento',
										6=>urlencode('Код скидки'), 
										7=>'Discount code',
										8=>'Discount code',
										9=>'Discount code',
										10=>'Discount code',
										11=>'Discount code',
										12=>'Discount code',
										13=>'Discount code',
										14=>'Discount code',
										15=>'Discount code',
										16=>'Discount code'
									);

				//generazione dei defaults in lingua
				foreach($lingue as $k=>$v){
					$form_header_lang = array(  "id_form" => $id_form,  "tipo_label" => "oggetto_email", "descrizione" => $oggetto[$k],	"id_lang" => $k );
					$db_form->insert("hospitality_form_testata_lang",$form_header_lang);
					$form_header_lang = array( "id_form" => $id_form, "tipo_label" => "destinatario_email", "descrizione" => $destinatario[$k], "id_lang" => $k);
					$db_form->insert("hospitality_form_testata_lang",$form_header_lang);
					$form_header_lang = array( "id_form" => $id_form, "tipo_label" => "testo_form", "descrizione" => $testo[$k], "id_lang" => $k);
					$db_form->insert("hospitality_form_testata_lang",$form_header_lang);
					$form_header_lang = array( "id_form" => $id_form, "tipo_label" => "template_mail", "descrizione" => $t_mail[$k], "id_lang" => $k);
					$db_form->insert("hospitality_form_testata_lang",$form_header_lang);
					$form_header_lang = array( "id_form" => $id_form, "tipo_label" => "template_form", "descrizione" => $t_form[$k], "id_lang" => $k);
					$db_form->insert("hospitality_form_testata_lang",$form_header_lang);
					$form_header_lang = array( "id_form" => $id_form, "tipo_label" => "nome_form", "descrizione" => $nome_form[$k], "id_lang" => $k);
					$db_form->insert("hospitality_form_testata_lang",$form_header_lang);
					$form_header_lang = array( "id_form" => $id_form, "tipo_label" => "testo_submit", "descrizione" => $testo_submit[$k], "id_lang" => $k);
					$db_form->insert("hospitality_form_testata_lang",$form_header_lang);
					$form_header_lang = array( "id_form" => $id_form, "tipo_label" => "text_consenso", "descrizione" => $consensoPrivacy[$k], "id_lang" => $k);
					$db_form->insert("hospitality_form_testata_lang",$form_header_lang);
					$form_header_lang = array( "id_form" => $id_form, "tipo_label" => "id_iubenda", "descrizione" => "", "id_lang" => $k);
					$db_form->insert("hospitality_form_testata_lang",$form_header_lang);
				}

				//vengono generati 6 campi in automatico che sono configurati come obbligatori :: nome email note con le relative impostazioni in lingua

				$form_content = array(

					//elemento 1
					array(
						"id_sito" 			=>	IDSITO,
						"id_form"			=>	$id_form,
						"id_tipo_input"		=>	3,
						"name"				=>	'nome',
						"obbligatorio"		=>	1,
						"ordinamento"		=> 	10,
						"attivo" 			=>	1,
					),
					//elemento 2
					array(
						"id_sito" 			=>	IDSITO,
						"id_form"			=>	$id_form,
						"id_tipo_input"		=>	3,
						"name"				=>	'cognome',
						"obbligatorio"		=>	1,
						"ordinamento"		=> 	20,
						"attivo" 			=>	1,
					),
					//elemento 3
					array(
						"id_sito" 			=>	IDSITO,
						"id_form"			=>	$id_form,
						"id_tipo_input"		=>	7,
						"name"				=>	'email',
						"obbligatorio"		=>	1,
						"ordinamento"		=> 	30,
						"attivo" 			=>	1,

					),
					//elemento 4
					array(
						"id_sito" 			=>	IDSITO,
						"id_form"			=>	$id_form,
						"id_tipo_input"		=>	3,
						"name"				=>	'telefono',
						"obbligatorio"		=>	0,
						"ordinamento"		=> 	40,
						"attivo" 			=>	1,
					),
					//elemento 5
					array(
						"id_sito" 			=>	IDSITO,
						"id_form"			=>	$id_form,
						"id_tipo_input"		=>	6,
						"name"				=>	'data_arrivo',
						"obbligatorio"		=>	1,
						"ordinamento"		=> 	50,
						"attivo" 			=>	1,

					),
					//elemento 6
					array(
						"id_sito" 			=>	IDSITO,
						"id_form"			=>	$id_form,
						"id_tipo_input"		=>	6,
						"name"				=>	'data_partenza',
						"obbligatorio"		=>	1,
						"ordinamento"		=> 	60,
						"attivo" 			=>	1,

					),
					//elemento 7
					array(
						"id_sito" 			=>	IDSITO,
						"id_form"			=>	$id_form,
						"id_tipo_input"		=>	18,
						"name"				=>	'campo_libero',
						"obbligatorio"		=>	0,
						"ordinamento"		=> 	70,
						"attivo" 			=>	1,
					),
					//elemento 8
					array(
						"id_sito" 			=>	IDSITO,
						"id_form"			=>	$id_form,
						"id_tipo_input"		=>	6,
						"name"				=>	'DataArrivo',
						"obbligatorio"		=>	1,
						"ordinamento"		=> 	80,
						"attivo" 			=>	1,

					),
					//elemento 9
					array(
						"id_sito" 			=>	IDSITO,
						"id_form"			=>	$id_form,
						"id_tipo_input"		=>	6,
						"name"				=>	'DataPartenza',
						"obbligatorio"		=>	1,
						"ordinamento"		=> 	90,
						"attivo" 			=>	1,

					),
					
					//elemento 10
					array(
						"id_sito" 			=>	IDSITO,
						"id_form"			=>	$id_form,
						"id_tipo_input"		=>	2,
						"name"				=>	'TipoVacanza',
						"obbligatorio"		=>	0,
						"ordinamento"		=> 	105,
						"attivo" 			=>	0,
					),	
					//elemento 11
					array(
						"id_sito" 			=>	IDSITO,
						"id_form"			=>	$id_form,
						"id_tipo_input"		=>	2,
						"name"				=>	'TipoSoggiorno',
						"obbligatorio"		=>	1,
						"ordinamento"		=> 	110,
						"attivo" 			=>	1,
					),
					//elemento 12
					array(
						"id_sito" 			=>	IDSITO,
						"id_form"			=>	$id_form,
						"id_tipo_input"		=>	2,
						"name"				=>	'NumeroCamere',
						"obbligatorio"		=>	0,
						"ordinamento"		=> 	115,
						"attivo" 			=>	0,
					),
					//elemento 13
					array(
						"id_sito" 			=>	IDSITO,
						"id_form"			=>	$id_form,
						"id_tipo_input"		=>	2,
						"name"				=>	'TipoCamere',
						"obbligatorio"		=>	0,
						"ordinamento"		=> 	120,
						"attivo" 			=>	0,
					),
					//elemento 14
					array(
						"id_sito" 			=>	IDSITO,
						"id_form"			=>	$id_form,
						"id_tipo_input"		=>	2,
						"name"				=>	'NumAdulti',
						"obbligatorio"		=>	1,
						"ordinamento"		=> 	125,
						"attivo" 			=>	1,
					),
					//elemento 15
					array(
						"id_sito" 			=>	IDSITO,
						"id_form"			=>	$id_form,
						"id_tipo_input"		=>	2,
						"name"				=>	'NumBambini',
						"obbligatorio"		=>	0,
						"ordinamento"		=> 	130,
						"attivo" 			=>	1,
					),
					//elemento 16
					array(
						"id_sito" 			=>	IDSITO,
						"id_form"			=>	$id_form,
						"id_tipo_input"		=>	2,
						"name"				=>	'EtaB1',
						"obbligatorio"		=>	0,
						"ordinamento"		=> 	140,
						"attivo" 			=>	1,
					),

					//elemento 16
					array(
						"id_sito" 			=>	IDSITO,
						"id_form"			=>	$id_form,
						"id_tipo_input"		=>	2,
						"name"				=>	'EtaB2',
						"obbligatorio"		=>	0,
						"ordinamento"		=> 	145,
						"attivo" 			=>	1,
					),

					//elemento 16
					array(
						"id_sito" 			=>	IDSITO,
						"id_form"			=>	$id_form,
						"id_tipo_input"		=>	2,
						"name"				=>	'EtaB3',
						"obbligatorio"		=>	0,
						"ordinamento"		=> 	150,
						"attivo" 			=>	1,

					),
					//elemento 16
					array(
						"id_sito" 			=>	IDSITO,
						"id_form"			=>	$id_form,
						"id_tipo_input"		=>	2,
						"name"				=>	'EtaB4',
						"obbligatorio"		=>	0,
						"ordinamento"		=> 	155,
						"attivo" 			=>	1,
					),

					//elemento 16
					array(
						"id_sito" 			=>	IDSITO,
						"id_form"			=>	$id_form,
						"id_tipo_input"		=>	2,
						"name"				=>	'EtaB5',
						"obbligatorio"		=>	0,
						"ordinamento"		=> 	160,
						"attivo" 			=>	1,
					),

					//elemento 16
					array(
						"id_sito" 			=>	IDSITO,
						"id_form"			=>	$id_form,
						"id_tipo_input"		=>	2,
						"name"				=>	'EtaB6',
						"obbligatorio"		=>	0,
						"ordinamento"		=> 	165,
						"attivo" 			=>	1,

					),

					//elemento 17
					array(
						"id_sito" 			=>	IDSITO,
						"id_form"			=>	$id_form,
						"id_tipo_input"		=>	18,
						"name"				=>	'campo_libero',
						"obbligatorio"		=>	0,
						"ordinamento"		=> 	170,
						"attivo" 			=>	1,
					),
					//elemento 18
					array(
						"id_sito" 			=>	IDSITO,
						"id_form"			=>	$id_form,
						"id_tipo_input"		=>	1,
						"name"				=>	'messaggio',
						"obbligatorio"		=>	0,
						"ordinamento"		=> 	900,
						"attivo" 			=>	1,
					),	
					//elemento 19
					array(
						"id_sito" 			=>	IDSITO,
						"id_form"			=>	$id_form,
						"id_tipo_input"		=>	3,
						"name"				=>	'codice_sconto',
						"obbligatorio"		=>	0,
						"ordinamento"		=> 	910,
						"attivo" 			=>	0,
					),					
					//elemento 20
					array(
						"id_sito" 			=>	IDSITO,
						"id_form"			=>	$id_form,
						"id_tipo_input"		=>	17,
						"name"				=>	'captcha',
						"obbligatorio"		=>	0,
						"ordinamento"		=> 	950,
						"attivo" 			=>	1,
					),

					//elemento 21
					array(
						"id_sito" 			=>	IDSITO,
						"id_form"			=>	$id_form,
						"id_tipo_input"		=>	5,
						"name"				=>	'marketing',
						"obbligatorio"		=>	0,
						"ordinamento"		=> 	960,
						"attivo" 			=>	1,
					),
					//elemento 22
					array(
						"id_sito" 			=>	IDSITO,
						"id_form"			=>	$id_form,
						"id_tipo_input"		=>	18,
						"name"				=>	'campo_libero',
						"obbligatorio"		=>	0,
						"ordinamento"		=> 	970,
						"attivo" 			=>	1,
					)

				);
				$id_items = array();
				foreach($form_content as $k=>$v){
					array_push($id_items, $db_form->insert("hospitality_form_contenuti",$v));
				}

				foreach($lingue as $k=>$v){

					
					//nome
					$form_content_lang = array(
						"id_campo" => $id_items[0],
						"id_lang" => $k,
						"label" => $nome[$k],
						"errore_su_campo" => str_replace('[label]',$nome[$k], $errore[$k]),
						"id_sito" => IDSITO,
						"id_form" => $id_form,
						"campo"=>'<div class="row"><div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 relative"><input type="text" class="form-control" name="nome" id="nome_'.$id_items[0].'" placeholder="'.$nome[$k].'" required autocomplete="off"></div>'
					);
					$db_form->insert("hospitality_form_contenuti_lang",$form_content_lang);

					//cognome
					$form_content_lang = array(
						"id_campo" => $id_items[1],
						"id_lang" => $k,
						"label" => $cognome[$k],
						"errore_su_campo" => str_replace('[label]',$cognome[$k], $errore[$k]),
						"id_sito" => IDSITO,
						"id_form" => $id_form,
						"campo"=>'<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 relative"><input type="text" class="form-control" name="cognome" id="cognome_'.$id_items[1].'" placeholder="'.$cognome[$k].'" required autocomplete="off"></div></div><div class="clearfix"></div>'
					);
					$db_form->insert("hospitality_form_contenuti_lang",$form_content_lang);

					//email
					$form_content_lang = array(
						"id_campo" => $id_items[2],
						"id_lang" => $k,
						"label" => "Email",
						"errore_su_campo" => str_replace('[label]',"Email", $errore[$k]),
						"id_sito" => IDSITO,
						"id_form" => $id_form,
						"campo"=>'<div class="row"><div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 relative"><input type="email" class="form-control" name="email" id="email_'.$id_items[2].'"  placeholder="Email" required autocomplete="off"><span id="check_email"></span></div>'
					);
					$db_form->insert("hospitality_form_contenuti_lang",$form_content_lang);


					//telefono
					$form_content_lang = array(
						"id_campo" => $id_items[3],
						"id_lang" => $k,
						"label" => $telefono[$k],
						"errore_su_campo" => str_replace('[label]',$telefono[$k], $errore[$k]),
						"id_sito" => IDSITO,
						"id_form" => $id_form,
						"campo"=>'<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 relative"><input type="text" class="form-control" name="telefono" id="telefono_'.$id_items[3].'" placeholder="'.$telefono[$k].'"  autocomplete="off"></div></div><div class="clearfix"></div>'
					);
					$db_form->insert("hospitality_form_contenuti_lang",$form_content_lang);

					//arrivo
					$form_content_lang = array(
						"id_campo" => $id_items[4],
						"id_lang" => $k,
						"label" => $arrivo[$k],
						"errore_su_campo" => str_replace('[label]',$arrivo[$k], $errore[$k]),
						"id_sito" => IDSITO,
						"id_form" => $id_form,
						"campo"=>'<div class="row"><div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 relative"><input type="text" class="form-control" readonly="readonly" onKeyDown="return false" name="data_arrivo" id="data_arrivo_'.$id_items[4].'" placeholder="'.$arrivo[$k].'"  autocomplete="new_password" onselectstart="return false;" onpaste="return false;"  ondrop="return false;" required></div>'
					);
					$db_form->insert("hospitality_form_contenuti_lang",$form_content_lang);

					//partenza
					$form_content_lang = array(
						"id_campo" => $id_items[5],
						"id_lang" => $k,
						"label" => $partenza[$k],
						"errore_su_campo" => str_replace('[label]',$partenza[$k], $errore[$k]),
						"id_sito" => IDSITO,
						"id_form" => $id_form,
						"campo"=>'<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 relative"><input type="text" class="form-control" readonly="readonly" onKeyDown="return false" name="data_partenza" id="data_partenza_'.$id_items[5].'" placeholder="'.$partenza[$k].'"  autocomplete="new_password" onselectstart="return false;" onpaste="return false;"  ondrop="return false;" required></div></div><div class="clearfix"></div>'
					);
					$db_form->insert("hospitality_form_contenuti_lang",$form_content_lang);


					//campo libero per visualizzare o nascondere le date alternative
					$form_content_lang = array(
						"id_campo" => $id_items[6],
						"id_lang" => $k,
						"label" => "Campo Libero",
						"errore_su_campo" => str_replace('[label]',"Campo Libero", $errore[$k]),
						"id_sito" => IDSITO,
						"id_form" => $id_form,
						"campo"=>'<a href="javascript:;" id="plus_date"><i class="fa fa-fw  fa-plus"></i> '.$plus_date[$k].'</a><div class="clearfix"></div><div id="date_alternative" style="display:none">'
					);
					$db_form->insert("hospitality_form_contenuti_lang",$form_content_lang);
					
					
							//arrivo_alt
							$form_content_lang = array(
								"id_campo" => $id_items[7],
								"id_lang" => $k,
								"label" => $arrivo[$k],
								"errore_su_campo" => str_replace('[label]',$arrivo_alternativo[$k], $errore[$k]),
								"id_sito" => IDSITO,
								"id_form" => $id_form,
								"campo"=>'<div class="row"><div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 relative"><input type="text" class="form-control" readonly="readonly" onKeyDown="return false" name="DataArrivo" id="DataArrivo_1_'.$id_items[7].'" placeholder="'.$arrivo_alternativo[$k].'"  autocomplete="new_password" onselectstart="return false;" onpaste="return false;"  ondrop="return false;"></div>'
							);
							$db_form->insert("hospitality_form_contenuti_lang",$form_content_lang);
	
							//partenza_alt
							$form_content_lang = array(
								"id_campo" => $id_items[8],
								"id_lang" => $k,
								"label" => $partenza[$k],
								"errore_su_campo" => str_replace('[label]',$partenza_alternativo[$k], $errore[$k]),
								"id_sito" => IDSITO,
								"id_form" => $id_form,
								"campo"=>'<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 relative"><input type="text" class="form-control" readonly="readonly" onKeyDown="return false" name="DataPartenza" id="DataPartenza_1_'.$id_items[8].'" placeholder="'.$partenza_alternativo[$k].'"  autocomplete="new_password" onselectstart="return false;" onpaste="return false;"  ondrop="return false;"></div></div><!--chiusura div date alternative--></div><div class="clearfix"></div>'
							);
							$db_form->insert("hospitality_form_contenuti_lang",$form_content_lang);

					//tipo vacanza
					$form_content_lang = array(
						"id_campo" => $id_items[9],
						"id_lang" => $k,
						"label" => $tipo_vacanza[$k],
						"errore_su_campo" => str_replace('[label]',$tipo_vacanza[$k], $errore[$k]),
						"id_sito" => IDSITO,
						"id_form" => $id_form,
						"parametri" => $vacanza_params[$k],
						"campo"=>'<select  name="TipoVacanza" id="TipoVacanza" class="form-control" placeholder="'.$tipo_vacanza[$k].'" required>[parametri]</select><div class="clearfix"></div>'
					);
					$db_form->insert("hospitality_form_contenuti_lang",$form_content_lang);

					//trattamento
					$form_content_lang = array(
						"id_campo" => $id_items[10],
						"id_lang" => $k,
						"label" => $trattamento[$k],
						"errore_su_campo" => str_replace('[label]',$trattamento[$k], $errore[$k]),
						"id_sito" => IDSITO,
						"id_form" => $id_form,
						"parametri" => $trattamento_params[$k] ,
						"campo"=>'<div class="row"><div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 relative"><select name="TipoSoggiorno_1"  class="form-control" id="TipoSoggiorno_1_1"  placeholder="'.$trattamento[$k].'" required>[parametri]</select></div>'
					);
					$db_form->insert("hospitality_form_contenuti_lang",$form_content_lang);


					//nr.camere
					$form_content_lang = array(
						"id_campo" => $id_items[11],
						"id_lang" => $k,
						"label" => $num_camere[$k],
						"errore_su_campo" => str_replace('[label]',$num_camere[$k], $errore[$k]),
						"id_sito" => IDSITO,
						"id_form" => $id_form,
						"parametri" => $numcamere_params[$k],
						"campo"=>'<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 relative"><select class="form-control" name="NumeroCamere_1" id="NumeroCamere_1_1"  placeholder="'.$num_camere[$k].'" required>[parametri]</select></div>'
					);
					$db_form->insert("hospitality_form_contenuti_lang",$form_content_lang);


					//tipo camera
					$form_content_lang = array(
						"id_campo" => $id_items[12],
						"id_lang" => $k,
						"label" => $tipo_camera[$k],
						"errore_su_campo" => str_replace('[label]',$tipo_camera[$k], $errore[$k]),
						"id_sito" => IDSITO,
						"id_form" => $id_form,
						"parametri" => $camera_params[$k],
						"campo"=>'<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 relative"><select class="form-control" name="TipoCamere_1" id="TipoCamere_1_1"  placeholder="'.$tipo_camera[$k].'" required>[parametri]</select></div>'
					);
					$db_form->insert("hospitality_form_contenuti_lang",$form_content_lang);


					//adulti
					$form_content_lang = array(
						"id_campo" => $id_items[13],
						"id_lang" => $k,
						"label" => $adulti[$k],
						"errore_su_campo" => str_replace('[label]',$adulti[$k], $errore[$k]),
						"id_sito" => IDSITO,
						"id_form" => $id_form,
						"parametri" => $adulti_params[$k],
						"campo"=>'<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 relative"><select class="form-control calcolaA" name="NumAdulti_1" id="NumeroAdulti_1_1"  placeholder="'.$adulti[$k].'" onchange="calcola_totale_adulti();" required>[parametri]</select></div>'
					);
					$db_form->insert("hospitality_form_contenuti_lang",$form_content_lang);

					//bambini
					$form_content_lang = array(
						"id_campo" => $id_items[14],
						"id_lang" => $k,
						"label" => $bambini[$k],
						"errore_su_campo" => str_replace('[label]',$bambini[$k], $errore[$k]),
						"id_sito" => IDSITO,
						"id_form" => $id_form,
						"parametri" => $bambini_params[$k],
						"campo"=>'<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 relative"><select class="form-control calcolaB" name="NumBambini_1" id="NumeroBambini_1_1"  placeholder="'.$bambini[$k].'" onchange="eta_bimbi(\'1_1\');calcola_totale_bambini();">[parametri]</select></div></div>'
					);
					$db_form->insert("hospitality_form_contenuti_lang",$form_content_lang);

					//bambini_eta
					$form_content_lang = array(
						"id_campo" => $id_items[15],
						"id_lang" => $k,
						"label" => $eta[$k],
						"errore_su_campo" => str_replace('[label]',$eta[$k], $errore[$k]),
						"id_sito" => IDSITO,
						"id_form" => $id_form,
						"parametri" => $eta_params[$k],
						"campo"=>'<div class="clearfix"></div><div class="row">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="row">
									<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 relative"><select class="form-control" name="EtaB1_1" id="EtaB1_1_1" style="display:none" onchange="cambia_prop(\'1_1_1\');">[parametri]</select></div>'
					);
					$db_form->insert("hospitality_form_contenuti_lang",$form_content_lang);

					//bambini_eta
					$form_content_lang = array(
						"id_campo" => $id_items[16],
						"id_lang" => $k,
						"label" => $eta[$k],
						"errore_su_campo" => str_replace('[label]',$eta[$k], $errore[$k]),
						"id_sito" => IDSITO,
						"id_form" => $id_form,
						"parametri" => $eta_params[$k],
						"campo"=>'<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 relative"><select class="form-control" name="EtaB2_1" id="EtaB2_1_1" style="display:none" onchange="cambia_prop(\'2_1_1\');">[parametri]</select></div>'
					);
					$db_form->insert("hospitality_form_contenuti_lang",$form_content_lang);

					//bambini_eta
					$form_content_lang = array(
						"id_campo" => $id_items[17],
						"id_lang" => $k,
						"label" => $eta[$k],
						"errore_su_campo" => str_replace('[label]',$eta[$k], $errore[$k]),
						"id_sito" => IDSITO,
						"id_form" => $id_form,
						"parametri" => $eta_params[$k],
						"campo"=>'<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 relative"><select class="form-control" name="EtaB3_1" id="EtaB3_1_1" style="display:none" onchange="cambia_prop(\'3_1_1\');">[parametri]</select></div>'
					);
					$db_form->insert("hospitality_form_contenuti_lang",$form_content_lang);
															
					//bambini_eta
					$form_content_lang = array(
						"id_campo" => $id_items[18],
						"id_lang" => $k,
						"label" => $eta[$k],
						"errore_su_campo" => str_replace('[label]',$eta[$k], $errore[$k]),
						"id_sito" => IDSITO,
						"id_form" => $id_form,
						"parametri" => $eta_params[$k],
						"campo"=>'<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 relative"><select class="form-control" name="EtaB4_1" id="EtaB4_1_1" style="display:none" onchange="cambia_prop(\'4_1_1\');">[parametri]</select></div>'
					);
					$db_form->insert("hospitality_form_contenuti_lang",$form_content_lang);

					//bambini_eta
					$form_content_lang = array(
						"id_campo" => $id_items[19],
						"id_lang" => $k,
						"label" => $eta[$k],
						"errore_su_campo" => str_replace('[label]',$eta[$k], $errore[$k]),
						"id_sito" => IDSITO,
						"id_form" => $id_form,
						"parametri" => $eta_params[$k],
						"campo"=>'<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 relative"><select class="form-control" name="EtaB5_1" id="EtaB5_1_1" style="display:none" onchange="cambia_prop(\'5_1_1\');">[parametri]</select></div>'
					);
					$db_form->insert("hospitality_form_contenuti_lang",$form_content_lang);
														
					//bambini_eta
					$form_content_lang = array(
						"id_campo" => $id_items[20],
						"id_lang" => $k,
						"label" => $eta[$k],
						"errore_su_campo" => str_replace('[label]',$eta[$k], $errore[$k]),
						"id_sito" => IDSITO,
						"id_form" => $id_form,
						"parametri" => $eta_params[$k],
						"campo"=>'<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 relative"><select class="form-control" name="EtaB6_1" id="EtaB6_1_1" style="display:none" onchange="cambia_prop(\'6_1_1\');">[parametri]</select></div></div></div>'
					);
					$db_form->insert("hospitality_form_contenuti_lang",$form_content_lang);

					//campo libero per aggiungere o eliminare righe
					$form_content_lang = array(
						"id_campo" => $id_items[21],
						"id_lang" => $k,
						"label" => "Campo Libero",
						"errore_su_campo" => str_replace('[label]',"Campo Libero", $errore[$k]),
						"id_sito" => IDSITO,
						"id_form" => $id_form,
						"campo"=>'</div><div class="clearfix"></div><!-- SE SI ATTIVANO TUTTI I CAMPI DEL FORM USARE (<a id="add" href="javascript:;"  onclick="room_fields_full(1,\'righe_room\');" >)--><a id="add" href="javascript:;"  onclick="room_fields(1,\'righe_room\');" ><i class="fa fa-fw  fa-plus"></i> '.$add_room[$k].'</a><div class="clearfix"></div><div id="righe_room"></div><div class="clearfix"></div>'
					);
					$db_form->insert("hospitality_form_contenuti_lang",$form_content_lang);						

					//richiesta
					$form_content_lang = array(
						"id_campo" => $id_items[22],
						"id_lang" => $k,
						"label" => $messaggio[$k],
						"errore_su_campo" => str_replace('[label]',$messaggio[$k], $errore[$k]),
						"id_sito" => IDSITO,
						"id_form" => $id_form,
						"campo"=>'<textarea name="messaggio" id="messaggio_'.$id_items[17].'" class="form-control" placeholder="'.$messaggio[$k].'"></textarea>'
					);
					$db_form->insert("hospitality_form_contenuti_lang",$form_content_lang);

					//codice sconto
					$form_content_lang = array(
						"id_campo" => $id_items[23],
						"id_lang" => $k,
						"label" => $codice_sconto[$k],
						"errore_su_campo" => str_replace('[label]',$codice_sconto[$k], $errore[$k]),
						"id_sito" => IDSITO,
						"id_form" => $id_form,
						"campo"=>'<div class="row"><div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 relative"><input type="text" class="form-control" name="codice_sconto" id="codice_sconto_'.$id_items[23].'" placeholder="'.$codice_sconto[$k].'" required autocomplete="off"></div></div><div class="clearfix"></div>'
					);
					$db_form->insert("hospitality_form_contenuti_lang",$form_content_lang);

					//captcha
					$form_content_lang = array(
						"id_campo" => $id_items[24],
						"id_lang" => $k,
						"label" => "Captcha",
						"errore_su_campo" => str_replace('[label]',"Captcha", $errore[$k]),
						"id_sito" => IDSITO,
						"id_form" => $id_form,
						"campo"=>'<div class="clearfix"></div><div class="g-recaptcha" data-sitekey="[chiavesito]"></div><div class="clearfix"></div>'
					);
					$db_form->insert("hospitality_form_contenuti_lang",$form_content_lang);

					//marketing
					$form_content_lang = array(
						"id_campo" => $id_items[25],
						"id_lang" => $k,
						"label" => $etichetta_marketing[$k],
						"errore_su_campo" => str_replace('[label]',$etichetta_marketing[$k], $errore[$k]),
						"id_sito" => IDSITO,
						"id_form" => $id_form,
						"campo"=>'<input type="checkbox" id="marketing_'.$id_items[19].'" name="marketing" > <span>'.$etichetta_marketing[$k].'</span><div id="latestform"><div class="clearfix"></div></div>'
					);
					$db_form->insert("hospitality_form_contenuti_lang",$form_content_lang);



				}

				header('Location:'.BASE_URL_SITO.'setting-form/');

			}
	
?>
