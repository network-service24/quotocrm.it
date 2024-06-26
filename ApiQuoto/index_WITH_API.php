<?php require($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");?>
<?php
	if($_GET['idsito']){
		$ID_SITO = $_GET['idsito'];
	}else{
		$ID_SITO = 'ID_SITO';
	}
	if($_GET['idform']){
		$ID_FORM = $_GET['idform'];
	}else{
		$ID_FORM = 'ID_FORM';
	}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>HELP INTEGRAZIONE FORM PER QUOTO | Network Service</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script src="https://use.fontawesome.com/da6d3ea52f.js"></script>
		<script src="<?=BASE_URL_SITO?>ApiQuoto/js/clipboard.js"></script>
		<script>
			$(document).ready(function(){
				$('[data-toogle="tooltip"]').tooltip();
			});
    	</script>
</head>
<body>
	<div class="container">
		<p>&nbsp;</p>
		<img src="<?=BASE_URL_SITO?>class/resize.class.php?src=<?=BASE_PATH_SITO?>img/logo.png&w=300&h=0&a=c&q=100" alt="QUOTO" style="vertical-align: bottom;" />  <em><a href="http://www.quoto.travel/" target="_blank">Cos'è QUOTO</a></em>
		<p>&nbsp;</p>
		<b>Help per creare e/o collegare un form, sincronizzando le richieste con QUOTO!</b> <small>(Quoto Engagement & Customer Satisfaction)</small><br>
		###################################################################################################################################################<br>


<h3><b>WIDGET JS FORM QUOTO!</b> <small id="blink">new</small></h3>
<p>
	Il widget qui sotto stampa a video il <b>form dedicato al CRM QUOTO!</b><br>
	Il form è già abilitato alla raccolta dati da inviare e ricevere da <b>Analytics GA4</b> per la <b>tracciabilità della campagne ADS</b><br>
	Inoltre è necessario per il funzionamento del widget l'uso della libreria <b>Jquery.js</b>
</p>
<script> var clipboard = new ClipboardJS('#WDQ');</script>	
<i class="fa fa-code"></i>&nbsp;
<b>
	Codice widget per includere il FORM di QUOTO nel sito e/o in una landing page
</b>&nbsp;&nbsp;<i class="fa fa-arrow-right"></i>&nbsp;&nbsp;
<p>
	Copia ed incolla il codice nella pagina dove vuoi il form&nbsp;&nbsp;<i class="fa fa-arrow-right"></i>
	&nbsp;&nbsp;<a href="javascript:;" id="WDQ" data-clipboard-action="copy" data-clipboard-target="#WD" title="copia" alt="copia" class="text-red"><i class="fa fa-clone" aria-hidden="true"></i>&nbsp;&nbsp;Copia ed incolla</a>
	&nbsp;&nbsp;<a href="javascript:window.open('<?=BASE_URL_SITO?>ApiQuoto/viewWidgetForm.php?idsito=<?=$_GET['idsito']?>');" title="preview" alt="preview"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;&nbsp;Visualizza preview form</a>
	&nbsp;&nbsp;<a href="javascript:;" id="view_tips_tricks" data-toggle="tooltip" title="Script per modificare le etichette testuali"><i class="fa fa-expand" aria-hidden="true"></i>&nbsp;&nbsp;Tips & Tricks</a>	
		<script>
			$(document).ready(function(){			
				$("#view_tips_tricks").click(function() {
					$("#tips_tricks").slideToggle("slow");
				});
			})
		</script>
</p>
<pre style="display:none" id="tips_tricks">
&lt;!--
/**
** Se avete necessità d'inserire un testo descrittivo per agevolare la compilazione del form,  questo script d'esempio fa per voi!
** Il testo apparirà subito sopra la textarea del messaggio
**
** LO SCRIPT VA POSIZIONATO SUBITO SOTTO A: 
** &lt;script type="text/javascript" src="https://www.quoto.online/apiForm/js/form_widget_quoto.min.js" async defer&gt;&lt;/script&gt;
*/
--&gt;
&lt;div id="legenda" style="font-size:14px;line-height:1.1em;padding-left: 6px;"&gt;
	&lt;strong&gt;Attenzione!&lt;/strong&gt;
	&lt;br&gt;Indicaci più dettagli possibili nel campo del messaggio.&lt;br&gt; Così potremo ospitarti al  meglio!
&lt;/div&gt;
&lt;script&gt;
$(document).ready(function(){
	// CALCOLO DELLA VARIABILE res=sent
	var request_uri_      = window.location.pathname + window.location.search;
	// STAMPA A VIDEO LA LEGENDA SOLO SE NON ESITE LA VARIABILE DI RISPOSTA res=sent
	if (request_uri_.indexOf('?') == -1) {
		$("#legenda").show();
		setTimeout(function(){
			$("#legenda").insertBefore("#messaggio");	
		}, 1000);
	}else{
		$("#legenda").hide();
	}
})
&lt;/script&gt;
&lt;!--################################################################################################################################################--&gt;
&lt;!--
/**
** Se per esempio il widget form di quoto viene installato su un sito di un campeggio (quindi un camping non ha camere), 
** e si desidera sostituire le frasi "+ aggiungi camere" e "- rimuovi camera", (perchè richiesto dal cliente), questo script d'esempio fa per voi!
** Naturalmente le etichette possono essere personalizzate su necessità!
**
** LO SCRIPT VA POSIZIONATO SUBITO SOTTO A: 
** &lt;script type="text/javascript" src="https://www.quoto.online/apiForm/js/form_widget_quoto.min.js" async defer&gt;&lt;/script&gt;
*/
--&gt;
&lt;script&gt;
	// compilare language con la variabile statica della lingua, con una variabile php oppure con la globale di wordpress
	var language      = '&lt;?=$language?&gt;';
	var etichetta_add = '';
	var etichetta_rem = '';
	switch(language){
		case"it":
			etichetta_add = 'aggiungi unità abitativa';
			etichetta_rem = 'rimuovi unità abitativa';
			break;
		case"en":
			etichetta_add = 'add housing unit';
			etichetta_rem = 'remove housing unit';
			break;
		case"fr":
			etichetta_add = 'ajouter un logement';
			etichetta_rem = 'retirer l\'unité d\'habitation';
			break;
		case"de":
			etichetta_add = 'Wohneinheit hinzufügen';
			etichetta_rem = 'Gehäuseeinheit entfernen';
			break;
		case"es":
			etichetta_add = 'añadir unidad de vivienda';
			etichetta_rem = 'quitar unidad de vivienda';
			break;
		case"ru":
			etichetta_add = 'добавить единицу жилья';
			etichetta_rem = 'снять жилой блок';
			break;
		default:
			etichetta_add = 'add housing unit';
			etichetta_rem = 'remove housing unit';
			break;
	}
	$(document).ready(function(){
		setTimeout(function(){
			$("a#add").html("&lt;i class=\"fa fa-plus fa-w-14 fa-fw\"&gt;&lt;/i&gt; " + etichetta_add + "");
			$("a#add").on("click",function(){
				$("a#re").html("&lt;i class=\"fa fa-minus fa-w-14 fa-fw\"&gt;&lt;/i&gt; " + etichetta_rem + "");
			})
		}, 1000);
	})
&lt;/script&gt;
</pre>
<pre id="WD" style="background-color:#F7FBF5!important;">
&lt;!--JQUERY --&gt;
&lt;script type="text/javascript" src="https://www.quotocrm.it/apiForm/js/jquery-3.1.1.min.js"&gt;&lt;/script&gt;
&lt;!-- QUOTO! form --&gt;
&lt;script type="text/javascript"&gt;
if(typeof window.quoto_form == 'undefined'){
	var quoto_form = $.makeArray({
					'idsito'              : <?=$ID_SITO?>,
					'language'            : 'it',
					'bootstrap'       	  : 1,
					'captcha'         	  : 0,
					'ChiaveSitoReCaptcha' : '',   //v.2 Invisible
					'iubendapolicy'   	  : 0, 
					'iubendacode'         : '',
					'selBambini'   	      : 1,
					'tipoSoggiorni'       : '',
					'fontawesome'     	  : 1,
					'campoSconto'     	  : 0,
					'selectAnimali'   	  : 0,
					'selectAlloggi'       : 0,
					'tipoAlloggi'         : '',
					'multiStruttura'      : ''
			}); 
}
&lt;/script&gt;
&lt;div id="WidgetformQuoto"&gt;&lt;/div&gt;
&lt;script type="text/javascript" src="https://www.quotocrm.it/apiForm/js/form_widget_quoto.min.js" async defer&gt;&lt;/script&gt;
&lt;!-- QUOTO! end form --&gt;</pre>
<p>
	<b>LEGENDA</b>
	<ul>
		<li>lo script necessità della libreria <b>jquery.js</b><br><br></li>
		<li><b>idsito</b>          	= ID_SITO <i class="fa fa-arrow-right" style="padding-left:10px;padding-right:10px;"></i> Se il valore non è auto compilato è da richiedere a Network Service</li>
		<li><b>language</b>        	= 'it' <i class="fa fa-arrow-right" style="padding-left:10px;padding-right:10px;"></i> (Italiano = it, Inglese = en, Francese = fr, Tedesco = de, Spagnolo = es, Russo = ru) <br><span style="font-size:12px">Queste altre lingue vengono visualizzate a video in inglese (Olandese = nl, Polacco = pl, Ungherese = hu, Portoghese = pt, Arabo = ae, Ceco = cz, Cinese = cn, Brasiliano = br, Giapponese = jp)</span></li>
		<li><b>bootstrap </b>      	= 1    <i class="fa fa-arrow-right" style="padding-left:10px;padding-right:10px;"></i> 1 utilizza il framework di Bootstrap, 0 non utilizza il framework</li>
		<li><b>captcha v.2 Invisible</b>         	= 0    <i class="fa fa-arrow-right" style="padding-left:10px;padding-right:10px;"></i> 1 utilizza il controllo captcha, 0 non utilizza il controllo</li>
		<li><b>ChiaveSitoReCaptcha</b> = '' 	<i class="fa fa-arrow-right" style="padding-left:10px;padding-right:10px;"></i> se si utilizza il controllo captcha, compilare la chiave sito, la chiave segreta v.2 Invisible la legge da QUOTO Manager</li>
		<li><b>iubendapolicy</b>   	= 0    <i class="fa fa-arrow-right" style="padding-left:10px;padding-right:10px;"></i> 1 utilizza iubenda, 0 non utilizza iubenda</li>
		<li><b>iubendacode</b>      = ''   <i class="fa fa-arrow-right" style="padding-left:10px;padding-right:10px;"></i> se si utilizza iubenda, compilare i vari cookiePolicyId di iubenda 1234#4321#5678#8765#8788#9595 IT#EN#FR#DE#ES#RU</li>
		<li><b>selBambini</b>       = 1    <i class="fa fa-arrow-right" style="padding-left:10px;padding-right:10px;"></i> 1 visualizza la select Bambini, 0 non visualizza la select</li>
		<li><b>tipoSoggiorni</b>    = ''   <i class="fa fa-arrow-right" style="padding-left:10px;padding-right:10px;"></i> <span style="font-size:12px">se si desidera personalizzare le tipologie di soggiorno è necessario compilare tutte e 6 le lingue dividendo le lingue con un cancelletto(#) ed i valori con una virgola(,)</span>
		<li><span style="font-size:12px">ESEMPIO: Solo Pernotto,Mezza Pensione,Pensione Completa#Bed & Breakfast,Half Pensione,Full Pension#Nuitée uniquement,Demi-pension,Pension complète#Nur Übernachtung Halbpension,Vollpension#Sólo pernocta, Media Pensión, Pensión Completa#Только ночь, полупансион, полный пансион</span> </li>
		<li><span style="font-size:12px">valori  in italiano # valori in inglese # valori in francese # valori in tedesco # valori in spagnolo # valori in russo</span></li>
		<li><b>fontawesome</b>     	= 1    <i class="fa fa-arrow-right" style="padding-left:10px;padding-right:10px;"></i> 1 utilizza le Font Awesome, 0 non utilizza le Font</li>
		<li><b>campoSconto</b>     	= 1    <i class="fa fa-arrow-right" style="padding-left:10px;padding-right:10px;"></i> 1 visualizza il campo codice sconto, 0 non visualizza il campo nel form</li>
		<li><b>selectAnimali</b>   	= 1    <i class="fa fa-arrow-right" style="padding-left:10px;padding-right:10px;"></i> 1 visualizza la select animali ammmessi, 0 non visualizza la select</li>
		<li><b>selectAlloggi</b>    = 1    <i class="fa fa-arrow-right" style="padding-left:10px;padding-right:10px;"></i> 1 visualizza il campo Tipo alloggi(camere), 0 non visualizza il campo nel form</li>
		<li><b>tipoAlloggi</b>      = ''   <i class="fa fa-arrow-right" style="padding-left:10px;padding-right:10px;"></i> se si abilita il campo Tipo Alloggi è necessario compilare tutte e 6 le lingue dividendo le lingue con un cancelletto(#) ed i valori con una virgola(,)</li></span>
		<li><span style="font-size:12px">ESEMPIO: Camera Singola,Camere Doppia,Bungalows#Single Room, Double Room, Bungalows#Chambre Simple, Chambre Double, Bungalows#Einzelzimmer, Doppelzimmer, Bungalows#Habitación Individual, Habitación Doble, Bungalows#Одноместный номер, двухместный номер, бунгало </span></li>
		<li><span style="font-size:12px">valori  in italiano # valori in inglese # valori in francese # valori in tedesco # valori in spagnolo # valori in russo	</span></li>
		<li><b>multiStruttura</b>     	= ''    <i class="fa fa-arrow-right" style="padding-left:10px;padding-right:10px;"></i> campo utile per siglare le richieste con una etichetta di provenienza</li>
		<li><span style="font-size:12px">ESEMPIO: Landing Page Estate 2023, oppure Hotel Demo, oppure dinamicamente in PHP ($_SERVER['REQUEST_URI']), oppure in JavaScript (window.location.pathname).</span></li>
	</ul>
</p>
<br/>
		<h3><b>FUNZIONE PHP</b> </h3>
		<h4>
			<b>L'INTERFACCIA DEL FORM</b>  viene creata dall'operatore, nel menù di configurazione di QUOTO!<br>
			<small>I campi sono già tutti pre-compilati, ma nel caso in cui si volesse inserire campi aggiuntivi è da dall'area dedicata che sarà possibile farlo!<br>
			Nel caso particolare di una struttura ricettiva che gestisce <b>multi strutture</b>, e sempre da quest'area che sarà possibile <b>inserire un campo hidden nominato hotel</b> </small>
		</h4>

        <script>
            $(document).ready(function() {
                var i = 0;
                var speed = 500;
                link = setInterval(function() {
                    i++;
                    $("#blink").css('color', i%2 == 1 ? '#DD4B39' : '#2C3B41');
                },speed);
            })
        </script>
		<div class="row">
			<div class="col-md-12">
				<span class="text-info">Con questa FUNZIONE PHP è possibile avere il tracciamento delle campagne ADS (facebook, Google, Newsletter) con Analytics integrato in QUOTO</span><br>
                      Il sito e/o landing che include questo codice neccessità del framework <b>BootStrap 5 </b><br><br>
					  <b>
					  	Questo script può essere usato anche in WordPress, semplicemente creando una funzione con il codice (qui sotto) nella function.php di WP creando un add_shortcode(); cosi da poterlo richiamare dove si desidera.<br>
					  </b>
					  <br>
                    <script> var clipboard = new ClipboardJS('#FQfa');</script>	
										<i class="fa fa-code"></i>&nbsp;<b>Codice per includere il FORM di QUOTO nel sito e/o nelle landing page</b>&nbsp;&nbsp;<i class="fa fa-arrow-right"></i>&nbsp;&nbsp;
                    <p>Copia ed incolla il codice nella pagina dove vuoi il form&nbsp;&nbsp;<i class="fa fa-arrow-right"></i>
										  &nbsp;&nbsp;<a href="javascript:;" id="FQfa" data-clipboard-action="copy" data-clipboard-target="#FQ" title="copia" alt="copia" class="text-red"><i class="fa fa-clone" aria-hidden="true"></i>&nbsp;&nbsp;Copia ed incolla</a>
								    </p>
<pre id="FQ" style="background-color:#F7FBF5!important;">&lt;?php
  /** 
  * $urlback statico 
  * $urlback      = 'https://www.sitoweb.xx/pagina_di_atterraggio';
  */
  /** Calcolo del $urlback dinamico */
  $provenienza_ = explode("?",$_SERVER['REQUEST_URI']);
  $provenienza  = $provenienza_[0];
  $urlback      = 'https://'.$_SERVER['HTTP_HOST'].$provenienza;
  $id_form      = <?=$ID_FORM?>; 
  $idsito       = <?=$ID_SITO?>; 
  $language     = 'it';
  $captcha      = 0;  
  $jquery       = 1;
  $fontawesome  = 1; 
  $bootstrap    = 0;

  function print_form($api,$id_form,$idsito,$language,$captcha,$jquery,$fontawesome,$bootstrap,$urlback,$res,$tracking,$_ga,$NumeroPrenotazione,$testo_form){

      $campi = array(
              'id_form'            => $id_form,       
              'idsito'             => $idsito,         
              'language'           => $language,                  
              'captcha'            => $captcha,  
              'jquery'             => $jquery,                 
              'fontawesome'        => $fontawesome,
              'bootstrap'          => $bootstrap,
              'urlback'            => $urlback, 
              'res'                => $res,
              'tracking'           => urlencode($_SERVER['REQUEST_URI']),
              '_ga'                => urlencode($_COOKIE['_ga']),
              'NumeroPrenotazione' => $_REQUEST['NumeroPrenotazione'],
              'testo_form'         => $_REQUEST['testo_form'],	
              'tracking'           => urlencode($_SERVER['REQUEST_URI'])	  
            );

      $variabili = '';
      foreach ($campi as $k => $v) {
        $variabili .= $k . '=' . urlencode($v) . '&';
      }
      rtrim($variabili, '&');

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $api);
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_POST, true );
      curl_setopt($ch, CURLOPT_POSTFIELDS, $variabili );
      curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
      curl_setopt($ch, CURLOPT_REFERER,(json_encode($_SESSION['navigation'])));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $output = curl_exec($ch);
      curl_close($ch);
      if ($output) echo $output;
        else echo FALSE;
  }

  print_form('<?=BASE_URL_SITO?>apiForm/get_form.php',$id_form,$idsito,$language,$captcha,$jquery,$fontawesome,$bootstrap,$urlback,$_REQUEST['res'],$tracking,$_REQUEST['_ga'],$_REQUEST['NumeroPrenotazione'],$_REQUEST['testo_form']);
?&gt;</pre>
<div class="row">
    <div class="col-md-12">
        <h5><b>LEGENDA:</b> valore e posizione di ogni variabile impostabile nella chiamata della funzione <b>print_form();</b></h5>
          <ul>
		  <ol>1)  'Indirizzo della API'</ol>
            <ol>2)  'Id del Form', richiedere a Network Service</ol>
            <ol>3)  'Id del sito', richiedere a Network Service</ol> 
            <ol>4)  'Lingua' <small class="text-info">(Italiano = 'it', Inglese = 'en', Francese = 'fr', Tedesco = 'de', Spagnolo = 'es', Russo = 'ru', Olandese = 'nl', Polacco = 'pl, Ungherese = 'hu', Portoghese = 'pt', Arabo = 'ae', Ceco = 'cz', Cinese = 'cn', Brasiliano = 'br', Giapponese = 'jp')</small></ol>
            <ol>5)  'Captcha' <small class="text-info">(1 attivo 0 non attivo)</small></ol>
            <ol>6)  'Jquery' <small class="text-info">(1 attivo 0 non attivo)</small></ol>
            <ol>7)  'Fontawesome' <small class="text-info">(1 attivo 0 non attivo)</small></ol>
            <ol>8)  'Bootstrap' <small class="text-info">(1 attivo 0 non attivo) per includere le librerie bootstrap 5</small></ol>
            <ol>9)  'Url di ritorno post invio form' <small class="text-info">(potrebbe essere anche la stessa nella quale si stampa a video il form)</small></ol>
            <ol>10)  'questo campo è utile alla funzione <small class="text-danger">(NON MODIFICARLO)</small></ol>
            <ol>11) 'questo campo è utile per il tracciamento ads con il sistema nativo di QUOTO <small class="text-danger">(NON MODIFICARLO)</small></ol>
            <ol>12) 'questo campo è il COOKIE _GA di Google Analytics utile per il tracciamento delle campagne ADS e la sincronia API tra Analytics e QUOTO <small class="text-danger">(NON MODIFICARLO)</small></ol>
            <ol>13) 'questo campo è l'assegnazione automatica post invio form del Numero di Prenotazione di QUOTO <small class="text-danger">(NON MODIFICARLO)</small></ol>
            <ol>14) 'questo campo è utile alla funzione <small class="text-danger">(NON MODIFICARLO)</small></ol>
          </ul>
      </div>
</div>
<br />
<b>Per chi integra la privacy policy e la gestione dei cookie da IUBENDA in WordPress, alcuni suggerimenti:</b>
<br /><br />
<b>FUNZIONE E SETTING DEL PLUGIN IUBENDA PER WP</b> (screenshots)
<br />
<img src="<?=BASE_URL_SITO?>ApiQuoto/img/setting_plugin_iubenda.png">
<br />
<div class="row">
    <div class="col-md-12">
        <h5><b>LEGENDA:</b> </h5>
          <ul>
            <ol>1)  'LANGUAGE', sostituire con la lingua <small class="text-info">(it, en, fr, de, ecc)</small></ol>
            <ol>2)  'SITE_ID_IUBENDA', sostituire con il <small class="text-info">SITE ID di iubenda</small></ol>
            <ol>3)  'COOKIE_ID_IUBENDA', sostituire con il <small class="text-info">COOKIE ID di iubenda</small></ol> 
          </ul>
      </div>
</div>
<br />
<script> var clipboard = new ClipboardJS('#FQ2fa');</script>
<p>Copia ed incolla il codice di Iubenda nel setting del plugin in WP&nbsp;&nbsp;<i class="fa fa-arrow-right"></i>
  &nbsp;&nbsp;<a href="javascript:;" id="FQ2fa" data-clipboard-action="copy" data-clipboard-target="#FQ2" title="copia" alt="copia" class="text-red"><i class="fa fa-clone" aria-hidden="true"></i>&nbsp;&nbsp;Copia ed incolla</a>	
</p>

<pre id="FQ2" style="background-color:#F7FBF5!important;">
&lt;script type="text/javascript"&gt;
    var _iub = _iub || [];
    _iub.csConfiguration = {
        "consentOnContinuedBrowsing":false,
    "whitelabel":false,
    "lang": "LANGUAGE",
        "siteId": SITE_ID_IUBENDA,
    "perPurposeConsent":true,
        "cookiePolicyId": COOKIE_ID_IUBENDA, 
        "banner":{
      "position": "float-top-center",
      "acceptButtonDisplay":true,
      "customizeButtonDisplay":true,
      "rejectButtonDisplay":true
    },
        callback: {
            onPreferenceExpressedOrNotNeeded: function(preference) {
                dataLayer.push({
                    iubenda_ccpa_opted_out: _iub.cs.api.isCcpaOptedOut()
                });
                if (!preference) {
                    dataLayer.push({
                        event: "iubenda_preference_not_needed"
                    });
                    write_client_id();
                } else {
                    if (preference.consent === true) {
                        dataLayer.push({
                            event: "iubenda_consent_given"
                        });
                        write_client_id();
                    } else if (preference.consent === false) {
                        dataLayer.push({
                            event: "iubenda_consent_rejected"
                        });
                    } else if (preference.purposes) {
                        for (var purposeId in preference.purposes) {
                            if (preference.purposes[purposeId]) {
                                dataLayer.push({
                                    event: "iubenda_consent_given_purpose_" + purposeId
                                });
                                write_client_id();
                            }
                        }
                    }
                }
            }
        }
    };
    &lt;/script&gt;
    &lt;script type="text/javascript" src="//cdn.iubenda.com/cs/iubenda_cs.js" charset="UTF-8" async&gt;&lt;/script&gt;
</pre>
			</div>
		</div>


	<div style="clear:both;height:10px"></div>
			<div class="row">
				<div class="col-md-12">

<h3><b>APPLICATION PROGRAM INTERFACE</b> </h3>
			<b>Web API</b> CON TRACCIAMENTO ADS
			<br>
			<span class="text-danger">Con questa Web API, rispettando alcune regole di setting, è possibile avere il tracciamento delle campagne ADS (facebook, Google, Newsletter) con Analytics integrato in QUOTO</span>
<script> var clipboard = new ClipboardJS('#FQ4fa');</script>
<br>
<small>Questa metodo necessità la <b>costruzione del FORM da parte del WebMaster</b> incaricato, successivamente dovrà inviare il form (anche in ajax va bene, se si preferisce!) ad una una pagina che contenga il codice qui compilato, oppure su se stesso!</small><br>
		<div class="text-center">
			<a href="<?=BASE_URL_SITO?>ApiQuoto/esempio_form.zip" target="_blank" class="btn btn-success btn-xs">Download Form Fac Simile per siti standard</a>
			&nbsp;&nbsp;&nbsp;<a href="<?=BASE_URL_SITO?>ApiQuoto/tutorial_api_WP.zip" target="_blank" class="btn btn-primary btn-xs">Download Tutorial e File per integrazione QUOTO-WP Contact Form 7</a>
			&nbsp;&nbsp;&nbsp;<a href="<?=BASE_URL_SITO?>ApiQuoto/form_quoto_api_2023_elementor.zip" target="_blank" class="btn btn-warning btn-xs">Download Tutorial e File per integrazione QUOTO-WP con il Visual Editor Elementor</a>
		</div>
		<div style="clear:both;padding:0px 0px 2px 5px!important"></div>
		<i class="fa fa-code"></i>&nbsp;<b>CURL PHP PER API IN ASCOLTO</b> &nbsp;&nbsp;<i class="fa fa-arrow-right"></i>
		&nbsp;&nbsp;<a href="javascript:;" id="FQ4fa" data-clipboard-action="copy" data-clipboard-target="#FQ4" title="copia" alt="copia" class="text-red"><i class="fa fa-clone" aria-hidden="true"></i>&nbsp;&nbsp;Copia ed incolla</a></small>	
		<div class="clearfix" style="padding:0px 0px 2px 5px!important"></div>
		<pre id="FQ4" style="background-color:#F7FBF5!important;">
&lt;?php

if($_REQUEST['action']=='send'){

	$idsito  	= <?=$ID_SITO?>; //(ID del sito, richiedere a Network Service : marcello@network-service.it)
	$urlback 	= ''; //(Indirizzo del vostro sito con la pagina di atterraggio dopo l'invio del form)
	$user    	= ''; //(richiedere a Network Service : marcello@network-service.it)
	$pass    	= ''; //(richiedere a Network Service : marcello@network-service.it)
	$_REQUEST['id_lingua'] =  1; //(Italiano = 1, Inglese = 2, Francese = 3, Tedesco = 4)
	$_REQUEST['language']  = 'it'; //(Italiano = 'it', Inglese = 'en', Francese = 'fr', Tedesco = 'de')

	$campi = array(
					'nome'          => $_REQUEST['nome'],       <span class="text-success">//obbligatorio</span>
					'cognome'       => $_REQUEST['cognome'],    <span class="text-success">//obbligatorio</span>
					'email'         => $_REQUEST['email'],      <span class="text-success">//obbligatorio</span>
					'action'        => 'send',                  <span class="text-success">//obbligatorio</span>
					'language'      => $_REQUEST['language'],   <span class="text-success">//obbligatorio</span>
					'id_lingua'     => $_REQUEST['id_lingua'],  <span class="text-success">//obbligatorio</span>
					'idsito'        => $idsito,                 <span class="text-success">//obbligatorio</span>
					'urlback'       => $urlback,                <span class="text-success">//obbligatorio</span>
					'telefono'      => $_REQUEST['telefono'],
					'data_arrivo'   => $_REQUEST['data_arrivo'],    // dd-mm-yyyy  - obbligatorio
					'data_partenza' => $_REQUEST['data_partenza'],  // dd-mm-yyyy  - obbligatorio
					'DataArrivo'    => $_REQUEST['DataArrivo'],     // dd-mm-yyyy date alternative - opzionale
					'DataPartenza'  => $_REQUEST['DataPartenza'],   // dd-mm-yyyy date alternative - opzionale
					'adulti'        => $_REQUEST['adulti'],         <span class="text-success">//obbligatorio</span>
					'bambini'       => $_REQUEST['bambini'],        <span class="text-success">//obbligatorio</span>
					'TipoVacanza'   => $_REQUEST['TipoVacanza'],    //  (Family, Business, Fiera, Benessere, Divertimento, Sport)

					'TipoSoggiorno[]'=> $_REQUEST['TipoSoggiorno'][$i], //altamente consigliato ma non obbligatorio
					'NumeroCamere[]' => $_REQUEST['NumeroCamere'][$i],
					'TipoCamere[]'   => $_REQUEST['TipoCamere'][$i],
					'NumAdulti[]'    => $_REQUEST['NumAdulti'][$i],     //altamente consigliato ma non obbligatorio
					'NumBambini[]'   => $_REQUEST['NumBambini'][$i],    //altamente consigliato ma non obbligatorio
					'EtaB[]'         => $_REQUEST['EtaB'][$i],          //altamente consigliato ma non obbligatorio

					'hotel'         => $_REQUEST['hotel'],//(opzionale: solo se si tratta di una multi struttura)

					'messaggio'     => $_REQUEST['messaggio'],
					'codice_sconto' => $_REQUEST['codice_sconto'],
					'marketing'     => $_REQUEST['marketing'],
					'profilazione'  => $_REQUEST['profilazione'],
					'privacy'       => $_REQUEST['privacy'],        <span class="text-success">//obbligatorio</span>
					'Ip'            => $_SERVER['REMOTE_ADDR'],     <span class="text-success">//obbligatorio</span>
					'Agent'         => $_SERVER['HTTP_USER_AGENT'], <span class="text-success">//obbligatorio</span>
					'percorso'      => $_SERVER['HTTP_REFERER'],    <span class="text-success">//obbligatorio</span>
					'tracking'      => urlencode($_SERVER['REQUEST_URI']), <span class="text-success">//obbligatorio</span>
					'CLIENT_ID'     => $_REQUEST['CLIENT_ID']  <span class="text-success">//obbligatorio</span>
				);

				$dati = '';
				foreach ($campi as $k => $v) {
					$dati .= $k . '=' . urlencode($v) . '&';
				}
				rtrim($dati, '&');
				<!--
				Inserire i valori dentro il file .htpasswd nella directory /ApiFormQuoto/, creandoli personalizzati per ogni cliente
				con il tool https://toolset.mrwebmaster.it/dev/htpasswd-generator.html
				Esempio: topolino:cG0kiqu2l.ALQ (La password è criptata, al cliente va consegnato il valore corrispondente topolino:paperino)
				-->
				$user    = '........'; //(richiedere a Network Service : marcello@network-service.it)
				$pass    = '........'; //(richiedere a Network Service : marcello@network-service.it)
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, '<?=BASE_URL_SITO?>ApiFormQuoto/api_form_2_ads.php');
				curl_setopt($ch, CURLOPT_USERPWD, $user.':'.$pass);
				curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $dati);
				curl_exec($ch);
				curl_close($ch);
}

###################################################################################################################################################
?&gt;

&lt;!--
/**
* INSERIRE OBBLIGATORIAMENTE QUESTO SCRIPT NELLA COSTRUZIONE DEL FORM dentro il tag &lt;form&gt;&lt;/form&gt;
* La vostra pagina di atterraggio deve avere la libreria JQuery
* (il mancato inserimento pregiudicherebbe il tracciamento delle campagne ADS)
*/
--&gt;
		&lt;script&gt;
		function leggiCookie(nomeCookie) {
			if (document.cookie.length > 0) {
					var inizio = document.cookie.indexOf(nomeCookie + "=");
					if (inizio != -1) {
						inizio = inizio + nomeCookie.length + 1;
						var fine = document.cookie.indexOf(";", inizio);
						if (fine == -1) fine = document.cookie.length;
						return unescape(document.cookie.substring(inizio, fine));
					} else {
						return "";
					}
				}
				return "";
			}
			$(document).ready(function(){
				setTimeout(function(){
					var CLIENT_ID_ = leggiCookie("_ga");
					var CLIENT_ID_tmp =  CLIENT_ID_.split(".");
					var CLIENT_ID = CLIENT_ID_tmp[2]+"."+CLIENT_ID_tmp[3];
					$("#load_client_id").html('&lt;input type="hidden" name="CLIENT_ID" value="'+CLIENT_ID+'" /&gt;');
				}, 3000);
			});

		&lt;/script&gt;
		&lt;div id="load_client_id"&gt;&lt;/div&gt;


###################################################################################################################################################	
/**
* INSERIRE OBBLIGATORIAMENTE QUESTO SCRIPT NELLA PAGINA dentro il tag &lt;head&gt;&lt;/head&gt; DI RITORNO DAL INVIO DEL VOSTRO FORM
* La vostra pagina di atterraggio deve avere la libreria JQuery 
* (il mancato inserimento pregiudicherebbe il tracciamento delle campagne ADS)
*/		
&lt;script&gt;
	window.dataLayer = window.dataLayer || []; 
	dataLayer.push({'event': 'Init', 'NumeroPrenotazione': '&lt;?=$_REQUEST['NumeroPrenotazione']?&gt;#&lt;?=$_REQUEST['idsito']?&gt;'});
&lt;/script&gt;

			</pre>	
			

			<b>Web API PER ELEMENTOR</b> CON TRACCIAMENTO ADS
		<br>
		<script> var clipboard = new ClipboardJS('#FQEfa');</script>
		<br>			
			<i class="fa fa-code"></i>&nbsp;<b>Codice </b>&nbsp;&nbsp;<i class="fa fa-arrow-right"></i>&nbsp;&nbsp;<small>Copia ed incolla il codice&nbsp;&nbsp;<i class="fa fa-arrow-right"></i>
			&nbsp;&nbsp;<a href="javascript:;" id="FQEfa" data-clipboard-action="copy" data-clipboard-target="#FQE" title="copia" alt="copia" class="text-red"><i class="fa fa-clone" aria-hidden="true"></i>&nbsp;&nbsp;Copia ed incolla</a>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" id="view_leg"><i class="fa fa-expand" aria-hidden="true"></i>&nbsp;&nbsp;Visulizza Legenda campi obbligatori</a>
		</small>
		<script>
			$(document).ready(function(){			
				$("#view_leg").click(function() {
					$("#legenda").slideToggle("slow");
				});
			})
		</script>
<pre style="display:none" id="legenda">
	<small>
		<b>LEGENDA</b> <br>
		<em>['form_fields'] = campo concordato da Elementor</em><br>
		'nome'          =  $_REQUEST['form_fields']['nome'];       <span class="text-success">//obbligatorio</span>
		'cognome'       =  $_REQUEST['form_fields']['cognome'];    <span class="text-success">//obbligatorio</span>
		'email'         =  $_REQUEST['form_fields']['email'];      <span class="text-success">//obbligatorio</span>
		'action'        =  'send',                  <span class="text-success">//obbligatorio</span>
		'language'      =  $_REQUEST['form_fields']['language'];   <span class="text-success">//obbligatorio</span>
		'id_lingua'     =  $_REQUEST['form_fields']['id_lingua'];  <span class="text-success">//obbligatorio</span>
		'idsito'        =  $idsito,                 <span class="text-success">//obbligatorio</span>
		'urlback'       =  $urlback,                <span class="text-success">//obbligatorio</span>
		'telefono'      =  $_REQUEST['form_fields']['telefono'];   <span class="text-primary">//NON obbligatorio</span>
		'data_arrivo'   =  $_REQUEST['form_fields']['data_arrivo'];    // dd-mm-yyyy  - <span class="text-success">obbligatorio</span>
		'data_partenza' =  $_REQUEST['form_fields']['data_partenza'];  // dd-mm-yyyy  - <span class="text-success">obbligatorio</span>
		'DataArrivo'    =  $_REQUEST['form_fields']['DataArrivo'];     // dd-mm-yyyy date alternative - opzionale
		'DataPartenza'  =  $_REQUEST['form_fields']['DataPartenza'];   // dd-mm-yyyy date alternative - opzionale
		'adulti'        =  $_REQUEST['form_fields']['adulti'];         <span class="text-success">//obbligatorio</span>
		'bambini'       =  $_REQUEST['form_fields']['bambini'];        <span class="text-primary">//NON obbligatorio</span>

		'TipoVacanza'     =  $_REQUEST['form_fields']['TipoVacanza'];    //  (Family, Business, Fiera, Benessere, Divertimento, Sport) - opzionale
		'codice_sconto'   =  $_REQUEST['form_fields']['codice_sconto'];  //  input text - opzionale
		'animali_ammessi' =  $_REQUEST['form_fields']['animali_ammessi'];//  select (0 = vuoto,1 = non ammessi,2 = ammessi) - opzionale

		'TipoSoggiorno1'=  $_REQUEST['form_fields']['TipoSoggiorno1']; <span class="text-success">//obbligatorio</span>
		'NumeroCamere1' =  $_REQUEST['form_fields']['NumeroCamere1'];  //(esempio: 1,2,3,4,5,6,7,8,9,10) - opzionale
		'TipoCamere1'   =  $_REQUEST['form_fields']['TipoCamere1'];    //(esempio: Singola, Doppia, Tripla, Suite, Junior Suite, Family Room) - opzionale
		'NumAdulti1'    =  $_REQUEST['form_fields']['NumAdulti1'];     <span class="text-success">//obbligatorio</span>
		'NumBambini1'   =  $_REQUEST['form_fields']['NumBambini1'];      
		'EtaB1_1'       =  $_REQUEST['form_fields']['EtaB1_1'];        <span class="text-success">//obbligatorio</span> solo se esitono bambini
		'EtaB1_2'       =  $_REQUEST['form_fields']['EtaB1_2'];        <span class="text-success">//obbligatorio</span> solo se esitono bambini
		'EtaB1_3'       =  $_REQUEST['form_fields']['EtaB1_3'];        <span class="text-success">//obbligatorio</span> solo se esitono bambini
		'EtaB1_4'       =  $_REQUEST['form_fields']['EtaB1_4'];        <span class="text-success">//obbligatorio</span> solo se esitono bambini
		'EtaB1_5'       =  $_REQUEST['form_fields']['EtaB1_5'];        <span class="text-success">//obbligatorio</span> solo se esitono bambini

		'TipoSoggiorno2'=  $_REQUEST['form_fields']['TipoSoggiorno2']; <span class="text-info">//opzionale</span>
		'NumeroCamere2' =  $_REQUEST['form_fields']['NumeroCamere2'];  <span class="text-info">//opzionale</span>
		'TipoCamere2'   =  $_REQUEST['form_fields']['TipoCamere2'];    <span class="text-info">//opzionale</span>
		'NumAdulti2'    =  $_REQUEST['form_fields']['NumAdulti2'];     <span class="text-info">//opzionale</span>
		'NumBambini2'   =  $_REQUEST['form_fields']['NumBambini2'];    <span class="text-info">//opzionale</span>
		'EtaB2_1'       =  $_REQUEST['form_fields']['EtaB2_1'];        <span class="text-info">//opzionale</span> 
		'EtaB2_2'       =  $_REQUEST['form_fields']['EtaB2_2'];        <span class="text-info">//opzionale</span>  
		'EtaB2_3'       =  $_REQUEST['form_fields']['EtaB2_3'];        <span class="text-info">//opzionale</span>  
		'EtaB2_4'       =  $_REQUEST['form_fields']['EtaB2_4'];        <span class="text-info">//opzionale</span>  
		'EtaB2_5'       =  $_REQUEST['form_fields']['EtaB2_5'];        <span class="text-info">//opzionale</span>  

		'TipoSoggiorno3'=  $_REQUEST['form_fields']['TipoSoggiorno3']; <span class="text-info">//opzionale</span>
		'NumeroCamere3' =  $_REQUEST['form_fields']['NumeroCamere3'];  <span class="text-info">//opzionale</span>
		'TipoCamere3'   =  $_REQUEST['form_fields']['TipoCamere3'];    <span class="text-info">//opzionale</span>
		'NumAdulti3'    =  $_REQUEST['form_fields']['NumAdulti3'];     <span class="text-info">//opzionale</span> 
		'NumBambini3'   =  $_REQUEST['form_fields']['NumBambini3'];    <span class="text-info">//opzionale</span>
		'EtaB3_1'       =  $_REQUEST['form_fields']['EtaB3_1'];        <span class="text-info">//opzionale</span>  
		'EtaB3_2'       =  $_REQUEST['form_fields']['EtaB3_2'];        <span class="text-info">//opzionale</span>  
		'EtaB3_3'       =  $_REQUEST['form_fields']['EtaB3_3'];        <span class="text-info">//opzionale</span>  
		'EtaB3_4'       =  $_REQUEST['form_fields']['EtaB3_4'];        <span class="text-info">//opzionale</span>  
		'EtaB3_5'       =  $_REQUEST['form_fields']['EtaB3_5'];        <span class="text-info">//opzionale</span>  

		'hotel'         =  $_REQUEST['form_fields']['hotel'];          //(solo se si tratta di una multi struttura) - opzionale

		'messaggio'     =  $_REQUEST['form_fields']['messaggio'];      <span class="text-primary">//NON obbligatorio</span>

		'marketing'     =  $_REQUEST['form_fields']['marketing'];      <span class="text-primary">//NON obbligatorio</span>
		'profilazione'  =  $_REQUEST['form_fields']['profilazione'];   <span class="text-primary">//NON obbligatorio</span>

		'privacy'       =  $_REQUEST['form_fields']['privacy'];        <span class="text-success">//obbligatorio</span>
		'Ip'            =  $_REQUEST['form_fields']['Ip'];     		<span class="text-success">//obbligatorio</span> ($_SERVER['REMOTE_ADDR'])
		'Agent'         =  $_REQUEST['form_fields']['Agent']; 			<span class="text-success">//obbligatorio</span> ($_SERVER['HTTP_USER_AGENT'])
		'tracking'      =  urlencode('https//'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']); <span class="text-success">//obbligatorio</span> - (creato in jQuery nel caso di elementor)
		'CLIENT_ID'     =  $_REQUEST['form_fields']['CLIENT_ID'];      <span class="text-success">//obbligatorio</span> - (creato in jQuery nel caso di elementor)
			
	</small>
</pre>			
		<pre id="FQE" style="background-color:#F7FBF5!important;">&lt;?php
		if($_REQUEST['form_fields']['action']=='send'){

					foreach ($_REQUEST['form_fields'] as $key => $value) {
							$campi[$key] = $value ;
					}

					$dati = '';
					foreach ($campi as $k => $v) {
						$dati .= $k . '=' . urlencode($v) . '&';
					}
					rtrim($dati, '&');

					$user    = 'quoto';
					$pass    = 'lHxAbMHGU'; 
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, '<?=BASE_URL_SITO?>ApiFormQuoto/api_form_elementor.php');
					curl_setopt($ch, CURLOPT_USERPWD, $user.':'.$pass);
					curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $dati);
					curl_exec($ch);
					curl_close($ch);
		}
		###################################################################################################################################################
		?&gt;

		&lt;!--
		/**
		* INSERIRE OBBLIGATORIAMENTE QUESTO SCRIPT NELLA COSTRUZIONE DEL FORM dentro il tag &lt;form&gt;&lt;/form&gt;
		* La vostra pagina di atterraggio deve avere la libreria JQuery
		* (il mancato inserimento pregiudicherebbe il tracciamento delle campagne ADS)
		*/
		--&gt;
			&lt;script&gt;
			function leggiCookie(nomeCookie) {
				if (document.cookie.length > 0) {
						var inizio = document.cookie.indexOf(nomeCookie + "=");
						if (inizio != -1) {
							inizio = inizio + nomeCookie.length + 1;
							var fine = document.cookie.indexOf(";", inizio);
							if (fine == -1) fine = document.cookie.length;
							return unescape(document.cookie.substring(inizio, fine));
						} else {
							return "";
						}
					}
					return "";
				}
				$(document).ready(function(){
					setTimeout(function(){
						var CLIENT_ID_ = leggiCookie("_ga");
						var CLIENT_ID_tmp =  CLIENT_ID_.split(".");
						var CLIENT_ID = CLIENT_ID_tmp[2]+"."+CLIENT_ID_tmp[3];
						$("#CLIENT_ID").val(CLIENT_ID);
					}, 3000);
				});

			&lt;/script&gt;



		###################################################################################################################################################	
		/**
		* INSERIRE OBBLIGATORIAMENTE QUESTO SCRIPT NELLA PAGINA dentro il tag &lt;head&gt;&lt;/head&gt; DI RITORNO DAL INVIO DEL VOSTRO FORM
		* La vostra pagina di atterraggio deve avere la libreria JQuery 
		* (il mancato inserimento pregiudicherebbe il tracciamento delle campagne ADS)
		*/		
		&lt;script&gt;
		window.dataLayer = window.dataLayer || []; 
		dataLayer.push({'event': 'Init', 'NumeroPrenotazione': '&lt;?=$_REQUEST['NumeroPrenotazione']?&gt;#&lt;?=$_REQUEST['idsito']?&gt;'});
		&lt;/script&gt;

		?&gt;</pre>




		</div>
	</div>
		################################################################################################################################################### <br>
		<div style="clear:both;height:10px"></div>
			<div class="row">
				<div class="col-md-8"><img src="<?=BASE_URL_SITO?>img/logo_network_2021.png"></div>
				<div class="col-md-4">
			        <b>Network Service</b><br>
			        Via Valentini A. e L., 11 47922 Rimini (RN), Italia <br>
			        <b>Tel:</b> +39 0541790062 | <b>Fax:</b> +39 0541778656<br>
			        <b>Email:</b> info@network-service.it<br>
			        <b>Email Developer:</b> marcello@network-service.it
		      </div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center">
					<p>&nbsp;</p>
					Per richiedere i dati di accesso <i class="fa fa-sign-in"></i> USER e PASS,contattare marcello@network-service.it
					<p>&nbsp;</p>
		      </div>
			</div>
		</div>
</body>
</html>
